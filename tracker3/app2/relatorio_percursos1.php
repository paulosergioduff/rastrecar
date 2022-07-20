<?php 
$servidor = "localhost";
$usuario = "root";
$senha = "TR4vcijU6T9Keaw";
$dbname = "traccar";

//Criar a conexao
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
$con = mysqli_connect($servidor, $usuario, $senha, $dbname);

$data_agora = date('H:i');
$data_login = date('Y-m-d H:i');
$deviceid = $_REQUEST['deviceid'];
$id_push = $_REQUEST['id_push'];



 $cons_user1 = mysqli_query($conn,"SELECT * FROM usuarios_push WHERE id_push='$id_push' ");
	if(mysqli_num_rows($cons_user1) <= 0){
		header('Location: logoff.php');
	}
	if(mysqli_num_rows($cons_user1) > 0){
		while ($resp_user1 = mysqli_fetch_assoc($cons_user1)) {
		$tipo = 	$resp_user1['tipo'];
		$id_usuarios = $resp_user1['id_usuarios'];
		$id_cliente_login = $resp_user1['id_cliente'];

	}}

$cons_user = mysqli_query($conn, "SELECT * FROM usuarios WHERE id_usuarios = '$id_usuarios'");
	if(mysqli_num_rows($cons_user) > 0){
while ($resp_user = mysqli_fetch_assoc($cons_user)) {
$nome_user = 	$resp_user['nome'];
$nome_us = explode(" ", $nome_user);
$nome_user = $nome_us[0];
$email_user = 	$resp_user['email'];
$nivel = 	$resp_user['nivel'];
$ativo = 	$resp_user['ativo'];
$veiculos_user = 	$resp_user['veiculos'];
$permite_bloqueio = 	$resp_user['permite_bloqueio'];
$id_empresa = 	$resp_user['id_empresa'];


	}}
	
$cons_empresa = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='$id_empresa'");
	if(mysqli_num_rows($cons_empresa) > 0){
while ($resp_empresa = mysqli_fetch_assoc($cons_empresa)) {
$nome_fantasia = 	$resp_empresa['nome_fantasia'];
$cor_sistema = 	$resp_empresa['cor_sistema'];
$logo = 	$resp_empresa['logo'];
$nome_url = 	$resp_empresa['nome_url'];
	}}

$cons_veiculo = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE deviceid = '$deviceid'");
	if(mysqli_num_rows($cons_veiculo) > 0){
		while ($resp_veiculos = mysqli_fetch_assoc($cons_veiculo)) {
		$placa = 	$resp_veiculos['placa'];
		$modelo_veiculo = 	$resp_veiculos['modelo_veiculo'];
		$marca_veiculo = 	$resp_veiculos['marca_veiculo'];
		$modelo_img = str_replace(' ', '_', $modelo_veiculo);
	}}

$nome_empesa = 'JC Rastreamento';

$agrupar = 'SIM';

$data_ini = $_REQUEST['data_inicial'];


$date = date('Y-m-d H:i:s');
$data_final = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($date)));

if($data_ini == '2'){
	$data_inic  =  date('Y-m-d H:i:s', strtotime('-2 hour', strtotime($date)));
	$tempo_p  = 'Últimas 2 horas';
}
if($data_ini == '4'){
	$data_inic  =  date('Y-m-d H:i:s', strtotime('-4 hour', strtotime($date)));
	$tempo_p  = 'Últimas 4 horas';
}
if($data_ini == '8'){
	$data_inic  =  date('Y-m-d H:i:s', strtotime('-8 hour', strtotime($date)));
	$tempo_p  = 'Últimas 8 horas';
}
if($data_ini == '12'){
	$data_inic  =  date('Y-m-d H:i:s', strtotime('-12 hour', strtotime($date)));
	$tempo_p  = 'Últimas 12 horas';
}
if($data_ini == '24'){
	$data_inic  =  date('Y-m-d H:i:s', strtotime('-24 hour', strtotime($date)));
	$tempo_p  = 'Últimas 24 horas';
}
if($data_ini == '48'){
	$data_inic  =  date('Y-m-d H:i:s', strtotime('-48 hour', strtotime($date)));
	$tempo_p  = 'Últimas 48 horas';
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
							$veiculo_nome = $placa.' - '.$marca_veiculo.'/'.$modelo_veiculo;
					}}

					$cons_cliente = mysqli_query($conn, "SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
					if(mysqli_num_rows($cons_cliente) > 0){
					while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
							$nome_cliente = $resp_cliente['nome_cliente'];
					}}

						
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



