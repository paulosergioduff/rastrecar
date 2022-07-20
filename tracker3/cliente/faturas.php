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
										<i class='subheader-icon fal fa-dollar-sign'></i> Minhas Faturas
										
									</h1>
								</div>
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
														<th>#</th>
														<th>Descrição</th>
														<th>Vencimento</th>
														<th>Valor</th>
														<th>Tipo</th>
														<th>Status</th>
														<th>Ações</th>

													</tr>
												</thead>
											<tbody>
											<?php
				
											$result_usuario = "SELECT * FROM contas_receber WHERE id_cliente='$id_cliente' ORDER BY data_vencimento DESC LIMIT 10";
											$resultado_usuario = mysqli_query($conn, $result_usuario);
											if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
											?>
											
											<?php
											while($row_usuario = mysqli_fetch_assoc($resultado_usuario)){
											$id_conta = $row_usuario['id_conta'];
											$descricao1 = $row_usuario['descricao'];
											$linha_digitavel = $row_usuario['linha_digitavel'];

											$categoria = $row_usuario['categoria'];
											$duplicata = $row_usuario['duplicata'];
											$class_financeira = $row_usuario['class_financeira'];
											$data_emissao = $row_usuario['data_emissao'];
											$data_emissao1 = date('d/m/Y', strtotime("$data_emissao"));
											$data_vencimento = $row_usuario['data_vencimento'];
											$data_vencimento1 = date('d/m/Y', strtotime("$data_vencimento"));
											$banco = $row_usuario['banco'];
											$especie = $row_usuario['especie'];
											$valor_bruto = $row_usuario['valor_bruto'];
											$valor_bruto1 = number_format($valor_bruto, 2, ",", ".");
											$id_recorrencia = $row_usuario['id_recorrencia'];
											$forma_pagamento_conta = $row_usuario['forma_pagamento'];
											$user_baixa = $row_usuario['user_baixa'];
											$qtd_parcelas = $row_usuario['qtd_parcelas'];
											$status_conta = $row_usuario['status'];
											$data_pagamento = $row_usuario['data_pagamento'];
											$user_baixa = $row_usuario['user_baixa'];
											$link_boleto = $row_usuario['link_boleto'];
											$url_pdf = $row_usuario['url_pdf'];
											$valor_pago = $row_usuario['valor_pago'];
											$valor_pago1 = number_format($valor_pago, 2, ",", ".");
											$observacoes = $row_usuario['observacoes'];
											$nr_parcela = $row_usuario['nr_parcela'];
											$obs_baixa = $row_usuario['obs_baixa'];
											
											if(strlen($descricao1) <= 20){
												$descricao = $descricao1;
											}
											if(strlen($descricao1) > 20){
												$descricao = substr($descricao1, 0, 20).'...';
											}
											
											$data_hj = date('Y-m-d');
											
											$d1 = strtotime($data_hoje); 
											$d2 = strtotime($data_vencimento);
											
											$dataFinal = ($d2 - $d1) /86400;
											
											if($dataFinal < 0)
											$dataFinal *= -1;
											
											if($status_conta == 'Em Aberto' && $data_vencimento < $data_hj){
												$status_conta1 = '<h5><span class="badge" style="background-color:#FF6347;color:#FFF">'.$dataFinal.' DIA(S) EM ATRASO</span></h5>';
												$botao_baixa = '<a href="baixar_conta_pagar.php?c='.$base_conta.'"><button type="button" class="btn btn-info"><i class="fal fa-download"></i> Baixar</button></a>';
												$cor = 'style="background-color:#EBD7D3"';
											}
											if($status_conta == 'Em Aberto' && $data_vencimento >= $data_hj){
												$status_conta1 = '<h5><span class="badge" style="background-color:#4682B4;color:#FFF">AGUAR. PGTO</span></h5>';
												$botao_baixa = '<a href="baixar_conta_pagar.php?c='.$base_conta.'"><button type="button" class="btn btn-info"><i class="fal fa-download"></i> Baixar</button></a>';
												$cor = '';
												
											}
											
											if($status_conta == 'Pago'){
												$status_conta1 = '<h5><span class="badge" style="background-color:#009900;color:#FFF">PAGO</span></h5>';
												$botao_baixa = '';
												$cor = '';
											}
											
											$cons_especie = mysqli_query($conn,"SELECT * FROM tipo_pagamento WHERE id_tipo='$especie'");
												if(mysqli_num_rows($cons_especie) > 0){
													while ($resp_especie = mysqli_fetch_assoc($cons_especie)) {
													$especie1	 = 	$resp_especie['tipo_pagamento'];
												}}
											
											$cons_banco = mysqli_query($conn,"SELECT * FROM bancos WHERE id_banco='$banco'");
												if(mysqli_num_rows($cons_banco) > 0){
													while ($resp_banco = mysqli_fetch_assoc($cons_banco)) {
													$banco1	 = 	$resp_banco['nome_banco'];
												}}
											
											$cons_class = mysqli_query($conn,"SELECT * FROM categorias_contas_receber WHERE id_categoria='$class_financeira'");
												if(mysqli_num_rows($cons_class) > 0){
													while ($resp_especie = mysqli_fetch_assoc($cons_class)) {
													$categoria	 = 	$resp_especie['categoria'];
													//$categoria = utf8_encode($categoria);
												}}
											
											if($status_conta == 'Em Aberto'){
												$data_pagamento1 = '';
											}
											
											if($status_conta == 'Pago'){
												$data_pagamento1 = date('d/m/Y', strtotime("$data_pagamento"));
											}
											
											if($id_recorrencia > 0){
												$recorrencia = 'SIM';
											}
											if($id_recorrencia == 0){
												$recorrencia = 'NÃO';
											}
											
											
											if($especie == 2){
												$tipo = 'Boleto Bancário';
											}
											if($especie == 13){
												$tipo = 'Cartão de Crédito';
											}
											
											if($link_boleto == ''){
												$link_boleto1 = $url_pdf;
											} else {
												$link_boleto1 = $link_boleto;
											}
											
											if($especie == 2 && $status_conta == 'Em Aberto'){
												$botao_boleto = '<a href="'.$link_boleto1.'" target="_blank"><button type="button" class="btn btn-dark btn-sm"><i class="fal fa-file-alt" data-toggle="tooltip" data-offset="0,10" title="Abrir Fatura"></i> Boleto</button></a>';
											}
											if($especie == 2 && $status_conta == 'Pago'){
												$botao_boleto = '';
											}
											if($especie != 2){
												$botao_boleto = '';
											}
											
											$base64 = 'id_conta:'.$id_conta.'';
											$base64 = base64_encode($base64);
											

											
											?>
											<tr>
													<td><div style="display:none;"><?php echo $data_vencimento; ?></div></td>
													<td><span data-toggle="popover" data-trigger="hover" data-placement="top" data-content="<?php echo $descricao1?>"><?php echo $descricao; ?></span></td>
													<td><?php echo $data_vencimento1; ?></td>
													<td>R$ <?php echo $valor_bruto1; ?></td>
													<td><?php echo $tipo; ?></td>
													<td><?php echo $status_conta1; ?></td>

													<td><?php echo $botao_boleto?></td>
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
					colReorder: true,
					order: [[ 0, "desc" ]]
					
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
