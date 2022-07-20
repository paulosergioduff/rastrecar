<?php include('conexao.php');


$cons_cli_cor = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
	if(mysqli_num_rows($cons_cli_cor) > 0){
while ($resp_cor = mysqli_fetch_assoc($cons_cli_cor)) {
$cor_sistema = 	$resp_cor['cor_sistema'];
$logo_cliente = 	$resp_cor['logo'];
	}}
	
if($logo_cliente == ''){
	$logo_cliente1 = '/tracker/Imagens/logo1.png';
	$logo_perfil = '/tracker3/app-assets/img/demo/avatars/profile_small.png';
}
if($logo_cliente != ''){
	$logo_cliente1 = 'logos/'.$logo_cliente;
	$logo_perfil = 'logos/'.$logo_cliente;
}

$cons_empresa = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='1361'");
	if(mysqli_num_rows($cons_empresa) > 0){
while ($resp_empresa = mysqli_fetch_assoc($cons_empresa)) {
$telefone = $resp_empresa['telefone'];
$razao_social = $resp_empresa['razao_social'];
$ativo = $resp_empresa['ativo'];
$valor_placa = $resp_empresa['valor_placa'];
$cnpj = $resp_empresa['cnpj'];
$cep = $resp_empresa['cep'];
$endereco = $resp_empresa['endereco'];
$numero = $resp_empresa['numero'];
$complemento = $resp_empresa['complemento'];
$bairro = $resp_empresa['bairro'];
$cidade = $resp_empresa['cidade'];
$estado = $resp_empresa['estado'];
$telefone = $resp_empresa['telefone'];
$email = $resp_empresa['email'];
$nome_url = $resp_empresa['nome_url'];
$logo = $resp_empresa['logo'];
$valor_placa = $resp_empresa['valor_placa'];
$valor_placa = number_format($valor_placa, 2, ",", ".");
$limite_veiculos = $resp_empresa['limite_veiculos'];
	}}
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
		<link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/formplugins/select2/select2.bundle.css">
        <!-- Place favicon.ico in the root directory -->
        <link rel="apple-touch-icon" sizes="180x180" href="/tracker3/app-assets/img/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/tracker3/app-assets/img/favicon/favicon-32x32.png">
        <link rel="mask-icon" href="/tracker3/app-assets/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
		<link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/fa-solid.css">
		<link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/fa-brands.css">
		
    </head>
    <body class="mod-bg-1 nav-function-fixed">
        <!-- DOC: script to save and load page settings -->
      
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
                    <?php include('include/head.php')?>

					
                    <!-- END Page Header -->
                    <!-- BEGIN Page Content -->
                    <!-- the #js-page-content id is needed for some plugins to initialize -->
					
                    <main id="js-page-content" role="main" class="page-content">
					<form name="forml" id="forml">
						
                        <div class="row">
                            <div class="col-md-3">
								<div class="card mb-g rounded-top">
                                    <div class="row no-gutters row-grid">
                                        <div class="col-12">
                                            <div class="d-flex flex-column align-items-center justify-content-center p-4">
                                              <img src="logos/<?php echo $logo?>" style="width:200px; height;auto;">
                                                <h5 class="mb-0 fw-700 text-center mt-3">
                                                    <?php echo $razao_social?><br>
                                                </h5>
												
												 
                                                
                                            </div>
											</div>
                                       
                                       
										 <div class="col-12">
                                            <div class="p-3 text-center">
                                               <button type="button" class="btn btn-dark btn-sm shadow-0" style="width:90%"><i class="fal fa-user"></i> Dados</button><br><br>
											   
											   <a href="cad_sistema_param.php?c=<?php echo $base64_empresa?>"><button type="button" class="btn btn-outline-dark btn-sm" onclick="carrega()" style="width:90%"><i class="fal fa-cog"></i> Parâmetros</button></a><br><br>
												
											   
                                            </div>
											
                                        </div>
										
                                    </div>
                                </div>
                            </div>
							
							<div class="col-md-9">
                                <div id="panel-1" class="panel">
                                    
                                    <div class="panel-container show">
                                        <div class="panel-content">
											<div class="row">
												<div class="col-md-6">
													<h3>DADOS DA EMPRESA</h3>
												</div>
												<div class="col-md-6 text-right">
													
												</div>
											</div>
											<hr style="border:#999999 1px solid">
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label>Razão Social:</label>
														<input type="text" name="razao_social" id="razao_social" class="form-control text-uppercase" value="<?php echo $razao_social?>">
														<input type="hidden" name="id_empresa1" id="id_empresa1" value="<?php echo $id_empresa1?>">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>CPF/CNPJ:</label>
														<input type="text" name="cnpj" id="cnpj" class="form-control" value="<?php echo $cnpj?>" onkeypress='mascaraMutuario(this,cpfCnpj)' onblur='clearTimeout()' maxlength="18" >
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Telefone:</label>
														<input type="text" name="telefone" id="telefone" class="form-control"  value="<?php echo $telefone?>" autocomplete="off" onKeyUp="mascara( this, mtel );" maxlength="15">
													</div>
												</div>
											</div><br>
											<div class="row">
												<div class="col-md-8">
													<div class="form-group">
														<label>E-mail:</label>
														<input type="text" name="email" id="email" class="form-control text-lowercase" autocomplete="off"  value="<?php echo $email?>">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>CEP:</label>
														<input type="text" name="cep" id="cep" class="form-control"  value="<?php echo $cep?>">
													</div>
												</div>
											</div><br>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label>Endereço:</label>
														<input type="text" name="endereco" id="endereco" class="form-control text-uppercase"  value="<?php echo $endereco?>">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Número:</label>
														<input type="text" name="numero" id="numero" class="form-control"   value="<?php echo $numero?>">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Complemento:</label>
														<input type="text" name="complemento" id="complemento" class="form-control text-uppercase"  value="<?php echo $complemento?>">
													</div>
												</div>
											</div><br>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label>Bairro:</label>
														<input type="text" name="bairro" id="bairro" class="form-control text-uppercase"  value="<?php echo $bairro?>">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Cidade:</label>
														<input type="text" name="cidade" id="cidade" class="form-control text-uppercase"   value="<?php echo $cidade?>">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Estado (UF):</label>
														<input type="text" name="estado" id="estado" class="form-control text-uppercase"  value="<?php echo $estado?>">
													</div>
												</div>
											</div>
											
											
											
											
											
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						
						
						<!-- MODAL ALTERAR STATUS -->
					
					<div class="modal fade" id="alterar_status" >
						<div class="modal-dialog modal-lg">
						  <div class="modal-content">
							<div class="modal-header bg-info text-white">
							  <h3 class="modal-title text-white">ALTERAR STATUS CLIENTE</h3>
							  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
							</div>
							<div class="modal-body">
							  <div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Status Cliente:</label>
										<select name="status" id="status" class="select2 form-control w-100" id="single-default">
										<option value="<?php echo $status?>"><?php echo $status3?></option>
										<?php
										
										$cons_status = mysqli_query($conn,"SELECT * FROM status WHERE id_status != '$status' ORDER BY id_status ASC");
										if(mysqli_num_rows($cons_status) <= 0){
										echo '<option value="0">N/A</option>';
										}else{
										
										while ($res_status = mysqli_fetch_assoc($cons_status)) {
										$id_status = $res_status['id_status'];
										$status_at = $res_status['status'];
										echo '<option value="'.$id_status.'">'.$status_at.'</option>';
										}
										}
										?>
										</select><input name="id_cliente" id="id_cliente" type="hidden" value="<?php echo $id_cliente?>">
									</div>
								</div>
							
								</div><br>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Motivo Alteração:</label>
												<textarea name="informacao" id="informacao" cols="60" rows="5" class="form-control" required>.</textarea>
												<input name="user" id="user" type="hidden" value="<?php echo $user_nome?>">
										</div>
									</div>
								</div>
								
							</div>
							<div class="modal-footer">
							  <button type="button" class="btn btn-dark btn-sm" style="font-size:13px" data-dismiss="modal">Cancelar</button>
							<button type="button" class="btn btn-info btn-sm" style="font-size:13px" onClick="envia_status();"  data-style="expand-left">Alterar</button>
							</div>
						  </div>
						  <!-- /.modal-content -->
						</div>
						<!-- /.modal-dialog -->
					</div>
					
					<!-- FIM MODAL ALTERAR STATUS -->
					
					
					<!-- FIM MODAL NOVO USUARIO -->
						
						</form>
                    </main>
					
					<!-- DIV Carregar -->
					<div class="modal fade" id="carregar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="static">
						<div class="modal-dialog modal-sm modal-dialog-centered">
							<div class="modal-content">
								
								<div class="modal-body" id="informacoes">
									<span style="font-size:18px">Aguarde... </span> <img src="/tracker3/Imagens/load.gif" width="40px" height="40px">
								</div>
								
							</div>
						</div>
					</div>	
                    <!-- FIM DIV Carregar -->
					
					<!-- MODAL EXCLUIR -->
					<div class="modal modal-alert fade" id="Excluir" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Excluir Cliente</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true"><i class="fal fa-times"></i></span>
									</button>
								</div>
								<div class="modal-body">
									<br>Esta ação é irreverssível.<br>
									Deseja prosseguir?
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
									<a href="del_cliente.php?id_cliente=<?php echo $id_cliente?>"><button type="button" class="btn1 btn1-danger">Excluir</button></a>
								</div>
							</div>
						</div>
					</div>
					
					<!-- FIM MODAL EXCLUIR -->
					
					
					

					
					
					
					
				
					<?php
					$os = $_GET['os'];
					if($os == 1){

					?>
						<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
					<script>
								$(document).ready(function(){
									$('#os_fim').modal('show');
								});
							</script>
						<?php } ?>
						<div class="modal fade" id="os_fim" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-body text-center font-18">
										
										<div class="mb-30 text-center"><img src="/tracker3/Imagens/success.png"></div><br><br>
										<h4 class="mb-20">ORDEM DE SERVIÇO FINALIZADA COM SUCESSO!</h4>
									</div>
									<div class="modal-footer justify-content-center">
										
										<button type="button" class="btn btn-dark" data-dismiss="modal">Fechar</button>
									</div>
								</div>
							</div>
						</div>
					
					
						<div class="modal fade" id="Excluir_no" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-sm modal-dialog-centered">
								<div class="modal-content bg-warning">
									<div class="modal-body text-center">
										<h3 class="mb-15"><font color="#000"><i class="fas fa-exclamation-triangle"></i> ATENÇÃO</font></h3>
										<p><font color="#000">AÇÃO NÃO PERMITIDA.</font></p>
										<p><font color="#000">CLIENTE POSSUI VEICULOS ATIVOS.</font></p>
										<button type="button" class="btn btn-dark btn-sm" data-dismiss="modal">Ok</button>
									</div>
								</div>
							</div>
						</div>
					
					
					<?php
					$del = $_GET['del'];
					$msg = $_GET['msg'];
					if($del == 'erro'){

					?>
						<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
					<script>
								$(document).ready(function(){
									$('#os_fim1').modal('show');
								});
							</script>
						<?php } ?>
						<div class="modal fade" id="os_fim1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-body text-center font-18">
										<h4 class="mb-20">ERRO</h4>
										<div class="mb-30 text-center"><img src="/tracker3/Imagens/cross.png"></div><br><br>
										<h4 class="mb-20"><?php echo $msg?></h4>
									</div>
									<div class="modal-footer justify-content-center">
										
										<button type="button" class="btn btn-dark" data-dismiss="modal">Fechar</button>
									</div>
								</div>
							</div>
						</div>
					
					<div class="modal fade" id="aviso_contas_pagar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content text-white" style="background-color:#CD5C5C">
								<div class="modal-body text-center">
									<h3 class="text-white mb-15"><i class="fa fa-exclamation-triangle"></i> ATENÇÃO</h3>
									<h5>CLIENTE POSSUI PENDENCIAS FINANCEIRAS</h5>
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
								</div>
							</div>
						</div>
					</div>
