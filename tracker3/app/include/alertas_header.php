

 <?php

include_once("../conexao.php");

$deviceid = $_GET['id_device'];

$id_cliente = $_GET['id_cliente'];


	
$parametros = mysqli_query($conn,"SELECT * FROM tc_devices WHERE contact='$id_cliente' AND positionid > '1'");
	if(mysqli_num_rows($parametros) > 0){
while ($resp_param = mysqli_fetch_assoc($parametros)) {
$deviceid	 = 	$resp_param['id'];


	$cons_eventos = mysqli_query($conn,"SELECT * FROM tc_events WHERE deviceid='$deviceid' AND (type='ignitionOff' OR type='ignitionOn' OR type='alarm' OR type='geofenceExit' OR type='geofenceEnter' OR type='deviceOverspeed') ORDER BY id DESC LIMIT 10");
	if(mysqli_num_rows($cons_eventos) > 0){
while ($row_ev = mysqli_fetch_assoc($cons_eventos)) {
	$geofenceid = $row_ev['geofenceid'];
	$horario_alarme = $row_ev['eventtime'];
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
		$tipo = '<font color="#990000"> <b>ANCORA VIOLADA</b></font>';
		$icon = '<i class="fas fa-anchor fa-2x" style="color:#990000;"></i>';
	} else {
		$tipo = '</b>SAIDA CERCA '.$name_cerca.'</b>';
		$icon = '<i class="fas fa-draw-polygon fa-2x"></i>';
	}
	
		$notific = $tipo;
		$img = $icon;
	}}}
	if($alarme == null && $type == 'geofenceEnter'){
		$notific = '</b>ENTRADA CERCA '.$name_cerca.'</b>';
		$img = '<i class="fas fa-draw-polygon fa-2x"></i>';
	}
	
	
	$datea = new DateTime($horario_alarme);
	$datea->sub(new DateInterval('PT3H00S'));
	$devicetime1 = $datea->format('H:i:s') . "\n";
	
	$cons_veiculos = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE deviceid='$deviceid'");
		if(mysqli_num_rows($cons_veiculos) > 0){
			while ($row_veic = mysqli_fetch_assoc($cons_veiculos)) {
				$placa = $row_veic['placa'];
				$modelo_veiculo = $row_veic['modelo_veiculo'];
				$marca_veiculo = $row_veic['marca_veiculo'];
	}}
				
				?>

				
				<li>
					<div class="row">
                    <div class="col-xl-2">
						<span class=" mr-2">
							<span class="profile-image"><?php echo $img?></span>
						</span>
					</div>
					<div class="col-xl-7">
							<span style="font-size:16px"><?php echo $notific?></span><br>
							<span ><?php echo $placa?></span><br>
							<span><?php echo $marca_veiculo;?>/<?php echo $modelo_veiculo;?></span><br>
							
					</div>
					<div class="col-xl-3">
							
							<span style="font-size:10px"><?php echo $devicetime1?></span>
					</div>
				</div>
				</li>
				
				
				
	<?php 	
	}}}}?>
	





