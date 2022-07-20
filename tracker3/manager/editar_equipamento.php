<?php include('conexao.php');
	
$base64 = $_GET['c'];
$base = base64_decode($base64);
$equip = explode(":", $base);
$id_equip = $equip[1];

$cons_estoque = mysqli_query($conn,"SELECT * FROM estoque_rastreadores WHERE id_equip='$id_equip'");
	if(mysqli_num_rows($cons_estoque) > 0){
while ($resp_estoque = mysqli_fetch_assoc($cons_estoque)) {
$deviceid = 	$resp_estoque['deviceid'];
$imei = 	$resp_estoque['imei'];
$modelo_equip = 	$resp_estoque['modelo_equip'];
$operadora = 	$resp_estoque['operadora'];
$chip = 	$resp_estoque['chip'];
$iccid = 	$resp_estoque['iccid'];
$fornecedor_chip = 	$resp_estoque['fornecedor_chip'];
$obs_bateria = 	$resp_estoque['obs_bateria'];
}}

if($deviceid <= 0 or $deviceid == ''){
	$correcao = '<a href="att_equipamento.php?imei='.$imei.'&id_equip='.$id_equip.'"><button  type="button" class="btn btn-warning btn-sm">Atualizar</button></a>';
}


$cons_modelo = mysqli_query($conn,"SELECT * FROM rastreadores_portas WHERE sigla='$modelo_equip'");
	if(mysqli_num_rows($cons_modelo) > 0){
while ($resp_modelo = mysqli_fetch_assoc($cons_modelo)) {
$nome1	 = 	$resp_modelo['nome'];
$porta1	 = 	$resp_modelo['porta'];
$sigla1	 = 	$resp_modelo['sigla'];

	}}

$cons_fornecedor = mysqli_query($conn,"SELECT * FROM fornecedor_chip WHERE fornecedor='$fornecedor_chip'");
	if(mysqli_num_rows($cons_fornecedor) > 0){
while ($resp_modelo = mysqli_fetch_assoc($cons_fornecedor)) {
$fornecedor	 = 	$resp_modelo['fornecedor'];


	}}
	
	
