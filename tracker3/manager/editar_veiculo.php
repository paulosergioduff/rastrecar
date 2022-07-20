<?php include('conexao.php');
	
$base64 = $_GET['c'];
$pag = $_GET['pag'];
$base = base64_decode($base64);
$dados = explode("&", $base);

$id_cliente = $dados[0];
$cliente = explode(":", $id_cliente);
$id_cliente = $cliente[1];

$id_veiculo = $dados[1];
$veiculo = explode(":", $id_veiculo);
$id_veiculo = $veiculo[1];

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
		<link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/datagrid/datatables/datatables.bundle.css">
    </head>
    <body class="mod-bg-1 nav-function-fixed" onload="bat_remov();bat_baixa();mov();vib();ign();panic();stat();">
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
					$cons_cliente = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
							if(mysqli_num_rows($cons_cliente) > 0){
						while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
						$nome_cliente = 	$resp_cliente['nome_cliente'];
						$id_cliente_pai = 	$resp_cliente['id_cliente_pai'];

							}}


						$cons_veic = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE id_veiculo='$id_veiculo'");
							if(mysqli_num_rows($cons_veic) > 0){
						while ($resp_veic = mysqli_fetch_assoc($cons_veic)) {
						$marca_veiculo = 	$resp_veic['marca_veiculo'];
						$modelo_veiculo = 	$resp_veic['modelo_veiculo'];
						$tipo_veiculo = 	$resp_veic['tipo_veiculo'];
						$ano_veiculo = 	$resp_veic['ano_veiculo'];
						$ano_modelo = 	$resp_veic['ano_modelo'];
						$placa = 	$resp_veic['placa'];
						$renavan = 	$resp_veic['renavan'];
						$chassi = 	$resp_veic['chassi'];
						$combustivel = 	$resp_veic['combustivel'];
						$cor_veiculo = 	$resp_veic['cor_veiculo'];
						$status = 	$resp_veic['status'];
						$imei = 	$resp_veic['imei'];
						$chip = 	$resp_veic['chip'];
						$iccid = 	$resp_veic['iccid'];
						$modelo_equip = 	$resp_veic['modelo_equip'];
						$operadora_veic = 	$resp_veic['operadora'];
						$fornecedor_chip_veic = 	$resp_veic['fornecedor_chip'];
						$pacote_veic = 	$resp_veic['pacote'];
						$valor_mensal = 	$resp_veic['valor_mensal'];
						$valor_mensal = number_format($valor_mensal, 2, ",", ".");
						$forma_pagamento = 	$resp_veic['forma_pagamento'];
						$deviceid = 	$resp_veic['deviceid'];
						$vendedor = 	$resp_veic['vendedor'];

						$alerta_ign = 	$resp_veic['alerta_ign'];
						$alerta_bateria = 	$resp_veic['alerta_bateria'];
						$alerta_bateria_baixa = 	$resp_veic['alerta_bateria_baixa'];
						$alerta_movimento = 	$resp_veic['alerta_movimento'];
						$alerta_vibracao = 	$resp_veic['alerta_vibracao'];
						$alerta_panico = 	$resp_veic['alerta_panico'];
						$alerta_voltagem = 	$resp_veic['alerta_voltagem'];
						}}


						$cons_vendedor = mysqli_query($con,"SELECT * FROM vendedores WHERE id_vendedor='$vendedor'");
							if(mysqli_num_rows($cons_vendedor) > 0){
						while ($resp_tipo = mysqli_fetch_assoc($cons_vendedor)) {
							$nome_vendedor = 	$resp_tipo['nome_vendedor'];
							$id_vendedor = 	$resp_tipo['id_vendedor'];
						}}




						if($alerta_ign == 'SIM'){
							$alerta_ign1 = 'checked';
						}
						if($alerta_ign != 'SIM'){
							$alerta_ign1 = '';
						}

						if($alerta_bateria == 'SIM'){
							$alerta_bateria1 = 'checked';
						}
						if($alerta_bateria != 'SIM'){
							$alerta_bateria1 = '';
						}

						if($alerta_bateria_baixa == 'SIM'){
							$alerta_bateria_baixa1 = 'checked';
						}
						if($alerta_bateria_baixa != 'SIM'){
							$alerta_bateria_baixa1 = '';
						}

						if($alerta_movimento == 'SIM'){
							$alerta_movimento1 = 'checked';
						}
						if($alerta_movimento != 'SIM'){
							$alerta_movimento1 = '';
						}

						if($alerta_vibracao == 'SIM'){
							$alerta_vibracao1 = 'checked';
						}
						if($alerta_vibracao != 'SIM'){
							$alerta_vibracao1 = '';
						}

						if($alerta_panico == 'SIM'){
							$alerta_panico1 = 'checked';
						}
						if($alerta_panico != 'SIM'){
							$alerta_panico1 = '';
						}



						if($status == 1){
							$status1 = 'checked';
						}
						if($status != 1){
							$status1 = '';
						}


						$cons_tipo = mysqli_query($con,"SELECT * FROM veiculos_tipos WHERE categoria='$tipo_veiculo' ORDER BY categoria DESC LIMIT 1");
							if(mysqli_num_rows($cons_tipo) > 0){
						while ($resp_tipo = mysqli_fetch_assoc($cons_tipo)) {
						$tipo_veiculo1 = 	$resp_tipo['tipo_veiculo'];
						}}

						$cons_porta = mysqli_query($con,"SELECT * FROM rastreadores_portas WHERE sigla='$modelo_equip'");
							if(mysqli_num_rows($cons_porta) > 0){
						while ($resp_porta = mysqli_fetch_assoc($cons_porta)) {
						$porta_veic = 	$resp_porta['porta'];
						$nome_equip = 	$resp_porta['nome'];
						}}

						$cons_pacote = mysqli_query($con,"SELECT * FROM pacotes WHERE id_pacote='$pacote_veic'");
								if(mysqli_num_rows($cons_pacote) > 0){
							while ($resp_pac = mysqli_fetch_assoc($cons_pacote)) {
							$pacote1 = 	$resp_pac['pacote'];
							}}
							
						$base64_cliente = 'id_cliente:'.$id_cliente.'';
						$base64_cliente = base64_encode($base64_cliente);	
					?>
                    <!-- END Page Header -->
                    <!-- BEGIN Page Content -->
                    <!-- the #js-page-content id is needed for some plugins to initialize -->
                    <main id="js-page-content" role="main" class="page-content">
					
						<div class="row">
                            <div class="col-xl-8">
								<div class="subheader">
									<h1 class="subheader-title">
										<i class='subheader-icon fal fa-car'></i> <?php echo $nome_cliente?>
										<small>
											Cadastro de Veículo
										</small>
									</h1>
								</div>
							</div>
							
						</div>
                        
                        <form name="forml" id="forml" action="edit_veiculo.php" method="post">
                        <div class="row">
                            <div class="col-xl-12">
                                <div id="panel-1" class="panel">
                                    
                                    <div class="panel-container show">
                                        <div class="panel-content">
											<div class="row">
												<div class="col-md-9">
													<h3>DADOS DO VEÍCULO</h3>
												</div>
												<div class="col-md-3">
													 <div class="custom-control custom-switch">
														<input type="checkbox" class="custom-control-input" onchange="stat();" id="status_veic" name="status_veic" value="SIM" <?php echo $status1?>>
														<label class="custom-control-label" for="status_veic" id="status_veic1"></label>
													</div>
												</div>
											</div>
											<hr style="border:#CCC 1px solid;">
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label>Tipo de Veículo:</label>
														<select class="select2 form-control" name="tipo_veiculo" id="tipo_veiculo" required>
															<option value="<?php echo $tipo_veiculo?>"><?php echo $tipo_veiculo1?></option>
																<?php
																$cons_marca = mysqli_query($conn,"SELECT * FROM veiculos_tipos ORDER BY tipo_veiculo ASC");
																if(mysqli_num_rows($cons_marca) <= 0){
																echo '<option value="0">Nenhum Tipo Encontrado</option>';
																}else{
																
																while ($res_marca = mysqli_fetch_assoc($cons_marca)) {
																$tipo_veiculo = $res_marca['tipo_veiculo'];
																$categoria = $res_marca['categoria'];
																echo '<option value="'.$categoria.'">'.$tipo_veiculo.'</option>';
																}
																}
																?>
														</select>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<div class="form-group">
															<label>Marca Veículo:</label>
															<select class="select2 form-control" name="marca_veiculo" id="marca_veiculo" required>
															<option value="<?php echo $marca_veiculo?>"><?php echo $marca_veiculo?></option>
															<?php
															$cons_marca = mysqli_query($conn,"SELECT * FROM veiculos_marcas ORDER BY marca ASC");
															if(mysqli_num_rows($cons_marca) <= 0){
															echo '<option value="0">Nenhum Pacote Encontrado</option>';
															}else{
															
															while ($res_marca = mysqli_fetch_assoc($cons_marca)) {
															$id_marca = $res_marca['id_marca'];
															$marca = $res_marca['marca'];
															echo '<option value="'.$marca.'">'.$marca.'</option>';
															}
															}
															?>
															</select>
														</div>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Modelo:</label>
														<input class="form-control" name="modelo_veiculo" id="modelo_veiculo" type="text" value="<?php echo $modelo_veiculo?>" required>
													</div>
												</div>
											</div><br>
											<div class="row">
												<div class="col-md-2">
													<div class="form-group">
														<label>Ano Fabricação:</label>
														<input class="form-control" name="ano_veiculo" id="ano_veiculo" type="number" value="<?php echo $ano_veiculo?>" required>
													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<label>Ano Modelo:</label>
														<input class="form-control" name="ano_modelo" id="ano_modelo" type="number" value="<?php echo $ano_modelo?>" required>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<div class="form-group">
															<label>Placa:</label>
															<input class="form-control" name="placa" id="placa" type="text" value="<?php echo $placa?>" required>
															<div id="retorno_placa"></div>
														</div>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Renavam:</label>
														<input class="form-control" name="renavan" id="renavan" type="number" value="<?php echo $renavan?>" required>
													</div>
												</div>			
											</div><br>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label>Chassi:</label>
														<input class="form-control" name="chassi" id="chassi" type="text" value="<?php echo $chassi?>" required>
													</div>

												</div>
												<div class="col-md-4">
													<div class="form-group">
														<div class="form-group">
															<label>Cor:</label>
															<input class="form-control" name="cor_veiculo" id="cor_veiculo" type="text" value="<?php echo $cor_veiculo?>" required>
														</div>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<div class="form-group">
															<label>Combustível:</label>
															<select class="select2 form-control" name="combustivel" id="combustivel" style="width: 100%; height: 38px;" required>
															<option value="<?php echo $combustivel?>"><?php echo $combustivel?></option>
															<option value="Gasolina">Gasolina</option>
															<option value="Gasolina/Etanol">Gasolina/Etanol</option>
															<option value="Gasolina/Etanol/GNV">Gasolina/Etanol/GNV</option>
															<option value="Gasolina/GNV">Gasolina/GNV</option>
															<option value="Diesel">Diesel</option>
															<option value="Diesel/GNV">Diesel/GNV</option>
															<option value="Etanol">Etanol</option>
															<option value="Eletrico">Elétrico</option>
															<option value="Hibrido">Hibrido</option>
															</select>
														</div>
													</div>
												</div>            
											</div><br>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label>Cliente:</label>
														<select class="select2 form-control" name="id_cliente" id="id_cliente" required>
														<option value="<?php echo $id_cliente?>"><?php echo $nome_cliente?></option>
														<?php
														$cons_clientes20 = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente != '$id_cliente' ORDER BY nome_cliente ASC");
														if(mysqli_num_rows($cons_clientes20) <= 0){
														echo '<option value="0">Nenhum Cliente Encontrado</option>';
														}else{
														
														while ($res_clientes20 = mysqli_fetch_assoc($cons_clientes20)) {
														$id_cliente20 = $res_clientes20['id_cliente'];
														$nome_cliente20 = $res_clientes20['nome_cliente'];
														echo '<option value="'.$id_cliente20.'">'.$nome_cliente20.'</option>';
														}
														}
														?>
														</select>
													</div>
												</div>
											</div><br>
											<div class="row">
												<div class="col-md-12">
													<h3>DADOS DO RASTREADOR/EQUIPAMENTO</h3>
													<hr style="border:#CCC 1px solid;">
												</div>
											</div><br>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label>Rastreador:</label>
														<select class="select2 form-control w-100" name="modelo_equip" id="modelo_equip">
															<option value="<?php echo $modelo_equip?>"><?php echo $modelo_equip?> / <?php echo $nome_equip?> - <?php echo $porta_veic?></option>
															<?php
															$cons_equip = mysqli_query($conn,"SELECT * FROM rastreadores_portas ORDER BY sigla ASC");
															if(mysqli_num_rows($cons_equip) <= 0){
															echo '<option value="0">Nenhum Equipamento Encontrado</option>';
															}else{
															
															while ($res_equip = mysqli_fetch_assoc($cons_equip)) {
															$id_disp = $res_equip['id_disp'];
															$nome = $res_equip['nome'];
															$porta = $res_equip['porta'];
															$sigla = $res_equip['sigla'];
															
															echo '<option value="'.$sigla.'">'.$sigla.' / '.$nome.' - '.$porta.'</option>';
															}
															}
															?>
														</select>
													</div>
												</div><br>
												<div class="col-md-4">
													<div class="form-group">
														<div class="form-group">
															<label>IMEI:</label>
															<div class="input-group flex-nowrap">
																<div class="input-group-prepend">
																	<a href="#" data-toggle="modal" data-target="#estoque"><span class="input-group-text"><i class="fal fa-search fs-xl"></i></span></a>
																</div>
																<input  type="text" id="imei" name="imei" value="<?php echo $imei?>" class="form-control" autocomplete="off">
															</div>
															<div id="retorno_imei"></div>
														</div>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Chip: <small>DDD+Número</small></label>
														<input class="form-control" name="chip" id="chip" type="number" placeholder="11999999999" value="<?php echo $chip?>" required>
														<div id="retorno_chip"></div>
													</div>
												</div>			
											</div><br>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<div class="form-group">
															<label>ICCID:</label>
															<input class="form-control" name="iccid" id="iccid" type="number" value="<?php echo $iccid?>" autocomplete="off">
														</div>
													</div>
												</div>
												
												<div class="col-md-4">
													<div class="form-group">
															<div class="form-group">
																<label>Operadora:</label>
																<select class="select2 form-control w-100" name="operadora" id="operadora">
																<option value="<?php echo $operadora_veic?>"><?php echo $operadora_veic?></option>
																<?php
																$cons_equip = mysqli_query($conn,"SELECT * FROM operadoras ORDER BY operadora ASC");
																if(mysqli_num_rows($cons_equip) <= 0){
																echo '<option value="0">Nenhuma Operadora Encontrada</option>';
																}else{
																
																while ($res_equip = mysqli_fetch_assoc($cons_equip)) {
																$operadora = $res_equip['operadora'];
																
																echo '<option value="'.$operadora.'">'.$operadora.'</option>';
																}
																}
																?>
																</select>	
															</div>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
															<div class="form-group">
																<label>Fornecedor:</label>
																<select class="select2 form-control w-100" name="fornecedor_chip" id="fornecedor_chip">
																<option value="<?php echo $fornecedor_chip_veic?>"><?php echo $fornecedor_chip_veic?></option>
																<?php
															$cons_forn = mysqli_query($conn,"SELECT * FROM fornecedor_chip ORDER BY fornecedor ASC");
															if(mysqli_num_rows($cons_forn) <= 0){
															echo '<option value="0">Nenhum fornecedor Encontrado</option>';
															}else{
															
															while ($res_f = mysqli_fetch_assoc($cons_forn)) {
															$fornecedor = $res_f['fornecedor'];
															
															echo '<option value="'.$fornecedor.'">'.$fornecedor.'</option>';
															}
															}															?>
																</select>	
															</div>
													</div>
												</div>
											</div><br><br>
											<div class="row">
												<div class="col-md-12">
													<h3>ALERTAS</h3>
												</div>
											</div>
											<div class="row">
												<div class="col-md-3">
													<label>Alerta Bateria Removida:</label><br>
													 <div class="custom-control custom-switch">
														<input type="checkbox" class="custom-control-input" onchange="bat_remov();" id="bateria_removida" name="bateria_removida" value="SIM" <?php echo $alerta_bateria1?>>
														<label class="custom-control-label" for="bateria_removida" id="bateria_removida1"></label>
													</div>
												</div>
												<div class="col-md-3">
													<label>Alerta Bateria Baixa:</label><br>
													 <div class="custom-control custom-switch">
														<input type="checkbox" class="custom-control-input" onchange="bat_baixa();" id="bateria_baixa" name="bateria_baixa" value="SIM" <?php echo $alerta_bateria_baixa1?>>
														<label class="custom-control-label" for="bateria_baixa" id="bateria_baixa1"></label>
													</div>
												</div>
												<div class="col-md-3">
													<label>Alerta Movimento:</label><br>
													 <div class="custom-control custom-switch">
														<input type="checkbox" class="custom-control-input" onchange="mov();" id="movimento" name="movimento" value="SIM" <?php echo $alerta_movimento1?>>
														<label class="custom-control-label" for="movimento" id="movimento1"></label>
													</div>
												</div>
												<div class="col-md-3">
													<label>Alerta Vibração:</label><br>
													 <div class="custom-control custom-switch">
														<input type="checkbox" class="custom-control-input" id="vibracao" onchange="vib();" name="vibracao" value="SIM" <?php echo $alerta_vibracao1?>>
														<label class="custom-control-label" for="vibracao" id="vibracao1"></label>
													</div>
												</div>
											</div><br>
											<div class="row">
												<div class="col-md-3">
													<label>Alerta Ignição:</label><br>
													 <div class="custom-control custom-switch">
														<input type="checkbox" class="custom-control-input" id="ignicao" onchange="ign();" name="ignicao" value="SIM" <?php echo $alerta_ign1?> >
														<label class="custom-control-label" for="ignicao" id="ignicao1"></label>
													</div>
												</div>
												<div class="col-md-3">
													<label>Alerta de Pânico:</label><br>
													 <div class="custom-control custom-switch">
														<input type="checkbox" class="custom-control-input" id="panico" onchange="panic();" name="panico" value="SIM" <?php echo $alerta_panico1?>>
														<label class="custom-control-label" for="panico" id="panico1"></label>
													</div>
												</div>
												
												
											</div><br><br>
											<div class="row">
												<div class="col-md-12">
													<h3>DADOS FINANCEIROS</h3>
													<hr style="border:#CCC 1px solid;">
												</div>
											</div><br>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<div class="form-group">
															<label>Plano / Pacote:</label>
															<select class="select2 form-control w-100" name="pacote" id="pacote" required>
																<option value="<?php echo $pacote_veic?>"><?php echo $pacote1?></option>
																<?php
																$cons_pacote = mysqli_query($conn,"SELECT * FROM pacotes ORDER BY pacote ASC");
																if(mysqli_num_rows($cons_pacote) <= 0){
																echo '<option value="0">Nenhum Pacote Encontrado</option>';
																}else{
																
																while ($res_pacote = mysqli_fetch_assoc($cons_pacote)) {
																$pacote = $res_pacote['pacote'];
																$id_pacote = $res_pacote['id_pacote'];
																$valor = $res_pacote['valor'];
																$valor = number_format($valor, 2, ",", ".");
																echo '<option value="'.$id_pacote.'">'.$pacote.' - R$ '.$valor.'</option>';
																}
																}
																?>
															</select>	
														</div>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<div class="form-group">
															<label>Valor Mensal:</label>
															<div id="retorno_pacote">
																<input class="form-control" name="valor_mensal" id="valor_mensal" onkeypress="return(MascaraMoeda(this,'.',',',event))"  autocomplete="off" type="text" value="<?php echo $valor_mensal?>">
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Forma de Pagamento Mensal:</label>
														<select class="select2 form-control w-100" name="forma_pagamento" id="forma_pagamento">
														<option value="<?php echo $forma_pagamento?>"><?php echo $forma_pagamento?></option>
															<?php
															$cons_pg = mysqli_query($conn,"SELECT * FROM tipo_pagamento ORDER BY tipo_pagamento ASC");
															if(mysqli_num_rows($cons_pg) <= 0){
															echo '<option value="0">Nenhum Pacote Encontrado</option>';
															}else{
															
															while ($res_pg = mysqli_fetch_assoc($cons_pg)) {
															$tipo_pagamento = $res_pg['tipo_pagamento'];
															$tipo_pagamento = utf8_encode($tipo_pagamento);
															echo '<option value="'.$tipo_pagamento.'">'.$tipo_pagamento.'</option>';
															}
															}
															?>
														</select>
													</div>
												</div>
											</div><br>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<div class="form-group">
															<label>Vendedor:</label>
															<select class="select2 form-control w-100" name="vendedor" id="vendedor" required>
																<option value="<?php echo $id_vendedor?>"><?php echo $nome_vendedor?></option>
																<?php
																$cons_vendedor1 = mysqli_query($conn,"SELECT * FROM vendedores WHERE id_vendedor != '$id_vendedor' ORDER BY nome_vendedor ASC");
																if(mysqli_num_rows($cons_vendedor1) <= 0){
																echo '<option value="0"></option>';
																}else{
																
																while ($res_vendedor = mysqli_fetch_assoc($cons_vendedor1)) {
																$vendedor1 = $res_vendedor['nome_vendedor'];
																$id_vendedor1 = $res_vendedor['id_vendedor'];
																echo '<option value="'.$id_vendedor1.'">'.$vendedor1.'</option>';
																}
																}
																?>
																<option value="0">Sem Vendedor</option>
															</select>	
														</div>
													</div>
												</div>
											</div>
											<br><br>
											<?php
											if($pag == 'veic'){
												$link_voltar = 'veiculos.php';
											}
											if($pag != 'veic'){
												$link_voltar = 'cad_cliente.php?c='.$base64_cliente.'';
											}
											?>
											<div class="row">
											   <div class="col-md-3">
													<div class="form-group">
														<button type="submit" id="botao" class="btn btn-info btn-sm">Salvar Alterações</button>
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<a href="<?php echo $link_voltar?>"><button type="button" class="btn btn-dark btn-sm">Voltar</button></a>
													</div>
												</div>	
													  
											</div>
											<input type="hidden" name="id_veiculo" id="id_veiculo" value="<?php echo $id_veiculo?>">
											<input type="hidden" name="id_cliente_pai" id="id_cliente_pai" value="<?php echo $id_cliente_pai?>">
											<input type="hidden" name="deviceid" id="deviceid" value="<?php echo $deviceid?>">
											<input type="hidden" name="pag" id="pag" value="<?php echo $pag?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						</form>
                    </main>
					
					   <?php
						$error = $_GET['error'];
						if($error == '1'){

						?>
							<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
						<script>
									$(document).ready(function(){
										$('#nova_conta').modal('show');
									});
								</script>
							<?php } ?>
							<div class="modal fade" id="nova_conta" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-body text-center font-18">
											<h3 class="mb-20">Erro!</h3>
											<div class="mb-30 text-center"><img src="/tracker3/Imagens/cross.png"></div><br><br>
											Não foi possível realizar as alterações. Verifique os dados digitados.
										</div>
										<div class="modal-footer justify-content-center">
											
											<button type="button" class="btn btn-dark" data-dismiss="modal">Fechar</button>
										</div>
									</div>
								</div>
							</div>
					
					

					
					<!-- DIV Carregar -->
					<div class="modal fade" id="carregar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-sm modal-dialog-centered">
							<div class="modal-content">
								
								<div class="modal-body" id="informacoes">
									<span style="fonta-size:20px">Aguarde... </span> <img src="/tracker3/Imagens/load.gif" width="40px" height="40px">
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
      
        <script src="/tracker3/app-assets/js/vendors.bundle.js"></script>
        <script src="/tracker3/app-assets/js/app.bundle.js"></script>
        <script src="/tracker3/app-assets/js/formplugins/select2/select2.bundle.js"></script>
		<script src="/tracker3/app-assets/js/datagrid/datatables/datatables.bundle.js"></script>
	<script>
