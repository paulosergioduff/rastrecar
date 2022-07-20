<?php include('conexao.php');
$cons_empresa = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='1361'");
	if(mysqli_num_rows($cons_empresa) > 0){
while ($resp_empresa = mysqli_fetch_assoc($cons_empresa)) {
$nome_url = $resp_empresa['nome_url'];
$logo = $resp_empresa['logo'];
$texto_rodape = $resp_empresa['texto_rodape'];
$texto_topo = $resp_empresa['texto_topo'];
$cor_sistema = $resp_empresa['cor_sistema'];
	}}
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
                <aside class="page-sidebar" style="background-color:#FFF">
                    <div style="background-color:#FFF">
                        <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative">
                           <img src="logos/<?php echo $logo?>" style="width:200px; heigth:auto" alt="SmartAdmin WebApp" aria-roledescription="logo">
                            
                            
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
										<i class='subheader-icon fal fa-car'></i> Veículos
										<small>
											Cadastro de Veículos
										</small>
									</h1>
								</div>
							</div>
							<div class="col-xl-4 text-right">
								<a href="veiculos_relatorios.php"><button type="button" class="btn btn-dark btn-sm"><i class="fal fa-file"></i> Relatórios</button></a>
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
														<th>#</th>
														<th><i class="fas fa-cogs"></i> Opções</th>
														<th><i class="far fa-address-card"></i> Placa</th>
														<th><i class="fas fa-car"></i> Veículo</th>
														<th><i class="fas fa-wifi"></i> Conexão</th>
														<th><i class="far fa-clock"></i> Últ. Conexão</th>
														<th><i class="fas fa-map-marker-alt"></i> Data GPS</th>
														<th><i class="fas fa-sign-out-alt"></i> Status</th>
														<th><i class="fas fa-user"></i> Cliente</th>
														<th><i class="fas fa-mobile"></i> Equipamento</th>
														<th><i class="fas fa-qrcode"></i> IMEI</th>
														<th><i class="fas fa-sim-card"></i> Chip</th>
														<th><i class="fas fa-sim-card"></i> Iccid</th>
														<th><i class="fas fa-signal"></i> Operadora</th>
														<th><i class="fas fa-hotel"></i> Fornecedor</th>
														<th><i class="fas fa-cart-arrow-down"></i> Plano</th>
														<th><i class="fas fa-file-invoice-dollar"></i> Valor Mensal</th>
														<th><i class="fas fa-hand-holding-usd"></i> Forma Pgto</th>
													</tr>
												</thead>
											
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
        $(document).ready(function(){
			
            $('#dt-basic-example').DataTable({
				'responsive': true,
                'processing': true,
                'serverSide': true,
				'lengthChange': true,
                'serverMethod': 'post',
                'ajax': {
                    'url':'include/list_veiculos1.php'
                },
                'columns': [
                    { data: 'id_veiculo' },
                    { data: 'opcoes' },
                    { data: 'placa' },
                    { data: 'modelo_veiculo' },
                    { data: 'conect' },
                    { data: 'data_server' },
                    { data: 'data_gps' },
                    { data: 'status' },
                    { data: 'nome_cliente' },
                    { data: 'modelo_equip' },
                    { data: 'imei' },
                    { data: 'chip' },
                    { data: 'iccid' },
                    { data: 'operadora' },
                    { data: 'fornecedor_chip' },
                    { data: 'pacote' },
                    { data: 'valor_mensal' },
                    { data: 'forma_pagamento' },
                ]
				
            });
        });
        </script>

    </body>
</html>
