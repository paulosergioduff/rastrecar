<?php
include_once("../conexao.php");

$deviceid = $_GET['deviceid'];
$geofenceid = $_GET['geofenceid'];
$id_cliente_login = $_GET['id'];


$cons_nivel = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='1361'");
	if(mysqli_num_rows($cons_nivel) > 0){
while ($resp_nivel = mysqli_fetch_assoc($cons_nivel)) {
$login_traccar = 	$resp_nivel['login_traccar'];
$senha_traccar = 	$resp_nivel['senha_traccar'];
$token_traccar = ''.$login_traccar.':'.$senha_traccar.'';
$token_traccar = base64_encode($token_traccar);
}}


$json = json_encode($object);

$url = 'http://5.189.185.179:8082/api/geofences/'.$geofenceid.'';

$ch = curl_init();


curl_setopt($ch, CURLOPT_URL, $url);

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE"); 



curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

curl_setopt($ch, CURLOPT_HTTPHEADER, array(

    'Content-Type: application/json',

	'Authorization: Basic '.$token_traccar.''

));


$output = curl_exec($ch);
$response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

$sql = mysqli_query($conn, "UPDATE veiculos_clientes SET ancora='OFF', geofenceid='' WHERE deviceid='$deviceid'");

header('Location: ../grid_device.php?deviceid='.$deviceid.'&anc=200&id='.$id_cliente_login.'&p=index&app=on');

?>