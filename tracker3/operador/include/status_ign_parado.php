<?php
include_once("../conexao.php");

	$id_empresa = $_REQUEST['customer'];

	$cont_veiculos = mysqli_query($conn,"SELECT * FROM tc_devices WHERE contact != 'ESTOQUE' AND id_cliente_pai='$id_empresa'");
		$cont_ligado = 0;
$cont_desligado = 0;
$cont_parado = 0;

		if(mysqli_num_rows($cont_veiculos) > 0){
while ($resp_device = mysqli_fetch_assoc($cont_veiculos)) {
	
	$id_device = $resp_device['id'];
	$id_position = $resp_device['positionid'];
	
	
	

	$cont_posicao = mysqli_query($conn,"SELECT * FROM tc_positions WHERE id='$id_position' ORDER BY id ASC");

		if(mysqli_num_rows($cont_posicao) > 0){
while ($resp_position = mysqli_fetch_assoc($cont_posicao)) {

	$speed = $resp_position['speed'];
	$attributes = $resp_position['attributes'];
	$obj = json_decode($attributes);
	$ignicao = $obj->{'ignition'};
if (is_bool($ignicao)) $ignicao ? $ignicao = "true" : $ignicao = "false";
else if ($ignicao !== null) $ignicao = (string)$ignicao;


if ($ignicao == 'true' && $speed <= 5){
	$cont_parado++;	
}


		}}}}
echo $cont_parado;		

		

		
		


?>