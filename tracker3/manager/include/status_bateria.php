<?php
include_once("../conexao.php");


$sql_vencidas = mysqli_query($conn, "SELECT * FROM tc_devices WHERE positionid >='1' ORDER BY id ASC");			
if(mysqli_num_rows($sql_vencidas) > 0){
	while($row_vencidas = mysqli_fetch_assoc($sql_vencidas)){
	$deviceid = $row_vencidas['id'];
	
	$sql_event = mysqli_query($conn, "SELECT * FROM tc_events WHERE deviceid ='$deviceid' ORDER BY id DESC LIMIT 1");			
		if(mysqli_num_rows($sql_event) > 0){
			while($row_event = mysqli_fetch_assoc($sql_event)){
			$type = $row_event['type'];
			$eventos = $row_event['attributes'];
			$eventos1 = json_decode($eventos);
			$alarme = $eventos1->{'alarm'};
			
		}}
	
	if($alarme == 'powerCut'){
		$registros[] = $alarme;
	}
}}

echo count($registros);
		
		


?>