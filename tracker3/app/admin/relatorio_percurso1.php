
<!DOCTYPE html>

<html lang="en">
    <head>
           <meta charset="utf-8"/>
        <title>APP</title>
        <meta name="description" content="Basic">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
        <!-- Call App Mode on ios devices -->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <!-- Remove Tap Highlight on Windows Phone IE -->
        <meta name="msapplication-tap-highlight" content="no">
        <!-- base css -->
        <link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/vendors.bundle.css">
        <link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/app.bundle.css">
        <!-- Place favicon.ico in the root directory -->
        <link rel="apple-touch-icon" sizes="180x180" href="/tracker3/app-assets/img/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/tracker3/app-assets/img/favicon/favicon-32x32.png">
        <link rel="mask-icon" href="/tracker3/app-assets/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/datagrid/datatables/datatables.bundle.css">
				<link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/fa-solid.css">
		<link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/statistics/chartjs/chartjs.css">
		<link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/formplugins/select2/select2.bundle.css">
		<script src="https://kit.fontawesome.com/a132241e15.js"></script>
    </head>
    <body class="mod-bg-1 nav-function-fixed">
        <!-- DOC: script to save and load page settings -->
        <script>
            /**
             *	This script should be placed right after the body tag for fast execution 
             *	Note: the script is written in pure javascript and does not depend on thirdparty library
             **/
            'use strict';

            var classHolder = document.getElementsByTagName("BODY")[0],
                /** 
                 * Load from localstorage
                 **/
                themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) :
                {},
                themeURL = themeSettings.themeURL || '',
                themeOptions = themeSettings.themeOptions || '';
            /** 
             * Load theme options
             **/
            if (themeSettings.themeOptions)
            {
                classHolder.className = themeSettings.themeOptions;
                console.log("%c✔ Theme settings loaded", "color: #148f32");
            }
            else
            {
                console.log("Heads up! Theme settings is empty or does not exist, loading default settings...");
            }
            if (themeSettings.themeURL && !document.getElementById('mytheme'))
            {
                var cssfile = document.createElement('link');
                cssfile.id = 'mytheme';
                cssfile.rel = 'stylesheet';
                cssfile.href = themeURL;
                document.getElementsByTagName('head')[0].appendChild(cssfile);
            }
            /** 
             * Save to localstorage 
             **/
            var saveSettings = function()
            {
                themeSettings.themeOptions = String(classHolder.className).split(/[^\w-]+/).filter(function(item)
                {
                    return /^(nav|header|mod|display)-/i.test(item);
                }).join(' ');
                if (document.getElementById('mytheme'))
                {
                    themeSettings.themeURL = document.getElementById('mytheme').getAttribute("href");
                };
                localStorage.setItem('themeSettings', JSON.stringify(themeSettings));
            }
            /** 
             * Reset settings
             **/
            var resetSettings = function()
            {
                localStorage.setItem("themeSettings", "");
            }

        </script>
        <!-- BEGIN Page Wrapper -->
        <div class="page-wrapper">
            <div class="page-inner">
                <!-- BEGIN Left Aside -->
               <?php include('include/sidebar.php')?>
                <!-- END Left Aside -->
                <div class="page-content-wrapper header-function-fixed">
                    <!-- BEGIN Page Header -->
                    <?php include('include/head.php')?>
					
					<?php
					$id_push = $_REQUEST['id'];
					$deviceid = $_REQUEST['deviceid'];
					
					$agrupar = 'SIM';

					$data_ini = $_REQUEST['data_inicial'];


					$date = date('Y-m-d H:i:s');
					$data_final = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($date)));

					if($data_ini == '2'){
						$data_inic  =  date('Y-m-d H:i:s', strtotime('-2 hour', strtotime($date)));
					}
					if($data_ini == '4'){
						$data_inic  =  date('Y-m-d H:i:s', strtotime('-4 hour', strtotime($date)));
					}
					if($data_ini == '8'){
						$data_inic  =  date('Y-m-d H:i:s', strtotime('-8 hour', strtotime($date)));
					}
					if($data_ini == '12'){
						$data_inic  =  date('Y-m-d H:i:s', strtotime('-12 hour', strtotime($date)));
					}
					if($data_ini == '24'){
						$data_inic  =  date('Y-m-d H:i:s', strtotime('-24 hour', strtotime($date)));
					}
					if($data_ini == '48'){
						$data_inic  =  date('Y-m-d H:i:s', strtotime('-48 hour', strtotime($date)));
					}


					$data_inicial = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_inic)));
					$data_inicial2 = date('d/m/Y H:i', strtotime("$data_inic"));
					$data_final2 = date('d/m/Y H:i', strtotime("$date"));
					
						$sql = mysqli_query($conn, "SELECT * FROM tc_positions WHERE deviceid='$deviceid' AND (servertime >= '$data_inicial' AND servertime <= '$data_final') ORDER BY id DESC LIMIT 1");
							if(mysqli_num_rows($sql) > 0){
						while ($resp_sql = mysqli_fetch_assoc($sql)) {
								$km_1 = $resp_sql['attributes'];
								$obj_km1 = json_decode($km_1);
								$km_1 = $obj_km1->{'totalDistance'};;
							}}
							
							$sql1 = mysqli_query($conn, "SELECT * FROM tc_positions WHERE deviceid='$deviceid' AND (servertime >= '$data_inicial' AND servertime <= '$data_final') ORDER BY id ASC LIMIT 1");
							if(mysqli_num_rows($sql1) > 0){
						while ($resp_sql1 = mysqli_fetch_assoc($sql1)) {
								$km_2 = $resp_sql1['attributes'];
								$obj_km2 = json_decode($km_2);
								$km_2 = $obj_km2->{'totalDistance'};;
							}}
							
							$totalkm = $km_1 - $km_2;
							$totalkm = $totalkm / 1000;
							$totalkm = round($totalkm, 2);
							$totalkm = number_format($totalkm, 2, ",", ".");
							
					$cons_veiculo = mysqli_query($conn, "SELECT * FROM veiculos_clientes WHERE deviceid='$deviceid'");
					if(mysqli_num_rows($cons_veiculo) > 0){
					while ($resp_veic = mysqli_fetch_assoc($cons_veiculo)) {
							$id_cliente = $resp_veic['id_cliente'];
							$marca_veiculo =  $resp_veic['marca_veiculo'];
							$modelo_veiculo =  $resp_veic['modelo_veiculo'];
							$placa =  $resp_veic['placa'];
					}}

					$cons_cliente = mysqli_query($conn, "SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
					if(mysqli_num_rows($cons_cliente) > 0){
					while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
							$nome_cliente = $resp_cliente['nome_cliente'];
					}}
					
					#----------------
					$cons_posicao = mysqli_query($conn,"SELECT * FROM tc_positions WHERE deviceid='$deviceid' AND (servertime >= '$data_inicial' AND servertime <= '$data_final) ORDER BY id DESC");
						if(mysqli_num_rows($cons_posicao) > 0){
					while ($resp_posicao = mysqli_fetch_assoc($cons_posicao)) {
							$servertime1 = $resp_posicao['servertime'];
						$servertime = date('Y-m-d H:i:s', strtotime('-3 hour', strtotime($servertime1)));
						$data_format = date('d/m/Y H:i:s', strtotime('-3 hour', strtotime($servertime1)));
						$latitude = $resp_posicao['latitude'];
						$longitude = $resp_posicao['longitude'];
						$address = $resp_posicao['address'];
						$speed = $resp_posicao['speed'];
						$address = utf8_encode($address);
						
						$address1 = explode(',', $address);
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
							
								$address_db = ''.$rua.' '.$bairro1.' - '.$cidade.' / '.$uf.'';
								$address_db = str_replace('Corredor de Transporte Coletivo', 'Av.', $address_db);
						
								$address = utf8_encode($address_db);
						
						
						

						
						
						
						$attributes = $resp_posicao['attributes'];
						$obj = json_decode($attributes);
						$ignicao = $obj->{'ignition'};
					if (is_bool($ignicao)) $ignicao ? $ignicao = "true" : $ignicao = "false";
					else if ($ignicao !== null) $ignicao = (string)$ignicao;


						$cons_veiculo = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE deviceid='$deviceid' ");
										if(mysqli_num_rows($cons_veiculo) > 0){
									while ($resp_veiculo = mysqli_fetch_assoc($cons_veiculo)) {
									$placa = 	$resp_veiculo['placa'];
									$bloqueio = 	$resp_veiculo['bloqueio'];
									$veiculo = ''.$resp_veiculo['marca_veiculo'].'/'.$resp_veiculo['modelo_veiculo'].'';

					if($ignicao == 'true' && $speed >= 6 && $bloqueio == 'NAO'){
						$ign = ''.$category.'_s.png';
						$ign2 = 'Ligada';
					} else if ($ignicao == 'true' && $speed <= 5 && $bloqueio == 'NAO'){
						$ign = ''.$category.'_w.png';	
						$ign2 = 'Ligada';
					} else if ($ignicao == 'true' && $speed <= 5 && $bloqueio == 'SIM'){
						$ign = ''.$category.'_d.png';
					$ign2 = 'Desligada';	
					} else if ($ignicao == 'false' && $speed <= 5 && $bloqueio == 'SIM'){
						$ign = ''.$category.'_d.png';	
						$ign2 = 'Desligada';
					} else {
						$ign = ''.$category.'.png';	
						$ign2 = 'Desligada';
					}
						
						
						$marker = array('type' => 'Feature',
										'name' => $name, 
										'address' => $address, 
										'lat' => $latitude,
										'lng' => $longitude,
										'icon' => $ign,
										'placa' => $placa,
										'veiculo' => $veiculo,
										'data_format' => $data_format,
										'ignicao' => $ignicao,
										'properties' => array('message' => $veiculo, 'iconSize' => array('99', '73')),
										'geometry' => array('type' => 'Point', 'coordinates' => array($longitude, $latitude)));

									$json[] = $marker;

									$mark = array('type' => 'FeatureCollection',
								  'features' => $json);

					}}}}



					$posicoes = json_encode($mark, JSON_PRETTY_PRINT);
						
					?>
					<?php



					function segundos_em_tempo($segundos) {
					 
					 $horas = floor($segundos / 3600);
					 $minutos = floor($segundos % 3600 / 60);
					 $segundos = $segundos % 60;
					 
					 return sprintf("%02d:%02d:%02d", $horas, $minutos, $segundos);
					 
					}
						


						
						
							$cons_eventos_off = mysqli_query($conn,"SELECT * FROM tc_events WHERE deviceid='$deviceid' AND (eventtime >= '$data_inicial' AND eventtime <= '$data_final') AND (type='ignitionOn' OR type='ignitionOff') ORDER BY eventtime ASC");
						if(mysqli_num_rows($cons_eventos_off) > 0){
							while ($row_ev_off = mysqli_fetch_assoc($cons_eventos_off)) {
								
								
								$listagem[] = $row_ev_off;  
								
							}
							
							for ($i=0; $i < count($listagem); $i++) { 
								
							if($listagem[$i]["type"]=='ignitionOn' && $listagem[$i+1]["type"] == 'ignitionOff'){
							
									$date_time  = new DateTime($listagem[$i]['eventtime']);
									$diff       = $date_time->diff( new DateTime($listagem[$i+1]['eventtime']));
									$horas_mov[] = $diff->format('%H:%i:%s');
									
									//echo ''.$listagem[$i]['type'].': '.$listagem[$i]['servertime'].' - '.$listagem[$i+1]['type'].': '.$listagem[$i+1]['servertime'].' - Tempo Movimento: '.$horas.'<br>';

							}
							if($listagem[$i]["type"]=='ignitionOn' && $listagem[$i+1]["type"] == ''){

									$date_time  = new DateTime($listagem[$i]['eventtime']);
									$diff       = $date_time->diff( new DateTime($data_final));
									$horas_mov[] = $diff->format('%H:%i:%s');
									
									//echo ''.$listagem[$i]['type'].': '.$listagem[$i]['servertime'].' - '.$listagem[$i+1]['type'].': '.$listagem[$i+1]['servertime'].' - Tempo Movimento: '.$horas.'<br>';


							} 
							
							if($listagem[$i]["type"]=='ignitionOff' && $listagem[$i+1]["type"] == 'ignitionOn'){
							
									$date_time  = new DateTime($listagem[$i]['eventtime']);
									$diff       = $date_time->diff( new DateTime($listagem[$i+1]['eventtime']));
									$horas_stop[] = $diff->format('%H:%i:%s');
									
									//echo ''.$listagem[$i]['type'].': '.$listagem[$i]['servertime'].' - '.$listagem[$i+1]['type'].': '.$listagem[$i+1]['servertime'].' - Tempo Parado: '.$horas.'<br>';

							}
							if($listagem[$i]["type"]=='ignitionOff' && $listagem[$i+1]["type"] == ''){

									$date_time  = new DateTime($listagem[$i]['eventtime']);
									$diff       = $date_time->diff( new DateTime($data_final));
									$horas_stop[] = $diff->format('%H:%i:%s');
									
									//echo ''.$listagem[$i]['type'].': '.$listagem[$i]['servertime'].' - '.$listagem[$i+1]['type'].': '.$listagem[$i+1]['servertime'].' - Tempo Parado: '.$horas.'<br>';


							} 
							
						//echo ''.$horas.'<br>';

						}}
						
						
						
						$soma = 0;
						$soma1 = 0;
					 
					foreach($horas_stop as $item1) {
						list($horas,$minutos,$segundos) = explode(":",$item1);
						$calc1 = $horas * 3600 + $minutos * 60 + $segundos;
						$soma1 = $calc1 + $soma1;
					}



					foreach($horas_mov as $item) {
						list($horas,$minutos,$segundos) = explode(":",$item);
						$calc = $horas * 3600 + $minutos * 60 + $segundos;
						$soma = $calc + $soma;
					}
					 
					$total_mov = segundos_em_tempo($soma);
					$total_mov = explode(":", $total_mov);
					$hora_mov = $total_mov[0];
					$min_mov = $total_mov[1];

					$total_stop = segundos_em_tempo($soma1);
					$total_stop = explode(":", $total_stop);
					$hora_stop = $total_stop[0];
					$min_stop = $total_stop[1];

					$total_movimento =  ''.$hora_mov.'h'.$min_mov.'min';
					$total_parado = ''.$hora_stop.'h'.$min_stop.'min';

					#-----------------------------------------
					#-----------------------------------------

					$valor_comb = $_REQUEST['valor_comb'];
					$km_litro = $_REQUEST['km_litro'];

					$consumo = $totalkm / $km_litro;

					$valor_gasto = $consumo * $valor_comb;
					$valor_gasto1 = number_format($valor_gasto, 2, ",", ".");
										
					?>
					<form name="forml" action="relatorio_percurso1.php?app=on" method="post">
                    <main id="js-page-content" role="main" class="page-content">
					
						<div class="row">
                            <div class="col-xl-8">
								<div class="subheader">
									<h1 class="subheader-title">
										<i class='subheader-icon fal fa-road'></i> Relatório de Percurso
										<small>
											<b><?php echo $data_inicial2?> ATÉ <?php echo $data_final2?></b>
										</small>
									</h1>
								</div>
							</div>
							
						</div>
                        
						<div class="row">
							<div class="col-md-4">
								<div class="alert alert-dark text-center" role="alert">
									<b>Distância Percorrida no período:</b><br>
									<b><?php echo $totalkm?> Km</b><br>
								</div>
							</div>
						</div>
						<div class="row align-items-center text-left">
							<div class="col-sm-12">
								<div class="row align-items-center text-left">
									<div class="col p-1-0">
										<div class="alert alert-danger text-center" role="alert">
											<b>Tempo Parado:</b><br>
											<b><?php echo $total_parado?></b>
										</div>
									</div>
									<div class="col p-1-0">
										<div class="alert alert-success text-center" role="alert">
											<b>Em Movimento:</b><br>
											<b><?php echo $total_movimento?></b>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<a href="mapa_device.php?deviceid=<?php echo $deviceid?>&data_inicial=<?php echo $data_inicial?>&data_final=<?php echo $data_final?>&id=<?php echo $id_push?>"><button type="button" data-toggle="modal" data-target="#carregar" class="btn btn-info" style="width:100%"><i class="fas fa-map-marked-alt"></i> Ver Percurso no Mapa</button></a>
							</div>
						</div><br>
                       <div class="row">
							<div class="col-md-12">
								<?php 
								$data_hoje = date('Y-m-d H:i');



								$sql = mysqli_query($conn, "DELETE FROM relatorios_posicoes WHERE deviceid='$deviceid'");
								$sql2 = mysqli_query($conn, "DELETE FROM posicoes_relatorios WHERE deviceid='$deviceid'");


								$cons_veiculo = mysqli_query($conn, "SELECT * FROM veiculos_clientes WHERE deviceid='$deviceid'  ORDER BY id_veiculo ASC LIMIT 1");
									if(mysqli_num_rows($cons_veiculo) > 0){
										while ($resp_veiculo = mysqli_fetch_assoc($cons_veiculo)) {
										$id_veiculo = $resp_veiculo['id_veiculo'];
										$limite_velocidade = $resp_veiculo['limite_velocidade'];
									}}


								$cons_events_ini = mysqli_query($conn, "SELECT * FROM tc_positions WHERE deviceid='$deviceid' AND (fixtime >= '$data_inicial' AND fixtime <= '$data_final') ORDER BY id ASC LIMIT 1");
									if(mysqli_num_rows($cons_events_ini) > 0){
										while ($resp_events_ini = mysqli_fetch_assoc($cons_events_ini)) {
										$posicao_ini = $resp_events_ini['id'];
									}}
										
								$cons_events_fim = mysqli_query($conn, "SELECT * FROM tc_positions WHERE deviceid='$deviceid' AND (fixtime >= '$data_inicial' AND fixtime <= '$data_final') ORDER BY id DESC LIMIT 1");
									if(mysqli_num_rows($cons_events_fim) > 0){
										while ($resp_events_fim = mysqli_fetch_assoc($cons_events_fim)) {
										$posicao_fim = $resp_events_fim['id'];
									}}
										
								$sql_rel = mysqli_query($conn, "INSERT INTO relatorios_posicoes (deviceid, id_veiculo, data_inicial, data_final, posicao_inicial, posicao_final, data_relatorio, limite_velocidade) VALUES ('$deviceid', '$id_veiculo', '$data_i1', '$data_f1', '$posicao_ini', '$posicao_fim', '$data_hoje', '$limite_velocidade')");
											
											
								$cons_relatorio = mysqli_query($conn, "SELECT * FROM relatorios_posicoes WHERE deviceid='$deviceid' ORDER BY id_relatorio DESC LIMIT 1");
									if(mysqli_num_rows($cons_relatorio) > 0){
										while ($resp_rel = mysqli_fetch_assoc($cons_relatorio)) {
										$id_relatorio = $resp_rel['id_relatorio'];
										$posicao_inicial = $resp_rel['posicao_inicial'];
										$posicao_final = $resp_rel['posicao_final'];

									}}


								$cons_posicao = mysqli_query($conn,"SELECT * FROM tc_positions WHERE deviceid='$deviceid' AND ( id >= '$posicao_inicial' AND id <= '$posicao_final') ORDER BY servertime ASC");
									if(mysqli_num_rows($cons_posicao) > 0){
										while ($resp_posicao = mysqli_fetch_assoc($cons_posicao)) {
										$servertime = $resp_posicao['servertime'];
										$servertime = date('Y-m-d H:i:s', strtotime('-3 hour', strtotime($servertime)));
										$devicetime = $resp_posicao['devicetime'];
										$devicetime = date('Y-m-d H:i:s', strtotime('-3 hour', strtotime($devicetime)));
										$fixtime = $resp_posicao['fixtime'];
										$fixtime = date('Y-m-d H:i:s', strtotime('-3 hour', strtotime($fixtime)));
										$positionid = $resp_posicao['id'];
										$latitude = $resp_posicao['latitude'];
										$longitude = $resp_posicao['longitude'];
										$address = $resp_posicao['address'];
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
										$speed = $resp_posicao['speed'];
										$speed = $speed * 1.609;
										$speed = round($speed, 2);
										
										
										$attributes = $resp_posicao['attributes'];
										$obj = json_decode($attributes);
										$ignicao = $obj->{'ignition'};
										$motion = $obj->{'motion'};
										if (is_bool($ignicao)) $ignicao ? $ignicao = "true" : $ignicao = "false";
										else if ($ignicao !== null) $ignicao = (string)$ignicao;
										
										if (is_bool($motion)) $motion ? $motion = "true" : $motion = "false";
										else if ($motion !== null) $motion = (string)$motion;
										
										if($ignicao == 'true'){
											$ign = 'Ligada';
										}  else if ($ignicao == 'false'){
											$ign = 'Desligada';
										}
										
										if($motion == 'true'){
											$movimento = 'SIM';
										}  else if ($motion == 'false'){
											$movimento = 'NAO';
										}

								$insere_posicao = mysqli_query($conn,"INSERT INTO  posicoes_relatorios (positionid, endereco, servertime, devicetime, fixtime, latitude, longitude, speed, ignicao, movimento, id_relatorio, deviceid) VALUES ('$positionid', '$address', '$servertime', '$devicetime', '$fixtime', '$latitude', '$longitude', '$speed', '$ign', '$movimento', '$id_relatorio', '$deviceid')");


									}}
									
									#=======================================================
								#=======================================================

								$cons_pos = mysqli_query($conn,"SELECT * FROM posicoes_relatorios WHERE id_relatorio='$id_relatorio' ORDER BY fixtime ASC");
									if(mysqli_num_rows($cons_pos) > 0){
										while ($resp_pos = mysqli_fetch_assoc($cons_pos)) {
										$horario = $resp_pos['fixtime'];
										$horario_br = date('d/m/Y H:i:s', strtotime("$horario"));
										$ign2 = $resp_pos['ignicao'];
										$latitude = $resp_pos['latitude'];
										$longitude = $resp_pos['longitude'];
										$endereco = $resp_pos['endereco'];
										$veloc = $resp_pos['speed'];
										$movimento = $resp_pos['movimento'];
										$id_pos = $resp_pos['id'];
										
										


										if($ign2 == 'Desligada'){
											$cons_posicao_desl = mysqli_query($conn,"SELECT * FROM posicoes_relatorios WHERE id_relatorio = '$id_relatorio' AND fixtime > '$horario' AND ignicao = 'Ligada' ORDER BY id ASC LIMIT 1");
												
												if(mysqli_num_rows($cons_posicao_desl) > 0){
													while ($resp_posicao_desl = mysqli_fetch_assoc($cons_posicao_desl)) {
													$hora_proximo = $resp_posicao_desl['fixtime'];
													$hora_proximo_br = date('d/m/Y H:i:s', strtotime("$hora_proximo"));
													
													if($hora_proximo < $horario){
														$data_pos = $horario_br;
													} else {
														$data_pos = $horario_br.' até '.$hora_proximo_br;
													}
												}}
											$velocidade = '0.00';
											$ign3 = '<span style="color:#990000"><i class="fab fa-product-hunt"></i> <b> Desligado</b></span>';
										}
										
										
										
										
										$str_ign = 'Desligado';
										if($ign2 == 'Ligada'){
											$str_ign = 'Ligada';
											$data_pos = $horario_br;
											$velocidade = $veloc;
											if($movimento == 'NAO'){
												$ign3 = '<span style="color:#F4A460"><b><i class="fas fa-key"></i> Ligado/Parado</b></span>';
											}
											if($movimento == 'SIM'){
												$ign3 = '<span style="color:#009900"><b><i class="fas fa-key"></i> Ligado/Movimento</b></span>';
											}
											
										};
										if($agrupar == 'SIM'){
											if($last_ign == 'Desligado' && $str_ign == 'Desligado'){
												continue;
											};
										};
										$last_ign = $str_ign;
										
										
										if($limite_velocidade != '0.0'){
											if($velocidade > $limite_velocidade){
												$alerta = ' ';
												$veloc1 = '<span style="color:#990000"><b>'.$velocidade.' km/h</b></span> <i class="fas fa-exclamation-triangle" style="color:#F4A460"></i>'; 
											}
											if($velocidade <= $limite_velocidade){
												$alerta = ' ';
												$veloc1 = $velocidade.' km/h'; 
											}
										}
										if($limite_velocidade == '0.0'){
											$alerta = ' ';
											$veloc1 = $velocidade.' km/h'; 
										}
										

										
														
									?>
													
									
									<div id="panel-1" class="panel">
										<div class="panel-container show">
											<div class="panel-content">
												<div class="row">
													<div class="col-12">
														<i class="fas fa-clock"></i> <b><?php echo $data_pos?></b>
													</div>
												</div><br>
												<div class="row">
													<div class="col-12">
														<i class="fas fa-map-marker-alt"></i> <?php echo $endereco; ?>
													</div>
												</div>
												<div class="row">
													<div class="col-6">
														<i class="fas fa-tachometer-alt"></i> <?php echo $veloc1; ?>
													</div>
													<div class="col-6">
														<?php echo $ign3; ?>
													</div>
												</div>
											</div>
										</div>
									</div>
									
									
									
									<?php }}?>
							</div>
						</div><br>
						<input type="hidden" id="id_relatorio" value="<?php echo $id_relatorio?>">
                    </main>
					</form>
					 
					
					 
					 <!-- DIV Carregar -->
					<div class="modal fade" id="carregar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-sm modal-dialog-centered">
							<div class="modal-content" style="border:#000 2px solid">
								
								<div class="modal-body" id="informacoes">
									<span style="fonta-size:20px">Aguarde... </span> <img src="/tracker2/Imagens/load.gif" width="40px" height="40px">
								</div>
								
							</div>
						</div>
					</div>	
                    <!-- FIM DIV Carregar -->
					
					
                    <!-- this overlay is activated only when mobile menu is triggered -->
                    <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div> <!-- END Page Content -->
                    <!-- BEGIN Page Footer -->

                    <!-- END Page Footer -->
                    <!-- BEGIN Shortcuts -->
                   
                </div>
            </div>
        </div>
        <!-- END Page Wrapper -->
        <!-- BEGIN Quick Menu -->

        <!-- END Quick Menu -->
        <!-- END Messenger -->
        <!-- BEGIN Page Settings -->

        <!-- END Page Settings -->
      
        <script src="/tracker3/app-assets/js/vendors.bundle.js"></script>
        <script src="/tracker3/app-assets/js/app.bundle.js"></script>
        <script src="/tracker3/app-assets/js/datagrid/datatables/datatables.bundle.js"></script>
<script>
		var id_cliente_b = document.getElementById("id_cliente_login").value;
	var id_push = document.getElementById("id_push").value;
	$(document).ready(function () {
		
		$.post('include/grid_veiculos.php?id='+id_cliente_b+'&id_push='+id_push, function(veiculos){
			$("#grid_veiculos").html(veiculos);
			
			
		});
	});


</script>
<script>
			
$(document).ready(function(){
  $("#table_search").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#grid_veiculos #buscar").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>		
        <script>
            /* demo scripts for change table color */
            /* change background */


            $(document).ready(function()
            {
                $('#dt-basic-example').dataTable(
                {

                    responsive: true,
					colReorder: true
					
                });

                $('.js-thead-colors a').on('click', function()
                {
                    var theadColor = $(this).attr("data-bg");
                    console.log(theadColor);
                    $('#dt-basic-example thead').removeClassPrefix('bg-').addClass(theadColor);
                });

                $('.js-tbody-colors a').on('click', function()
                {
                    var theadColor = $(this).attr("data-bg");
                    console.log(theadColor);
                    $('#dt-basic-example').removeClassPrefix('bg-').addClass(theadColor);
                });

            });

        </script>
    </body>
</html>
