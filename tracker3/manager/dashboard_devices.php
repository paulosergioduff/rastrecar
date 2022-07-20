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
		<link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/fa-solid.css">
		<link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/statistics/chartjs/chartjs.css">
		<script src="https://kit.fontawesome.com/a132241e15.js"></script>
    </head>
    <body class="mod-bg-1 nav-function-fixed header-function-fixed">
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
                <div class="page-content-wrapper header-function-fixed">
                    <!-- BEGIN Page Header -->
                    <?php include('include/head.php');
					
					
					$data_agora = date('Y-m-d H:i:s');
					$data_agora = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_agora)));
					
					$data_inicial_3 = date('Y-m-d H:i:s', strtotime('-12 hour', strtotime($data_agora)));
					$data_final_3 = date('Y-m-d H:i:s', strtotime('-24 hour', strtotime($data_agora)));	
					$cont_veiculos2 = mysqli_query($conn,"SELECT * FROM tc_devices WHERE lastupdate < '$data_inicial_3' AND lastupdate >= '$data_final_3' AND contact != 'ESTOQUE' ");
					$off_12_24 = mysqli_num_rows($cont_veiculos2);
					
					$data_inicial_4 = date('Y-m-d H:i:s', strtotime('-5 minutes', strtotime($data_agora)));
					$data_final_4 = date('Y-m-d H:i:s', strtotime('-12 hour', strtotime($data_agora)));
					$cont_veiculos3 = mysqli_query($conn,"SELECT * FROM tc_devices WHERE lastupdate < '$data_inicial_4' AND lastupdate >= '$data_final_4' AND contact != 'ESTOQUE'");
					$off_12 = mysqli_num_rows($cont_veiculos3);
					
					
					$data_inicial_1 = date('Y-m-d H:i:s', strtotime('-24 hour', strtotime($data_agora)));
					$cont_veiculos = mysqli_query($conn,"SELECT * FROM tc_devices WHERE lastupdate < '$data_inicial_1' AND contact != 'ESTOQUE'");
					$off_24 = mysqli_num_rows($cont_veiculos);
					
					$data_inicial_12 = date('Y-m-d H:i:s', strtotime('-5 minutes', strtotime($data_agora)));
					$cont_veiculos20 = mysqli_query($conn,"SELECT * FROM tc_devices WHERE lastupdate >= '$data_inicial_12' AND contact != 'ESTOQUE'");
					$online = mysqli_num_rows($cont_veiculos20);	
					
					?>
                    
			
					
                    <main id="js-page-content" role="main" class="page-content">
					
						<div class="row">
                            <div class="col-xl-8">
								<div class="subheader">
									<h1 class="subheader-title">
										<i class='subheader-icon fal fa-chart-area'></i> Dashboard Dispositivos
										
									</h1>
								</div>
							</div>
							
						</div>

						<div class="row">
							<div class="col-md-3">
								<div class="card mb-2" style="border:#CCC 1px solid;">
									<div class="card-body">
										<div class="d-flex flex-row align-items-center">
											<div class='icon-stack display-3 flex-shrink-0'>
												<i class="fal fa-circle icon-stack-3x opacity-100" style="color:#009900"></i>
												<i class="fas fas fa-key icon-stack-1x opacity-100" style="color:#009900"></i>
											</div>
											<div class="ml-3">
												<strong>
													<span style="font-size:24px;" id="ligados"><img src="/tracker2/Imagens/load.gif" style="width:30px; height:30px;"></span>
												</strong>
												<br>
												<b>Veículos Ligados em Mov.</b>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="card mb-2" style="border:#CCC 1px solid;">
									<div class="card-body">
										<div class="d-flex flex-row align-items-center">
											<div class='icon-stack display-3 flex-shrink-0'>
												<i class="fal fa-circle icon-stack-3x opacity-100" style="color:#FFA500"></i>
												<i class="fas fa-key icon-stack-1x opacity-100" style="color:#FFA500"></i>
											</div>
											<div class="ml-3">
												<strong>
													<span style="font-size:24px;" id="parados"><img src="/tracker2/Imagens/load.gif" style="width:30px; height:30px;"></span>
												</strong>
												<br>
												<b>Veículos Ligados e Parados</b>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="card mb-2" style="border:#CCC 1px solid;">
									<div class="card-body">
										<div class="d-flex flex-row align-items-center">
											<div class='icon-stack display-3 flex-shrink-0'>
												<i class="fal fa-circle icon-stack-3x opacity-100"  style="color:#000"></i>
												<i class="fas fas fa-key icon-stack-1x opacity-100" style="color:#000"></i>
											</div>
											<div class="ml-3">
												<strong>
													<span style="font-size:24px;" id="desligados"><img src="/tracker2/Imagens/load.gif" style="width:30px; height:30px;"></span>
												</strong>
												<br>
												<b>Veículos Desligados</b>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="card mb-2" style="border:#CCC 1px solid;">
									<div class="card-body">
										<div class="d-flex flex-row align-items-center">
											<div class='icon-stack display-3 flex-shrink-0' style="cursor:pointer;" data-toggle="modal" data-target="#clientes_bloqueados">
												<i class="fal fa-circle icon-stack-3x opacity-100"  style="color:#990000"></i>
												<i class="fas fa-car-battery icon-stack-1x opacity-100" style="color:#990000"></i>
											</div>
											<div class="ml-3">
												<strong>
													<span style="font-size:24px;" id="bateria"><img src="/tracker2/Imagens/load.gif" style="width:30px; height:30px;"></span>
												</strong>
												<br>
												<b>Alertas de Bateria</b>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div><br>
						<div class="row">
							<div class="col-md-6">
								<div class="card" style="border:#CCC 1px solid;">
									<div class="card-header">
										<h4 class="card-title"><b>DEMONSTRATIVO DE CONEXÕES</b></h4>
									</div>
									<div class="card-content">
										<div class="row">
											<div class="col-md-6">
												<div class="card-body">
													<div class="height-300">
														<div id="offline"></div>
													</div>
												</div>
											</div>
											<div class="col-md-5">
												<div class="d-flex mt-2">
													<h4>Dispositivos Online</h4>
													<span class="d-inline-block ml-auto"><h4><span class="badge" style="background-color:#9ACD32; color:#000;"><?php echo $online?></span></h4></span>
												</div>
												
												<br>
												<div class="d-flex">
													<h4>Offline até 12h</h4>
													<span class="d-inline-block ml-auto"><a href="veiculos_offline.php?time=12"><h4><span class="badge" style="background-color:#4682B4; color:#FFF;"><?php echo $off_12?></span></h4></a></span>
												</div>
												<br>
												<div class="d-flex">
													<h4>Offline de 12h a 24h</h4>
													<span class="d-inline-block ml-auto"><h4><a href="veiculos_offline.php?time=12x24"><span class="badge" style="background-color:#FFD700; color:#000;"><?php echo $off_12_24?></span></a></h4></span>
												</div>
												<br>
												<div class="d-flex">
													<h4>Offline acima de 24h</h4>
													<span class="d-inline-block ml-auto"><h4><a href="veiculos_offline.php?time=24"><span class="badge" style="background-color:#CD5C5C; color:#FFF;"><?php echo $off_24?></span></h4></a></span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card" style="border:#CCC 1px solid;">
									<div class="card-header">
										<h4 class="card-title"><b>OPERADORAS OFFLINE</b></h4>
									</div>
									<div class="card-content">
										<div class="row">
											<div class="col-md-12">
												<div class="card-body">
													<div class="height-350">
														<div id="offline_op" style="width:400px"></div>
													</div>
												</div>
											</div>
											
										</div><br><br>
									</div>
								</div>
							</div>
						</div><br>
                        <div class="row">
							<div class="col-md-12" >
								<div class="card" style="border:#CCC 1px solid;">
									<div class="card-header">
										<h4 class="card-title"><b>DEMONSTRATIVO DE CONEXÕES</b></h4>
									</div>
									<div class="card-content">
										<div class="row">
											<div class="col-md-12">
												<div class="card-body">
													<div class="height-300">
														<div id="rel_conexoes"></div>
													</div><br><br>
												</div>
											</div>
											
										</div>
									</div>
								</div>
							</div>
						</div>
                        	
                        <div class="modal fade" id="clientes_bloqueados" tabindex="-5" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-xl">
							<div class="modal-content">
								<div class="modal-header bg-danger text-white">
									<h3 class="modal-title" id="myLargeModalLabel" style="color:#FFF;">ALERTAS DE BATERIA</h3>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								</div>
								<div class="modal-body pos-center">
									<?php
									$sql_vencidas = mysqli_query($conn, "SELECT * FROM tc_devices WHERE positionid >='1' ORDER BY id ASC");			
									if(mysqli_num_rows($sql_vencidas) > 0){
									?>
									<table class="table table-ms">
									<thead>
									<tr>
									<th>Veiculo</th>
									<th>Cliente</th>
									<th>Horário Alerta</th>
									</tr>
									</thead>
									<tbody>
									<?php
									while($row_vencidas = mysqli_fetch_assoc($sql_vencidas)){
									$deviceid = $row_vencidas['id'];
									
									$sql_event = mysqli_query($conn, "SELECT * FROM tc_events WHERE deviceid ='$deviceid' ORDER BY id DESC LIMIT 1");			
										if(mysqli_num_rows($sql_event) > 0){
											while($row_event = mysqli_fetch_assoc($sql_event)){
											$type = $row_event['type'];
											$servertime = $row_event['eventtime'];
											$servertime = date('d/m/Y H:i:s', strtotime('-3 hour', strtotime($servertime)));
											$eventos = $row_event['attributes'];
											$eventos1 = json_decode($eventos);
											$alarme = $eventos1->{'alarm'};		
										}}
										
										$sql_veiculo = mysqli_query($conn, "SELECT * FROM veiculos_clientes WHERE deviceid ='$deviceid'");			
										if(mysqli_num_rows($sql_veiculo) > 0){
											while($row_veiculo = mysqli_fetch_assoc($sql_veiculo)){
											$placa = $row_veiculo['placa'];
											$marca_veiculo = $row_veiculo['marca_veiculo'];
											$modelo_veiculo = $row_veiculo['modelo_veiculo'];
											$veiculo = $placa.' - '.$marca_veiculo.'/'.$modelo_veiculo;
											$id_cliente = $row_veiculo['id_cliente'];
										}}
										
										$sql_cliente = mysqli_query($conn, "SELECT * FROM clientes WHERE id_cliente ='$id_cliente'");			
										if(mysqli_num_rows($sql_cliente) > 0){
											while($row_cliente = mysqli_fetch_assoc($sql_cliente)){
											$nome_cliente = $row_cliente['nome_cliente'];
										}}
									
									if($alarme == 'powerCut'){
										
									
							?>
							<tr>
									<td><span style="color:#990000"><b><?php echo $veiculo; ?></b></span></td>
									<td><b><?php echo $nome_cliente; ?></b></td>
									<td><b><?php echo $servertime; ?></b></td>
									
									
								</tr>
								
								
								
								
								
							<?php
									}}?>
                    </tbody>
                    </table>
					<?php
	
						}else{
						echo "<div class='alert alert-danger' role='alert'>Nenhum usuário encontrado!</div>";
						}
						?>
								</div>
								<div class="modal-footer">
									 <button type="button" class="btn btn-dark btn-sm" data-dismiss="modal">Fechar</button>
									
								</div>
							</div>
						</div>
						</div>
						
						<input type="hidden" id="customer" value="<?php echo $id_empresa?>">
						
						<!--
						<div class="row">
                            <div class="col-xl-12">
                                <div id="panel-1" class="panel">
                                    
                                    <div class="panel-container show">
                                        <div class="panel-content">
											
                                         
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						-->
                    </main>
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
		<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
		<script src="https://code.highcharts.com/highcharts.js"></script>
		<script src="https://code.highcharts.com/modules/exporting.js"></script>
		<script src="https://code.highcharts.com/modules/export-data.js"></script>
		<script src="https://code.highcharts.com/modules/accessibility.js"></script>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
	var customer = document.getElementById("customer").value;
	var intervalo = setInterval(function() { $('#ligados').load('include/status_ign_ligado.php?customer='+customer); }, 1500);

	var intervalo2 = setInterval(function() { $('#parados').load('include/status_ign_parado.php?customer='+customer); }, 1500);
	
	var intervalo3 = setInterval(function() { $('#desligados').load('include/status_ign_desligado.php?customer='+customer); }, 1500);
	
	var intervalo4 = setInterval(function() { $('#bateria').load('include/status_bateria.php?customer='+customer); }, 1500);
