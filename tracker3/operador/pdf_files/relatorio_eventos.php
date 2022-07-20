<?php 

include('../conexao.php');	
$deviceid = $_GET['deviceid'];
$data_inicial = $_GET['data_inicial'];
$data_inic  =  date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_inicial)));
$data_inicial1 = date('d/m/Y H:i:s', strtotime("$data_inicial"));
$data_final = $_GET['data_final'];
$data_fin  =  date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_final)));
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
$html .= '<th style="border:#000 1px solid; font-size:12px"><b>Tipo de Evento</b></th>';
$html .= '<th style="border:#000 1px solid; font-size:12px"><b>Endereço</b></th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';





	
$cons_conta = mysqli_query($conn,"SELECT * FROM tc_events WHERE deviceid='$deviceid' AND (eventtime >= '$data_inic' AND eventtime <= '$data_fin') AND (type='ignitionOff' OR type='ignitionOn' OR type='alarm' OR type='geofenceExit' OR type='geofenceEnter' OR type='deviceOverspeed') ORDER BY id ASC");
	$total = mysqli_num_rows($cons_conta);
		if(mysqli_num_rows($cons_conta) > 0){
		
while ($row_ev = mysqli_fetch_assoc($cons_conta)) {
	$positionid = $row_ev['positionid'];
	$geofenceid = $row_ev['geofenceid'];
	$horario_alarme = $row_ev['eventtime'];
	$horario_alarme = date('d/m/Y H:i:s', strtotime('-3 hour', strtotime($horario_alarme)));
	$eventos = $row_ev['attributes'];
	$eventos1 = json_decode($eventos);
	$alarme = $eventos1->{'alarm'};
	$type = $row_ev['type'];
	$speed1 = $eventos1->{'speed'};
	$speed1 = $speed1 + 1.609;
	$speed1 = round($speed1, 2);

if($type == 'deviceOverspeed'){
	$notific = '<font color="#990000"><i class="fas fa-tachometer-alt"></i> <b>EXC. VELOCIDADE</b></font>';	
} 

if($type == 'ignitionOn'){
	$notific = '<font color="#009900"><i class="fas fa-key"></i> <b>IGNIÇÃO LIGADA</b></font>';	
} 
if($type == 'ignitionOff'){
	$notific = '<i class="fas fa-key"></i> <b>IGNIÇÃO DESLIGADA<b/>';
}

if($alarme == 'powerCut' && $type == 'alarm'){
	$notific = '<font color="#990000"><i class="fas fa-car-battery"></i> <b>BATERIA REMOVIDA</b></font>';
}
if($alarme == 'shock' && $type == 'alarm' ){
	$notific = '<font color="#990000"><i class="far fa-bell"></i> <b>ALARME DISPARADO SENSOR</b></font>';
}

if($alarme == 'door' && $type == 'alarm'){
	$notific = '<font color="#990000"><i class="far fa-bell"></i> <b>ALARME DISPARADO PORTAS</b></font>';
}
if($alarme == null && $type == 'geofenceExit'){
	$cons_fence = mysqli_query($conn,"SELECT * FROM tc_geofences WHERE id='$geofenceid'");
if(mysqli_num_rows($cons_fence) > 0){
while ($row_fence = mysqli_fetch_assoc($cons_fence)) {
$name_cerca = $row_fence['name'];
$description = $row_fence['description'];
if($description == 'ANCORA'){
	$tipo = '<font color="#990000"><i class="fas fa-anchor"></i> <b>ANCORA VIOLADA</b></font>';

} else {
	$tipo = '<i class="far fa-vector-square"></i> </b>SAIDA CERCA '.$name_cerca.'</b>';
}

	$notific = $tipo;
}}}
if($alarme == null && $type == 'geofenceEnter'){
	$notific = '<i class="far fa-bell"></i> </b>ENTRADA CERCA '.$name_cerca.'</b>';
}



							
$cons_position = mysqli_query($conn,"SELECT * FROM tc_positions WHERE id='$positionid'");
if(mysqli_num_rows($cons_position) > 0){
while ($resp_posi = mysqli_fetch_assoc($cons_position)) {			
$id_pos = $resp_posi['id'];
$address = $resp_posi['address'];
$speed = 	$resp_posi['speed'];
$speed = $speed * 1.609;
$speed = round($speed, 2);
$address = str_replace(', BR', '', $address);
$address1 = explode(",", $address);
$estado1 = end($address1);
$estado = ','.$estado1;
$address = str_replace($estado, '', $address);
$address1 = explode(",", $address);
$cep = end($address1);
$cep = ','.$cep;
$address = str_replace($cep, '', $address);
$address = $address.' /'.$estado1;
}}

$html .= '<tr><td style="border-bottom:#000 1px solid; font-size:10px">'.$horario_alarme.'</td>';
$html .= '<td style="border-bottom:#000 1px solid; font-size:10px">'.$notific.'</td>';
$html .= '<td style="border-bottom:#000 1px solid; font-size:10px">'.$address.'</td></tr>';






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
	$dompdf->setPaper('A4', 'portrait'); //Paisagem
	// Carrega seu HTML
	$dompdf->load_html('

<table width="100%">
  <tr>
    <td width="20%" rowspan="5" style="font-size:18px; text-align: center;"><img src="http://rastreiamaisbrasil.com.br/tracker3/manager/logos/'.$logo.'" style="width:100px;height:auto;"></td>
    <td width="80%" style="font-size:18px; text-align: center;"><b>RELATORIO DE EVENTOS/ALERTAS</b></td>
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