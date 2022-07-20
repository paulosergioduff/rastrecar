
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
    <body class="mod-bg-1 nav-function-fixed" onload=" bat_remov();veloc();alert_ign();">
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
					
					$cons_veiculo = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE deviceid = '$deviceid'");
					if(mysqli_num_rows($cons_veiculo) > 0){
						while ($resp_veiculos = mysqli_fetch_assoc($cons_veiculo)) {
						$placa = 	$resp_veiculos['placa'];
						$modelo_veiculo = 	$resp_veiculos['modelo_veiculo'];
						$marca_veiculo = 	$resp_veiculos['marca_veiculo'];
						$alerta_velocidade = $resp_veiculos['alerta_velocidade'];
						$alerta_ign = $resp_veiculos['alerta_ign'];
						$alerta_bateria = $resp_veiculos['alerta_bateria'];
						$alerta_bateria_baixa = $resp_veiculos['alerta_bateria_baixa'];
						$limite_velocidade = 	$resp_veiculos['limite_velocidade'];
					}}
					
						if($alerta_velocidade == 'SIM'){
							$alerta_velocidade1 = 'checked';
							$display = 'block';
						} else {
							$alerta_velocidade1 = '';
							$display = 'none';
						}

						if($alerta_ign == 'SIM'){
							$alerta_ign1 = 'checked';
						} else {
							$alerta_ign1 = '';
						}

						if($alerta_bateria == 'SIM'){
							$alerta_bateria1 = 'checked';
						} else {
							$alerta_bateria1 = '';
						}

						if($alerta_bateria_baixa == 'SIM'){
							$alerta_bateria_baixa1 = 'checked';
						} else {
							$alerta_bateria_baixa1 = '';
						}
						
						
						if($limite_velocidade < 1){
							$lim_vel = 'Selecione';
						} else {
							$lim_vel = ''.$limite_velocidade.' Km/h';
						}
					
					?>
					<form name="forml" action="add_conf_alertas.php?app=on" method="post">
                    <main id="js-page-content" role="main" class="page-content">
					
						<div class="row">
                            <div class="col-xl-8">
								<div class="subheader">
									<h1 class="subheader-title">
										<i class='subheader-icon fas fa-bell'></i> Alertas / Notificações
										
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
								<div class="form-group">
									<label>Falha Bateria Veículo</label>
									 <div class="custom-control custom-switch">
										<input type="checkbox" class="custom-control-input" id="bateria_removida" onChange="bat_remov();" name="bateria_removida" value="SIM" <?php echo $alerta_bateria1?>>
										<label class="custom-control-label" for="bateria_removida" id="bateria_removida1"></label>
									</div>
								</div>
							</div>
						</div>
						<br>
                        <div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Alerta Ignição</label>
									 <div class="custom-control custom-switch">
										<input type="checkbox" class="custom-control-input" onChange="alerta();alert_ign()" id="alerta_ignicao" name="alerta_ignicao" value="SIM" <?php echo $alerta_ign1?>>
										<label class="custom-control-label" for="alerta_ignicao" id="ignicao1"></label>
									</div>
								</div>
							</div>
						</div>
						<br>
                        <div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Alerta Excesso de Velocidade</label>
									 <div class="custom-control custom-switch">
										<input type="checkbox" class="custom-control-input" onChange="veloc();" id="alerta_velocidade" name="alerta_velocidade" value="SIM" <?php echo $alerta_velocidade1?>>
										<label class="custom-control-label" for="alerta_velocidade" id="alerta_velocidade2"></label>
										
									</div>
								</div>
							</div><br>
							
						</div><br>
						<div class="row" id="velocidade" style="display:<?php echo $display?>;">
							<div class="col-12">
							<label>Selecione a Velocidade</label>
							 <select class="form-control" name="limite_velocidade" id="limite_velocidade" style="width: 100%; height: 38px;" >
								<option value="<?php echo $limite_velocidade?>"><?php echo $lim_vel?> </option>
								<option value="60">60 Km/h</option>
								<option value="80">80 Km/h</option>
								<option value="100">100 Km/h</option>
								<option value="120">120 Km/h</option>
							 </select>
							</div>
						</div>
						<br><br>
						<div class="row">
							<div class="col-12">
								<button type="submit" data-toggle="modal" data-target="#carregar" class="btn btn-dark" style="width:100%">Salvar</button>
							</div>
						</div>
						
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
					
					
					<div class="modal fade" id="alert_ign" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-header bg-success text-white">
									<h4 class="modal-title" id="myLargeModalLabel"><i class="fas fa-key" title="Âncora"></i> ALERTA IGNIÇÃO!</h4>
									<button type="button" class="close text-white" data-dismiss="modal" aria-hidden="true">×</button>
								</div>
								<div class="modal-body">
									Se ativado, será emitido alerta sempre que a ignição do veículo for ligada e/ou desligada.
								
								</div>
								<div class="modal-footer">
									<button type="button" onClick="alerta2();" class="btn btn-inverse">CANCELAR</button>
									<button type="button" class="btn btn-info" data-dismiss="modal">Confirmar</button>
								</div>
							</div>
						</div>
					</div>	
					
					
					
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
	function alerta(){
		var alerta_ignicao = document.getElementById("alerta_ignicao");
			if(alerta_ignicao.checked == true){
				$('#alert_ign').modal('show');
				
			} 
	}

	function alerta2(){
		var alerta_ignicao = document.getElementById("alerta_ignicao");
		  $(alerta_ignicao).trigger('click').removeAttr("checked");
		 $('#alert_ign').modal("hide");
	}
	
	function veloc(){
		var alerta_velocidade = document.getElementById("alerta_velocidade");
			if(alerta_velocidade.checked == true){
				document.getElementById('velocidade').style.display = 'block';
				$("#alerta_velocidade2").html('<h5><span class="badge" style="background-color:#009900;color:#FFF">ATIVADO</span></h5>');
			} else {
				document.getElementById('velocidade').style.display = 'none';
				$("#alerta_velocidade2").html('<h5><span class="badge badge-dark">OFF</span></h5>');
			}
	}
	
	
	function bat_remov(){
		//var bateria_removida = document.getElementById("bateria_removida").value;
		 if(bateria_removida.checked == true){
			$("#bateria_removida1").html('<h5><span class="badge" style="background-color:#009900;color:#FFF">ATIVADO</span></h5>');
		} else {
			$("#bateria_removida1").html('<h5><span class="badge badge-dark">OFF</span></h5>');
		}
	}
	
	function alert_ign(){
		//var bateria_removida = document.getElementById("bateria_removida").value;
		 if(alerta_ignicao.checked == true){
			$("#ignicao1").html('<h5><span class="badge" style="background-color:#009900;color:#FFF">ATIVADO</span></h5>');
		} else {
			$("#ignicao1").html('<h5><span class="badge badge-dark">OFF</span></h5>');
		}
	}
</script>

    </body>
</html>