function editar(e){

   var linha = $(e).closest("tr");
   var modelo_equip = linha.find("td:eq(0)").text().trim(); // texto da primeira coluna
   var imei  = linha.find("td:eq(1)").text().trim(); // texto da segunda coluna
   var chip = linha.find("td:eq(2)").text().trim(); // texto da terceira coluna
   var iccid   = linha.find("td:eq(3)").text().trim(); // texto da quarta coluna
   var operadora   = linha.find("td:eq(4)").text().trim(); // texto da quarta coluna
   var fornecedor_chip   = linha.find("td:eq(5)").text().trim(); // texto da quarta coluna

   $("select[name=modelo_equip]").html('<option value="'+modelo_equip+'">'+modelo_equip+'</option>');
   $("#imei").val(imei);
   $("#chip").val(chip);
   $("#iccid").val(iccid);
   $("select[name=operadora]").html('<option value="'+operadora+'">'+operadora+'</option>');
   $("select[name=fornecedor_chip]").html('<option value="'+fornecedor_chip+'">'+fornecedor_chip+'</option>');
	$('#estoque').modal('hide');
}
</script>	
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
<script>

function bat_remov(){
	//var bateria_removida = document.getElementById("bateria_removida").value;
	 if(bateria_removida.checked == true){
		$("#bateria_removida1").html('<h5><span class="badge" style="background-color:#009900;color:#FFF">ATIVADO</span></h5>');
	} else {
		$("#bateria_removida1").html('<h5><span class="badge badge-dark">OFF</span></h5>');
	}
}

