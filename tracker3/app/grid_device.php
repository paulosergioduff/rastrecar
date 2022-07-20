
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
<style>
#floating-panel {
  position: absolute;
  top: 10px;
  left: 10px;
  z-index: 5;
  background-color:  rgb(255, 255, 255, 0);
  padding: 5px;
  text-align: center;
  font-family: 'Roboto','sans-serif';
  line-height: 30px;
  padding-left: 10px;
}
#floating-panel2 {
  position: absolute;
  top: 1.5%;
  left: 3%;
  z-index: 5;
  background-color:  rgb(255, 255, 255, 0);
  padding: 5px;
  text-align: center;
  font-family: 'Roboto','sans-serif';
  line-height: 30px;
  padding-left: 10px;
}
#floating-panel3 {
  position: absolute;
  top: 9%;
  left: 3%;
  z-index: 5;
  background-color:  rgb(255, 255, 255, 0);
  padding: 5px;
  text-align: center;
  font-family: 'Roboto','sans-serif';
  line-height: 30px;
  padding-left: 10px;
}
#floating-panel4 {
  position: absolute;
  top: 160px;
  left: 10px;
  z-index: 5;
  background-color:  rgb(255, 255, 255, 0);
  padding: 5px;
  text-align: center;
  font-family: 'Roboto','sans-serif';
  line-height: 30px;
  padding-left: 10px;
}
#accordionExample {
  position: absolute;
  bottom: 10px;
  left: 0px;
  z-index: 999;
  background-color:  rgb(255, 255, 255, 0);
  padding: 5px;
  text-align: center;
  font-family: 'Roboto','sans-serif';
  line-height: 30px;
  padding-left: 10px;
  width:98%;
}
#compart {
  position: absolute;
  top: 16.5%;
  left: 3%;
  z-index: 5;
  background-color:  rgb(255, 255, 255, 0);
  padding: 5px;
  text-align: center;
  font-family: 'Roboto','sans-serif';
  line-height: 30px;
  padding-left: 10px;
}
</style>
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
//include_once("conexao.php");
//include_once("include/global.php");


$id_cliente_login = $_GET['id'];
$deviceid = $_GET['deviceid'];

$data_limite = date('Y-m-d H:i');
$data_limite = date('Y-m-d H:i', strtotime('+24 hour', strtotime($data_limite)));

$link = 'id_device='.$deviceid.'&d='.$data_limite.'';

$link_base = base64_encode($link);

$id_empresa = '1';

$chave_google = mysqli_query($conn,"SELECT * FROM api_google ORDER BY id DESC LIMIT 1");
	if(mysqli_num_rows($chave_google) > 0){
while ($resp_google = mysqli_fetch_assoc($chave_google)) {
$chave	 = 	$resp_google['chave'];

	}}


$dados_empresa = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='$id_empresa'");
	if(mysqli_num_rows($dados_empresa) > 0){
while ($resp_empresa = mysqli_fetch_assoc($dados_empresa)) {
$nome_fantasia	 = 	$resp_empresa['nome_fantasia'];
$whats	 = 	$resp_empresa['whats'];
	}}
	
  $cons_user1 = mysqli_query($conn,"SELECT * FROM usuarios_push WHERE id_push='$id_cliente_login' ");
	if(mysqli_num_rows($cons_user1) > 0){
while ($resp_user1 = mysqli_fetch_assoc($cons_user1)) {
$tipo = 	$resp_user1['tipo'];
$id_usuarios = $resp_user1['id_usuarios'];

}}	

