<?php

include('../conexao.php');

$bateria_removida = $_REQUEST['bateria_removida'];
$deviceid = $_REQUEST['deviceid'];

if($bateria_removida == 'SIM'){
	$alerta_bateria = 'SIM';
}
if($bateria_removida != 'SIM'){
	$alerta_bateria = 'NAO';
}

$sql = mysqli_query($conn,"UPDATE veiculos_clientes SET alerta_bateria='$alerta_bateria', alerta_bateria_baixa='$alerta_bateria' WHERE deviceid='$deviceid'");
	
	
?>