</script>
<script>
		Highcharts.chart('offline', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie',
		width: 250,
		height: 250,
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
            name: 'Offline Até 12 horas',
            y: <?php echo $off_12?>, 
			color: '#4682B4',
        }, {
            name: 'Offline Entre 12h e 24h',
            y: <?php echo $off_12_24?>, 
			color: '#FFD700',
        }, {
            name: 'Online',
            y: <?php echo $online?>, 
			color: '#9ACD32',
        }, {
            name: 'Offline Acima de 24 horas',
            y: <?php echo $off_24?>,
			color: '#CD5C5C',

        
        }]
    }]
});
	</script>	
	<?php 
	$cons_off_line = mysqli_query($conn,"SELECT * FROM relatorio_conexoes ORDER BY id_rel DESC LIMIT 24");
	if(mysqli_num_rows($cons_off_line) > 0){
	while ($resp_offline = mysqli_fetch_assoc($cons_off_line)) {
	$offline20[]	 = 	$resp_offline['offline'];
	$online20[]	 = 	$resp_offline['online'];
	$hora20[]	 = 	"'".$resp_offline['hora']."'";
		}}
	$offline20 = implode(", ", $offline20);
	$online20 = implode(", ", $online20);
	
	$hora20 = implode(", ", $hora20);
	