$cons_user = mysqli_query($conn,"SELECT * FROM usuarios WHERE id_usuarios='$id_usuarios' ");
	if(mysqli_num_rows($cons_user) > 0){
while ($resp_user = mysqli_fetch_assoc($cons_user)) {
$nome_user = 	$resp_user['nome'];
$email_user = 	$resp_user['email'];
$permite_bloqueio = 	$resp_user['permite_bloqueio'];
	}}
	
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
				if($category == 'car'){
					$tipo_veiculo = '<font style="font-size:26px"><i class="fas fa-car" title="Automóvel"></i></font>';
				}
				else if($category == 'motorcycle'){
					$tipo_veiculo = '<font style="font-size:26px"><i class="fas fa-motorcycle" title="Motocicleta"></i></font>';
				} 
				else if($category == 'pickup'){
					$tipo_veiculo = '<font style="font-size:26px"><i class="fas fa-pickup" title="Pick-up"></i></font>';
				}
				
				
				$cons_cliente = mysqli_query($conn,"SELECT * FROM tc_positions WHERE id='$positionid' ORDER BY id DESC");
					if(mysqli_num_rows($cons_cliente) > 0){
				while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
				$address = 	$resp_cliente['address'];
				$devicetime = 	$resp_cliente['devicetime'];
				$latit = 	$resp_cliente['latitude'];
				$longit = 	$resp_cliente['longitude'];
				
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
				
					$address1 = explode(',', $address);
					$result = count($address1);
					
					$estado_n = $result -1;
					$estado = $address1[$estado_n];
					$rua = $address1[0];
					$cidade_n = $result -4;
					$cidade = $address1[$cidade_n];
					
					

					if($estado = 'Rio Grande do Sul'){
						$uf = 'RS';
					}
					
					$address_db = ''.$rua.' - '.$cidade.' / '.$uf.'';
				
				
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
				$km = '<button type="button" class="btn btn-info" style="font-size:13px; top:0; width:auto;" title="Hodometro: '.$total_km.' KM"><i class="fas fa-road" title="Hodometro: '.$total_km.' KM"></i></button>';
				if (is_bool($ignicao)) $ignicao ? $ignicao = "true" : $ignicao = "false";
				else if ($ignicao !== null) $ignicao = (string)$ignicao;
				
				$cons_conexao = mysqli_query($conn,"SELECT * FROM tc_events WHERE deviceid='$id_device' ORDER BY id DESC LIMIT 1");
					if(mysqli_num_rows($cons_conexao) > 0){
				while ($resp_conexao = mysqli_fetch_assoc($cons_conexao)) {
				$status_conexao = 	$resp_conexao['type'];
				$servertime = 	$resp_conexao['eventtime'];
				
				$block = '<button type="button" id="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" style="font-size:13px; top:0; width:auto;"><i class="fas fa-lock-open" title="Desbloqueado"></i></button>';
				
				
				
				if($status_conexao == 'deviceOffline'){
					$conect = '<button type="button"  class="btn btn-danger" style="font-size:13px; top:0; width:auto;" title="Desconetado a '.$inter.'"><i class="fas fa-wifi" title="Desconetado a '.$inter.'"></i></button>';
				} else {
					$conect = '<button type="button" class="btn btn-success" style="font-size:13px; top:0; width:auto;" title="Conectado"><i class="fas fa-wifi" title="Conectado"></i></button>';
				}
				
				if($ignicao == 'true' && $speed >= 6){
					$ign = '<button type="button" class="btn btn-success" style="font-size:13px; top:0; width:auto;" title="Ignição Ligada"><i class="fas fa-key" title="Ignição Ligada"></i></button>';
					$apeed1 = '<button type="button" class="btn btn-info" style="font-size:13px; top:0; width:auto;"><i class="fas fa-tachometer-alt"></i> <b>'.$speed.' km/h</b></button>';
				} else if ($ignicao == 'true' && $speed <= 5){
					$ign = '<button type="button" class="btn btn-warning" style="font-size:13px; top:0; width:auto;" title="Ignição Ligada"><i class="fas fa-key" title="Ignição Ligada"></i></button>';
					$apeed1 = '<button type="button" class="btn btn-info" style="font-size:13px; top:0; width:auto;"><i class="fas fa-tachometer-alt"></i> <b>'.$speed.' km/h</b></button>';					
				} else {
					$ign = '<button type="button" class="btn btn-dark" style="font-size:13px; top:0; width:auto;" title="Ignição Desligada"><i class="fas fa-key" title="Ignição Desligada"></i></button>';
					$apeed1 = '<button type="button" class="btn btn-info" style="font-size:13px; top:0; width:auto;"><i class="fas fa-tachometer-alt"></i> <b>0 km/h</b></button>';					
				}
				
				$cons_veiculo = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE deviceid='$id_device' ");
					if(mysqli_num_rows($cons_veiculo) > 0){
				while ($resp_veiculo = mysqli_fetch_assoc($cons_veiculo)) {
				$placa = 	$resp_veiculo['placa'];
				$bloqueio = 	$resp_veiculo['bloqueio'];
				$alarme_veic = 	$resp_veiculo['alarme'];
				$status_alarme = 	$resp_veiculo['status_alarme'];
				$marca_veiculo = 	$resp_veiculo['marca_veiculo'];
				$modelo_veiculo = 	$resp_veiculo['modelo_veiculo'];
				$modelo_equip = 	$resp_veiculo['modelo_equip'];
				$odometro = 	$resp_veiculo['odometro'];
				
				if($bloqueio == 'SIM'){
					$block = '<button type="button" class="btn btn-danger" style="font-size:13px; top:0; width:auto;" title="BLOQUEADO"><i class="fas fa-lock" title="BLOQUEADO"></i></button>';
					$block2 = '<i class="fa fa-lock-open"></i> Desbloquear';
					$block3 = 'bloqueado';
					$block4 = 'DESBLOQUEIO';
					$block6 = 'DESBLOQUEIO';
					$block5 = '<button type="button" class="btn btn-success"  data-toggle="modal" data-target="#bloqueio" title="DESBLOQUEAR"><i class="fas fa-lock-open" title="DESBLOQUEAR"></i> DESBLOQUEAR</button>';
				} else if($bloqueio == 'NAO'){
					$block = '<button type="button" class="btn btn-success" style="font-size:13px; top:0; width:auto;" title="Desbloqueado"><i class="fas fa-lock-open" title="Desbloqueado"></i></button>';
					$block2 = '<i class="fa fa-lock"></i> Bloquear';
					$block3 = 'desbloqueado';
					$block4 = 'BLOQUEIO';
					$block5 = '<button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#bloqueio" title="BLOQUEAR"><i class="fas fa-lock" title="BLOQUEAR"></i> BLOQUEAR</button>';
				} 
				
				if($alarme_veic == 'SIM' && $status_alarme == 'ON'){
					$botao_alarme = '<button type="button" class="btn btn-warning" style="width:100%" data-toggle="modal" data-target="#alarme_veiculo1"><i class="fas fa-bell" title="DESATIVAR ALARME"></i> Desativar Alarme</button>';
					$status_alarme1 = 'Deseja desativar o alarme do veículo?';
					$status_alarme2 = 'DESATIVAR';
				} else if($alarme_veic == 'SIM' && $status_alarme == 'OFF'){
					$botao_alarme = '<button type="button" class="btn btn-info" style="width:100%" data-toggle="modal" data-target="#alarme_veiculo1" ><i class="far fa-bell"></i> Ativar Alarme</button>';
					$status_alarme1 = 'Deseja Ativar o alarme do veículo?';
					$status_alarme2 = 'ATIVAR';
				} else {
					$botao_alarme = '';
				}
				
			}}}}}}}}
			
		$cons_ancora = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE deviceid = '$deviceid'");
					if(mysqli_num_rows($cons_ancora) > 0){
				while ($resp_anc = mysqli_fetch_assoc($cons_ancora)) {
				$ancora = 	$resp_anc['ancora'];
				$geofenceid = 	$resp_anc['geofenceid'];	
				
				$sql1 = mysqli_query($conn, "SELECT * FROM tc_geofences WHERE id='$geofenceid'");
			if(mysqli_num_rows($sql1) > 0){
				while ($resp = mysqli_fetch_assoc($sql1)) {
				$area = 	$resp['area'];
				$posicao = strpos($area,"(-");
				$resultado = substr($area,$posicao);
				$area = str_replace('(', '', $resultado);
				$area = str_replace(')', '', $area);
				$area = str_replace(',', '', $area);
				$area = str_replace(' ', ',', $area);
				$area1 = explode(",", $area);
				$anc_lat = $area1[0];
				$anc_long = $area1[1]; 	
				$anc_raio = $area1[2];				
					}}
					
			}}
			
			if($ancora == 'ON'){
				$latitude_ancora = $anc_lat;
				$longitude_ancora = $anc_long;
				$raio_ancora = $anc_raio;
				$info_modal = 'O veiculo está com Âncora ativada.<br>Deseja desativar?';
				$link_ancora = '<a href="comandos/del_ancora.php?deviceid='.$deviceid.'&geofenceid='.$geofenceid.'&id='.$id_push.'&nome_user='.$nome_user.'">';
			} else {
				$latitude_ancora = $latit;
				$longitude_ancora =  $longit;
				$raio_ancora = '0.5';
				$info_modal = 'Deseja ativar a Âncora para o veículo?';
				$link_ancora = '<a href="comandos/ancora.php?deviceid='.$deviceid.'&geofenceid='.$geofenceid.'&id='.$id_push.'&nome_user='.$nome_user.'">';
			}
		
		
		$cons_cerca = mysqli_query($conn,"SELECT * FROM tc_events WHERE type='geofenceEnter' AND deviceid='$deviceid' ORDER BY id DESC LIMIT 1");
		if(mysqli_num_rows($cons_cerca) > 0){
			while ($row_ev = mysqli_fetch_assoc($cons_cerca)) {
				$deviceid = $row_ev['deviceid'];
				$horario_alarme = $row_ev['eventtime'];
				$type = $row_ev{'type'};
				$geofenceid = $row_ev['geofenceid'];
				$id_unico = $row_ev['id'];
				
				$sql11 = mysqli_query($conn, "SELECT * FROM tc_geofences WHERE id='$geofenceid'");
					if(mysqli_num_rows($sql11) > 0){
						while ($resp1 = mysqli_fetch_assoc($sql11)) {
						$name_cerca1 = $resp1['name'];
						$description1 = $resp1['description'];
						$area1 = 	$resp1['area'];
						$posicao1 = strpos($area1,"(-");
						$resultado1 = substr($area1,$posicao1);
						$area1 = str_replace('(', '', $resultado1);
						$area1 = str_replace(')', '', $area1);
						$area1 = str_replace(',', '', $area1);
						$area1 = str_replace(' ', ',', $area1);
						$area1 = explode(",", $area1);
						$anc_lat1 = $area1[0];
						$anc_long1 = $area1[1]; 	
						$anc_raio1 = $area1[2];		

						$latitude_cerca = $anc_lat1;
						$longitude_cerca = $anc_long1;
						$raio_cerca = $anc_raio1;
							}}
							
							

		}}
			
		
		if($permite_bloqueio == 'SIM'){
			$botao_bloqueio = '<div class="row">
									<div class="col-6 text-center">
										<button type="button" class="btn btn-danger shadow-0" style="width:100%" data-toggle="modal" data-target="#bloqueio"><i class="fas fa-lock"></i> Bloquear</button>
									</div>
									<div class="col-6 text-center">
										<button type="button" class="btn btn-success shadow-0" style="width:100%" data-toggle="modal" data-target="#desbloqueio"><i class="fas fa-lock-open"></i> Desbloquear</button>
									</div>
								</div><br>';
		}
		if($permite_bloqueio != 'SIM'){
			$botao_bloqueio = '';
		}
