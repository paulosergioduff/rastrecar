  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('conexao.php');

$date = date('Y-m-d');
$hora = date('H:i:s');
$user = $_POST['user_nome'];


$id_cliente_login = $_POST['id'];
$deviceid = $_POST['deviceid'];

$limite_velocidade = $_POST['limite_velocidade'];
$alerta_velocidade = $_POST['alerta_velocidade'];
$alerta_ign = $_POST['alerta_ignicao'];
$alerta_bateria = $_POST['bateria_removida'];

$velocidade = $limite_velocidade / 1.609;
$velocidade = round($velocidade, 2);
$velocidade = '{"speedLimit":'.$velocidade.'}';


if($alerta_velocidade == ''){
	$alerta_velocidade1 = 'NAO';
} else {
	$alerta_velocidade1 = $alerta_velocidade;
	$update_device = mysqli_query($conn, "UPDATE tc_devices SET attributes = '$velocidade' WHERE id='$deviceid'");
}

if($alerta_ign == ''){
	$alerta_ign1 = 'NAO';
	
} else {
	$alerta_ign1 = $alerta_ign;
}



if($alerta_bateria == ''){
	$alerta_bateria1 = 'NAO';
} else {
	$alerta_bateria1 = $alerta_bateria;
}



$update_veiculo = mysqli_query($conn, "UPDATE veiculos_clientes SET limite_velocidade='$limite_velocidade', alerta_velocidade='$alerta_velocidade1', alerta_ign='$alerta_ign1', alerta_bateria='$alerta_bateria1' WHERE deviceid='$deviceid'");

header ('Location: grid_device.php?id='.$id_cliente_login.'&deviceid='.$deviceid.'&app=on')


?>
