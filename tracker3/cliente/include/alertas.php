<?php

include_once("../conexao.php");

$deviceid = $_GET['deviceid'];


$cons_eventos = mysqli_query($conn,"SELECT * FROM tc_events WHERE deviceid='$deviceid' AND (type='ignitionOff' OR type='ignitionOn' OR type='alarm' OR type='geofenceExit' OR type='geofenceEnter' OR type='deviceOverspeed') ORDER BY id DESC LIMIT 20");
	if(mysqli_num_rows($cons_eventos) > 0){
	while ($row_ev = mysqli_fetch_assoc($cons_eventos)) {
	$posicao = $row_ev['positionid'];
	$geofenceid = $row_ev['geofenceid'];
	$horario_alarme = $row_ev['eventtime'];
	$horario_alarme = date('d/m/Y H:i:s', strtotime('-3 hour', strtotime($horario_alarme)));
	
	$eventos = $row_ev['attributes'];
	$eventos1 = json_decode($eventos);
	$alarme = $eventos1->{'alarm'};
	$type = $row_ev['type'];
	$speed = $eventos1->{'speed'};
	$speed = $speed + 1.609;
	$speed = round($speed, 2);
		
		
	if($alarme == null && $type == 'deviceOnline'){
		$notific = '<h3><span class="badge" style="background-color:#009900; color:#FFF"><i class="fas fa-wifi"></i> DISPOSITIVO CONECTADO</span></h3>';	
	} 
	if($alarme == null && $type == 'deviceOffline'){
		$notific = '<h3><span class="badge" style="background-color:#CD5C5C; color:#FFF"><i class="fas fa-wifi"></i> DISPOSITIVO OFFLINE</span></h3>';	
	} 
	if($alarme == null && $type == 'deviceOverspeed'){
		$notific = '<h3><span class="badge" style="background-color:#009900; color:#FFF"><i class="fas fa-tachometer-alt"></i> EXC. VELOCIDADE</span></h3>';	
	} 
	if($type == 'ignitionOn'){
		$notific = '<h3><span class="badge" style="background-color:#009900; color:#FFF"><i class="fas fa-key"></i> IGNIÇÃO LIGADA</span></h3>';
	} 
	if($type == 'ignitionOff'){
		$notific = '<h3><span class="badge" style="background-color:#000; color:#FFF"><i class="fas fa-key"></i> IGNIÇÃO DESLIGADA</span></h3>';
	}
	if($alarme == 'sos' && $type == 'alarm'){
		$notific = '<h3><span class="badge" style="background-color:#CD5C5C; color:#FFF"><i class="fas fa-bell"></i> PANICO ACIONADO</span></h3>';
		
	}
	if($alarme == 'powerCut' && $type == 'alarm'){
		$notific = '<h3><span class="badge" style="background-color:#CD5C5C; color:#FFF"><i class="fas fa-car-battery"></i> BATERIA REMOVIDA</span></h3>';
	}
	if($alarme == 'shock' && $type == 'alarm'){
		$notific = '<h3><span class="badge" style="background-color:#DAA520; color:#FFF"><i class="far fa-bell"></i>  ALARME MOVIMENTO</span></h3>';
	}
	if($alarme == 'door' && $type == 'alarm'){
		$notific = '<h3><span class="badge" style="background-color:#DAA520; color:#FFF"><i class="far fa-bell"></i>  ALARME PORTAS</span></h3>';
	}
	if($alarme == null && $type == 'geofenceExit'){
		$cons_fence = mysqli_query($conn,"SELECT * FROM tc_geofences WHERE id='$geofenceid'");
			if(mysqli_num_rows($cons_fence) > 0){
			while ($row_fence = mysqli_fetch_assoc($cons_fence)) {
			$name_cerca = $row_fence['name'];
			$description = $row_fence['description'];
	if($description == 'ANCORA'){
		$tipo = '<h3><span class="badge" style="background-color:#DAA520; color:#FFF"><i class="fas fa-anchor"></i> ANCORA VIOLADA</span></h3>';
	} else {
		$tipo = '<i class="far fa-vector-square"></i> SAIDA CERCA '.$name_cerca.'';
		$tipo = '<h3><span class="badge" style="background-color:#000; color:#FFF"><i class="far fa-vector-square"></i> SAIDA CERCA '.$name_cerca.'</span></h3>';
	}
	
		$notific = $tipo;
	}}}
	if($alarme == null && $type == 'geofenceEnter'){
		$notific = '<h3><span class="badge" style="background-color:#000; color:#FFF"><i class="far fa-vector-square"></i> ENMTRADA CERCA '.$name_cerca.'</span></h3>';
	}
	
	

	
	
	$cons_eventos_p = mysqli_query($conn,"SELECT * FROM tc_positions WHERE id='$posicao'");
	if(mysqli_num_rows($cons_eventos_p) > 0){
while ($row_evp = mysqli_fetch_assoc($cons_eventos_p)) {
	$end_evento = 	$row_evp['address'];
	$latit = 	$row_evp['latitude'];
	$longit = 	$row_evp['longitude'];
}}
	
	


	
				
		?>
		<div class="card mb-5" style="border:#ccc 1px solid;">
			<div class="card-body p-3">
				<div class="row">
					<div class="col-md-12">
					<?php echo $notific?>
					</div>
				</div><br>
				<div class="row">
					<div class="col-md-12">
					<i class="fas fa-map-marker-alt"></i> <?php echo $end_evento?>
					</div>
				</div><br>
				<div class="row">
					<div class="col-md-8">
					<i class="far fa-clock"></i> <?php echo $horario_alarme?>
					</div>
					<div class="col-md-4 text-right">
					<a href="https://www.google.com/maps?layer=c&cbll=<?php echo $latit?>,<?php echo $longit?>" target="_blank"><button type="button" class="btn btn-dark btn-sm btn-icon" ><i class="fas fa-street-view"></i></button></a>	
					</div>
				</div>
			</div>
		</div>
					
	<?php 	}}?>