?>
                    <main id="js-page-content" role="main" class="page-content">
					
						<div class="row" >
						<div class="col-md-12">
						<input type="hidden" value="http://rastreiamaisbrasil.com.br/tracker3/manager/posicao.php?p=<?php echo $link_base?>" id="flink">
						 <input type="hidden" name="id" id="id" value="<?php echo $id_cliente_login?>">
						 <input type="hidden" name="deviceid" id="deviceid" value="<?php echo $deviceid?>">
						 <input type="hidden" value="<?php echo $latitude_ancora?>" id="latitude_ancora">
						<input type="hidden" value="<?php echo $longitude_ancora?>" id="longitude_ancora">
						<input type="hidden" value="<?php echo $raio_ancora?>" id="raio_ancora">	
						<input type="hidden" value="<?php echo $ancora?>" id="anc_raio">
							<input type="hidden" value="<?php echo $name_cerca1?>" id="tipo_cerca">	
							<input type="hidden" value="<?php echo $ancora?>" id="ancora_on">
							<div id="floating-panel2">				
								<button type="button" onClick="setSatellite();" class="btn btn-dark btn-icon" style="width:45px; height:45px; " title="Satélite"><i class="fas fa-satellite" title="Satélite"></i></button>							
							</div>
							<div id="floating-panel3">				
								<a href="https://www.google.com/maps?layer=c&cbll=<?php echo $latit?>,<?php echo $longit?>"><button type="button" style="width:45px; height:45px; " class="btn btn-dark btn-icon" title="Street View" data-toggle="tooltip" data-offset="0,10" data-original-title="Street View"><i class="fas fa-street-view"></i></button></a>						
							</div>
							<div id="compart">				
								<a href="#" data-toggle="modal" data-target="#compartilhar"><button type="button" onClick="gerar_link()" class="btn waves-effect waves-primary btn-primary" style="width:45px; height:45px; "><i class="fas fa-share-alt"></i></button></a>						
							</div>
						<div id="map" style=" height: 88vh;"></div>
						</div>
					</div>	
                       
					 <div class="accordion" id="accordionExample">
					 <div class="card" style="border:#999 1px solid;">
						<div class="card-header" id="headingOne">
							<a href="javascript:void(0);" class="card-title" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								<div id="top_veiculo"></div>
								<span class="ml-auto">
									<span class="collapsed-reveal align-items-center">
										<i class="fas fa-chevron-circle-down text-info fa-2x"></i><br>Opções
									</span>
									<span class="collapsed-hidden align-items-center">
										<i class="fas fa-chevron-circle-up text-info fa-2x"></i><br>Opções
									</span>
								</span>
							</a>
						</div>
						<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
							<div class="card-body">
								<div class="row">
									<div class="col-12">
										<h3><?php echo $placa?> - <?php echo $marca_veiculo?>/<?php echo $modelo_veiculo?></h3>
									</div>
								</div>
								<hr style="border:#CCC 1px dashed">
								<div class="row">
									<div class="col-12">
										<div id="informacoes"></div>
									</div>
								</div>
								<hr style="border:#CCC 1px dashed">
								<?php echo $botao_bloqueio?>
								<div class="row">
									<div class="col-6 text-center">
										<button type="button" class="btn btn-info shadow-0" style="width:100%"  data-toggle="modal" data-target="#ancora"><i class="fas fa-anchor"></i> Âncora</button>
									</div>
									<div class="col-6 text-center">
										<button type="button" class="btn btn-info shadow-0" style="width:100%" data-toggle="modal" data-target="#set_odometro"><i class="fas fa-digital-tachograph"></i> Odômetro</button>
									</div>
								</div><br>
								<div class="row">
									<div class="col-6 text-center">
										<a href="relatorio_percurso.php?id=<?php echo $id_push?>&deviceid=<?php echo $deviceid?>"><button type="button" class="btn btn-dark shadow-0" style="width:100%" data-toggle="modal" data-target="#carregar"><i class="fas fa-road"></i> Percurso</button></a>
									</div>
									<div class="col-6 text-center">
										<a href="relatorio_eventos.php?id=<?php echo $id_push?>&deviceid=<?php echo $deviceid?>"><button type="button" class="btn btn-dark shadow-0" style="width:100%"><i class="fas fa-flag"></i> Eventos</button></a>
									</div>
								</div><br>
								<div class="row">
									<div class="col-6 text-center">
										<a href="alertas.php?id=<?php echo $id_push?>&deviceid=<?php echo $deviceid?>"><button type="button" class="btn btn-dark shadow-0" style="width:100%"><i class="fas fa-bell"></i> Habilitar Alertas</button></a>
									</div>
									<div class="col-6 text-center">
										<?php echo $botao_alarme?>
									</div>
								
									<input type="hidden" value="<?php echo $deviceid?>" id="deviceid1" name="deviceid1">
								</div><br>
							</div>
						</div>
					</div>
					</div>	
                    </main>
					
					
					<div class="modal fade" id="compartilhar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered modal-lg">
						<div class="modal-content">
							<div class="modal-header bg-primary text-white">
								<h3 class="modal-title" id="myLargeModalLabel" style="color:#FFF;">COMPARTILHAR POSIÇÃO</h3>
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							</div>
							<div class="modal-body">
								<div class="row">
									<div class="col-lg-8">
									<p>O link para compatilhamento será válido por 24 horas.</p>
									</div>
								</div>
								<div class="row align-items-center text-left">
									<div class="col-sm-12">
										<div class="row align-items-center text-left">
											<div class="col-auto">
											<input type="text" name="url_link" id="url_link" class="form-control" style="width:90%">
											</div>
											<div class="col p-l-0">
												<button type="button" class="btn btn-primary btn-sm" onClick="copiarTexto()">Copiar</button>
											</div>
										</div>
									</div>
									
								</div>
								<script>
								  function copiarTexto() {
									var textoCopiado = document.getElementById("url_link");
									textoCopiado.select();
									document.execCommand("Copy");
									
								  }
								</script>
							</div>
							<div class="modal-footer">
								 <button type="button" class="btn btn-dark btn-sm" data-dismiss="modal">Fechar</button>
								 
							</div>
						</div>
					</div>
				</div>
					
					
					<!-------- MODAL BLOQUEIO --->
					<div class="modal fade example-modal-centered-transparent" id="bloqueio" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-transparent" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title text-white">
										<i class="fas fa-lock"></i> BLOQUEIO
										<small class="m-0 text-white opacity-70">
											Deseja efetuar o bloqueio do veículo?
										</small>
									</h4>
									<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true"><i class="fal fa-times"></i></span>
									</button>
								</div>
								<div class="modal-body">
									...
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
									<a href="comandos/comandos.php?deviceid=<?php echo $deviceid?>&id=<?php echo $id_push?>&nome_user=<?php echo $nome_user?>&t=BLOQUEIO&model=<?php echo $modelo_equip?>"><button type="button" class="btn btn-default" data-toggle="modal" data-target="#carregar">Confirmar</button><a/>
								</div>
							</div>
						</div>
					</div>
					 <!-------- FIM MODAL BLOQUEIO --->
					 
					 <!-------- MODAL alarme --->
					<div class="modal fade example-modal-centered-transparent" id="alarme_veiculo1" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-transparent" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title text-white">
										<i class="fas fa-lock"></i> ALARME
										<small class="m-0 text-white opacity-70">
											<?php echo $status_alarme1?>
										</small>
									</h4>
									<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true"><i class="fal fa-times"></i></span>
									</button>
								</div>
								<div class="modal-body">
									...
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
									<a href="comandos/alarme.php?deviceid=<?php echo $deviceid?>&id=<?php echo $id_push?>&nome_user=<?php echo $nome_user?>&t=BLOQUEIO&model=<?php echo $modelo_equip?>"><button type="button" class="btn btn-default" data-toggle="modal" data-target="#carregar">Confirmar</button><a/>
								</div>
							</div>
						</div>
					</div>
					 <!-------- FIM MODAL alarme --->
					 
					 
					 <!-------- MODAL DESBLOQUEIO --->
					<div class="modal fade example-modal-centered-transparent" id="desbloqueio" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-transparent" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title text-white">
										<i class="fas fa-lock-open"></i> DESBLOQUEIO
										<small class="m-0 text-white opacity-70">
											Deseja efetuar o desbloqueio do veículo?
										</small>
									</h4>
									<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true"><i class="fal fa-times"></i></span>
									</button>
								</div>
								<div class="modal-body">
									...
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
									<a href="comandos/comandos.php?deviceid=<?php echo $deviceid?>&id=<?php echo $id_push?>&nome_user=<?php echo $nome_user?>&t=DESBLOQUEIO&model=<?php echo $modelo_equip?>"><button type="button" class="btn btn-default" data-toggle="modal" data-target="#carregar">Confirmar</button></a>
								</div>
							</div>
						</div>
					</div>
					 <!-------- FIM MODAL DESBLOQUEIO --->
					 
					 
					  <!-------- MODAL ATIVAR ANCORA --->
					<div class="modal fade example-modal-centered-transparent" id="ancora" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-transparent" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title text-white">
										<i class="fas fa-anchor"></i> ÂNCORA
										<small class="m-0 text-white opacity-70">
											<?php echo $info_modal?>
										</small>
									</h4>
									<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true"><i class="fal fa-times"></i></span>
									</button>
								</div>
								<div class="modal-body">
									...
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
									<?php echo $link_ancora?><button type="button" class="btn btn-default" data-toggle="modal" data-target="#carregar">Confirmar</button></a>
								</div>
							</div>
						</div>
					</div>
					 <!-------- FIM MODAL ATIVAR ANCORA --->
					 
					 <!-------- MODAL ODOMETRO --->
					 
					<form action="enviar_odometro.php" method="post">
					<div class="modal fade" id="set_odometro" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-lg">
							<div class="modal-content">
								<div class="modal-header bg-info text-white">
									<h4 class="modal-title" id="myLargeModalLabel" style="color:#FFF;"><i class="fas fa-digital-tachograph"></i> ODÔMETRO</h4>
									<button type="button" class="close text-white" data-dismiss="modal" aria-hidden="true">×</button>
								</div>
								<div class="modal-body">
									<div class="row">
										<div class="col-12 text-center">
											Odômetro Virtual Atual:<br>
											<h4><span class="badge" style="background-color:#000; color:#FFF"><?php echo $odometro?> Km</span></h4>
										</div>
									</div>
									<hr style="border:#999 1px dashed">
									<div class="row">
										<div class="col-12 text-center">
											Novo Odômetro:<br>
											<input type="text" class="form-control mx-auto p-2" name="novo_odomento" id="novo_odomento" value="0,00" style="width:40%; border:#999 1px solid; text-align: center" onkeyup="k(this);">
											<input type="hidden"  name="deviceid_5" id="deviceid_5" value="<?php echo $deviceid?>">
											<input type="hidden"  name="id_cliente_5" id="id_cliente_5" value="<?php echo $id_push?>">
										</div>
									</div>
								</div>
								<div class="modal-footer">
									 <button type="button" class="btn btn-dark" data-dismiss="modal">Fechar</button>
									 <button type="submit" class="btn btn-info" data-toggle="modal" data-target="#carregar">Alterar</button>
								</div>
							</div>
						</div>
					</div>
					</form>
					 <!-------- FIM MODAL ODOMETRO --->
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
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
		
			<?php
		$cons_token = mysqli_query($conn,"SELECT * FROM chaves_maps ORDER BY id DESC LIMIT 1");
			if(mysqli_num_rows($cons_token) > 0){
		while ($resp_token = mysqli_fetch_assoc($cons_token)) {
		$token = 	$resp_token['chave'];
			}}
		?>
      
        <script src="/tracker3/app-assets/js/vendors.bundle.js"></script>
        <script src="/tracker3/app-assets/js/app.bundle.js"></script>
        <script src="/tracker3/app-assets/js/datagrid/datatables/datatables.bundle.js"></script>

