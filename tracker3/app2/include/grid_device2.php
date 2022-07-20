

 <?php

$servidor = "localhost";
$usuario = "root";
$senha = "TR4vcijU6T9Keaw";
$dbname = "traccar";

//Criar a conexao
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
$con = mysqli_connect($servidor, $usuario, $senha, $dbname);

		$id_device = $_GET['id_device'];			
			$result_usuario = "SELECT * FROM tc_devices WHERE id='$id_device' ORDER BY positionid DESC";
					$resultado_usuario = mysqli_query($conn, $result_usuario);


					//Verificar se encontrou resultado na tabela "usuarios"
					if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
					?>

				  <?php
			while($row_usuario = mysqli_fetch_assoc($resultado_usuario)){
				$name = $row_usuario['name'];
				$positionid = $row_usuario['positionid'];
				$category = 	$row_usuario['category'];
				$lastupdate = 	$row_usuario['lastupdate'];
				$lastupdate1 = date('d/m/Y H:i:s', strtotime('-3 hour', strtotime($lastupdate)));
				
				if($lastupdate < $data_agora1){
					$conect = '<h3><span class="badge" style="background-color:#CD5C5C;color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Dispositivo Offline"><i class="fas fa-wifi"></i></span></h3>';
					$status_conexao = 'off';
				} else {
					$conect = '<h3><span class="badge" style="background-color:#009900;color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Dispositivo Online"><i class="fas fa-wifi"></i></span></h3>';
					$status_conexao = 'on';
				}
				
				
				$cons_cliente = mysqli_query($conn,"SELECT * FROM tc_positions WHERE id='$positionid' ORDER BY id DESC");
					if(mysqli_num_rows($cons_cliente) > 0){
						$address = 'Endereço Não Encontrado';
						$devicetime1 = $lastupdate1;
						$ignicao = 'false';
					}
					if(mysqli_num_rows($cons_cliente) > 0){
				while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
				$address = 	$resp_cliente['address'];
				$devicetime = 	$resp_cliente['fixtime'];
				$devicetime1 = date('d/m/Y H:i:s', strtotime('-3 hour', strtotime($devicetime)));
				$speed = 	$resp_cliente['speed'];
				$speed = $speed * 1.609;
				$speed = round($speed, 2);
				$protocol = 	$resp_cliente['protocol'];
				$attributes = $resp_cliente['attributes'];
				$obj = json_decode($attributes);
				$ignicao = $obj->{'ignition'};
				}}
				
				if (is_bool($ignicao)) $ignicao ? $ignicao = "true" : $ignicao = "false";
				else if ($ignicao !== null) $ignicao = (string)$ignicao;
				

				if($ignicao == 'true' && $speed >= 6){
					$ign = 'LIGADO';
					$movi = '';
					$apeed1 = $speed;
					$cor_ign = 'success';
					$cor_ign2 = '#E7EEE3';
				} else if ($ignicao == 'true' && $speed <= 5){
					$ign = 'LIGADO';
					$movi = 'PARADO';
					$apeed1 = $speed;
					$cor_ign = 'warning';
					$cor_ign2 = '#FBF0E1';
				} else {
					$ign = 'DESLIGADO';
					$movi = '';
					$apeed1 = '0.00';
					$cor_ign = 'dark';
					$cor_ign2 = '#EBEBEB';
				}
				
				
				
					$data_pos = date('Y-m-d H:i:s');
				$data_pos_inicial = date('Y-m-d 03:00:00');
				$data_pos_final = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_pos)));
				$position_inicial = mysqli_query($conn,"SELECT * FROM tc_positions WHERE deviceid='$id_device' AND servertime >= '$data_pos_inicial' ORDER BY id ASC LIMIT 1");
					if(mysqli_num_rows($position_inicial) <= 0){
						$km_inicial = '0';
					}
					if(mysqli_num_rows($position_inicial) > 0){
						while ($resp_posi1 = mysqli_fetch_assoc($position_inicial)) {
						$km_inicial = $resp_posi1['attributes'];
						$obj_km1 = json_decode($km_inicial);
						$km_inicial = $obj_km1->{'totalDistance'};
					}}
					
				$position_final = mysqli_query($conn,"SELECT * FROM tc_positions WHERE deviceid='$id_device' AND servertime <= '$data_pos_final' ORDER BY id DESC LIMIT 1");
					if(mysqli_num_rows($position_final) <= 0){
						$km_final = '0';
					}
					if(mysqli_num_rows($position_final) > 0){
						while ($resp_posi2 = mysqli_fetch_assoc($position_final)) {
						$km_final = $resp_posi2['attributes'];
						$obj_km2 = json_decode($km_final);
						$km_final = $obj_km2->{'totalDistance'};
					}}
					
					$totalkm = $km_final - $km_inicial;
					$totalkm = $totalkm / 1000;
					$totalkm = round($totalkm, 2);
					$totalkm = number_format($totalkm, 2, ",", ".");
				
					$cons_veiculo = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE deviceid='$id_device' ");
					if(mysqli_num_rows($cons_veiculo) > 0){
						while ($resp_veiculo = mysqli_fetch_assoc($cons_veiculo)) {
						$placa = 	$resp_veiculo['placa'];
						$bloqueio = 	$resp_veiculo['bloqueio'];
						$odometro = 	$resp_veiculo['odometro'];
						$ancora = 	$resp_veiculo['ancora'];
						$marca_veiculo = 	$resp_veiculo['marca_veiculo'];
						$modelo_veiculo = 	$resp_veiculo['modelo_veiculo'];
						$id_cliente = 	$resp_veiculo['id_cliente'];
						$veiculo = $placa.' - '.$marca_veiculo.'/'.$modelo_veiculo;
						$veic_volts = 	$resp_veiculo['volts'];
						$veic_satelite = 	$resp_veiculo['satelite'];
						$veic_gsm = 	$resp_veiculo['gsm'];
						$veic_bateria_interna = 	$resp_veiculo['bateria_interna'];
						$id_cliente = 	$resp_veiculo['id_cliente'];
						}}
						
					if($bloqueio == 'SIM'){
						$status_bloqueio = 'BLOQUEADO';
						$cor_block = 'bg-red2-dark';
						$icon_block = '<i class="fas fa-lock fa-2x"></i>';
					}
					if($bloqueio != 'SIM'){
						$status_bloqueio = 'DESBLOQUEADO';
						$cor_block = 'bg-success';
						$icon_block = '<i class="fas fa-lock-open fa-2x"></i>';
					}
						
						
					if($veic_bateria_interna == ''){
						$veic_bateria_interna1 = '100';
					}
					if($veic_bateria_interna != ''){
						$veic_bateria_interna1 = $veic_bateria_interna;
					}
					
					if($veic_gsm == ''){
						$veic_gsm1 = '1';
					}
					if($veic_gsm != ''){
						$veic_gsm1 = $veic_gsm;
					}
					
					if($veic_volts == ''){
						$veic_volts1 = '12.5';
					}
					if($veic_volts != ''){
						$veic_volts1 = $veic_volts;
					}
					
					if($veic_satelite == ''){
						$veic_satelite1 = '1';
					}
					if($veic_satelite != ''){
						$veic_satelite1 = $veic_satelite;
					}
				?>				

				<div class="row text-center">
					<div class="col-3 align-items-center">
						<span class="text-center">
							<a href="#" class="btn btn-xxs rounded-s font-900 shadow-s bg-<?php echo $cor_ign?> color-white"><i class="fas fa-key fa-2x"></i></a><br>
							<span style="font-size:11px"><b>Ignição</b><br><?php echo $ign?></span>
						</span>
					</div>
					<div class="col-3 align-items-center">
						<span class="text-center">
							<a href="#" class="btn btn-xxs rounded-s font-900 shadow-s bg-dark color-white"><i class="fas fa-tachometer-alt fa-2x"></i></a><br>
							<text style="font-size:11px"><b>Velocidade</b><br><?php echo $apeed1?> Km/h</text>
						</span>
					</div>
					<div class="col-3 align-items-center">
						<span class="text-center">
							<a href="#" class="btn btn-xxs rounded-s font-900 shadow-s <?php echo $cor_block?> color-white" ><?php echo $icon_block?></a><br>
							<span style="font-size:11px"><b>Bloqueio</b><br><?php echo $status_bloqueio; ?></span>
						</span>
					</div>
					<div class="col-3 align-items-center">
						<span class="text-center">
							<a href="#" class="btn btn-xxs rounded-s font-900 shadow-s bg-dark color-white"><i class="fas fa-road fa-2x"></i></a><br>
							<span style="font-size:11px"><b>Km dia</b><br><?php echo $totalkm; ?> km</span>
						</span>
					</div>	
				</div>
				<div class="row text-center">
					<div class="col-3 align-items-center">
						<span class="text-center">
							<a href="#" class="btn btn-xxs rounded-s font-900 shadow-s bg-blue-dark" ><i class="fas fa-battery-full fa-2x"></i></a><br>
							<span style="font-size:11px"><b>Bateria</b><br><?php echo $veic_bateria_interna1?>%</span>
						</span>
					</div>
					<div class="col-3 align-items-center">
						<span class="text-center">
							<a href="#" class="btn btn-xxs rounded-s font-900 shadow-s bg-blue-dark"><i class="fas fa-satellite fa-2x"></i></a><br>
							<span style="font-size:11px"><b>Satétiles</b><br><?php echo $veic_satelite1?> Sát.</span>
						</span>
					</div>
					<div class="col-3 align-items-center">
						<span class="text-center">
							<a href="#" class="btn btn-xxs rounded-s font-900 shadow-s bg-blue-dark" ><i class="fas fa-signal fa-2x"></i></a><br>
							<span style="font-size:11px"><b>Nível GSM</b><br><?php echo $veic_gsm1?>%</span>
						</span>
					</div>
					<div class="col-3 align-items-center">
						<span class="text-center">
							<a href="#" class="btn btn-xxs rounded-s font-900 shadow-s bg-blue-dark"  data-toast="notification-2"><i class="fas fa-car-battery fa-2x"></i></a><br>
							<span style="font-size:11px"><b>Voltagem</b><br><?php echo $veic_volts1?> v</span>
						</span>
					</div>
				</div>
				<?php
					}}?>

