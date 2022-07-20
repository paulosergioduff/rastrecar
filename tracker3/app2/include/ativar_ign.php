<?php

include('../conexao.php');

$alerta_ignicao = $_REQUEST['alerta_ignicao'];
$deviceid = $_REQUEST['deviceid'];

if($alerta_ignicao == 'SIM'){
	$alerta_ign = 'SIM';
}
if($alerta_ignicao != 'SIM'){
	$alerta_ign = 'NAO';
}

$sql = mysqli_query($conn,"UPDATE veiculos_clientes SET alerta_ign='$alerta_ign' WHERE deviceid='$deviceid'");
	
	
?>