<script src='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css' rel='stylesheet' />

  <script>
function gerar_link() {
  var valor = document.getElementById("flink").value;
  $.getJSON( "https://is.gd/create.php?callback=?", {
    url: valor,
    format: "json"
}).done(function( data ) {
    let novolink = data.shorturl;
	console.log(novolink);
	if(novolink!==undefined)
	$("#url_link").val(novolink);
	else $("#url_link").val("Erro ao gerar link");
});
}
</script>
<script>

var deviceid = document.getElementById("deviceid").value;
var latitude_ancora = document.getElementById("latitude_ancora").value;
var longitude_ancora = document.getElementById("longitude_ancora").value;
var raio_ancora = document.getElementById("raio_ancora").value;
var tipo_cerca = document.getElementById("tipo_cerca").value;
var ancora_on = document.getElementById("ancora_on").value;





	mapboxgl.accessToken = 'pk.eyJ1IjoicmFzdHJlYW1lbnRvamMiLCJhIjoiY2tsNmxuNDF5MDEwcjJwbm95cGVpeXhuNCJ9.T5AnJGLIVwj02mjOzz1Oaw';
		

function downloadUrl(url, callback) {
  var request = window.ActiveXObject ?
  new ActiveXObject('Microsoft.XMLHTTP') :
  new XMLHttpRequest;

  request.onreadystatechange = function() {
  if (request.readyState == 4) {
      request.onreadystatechange = function(){};
      callback(request, request.status);
      }
  };

  request.open('GET', url, true);
  request.send(null);
}		

