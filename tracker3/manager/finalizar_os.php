<?php
include('conexao.php');


$date = date('Y-m-d');
$date_hour = date('Y-m-d H:i');
$parceiro	 = 	$_POST['parceiro'];
$local_equipamento	 = 	$_POST['local_equipamento'];
$imei = 	$_POST['imei'];
$chip = 	$_POST['chip'];
$bloqueio	 = 	$_POST['bloqueio'];
$tipo_bloqueio	 = 	$_POST['tipo_bloqueio'];
$comissao_tecnico	 = 	$_POST['comissao_tecnico'];
$comissao_tecnico = str_replace(".","","$comissao_tecnico");
$comissao_tecnico = str_replace(",",".","$comissao_tecnico");
$id_cliente = 	$_POST['id_cliente'];
$id_os = 	$_POST['id_os'];
$id_veiculo = 	$_POST['id_veiculo'];
$id_empresa = 	$_POST['id_empresa'];
$status_os = 2;
$modelo_equip = $_POST['modelo_equip'];

$sql_os = mysqli_query($conn, "UPDATE ordem_servico SET imei='$imei', chip='$chip', bloqueio_inst='$bloqueio', comissao_tecnico='$comissao_tecnico', local_equipamento='$local_equipamento', status='$status_os', data_encerramento='$date', parceiro='$parceiro', modelo_equip='$modelo_equip', tipo_bloqueio='$tipo_bloqueio' WHERE id_os='$id_os'");

$sql_veiculo = mysqli_query($conn,"UPDATE veiculos_clientes SET imei='$imei', chip='$chip',  bloqueio_inst='$bloqueio', modelo_equip='$modelo_equip', local_equipamento='$local_equipamento', tipo_bloqueio='$tipo_bloqueio', encerramento_os='$date' WHERE id_veiculo='$id_veiculo'");




$base64 = 'id_cliente:'.$id_cliente.'';
$base64 = base64_encode($base64);
header('Location: cad_cliente.php?c='.$base64.'&os=1');










?>