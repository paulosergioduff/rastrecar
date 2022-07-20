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
		<link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/formplugins/select2/select2.bundle.css">
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
                    <?php include('include/head.php')?>
                    <!-- END Page Header -->
                    <!-- BEGIN Page Content -->
                    <!-- the #js-page-content id is needed for some plugins to initialize -->
					 
                    <main id="js-page-content" role="main" class="page-content">
					
						<div class="row">
                            <div class="col-xl-8">
								<div class="subheader">
									<h1 class="subheader-title">
										<i class='subheader-icon fal fa-boxes'></i> Novo Equipamento
										<small>
											Estoque de Dispositivos
										</small>
									</h1>
								</div>
							</div>
							
						</div>
                        
                        <form action="add/add_equipamento.php" method="post">
                        <div class="row">
                            <div class="col-xl-12">
                                <div id="panel-1" class="panel">
                                    
                                    <div class="panel-container show">
                                        <div class="panel-content">
											 <div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label>Modelo:</label>
														<select class="select2 form-control w-100" name="modelo_equip" id="modelo_equip">
															<option value="">Selecione</option>
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
														<input type="text" name="imei" id="imei" class="form-control" required>
														<div id="retorno_imei"></div>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Nº Linha: <small><i>Somente números</i></small></label>
														<input type="number" class="form-control" name="chip" id="chip" required>
														<div id="retorno_chip"></div>
													</div>
												</div>
											</div><br>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label>ICCID:</label>
														<input type="number" class="form-control" name="iccid" id="iccid" required>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Operadora:</label>
														<select class="select2 form-control w-100" name="operadora" id="operadora" required>
															<option value="">Selecione</option>
															<?php
															$cons_equip = mysqli_query($conn,"SELECT * FROM operadoras ORDER BY operadora ASC");
															if(mysqli_num_rows($cons_equip) <= 0){
															echo '<option value="0">Nenhum Equipamento Encontrado</option>';
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
												<div class="col-md-4">
													<div class="form-group">
														<label>Fornecedor M2M:</label>
														<select class="select2 form-control w-100" name="fornecedor" id="fornecedor" required>
															<option value="">Selecione</option>
															<?php
															$cons_forn = mysqli_query($conn,"SELECT * FROM fornecedor_chip ORDER BY fornecedor ASC");
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
												<div class="col-md-4">
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
											</div>
											<br><br>
											<div class="row">
											   <div class="col-md-3">
													<div class="form-group">
														<button type="submit" id="botao" class="btn btn-success btn-sm" style="font-size:14px">Cadastrar</button>
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<a href="equipamentos.php?p=equipamentos"><button type="button" class="btn btn-dark btn-sm" style="font-size:14px">Voltar</button></a>
													</div>
												</div>	
													  
											</div>
											
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						</form>
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
        <script src="/tracker3/app-assets/js/formplugins/select2/select2.bundle.js"></script>
<script>
$('#forml').on('submit', function(e){
  $('#carregar').modal('show');
});
</script>  
<script type="text/javascript">
	$("#imei").focusout(function(){
		var imei = document.getElementById("imei").value;
		$.get( "ajax/imei_estoque.ajax.php?imei="+imei, function( data ) {
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
		$.get( "ajax/chip_estoque.ajax.php?chip="+chip, function( data1 ) {
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
