<?php include('conexao.php');
	
$base64 = $_GET['c'];
$base = base64_decode($base64);
$cliente = explode(":", $base);
$id_usuarios = $cliente[1];

$date = date('Y-m-d');

$cons_user = mysqli_query($conn,"SELECT * FROM usuarios WHERE id_usuarios='$id_usuarios'");
if(mysqli_num_rows($cons_user) >= 1){
while ($result_user = mysqli_fetch_assoc($cons_user)) {
$usuario = $result_user['usuario'];
$ativo = $result_user['ativo'];
$telefone = $result_user['telefone'];
$nome = $result_user['nome'];
$id_cliente = $result_user['id_cliente'];
$nivel = $result_user['nivel'];
$email = $result_user['email'];
$usuario = $result_user['usuario'];
$veiculos1 = $result_user['veiculos'];
$user = explode("@", $usuario);
$login = $user[0];


$ultimo_login = $result_user['ultimo_login'];
if($ultimo_login != ''){
	$ultimo_login1 = date('d/m/Y H:i', strtotime("$ultimo_login"));
}
if($ultimo_login == ''){
	$ultimo_login1 = '';
}

if($ativo == 'SIM'){
	$ativo_n = 'NAO';
}
if($ativo == 'NAO'){
	$ativo_n = 'SIM';
}


$bloqueio = $result_user['permite_bloqueio'];
if($bloqueio != 'SIM'){
	$permite_bloqueio = '';
}
if($bloqueio == 'SIM'){
	$permite_bloqueio = 'checked';
}
$whats = $result_user['alertas_whats'];
if($whats != 'SIM'){
	$alertas_whats = '';
}
if($whats == 'SIM'){
	$alertas_whats = 'checked';
}
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
                    <?php include('include/head.php')?>
                    <!-- END Page Header -->
                    <!-- BEGIN Page Content -->
                    <!-- the #js-page-content id is needed for some plugins to initialize -->
                    <main id="js-page-content" role="main" class="page-content">
					
						<div class="row">
                            <div class="col-xl-8">
								<div class="subheader">
									<h1 class="subheader-title">
										<i class='subheader-icon fal fa-user'></i> Usuário: <?php echo $nome?>
										<small>
											Alteração de Usuário Master
										</small>
									</h1>
								</div>
							</div>
							
						</div>
                        
                        <form name="forml" id="forml">
                        <div class="row">
                            <div class="col-xl-12">
                                <div id="panel-1" class="panel">
                                    
                                    <div class="panel-container show">
                                        <div class="panel-content">
											 <div class="row">
												<div class="col-md-12">
												<button type="button" style="font-size:12px" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal"><i class="fal fa-trash-alt"></i> Excluir</button> 
												<button type="button" style="font-size:12px" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#reset_senha"><i class="fal fa-key"></i> Reset Senha</button>
												</div>
											</div><br>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label>Nome:</label>
														<input type="text" name="nome" id="nome" class="form-control text-uppercase" value="<?php echo $nome?>" readonly>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Login de Acesso:</label>
														<input type="text" name="usuario" id="usuario" class="form-control" value="<?php echo $login?>" readonly>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Nova Senha:</label>
														<input type="text" class="form-control" name="senha" id="senha">
														<input type="hidden" class="form-control" name="id_usuarios" id="id_usuarios" value="<?php echo $id_usuarios;?>">
														<input type="hidden" class="form-control" name="id_cliente" id="id_cliente" value="<?php echo $id_cliente;?>">
													</div>
													</div>
											</div><br>
											 <div class="row">
												<div class="col-md-3">
													<div class="form-group">
														<label>Tipo de Acesso:</label>
														<input type="text" class="form-control" name="nivel" id="nivel" value="MASTER" readonly>
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label>E-mail:</label>
														<input type="text" class="form-control" name="email" id="email" value="<?php echo $email;?>" required>
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label>ATIVO:</label>
														<select class="select2 form-control w-100" name="ativo" id="ativo">
															<option value="<?php echo $ativo?>"><?php echo $ativo?></option>
															<option value="<?php echo $ativo_n?>"><?php echo $ativo_n?></option>n>
														</select>
													</div>
												</div>
												<div class="col-md-3">
													<label>Celular Whatsapp:</label><br>
													<input type="text" class="form-control" name="telefone_celular" id="telefone_celular" value="<?php echo $telefone?>" required>
												</div>
											</div>
											<br>
											<div class="row">
												<div class="col-md-12">
													<label>Novos Veículos para vincular:</label><br>
													<select class="select2 form-control" multiple="multiple" name="veiculos[]" id="veiculos">
														<option value="todos">Todos</option>
														
													   <?php
																										
														$cons_cliente = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE status='1' ORDER BY id_veiculo ASC");
														if(mysqli_num_rows($cons_cliente) <= 0){
														echo '<option value="0">Nenhum Veículo Encontrado</option>';
														}else{
														
														while ($res_cliente = mysqli_fetch_assoc($cons_cliente)) {
														$id_veiculo = $res_cliente['id_veiculo'];
														$marca_veiculo = $res_cliente['marca_veiculo'];
														$modelo_veiculo = $res_cliente['modelo_veiculo'];
														$placa = $res_cliente['placa'];
														$deviceid = $res_cliente['deviceid'];

														echo '<option value="'.$deviceid.'">'.$placa.' - '.$marca_veiculo.'/'.$modelo_veiculo.'</option>';
														}
														}
														?>
														
													</select>
												</div>
												<br>
												
											</div><br>
											<div class="row">
												<div class="col-md-4">
													<label>Permitir Bloqueio no App:</label><br>
													<div class="custom-control custom-switch" >
														<input type="checkbox" class="custom-control-input" name="bloqueio" value="SIM" id="bloqueio" <?php echo $permite_bloqueio?>>
														<label class="custom-control-label" for="bloqueio"> </label>
													</div>
												</div>
												
												<div class="col-md-8 text-right">
													<label>Mensagem Boas Vindas:</label><br>
													<button type="button" data-toggle="modal" data-target="#enviar_bvindas1" style="text-align:center; font-size:13px; top:0; width:auto;" class="btn btn-success"><i class="fab fa-whatsapp"></i> Boas Vindas Novo</button>
													<button type="button" data-toggle="modal" data-target="#enviar_bvindas2" style="text-align:center; font-size:13px; top:0; width:auto;" class="btn btn-success"><i class="fab fa-whatsapp"></i> Boas Vindas Cliente</button>
												</div>
												
											</div>
											<br><br>
											<div class="row">
											   <div class="col-md-3">
													<div class="form-group">
														<button type="button" onclick="envia_3()" class="btn btn-success btn-sm" style="font-size:14px">Alterar</button>
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<a href="usuarios.php"><button type="button" class="btn btn-dark btn-sm" style="font-size:14px">Voltar</button></a>
													</div>
												</div>	
													  
											</div>
											<hr style="border:#000 1px solid;">
											<div class="row">
											   <div class="col-md-3">
													<div class="form-group">
														VEÍCULOS VINCULADOS
													</div>
												</div>
												  
											</div><br>
											<div class="row">
											   <div class="col-md-10">
													<div class="form-group">
													 <table class="table table-bordered table-hover table-striped">
														<thead>
															<tr>
																<th>PLACA</th>
																<th>VEICULO</th>
																<th>PROPRIETARIO</th>
																<th>AÇÕES</th>
															</tr>
														</thead>
														<tbody>
														<?php
														$cons_veic = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE deviceid IN ($veiculos1) ORDER BY id_veiculo DESC");
															if(mysqli_num_rows($cons_veic) > 0){
														while ($resp_veic = mysqli_fetch_assoc($cons_veic)) {
														$user_master = 	$resp_veic['user_master'];
														$id_veiculo = 	$resp_veic['id_veiculo'];
														$placa = 	$resp_veic['placa'];
														$marca_veiculo = 	$resp_veic['marca_veiculo'];
														$modelo_veiculo = $resp_veic['modelo_veiculo'];
														$id_cliente = $resp_veic['id_cliente'];
														$deviceid2 = $resp_veic['deviceid'];
														
														
														$cons_cliente = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente = '$id_cliente'");
															if(mysqli_num_rows($cons_cliente) > 0){
															while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
															$nome_cliente = 	$resp_cliente['nome_cliente'];
															}}
														
															
															?>
															 <tr>
																<th><?php echo $placa?></th>
																<th><?php echo $marca_veiculo?> / <?php echo $modelo_veiculo?></th>
																<td><?php echo $nome_cliente; ?></td>
																<td>
																	<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#remover<?php echo $deviceid2?>"><i class="fal fa-trash"></i></button>
																</td>
															</tr>
															
															<div class="modal fade" id="remover<?php echo $deviceid2?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
																<div class="modal-dialog modal-dialog-centered">
															<div class="modal-content">
																<div class="modal-header bg-danger text-white">
																	<h4 class="modal-title" id="myLargeModalLabel" style="color:#FFF;">REMOVER VEÍCULO!</h4>
																	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
																</div>
																<div class="modal-body">
																	<p>Deseja desvincular este veículo?</p><br>
																	<p>Esta ação é irreversível. Deseja prosseguir?</p>
																</div>
																<div class="modal-footer">
																	 <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
																	<a href="del_veic_master.php?deviceid=<?php echo $deviceid2; ?>&id_usuarios=<?php echo $id_usuarios?>"><button type="button" class="btn btn-danger">Excluir</button></a>
																</div>
															</div>
														</div>
													</div>
															
															<?php
														
														
															}}
														?>
													</tbody>
												</table>
													</div>
												</div>
												  
											</div>
										   
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						
						<?php
						$boas_vindas1 = '%2ABOAS+VINDAS%2A%0A%0APrezado%28a%29+'.$nome.'%0A%0A%C3%89+com+muito+prazer+que+a+JC+CAR+Rastreamento+lhe+d%C3%A1+Boas+Vindas.%0A%0ATrabalharemos+forte+para+lhe+oferecer+a+cada+dia+os+melhores+servi%C3%A7os+em+rastreamento+veicular%2C+buscando+sempre+a+excel%C3%AAncia+no+atendimento+e+na+qualidade.+Abaixo+seguem+os+dados+para+acesso+ao+nosso+app.%0A%0ALink+para+Android%3A%0Ahttp%3A%2F%2Fencurtador.com.br%2FACHMR%0A%0ALink+para+IOS%3A%0Ahttps%3A%2F%2Fapps.apple.com%2Fus%2Fapp%2Fjc-car-rastreamento%2Fid1559599855%0A%0ADados+de+Acesso%3A%0AUsu%C3%A1rio%3A+'.$login.'%0ASenha%3A+102030%0A%0A-----------------------------%0APara+que+voc%C3%AA+possa+receber+as+notifica%C3%A7%C3%B5es+via+whatsapp%2C+caso+seja+do+seu+interesse%2C+por+favor+salve+este+telefone+em+sua+agenda+de+contatos.%0A%0AQualquer+d%C3%BAvida+estamos+sempre+a+disposi%C3%A7%C3%A3o.%0A%0AAtenciosamente%2C%0A%2AComercial+JC+Rastreamento%2A';
						$boas_vindas1 = urldecode($boas_vindas1);
						?>
						
						<div class="modal fade" id="enviar_bvindas1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header bg-primary text-white">
										<h4 class="modal-title" id="myLargeModalLabel" style="color:#FFF;">BOAS VINDAS!</h4>
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									</div>
									<div class="modal-body">
										<div class="row">
											<div class="col-md-12">
												<p><b>Mensagem a ser enviada:</b><br><br>
												<textarea class="form-control" style="height:400px;" name="mensagem" id="mensagem"><?php echo $boas_vindas1?></textarea>
												<input type="hidden" id="origem" name="origem" value="MASTER">
											</div>
										</div>

									</div>
									<div class="modal-footer">
										 <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
										 <button type="button" onclick="envia_1();" class="btn btn-success">Enviar Mensagem</button>
									</div>
								</div>
							</div>
						</div>
						
						<?php
						$boas_vindas2 = '%27%2AAVISO+JC+RASTREAMENTO%2A%0A%0APrezado%28a%29+'.$nome.'%0A%0ASempre+pensando+em+melhorias+para+nossos+clientes%2C+%C3%A9+com+prazer+que+anunciamos+o+lan%C3%A7amento+da+nova+plataforma+de+rastreamento+e+o+novo+Aplicativo.+Ambos+foram+desenvolvidos+visando+mais+qualidade+e+seguran%C3%A7a+nas+informa%C3%A7%C3%B5es+e+servi%C3%A7os.+Estamos+encaminhando+as+informa%C3%A7%C3%B5es+para+que+voc%C3%AA+possa+acessar+o+novo+sistema.%0A%0ALink+para+baixar+Android%3A%0Ahttps%3A%2F%2Fencurtador.com.br%2FACHMR%0A%0ALink+para+baixar+IOS%3A%0Ahttps%3A%2F%2Fapps.apple.com%2Fus%2Fapp%2Fjc-car-rastreamento%2Fid1559599855%0A%0ADados+de+Acesso%3A%0AUsu%C3%A1rio%3A++'.$login.'%0ASenha%3A+102030%0A%0A-----------------------------%0APara+que+voc%C3%AA+possa+receber+as+notifica%C3%A7%C3%B5es+via+whatsapp%2C+caso+seja+do+seu+interesse%2C+por+favor+salve+este+telefone+em+sua+agenda+de+contatos.%0A%0AQualquer+d%C3%BAvida+estamos+sempre+a+disposi%C3%A7%C3%A3o.%0A%0AAtenciosamente%2C%0A%2AComercial+JC+Rastreamento%2A';
						$boas_vindas2 = urldecode($boas_vindas2);
						?>
						
						<div class="modal fade" id="enviar_bvindas2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header bg-primary text-white">
										<h4 class="modal-title" id="myLargeModalLabel" style="color:#FFF;">BOAS VINDAS!</h4>
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									</div>
									<div class="modal-body">
										<div class="row">
											<div class="col-md-12">
												<p><b>Mensagem a ser enviada:</b><br><br>
												<textarea class="form-control" style="height:400px;" name="mensagem2" id="mensagem2"><?php echo $boas_vindas2?></textarea>
												<input type="hidden" id="origem2" name="origem2" value="MASTER">
											</div>
										</div>

									</div>
									<div class="modal-footer">
										 <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
										 <button type="button" onclick="envia_2();" class="btn btn-success">Enviar Mensagem</button>
									</div>
								</div>
							</div>
						</div>
						
						</form>
                    </main>
					
					<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-header bg-danger text-white">
									<h4 class="modal-title" id="myLargeModalLabel" style="color:#FFF;">EXCLUIR!</h4>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								</div>
								<div class="modal-body">
									<p>Excluir este usuário?</p><br>
									<p>Esta ação é irreversível. Deseja prosseguir?</p>
								</div>
								<div class="modal-footer">
									 <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
									<a href="deletar_usuario_adm.php?&id_usuarios=<?php echo $id_usuarios; ?>"><button type="button" class="btn btn-danger">Excluir</button></a>
								</div>
							</div>
						</div>
					</div>
					
					
					<div class="modal fade" id="reset_senha" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-header bg-primary text-white">
									<h4 class="modal-title" id="myLargeModalLabel" style="color:#FFF;">RESET!</h4>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								</div>
								<div class="modal-body">
									<p><b>RESETAR SENHA DO USUÁRIO</b><br><br>
									
									

									<b>Deseja prosseguir?</b>
								</div>
								<div class="modal-footer">
									 <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
									 <a href="reset_senha_admin.php?id_usuarios=<?php echo $id_usuarios?>&nivel=<?php echo $nivel?>"><button type="button" class="btn btn-danger">Confirmar</button></a>
								</div>
							</div>
						</div>
					</div>
					
					
					
						<?php
						$date = date('Y-m-d');
						$reset = $_GET['reset'];
						if($reset == 'ok'){

						?>
						<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
						<script>
									$(document).ready(function(){
										$('#confirm').modal('show');
									});
								</script>
							<?php } ?>
							<div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-body text-center font-18">
											<h3 class="mb-20">Senha Alterada!</h3>
											<div class="mb-30 text-center"><img src="/tracker/Imagens/success.png"></div><br><br>
											A senha provisória é 123456
										</div>
										<div class="modal-footer justify-content-center">
											
											<button type="button" class="btn btn-dark" data-dismiss="modal">Fechar</button>
										</div>
									</div>
								</div>
							</div>
							
							<?php
						$date = date('Y-m-d');
						$send = $_GET['send'];
						if($send == 'ok'){

						?>
						<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
						<script>
									$(document).ready(function(){
										$('#send').modal('show');
									});
								</script>
							<?php } ?>
							<div class="modal fade" id="send" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-body text-center font-18">
											<h3 class="mb-20">Mensagem Enviada!</h3>
											<div class="mb-30 text-center"><img src="/tracker/Imagens/success.png"></div><br><br>
											
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
									<span style="fonta-size:20px">Aguarde... </span> <img src="/tracker2/Imagens/load.gif" width="40px" height="40px">
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
<script>
$('#forml').on('submit', function(e){
  $('#carregar').modal('show');
});
</script> 
<script>
function envia_1(){
	document.forml.action="enviar_bvindas1.php"
	document.forml.method = 'POST';
	document.forml.submit()
}
function envia_2(){
	document.forml.action="enviar_bvindas5.php"
	document.forml.method = 'POST';
	document.forml.submit()
}
function envia_3(){
	document.forml.action="edit_usuario_master.php"
	document.forml.method = 'POST';
	document.forml.submit()
}
</script>
<script type="text/javascript">
	$("#usuario").focusout(function(){
		var usuario = document.getElementById("usuario").value;
		$.get( "ajax/usuario.ajax.php?usuario="+usuario, function( data ) {
			console.log(data)
			if(data == 400){
			  //$( "#retorno_user" ).html('<span style="color:#990000">Usuário já existe</span>');
			  $("#usuario").addClass("is-invalid");
			  document.getElementById("botao").disabled = true;
			  //$("#usuario").focus();
			
			}
			
			if(data == 1){
			  $( "#retorno_user" ).html('<span style="color:#990000">Usuário já existe</span>');
			  $("#usuario").addClass("is-invalid");
			  document.getElementById("botao").disabled = true;
			  $("#usuario").focus();
			}
			if(data == 0){
			  $( "#retorno_user" ).html('');
			  $("#usuario").removeClass("is-invalid");
			  $("#usuario").addClass("is-valid");
			  //document.getElementById("usuario").style.borderColor = "red";
			  document.getElementById("botao").disabled = false;
			  

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
