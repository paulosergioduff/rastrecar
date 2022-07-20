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
		<link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/botoes.css">
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
                    <?php include('include/head.php');
					
					?>
                    <!-- END Page Header -->
                    <!-- BEGIN Page Content -->
                    <!-- the #js-page-content id is needed for some plugins to initialize -->
                    <main id="js-page-content" role="main" class="page-content">
					
						<div class="row">
                            <div class="col-xl-8">
								<div class="subheader">
									<h1 class="subheader-title">
										<i class='subheader-icon fal fa-users'></i> Instaladores
										<small>
											Cadastro de Instaladores
										</small>
									</h1>
								</div>
							</div>
							<div class="col-xl-4 text-right">
							
							<a href="novo_instalador.php"><button type="button" class="btn btn-info btn-sm" style="font-size:14px"><i class="fal fa-user-plus"></i> Novo Instalador</button></a>
							</div>
						</div>
                        
                        
                        <div class="row">
                            <div class="col-xl-12">
                                <div id="panel-1" class="panel">
                                    
                                    <div class="panel-container show">
                                        <div class="panel-content">
											<?php
				
											$result_usuario = "SELECT * FROM parceiros WHERE id_empresa='$id_empresa' ORDER BY id_parceiro DESC";
											$resultado_usuario = mysqli_query($conn, $result_usuario);
											if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
											?>
											<table id="dt-basic-example" class="table table-bordered table-hover table-striped nowrap" style="width:100%">
												<thead>
													<tr>
														<th>Nome</th>
														<th>Telefone</th>
														<th>Status</th>
														<th>Ações</th>

													</tr>
												</thead>
											<tbody>
											<?php
											while($row_usuario = mysqli_fetch_assoc($resultado_usuario)){
											$id_instalador = $row_usuario['id_parceiro'];
											$nome_instalador = $row_usuario['nome_parceiro'];
											$telefone_celular = $row_usuario['celular'];
											$endereco = $row_usuario['endereco'];
											$numero = $row_usuario['numero'];
											$bairro = $row_usuario['bairro'];
											$cidade = $row_usuario['cidade'];
											$cep = $row_usuario['cep'];
											$estado = $row_usuario['estado'];
											$status = $row_usuario['status'];
											$comissao_fixa = $row_usuario['comissao_fixa'];
											$doc_instalador = $row_usuario['doc_instalador'];
											
											
											$vlr_inst_bloqueio = $row_usuario['vlr_inst_bloqueio'];
											$vlr_inst_bloqueio = number_format($vlr_inst_bloqueio, 2, ",", ".");
											
											$vlr_inst = $row_usuario['vlr_inst'];
											$vlr_inst = number_format($vlr_inst, 2, ",", ".");
											
											$vlr_manutencao = $row_usuario['vlr_manutencao'];
											$vlr_manutencao = number_format($vlr_manutencao, 2, ",", ".");
											
											$vlr_retirada = $row_usuario['vlr_retirada'];
											$vlr_retirada = number_format($vlr_retirada, 2, ",", ".");
											

											$data_cadastro = $row_usuario['data_cadastro'];
											$data_cadastro = date('d/m/Y', strtotime("$data_cadastro"));
											
											
											
											
											$cons_status = mysqli_query($conn,"SELECT * FROM status WHERE id_status='$status'");
												if(mysqli_num_rows($cons_status) > 0){
													while ($resp_status = mysqli_fetch_assoc($cons_status)) {
													$status_cliente = 	$resp_status['status'];
												}}
											
											
												
											
											if($status == 1){
												$status1 = '<h5><span class="badge" style="background-color:#009900;color:#FFF">'.$status_cliente.'</span></h5>';
											}
											if($status == 2){
												$status1 = '<h5><span class="badge" style="background-color:#CD5C5C;color:#FFF">'.$status_cliente.'</span></h5>';
											}
											

											
											$base64 = 'id_instalador:'.$id_instalador.'';
											$base64 = base64_encode($base64);
											
											$base64_veic = 'id_cliente:'.$id_cliente.'&id_veiculo:'.$id_veiculo;
											$base64_veic = base64_encode($base64_veic);
											
											?>
											<tr>
													<td><?php echo $nome_instalador; ?></td>
													<td><?php echo $telefone_celular; ?></td>
													<td><?php echo $status1; ?></td>
													<td><button type="button" class="btn btn-dark btn-icon btn-sm" data-toggle="modal" data-target="#vendedor<?php echo $id_instalador?>" ><i class="fal fa-file-alt" data-toggle="tooltip" data-offset="0,10" title="Ver Detalhes"></i></button>
													<button type="button" class="btn1 btn1-danger btn-sm btn-icon1" data-toggle="modal" data-target="#excluir<?php echo $id_instalador?>" ><i class="fal fa-trash-alt"></i></button></td>
													

												</tr>
												
												<script>
												function install<?php echo $id_instalador?>(){
													$('#vendedor<?php echo $id_instalador?>').modal('hide');
													$('#instalacoes<?php echo $id_instalador?>').modal('show');
												}
											</script>
												
												<div class="modal fade default-example-modal-right" id="vendedor<?php echo $id_instalador?>" tabindex="-1" role="dialog" aria-hidden="true">
													<div class="modal-dialog modal-dialog-right  modal-lg">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title h4">DETALHES INSTALADOR</h5>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true"><i class="fal fa-times"></i></span>
																</button>
															</div>
															<div class="modal-body">
																<div class="row">
																	<div class="col-md-12">
																		<a href="editar_instalador.php?c=<?php echo $base64?>"><button type="button" class="btn btn-primary btn-sm"><i class="fal fa-edit"></i> Alterar Cadastro</button></a>
																		<button type="button" class="btn btn-dark btn-sm" onclick="install<?php echo $id_instalador?>();"><i class="fal fa-file-alt"></i> Relatório de Instalações</button>
																	</div>
																</div><br>
																<div class="card mb-5" style="border:#ccc 1px solid;">
																	<div class="card-body p-3">
																		<h4><span class="badge badge-dark">INFORMAÇÕES DO INSTALADOR</span></h4><br>
																		
																		<br>
																		<div class="row">
																			<div class="col-md-8">
																				<label>Instalador</label><br>
																				<span ><b><?php echo $nome_instalador?></b></span>
																			</div>
																			<div class="col-md-4">
																				<label>Data Cadastro</label><br>
																				<span ><b><?php echo $data_cadastro; ?></b></span>
																			</div>
																		</div><br>
																		<div class="row">
																			<div class="col-md-4">
																				<label>CPF/CNPJ</label><br>
																				<span ><b><?php echo $doc_instalador; ?></b></span>
																			</div>
																			<div class="col-md-4">
																				<label>Telefone:</label><br>
																				<span ><b><?php echo $telefone_celular?></b></span>
																			</div>
																			<div class="col-md-4">
																				<label>Status:</label><br>
																				<span ><b><?php echo $status1?></b></span>
																			</div>
																		</div><br>
																		<div class="row">
																			<div class="col-md-2">
																				<label>CEP:</label><br>
																				<span ><b><?php echo $cep?></b></span>
																			</div>
																			<div class="col-md-5">
																				<label>Endereço</label><br>
																				<span ><b><?php echo $endereco?>, <?php echo $numero?></b></span>
																			</div>
																			<div class="col-md-5">
																				<label>Bairro/Cidade</label><br>
																				<span ><b><?php echo $bairro?> - <?php echo $cidade?>/<?php echo $estado?></b></span>
																			</div>
																		</div><br><br>
																		<div class="row">
																			<div class="col-md-6">
																				<label>Valor Instalação com Bloqueio</label><br>
																				<span ><b>R$ <?php echo $vlr_inst_bloqueio; ?> </b></span>
																			</div>
																			<div class="col-md-6">
																				<label>Valor Instalação sem Bloqueio</label><br>
																				<span ><b>R$ <?php echo $vlr_inst; ?></b></span>
																			</div>
																		</div><br>
																		<div class="row">
																			<div class="col-md-6">
																				<label>Valor Manutenção</label><br>
																				<span ><b>R$ <?php echo $vlr_manutencao; ?> </b></span>
																			</div>
																			<div class="col-md-6">
																				<label>Valor Retirada</label><br>
																				<span ><b>R$ <?php echo $vlr_retirada; ?></b></span>
																			</div>
																		</div><br>
																	</div>
																	
																</div>
																
															</div>   
															<div class="modal-footer">
																
																<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
															</div>
														</div>
													</div>				
												</div>
												
												
												<div class="modal fade default-example-modal-right" id="instalacoes<?php echo $id_instalador?>" tabindex="-1" role="dialog" aria-hidden="true">
													<div class="modal-dialog modal-dialog-right  modal-lg">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title h4">INSTALAÇÕES REALIZADAS</h5>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true"><i class="fal fa-times"></i></span>
																</button>
															</div>
															<div class="modal-body">
																
																<div class="card mb-5" style="border:#ccc 1px solid;">
																	<div class="card-body p-3">
																		<h4><span class="badge badge-dark">INSTALAÇÕES DE <?php echo $nome_instalador?></span></h4><br>
																		<br>
																		<div class="row">
																			<div class="col-md-12">
																				<div class="row">
																					<div class="col-md-12">
																						<span><b>INSTALAÇÕES REALIZADAS NESTE MÊS</b></span>
																					</div>
																					
																				</div><br>
																				<div class="row" style="border:#000 1px solid">
																					<div class="col-md-4">
																						<span><b>VEÍCULO</b></span>
																					</div>
																					<div class="col-md-2">
																						<span ><b>TIPO OS</b></span>
																					</div>
																					<div class="col-md-3">
																						<span ><b>VALOR A PAGAR</b></span>
																					</div>
																					<div class="col-md-3">
																						<span ><b>STATUS OS</b></span>
																					</div>
																				</div><br>
																				
																				<?php
																				$cons_os = mysqli_query($conn,"SELECT * FROM ordem_servico WHERE parceiro='$id_instalador'");
																					if(mysqli_num_rows($cons_os) > 0){
																						while ($resp_os = mysqli_fetch_assoc($cons_os)) {
																						$tipo_os = 	$resp_os['tipo_os'];
																						$id_veiculo = 	$resp_os['id_veiculo'];
																						$id_veiculo = 	$resp_os['id_veiculo'];
																						$status_os = 	$resp_os['status'];
																						$bloqueio_inst = 	$resp_os['bloqueio_inst'];
																						
																					$cons_veic = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE id_veiculo='$id_veiculo'");
																						if(mysqli_num_rows($cons_veic) > 0){
																							while ($resp_veic = mysqli_fetch_assoc($cons_veic)) {
																							$placa = 	$resp_veic['placa'];
																							$marca_veiculo = 	$resp_veic['marca_veiculo'];
																							$modelo_veiculo = 	$resp_veic['modelo_veiculo'];
																						}}
																						
																					$cons_inst = mysqli_query($conn,"SELECT * FROM instaladores WHERE id_instalador='$id_instalador'");
																						if(mysqli_num_rows($cons_inst) > 0){
																							while ($resp_inst = mysqli_fetch_assoc($cons_inst)) {
																							$vlr_inst_bloqueio1 = 	$resp_inst['vlr_inst_bloqueio'];
																							$vlr_inst_bloqueio1 = number_format($vlr_inst_bloqueio1, 2, ",", ".");
																							$vlr_inst1 = 	$resp_inst['vlr_inst1'];
																							$vlr_inst1 = number_format($vlr_inst1, 2, ",", ".");
																							$vlr_manutencao1 = 	$resp_inst['vlr_manutencao'];
																							$vlr_manutencao1 = number_format($vlr_manutencao1, 2, ",", ".");
																							$vlr_retirada1 = 	$resp_inst['vlr_retirada'];
																							$vlr_retirada1 = number_format($vlr_retirada1, 2, ",", ".");
																						}}
																					
																					$cons_status_os = mysqli_query($conn,"SELECT * FROM status_os WHERE id_status='$status_os'");
																						if(mysqli_num_rows($cons_status_os) > 0){
																							while ($resp_veic1 = mysqli_fetch_assoc($cons_status_os)) {
																							$status_os3 = 	$resp_veic1['status_os'];
																							
																						}}
																					
																					
																						
																					if($tipo_os = 'INSTALACAO'){
																						if($bloqueio_inst == 'SIM'){
																							$valor = $vlr_inst_bloqueio1;
																						}
																						if($bloqueio_inst != 'SIM'){
																							$valor = $vlr_inst1;
																						}
																					}
																					if($tipo_os = 'MANUTENCAO'){
																						$valor = $vlr_manutencao1;
																					}
																					if($tipo_os = 'RETIRADA'){
																						$valor = $vlr_retirada1;
																					}
																					
																					if($status_os == 2){
																						$cor1 = '<h5><span class="badge" style="background-color:#009900;color:#FFF">'.$status_os3.'</span></h5>';
																					} else if ($status_os == 1){
																						$cor1 = '<h5><span class="badge" style="background-color:#4169E1;color:#FFF">'.$status_os3.'</span></h5>';
																					} else {
																						$cor1 = '<h5><span class="badge badge-dark">'.$status_os3.'</span></h5>';	
																							}
																					
																					
																					?>	
																					<div class="row">
																						<div class="col-md-4">
																							<span ><b><?php echo $placa; ?> - <?php echo $marca_veiculo; ?>/<?php echo $modelo_veiculo; ?></b></span>
																						</div>
																						<div class="col-md-2">
																							<span><b><?php echo $tipo_os; ?></b></span>
																						</div>
																						<div class="col-md-3">
																							<span><b>R$ <?php echo $valor; ?></b></span>
																						</div>
																						<div class="col-md-3">
																							<span ><b><?php echo $cor1; ?></b></span>
																						</div>
																					</div><br>
																						
																					<?php }} ?>								
																				
																				
																				
																				
																				
																				
																			</div>
																			
																		</div><br>
																	</div>
																	
																</div>
																
															</div>   
															<div class="modal-footer">
																
																<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
															</div>
														</div>
													</div>				
												</div>
												
												
												<div class="modal fade" id="excluir<?php echo $id_instalador?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
													<div class="modal-dialog modal-dialog-centered">
														<div class="modal-content">
															<div class="modal-header bg-danger text-white">
																<h4 class="modal-title" id="myLargeModalLabel" style="color:#FFF;">EXCLUIR VEÍCULO!</h4>
																<button type="button" class="close text-white" data-dismiss="modal" aria-hidden="true">×</button>
															</div>
															<div class="modal-body">
																<b>EXCLUIR INSTALADOR?</b><BR />
																<?php echo $nome_instalador?><br><br>
																<p>Esta ação é irreverssível.</p>
																Deseja prosseguir?
															</div>
															<div class="modal-footer">
																 <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
																 <a href="del_instalador.php?id_parceiro=<?php echo $id_instalador?>"><button type="button" class="btn btn-danger">Excluir</button></a>
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
