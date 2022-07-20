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

$base64 = $_GET['c'];
$base = base64_decode($base64);
$cliente = explode(":", $base);
$id_vendedor = $cliente[1];



$cons_vendedor = mysqli_query($con,"SELECT * FROM vendedores WHERE id_vendedor='$id_vendedor'");
	if(mysqli_num_rows($cons_vendedor) > 0){
		while ($resp_vendedor = mysqli_fetch_assoc($cons_vendedor)) {
		$nome_vendedor = 	$resp_vendedor['nome_vendedor'];
		$doc_vendedor = 	$resp_vendedor['doc_vendedor'];
		$telefone_celular = 	$resp_vendedor['telefone_celular'];
		$endereco = 	$resp_vendedor['endereco'];
		$numero = 	$resp_vendedor['numero'];
		$bairro = 	$resp_vendedor['bairro'];
		$cidade = 	$resp_vendedor['cidade'];
		$estado = 	$resp_vendedor['estado'];
		$cep = 	$resp_vendedor['cep'];
		$email = 	$resp_vendedor['email'];
		$status = 	$resp_vendedor['status'];
		$comissao_fixa = 	$resp_vendedor['comissao_fixa'];
		$comissao_fixa = number_format($comissao_fixa, 2, ",", ".");
		
		$tipo_fixa = 	$resp_vendedor['tipo_fixa'];
		$comissao_recorrente = 	$resp_vendedor['comissao_recorrente'];
		$comissao_recorrente = number_format($comissao_recorrente, 2, ",", ".");
		$tipo_recorrente = 	$resp_vendedor['tipo_recorrente'];
}}

if($status == '1'){
	$status1 = 'checked';
	$status3 = '<h5><span class="badge" style="background-color:#009900;color:#FFF">ATIVO</span></h5>';
}
if($status != '1'){
	$status1 = '';
	$status3 = '<h5><span class="badge badge-dark">INATIVO</span></h5>';
}


if($tipo_fixa == 'VALOR'){
	$tipo_fixa1 = '<option value="VALOR">VALOR - R$</option><option value="PERCENTUAL">PERCENTUAL - %</option>';
}
if($tipo_fixa == 'PERCENTUAL'){
	$tipo_fixa1 = '<option value="PERCENTUAL">PERCENTUAL - %</option><option value="VALOR">VALOR - R$</option>';
}

if($tipo_recorrente == 'VALOR'){
	$tipo_recorrente1 = '<option value="VALOR">VALOR - R$</option><option value="PERCENTUAL">PERCENTUAL - %</option>';
}
if($tipo_recorrente == 'PERCENTUAL'){
	$tipo_recorrente1 = '<option value="PERCENTUAL">PERCENTUAL - %</option><option value="VALOR">VALOR - R$</option>';
}