function bat_baixa(){
	//var bateria_removida = document.getElementById("bateria_removida").value;
	 if(bateria_baixa.checked == true){
		$("#bateria_baixa1").html('<h5><span class="badge" style="background-color:#009900;color:#FFF">ATIVADO</span></h5>');
	} else {
		$("#bateria_baixa1").html('<h5><span class="badge badge-dark">OFF</span></h5>');
	}
}

function vib(){
	//var bateria_removida = document.getElementById("bateria_removida").value;
	 if(vibracao.checked == true){
		$("#vibracao1").html('<h5><span class="badge" style="background-color:#009900;color:#FFF">ATIVADO</span></h5>');
	} else {
		$("#vibracao1").html('<h5><span class="badge badge-dark">OFF</span></h5>');
	}
}

function mov(){
	//var bateria_removida = document.getElementById("bateria_removida").value;
	 if(movimento.checked == true){
		$("#movimento1").html('<h5><span class="badge" style="background-color:#009900;color:#FFF">ATIVADO</span></h5>');
	} else {
		$("#movimento1").html('<h5><span class="badge badge-dark">OFF</span></h5>');
	}
}

function ign(){
	//var bateria_removida = document.getElementById("bateria_removida").value;
	 if(ignicao.checked == true){
		$("#ignicao1").html('<h5><span class="badge" style="background-color:#009900;color:#FFF">ATIVADO</span></h5>');
	} else {
		$("#ignicao1").html('<h5><span class="badge badge-dark">OFF</span></h5>');
	}
}

