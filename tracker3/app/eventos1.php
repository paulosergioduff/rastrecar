
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
					
					$cons_veiculo = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE deviceid = '$deviceid'");
					if(mysqli_num_rows($cons_veiculo) > 0){
						while ($resp_veiculos = mysqli_fetch_assoc($cons_veiculo)) {
						$placa = 	$resp_veiculos['placa'];
						$modelo_veiculo = 	$resp_veiculos['modelo_veiculo'];
						$marca_veiculo = 	$resp_veiculos['marca_veiculo'];
					}}
					?>
					<form name="forml" action="relatorio_eventos1.php?app=on" method="post">
                    <main id="js-page-content" role="main" class="page-content">
					
						<div class="row">
                            <div class="col-xl-8">
								<div class="subheader">
									<h1 class="subheader-title">
										<i class='subheader-icon fas fa-flag'></i> Relatório de Eventos
										
									</h1>
								</div>
							</div>
							
						</div>
                        <input type="hidden" id="deviceid" name="deviceid" value="<?php echo $deviceid?>">
						<input type="hidden" id="id" name="id" value="<?php echo $id_push?>">
						<div class="row">
                            <div class="col-12">
								<div class="form-group text-center">
									
									 <div class="alert alert-primary" role="alert">
										<strong><i class="fas fa-car fa-2x"></i><br><?php echo $placa?><br><h3><?php echo $marca_veiculo?>/<?php echo $modelo_veiculo?></h3></strong>
									</div>
								</div>
							</div>
							
						</div>
						<br>
                        <div class="row">
							<div class="col-md-12">
								<?php
						
						
							$cons_conta = mysqli_query($conn,"SELECT * FROM tc_events WHERE deviceid='$deviceid' AND (eventtime >= '$data_inicial' AND eventtime <= '$data_final') ORDER BY id DESC");
							$total = mysqli_num_rows($cons_conta);
								if(mysqli_num_rows($cons_conta) > 0){
									
									


						
							$i = $total;
						while ($row_ev = mysqli_fetch_assoc($cons_conta)) {
							--$i;
									$positionid = $row_ev['positionid'];
									$geofenceid = $row_ev['geofenceid'];
									$horario_alarme = $row_ev['eventtime'];
									$horario_alarme = date('d/m/Y H:i:s', strtotime('-3 hour', strtotime($horario_alarme)));
									$eventos = $row_ev['attributes'];
									$eventos1 = json_decode($eventos);
									$alarme = $eventos1->{'alarm'};
									$type = $row_ev['type'];
									$speed1 = $eventos1->{'speed'};
									$speed1 = $speed1 + 1.609;
									$speed1 = round($speed1, 2);
								
								if($type == 'deviceOverspeed'){
									$notific = '<h3><span class="badge badge-warning"><i class="fas fa-tachometer-alt"></i> <b>EXC. VELOCIDADE</b></span></h3>';
									$cor = 'red';
								}

								if($type == 'ignitionOn'){
									$notific = '<h3><span class="badge" style="background-color:#009900;color:#FFF"><i class="fas fa-key"></i> <b>IGNIÇÃO LIGADA</b></span></h3>';
									$cor = 'green';									
								} 
								if($type == 'ignitionOff'){
									$notific = '<h3><span class="badge" style="background-color:#000;color:#FFF"><i class="fas fa-key"></i> <b>IGNIÇÃO DESLIGADA</b></span></h3>';
									$cor = 'black';
								}
								
								if($alarme == 'powerCut' && $type == 'alarm'){
									$notific = '<h3><span class="badge" style="background-color:#CD5C5C;color:#FFF"><i class="fas fa-car-battery"></i> <b>FALHA BATERIA VEICULO</b></span></h3>';
									$cor = 'red';
								}
								if($alarme == 'shock' && $type == 'alarm' ){
									$notific = '<h3><span class="badge" style="background-color:#CD5C5C;color:#FFF"><i class="fas fa-bell"></i> <b>ALARME SENSOR MOV.</b></span></h3>';
									$cor = 'red';
								}
								
								if($alarme == 'door' && $type == 'alarm'){
									$notific = '<h3><span class="badge" style="background-color:#CD5C5C;color:#FFF"><i class="fas fa-bell"></i> <b>ALARME SENSOR PORTAS</b></span></h3>';
									$cor = 'red';
								}
								if($alarme == null && $type == 'geofenceExit'){
									$cons_fence = mysqli_query($conn,"SELECT * FROM tc_geofences WHERE id='$geofenceid'");
								if(mysqli_num_rows($cons_fence) > 0){
							while ($row_fence = mysqli_fetch_assoc($cons_fence)) {
								$name_cerca = $row_fence['name'];
								$description = $row_fence['description'];
								if($description == 'ANCORA'){
									$tipo = '<h3><span class="badge" style="background-color:#CD5C5C;color:#FFF"><i class="fas fa-anchor"></i> <b>ANCORA VIOLADA</b></span></h3>';
									$cor = 'red';
								} else {
									$tipo = '<h3><span class="badge" style="background-color:#CD5C5C;color:#FFF"><i class="fas fa-anchor"></i> <b><i class="fas fa-bell"></i> SAIDA CERCA '.$name_cerca.'</b></span></h3>';
									$cor = 'black';
								}
								
									$notific = $tipo;
								}}}
								if($alarme == null && $type == 'geofenceEnter'){
									$tipo = '<h3><span class="badge" style="background-color:#CD5C5C;color:#FFF"><i class="fas fa-anchor"></i> <b><i class="fas fa-bell"></i> ENTRADA CERCA '.$name_cerca.'</b></span></h3>';
									$cor = 'black';
								}

								
								
															
								$cons_position = mysqli_query($conn,"SELECT * FROM tc_positions WHERE id='$positionid'");
							
								if(mysqli_num_rows($cons_position) > 0){
										while ($resp_posi = mysqli_fetch_assoc($cons_position)) {
											
								$id_pos = $resp_posi['id'];
								
								$speed = 	$resp_posi['speed'];
								$speed = $speed * 1.609;
								$speed = round($speed, 2);
								
								if($type == 'ignitionOff'){
									$speed2 = '0.00';
								}
								if($type == 'ignitionOn'){
									$speed2 = $speed;
								}
								
								
								$address = $resp_posi['address'];
								
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
						?>
								
								<div id="panel-1" class="panel">
									<div class="panel-container show">
										<div class="panel-content">
											<div class="row">
												<div class="col-12">
													<?php echo $notific?>
												</div>
											</div><br>
											<div class="row">
												<div class="col-12">
													<i class="fas fa-map-marker-alt"></i> <?php echo $address; ?>
												</div>
											</div><br>
											<div class="row">
												<div class="col-6">
													<i class="fas fa-tachometer-alt"></i> <?php echo $speed2; ?> km/h
												</div>
												<div class="col-6">
													<i class="far fa-clock"></i> <?php echo $horario_alarme?>
												</div>
											</div>
											
										</div>
									</div>
								</div>
								


								<?php }}}} else {
									echo '<div class="callout callout-warning">
							  <h5><i class="fas fa-exclamation-triangle"></i> ATENÇÃO:</h5>
							  <p>Sem Notificações no período selecionado</p>
							</div>';
								}?>
							</div>
						</div>
                       <br>
						
						
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
