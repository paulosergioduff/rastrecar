<?php include('conexao.php');

$cons_usuario20 = mysqli_query($conn,"SELECT * FROM usuarios WHERE id_usuarios='$user_id'");
	if(mysqli_num_rows($cons_usuario20) > 0){
while ($resp_usuario11 = mysqli_fetch_assoc($cons_usuario20)) {
$id_cliente_1 = 	$resp_usuario11['id_cliente'];
	}}
	
$cons_cli10 = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente_1'");
	if(mysqli_num_rows($cons_cli10) > 0){
while ($resp_cor30 = mysqli_fetch_assoc($cons_cli10)) {
$id_cliente_pai_ini = 	$resp_cor30['id_cliente_pai'];

	}}
	
$cons_cli_cor = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente_pai_ini'");
	if(mysqli_num_rows($cons_cli_cor) > 0){
while ($resp_cor = mysqli_fetch_assoc($cons_cli_cor)) {
$cor_sistema1 = 	$resp_cor['cor_sistema'];
$logo1 = 	$resp_cor['logo'];
$login_padrao1 = 	$resp_cor['subdominio'];
$telefone_residencial1 = 	$resp_cor1['telefone_residencial'];
	}}
	
if($id_cliente_pai_ini == 1361){
	$logo = '/tracker/Imagens/logo1.png';
	$cor_sistema = '#14145A';
	$login_padrao = 'RMB';
}

if($id_cliente_pai_ini != 1361){
	$logo = '/tracker3/manager/logos/'.$logo1;
	$cor_sistema = $cor_sistema1;
	$login_padrao = $login_padrao1;

}
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
        <!-- Place favicon.ico in the root directory -->
        <link rel="apple-touch-icon" sizes="180x180" href="/tracker3/app-assets/img/favicon/apple-touch-icon.png">
       <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $logo?>">
        <link rel="mask-icon" href="/tracker3/app-assets/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/datagrid/datatables/datatables.bundle.css">
		<link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/fa-solid.css">
		<link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/statistics/chartjs/chartjs.css">
		<link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/formplugins/select2/select2.bundle.css">
		<script src="https://kit.fontawesome.com/a132241e15.js"></script>
<style>
.Ligada{
color: #08700a;
}
.Desligada{
  color: #bd0202
}
.mapboxgl-popup {
  width: 500px;
}

.mapboxgl-popup-content {
   width: 500px;
}

.mapboxgl-popup-tip{
  margin-bottom: 35px;
}
#botoes {
  position: absolute;
  bottom: 5%;
  right: 3%;
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
    <body class="mod-bg-1 nav-function-fixed header-function-fixed">
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
                           <img src="<?php echo $logo?>" style="width:200px; heigth:auto" alt="SmartAdmin WebApp" aria-roledescription="logo">
                            
                            
                        </a>
                    </div>
                    <?php include('include/sidebar.php')?>
                    
                </aside>
                <!-- END Left Aside -->
                <div class="page-content-wrapper header-function-fixed">
                    <!-- BEGIN Page Header -->
                    <?php include('include/head.php')?>
                    
<?php

$date = date('Y-m-d');

$base64 = $_GET['c'];
$base = base64_decode($base64);
$cliente = explode(":", $base);
$deviceid = $cliente[1];

$data_hora = date('Y-m-d H:i');
$data_limite = date('Y-m-d H:i');
$data_limite = date('Y-m-d H:i', strtotime('+24 hour', strtotime($data_limite)));

$link = 'id_device='.$deviceid.'&d='.$data_limite.'';

$link_base = base64_encode($link);



