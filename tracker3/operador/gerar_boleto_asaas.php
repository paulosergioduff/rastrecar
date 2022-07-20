<?php include('conexao.php');
	
$base64 = $_GET['c'];
$base = base64_decode($base64);
$cliente = explode(":", $base);
$id_cliente = $cliente[1];




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
					$cons_cliente = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
							if(mysqli_num_rows($cons_cliente) > 0){
						while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
						$nome_cliente = 	$resp_cliente['nome_cliente'];
						$doc_cliente = 	$resp_cliente['doc_cliente'];
						$rg_cliente	 = 	$resp_cliente['rg_cliente'];
						$data_nascimento = 	$resp_cliente['data_nascimento'];
						$data_nascimento = date('d/m/Y', strtotime("$data_nascimento"));
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
						$indicacao = 	$resp_cliente['indicacao'];
						$tipo_cliente = $resp_cliente['tipo_cliente'];
						$nr_contrato = $resp_cliente['nr_contrato'];
						$pacote_cliente = $resp_cliente['pacote'];
						$forma_pagamento = $resp_cliente['forma_pagamento'];
						$data_vencimento = $resp_cliente['data_vencimento'];
						$vendedor = $resp_cliente['vendedor'];
						$assinatura = $resp_cliente['assinatura'];
						$id_asaas = $resp_cliente['id_asaas'];
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
											Gerar Boleto - Asaas Bank
										</small>
									</h1>
								</div>
							</div>
							
						</div>
                        
                        <form name="forml" id="forml" action="add/add_boleto_asaas.php" method="post">
                        <div class="row">
                            <div class="col-xl-12">
                                <div id="panel-1" class="panel">
                                    
                                    <div class="panel-container show">
                                        <div class="panel-content">
											<h3><img src="/tracker3/Imagens/asaas.jpg" style="width:30px; heigth:auto;"> DADOS DO BOLETO - ASAAS</h3>
											<hr style="border:#CCC 1px solid;">
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label>Banco:</label>
														<input type="text" class="form-control" name="banco1" id="banco1" value="ASAAS BANK" readonly>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Cliente:</label>
														<input type="text" class="form-control" name="nome_cliente" id="nome_cliente" value="<?php echo $nome_cliente?>" readonly>
													</div>
												</div>
												<div class="col-md-4">		
													<div class="form-group" id="data_1">
														<label>Vencimento: </label>
														<input type="date" class="form-control" name="data_vencimento" id="data_vencimento" required>
													</div>
												</div>
											</div><br>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label>Valor: </label>
														<div id="retorno_pacote">
														<input type="text" class="form-control" name="valor" id="valor" onkeypress="return(MascaraMoeda(this,'.',',',event))" required>
														</div>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>% Multa:</label>
														<input type="text" class="form-control" name="multa" id="multa" value="2,00" onkeypress="return(MascaraMoeda(this,'.',',',event))" required>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>% Juros ao mês:</label>
														<input type="text" class="form-control" name="juros" id="juros" value="1,00" onkeypress="return(MascaraMoeda(this,'.',',',event))" required>
													</div>
												</div>
											</div><br>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label>Classificação Financeira: <i class="fas fa-plus-circle" data-toggle="modal" data-target="#novo_registro"></i></label>
														<select class="select2 form-control w-100" name="class_financeira" id="class_financeira" required>
															<option>Selecione</option>
															<?php
															$cons_pacote = mysqli_query($conn,"SELECT * FROM categorias_contas_receber ORDER BY categoria ASC");
															if(mysqli_num_rows($cons_pacote) <= 0){
															echo '<option value="0">Nenhum Pacote Encontrado</option>';
															}else{
															
															while ($res = mysqli_fetch_assoc($cons_pacote)) {
															$id_categoria = $res['id_categoria'];
															$categoria = $res['categoria'];
															echo '<option value="'.$id_categoria.'">'.$categoria.'</option>';
															}
															}
															?>
														</select>
													</div>
												</div>
												<div class="col-md-8">
													<div class="form-group">
														<label>Descrição: <i class="fas fa-info-circle" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Informação que será impressa nas instruções do boleto." data-original-title="Descrição"></i></label>
														<input type="text" class="form-control" name="descricao" id="descricao" placeholder="Ex: Mensalidade Rastreamento">
													</div>
												</div>
											</div>
											
											
											<br><br>
											<div class="row">
											   <div class="col-md-3">
													<div class="form-group">
														<button type="submit" id="botao" class="btn btn-info btn-sm">Gerar Boleto</button>
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<a href="cad_cliente.php?c=<?php echo $base64_cliente?>"><button type="button" class="btn btn-dark btn-sm">Voltar</button></a>
													</div>
												</div>	
													  
											</div>
											<input type="hidden" name="id_empresa" id="id_empresa" value="<?php echo $id_empresa?>">
											<input type="hidden" name="id_cliente" id="id_cliente" value="<?php echo $id_cliente?>">
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
					
					
					
					
					
					<?php
					$status = $_GET['status'];
					$fat = $_GET['fat'];
					if($status == 1){
					$base_cliente = 'id_cliente:'.$id_cliente;
					$base_cliente = base64_encode($base_cliente);
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
										<h3 class="mb-20">BOLETO GERADO COM SUCESSO!</h3>
										<div class="mb-30 text-center"><img src="/tracker2/Imagens/success.png"></div><br><br>
										Deseja imprimir o boleto?
									</div>
									<div class="modal-footer justify-content-center">
										<a href="https://www.asaas.com/b/pdf/<?php echo $fat?>" target="_blank"><button type="button" class="btn btn-primary">Imprimir</button></a>
										<a href="cad_cliente.php?c=<?php echo $base_cliente?>"><button type="button" class="btn btn-dark">fechar</button></a>
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
$('#forml').on('submit', function(e){
  $('#carregar').modal('show');
});
</script> 

<script>
	function add(){
		var nova_categoria = document.getElementById("nova_categoria").value;
		var id_empresa = document.getElementById("id_empresa").value;
		
		$.ajax({
				url: "add/add_class_financeira.php?categoria="+nova_categoria+"&id_empresa="+id_empresa,
				success: (data)=>{
					$("#class_financeira").append(new Option(nova_categoria, data));		
					$('#class_financeira').val(data).change();
						
				}
			});
		
		$('#novo_registro').modal('hide');
	}
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