var iconBase = '/tracker2/manager/Imagens/icons/';
 
var map = new mapboxgl.Map({
container: 'map',
style: 'mapbox://styles/mapbox/streets-v11',
center: [<?php echo $longit?>, <?php echo $latit?>],
zoom: 16,
pitch: 65,
bearing: -17.6,
antialias: true
});


if(tipo_cerca != 'ANCORA'){
	map.on('load', function() {
      map.addSource("source_circle_500", {
        "type": "geojson",
        "data": {
          "type": "FeatureCollection",
		  
          "features": [{
            "type": "Feature",
				 
            "geometry": {
              "type": "Point",
              "coordinates": [<?php echo $longitude_cerca?>, <?php echo $latitude_cerca?>]
			 
            },
			"properties": {
				"title": "CERCA <?php echo $name_cerca1?>"
				}
          }]
        }
      });

      map.addLayer({
        "id": "circle500",
        "type": "circle",
        "source": "source_circle_500",
		
        "paint": {
          "circle-radius": {
            stops: [
              [5, 1],
              [15, <?php echo $raio_cerca?>]
            ],
            base: 2
          },
		  "circle-color": "#003366",
          "circle-opacity": 0.2,
	      "circle-stroke-color": "#003366",
		  "circle-stroke-width": 4
        }
      });
	  // Add a symbol layer
		map.addLayer({
			'id': 'source_circle_500',
			'type': 'symbol',
			'source': 'source_circle_500',
			'layout': {
			// get the title name from the source's "title" property
			'text-field': ['get', 'title'],
			'text-font': [
			'Open Sans Semibold',
			'Arial Unicode MS Bold'
			],
			'text-offset': [0, 1.25],
			'text-anchor': 'top'
			}
		});
	  
 });
} 
if(ancora_on == 'ON') {
	map.on('load', function() {
      map.addSource("source_circle_400", {
        "type": "geojson",
        "data": {
          "type": "FeatureCollection",
		  
          "features": [{
            "type": "Feature",
				 
            "geometry": {
              "type": "Point",
              "coordinates": [<?php echo $longitude_ancora?>, <?php echo $latitude_ancora?>]
			 
            },
			"properties": {
				"title": "ANCORA"
				}
          }]
        }
      });

      map.addLayer({
        "id": "circle400",
        "type": "circle",
        "source": "source_circle_400",
		
        "paint": {
          "circle-radius": {
            stops: [
              [5, 1],
              [15, <?php echo $raio_ancora?>]
            ],
            base: 2
          },

          "circle-color": "#006666",
          "circle-opacity": 0.4,
	      "circle-stroke-color": "#006666",
		  "circle-stroke-width": 4
        }
      });
	  // Add a symbol layer
		map.addLayer({
			'id': 'source_circle_400',
			'type': 'symbol',
			'source': 'source_circle_400',
			'layout': {
			// get the title name from the source's "title" property
			'text-field': ['get', 'title'],
			'text-font': [
			'Open Sans Semibold',
			'Arial Unicode MS Bold'
			],
			'text-offset': [0, 1.25],
			'text-anchor': 'top'
			}
		});
		
	  
 });
}