function panic(){
	//var bateria_removida = document.getElementById("bateria_removida").value;
	 if(panico.checked == true){
		$("#panico1").html('<h5><span class="badge" style="background-color:#009900;color:#FFF">ATIVADO</span></h5>');
	} else {
		$("#panico1").html('<h5><span class="badge badge-dark">OFF</span></h5>');
	}
}



function stat(){
	//var bateria_removida = document.getElementById("bateria_removida").value;
	 if(status_veic.checked == true){
		$("#status_veic1").html('<h5><span class="badge" style="background-color:#009900;color:#FFF">VEÍCULO ATIVO</span></h5>');
	} else {
		$("#status_veic1").html('<h5><span class="badge" style="background-color:#FF6347;color:#FFF">VEÍCULO INATIVO</span></h5>');
	}
}

</script>
		
		
<script>
$('#forml').on('submit', function(e){
  $('#carregar').modal('show');
});
</script>  
 <script type="text/javascript">
	$(function(){
	  $("select[name=pacote]").change(function(){
	var pacote = document.getElementById("pacote").value;
	var id_empresa = 1361;
	$(document).ready(function () {
				listar_comando(pacote); //Chamar a função para listar os registros
			});
			
			function listar_comando(pacote){
				var dados = {
					pacote: pacote, id_empresa: id_empresa
				}
				$.post('ajax/pacote.ajax.php', dados , function(retorna){
					//Subtitui o valor no seletor id="conteudo"
					$("#retorno_pacote").html(retorna);
				});
			}
	  })	
	})
	
	
