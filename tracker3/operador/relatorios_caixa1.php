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
						$botao_loja1 = ' - Loja Horizonte';
						$botao_loja2 = '<a href="relatorios_caixa2.php"><button type="button" class="btn btn-dark btn-sm shadow-0" style="font-size:14px"><i class="fal fa-home"></i> Loja Fortaleza</button></a>';
						
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
										<i class='subheader-icon fal fa-dollar-sign'></i> Relatórios Caixa<?php echo $botao_loja1;?>
										
									</h1>
								</div>
							</div>
							<div class="col-xl-4 text-right">
							<?php echo $botao_loja2;?>
							
							</div>
						</div>
                        
                        
                        <div class="row">
                            <div class="col-xl-12">
                                <div id="panel-1" class="panel">
                                    
                                    <div class="panel-container show">
                                        <div class="panel-content">
										<table id="dt-basic-example" class="table table-bordered table-hover table-striped nowrap" >
												<thead>
													<tr>
														<th></th>
														<th>DATA</th>
														<th>OPERADOR</th>
														<th>VALOR INICIAL</th>
														<th>VALOR FINAL</th>
														<th>STATUS</th>
														<th>AÇÕES</th>
													</tr>
												</thead>
											<tbody>
											<?php
												
												$result_usuario = "SELECT * FROM caixa WHERE id_empresa='$id_empresa' ORDER BY data DESC";
												$resultado_usuario = mysqli_query($conn, $result_usuario);
												if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
												while($row_usuario = mysqli_fetch_assoc($resultado_usuario)){
												$id_caixa = $row_usuario['id_caixa'];
												$data = $row_usuario['data'];
												$data1 = date('d/m/Y', strtotime("$data"));
												$valor_inicial = $row_usuario['valor_inicial'];
												$valor_inicial = number_format($valor_inicial, 2, ",", ".");
												$montante = $row_usuario['montante'];
												$montante = number_format($montante, 2, ",", ".");
												$user_fim = $row_usuario['user_fim'];
												$user_inicio = $row_usuario['user_inicio'];
												$status = $row_usuario['status'];
												
												if($status == 'ABERTO'){
													$tipo1 = '<h5><span class="badge badge-warning"><i class="fal fa-folder-open"></i> ABERTO</span></h5>';
													
												}
												if($status == 'FECHADO'){
													$tipo1 = '<h5><span class="badge" style="background-color:#009900;color:#FFF"><i class="fal fa-folder"></i> FECHADO</span></h5>';
													
												}
											
													
												$base64 = 'id_caixa:'.$id_caixa;
												$base64 = base64_encode($base64);
													
												?>
											<tr>
												<th></th>
												<th><?php echo $data1?></th>
												<th><?php echo $user_inicio?></th>
												<td>R$ <?php echo $valor_inicial; ?></td>
												<td>R$ <?php echo $montante; ?></td>
												<td><?php echo $tipo1; ?></td>
												<td>
													<a href="movimento_caixa.php?c=<?php echo $base64; ?>"><button type="button" class="btn btn-icon btn-outline-dark btn-sm" data-toggle="tooltip" data-trigger="hover" data-placement="top" title="Abrir Cadastro"><i class="fas fa-search"></i></button></a>
												</td>
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
					
						<?php
					$caixa = $_GET['caixa'];
					$valor_caixa = $_GET['valor_caixa'];
					$valor_caixa1 = number_format($valor_caixa, 2, ",", ".");
					if($valor_caixa > 0 && $caixa == 'ok'){

					?>
					<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
					<script>
								$(document).ready(function(){
									$('#vcaixa').modal('show');
								});
							</script>
						<?php } ?>
						<div class="modal fade" id="vcaixa" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-body text-center font-18">
										<h3 class="mb-20">CAIXA ABERTO COM SUCESSO!</h3>
										<div class="mb-30 text-center"><img src="/tracker/Imagens/success.png"></div><br><br>
										Valor Incial do caixa: R$ <?php echo $valor_caixa1?>
									</div>
									<div class="modal-footer justify-content-center">
										<button type="button" class="btn btn-dark" data-dismiss="modal">OK</button>
									</div>
								</div>
							</div>
						</div>
				
					
						<?php
						$caixa1 = $_GET['caixa'];
						$valor_cx = $_GET['valor_caixa'];
						$valor_cx1 = number_format($valor_cx, 2, ",", ".");
						if($caixa1 == 'fechado'){

						?>
						<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
						<script>
									$(document).ready(function(){
										$('#vcaixa1').modal('show');
									});
								</script>
							<?php } ?>
							<div class="modal fade" id="vcaixa1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-body text-center font-18">
											<h3 class="mb-20">CAIXA FECHADO COM SUCESSO!</h3>
											<div class="mb-30 text-center"><img src="/tracker/Imagens/success.png"></div><br><br>
											Valor Final do caixa: R$ <?php echo $valor_cx1?>
										</div>
										<div class="modal-footer justify-content-center">
											<button type="button" class="btn btn-dark" data-dismiss="modal">OK</button>
										</div>
									</div>
								</div>
							</div>	
                    <!-- this overlay is activated only when mobile menu is triggered -->
                    <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div> <!-- END Page Content -->
                    <!-- BEGIN Page Footer -->
						<?php include('include/footer.php');?>
                    <!-- END Page Footer -->
                    <!-- BEGIN Shortcuts -->
                   <input type="hidden" id="empresa" value="<?php echo $id_empresa?>">
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
					colReorder: true
					
                });

              

            });

        </script>



    </body>
</html>
