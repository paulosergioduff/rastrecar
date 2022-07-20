  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('conexao.php');



$imei = $_GET['imei'];

$id_cliente_login = $_GET['id'];
$id_equip = $_GET['id_equip'];


$cons_nivel = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='1361'");
	if(mysqli_num_rows($cons_nivel) > 0){
while ($resp_nivel = mysqli_fetch_assoc($cons_nivel)) {
$login_traccar = 	$resp_nivel['login_traccar'];
$senha_traccar = 	$resp_nivel['senha_traccar'];
$token_traccar = ''.$login_traccar.':'.$senha_traccar.'';
$token_traccar = base64_encode($token_traccar);
}}



$cons_device = mysqli_query($conn,"SELECT * FROM tc_devices WHERE uniqueid='$imei'");
	if(mysqli_num_rows($cons_device) > 0){
		while ($resp_device = mysqli_fetch_assoc($cons_device)) {
$deviceid = 	$resp_device['id'];

}}



$json = json_encode($object);

$url = 'http://144.91.86.255:8082/api/devices/'.$deviceid.'';

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
echo $output;

$sql = mysqli_query($conn, "DELETE FROM estoque_rastreadores WHERE id_equip='$id_equip'");

header('Location: equipamentos.php?p=equipamentos');












?>
