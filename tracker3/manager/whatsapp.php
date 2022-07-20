<?php include('conexao.php');
	
$id_empresa = 1361;

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
					
					
<?php
$data_atual = date('Y-m-01');
	
$whats_financeiro = mysqli_query($conn,"SELECT * FROM envios_whats WHERE enviado = 'SIM' AND tipo = 'FINANCEIRO' AND id_empresa='$id_empresa' AND data_envio >= '$data_atual'");
$total_whats_financeiro = mysqli_num_rows($whats_financeiro);

$whats_alerta = mysqli_query($conn,"SELECT * FROM envios_whats WHERE enviado = 'SIM' AND (tipo = 'ALERTA' OR tipo = 'ENVIO') AND id_empresa='$id_empresa' AND data_envio >= '$data_atual'");
$total_whats_alerta = mysqli_num_rows($whats_alerta);

$whats_cobranca = mysqli_query($conn,"SELECT * FROM envios_whats WHERE enviado = 'SIM' AND tipo = 'COBRANCA' AND id_empresa='$id_empresa' AND data_envio >= '$data_atual'");
$total_whats_cobranca = mysqli_num_rows($whats_cobranca);

$whats_manual = mysqli_query($conn,"SELECT * FROM envios_whats WHERE enviado = 'SIM' AND tipo = 'MANUAL' AND id_empresa='$id_empresa' AND data_envio >= '$data_atual'");
$total_whats_manual = mysqli_num_rows($whats_manual);


#=====================================

$whats_entregue = mysqli_query($conn,"SELECT * FROM envios_whats WHERE enviado = 'SIM' AND id_empresa='$id_empresa' AND data_envio >= '$data_atual'");
$total_whats_entregue = mysqli_num_rows($whats_entregue);

$whats_lido = mysqli_query($conn,"SELECT * FROM envios_whats WHERE visualizado='1' AND enviado = 'SIM' AND id_empresa='$id_empresa' AND data_envio >= '$data_atual'");
$total_whats_lido = mysqli_num_rows($whats_lido);



$whats_resposta = mysqli_query($conn,"SELECT * FROM envios_whats WHERE tipo='RESPOSTA' AND id_empresa='$id_empresa' AND data_envio >= '$data_atual'");
$total_whats_resposta = mysqli_num_rows($whats_resposta);

$whats_enviado = mysqli_query($conn,"SELECT * FROM envios_whats WHERE enviado = 'NAO' AND id_empresa='$id_empresa' AND data_envio >= '$data_atual'");
$total_whats_enviado = mysqli_num_rows($whats_enviado);

#=======================================


$dados_empresa = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa = '$id_empresa'");
if(mysqli_num_rows($dados_empresa) > 0){
while ($resp_dados = mysqli_fetch_assoc($dados_empresa)) {
$whats = 	$resp_dados['whats'];
}}

if($whats == 'SIM'){
	$botao_enviar = '<button type="button" class="btn btn-info btn-sm" ><i class="fal fa-comments"></i> Enviar Mensagem</button>';
	$botao_infor = '';
	$botao_parear = '<a href="qrcode.php"><button type="button" class="btn btn-info btn-sm" ><i class="fal fa-qrcode"></i> Parear / Status</button></a>';
}
if($whats == 'NAO'){
	$botao_infor = '<button type="button" class="btn btn-info btn-sm" ><i class="fal fa-comments"></i> Enviar Mensagem</button>';
	$botao_enviar = '';
	$botao_parear = '';
}


