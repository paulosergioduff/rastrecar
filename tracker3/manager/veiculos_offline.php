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
                <div class="page-content-wrapper header-function-fixed">
                    <!-- BEGIN Page Header -->
                    <?php include('include/head.php')?>
                    <!-- END Page Header -->
                    <!-- BEGIN Page Content -->
                    <!-- the #js-page-content id is needed for some plugins to initialize -->
					
					<?php
					$time = $_GET['time'];
					if($time == '12'){
						$tempo = 'até 12h';
					}
					if($time == '12x24'){
						$tempo = 'entre 12h e 24h';
					}
					if($time == '24'){
						$tempo = 'acima 24h';
					}
					?>
                    <main id="js-page-content" role="main" class="page-content">
					
						<div class="row">
                            <div class="col-xl-8">
								<div class="subheader">
									<h1 class="subheader-title">
										<i class='subheader-icon fal fa-car'></i> Veículos Offline <?php echo $tempo?>
										<small>
											Veículos sem comunicação
										</small>
									</h1>
								</div>
							</div>
							<div class="col-xl-4 text-right">
								<a href="excel/veiculos_off.php?time=<?php echo $time?>"><button type="button" class="btn btn-success btn-sm shadow-0"><i class="fas fa-file-excel"></i> Excel</button></a> 
								<a href="pdf_files/veiculos_off.php?time=<?php echo $time?>" target="_blank"><button type="button" class="btn btn-sm shadow-0" style="background-color:#CD5C5C; color:#FFF"><i class="fas fa-file-pdf"></i> PDF</button></a>
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
														<th>Última Conexão</th>
														<th>Veículo</th>
														<th>Última Tratativa</th>
														<th>Equipamento</th>
														<th>IMEI</th>
														<th>Linha M2M</th>
														<th>Operadora</th>
														<th>Fornecedor M2M</th>
														<th>Cliente</th>
														<th>Telefone Cliente</th>
													</tr>
												</thead>
											<tbody>
											<?php
											$time = $_GET['time'];
											$data_agora = date('Y-m-d H:i:s');
											$data_agora = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_agora)));
											$data_5 = date('Y-m-d H:i:s', strtotime('-5 minutes', strtotime($data_agora)));
											$data_12 = date('Y-m-d H:i:s', strtotime('-12 hour', strtotime($data_agora)));
											$data_24 = date('Y-m-d H:i:s', strtotime('-24 hour', strtotime($data_agora)));
											
											
											if($time == '12'){
												$tabela = "SELECT * FROM tc_devices WHERE lastupdate < '$data_5' AND lastupdate >= '$data_12' AND contact != 'ESTOQUE' ORDER BY lastupdate DESC";
											}
											if($time == '12x24'){
												$tabela = "SELECT * FROM tc_devices WHERE lastupdate < '$data_12' AND lastupdate >= '$data_24' AND contact != 'ESTOQUE' ORDER BY lastupdate DESC";
											}
											if($time == '24'){
												$tabela = "SELECT * FROM tc_devices WHERE lastupdate < '$data_24' AND contact != 'ESTOQUE' ORDER BY lastupdate DESC";
											}
											
											
											$cons_devices = mysqli_query($conn, $tabela);
											if(mysqli_num_rows($cons_devices) > 0){
											while($row_devices = mysqli_fetch_assoc($cons_devices)){
											$deviceid = $row_devices['id'];
											$lastupdate = $row_devices['lastupdate'];
											$positionid = $row_devices['positionid'];
											$lastupdate = date('Y-m-d H:i:s', strtotime('-3 hour', strtotime($lastupdate)));
											$lastupdate1 = date('d/m/Y H:i:s', strtotime("$lastupdate"));
				
											$result_usuario = mysqli_query($conn, "SELECT * FROM veiculos_clientes WHERE deviceid='$deviceid'");
											if(mysqli_num_rows($result_usuario) >0){
											while($row_usuario = mysqli_fetch_assoc($result_usuario)){
											$id_cliente = $row_usuario['id_cliente'];
											$id_veiculo = $row_usuario['id_veiculo'];
											$placa = $row_usuario['placa'];
											$modelo_veiculo = $row_usuario['modelo_veiculo'];
											$marca_veiculo = $row_usuario['marca_veiculo'];
											$modelo_equip = $row_usuario['modelo_equip'];
											$chip = $row_usuario['chip'];
											$imei = $row_usuario['imei'];
											$operadora = $row_usuario['operadora'];
											$fornecedor_chip = $row_usuario['fornecedor_chip'];
											$veiculo = $placa.' - '.$modelo_veiculo.'/'.$marca_veiculo;
											}}
											
											
											$cons_cliente = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
												if(mysqli_num_rows($cons_cliente) > 0){
													while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
													$nome_cliente = 	$resp_cliente['nome_cliente'];
													$telefone_celular = 	$resp_cliente['telefone_celular'];
												}}
											
											$cons_trat = mysqli_query($conn,"SELECT * FROM tratativas WHERE deviceid='$deviceid' ORDER BY data_trat DESC LIMIT 1");
												if(mysqli_num_rows($cons_trat) <= 0){
													$data_tratativa = '';
												}
												if(mysqli_num_rows($cons_trat) > 0){
													while ($resp_trat = mysqli_fetch_assoc($cons_trat)) {
													$data_tratativa = 	$resp_trat['data_trat'];
													$data_tratativa = date('d/m/Y H:i', strtotime("$data_tratativa"));
													
													
												}}
											
											
											$cons_posicao = mysqli_query($conn,"SELECT * FROM tc_positions WHERE id='$positionid'");
												if(mysqli_num_rows($cons_posicao) > 0){
													while ($resp_posicao = mysqli_fetch_assoc($cons_posicao)) {
													$devicetime = 	$resp_posicao['fixtime'];
													$devicetime = date('Y-m-d H:i:s', strtotime('-3 hour', strtotime($devicetime)));
													$devicetime = date('d/m/Y H:i:s', strtotime("$devicetime"));
												}}
											
											
												
											
										
											
										$icon_conect = '<h4><span class="badge" style="background-color:#CD5C5C;color:#FFF" ><i class="fas fa-wifi"></i></span></h4>';
											
											
											
											
											$base64 = 'id_cliente:'.$id_cliente.'';
											$base64 = base64_encode($base64);
											
											$base64_veic = 'id_cliente:'.$id_cliente.'&id_veiculo:'.$id_veiculo;
											$base64_veic = base64_encode($base64_veic);
											
											$base64_device = 'deviceid:'.$deviceid.'';
											$base64_device = base64_encode($base64_device);
											
											
											?>
											<tr>
													
													<td><a href="editar_veiculo.php?c=<?php echo $base64_veic?>&pag=veic"><button type="button" class="btn btn-dark btn-icon btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Abrir Cadastro"><i class="fab fa-elementor"></i></button></a>
														<a href="grid_device.php?c=<?php echo $base64_device?>"><button type="button" class="btn btn-primary btn-icon btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Abrir no Mapa"><i class="fal fa-map-marker-alt"></i></button></a>
														<a href="tratar.php?c=<?php echo $base64_device?>&time=<?php echo $time?>"><button type="button" class="btn btn-warning btn-icon btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tratamento"><i class="fal fa-exclamation-circle"></i></button></a></td>
													
													<td><?php echo $lastupdate1; ?></td>
													<td><?php echo $veiculo; ?></td>
													<td><?php echo $data_tratativa; ?></td>
													<td><?php echo $modelo_equip; ?></td>
													<td><?php echo $imei; ?></td>
													<td><?php echo $chip; ?></td>
													<td><?php echo $operadora; ?></td>
													<td><?php echo $fornecedor_chip; ?></td>
													<td><?php echo $nome_cliente; ?></td>
													<td><?php echo $telefone_celular; ?></td>
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
