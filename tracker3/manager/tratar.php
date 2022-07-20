<?php include('conexao.php');
	
$time = $_GET['time'];
$base64 = $_GET['c'];
$base = base64_decode($base64);
$cliente = explode(":", $base);
$deviceid = $cliente[1];

$result_usuario = mysqli_query($conn, "SELECT * FROM veiculos_clientes WHERE deviceid='$deviceid'");
if(mysqli_num_rows($result_usuario) >0){
	while($row_usuario = mysqli_fetch_assoc($result_usuario)){
	$id_cliente = $row_usuario['id_cliente'];
	$id_veiculo = $row_usuario['id_veiculo'];
	$placa = $row_usuario['placa'];
	$modelo_veiculo = $row_usuario['modelo_veiculo'];
	$marca_veiculo = $row_usuario['marca_veiculo'];
	$modelo_equip = $row_usuario['modelo_equip'];
	$chip = $row_usuario['chip'];
	$imei = $row_usuario['imei'];
	$operadora = $row_usuario['operadora'];
	$fornecedor_chip = $row_usuario['fornecedor_chip'];
	$veiculo = $placa.' - '.$modelo_veiculo.'/'.$marca_veiculo;
}}

$cons_cliente = mysqli_query($conn, "SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
if(mysqli_num_rows($cons_cliente) >0){
	while($row_cliente = mysqli_fetch_assoc($cons_cliente)){
	$nome_cliente = $row_cliente['nome_cliente'];

}}

$tc_devices = mysqli_query($conn, "SELECT * FROM tc_devices WHERE id='$deviceid'");
if(mysqli_num_rows($tc_devices) >0){
	while($row_device = mysqli_fetch_assoc($tc_devices)){
	$positionid = $row_device['positionid'];
	$lastupdate = $row_device['lastupdate'];
	$lastupdate = date('Y-m-d H:i:s', strtotime('-3 hour', strtotime($lastupdate)));
	$lastupdate1 = date('d/m/Y H:i:s', strtotime("$lastupdate"));

}}

$cons_position = mysqli_query($conn, "SELECT * FROM tc_positions WHERE id='$positionid'");
if(mysqli_num_rows($cons_position) >0){
	while($row_position = mysqli_fetch_assoc($cons_position)){
	$address = $row_position['address'];

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
										<i class='subheader-icon fal fa-car'></i> Tratamento de Veículo Offline
										
									</h1>
								</div>
							</div>
							
						</div>
                        
                        <form name="forml" id="forml" action="add/add_tratativa.php" method="post">
                        <div class="row">
                            <div class="col-xl-12">
                                <div id="panel-1" class="panel">
									<div id="panel-1" class="panel">
                                    
                                    <div class="panel-container show">
                                        <div class="panel-content">
                                           
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab_default-1" role="tab"><i class="fal fa-plus-circle"></i> Novo Registro</a></li>
                                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab_default-3" role="tab"><i class="fal fa-clock"></i> Linha do Tempo</a></li>
                                            </ul>
                                            <div class="tab-content p-3">
                                                <div class="tab-pane fade show active" id="tab_default-1" role="tabpanel">
													<h3>DADOS DO VEÍCULO</h3>
													<hr style="border:#CCC 1px solid;">
													<div class="row">
														<div class="col-md-4">
															<label>Veículo:</label>
															<input type="text" class="form-control" value="<?php echo $veiculo?>" readonly>
															<input type="hidden" name="deviceid20" id="deviceid20" class="form-control" value="<?php echo $deviceid?>">
														</div>
														<div class="col-md-4">
															<label>Cliente:</label>
															<input type="text" class="form-control" value="<?php echo $nome_cliente?>" readonly>
															<input type="hidden" name="id_cliente" id="id_cliente" class="form-control" value="<?php echo $id_cliente?>">
															<input type="hidden" name="time" id="time" class="form-control" value="<?php echo $time?>">
															<input type="hidden" name="user_nome" id="user_nome" class="form-control" value="<?php echo $user_nome?>">
															<input type="hidden" name="id_veiculo" id="id_veiculo" class="form-control" value="<?php echo $id_veiculo?>">
														</div>
													</div><br>
													<div class="row">
														<div class="col-md-4">
															<label>Última Conexão:</label>
															<input type="text" class="form-control" value="<?php echo $lastupdate1?>" readonly>
														</div>
														<div class="col-md-8">
															<label>Última Localização:</label>
															<input type="text" class="form-control" value="<?php echo $address?>" readonly>
														</div>
													</div><br>
													<h3>INFORMAÇÕES TRATAMENTO</h3>
													<hr style="border:#CCC 1px solid;">
													<div class="row">
														<div class="col-md-6">
															<label>Tipo:</label>
															<select class="select2 form-control w-100l" name="tipo" id="tipo">
																 <option value="">Selecione</option>
																 <option value="EVENTO INTERNO">EVENTO INTERNO</option>
																 <option value="ORDEM DE SERVIÇO">ORDEM DE SERVIÇO</option>
																 <option value="AGUARDANDO RETORNO">AGUARDANDO RETORNO</option>
																 <option value="AGUARDANDO RETIRADA">AGUARDANDO RETIRADA</option>
																 <option value="TRATADO">TRATADO</option>
																 <option value="VEICULO SEM COMUNICACAO">VEICULO SEM COMUNICAÇÃO</option>
																	
																</select>
														</div>
														<div class="col-md-6">
															<label>Data:</label>
															<?php $data_hora = date('d/m/Y H:i');?>
															<input type="text" class="form-control" value="<?php echo $data_hora?>" name="data_trat" id="data_trat" readonly>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-12">
															<label>Título:</label>
															<input type="text" class="form-control" name="titulo" id="titulo" />
														</div>
													</div><br>
													<div class="row">
														<div class="col-md-12">
															<label>Descrição:</label>
															<textarea class="form-control" name="descricao" id="descricao" rows="3"></textarea>
														</div>
													</div>
													<br><br>
											
													<div class="row">
													   <div class="col-md-3">
															<div class="form-group">
																<button type="submit" id="botao" class="btn btn-info btn-sm">Inserir Registro</button>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<a href="veiculos_offline.php?time=<?php echo $time?>"><button type="button" class="btn btn-dark btn-sm">Voltar</button></a>
															</div>
														</div>	
															  
													</div>
                                                </div>
                                               
                                                <div class="tab-pane fade" id="tab_default-3" role="tabpanel">
													<h3>LINHA DO TEMPO</h3><br>
													<div class="row">
														<div class="col-md-12">
															<table id="dt-basic-example" class="table table-bordered table-hover table-striped" style="width:100%">
																<thead>
																	<tr>
																		<th>Data</th>
																		<th>Tipo</th>
																		<th>Usuário</th>
																		<th>Título</th>
																		<th>Descrição</th>
																		
																		
																	</tr>
																</thead>
																<tbody>
															<?php

															$result_usuario = mysqli_query($conn,"SELECT * FROM tratativas WHERE deviceid='$deviceid' ORDER BY data_trat DESC");
															if(mysqli_num_rows($result_usuario) > 0){
															while($row_usuario = mysqli_fetch_assoc($result_usuario)){
																$tipo = $row_usuario['tipo'];
																$data_trat = $row_usuario['data_trat'];
																$data_trat = date('d/m/Y H:i', strtotime("$data_trat"));
																$titulo = $row_usuario['titulo'];
																$descricao = $row_usuario['descricao'];
																$user_trat = $row_usuario['user_trat'];
														

																	?>
																	<tr>
																		<td><font style="font-size:12px;"><?php echo $data_trat; ?></font></td>
																		<td><font style="font-size:12px;"><?php echo $tipo; ?></font></td>
																		<td><font style="font-size:12px;"><?php echo $user_trat; ?></font></td>
																		<td><font style="font-size:12px;"><?php echo $titulo; ?></font></td>
																		<td><font style="font-size:12px;"><?php echo $descricao; ?></font></td>
																		
																		
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
		<script src="/tracker3/app-assets/js/datagrid/datatables/datatables.bundle.js"></script>
<script>
$('#forml').on('submit', function(e){
  $('#carregar').modal('show');
});
</script>  
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
