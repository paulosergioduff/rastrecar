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


$cons_usuario20 = mysqli_query($conn,"SELECT * FROM usuarios WHERE id_usuarios='$user_id'");
	if(mysqli_num_rows($cons_usuario20) > 0){
while ($resp_usuario11 = mysqli_fetch_assoc($cons_usuario20)) {
$id_cliente10 = 	$resp_usuario11['id_cliente'];
	}}
	
$cons_cli_cor = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente10'");
	if(mysqli_num_rows($cons_cli_cor) > 0){
while ($resp_cor = mysqli_fetch_assoc($cons_cli_cor)) {
$cor_sistema = 	$resp_cor['cor_sistema'];
$logo = 	$resp_cor['logo'];
$login_padrao = 	$resp_cor['subdominio'];

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
        <link rel="icon" type="image/png" sizes="32x32" href="/tracker3/manager/logos/<?php echo $logo?>">
        <link rel="mask-icon" href="/tracker3/app-assets/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
		<link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/fa-brands.css">
		<link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/datagrid/datatables/datatables.bundle.css">
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
                           <img src="/tracker3/manager/logos/<?php echo $logo?>" style="width:200px; heigth:auto" alt="SmartAdmin WebApp" aria-roledescription="logo">
                            
                            
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
											</div>
											
										

											<br><br>
											<?php
											if($pag == 'veic'){
												$link_voltar = 'veiculos.php';
											}
											if($pag != 'veic'){
												$link_voltar = 'cad_cliente_veiculos.php?c='.$base64_cliente.'';
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
  
</body>
</html>
