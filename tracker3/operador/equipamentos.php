<?php include('conexao.php');

?>

<!DOCTYPE html>

<html lang="en">
    <head>
           <meta charset="utf-8"/>
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
        <link rel="icon" type="image/png" sizes="32x32" href="/tracker3/app-assets/img/favicon/favicon-32x32.png">
        <link rel="mask-icon" href="/tracker3/app-assets/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/datagrid/datatables/datatables.bundle.css">
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
                <aside class="page-sidebar" style="background-color:#14145A">
                    <div style="background-color:#14145A">
                        <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative">
                           <img src="/tracker/Imagens/logo1.png" style="width:200px; heigth:auto" alt="SmartAdmin WebApp" aria-roledescription="logo">
                            
                            
                        </a>
                    </div>
                    <?php include('include/sidebar.php')?>
                    
                </aside>
                <!-- END Left Aside -->
                <div class="page-content-wrapper ">
                    <!-- BEGIN Page Header -->
                    <?php include('include/head.php');
						if($acesso == 'GERAL'){
							$botao_loja1 = ' - LOJA HORIZONTE';
							$botao_loja2 = '<a href="veiculos2.php"><button type="button" class="btn btn-dark btn-sm"><i class="fal fa-home"></i> Loja Fortaleza</button></a>';	
						}
						if($id_empresa == '1361'){
							$botao_loja1 = ' - LOJA HORIZONTE';
						}
						if($id_empresa == '1362'){
							$botao_loja1 = ' - LOJA FORTALEZA';
						}
					?>
                    <!-- END Page Header -->
                    <!-- BEGIN Page Content -->
                    <!-- the #js-page-content id is needed for some plugins to initialize -->
                    <main id="js-page-content" role="main" class="page-content">
					
						<div class="row">
                            <div class="col-xl-8">
								<div class="subheader">
									<h1 class="subheader-title">
										<i class='subheader-icon fal fa-boxes'></i> Estoque<?php echo $botao_loja1;?>
										<small>
											Estoque de Dispositivos
										</small>
									</h1>
								</div>
							</div>
							<div class="col-xl-4 text-right">
							<?php echo $botao_loja2;?>
							<a href="novo_equipamento.php?p=clientes"><button type="button" class="btn btn-info btn-sm" style="font-size:14px"><i class="fal fa-user-plus"></i> Novo Registro</button></a>
							</div>
						</div>
                        
                        
                        <div class="row">
                            <div class="col-xl-12">
                                <div id="panel-1" class="panel">
                                    
                                    <div class="panel-container show">
                                        <div class="panel-content">
										<table id="dt-basic-example" class="table table-bordered table-hover table-striped nowrap">
												<thead>
													<tr>		
														<th></th>
														<th style="width:6%">Status</th>
														<th>Modelo</th>
														<th style="width:9%">IMEI</th>
														<th style="width:7%">Chip</th>
														<th style="width:10%">Data Conexão</th>
														<th style="width:10%">Data GPS</th>
														<th>Operadora</th>
														<th>Fornecedor</th>
													</tr>
												</thead>
											<tbody>
											<?php
				
											$result_usuario = "SELECT * FROM estoque_rastreadores WHERE status='ESTOQUE' AND id_empresa='$id_empresa'";
											$resultado_usuario = mysqli_query($conn, $result_usuario);
											if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
											
											while($row_usuario = mysqli_fetch_assoc($resultado_usuario)){
											$id_equip = $row_usuario['id_equip'];
											$modelo_equip = $row_usuario['modelo_equip'];
											$imei = $row_usuario['imei'];
											$chip = $row_usuario['chip'];
											$operadora = $row_usuario['operadora'];
											$deviceid = $row_usuario['deviceid'];
											$lastupdate = 	$row_usuario['data_server'];
											$fornecedor_chip = 	$row_usuario['fornecedor_chip'];
											
											if($lastupdate == 'Sem Conexao'){
												$data_server = '<h5><span class="badge" style="background-color:#999;color:#FFF">Sem Conexão</span></h5>';
											}
											if($lastupdate != 'Sem Conexao'){
												$data_server = date('d/m/Y H:i:s', strtotime('-3 hour', strtotime($lastupdate)));
											}
											
											$data_gps1 = 	$row_usuario['data_gps'];
											
											if($data_gps1 == 'Sem Posicao'){
												$data_gps = '<h5><span class="badge" style="background-color:#999;color:#FFF">Sem Posição</span></h5>';
											}
											if($data_gps1 != 'Sem Posicao'){
												$data_gps = date('d/m/Y H:i:s', strtotime('-3 hour', strtotime($data_gps1)));
											}
											
											
											$data_agora = date('Y-m-d H:i:s');
											$data_agora = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_agora)));

											$data_inicial_12 = date('Y-m-d H:i:s', strtotime('-5 minutes', strtotime($data_agora)));
											
											
											if($lastupdate <= $data_inicial_12){
												$conect = '<h5><span class="badge" style="background-color:#CD5C5C;color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" title="OFFLINE" data-content="Dispositivo sem comunicação desde '.$data_server.'"><i class="fas fa-wifi"></i> OFFLINE</span></h5>';
												
											} 
											if($lastupdate > $data_inicial_12){
												$conect = '<h5><span class="badge" style="background-color:#009900;color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" title="ONLINE" data-content="Data/hora: '.$data_server.'"><i class="fas fa-wifi"></i> ONLINE</span></h5>';
												
											}
											if($lastupdate == 'Sem Conexao' or $lastupdate == null){
												$conect = '<h5><span class="badge" style="background-color:#999;color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" title="OFFLINE" data-content="Dispositivo sem histórico de comunicação" data-original-title="O"><i class="fas fa-wifi"></i> DESCONETADO</span></h5>';
												
												
											}
											
											
											$base64 = 'id_equip:'.$id_equip.'';
											$base64 = base64_encode($base64);
											
											?>
											<tr>
													
													<td><a href="editar_equipamento.php?c=<?php echo $base64?>"><button type="button" class="btn btn-dark btn-icon btn-sm"><i class="fab fa-elementor"></i></button></a>
													</td>
													<td><?php echo $conect; ?></td>
													<td><?php echo $modelo_equip; ?></td>
													<td><?php echo $imei; ?></td>
													<td><?php echo $chip; ?></td>
													<td><?php echo $data_server; ?></td>
													<td><?php echo $data_gps; ?></td>
													<td><?php echo $operadora; ?></td>
													<td><?php echo $fornecedor_chip; ?></td>
												</tr>
											<?php
											}}?>
											</tbody>
											</table>
											
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
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

        <!-- END Page Settings -->
      
        <script src="/tracker3/app-assets/js/vendors.bundle.js"></script>
        <script src="/tracker3/app-assets/js/app.bundle.js"></script>
        <script src="/tracker3/app-assets/js/datagrid/datatables/datatables.bundle.js"></script>

        <script>
            /* demo scripts for change table color */
            /* change background */


            $(document).ready(function()
            {
                $('#dt-basic-example').dataTable(
                {

                    responsive: true,
					colReorder: true,
					order: [[ 1, "desc" ]]
					
                });

              

            });

        </script>
    </body>
</html>
