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
        <link rel="stylesheet" media="screen, print" href="/tracker2/app-assets/css/vendors.bundle.css">
        <link rel="stylesheet" media="screen, print" href="/tracker2/app-assets/css/app.bundle.css">
        <!-- Place favicon.ico in the root directory -->
        <link rel="apple-touch-icon" sizes="180x180" href="/tracker2/app-assets/img/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/tracker2/app-assets/img/favicon/favicon-32x32.png">
        <link rel="mask-icon" href="/tracker2/app-assets/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="stylesheet" media="screen, print" href="/tracker2/app-assets/css/datagrid/datatables/datatables.bundle.css">
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
                            <img src="http://<?php echo $login_padrao?>.mtracker.com.br/logo.png" style="width:200px; heigth:auto" alt="SmartAdmin WebApp" aria-roledescription="logo">
                            
                            
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
							
						</div>
                        
                        
                        <div class="row">
                            <div class="col-xl-12">
                                <div id="panel-1" class="panel">
                                    
                                    <div class="panel-container show">
                                        <div class="panel-content">
											<?php
				
											$result_usuario = "SELECT * FROM veiculos_clientes WHERE id_empresa='$id_empresa' ORDER BY id_veiculo DESC";
											$resultado_usuario = mysqli_query($conn, $result_usuario);
											if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
											?>
											<table id="dt-basic-example" class="table table-bordered table-hover table-striped nowrap" style="width:100%">
												<thead>
													<tr>
														
														<th></th>
														<th>Conexão</th>
														<th>Data Cadastro</th>
														<th>Placa</th>
														<th>Veículo</th>
														<th>Status</th>
														<th>Ano</th>
														<th>Cor</th>
														<th>Cliente</th>
														<th>Equipamento</th>
														<th>IMEI</th>
														<th>Linha M2M</th>
														<th>Operadora</th>
														<th>Fornecedor M2M</th>
														<th>Data Conexão</th>
														<th>Data GPS</th>
														<th>Vendedor</th>
														<th>Plano</th>
														<th>Valor Mensal</th>
														<th>Forma Pagamento</th>
														<th>Recorrência</th>
														<th></th>
													</tr>
												</thead>
											<tbody>
											<?php
											while($row_usuario = mysqli_fetch_assoc($resultado_usuario)){
											$id_cliente = $row_usuario['id_cliente'];
											$id_veiculo = $row_usuario['id_veiculo'];
											$placa = $row_usuario['placa'];
											$modelo_veiculo = $row_usuario['modelo_veiculo'];
											$marca_veiculo = $row_usuario['marca_veiculo'];
											$deviceid = $row_usuario['deviceid'];
											$status = $row_usuario['status'];
											$data_cadastro = $row_usuario['data_cadastro'];
											$data_cadastro = date('d/m/Y', strtotime("$data_cadastro"));
											$modelo_equip = $row_usuario['modelo_equip'];
											$chip = $row_usuario['chip'];
											$imei = $row_usuario['imei'];
											$operadora = $row_usuario['operadora'];
											$fornecedor_chip = $row_usuario['fornecedor_chip'];
											$ano_veiculo = $row_usuario['ano_veiculo'];
											$ano_modelo = $row_usuario['ano_modelo'];
											$cor_veiculo = $row_usuario['cor_veiculo'];
											$vendedor = $row_usuario['vendedor'];
											$recorrencia_veic = $row_usuario['recorrencia'];
											$pacote = $row_usuario['pacote'];
											$forma_pagamento = $row_usuario['forma_pagamento'];
											$valor_mensal = $row_usuario['valor_mensal'];
											$valor_mensal = number_format($valor_mensal, 2, ",", ".");
											
											
											$cons_cliente = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
												if(mysqli_num_rows($cons_cliente) > 0){
													while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
													$nome_cliente = 	$resp_cliente['nome_cliente'];
												}}
											
											
											$cons_status = mysqli_query($conn,"SELECT * FROM status WHERE id_status='$status'");
												if(mysqli_num_rows($cons_status) > 0){
													while ($resp_status = mysqli_fetch_assoc($cons_status)) {
													$status_cliente = 	$resp_status['status'];
												}}
											
											$cons_posicao = mysqli_query($conn,"SELECT * FROM posicoes WHERE deviceid='$deviceid'");
												if(mysqli_num_rows($cons_posicao) > 0){
													while ($resp_posicao = mysqli_fetch_assoc($cons_posicao)) {
													$devicetime = 	$resp_posicao['devicetime'];
													$devicetime = date('d/m/Y H:i:s', strtotime("$devicetime"));
												}}
											
											$cons_pacote = mysqli_query($con,"SELECT * FROM pacotes WHERE id_pacote='$pacote'");
												if(mysqli_num_rows($cons_pacote) > 0){
											while ($resp_pac = mysqli_fetch_assoc($cons_pacote)) {
											$pacote1 = 	$resp_pac['pacote'];
											}}
												
											
											if($status == 1){
												$status1 = '<h5><span class="badge" style="background-color:#009900;color:#FFF">'.$status_cliente.'</span></h5>';
											}
											if($status == 2){
												$status1 = '<h4><span class="badge badge-danger">'.$status_cliente.'</span></h4>';
											}
											if($status == 4){
												$status1 = '<h4><span class="badge badge-dark">'.$status_cliente.'</span></h4>';
											}
											if($status == 5){
												$status1 = '<h4><span class="badge badge-dark">'.$status_cliente.'</span></h4>';
											}
											if($status == 7){
												$status1 = '<h4><span class="badge badge-info">'.$status_cliente.'</span></h4>';
											}
											if($status == 11){
												$status1 = '<h4><span class="badge badge-info">'.$status_cliente.'</span></h4>';
											}
											if($status == 13){
												$status1 = '<h4><span class="badge badge-info">'.$status_cliente.'</span></h4>';
											}
											if($status == 99){
												$status1 = '<h4><span class="badge badge-warning">'.$status_cliente.'</span></h4>';
											}
											
											$data_agora = date('Y-m-d H:i:s');
											$data_agora = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_agora)));

											$data_inicial_12 = date('Y-m-d H:i:s', strtotime('-5 minutes', strtotime($data_agora)));
											
											$cons_device = mysqli_query($con,"SELECT * FROM tc_devices WHERE id='$deviceid'");
												if(mysqli_num_rows($cons_device) > 0){
											while ($resp_device = mysqli_fetch_assoc($cons_device)) {
												$lastupdate = 	$resp_device['lastupdate'];
											$lastupdate1 = date('d/m/Y H:i:s', strtotime('-3 hour', strtotime($lastupdate)));
											if($lastupdate <= $data_inicial_12){
												$conect = '<h4><span class="badge" style="background-color:#CD5C5C;color:#FFF"><i class="fas fa-wifi"></i> OFFLINE</span></h4>';
												$icon_conect = '<h4><span class="badge" style="background-color:#CD5C5C;color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" title="Offline" data-content="Dispositivo sem comunicação desde '.$lastupdate1.'" data-original-title="ONLINE"><i class="fas fa-wifi"></i></span></h4>';
											} 
											if($lastupdate > $data_inicial_12){
												$conect = '<h4><span class="badge" style="background-color:#009900;color:#FFF"><i class="fas fa-wifi"></i> ONLINE</span></h4>';
												$icon_conect = '<h4><span class="badge" style="background-color:#009900;color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" title="ONLINE" data-content="Data/hora: '.$lastupdate1.'" data-original-title="OFFLINE"><i class="fas fa-wifi"></i></span></h4>';	
											}
											if($lastupdate == '' or $lastupdate == null){
												$conect = '<h4><span class="badge" style="background-color:#CD5C5C;color:#FFF"><i class="fas fa-wifi"></i> OFFLINE</span></h4>';
												$icon_conect = '<h4><span class="badge" style="background-color:#CD5C5C;color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" title="Offline" data-content="Dispositivo sem comunicação" data-original-title="O"><i class="fas fa-wifi"></i></span></h4>';
											}
											}}
											
											
											
											
											$base64 = 'id_cliente:'.$id_cliente.'';
											$base64 = base64_encode($base64);
											
											$base64_veic = 'id_cliente:'.$id_cliente.'&id_veiculo:'.$id_veiculo;
											$base64_veic = base64_encode($base64_veic);
											
											?>
											<tr>
													
													<td><a href="editar_veiculo.php?c=<?php echo $base64_veic?>&pag=veic"><button type="button" class="btn btn-dark btn-icon btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Abrir Cadastro"><i class="fab fa-elementor"></i></button></a>
														<a href="grid_device.php?c=<?php echo $base64_veic?>"><button type="button" class="btn btn-primary btn-icon btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Abrir no Mapa"><i class="fal fa-map-marker-alt"></i></button></a></td>
													<td><?php echo $icon_conect; ?></td>
													<td><?php echo $data_cadastro; ?></td>
													<td><?php echo $placa; ?></td>
													<td><?php echo $marca_veiculo; ?> / <?php echo $modelo_veiculo; ?></td>
													<td><?php echo $status1; ?></td>
													<td><?php echo $ano_modelo; ?>/<?php echo $ano_veiculo; ?></td>
													<td><?php echo $cor_veiculo; ?></td>
													<td><i class="fal fa-user"></i> <a href="cad_cliente.php?c=<?php echo $base64?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Abrir Cadastro do Cliente"><?php echo $nome_cliente; ?></a></td>
													<td><?php echo $modelo_equip; ?></td>
													<td><?php echo $imei; ?></td>
													<td><?php echo $chip; ?></td>
													<td><?php echo $operadora; ?></td>
													<td><?php echo $fornecedor_chip; ?></td>
													<td><i class="fal fa-clock"></i> <?php echo $lastupdate1; ?></td>
													<td><i class="fal fa-map-marker-alt"></i> <?php echo $devicetime; ?></td>
													<td><?php echo $vendedor; ?></td>
													<td><?php echo $pacote1; ?></td>
													<td>R$ <?php echo $valor_mensal; ?></td>
													<td><?php echo $forma_pagamento; ?></td>
													<td><?php echo $recorrencia_veic; ?></td>
													<td><button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#del<?php echo $id_veiculo?>"><i class="fal fa-trash-alt"></i> Excluir Veículo</button></td>
												</tr>
												
												<div class="modal fade" id="del<?php echo $id_veiculo?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
													<div class="modal-dialog modal-dialog-centered">
														<div class="modal-content">
															<div class="modal-header bg-danger text-white">
																<h4 class="modal-title" id="myLargeModalLabel" style="color:#FFF;">EXCLUIR VEÍCULO!</h4>
																<button type="button" class="close text-white" data-dismiss="modal" aria-hidden="true">×</button>
															</div>
															<div class="modal-body">
																<b>EXCLUIR VEÍCULO?</b><BR />
																<?php echo $placa?> - <?php echo $marca_veiculo; ?> / <?php echo $modelo_veiculo; ?><br />
																<p>Esta ação é irreverssível.</p>
																Deseja prosseguir?
															</div>
															<div class="modal-footer">
																 <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
																 <a href="del_veiculo1.php?id_veiculo=<?php echo $id_veiculo?>&id_cliente=<?php echo $id_cliente?>&deviceid=<?php echo $deviceid?>"><button type="button" class="btn btn-danger">Excluir</button></a>
															</div>
														</div>
													</div>
												</div>
												
												
											<?php
													}?>
											</tbody>
											</table>
											<?php
											}else{
											?>
											<table id="dt-basic-example" class="table table-bordered table-hover table-striped nowrap" style="width:100%">
												<thead>
													<tr>	
														<th>Data Cadastro</th>
														<th>Placa</th>
														<th>Veículo</th>
														<th>Status</th>
													</tr>
												</thead>
											<tbody>
											
											</tbody>
											</table>
											<?php
											}
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
      
        <script src="/tracker2/app-assets/js/vendors.bundle.js"></script>
        <script src="/tracker2/app-assets/js/app.bundle.js"></script>
        <script src="/tracker2/app-assets/js/datagrid/datatables/datatables.bundle.js"></script>
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
