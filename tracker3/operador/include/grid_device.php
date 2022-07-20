

 <?php

include_once("../conexao.php");

$id_empresa = $_REQUEST['customer'];
$deviceid = $_REQUEST['deviceid'];

$data_agora = date('Y-m-d H:i:s');
$data_agora = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_agora)));
$data_agora1 = date('Y-m-d H:i:s', strtotime('-5 minutes', strtotime($data_agora)));
					
			$result_usuario = "SELECT * FROM tc_devices WHERE id='$deviceid'";
					$resultado_usuario = mysqli_query($conn, $result_usuario);


					//Verificar se encontrou resultado na tabela "usuarios"
					if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
					?>

				  <?php
			while($row_usuario = mysqli_fetch_assoc($resultado_usuario)){
				$id_device = $row_usuario['id'];
				$name = $row_usuario['name'];
				$positionid = $row_usuario['positionid'];
				$category = 	$row_usuario['category'];
				$lastupdate = 	$row_usuario['lastupdate'];
				$lastupdate1 = date('d/m/Y H:i:s', strtotime('-3 hour', strtotime($lastupdate)));
				
				if($lastupdate < $data_agora1){
					$conect = 'Offline';
					$status_conexao = 'off';
					$cor_conexao = '#CD5C5C';
				} else {
					$conect = 'Online';
					$status_conexao = 'on';
					$cor_conexao = '#009900';
				}
				
				
				$cons_cliente = mysqli_query($conn,"SELECT * FROM tc_positions WHERE id='$positionid' ORDER BY id DESC");
					if(mysqli_num_rows($cons_cliente) > 0){
				while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
				$address = 	$resp_cliente['address'];
				$protocol = 	$resp_cliente['protocol'];
				$address = str_replace(', BR', '', $address);
				$address1 = explode(",", $address);
				$estado1 = end($address1);
				$estado = ','.$estado1;
				$address = str_replace($estado, '', $address);
				$address1 = explode(",", $address);
				$cep = end($address1);
				$cep = ','.$cep;
				$address = str_replace($cep, '', $address);
				$address = $address.' /'.$estado1;
		
				
				
				$devicetime = 	$resp_cliente['fixtime'];
				$devicetime11 = date('d/m/Y H:i:s', strtotime('-3 hour', strtotime($devicetime)));
				
				$speed = 	$resp_cliente['speed'];
				
				$speed = $speed * 1.609;
				$speed = round($speed, 2);
				$attributes = $resp_cliente['attributes'];
				$obj = json_decode($attributes);
				$ignicao = $obj->{'ignition'};
				
				
				if (is_bool($ignicao)) $ignicao ? $ignicao = "true" : $ignicao = "false";
				else if ($ignicao !== null) $ignicao = (string)$ignicao;
				
				$driver_hex = $resp_cliente['driver_hex'];
				$driver_num = $resp_cliente['driver_num'];
				
				if($driver_hex != ''){
					$cons_motorista = mysqli_query($conn,"SELECT * FROM motoristas WHERE cartao_rfid_hex='$driver_hex'");
					if(mysqli_num_rows($cons_motorista) > 0){
						while ($resp_mot = mysqli_fetch_assoc($cons_motorista)) {
						$id_motorista = 	$resp_mot['id_motorista'];
						$nome_motorista = 	$resp_mot['nome_motorista'];
						$driver = $driver_num.' - '.$nome_motorista;
					}}
				}
				if($driver_hex == '' or $driver_hex == null){
					$driver = 'S/Inf';
				}	
				
				$cons_conexao = mysqli_query($conn,"SELECT * FROM tc_events WHERE deviceid='$deviceid' ORDER BY id DESC LIMIT 1");
					if(mysqli_num_rows($cons_conexao) > 0){
				while ($resp_conexao = mysqli_fetch_assoc($cons_conexao)) {
				$type = 	$resp_conexao['type'];
				$eventos = $resp_conexao['attributes'];
				$eventos1 = json_decode($eventos);
				$alarme = $eventos1->{'alarm'};
				
				}}
				
				if($status_conexao == 'on'){
					if($type == 'alarm' && $alarme == 'powerCut'){
						$alimentacao = 'Desligada';
						$cor_alimentacao = '#CD5C5C';
					}
					if($type == 'alarm' && $alarme == 'powerRestored' or $alarme != 'powerCut'){
						$alimentacao = 'Ligada';
						$cor_alimentacao = '#009900';
					}
				}
				if($status_conexao == 'off'){
					$alimentacao = 'S/Inf';
					$cor_alimentacao = '#999999';
				}
				

				
					if($ignicao == 'true' && $speed >= 6){
						$ign = 'Ligada';
						$apeed1 = ''.$speed.' km/h';
						$cor_ign = '#1e7e34';
					} else if ($ignicao == 'true' && $speed <= 4){
						$ign = 'Ligada';
						$apeed1 = ''.$speed.' km/h';
						$cor_ign = '#d39e00';					
					} else {
						$ign = 'Desligada';
						$apeed1 = ''.$speed.' km/h';
						$cor_ign = '#000';		
					}
					$cor_speed = '#000';	
				
				
				
				
				
				
				$cons_veiculo = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE deviceid='$deviceid' ");
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
				
				if($veic_volts >= 12){
					$power = $veic_volts.' Volts';
					$cor_power = '#009900';
					$icon_power = '<i class="fas fa-car-battery fa-2x"></i>';
				}
				if($veic_volts >= 11 && $veic_volts < 12){
					$power = $veic_volts.' Volts';
					$cor_power = '#DAA520';
					$icon_power = '<i class="fas fa-car-battery fa-2x"></i>';
				}
				if($veic_volts < 11){
					$power = $veic_volts.' Volts';
					$cor_power = '#CD5C5C';
					$icon_power = '<i class="fas fa-car-battery fa-2x"></i>';
				}
				if($veic_volts == '' or $veic_volts == null){
					$power = '<b>S/Inf</b>';
					$cor_power = '#999';
					$icon_power = '';
				}
				
				if($veic_satelite >= 4){
					$satelites = $veic_satelite.' Sat.';
					$cor_satelites = '#009900';
				}
				if($veic_satelite <= 3){
					$satelites = $veic_satelite.' Sat.';
					$cor_satelites = '#DAA520';
				}
				if($veic_satelite == '' or $veic_satelite == null){
					$satelites = '<b>S/Inf</b>';
					$cor_satelites = '#999';
				}
				
				if($veic_gsm >= 75){
					$gsm = $veic_gsm.'%';
					$cor_gsm = '#009900';
				}
				if($veic_gsm >= 25 && $veic_gsm < 75){
					$gsm = $veic_gsm.'%';
					$cor_gsm = '#DAA520';
				}
				if($veic_gsm < 25){
					$gsm = $veic_gsm.'%';
					$cor_gsm = '#CD5C5C';
				}
				if($veic_gsm == '' or $veic_gsm == null){
					$gsm = '<b>S/Inf</b>';
					$cor_gsm = '#999';
				}
				
				if($veic_bateria_interna >= 80){
					$bat_interna = $veic_bateria_interna.'%';
					$icon_bateria = '<i class="fas fa-battery-full fa-2x"></i>';
					$cor_bateria = '#009900';
				}
				if($veic_bateria_interna >= 40 && $veic_bateria_interna < 80){
					$bat_interna = $veic_bateria_interna.'%';
					$icon_bateria = '<i class="fas fa-battery-half fa-2x"></i>';
					$cor_bateria = '#DAA520';
				}
				if($veic_bateria_interna >= 5 && $veic_bateria_interna < 40){
					$bat_interna = $veic_bateria_interna.'%';
					$icon_bateria = '<i class="fas fa-battery-quarter fa-2x"></i>';
					$cor_bateria = '#CD5C5C';
				}
				if($veic_bateria_interna < 5){
					$bat_interna = $veic_bateria_interna.'%';
					$icon_bateria = '<i class="fas fa-battery-empty fa-2x"></i>';
					$cor_bateria = '#CD5C5C';
				}
				if($veic_bateria_interna == '' or $veic_bateria_interna == null){
					$bat_interna = '<b>S/Inf</b>';
					$icon_bateria = '<i class="fas fa-battery-slash fa-2x"></i>';
					$cor_bateria = '#999';
				}
				
				if($ancora == 'ON'){
					$cor_ancora = '#009900';
					$status_ancora = 'Ativada';
				}
				if($ancora == 'OFF'){
					$cor_ancora = '#000';
					$status_ancora = 'Desativada';
				}
				
				$cons_cli = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente' ");
					if(mysqli_num_rows($cons_cli) > 0){
				while ($resp_cli = mysqli_fetch_assoc($cons_cli)) {
				$nome_cliente = 	$resp_cli['nome_cliente'];
					}}
				
					if($bloqueio == 'SIM'){
						$block = 'BLOQUEADO';
						$cor_block_geral = '#CD5C5C';
						$icon_block_geral = '<i class="fas fa-lock fa-2x"></i>';
					} else if($bloqueio == 'NAO'){
						$block = 'Desbloqueado';
						$cor_block_geral = '#009900';
						$icon_block_geral = '<i class="fas fa-lock-open fa-2x"></i>';
						
					} else if($bloqueio == ''){
						$block = '<h3><span class="badge" style="background-color:#009900; color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Veículo Desbloqueado"><i class="fas fa-lock-open"></i></span></h3>';
					}

				
				
				
				if($protocol == 'easytrack'){
					$blocked = $obj->{'blocked'};
					if (is_bool($blocked)) $blocked ? $blocked = "true" : $blocked = "false";
					else if ($blocked !== null) $blocked = (string)$blocked;
					
					
						if($blocked == 'true'){
							$status_bloqueio = 'BLOQUEADO';
							$cor_block = '#CD5C5C';
							$icon_block = '<i class="fas fa-lock fa-2x"></i>';
							$sql_block = mysqli_query($conn, "UPDATE veiculos_clientes SET bloqueio='SIM' WHERE deviceid='$deviceid'");
							
							$cons_comandos = mysqli_query($conn,"SELECT * FROM comandos_enviados WHERE deviceid='$deviceid' AND comando = 'BLOQUEIO' AND executado='NAO' ORDER BY id_log DESC LIMIT 1");
								if(mysqli_num_rows($cons_comandos) > 0){
									while ($resp_comandos = mysqli_fetch_assoc($cons_comandos)) {
									$id_log = 	$resp_comandos['id_log'];
								}}
							
							$sql_block = mysqli_query($conn, "UPDATE comandos_enviados SET executado='SIM', positionid='$positionid', address='$address' WHERE id_log='$id_log' ");
						}
						if($blocked == 'false'){
							$status_bloqueio = 'Desbloqueado';
							$cor_block = '#009900';
							$icon_block = '<i class="fas fa-lock-open fa-2x"></i>';
							$sql_block = mysqli_query($conn, "UPDATE veiculos_clientes SET bloqueio='NAO' WHERE deviceid='$deviceid'");
							
							$cons_comandos = mysqli_query($conn,"SELECT * FROM comandos_enviados WHERE deviceid='$deviceid' AND comando = 'DESBLOQUEIO' AND executado='NAO' ORDER BY id_log DESC LIMIT 1");
								if(mysqli_num_rows($cons_comandos) > 0){
									while ($resp_comandos = mysqli_fetch_assoc($cons_comandos)) {
									$id_log = 	$resp_comandos['id_log'];
								}}
							
							$sql_block = mysqli_query($conn, "UPDATE comandos_enviados SET executado='SIM', positionid='$positionid', address='$address' WHERE id_log='$id_log' ");
						}
					
				}
				else if($protocol == 'suntech'){
					$blocked = $obj->{'out1'};
					if (is_bool($blocked)) $blocked ? $blocked = "true" : $blocked = "false";
					else if ($blocked !== null) $blocked = (string)$blocked;
					
				
						if($blocked == 'true'){
							$status_bloqueio = 'BLOQUEADO';
							$cor_block = '#CD5C5C';
							$icon_block = '<i class="fas fa-lock fa-2x"></i>';
							$sql_block = mysqli_query($conn, "UPDATE veiculos_clientes SET bloqueio='SIM' WHERE deviceid='$deviceid'");
							
							$cons_comandos = mysqli_query($conn,"SELECT * FROM comandos_enviados WHERE deviceid='$deviceid' AND comando = 'BLOQUEIO' AND executado='NAO' ORDER BY id_log DESC LIMIT 1");
								if(mysqli_num_rows($cons_comandos) > 0){
									while ($resp_comandos = mysqli_fetch_assoc($cons_comandos)) {
									$id_log = 	$resp_comandos['id_log'];
								}}
							
							$sql_block = mysqli_query($conn, "UPDATE comandos_enviados SET executado='SIM', positionid='$positionid', address='$address' WHERE id_log='$id_log' ");
						}
						if($blocked == 'false'){
							$status_bloqueio = 'Desbloqueado';
							$cor_block = '#009900';
							$icon_block = '<i class="fas fa-lock-open fa-2x"></i>';
							$sql_block = mysqli_query($conn, "UPDATE veiculos_clientes SET bloqueio='NAO' WHERE deviceid='$deviceid'");
							
							$cons_comandos = mysqli_query($conn,"SELECT * FROM comandos_enviados WHERE deviceid='$deviceid' AND comando = 'DESBLOQUEIO' AND executado='NAO' ORDER BY id_log DESC LIMIT 1");
								if(mysqli_num_rows($cons_comandos) > 0){
									while ($resp_comandos = mysqli_fetch_assoc($cons_comandos)) {
									$id_log = 	$resp_comandos['id_log'];
								}}
							
							$sql_block = mysqli_query($conn, "UPDATE comandos_enviados SET executado='SIM', positionid='$positionid', address='$address' WHERE id_log='$id_log' ");
						}
					
				}
				else if($protocol == 'teltonika'){
					$blocked = $obj->{'out1'};
					if (is_bool($blocked)) $blocked ? $blocked = "true" : $blocked = "false";
					else if ($blocked !== null) $blocked = (string)$blocked;
					
					
						if($blocked == 'true'){
							$status_bloqueio = 'BLOQUEADO';
							$cor_block = '#CD5C5C';
							$icon_block = '<i class="fas fa-lock fa-2x"></i>';
							$sql_block = mysqli_query($conn, "UPDATE veiculos_clientes SET bloqueio='SIM' WHERE deviceid='$deviceid'");
							
							$cons_comandos = mysqli_query($conn,"SELECT * FROM comandos_enviados WHERE deviceid='$deviceid' AND comando = 'BLOQUEIO' AND executado='NAO' ORDER BY id_log DESC LIMIT 1");
								if(mysqli_num_rows($cons_comandos) > 0){
									while ($resp_comandos = mysqli_fetch_assoc($cons_comandos)) {
									$id_log = 	$resp_comandos['id_log'];
								}}
							
							$sql_block = mysqli_query($conn, "UPDATE comandos_enviados SET executado='SIM', positionid='$positionid', address='$address' WHERE id_log='$id_log' ");
						}
						if($blocked == 'false'){
							$status_bloqueio = 'Desbloqueado';
							$cor_block = '#009900';
							$icon_block = '<i class="fas fa-lock-open fa-2x"></i>';
							$sql_block = mysqli_query($conn, "UPDATE veiculos_clientes SET bloqueio='NAO' WHERE deviceid='$deviceid'");
							
							$cons_comandos = mysqli_query($conn,"SELECT * FROM comandos_enviados WHERE deviceid='$deviceid' AND comando = 'DESBLOQUEIO' AND executado='NAO' ORDER BY id_log DESC LIMIT 1");
								if(mysqli_num_rows($cons_comandos) > 0){
									while ($resp_comandos = mysqli_fetch_assoc($cons_comandos)) {
									$id_log = 	$resp_comandos['id_log'];
								}}
							
							$sql_block = mysqli_query($conn, "UPDATE comandos_enviados SET executado='SIM', positionid='$positionid', address='$address' WHERE id_log='$id_log' ");
						}
					
				}
				else if($protocol == 'gt06'){
					$blocked = $obj->{'blocked'};
					if (is_bool($blocked)) $blocked ? $blocked = "true" : $blocked = "false";
					else if ($blocked !== null) $blocked = (string)$blocked;
					
					
						if($blocked == 'true'){
							$status_bloqueio = 'BLOQUEADO';
							$cor_block = '#CD5C5C';
							$icon_block = '<i class="fas fa-lock fa-2x"></i>';
							$sql_block = mysqli_query($conn, "UPDATE veiculos_clientes SET bloqueio='SIM' WHERE deviceid='$deviceid'");
							
							$cons_comandos = mysqli_query($conn,"SELECT * FROM comandos_enviados WHERE deviceid='$deviceid' AND comando = 'BLOQUEIO' AND executado='NAO' ORDER BY id_log DESC LIMIT 1");
								if(mysqli_num_rows($cons_comandos) > 0){
									while ($resp_comandos = mysqli_fetch_assoc($cons_comandos)) {
									$id_log = 	$resp_comandos['id_log'];
								}}
							
							$sql_block = mysqli_query($conn, "UPDATE comandos_enviados SET executado='SIM', positionid='$positionid', address='$address' WHERE id_log='$id_log' ");
						}
						if($blocked == 'false'){
							$status_bloqueio = 'Desbloqueado';
							$cor_block = '#009900';
							$icon_block = '<i class="fas fa-lock-open fa-2x"></i>';
							$sql_block = mysqli_query($conn, "UPDATE veiculos_clientes SET bloqueio='NAO' WHERE deviceid='$deviceid'");
							
							$cons_comandos = mysqli_query($conn,"SELECT * FROM comandos_enviados WHERE deviceid='$deviceid' AND comando = 'DESBLOQUEIO' AND executado='NAO' ORDER BY id_log DESC LIMIT 1");
								if(mysqli_num_rows($cons_comandos) > 0){
									while ($resp_comandos = mysqli_fetch_assoc($cons_comandos)) {
									$id_log = 	$resp_comandos['id_log'];
								}}
							
							$sql_block = mysqli_query($conn, "UPDATE comandos_enviados SET executado='SIM', positionid='$positionid', address='$address' WHERE id_log='$id_log' ");
						}
					
				}
				else if($protocol == 'gps103'){
					$blocked = $obj->{'event'};
					
					
					
						if($blocked == 'jt'){
							$status_bloqueio = 'BLOQUEADO';
							$cor_block = '#CD5C5C';
							$icon_block = '<i class="fas fa-lock fa-2x"></i>';
							$sql_block = mysqli_query($conn, "UPDATE veiculos_clientes SET bloqueio='SIM' WHERE deviceid='$deviceid'");
							
							$cons_comandos = mysqli_query($conn,"SELECT * FROM comandos_enviados WHERE deviceid='$deviceid' AND comando = 'BLOQUEIO' AND executado='NAO' ORDER BY id_log DESC LIMIT 1");
								if(mysqli_num_rows($cons_comandos) > 0){
									while ($resp_comandos = mysqli_fetch_assoc($cons_comandos)) {
									$id_log = 	$resp_comandos['id_log'];
								}}
							
							$sql_block = mysqli_query($conn, "UPDATE comandos_enviados SET executado='SIM', positionid='$positionid', address='$address' WHERE id_log='$id_log' ");
						}
						if($blocked != 'jt'){
							$status_bloqueio = 'Desbloqueado';
							$cor_block = '#009900';
							$icon_block = '<i class="fas fa-lock-open fa-2x"></i>';
							$sql_block = mysqli_query($conn, "UPDATE veiculos_clientes SET bloqueio='NAO' WHERE deviceid='$deviceid'");
							
							$cons_comandos = mysqli_query($conn,"SELECT * FROM comandos_enviados WHERE deviceid='$deviceid' AND comando = 'DESBLOQUEIO' AND executado='NAO' ORDER BY id_log DESC LIMIT 1");
								if(mysqli_num_rows($cons_comandos) > 0){
									while ($resp_comandos = mysqli_fetch_assoc($cons_comandos)) {
									$id_log = 	$resp_comandos['id_log'];
								}}
							
							$sql_block = mysqli_query($conn, "UPDATE comandos_enviados SET executado='SIM', positionid='$positionid', address='$address' WHERE id_log='$id_log' ");
						}
					
				}
				else {
					$status_bloqueio = $block;
					$cor_block = $cor_block_geral;
					$icon_block = $icon_block_geral;
				}
				
				
				
				$base64 = 'deviceid:'.$deviceid;
				$base64 = base64_encode($base64);

				?>
				
					
					<div class="row">
						<div class="col-12 d-sm-flex align-items-center">
							<div class="p-1 mr-1">
							   <i class="fas fa-map-marker-alt fa-2x"></i>
							</div>
							<div>
								<label class="fs-sm mb-0"><?php echo $address?></label>
							</div>
						</div>
					</div><br>
					<div class="row">
						<div class="col-6 d-sm-flex align-items-center">
							<div class="p-1 mr-1">
							  <i class="fas fa-satellite-dish fa-2x"></i>
							</div>
							<div>
								<label class="fs-sm mb-0"><b>Hora GPS:</b> <br><?php echo $devicetime11; ?></label>
							</div>
						</div>
						<div class="col-6 d-sm-flex align-items-center">
							<div class="p-1 mr-1">
							  <i class="far fa-clock fa-2x"></i>
							</div>
							<div>
								<label class="fs-sm mb-0"><b>Hora Servidor:</b> <br><?php echo $lastupdate1; ?></label>
							</div>
						</div>
					</div><br>
					<div class="row">
						<div class="col-6 d-sm-flex align-items-center">
							<div class="p-1 mr-1">
							   <i class="fas fa-user fa-2x"></i>
							</div>
							<div>
								<label class="fs-sm mb-0"><b>Cliente:</b> <br><?php echo $nome_cliente?></label>
							</div>
						</div>
						<div class="col-6 d-sm-flex align-items-center">
							<div class="p-1 mr-1">
							  <i class="far fa-user-circle fa-2x"></i>
							</div>
							<div>
								<label class="fs-sm mb-0"><b>Motorista:</b> <br><?php echo $driver; ?></label>
							</div>
						</div>
					</div>
					<hr style="border:#CCC 1px solid;">
					<div class="row">
						<div class="col-4 d-sm-flex align-items-center">
							<div class="p-1 mr-1">
							  <span class="badge" style="background-color:<?php echo $cor_conexao?>; color:#FFF"><i class="fas fa-wifi fa-2x"></i></span>
							</div>	
							<div>
								<label class="fs-sm mb-0"><b>Status:</b><br><?php echo $conect?></label>
							</div>
						</div>
						<div class="col-4 d-sm-flex align-items-center">
							<div class="p-1 mr-1">
							  <span class="badge" style="background-color:<?php echo $cor_ign?>; color:#FFF"><i class="fas fa-key fa-2x"></i></span>
							</div>	
							<div>
								<label class="fs-sm mb-0"><b>Ignição:</b><br><?php echo $ign?></label>
							</div>
						</div>
						<div class="col-4 d-sm-flex align-items-center">
							<div class="p-1 mr-1">
							  <span class="badge" style="background-color:<?php echo $cor_speed?>; color:#FFF"><i class="fas fa-tachometer-alt fa-2x"></i></span>
							</div>	
							<div>
								<label class="fs-sm mb-0"><b>Velocidade:</b><br><?php echo $apeed1?></label>
							</div>
						</div>
					</div><br>
					<div class="row">
						<div class="col-4 d-sm-flex align-items-center">
							<div class="p-1 mr-1">
							  <span class="badge" style="background-color:<?php echo $cor_block?>; color:#FFF"><?php echo $icon_block?></span>
							</div>	
							<div>
								<label class="fs-sm mb-0"><b>Bloqueio:</b><br><?php echo $status_bloqueio?></label>
							</div>
						</div>
						<div class="col-4 d-sm-flex align-items-center">
							<div class="p-1 mr-1">
							  <span class="badge" style="background-color:<?php echo $cor_alimentacao?>; color:#FFF; width:30px"><i class="fas fa-plug fa-2x"></i></span>
							</div>	
							<div>
								<label class="fs-sm mb-0"><b>Alimentação:</b><br><?php echo $alimentacao?></label>
							</div>
						</div>
						<div class="col-4 d-sm-flex align-items-center">
							<div class="p-1 mr-1">
							  <span class="badge" style="background-color:<?php echo $cor_bateria?>; color:#FFF"><?php echo $icon_bateria?></span>
							</div>	
							<div>
								<label class="fs-sm mb-0"><b>Bat. Interna:</b><br><?php echo $bat_interna?></label>
							</div>
						</div>
					</div><br>
					<div class="row">
						<div class="col-4 d-sm-flex align-items-center">
							<div class="p-1 mr-1">
							  <span class="badge" style="background-color:<?php echo $cor_power?>; color:#FFF"><i class="fas fa-car-battery fa-2x"></i></span>
							</div>	
							<div>
								<label class="fs-sm mb-0"><b>Bat. Veículo:</b><br><?php echo $power?></label>
							</div>
						</div>
						<div class="col-4 d-sm-flex align-items-center">
							<div class="p-1 mr-1">
							  <span class="badge" style="background-color:<?php echo $cor_gsm?>; color:#FFF;"><i class="fas fa-signal fa-2x"></i></span>
							</div>	
							<div>
								<label class="fs-sm mb-0"><b>Nível GSM:</b><br><?php echo $gsm?></label>
							</div>
						</div>
						<div class="col-4 d-sm-flex align-items-center">
							<div class="p-1 mr-1">
							  <span class="badge" style="background-color:<?php echo $cor_satelites?>; color:#FFF"><i class="fas fa-satellite fa-2x"></i></span>
							</div>	
							<div>
								<label class="fs-sm mb-0"><b>Satélites:</b><br><?php echo $satelites?></label>
							</div>
						</div>
					</div><br>
					<div class="row">
						<div class="col-4 d-sm-flex align-items-center">
							<div class="p-1 mr-1">
							  <span class="badge" style="background-color:#000; color:#FFF"><i class="fas fa-road fa-2x"></i></span>
							</div>	
							<div>
								<label class="fs-sm mb-0"><b>Odômetro:</b><br><?php echo $odometro?> km</label>
							</div>
						</div>
						<div class="col-4 d-sm-flex align-items-center">
							<div class="p-1 mr-1">
							  <span class="badge" style="background-color:<?php echo $cor_ancora?>; color:#FFF"><i class="fas fa-anchor fa-2x"></i></span>
							</div>	
							<div>
								<label class="fs-sm mb-0"><b>Âncora:</b><br><?php echo $status_ancora?></label>
							</div>
						</div>
						<div class="col-4 d-sm-flex align-items-center">
							<div class="p-1 mr-1">
							  <span class="badge" style="background-color:#4169E1; color:#FFF"><i class="fas fa-chart-line fa-2x"></i></span>
							</div>	
							<div>
								<label class="fs-sm mb-0"><b>Consumo Sim Card:</b><br>0,0 MB</label>
							</div>
						</div>
					</div>
					<input type="hidden" value="<?php echo $status_bloqueio?>" id="retorno_bloqueio" name="retorno_bloqueio">	
					

							
				<?php
					}}}}?>

