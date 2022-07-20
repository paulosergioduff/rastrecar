<?php
include_once("../conexao.php");

$deviceid = $_GET['deviceid'];
$geofenceid = $_GET['geofenceid'];

$id_push = $_GET['id'];

$cons_user1 = mysqli_query($conn,"SELECT * FROM usuarios_push WHERE id_push='$id_push' ");
if(mysqli_num_rows($cons_user1) > 0){
	while ($resp_user1 = mysqli_fetch_assoc($cons_user1)) {
$tipo = 	$resp_user1['tipo'];
$id_cliente_login = $resp_user1['id_cliente'];

}}	


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

$url = 'http://5.189.185.179:8082/api/permissions';

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


header('Location: ../grid_device.php?deviceid='.$deviceid.'&anc=400&id='.$id_push.'&p=index&app=on');



?>