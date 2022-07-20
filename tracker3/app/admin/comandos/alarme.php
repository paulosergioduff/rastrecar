<?php
include_once("../conexao.php");

$deviceid = $_GET['deviceid'];
$id = $_REQUEST['id'];
$cons_alarme = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE deviceid='$deviceid' ");
	if(mysqli_num_rows($cons_alarme) > 0){
while ($resp_alarme = mysqli_fetch_assoc($cons_alarme)) {
$status_alarme = 	$resp_alarme['status_alarme'];
if($status_alarme == 'OFF'){
	$comando = 10;
	$tipo = 'alarmArm';
	$descricao = 'AlarmeOn';
} else if($status_alarme == 'ON'){
	$comando = 11;
	$tipo = 'alarmDisarm';
	$descricao = 'AlarmeOff';
}
	}}

$cons_nivel = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='1'");
	if(mysqli_num_rows($cons_nivel) > 0){
while ($resp_nivel = mysqli_fetch_assoc($cons_nivel)) {
$login_traccar = 	$resp_nivel['login_traccar'];
$senha_traccar = 	$resp_nivel['senha_traccar'];
$token_traccar = ''.$login_traccar.':'.$senha_traccar.'';
$token_traccar = base64_encode($token_traccar);
}}


$object = array('type' => $tipo, 'attributes' => null, 'description' => $descricao, 'id' => $comando, 'deviceId' => $deviceid);

$json = json_encode($object);

$url = 'http://207.244.237.148:8082/api/commands/send';

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

echo $response_code.'-'.$output;

if ($comando == 10 && $response_code == 200) {
       $sql = mysqli_query($conn,"UPDATE veiculos_clientes SET status_alarme='ON' WHERE deviceid='$deviceid'");
} else if ($comando == 10 && $response_code == 200) {
       $sql = mysqli_query($conn,"UPDATE veiculos_clientes SET status_alarme='OFF' WHERE deviceid='$deviceid'");
} else if ($comando == 10 && $response_code == 202) {
       $sql = mysqli_query($conn,"UPDATE veiculos_clientes SET status_alarme='ON' WHERE deviceid='$deviceid'");
} else if ($comando == 11 && $response_code == 202) {
       $sql = mysqli_query($conn,"UPDATE veiculos_clientes SET status_alarme='OFF' WHERE deviceid='$deviceid'");
} else if ($comando == 10 && $response_code == 400) {
       $sql = '';
} else if ($comando == 11 && $response_code == 400) {
       $sql = '';
}


if($response_code == 200){
	header('Location: ../grid_device.php?deviceid='.$deviceid.'&id='.$id.'&res=200');
} else if($response_code == 202){
	header('Location: ../grid_device.php?deviceid='.$deviceid.'&id='.$id.'&res=200');
} else if($response_code == 400){
	header('Location: ../grid_device.php?deviceid='.$deviceid.'&id='.$id.'&res=200');
}

?>