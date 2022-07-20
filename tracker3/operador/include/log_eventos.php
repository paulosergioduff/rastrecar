<?php


require("../conexao.php");

$deviceid = $_REQUEST['deviceid'];




$result_markers = "SELECT * FROM tc_events WHERE deviceid='$deviceid' ORDER BY id DESC LIMIT 10";
$resultado_markers = mysqli_query($conn, $result_markers);

if(mysqli_num_rows($resultado_markers) > 0){
while ($resp_posicao = mysqli_fetch_assoc($resultado_markers)) {
	$devicetime = $resp_posicao['servertime'];
	$devicetime = date('Y-m-d H:i:s', strtotime('-3 hour', strtotime($devicetime)));
	$type = $resp_posicao['type'];
	$attributes = $resp_posicao['attributes'];

	
	
	$cons_veiculo = mysqli_query($conn,"SELECT * FROM tc_devices WHERE id='$deviceid' ");
		if(mysqli_num_rows($cons_veiculo) > 0){
	while ($resp_veiculo = mysqli_fetch_assoc($cons_veiculo)) {
	$lastupdate = 	$resp_veiculo['lastupdate'];
	$lastupdate = date('Y-m-d H:i:s', strtotime('-3 hour', strtotime($lastupdate)));
		}}
	
	
	
		?>
		<br>
		<span>hour: <?php echo $devicetime?></span><br>
		<span>type: <?php echo $type?></span><br>
		<span>alarm: <?php echo $attributes?></span><br>

		<span>deviceid: <?php echo $deviceid?></span><br>
		<span>=========================</span><br><br>
		



		<?php

				
	
			
			}
		}


