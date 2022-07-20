<?php 

include('../conexao.php');	
$deviceid = $_GET['deviceid'];
$data_inicial = $_GET['data_inicial'];
$data_inic  =  date('Y-m-d H:i:s', strtotime($data_inicial));
$data_inicial1 = date('d/m/Y H:i:s', strtotime("$data_inicial"));
$data_final = $_GET['data_final'];
$data_fin  =  date('Y-m-d H:i:s', strtotime($data_final));
$data_final1 = date('d/m/Y H:i:s', strtotime("$data_final"));

$data = date('d/m/Y H:i:s');

$cons_empresa = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='1361'");
	if(mysqli_num_rows($cons_empresa) > 0){
while ($resp_empresa = mysqli_fetch_assoc($cons_empresa)) {
$nome_url = $resp_empresa['nome_url'];

$login_traccar = $resp_empresa['login_traccar'];
$senha_traccar = $resp_empresa['senha_traccar'];
$token_traccar = $login_traccar.':'.$senha_traccar;
$token_traccar = base64_encode($token_traccar);
	}}	
	
	
$cons_veiculo = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE deviceid='$deviceid'");
	if(mysqli_num_rows($cons_veiculo) > 0){
while ($resp_veiculo = mysqli_fetch_assoc($cons_veiculo)) {
$placa = $resp_veiculo['placa'];
$marca_veiculo = $resp_veiculo['marca_veiculo'];
$modelo_veiculo = $resp_veiculo['modelo_veiculo'];
$veiculo = $placa.' - '.$marca_veiculo.'/'.$modelo_veiculo;
$id_cliente = $resp_veiculo['id_cliente'];
	}}	
	
$cons_cliente = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
	if(mysqli_num_rows($cons_cliente) > 0){
while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
$nome_cliente = $resp_cliente['nome_cliente'];
$logo1 = $resp_cliente['logo'];
	}}	

if($logo1 == ''){
	$logo = '20210903100915-1361.jpg';
} else {
	$logo = $logo1;
}



$html = '<table width="100%"';	
$html .= '<thead>';
$html .= '<tr>';
$html .= '<th style="border:#000 1px solid; font-size:12px"><b>Data/Hora</b></th>';
$html .= '<th style="border:#000 1px solid; font-size:12px"><b>Comando Enviado</b></th>';
$html .= '<th style="border:#000 1px solid; font-size:12px"><b>Endereço</b></th>';
$html .= '<th style="border:#000 1px solid; font-size:12px"><b>Enviado por</b></th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';


$cons_comandos = mysqli_query($conn,"SELECT * FROM comandos_enviados WHERE deviceid='$deviceid' AND executado='SIM' AND (data >='$data_inic' AND data<='$data_fin') ORDER BY id_log DESC ");
if(mysqli_num_rows($cons_comandos) > 0){
	while ($resp_comandos = mysqli_fetch_assoc($cons_comandos)) {
	$executado = 	$resp_comandos['executado'];
	$address = 	$resp_comandos['address'];
	$comando = 	$resp_comandos['comando'];
	$nome_user = 	$resp_comandos['nome_user'];
	$data_comand = 	$resp_comandos['data'];
	$data_comand = date('d/m/Y H:i:s', strtotime("$data_comand"));
	
	if($comando == 'BLOQUEIO'){
		$comand = '<h4><span class="badge" style="background-color:#CD5C5C; color:#FFF"><i class="fas fa-lock"></i> BLOQUEIO</span></h4>';
	}
	if($comando == 'DESBLOQUEIO'){
		$comand = '<h4><span class="badge" style="background-color:#009900; color:#FFF"><i class="fas fa-lock-open"></i> DESBLOQUEIO</span></h4>';
	}
	if($comando == 'ANCORA'){
		$comand = '<h4><span class="badge" style="background-color:#999; color:#FFF"><i class="fas fa-anchor"></i> ANCORA</span></h4>';
	}


$html .= '<tr><td style="border-bottom:#000 1px solid; font-size:10px">'.$data_comand.'</td>';
$html .= '<td style="border-bottom:#000 1px solid; font-size:10px">'.$comando.'</td>';
$html .= '<td style="border-bottom:#000 1px solid; font-size:10px">'.$address.'</td>';
$html .= '<td style="border-bottom:#000 1px solid; font-size:10px">'.$nome_user.'</td></tr>';




}}

//referenciar o DomPDF com namespace
	use Dompdf\Dompdf;

	// include autoloader
	require_once("../dompdf/autoload.inc.php");

	//Criando a Instancia
	$dompdf = new DOMPDF();
	$dompdf = new Dompdf(array('enable_remote' => true));
	$dompdf->setPaper('A4', 'portrait'); //Paisagem
	// Carrega seu HTML
	$dompdf->load_html('

<table width="100%">
  <tr>
    <td width="20%" rowspan="5" style="font-size:18px; text-align: center;"><img src="http://rastreiamaisbrasil.com.br/tracker3/manager/logos/'.$logo.'" style="width:100px;height:auto;"></td>
    <td width="80%" style="font-size:18px; text-align: center;"><b>RELATORIO DE COMANDOS ENVIADOS</b></td>
  </tr>
  <tr>
    <td style="font-size:14px; text-align: center;">Periodo: '.$data_inicial1.' ate '.$data_final1.'</td>
  </tr>
  <tr>
    <td style="font-size:14px; text-align: center;">Data Processamento: '.$data.'</td>
  </tr>
  <tr>
    <td style="font-size:14px; text-align: center;">Veículo: '.$veiculo.'</td>
  </tr>
  <tr>
    <td style="font-size:14px; text-align: center;">Cliente: '.$nome_cliente.'</td>
  </tr>
  <tr>
    <td colspan="2" style="font-size:14px; text-align: center;"><hr style="border:#000 1px solid;"></td>
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