<?php
include_once("conexao.php");

$id_equip = $_REQUEST['id_equip'];
$id_veiculo = $_REQUEST['id_veiculo'];
$modelo_equip = $_REQUEST['modelo_equip'];
$fornecedor = $_REQUEST['fornecedor'];
$imei = $_REQUEST['imei'];
$deviceid = $_REQUEST['deviceid'];
$obs_bateria = $_REQUEST['obs_bateria'];
$id_empresa = $_REQUEST['customer_fact'];

$iccid = $_REQUEST['iccid'];
$chip = $_REQUEST['chip'];
$operadora = $_REQUEST['operadora'];

$data_entrada = date('Y-m-d');

if($modelo_equip == 'GT02D'){
	$atributos = '{"processing.copyAttributes":"ignition","devicePassword":"6666","gt06.alternative":"true"}';
} else if($modelo_equip == 'GT06-2'){
	$atributos = '{"processing.copyAttributes":"ignition","devicePassword":"123456","gt06.alternative":"true"}';
} else {
$obj1 = new \stdClass; // Instantiate stdClass object
$obj2 = new class{}; // Instantiate anonymous class
$obj3 = (object)[]; 
$atributos = $obj3;
}

$cons_nivel = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='$id_empresa'");
	if(mysqli_num_rows($cons_nivel) > 0){
while ($resp_nivel = mysqli_fetch_assoc($cons_nivel)) {
$ip_traccar = 	$resp_nivel['ip_traccar'];
$login_traccar = 	$resp_nivel['login_traccar'];
$senha_traccar = 	$resp_nivel['senha_traccar'];
$token_traccar = ''.$login_traccar.':'.$senha_traccar.'';
$token_traccar = base64_encode($token_traccar);
}}

$object = array('name' => $modelo_equip, 'attributes' => $atributos, 'uniqueId' => $imei, 'category' => 'car', 'contact' => 'ESTOQUE', 'phone' => $chip, 'id'=> $deviceid);
			$json = json_encode($object);
			$url = 'http://144.91.86.255:8082/api/devices/'.$deviceid.'';
			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Content-Type: application/json',
				'Authorization: Basic '.$token_traccar.''
			));
			$output = curl_exec($ch);
			$response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);



$sql222 = mysqli_query($conn,"UPDATE estoque_rastreadores SET modelo_equip='$modelo_equip', imei='$imei', chip='$chip', operadora='$operadora', iccid='$iccid', fornecedor_chip='$fornecedor', obs_bateria='$obs_bateria', id_empresa='$id_empresa' WHERE id_equip='$id_equip'");

$sql_device = mysqli_query($conn, "UPDATE tc_devices SET id_empresa='$id_empresa' WHERE id='$deviceid'");

header('Location: equipamentos.php?p=equipamentos');



?>