<?php

include('../conexao.php');

$alerta_velocidade = $_REQUEST['alerta_velocidade'];
$deviceid = $_REQUEST['deviceid'];
$limite_velocidade = $_REQUEST['limite_velocidade'];



$sql = mysqli_query($conn,"UPDATE veiculos_clientes SET alerta_velocidade='SIM', limite_velocidade='$limite_velocidade' WHERE deviceid='$deviceid'");
	
	
?>


