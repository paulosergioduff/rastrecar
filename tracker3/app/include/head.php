<?php
	
$cons_user1 = mysqli_query($conn,"SELECT * FROM usuarios_push WHERE id_push='$id_push' ");
	if(mysqli_num_rows($cons_user1) > 0){
		while ($resp_user1 = mysqli_fetch_assoc($cons_user1)) {
		$tipo = 	$resp_user1['tipo'];
		$id_cliente_alert = $resp_user1['id_cliente'];

	}}	

?>
 <input type="hidden" id="id_cliente_alert" value="<?php echo $id_cliente_alert?>">
<header class="page-header" role="banner">
	<!-- we need this logo when user switches to nav-function-top -->
 
	<!-- DOC: nav menu layout change shortcut -->
	<div class="hidden-md-down dropdown-icon-menu position-relative">
		<a href="#" class="header-btn btn js-waves-off"  data-action="toggle" data-class="nav-function-hidden" title="Hide Navigation">
			<i class="ni ni-menu"></i>
		</a>
		
	</div>
	<!-- DOC: mobile button appears during mobile width -->
	<div class="hidden-lg-up">
		<a href="#" class="header-btn btn press-scale-down"  data-action="toggle" data-class="mobile-nav-on">
			<i class="ni ni-menu"></i>
		</a>
	</div>
  
	<div class="ml-auto d-flex">
		
	   
	   <!-- app notification -->
	 
	  
	   
	
	   
	   
	   
	   
	   
		<!-- app notification -->
		<div>
			<a href="#" class="header-icon" data-toggle="dropdown">
				<i class="fal fa-bell"></i>
				
			</a>
			<div class="dropdown-menu dropdown-menu-animated dropdown-xl">
				<div class="dropdown-header bg-trans-gradient d-flex justify-content-center align-items-center rounded-top mb-2">
					<h4 class="m-0 text-center color-white">
						Alertas Emitidos - Veículos
						<small class="mb-0 opacity-80 bg-fadedz">Últimos 10 registros</small>
					</h4>
				</div>
			   
				<div class="tab-content tab-notification" >
					
					
					
					<div style="height:500px">
						<div class="custom-scroll h-100 shadow-2">
							<ul class="notification" id="avisos">
								
						<?php	  	
$parametros = mysqli_query($conn,"SELECT * FROM tc_devices WHERE contact='$id_cliente_alert' AND positionid > '1'");
	if(mysqli_num_rows($parametros) > 0){
while ($resp_param = mysqli_fetch_assoc($parametros)) {
$deviceid	 = 	$resp_param['id'];


	$cons_eventos = mysqli_query($conn,"SELECT * FROM tc_events WHERE deviceid='$deviceid' AND (type='ignitionOff' OR type='ignitionOn' OR type='alarm' OR type='geofenceExit' OR type='geofenceEnter' OR type='deviceOverspeed') ORDER BY id DESC LIMIT 10");
	if(mysqli_num_rows($cons_eventos) > 0){
while ($row_ev = mysqli_fetch_assoc($cons_eventos)) {
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
		$notific = '<h3><span class="badge" style="background-color:#CD5C5C; color:#FFF"><i class="fas fa-car-battery"></i> FALHA BATERIA VEICULO</span></h3>';
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
                  
					<div class="col-xl-7">
							<span style="font-size:16px"><?php echo $notific?></span>
							<span ><i class="fas fa-car"></i> <?php echo $placa?> - <?php echo $marca_veiculo;?>/<?php echo $modelo_veiculo;?></span><br>
							<span><i class="far fa-clock"></i> <?php echo $horario_alarme?></span><br>
							
					</div>
					
				</div>
				</li>
				
				
				
	<?php 	
	}}}}?>
								
							   
							   
								
							   
							</ul>
						</div>
					</div>
				</div>
				
			</div>
		</div>
		<!-- app user menu -->
		
		
		
		
		
	</div>
</header>
					

					
















