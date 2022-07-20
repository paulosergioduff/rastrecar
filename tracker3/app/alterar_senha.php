
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
                <aside class="page-sidebar">
                  <div style="background-color:#F3F3F3">
                        <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative">
                            <img src="http://mobidrive.mtracker.com.br/logo.png" style="width:200px; heigth:auto" alt="SmartAdmin WebApp" aria-roledescription="logo">
                            
                            
                        </a>
                    </div>
                    <?php include('include/sidebar.php')?>
                    
                </aside>
                <!-- END Left Aside -->
                <div class="page-content-wrapper header-function-fixed">
                    <!-- BEGIN Page Header -->
                    <?php include('include/head.php')?>
					<?php
					  $cons_user1 = mysqli_query($conn,"SELECT * FROM usuarios_push WHERE id_push='$id_push' ");
						if(mysqli_num_rows($cons_user1) > 0){
							while ($resp_user1 = mysqli_fetch_assoc($cons_user1)) {
							$tipo = 	$resp_user1['tipo'];
							$id_cliente = $resp_user1['id_cliente'];
							$id_usuarios = $resp_user1['id_usuarios'];

						}}	
					
					
					
					
					?>
					<form method="post" action="edit_senha.php?app=on" name="forml" id="forml">
                    <main id="js-page-content" role="main" class="page-content">
					
						<div class="row">
                            <div class="col-xl-8">
								<div class="subheader">
									<h1 class="subheader-title">
										<i class='subheader-icon fal fa-key'></i> Alterar Senha
										
									</h1>
								</div>
							</div>
							
						</div>
                        <input type="hidden" id="id_cliente_login" value="<?php echo $id_cliente_login?>">
						<input type="hidden" id="id_push" name="id_push" value="<?php echo $id_push?>">
						<div class="row">
                            <div class="col-12">
								 <div id="panel-1" class="panel">
                                    
                                    <div class="panel-container show">
                                        <div class="panel-content">
											<div class="row">
												<div class="col-12">
													<h3>Senha Atual:</h3>
													<div class="input-group">
														<input type="password" class="form-control" name="senha" id="senha" required>
														<div class="input-group-append">
															<button class="btn btn-outline-default" onclick="mostrar_senha();" type="button" id="bt_senha"><i class="fal fa-eye"></i></button>
														</div>
													</div>
												</div>
											</div>
											<br><br>
											<div class="row">
												<div class="col-12">
													<h3>Nova Senha:</h3>
													<div class="input-group">
														<input type="password" class="form-control" name="nova_senha" id="nova_senha" required>
														<div class="input-group-append">
															<button class="btn btn-outline-default" onclick="mostrar_senha1();" type="button" id="bt_senha1"><i class="fal fa-eye"></i></button>
														</div>
													</div>
												</div>
											</div>
											
											
                                        </div>
                                    </div>
                                </div>
							</div>
							<input type="hidden"  name="id_usuarios" id="id_usuarios" value="<?php echo $id_usuarios?>">
						</div>
						<br>
                        <div class="row">
							<div class="col-12">
							<button type="submit" class="btn btn-dark" style="width:100%">Alterar</button>
							</div>	
						</div>
                       
						
                    </main>
					</form>
					<input type="hidden" id="valor_senha" value="0">
					<input type="hidden" id="valor_senha1" value="0">
					
					
					
						<?php
					$error = $_GET['error'];
					if($error == 'error'){

					?>
					<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
					<script>
								$(document).ready(function(){
									$('#error').modal('show');
								});
							</script>
						<?php } ?>
						<div class="modal fade example-modal-centered-transparent" id="error" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered modal-transparent" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title text-white">
											<i class="fas fa-lock"></i> ERRO
											<small class="m-0 text-white">
												<h4><b>Senha atual não confere!</b></h4>
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
										<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
										
									</div>
								</div>
							</div>
						</div>
					
					
					
					
					
					
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
$('#forml').on('submit', function(e){
  $('#carregar').modal('show');
});
</script> 
<script>
function mostrar_senha(){
	var valor_senha = document.getElementById("valor_senha").value;
	if(valor_senha == 0){
		$('#valor_senha').val('1');
		document.getElementById('senha').type = 'text';
		$('#bt_senha').html('<i class="fas fa-eye-slash"></i>');
	}
	if(valor_senha == 1){
		$('#valor_senha').val('0');
		document.getElementById('senha').type = 'password';
		$('#bt_senha').html('<i class="fas fa-eye"></i>');
	}
}
</script>
<script>
function mostrar_senha1(){
	var valor_senha = document.getElementById("valor_senha1").value;
	if(valor_senha == 0){
		$('#valor_senha1').val('1');
		document.getElementById('nova_senha').type = 'text';
		$('#bt_senha1').html('<i class="fas fa-eye-slash"></i>');
	}
	if(valor_senha == 1){
		$('#valor_senha1').val('0');
		document.getElementById('nova_senha').type = 'password';
		$('#bt_senha1').html('<i class="fas fa-eye"></i>');
	}
}
</script>
    </body>
</html>
