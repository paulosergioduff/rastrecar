<?php


include_once("conexao.php");

$cons_empresa = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='1361'");
	if(mysqli_num_rows($cons_empresa) > 0){
while ($resp_empresa = mysqli_fetch_assoc($cons_empresa)) {
$nome_url = $resp_empresa['nome_url'];
$logo = $resp_empresa['logo'];
$texto_rodape = $resp_empresa['texto_rodape'];
$texto_topo = $resp_empresa['texto_topo'];
$cor_sistema = $resp_empresa['cor_sistema'];
	}}

$date = date('Y-m-d');	

$agrupar = 'SIM';

$data_i1 = $_REQUEST['data_inicial'];
$data_ini1 = date('Y-m-d H:i' , strtotime($data_i1));
//$data_i1 = '2020-12-29 06:00:00';

$data_inicial = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_i1)));
$data_inicial_1 = date('d/m/Y H:i' , strtotime($data_i1));


$data_f1 = $_REQUEST['data_final'];
$data_fin1 = date('Y-m-d H:i' , strtotime($data_f1));
//$data_f1 = '2020-12-29 21:00:00';

$data_final = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_f1)));
$data_final_1 = date('d/m/Y H:i' , strtotime($data_f1));




$deviceid = $_REQUEST['veiculo'];
//$deviceid = '178';


$sql = mysqli_query($conn, "SELECT latitude, longitude, attributes FROM tc_positions WHERE deviceid='$deviceid' AND (servertime >= '$data_inicial' AND servertime <= '$data_final') ORDER BY id DESC LIMIT 1");
	if(mysqli_num_rows($sql) > 0){
while ($resp_sql = mysqli_fetch_assoc($sql)) {
		$latitude_final = $resp_sql['latitude'];
		$longitude_final = $resp_sql['longitude'];
		$km_1 = $resp_sql['attributes'];
		$obj_km1 = json_decode($km_1);
		$km_1 = $obj_km1->{'totalDistance'};;
	}}
	
	$sql1 = mysqli_query($conn, "SELECT latitude, longitude, attributes FROM tc_positions WHERE deviceid='$deviceid' AND (servertime >= '$data_inicial' AND servertime <= '$data_final') ORDER BY id ASC LIMIT 1");
	if(mysqli_num_rows($sql1) > 0){
while ($resp_sql1 = mysqli_fetch_assoc($sql1)) {
		$latitude_inicial = $resp_sql1['latitude'];
		$longitude_inicial = $resp_sql1['longitude'];
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
		$tipo_veiculo =  $resp_veic['tipo_veiculo'];
		
}}

if($tipo_veiculo == 'Automovel'){
	$imagem = 'car.png';
}
else if($tipo_veiculo == 'Caminhao'){
	$imagem = 'truck.png';
}
else if($tipo_veiculo == 'PickUp'){
	$imagem = 'car.png';
}
else if($tipo_veiculo == 'Motocicleta'){
	$imagem = 'moto.png';
} else {
$imagem = 'car.png';
}

$cons_cliente = mysqli_query($conn, "SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
if(mysqli_num_rows($cons_cliente) > 0){
while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
		$nome_cliente = $resp_cliente['nome_cliente'];
}}



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

$total_movimento =  ''.$hora_mov.' hora(s) e '.$min_mov.' minutos <br>';
$total_parado = ''.$hora_stop.' hora(s) e '.$min_stop.' minutos';

	
	
	
#------------------------------------------------
#------------------------------------------------
$valor_comb = $_POST['valor_comb'];
$valor_comb = str_replace(".","","$valor_comb");
$valor_comb = str_replace(",",".","$valor_comb");
$km_litro = $_POST['km_litro'];

$consumo = $totalkm / $km_litro;

$valor_gasto = $consumo * $valor_comb;
$valor_gasto1 = number_format($valor_gasto, 2, ",", ".");

