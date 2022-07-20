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
						
					$data_inicial = date('d/m/Y H:i:s');
						$date = date('Y-m-d H:i:s');

						$data_hoje = date('Y-m-d');
						
						$id_caixa = $_GET['id_caixa'];

						$sql_caixa = mysqli_query($conn,"SELECT * FROM caixa WHERE id_caixa = '$id_caixa' ORDER BY id_caixa DESC LIMIT 1");

						if(mysqli_num_rows($sql_caixa) > 0){
							while ($resp_caixa = mysqli_fetch_assoc($sql_caixa)) {
							$id_caixa = 	$resp_caixa['id_caixa'];
							$valor_inicial = 	$resp_caixa['valor_inicial'];
							$valor_inicial1 = number_format($valor_inicial, 2, ",", ".");
						}}

						$sql_entradas = mysqli_query($conn,"SELECT * FROM movimento_caixa WHERE id_caixa = '$id_caixa' AND tipo='ENTRADA'");
						if(mysqli_num_rows($sql_entradas) > 0){
							while ($resp_entradas = mysqli_fetch_assoc($sql_entradas)) {
							$movimento_entrada += $resp_entradas['valor_mov'];
							$movimento_entrada1 = number_format($movimento_entrada, 2, ",", ".");
						}}

						$sql_saidas = mysqli_query($conn,"SELECT * FROM movimento_caixa WHERE id_caixa = '$id_caixa' AND tipo='SAIDA'");
						if(mysqli_num_rows($sql_saidas) > 0){
							while ($resp_saidas = mysqli_fetch_assoc($sql_saidas)) {
							$movimento_saida += $resp_saidas['valor_mov'];
							$movimento_saida1 = number_format($movimento_saida, 2, ",", ".");
						}}

						$fechamento = $valor_inicial + $movimento_entrada - $movimento_saida;
						$fechamento1 = number_format($fechamento, 2, ",", ".");
					?>
                    <!-- END Page Header -->
                    <!-- BEGIN Page Content -->
                    <!-- the #js-page-content id is needed for some plugins to initialize -->
                    <main id="js-page-content" role="main" class="page-content">
					
						<div class="row">
                            <div class="col-xl-8">
								<div class="subheader">
									<h1 class="subheader-title">
										<i class='subheader-icon fal fa-car'></i> CAIXA
										<small>
											Fechamento de Caixa
										</small>
									</h1>
								</div>
							</div>
							
						</div>
                        
                        <form name="forml" id="forml" action="fechamento_caixa.php" method="post">
                        <div class="row">
                            <div class="col-xl-12">
                                <div id="panel-1" class="panel">
                                    
                                    <div class="panel-container show">
                                        <div class="panel-content">
											<h3>DADOS DO FECHAMENTO</h3>
											<hr style="border:#CCC 1px solid;">
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label>Data:</label>
														<input type="text" class="form-control" name="data_ini" id="data_ini" value="<?php echo $data_inicial?>" readonly>
														<input type="hidden" class="form-control" name="data_final" id="data_final" value="<?php echo $date?>" >
														<input type="hidden" class="form-control" name="user_fim" id="user_fim" value="<?php echo $user_nome?>" >
														<input type="hidden" class="form-control" name="status" id="status" value="FECHADO" >
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Operador:</label>
														<input type="text" class="form-control" value="<?php echo $user_nome?>" readonly>
													</div>
												</div>	
											</div><br>
											<div class="row">
												<div class="col-md-3">
													<div class="form-group">
														<label>Valor Inicial em dinheiro:</label>
														<input type="text" class="form-control" name="valor_inicial" id="valor_inicial" value="R$ <?php echo $valor_inicial1?>" readonly>
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label>Valor Entradas:</label>
														<input type="text" class="form-control" name="entradas" id="entradas" value="R$ <?php echo $movimento_entrada1?>" readonly>
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label>Valor Saídas:</label>
														<input type="text" class="form-control" name="saidas" id="saidas" value="R$ <?php echo $movimento_saida1?>" readonly>
														</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label>Valor Final:</label>
														<input type="text" class="form-control" name="valor_final1" id="valor_final1" value="R$ <?php echo $fechamento1?>" readonly>
														<input type="hidden" class="form-control" name="valor_final" id="valor_final" value="<?php echo $fechamento1?>">
														<input type="hidden" class="form-control" name="id_caixa" id="id_caixa" value="<?php echo $id_caixa?>">
													</div>
												</div>
											</div>
											
											
											
											
											
											
											
											
											
											
											
											<br><br>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
													<label>.</label><br>
														<button type="submit" data-toggle="modal" data-target="#carregar" class="btn btn-primary m-t-n-xs">Fechar Caixa</button>
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
</script>  
 <script type="text/javascript">
	$(function(){
	  $("select[name=pacote]").change(function(){
	var pacote = document.getElementById("pacote").value;
	var id_empresa = document.getElementById("id_empresa").value;
	$(document).ready(function () {
				listar_comando(pacote); //Chamar a função para listar os registros
			});
			
			function listar_comando(pacote){
				var dados = {
					pacote: pacote, id_empresa: id_empresa
				}
				$.post('ajax/pacote.ajax.php', dados , function(retorna){
					//Subtitui o valor no seletor id="conteudo"
					$("#retorno_pacote").html(retorna);
				});
			}
	  })	
	})
	
	
</script>
<script type="text/javascript">
	$("#imei").focusout(function(){
		var imei = document.getElementById("imei").value;
		$.get( "ajax/imei.ajax.php?imei="+imei, function( data ) {
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
		$.get( "ajax/chip.ajax.php?chip="+chip, function( data1 ) {
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