?>	
	<script>
Highcharts.chart('rel_conexoes', {
    chart: {
        type: 'areaspline'
    },
    title: {
        text: 'Conexões nas últimas 2 horas'
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: 10,
        y: 10,
        floating: true,
        borderWidth: 1,
        backgroundColor:
            Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF'
    },
    xAxis: {
        categories: [<?php echo $hora20?>],
        
    },
    yAxis: {
        title: {
            text: ''
        }
    },
    tooltip: {
        shared: true,
        valueSuffix: ' dispositivos'
    },
    credits: {
        enabled: false
    },
    plotOptions: {
        areaspline: {
            fillOpacity: 0.5
        }
    },
    series: [{
        name: 'Online',
        data: [<?php echo $online20?>],
		color: '#9ACD32',
    }, {
        name: 'Offline',
        data: [<?php echo $offline20?>],
		color: '#CD5C5C',
    }]
});
	</script>
	<script>

      google.charts.load('current', {'packages':['corechart'], 'language': 'pt'});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
		 $.ajax({
			url: "include/operadoras_off.php",
			dataType: "JSON",
			success: function (jsonData) {
				var dataArray = [
					['Operadora', 'Valor'],
				];

				for (var i = 0; i < jsonData.length; i++) {
					var valor =  parseInt(jsonData[i].valor);
					var row = [jsonData[i].categoria, jsonData[i].valor];
					dataArray.push(row);
				}
				var options = {
					title: '',
					curveType: 'function',
					is3D: false,
					series: {0: {"color": '#57c8f2'}},
					chartArea: {
						left: "3%",
						top: "3%",
						height: "115%",
						width: "100%"
					}
				};

				var data = google.visualization.arrayToDataTable(dataArray);

				var chart = new google.visualization.PieChart(document.getElementById('offline_op'));
				chart.draw(data, options);
			}
		});
      }	

</script>

	
		
    </body>
</html>