$cons_user_ven = mysqli_query($con,"SELECT * FROM usuarios WHERE id_vendedor='$id_vendedor'");
	if(mysqli_num_rows($cons_user_ven) <= 0){
		$usuario = '';
	}
	if(mysqli_num_rows($cons_user_ven) > 0){
		while ($resp_user_ven = mysqli_fetch_assoc($cons_user_ven)) {
		$usuario = 	$resp_user_ven['usuario'];
		$usuario1 = explode("@", $usuario);
		$usuario = $usuario1[0];
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
        <!-- Place favicon.ico in the root directory -->
        <link rel="apple-touch-icon" sizes="180x180" href="/tracker3/app-assets/img/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/tracker3/app-assets/img/favicon/favicon-32x32.png">
        <link rel="mask-icon" href="/tracker3/app-assets/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/datagrid/datatables/datatables.bundle.css">
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
                <aside class="page-sidebar" style="background-color:#FFF">
                    <div style="background-color:#FFF">
                        <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative">
                           <img src="logos/<?php echo $logo?>" style="width:200px; heigth:auto" alt="SmartAdmin WebApp" aria-roledescription="logo">
                            
                            
                        </a>
                    </div>
                    <?php include('include/sidebar.php')?>
                    
                </aside>
                <!-- END Left Aside -->
                <div class="page-content-wrapper header-function-fixed"">
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
										<i class='subheader-icon fal fa-users'></i> Alterar Vendedor
										<small>
											Alteração de Cadastro de Vendedores
										</small>
									</h1>
								</div>
							</div>
							
						</div>
                        
                        <form name="forml" id="forml" action="edit_vendedor.php" method="post">
                        <div class="row">
                            <div class="col-xl-12">
                                <div id="panel-1" class="panel">
                                    
                                    <div class="panel-container show">
                                        <div class="panel-content">
											<h3>DADOS PESSOAIS</h3>
											<hr style="border:#CCC 1px solid;">
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label>Nome Completo:</label>
														<input type="text" name="nome_vendedor" autocomplete="off" id="nome_vendedor" value="<?php echo $nome_vendedor?>" class="form-control text-uppercase" required>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>CPF/CNPJ:</label>
														<input type="text" name="doc_vendedor" autocomplete="off" id="doc_vendedor" class="form-control" value="<?php echo $doc_vendedor?>" onkeypress='mascaraMutuario(this,cpfCnpj)' onblur='clearTimeout()' maxlength="18" required>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>E-mail:</label>
														<input type="text" name="email" id="email" autocomplete="off" class="form-control text-lowercase" value="<?php echo $email?>" autocomplete="off" required>
													</div>
												</div>
											</div><br>
											
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label>CEP:</label>
														<input type="text" name="cep" id="cep" autocomplete="off" class="form-control" value="<?php echo $cep?>" maxlength="8" required>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Endereço:</label>
														<input type="text" name="endereco" id="endereco" class="form-control text-uppercase" value="<?php echo $endereco?>" required>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Número:</label>
														<input type="text" name="numero" id="numero" class="form-control" value="<?php echo $numero?>" required>
													</div>
												</div>
												
											</div><br>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label>Bairro:</label>
														<input type="text" name="bairro" id="bairro" value="<?php echo $bairro?>" class="form-control text-uppercase" required>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Cidade:</label>
														<input type="text" name="cidade" id="cidade" value="<?php echo $cidade?>" class="form-control text-uppercase"  required>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Estado (UF):</label>
														<input type="text" name="estado" id="estado" value="<?php echo $estado?>" class="form-control text-uppercase" required>
													</div>
												</div>
											</div><br>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label>Telefone Celular:</label>
														<input type="text" name="telefone_celular" id="telefone_celular" value="<?php echo $telefone_celular?>" autocomplete="off" onKeyUp="mascara( this, mtel );" maxlength="15" class="form-control"  required>
													</div>
												</div>
											</div><br><br>
											<h3>DADOS FINANCEIROS</h3>
											<hr style="border:#CCC 1px solid;"><br>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label>Tipo Comissão Fixa:</label>
														<select class="select2 form-control" name="tipo_fixa" id="tipo_fixa" >
															<?php echo $tipo_fixa1?>
														</select>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Valor/Percentual:</label>
														<input type="text" name="comissao_fixa" id="comissao_fixa" value="<?php echo $comissao_fixa?>" onkeypress="return(MascaraMoeda(this,'.',',',event))" value="0,00" autocomplete="off" class="form-control">
													</div>
												</div>
											</div><br>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label>Tipo Comissão Recorrente:</label>
														<select class="select2 form-control" name="tipo_recorrente" id="tipo_recorrente" >
															<?php echo $tipo_recorrente1?>
														</select>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Valor/Percentual:</label>
														<input type="text" name="comissao_recorrente" id="comissao_recorrente" value="<?php echo $comissao_recorrente?>" onkeypress="return(MascaraMoeda(this,'.',',',event))" value="0,00" autocomplete="off" class="form-control">
													</div>
												</div>
											</div><br><br>
											<h3>LOGIN DE ACESSO</h3>
											<hr style="border:#CCC 1px solid;"><br>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label>Usuário:</label>
														<input type="text" name="usuario" id="usuario" value="<?php echo $usuario?>" autocomplete="off" class="form-control">
														<div id="retorno_user"></div>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Senha:</label>
														<input type="text" name="senha" id="senha" autocomplete="off" class="form-control">
													</div>
												</div>
												<div class="col-md-4">
													<label>Status Vendedor:</label><br>
													 <div class="custom-control custom-switch">
														<input type="checkbox" class="custom-control-input" id="status_vendedor" onchange="status_vend();" name="status_vendedor" value="SIM" <?php echo $status1?> >
														<label class="custom-control-label" for="status_vendedor" id="status_vendedor1"><?php echo $status3?></label>
													</div>
												</div>
											</div><br><br>
											
											
											<div class="row">
											   <div class="col-md-3">
													<div class="form-group">
														<button type="submit" id="botao" class="btn btn-info btn-sm">Cadastrar Vendedor</button>
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<a href="vendedores.php"><button type="button" class="btn btn-dark btn-sm">Voltar</button></a>
													</div>
												</div>	
													  
											</div>
											<input type="hidden" name="customer_sales" id="customer_sales" value="<?php echo $id_vendedor?>">
											<input type="hidden" name="customer_name" id="customer_name" value="<?php echo $login_padrao?>">
											
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
        <script src="/tracker3/app-assets/js/datagrid/datatables/datatables.bundle.js"></script>
<script>
function status_vend(){
	//var bateria_removida = document.getElementById("bateria_removida").value;
	 if(status_vendedor.checked == true){
		$("#status_vendedor1").html('<h5><span class="badge" style="background-color:#009900;color:#FFF">ATIVO</span></h5>');
	} else {
		$("#status_vendedor1").html('<h5><span class="badge" style="background-color:#FF6347;color:#FFF">INATIVO</span></h5>');
	}
}
</script>
<script type="text/javascript">
	$("#usuario").focusout(function(){
		var usuario = document.getElementById("usuario").value;
		var customer_name = document.getElementById("customer_name").value;
		$.get( "ajax/usuario.ajax.php?usuario="+usuario+"&customer_name="+customer_name, function( data ) {
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
$('#forml').on('submit', function(e){
  $('#carregar').modal('show');
});
</script>   
 <script type="text/javascript">
	$("#cep").focusout(function(){
		function limpa_formulário_cep() {
			// Limpa valores do formulário de cep.
			$("#rua").val("");
			$("#bairro").val("");
			$("#cidade").val("");
			$("#estado").val("");
			$("#ibge").val("");
		}
		
		//Quando o campo cep perde o foco.
		$("#cep").blur(function() {

			//Nova variável "cep" somente com dígitos.
			var cep = $(this).val().replace(/\D/g, '');

			//Verifica se campo cep possui valor informado.
			if (cep != "") {

				//Expressão regular para validar o CEP.
				var validacep = /^[0-9]{8}$/;

				//Valida o formato do CEP.
				if(validacep.test(cep)) {

					//Preenche os campos com "..." enquanto consulta webservice.
					$("#endereco").val("");
					$("#bairro").val("");
					$("#cidade").val("");
					$("#estado").val("");
					$("#endereco").focus();

					//Consulta o webservice viacep.com.br/
					$.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

						if (!("erro" in dados)) {
							//Atualiza os campos com os valores da consulta.
							$("#endereco").val(dados.logradouro);
							$("#bairro").val(dados.bairro);
							$("#cidade").val(dados.localidade);
							$("#estado").val(dados.uf);
							$("#numero").focus();
						} //end if.
						
					});
				} //end if.
				else {
					//cep é inválido.
					limpa_formulário_cep();
					alert("Formato de CEP inválido.");
				}
			} //end if.
			
		});
	});
</script>
<script type="text/javascript">
/* Máscaras ER */
function mascara(o,f){
    v_obj=o
    v_fun=f
    setTimeout("execmascara()",1)
}
function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}
function mtel(v){
    v=v.replace(/\D/g,"");             //Remove tudo o que não é dígito
    v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
    v=v.replace(/(\d)(\d{4})$/,"$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos
    return v;
}


function mascaraMutuario(o,f){
    v_obj=o
    v_fun=f
    setTimeout('execmascara()',1)
}

function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}

function cpfCnpj(v){

    //Remove tudo o que não é dígito
    v=v.replace(/\D/g,"")

    if (v.length == 11) { //CPF

        //Coloca um ponto entre o terceiro e o quarto dígitos
        v=v.replace(/(\d{3})(\d)/,"$1.$2")

        //Coloca um ponto entre o terceiro e o quarto dígitos
        //de novo (para o segundo bloco de números)
        v=v.replace(/(\d{3})(\d)/,"$1.$2")

        //Coloca um hífen entre o terceiro e o quarto dígitos
        v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2")

    } else { //CNPJ

        //Coloca ponto entre o segundo e o terceiro dígitos
        v=v.replace(/^(\d{2})(\d)/,"$1.$2")

        //Coloca ponto entre o quinto e o sexto dígitos
        v=v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3")

        //Coloca uma barra entre o oitavo e o nono dígitos
        v=v.replace(/\.(\d{3})(\d)/,".$1/$2")

        //Coloca um hífen depois do bloco de quatro dígitos
        v=v.replace(/(\d{4})(\d)/,"$1-$2")

    }

return v

}

</script> 
<script>
function mascaraData(val) {
  var pass = val.value;
  var expr = /[0123456789]/;

  for (i = 0; i < pass.length; i++) {
    // charAt -> retorna o caractere posicionado no índice especificado
    var lchar = val.value.charAt(i);
    var nchar = val.value.charAt(i + 1);

    if (i == 0) {
      // search -> retorna um valor inteiro, indicando a posição do inicio da primeira
      // ocorrência de expReg dentro de instStr. Se nenhuma ocorrencia for encontrada o método retornara -1
      // instStr.search(expReg);
      if ((lchar.search(expr) != 0) || (lchar > 3)) {
        val.value = "";
      }

    } else if (i == 1) {

      if (lchar.search(expr) != 0) {
        // substring(indice1,indice2)
        // indice1, indice2 -> será usado para delimitar a string
        var tst1 = val.value.substring(0, (i));
        val.value = tst1;
        continue;
      }

      if ((nchar != '/') && (nchar != '')) {
        var tst1 = val.value.substring(0, (i) + 1);

        if (nchar.search(expr) != 0)
          var tst2 = val.value.substring(i + 2, pass.length);
        else
          var tst2 = val.value.substring(i + 1, pass.length);

        val.value = tst1 + '/' + tst2;
      }

    } else if (i == 4) {

      if (lchar.search(expr) != 0) {
        var tst1 = val.value.substring(0, (i));
        val.value = tst1;
        continue;
      }

      if ((nchar != '/') && (nchar != '')) {
        var tst1 = val.value.substring(0, (i) + 1);

        if (nchar.search(expr) != 0)
          var tst2 = val.value.substring(i + 2, pass.length);
        else
          var tst2 = val.value.substring(i + 1, pass.length);

        val.value = tst1 + '/' + tst2;
      }
    }

    if (i >= 6) {
      if (lchar.search(expr) != 0) {
        var tst1 = val.value.substring(0, (i));
        val.value = tst1;
      }
    }
  }

  if (pass.length > 10)
    val.value = val.value.substring(0, 10);
  return true;
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
    </body>
</html>
