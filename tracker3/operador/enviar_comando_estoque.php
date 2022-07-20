  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('conexao.php');

$date = date('Y-m-d');
$hora = date('H:i:s');
$sms_comando = $_POST['sms_comando'];
$ip = $_POST['ip'];
$porta = $_POST['porta'];
$comando = $_POST['comando'];
$deviceid = $_POST['deviceid1'];
$chip = $_POST['chip'];
$id_equip = $_POST['id_equip'];

echo $sms_comando;


$insere_log = mysqli_query($conn,"INSERT INTO log_sms (data_envio, hora_envio, user_envio, tipo, sms, destino, tipo_envio, id_cliente, comando) VALUES ('$date', '$hora', '$user_nome', 'SMS', '$sms_comando', '$chip', 'Comando Equip.', '$deviceid', '$comando')");


$base64 = 'id_equip:'.$id_equip.'';
$base64 = base64_encode($base64);

header('Location: editar_equipamento.php?c='.$base64.'');

?>
