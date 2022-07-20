<?php include('conexao.php');

$cons_usuario20 = mysqli_query($conn,"SELECT * FROM usuarios WHERE id_usuarios='$user_id'");
	if(mysqli_num_rows($cons_usuario20) > 0){
while ($resp_usuario11 = mysqli_fetch_assoc($cons_usuario20)) {
$id_cliente10 = 	$resp_usuario11['id_cliente'];
	}}
	
$cons_cli_cor = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente10'");
	if(mysqli_num_rows($cons_cli_cor) > 0){
while ($resp_cor = mysqli_fetch_assoc($cons_cli_cor)) {
$cor_sistema = 	$resp_cor['cor_sistema'];
$logo = 	$resp_cor['logo'];
$login_padrao = 	$resp_cor['subdominio'];

	}}

?>



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
        <link rel="icon" type="image/png" sizes="32x32" href="/tracker3/manager/logos/<?php echo $logo?>">
        <link rel="mask-icon" href="/tracker3/app-assets/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/datagrid/datatables/datatables.bundle.css">
		<link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/fa-solid.css">
		<link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/statistics/chartjs/chartjs.css">
		
    </head>
    <body class="mod-bg-1 nav-function-fixed header-function-fixed">
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
                           <img src="/tracker3/manager/logos/<?php echo $logo?>" style="width:200px; heigth:auto" alt="SmartAdmin WebApp" aria-roledescription="logo">
                            
                            
                        </a>
                    </div>
                    <?php include('include/sidebar.php')?>
                    
                </aside>
                <!-- END Left Aside -->
                <div class="page-content-wrapper header-function-fixed">
                    <!-- BEGIN Page Header -->
                    <?php include('include/head.php')?>
                    
					<?php
					
					$cont_veiculos_ativos = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE status='1' AND deviceid >= '1' AND id_cliente_pai='$id_cliente10'");
					$total_veiculos_ativos = mysqli_num_rows($cont_veiculos_ativos);
					
					
					$cont_clientes_ativos = mysqli_query($conn,"SELECT * FROM clientes WHERE status='1' AND id_cliente_pai='$id_cliente10'");
					$total_clientes_ativos = mysqli_num_rows($cont_clientes_ativos);
					
					
					?>
					
					
                    <main id="js-page-content" role="main" class="page-content">
					
						<div class="row">
                            <div class="col-xl-8">
								<div class="subheader">
									<h1 class="subheader-title">
										<i class='subheader-icon fal fa-chart-area'></i> Dashboard Analítico
										<small>
											DADOS ANALÍTICOS
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
											<div class="row">
												<div class="col-lg-6 col-sm-6 col-12">
													<div class="card text-center" style="border:#CCC 1px solid;">
														<div class="card-content">
															<div class="card-body">
																<div class="avatar bg-rgba-primary p-50 m-0 mb-1">
																	<div class="avatar-content">
																		<i class="fas fa-car fa-3x" style="color:#003366"></i>
																	</div>
																</div>
																<h2 class="text-bold-700"><?php echo $total_veiculos_ativos?></h2>
																<p class="mb-0 line-ellipsis"><b>VEÍCULOS ATIVOS</b></p>
															</div>
														</div>
													</div>
												</div>
												
												<div class="col-lg-6 col-sm-6 col-12">
													<div class="card text-center" style="border:#CCC 1px solid;">
														<div class="card-content">
															<div class="card-body">
																<div class="avatar bg-rgba-primary p-50 m-0 mb-1">
																	<div class="avatar-content">
																		<i class="fas fa-user fa-3x" style="color:#003366"></i>
																	</div>
																</div>
																<h2 class="text-bold-700"><?php echo $total_clientes_ativos?></h2>
																<p class="mb-0 line-ellipsis"><b>CLIENTES ATIVOS</b></p>
															</div>
														</div>
													</div>
												</div>
												
											   
												
											</div>
                                         
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						<div class="row">
							<div class="col-md-12">
								<div class="card" style="border:#CCC 1px solid;">
									<div class="card-header">
										<h4 class="card-title"><b>COMPARATIVO NOVOS VEÍCULOS NOS ÚLTIMOS 6 MESES</b></h4>
									</div>
									<div class="card-content">
										<div class="card-body">
											<div class="height-300">
												<div id="novos_veiculos"></div>
											</div>
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

      
		<?php
		
		
		$meses = array("01" => "Janeiro","02" => "Fevereiro", "03" => "Março", "04" => "Abril", "05" => "Maio", "06" => "Junho", "07" =>"Julho", "08" => "Agosto", "09" => "Setembro", "10" => "Outubro", "11" => "Novembro", "12" => "Dezembro");
		
		$data_agora = date('Y-m-d');
		$mes_atual = date("m");
		$ano_atual = date('Y');
		
		$mes_atual_1 = $meses[$mes_atual];
		
		$cons_mes_atual = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE MONTH(data_contrato) = '$mes_atual' AND YEAR(data_contrato) = '$ano_atual' AND status='1' AND id_cliente_pai='$id_cliente10' ORDER BY data_contrato DESC");
		$total_mes_1 = mysqli_num_rows($cons_mes_atual);
		
		#===============================================================================
		
		$mes_2 = date('m', strtotime('-30 days', strtotime($data_agora)));
		$ano_2 = date('Y', strtotime('-30 days', strtotime($data_agora)));
		$mes_atual_2 = $meses[$mes_2];
		
		$cons_mes_2 = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE MONTH(data_contrato) = '$mes_2' AND YEAR(data_contrato) = '$ano_2' AND status='1' AND iid_cliente_pai='$id_cliente10' ORDER BY data_contrato DESC");
		$total_mes_2 = mysqli_num_rows($cons_mes_2);
		
		#===============================================================================
		
		$mes_3 = date('m', strtotime('-60 days', strtotime($data_agora)));
		$ano_3 = date('Y', strtotime('-60 days', strtotime($data_agora)));
		$mes_atual_3 = $meses[$mes_3];
		
		$cons_mes_3 = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE MONTH(data_contrato) = '$mes_3' AND YEAR(data_contrato) = '$ano_3' AND status='1' AND id_cliente_pai='$id_cliente10' ORDER BY data_contrato DESC");
		$total_mes_3 = mysqli_num_rows($cons_mes_3);
		
		#===============================================================================
		
		$mes_4 = date('m', strtotime('-90 days', strtotime($data_agora)));
		$ano_4 = date('Y', strtotime('-90 days', strtotime($data_agora)));
		$mes_atual_4 = $meses[$mes_4];
		
		$cons_mes_4 = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE MONTH(data_contrato) = '$mes_4' AND YEAR(data_contrato) = '$ano_4' AND status='1' AND id_cliente_pai='$id_cliente10' ORDER BY data_contrato DESC");
		$total_mes_4 = mysqli_num_rows($cons_mes_4);
		
		#===============================================================================
		
		$mes_5 = date('m', strtotime('-120 days', strtotime($data_agora)));
		$ano_5 = date('Y', strtotime('-120 days', strtotime($data_agora)));
		$mes_atual_5 = $meses[$mes_5];
		
		$cons_mes_5 = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE MONTH(data_contrato) = '$mes_5' AND YEAR(data_contrato) = '$ano_5' AND status='1' AND id_cliente_pai='$id_cliente10'  ORDER BY data_contrato DESC");
		$total_mes_5 = mysqli_num_rows($cons_mes_5);
		
		#===============================================================================
		
		$mes_6 = date('m', strtotime('-150 days', strtotime($data_agora)));
		$ano_6 = date('Y', strtotime('-150 days', strtotime($data_agora)));
		$mes_atual_6 = $meses[$mes_6];
		
		$cons_mes_6 = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE MONTH(data_contrato) = '$mes_6' AND YEAR(data_contrato) = '$ano_6' AND status='1' AND id_cliente_pai='$id_cliente10' ORDER BY data_contrato DESC");
		$total_mes_6 = mysqli_num_rows($cons_mes_6);
		
		?>
	  
	  
	  
        <script src="/tracker3/app-assets/js/vendors.bundle.js"></script>
        <script src="/tracker3/app-assets/js/app.bundle.js"></script>
        <script src="/tracker3/app-assets/js/datagrid/datatables/datatables.bundle.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
var options = {
          series: [{
          name: 'Novos Veículos',
          data: [<?php echo $total_mes_6?>, <?php echo $total_mes_5?>, <?php echo $total_mes_4?>, <?php echo $total_mes_3?>, <?php echo $total_mes_2?>, <?php echo $total_mes_1?>]
        }],
          chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: ['<?php echo $mes_atual_6?>', '<?php echo $mes_atual_5?>', '<?php echo $mes_atual_4?>', '<?php echo $mes_atual_3?>', '<?php echo $mes_atual_2?>', '<?php echo $mes_atual_1?>'],
        },
        yaxis: {
          title: {
            text: ''
          }
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return val
            }
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#novos_veiculos"), options);
        chart.render();
		
</script>
    </body>
</html>
