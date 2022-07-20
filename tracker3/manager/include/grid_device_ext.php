

 <?php

include_once("../conexao_ext.php");

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
				if($category == 'car'){
					$tipo_veiculo = '<font style="font-size:26px"><i class="fas fa-car" title="Automóvel"></i></font>';
				}
				else if($category == 'motorcycle'){
					$tipo_veiculo = '<font style="font-size:26px"><i class="fas fa-motorcycle" title="Motocicleta"></i></font>';
				} 
				else if($category == 'pickup'){
					$tipo_veiculo = '<font style="font-size:26px"><i class="fas fa-pickup" title="Pick-up"></i></font>';
				}
				
				
				$cons_cliente = mysqli_query($conn,"SELECT * FROM tc_positions WHERE deviceid='$id_device' ORDER BY id DESC LIMIT 1");
					if(mysqli_num_rows($cons_cliente) > 0){
				while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
				$address = 	$resp_cliente['address'];
				$devicetime = 	$resp_cliente['devicetime'];
				
				if($address == ''){
					$cons_cliente1 = mysqli_query($conn,"SELECT * FROM tc_positions WHERE deviceid='$id_device' AND address != '' ORDER BY id DESC LIMIT 1");
					if(mysqli_num_rows($cons_cliente1) > 0){
				while ($resp_cliente1 = mysqli_fetch_assoc($cons_cliente1)) {
				$endereco = $resp_cliente1['address'];
					}}
				}
				if($address != ''){
				$endereco =  $address;
				}
				
				date_default_timezone_set('America/Sao_Paulo');
				$objDate = DateTime::createFromFormat('Y-m-d H:i:s', $devicetime);
				$date_dev = $objDate->format('Y-m-d');
				$date_dev = date('Y-m-d', time());
				$time_dev = $objDate->format('H:i:s');
				$time_dev = date('H:i:s', strtotime('-3 hour', strtotime($time_dev)));
				$devicetime = ''.$date_dev.' '.$time_dev.'';
				$devicetime = date('d/m/Y H:i:s', strtotime("$devicetime"));
				
				$hora =  date('H:i:s');
				
				$inicio = DateTime::createFromFormat('H:i:s', $time_dev);
				$fim = DateTime::createFromFormat('H:i:s', $hora);
				$intervalo = $inicio->diff($fim);
				$inter = $intervalo->format('%H:%I:%S');
				
					$address1 = explode(',', $endereco);
					$result = count($address1);
					
					$bairro_n = $result -5;
					$bairro = $address1[$bairro_n];
					$estado_n = $result -2;
					$uf = $address1[$estado_n];
					$rua = $address1[0];
					$cidade_n = $result -4;
					$cidade = $address1[$cidade_n];
					
					$cidade_n2 = $result -3;
					$cidade2 = $address1[$cidade_n2];
					
					if($bairro == $rua){
						$bairro1 = '';
					} else {
						$bairro1 = $bairro;
					}
		
			$address_db = ''.$rua.' <br> '.$bairro1.' - '.$cidade.' / '.$uf.'';
			$address_db = str_replace('Corredor de Transporte Coletivo', 'Av.', $address_db);
				
				
				$address = utf8_encode($address_db);
				$speed = 	$resp_cliente['speed'];
				
				
				
								
				
				
				
				$speed = $speed * 1.609;
				$speed = round($speed, 2);
				$attributes = $resp_cliente['attributes'];
				$obj = json_decode($attributes);
				$ignicao = $obj->{'ignition'};
				$total_km = $obj->{'totalDistance'};
				$total_km = $total_km / 1000;
				$total_km = round($total_km, 2);
				$total_km = number_format($total_km, 2, ",", ".");
				$km = '<button type="button" class="btn btn-dark btn-sm btn-icon"  title="Hodometro: '.$total_km.' KM"><i class="fas fa-road" title="Hodometro: '.$total_km.' KM"></i></button>';
				if (is_bool($ignicao)) $ignicao ? $ignicao = "true" : $ignicao = "false";
				else if ($ignicao !== null) $ignicao = (string)$ignicao;
				
				$cons_conexao = mysqli_query($conn,"SELECT * FROM tc_events WHERE deviceid='$id_device' ORDER BY id DESC LIMIT 1");
					if(mysqli_num_rows($cons_conexao) > 0){
				while ($resp_conexao = mysqli_fetch_assoc($cons_conexao)) {
				$status_conexao = 	$resp_conexao['type'];
				$servertime = 	$resp_conexao['servertime'];
				
				$block = '<button type="button" id="button" class="btn btn-success btn-sm btn-icon" style="font-size:13px; top:0; width:auto;"><i class="fas fa-lock-open" title="Desbloqueado"></i></button>';
				
				
				
				if($status_conexao == 'deviceOffline'){
					$conect = '<button type="button"  class="btn btn-danger btn-sm btn-icon" top:0; width:auto;" title="Desconetado a '.$inter.'"><i class="fas fa-wifi" title="Desconetado a '.$inter.'"></i></button>';
				} else {
					$conect = '<button type="button" class="btn btn-success btn-sm btn-icon" title="Conectado"><i class="fas fa-wifi" title="Conectado"></i></button>';
				}
				
				if($ignicao == 'true' && $speed >= 6){
					$ign = '<button type="button" class="btn btn-success btn-sm btn-icon" title="Ignição Ligada"><i class="fas fa-key""></i></button>';
					$apeed1 = '<i class="fas fa-tachometer-alt"></i> <b>'.$speed.' km/h</b>';
				} else if ($ignicao == 'true' && $speed <= 5){
					$ign = '<button type="button" class="btn btn-warning btn-sm btn-icon"  title="Ignição Ligada"><i class="fas fa-key" ></i></button>';
					$apeed1 = '<i class="fas fa-tachometer-alt"></i> <b>'.$speed.' km/h</b>';					
				} else {
					$ign = '<button type="button" class="btn btn-dark btn-sm btn-icon"  title="Ignição Desligada"><i class="fas fa-key"></i></button>';
					$apeed1 = '<i class="fas fa-tachometer-alt"></i> <b>0 km/h</b>';					
				}
				
				$cons_veiculo = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE deviceid='$id_device' ");
					if(mysqli_num_rows($cons_veiculo) > 0){
				while ($resp_veiculo = mysqli_fetch_assoc($cons_veiculo)) {
				$placa = 	$resp_veiculo['placa'];
				$bloqueio = 	$resp_veiculo['bloqueio'];
				$ancora = 	$resp_veiculo['ancora'];
				$marca_veiculo = 	$resp_veiculo['marca_veiculo'];
				$modelo_veiculo = 	$resp_veiculo['modelo_veiculo'];
				
				if($bloqueio == 'SIM'){
					$block = '<button type="button" class="btn btn-danger btn-sm btn-icon" title="BLOQUEADO"><i class="fas fa-lock" title="BLOQUEADO"></i></button>';
					$block2 = '<i class="fa fa-lock-open"></i> Desbloquear';
				} else if($bloqueio == 'NAO'){
					$block = '<button type="button" class="btn btn-success btn-sm btn-icon" title="Desbloqueado"><i class="fas fa-lock-open" title="Desbloqueado"></i></button>';
					$block2 = '<i class="fa fa-lock"></i> Bloquear';
					$block3 = 'desbloqueado';
					$block4 = 'DESBLOQUEIO';
				} else if($bloqueio == ''){
					$block = '<button type="button" class="btn btn-success btn-sm btn-icon"  title="Desbloqueado"><i class="fas fa-lock-open" title="Desbloqueado"></i></button>';
					$block2 = '<i class="fa fa-lock"></i> Bloquear';
					$block3 = 'bloqueado';
					$block4 = 'BLOQUEIO';
				}
				if($ancora == 'ON'){
					$anchor = '<button type="button" class="btn btn-success btn-sm btn-icon" title="Ancora Ativada"><i class="fas fa-anchor" title="Ancora Ativada"></i></button>';
				} else {
					$anchor = '<button type="button" class="btn btn-dark btn-sm btn-icon" title="Ancora Desativada"><i class="fas fa-anchor" title="Ancora Desativada"></i></button>';
				}
				
				?>
				
                 <tr>
					
					<th><font style="font-size:12px;"><b><?php echo $placa?></b></font></th>
					<td><font style="font-size:12px;"><?php echo $marca_veiculo; ?><br><?php echo $modelo_veiculo; ?></font></td>
					<td><font style="font-size:12px;"><?php echo $address; ?></font></td>
                    <td><font style="font-size:12px;"><?php echo $apeed1; ?></font></td>
					
				</tr>
				
							
				<?php
					}}}}}}}}?>