if($modelo_equip == 'M1' or $modelo_equip == 'F1'){
	$obs_bat = '<div class="col-md-6">
				<div class="form-group">
					<label>Obs Bateria Interna:</label>
					<input type="text" name="obs_bateria" id="obs_bateria" class="form-control" value="'.$obs_bateria.'" required>
					<div id="retorno_user"></div>
				</div>
			</div>';
}

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
			<script src="https://kit.fontawesome.com/a132241e15.js"></script>
    </head>
    <body class="mod-bg-1 nav-function-fixed">
        <!-- DOC: script to save and load page settings -->

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
					<form name="forml">
                    <main id="js-page-content" role="main" class="page-content">
					
						<div class="row">
                            <div class="col-xl-8">
								<div class="subheader">
									<h1 class="subheader-title">
										<i class='subheader-icon fal fa-mobile-android-alt'></i> <?php echo $modelo_equip?> - IMEI: <?php echo $imei?>
										<small>
											
										</small>
									</h1>
								</div>
							</div>
							<div class="col-xl-4 text-right">
								 <div class="btn-group">
									<button type="button" class="btn btn-danger btn-sm shadow-0" data-toggle="modal" data-target="#excluir" style="font-size:14px"><i class="fas fa-trash"></i> Excluir Dispositivo</button>
								</div>
							</div>
						</div>
                        
                       
                        <div class="row">
                            <div class="col-xl-8">
                                <div id="panel-1" class="panel">
                                    
                                    <div class="panel-container show">
                                        <div class="panel-content">
											<h3>DADOS DO EQUIPAMENTO</h3>
											<hr style="border:#CCC 1px solid;">
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label>Modelo:</label>
														<select class="select2 form-control w-100" name="modelo_equip" id="modelo_equip">
															<option value="<?php echo $sigla1?>"><?php echo ''.$sigla1.' | '.$nome1.' | '.$porta1.''?></option>
															<?php
															$cons_equip = mysqli_query($conn,"SELECT * FROM rastreadores_portas WHERE sigla != '$name' ORDER BY sigla ASC");
															if(mysqli_num_rows($cons_equip) <= 0){
															echo '<option value="0">Nenhum Equipamento Encontrado</option>';
															}else{
															
															while ($res_equip = mysqli_fetch_assoc($cons_equip)) {
															$id_disp = $res_equip['id_disp'];
															$nome = $res_equip['nome'];
															$porta = $res_equip['porta'];
															$sigla = $res_equip['sigla'];
															
															echo '<option value="'.$sigla.'">'.$sigla.' | '.$nome.' | '.$porta.'</option>';
															}
															}
															?>
														</select>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>IMEI:</label>
														<input type="text" name="imei" id="imei" class="form-control" value="<?php echo $imei?>" required>
														<div id="retorno_user"></div>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Nº Linha: <small><i>Somente números</i></small></label>
														<input type="number" class="form-control" name="chip" id="chip" value="<?php echo $chip?>" required>
														<input type="hidden" class="form-control" name="id_equip" id="id_equip" value="<?php echo $id_equip?>" required>
														<input type="hidden" class="form-control" name="deviceid" id="deviceid" value="<?php echo $deviceid?>" required>
													</div>
												</div>
												
											</div><br>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label>ICCID:</label>
														<input type="number" class="form-control" name="iccid" id="iccid" value="<?php echo $iccid?>" required>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Operadora:</label>
														<select class="select2 form-control w-100" name="operadora" id="operadora" required>
															<option value="<?php echo $operadora?>"><?php echo $operadora?></option>
															<?php
															$cons_op = mysqli_query($conn,"SELECT * FROM operadoras WHERE operadora !='$operadora' ORDER BY operadora ASC");
															if(mysqli_num_rows($cons_op) <= 0){
															echo '<option value="0">Nenhum Equipamento Encontrado</option>';
															}else{
															
															while ($res_op = mysqli_fetch_assoc($cons_op)) {
															$operadora1 = $res_op['operadora'];
															
															echo '<option value="'.$operadora1.'">'.$operadora1.'</option>';
															}
															}
															?>
														</select>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Fornecedor M2M:</label>
														<select class="select2 form-control w-100" name="fornecedor" id="fornecedor" required>
															<option value="<?php echo $fornecedor_chip?>"><?php echo $fornecedor?></option>
															<?php
															$cons_forn = mysqli_query($conn,"SELECT * FROM fornecedor_chip WHERE id_fornecedor != '$fornecedor_chip' ORDER BY fornecedor ASC");
															if(mysqli_num_rows($cons_forn) <= 0){
															echo '<option value="0">Nenhum fornecedor Encontrado</option>';
															}else{
															
															while ($res_f = mysqli_fetch_assoc($cons_forn)) {
															$fornecedor = $res_f['fornecedor'];
															
															echo '<option value="'.$fornecedor.'">'.$fornecedor.'</option>';
															}
															}
															?>
														</select>
													</div>
												</div>
											</div><br>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label>Loja:</label>
														<select class="select2 form-control" name="customer_fact" id="customer_fact" style="width: 100%; height: 38px;" required>
															<?php
															if($acesso == 'GERAL'){
															?>
															<option value="1361">LOJA HORIZONTE</option>
															<option value="1362">LOJA FORTALEZA</option>
															<?php
															}	
															?>
															<?php
															if($acesso != 'GERAL'){
																if($id_empresa == 1361){
																?>
																<option value="1361">LOJA HORIZONTE</option>
																<?php
																}
																if($id_empresa == 1362){
																?>
																<option value="1362">LOJA FORTALEZA</option>
																<?php
																}
															}	
															?>
															
															
															
															</select>
													</div>
												</div>
												<?php echo $obs_bat?>
											</div><br>
											<div class="row">
											   <div class="col-md-2">
													<div class="form-group">
														<button type="button" onClick="envia_2();" class="btn btn-success btn-sm" data-toggle="modal" data-target="#carregar" style="font-size:14px">Salvar</button>
													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<a href="equipamentos.php"><button type="button" class="btn btn-dark btn-sm" style="font-size:14px">Voltar</button></a>
													</div>
												</div>	  
											</div>
											
											
											
											
                                        </div>
                                    </div>
                                </div>
                            </div>
							<div class="col-xl-4">
                                <div id="panel-1" class="panel">
                                    
                                    <div class="panel-container show">
                                        <div class="panel-content">
											<h3>STATUS / INFORMAÇÕES</h3>
											<hr style="border:#CCC 1px solid;">
											<div class="row">
												<div class="col-md-12">
													<div id="equipamentos"><img src="/tracker2/Imagens/load.gif" width="40px" height="40px"> Carregando Informações</div>	
												</div>
											</div>
											<hr style="border:#CCC 1px solid;">
											<div class="row">
												<div class="col-md-6">
													<button type="button" style="width:100%" class="btn btn-danger btn-sm shadow-0" data-toggle="modal" data-target="#bloquear" style="font-size:14px"><i class="fas fa-lock"></i> Bloquear</button>
												</div>
												<div class="col-md-6">
													<button type="button" style="width:100%" class="btn btn-success btn-sm shadow-0" data-toggle="modal" data-target="#desbloqueio" style="font-size:14px"><i class="fas fa-lock-open"></i> Desbloquear</button>
												</div>
											</div><br>
											<div class="row">
												<div class="col-md-6">
													<button type="button" style="width:100%" class="btn btn-info btn-sm shadow-0" data-toggle="modal" data-target="#comandos" style="font-size:14px"><i class="fas fa-sms"></i> Comandos SMS</button>
												</div>
												<div class="col-md-6">
													<button type="button" style="width:100%" class="btn btn-info btn-sm shadow-0" data-toggle="modal" data-target="#logs" style="font-size:14px"><i class="fas fa-th-list"></i> Logs</button>
												</div>
											</div>
											
											
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						<div class="row">
							<div class="col-xl-8">
                                <div id="panel-1" class="panel">
                                    
                                    <div class="panel-container show">
                                        <div class="panel-content">
											<h3>COMANDOS ENVIADOS</h3>
											<hr style="border:#CCC 1px solid;">
											<div class="row">
												<div class="col-md-12">
													 <table class="table table-striped table-bordered table-hover">
														  <thead>
															<tr>
															  <th>Data Envio</th>
															  <th>Comando</th>
															  <th>Status</th>
															  <th>Resposta</th>
															</tr>
														  </thead>
														  <tbody id="status_comando"> 
														  
														
														
															</tbody>
														</table>
												</div>
												
											</div><br>
											
                                        </div>
                                    </div>
                                </div>
                            </div>
						</div>

                    </main>
					
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
					
					
					<div class="modal fade" id="novo_registro" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-lg">
							<div class="modal-content">
								<div class="modal-header text-white bg-primary">
									<h4 class="modal-title" id="myLargeModalLabel" style="color:#FFF;"> NOVO REGISTRO</h4>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								</div>
								<div class="modal-body">
									<br>
									<label>Nome da Classificação Financeira</label><br>
									<input type="text" class="form-control" name="nova_categoria" id="nova_categoria" required>
								</div>
								<div class="modal-footer">
									 <button type="button" style="font-size:14px" class="btn btn-primary btn-sm" data-dismiss="modal">Cancelar</button>
									<button type="button" style="font-size:14px" onclick="add();" class="btn btn-success btn-sm">Cadastrar</button>
								</div>
							</div>
						</div>
					</div>
					
					
					<div class="modal fade" id="logs" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog modal-dialog-right modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title h4">Logs de Comunicação</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true"><i class="fal fa-times"></i></span>
									</button>
								</div>
								<div class="modal-body">
									 <div class="row">
										<div class="col-md-6">
											<h3>Log Posições</h3>
											<div class="form-group"  style="border:#000 1px solid; overflow-x:auto; height:500px;background-color:#4682B4;color:#FFF">
												<div id="log"></div>
												
											</div>
										</div>
										<div class="col-md-6" >
										<h3>Log Alarmes/Eventos</h3>
											<div class="form-group" style="border:#000 1px solid; overflow-x:auto; height:500px;background-color:#4682B4;color:#FFF">
												<div id="evento"></div>
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
								</div>
							</div>
						</div>
					</div>
					
					
					<div class="modal fade" id="excluir" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-header text-white" style="background-color:#990000">
									<h4 class="modal-title" id="myLargeModalLabel" style="color:#FFF;"><i class="far fa-trash-alt"></i> EXCLUIR EQUIPAMENTO?</h4>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								</div>
								<div class="modal-body">
									Deseja Excluir o Equipamento <?php echo ''.$sigla1.' | '.$nome1.' | '.$porta1.''?><br><br><br>
								
									<span>Esta Ação é irreverssível. </span>
									

									Deseja prosseguir?
								</div>
								<div class="modal-footer">
									 <button type="button" style="font-size:14px" class="btn btn-primary btn-sm" data-dismiss="modal">Cancelar</button>
									<a href="delete_rastreavel_temp.php?imei=<?php echo $imei; ?>&id_equip=<?php echo $id_equip?>"><button type="button" style="font-size:14px" class="btn btn-danger btn-sm">Excluir</button></a>
								</div>
							</div>
						</div>
					</div>
					
					<div class="modal inmodal" id="comandos"  role="dialog" >
						<div class="modal-dialog modal-lg">
							<div class="modal-content animated bounceInRight">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
									
								</div>
								<div class="modal-body">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group text-center">
											<i class="fas fa-mobile fa-3x"></i>
												
												<h4>Equipamento: <?php echo $modelo_equip?>.</h4>
												<h4>Linha: <?php echo $chip?>.</h4>
											</div>
										</div>
									</div><br>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>Selecione o Comando:</label>
												 <select class="select2 form-control w-100l" name="comando" id="comando">
												 <option value="">Selecione</option>
													<?php
													$cons_comandos = mysqli_query($conn,"SELECT * FROM comandos_equip WHERE equipamento='$modelo_equip' ORDER BY nome_comando ASC");
													if(mysqli_num_rows($cons_comandos) <= 0){
													echo '<option value="0">Nenhum Pacote Encontrado</option>';
													}else{
													
													while ($res_cat = mysqli_fetch_assoc($cons_comandos)) {
													$id_comando = $res_cat['id_comando'];
													$nome_comando = $res_cat['nome_comando'];
													$tipo = $res_cat['tipo'];
													echo '<option value="'.$id_comando.'">'.$tipo.' | '.$nome_comando.'</option>';
													}
													}
													?>
												
												</select>
												
												<input type="hidden" value="<?php echo $deviceid?>" id="deviceid1" name="deviceid1">
												
											</div>
										</div>
									</div><br>
									<div id="retorno_comando">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label>Comando:</label>
													<input type="text" class="form-control" name="sms_comando" id="sms_comando">
												</div>
											</div>
										</div>
									</div>
									
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-dark btn-sm" data-dismiss="modal">Fechar</button>
									<button type="button" onClick="envia_1();" class=" btn btn-primary btn-sm">Enviar</button>
								</div>
							</div>
						</div>
					</div>
					</form>
					
						<!-- ----- MODAL BLOQUEIO --->	
					
					<div class="modal fade" id="bloquear" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-lg">
							<div class="modal-content">
								<div class="modal-header bg-primary text-white">
									<h3 class="modal-title" id="myLargeModalLabel" style="color:#FFF;"><i class="fas fa-lock"></i> COMANDO DE BLOQUEIO</h3>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								</div>
								<div class="modal-body">
									
									<p>Deseja efetuar o BLOQUEIO do dispositivo?</p>
								</div>
								<div class="modal-footer">
									 <button type="button"  class="btn btn-dark" data-dismiss="modal">Cancelar</button>
									 <a href="comandos/comandos_estoque.php?t=BLOQUEIO&model=<?php echo $modelo_equip?>&deviceid=<?php echo $deviceid?>&nome_user=<?php echo $user_nome?>&id_equip=<?php echo $id_equip?>"><button onclick="bloqueio();" type="button" class="btn btn-danger shadow-0" style="width:100%"><i class="fas fa-lock"></i> Bloquear</button></a><br>
								</div>
							</div>
						</div>
					</div>

					<!-- ----- FIM MODAL BLOQUEIO --->	
					
					
					<!-- ----- MODAL DESBLOQUEIO --->	
					
					<div class="modal fade" id="desbloqueio" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-lg">
							<div class="modal-content">
								<div class="modal-header bg-primary text-white">
									<h3 class="modal-title" id="myLargeModalLabel" style="color:#FFF;"><i class="fas fa-lock"></i> COMANDO DE DESBLOQUEIO</h3>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								</div>
								<div class="modal-body">
									
									<p>Deseja efetuar o DESBLOQUEIO do dispositivo?</p>
								</div>
								<div class="modal-footer">
									 <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
									 <a href="comandos/comandos_estoque.php?t=DESBLOQUEIO&model=<?php echo $modelo_equip?>&deviceid=<?php echo $deviceid?>&nome_user=<?php echo $user_nome?>&id_equip=<?php echo $id_equip?>"><button type="button" class="btn btn-success shadow-0" onClick="desbloqueio();" style="width:100%"><i class="fas fa-lock-open"></i> Desbloquear</button></a><br>
								</div>
							</div>
						</div>
					</div>
					
					<?php

					$res = $_GET['res'];
					$cmd = $_GET['cmd'];
					if($res == 202){
						
					 ?>
							<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
							<script>
								$(document).ready(function(){
									$('#confirm_comando').modal('show');
								});
							</script>
				<?php } ?>
					
					
					<div class="modal fade" id="confirm_comando" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-body text-center font-18">
									<h4 class="mb-20">DISPOSITIVO OFFLINE</h4>
									<div class="mb-30 text-center"><i class="fas fa-times fa-3x" style="color:#990000"></i></div><br><br>
									<h4 class="mb-20">O COMANDO SERÁ EXECUTADO QUANDO O DISPOSITIVO ESTIVER ONLINE!</h4>
								</div>
								<div class="modal-footer justify-content-center">
									
									<button type="button" class="btn btn-dark" data-dismiss="modal">Fechar</button>
								</div>
							</div>
						</div>
					</div>
					<!-- ----- FIM MODAL DESBLOQUEIO --->	

					
					
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
document.forml.action="enviar_comando_estoque.php"
document.forml.method = 'POST';
document.forml.submit()
}	
	function envia_2(){
document.forml.action="edit_equipamento.php"
document.forml.method = 'POST';
document.forml.submit()
}

