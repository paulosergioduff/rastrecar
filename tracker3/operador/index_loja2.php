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
                <aside class="page-sidebar" style="background-color:#14145A">
                    <div style="background-color:#14145A">
                        <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative">
                           <img src="/tracker/Imagens/logo1.png" style="width:200px; heigth:auto" alt="SmartAdmin WebApp" aria-roledescription="logo">
                            
                            
                        </a>
                    </div>
                    <?php include('include/sidebar.php')?>
                    
                </aside>
                <!-- END Left Aside -->
                <div class="page-content-wrapper header-function-fixed">
                    <!-- BEGIN Page Header -->
                    <?php include('include/head.php')?>
                    
					<?php
					
					if($acesso == 'GERAL'){
						$botao_loja1 = '';
						$botao_loja2 = '<a href="index.php"><button type="button" class="btn btn-dark btn-sm"><i class="fal fa-home"></i> Loja Horizonte</button></a>';
						
					}
					$id_empresa = '1362';
					$cont_veiculos_ativos = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE status='1' AND deviceid >= '1' AND id_empresa='$id_empresa'");
					$total_veiculos_ativos = mysqli_num_rows($cont_veiculos_ativos);
					
					$cont_assist_ativos = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE protecao ='SIM' AND id_empresa='$id_empresa'");
					$total_assist_ativos = mysqli_num_rows($cont_assist_ativos);
					
					$cont_clientes_ativos = mysqli_query($conn,"SELECT * FROM clientes WHERE status='1' AND id_empresa='$id_empresa'");
					$total_clientes_ativos = mysqli_num_rows($cont_clientes_ativos);
					
					$cont_clientes_block = mysqli_query($conn,"SELECT * FROM clientes WHERE status='2' AND id_empresa='$id_empresa'");
					$total_clientes_block = mysqli_num_rows($cont_clientes_block);
					?>
					
					
                    <main id="js-page-content" role="main" class="page-content">
					
						<div class="row">
                            <div class="col-xl-8">
								<div class="subheader">
									<h1 class="subheader-title">
										<i class='subheader-icon fal fa-chart-area'></i> Dashboard Analítico
										<small>
											LOJA FORTALEZA
										</small>
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
											<div class="row">
												<div class="col-lg-3 col-sm-6 col-12">
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
												<div class="col-lg-3 col-sm-6 col-12">
													<div class="card text-center" style="border:#CCC 1px solid;">
														<div class="card-content">
															<div class="card-body">
																<div class="avatar bg-rgba-success p-50 m-0 mb-1">
																	<div class="avatar-content">
																		<img src="/tracker2/manager/imagens/defenf.jpeg" style="width:38px; height:38px">
																	</div>
																</div>
																<h2 class="text-bold-700"><?php echo $total_assist_ativos?></h2>
																<p class="mb-0 line-ellipsis"><b>ATIVOS PROTEÇÃO</b></p>
															</div>
														</div>
													</div>
												</div>
												<div class="col-lg-3 col-sm-6 col-12">
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
												<div class="col-lg-3 col-sm-6 col-12">
													<div class="card text-center" style="border:#CCC 1px solid;">
														<div class="card-content">
															<div class="card-body">
																<div class="avatar bg-rgba-danger p-50 m-0 mb-1" style="cursor:pointer;" data-toggle="modal" data-target="#clientes_bloqueados">
																	<div class="avatar-content">
																		<i class="fas fa-user-times fa-3x" style="color:#990000"></i>
																	</div>
																</div>
																<h2 class="text-bold-700"><?php echo $total_clientes_block?></h2>
																<p class="mb-0 line-ellipsis"><b>CLIENTES BLOQUEADOS</b></p>
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
					
					<div class="modal fade" id="clientes_bloqueados" tabindex="-5" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-xl">
							<div class="modal-content">
								<div class="modal-header bg-danger text-white">
									<h3 class="modal-title" id="myLargeModalLabel" style="color:#FFF;">CLIENTES BLOQUEADOS</h3>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								</div>
								<div class="modal-body pos-center">
									<?php
									include_once "conexao.php";
									$data_v = date('Y-m-d');
									$pagina = filter_input(INPUT_POST, 'pagina', FILTER_SANITIZE_NUMBER_INT);
									$qnt_result_pg = filter_input(INPUT_POST, 'qnt_result_pg', FILTER_SANITIZE_NUMBER_INT);


									//consultar no banco de dados
									$result_usuario = "SELECT * FROM clientes WHERE status='2' AND id_empresa='$id_empresa'";
									$resultado_usuario = mysqli_query($conn, $result_usuario);


									//Verificar se encontrou resultado na tabela "usuarios"
									if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
									?>
									<table class="table table-ms">
									<thead>
									<tr>
									<th>Nome Cliente</th>
									<th>Qtd Veículos</th>
									<th>Telefone</th>
									<th>Status</th>
									</tr>
									</thead>
									<tbody>
									<?php
							while($row_usuario = mysqli_fetch_assoc($resultado_usuario)){
							$id_cliente = $row_usuario['id_cliente'];
							$status = $row_usuario['status'];
							$nome_cliente = $row_usuario['nome_cliente'];
						
							$cons_veic1 = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE id_cliente='$id_cliente' AND status='1'");
							$total_veic = mysqli_num_rows($cons_veic1);
							
							$cons_contas = mysqli_query($conn,"SELECT * FROM contas_receber WHERE descricao='$nome_cliente' AND status='Em Aberto' AND data_vencimento < '$data_v'");
							$total_c = mysqli_num_rows($cons_contas);
							
							if($total_c > 0){
							$atraso = '<span style="color:#990000"><b>'.$row_usuario['nome_cliente'].'</b> <i title="'.$total_c.' Fatura(s) em atraso" class="fal fa-info-square"></i></span>';
							$color_l = 'style="background:#F1E9E7"';
							} else {
								$atraso = '<b><span>'.$row_usuario['nome_cliente'].'</span></b>';
							$color_l = '';	
							}
			
							if($total_veic == 1){
							$icon = '<i class="fas fa-car"></i> Único';
							} else if($total_veic >= 2) {
							$icon = '<i class="fas fa-truck"></i> Frotista';
								}
								
								if($status == 1){
							$status1 = '<button type="button" class="btn btn-success btn-sm" title="Ativo" style="font-size:13px; width:auto; top:0; font-weight: bolder;"><b>ATIVO</b></button>';
							} else if($status == 4){
							$status1 = '<button type="button" class="btn btn-dark btn-sm" style="text-align:center; font-size:13px; top:0; width:auto;"><b>CANCELADO</b></button>';
							} else if($status == 5){
							$status1 = '<button type="button" class="btn btn-dark btn-sm" style="text-align:center; font-size:13px; top:0; width:auto;"><b>CANCELADO</b></button>';
							} else if($status == 11){
							$status1 = '<button type="button" class="btn btn-info btn-sm" style="font-size:13px; top:0; width:auto;"><b>NOVO</b></button>';
							} else if($status == 13){
							$status1 = '<button type="button" class="btn btn-warning btn-sm" style="font-size:13px; top:0; width:auto;"><b>PEDIDO CANCELADO</b></button>';
							} else {
							$status1 = '<button type="button" class="btn btn-danger btn-sm" title="Inativo" style="font-size:13px; top:0; width:auto;"><b>Bloqueado</b></button>';
								}
								
								
								$cons_user = mysqli_query($conn,"SELECT * FROM usuarios WHERE id_cliente='$id_cliente'");
								if(mysqli_num_rows($cons_user) > 0){
							while ($resp_user = mysqli_fetch_assoc($cons_user)) {
							$id_usuarios = 	$resp_user['id_usuarios'];
							$user = '(MOBI)';
								}} else {
									$user = '(HAPOLO)';
								}
							?>
							<tr>
									<td><span style="color:#990000"><b><?php echo $row_usuario['nome_cliente']; ?></b></span></td>
									<td><b><?php echo $total_veic; ?> Veículo(s) - <?php echo $user?></b></td>
									<td><span class="text-dark"><?php echo $row_usuario['telefone_celular']; ?></span></td>
									<td><?php echo $status1; ?></td>
									
								</tr>
								
								
								
								
								
							<?php
							}?>
                    </tbody>
                    </table>
					<?php
	
						}else{
						echo "<div class='alert alert-danger' role='alert'>Nenhum usuário encontrado!</div>";
						}
						?>
								</div>
								<div class="modal-footer">
									 <button type="button" class="btn btn-dark btn-sm" data-dismiss="modal">Fechar</button>
									
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
      
		<?php
		
		
		$meses = array("01" => "Janeiro","02" => "Fevereiro", "03" => "Março", "04" => "Abril", "05" => "Maio", "06" => "Junho", "07" =>"Julho", "08" => "Agosto", "09" => "Setembro", "10" => "Outubro", "11" => "Novembro", "12" => "Dezembro");
		
		$data_agora = date('Y-m-d');
		$mes_atual = date("m");
		$ano_atual = date('Y');
		
		$mes_atual_1 = $meses[$mes_atual];
		
		$cons_mes_atual = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE MONTH(data_contrato) = '$mes_atual' AND YEAR(data_contrato) = '$ano_atual' AND status='1' AND id_empresa='$id_empresa' ORDER BY data_contrato DESC");
		$total_mes_1 = mysqli_num_rows($cons_mes_atual);
		
		#===============================================================================
		
		$mes_2 = date('m', strtotime('-30 days', strtotime($data_agora)));
		$ano_2 = date('Y', strtotime('-30 days', strtotime($data_agora)));
		$mes_atual_2 = $meses[$mes_2];
		
		$cons_mes_2 = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE MONTH(data_contrato) = '$mes_2' AND YEAR(data_contrato) = '$ano_2' AND status='1' AND id_empresa='$id_empresa' ORDER BY data_contrato DESC");
		$total_mes_2 = mysqli_num_rows($cons_mes_2);
		
		#===============================================================================
		
		$mes_3 = date('m', strtotime('-60 days', strtotime($data_agora)));
		$ano_3 = date('Y', strtotime('-60 days', strtotime($data_agora)));
		$mes_atual_3 = $meses[$mes_3];
		
		$cons_mes_3 = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE MONTH(data_contrato) = '$mes_3' AND YEAR(data_contrato) = '$ano_3' AND status='1' AND id_empresa='$id_empresa' ORDER BY data_contrato DESC");
		$total_mes_3 = mysqli_num_rows($cons_mes_3);
		
		#===============================================================================
		
		$mes_4 = date('m', strtotime('-90 days', strtotime($data_agora)));
		$ano_4 = date('Y', strtotime('-90 days', strtotime($data_agora)));
		$mes_atual_4 = $meses[$mes_4];
		
		$cons_mes_4 = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE MONTH(data_contrato) = '$mes_4' AND YEAR(data_contrato) = '$ano_4' AND status='1' AND id_empresa='$id_empresa' ORDER BY data_contrato DESC");
		$total_mes_4 = mysqli_num_rows($cons_mes_4);
		
		#===============================================================================
		
		$mes_5 = date('m', strtotime('-120 days', strtotime($data_agora)));
		$ano_5 = date('Y', strtotime('-120 days', strtotime($data_agora)));
		$mes_atual_5 = $meses[$mes_5];
		
		$cons_mes_5 = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE MONTH(data_contrato) = '$mes_5' AND YEAR(data_contrato) = '$ano_5' AND status='1' AND id_empresa='$id_empresa' ORDER BY data_contrato DESC");
		$total_mes_5 = mysqli_num_rows($cons_mes_5);
		
		#===============================================================================
		
		$mes_6 = date('m', strtotime('-150 days', strtotime($data_agora)));
		$ano_6 = date('Y', strtotime('-150 days', strtotime($data_agora)));
		$mes_atual_6 = $meses[$mes_6];
		
		$cons_mes_6 = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE MONTH(data_contrato) = '$mes_6' AND YEAR(data_contrato) = '$ano_6' AND status='1' AND id_empresa='$id_empresa' ORDER BY data_contrato DESC");
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
