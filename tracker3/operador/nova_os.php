<?php include('conexao.php');
	
$base64 = $_GET['c'];
$base = base64_decode($base64);
$dados = explode("&", $base);

$id_cliente = $dados[0];
$cliente = explode(":", $id_cliente);
$id_cliente = $cliente[1];

$id_veiculo = $dados[1];
$veiculo = explode(":", $id_veiculo);
$id_veiculo = $veiculo[1];


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
$placa = 	$resp_veic['placa'];
$renavan = 	$resp_veic['renavan'];
$chassi = 	$resp_veic['chassi'];
$combustivel = 	$resp_veic['combustivel'];
$cor_veiculo = 	$resp_veic['cor_veiculo'];
$status = 	$resp_veic['status'];
$chip = 	$resp_veic['chip'];
$imei = 	$resp_veic['imei'];
$nr_contrato = 	$resp_veic['nr_contrato'];
}}

		
	$cons_stat = mysqli_query($con,"SELECT * FROM status WHERE id_status='$status'");
	if(mysqli_num_rows($cons_stat) > 0){
while ($resp_stat = mysqli_fetch_assoc($cons_stat)) {
$status1 = 	$resp_stat['status'];
}}


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
                    <?php include('include/head.php')?>
                    <!-- END Page Header -->
                    <!-- BEGIN Page Content -->
                    <!-- the #js-page-content id is needed for some plugins to initialize -->
                    <main id="js-page-content" role="main" class="page-content">
					
						<div class="row">
                            <div class="col-xl-8">
								<div class="subheader">
									<h1 class="subheader-title">
										<i class='subheader-icon fal fa-users'></i> <?php echo $nome_cliente?>
										<small>
											Ordem de Serviço
										</small>
									</h1>
								</div>
							</div>
							
						</div>
                        
                        <form name="forml" id="forml" action="add/add_os.php" method="post">
                        <div class="row">
                            <div class="col-xl-12">
                                <div id="panel-1" class="panel">
                                    
                                    <div class="panel-container show">
                                        <div class="panel-content">
											<h3>DADOS DA OS</h3>
											<hr style="border:#CCC 1px solid;">
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label>Veículo:</label>
														<input type="text" name="modelo_veiculo" id="modelo_veiculo" class="form-control" value="<?php echo $placa?> - <?php echo $marca_veiculo?> / <?php echo $modelo_veiculo?>" required>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Parceiro Instalação:</label>
														<select class="select2 form-control w-100" name="parceiro" id="parceiro">
														 <option value="">Selecione</option>
															<?php
																	
																	$cons_parceiro = mysqli_query($conn,"SELECT * FROM parceiros WHERE id_empresa='$id_cliente10' ORDER BY estado ASC");
																	if(mysqli_num_rows($cons_parceiro) <= 0){
																	echo '<option value="0">Nenhum Parceiro Encontrado</option>';
																	}else{
																	
																	while ($res = mysqli_fetch_assoc($cons_parceiro)) {
																	$id_parceiro = $res['id_parceiro'];
																	$nome_parceiro = $res['nome_parceiro'];
																	$estado = $res['estado'];
																	echo '<option value="'.$id_parceiro.'">'.$estado.' - '.$nome_parceiro.'</option>';
																	}
																	}
																	?>
															
														</select>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Tipo de OS:</label>
														<select class="select2 form-control w-100" name="tipo_os" id="tipo_os" required>
														 <option value="INSTALACAO">INSTALAÇÃO</option>
														<option value="MANUTENCAO">MANUTENÇÃO</option>
														<option value="RETIRADA">RETIRADA</option>
														</select>
													</div>
												</div>
											</div><br>
											<div class="row">
												<div class="col-md-4">
													<label>Prioridade Atendimento:</label>
													<select class="select2 form-control w-100" name="prioridade" id="prioridade" required>
														<option value="Normal">Normal</option>
														  <option value="Baixa">Baixa</option>
														  <option value="Alta">Alta</option>
														  <option value="Urgente">Urgente</option>
													</select>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>IMEI Equipamento:</label>
														<input class="form-control" name="imei" id="imei" autocomplete="off"  type="text" readonly>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Linha M2M:</label>
														<input class="form-control" name="chip" id="chip" autocomplete="off"  type="text" readonly>
													</div>
												</div>
											</div><br>
											
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<div class="form-group" id="data_1">
															<label class="font-normal">Data Agendamento:</label>
															<input type="datetime-local" class="form-control" name="data_agenda" id="data_agenda" autocomplete="off" type="text" required>
														</div>
													</div>
												</div>
												
											</div><br>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label>OBERVAÇÕES DA OS:</label>
														<textarea name="descricao" id="descricao" cols="60" rows="5" class="form-control" style="height:60px;"></textarea>
													</div>
												</div>
											</div><br><br>
											
											
											
											
											
											
											<div class="row">
											   <div class="col-md-3">
													<div class="form-group">
														<button type="submit" class="btn btn-info btn-sm">Cadastrar OS</button>
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<a href="clientes.php"><button type="button" class="btn btn-dark btn-sm">Voltar</button></a>
													</div>
												</div>	
													  
											</div>
											<input type="hidden" name="id_empresa" id="id_empresa" value="<?php echo $id_empresa?>">
											<input type="hidden" name="id_cliente" id="id_cliente" value="<?php echo $id_cliente?>">
											<input type="hidden" name="id_veiculo" id="id_veiculo" value="<?php echo $id_veiculo?>">
											<input type="hidden" name="id_cliente_pai" id="id_cliente_pai" value="<?php echo $id_cliente10?>">
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
									<span style="fonta-size:20px">Gerando Ordem de Serviço. Aguarde... </span> <img src="/tracker2/Imagens/load.gif" width="40px" height="40px">
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
