<?php 

include('../conexao.php');	
$cliente = $_GET['cliente'];
$bloqueados = $_GET['bloqueados'];
$cliente_pai = $_GET['cliente_pai'];


$data = date('d/m/Y H:i:s');
									
if($cliente == '1'){
	if($bloqueados == 'SIM'){
		$tabela = "SELECT * FROM clientes WHERE status='1' AND id_cliente_pai='$cliente_pai' ORDER BY nome_cliente ASC";
	}
	if($bloqueados != 'SIM'){
		$tabela = "SELECT * FROM clientes AND id_cliente_pai='$cliente_pai' ORDER BY nome_cliente ASC";
	}
	
}

if($cliente != '1'){
	if($bloqueados == 'SIM'){
		$tabela = "SELECT * FROM clientes WHERE id_cliente='$cliente' OR id_cliente_pai='$cliente_pai' ORDER BY nome_cliente ASC";
	}
	if($bloqueados != 'SIM'){
		$tabela = "SELECT * FROM clientes WHERE (id_cliente='$cliente' OR id_cliente_pai='$cliente_pai') AND status='1'  ORDER BY nome_cliente ASC";
	}
}

$soma_total = mysqli_query($conn, $tabela);
$soma_total = mysqli_num_rows($soma_total);



$html = '<table width="100%"';	
$html .= '<thead>';
$html .= '<tr>';
$html .= '<th style="border:#000 1px solid; font-size:12px"><b>CPF/CNPJ</b></th>';
$html .= '<th style="border:#000 1px solid; font-size:12px"><b>Tipo</b></th>';
$html .= '<th style="border:#000 1px solid; font-size:12px"><b>Cliente</b></th>';
$html .= '<th style="border:#000 1px solid; font-size:12px"><b>Endereco</b></th>';
$html .= '<th style="border:#000 1px solid; font-size:12px"><b>Bairro</b></th>';
$html .= '<th style="border:#000 1px solid; font-size:12px"><b>Cidade</b></th>';
$html .= '<th style="border:#000 1px solid; font-size:12px"><b>UF</b></th>';
$html .= '<th style="border:#000 1px solid; font-size:12px"><b>Telefone</b></th>';
$html .= '<th style="border:#000 1px solid; font-size:12px"><b>Celular</b></th>';
$html .= '<th style="border:#000 1px solid; font-size:12px"><b>Veiculos</b></th>';
$html .= '<th style="border:#000 1px solid; font-size:12px"><b>Status</b></th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';



$resultado_usuario = mysqli_query($conn, $tabela);
if(mysqli_num_rows($resultado_usuario) > 0){
while($resp_cliente = mysqli_fetch_assoc($resultado_usuario)){
$nome_cliente = 	$resp_cliente['nome_cliente'];
$doc_cliente = 	$resp_cliente['doc_cliente'];
$documento = preg_replace("/[^0-9]/", "", $doc_cliente);
$cep = 	$resp_cliente['cep'];
$endereco = 	$resp_cliente['endereco'];
$numero = 	$resp_cliente['numero'];
$complemento = 	$resp_cliente['complemento'];
$bairro = 	$resp_cliente['bairro'];
$cidade = 	$resp_cliente['cidade'];
$estado = 	$resp_cliente['estado'];
$telefone_residencial = 	$resp_cliente['telefone_residencial'];
$telefone_celular = 	$resp_cliente['telefone_celular'];
$telefone_outros = 	$resp_cliente['telefone_outros'];
$status = 	$resp_cliente['status'];
$id_cliente = 	$resp_cliente['id_cliente'];

if(strlen($documento) == 14){
	$tipo = 'P. Fisica';
}
if(strlen($documento) == 11){
	$tipo = 'P. Juridica';
}

if($status == 1){
	$status1 = 'ATIVO';
}
if($status != 1){
	$status1 = 'INATIVO';
}

$cons_veiculos = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE id_cliente='$id_cliente' AND status='1'");
$total_veiculos = mysqli_num_rows($cons_veiculos);

	



$html .= '<tr><td style="border-bottom:#000 1px solid; font-size:10px">'.$doc_cliente.'</td>';
$html .= '<td style="border-bottom:#000 1px solid; font-size:10px">'.$tipo.'</td>';
$html .= '<td style="border-bottom:#000 1px solid; font-size:10px">'.$nome_cliente.'</td>';
$html .= '<td style="border-bottom:#000 1px solid; font-size:10px">'.$endereco.', '.$numero.'</td>';
$html .= '<td style="border-bottom:#000 1px solid; font-size:10px">'.$bairro.'</td>';
$html .= '<td style="border-bottom:#000 1px solid; font-size:10px">'.$cidade.'</td>';
$html .= '<td style="border-bottom:#000 1px solid; font-size:10px">'.$estado.'</td>';
$html .= '<td style="border-bottom:#000 1px solid; font-size:10px">'.$telefone_residencial.'</td>';
$html .= '<td style="border-bottom:#000 1px solid; font-size:10px">'.$telefone_celular.'</td>';
$html .= '<td style="border-bottom:#000 1px solid; font-size:10px">'.$total_veiculos.'</td>';
$html .= '<td style="border-bottom:#000 1px solid; font-size:10px">'.$status1.'</td></tr>';


		}}



$html .= '</tbody>';
$html .= '</table';

//referenciar o DomPDF com namespace
	use Dompdf\Dompdf;

	// include autoloader
	require_once("../dompdf/autoload.inc.php");

	//Criando a Instancia
	$dompdf = new DOMPDF();
	$dompdf = new Dompdf(array('enable_remote' => true));
	$dompdf->setPaper('A4', 'landscape'); //Paisagem
	// Carrega seu HTML
	$dompdf->load_html('

<table width="100%">
  <tr>
    <td width="8%"><img src="http://rastreiamaisbrasil.com.br/tracker/Imagens/logo_excel.png"></td>
    <td width="92%" style="font-size:22px; text-align: center;"><b>RELATORIO DE CLIENTES</b></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td style="font-size:14px; text-align: center;">Data Processamento: '.$data.'</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td style="font-size:14px; text-align: center;">Total de Registros: '.$soma_total.'</td>
  </tr>
</table>
			'. $html .'
		');

	//Renderizar o html
	$dompdf->render();

	//Exibibir a página
	$dompdf->stream(
		"Relatorio_veiculos.pdf", 
		array(
			"Attachment" => false //Para realizar o download somente alterar para true
		)
	);



?>