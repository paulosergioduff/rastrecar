  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('conexao.php');

$date = date('Y-m-d');
$hora = date('H:i:s');
$odometro = 	$_POST['vlr_odometro'];
$odometro = str_replace(".","","$odometro");
$odometro = str_replace(",",".","$odometro");
$media_consumo = 	$_POST['media_consumo'];
$deviceid = 	$_POST['deviceid20'];




$insere_pos = mysqli_query($conn, "UPDATE veiculos_clientes SET odometro = '$odometro', media_consumo = '$media_consumo' WHERE deviceid = '$deviceid'");

$base64 = 'deviceid:'.$deviceid;
$base64 = base64_encode($base64);

header('Location: grid_device.php?c='.$base64.'');





?>
