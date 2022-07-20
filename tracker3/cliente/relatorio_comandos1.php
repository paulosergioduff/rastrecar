<?php


include_once("conexao.php");

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

$date = date('Y-m-d');	

$data_i1 = $_POST['data_inicial'];
$data_inicial = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_i1)));
$data_inicial_1 = date('d/m/Y H:i' , strtotime($data_i1));


$agrupar = $_POST['agrupar'];

$data_f1 = $_POST['data_final'];
$data_final = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_f1)));
$data_final_1 = date('d/m/Y H:i' , strtotime($data_f1));



$deviceid = $_POST['veiculo'];

$cons_veiculo = mysqli_query($conn, "SELECT * FROM veiculos_clientes WHERE deviceid='$deviceid'");
if(mysqli_num_rows($cons_veiculo) > 0){
while ($resp_veic = mysqli_fetch_assoc($cons_veiculo)) {
		$id_cliente = $resp_veic['id_cliente'];
		$marca_veiculo =  $resp_veic['marca_veiculo'];
		$modelo_veiculo =  $resp_veic['modelo_veiculo'];
		$placa =  $resp_veic['placa'];
}}

$cons_cliente = mysqli_query($conn, "SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
if(mysqli_num_rows($cons_cliente) > 0){
while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
		$nome_cliente = $resp_cliente['nome_cliente'];
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
		<link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/formplugins/select2/select2.bundle.css">
        <!-- Place favicon.ico in the root directory -->
        <link rel="apple-touch-icon" sizes="180x180" href="/tracker3/app-assets/img/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/tracker3/app-assets/img/favicon/favicon-32x32.png">
        <link rel="mask-icon" href="/tracker3/app-assets/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
		<link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/fa-brands.css">
		<link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/fa-solid.css">
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
                    <!-- END Page Header -->
                    <!-- BEGIN Page Content -->
                    <!-- the #js-page-content id is needed for some plugins to initialize -->
                    <main id="js-page-content" role="main" class="page-content">
					
						<div class="row">
                            <div class="col-xl-8">
								<div class="subheader">
									<h1 class="subheader-title">
										<i class='subheader-icon fal fa-external-link-alt'></i> Relatório de Comandos
										<small>
											Comandos enviados.
										</small>
									</h1>
								</div>
							</div>
							<div class="col-xl-4 text-right">
								 <a href="/tracker3/manager/pdf_files/relatorio_comandos.php?data_inicial=<?php echo $data_i1?>&data_final=<?php echo $data_f1?>&deviceid=<?php echo $deviceid?>" target="_blank"><button type="button" class="btn btn-danger btn-sm" style="font-size:14px"><i class="fas fa-file-pdf"></i> PDF</button></a>
								 <button type="button" onclick="imprimir();" class="btn btn-primary btn-sm" style="font-size:14px">Imprimir</button>
							</div>
						</div>
                        
                        <form name="forml" id="forml" action="relatorio_alertas1.php" method="post">
                        <div class="row">
                            <div class="col-xl-12">
                                <div id="panel-1" class="panel">
                                    
                                    <div class="panel-container show">
                                        <div class="panel-content">
											<form action="relatorio_percurso1.php" method="post" name="forml">
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox ">
                  
					<input type="hidden" id="pagina" value="resultado_rota.php?data_inicial=<?php echo $data_inicial ?>&data_final=<?php echo $data_final ?>&deviceid=<?php echo $deviceid?>">
					<div id="relatorio_geral">
						<div class="ibox-content">
							<div class="row">
								<div class="col-md-8">
									
										<b>Período:</b> <?php echo $data_inicial_1?> até <?php echo $data_final_1?><br>
										<b>Cliente:</b> <?php echo $nome_cliente?><br>
										<b>Veículo:</b> <?php echo $marca_veiculo?>/<?php echo $modelo_veiculo?><br>
										<b>Placa: </b><?php echo $placa?>
								</div>
								
							</div>
							<hr>
							
						<div class="row">
						<div class="col-md-12">
						
						<table class="table table-striped table-bordered table-hover">
							
							<thead>
								<tr>
									<th>Data/Hora</th>
									<th>Comando</th>
									<th>Endereço</th>
									<th>Enviado por:</th>
								</tr>
							 </thead>
							<tbody>
						<?php 
						
							$cons_comandos = mysqli_query($conn,"SELECT * FROM comandos_enviados WHERE deviceid='$deviceid' AND executado='SIM' AND (data >='$data_inicial' AND data<='$data_final') ORDER BY id_log DESC ");
								if(mysqli_num_rows($cons_comandos) > 0){
									while ($resp_comandos = mysqli_fetch_assoc($cons_comandos)) {
									$executado = 	$resp_comandos['executado'];
									$address = 	$resp_comandos['address'];
									$comando = 	$resp_comandos['comando'];
									$nome_user = 	$resp_comandos['nome_user'];
									$data_comand = 	$resp_comandos['data'];
									$data_comand = date('d/m/Y H:i:s', strtotime("$data_comand"));
									
									if($comando == 'BLOQUEIO'){
										$comand = '<h4><span class="badge" style="background-color:#CD5C5C; color:#FFF"><i class="fas fa-lock"></i> BLOQUEIO</span></h4>';
									}
									if($comando == 'DESBLOQUEIO'){
										$comand = '<h4><span class="badge" style="background-color:#009900; color:#FFF"><i class="fas fa-lock-open"></i> DESBLOQUEIO</span></h4>';
									}
									if($comando == 'ANCORA'){
										$comand = '<h4><span class="badge" style="background-color:#999; color:#FFF"><i class="fas fa-anchor"></i> ANCORA</span></h4>';
									}
							
						?>
						 <tr>
							<th><font style="font-size:14px;"><?php echo $data_comand?></font></th>
							<td><font style="font-size:14px;"><?php echo $comand; ?></font></td>
							<td><font style="font-size:14px;"><?php echo $address; ?></font></td>
							<td><font style="font-size:14px;"><?php echo $nome_user; ?></font></td>
						</tr>
								<?php }}?>
							</tbody>
					</table>
					
						</div>
						</div>
					
					
						
						
						
						
					
					
						</div>
                </div>
            </div>
            </div>
        </div>
		</form>
											
											
											
											
											
											

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						</form>
                    </main>
					
					<!-- DIV Carregar -->
					<div class="modal fade" id="carregar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-sm modal-dialog-centered">
							<div class="modal-content">
								
								<div class="modal-body" id="informacoes">
									<span style="fonta-size:20px"> Aguarde... </span> <img src="/tracker2/Imagens/load.gif" width="40px" height="40px">
								</div>
								
							</div>
						</div>
					</div>	
                    <!-- FIM DIV Carregar -->
					
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
				$base64 = $deviceid.'@'.$data_inicial.'@'.$data_final;
				$base64 = base64_encode($base64);
				
				?>
				<input type="hidden" id="base64" value="<?php echo $base64?>">
				<input type="hidden" id="deviceid" value="<?php echo $deviceid?>">
				<input type="hidden" id="data_inicial" value="<?php echo $data_inicial?>">
				<input type="hidden" id="data_final" value="<?php echo $data_final?>">
        <script src="/tracker3/app-assets/js/vendors.bundle.js"></script>
        <script src="/tracker3/app-assets/js/app.bundle.js"></script>
        <script src="/tracker3/app-assets/js/formplugins/select2/select2.bundle.js"></script>
<script>
$('#forml').on('submit', function(e){
  $('#carregar').modal('show');
});
</script>   
		<script>
			var base64 = document.getElementById("base64").value;
		
		function imprimir(){
		window.open("http://rastreiamaisbrasil.com.br/tracker3/manager/imprimir_relatorio_comandos.php?c="+base64, "minhaJanela", "height=700,width=1000");
		}
	</script>







	
</body>
</html>
