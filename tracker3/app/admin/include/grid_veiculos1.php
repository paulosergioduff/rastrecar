
								<div class="accordion card-transparent" id="accordionExample">
	
 <?php

$servidor = "localhost";
$usuario = "root";
$senha = "M196619m210300";
$dbname = "traccar";

//Criar a conexao
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
$con = mysqli_connect($servidor, $usuario, $senha, $dbname);



$id_empresa = $_REQUEST['id_empresa'];
$table_search = $_REQUEST['table_search'];
$id_cliente_login = $_REQUEST['id'];
$id_push = $_REQUEST['id_push'];
$data_agora = date('Y-m-d H:i:s');
$data_agora = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_agora)));
$data_agora1 = date('Y-m-d H:i:s', strtotime('-5 minutes', strtotime($data_agora)));


				
	
					
			$result_usuario = mysqli_query($conn, "SELECT * FROM tc_devices WHERE id_empresa='$id_empresa' AND name LIKE '%".$table_search."%' ORDER BY positionid DESC");
				$total_devices = mysqli_num_rows($result_usuario);
				if(mysqli_num_rows($result_usuario) > 0){
				while ($row_usuario = mysqli_fetch_assoc($result_usuario)) {
				$deviceid = $row_usuario['id'];
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
				
				if($total_devices >= 1){
					$abrir = 'show';
				}
				if($total_devices <= 0){
					$abrir = '';
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
				$address = str_replace('Corredor de Transporte Coletivo', 'Av.', $address);
				
				
				$devicetime = 	$resp_cliente['fixtime'];
				$devicetime11 = date('d/m/Y H:i:s', strtotime('-3 hour', strtotime($devicetime)));
				
				$speed = 	$resp_cliente['speed'];
				
				$speed = $speed * 1.609;
				$speed = round($speed, 2);
				$attributes = $resp_cliente['attributes'];
				$protocol = 	$resp_cliente['protocol'];
				$obj = json_decode($attributes);
				$ignicao = $obj->{'ignition'};
				}}
				if (is_bool($ignicao)) $ignicao ? $ignicao = "true" : $ignicao = "false";
				else if ($ignicao !== null) $ignicao = (string)$ignicao;
				
				$cons_conexao = mysqli_query($conn,"SELECT * FROM tc_events WHERE deviceid='$deviceid' ORDER BY id DESC LIMIT 1");
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
				
				
				
				
				
			
				
				$cons_veiculo = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE deviceid='$deviceid' ");
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
					$ign = 'LIGADO';
					$movi = 'EM MOVIMENTO';
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
						$icon_anchor = '<i class="fas fa-anchor fa-2x" style="color:#000;"></i>';
					} 
					if($ancora != 'ON'){
						$anchor = '<h3><span class="badge" style="background-color:#000; color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Âncora Desativada"><i class="fas fa-anchor"></i></span></h3>';
						$icon_anchor = '';
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
							$icon_block = '<i class="fas fa-lock fa-2x" style="color:#990000;"></i>';
						}
						if($blocked == 'false'){
							$status_bloqueio = '<h3><span class="badge" style="background-color:#009900; color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Veículo Desbloqueado"><i class="fas fa-lock-open"></i></span></h3>';
							$cor_block = '#009900';
							$icon_block = '';
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
							$icon_block = '<i class="fas fa-lock fa-2x" style="color:#990000;"></i>';
						}
						if($blocked == 'false'){
							$status_bloqueio = '<h3><span class="badge" style="background-color:#009900; color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Veículo Desbloqueado"><i class="fas fa-lock-open"></i></span></h3>';
							$cor_block = '#009900';
							$icon_block = '';
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
							$icon_block = '<i class="fas fa-lock fa-2x" style="color:#990000;"></i>';
						}
						if($blocked == 'false'){
							$status_bloqueio = '<h3><span class="badge" style="background-color:#009900; color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Veículo Desbloqueado"><i class="fas fa-lock-open"></i></span></h3>';
							$cor_block = '#009900';
							$icon_block = '';
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
							$icon_block = '<i class="fas fa-lock fa-2x" style="color:#990000;"></i>';
						}
						if($blocked == 'false'){
							$status_bloqueio = '<h3><span class="badge" style="background-color:#009900; color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Veículo Desbloqueado"><i class="fas fa-lock-open"></i></span></h3>';
							$cor_block = '#009900';
							$icon_block = '';
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
							$icon_block = '<i class="fas fa-lock fa-2x" style="color:#990000;"></i>';
						}
						if($blocked != 'jt'){
							$status_bloqueio = '<h3><span class="badge" style="background-color:#009900; color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Veículo Desbloqueado"><i class="fas fa-lock-open"></i></span></h3>';
							$cor_block = '#009900';
							$icon_block = '';
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
				
				$base64 = 'deviceid:'.$deviceid;
				$base64 = base64_encode($base64);

				?>
				
				
			
							<span class="buscar">
							<div class="card" style="border:<?php echo $cor_ign?> 1px solid;border-left:<?php echo $cor_ign?> 8px solid;">
								<div class="card-header " id="headingTwo" style=" background-color:<?php echo $cor_ign2?>">
									<a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse" data-target="#veic<?php echo $deviceid?>" aria-expanded="false" aria-controls="veic<?php echo $deviceid?>">
										<div class="row">
											<div class="col-10">
												<div class="d-flex flex-row align-items-center">
													<span class="mr-3">
														<span class="rounded-circle profile-image d-block " style="background-image:url('/tracker2/Imagens/veiculos/<?php echo $category?>.png'); background-size: cover;"></span>
													</span>
													<div class="info-card-text flex-1">
														 <span class="text-truncate text-truncate-xl" style="font-size:20px"><b><?php echo $placa?></b></span>
														<span class="text-truncate text-truncate-xl"><b><?php echo $marca_veiculo?>/<?php echo $modelo_veiculo?></b></span>
													</div> 
												</div>
											</div>
											<div class="col-2 text-right">
												<span class="mr-5">
													<span class="rounded-circle profile-image d-block " style="background-size: cover;"><?php echo $icon_block?> <?php echo $icon_anchor?></span>
													
												</span>
											</div>
										</div>
										
									</a>
								</div>
								<div id="veic<?php echo $deviceid?>" class="collapse" aria-labelledby="headingTwo" >
									<div class="card-body">
										<div class="row">
											<div class="col-12 d-flex flex-row align-items-center">
												<div class="p-1 mr-1">
												   <i class="fas fa-map-marker-alt fa-2x" style="color:<?php echo $cor_ign?>"></i>
												</div>
												<div>
													<label class="fs-sm mb-0"><?php echo $address?></label>
												</div>
											</div>
											
										</div><br>
										<div class="row">
											<div class="col-7 d-flex flex-row align-items-center">
												<div class="p-1 mr-1">
												   <i class="fas fa-key fa-2x" style="color:<?php echo $cor_ign?>"></i>
												</div>
												<div>
													<label class="fs-sm mb-0"><?php echo $ign?><br><?php echo $movi?></label>
												</div>
											</div>
											<div class="col-5 d-flex flex-row align-items-center">
												<div class="p-1 mr-1">
												   <i class="fas fa-tachometer-alt fa-2x" style="color:<?php echo $cor_ign?>"></i>
												</div>
												<div>
													<label class="fs-sm mb-0"><?php echo $apeed1?> Km/h</label>
												</div>
											</div>
											
										</div><br>
										<div class="row">
											<div class="col-12 text-center">
												<span style="font-size:10px"><i class="fas fa-clock"></i> <?php echo $devicetime11?></span>
											</div>
										</div><br>
										<div class="row">
											<div class="col-12 text-center">
												<a href="grid_device.php?deviceid=<?php echo $deviceid?>&id=<?php echo $id_push?>"><button type="button" class="btn btn-outline-dark" style="width:70%" data-toggle="modal" data-target="#carregar"><i class="fas fa-map-marked-alt"></i> Ver no Mapa</button></a>
											</div>
										</div>
										
									</div>
								</div>
							</div>
							</span>
							<br>
							
							
				<?php
					}}}}?>
					
					
</div>
							

