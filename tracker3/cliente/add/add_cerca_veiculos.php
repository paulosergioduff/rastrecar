<?php
include_once("../conexao.php");

$data_criacao = date('Y-m-d H:i');
$id_empresa = $_REQUEST['customer'];
$veiculos = $_REQUEST['veiculos'];
$geofenceid = $_REQUEST['geofenceid'];
$pag = $_REQUEST['pag'];
$id_cerca = $_REQUEST['id_cerca'];



$cons_nivel = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='1'");
	if(mysqli_num_rows($cons_nivel) > 0){
while ($resp_nivel = mysqli_fetch_assoc($cons_nivel)) {
$login_traccar = 	$resp_nivel['login_traccar'];
$senha_traccar = 	$resp_nivel['senha_traccar'];
$token_traccar = ''.$login_traccar.':'.$senha_traccar.'';
$token_traccar = base64_encode($token_traccar);
}}







$json = json_encode($object);






for($i=0; $i<count($veiculos); $i++){

$object1 = array('deviceId' => $veiculos[$i], 'geofenceId' => $geofenceid);

$json1 = json_encode($object1);

$url1 = 'http://5.189.185.179:8082/api/permissions';

$ch1 = curl_init();


curl_setopt($ch1, CURLOPT_URL, $url1);

curl_setopt($ch1, CURLOPT_POST, 1);

curl_setopt($ch1, CURLOPT_POSTFIELDS, $json1);

curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);

curl_setopt($ch1, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

curl_setopt($ch1, CURLOPT_HTTPHEADER, array(

    'Content-Type: application/json',

	'Authorization: Basic '.$token_traccar.''

));


$output1 = curl_exec($ch1);
$response_code1 = curl_getinfo($ch1, CURLINFO_HTTP_CODE);
echo $output1;

}


if($pag == 1){
	header('Location: ../view_cerca1.php?c='.$id_cerca.'');
}
if($pag == 0){
	header('Location: ../view_cerca.php?c='.$id_cerca.'');
}








?>