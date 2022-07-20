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
                    <?php include('include/head.php');
						
					if($acesso == 'GERAL'){
						$botao_loja1 = '';
						$botao_loja2 = '<a href="vendedores2.php"><button type="button" class="btn btn-dark btn-sm" style="font-size:14px"><i class="fal fa-home"></i> Loja Fortaleza</button></a>';
						
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
										<i class='subheader-icon fal fa-users'></i> Vendedores<?php echo $botao_loja1;?> 
										<small>
											Cadastro de Vendedores
										</small>
									</h1>
								</div>
							</div>
							<div class="col-xl-4 text-right">
							<?php echo $botao_loja2;?> 
							<a href="novo_vendedor.php"><button type="button" class="btn btn-info btn-sm" style="font-size:14px"><i class="fal fa-user-plus"></i> Novo Vendedor</button></a>
							</div>
						</div>
                        
                        
                        <div class="row">
                            <div class="col-xl-12">
                                <div id="panel-1" class="panel">
                                    
                                    <div class="panel-container show">
                                        <div class="panel-content">
											<?php
				
											$result_usuario = "SELECT * FROM vendedores WHERE id_empresa='$id_empresa' ORDER BY id_vendedor DESC";
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
											$id_vendedor = $row_usuario['id_vendedor'];
											$nome_vendedor = $row_usuario['nome_vendedor'];
											$telefone_celular = $row_usuario['telefone_celular'];
											$endereco = $row_usuario['endereco'];
											$numero = $row_usuario['numero'];
											$bairro = $row_usuario['bairro'];
											$cidade = $row_usuario['cidade'];
											$cep = $row_usuario['cep'];
											$estado = $row_usuario['estado'];
											$status = $row_usuario['status'];
											$comissao_fixa = $row_usuario['comissao_fixa'];
											$tipo_fixa = $row_usuario['tipo_fixa'];
											$comissao_recorrente = $row_usuario['comissao_recorrente'];
											$tipo_recorrente = $row_usuario['tipo_recorrente'];
											$doc_vendedor = $row_usuario['doc_vendedor'];
											$comissao_recorrente = number_format($comissao_recorrente, 2, ",", ".");
											$comissao_fixa = number_format($comissao_fixa, 2, ",", ".");
											$data_cadastro = $row_usuario['data_cadastro'];
											$data_cadastro = date('d/m/Y', strtotime("$data_cadastro"));
											
											if($tipo_fixa == 'VALOR'){
												$comissao_fixa1 = 'R$ '.$comissao_fixa.' por venda';
											}
											if($tipo_fixa == 'PERCENTUAL'){
												$comissao_fixa1 = ''.$comissao_fixa.'% por venda';
											}
											
											if($tipo_recorrente == 'VALOR'){
												$comissao_recorrente1 = 'R$ '.$comissao_recorrente.' por venda';
											}
											if($tipo_recorrente == 'PERCENTUAL'){
												$comissao_recorrente1 = ''.$comissao_recorrente.'% por venda';
											}
											
											
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
											

											
											$base64 = 'id_vendedor:'.$id_vendedor.'';
											$base64 = base64_encode($base64);
											
											$base64_veic = 'id_cliente:'.$id_cliente.'&id_veiculo:'.$id_veiculo;
											$base64_veic = base64_encode($base64_veic);
											
											?>
											<tr>
													<td><?php echo $nome_vendedor; ?></td>
													<td><?php echo $telefone_celular; ?></td>
													<td><?php echo $status1; ?></td>
													<td><button type="button" class="btn btn-dark btn-icon btn-sm" data-toggle="modal" data-target="#vendedor<?php echo $id_vendedor?>" ><i class="fal fa-file-alt" data-toggle="tooltip" data-offset="0,10" title="Ver Detalhes"></i></button>
													<button type="button" class="btn1 btn1-danger btn-sm btn-icon1" data-toggle="modal" data-target="#excluir<?php echo $id_vendedor?>" ><i class="fal fa-trash-alt"></i></button></td>
													

												</tr>
												
												<div class="modal fade default-example-modal-right" id="vendedor<?php echo $id_vendedor?>" tabindex="-1" role="dialog" aria-hidden="true">
													<div class="modal-dialog modal-dialog-right  modal-lg">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title h4">DETALHES VENDEDOR</h5>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true"><i class="fal fa-times"></i></span>
																</button>
															</div>
															<div class="modal-body">
																<div class="row">
																	<div class="col-md-12">
																		<a href="editar_vendedor.php?c=<?php echo $base64?>"><button type="button" class="btn btn-primary btn-sm"><i class="fal fa-file-alt"></i> Alterar Cadastro</button></a>
																		<a href="relatorio_vendedor.php?c=<?php echo $base64?>"><button type="button" class="btn btn-dark btn-sm"><i class="fal fa-file-alt"></i> Relatório de Vendas</button></a>
																	</div>
																</div><br>
																<div class="card mb-5" style="border:#ccc 1px solid;">
																	<div class="card-body p-3">
																		<h4><span class="badge badge-dark">INFORMAÇÕES DO VENDEDOR</span></h4><br>
																		
																		<br>
																		<div class="row">
																			<div class="col-md-8">
																				<label>Vendedor</label><br>
																				<span ><b><?php echo $nome_vendedor?></b></span>
																			</div>
																			<div class="col-md-4">
																				<label>Data Cadastro</label><br>
																				<span ><b><?php echo $data_cadastro; ?></b></span>
																			</div>
																		</div><br>
																		<div class="row">
																			<div class="col-md-4">
																				<label>CPF/CNPJ</label><br>
																				<span ><b><?php echo $doc_vendedor; ?></b></span>
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
																			<div class="col-md-4">
																				<label>CEP:</label><br>
																				<span ><b><?php echo $cep?></b></span>
																			</div>
																			<div class="col-md-4">
																				<label>Endereço</label><br>
																				<span ><b><?php echo $endereco?>, <?php echo $numero?></b></span>
																			</div>
																			<div class="col-md-4">
																				<label>Bairro/Cidade</label><br>
																				<span ><b><?php echo $bairro?> - <?php echo $cidade?>/<?php echo $estado?></b></span>
																			</div>
																		</div><br>
																		<div class="row">
																			<div class="col-md-6">
																				<label>Comissão Fixa</label><br>
																				<span ><b><?php echo $comissao_fixa1; ?> </b></span>
																			</div>
																			<div class="col-md-6">
																				<label>Comissão Recorrente</label><br>
																				<span ><b><?php echo $comissao_recorrente1; ?></b></span>
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
												
												<div class="modal fade" id="excluir<?php echo $id_vendedor?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
													<div class="modal-dialog modal-dialog-centered">
														<div class="modal-content">
															<div class="modal-header bg-danger text-white">
																<h4 class="modal-title" id="myLargeModalLabel" style="color:#FFF;">EXCLUIR VEÍCULO!</h4>
																<button type="button" class="close text-white" data-dismiss="modal" aria-hidden="true">×</button>
															</div>
															<div class="modal-body">
																<b>EXCLUIR VENDEDOR?</b><BR />
																<?php echo $nome_vendedor?><br><br>
																<p>Esta ação é irreverssível.</p>
																Deseja prosseguir?
															</div>
															<div class="modal-footer">
																 <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
																 <a href="del_vendedor.php?id_vendedor=<?php echo $id_vendedor?>"><button type="button" class="btn btn-danger">Excluir</button></a>
															</div>
														</div>
													</div>
												</div>
												
												
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
