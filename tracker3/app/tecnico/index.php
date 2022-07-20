
<!DOCTYPE html>

<html lang="en">
    <head>
           <meta charset="utf-8"/>
        <title>GRID</title>
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
					 $cons_os1 = mysqli_query($conn,"SELECT * FROM ordem_servico WHERE parceiro='$id_parceiro' AND status='1'");
					$total_veiculos = mysqli_num_rows($cons_os1);
					
					  $cons_user1 = mysqli_query($conn,"SELECT * FROM usuarios_push WHERE id_push='$id_push' ");
						if(mysqli_num_rows($cons_user1) > 0){
							while ($resp_user1 = mysqli_fetch_assoc($cons_user1)) {
							$tipo = 	$resp_user1['tipo'];
							$id_parceiro = $resp_user1['id_parceiro'];
							$id_usuarios = $resp_user1['id_usuarios'];
							
						}}	
					
					 $cons_instaladores = mysqli_query($conn,"SELECT * FROM instaladores WHERE id_instalador='$id_parceiro' ");
						if(mysqli_num_rows($cons_instaladores) > 0){
							while ($resp_cli = mysqli_fetch_assoc($cons_instaladores)) {
							$nome_instalador = 	$resp_cli['nome_instalador'];

						}}
						
				
					 $cons_os1 = mysqli_query($conn,"SELECT * FROM ordem_servico WHERE parceiro='$id_parceiro' AND status='1'");
					$total_veiculos = mysqli_num_rows($cons_os1);
					
					?>
					
					
                    <main id="js-page-content" role="main" class="page-content">
					
						<div class="row">
                            <div class="col-xl-12">
								<div class="subheader">
									<h1 class="subheader-title">
										<i class='subheader-icon fal fa-car'></i> Serviços Pendentes
										<small>
											<?php echo $total_veiculos?> OS(s) Encontado(s)
										</small>
									</h1>
								</div>
							</div>
							
						</div>
                        <input type="hidden" id="id_cliente_login" value="<?php echo $id_cliente_login?>">
						<input type="hidden" id="id_push" value="<?php echo $id_push?>">
						
                        <div id="grid_veiculos" style="width:100%">
							<div class="row">
								<div class="col-12">
									<?php 
									 $cons_os = mysqli_query($conn,"SELECT * FROM ordem_servico WHERE parceiro='$id_parceiro' AND status='1'");
										if(mysqli_num_rows($cons_os) > 0){
											while ($resp_os = mysqli_fetch_assoc($cons_os)) {
											$id_os = 	$resp_os['id_os'];
											$id_cliente = 	$resp_os['id_cliente'];
											$tipo_os = 	$resp_os['tipo_os'];
											
									$cons_cliente = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
										if(mysqli_num_rows($cons_cliente) > 0){
											while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
											$nome_cliente = 	$resp_cliente['nome_cliente'];
											$cidade = 	$resp_cliente['cidade'];
											$estado = 	$resp_cliente['estado'];
										}}
										
									$cons_agenda = mysqli_query($conn,"SELECT * FROM agenda_instalacao WHERE id_os='$id_os'");
										if(mysqli_num_rows($cons_agenda) > 0){
											while ($resp_agenda = mysqli_fetch_assoc($cons_agenda)) {
											$id_veiculo = 	$resp_agenda['id_veiculo'];
											$data_agenda = 	$resp_agenda['data_agenda'];
											$data_agenda = date('d/m/Y H:i', strtotime("$data_agenda"));
										}}
										
									$cons_veiculo = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE id_veiculo='$id_veiculo'");
										if(mysqli_num_rows($cons_veiculo) > 0){
											while ($resp_veiculo = mysqli_fetch_assoc($cons_veiculo)) {
											$marca_veiculo = 	$resp_veiculo['marca_veiculo'];
											$modelo_veiculo = 	$resp_veiculo['modelo_veiculo'];
											$deviceid = 	$resp_veiculo['deviceid'];
											
										}}
											
											?>
											<div class="panel" style="border:#999 1px solid; border-left:#999 5px solid;">
												<div class="panel-container show">
													<div class="panel-content">
														<div class="row">
															<div class="col-12">
																<h5><span class="badge" style="background-color:#000;color:#FFF"><?php echo $tipo_os; ?></span></h5>
															</div>
														</div><br>
														<div class="row">
															<div class="col-12">
																CLIENTE: <b><?php echo $nome_cliente; ?></b>
															</div>
														</div><br>
														<div class="row">
															<div class="col-12">
																VEÍCULO: <b><?php echo $marca_veiculo; ?>/<?php echo $modelo_veiculo; ?></b>
															</div>
														</div><br>
														<div class="row">
															<div class="col-12">
																CIDADE: <b><?php echo $cidade; ?>/<?php echo $estado; ?></b>
															</div>
														</div><br>
														<div class="row">
															<div class="col-12">
																DIA/HORA: <b><?php echo $data_agenda; ?></b>
															</div>
														</div><br>
														<div class="row">
															<div class="col-12">
																<a href="grid_device.php?deviceid=<?php echo $deviceid?>&id=<?php echo $id_push?>&id_os=<?php echo $id_os?>"><button type="button" class="btn btn-dark">Abrir OS</button></a>
															</div>
														</div><br>
													</div>
												</div>
											</div>	
											
										<?php }}	
									
									?>
								</div>
							</div>
									
								
						</div>
                       
						
                    </main>
					
					
					 
					
					
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
