<?php
$servidor = "localhost";
$usuario = "root";
$senha = "M196619m210300";
$dbname = "traccar";

//Criar a conexao
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
$con = mysqli_connect($servidor, $usuario, $senha, $dbname);

 header('Content-Type: application/json');


$deviceid = $_GET['id_device'];


// Select all the rows in the markers table
$result_markers = "SELECT * FROM tc_devices WHERE id='$deviceid'";
$resultado_markers = mysqli_query($conn, $result_markers);

// Iterate through the rows, printing XML nodes for each
while ($row_markers = mysqli_fetch_assoc($resultado_markers)){
	
	$id_device = $row_markers['id'];
	$position_id = $row_markers['positionid'];
	$name = $row_markers['name'];
	$category = $row_markers['category'];
	
	$cons_posicao = mysqli_query($conn,"SELECT * FROM tc_positions WHERE id='$position_id'");
	if(mysqli_num_rows($cons_posicao) > 0){
while ($resp_posicao = mysqli_fetch_assoc($cons_posicao)) {
	
	$latitude = $resp_posicao['latitude'];
	$longitude = $resp_posicao['longitude'];
	$address = $resp_posicao['address'];
	$speed = $resp_posicao['speed'];
	$speed = $speed * 1.609;
	$speed = round($speed, 2);
	$address = utf8_encode($address);

	
	$attributes = $resp_posicao['attributes'];
	$obj = json_decode($attributes);
	$ignicao = $obj->{'ignition'};
if (is_bool($ignicao)) $ignicao ? $ignicao = "true" : $ignicao = "false";
else if ($ignicao !== null) $ignicao = (string)$ignicao;


	$cons_veiculo = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE deviceid='$deviceid' ");
					if(mysqli_num_rows($cons_veiculo) > 0){
				while ($resp_veiculo = mysqli_fetch_assoc($cons_veiculo)) {
				$placa = 	$resp_veiculo['placa'];
				$bloqueio = 	$resp_veiculo['bloqueio'];


if($ignicao == 'true' && $speed >= 6 && $bloqueio == 'NAO'){
	$ign = ''.$category.'_s.png';
} else if ($ignicao == 'true' && $speed <= 5 && $bloqueio == 'NAO'){
	$ign = ''.$category.'_w.png';	
} else if ($ignicao == 'true' && $speed <= 5 && $bloqueio == 'SIM'){
	$ign = ''.$category.'_d.png';	
} else if ($ignicao == 'false' && $speed <= 5 && $bloqueio == 'SIM'){
	$ign = ''.$category.'_d.png';	
} else if ($ignicao == '' && $speed <= 5 && $bloqueio == 'NAO'){
	$ign = ''.$category.'.png';	
} else if ($ignicao == '' && $speed <= 5 && $bloqueio == 'SIM'){
	$ign = ''.$category.'_d.png';	
} else {
	$ign = ''.$category.'.png';	
}


	

	if($ignicao == 'true' && $speed >= 6 && $bloqueio == 'NAO'){
	$ign = ''.$category.'_s.png';
	$ign2 = 'Ligada';
} else if ($ignicao == 'true' && $speed <= 5 && $bloqueio == 'NAO'){
	$ign = ''.$category.'_w.png';	
	$ign2 = 'Ligada';
} else if ($ignicao == 'true' && $speed <= 5 && $bloqueio == 'SIM'){
	$ign = ''.$category.'_d.png';
$ign2 = 'Desligada';	
} else if ($ignicao == 'false' && $speed <= 5 && $bloqueio == 'SIM'){
	$ign = ''.$category.'_d.png';	
	$ign2 = 'Desligada';
} else {
	$ign = ''.$category.'.png';	
	$ign2 = 'Desligada';
}
	
	$dados = array('name' => $name, 'address' => $address, 'lat' => $resp_posicao['latitude'], 'lng' => $resp_posicao['longitude'], 'ign' => $ign, 'ignicao' => $ign2, 'speed'=> $speed);
	
	echo json_encode($dados);
}}}}}




