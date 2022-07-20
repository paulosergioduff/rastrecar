<?php


require("../conexao.php");

$deviceid = $_REQUEST['deviceid'];




$result_markers = "SELECT * FROM tc_positions WHERE deviceid='$deviceid' ORDER BY id DESC LIMIT 5";
$resultado_markers = mysqli_query($conn, $result_markers);

if(mysqli_num_rows($resultado_markers) > 0){
while ($resp_posicao = mysqli_fetch_assoc($resultado_markers)) {
	$devicetime = $resp_posicao['servertime'];
	$devicetime = date('Y-m-d H:i:s', strtotime('-3 hour', strtotime($devicetime)));
	$deviceid = $resp_posicao['deviceid'];
	$latitude = $resp_posicao['latitude'];
	$longitude = $resp_posicao['longitude'];
	$address = $resp_posicao['address'];
	$course = $resp_posicao['course'];
	$speed = $resp_posicao['speed'];
	$speed = $speed * 1.609;
	$speed = round($speed, 2);
	//$address = utf8_encode($address);
	$address1 = explode(',', $address);
	$result = count($address1);
	$id_position = $resp_posicao['id'];
					
	$estado_n = $result -1;
	$estado = $address1[$estado_n];
	$rua = $address1[0];
	$cidade_n = $result -4;
	$cidade = $address1[$cidade_n];
	
	$attributes = $resp_posicao['attributes'];
	$obj = json_decode($attributes);
	$alarm = $obj->{'alarm'};
	$batteryLevel = $obj->{'batteryLevel'};
	$power = $obj->{'power'};
	$sat = $obj->{'sat'};
	$blocked = $obj->{'blocked'};
	$totalDistance = $obj->{'totalDistance'};
	$gsm = $obj->{'rssi'};
	$battery = $obj->{'battery'};
	$hours = $obj->{'hours'};
	$status = $obj->{'status'};
	$odometer = $obj->{'odometer'};
	$adb1 = $obj->{'adb1'};
	

	
	$ignicao = $obj->{'ignition'};
		if (is_bool($ignicao)) $ignicao ? $ignicao = "true" : $ignicao = "false";
		else if ($ignicao !== null) $ignicao = (string)$ignicao;
	
	
	$cons_veiculo = mysqli_query($conn,"SELECT * FROM tc_devices WHERE id='$deviceid' ");
		if(mysqli_num_rows($cons_veiculo) > 0){
	while ($resp_veiculo = mysqli_fetch_assoc($cons_veiculo)) {
	$lastupdate = 	$resp_veiculo['lastupdate'];
	$lastupdate = date('Y-m-d H:i:s', strtotime('-3 hour', strtotime($lastupdate)));
		}}
	
		$cons_veiculo1 = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE deviceid='$deviceid' ");
		if(mysqli_num_rows($cons_veiculo1) > 0){
	while ($resp_veiculo1 = mysqli_fetch_assoc($cons_veiculo1)) {
	$odometro = 	$resp_veiculo1['odometro'];
		}}
	
	
	
		?>
		<br>
		<span>conexao_gps: <?php echo $devicetime?></span><br>
		<span>conexao_server: <?php echo $lastupdate?></span><br>
		<span>latitude: <?php echo $latitude?></span><br>
		<span>longitude: <?php echo $longitude?></span><br>
		<span>ignicao: <?php echo $ignicao?></span><br>
		<span>address: <?php echo $address?></span><br>
		<span>course: <?php echo $course?></span><br>
		<span>speed: <?php echo $speed?></span><br>
		<span>alarm: <?php echo $alarm?></span><br>
		<span>gsm: <?php echo $gsm?></span><br>
		<span>batteryLevel: <?php echo $batteryLevel?></span><br>
		<span>power: <?php echo $power?></span><br>
		<span>blocked: <?php echo $blocked?></span><br>
		<span>battery: <?php echo $bateria?></span><br>
		<span>sat: <?php echo $sat?></span><br>
		<span>totalDistance: <?php echo $totalDistance?></span><br>
		<span>hours: <?php echo $hours?></span><br>
		<span>odometer: <?php echo $odometer?></span><br>
		<span>virtual odometer: <?php echo $odometro?></span><br>
		<span>deviceid: <?php echo $deviceid?></span><br>
		<span>=========================</span><br><br>
		



		<?php

				
	
			
			}
		}


