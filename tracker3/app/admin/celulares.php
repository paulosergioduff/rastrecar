
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

						}}	
					
					
					
					?>
					
                    <main id="js-page-content" role="main" class="page-content">
					
						<div class="row">
                            <div class="col-xl-8">
								<div class="subheader">
									<h1 class="subheader-title">
										<i class='subheader-icon fal fa-mobile-android-alt'></i> Celulares
										
									</h1>
								</div>
							</div>
							
						</div>
                        <input type="hidden" id="id_cliente_login" value="<?php echo $id_cliente_login?>">
						<input type="hidden" id="id_push" value="<?php echo $id_push?>">
						<div class="row">
                            <div class="col-12">
								 <div id="panel-1" class="panel">
                                    
                                    <div class="panel-container show">
                                        <div class="panel-content">
											<?php
											
											 $cons_cel = mysqli_query($conn,"SELECT * FROM usuarios_push WHERE id_cliente='$id_cliente'");
											if(mysqli_num_rows($cons_cel) > 0){
												while ($resp_cel = mysqli_fetch_assoc($cons_cel)) {
												$id_push_2 = 	$resp_cel['id_push'];
												$modelo = 	$resp_cel['modelo'];
												$ultimo_login = 	$resp_cel['ultimo_login'];
												$ultimo_login = date('d/m/Y H:i', strtotime("$ultimo_login"));
												
												if($id_push_2 == $id_push){
													$meu_dispositivo = '(Este Aparelho)';
													$excluir = '';
												}
												if($id_push_2 != $id_push){
													$meu_dispositivo = '';
													$excluir = '<a href="del_celular.php?id='.$id_push.'&id_push='.$id_push_2.'"><button type="button" data-toggle="modal" data-target="#carregar" class="btn btn-dark btn-sm btn-icon"><i class="fal fa-trash-alt"></i></button></a>';
												}
											?>	
											
											<div class="row">
												<div class="col-12">
													<span style="font-size:18px"><?php echo $modelo?> </span><span style="font-size:9px"><?php echo $meu_dispositivo?></span>
												</div>
											</div><br>
											<div class="row">
												<div class="col-8">
													<label>Útimo Acesso:</label>
													<h5><?php echo $ultimo_login?></h5>
												</div>
												<div class="col-4 text-right">
													<?php echo $excluir?>
												</div>
											</div>
											<hr style="border:#CCC 1px dashed;">
											
											
											
											
											<?php
											}}	
					
											?>
											
                                        </div>
                                    </div>
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
