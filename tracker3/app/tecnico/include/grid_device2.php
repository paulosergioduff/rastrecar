

 <?php

$servidor = "localhost";
$usuario = "root";
$senha = "M196619m210300";
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
				$imei = $row_usuario['uniqueid'];
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
					$cor_ign = '#009900';
					$cor_ign2 = '#E7EEE3';
				} else if ($ignicao == 'true' && $speed <= 5){
					$ign = 'LIGADO';
					$movi = 'PARADO';
					$apeed1 = $speed;
					$cor_ign = '#F4A460';
					$cor_ign2 = '#FBF0E1';
				} else {
					$ign = 'DESLIGADO';
					$movi = '';
					$apeed1 = '0.00';
					$cor_ign = '#000';
					$cor_ign2 = '#EBEBEB';
				}
				
				if($protocol == 'easytrack'){
					$blocked = $obj->{'blocked'};
					if (is_bool($blocked)) $blocked ? $blocked = "true" : $blocked = "false";
					else if ($blocked !== null) $blocked = (string)$blocked;
					
					if($blocked == 'true'){
						$status_bloqueio = 'BLOQUEADO';
						$cor_block = '#CD5C5C';
						$icon_block = '<i class="fas fa-lock fa-2x" style="color:#CD5C5C"></i>';
					}
					if($blocked == 'false'){
						$status_bloqueio = 'DESBLOQUEADO';
						$cor_block = '#009900';
						$icon_block = '<i class="fas fa-lock-open fa-2x" style="color:#000"></i>';
					}
				}
				if($protocol == 'suntech'){
					$blocked = $obj->{'out1'};
					if (is_bool($blocked)) $blocked ? $blocked = "true" : $blocked = "false";
					else if ($blocked !== null) $blocked = (string)$blocked;
					
					if($blocked == 'true'){
						$status_bloqueio = 'BLOQUEADO';
						$cor_block = '#CD5C5C';
						$icon_block = '<i class="fas fa-lock fa-2x" style="color:#CD5C5C"></i>';
					}
					if($blocked == 'false'){
						$status_bloqueio = 'DESBLOQUEADO';
						$cor_block = '#009900';
						$icon_block = '<i class="fas fa-lock-open fa-2x" style="color:#000"></i>';
					}
				}
				if($protocol == 'teltonika'){
					$blocked = $obj->{'out1'};
					if (is_bool($blocked)) $blocked ? $blocked = "true" : $blocked = "false";
					else if ($blocked !== null) $blocked = (string)$blocked;
					
					if($blocked == 'true'){
						$status_bloqueio = 'BLOQUEADO';
						$cor_block = '#CD5C5C';
						$icon_block = '<i class="fas fa-lock fa-2x" style="color:#CD5C5C"></i>';
					}
					if($blocked == 'false'){
						$status_bloqueio = 'DESBLOQUEADO';
						$cor_block = '#009900';
						$icon_block = '<i class="fas fa-lock-open fa-2x" style="color:#000"></i>';
					}
				}
				if($protocol == 'gt06'){
					$blocked = $obj->{'blocked'};
					if (is_bool($blocked)) $blocked ? $blocked = "true" : $blocked = "false";
					else if ($blocked !== null) $blocked = (string)$blocked;
					
					if($blocked == 'true'){
						$status_bloqueio = 'BLOQUEADO';
						$cor_block = '#CD5C5C';
						$icon_block = '<i class="fas fa-lock fa-2x" style="color:#CD5C5C"></i>';
					}
					if($blocked == 'false'){
						$status_bloqueio = 'DESBLOQUEADO';
						$cor_block = '#009900';
						$icon_block = '<i class="fas fa-lock-open fa-2x" style="color:#000"></i>';
					}
				}
				if($protocol == 'gps103'){
					$blocked = $obj->{'event'};
					
					if($blocked == 'jt'){
						$status_bloqueio = 'BLOQUEADO';
						$cor_block = '#CD5C5C';
						$icon_block = '<i class="fas fa-lock fa-2x" style="color:#CD5C5C"></i>';
					}
					if($blocked != 'jt'){
						$status_bloqueio = 'DESBLOQUEADO';
						$cor_block = '#009900';
						$icon_block = '<i class="fas fa-lock-open fa-2x" style="color:#000"></i>';
					}
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
				$modelo_veiculo = 	$resp_veiculo['modelo_veiculo'];
				$modelo_equip = 	$resp_veiculo['modelo_equip'];
			
					}}
				
				?>				
				<div class="row">
					<div class="col-6 text-center">
						 <i class="fas fa-key fa-2x" style="color:<?php echo $cor_ign?>"></i><br>
						 <span style="font-size:10px"><?php echo $ign?> <?php echo $movi?></span>
					</div>
					<div class="col-6 text-center">
						<?php echo $icon_block?><br>
						<span style="font-size:10px"><?php echo $status_bloqueio?></span>
					</div>
					
				</div><br>
				<div class="row">
					<div class="col-6 text-center">
						<i class="fas fa-mobile fa-2x" style="color:#000"></i><br>
						<span style="font-size:10px"><?php echo $modelo_equip?></span>
						<span style="font-size:10px"><?php echo $imei?></span>
					</div>
					<div class="col-6 text-center">
						<span style="font-size:10px"><i class="fas fa-clock fa-2x"></i> <br><?php echo $devicetime1?></span>
					</div>
				</div>
				
				
				<?php
					}}?>