?>
<?php
		$cons_token = mysqli_query($conn,"SELECT * FROM chaves_maps ORDER BY id DESC LIMIT 1");
			if(mysqli_num_rows($cons_token) > 0){
		while ($resp_token = mysqli_fetch_assoc($cons_token)) {
		$token = 	$resp_token['chave'];
			}}
		?>
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
           <?php echo $login_padrao?> | Sistema de Gestão Rastreamento
        </title>
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
		<link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/formplugins/select2/select2.bundle.css">
        <!-- Place favicon.ico in the root directory -->
        <link rel="apple-touch-icon" sizes="180x180" href="/tracker3/app-assets/img/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/tracker3/app-assets/img/favicon/favicon-32x32.png">
        <link rel="mask-icon" href="/tracker3/app-assets/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
		<link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/fa-brands.css">
		<link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/fa-solid.css">
		<script src="https://kit.fontawesome.com/a132241e15.js"></script>
		<style>
		#floating-panel {
		  position: absolute;
		  top: 10%;
		  left: 2%;
		  z-index: 9999;
		  background-color:  rgb(255, 255, 255, 0);
		  padding: 5px;
		  text-align: center;
		  font-family: 'Roboto','sans-serif';
		  line-height: 30px;
		  padding-left: 10px;
		}
		</style>
		</head>
    <body class="mod-bg-1 nav-function-fixed" >
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
                <aside class="page-sidebar" style="background-color:#FFF">
                    <div style="background-color:#FFF">
                        <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative">
                           <img src="logos/<?php echo $logo?>" style="width:200px; heigth:auto" alt="SmartAdmin WebApp" aria-roledescription="logo">
                            
                            
                        </a>
                    </div>
                    <?php include('include/sidebar.php')?>
                    
                </aside>
                <!-- END Left Aside -->
                <div class="page-content-wrapper header-function-fixed">
                    <!-- BEGIN Page Header -->
                    <?php include('include/head.php')?>
                    <!-- END Page Header -->
                    <!-- BEGIN Page Content -->
                    <!-- the #js-page-content id is needed for some plugins to initialize -->
                    <main id="js-page-content" role="main" class="page-content">
					
						<div class="row">
                            <div class="col-xl-8">
								<div class="subheader">
									<h1 class="subheader-title">
										<i class='subheader-icon fal fa-road'></i> Relatório de Percurso
										<small>
											Percurso, Km, velocidade...
										</small>
									</h1>
								</div>
							</div>
							<div class="col-xl-4 text-right">
								 <a href="pdf_files/relatorio_percurso.php?data_inicial=<?php echo $data_i1?>&data_final=<?php echo $data_f1?>&deviceid=<?php echo $deviceid?>" target="_blank"><button type="button" class="btn btn-danger btn-sm" style="font-size:14px"><i class="fas fa-file-pdf"></i> PDF</button></a>
								 <button type="button" onclick="imprimir();" class="btn btn-primary btn-sm" style="font-size:14px"><i class="fas fa-print"></i> Imprimir</button>
								  <button type="button" onclick="abrir();" class="btn btn-primary btn-sm" style="font-size:14px"><i class="fas fa-map-marked-alt"></i> Ver no Mapa</button>
							</div>
						</div>
                        
						<div class="row">
							<div class="col-md-4">
								<div class="card mb-2" style="border:#CCC 1px solid;">
									<div class="card-body">
										<div class="d-flex flex-row align-items-center">
											<div class='icon-stack display-3 flex-shrink-0'>
												<i class="fal fa-circle icon-stack-3x opacity-100" style="color:#CD5C5C"></i>
												<i class="fas fas fa-parking icon-stack-1x opacity-100" style="color:#CD5C5C"></i>
											</div>
											<div class="ml-3">
												<strong>
													<span style="font-size:20px;"><?php echo $total_parado?></span>
												</strong>
												<br>
												<b>TEMPO PARADO</b>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="card mb-2" style="border:#CCC 1px solid;">
									<div class="card-body">
										<div class="d-flex flex-row align-items-center">
											<div class='icon-stack display-3 flex-shrink-0'>
												<i class="fal fa-circle icon-stack-3x opacity-100" style="color:#009900"></i>
												<i class="fas fa-route icon-stack-1x opacity-100" style="color:#009900"></i>
											</div>
											<div class="ml-3">
												<strong>
													<span style="font-size:20px;"><?php echo $total_movimento?></span>
												</strong>
												
												<b>TEMPO EM MOVIMENTO</b>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="card mb-2" style="border:#CCC 1px solid;">
									<div class="card-body">
										<div class="d-flex flex-row align-items-center">
											<div class='icon-stack display-3 flex-shrink-0'>
												<i class="fal fa-circle icon-stack-3x opacity-100 color-info-400"></i>
												<i class="fas fas fa-road icon-stack-1x opacity-100 color-info-500"></i>
											</div>
											<div class="ml-3">
												<strong>
													<span style="font-size:20px;"><?php echo $totalkm?> Km</span>
												</strong>
												<br>
												<b>DISTÂNCIA PERCORRIDA</b>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-4">
								<div class="card mb-2" style="border:#CCC 1px solid;">
									<div class="card-body">
										<div class="d-flex flex-row align-items-center">
											<div class='icon-stack display-3 flex-shrink-0'>
												<i class="fal fa-circle icon-stack-3x opacity-100" style="color:#000"></i>
												<i class="fas fas fa-gas-pump icon-stack-1x opacity-100" style="color:#000"></i>
											</div>
											<div class="ml-3">
												<strong>
													<span style="font-size:20px;"><?php echo $consumo?> litros</span>
												</strong>
												<br>
												<b>CONSUMO</b>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="card mb-2" style="border:#CCC 1px solid;">
									<div class="card-body">
										<div class="d-flex flex-row align-items-center">
											<div class='icon-stack display-3 flex-shrink-0'>
												<i class="fal fa-circle icon-stack-3x opacity-100" style="color:#000"></i>
												<i class="fas fa-dollar-sign icon-stack-1x opacity-100" style="color:#000"></i>
											</div>
											<div class="ml-3">
												<strong>
													<span style="font-size:20px;">R$ <?php echo $valor_gasto1?></span>
												</strong>
												<br>
												<b>VALOR GASTO</b>
											</div>
										</div>
									</div>
								</div>
							</div>
							
						</div>
						
                        <form name="forml" id="forml" action="relatorio_percurso1.php" method="post">
                        <div class="row">
                            <div class="col-xl-12">
                                <div id="panel-1" class="panel">
                                    
                                    <div class="panel-container show">
                                        <div class="panel-content">
											 
											<div class="row">
												<div class="col-md-12">
												<input type="hidden" id="data_ini" value="<?php echo $data_ini1 ?>">
												<input type="hidden" id="data_fin" value="<?php echo $data_fin1 ?>">
												<input type="hidden" id="device_id" value="<?php echo $deviceid ?>">
												<input type="hidden" id="agrupar" value="<?php echo $agrupar ?>">
												<b>Período:</b> <?php echo $data_inicial_1?>  até <?php echo $data_final_1?><br>
												<b>Cliente:</b> <?php echo $nome_cliente?><br>
												<b>Veículo:</b> <?php echo $marca_veiculo?>/<?php echo $modelo_veiculo?><br>
												<b>Placa: </b><?php echo $placa?>
												</div>
												
											</div>
											<hr>
											
											<!--<div id="map" style="width:100%; height:500px;"></div>--><br>
											
											<div class="row">
												<div class="col-md-12">
													
													<table class="table table-striped table-bordered table-hover">
														<thead>
															<tr>
																<th>Data/Hora</th>
																<th>Endereço</th>
																<th>Velocidade</th>
																<th>Ignição</th>
																<th></th>
															</tr>
														 </thead>
														<tbody>
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