</script>
<script type="text/javascript">
	$("#imei").focusout(function(){
		var imei = document.getElementById("imei").value;
		$.get( "ajax/imei.ajax.php?imei="+imei, function( data ) {
			console.log(data)
			if(data == 400){
			  //$( "#retorno_user" ).html('<span style="color:#990000">Usuário já existe</span>');
			  $("#imei").addClass("is-invalid");
			  document.getElementById("botao").disabled = true;
			  //$("#usuario").focus();
			
			}
			
			if(data == 1){
			  $( "#retorno_imei" ).html('<span style="color:#990000">Equipamento já cadastrado</span>');
			  $("#imei").addClass("is-invalid");
			  document.getElementById("botao").disabled = true;
			  $("#imei").focus();
			}
			if(data == 0){
			  $( "#retorno_imei" ).html('');
			  $("#imei").removeClass("is-invalid");
			  $("#imei").addClass("is-valid");
			  //document.getElementById("usuario").style.borderColor = "red";
			  document.getElementById("botao").disabled = false;
			  

			}
		});
	});
</script>
<script type="text/javascript">
	$("#chip").focusout(function(){
		var chip = document.getElementById("chip").value;
		$.get( "ajax/chip.ajax.php?chip="+chip, function( data1 ) {
			console.log(data1)
			if(data1 == 400){
			  //$( "#retorno_user" ).html('<span style="color:#990000">Usuário já existe</span>');
			  $("#chip").addClass("is-invalid");
			  document.getElementById("botao").disabled = true;
			  //$("#usuario").focus();
			
			}
			
			if(data1 == 1){
			  $( "#retorno_chip" ).html('<span style="color:#990000">Chip já cadastrado</span>');
			  $("#chip").addClass("is-invalid");
			  document.getElementById("botao").disabled = true;
			  $("#chip").focus();
			}
			if(data1 == 0){
			  $( "#retorno_chip" ).html('');
			  $("#chip").removeClass("is-invalid");
			  $("#chip").addClass("is-valid");
			  //document.getElementById("usuario").style.borderColor = "red";
			  document.getElementById("botao").disabled = false;
			  

			}
		});
	});
