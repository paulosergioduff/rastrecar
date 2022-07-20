<?php


include_once("conexao.php");
/*

$cons_devices = mysqli_query($conn,"SELECT * FROM tc_devices WHERE contact != 'ESTOQUE' AND positionid > '1' ORDER BY id DESC");
if(mysqli_num_rows($cons_devices) > 0){
	while ($row_dev = mysqli_fetch_array($cons_devices)) {
		$deviceid = $row_dev['id'];
		$name = $row_dev['name'];
		$positionid = $row_dev['positionid'];
		
		$cons_veiculo = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE deviceid = '$deviceid'");
		if(mysqli_num_rows($cons_veiculo) > 0){
			while ($row_veiculo = mysqli_fetch_array($cons_veiculo)) {
				$positionid_veic = $row_veiculo['positionid'];
				$odometro = $row_veiculo['odometro'];

		}}
		
		if($positionid_veic < $positionid){
		
			$cons_position = mysqli_query($conn,"SELECT * FROM tc_positions WHERE id = '$positionid'");
			if(mysqli_num_rows($cons_position) > 0){
				while ($row_position = mysqli_fetch_array($cons_position)) {
					$attributes = $row_position['attributes'];
					$obj = json_decode($attributes);
					$totalDistance = $obj->{'totalDistance'};
			}}
			
			$cons_position2 = mysqli_query($conn,"SELECT * FROM tc_positions WHERE deviceid = '$deviceid' AND id < '$positionid' ORDER BY id DESC LIMIT 1");
			if(mysqli_num_rows($cons_position2) > 0){
				while ($row_position2 = mysqli_fetch_array($cons_position2)) {
					$positionid2 = $row_position2['id'];
					$attributes2 = $row_position2['attributes'];
					$obj2 = json_decode($attributes2);
					$totalDistance2 = $obj2->{'totalDistance'};
			}}

			$odometer = $totalDistance - $totalDistance2;
			$odometer = $odometer / 1000;
			$odometer = $odometro + $odometer;
			$odometer = round($odometer, 2);
			
			//echo $attributes2;
		
			$insere_pos = mysqli_query($conn, "UPDATE veiculos_clientes SET odometro = '$odometer', positionid = '$positionid' WHERE deviceid = '$deviceid'");
			//echo ''.$name.' - '.$positionid.' - '.$positionid_veic.' - Odometro: '.$odo.'<br>';
		}
 
		

}}

*/


























?>
<?php

#================== VOLTS EV02 =======================

$cons_veiculo = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE deviceid > '1' AND modelo_equip='EV02'");
	if(mysqli_num_rows($cons_veiculo) > 0){
		while ($resp_veiculo = mysqli_fetch_assoc($cons_veiculo)) {
		$deviceid1 = 	$resp_veiculo['deviceid'];
		$imei1 = 	$resp_veiculo['imei'];
		




//$imei = '359857080849581';


$arquivo = fopen ('/opt/traccar/logs/tracker-server.log', 'r');


while(!feof($arquivo)){

	$linha = fgets($arquivo, 1024);
	
	
	if (strpos($linha, 'id: '.$imei1) !== false) {
		$registros[] = $linha;	
		}

}

$num = count($registros);

fclose($arquivo);

$ultima_linha =  $registros[$num - 1];

$ultima_linha = explode("[", $ultima_linha);

$retorno_linha = $ultima_linha[1];

$ultima_linha = explode("]", $retorno_linha);

$chave = $ultima_linha[0];

$arquivo1 = fopen ('/opt/traccar/logs/tracker-server.log', 'r');
while(!feof($arquivo1)){

	$linha1 = fgets($arquivo1, 1024);
	
	
	if (strpos($linha1, $chave) !== false) {
		if (strpos($linha1, '78780a13') !== false) {
			$protocol = explode("HEX: ", $linha1);
			$protocol2 = $protocol[1];
			
			$volt =  substr($protocol2, 12, -15);
			$volt =  hexdec($volt).'<br>';
			$volts[] = $volt;	
		}
	}

}

$num1 = count($volts);

fclose($arquivo1);

$bateria_ext = $volts[$num1 - 1];
$bateria_ext = $bateria_ext * 1;
$bateria_ext = substr_replace($bateria_ext, '.', -2, 0);


$sql = mysqli_query($conn, "UPDATE veiculos_clientes SET volts='$bateria_ext' WHERE deviceid='$deviceid1'");


	}}

?>