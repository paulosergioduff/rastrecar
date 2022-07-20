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
                    <?php include('include/sidebar.php');
						$id_empresa = 1362;
						if($acesso == 'GERAL'){
							$botao_loja1 = ' - LOJA HORIZONTE';
							$botao_loja2 = '<a href="ordens_servico.php"><button type="button" class="btn btn-dark btn-sm"><i class="fal fa-home"></i> Loja Horizonte</button></a>';	
						}
						if($id_empresa == '1361'){
							$botao_loja1 = ' - LOJA HORIZONTE';
						}
						if($id_empresa == '1362'){
							$botao_loja1 = ' - LOJA FORTALEZA';
						}	
					
					?>
                    
                </aside>
                <!-- END Left Aside -->
                <div class="page-content-wrapper header-function-fixed">
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
										<i class='subheader-icon fal fa-car'></i> Ordens de Serviço<?php echo $botao_loja1;?>
										<small>
											Ordens de Serviço Pendentes
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
											<table id="dt-basic-example" class="table table-bordered table-hover table-striped nowrap" style="width:100%">
												<thead>
													<tr>
														
														<th></th>
														<th>Data Criação</th>
														<th>Veículo</th>
														<th>Cliente</th>
														<th>Tipo</th>
														<th>Status</th>
														<th>Instalador</th>
													</tr>
												</thead>
											<tbody>
											<?php
				
											$result_usuario = "SELECT * FROM ordem_servico WHERE status='1' AND id_empresa='$id_empresa' ORDER BY id_os DESC";
											$resultado_usuario = mysqli_query($conn, $result_usuario);
											if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
											
											while($row_usuario = mysqli_fetch_assoc($resultado_usuario)){
											$id_os = $row_usuario['id_os'];
											$data_criacao = $row_usuario['data_criacao'];
											$data_criacao = date('d/m/Y', strtotime("$data_criacao"));
											$id_cliente = $row_usuario['id_cliente'];
											$id_veiculo = $row_usuario['id_veiculo'];
											$parceiro = $row_usuario['parceiro'];
											$status_os = $row_usuario['status'];
											$tipo_os = $row_usuario['tipo_os'];
											

											
											
											$cons_cliente = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
												if(mysqli_num_rows($cons_cliente) > 0){
													while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
													$nome_cliente = 	$resp_cliente['nome_cliente'];
												}}
											
											
											$cons_veiculo = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE id_veiculo='$id_veiculo'");
												if(mysqli_num_rows($cons_veiculo) > 0){
													while ($resp_status = mysqli_fetch_assoc($cons_veiculo)) {
													$placa = 	$resp_status['placa'];
													$marca_veiculo = 	$resp_status['marca_veiculo'];
													$modelo_veiculo = 	$resp_status['modelo_veiculo'];
													$veiculo = $placa.'-'.$marca_veiculo.'/'.$modelo_veiculo;
													
												}}
											
											$cons_posicao = mysqli_query($conn,"SELECT * FROM parceiros WHERE id_parceiro ='$parceiro'");
												if(mysqli_num_rows($cons_posicao) > 0){
													while ($resp_posicao = mysqli_fetch_assoc($cons_posicao)) {
													$nome_instalador = 	$resp_posicao['nome_parceiro'];
												}}
											
											$cons_pacote = mysqli_query($con,"SELECT * FROM pacotes WHERE id_pacote='$pacote'");
												if(mysqli_num_rows($cons_pacote) > 0){
											while ($resp_pac = mysqli_fetch_assoc($cons_pacote)) {
											$pacote1 = 	$resp_pac['pacote'];
											}}

											$cons_stat1 = mysqli_query($con,"SELECT * FROM status_os WHERE id_status='$status_os'");
													if(mysqli_num_rows($cons_stat1) > 0){
												while ($resp_stat1 = mysqli_fetch_assoc($cons_stat1)) {
												$status_os1 = 	$resp_stat1['status_os'];
													}}
											
											if($status_os == 2){
												$cor1 = '<h5><span class="badge" style="background-color:#009900;color:#FFF">'.$status_os1.'</span></h5>';
											} else if ($status_os == 1){
												$cor1 = '<h5><span class="badge" style="background-color:#4169E1;color:#FFF">'.$status_os1.'</span></h5>';
											} else {
												$cor1 = '<h5><span class="badge badge-dark">'.$status_os1.'</span></h5>';	
											}
											
											
											$base64 = 'id_cliente:'.$id_cliente.'&id_os:'.$id_os.'';
											$base64 = base64_encode($base64);
											
											
											?>
											<tr>
													
													<td><a href="ordem_servico.php?c=<?php echo $base64?>&pag=veic"><button type="button" class="btn btn-dark btn-icon btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Abrir OS"><i class="fab fa-elementor"></i></button></a>
													</td>
													<td><?php echo $data_criacao; ?></td>
													<td><?php echo $veiculo; ?></td>
													<td><?php echo $nome_cliente; ?></td>
													<td><?php echo $tipo_os; ?></td>
													<td><?php echo $cor1; ?></td>
													<td><?php echo $nome_instalador; ?></td>

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
