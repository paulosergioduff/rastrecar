<?php include('conexao.php');
	
$cons_empresa = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='1361'");
	if(mysqli_num_rows($cons_empresa) > 0){
while ($resp_empresa = mysqli_fetch_assoc($cons_empresa)) {
$nome_url = $resp_empresa['nome_url'];
$logo = $resp_empresa['logo'];
$texto_rodape = $resp_empresa['texto_rodape'];
$texto_topo = $resp_empresa['texto_topo'];
$cor_sistema = $resp_empresa['cor_sistema'];
	}}
$ativo2 = '<h5><span class="badge" style="background-color:#4682B4;color:#FFF">EM ABERTO</span></h5>';
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
					
						<div class="row">
                            <div class="col-xl-8">
								<div class="subheader">
									<h1 class="subheader-title">
										<i class='subheader-icon fal fa-dollar-sign'></i> Nova Conta a Pagar
										<small>
											Cadastro de Despesas
										</small>
									</h1>
								</div>
							</div>
							
						</div>
                        
                        <form name="forml" id="forml" action="add/add_conta_pagar.php" method="post">
                        <div class="row">
                            <div class="col-xl-12">
                                <div id="panel-1" class="panel">
                                    
                                    <div class="panel-container show">
                                        <div class="panel-content">
											<h3>DADOS DA CONTA</h3>
											<hr style="border:#CCC 1px solid;">
											
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label>Nº Documento:</label>
														<input class="form-control" name="duplicata" id="duplicata" value="<?php echo $duplicata?>" type="text" required>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group" id="data_1">
														<label>Data Emissão:</label>
														<input type="date" class="form-control" name="data_emissao" id="data_emissao" autocomplete="off" value="<?php echo $data?>" type="text" required>
													</div>
												</div>
												<div class="col-md-4">		
													<div class="form-group" id="data_1">
														<label>Data Vencimento:</label>
														<input type="date" class="form-control" name="data_vencimento" id="data_vencimento" autocomplete="off" required>
													</div>
												</div>
											</div><br>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label>Valor Bruto:</label>
														<input type="text" class="form-control" name="valor_bruto" id="valor_bruto" onkeypress="return(MascaraMoeda(this,'.',',',event))" required>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Credor / Fornecedor: <i class="fas fa-plus-circle" onclick="novo_reg();" data-toggle="popover" data-target="#novo_registro" data-trigger="hover" data-placement="top" data-content="Clique aqui para adicionar um novo fornecedor" data-original-title="Cadastrar"></i></label>
															<select class="select2 form-control w-100" name="descricao" id="descricao" required>
																<option value="">Selecione</option>
																<?php
																$cons_pacote = mysqli_query($conn,"SELECT * FROM fornecedores ORDER BY nome_fornecedor ASC");
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
																<option value="">Selecione</option>
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
														<select class="select2 form-control w-100" name="banco" id="banco" required>
															<option value="">Selecione</option>
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
																 <option value="">Selecione</option>
																	<?php
																	$cons_categorias_contas_pagar = mysqli_query($conn,"SELECT * FROM categorias_contas_pagar ORDER BY categoria ASC");
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
														  <input type="text" class="form-control" name="qtd_parcelas" id="qtd_parcelas" value="1" >
														  <input type="hidden" name="data_cadastro" id="data_cadastro" value="<?php echo $date?>" >
													</div>
												</div>
											</div><br>
											<div class="row">
												<div class="col-md-8">
													<div class="form-group">
															<label>Observações:</label>
															<textarea name="observacoes" id="observacoes" cols="60" rows="5" class="form-control" style="height:60px;" ></textarea>
													</div>
												</div>
												<div class="col-md-2">
													<label>Status Conta:</label><br>
													 <div class="custom-control custom-switch">
														<input type="checkbox" class="custom-control-input" id="status_c" onchange="status_conta();" name="status_c" value="SIM"  >
														<label class="custom-control-label" for="status_c" id="status1"><?php echo $ativo2?></label>
													</div>
												</div>
												<div class="col-md-2">
													<label>Recorrente:</label><br>
													 <div class="custom-control custom-switch">
														<input type="checkbox" class="custom-control-input" id="recorrencia" name="recorrencia" value="SIM"  >
														<label class="custom-control-label" for="recorrencia"></label>
													</div>
												</div>
											</div>
											<br><br>
											
											
											
											
											<div class="row">
											   <div class="col-md-3">
													<div class="form-group">
														<button type="submit" class="btn btn-info btn-sm">Cadastrar Conta</button>
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<a href="contas_pagar.php"><button type="button" class="btn btn-dark btn-sm">Voltar</button></a>
													</div>
												</div>	
													  
											</div>
											
											<input type="hidden" name="user_baixa" id="user_baixa" value="<?php echo $user_nome?>">
											<input type="hidden" name="id_empresa" id="id_empresa" value="<?php echo $id_empresa?>">
											
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						</form>
                    </main>
					
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


function status_conta(){
	//var bateria_removida = document.getElementById("bateria_removida").value;
	 if(status_c.checked == true){
		$("#status1").html('<h5><span class="badge" style="background-color:#009900;color:#FFF">PAGO</span></h5>');
	} else {
		$("#status1").html('<h5><span class="badge" style="background-color:#4682B4;color:#FFF">EM ABERTO</span></h5>');
	}
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
		
		var categoria = $("#categoria").val();
		
		$.ajax({
				url: "add/add_class_pagar_js.php?categoria="+categoria,
				success: (data1)=>{
					$("#class_financeira").append(new Option(categoria, data1));		
					$('#class_financeira').val(data1).change();
						
				}
			});
		
		$('#novo_classificacao').modal('hide');
	}
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
