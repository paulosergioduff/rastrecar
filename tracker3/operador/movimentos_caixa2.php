<?php include('conexao.php');
	


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
                <div class="page-content-wrapper header-function-fixed">
                    <!-- BEGIN Page Header -->
                    <?php include('include/head.php');
					
					$data_hoje = date('Y-m-d');
					
					$id_empresa = '1362';

					$sql_caixa = mysqli_query($conn,"SELECT * FROM caixa WHERE status = 'ABERTO' AND id_empresa='$id_empresa' ORDER BY id_caixa DESC LIMIT 1");

					if(mysqli_num_rows($sql_caixa) > 0){
						while ($resp_caixa = mysqli_fetch_assoc($sql_caixa)) {
						$id_caixa = 	$resp_caixa['id_caixa'];
						$valor_inicial = 	$resp_caixa['valor_inicial'];
						$valor_inicial1 = number_format($valor_inicial, 2, ",", ".");
					}}

					$sql_entradas = mysqli_query($conn,"SELECT * FROM movimento_caixa WHERE data = '$data_hoje' AND tipo='ENTRADA' AND id_empresa='$id_empresa'");
					if(mysqli_num_rows($sql_entradas) > 0){
						while ($resp_entradas = mysqli_fetch_assoc($sql_entradas)) {
						$movimento_entrada += $resp_entradas['valor_mov'];
						$movimento_entrada1 = number_format($movimento_entrada, 2, ",", ".");
					}}

					$sql_saidas = mysqli_query($conn,"SELECT * FROM movimento_caixa WHERE data = '$data_hoje' AND tipo='SAIDA' AND id_empresa='$id_empresa'");
					if(mysqli_num_rows($sql_saidas) > 0){
						while ($resp_saidas = mysqli_fetch_assoc($sql_saidas)) {
						$movimento_saida += $resp_saidas['valor_mov'];
						$movimento_saida1 = number_format($movimento_saida, 2, ",", ".");
					}}

					$sql_entradas_din = mysqli_query($conn,"SELECT * FROM movimento_caixa WHERE data = '$data_hoje' AND tipo='ENTRADA' AND forma_pagamento='DINHEIRO' AND id_empresa='$id_empresa'");
					if(mysqli_num_rows($sql_entradas_din) > 0){
						while ($resp_entradas_din = mysqli_fetch_assoc($sql_entradas_din)) {
						$movimento_entrada_din += $resp_entradas_din['valor_mov'];
						$movimento_entrada_din1 = number_format($movimento_entrada_din, 2, ",", ".");
					}}

					$sql_entradas_card = mysqli_query($conn,"SELECT * FROM movimento_caixa WHERE data = '$data_hoje' AND tipo='ENTRADA' AND forma_pagamento != 'DINHEIRO' AND id_empresa='$id_empresa'");
					if(mysqli_num_rows($sql_entradas_card) > 0){
						while ($resp_entradas_card = mysqli_fetch_assoc($sql_entradas_card)) {
						$movimento_entrada_card += $resp_entradas_card['valor_mov'];
						$movimento_entrada_card1 = number_format($movimento_entrada_card, 2, ",", ".");
					}}

					$fechamento = $valor_inicial + $movimento_entrada - $movimento_saida;
					$fechamento = number_format($fechamento, 2, ",", ".");
					
						if($acesso == 'GERAL'){
							$botao_loja2 = '<a href="movimentos_caixa2.php"><button type="button" class="btn btn-dark btn-sm" style="font-size:14px"><i class="fal fa-home"></i> Loja Fortaleza</button></a>';	
						}
						if($id_empresa == '1361'){
							$botao_loja1 = 'LOJA HORIZONTE';
						}
						if($id_empresa == '1362'){
							$botao_loja1 = 'LOJA FORTALEZA';
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
										<i class='subheader-icon fal fa-file'></i> Movimentos Caixa <?php echo date('d/m/Y');?>
										<small>
											<?php echo $botao_loja1?>
										</small>
									</h1>
								</div>
							</div>
							<div class="col-xl-4 text-right">
							<?php echo $botao_loja2?> 
							<button type="button" class="btn btn-success btn-sm" style="font-size:14px" data-toggle="modal" data-target="#novo_registro">Novo Registro</button>
							</div>
						</div>
                        <div class="row">
							<div class="col-md-4">
								<div class="card mb-2">
									<div class="card-body">
										<div class="d-flex flex-row align-items-center">
											<div class='icon-stack display-3 flex-shrink-0'>
												<i class="fal fa-circle icon-stack-3x opacity-100 color-info-400"></i>
												<i class="fas fa-funnel-dollar icon-stack-1x opacity-100 color-info-500"></i>
											</div>
											<div class="ml-3">
												<strong>
													<span style="font-size:24px;">R$ <?php echo $valor_inicial1?></span>
												</strong>
												<br>
												<b>INICIO CAIXA</b>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="card mb-2">
									<div class="card-body">
										<div class="d-flex flex-row align-items-center">
											<div class='icon-stack display-3 flex-shrink-0'>
												<i class="fal fa-circle icon-stack-3x opacity-100" style="color:#990000"></i>
												<i class="fas fa-funnel-dollar icon-stack-1x opacity-100" style="color:#990000"></i>
											</div>
											<div class="ml-3">
												<strong>
													<span style="font-size:24px;">R$ <?php echo $movimento_entrada1?></span>
												</strong>
												<br>
												<b>ENTRADAS</b>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="card mb-2">
									<div class="card-body">
										<div class="d-flex flex-row align-items-center">
											<div class='icon-stack display-3 flex-shrink-0'>
												<i class="fal fa-circle icon-stack-3x opacity-100" style="color:#228B22"></i>
												<i class="fas fa-funnel-dollar icon-stack-1x opacity-100" style="color:#228B22"></i>
											</div>
											<div class="ml-3">
												<strong>
													<span style="font-size:24px;">R$ <?php echo $movimento_saida1?></span>
												</strong>
												<br>
												<b>SAÍDAS</b>
											</div>
										</div>
									</div>
								</div>
							</div>
							
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="card mb-2">
									<div class="card-body">
										<div class="d-flex flex-row align-items-center">
											<div class='icon-stack display-3 flex-shrink-0'>
												<i class="fal fa-circle icon-stack-3x opacity-100" style="color:#000"></i>
												<i class="fas fa-money-bill-alt icon-stack-1x opacity-100" style="color:#000"></i>
											</div>
											<div class="ml-3">
												<strong>
													<span style="font-size:24px;">R$ <?php echo $movimento_entrada_din1?></span>
												</strong>
												<br>
												<b>ENTRADAS EM DINHEIRO</b>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="card mb-2">
									<div class="card-body">
										<div class="d-flex flex-row align-items-center">
											<div class='icon-stack display-3 flex-shrink-0'>
												<i class="fal fa-circle icon-stack-3x opacity-100" style="color:#000"></i>
												<i class="fas fa-credit-card icon-stack-1x opacity-100" style="color:#000"></i>
											</div>
											<div class="ml-3">
												<strong>
													<span style="font-size:24px;">R$ <?php echo $movimento_entrada_card1?></span>
												</strong>
												<br>
												<b>ENTRADAS CARTÃO</b>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="card mb-2">
									<div class="card-body">
										<div class="d-flex flex-row align-items-center">
											<div class='icon-stack display-3 flex-shrink-0'>
												<i class="fal fa-circle icon-stack-3x opacity-100" style="color:#000"></i>
												<i class="fas fa-funnel-dollar icon-stack-1x opacity-100" style="color:#000"></i>
											</div>
											<div class="ml-3">
												<strong>
													<span style="font-size:24px;">R$ <?php echo $fechamento?></span>
												</strong>
												<br>
												<b>FECHAMENTO</b>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
                       
                        <div class="row">
                            <div class="col-xl-12">
                                <div id="panel-1" class="panel">
                                    
                                    <div class="panel-container show">
                                        <div class="panel-content">
											<h3>DETALHES</h3>
											<hr style="border:#CCC 1px solid;">
											<div class="row">
												<div class="col-12">
													 <?php


$date = date('Y-m-d');
$data = date('Y-m-d H:i:s');


//consultar no banco de dados
$result_usuario = "SELECT * FROM movimento_caixa WHERE data = '$date' AND id_empresa='$id_empresa' ORDER BY id_mov DESC";
$resultado_usuario = mysqli_query($conn, $result_usuario);


//Verificar se encontrou resultado na tabela "usuarios"
if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
?>
                        <table id="example" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>DATA/HORA</th>
                                    <th>TIPO</th>
                                    <th>DESCRIÇÃO</th>
                                    <th>CLASSIFICAÇÃO</th>
                                    <th>ESPÉCIE</th>
                                    <th>VALOR</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php
							while($row_usuario = mysqli_fetch_assoc($resultado_usuario)){
							$id_mov = $row_usuario['id_mov'];
							$tipo = $row_usuario['tipo'];
							$classificacao = $row_usuario['classificacao'];
							$forma_pagamento = $row_usuario['forma_pagamento'];
							$descricao = $row_usuario['descricao'];
							$doc_cliente = $row_usuario['doc_cliente'];
							$valor_mov = $row_usuario['valor_mov'];
							$valor_mov = number_format($valor_mov, 2, ",", ".");
							$data_mov = $row_usuario['data_mov'];
							$data_mov = date('d/m/Y H:i:s', strtotime("$data_mov"));
						
							if($tipo == 'ENTRADA'){
									$tipo1 = '<h5><span class="badge" style="background-color:#009900;color:#FFF">ENTRADA</span></h5>';
								$recibo = '<a href="/tracker/manager/imprimir_recibo_mov.php?id_mov'.$id_mov.'" target="_blank"><button type="button" class="btn btn-primary btn-icon"><i class="fas fa-print"></i></button></a>';
							}
							if($tipo == 'SAIDA'){
								$tipo1 = '<h5><span class="badge" style="background-color:#4169E1;color:#FFF">SAÍDA</span></h5>';
								$recibo = '';
							}
								
								
								
							?>
                                <tr>
                                    <th><?php echo $data_mov?></th>
                                    <th><?php echo $tipo1?></th>
                                    <td><?php echo $descricao; ?></td>
                                    <td><?php echo $classificacao; ?></td>
                                    <td><?php echo $forma_pagamento; ?></td>
                                    <td>R$ <?php echo $valor_mov; ?></td>
                                    
                                </tr>
								
								
								
                               <?php
							}?>
                            </tbody>
                        </table>
						<?php
	
						}else{
						echo "<div class='alert alert-dark text-center' role='alert'>Sem movimentações na data de hoje!</div>";
						}
						?>
												</div>
											</div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						<form action="add/add_movimento.php" method="post">
				
				
				
				<div class="modal inmodal" id="novo_registro"  role="dialog" >
						<div class="modal-dialog modal-lg">
							<div class="modal-content animated bounceInRight">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
									
								</div>
								<div class="modal-body">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group text-center">
											
												<h3><span class="badge" style="background-color:#000; color:#FFF">NOVO MOVIMENTO CAIXA</span></h3>
												<hr>
											</div>
										</div>
									</div><br>
									<div class="row">
									<div class="col-md-4">
										<label>Tipo Movimento:</label>
										<select class="select2 form-control w-100" name="tipo" id="tipo" required>
											<option value="">Selecione</option>
											<option value="ENTRADA">ENTRADA</option>
											<option value="SAIDA">SAIDA</option>
										</select>
									</div>
									
									<div class="col-md-8">
										<label>Origem / Destino:</label>
										<input type="text" name="descricao" id="descricao" class="form-control" required>
									</div>
									
									
								</div><br>
								<div class="row">
									<div class="col-md-8">
										<label>Clasificação Financeira:</label>
										<select class="select2 form-control w-100" name="classificacao" id="classificacao" style="z-index:999999"  required>
										  <option value="">Selecione a Classificação</option>
											
										</select>
									</div>
								</div><br>
								<div class="row">
									<div class="col-md-4">
										<label>Valor:</label>
										<input type="text" class="form-control" name="valor_mov" id="valor_mov" onkeypress="return(MascaraMoeda(this,'.',',',event))" required>
										<input type="hidden" class="form-control" name="data_mov" id="data_mov" value="<?php echo $data?>" >
										<input type="hidden" class="form-control" name="user_mov" id="user_mov" value="<?php echo $user_nome?>" >
										<input type="hidden" class="form-control" name="id_empresa" id="id_empresa" value="<?php echo $id_empresa?>" >
									</div>
									<div class="col-md-4">
										<label>Forma Pagamento:</label>
										<select class="select2 form-control w-100" name="forma_pagamento" id="forma_pagamento" required>
											<option value="DINHEIRO">DINHEIRO</option>
											<option value="CARTAO DEBITO">CARTAO DEBITO</option>
											<option value="CARTAO CREDITO A VISTA">CARTAO CREDITO A VISTA</option>
											<option value="CARTAO CREDITO PARCELADO">CARTAO CREDITO PARCELADO</option>
										</select>
									</div>
									<div class="col-md-4">
										<label>NSU / Nº Boleto:</label>
										<input type="text" class="form-control" name="nsu" id="nsu" >
									</div>
								</div>
									
									
									
									
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
									<button type="submit" data-toggle="modal" data-target="#carregar" class="btn btn-success m-t-n-xs">Registar</button>
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
	$(function(){
	  $("select[name=tipo]").change(function(){
	    beforeSend:$("select[name=classificacao]").html('<option value="0">Carregando...</option>')
	
		var classificacao = $("select[name=tipo]").val();
		$.post("ajax/classificacao.ajax.php",{classificacao: classificacao},function(pega_veiculo){
		complete:$("select[name=classificacao]").html(pega_veiculo);
		
		})
	  })	
	})
</script>
	    <script type="text/javascript">
	$(function(){
	  $("select[name=tipo]").change(function(){
	    $("#campo").html('');
	
		var campo = $("select[name=tipo]").val();
		$.post("ajax/campo.ajax.php",{campo: campo},function(pega_campo){
		$("#campo").html(pega_campo);

		})
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