</script>
<script type="text/javascript">
	$("#placa").focusout(function(){
		var placa = document.getElementById("placa").value;
		$.get( "ajax/placa.ajax.php?placa="+placa, function( data_placa ) {
			console.log(data_placa)
			if(data_placa == 400){
			  //$( "#retorno_user" ).html('<span style="color:#990000">Usuário já existe</span>');
			  $("#placa").addClass("is-invalid");
			  //document.getElementById("botao").disabled = true;
			  //$("#usuario").focus();
			
			}
			
			if(data_placa == 1){
			  $( "#retorno_placa" ).html('<span style="color:#990000">placa já cadastrada</span>');
			  $("#placa").addClass("is-invalid");
			  //document.getElementById("botao").disabled = true;
			  $("#placa").focus();
			}
			if(data_placa == 0){
			  $( "#retorno_placa" ).html('');
			  $("#placa").removeClass("is-invalid");
			  $("#placa").addClass("is-valid");
			  //document.getElementById("usuario").style.borderColor = "red";
			  //document.getElementById("botao").disabled = false;
			  

			}
		});
	});
</script>




 <script>
	$(document).ready(function()
            {
                $(function()
                {
                    $('.select2').select2();

                    $(".select2-placeholder-multiple").select2(
                    {
                        placeholder: "Select State"
                    });
                    $(".js-hide-search").select2(
                    {
                        minimumResultsForSearch: 1 / 0
                    });
                    $(".js-max-length").select2(
                    {
                        maximumSelectionLength: 2,
                        placeholder: "Select maximum 2 items"
                    });
                    $(".select2-placeholder").select2(
                    {
                        placeholder: "Select a state",
                        allowClear: true
                    });



                    $(".js-select2-icons").select2(
                    {
                        minimumResultsForSearch: 1 / 0,
                        templateResult: icon,
                        templateSelection: icon,
                        escapeMarkup: function(elm)
                        {
                            return elm
                        }
                    });

                    function icon(elm)
                    {
                        elm.element;
                        return elm.id ? "<i class='" + $(elm.element).data("icon") + " mr-2'></i>" + elm.text : elm.text
                    }

                    $(".js-data-example-ajax").select2(
                    {
                        ajax:
                        {
                            url: "https://api.github.com/search/repositories",
                            dataType: 'json',
                            delay: 250,
                            data: function(params)
                            {
                                return {
                                    q: params.term, // search term
                                    page: params.page
                                };
                            },
                            processResults: function(data, params)
                            {
                                // parse the results into the format expected by Select2
                                // since we are using custom formatting functions we do not need to
                                // alter the remote JSON data, except to indicate that infinite
                                // scrolling can be used
                                params.page = params.page || 1;

                                return {
                                    results: data.items,
                                    pagination:
                                    {
                                        more: (params.page * 30) < data.total_count
                                    }
                                };
                            },
                            cache: true
                        },
                        placeholder: 'Search for a repository',
                        escapeMarkup: function(markup)
                        {
                            return markup;
                        }, // let our custom formatter work
                        minimumInputLength: 1,
                        templateResult: formatRepo,
                        templateSelection: formatRepoSelection
                    });

                    function formatRepo(repo)
                    {
                        if (repo.loading)
                        {
                            return repo.text;
                        }

                        var markup = "<div class='select2-result-repository clearfix d-flex'>" +
                            "<div class='select2-result-repository__avatar mr-2'><img src='" + repo.owner.avatar_url + "' class='width-2 height-2 mt-1 rounded' /></div>" +
                            "<div class='select2-result-repository__meta'>" +
                            "<div class='select2-result-repository__title fs-lg fw-500'>" + repo.full_name + "</div>";

                        if (repo.description)
                        {
                            markup += "<div class='select2-result-repository__description fs-xs opacity-80 mb-1'>" + repo.description + "</div>";
                        }

                        markup += "<div class='select2-result-repository__statistics d-flex fs-sm'>" +
                            "<div class='select2-result-repository__forks mr-2'><i class='fal fa-lightbulb'></i> " + repo.forks_count + " Forks</div>" +
                            "<div class='select2-result-repository__stargazers mr-2'><i class='fal fa-star'></i> " + repo.stargazers_count + " Stars</div>" +
                            "<div class='select2-result-repository__watchers mr-2'><i class='fal fa-eye'></i> " + repo.watchers_count + " Watchers</div>" +
                            "</div>" +
                            "</div></div>";

                        return markup;
                    }

                    function formatRepoSelection(repo)
                    {
                        return repo.full_name || repo.text;
                    }

                });
            });

  </script>
  <script>