<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
<title>APP</title>
<link rel="stylesheet" type="text/css" href="styles/bootstrap.css">
<link rel="stylesheet" type="text/css" href="styles/style.css">
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900|Roboto:300,300i,400,400i,500,500i,700,700i,900,900i&amp;display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="fonts/css/fontawesome-all.min.css">    
<link rel="manifest" href="_manifest.json" data-pwa-version="set_in_manifest_and_pwa_js">
<link rel="apple-touch-icon" sizes="180x180" href="app/icons/icon-192x192.png">
<script src="https://kit.fontawesome.com/a132241e15.js"></script>
</head>
    
<body class="theme-light" data-highlight="blue2">
    
<div id="preloader"><div class="spinner-border color-highlight" role="status"></div></div>
    
<div id="page">
    
    <!-- header and footer bar go here-->
    <div class="header header-fixed header-auto-show header-logo-app">
        <a href="index.html" class="header-title"><?php echo $nome_url?></a>
        <a href="#" data-menu="menu-main" class="header-icon header-icon-1"><i class="fas fa-bars"></i></a>
        <a href="#" data-toggle-theme class="header-icon header-icon-2 show-on-theme-dark"><i class="fas fa-sun"></i></a>
        <a href="#" data-toggle-theme class="header-icon header-icon-2 show-on-theme-light"><i class="fas fa-moon"></i></a>
        <a href="#" data-menu="menu-highlights" class="header-icon header-icon-3"><i class="fas fa-brush"></i></a>
    </div>
    <div id="footer-bar" class="footer-bar-5">
         <a href="perfil.php?id=<?php echo $id_push?>" onclick="carregar();"><i class="fas fa-user-circle"></i><span>Perfil</span></a>
        <a href="faturas.php?id=<?php echo $id_push?>" onclick="carregar();"><i class="fas fa-file-invoice-dollar"></i><span>Faturas</span></a>
        <a href="index.php?id=<?php echo $id_push?>" onclick="carregar();" class="active-nav"><i class="fas fa-car"></i><span>Veículos</span></a>
        <a href="#" data-menu="menu-main"><i class="fa fa-bars"></i><span>Menu</span></a>
    </div>
    
    <div class="page-content">
        
        <div class="page-title page-title-large">
            <h2><a href="#" class="color-white" data-back-button><i class="fa fa-arrow-left"></i> Voltar</a> </h2><br>
            <a href="#" data-menu="menu-main" class="bg-fade-gray1-dark shadow-xl preload-img" data-src="images/avatars/5s.png"></a>
        </div>
        <div class="card header-card shape-rounded" data-card-height="210">
            <div class="card-overlay bg-highlight opacity-95"></div>
            <div class="card-overlay dark-mode-tint"></div>
            <div class="card-bg preload-img" data-src="images/pictures/20s.jpg"></div>
        </div>
        

        <!-- Homepage Slider-->
        
		 <div class="card card-style shadow-xl">        
            <div class="content">
                <h3>Relatório Percurso</h3>
				<p>Este relatório irá demonstrar o percurso realizado pelo veículo, com endereço, velocidade e status de Ignição. Selecione o período desejado. Para períodos maiores, por favor, acesse www.localrast.com.br</p>
            </div>
			
        </div>
       <div class="card card-style text-center">
            <div class="content">
                <p class="mb-0 font-600 color-highlight">Veículo</p>
                <h4><?php echo $veiculo_nome?></h4>
                    
            </div>
        </div>
		<div class="card card-style text-center">
            <div class="content">
                <p class="mb-0 font-600 color-highlight">Distância Percorrida no período:</p>
                <h1><?php echo $totalkm?> Km</h1>
                    
            </div>
        </div>
		<div class="row mb-0">
            <div class="col-6 pe-0 text-center">
                <div class="card card-style">
                    <div class="p-2">
                        <p class="font-600 color-highlight mb-n2">Tempo Parado:</p>
                        <h4 class="pt-2"><?php echo $total_parado?></h4>
                        
                    </div>
                </div>
            </div>
            <div class="col-6 ps-0 text-center">
                <div class="card card-style">
                    <div class="p-2">
                        <p class="font-600 color-highlight mb-n2">Em Movimento:</p>
                        <h4 class="pt-2"><?php echo $total_movimento?></h4>
                    </div>
                </div>
            </div>
        </div>
		<button onclick="abrir();" type="button" class="btn btn-full btn-m bg-blue2-dark font-600 rounded-s" style="width:100%"><i class="fas fa-map-marked-alt"></i> Ver Percurso no Mapa</button><br>
		
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
													

									<div class="card card-style">
										<div class="content">
											<p class="mb-0 font-600 color-highlight"><i class="fas fa-clock"></i> <?php echo $data_pos?></p>
											<h5><i class="fas fa-map-marker-alt"></i> <?php echo $endereco; ?></h5>
											<i class="fas fa-tachometer-alt"></i> <?php echo $veloc1; ?><br>
											<?php echo $ign3; ?>
										</div>
									</div>
									
									
									
									<?php }}?>
							</div>
						</div>
	
		<input type="hidden" id="data_ini" value="<?php echo $data_inicial ?>">
		<input type="hidden" id="data_fin" value="<?php echo $data_final ?>">
		<input type="hidden" id="device_id" value="<?php echo $deviceid ?>">
		<input type="hidden" id="agrupar" value="<?php echo $agrupar ?>">		
		<input type="hidden" id="id_push" value="<?php echo $id_push?>">		
		<input type="hidden" id="id_relatorio" value="<?php echo $id_relatorio?>">
	

        <!-- footer and footer card-->
        
    </div>    
    <!-- end of page content-->
    

	

	
	<div id="aguarde" class="menu menu-box-modal rounded-m" 
         data-menu-height="120" 
         data-menu-width="310">
        <h1 class="text-center mt-3 pt-1"><i class="fa fa-sync fa-spin mr-3 fa-2x"></i></h1>
        
        <p class="boxed-text-l">
            Por favor, aguarde...
        </p>
    </div>
    
    <div id="menu-share" 
         class="menu menu-box-bottom menu-box-detached rounded-m" 
         data-menu-load="menu-share.html"
         data-menu-height="420" 
         data-menu-effect="menu-over">
    </div>    
    
    <div id="menu-highlights" 
         class="menu menu-box-bottom menu-box-detached rounded-m" 
         data-menu-load="menu-colors.html"
         data-menu-height="510" 
         data-menu-effect="menu-over">        
    </div>
    
    <div id="menu-main"
         class="menu menu-box-left menu-box-detached rounded-m"
         data-menu-width="300"
         data-menu-load="menu-main.php?id=<?php echo $id_push?>"
         data-menu-active="nav-starters"
         data-menu-effect="menu-over">  
    </div>
    


    
</div>    


<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript" src="scripts/bootstrap.min.js"></script>
<script type="text/javascript" src="scripts/custom.js"></script>

<script>
	function carregar(){
		$('#aguarde').showMenu();
		
		var device_id = document.getElementById("deviceid").value;
		var data_ini = document.getElementById("data_inicial").value;
		var id_push = document.getElementById("id_push").value;
		location.href = "relatorio_percurso1.php?deviceid="+device_id+"&data_inicial="+data_ini+"&id_push="+id_push;
	}
function carregar2(){
	$('#aguarde').showMenu();
	$('#menu-main').hideMenu();
}

function abrir(){
	
	$('#aguarde').showMenu();
	
	var device_id = document.getElementById("device_id").value;
	var data_ini = document.getElementById("data_ini").value;
	var data_fin = document.getElementById("data_fin").value;
	var id_relatorio = document.getElementById("id_relatorio").value;
	var id_push = document.getElementById("id_push").value;
	location.href = "mapa_device.php?id_relatorio="+id_relatorio+"&deviceid="+device_id+"&data_inicial="+data_ini+"&data_final="+data_fin+"&id_push="+id_push;
}
</script>

</body>
