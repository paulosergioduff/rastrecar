<?php
include_once("conexao.php");

$data_criacao = date('Y-m-d H:i');
$id_empresa = $_REQUEST['customer'];
$veiculos = $_REQUEST['veiculos'];
$nome_cerca = $_REQUEST['nome_cerca'];
$latitude = $_REQUEST['latitude'];
$longitude = $_REQUEST['longitude'];
$coordenadas1 = $_REQUEST['coordenadas'];
$tipo_cerca = $_REQUEST['tipo_cerca'];
$endereco = $_REQUEST['endereco'];
$radius_size = $_REQUEST['radius_size'];
$obj1 = new \stdClass; // Instantiate stdClass object
$obj2 = new class{}; // Instantiate anonymous class
$obj3 = (object)[]; 


$cons_nivel = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='1361'");
	if(mysqli_num_rows($cons_nivel) > 0){
while ($resp_nivel = mysqli_fetch_assoc($cons_nivel)) {
$login_traccar = 	$resp_nivel['login_traccar'];
$senha_traccar = 	$resp_nivel['senha_traccar'];
$token_traccar = ''.$login_traccar.':'.$senha_traccar.'';
$token_traccar = base64_encode($token_traccar);
}}


if($tipo_cerca == 'POLYGON'){
	$coordenadas = str_replace('(', '', $coordenadas1);
	$coord = explode("),", $coordenadas);
	$coordenadas = str_replace(')', '', $coord);
	$coordenadas = str_replace(',', ' ', $coordenadas);
	
	$coordenadas = implode(", ", $coordenadas);
	$coord_ini = $coord[0];
	$coord_ini = str_replace(',', ' ', $coord_ini);
	$coordenadas20 = 'POLYGON(('.$coordenadas.', '.$coord_ini.'))';
	$coordenadas20 = str_replace('  ', ' ', $coordenadas20);

	$object = array('area' => $coordenadas20, 'attributes' => $obj3, 'description' => $nome_cerca, 'name' => $nome_cerca);
}

if($tipo_cerca == 'CIRCLE'){
	$object = array('area' => 'CIRCLE ('.$latitude.' '.$longitude.', '.$radius_size.')', 'attributes' => $obj3, 'description' => $nome_cerca, 'name' => $nome_cerca);
}





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
echo $output;


$codigo = json_decode($output);
	$id = $codigo->{'id'};

if($response_code == 401){
	header('Location: ../nova_cerca.php?res=401');
}

$sql = mysqli_query($conn, "INSERT INTO cerca_virtual (geofenceid, id_cliente, endereco, latitude, longitude, radius, nome_cerca, data_criacao, area, tipo) VALUES ('$id', '$id_cliente', '$endereco', '$latitude', '$longitude', '$radius_size', '$nome_cerca', '$data_criacao', '$coordenadas1', '$tipo_cerca')");

for($i=0; $i<count($veiculos); $i++){

$object1 = array('deviceId' => $veiculos[$i], 'geofenceId' => $id);

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


}





header('Location: ../cerca_virtual.php');








?>