<?php 

include('../conexao.php');	
$cliente = $_GET['cliente'];
$cliente_pai = $_GET['cliente_pai'];
$equipamentos = $_GET['equipamentos'];
$data_inicial = $_GET['data_inicial'];
$data_inicial1 = date('d/m/Y', strtotime("$data_inicial"));
$data_final = $_GET['data_final'];
$data_final1 = date('d/m/Y', strtotime("$data_final"));

$cons_empresa = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='1361'");
	if(mysqli_num_rows($cons_empresa) > 0){
while ($resp_empresa = mysqli_fetch_assoc($cons_empresa)) {
$nome_url = $resp_empresa['nome_url'];
$logo = $resp_empresa['logo'];
$texto_rodape = $resp_empresa['texto_rodape'];
$texto_topo = $resp_empresa['texto_topo'];
$cor_sistema = $resp_empresa['cor_sistema'];
	}}	

$data = date('d/m/Y H:i:s');

if($equipamentos != '1'){
	$equip = "AND modelo_equip='$equipamentos'";
}
if($equipamentos == '1'){
	$equip = '';
}

if($cliente == '1'){
	$tabela = "SELECT * FROM veiculos_clientes WHERE id_cliente_pai='$cliente_pai' AND (data_cadastro >= '$data_inicial' AND data_cadastro <= '$data_final') ".$equip." ORDER BY data_cadastro ASC";
}
if($cliente != '1'){
	$tabela = "SELECT * FROM veiculos_clientes WHERE id_cliente IN ($clientes) AND (data_cadastro >= '$data_inicial' AND data_cadastro <= '$data_final') ".$equip." ORDER BY data_cadastro ASC";
}

$soma_total = mysqli_query($conn, $tabela);
$soma_total = mysqli_num_rows($soma_total);



$html = '<table width="100%"';	
$html .= '<thead>';
$html .= '<tr>';
$html .= '<th style="border:#000 1px solid; font-size:12px"><b>Descricao</b></th>';
$html .= '<th style="border:#000 1px solid; font-size:12px"><b>Placa</b></th>';
$html .= '<th style="border:#000 1px solid; font-size:12px"><b>Cliente</b></th>';
$html .= '<th style="border:#000 1px solid; font-size:12px"><b>Data Cadastro</b></th>';
$html .= '<th style="border:#000 1px solid; font-size:12px"><b>Dispositivo</b></th>';
$html .= '<th style="border:#000 1px solid; font-size:12px"><b>Modelo Equipamento</b></th>';
$html .= '<th style="border:#000 1px solid; font-size:12px"><b>Data Instalacao</b></th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';



$resultado_usuario = mysqli_query($conn, $tabela);
if(mysqli_num_rows($resultado_usuario) > 0){
while($row_usuario = mysqli_fetch_assoc($resultado_usuario)){
$id_cliente = $row_usuario['id_cliente'];
$id_veiculo = $row_usuario['id_veiculo'];
$placa = $row_usuario['placa'];
$modelo_veiculo = $row_usuario['modelo_veiculo'];
$marca_veiculo = $row_usuario['marca_veiculo'];
$data_cadastro = $row_usuario['data_cadastro'];
$data_cadastro = date('d/m/Y', strtotime("$data_cadastro"));
$encerramento_os1 = $row_usuario['encerramento_os'];

$modelo_equip = $row_usuario['modelo_equip'];
$imei = $row_usuario['imei'];
$veiculo = $marca_veiculo.'/'.$modelo_veiculo;

if($encerramento_os1 == ''){
	$encerramento_os = '';
}
if($encerramento_os1 != ''){
	$encerramento_os = date('d/m/Y', strtotime("$encerramento_os"));
}

$cons_cliente = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
	if(mysqli_num_rows($cons_cliente) > 0){
		while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
		$nome_cliente = 	$resp_cliente['nome_cliente'];
	}}

	



$html .= '<tr><td style="border-bottom:#000 1px solid; font-size:10px">'.$veiculo.'</td>';
$html .= '<td style="border-bottom:#000 1px solid; font-size:10px">'.$placa.'</td>';
$html .= '<td style="border-bottom:#000 1px solid; font-size:10px">'.$nome_cliente.'</td>';
$html .= '<td style="border-bottom:#000 1px solid; font-size:10px">'.$data_cadastro.'</td>';
$html .= '<td style="border-bottom:#000 1px solid; font-size:10px">'.$imei.'</td>';
$html .= '<td style="border-bottom:#000 1px solid; font-size:10px">'.$modelo_equip.'</td>';
$html .= '<td style="border-bottom:#000 1px solid; font-size:10px">'.$encerramento_os.'</td></tr>';






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
    <td width="8%"><img src="http://rastreiamaisbrasil.com.br/tracker3/manager/logos/'.$logo.'" style="width:150px;height:auto;"></td>
    <td width="92%" style="font-size:22px; text-align: center;"><b>RELATORIO DE VEICULOS</b></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td style="font-size:14px; text-align: center;">Periodo: '.$data_inicial1.' ate '.$data_final1.'</td>
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