  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('conexao.php');


$data_delete = date('Y-m-d');
$deviceid = $_GET['deviceid'];
$id_cliente = $_GET['id_cliente'];
$id_veiculo = $_GET['id_veiculo'];

$cons_nivel = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='1361'");
	if(mysqli_num_rows($cons_nivel) > 0){
while ($resp_nivel = mysqli_fetch_assoc($cons_nivel)) {
$ip_traccar = 	$resp_nivel['ip_traccar'];
$login_traccar = 	$resp_nivel['login_traccar'];
$senha_traccar = 	$resp_nivel['senha_traccar'];
$token_traccar = ''.$login_traccar.':'.$senha_traccar.'';
$token_traccar = base64_encode($token_traccar);
}}

$cons_veic = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE id_veiculo='$id_veiculo'");
	if(mysqli_num_rows($cons_veic) > 0){
while ($resp_veic = mysqli_fetch_assoc($cons_veic)) {
$imei = 	$resp_veic['imei'];
$chip = 	$resp_veic['chip'];
$iccid = 	$resp_veic['iccid'];
$modelo_equip = 	$resp_veic['modelo_equip'];
$operadora_veic = 	$resp_veic['operadora'];
$fornecedor_chip_veic = 	$resp_veic['fornecedor_chip'];
	}}


$sql222 = mysqli_query($conn,"INSERT IGNORE INTO estoque_rastreadores (data_entrada, modelo_equip, imei, chip, operadora, iccid, id_cliente, id_empresa, id_parceiro, status, deviceid, fornecedor_chip) VALUES ('$data_delete', '$modelo_equip', '$imei', '$chip', '$operadora', '$iccid', '0', '1361', '0', 'ESTOQUE', '0', '$fornecedor_chip_veic')");


$json = json_encode($object);
$url = 'http://5.189.185.179:8082/api/devices/'.$deviceid.'';
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



$sql = mysqli_query($conn, "DELETE FROM veiculos_clientes WHERE id_veiculo='$id_veiculo'");

$base64 = 'id_cliente:'.$id_cliente.'';
$base64 = base64_encode($base64);

header('Location: cad_cliente.php?c='.$base64.'');












?>