map.on("click", function(e) {
  console.log(e)
  if (e.originalEvent.target) {

  }
    /*
    console.log(marker)

    map.flyTo({
      center: [
         marker.lon,
         marker.lat
      ],
      essential: true // this animation is considered essential with respect to prefers-reduced-motion
      });
    }
    */
});
var tipo_mapbox = 0
function setSatellite(){
  if(tipo_mapbox == 0){
    map.setStyle('mapbox://styles/mapbox/satellite-v9');
    tipo_mapbox = 1
  }else{
    map.setStyle('mapbox://styles/mapbox/streets-v11');
    tipo_mapbox = 0
  }
}

map.addControl(new mapboxgl.FullscreenControl());
map.addControl(new mapboxgl.NavigationControl());
var mapboxMarkers = []








function refreshMap(){
 downloadUrl('resultado_device.php?id_device='+deviceid, (data) => {
    var xml = data.responseXML;
      markers = xml.documentElement.getElementsByTagName('marker');
      

      Array.prototype.forEach.call(markers, function(markerElem) {

          var name = markerElem.getAttribute('name');
          var address = markerElem.getAttribute('address');
          var ign = markerElem.getAttribute('ign');
          var latitude = markerElem.getAttribute('lat');
          var longitude = markerElem.getAttribute('lng');
          var placa = markerElem.getAttribute('placa');
          var data_format = markerElem.getAttribute('data_format')
          var ignicao = markerElem.getAttribute('ignicao')
          var point = [parseFloat(longitude), parseFloat(latitude)]
          
            
            // add marker to map
          var encontrou = false;
          for(let i = 0; i<= mapboxMarkers.length-1; i++){
            if(mapboxMarkers[i].name == name){
                  encontrou = true
                  if(String(ign) != String(mapboxMarkers[i].ign)
                          || String(point) != String(mapboxMarkers[i].point)
                          ){
							map.flyTo({
							center: point,
							speed: 0.2
							});

							let linha = [
								mapboxMarkers[i].point,
								point,
							]
							let ident = Math.random()
							map.addSource('route'+ident, {
								'type': 'geojson',
								'data': {
									'type': 'Feature',
									'properties': {},
									'geometry': {
										'type': 'LineString',
										'coordinates': linha
									}
								}
							});
							map.addLayer({
								'id': 'route'+ident,
								'type': 'line',
								'source': 'route'+ident,
								'layout': {
								'line-join': 'round',
								'line-cap': 'round'
								},
								'paint': {
								'line-color': '#293185',
								'line-width': 4
								}
							});


							var el = document.createElement('div');
							el.className = 'marker';
							el.style.backgroundImage =
							'url(/tracker2/manager/Imagens/icons/'+ign;
							el.style.width = '99px';
							el.style.height = '73px';
							var infotitle = `
								<div style="margin-bottom: 25px">
									<strong><b>${name}</b></strong>
									<br><br>
									<text>${address}</text>
									<br>
									<br>
									
									<text><b>Ignicao:</b> <i class="fas fa-key ${ignicao}"></i> <span class="${ignicao}">${ignicao}</span></text>

								</div>`
							var popup = new mapboxgl.Popup({ closeOnClick: false }).setLngLat([longitude, latitude]).setHTML(infotitle)
							var marker = new mapboxgl.Marker(el).setLngLat([longitude, latitude]).setPopup(popup).addTo(map);
							
							var tagg = {
								name: name,
								point: point,
								ign: ign,
								marcador: marker
							}
                            mapboxMarkers[i].marcador.remove()
							mapboxMarkers = []
							mapboxMarkers.push(tagg)


							
							
							
                          
                  }
              }
          }
		  
		  
		  

		  
          if(encontrou == false){
				
                  var el = document.createElement('div');
                  el.className = 'marker';
                  el.style.backgroundImage =
                  'url(/tracker2/manager/Imagens/icons/'+ign;
                  el.style.width = '99px';
                  el.style.height = '73px';
                  var infotitle = `
                      <div>
                        <strong><b>${name}</b></strong>
                        <br><br>
                        <text>${address}</text>
                        <br>
                        <br>
                       
                        <text><b>Ignicao:</b> <i class="fas fa-key ${ignicao}"></i> <span class="${ignicao}">${ignicao}</span></text>

                      </div>`
                  var popup = new mapboxgl.Popup({ closeOnClick: false }).setLngLat([-96, 37.8]).setHTML(infotitle)
                  var marker = new mapboxgl.Marker(el).setLngLat([longitude, latitude]).setPopup(popup).addTo(map);
                  
                  var tagg = {
                      name: name,
                      point: point,
                      ign: ign,
                      marcador: marker
                  }
                  mapboxMarkers.push(tagg)
          } 
      });
  });
}
refreshMap();
setInterval(() => {
  refreshMap();
}, 5000);
console.log(mapboxMarkers)
	// add markers to map