function bloqueio(){
	$('#bloquear').modal('hide');
	$('#carregar').modal('show');
	
}

function desbloqueio(){
	$('#desbloqueio').modal('hide');
	$('#carregar').modal('show');
	
}

</script>
<script>
	var deviceid = document.getElementById("deviceid").value;
	var intervalo1 = setInterval(function() { $('#equipamentos').load('retorno_device_temp.php?deviceid='+deviceid); }, 1500);
	  
</script>
<script>
	var chip = document.getElementById("chip").value;
	var intervalo = setInterval(function() { $('#status_comando').load('include/retorno_comando.php?chip='+chip); }, 1700);
 </script>
<script>
	var deviceid = document.getElementById('deviceid').value;
	var intervalo2 = setInterval(function() { $('#log').load('include/log_devices.php?deviceid='+deviceid); }, 1000);
	var intervalo3 = setInterval(function() { $('#evento').load('include/log_eventos.php?deviceid='+deviceid); }, 1000);
</script>
 <script type="text/javascript">
	$(function(){
	  $("select[name=comando]").change(function(){
	var comando = document.getElementById("comando").value;
	var imei = document.getElementById("imei").value;
	$(document).ready(function () {
				listar_comando(comando); //Chamar a função para listar os registros
			});
			
			function listar_comando(comando){
				var dados = {
					comando: comando, imei: imei
				}
				$.post('ajax/comando.ajax.php', dados , function(retorna){
					//Subtitui o valor no seletor id="conteudo"
					$("#retorno_comando").html(retorna);
				});
			}
	  })	
	})
	
	
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
