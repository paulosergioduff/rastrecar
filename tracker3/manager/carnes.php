<?php include('conexao.php');?>

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
                    <?php include('include/head.php')?>
                    <!-- END Page Header -->
                    <!-- BEGIN Page Content -->
                    <!-- the #js-page-content id is needed for some plugins to initialize -->
                    <main id="js-page-content" role="main" class="page-content">
					
						<div class="row">
                            <div class="col-xl-8">
								<div class="subheader">
									<h1 class="subheader-title">
										<i class='subheader-icon fal fa-arrows-alt'></i> Carnês Asaas
										<small>
											Lista de Carnês 
										</small>
									</h1>
								</div>
							</div>
							
						</div>
                        
                        
                        <div class="row">
                            <div class="col-xl-12">
                                <div id="panel-1" class="panel">
                                    
                                    <div class="panel-container show">
                                        <div class="panel-content">
											<table id="dt-basic-example" class="table table-bordered table-hover table-striped nowrap" style="width:100%">
												<thead>
													<tr>
														<th></th>
														<th>Data Inicio</th>
														<th>Cliente</th>
														<th>Status</th>
														<th>Qtd Parcelas</th>
														<th>Valor Parcela</th>
														<th>Valor Total</th>
														<th>Data Término</th>
													</tr>
												</thead>
											<tbody>
											<?php
											$data_hoje1 = date('Y-m-d');
											$resultado_usuario = mysqli_query($conn,"SELECT * FROM carnes WHERE id_empresa='$id_empresa' ORDER BY id_carne ASC");
											if(mysqli_num_rows($resultado_usuario) > 0){
											while($row_usuario = mysqli_fetch_assoc($resultado_usuario)){
											$id_carne = $row_usuario['id_carne'];
											$id_cliente = $row_usuario['id_cliente'];
											$parcelas = $row_usuario['parcelas'];
											$valor_parcela = $row_usuario['valor_parcela'];
											$valor_parcela = number_format($valor_parcela, 2, ",", ".");
											$valor_total = $row_usuario['valor_total'];
											$valor_total = number_format($valor_total, 2, ",", ".");
											$data_criacao = $row_usuario['data_criacao'];
											$data_criacao = date('d/m/Y', strtotime("$data_criacao"));
											$data_termino1 = $row_usuario['data_termino'];
											$data_termino = date('d/m/Y', strtotime("$data_termino1"));
											
											
											
											
											$data_hoje = date('Y-m-d');
											$d1 = strtotime($data_hoje); 
											$d2 = strtotime($data_termino1);
											
											$dataFinal = ($d2 - $d1) /86400;
											
											if($dataFinal < 0)
											$dataFinal *= -1;
											
											if($dataFinal > 30){
												$vencimento_recorrencia = '<h5><span class="badge" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Carnê em Prazo Normal" style="background-color:#009900;color:#FFF">'.$data_termino.'</span></h5>';
												$status = '<h5><span class="badge" style="background-color:#009900;color:#FFF"><i class="fas fa-check"></i> NORMAL</span></h5>';
											}
											if($dataFinal <= 30 && $dataFinal >= 1){
												$vencimento_recorrencia = '<h5><span class="badge" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Carnê Próximo do Vencimento" style="background-color:#F4A460;color:#FFF">'.$data_termino.'</span></h5>';
												$status = '<h5><span class="badge" style="background-color:#F4A460;color:#FFF">VENCENDO</span></h5>';
											}
											if($data_termino1 < $data_hoje){
												$vencimento_recorrencia = '<h5><span class="badge" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Carnê Vencido" style="background-color:#CD5C5C;color:#FFF">'.$data_termino.'</span></h5>';
												$status = '<h5><span class="badge" style="background-color:#CD5C5C;color:#FFF"><i class="fas fa-ban"></i> VENCIDO</span></h5>';
											}
											
											
											$cons_cliente = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
												if(mysqli_num_rows($cons_cliente) > 0){
													while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
													$nome_cliente = 	$resp_cliente['nome_cliente'];
												}}
											
											
											
											
											
											
											$base64 = 'id_carne:'.$id_carne.'';
											$base64 = base64_encode($base64);
											
											$base64_1 = 'id_cliente:'.$id_cliente.'';
											$base64_1 = base64_encode($base64_1);
											
											
											
											$botao_excluir = '<button type="button" class="btn btn-danger btn-xs shadow-0"  data-toggle="modal" data-target="#encerrar'.$id_carne.'">Encerrar Recorrência</button>';
											
											
											?>
											<tr>
												<td><a href="cad_cliente.php?c=<?php echo $base64_1?>"><button type="button" class="btn btn-dark btn-icon btn-sm"><i class="fab fa-elementor" data-toggle="tooltip" data-placement="top" data-original-title="Abrir Cadastro"></i></a> 
												<a href="del_carne_2.php?id_carne=<?php echo $id_carne?>"><button type="button" class="btn btn-danger btn-icon btn-sm"><i class="fal fa-trash" data-toggle="tooltip" data-placement="top" data-original-title="Excluir"></i></button></a>
												</td>
												<td><?php echo $data_criacao; ?></td>
												<td><?php echo $nome_cliente; ?></td>
												<td><?php echo $status?></td>
												<td><?php echo $parcelas; ?> Parcelas</td>
												<td>R$ <?php echo $valor_parcela; ?></td>
												<td>R$ <?php echo $valor_total; ?></td>
												<td><?php echo $vencimento_recorrencia; ?></td>
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
        <!-- BEGIN Quick Menu -->
			<?php include('include/quick_menu.php');?>
        <!-- END Quick Menu -->
        <!-- BEGIN Messenger -->
			<?php include('include/messenger.php');?>
        <!-- END Messenger -->
        <!-- BEGIN Page Settings -->
			<?php include('include/settings.php');?>
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
