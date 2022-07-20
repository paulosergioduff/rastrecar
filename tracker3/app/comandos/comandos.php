<?php
include_once("../conexao.php");

$deviceid = $_REQUEST['deviceid'];
$modelo_equip = $_REQUEST['model'];
$nome_user = $_REQUEST['nome_user'];
$tipo_comando = $_REQUEST['t'];
$id = $_REQUEST['id'];
$data = date('Y-m-d H:i:s');

$cons_nivel = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='1361'");
	if(mysqli_num_rows($cons_nivel) > 0){
while ($resp_nivel = mysqli_fetch_assoc($cons_nivel)) {
$login_traccar = 	$resp_nivel['login_traccar'];
$senha_traccar = 	$resp_nivel['senha_traccar'];
$token_traccar = ''.$login_traccar.':'.$senha_traccar.'';
$token_traccar = base64_encode($token_traccar);
}}

$cons_veiculo = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE deviceid='$deviceid' ");
	if(mysqli_num_rows($cons_veiculo) > 0){
while ($resp_veiculo = mysqli_fetch_assoc($cons_veiculo)) {
$bloqueio_veic = 	$resp_veiculo['bloqueio'];
$modelo_equip = 	$resp_veiculo['modelo_equip'];
$id_veiculo = 	$resp_veiculo['id_veiculo'];
	}}

$cons_equip = mysqli_query($conn,"SELECT * FROM comandos_gprs WHERE modelo_equip='$modelo_equip' AND tipo='$tipo_comando'");
	if(mysqli_num_rows($cons_equip) > 0){
while ($resp_equip = mysqli_fetch_assoc($cons_equip)) {
$name_server = 	$resp_equip['name_server'];
$id_server = 	$resp_equip['id_server'];
$comando = 	$resp_equip['comando'];

	}}




$object = array('type' => $name_server ,'attributes' => null, 'description' => $comando, 'id' => $id_server, 'deviceId' => $deviceid);

$json = json_encode($object);

$url = 'http://5.189.185.179:8082/api/commands/send';

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
//echo $output;


$base64 = 'deviceid:'.$deviceid;
$base64 = base64_encode($base64);

if($response_code == 200){
	$sql_comando = mysqli_query($conn,"INSERT INTO comandos_enviados (deviceid, data, id_veiculo, comando, nome_user) VALUES ('$deviceid', '$data', '$id_veiculo', '$tipo_comando', '$nome_user')");
	header('Location: ../grid_device.php?deviceid='.$deviceid.'&id='.$id.'&res=200');
} 

if($response_code == 202){
	$sql_comando = mysqli_query($conn,"INSERT INTO comandos_enviados (deviceid, data, id_veiculo, comando, nome_user) VALUES ('$deviceid', '$data', '$id_veiculo', '$tipo_comando', '$nome_user')");
    header('Location: ../grid_device.php?deviceid='.$deviceid.'&id='.$id.'&res=202&cmd=enable');
} 

if($response_code == 400){
	header('Location: ../grid_device.php?deviceid='.$deviceid.'&id='.$id.'&res=400');
}
if($response_code == 401){
	header('Location: ../grid_device.php?deviceid='.$deviceid.'&id='.$id.'&res=401');
}

?>