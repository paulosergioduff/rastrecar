<?php include('conexao.php');?>

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
					$cliente = $_REQUEST['cliente'];
					$cliente_pai = $_REQUEST['cliente_pai'];
					$bloqueados = $_REQUEST['bloqueados'];
					
					if($cliente_pai == '1361'){
						$nome_cliente_pai = 'RMB';
					}
					
					if($cliente_pai != '1361'){
						$cons_pai = mysqli_query($con,"SELECT * FROM clientes WHERE id_cliente='$cliente_pai'");
						if(mysqli_num_rows($cons_pai) > 0){
							while ($resp_pai = mysqli_fetch_assoc($cons_pai)) {
							$nome_cliente_pai = 	$resp_pai['nome_cliente'];
							}}
					} 
					
					if($cliente == '1'){
						$cliente2 = 'Selecionado Todos';
					}
					if($cliente != '1'){
						$cons_cli = mysqli_query($con,"SELECT * FROM clientes WHERE id_cliente='$cliente'");
							if(mysqli_num_rows($cons_cli) > 0){
								while ($resp_cli = mysqli_fetch_assoc($cons_cli)) {
								$cliente2 = 	$resp_cli['nome_cliente'];
								}}
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
										<i class='subheader-icon fal fa-car'></i> Relatório de Veículos
										<small>
											Relatório por Cliente.
										</small>
									</h1>
								</div>
							</div>
							
						</div>
                        
                        <form name="forml" id="forml" action="veiculos_relatorios_result.php" method="post">
                        <div class="row">
                            <div class="col-xl-12">
                                <div id="panel-1" class="panel">
                                    
                                    <div class="panel-container show">
                                        <div class="panel-content">
											
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label>Cliente Pai:</label>
														<select class="select2 form-control w-100" name="cliente_pai" id="cliente_pai"  required>
														  <option value="<?php echo $cliente_pai?>"><?php echo $nome_cliente_pai?></option>
															<?php
																
																$cons_parceiro = mysqli_query($conn,"SELECT * FROM clientes ORDER BY nome_cliente ASC");
																if(mysqli_num_rows($cons_parceiro) <= 0){
																echo '<option value="0">Nenhum Cliente Encontrado</option>';
																}else{
																
																while ($res = mysqli_fetch_assoc($cons_parceiro)) {
																$id_cliente = $res['id_cliente'];
																
																$nome_cliente = $res['nome_cliente'];
																echo '<option value="'.$id_cliente.'">'.$nome_cliente.'</option>';
																}
																}
																?>
														</select>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Sub Cliente:</label>
														<select class="select2 form-control w-100" name="cliente" id="cliente"  required>
														  <option value="<?php echo $cliente?>"><?php echo $cliente2?></option>
															
														</select>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label class="font-normal">.</label><br>
														<button type="submit" class="btn btn-primary btn-sm">Gerar Relatório</button>
													</div>
												</div>
											</div><br>
											

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
											<h3>
											<a href="excel/clientes_relatorio.php?cliente=<?php echo $cliente?>&cliente_pai=<?php echo $cliente_pai?>&bloqueados=<?php echo $bloqueados?>"><button type="button" class="btn btn-success btn-sm shadow-0"><i class="fas fa-file-excel"></i> Excel</button></a> 
											<a href="pdf_files/clientes_relatorio.php?cliente=<?php echo $cliente?>&cliente_pai=<?php echo $cliente_pai?>&bloqueados=<?php echo $bloqueados?>" target="_blank"><button type="button" class="btn btn-sm shadow-0" style="background-color:#CD5C5C; color:#FFF"><i class="fas fa-file-pdf"></i> PDF</button></a>
											</h3>
											<hr style="border:#CCC 1px solid;">
												<table id="dt-basic-example" class="table table-bordered table-hover table-striped nowrap" style="width:100%">
												<thead>
													<tr>
														<th>CPF/CNPJ</th>
														<th>Tipo</th>
														<th>Cliente</th>
														<th>Endereço</th>
														<th>Bairro</th>
														<th>Cidade</th>
														<th>UF</th>
														<th>Telefone</th>
														<th>Celular</th>
														<th>Veículos</th>
														<th>Status</th>
													</tr>
												</thead>
											<tbody>
											<?php
											
											if($cliente == '1'){
												if($bloqueados == 'SIM'){
													$tabela = "SELECT * FROM clientes WHERE status='1' AND id_cliente_pai='$cliente_pai' ORDER BY nome_cliente ASC";
												}
												if($bloqueados != 'SIM'){
													$tabela = "SELECT * FROM clientes AND id_cliente_pai='$cliente_pai' ORDER BY nome_cliente ASC";
												}
												
											}
											
											if($cliente != '1'){
												if($bloqueados == 'SIM'){
													$tabela = "SELECT * FROM clientes WHERE id_cliente='$cliente' OR id_cliente_pai='$cliente_pai' ORDER BY nome_cliente ASC";
												}
												if($bloqueados != 'SIM'){
													$tabela = "SELECT * FROM clientes WHERE (id_cliente='$cliente' OR id_cliente_pai='$cliente_pai') AND status='1'  ORDER BY nome_cliente ASC";
												}
											}

											$resultado_usuario = mysqli_query($conn, $tabela);
											if(mysqli_num_rows($resultado_usuario) > 0){
											while($resp_cliente = mysqli_fetch_assoc($resultado_usuario)){
											$nome_cliente = 	$resp_cliente['nome_cliente'];
											$doc_cliente = 	$resp_cliente['doc_cliente'];
											$documento = preg_replace("/[^0-9]/", "", $doc_cliente);
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
											$status = 	$resp_cliente['status'];
											$id_cliente = 	$resp_cliente['id_cliente'];
											
											if(strlen($documento) == 14){
												$tipo = 'P. Física';
											}
											if(strlen($documento) == 11){
												$tipo = 'P. Jurídica';
											}
											
											if($status == 1){
												$status1 = 'ATIVO';
											}
											if($status != 1){
												$status1 = 'INATIVO';
											}
											
											$cons_veiculos = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE id_cliente='$id_cliente' AND status='1'");
											$total_veiculos = mysqli_num_rows($cons_veiculos);
											
												
											

											?>
											<tr>
												<td><?php echo $doc_cliente; ?></td>
												<td><?php echo $tipo; ?></td>
												<td><?php echo $nome_cliente; ?></td>
												<td><?php echo $endereco; ?>, <?php echo $numero; ?></td>
												<td><?php echo $bairro; ?></td>
												<td><?php echo $cidade; ?></td>
												<td><?php echo $estado; ?></td>
												<td><?php echo $telefone_residencial; ?></td>
												<td><?php echo $telefone_celular; ?></td>
												<td><?php echo $total_veiculos; ?></td>
												<td><?php echo $status1; ?></td>
											</tr>
												
												
												
											<?php
											}}?>
											</tbody>
											</table>
											

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
									<span style="fonta-size:20px"> Aguarde... </span> <img src="/tracker2/Imagens/load.gif" width="40px" height="40px">
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
    <script type="text/javascript">
	$(function(){
	  $("select[name=cliente]").change(function(){
	    beforeSend:$("select[name=equipamentos]").html('<option value="0">Carregando...</option>')
	
		var equipamentos = $("select[name=cliente]").val();
		$.post("ajax/equipamentos.ajax.php",{equipamentos: equipamentos},function(pega_equip){
		complete:$("select[name=equipamentos]").html(pega_equip);
		
		})
	  })	
	})
</script>
    <script type="text/javascript">
	$(function(){
	  $("select[name=cliente_pai]").change(function(){
	    beforeSend:$("select[name=cliente]").html('<option value="0">Carregando...</option>')
	
		var cliente = $("select[name=cliente_pai]").val();
		$.post("ajax/clientes.ajax.php",{cliente: cliente},function(pega_veiculo){
		complete:$("select[name=cliente]").html(pega_veiculo);
		
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
