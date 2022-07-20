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
							$botao_loja1 = ' - LOJA HORIZONTE';
							$botao_loja2 = '<a href="pedidos2.php"><button type="button" class="btn btn-dark btn-sm"><i class="fal fa-home"></i> Loja Fortaleza</button></a>';	
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
										<i class='subheader-icon fal fa-boxes'></i> Pedidos Site<?php echo $botao_loja1;?>
										
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
										<table id="dt-basic-example" class="table table-bordered table-hover table-striped nowrap">
												<thead>
													<tr>		
														<th>Data Cadastro</th>
														<th>Nome Cliente</th>
														<th>Telefone</th>
														<th>Status</th>
														<th>Ação</th>
													</tr>
												</thead>
											<tbody>
											<?php
							$result_usuario = "SELECT * FROM pedidos WHERE status != '1' AND id_empresa='$id_empresa' ORDER BY data_cadastro DESC";
							$resultado_usuario = mysqli_query($conn, $result_usuario);


							//Verificar se encontrou resultado na tabela "usuarios"
							if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
							while($row_usuario = mysqli_fetch_assoc($resultado_usuario)){
							$id_pedido = $row_usuario['id_pedido'];
							$status = $row_usuario['status'];
							$data_cadastro = $row_usuario['data_cadastro'];
							$data_cadastro = date('d/m/Y H:i', strtotime("$data_cadastro"));
							
															
								if($status == 1){
							$status1 = '<a href="edit_status_clientes.php?id_cliente='.$id_cliente.'"><button type="button" class="btn btn-success btn-xs" title="Ativo"><b>ATIVO</b></button></a>';
							} else if($status == 4){
							$status1 = '<button type="button" class="btn btn-dark btn-sm"><b>CANCELADO</b></button>';
							} else if($status == 5){
							$status1 = '<button type="button" class="btn btn-dark btn-sm"><b>CANCELADO</b></button>';
							} else if($status == 11){
							$status1 = '<button type="button" class="btn btn-info btn-sm"><b>NOVO</b></button>';
							} else if($status == 13){
							$status1 = '<button type="button" class="btn btn-warning btn-sm"><b>PEDIDO CANCELADO</b></button>';
							} else if($status == 14){
							$status1 = '<button type="button" class="btn btn-danger btn-sm"><b>CREDITO NEGADO</b></button>';
							} else {
							$status1 = '<a href="edit_status_clientes.php?id_cliente='.$id_cliente.'"><button type="button" class="btn btn-danger btn-sm" title="Inativo" ><b>Bloqueado</b></button></a>';
								}
							?>
								<tr>
									<th><?php echo $data_cadastro; ?></th>
									<td class="table-plus"><?php echo $row_usuario['nome_cliente']; ?></td>
									<td><?php echo $row_usuario['telefone_celular']; ?></td>
									<td><?php echo $status1; ?></td>
									<td>
										<a href="cad_pedidos.php?id_pedido=<?php echo $id_pedido; ?>&p=pedidos"><button data-toggle="tooltip" data-offset="0,10" data-original-title="Abrir Pedido" type="button" class="btn btn-outline-dark btn-icon btn-sm"><i class="fas fa-file-alt"></i></button></a>
										<a href="#" data-toggle="modal" data-target="#del<?php echo $id_pedido?>"><button data-toggle="tooltip" data-offset="0,10" data-original-title="Excluir Pedido" type="button" class="btn btn-outline-danger btn-icon btn-sm"><i class="fas fa-trash-alt"></i></button></a>
									</td>
								</tr>
								<div class="modal fade" id="del<?php echo $id_pedido?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-header bg-danger text-white">
											<h4 class="modal-title" id="myLargeModalLabel" style="color:#FFF;">ATENÇÃO!</h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										</div>
										<div class="modal-body">
											<b>EXCLUIR PEDIDO?</b><BR />
											<?php echo $id_pedido?> - <?php echo $row_usuario['nome_cliente'];?><br />
        
											Deseja prosseguir?
										</div>
										<div class="modal-footer">
											 <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
											<a href="delete_pedido.php?id_pedido=<?php echo $id_pedido; ?>"><button type="button" class="btn btn-danger">Excluir</button></a>
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
					colReorder: true,
					order: [[ 1, "desc" ]]
					
                });

              

            });

        </script>
    </body>
</html>