$cons_events_ini = mysqli_query($conn, "SELECT id FROM tc_positions WHERE deviceid='$deviceid' AND (fixtime >= '$data_inicial' AND fixtime <= '$data_final') ORDER BY id ASC LIMIT 1");
	if(mysqli_num_rows($cons_events_ini) > 0){
		while ($resp_events_ini = mysqli_fetch_assoc($cons_events_ini)) {
		$posicao_ini = $resp_events_ini['id'];
	}}
		
$cons_events_fim = mysqli_query($conn, "SELECT id FROM tc_positions WHERE deviceid='$deviceid' AND (fixtime >= '$data_inicial' AND fixtime <= '$data_final') ORDER BY id DESC LIMIT 1");
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


$cons_posicao = mysqli_query($conn,"SELECT servertime, devicetime, fixtime, id, latitude, longitude, address, speed, attributes FROM tc_positions WHERE deviceid='$deviceid' AND ( id >= '$posicao_inicial' AND id <= '$posicao_final') ORDER BY servertime ASC");
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

$insere_posicao = mysqli_query($conn,"INSERT INTO  posicoes_relatorios (positionid, endereco, servertime, devicetime, fixtime, latitude, longitude, speed, ignicao, movimento, id_relatorio, deviceid, nome_motorista) VALUES ('$positionid', '$address', '$servertime', '$devicetime', '$fixtime', '$latitude', '$longitude', '$speed', '$ign', '$movimento', '$id_relatorio', '$deviceid', '$nome_motorista')");


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
		$nome_motorista = $resp_pos['nome_motorista'];
		
		


		if($ign2 == 'Desligada'){
			$cons_posicao_desl = mysqli_query($conn,"SELECT * FROM posicoes_relatorios WHERE id_relatorio = '$id_relatorio' AND fixtime > '$horario' AND ignicao = 'Ligada' ORDER BY id ASC LIMIT 1");
				
				if(mysqli_num_rows($cons_posicao_desl) > 0){
					while ($resp_posicao_desl = mysqli_fetch_assoc($cons_posicao_desl)) {
					$hora_proximo = $resp_posicao_desl['fixtime'];
					$hora_proximo_br = date('d/m/Y H:i:s', strtotime("$hora_proximo"));
					
					if($hora_proximo < $horario){
						$data_pos = $horario_br;
					} else {
						$data_pos = $horario_br.' até <br>'.$hora_proximo_br;
						
					}
				}}
				$date1 = new DateTime($horario);
				$date2 = new DateTime($hora_proximo);

				// The diff-methods returns a new DateInterval-object...
				$diff = $date2->diff($date1);

				// Call the format method on the DateInterval-object
				$horas = $diff->format('%h horas e %i minutos');
				$velocidade = '0.00';
				$ign3 = '<span style="color:#990000"><i class="fab fa-product-hunt"></i>  PARADA</b></span>';
		}
		
		
		
		
		$str_ign = 'Desligado';
		if($ign2 == 'Ligada'){
			$str_ign = 'Ligada';
			$data_pos = $horario_br;
			$velocidade = $veloc;
			$horas = '';
			if($veloc == 0){
				$ign3 = '<span style="color:#F4A460"><b><i class="fas fa-key"></i> Parado com IGN ligada</b></span>';
			} else {
				$ign3 = '<span style="color:#228B22"><b><i class="fas fa-key"></i> '.$ign2.' em Movimento</b></span>';
			}
		};
		if($agrupar == 'SIM'){
			if($last_ign == 'Desligado' && $str_ign == 'Desligado'){
				continue;
			};
		};
		$last_ign = $str_ign;
		
		

		if($velocidade > $limite_velocidade){
			$alerta = ' ';
			$veloc1 = '<span style="color:#990000"><b>'.$velocidade.' km/h</b></span> <i class="fas fa-exclamation-triangle" style="color:#F4A460"></i>'; 
		}
		if($velocidade <= $limite_velocidade){
			$alerta = ' ';
			$veloc1 = $velocidade.' km/h'; 
		}
		
		if($nome_motorista == ''){
			$motorista = '';
		}
		if($nome_motorista != ''){
			$motorista = '<i class="fas fa-user-tie"></i>  <b>Motorista: '.$nome_motorista.'</b>';
		}
														
													?>
													<tr>
														<td><b><?php echo $data_pos?></b></td>
														<td><i class="fas fa-map-marker-alt"></i> <?php echo $endereco; ?><br><?php echo $motorista?></td>
														<td><?php echo $velocidade; ?> Km/h</td>
														<td><?php echo $ign3; ?><br><b><?php echo $horas?></b></td>
														<td><a href="http://maps.google.com/maps?q=<?php echo $latitude?>,<?php echo $longitude?>&ll=<?php echo $latitude?>,<?php echo $longitude?>&z=17" target="_blank"><button type="button" class="btn btn-dark btn-sm"><i class="fas fa-map-marked-alt"></i></button></a></td>
													</tr>
													<?php }}?>
															</tbody>
													</table>
													 
												</div>
											</div>
                                        <input type="hidden" id="id_relatorio" value="<?php echo $id_relatorio?>">
											
											
											
											
											
											
											
											
											

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						</form>
                    </main>
					
					<!-- DIV Carregar -->
					<div class="modal fade" id="carregar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-sm modal-dialog-centered">
							<div class="modal-content">
								
								<div class="modal-body" id="informacoes">
									<span style="fonta-size:20px"> Aguarde... </span> <img src="/tracker2/Imagens/load.gif" width="40px" height="40px">
								</div>
								
							</div>
						</div>
					</div>	
                    <!-- FIM DIV Carregar -->
					
					<!-- this overlay is activated only when mobile menu is triggered -->
                    <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div> <!-- END Page Content -->
                    <!-- BEGIN Page Footer -->
						<?php include('include/footer.php');?>
                    <!-- END Page Footer -->
                    <!-- BEGIN Shortcuts -->
                   
                </div>
            </div>
        </div>
        <!-- END Page Wrapper -->
        <!-- BEGIN Quick Menu -->
			<?php include('include/quick_menu.php');?>
        <!-- END Quick Menu -->
        <!-- BEGIN Messenger -->
			<?php include('include/messenger.php');?>
        <!-- END Messenger -->
        <!-- BEGIN Page Settings -->
			<?php include('include/settings.php');?>
        <!-- END Page Settings -->
		
		<?php 
				$base64 = $id_relatorio.'@'.$deviceid.'@'.$data_inicial.'@'.$data_final;
				$base64 = base64_encode($base64);
				
				$base64_print = $data_i1.'@'.$data_f1.'@'.$deviceid;
				$base64_print = base64_encode($base64_print)
				
				?>
				<input type="hidden" id="id_relatorio" value="<?php echo $id_relatorio?>">
				<input type="hidden" id="base64" value="<?php echo $base64?>">
				<input type="hidden" id="base64_print" value="<?php echo $base64_print?>">
      
        <script src="/tracker3/app-assets/js/vendors.bundle.js"></script>
        <script src="/tracker3/app-assets/js/app.bundle.js"></script>
        <script src="/tracker3/app-assets/js/formplugins/select2/select2.bundle.js"></script>
<script>
$('#forml').on('submit', function(e){
  $('#carregar').modal('show');
});
</script>   

		<script>
			var device_id = document.getElementById("device_id").value;
			var data_ini = document.getElementById("data_ini").value;
			var data_fin = document.getElementById("data_fin").value;
			var id_relatorio = document.getElementById("id_relatorio").value;
			var base64 = document.getElementById("base64").value;
			var base64_print = document.getElementById("base64_print").value;
		function abrir(){
			
			window.open("http://rastreiamaisbrasil.com.br/tracker3/manager/mapa_rel2.php?id_relatorio="+id_relatorio+"&deviceid="+device_id+"&data_inicial="+data_ini+"&data_final="+data_fin, "minhaJanela", "height=700,width=1000");
		}
		
		function imprimir(){
		window.open("http://rastreiamaisbrasil.com.br/tracker3/manager/imprimir_relatorio.php?c="+base64, "minhaJanela", "height=700,width=1000");
		}

	</script>
</body>
</html>