$result_usuario = "SELECT * FROM tc_devices WHERE id='$deviceid'";
					$resultado_usuario = mysqli_query($conn, $result_usuario);


					//Verificar se encontrou resultado na tabela "usuarios"
					if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
			while($row_usuario = mysqli_fetch_assoc($resultado_usuario)){
				$id_device = $row_usuario['id'];
				$name = $row_usuario['name'];
				$positionid = $row_usuario['positionid'];
				$category = 	$row_usuario['category'];

				
				
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
				$devicetime = 	$resp_cliente['devicetime'];
				$latit = 	$resp_cliente['latitude'];
				$longit = 	$resp_cliente['longitude'];
				
	
				
				
				$speed = $speed * 1.609;
				$speed = round($speed, 2);
				$protocolo = $resp_cliente['protocol'];
				$attributes = $resp_cliente['attributes'];
				$obj = json_decode($attributes);
				$ignicao = $obj->{'ignition'};
				$satelites = $obj->{'sat'};

				if (is_bool($ignicao)) $ignicao ? $ignicao = "true" : $ignicao = "false";
				else if ($ignicao !== null) $ignicao = (string)$ignicao;
				
				
				
				
				

				
				$cons_veiculo = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE deviceid='$id_device' ");
					if(mysqli_num_rows($cons_veiculo) > 0){
				while ($resp_veiculo = mysqli_fetch_assoc($cons_veiculo)) {
				$placa = 	$resp_veiculo['placa'];
				$bloqueio = 	$resp_veiculo['bloqueio'];
				$media_consumo = 	$resp_veiculo['media_consumo'];
				$odometro = 	$resp_veiculo['odometro'];
				$odometro = number_format($odometro, 2, ",", ".");
				$alarme_veic = 	$resp_veiculo['alarme'];
				$status_alarme = 	$resp_veiculo['status_alarme'];
				$imei = 	$resp_veiculo['imei'];
				$chip = 	$resp_veiculo['chip'];
				$operadora = 	$resp_veiculo['operadora'];
				$fornecedor_chip = 	$resp_veiculo['fornecedor_chip'];
				$modelo_equip = 	$resp_veiculo['modelo_equip'];
				$veic_volts = 	$resp_veiculo['volts'];
				$veic_satelite = 	$resp_veiculo['satelite'];
				$veic_gsm = 	$resp_veiculo['gsm'];
				$veic_bateria_interna = 	$resp_veiculo['bateria_interna'];
				$id_cliente = 	$resp_veiculo['id_cliente'];
				$ancora = 	$resp_veiculo['ancora'];
				$geofenceid = 	$resp_veiculo['geofenceid'];	
				$veiculo = 	$placa.' - '.$resp_veiculo['marca_veiculo'].'/'.$resp_veiculo['modelo_veiculo'];	
				
				

				
				

				
			}}}}}}
			
		
				
				
				
				
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
					
			
			
			$cons_cli = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente' ");
					if(mysqli_num_rows($cons_cli) > 0){
				while ($resp_cli = mysqli_fetch_assoc($cons_cli)) {
				$nome_cliente = 	$resp_cli['nome_cliente'];

					}}
			if($ancora == 'ON'){
				$latitude_ancora = $anc_lat;
				$longitude_ancora = $anc_long;
				$raio_ancora = $anc_raio;
				$info_modal = '<p>O veiculo já esta com Âncora ativada.</p><br><p>Deseja destivar?</p>';
				$link_ancora = '<a href="comandos/del_ancora.php?&deviceid='.$deviceid.'&geofenceid='.$geofenceid.'">';
			} else {
			$latitude_ancora = $latit;
				$longitude_ancora =  $longit;
				$raio_ancora = '0.5';
				$info_modal = '<p>A localização do veículo é <b>'.$address.'</b>.</p><br><p>Deseja ancorar neste endereço?</p>';
				$link_ancora = '<a href="comandos/ancora.php?deviceid='.$deviceid.'&geofenceid='.$geofenceid.'">';
			}
		


