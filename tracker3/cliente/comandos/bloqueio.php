<?php
include_once("../conexao.php");

$deviceid = $_REQUEST['deviceid'];
$id_empresa = $_REQUEST['id_empresa'];

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
	}}

$cons_equip = mysqli_query($conn,"SELECT * FROM rastreadores_portas WHERE sigla='$modelo_equip' ");
	if(mysqli_num_rows($cons_equip) > 0){
while ($resp_equip = mysqli_fetch_assoc($cons_equip)) {
$id_block = 	$resp_equip['id_block'];
$id_desblock = 	$resp_equip['id_desblock'];
$bloqueio = 	$resp_equip['bloqueio'];
$desbloqueio = 	$resp_equip['desbloqueio'];
$nome_block = 	$resp_equip['nome_block'];
$nome_desblock = 	$resp_equip['nome_desblock'];
	}}

if($bloqueio_veic == 'NAO'){
	$comando = $id_block;
	$tipo = $bloqueio;
	$descricao = $nome_block;
} else if($bloqueio_veic == 'SIM'){
	$comando = $id_desblock;
	$tipo = $desbloqueio;
	$descricao = $nome_desblock;
}


$object = array('type' => $tipo ,'attributes' => null, 'description' => $descricao, 'id' => $comando, 'deviceId' => $deviceid);

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

if($response_code == 401){
	header('Location: ../grid_device.php?id_device='.$deviceid.'&res=401');
}


$output = curl_exec($ch);
$response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
echo $output;


if($response_code == 200){
	if ($bloqueio_veic == 'SIM') {
       $sql = mysqli_query($conn,"UPDATE veiculos_clientes SET bloqueio='NAO' WHERE deviceid='$deviceid'");
	} if ($bloqueio_veic == 'NAO') {
       $sql = mysqli_query($conn,"UPDATE veiculos_clientes SET bloqueio='SIM' WHERE deviceid='$deviceid'");
	}
	header('Location: ../grid_device.php?id_device='.$deviceid.'&res=200');
} 

if($response_code == 202){
	if ($bloqueio_veic == 'SIM') {
      header('Location: ../grid_device.php?id_device='.$deviceid.'&res=202&cmd=disable');
	} if ($bloqueio_veic == 'NAO') {
      header('Location: ../grid_device.php?id_device='.$deviceid.'&res=202&cmd=enable');
	}
	
} 

if($response_code == 400){
	header('Location: ../grid_device.php?id_device='.$deviceid.'&res=400');
}


?>