function MascaraMoeda(objTextBox, SeparadorMilesimo, SeparadorDecimal, e){
    var sep = 0;
    var key = '';
    var i = j = 0;
    var len = len2 = 0;
    var strCheck = '0123456789';
    var aux = aux2 = '';
    var whichCode = (window.Event) ? e.which : e.keyCode;
    if (whichCode == 13) return true;
    key = String.fromCharCode(whichCode); // Valor para o código da Chave
    if (strCheck.indexOf(key) == -1) return false; // Chave inválida
    len = objTextBox.value.length;
    for(i = 0; i < len; i++)
        if ((objTextBox.value.charAt(i) != '0') && (objTextBox.value.charAt(i) != SeparadorDecimal)) break;
    aux = '';
    for(; i < len; i++)
        if (strCheck.indexOf(objTextBox.value.charAt(i))!=-1) aux += objTextBox.value.charAt(i);
    aux += key;
    len = aux.length;
    if (len == 0) objTextBox.value = '';
    if (len == 1) objTextBox.value = '0'+ SeparadorDecimal + '0' + aux;
    if (len == 2) objTextBox.value = '0'+ SeparadorDecimal + aux;
    if (len > 2) {
        aux2 = '';
        for (j = 0, i = len - 3; i >= 0; i--) {
            if (j == 3) {
                aux2 += SeparadorMilesimo;
                j = 0;
            }
            aux2 += aux.charAt(i);
            j++;
        }
        objTextBox.value = '';
        len2 = aux2.length;
        for (i = len2 - 1; i >= 0; i--)
        objTextBox.value += aux2.charAt(i);
        objTextBox.value += SeparadorDecimal + aux.substr(len - 2, len);
    }
    return false;
}

