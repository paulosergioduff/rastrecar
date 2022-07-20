<?php
include_once("../conexao.php");

$data = date('Y-m-d H:i:s');

$nome_user = $_REQUEST['nome_user'];
$deviceid = $_REQUEST['deviceid'];
$id_cliente_login = $_GET['id'];
$cons_veiculo = mysqli_query($conn,"SELECT * FROM tc_positions WHERE deviceid='$deviceid' ORDER BY id DESC LIMIT 1");
	if(mysqli_num_rows($cons_veiculo) > 0){
while ($resp_veiculo = mysqli_fetch_assoc($cons_veiculo)) {
$lat = 	$resp_veiculo['latitude'];
$positionid = 	$resp_veiculo['id'];
$address = 	$resp_veiculo['address'];
$long = 	$resp_veiculo['longitude'];
$obj1 = new \stdClass; // Instantiate stdClass object
$obj2 = new class{}; // Instantiate anonymous class
$obj3 = (object)[]; 

	}}

$cons_nivel = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='1361'");
	if(mysqli_num_rows($cons_nivel) > 0){
while ($resp_nivel = mysqli_fetch_assoc($cons_nivel)) {
$login_traccar = 	$resp_nivel['login_traccar'];
$senha_traccar = 	$resp_nivel['senha_traccar'];
$token_traccar = ''.$login_traccar.':'.$senha_traccar.'';
$token_traccar = base64_encode($token_traccar);
}}

$cons_veiculo1 = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE deviceid='$deviceid' ");
	if(mysqli_num_rows($cons_veiculo1) > 0){
while ($resp_veiculo1 = mysqli_fetch_assoc($cons_veiculo1)) {
$bloqueio_veic = 	$resp_veiculo1['bloqueio'];
$modelo_equip = 	$resp_veiculo1['modelo_equip'];
$id_veiculo = 	$resp_veiculo1['id_veiculo'];
	}}


$object = array('area' => 'CIRCLE ('.$lat.' '.$long.', 50.1)', 'attributes' => $obj3, 'description' => 'ANCORA', 'name' => 'ANCORA');

$json = json_encode($object);

$url = 'http://5.189.185.179:8082/api/geofences';

$ch = curl_init();


curl_setopt($ch, CURLOPT_URL, $url);

curl_setopt($ch, CURLOPT_POST, 1);

curl_setopt($ch, CURLOPT_POSTFIELDS, $json);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

curl_setopt($ch, CURLOPT_HTTPHEADER, array(

    'Content-Type: application/json',

	'Authorization: Basic '.$token_traccar.''

));


$output = curl_exec($ch);
$response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

$codigo = json_decode($output);
	$id = $codigo->{'id'};


$sql = mysqli_query($conn, "UPDATE veiculos_clientes SET ancora='ON', geofenceid='$id' WHERE deviceid='$deviceid'");

$sql_comando = mysqli_query($conn,"INSERT INTO comandos_enviados (deviceid, data, id_veiculo, comando, nome_user, positionid, address, executado) VALUES ('$deviceid', '$data', '$id_veiculo', 'ANCORA', '$nome_user', '$positionid', '$address', 'SIM')");

header('Location: device_ancora.php?deviceid='.$deviceid.'&geofenceid='.$id.'&id='.$id_cliente_login.'');









?>