<?php include('conexao.php');

$cons_usuario20 = mysqli_query($conn,"SELECT * FROM usuarios WHERE id_usuarios='$user_id'");
	if(mysqli_num_rows($cons_usuario20) > 0){
while ($resp_usuario11 = mysqli_fetch_assoc($cons_usuario20)) {
$id_cliente_1 = 	$resp_usuario11['id_cliente'];
	}}
	
$cons_cli10 = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente_1'");
	if(mysqli_num_rows($cons_cli10) > 0){
while ($resp_cor30 = mysqli_fetch_assoc($cons_cli10)) {
$id_cliente_pai_ini = 	$resp_cor30['id_cliente_pai'];

	}}
	
$cons_cli_cor = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente_pai_ini'");
	if(mysqli_num_rows($cons_cli_cor) > 0){
while ($resp_cor = mysqli_fetch_assoc($cons_cli_cor)) {
$cor_sistema1 = 	$resp_cor['cor_sistema'];
$logo1 = 	$resp_cor['logo'];
$login_padrao1 = 	$resp_cor['subdominio'];
$telefone_residencial1 = 	$resp_cor1['telefone_residencial'];
	}}
	
if($id_cliente_pai_ini == 1361){
	$logo = '/tracker/Imagens/logo1.png';
	$cor_sistema = '#14145A';
	$login_padrao = 'RMB';
}

if($id_cliente_pai_ini != 1361){
	$logo = '/tracker3/manager/logos/'.$logo1;
	$cor_sistema = $cor_sistema1;
	$login_padrao = $login_padrao1;

}
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
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $logo?>">
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
                           <img src="<?php echo $logo?>" style="width:200px; heigth:auto" alt="SmartAdmin WebApp" aria-roledescription="logo">
                            
                            
                        </a>
                    </div>
                    <?php include('include/sidebar.php')?>
                    
                </aside>
                <!-- END Left Aside -->
                <div class="page-content-wrapper header-function-fixed">
                    <!-- BEGIN Page Header -->
                    <?php include('include/head.php')?>
                     <?php
					$cons_usuarios = mysqli_query($conn,"SELECT * FROM usuarios WHERE id_usuarios ='$user_id'");
					if(mysqli_num_rows($cons_usuarios) > 0){
						while ($resp_usuario = mysqli_fetch_assoc($cons_usuarios)) {
						$id_cliente = $resp_usuario['id_cliente'];
					}}
					
					?>
                    <main id="js-page-content" role="main" class="page-content">
					
						<div class="row">
                            <div class="col-xl-8">
								<div class="subheader">
									<h1 class="subheader-title">
										<i class='subheader-icon fal fa-object-ungroup'></i> Cercas Virtuais
										<small>
											Lista de Cercas Criadas/Ativas
										</small>
									</h1>
								</div>
							</div>
							<div class="col-xl-4 text-right">
							 <a href="nova_cerca.php"><button type="button" class="btn btn-success btn-sm" style="font-size:14px"><i class="fas fa-draw-polygon"></i> Nova Cerca</button></a>
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
														
														<th>Nome da Cerca</th>
														<th>Endereço Referência</th>
														<th>Qtd Veículos</th>
														<th>Ação</th>
													</tr>
												</thead>
											<tbody>
											<?php
				
											$result_usuario = "SELECT * FROM cerca_virtual WHERE id_cliente='$id_cliente' ORDER BY id_cerca ASC";
											$resultado_usuario = mysqli_query($conn, $result_usuario);
											if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
											while($row_usuario = mysqli_fetch_assoc($resultado_usuario)){
											$id_cerca = $row_usuario['id_cerca'];
											$geofenceid = $row_usuario['geofenceid'];
											$endereco = $row_usuario['endereco'];
											$endereco = html_entity_decode($endereco);
											$latitude = $row_usuario['latitude'];
											$longitude = $row_usuario['longitude'];
											$nome_cerca = $row_usuario['nome_cerca'];
											$radius = $row_usuario['radius'];
											$tipo = $row_usuario['tipo'];
											$data_criacao = $row_usuario['data_criacao'];
											$data_criacao = date('d/m/Y', strtotime("$data_criacao"));

											$cons_devices = mysqli_query($conn,"SELECT * FROM tc_device_geofence WHERE geofenceid='$geofenceid'");
											$total = mysqli_num_rows($cons_devices);
												if(mysqli_num_rows($cons_devices) > 0){
											while ($resp_p = mysqli_fetch_assoc($cons_devices)) {
											$deviceid = 	$resp_p['deviceid'];
											
												}}
											
											$frota = '<button type="button" class="btn btn-info btn-sm" data-dismiss="modal"><b>'.$total.'</b></button>';
											
											
											
											
											$base64 = 'id_cerca:'.$id_cerca.'';
											$base64 = base64_encode($base64);
											
											
											if($tipo == 'CIRCLE'){
												$url = 'view_cerca1.php?c='.$id_cerca;
											}
											if($tipo != 'CIRCLE'){
												$url = 'view_cerca.php?c='.$id_cerca;
											}
											
											
											?>
											<tr>
									
									<th><?php echo $nome_cerca; ?></th>
									<td><?php echo $endereco; ?></td>
									<td><?php echo $frota; ?></td>
									<td>
									<a href="<?php echo $url; ?>" data-toggle="tooltip" data-trigger="hover" data-placement="top" title="Ver Cerca"><button type="button" class="btn btn-outline-dark btn-icon btn-sm"><i class="fas fa-search"></i></button></a>
									<a href="#" data-toggle="modal" data-target="#e<?php echo $geofenceid?>"><button data-toggle="tooltip" data-trigger="hover" data-placement="top" title="Excluir Cerca" type="button" class="btn btn-outline-danger btn-icon btn-sm"><i class="fas fa-trash-alt"></i></button></a>
									</td>
								</tr>
								
							<div class="modal fade" id="e<?php echo $geofenceid?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-header text-white" style="background-color:#990000">
											<h4 class="modal-title" id="myLargeModalLabel" style="color:#FFF;"><i class="fas fa-trash-alt"></i> EXCLUIR CERCA?</h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										</div>
										<div class="modal-body">
											<span>Deseja excluir a cerca </span><br><br>
											<b><?php echo $nome_cerca?></b> <br> <?php echo $endereco;?><br><br><br>
										
											<span>Esta Ação é irreverssível. </span>
											

											Deseja prosseguir?
										</div>
										<div class="modal-footer">
											 <button type="button" style="font-size:14px" class="btn btn-primary btn-sm" data-dismiss="modal">Cancelar</button>
											<a href="delete_cerca.php?geofenceid=<?php echo $geofenceid; ?>&deviceid=<?php echo $deviceid; ?>"><button type="button" style="font-size:14px" class="btn btn-danger btn-sm">Excluir</button></a>
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