function MascaraFloat3(objTextBox, SeparadorMilesimo, SeparadorDecimal, e){
	var sep = 0;
	var key = '';
	var i = j = 0;
	var len = len2 = 0;
	var strCheck = '0123456789';
	var aux = aux2 = '';
	var whichCode = (window.Event) ? e.which : e.keyCode;
	if (whichCode == 13 || whichCode == 8) return true;
	key = String.fromCharCode(whichCode); // Valor para o código da Chave
	if (strCheck.indexOf(key) == -1) return false; // Chave inválida
	len = objTextBox.value.length;
	for(i = 0; i < len; i++)
	if ((objTextBox.value.charAt(i) != '0') && (objTextBox.value.charAt(i) != SeparadorDecimal)) break;
	aux = '';
	for(; i < len; i++)
	if (strCheck.indexOf(objTextBox.value.charAt(i))!=-1) aux += objTextBox.value.charAt(i);
	aux += key;
	len = aux.length;
	if (len == 0) objTextBox.value = '';
	if (len == 1) objTextBox.value = '0'+ SeparadorDecimal + '00' + aux;
	if (len == 2) objTextBox.value = '0'+ SeparadorDecimal + '0' + aux;
	if (len == 3) objTextBox.value = '0'+ SeparadorDecimal + aux;
	if (len > 3) {
		aux2 = '';
		for (j = 0, i = len - 4; i >= 0; i--) {
			if (j == 3) {
				aux2 += SeparadorMilesimo;
				j = 0;
			}
			aux2 += aux.charAt(i);
			j++;
		}
		objTextBox.value = '';
		len2 = aux2.length;
		for (i = len2 - 1; i >= 0; i--)
		objTextBox.value += aux2.charAt(i);
		objTextBox.value += SeparadorDecimal + aux.substr(len - 3, len);
	}
	return false;
}

function fmtMoney(n, c, d, t){ 
   var m = (c = Math.abs(c) + 1 ? c : 2, d = d || ",", t = t || ".", 
      /(\d+)(?:(\.\d+)|)/.exec(n + "")), x = m[1].length > 3 ? m[1].length % 3 : 0; 
   return (x ? m[1].substr(0, x) + t : "") + m[1].substr(x).replace(/(\d{3})(?=\d)/g, 
      "$1" + t) + (c ? d + (+m[2] || 0).toFixed(c).substr(2) : ""); 
};
</script>
</body>
</html>
