<?php include('conexao.php');
	
$base64 = $_GET['c'];
$base = base64_decode($base64);
$cliente = explode(":", $base);
$id_conta = $cliente[1];


$hora = date('H:i:s');
$date = date('Y-m-d');

$cons_cliente = mysqli_query($conn,"SELECT * FROM contas_pagar WHERE id_conta='$id_conta'");
	if(mysqli_num_rows($cons_cliente) > 0){
while ($row_usuario = mysqli_fetch_assoc($cons_cliente)) {
$id_conta = $row_usuario['id_conta'];
$descricao = $row_usuario['descricao'];
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

$qtd_parcelas = $row_usuario['qtd_parcelas'];
$status_conta = $row_usuario['status'];
$data_pagamento = $row_usuario['data_pagamento'];
$user_baixa = $row_usuario['user_baixa'];

$valor_pago = $row_usuario['valor_pago'];
$valor_pago1 = number_format($valor_pago, 2, ",", ".");
$observacoes = $row_usuario['observacoes'];
$nr_parcela = $row_usuario['nr_parcela'];
$obs_baixa = $row_usuario['obs_baixa'];
	}}

$data_hj = date('Y-m-d');
											
if($status_conta == 'Em Aberto' && $data_vencimento < $data_hj){
	$status_conta1 = '<h3><span class="badge" style="background-color:#FF6347;color:#FFF">EM ATRASO</span></h3>';
	$botao_baixa = '<a href="baixar_conta_pagar.php?c='.$base_conta.'"><button type="button" class="btn btn-info btn-sm"><i class="fal fa-download"></i> Baixar</button></a>';
}
if($status_conta == 'Em Aberto' && $data_vencimento >= $data_hj){
	$status_conta1 = '<h3><span class="badge" style="background-color:#4682B4;color:#FFF">AGUAR. PGTO</span></h3>';
	$botao_baixa = '<a href="baixar_conta_pagar.php?c='.$base_conta.'"><button type="button" class="btn btn-info btn-sm"><i class="fal fa-download"></i> Baixar</button></a>';
}
if($status_conta == 'Pago'){
	$status_conta1 = '<h3><span class="badge" style="background-color:#009900;color:#FFF">PAGO</span></h3>';
	$botao_baixa = '';
}


$cons_especie = mysqli_query($conn,"SELECT * FROM tipo_pagamento WHERE id_tipo='$especie'");
	if(mysqli_num_rows($cons_especie) > 0){
while ($resp_especie = mysqli_fetch_assoc($cons_especie)) {
$especie1	 = 	$resp_especie['tipo_pagamento'];

}}

$cons_cat = mysqli_query($conn,"SELECT * FROM categorias_contas_pagar WHERE id_categoria='$class_financeira'");
	if(mysqli_num_rows($cons_cat) > 0){
while ($resp_cons_cat = mysqli_fetch_assoc($cons_cat)) {
$categoria	 = 	$resp_cons_cat['categoria'];

}}

