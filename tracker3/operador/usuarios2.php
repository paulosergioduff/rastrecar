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
						$botao_loja2 = '<a href="usuarios.php"><button type="button" class="btn btn-dark btn-sm"><i class="fal fa-home"></i> Loja Horizonte</button></a>';
						
					}
					$id_empresa = '1362';
					?>
                    <!-- END Page Header -->
                    <!-- BEGIN Page Content -->
                    <!-- the #js-page-content id is needed for some plugins to initialize -->
                    <main id="js-page-content" role="main" class="page-content">
					
						<div class="row">
                            <div class="col-xl-6">
								<div class="subheader">
									<h1 class="subheader-title">
										<i class='subheader-icon fal fa-users'></i> Usuários - Loja Fortaleza
										<small>
											Cadastro de Usuários
										</small>
									</h1>
								</div>
							</div>
							<div class="col-xl-6 text-right">
								<a href="novo_user_adm.php?c=1362"><button type="button" class="btn btn-primary btn-sm"><i class="fal fa-user"></i> Novo Usuário Admin</button></a>
								<a href="novo_user_master.php?c=1362"><button type="button" class="btn btn-primary btn-sm"><i class="fal fa-user"></i> Novo Usuário Master</button></a>
								 
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
														<th>ID</th>
														<th>NOME</th>
														<th>USUARIO</th>
														<th>NIVEL</th>
														<th>ULTIMO LOGIN WEB</th>
														<th>STATUS</th>
														<th>AÇÕES</th>
													</tr>
												</thead>
											<tbody>
											<?php
				
											$result_usuario = "SELECT * FROM usuarios WHERE id_empresa='$id_empresa' ORDER BY id_usuarios ASC";
											$resultado_usuario = mysqli_query($conn, $result_usuario);
											if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
											while($row_usuario = mysqli_fetch_assoc($resultado_usuario)){
											$id_usuarios = $row_usuario['id_usuarios'];
											$nome = $row_usuario['nome'];
											$usuario = $row_usuario['usuario'];
											$user = explode("@", $usuario);
											$login = $user[0];
											$ativo = $row_usuario['ativo'];
											$nivel = $row_usuario['nivel'];
											$ultimo_login = $row_usuario['ultimo_login'];
											if($ultimo_login != ''){
												$ultimo_login1 = date('d/m/Y H:i', strtotime("$ultimo_login"));
											}
											if($ultimo_login == ''){
												$ultimo_login1 = '';
											}
											
											
											if($ativo == 'SIM'){
												$ativo1 = '<h5><span class="badge" style="background-color:#009900;color:#FFF">ATIVO</span></h5>';
											}
											if($ativo == 'NAO'){
												$ativo1 = '<h5><span class="badge" style="background-color:#CCC;color:#FFF">INATIVO</span></h5>';
											}
											$base_user = 'id_usuarios:'.$id_usuarios;
											$base_user = base64_encode($base_user);
											
											if($nivel == 1){
												$nivel1 = 'ADMINISTRADOR';
												$botao = ' <a href="editar_usuario_adm.php?c='.$base_user.'"><button type="button" class="btn btn-icon btn-outline-dark btn-sm" data-toggle="tooltip" data-trigger="hover" data-placement="top" title="Abrir Cadastro"><i class="fas fa-search"></i></button></a>';
											}
											if($nivel == 2){
												$nivel1 = 'CLIENTE';
												$botao = ' <a href="editar_usuario_cli.php?c='.$base_user.'"><button type="button" class="btn btn-icon btn-outline-dark btn-sm" data-toggle="tooltip" data-trigger="hover" data-placement="top" title="Abrir Cadastro"><i class="fas fa-search"></i></button></a>';
											}
											if($nivel == 6){
												$nivel1 = 'TECNICO';
												$botao = ' <a href="editar_usuario_tec.php?c='.$base_user.'"><button type="button" class="btn btn-icon btn-outline-dark btn-sm" data-toggle="tooltip" data-trigger="hover" data-placement="top" title="Abrir Cadastro"><i class="fas fa-search"></i></button></a>';
											}
											if($nivel == 4){
												$nivel1 = 'VENDEDOR';
												$botao = ' <a href="editar_usuario_vend.php?c='.$base_user.'"><button type="button" class="btn btn-icon btn-outline-dark btn-sm" data-toggle="tooltip" data-trigger="hover" data-placement="top" title="Abrir Cadastro"><i class="fas fa-search"></i></button></a>';
											}
											if($nivel == 5){
												$nivel1 = 'MASTER';
												$botao = ' <a href="editar_usuario_master.php?c='.$base_user.'"><button type="button" class="btn btn-icon btn-outline-dark btn-sm" data-toggle="tooltip" data-trigger="hover" data-placement="top" title="Abrir Cadastro"><i class="fas fa-search"></i></button></a>';
											}
											
											?>
												<tr>
													 <th><?php echo $id_usuarios?></th>
													<td class="product-name"><?php echo $nome; ?></td>
													<td class="product-category"><?php echo $login; ?></td>
													<td><span class="text-dark"><?php echo $nivel1; ?></span></td>
													<td><span class="text-dark"><?php echo $ultimo_login1; ?></span></td>
													<td><?php echo $ativo1; ?></td>
													<td>
													   <?php echo $botao; ?>
													</td>
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
