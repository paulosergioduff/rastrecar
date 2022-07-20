<?php 

include('../conexao.php');	



setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');
$date = date('y-m-d H:i:s');

$semana = date("w"); 
$dia = date("j");
$mês = date("n");
$ano = date("Y");

$meses = array(1 => "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", 
"Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro");

$semanas = array("Domingo", "Segunda-Feira", "Terça-Feira", "Quarta-Feira", "Quinta-Feira", "Sexta-Feira", "Sábado");


$base64 = $_GET['c'];
$base = base64_decode($base64);
$dados = explode("&", $base);

$id_cliente = $dados[0];
$cliente = explode(":", $id_cliente);
$id_cliente = $cliente[1];

$id_veiculo = $dados[1];
$veiculo = explode(":", $id_veiculo);
$id_veiculo = $veiculo[1];


$cons_cliente = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
	if(mysqli_num_rows($cons_cliente) > 0){
while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
$nome_cliente = 	$resp_cliente['nome_cliente'];
$doc_cliente = 	$resp_cliente['doc_cliente'];
$rg_cliente	 = 	$resp_cliente['rg_cliente'];
$data_nascimento = 	$resp_cliente['data_nascimento'];
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
$data_cadastro = 	$resp_cliente['data_cadastro'];
$data_cadastro = date('d/m/Y', strtotime("$data_cadastro"));
$status = 	$resp_cliente['status'];
$email = 	$resp_cliente['email'];
$assinatura = 	$resp_cliente['assinatura'];
$id_empresa = 	$resp_cliente['id_empresa'];
	
}}



	$sql11 = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE id_veiculo = '$id_veiculo' ORDER BY id_veiculo DESC");
	if(mysqli_num_rows($sql11) > 0){						
	while ($rows44 = mysqli_fetch_assoc($sql11)) {
	$marca_veiculo = $rows44['marca_veiculo'];
	$modelo_veiculo = $rows44['modelo_veiculo'];
	$chassi = $rows44['chassi'];
	$placa = $rows44['placa'];
	$pacote = $rows44['pacote'];
	$renavan = $rows44['renavan'];
	$cor_veiculo = $rows44['cor_veiculo'];
	$tipo_veiculo = $rows44['tipo_veiculo'];
	$ano_veiculo = $rows44['ano_veiculo'];
	$forma_pagamento = $rows44['forma_pagamento'];
	$valor_mensal = $rows44['valor_mensal'];
	$valor_mensal = number_format($valor_mensal, 2, ",", ".");
	}}
	



	$sql1 = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='$id_empresa'");
	if(mysqli_num_rows($sql1) > 0){						
	while($rows4 = $sql1->fetch_array(MYSQLI_ASSOC)){
	$razao_social = $rows4['razao_social'];
	$cnpj = $rows4['cnpj'];
	$endereco_emp = $rows4['endereco'];
	$numero_emp = $rows4['numero'];
	$complemento_emp = $rows4['complemento'];
	$bairro_emp = $rows4['bairro'];
	$cidade_emp = $rows4['cidade'];
	$estado_emp = $rows4['estado'];
	$cep_emp = $rows4['cep'];
	$telefone_emp = $rows4['telefone'];

	}}


	$cons_pacote = mysqli_query($conn,"SELECT * FROM pacotes WHERE id_pacote='$pacote_cliente'");
	if(mysqli_num_rows($cons_pacote) > 0){
while ($resp_pacote = mysqli_fetch_assoc($cons_pacote)) {
$pacote1 = 	$resp_pacote['pacote'];
$info = 	$resp_pacote['info'];
$info = utf8_encode($info);
$valor_pacote = $resp_pacote['valor'];
}}




	$conta_veic = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE nr_contrato='$nr_contrato'");
	$total = mysqli_num_rows($conta_veic);


$soma_contrato = $total * $valor;
$valor1 = number_format($valor_contrato, 2, ",", ".");




//referenciar o DomPDF com namespace
	use Dompdf\Dompdf;

	// include autoloader
	require_once("../dompdf/autoload.inc.php");

	//Criando a Instancia
	$dompdf = new DOMPDF();
	$dompdf = new Dompdf(array('enable_remote' => true));
	// Carrega seu HTML
	$dompdf->load_html('
		<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><table width="100%" border="0" cellspacing="0">
      <tr>
        <td width="14%"><img src="http://rastreiamaisbrasil.com.br/tracker/Imagens/logo_excel.png" alt=""></td>
        <td width="72%" align="center"><table width="100%" border="0" cellspacing="0">
          <tr>
            <td align="center"><span style="font-size:18px"><B>FORMULÁRIO DE ADESÃO</B></span></td>
          </tr>
          <tr>
            <td align="center"><span style="font-size:12px"><B>RASTREAMENTO E MONITORAMENTO VEICULAR</B></span></td>
          </tr>
        </table></td>
        <td width="14%" align="right"><span style="font-size:10px"><B>Contrato: '.$id_veiculo.'</B></span></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><hr style="border:#000 1px solid;"></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" style="font-size:12px;">
      <tr>
        <td width="48%" style="background-color:#CCC"><b>DADOS DA CONTRATADA</b></td>
        <td width="4%">&nbsp;</td>
        <td width="48%">&nbsp;</td>
      </tr>
      <tr>
        <td>Razão Social: <b>RMB RASTREIA MAIS BRASIL</b></td>
        <td>&nbsp;</td>
        <td>Telefone: <b>(81)99880-2625</b></td>
      </tr>
      <tr>
        <td>End.: <b>AV DR CLAUDIO JOSE GUEIROS LEITE, 3444</b></td>
        <td>&nbsp;</td>
        <td>Bairro/Cidade: <b>JANGA, PAULISTA/PE</b></td>
      </tr>
      <tr>
        <td>CNPJ: <b>42.202.950/0001-49</b></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>

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