<?php
		$data_aviso = date('Y-m-d');
		$cons_contas = mysqli_query($conn,"SELECT * FROM contas_receber WHERE id_cliente='$id_cliente' AND status='Em Aberto' AND data_vencimento < '$data_aviso'");
	if(mysqli_num_rows($cons_contas) > 0){
			

 ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
				<script>
					$(document).ready(function(){
						$('#aviso_contas_pagar').modal('show');
					});
				</script>
			<?php } ?>
			
			
			
			<?php
		$error_asaas = $_GET['error_asaas'];
		if($error_asaas != ''){
		
		?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script>
					$(document).ready(function(){
						$('#asaas_ret2').modal('show');
					});
				</script>
			<?php } ?>
			<div class="modal fade" id="asaas_ret2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-body text-center font-18">
							<h3 class="mb-20">ERRO!</h3>
							<div class="mb-30 text-center"><img src="/tracker/Imagens/cross.png"></div><br><br>
							<?php echo $error_asaas?>
						</div>
						<div class="modal-footer justify-content-center">
							
							<button type="button" class="btn btn-dark" data-dismiss="modal">Fechar</button>
						</div>
					</div>
				</div>
			</div>
			
			
				<?php
		$cad_asaas = $_GET['cad_asaas'];
		if($cad_asaas == 'ok'){
		
		?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script>
					$(document).ready(function(){
						$('#asaas_ret3').modal('show');
					});
				</script>
			<?php } ?>
			<div class="modal fade" id="asaas_ret3" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-body text-center font-18">
							
							<div class="mb-30 text-center"><img src="/tracker/Imagens/success.png"></div><br><br>
							<h3 class="mb-20">CLIENTE CADASTRADO NO ASAAS BANK!</h3>
						</div>
						<div class="modal-footer justify-content-center">
							
							<button type="button" class="btn btn-dark" data-dismiss="modal">Fechar</button>
						</div>
					</div>
				</div>
			</div>
			
			<?php
		$cad_cliente = $_GET['cad_cliente'];
		if($cad_cliente == 'ok'){
		$base_cli = 'id_cliente:'.$id_cliente;
		$base_cli = base64_encode($base_cli);
		
		?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script>
					$(document).ready(function(){
						$('#cad_cliente').modal('show');
					});
				</script>
			<?php } ?>
			<div class="modal fade" id="cad_cliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-body text-center font-18">
							
							<div class="mb-30 text-center"><img src="/tracker/Imagens/success.png"></div><br><br>
							<h3 class="mb-20">CLIENTE CADASTRADO COM SUCESSO!</h3>
							<h4 class="mb-20">Deseja cadastrar o veículo?</h4>
						</div>
						<div class="modal-footer justify-content-center">
							
							<button type="button" class="btn btn-dark" data-dismiss="modal">NÃO</button>
							<a href="novo_veiculo.php?c=<?php echo $base_cli?>"><button type="button" class="btn btn-success">SIM</button></a>
						</div>
					</div>
				</div>
			</div>
			
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
function envia_status(){
	document.forml.action="edit_status_cliente.php"
	document.forml.method = 'POST';
	document.forml.submit()
}

</script>
<script>
function envia_user(){
	document.forml.action="add/add_usuario_cliente.php"
	document.forml.method = 'POST';
	document.forml.submit()
}
function edit_user(){
	document.forml.action="edit_user_cliente.php"
	document.forml.method = 'POST';
	document.forml.submit()
}

</script>
<script>
$('#forml').on('submit', function(e){
  $('#carregar').modal('show');
});
</script>  
<script>
function carrega(){
  $('#carregar').modal('show');
};
</script>  
<script type="text/javascript">
	$("#usuario").focusout(function(){
		var usuario = document.getElementById("usuario").value;
		var customer_name = document.getElementById("login_padrao1").value;
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
    </body>
</html>
