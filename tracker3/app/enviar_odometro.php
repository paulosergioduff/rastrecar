  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('conexao.php');

$date = date('Y-m-d');
$hora = date('H:i:s');
$odometro = 	$_POST['novo_odomento'];
$odometro = str_replace(".","","$odometro");
$odometro = str_replace(",",".","$odometro");
$media_consumo = 	$_POST['media_consumo'];
$deviceid = 	$_POST['deviceid_5'];
$id_cliente_login = 	$_POST['id_cliente_5'];


$insere_pos = mysqli_query($conn, "UPDATE veiculos_clientes SET odometro = '$odometro', media_consumo = '$media_consumo' WHERE deviceid = '$deviceid'");

header('Location: grid_device.php?id='.$id_cliente_login.'&deviceid='.$deviceid.'&app=on');





?>
