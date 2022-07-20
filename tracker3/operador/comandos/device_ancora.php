<?php
include_once("../conexao.php");

$deviceid = $_GET['deviceid'];
$geofenceid = $_GET['geofenceid'];


$cons_nivel = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='1'");
	if(mysqli_num_rows($cons_nivel) > 0){
while ($resp_nivel = mysqli_fetch_assoc($cons_nivel)) {
$login_traccar = 	$resp_nivel['login_traccar'];
$senha_traccar = 	$resp_nivel['senha_traccar'];
$token_traccar = ''.$login_traccar.':'.$senha_traccar.'';
$token_traccar = base64_encode($token_traccar);
}}



$object = array('deviceId' => $deviceid, 'geofenceId' => $geofenceid);

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

$base64 = 'deviceid:'.$deviceid;
$base64 = base64_encode($base64);

header('Location: ../grid_device.php?c='.$base64.'&anc=200');



?>