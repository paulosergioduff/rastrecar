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
$html .= '<th style="border:#000 1px solid; font-size:12px"><b>Entrada</b></th>';
$html .= '<th style="border:#000 1px solid; font-size:12px"><b>Hora Entrada</b></th>';
$html .= '<th style="border:#000 1px solid; font-size:12px"><b>Saída</b></th>';
$html .= '<th style="border:#000 1px solid; font-size:12px"><b>Hora Saída</b></th>';
$html .= '<th style="border:#000 1px solid; font-size:12px"><b>Tempo Evento</b></th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';


$data_hoje = date('Y-m-d H:i');

$cons_conexao = mysqli_query($conn,"SELECT * FROM tc_events WHERE deviceid='$deviceid' AND type='geofenceEnter' AND (servertime >= '$data_inicial' AND servertime <= '$data_final') ORDER BY id ASC");


	if(mysqli_num_rows($cons_conexao) > 0){
		while ($resp_conexao = mysqli_fetch_assoc($cons_conexao)) {
		$positionid = 	$resp_conexao['positionid'];
		$servertime1 = $resp_conexao['servertime'];
		$servertime = date('d/m/Y H:i:s', strtotime('-3 hour', strtotime($servertime1)));
		$geofenceid = $resp_conexao['geofenceid'];
		$type = $resp_conexao['type'];
	
		
		$cons_fence = mysqli_query($conn,"SELECT * FROM tc_geofences WHERE id='$geofenceid'");
			if(mysqli_num_rows($cons_fence) > 0){
			while ($row_fence = mysqli_fetch_assoc($cons_fence)) {
			$name_cerca = $row_fence['name'];
			$description = $row_fence['description'];
			}}
		
		$entrada = '<i class="fas fa-chevron-circle-right" style="color:#4169E1"></i> CHEGADA '.$description.'';
		
		$cons_cliente = mysqli_query($conn,"SELECT * FROM tc_positions WHERE id='$positionid'");
			if(mysqli_num_rows($cons_cliente) > 0){
		while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
		$latitude = 	$resp_cliente['latitude'];
		$longitude = 	$resp_cliente['longitude'];
		$address = 	$resp_cliente['address'];
		$driver_num = $resp_cliente['driver_num'];
			
			$cons_driver = mysqli_query($conn, "SELECT * FROM motoristas WHERE cartao_rfid='$driver_num'");
				if(mysqli_num_rows($cons_driver) <= 0){
				$nome_motorista = '';
				}
				if(mysqli_num_rows($cons_driver) > 0){
					while ($resp_rel10 = mysqli_fetch_assoc($cons_driver)) {
					$id_motorista = $resp_rel10['id_motorista'];
					$nome_motorista = $resp_rel10['nome_motorista'];

				}}
		
			}}
		
		
		
		
		$cons_fence_ent = mysqli_query($conn,"SELECT * FROM tc_events WHERE deviceid='$deviceid' AND servertime > '$servertime1' AND type='geofenceExit' ORDER BY id ASC LIMIT 1");
			if(mysqli_num_rows($cons_fence_ent) <= 0){
			$saida = '<i class="fab fa-product-hunt" style="color:#F4A460"></i> PARADO NO LOCAL';
			$servertime10 = '';
			$tempo ='';
			}
			if(mysqli_num_rows($cons_fence_ent) > 0){
			while ($row_fence1 = mysqli_fetch_assoc($cons_fence_ent)) {
			$servertime11 = $row_fence1['servertime'];
			$servertime10 = date('d/m/Y H:i:s', strtotime('-3 hour', strtotime($servertime11)));
			$date_time  = new DateTime($servertime1);
			 $diff       = $date_time->diff( new DateTime($servertime11));
			 $tempo = $diff->format('%H hora(s), %i minuto(s)');
			 $saida = '<i class="fas fa-chevron-circle-left" style="color:#009900"></i> SAIDA '.$description.'';
			}}
			
			$horario = $ervertime10;

$html .= '<tr><td style="border-bottom:#000 1px solid; font-size:10px">'.$entrada.'</td>';
$html .= '<td style="border-bottom:#000 1px solid; font-size:10px">'.$servertime.'</td>';
$html .= '<td style="border-bottom:#000 1px solid; font-size:10px">'.$saida.'</td>';
$html .= '<td style="border-bottom:#000 1px solid; font-size:10px">'.$servertime10.'</td>';
$html .= '<td style="border-bottom:#000 1px solid; font-size:10px">'.$tempo.'</td></tr>';




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
    <td width="80%" style="font-size:18px; text-align: center;"><b>RELATORIO CERCAS VITUAIS</b></td>
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