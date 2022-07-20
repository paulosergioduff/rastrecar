
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
					
					$cons_veiculo = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE deviceid = '$deviceid'");
					if(mysqli_num_rows($cons_veiculo) > 0){
						while ($resp_veiculos = mysqli_fetch_assoc($cons_veiculo)) {
						$placa = 	$resp_veiculos['placa'];
						$modelo_veiculo = 	$resp_veiculos['modelo_veiculo'];
						$marca_veiculo = 	$resp_veiculos['marca_veiculo'];
					}}
					?>
					<form name="forml" action="eventos1.php" method="post">
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
							<div class="col-md-4">
								<div class="form-group">
									<label>Período:</label>
										<select class="form-control" name="data_inicial" id="data_inicial">
											<option value="2">Últimas 2 horas</option>
											<option value="4">Últimas 4 horas</option>
											<option value="8">Últimas 8 horas</option>
											<option value="12">Últimas 12 horas</option>
											<option value="24">Últimas 24 horas</option>
										</select>
								</div>
							</div>
						</div>
                       <br>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<button type="submit" data-toggle="modal" data-target="#carregar" class="btn btn-dark" style="width:100%">Gerar Relatório</button>
								</div>
							</div>
						</div> <br><br>
						<div class="row" style="height: 100%; overflow: auto;">
						<div class="col-md-12">
							<div class="form-group text-center">
								Este relatório irá demonstrar os eventos e alertas emitidos pelo veiculo.
							</div>
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