$cons_cerca = mysqli_query($conn,"SELECT * FROM tc_events WHERE type='geofenceEnter' AND deviceid='$deviceid' ORDER BY id DESC LIMIT 1");
if(mysqli_num_rows($cons_cerca) > 0){
	while ($row_ev = mysqli_fetch_assoc($cons_cerca)) {
		$deviceid = $row_ev['deviceid'];
		$horario_alarme = $row_ev['servertime'];
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




	?>
					 <form name="forml">
                    <main id="js-page-content" role="main" class="page-content">
					
						
                        
						
						<div class="row">
                            <div class="col-xl-5">
                                <div id="panel-1" class="panel" style="border:#CCC 1px solid;">
                                    
                                    <div class="panel-container show">
                                        <div class="panel-content">
											<div class="row">
												<div class="col-md-8">
													<h3><span class="badge" style="background-color:#000; color:#FFF"><b><?php echo $veiculo?></b></span></h3>
												</div>
											</div>
											<div id="grid_veiculos"></div>
											
											
											<hr style="border:#CCC 1px solid;">
											<div class="row">
												<div class="col-md-12">
													<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#comandos_gprs"><i class="fas fa-link"></i> Comandos GPRS</button> 
													
													<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#alertas"><i class="far fa-bell"></i> Últimos Alertas</button> 
												</div>
											</div>
											<input type="hidden" id="ret_bloc1" />
											<input type="hidden" id="ret_bloc2" />
                                        </div>
                                    </div>
                                </div>
                            </div>
							<div class="col-xl-7">
                                <div id="panel-1" class="panel" style="border:#CCC 1px solid;">
                                    <div class="panel-container show">
                                        <div class="panel-content">
											<div id="map" style="height: 80vh;"></div>
											<div id="botoes">
												<nav class="d-none d-sm-block">
													<input type="checkbox" class="menu-open" name="menu-open" id="menu_open" />
													<label for="menu_open" class="menu-open-button ">
														<span class="app-shortcut-icon d-block"></span>
													</label>
													<a href="#" class="menu-item btn" onclick="setSatellite()"  style="background-color:#6959CD" data-toggle="tooltip" data-placement="right" title="Mapa Satélite">
														<i class="fas fa-satellite"></i>
													</a>
													<a href="#" class="menu-item btn" onclick="setMap()"  style="background-color:#4169E1" data-toggle="tooltip" data-placement="right" title="Mapa Normal">
														<i class="fas fa-map-marked-alt"></i>	
													</a>
													<a href="#" class="menu-item btn" onclick="setNoite()" data-toggle="tooltip" data-placement="right" title="Mapa Noturno">
														<i class="far fa-moon"></i>	
													</a>
													<a href="#" class="menu-item btn" style="background-color:#4169E1" data-toggle="modal" data-target="#compartilhar" onClick="gerar_link()">
														<i class="fas fa-share-alt" data-toggle="tooltip" data-placement="right" title="Compartilhar"></i>
													</a>
													<a href="https://www.google.com/maps?layer=c&cbll=<?php echo $latit?>,<?php echo $longit?>" target="_blank" class="menu-item btn" style="background-color:#4169E1" data-toggle="tooltip" data-placement="right" title="Ver no Google Street">
														<i class="fas fa-street-view"></i>
													</a>
													<a href="#" class="menu-item btn" data-action="app-fullscreen" data-toggle="tooltip" data-placement="right" title="Tela Cheia">
														<i class="fal fa-expand"></i>
													</a>
												</nav>
											</div>
											
											
											
											
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
					
					<!-- ----- MODAL COMANDOS --->
					<div class="modal fade default-example-modal-right" id="comandos_gprs" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog modal-dialog-right">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title h4">COMANDOS GPRS</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true"><i class="fal fa-times"></i></span>
									</button>
								</div>
								<div class="modal-body">
									
									<div class="card mb-5" style="border:#ccc 1px solid;">
										<div class="card-body p-3">
											<h4><span class="badge badge-dark">ENVIOS DE COMANDOS GPRS</span></h4><br>
											<div class="row">
												<div class="col-md-6">
													<button type="button" onclick="bloqueio();" class="btn btn-danger shadow-0" style="width:100%"><i class="fas fa-lock"></i> Bloquear</button>
												</div>
												<div class="col-md-6">
													<button type="button" onclick="desbloqueio();" class="btn btn-success shadow-1" style="width:100%"><i class="fas fa-lock-open"></i> Desbloquear</button>
												</div>
											</div><br>
											<div class="row">
												<div class="col-md-6">
													<button type="button" onclick="odometro();" class="btn btn-info shadow-0" style="width:100%"><i class="fas fa-road"></i> Odômetro</button>
												</div>
												<div class="col-md-6">
													<button type="button" onclick="set_ancora();" class="btn btn-primary shadow-0" style="width:100%"><i class="fas fa-anchor"></i> Âncora</button>
												</div>
											</div><br>
										</div>
									</div>
									
									<div class="card mb-5" style="border:#ccc 1px solid;">
										<div class="card-body p-3">
											<h4><span class="badge badge-dark">ÚLTIMOS COMANDOS ENVIADOS</span></h4><br>
											<div class="row">
												<div class="col-md-12">
													<?php
													$cons_comandos = mysqli_query($conn,"SELECT * FROM comandos_enviados WHERE deviceid='$deviceid' AND executado='SIM' ORDER BY id_log DESC ");
														if(mysqli_num_rows($cons_comandos) > 0){
															while ($resp_comandos = mysqli_fetch_assoc($cons_comandos)) {
															$executado = 	$resp_comandos['executado'];
															$comando = 	$resp_comandos['comando'];
															$data_comand = 	$resp_comandos['data'];
															$data_comand = date('d/m/Y H:i:s', strtotime("$data_comand"));
															
															if($comando == 'BLOQUEIO'){
																$comand = '<h4><span class="badge" style="background-color:#CD5C5C; color:#FFF"><i class="fas fa-lock"></i> BLOQUEIO</span></h4>';
															}
															if($comando == 'DESBLOQUEIO'){
																$comand = '<h4><span class="badge" style="background-color:#009900; color:#FFF"><i class="fas fa-lock-open"></i> DESBLOQUEIO</span></h4>';
															}
														?>	
														<div class="row">
															<div class="col-md-5">
																<label>Comando:</label>
																<span><?php echo $comand?></span>
															</div>
															<div class="col-md-4">
																<label>Data Envio:</label>
																<span><b><?php echo $data_comand?></b></span>
															</div>
															<div class="col-md-3">
																<label>Executado:</label><br>
																<span><b><?php echo $executado?></b></span>
															</div>
														</div>
														<br>
														<?php
														}}
													
													?>
												</div>
												
											</div><br>
										</div>
									</div>
									
								</div>   
								<div class="modal-footer">
									
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
								</div>
							</div>
						</div>				
					</div>
					<!-- ----- FIM MODAL COMANDOS --->	
					
					
					<!-- ----- MODAL ALERTAS --->
					<div class="modal fade default-example-modal-right" id="alertas" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog modal-dialog-right">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title h4">ÚLTIMOS 15 EVENTOS</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true"><i class="fal fa-times"></i></span>
									</button>
								</div>
								<div class="modal-body">
									<div id="alertas1"></div>
									
								</div>   
								<div class="modal-footer">
									
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
								</div>
							</div>
						</div>				
					</div>
					<!-- ----- FIM MODAL ALERTAS --->	
					
					
					<!-- ----- MODAL COMPARTILHAR --->	
					
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
									<div class="row">
										<div class="col-lg-5">
										<input type="text" name="url_link" id="url_link" class="form-control">
										</div>
										<div class="col-lg-4">
										<button type="button" class="btn btn-primary" onClick="copiarTexto()">Copiar</button>
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
					<!-- ----- FIM MODAL COMPARTILHAR --->	
					
					
					
					
					<!-- ----- MODAL BLOQUEIO --->	
					
					<div class="modal fade" id="bloqueio" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-lg">
							<div class="modal-content">
								<div class="modal-header bg-primary text-white">
									<h3 class="modal-title" id="myLargeModalLabel" style="color:#FFF;"><i class="fas fa-lock"></i> COMANDO DE BLOQUEIO</h3>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								</div>
								<div class="modal-body">
									
									<p>Deseja efetuar o BLOQUEIO do veículo?</p>
								</div>
								<div class="modal-footer">
									 <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
									 <a href="comandos/comandos.php?t=BLOQUEIO&model=<?php echo $modelo_equip?>&deviceid=<?php echo $deviceid?>&nome_user=<?php echo $user_nome?>"><button type="button" class="btn btn-danger shadow-0" data-toggle="modal" data-target="#carregar" style="width:100%"><i class="fas fa-lock"></i> Bloquear</button></a><br>
								</div>
							</div>
						</div>
					</div>

					<!-- ----- FIM MODAL BLOQUEIO --->	
					
					<!-- ----- MODAL ODOMETRO --->	
					
					<div class="modal fade" id="set_odometro" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-lg">
							<div class="modal-content">
								<div class="modal-header bg-primary text-white">
									<h3 class="modal-title" id="myLargeModalLabel" style="color:#FFF;"><i class="fas fa-road"></i> DEFINIR ODOMETRO</h3>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								</div>
								<div class="modal-body">
									<div class="row">
										<div class="col-md-6">
											<label>Digite o valor do Odômetro: (Valor em KM)</label><br>
											<input type="text" class="form-control" value="<?php echo $odometro?>" name="vlr_odometro" id="vlr_odometro" style="width:50%" onkeypress="return(MascaraMoeda(this,'.',',',event))">
										</div>
										<div class="col-md-6">
											<label>Média de consumo do veículo: (km/l)</label><br>
											<input type="text" class="form-control" value="<?php echo $media_consumo?>" name="media_consumo" id="media_consumo" style="width:50%" onkeypress="return(MascaraMoeda(this,'.',',',event))">
											<input type="hidden" value="<?php echo $deviceid?>" name="deviceid20" id="deviceid20">
										</div>
									</div>
									
								</div>
								<div class="modal-footer">
									 <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
									 <button type="button" onclick="envia_3();" class="btn btn-success shadow-0" data-toggle="modal" data-target="#carregar">Registrar</button>
								</div>
							</div>
						</div>
					</div>

					<!-- ----- FIM MODAL ODOMETRO --->
					
					<!-- ----- MODAL DESBLOQUEIO --->	
					
					<div class="modal fade" id="desbloqueio" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-lg">
							<div class="modal-content">
								<div class="modal-header bg-primary text-white">
									<h3 class="modal-title" id="myLargeModalLabel" style="color:#FFF;"><i class="fas fa-lock"></i> COMANDO DE DESBLOQUEIO</h3>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								</div>
								<div class="modal-body">
									
									<p>Deseja efetuar o DESBLOQUEIO do veículo?</p>
								</div>
								<div class="modal-footer">
									 <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
									 <a href="comandos/comandos.php?t=DESBLOQUEIO&model=<?php echo $modelo_equip?>&deviceid=<?php echo $deviceid?>&nome_user=<?php echo $user_nome?>"><button type="button" class="btn btn-success shadow-0" data-toggle="modal" data-target="#carregar" style="width:100%"><i class="fas fa-lock-open"></i> Desbloquear</button></a><br>
								</div>
							</div>
						</div>
					</div>

					<!-- ----- FIM MODAL DESBLOQUEIO --->	
					
					<!-- ----- MODAL ANCORA --->	
					
					<div class="modal fade" id="ancora" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-lg">
							<div class="modal-content">
								<div class="modal-header bg-primary text-white">
									<h3 class="modal-title" id="myLargeModalLabel" style="color:#FFF;">COMANDOS DE ÂNCORA</h3>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								</div>
								<div class="modal-body">
									<?php echo $info_modal?>
									
								</div>
								<div class="modal-footer">
									 <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
									 <?php echo $link_ancora?><button type="button" class="btn btn-info">Enviar Comando</button></a>
								</div>
							</div>
						</div>
					</div>

					<!-- ----- FIM MODAL ANCORA --->
					
					
					<!-- ----- MODAL COMANDOS SMS --->	
					
					<div class="modal inmodal" id="comandos_sms"  role="dialog" >
						<div class="modal-dialog">
							<div class="modal-content animated bounceInRight">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
									
								</div>
								<div class="modal-body">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group text-center">
											<i class="fas fa-car fa-3x"></i>
												<h3><?php echo $veiculo?></h3>
												<h4>Equipamento: <?php echo $modelo_equip?>.</h4>
												<h5>Linha: <?php echo $chip?>.</h5>
												<hr>
												
												<h3><span class="badge" style="background-color:#000; color:#FFF">Crédito SMS: <span id="saldo2"></span></h3>
												<hr>
											</div>
										</div>
									</div><br>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>Selecione o Comando:</label>
												 <select class="select2 form-control w-100" name="comando" id="comando">
												 <option value="">Selecione</option>
													<?php
													$cons_categorias_contas_pagar = mysqli_query($conn,"SELECT * FROM comandos_sms WHERE equipamento='$modelo_equip' ORDER BY nome_comando ASC");
													if(mysqli_num_rows($cons_categorias_contas_pagar) <= 0){
													echo '<option value="0">Nenhum Comando Encontrado para este modelo</option>';
													}else{
													
													while ($res_cat = mysqli_fetch_assoc($cons_categorias_contas_pagar)) {
													$id_comando = $res_cat['id_comando'];
													$nome_comando = $res_cat['nome_comando'];
													$tipo = $res_cat['tipo'];
													echo '<option value="'.$id_comando.'">'.$nome_comando.'</option>';
													}
													}
													?>
												
												</select>
												<input type="hidden" value="<?php echo $chip?>" id="chip" name="chip">	
												<input type="hidden" value="<?php echo $deviceid?>" id="deviceid1" name="deviceid1">
												<input type="hidden" value="<?php echo $id_empresa?>" id="customer1" name="customer1">
												<input type="hidden" value="<?php echo $user_nome?>" id="nome_user" name="nome_user">
												
											</div>
										</div>
									</div><br>
									<div id="retorno_comando"></div><br>
									
									
									
								</div>
								<div class="modal-footer">
									<button type="button" onClick="comando_ok()" class="btn btn-success btn-sm">Envios Realizados</button>
									<button type="button" class="btn btn-dark btn-sm" data-dismiss="modal">Fechar</button>
									<button type="button" onClick="envia_1();"  class=" btn btn-primary btn-sm">Enviar</button>
								</div>
							</div>
						</div>
					</div>
					<!-- ----- FIM MODAL COMANDOS SMS --->	
					
					<div class="modal fade" id="envios_sms1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-xl">
							<div class="modal-content">
								<div class="modal-header bg-info text-white">
									<h3 class="modal-title" id="myLargeModalLabel">COMANDOS SMS ENVIADOS!</h3>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								</div>
								<div class="modal-body">
									<table class="table table-striped table-bordered table-hover">
									  <thead>
										<tr>
										  <th style="width:15%">Data Envio</th>
										  <th style="width:20%">Comando</th>
										  <th style="width:15%">Status</th>
										  <th style="width:50%">Resposta</th>
										</tr>
									  </thead>
									  <tbody id="status_comando"> 
									  
									
									
										</tbody>
									</table>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-dark" data-dismiss="modal">Fechar</button>
									
								</div>
							</div>
						</div>
					</div>
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					<?php

					$res = $_GET['res'];
					$cmd = $_GET['cmd'];
					if($res == 200){
						$codigo = '<p>Comando executado com sucesso. Aguarde até 60 segundos.</p>';
						$cor_cmd = 'bg-primary';
					 ?>
			
							<script>
								$(document).ready(function(){
									$('#confirm_comando').modal('show');
								});
							</script>
				<?php } else if  ($res == 202){
					$codigo = '<p>Equipamento Offline. </p><p>O comando será executado assim que o equipamento estiver online. </p>';
				
					$cor_cmd = 'bg-warning';
					?>
				
				<script>
					$(document).ready(function(){
						$('#confirm_comando').modal('show');
					});
				</script>
				<?php } else if  ($res == 400){
					$codigo = '<p>Não foi possível executar o comando.</p><p>Verifique as configurações do equipamento.</p>';
				
					$cor_cmd = 'bg-danger';
					?>
				
				<script>
					$(document).ready(function(){
						$('#confirm_comando').modal('show');
					});
				</script>
				<?php } ?>
				
				
				<div class="modal fade" id="confirm_comando" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-header <?php echo $cor_cmd?> text-white">
									<h3 class="modal-title" id="myLargeModalLabel">AVISO!</h3>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								</div>
								<div class="modal-body">
									<?php echo $codigo?>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-dark" data-dismiss="modal">Fechar</button>
									
								</div>
							</div>
						</div>
					</div>
					
					
					
				<div class="modal fade" id="aviso_sms" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-header bg-warning text-white">
								<h3 class="modal-title" id="myLargeModalLabel"><h3>SALDO INSUFICIENTE!</h3></h3>
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							</div>
							<div class="modal-body">

								<h4>Saldo SMS: <span id="saldo1"></span></h4><br>
								<p>Para envio de comandos por SMS, faça compra de créditos.</p>
								
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-dark" data-dismiss="modal">Fechar</button>
								<button type="button" class="btn btn-success">Saiba mais</button>
							</div>
						</div>
					</div>
				</div>
					
					<div class="modal fade" id="BLOQUEADO" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-body text-center font-18">
									<h4 class="mb-20">CONFIRMAÇÃO</h4>
									<div class="mb-30 text-center"><i class="fas fa-lock fa-3x" style="color:#990000"></i></div><br><br>
									<h4 class="mb-20">VEÍCULO BLOQUEADO COM SUCESSO!</h4>
								</div>
								<div class="modal-footer justify-content-center">
									
									<button type="button" class="btn btn-dark" data-dismiss="modal">Fechar</button>
								</div>
							</div>
						</div>
					</div>
					
					<div class="modal fade" id="Desbloqueado" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-body text-center font-18">
									<h4 class="mb-20">CONFIRMAÇÃO</h4>
									<div class="mb-30 text-center"><i class="fas fa-lock fa-3x" style="color:#009900"></i></div><br><br>
									<h4 class="mb-20">VEÍCULO DESBLOQUEADO COM SUCESSO!</h4>
								</div>
								<div class="modal-footer justify-content-center">
									
									<button type="button" class="btn btn-dark" data-dismiss="modal">Fechar</button>
								</div>
							</div>
						</div>
					</div>
					
					
					<div class="modal fade" id="carregar" tabindex="-1" role="dialog"  aria-labelledby="myLargeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-sm modal-dialog-centered">
							<div class="modal-content" style="border:#000 2px solid;">
								
								<div class="modal-body" id="informacoes">
									 Aguarde... <img src="/tracker2/Imagens/load.gif" width="30px" height="30px">
								</div>
								
							</div>
						</div>
					</div>	
                    </main>
					</form>
                    <!-- this overlay is activated only when mobile menu is triggered -->
                    <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div> <!-- END Page Content -->
                    <!-- BEGIN Page Footer -->
						<?php include('include/footer.php');?>
                    <!-- END Page Footer -->
                    <!-- BEGIN Shortcuts -->
                   
                </div>
            </div>
        </div>
		<div style="display:none" id="saldo_sms10"></div>
		<input type="hidden" value="<?php echo $id_device?>" id="deviceid">	  
		<div id="status_comando" style="display:none"></div>
		<input type="hidden" value="<?php echo $id_empresa?>" id="customer">	  
		<input type="hidden" value="<?php echo $latitude_ancora?>" id="latitude_ancora">
		<input type="hidden" value="<?php echo $longitude_ancora?>" id="longitude_ancora">
		<input type="hidden" value="<?php echo $raio_ancora?>" id="raio_ancora">	
		<input type="hidden" value="<?php echo $ancora?>" id="anc_raio">	
		<input type="hidden" value="<?php echo $name_cerca1?>" id="tipo_cerca">	
		<input type="hidden" value="<?php echo $ancora?>" id="ancora_on">
		<input type="hidden" value="<?php echo $imei?>" id="imei">
		<input type="hidden" value="http://rastreiamaisbrasil.com.br/tracker3/admin/posicao.php?p=<?php echo $link_base?>" id="flink">
        <!-- END Page Wrapper -->
        <!-- BEGIN Quick Menu -->
		
        <!-- END Quick Menu -->
        <!-- BEGIN Messenger -->
			<?php include('include/messenger.php');?>
        <!-- END Messenger -->
        <!-- BEGIN Page Settings -->
			<?php include('include/settings.php');?>
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
 <script src="/tracker3/app-assets/js/formplugins/select2/select2.bundle.js"></script>
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
	function comando_ok(){
		$('#comando_sms').modal('hide');
		$('#envios_sms1').modal('show');
		}
</script>
<script>
function hide_menu(){
	 $('body').addClass('nav-function-hidden')
}
</script>

<script>
$('#forml').on('submit', function(e){
$('#carregar').modal('show');
});
</script> 
<script>
function envia_1(){
	document.forml.action="enviar_comando.php"
	document.forml.method = 'POST';
	document.forml.submit()
}

function envia_2(){
	document.forml.action="add/add_tratativa.php"
	document.forml.method = 'POST';
	document.forml.submit()
}

function envia_3(){
	document.forml.action="enviar_odometro.php"
	document.forml.method = 'POST';
	document.forml.submit()
}
	</script>
<script>
function bloqueio(){
	$('#comandos_gprs').modal('hide');
	$('#bloqueio').modal('show');
}

function odometro(){
	$('#comandos_gprs').modal('hide');
	$('#set_odometro').modal('show');
}

function desbloqueio(){
	$('#comandos_gprs').modal('hide');
	$('#desbloqueio').modal('show');
}

function set_ancora(){
	$('#comandos_gprs').modal('hide');
	$('#ancora').modal('show');
}

function sms(){
	var saldo_sms = document.getElementById("saldo_sms1").value;
	if(saldo_sms >= 1){
		$('#comandos_sms').modal('show');
	} 
	if(saldo_sms <= 0){
		$('#aviso_sms').modal('show');
	}
}
</script>
      <script type="text/javascript">
	$(function(){
	  $("select[name=comando]").change(function(){
	var comando = document.getElementById("comando").value;
	var imei = document.getElementById("imei").value;
	$(document).ready(function () {
				listar_comando(comando); //Chamar a função para listar os registros
			});
			
			function listar_comando(comando){
				var dados = {
					comando: comando, imei: imei
				}
				$.post('ajax/comando.ajax.php', dados , function(retorna){
					//Subtitui o valor no seletor id="conteudo"
					$("#retorno_comando").html(retorna);
				});
			}
	  })	
	})
	
	
</script>

<script>
	$(document).ready(function () {
		
		$.post('include/grid_device.php?customer='+customer+'&deviceid='+deviceid, function(grid_veiculos){
			$("#grid_veiculos").html(grid_veiculos);
			
			
		});
	});
</script>
<script>
	var intervalo = setInterval(function(){
		$('#grid_veiculos').load('include/grid_device.php?customer='+customer+'&deviceid='+deviceid); 
	}, 1500);
</script>
<script>
	var intervalo6 = setInterval(function(){
		$('#alertas1').load('include/alertas.php?deviceid='+deviceid); 
	}, 1500);
</script>
<script>
	var intervalo1 = setInterval(function(){
		$('#saldo_sms10').load('include/saldo_sms.php?customer='+customer);
		var saldos = document.getElementById("saldo_sms1").value;
		$("#saldo1").html(saldos);
		$("#saldo2").html(saldos);
	}, 1500);
</script>

<script>

var deviceid = document.getElementById("deviceid").value;
var latitude_ancora = document.getElementById("latitude_ancora").value;
var longitude_ancora = document.getElementById("longitude_ancora").value;
var raio_ancora = document.getElementById("raio_ancora").value;
var tipo_cerca = document.getElementById("tipo_cerca").value;
var ancora_on = document.getElementById("ancora_on").value;
var customer = document.getElementById("customer").value;




	mapboxgl.accessToken = '<?php echo $token?>';
		

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

var iconBase = '/tracker2/manager/imagens/icons/';
 
var map = new mapboxgl.Map({
container: 'map',
style: 'mapbox://styles/mapbox/streets-v11',
center: [<?php echo $longit?>, <?php echo $latit?>],
zoom: 16,
pitch: 65,
bearing: -17.6,
antialias: true,
attributionControl: false
});

map.on("load", function(e) {
map.resize();
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
		  "circle-stroke-width": 4,
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
   map.setStyle('mapbox://styles/mapbox/satellite-streets-v11');
    tipo_mapbox = 1
}

function setMap(){
	map.setStyle('mapbox://styles/mapbox/streets-v11');
    tipo_mapbox = 0
}

function setNoite(){
	map.setStyle('mapbox://styles/mapbox/navigation-night-v1');
    tipo_mapbox = 0
}

map.addControl(new mapboxgl.FullscreenControl());
map.addControl(new mapboxgl.NavigationControl());
var mapboxMarkers = []








function refreshMap(){
 downloadUrl('resultado_device.php?id_device='+deviceid+'&id_empresa='+customer, (data) => {
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
          var motorista = markerElem.getAttribute('motorista')
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
							speed: 0.7
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
							'url(/tracker2/manager/imagens/icons/'+ign;
							el.style.width = '99px';
							el.style.height = '73px';
							var infotitle = `
								<div style="margin-bottom: 25px">
									<strong><b>${name}</b></strong>
									<br><br>
									<text>${address}</text>
									<br>
									
									<text><b>Data/Hora:</b> ${data_format}</text>
									<br>
									<text><b>Ignicao:</b> <i class="fas fa-key ${ignicao}"></i> <span class="${ignicao}">${ignicao}</span></text>
									<br>
									<text><b>Motorista:</b> ${motorista}</text>

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
                  'url(/tracker2/manager/imagens/icons/'+ign;
                  el.style.width = '99px';
                  el.style.height = '73px';
                  var infotitle = `
                      <div>
                        <strong><b>${name}</b></strong>
                        <br><br>
                        <text>${address}</text>
                        <br>
                        <br>
                        <text><b>Data/Hora:</b> ${data_format}</text>
                        <br><br>
                        <text><b>Ignicao:</b> <i class="fas fa-key ${ignicao}"></i> <span class="${ignicao}">${ignicao}</span></text>
						<br><br>
						<text><b>Motorista:</b> ${motorista}</text>
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
  'url(/tracker2/manager/imagens/icons/car.png';
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
	$(document).ready(function()
            {
                $(function()
                {
                    $('.select2').select2();

                    $(".select2-placeholder-multiple").select2(
                    {
                        placeholder: "Select State"
                    });
                    $(".js-hide-search").select2(
                    {
                        minimumResultsForSearch: 1 / 0
                    });
                    $(".js-max-length").select2(
                    {
                        maximumSelectionLength: 2,
                        placeholder: "Select maximum 2 items"
                    });
                    $(".select2-placeholder").select2(
                    {
                        placeholder: "Select a state",
                        allowClear: true
                    });



                    $(".js-select2-icons").select2(
                    {
                        minimumResultsForSearch: 1 / 0,
                        templateResult: icon,
                        templateSelection: icon,
                        escapeMarkup: function(elm)
                        {
                            return elm
                        }
                    });

                    function icon(elm)
                    {
                        elm.element;
                        return elm.id ? "<i class='" + $(elm.element).data("icon") + " mr-2'></i>" + elm.text : elm.text
                    }

                    $(".js-data-example-ajax").select2(
                    {
                        ajax:
                        {
                            url: "https://api.github.com/search/repositories",
                            dataType: 'json',
                            delay: 250,
                            data: function(params)
                            {
                                return {
                                    q: params.term, // search term
                                    page: params.page
                                };
                            },
                            processResults: function(data, params)
                            {
                                // parse the results into the format expected by Select2
                                // since we are using custom formatting functions we do not need to
                                // alter the remote JSON data, except to indicate that infinite
                                // scrolling can be used
                                params.page = params.page || 1;

                                return {
                                    results: data.items,
                                    pagination:
                                    {
                                        more: (params.page * 30) < data.total_count
                                    }
                                };
                            },
                            cache: true
                        },
                        placeholder: 'Search for a repository',
                        escapeMarkup: function(markup)
                        {
                            return markup;
                        }, // let our custom formatter work
                        minimumInputLength: 1,
                        templateResult: formatRepo,
                        templateSelection: formatRepoSelection
                    });

                    function formatRepo(repo)
                    {
                        if (repo.loading)
                        {
                            return repo.text;
                        }

                        var markup = "<div class='select2-result-repository clearfix d-flex'>" +
                            "<div class='select2-result-repository__avatar mr-2'><img src='" + repo.owner.avatar_url + "' class='width-2 height-2 mt-1 rounded' /></div>" +
                            "<div class='select2-result-repository__meta'>" +
                            "<div class='select2-result-repository__title fs-lg fw-500'>" + repo.full_name + "</div>";

                        if (repo.description)
                        {
                            markup += "<div class='select2-result-repository__description fs-xs opacity-80 mb-1'>" + repo.description + "</div>";
                        }

                        markup += "<div class='select2-result-repository__statistics d-flex fs-sm'>" +
                            "<div class='select2-result-repository__forks mr-2'><i class='fal fa-lightbulb'></i> " + repo.forks_count + " Forks</div>" +
                            "<div class='select2-result-repository__stargazers mr-2'><i class='fal fa-star'></i> " + repo.stargazers_count + " Stars</div>" +
                            "<div class='select2-result-repository__watchers mr-2'><i class='fal fa-eye'></i> " + repo.watchers_count + " Watchers</div>" +
                            "</div>" +
                            "</div></div>";

                        return markup;
                    }

                    function formatRepoSelection(repo)
                    {
                        return repo.full_name || repo.text;
                    }

                });
            });

  </script>

 <script>
function MascaraMoeda(objTextBox, SeparadorMilesimo, SeparadorDecimal, e){
    var sep = 0;
    var key = '';
    var i = j = 0;
    var len = len2 = 0;
    var strCheck = '0123456789';
    var aux = aux2 = '';
    var whichCode = (window.Event) ? e.which : e.keyCode;
    if (whichCode == 13) return true;
    key = String.fromCharCode(whichCode); // Valor para o código da Chave
    if (strCheck.indexOf(key) == -1) return false; // Chave inválida
    len = objTextBox.value.length;
    for(i = 0; i < len; i++)
        if ((objTextBox.value.charAt(i) != '0') && (objTextBox.value.charAt(i) != SeparadorDecimal)) break;
    aux = '';
    for(; i < len; i++)
        if (strCheck.indexOf(objTextBox.value.charAt(i))!=-1) aux += objTextBox.value.charAt(i);
    aux += key;
    len = aux.length;
    if (len == 0) objTextBox.value = '';
    if (len == 1) objTextBox.value = '0'+ SeparadorDecimal + '0' + aux;
    if (len == 2) objTextBox.value = '0'+ SeparadorDecimal + aux;
    if (len > 2) {
        aux2 = '';
        for (j = 0, i = len - 3; i >= 0; i--) {
            if (j == 3) {
                aux2 += SeparadorMilesimo;
                j = 0;
            }
            aux2 += aux.charAt(i);
            j++;
        }
        objTextBox.value = '';
        len2 = aux2.length;
        for (i = len2 - 1; i >= 0; i--)
        objTextBox.value += aux2.charAt(i);
        objTextBox.value += SeparadorDecimal + aux.substr(len - 2, len);
    }
    return false;
}

function MascaraFloat3(objTextBox, SeparadorMilesimo, SeparadorDecimal, e){
	var sep = 0;
	var key = '';
	var i = j = 0;
	var len = len2 = 0;
	var strCheck = '0123456789';
	var aux = aux2 = '';
	var whichCode = (window.Event) ? e.which : e.keyCode;
	if (whichCode == 13 || whichCode == 8) return true;
	key = String.fromCharCode(whichCode); // Valor para o código da Chave
	if (strCheck.indexOf(key) == -1) return false; // Chave inválida
	len = objTextBox.value.length;
	for(i = 0; i < len; i++)
	if ((objTextBox.value.charAt(i) != '0') && (objTextBox.value.charAt(i) != SeparadorDecimal)) break;
	aux = '';
	for(; i < len; i++)
	if (strCheck.indexOf(objTextBox.value.charAt(i))!=-1) aux += objTextBox.value.charAt(i);
	aux += key;
	len = aux.length;
	if (len == 0) objTextBox.value = '';
	if (len == 1) objTextBox.value = '0'+ SeparadorDecimal + '00' + aux;
	if (len == 2) objTextBox.value = '0'+ SeparadorDecimal + '0' + aux;
	if (len == 3) objTextBox.value = '0'+ SeparadorDecimal + aux;
	if (len > 3) {
		aux2 = '';
		for (j = 0, i = len - 4; i >= 0; i--) {
			if (j == 3) {
				aux2 += SeparadorMilesimo;
				j = 0;
			}
			aux2 += aux.charAt(i);
			j++;
		}
		objTextBox.value = '';
		len2 = aux2.length;
		for (i = len2 - 1; i >= 0; i--)
		objTextBox.value += aux2.charAt(i);
		objTextBox.value += SeparadorDecimal + aux.substr(len - 3, len);
	}
	return false;
}

function fmtMoney(n, c, d, t){ 
   var m = (c = Math.abs(c) + 1 ? c : 2, d = d || ",", t = t || ".", 
      /(\d+)(?:(\.\d+)|)/.exec(n + "")), x = m[1].length > 3 ? m[1].length % 3 : 0; 
   return (x ? m[1].substr(0, x) + t : "") + m[1].substr(x).replace(/(\d{3})(?=\d)/g, 
      "$1" + t) + (c ? d + (+m[2] || 0).toFixed(c).substr(2) : ""); 
};
</script>		
    </body>
</html>
