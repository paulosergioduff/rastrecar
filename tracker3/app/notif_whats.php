
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
        <link rel="stylesheet" media="screen, print" href="/tracker2/app-assets/css/vendors.bundle.css">
        <link rel="stylesheet" media="screen, print" href="/tracker2/app-assets/css/app.bundle.css">
        <!-- Place favicon.ico in the root directory -->
        <link rel="apple-touch-icon" sizes="180x180" href="/tracker2/app-assets/img/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/tracker2/app-assets/img/favicon/favicon-32x32.png">
        <link rel="mask-icon" href="/tracker2/app-assets/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="stylesheet" media="screen, print" href="/tracker2/app-assets/css/datagrid/datatables/datatables.bundle.css">
				<link rel="stylesheet" media="screen, print" href="/tracker2/app-assets/css/fa-solid.css">
		<link rel="stylesheet" media="screen, print" href="/tracker2/app-assets/css/statistics/chartjs/chartjs.css">
		<link rel="stylesheet" media="screen, print" href="/tracker2/app-assets/css/formplugins/select2/select2.bundle.css">
		<script src="https://kit.fontawesome.com/a132241e15.js"></script>
    </head>
    <body class="mod-bg-1 nav-function-fixed" onload="bat_remov();">
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

						}}	
					
					
					
					?>
					<form method="post" action="edit_whats.php?app=on" name="forml" id="forml">
                    <main id="js-page-content" role="main" class="page-content">
					
						<div class="row">
                            <div class="col-xl-8">
								<div class="subheader">
									<h1 class="subheader-title">
										<i class='subheader-icon fab fa-whatsapp'></i> Alertas Whatsapp
										
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
											<?php
											
											$cons_user1 = mysqli_query($conn,"SELECT * FROM usuarios_push WHERE id_push='$id_push' ");
												if(mysqli_num_rows($cons_user1) > 0){
													while ($resp_user1 = mysqli_fetch_assoc($cons_user1)) {
													$tipo = 	$resp_user1['tipo'];
													$id_cliente = $resp_user1['id_cliente'];
													$id_usuarios = $resp_user1['id_usuarios'];

												}}	
											
											$cons_user2 = mysqli_query($conn,"SELECT * FROM usuarios WHERE id_usuarios='$id_usuarios' ");
												if(mysqli_num_rows($cons_user2) > 0){
													while ($resp_user2 = mysqli_fetch_assoc($cons_user2)) {
													$alertas_whats = 	$resp_user2['alertas_whats'];
												}}	
												
											if($alertas_whats == 'SIM'){
												$alert_whats = 'checked';
											}
											if($alertas_whats != 'SIM'){
												$alert_whats = '';
											}
											
											 $cons_cliente = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
												if(mysqli_num_rows($cons_cliente) > 0){
													while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
													$nome_cliente = 	$resp_cliente['nome_cliente'];
													
													
													$telefone_celular = $resp_cliente['telefone_celular'];
													$telefone_celular = substr_replace($telefone_celular, '****', 7, 5);
												}}	
											
					
											?>
											<div class="row">
												<div class="col-12">
													<span style="font-size:14px">Ao habilitar essa opção, todos os alertas ativos dos seus veículos serão enviados via whatsapp no telefone cadastrado. Caso precise mudar o número, entre em contato com a central.</span>
												</div>
											</div><br>
											<div class="row">
												<div class="col-12 text-center">
													<span style="font-size:14px">Telefone:</span><br>
													<span style="font-size:20px"><?php echo $telefone_celular?></span>
												</div>
											</div>
											<hr style="border:#999 1px solid;">
											<br>
											<div class="row">
												<div class="col-12 text-center">
													 <div class="custom-control custom-switch">
														<input type="checkbox" class="custom-control-input" id="alerta_whats" onChange="bat_remov();" name="alerta_whats" value="SIM" <?php echo $alert_whats?>>
														<label class="custom-control-label" for="alerta_whats" id="alerta_whats1"></label>
													</div>
												</div>
											</div><br>
                                        </div>
                                    </div>
                                </div>
							</div>
							<input type="hidden"  name="id_usuarios" id="id_usuarios" value="<?php echo $id_usuarios?>">
						</div>
						<br>
                        <div class="row">
							<div class="col-12">
							<button type="submit" class="btn btn-dark" style="width:100%">Salvar</button>
							</div>	
						</div>
                       
						
                    </main>
					</form>
					
					 
					
					
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
      
        <script src="/tracker2/app-assets/js/vendors.bundle.js"></script>
        <script src="/tracker2/app-assets/js/app.bundle.js"></script>
        <script src="/tracker2/app-assets/js/datagrid/datatables/datatables.bundle.js"></script>
<script>
$('#forml').on('submit', function(e){
  $('#carregar').modal('show');
});
</script> 
<script>
	function bat_remov(){
		//var bateria_removida = document.getElementById("bateria_removida").value;
		 if(alerta_whats.checked == true){
			$("#alerta_whats1").html('<h5><span class="badge" style="background-color:#009900;color:#FFF">ATIVADO</span></h5>');
		} else {
			$("#alerta_whats1").html('<h5><span class="badge badge-dark">OFF</span></h5>');
		}
	}
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