$cons_bancos1 = mysqli_query($conn,"SELECT * FROM bancos WHERE id_banco='$banco'");
	if(mysqli_num_rows($cons_bancos1) > 0){
	while ($res_banco1 = mysqli_fetch_assoc($cons_bancos1)) {
		$nome_banco	 = 	$res_banco1['nome_banco'];
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
                    <?php include('include/head.php')?>
                    <!-- END Page Header -->
                    <!-- BEGIN Page Content -->
                    <!-- the #js-page-content id is needed for some plugins to initialize -->
                    <main id="js-page-content" role="main" class="page-content">
					
						<div class="row">
                            <div class="col-xl-8">
								<div class="subheader">
									<h1 class="subheader-title">
										<i class='subheader-icon fal fa-dollar-sign'></i> Detalhes Conta a Pagar
										<small>
											Credor: <?php echo $descricao?>
										</small>
									</h1>
								</div>
							</div>
							
						</div>
                        
                        <form name="forml" id="forml" action="edit_conta_pagar.php" method="post">
                        <div class="row">
                            <div class="col-xl-12">
                                <div id="panel-1" class="panel">
                                    
                                    <div class="panel-container show">
                                        <div class="panel-content">
											<div class="row">
												<div class="col-md-4">
													<h3>DADOS DA CONTA</h3>
												</div>
												
											</div>
											<hr style="border:#CCC 1px solid;">
											 <div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label>Nº Documento:</label>
														<input class="form-control" name="duplicata" id="duplicata" value="<?php echo $duplicata?>" type="text" required>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Data Emissão:</label>
														<input class="form-control" name="data_emissao" id="data_emissao" value="<?php echo $data_emissao?>" type="date" required>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
															<label>Data Vencimento:</label>
															<input type="date" class="form-control" name="data_vencimento" id="data_vencimento" value="<?php echo $data_vencimento?>" required>
													</div>
												</div>
											</div><br>
											<div class="row">
												<div class="col-md-4">
															<label>Valor Bruto:</label>
															<input type="text" class="form-control" name="valor_bruto" id="valor_bruto" value="<?php echo $valor_bruto1?>" onkeypress="return(MascaraMoeda(this,'.',',',event))" required>

												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Credor / Fornecedor: <i class="fas fa-plus-circle" onclick="novo_reg();" data-toggle="popover" data-target="#novo_registro" data-trigger="hover" data-placement="top" data-content="Clique aqui para adicionar um novo fornecedor" data-original-title="Cadastrar"></i></label>
														<select class="select2 form-control w-100" name="descricao" id="descricao" required>
															<option value="<?php echo $descricao?>"><?php echo $descricao?></option>
															<?php
															$cons_pacote = mysqli_query($conn,"SELECT * FROM fornecedores  ORDER BY nome_fornecedor ASC");
															if(mysqli_num_rows($cons_pacote) <= 0){
															echo '<option value="0">Nenhum Fornecedor Encontrado</option>';
															}else{
															
															while ($res = mysqli_fetch_assoc($cons_pacote)) {
															$id_fornecedor = $res['id_fornecedor'];
															$nome_fornecedor = $res['nome_fornecedor'];
															echo '<option value="'.$nome_fornecedor.'">'.$nome_fornecedor.'</option>';
															}
															}
															?>
														</select>
													</div>

												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Condição de Pagamento:</label><BR>
														<select class="select2 form-control w-100" name="especie" id="especie" required>
														 <option value="<?php echo $especie?>"><?php echo $especie1?></option>
															<?php
															$cons_pgt = mysqli_query($conn,"SELECT * FROM tipo_pagamento ORDER BY id_tipo ASC");
															if(mysqli_num_rows($cons_pgt) <= 0){
															echo '<option value="0">Nenhum Pacote Encontrado</option>';
															}else{
															
															while ($res = mysqli_fetch_assoc($cons_pgt)) {
															$id_tipo = $res['id_tipo'];
															$tipo_pagamento = $res['tipo_pagamento'];
															//$tipo_pagamento = utf8_encode($tipo_pagamento);
															echo '<option value="'.$id_tipo.'">'.$tipo_pagamento.'</option>';
															}
															}
															?>
														</select>
													</div>

												</div>          
											</div><br>
											<div class="row">
												<div class="col-md-4">
														<label>Banco:</label>
														<select class="select2 form-control w-100" name="banco" id="banco"  required>
															  <option value="<?php echo $banco?>"><?php echo $nome_banco?></option>
																<?php
																			
																	$cons_bancos = mysqli_query($conn,"SELECT * FROM bancos ORDER BY nome_banco ASC");
																	if(mysqli_num_rows($cons_bancos) <= 0){
																	echo '<option value="0">Nenhum Banco Encontrado</option>';
																	}else{
																	
																	while ($res_banco = mysqli_fetch_assoc($cons_bancos)) {
																	$id_banco = $res_banco['id_banco'];
																	$nome_banco = $res_banco['nome_banco'];
																	//$nome_banco = utf8_encode($nome_banco);
																	echo '<option value="'.$id_banco.'">'.$nome_banco.'</option>';
																	}
																	}
																	?>
															</select>

												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Classificação Financeira: <i class="fas fa-plus-circle" onclick="novo_classif();" data-toggle="popover" data-target="#novo_registro" data-trigger="hover" data-placement="top" data-content="Clique aqui para adicionar um novo fornecedor" data-original-title="Cadastrar"></i></label>
														<select class="select2 form-control w-100" name="class_financeira" id="class_financeira" required>
															 <option value="<?php echo $class_financeira?>"><?php echo $categoria?></option>
																<?php
																$cons_categorias_contas_pagar = mysqli_query($conn,"SELECT * FROM categorias_contas_receber ORDER BY categoria ASC");
																if(mysqli_num_rows($cons_categorias_contas_pagar) <= 0){
																echo '<option value="0">Nenhum Pacote Encontrado</option>';
																}else{
																
																while ($res_cat = mysqli_fetch_assoc($cons_categorias_contas_pagar)) {
																$id_categoria = $res_cat['id_categoria'];
																$categoria = $res_cat['categoria'];
																//$categoria = utf8_encode($categoria);
																echo '<option value="'.$id_categoria.'">'.$categoria.'</option>';
																}
																}
																?>
															
															</select>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Quantidade de Parcelas:</label>
														<input type="text" class="form-control" name="qtd_parcelas" id="qtd_parcelas" value="<?php echo $qtd_parcelas?>" >
													</div>
												</div>
											</div><br>
											<div class="row">
												<div class="col-md-8">
													<div class="form-group">
														<label>Observações:</label>
														<textarea name="observacoes" id="observacoes" cols="60" rows="5" class="form-control" style="height:60px;"><?php echo $observacoes?></textarea>
													</div>                                 
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Status:</label><br>
														<?php echo $status_conta1?>							
													</div>
												</div>
											</div>
											<input type="hidden" name="id_conta" id="id_conta" size="15" value="<?php echo $id_conta?>">
											<br><br>
											<div class="row">
											   <div class="col-md-3">
													<div class="form-group">
														<button type="submit" class="btn btn-info btn-sm">Alterar Conta</button>
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<a href="view_conta_pagar.php?c=<?php echo $base64?>"><button type="button" class="btn btn-dark btn-sm">Voltar</button></a>
													</div>
												</div>	
													  
											</div>
											
					<div class="modal fade" id="novo_registro" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-lg">
							<div class="modal-content">
								<div class="modal-header text-white bg-primary">
									<h4 class="modal-title" id="myLargeModalLabel" style="color:#FFF;"> NOVO FORNECEDOR/CREDOR</h4>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								</div>
								<div class="modal-body">
									<div class="row">
										<div class="col-md-4">
											<label>Nome Fornecedor</label><br>
											<input type="text" class="form-control" name="nome_fornecedor" id="nome_fornecedor">
										</div>
										<div class="col-md-4">
											<label>CPF/CNPJ</label><br>
											<input type="text" class="form-control" name="doc_fornecedor" id="doc_fornecedor">
										</div>
										<div class="col-md-4">
											<label>Telefone</label><br>
											<input type="text" class="form-control" name="telefone_comercial" id="telefone_comercial">
											<input type="hidden" class="form-control" name="customer_emp" id="customer_emp" value="<?php echo $id_empresa?>">
										</div>
									</div>
									
									
								</div>
								<div class="modal-footer">
									 <button type="button" style="font-size:14px" class="btn btn-primary btn-sm" data-dismiss="modal">Cancelar</button>
									<button type="button" style="font-size:14px" onclick="add();" class="btn btn-success btn-sm">Cadastrar</button>
								</div>
							</div>
						</div>
					</div>
					
					
					<div class="modal fade" id="novo_classificacao" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-lg">
							<div class="modal-content">
								<div class="modal-header text-white bg-primary">
									<h4 class="modal-title" id="myLargeModalLabel" style="color:#FFF;"> NOVA CLASSIFICAÇÃO FINANCEIRA</h4>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								</div>
								<div class="modal-body">
									<div class="row">
										<div class="col-md-4">
											<label>Nome Categoria</label><br>
											<input type="text" class="form-control" name="categoria" id="categoria">
										</div>
										
									</div>
									
									
								</div>
								<div class="modal-footer">
									 <button type="button" style="font-size:14px" class="btn btn-primary btn-sm" data-dismiss="modal">Cancelar</button>
									<button type="button" style="font-size:14px" onclick="add_cat();" class="btn btn-success btn-sm">Cadastrar</button>
								</div>
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

function novo_reg(){
	$('#novo_registro').modal('show');
}
function novo_classif(){
	$('#novo_classificacao').modal('show');
}

</script>  
<script>
	function add(){
		var nome_fornecedor = document.getElementById("nome_fornecedor").value;
		var doc_fornecedor = document.getElementById("doc_fornecedor").value;
		var telefone_comercial = document.getElementById("telefone_comercial").value;
		var customer_emp = document.getElementById("customer_emp").value;
		var n_forn = $("#nome_fornecedor").val().toUpperCase();
		
		
		$.ajax({
				url: "add/add_fornecedor_js.php?nome_fornecedor="+n_forn+"&doc_fornecedor="+doc_fornecedor+"&telefone_comercial="+telefone_comercial+"&customer_emp="+customer_emp,
				success: (data)=>{
					$("#descricao").append(new Option(n_forn, n_forn));		
					$('#descricao').val(n_forn).change();
						
				}
			});
		
		$('#novo_registro').modal('hide');
	}
	
	function add_cat(){
		
		var customer_emp = document.getElementById("customer_emp").value;
		var categoria = $("#categoria").val();
		
		$.ajax({
				url: "add/add_class_pagar_js.php?categoria="+categoria+"&id_empresa="+customer_emp,
				success: (data1)=>{
					$("#class_financeira").append(new Option(categoria, data1));		
					$('#class_financeira').val(data1).change();
						
				}
			});
		
		$('#novo_classificacao').modal('hide');
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