/*
geojson.features.forEach(function(marker) {
  // create a DOM element for the marker
  var el = document.createElement('div');
  el.className = 'marker';
  el.style.backgroundImage =
  'url(/tracker2/manager/Imagens/icons/car.png';
  el.style.width = marker.properties.iconSize[0] + 'px';
  el.style.height = marker.properties.iconSize[1] + 'px';



  
  // add marker to map
  new mapboxgl.Marker(el)
  .setLngLat(marker.geometry.coordinates)
  .addTo(map);
});
*/
</script>
<script>
	$(document).ready(function () {
		
		$.post('include/grid_device.php?id_device='+deviceid, function(grid_veiculos){
			$("#grid_veiculos").html(grid_veiculos);
			
			
		});
	});
</script>

 <script>
	var intervalo2 = setInterval(function() { $('#top_veiculo').load('include/grid_device1.php?id_device='+deviceid); }, 2000);
</script>
 <script>
	var intervalo3 = setInterval(function() { $('#informacoes').load('include/grid_device2.php?id_device='+deviceid); }, 2000);
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
<script language="javascript">   
function k(i) {
	var v = i.value.replace(/\D/g,'');
	v = (v/100).toFixed(2) + '';
	v = v.replace(".", ",");
	v = v.replace(/(\d)(\d{3})(\d{3}),/g, "$1.$2.$3,");
	v = v.replace(/(\d)(\d{3}),/g, "$1.$2,");
	i.value = v;
}
 </script> 
    </body>
</html>