?>
					
                    <main id="js-page-content" role="main" class="page-content">
					
						<div class="row">
                            <div class="col-xl-8">
								<div class="subheader">
									<h1 class="subheader-title">
										<i class='subheader-icon fab fa-whatsapp'></i> Whatsapp
										<small>
											Relatórios deste mês.
										</small>
									</h1>
								</div>
							</div>
							<div class="col-xl-4 text-right">
								<a href="envio_whats.php"><button type="button" class="btn btn-success btn-sm" ><i class="fal fa-comments"></i> Enviar Mensagem</button></a>
								<a href="qrcode.php"><button type="button" class="btn btn-dark btn-sm" ><i class="fal fa-qrcode"></i> Parear / Status</button></a>
							</div>
						</div>
                        
						<div class="row">
							<div class="col-md-6">
								<div class="card" style="border:#CCC 1px solid;">
									<div class="card-header">
										<h4 class="card-title"><b>NOTIFICAÇÕES ENVIADAS POR TIPO</b></h4>
									</div>
									<div class="card-content">
										<div class="row">
											<div class="col-md-5">
												<div class="card-body">
													<div class="height-300">
														<div id="rel_tipo"></div>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="d-flex mt-2">
													<h5><span class="badge" style="background-color:#4682B4;color:#4682B4">0</span></h5> - Notificações de Alertas Veiculo
													<span class="d-inline-block ml-auto"><?php echo $total_whats_alerta?></span>
												</div>
												<br>
												<div class="d-flex">
													<h5><span class="badge" style="background-color:#9ACD32;color:#9ACD32">0</span></h5> -Notificações de Faturas
													<span class="d-inline-block ml-auto"><?php echo $total_whats_financeiro?></span>
												</div>
												<br>
												<div class="d-flex">
												  <h5><span class="badge" style="background-color:#5F9EA0;color:#5F9EA0">0</span></h5> - Notificações de cobrança
													<span class="d-inline-block ml-auto"><?php echo $total_whats_cobranca?></span>
												</div>
												<br>
												<div class="d-flex">
												<h5><span class="badge" style="background-color:#CD5C5C;color:#CD5C5C">0</span></h5> - Notificações Manuais
													<span class="d-inline-block ml-auto"><?php echo $total_whats_manual?></span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card" style="border:#CCC 1px solid;">
									<div class="card-header">
										<h4 class="card-title"><b>RELATÓRIO DE ENVIO / ENTREGA</b></h4>
									</div>
									<div class="card-content">
										<div class="row">
											<div class="col-md-6">
												<div class="card-body">
													<div class="height-300">
														<div id="envios"></div>
													</div>
												</div>
											</div>
											<div class="col-md-5">
												<div class="d-flex mt-2">
													<h5><span class="badge" style="background-color:#4682B4;color:#4682B4">0</span></h5> - Entregue
													<span class="d-inline-block ml-auto"><?php echo $total_whats_entregue?></span>
												</div>
												<br>
												
												<div class="d-flex">
												  <h5><span class="badge" style="background-color:#5F9EA0;color:#5F9EA0">0</span></h5> -   Respostas Recebidas
													<span class="d-inline-block ml-auto"><b><?php echo $total_whats_resposta?></b></span>
												</div>
												<br>
												<div class="d-flex">
												 <h5><span class="badge" style="background-color:#999999;color:#999999">0</span></h5> -  Aguardando Envio
													<span class="d-inline-block ml-auto"><b><?php echo $total_whats_enviado?></b></span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<br>
                        <form name="forml" id="forml" action="gerar_recorrencia_pjb1.php" method="post">
                        <div class="row">
                            <div class="col-xl-12">
                                <div id="panel-1" class="panel">
                                    
                                    <div class="panel-container show">
                                        <div class="panel-content">
											<h3>ÚLTIMAS 10 NOTIFICAÇÕES</h3>
											<hr style="border:#CCC 1px solid;">
											<?php
												$cons_cliente = mysqli_query($conn,"SELECT * FROM envios_whats ORDER BY id DESC LIMIT 10");
												if(mysqli_num_rows($cons_cliente) > 0){
													while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
													$telefone = $resp_cliente['telefone'];
													$mensagem = $resp_cliente['mensagem'];
													$mensagem = urldecode($mensagem);
													$enviado = $resp_cliente['enviado'];
													$id_cliente = $resp_cliente['id_cliente'];
													$visualizado = $resp_cliente['visualizado'];
													$data_envio = $resp_cliente['data_envio'];
													$data_envio = date('d/m/Y H:i:s', strtotime("$data_envio"));
													
													if($visualizado == 1){
														$visualizado1 = 'SIM';
													}
													if($visualizado == 0){
														$visualizado1 = 'NÃO';
													}
													
													$cons_cliente1= mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
													if(mysqli_num_rows($cons_cliente1) > 0){
														while ($resp_cliente1 = mysqli_fetch_assoc($cons_cliente1)) {
														$nome_cliente = $resp_cliente1['nome_cliente'];
													}}
													?>

												<div class="row">
													<div class="col-md-3">
														<label>Telefone: </label><br>
														<b><?php echo $telefone?></b><br><br>
														<label>Cliente: </label><br>
														<b><?php echo $nome_cliente?></b><br><br>
														<label>Data Envio: </label><br>
														<b><?php echo $data_envio?></b>
													</div>
													<div class="col-md-3">
														<label>Enviado: </label><br>
														<b><?php echo $enviado?></b><br><br>
														
													</div>
													<div class="col-md-6">
															<textarea class="textarea form-control" style="background: transparent; width:350px; height:150px; border: 0 none; color:#000; border:#CCC 1px solid;"><?php echo $mensagem?></textarea><br>
													</div>
												</div>
												<hr style="border:#CCC 1px solid;">

											<?php
												

												}}
											?>
											
											
											
											
											
											
											<input type="hidden" name="id_empresa" id="id_empresa" value="1361">
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
		<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
		<script src="https://code.highcharts.com/highcharts.js"></script>
		<script src="https://code.highcharts.com/modules/exporting.js"></script>
		<script src="https://code.highcharts.com/modules/export-data.js"></script>
		<script src="https://code.highcharts.com/modules/accessibility.js"></script>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
$('#forml').on('submit', function(e){
  $('#carregar').modal('show');
});
</script> 

<script>
		Highcharts.chart('rel_tipo', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie',
		width: 200,
		height: 200,
    },
    title: {
        text: ''
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            }
        }
    },
    series: [{
        name: 'Total',
        colorByPoint: true,
        data: [{
            name: 'Notificações de Alertas Veiculo',
            y: <?php echo $total_whats_alerta?>, 
			color: '#4682B4',
        }, {
            name: 'Notificações de Faturas',
            y: <?php echo $total_whats_financeiro?>, 
			color: '#9ACD32',
        }, {
            name: 'Notificações de cobrança',
            y: <?php echo $total_whats_cobranca?>, 
			color: '#5F9EA0',
        },{
            name: ' Notificações Manuais',
            y: <?php echo $total_whats_manual?>,
			color: '#CD5C5C',

        
        }]
    }]
});
	</script>	
<script>
		Highcharts.chart('envios', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie',
		width: 200,
		height: 200,
    },
    title: {
        text: ''
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            }
        }
    },
    series: [{
        name: 'Total',
        colorByPoint: true,
        data: [{
            name: 'Entregue',
            y: <?php echo $total_whats_entregue?>, 
			color: '#4682B4',
        }, {
            name: 'Respostas Recebidas',
            y: <?php echo $total_whats_resposta?>,
			color: '#5F9EA0',
        },{
            name: 'Aguardando Envio',
            y: <?php echo $total_whats_enviado?>,
			color: '#999999',

        
        }]
    }]
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
