<?php
include_once("conexao.php");

$deviceid = $_GET['deviceid'];
$geofenceid = $_GET['geofenceid'];
$id_empresa = $_REQUEST['id_empresa'];
$pag = $_REQUEST['pag'];

$cons_nivel = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='1361'");
	if(mysqli_num_rows($cons_nivel) > 0){
while ($resp_nivel = mysqli_fetch_assoc($cons_nivel)) {
$login_traccar = 	$resp_nivel['login_traccar'];
$senha_traccar = 	$resp_nivel['senha_traccar'];
$token_traccar = ''.$login_traccar.':'.$senha_traccar.'';
$token_traccar = base64_encode($token_traccar);
}}



$object1 = array('deviceId' => $deviceid, 'geofenceId' => $geofenceid);

$json1 = json_encode($object1);

$url1 = 'http://144.91.86.255:8082/api/permissions/';

$ch1 = curl_init();


curl_setopt($ch1, CURLOPT_URL, $url1);

curl_setopt($ch1, CURLOPT_POST, 1);

curl_setopt($ch1, CURLOPT_POSTFIELDS, $json1);

curl_setopt($ch1, CURLOPT_CUSTOMREQUEST, "DELETE"); 

curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);

curl_setopt($ch1, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

curl_setopt($ch1, CURLOPT_HTTPHEADER, array(

    'Content-Type: application/json',

	'Authorization: Basic '.$token_traccar.''

));


$output = curl_exec($ch1);
$response_code = curl_getinfo($ch1, CURLINFO_HTTP_CODE);
echo $response_code.'<br>'.$output;


$cons_devices = mysqli_query($conn,"SELECT * FROM cerca_virtual WHERE geofenceid='$geofenceid'");
	if(mysqli_num_rows($cons_devices) > 0){
		while ($resp_p = mysqli_fetch_assoc($cons_devices)) {
		$id_cerca = 	$resp_p['id_cerca'];
			}}
			
			
if($pag == 1){
	header('Location: view_cerca1.php?c='.$id_cerca.'');
}
if($pag == 0){
	header('Location: view_cerca.php?c='.$id_cerca.'');
}


?>