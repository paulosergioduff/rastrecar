

 <?php

include_once("../conexao.php");

$id_empresa = $_REQUEST['customer'];
$data_agora = date('Y-m-d H:i:s');
$data_agora = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_agora)));
$data_agora1 = date('Y-m-d H:i:s', strtotime('-5 minutes', strtotime($data_agora)));
					
			$result_usuario = "SELECT * FROM tc_devices WHERE contact !='ESTOQUE' AND lastupdate < '$data_agora1' AND id_empresa='$id_empresa' ORDER BY positionid DESC";
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
				$protocol = 	$resp_cliente['protocol'];
				$obj = json_decode($attributes);
				$ignicao = $obj->{'ignition'};
				$total_km = $obj->{'totalDistance'};
				$total_km = $total_km / 1000;
				$total_km = round($total_km, 2);
				$total_km = number_format($total_km, 2, ",", ".");
				$km = '<button type="button" class="btn btn-outline btn-info btn-sm btn-icon " title="Hodometro: '.$total_km.' KM"><i class="fas fa-road" title="Hodometro: '.$total_km.' KM"></i></button>';
				if (is_bool($ignicao)) $ignicao ? $ignicao = "true" : $ignicao = "false";
				else if ($ignicao !== null) $ignicao = (string)$ignicao;
				
				$cons_conexao = mysqli_query($conn,"SELECT * FROM tc_events WHERE deviceid='$id_device' ORDER BY id DESC LIMIT 1");
					if(mysqli_num_rows($cons_conexao) > 0){
				while ($resp_conexao = mysqli_fetch_assoc($cons_conexao)) {
				$type = 	$resp_conexao['type'];
				$eventos = $resp_conexao['attributes'];
				$eventos1 = json_decode($eventos);
				$alarme = $eventos1->{'alarm'};
				
				if($status_conexao == 'on'){
					if($type == 'alarm' && $alarme == 'powerCut'){
						$bateria = '<h3><span class="badge" style="background-color:#CD5C5C;color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Sem Alimentação"><i class="fas fa-plug"></i></span></h3>';
					}
					if($type == 'alarm' && $alarme == 'powerRestored' or $alarme != 'powerCut'){
						$bateria = '<h3><span class="badge" style="background-color:#009900;color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Alimentação Conectada"><i class="fas fa-plug"></i></span></h3>';
					}
				}
				if($status_conexao == 'off'){
					$bateria = '<h3><span class="badge badge-secondary" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Sem Informação"><i class="fas fa-plug"></i></span></h3>';
					$div_off = '<div style="display:none">offline</div>';
				}
				
				
				
				
				
			
				
				$cons_veiculo = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE deviceid='$id_device' ");
					if(mysqli_num_rows($cons_veiculo) > 0){
				while ($resp_veiculo = mysqli_fetch_assoc($cons_veiculo)) {
				$placa = 	$resp_veiculo['placa'];
				$bloqueio = 	$resp_veiculo['bloqueio'];
				$ancora = 	$resp_veiculo['ancora'];
				$marca_veiculo = 	$resp_veiculo['marca_veiculo'];
				$modelo_veiculo = 	$resp_veiculo['modelo_veiculo'];
				$id_cliente = 	$resp_veiculo['id_cliente'];
				$veiculo = $placa.' - '.$marca_veiculo.'/'.$modelo_veiculo;
				}}
				
				$cons_cli = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente' ");
					if(mysqli_num_rows($cons_cli) > 0){
				while ($resp_cli = mysqli_fetch_assoc($cons_cli)) {
				$nome_cliente = 	$resp_cli['nome_cliente'];
					}}
					
				if($ignicao == 'true' && $speed >= 6){
					$ign = '<h3><span class="badge" style="background-color:#009900; color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Ignição Ligada /Em Movimento"><i class="fas fa-key"></i></span></h3>';
					$apeed1 = '<h3><span class="badge badge-dark"><i class="fas fa-tachometer-alt"></i> <b>'.$speed.' km/h</b></span></h3>';
					$cor = '#1e7e34';
					$nome_veiculo = '<h4><span class="badge" style="background-color:#009900; color:#FFF"><b>'.$veiculo.'</b></span></h4>';
				} else if ($ignicao == 'true' && $speed <= 5){
					$ign = '<h3><span class="badge badge-warning" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Ignição Ligada / Veículo Parado"><i class="fas fa-key"></i></span></h3>';
					$apeed1 = '<h3><span class="badge" style="background-color:#000; color:#FFF"><i class="fas fa-tachometer-alt"></i> <b>0 km/h</b></span></h3>';	
					$cor = '#d39e00';	
					$nome_veiculo = '<h4><span class="badge badge-warning"><b>'.$veiculo.'</b></span></h4>';
				} else {
					if($status_conexao == 'off'){
						$cor = '#CCC';		
						$apeed1 = '<h3><span class="badge badge-secondary"><i class="fas fa-tachometer-alt"></i> <b>0 km/h</b></span></h3>';
						$ign = '<h3><span class="badge border badge-secondary" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Sem Informação"><i class="fas fa-key"></i></span></h3>';
						$nome_veiculo = '<h4><span class="badge  badge-secondary"><b>'.$veiculo.'</b></span></h4>';
					}
					if($status_conexao == 'on'){
						$cor = '#000';		
						$apeed1 = '<h3><span class="badge" style="background-color:#000; color:#FFF"><i class="fas fa-tachometer-alt"></i> <b>0 km/h</b></span></h3>';
						$ign = '<h3><span class="badge border" style="background-color:#000; color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Ignição Desligada"><i class="fas fa-key"></i></span></h3>';
						$nome_veiculo = '<h4><span class="badge" style="background-color:#000; color:#FFF"><b>'.$veiculo.'</b></span></h4>';
					}
				}
				
				if($status_conexao == 'on'){
					if($bloqueio == 'SIM'){
						$block = '<h3><span class="badge" style="background-color:#CD5C5C; color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Veículo Bloqueado"><i class="fas fa-lock"></i></span></h3>';
						$block2 = '<i class="fa fa-lock-open"></i> Desbloquear';
					} else if($bloqueio == 'NAO'){
						$block = '<h3><span class="badge" style="background-color:#009900; color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Veículo Desbloqueado"><i class="fas fa-lock-open"></i></span></h3>';
						$block2 = '<i class="fa fa-lock"></i> Bloquear';
						$block3 = 'desbloqueado';
						$block4 = 'DESBLOQUEIO';
					} else if($bloqueio == ''){
						$block = '<h3><span class="badge" style="background-color:#009900; color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Veículo Desbloqueado"><i class="fas fa-lock-open"></i></span></h3>';
						$block2 = '<i class="fa fa-lock"></i> Bloquear';
						$block3 = 'bloqueado';
						$block4 = 'BLOQUEIO';
					}
					
					if($ancora == 'ON'){
						$anchor = '<h3><span class="badge" style="background-color:#009900; color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Âncora Ativada"><i class="fas fa-anchor"></i></span></h3>';
					} 
					if($ancora != 'ON'){
						$anchor = '<h3><span class="badge" style="background-color:#000; color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Âncora Desativada"><i class="fas fa-anchor"></i></span></h3>';
					}
					
					
				}
				if($status_conexao == 'off'){
					$block = '<h3><span class="badge badge-secondary" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Sem Informação"><i class="fas fa-lock"></i></span></h3>';
					
					$anchor = '<h3><span class="badge badge-secondary" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Sem Informação"><i class="fas fa-anchor"></i></span></h3>';
					
					
				}
				
				
				if($protocol == 'easytrack'){
					$blocked = $obj->{'blocked'};
					if (is_bool($blocked)) $blocked ? $blocked = "true" : $blocked = "false";
					else if ($blocked !== null) $blocked = (string)$blocked;
					
					if($status_conexao == 'on'){
						if($blocked == 'true'){
							$status_bloqueio = '<h3><span class="badge" style="background-color:#CD5C5C; color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Veículo Bloqueado"><i class="fas fa-lock"></i></span></h3>';
							$cor_block = '#CD5C5C';
							$icon_block = '<i class="fas fa-lock fa-2x"></i>';
						}
						if($blocked == 'false'){
							$status_bloqueio = '<h3><span class="badge" style="background-color:#009900; color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Veículo Desbloqueado"><i class="fas fa-lock-open"></i></span></h3>';
							$cor_block = '#009900';
							$icon_block = '<i class="fas fa-lock-open fa-2x"></i>';
						}
					}
					if($status_conexao == 'off'){
						$block = 'S/Inf';
						$cor_block = '#999';
					}
				}
				if($protocol == 'suntech'){
					$blocked = $obj->{'out1'};
					if (is_bool($blocked)) $blocked ? $blocked = "true" : $blocked = "false";
					else if ($blocked !== null) $blocked = (string)$blocked;
					
					if($status_conexao == 'on'){
						if($blocked == 'true'){
							$status_bloqueio = '<h3><span class="badge" style="background-color:#CD5C5C; color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Veículo Bloqueado"><i class="fas fa-lock"></i></span></h3>';
							$cor_block = '#CD5C5C';
							$icon_block = '<i class="fas fa-lock fa-2x"></i>';
						}
						if($blocked == 'false'){
							$status_bloqueio = '<h3><span class="badge" style="background-color:#009900; color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Veículo Desbloqueado"><i class="fas fa-lock-open"></i></span></h3>';
							$cor_block = '#009900';
							$icon_block = '<i class="fas fa-lock-open fa-2x"></i>';
						}
					}
					if($status_conexao == 'off'){
						$block = 'S/Inf';
						$cor_block = '#999';
					}
				}
				if($protocol == 'teltonika'){
					$blocked = $obj->{'out1'};
					if (is_bool($blocked)) $blocked ? $blocked = "true" : $blocked = "false";
					else if ($blocked !== null) $blocked = (string)$blocked;
					
					if($status_conexao == 'on'){
						if($blocked == 'true'){
							$status_bloqueio = '<h3><span class="badge" style="background-color:#CD5C5C; color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Veículo Bloqueado"><i class="fas fa-lock"></i></span></h3>';
							$cor_block = '#CD5C5C';
							$icon_block = '<i class="fas fa-lock fa-2x"></i>';
						}
						if($blocked == 'false'){
							$status_bloqueio = '<h3><span class="badge" style="background-color:#009900; color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Veículo Desbloqueado"><i class="fas fa-lock-open"></i></span></h3>';
							$cor_block = '#009900';
							$icon_block = '<i class="fas fa-lock-open fa-2x"></i>';
						}
					}
					if($status_conexao == 'off'){
						$block = 'S/Inf';
						$cor_block = '#999';
					}
				}
				if($protocol == 'gt06'){
					$blocked = $obj->{'blocked'};
					if (is_bool($blocked)) $blocked ? $blocked = "true" : $blocked = "false";
					else if ($blocked !== null) $blocked = (string)$blocked;
					
					if($status_conexao == 'on'){
						if($blocked == 'true'){
							$status_bloqueio = '<h3><span class="badge" style="background-color:#CD5C5C; color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Veículo Bloqueado"><i class="fas fa-lock"></i></span></h3>';
							$cor_block = '#CD5C5C';
							$icon_block = '<i class="fas fa-lock fa-2x"></i>';
						}
						if($blocked == 'false'){
							$status_bloqueio = '<h3><span class="badge" style="background-color:#009900; color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Veículo Desbloqueado"><i class="fas fa-lock-open"></i></span></h3>';
							$cor_block = '#009900';
							$icon_block = '<i class="fas fa-lock-open fa-2x"></i>';
						}
					}
					if($status_conexao == 'off'){
						$block = 'S/Inf';
						$cor_block = '#999';
					}
				}
				if($protocol == 'gps103'){
					$blocked = $obj->{'event'};
					
					
					if($status_conexao == 'on'){
						if($blocked == 'jt'){
							$status_bloqueio = '<h3><span class="badge" style="background-color:#CD5C5C; color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Veículo Bloqueado"><i class="fas fa-lock"></i></span></h3>';
							$cor_block = '#CD5C5C';
							$icon_block = '<i class="fas fa-lock fa-2x"></i>';
						}
						if($blocked != 'jt'){
							$status_bloqueio = '<h3><span class="badge" style="background-color:#009900; color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Veículo Desbloqueado"><i class="fas fa-lock-open"></i></span></h3>';
							$cor_block = '#009900';
							$icon_block = '<i class="fas fa-lock-open fa-2x"></i>';
						}
					}
					if($status_conexao == 'off'){
						$block = 'S/Inf';
						$cor_block = '#999';
					}
				}
				else {
					$status_bloqueio = $block;
					$cor_block = $cor_block_geral;
					$icon_block = $icon_block_geral;
				}
				
				$base64 = 'deviceid:'.$id_device;
				$base64 = base64_encode($base64);

				?>
				
       
			
				<span class="buscar">
					<div class="card border mb-g" >
						<div class="card-body pl-4 pt-4 pr-4 pb-0" style="border-left:<?php echo $cor?> 5px solid; border-bottom:<?php echo $cor?> 1px solid; border-top:<?php echo $cor?> 1px solid; border-right:<?php echo $cor?> 1px solid;">
							<div class="d-flex flex-column">
								<div class="border-0 flex-1 position-relative shadow-top">
									<div class="row">
										<div class="col-md-8">
											<?php echo $nome_veiculo; ?>
										</div>
										<div class="col-md-4 text-right">
											
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<span><i class="fas fa-map-marker-alt"></i> <?php echo $address; ?></span>
										</div>
									</div><br>
									<div class="row">
										<div class="col-md-6">
											<span data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Horário GPS"><i class="fas fa-map-marked-alt"></i> <?php echo $devicetime11; ?></span>
										</div>
										<div class="col-md-6">
											<span data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Horário Conexão Servidor"><i class="fas fa-clock"></i> <?php echo $lastupdate1; ?></span>
										</div>
									</div><br>
									<div class="row">
										<div class="col-md-12">
											<span><i class="fas fa-user"></i> <?php echo $nome_cliente; ?></span>
										</div>
									</div>
								</div>
								<div class="height-8 d-flex flex-row align-items-center flex-wrap flex-shrink-0">
									<?php echo $apeed1; ?><span class="text-white">-</span>
									<?php echo $ign; ?><span class="text-white">-</span>
									<?php echo $conect; ?><span class="text-white">-</span>
									<?php echo $status_bloqueio; ?><span class="text-white">-</span>
									<?php echo $bateria; ?><span class="text-white">-</span>
									<?php echo $div_off; ?><span class="text-white">-</span>
									<a href="grid_device.php?c=<?php echo $base64?>"><h3><span class="badge badge-dark">Mapa <i class="fas fa-play-circle"></i></span></h3>
									</a>
									
									<?php
									$base64 = 'deviceid:'.$deviceid.'';
									$base64 = base64_encode($base64);
									?>
									
									
								</div>
							</div>
						</div>
					</div>
				</span>

							
				<?php
					}}}}}}?>

<script>
$(function () {
	$('[data-toggle="popover"]').popover()
})
</script>
