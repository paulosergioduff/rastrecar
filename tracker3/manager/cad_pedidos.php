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
							$botao_loja2 = '<a href="veiculos2.php"><button type="button" class="btn btn-dark btn-sm"><i class="fal fa-home"></i> Loja Fortaleza</button></a>';	
						}
						if($id_empresa == '1361'){
							$botao_loja1 = ' - LOJA HORIZONTE';
						}
						if($id_empresa == '1362'){
							$botao_loja1 = ' - LOJA FORTALEZA';
						}
						
							$id_pedido = $_REQUEST['id_pedido'];
	$cons_cliente = mysqli_query($conn,"SELECT * FROM pedidos WHERE id_pedido='$id_pedido'");
	if(mysqli_num_rows($cons_cliente) > 0){
while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
$nome_cliente = 	$resp_cliente['nome_cliente'];
$doc_cliente = 	$resp_cliente['doc_cliente'];
$rg_cliente	 = 	$resp_cliente['rg_cliente'];
$data_nascimento = 	$resp_cliente['data_nascimento'];
$cep = 	$resp_cliente['cep'];
$endereco = 	$resp_cliente['endereco'];
$numero = 	$resp_cliente['numero'];
$complemento = 	$resp_cliente['complemento'];
$bairro = 	$resp_cliente['bairro'];
$cidade = 	$resp_cliente['cidade'];
$estado = 	$resp_cliente['estado'];
$telefone_residencial = 	$resp_cliente['telefone_residencial'];
$telefone_celular = 	$resp_cliente['telefone_celular'];
$telefone_outros = 	$resp_cliente['telefone_outros'];
$data_cadastro = 	$resp_cliente['data_cadastro'];
$data_cadastro = date('d/m/Y', strtotime("$data_cadastro"));
$status = 	$resp_cliente['status'];
$email = 	$resp_cliente['email'];
$pacote = $resp_cliente['pacote'];
$forma_pagamento = $resp_cliente['forma_pagamento'];
$vendedor = $resp_cliente['vendedor'];
$placa_veiculo = $resp_cliente['placa_veiculo'];
$renavam = $resp_cliente['renavam'];
$pgto_instalacao = $resp_cliente['pgto_instalacao'];
$status = $resp_cliente['status'];
	}}
	
	
	if($status == 14){
		$but = 'btn-block';
	} else {
		$but = '';
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
										<i class='subheader-icon fal fa-boxes'></i> Pedido
										
									</h1>
								</div>
							</div>
						
						</div>
                        
                        
                        <div class="row">
                            <div class="col-xl-12">
                                <div id="panel-1" class="panel">
                                    
                                    <div class="panel-container show">
                                        <div class="panel-content">
											<form name="forml" action="gerar_venda.php" method="post">
                                            <div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label>Nome Completo:</label>
														<input type="text" name="nome_cliente" id="nome_cliente" class="form-control text-uppercase" value="<?php echo $nome_cliente?>" readonly>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>CPF/CNPJ:</label>
														<input type="text" name="doc_cliente" id="doc_cliente" class="form-control" value="<?php echo $doc_cliente?>" readonly>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>RG/Inscrição Estadual:</label>
														<input type="text" name="rg_cliente" id="rg_cliente" class="form-control"  value="<?php echo $rg_cliente?>" readonly>
													</div>
												</div>
											</div><br>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label>Data Nascimento / Fundação:</label>
														<input type="text" name="data_nascimento" id="data_nascimento" class="form-control"  value="<?php echo $data_nascimento?>" readonly>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>E-mail:</label>
														<input type="text" name="email" id="email" class="form-control text-lowercase" autocomplete="off"  value="<?php echo $email?>" readonly>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>CEP:</label>
														<input type="text" name="cep" id="cep" class="form-control"  value="<?php echo $cep?>" readonly>
													</div>
												</div>
											</div><br>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label>Endereço:</label>
														<input type="text" name="endereco" id="endereco" class="form-control text-uppercase"  value="<?php echo $endereco?>" readonly>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Número:</label>
														<input type="text" name="numero" id="numero" class="form-control"   value="<?php echo $numero?>" readonly>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Complemento:</label>
														<input type="text" name="complemento" id="complemento" class="form-control text-uppercase"  value="<?php echo $complemento?>" readonly>
													</div>
												</div>
											</div><br>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label>Bairro:</label>
														<input type="text" name="bairro" id="bairro" class="form-control text-uppercase"  value="<?php echo $bairro?>" readonly>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Cidade:</label>
														<input type="text" name="cidade" id="cidade" class="form-control text-uppercase"   value="<?php echo $cidade?>" readonly>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Estado (UF):</label>
														<input type="text" name="estado" id="estado" class="form-control text-uppercase"  value="<?php echo $estado?>" readonly>
													</div>
												</div>
											</div><br>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label>Telefone Celular:</label>
														<input type="text" name="telefone_celular" id="telefone_celular" class="form-control"  value="<?php echo $telefone_celular?>" readonly>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Placa do Veículo:</label>
														<input type="text" name="placa_veiculo" id="placa_veiculo" class="form-control" value="<?php echo $placa_veiculo?>" readonly>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Renavam</label>
														<input type="text" name="renavam" id="renavam" class="form-control"  value="<?php echo $renavam?>" readonly>
													</div>
												</div>
												 
											</div><br>
											<div class="row"> 
												<div class="col-md-4">
													<div class="form-group">
														<label>Forma de Pagamento:</label>
														<input type="text" name="forma_pagamento" id="forma_pagamento" class="form-control" value="<?php echo $forma_pagamento?>" readonly>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Pgto Instalação:</label>
														<input type="text" name="pgto_instalacao" id="pgto_instalacao" class="form-control" value="<?php echo $pgto_instalacao?>" readonly>
													</div>
												</div> 
												<div class="col-md-4">
													<div class="form-group">
														<label>Pacote:</label>
														<input type="text" name="pacote" id="pacote" class="form-control" value="<?php echo $pacote?>" readonly>
														<input type="hidden" name="id_pedido" id="id_pedido" class="form-control" value="<?php echo $id_pedido?>" readonly>
													</div>
												</div>  									
											</div><br>
											
                                        </form>
											
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
