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
        <!-- Place favicon.ico in the root directory -->
        <link rel="apple-touch-icon" sizes="180x180" href="/tracker3/app-assets/img/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/tracker3/app-assets/img/favicon/favicon-32x32.png">
        <link rel="mask-icon" href="/tracker3/app-assets/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/datagrid/datatables/datatables.bundle.css">
		<link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/fa-solid.css">
		<link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/statistics/chartjs/chartjs.css">
		
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
		
		if($acesso == 'GERAL'){
			$botao_loja1 = '';
			$botao_loja2 = '<a href="dashboard_financeiro.php"><button type="button" class="btn btn-dark btn-sm"><i class="fal fa-home"></i> Loja Horizonte</button></a>';	
			$loja = ' - LOJA FORTALEZA';
		}
		$id_empresa = '1362';
		$data_inicial = date('Y-m-01');
		$ult_dia = date("t");
		$mes1 = date("m");
		$data_final = date('Y-m-').$ult_dia;
		
		$data_agora = date('Y-m-d');
		$mes_atual = date("m");
		$ano_atual = date('Y');
		
		$cons_conta_rec_ab = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_receber WHERE MONTH(data_vencimento)='$mes_atual' AND YEAR(data_vencimento)='$ano_atual' AND data_vencimento >= '$data_agora' AND status='Em Aberto' AND id_empresa='$id_empresa'");
			if(mysqli_num_rows($cons_conta_rec_ab) > 0){
		while ($resp_conta_r = mysqli_fetch_assoc($cons_conta_rec_ab)) {
		$conta_rec_aberto = 	$resp_conta_r['SOMA'];
		$conta_rec_aberto1 = number_format($conta_rec_aberto, 2, ",", ".");
		if($conta_rec_aberto == ''){
			$conta_rec_aberto = 0.00;
			}
		}}
		
		$cons_conta_rec_pg = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_receber WHERE MONTH(data_pagamento)='$mes_atual' AND YEAR(data_pagamento)='$ano_atual' AND status='Pago' AND id_empresa='$id_empresa'");
			if(mysqli_num_rows($cons_conta_rec_pg) > 0){
		while ($resp_conta_p = mysqli_fetch_assoc($cons_conta_rec_pg)) {
		$conta_rec_pago = 	$resp_conta_p['SOMA'];
		$conta_rec_pago1 = number_format($conta_rec_pago, 2, ",", ".");
		if($conta_rec_pago == ''){
			$conta_rec_pago = 0.00;
			}
		}}
		
		$cons_conta_rec_atr = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_receber WHERE MONTH(data_vencimento)='$mes_atual' AND YEAR(data_vencimento)='$ano_atual' AND data_vencimento < '$data_agora' AND status='Em Aberto' AND id_empresa='$id_empresa'");
			if(mysqli_num_rows($cons_conta_rec_atr) > 0){
		while ($resp_conta_p1 = mysqli_fetch_assoc($cons_conta_rec_atr)) {
		$conta_rec_atr = 	$resp_conta_p1['SOMA'];
		$conta_rec_atr1 = number_format($conta_rec_atr, 2, ",", ".");
		if($conta_rec_atr == ''){
			$conta_rec_atr = 0.00;
			}
		}}
		
		$cons_conta_rec_hj = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_receber WHERE data_vencimento='$data_agora' AND status='Em Aberto' AND id_empresa='$id_empresa'");
			if(mysqli_num_rows($cons_conta_rec_hj) > 0){
		while ($resp_conta_rec_hj = mysqli_fetch_assoc($cons_conta_rec_hj)) {
		$conta_rec_hj = 	$resp_conta_rec_hj['SOMA'];
		$conta_rec_hj1 = number_format($conta_rec_hj, 2, ",", ".");
		if($conta_rec_hj == ''){
			$conta_rec_hj = 0.00;
			}
		}}
		
		$total_receber = $conta_rec_aberto + $conta_rec_pago + $conta_rec_atr;
		$total_receber1 = number_format($total_receber, 2, ",", ".");
		
		$perc_rec_pago = $conta_rec_pago / $total_receber * 100;
		$perc_rec_atraso = $conta_rec_atr / $total_receber * 100;
		$perc_rec_vencer = $conta_rec_aberto / $total_receber * 100;
		?>
		
		<?php

		$data_inicial = date('Y-m-01');
		$ult_dia = date("t");
		$mes1 = date("m");
		$data_final = date('Y-m-').$ult_dia;
		
		$data_agora = date('Y-m-d');
		$mes_atual = date("m");
		$ano_atual = date('Y');
		
		$cons_conta_pag_ab = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_pagar WHERE MONTH(data_vencimento)='$mes_atual' AND YEAR(data_vencimento)='$ano_atual' AND data_vencimento >= '$data_agora' AND status='Em Aberto' AND id_empresa='$id_empresa'");
			if(mysqli_num_rows($cons_conta_pag_ab) > 0){
		while ($resp_conta_p = mysqli_fetch_assoc($cons_conta_pag_ab)) {
		$conta_pag_aberto = 	$resp_conta_p['SOMA'];
		$conta_pag_aberto1 = number_format($conta_pag_aberto, 2, ",", ".");
		if($conta_pag_aberto == ''){
			$conta_pag_aberto = 0.00;
			}
		}}
		
		$cons_conta_pag_pg = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_pagar WHERE MONTH(data_vencimento)='$mes_atual' AND YEAR(data_vencimento)='$ano_atual' AND status='Pago' AND id_empresa='$id_empresa'");
			if(mysqli_num_rows($cons_conta_pag_pg) > 0){
		while ($resp_conta_pag_p = mysqli_fetch_assoc($cons_conta_pag_pg)) {
		$conta_pag_pago = 	$resp_conta_pag_p['SOMA'];
		$conta_pag_pago1 = number_format($conta_pag_pago, 2, ",", ".");
		if($conta_pag_pago == ''){
			$conta_pag_pago = 0.00;
			}
		}}
		
		$cons_conta_pag_atr = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_pagar WHERE (MONTH(data_vencimento)='$mes_atual' AND YEAR(data_vencimento)='$ano_atual') AND data_vencimento < '$data_agora' AND status='Em Aberto' AND id_empresa='$id_empresa'");
			if(mysqli_num_rows($cons_conta_pag_atr) > 0){
		while ($resp_conta_pag_a = mysqli_fetch_assoc($cons_conta_pag_atr)) {
		$conta_pag_atr = 	$resp_conta_pag_a['SOMA'];
		$conta_pag_atr1 = number_format($conta_pag_atr, 2, ",", ".");
		if($conta_pag_atr == ''){
			$conta_pag_atr = 0.00;
			}
		}}
		
		$cons_conta_pag_hj = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_pagar WHERE data_vencimento='$data_agora' AND status='Em Aberto' AND id_empresa='$id_empresa'");
			if(mysqli_num_rows($cons_conta_pag_hj) > 0){
		while ($resp_conta_pag_hj = mysqli_fetch_assoc($cons_conta_pag_hj)) {
		$conta_pag_hj = 	$resp_conta_pag_hj['SOMA'];
		$conta_pag_hj1 = number_format($conta_pag_hj, 2, ",", ".");
		if($conta_pag_hj == ''){
			$conta_pag_hj = 0.00;
			}
		}}
		
		$total_pagar = $conta_pag_aberto + $conta_pag_pago + $conta_pag_atr;
		$total_pagar1 = number_format($total_pagar, 2, ",", ".");
		
		$perc_pag_pago = $conta_pag_pago / $total_pagar * 100;
		$perc_pag_atraso = $conta_pag_atr / $total_pagar * 100;
		$perc_pag_vencer = $conta_pag_aberto / $total_pagar * 100;
		?>
					
					
                    <main id="js-page-content" role="main" class="page-content">
					
						<div class="row">
                            <div class="col-xl-8">
								<div class="subheader">
									<h1 class="subheader-title">
										<i class='subheader-icon fal fa-chart-area'></i> Dashboard Financeiro
										<small>
											LOJA HORIZONTE
										</small>
									</h1>
								</div>
							</div>
							<div class="col-xl-4 text-right">
								<?php echo $botao_loja2;?>
							</div>
						</div>
                        <div class="row">
							<div class="col-md-3">
								<div class="card mb-2" style="border:#CCC 1px solid;">
									<div class="card-body">
										<div class="d-flex flex-row align-items-center">
											<div class='icon-stack display-3 flex-shrink-0'>
												<i class="fal fa-circle icon-stack-3x opacity-100 color-info-400"></i>
												<i class="fas fas fa-calendar-minus icon-stack-1x opacity-100 color-info-500"></i>
											</div>
											<div class="ml-3">
												<strong>
													<span style="font-size:24px;"><?php echo $conta_rec_hj1?></span>
												</strong>
												<br>
												<b>Contas a Receber Hoje</b>
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
												<i class="fal fa-circle icon-stack-3x opacity-100" style="color:#990000"></i>
												<i class="fas fa-calendar-times icon-stack-1x opacity-100" style="color:#990000"></i>
											</div>
											<div class="ml-3">
												<strong>
													<span style="font-size:24px;"><?php echo $conta_rec_atr1?></span>
												</strong>
												<br>
												<b>Contas a Receber Vencidas</b>
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
												<i class="fal fa-circle icon-stack-3x opacity-100 color-info-400"></i>
												<i class="fas fas fa-calendar-minus icon-stack-1x opacity-100 color-info-500"></i>
											</div>
											<div class="ml-3">
												<strong>
													<span style="font-size:24px;"><?php echo $conta_pag_hj1?></span>
												</strong>
												<br>
												<b>Contas a Pagar Hoje</b>
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
												<i class="fal fa-circle icon-stack-3x opacity-100" style="color:#990000"></i>
												<i class="fas fa-calendar-times icon-stack-1x opacity-100" style="color:#990000"></i>
											</div>
											<div class="ml-3">
												<strong>
													<span style="font-size:24px;"><?php echo $conta_pag_atr1?></span>
												</strong>
												<br>
												<b>Contas a Pagar Vencidas</b>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
                        
                        
						<div class="row">
							<div class="col-md-6">
								<div class="card" style="border:#CCC 1px solid;">
									<div class="card-header">
										<h4 class="card-title"><b>DEMONSTRATIVO DE CONTAS A RECEBER NESTE MÊS</b></h4>
									</div>
									<div class="card-content">
										<div class="row">
											<div class="col-md-6">
												<div class="card-body">
													<div class="height-300">
														<div id="receber"></div>
													</div>
												</div>
											</div>
											<div class="col-md-5">
												<div class="d-flex mt-2">
													Contas Pagas
													<span class="d-inline-block ml-auto">R$ <?php echo $conta_rec_pago1?></span>
												</div>
												<div class="progress progress-sm mb-3" style="height:16px;">
													<div class="progress-bar" role="progressbar" style="width: <?php echo $perc_rec_pago?>%;background-color:#9ACD32" aria-valuenow="<?php echo $perc_rec_pago?>" aria-valuemin="0" aria-valuemax="100"></div>
												</div><br>
												<div class="d-flex">
													Contas a Vencer
													<span class="d-inline-block ml-auto">R$ <?php echo $conta_rec_aberto1?></span>
												</div>
												<div class="progress progress-sm mb-3" style="height:16px;">
													<div class="progress-bar" role="progressbar" style="width: <?php echo $perc_rec_vencer?>%;background-color:#4682B4" aria-valuenow="<?php echo $perc_rec_vencer?>" aria-valuemin="0" aria-valuemax="100"></div>
												</div><br>
												<div class="d-flex">
												   Contas Vencidas
													<span class="d-inline-block ml-auto">R$ <?php echo $conta_rec_atr1?></span>
												</div>
												<div class="progress progress-sm mb-3" style="height:16px;">
													<div class="progress-bar" role="progressbar" style="width: <?php echo $perc_rec_atraso?>%;background-color:#CD5C5C" aria-valuenow="<?php echo $perc_rec_atraso?>" aria-valuemin="0" aria-valuemax="100"></div>
												</div><br>
												<div class="d-flex" style="border:#CCC 1px solid;">
												  Total de Contas a Receber
													<span class="d-inline-block ml-auto"><b>R$ <?php echo $total_receber1?></b></span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card" style="border:#CCC 1px solid;">
									<div class="card-header">
										<h4 class="card-title"><b>DEMONSTRATIVO DE CONTAS A PAGAR NESTE MÊS</b></h4>
									</div>
									<div class="card-content">
										<div class="row">
											<div class="col-md-6">
												<div class="card-body">
													<div class="height-300">
														<div id="pagar"></div>
													</div>
												</div>
											</div>
											<div class="col-md-5">
												<div class="d-flex mt-2">
													Contas Pagas
													<span class="d-inline-block ml-auto">R$ <?php echo $conta_pag_pago1?></span>
												</div>
												<div class="progress progress-sm mb-3" style="height:16px;">
													<div class="progress-bar" role="progressbar" style="width: <?php echo $perc_pag_pago?>%;background-color:#9ACD32" aria-valuenow="<?php echo $perc_pag_pago?>" aria-valuemin="0" aria-valuemax="100"></div>
												</div><br>
												<div class="d-flex">
													Contas a Vencer
													<span class="d-inline-block ml-auto">R$ <?php echo $conta_pag_aberto1?></span>
												</div>
												<div class="progress progress-sm mb-3" style="height:16px;">
													<div class="progress-bar" role="progressbar" style="width: <?php echo $perc_pag_vencer?>%;background-color:#4682B4" aria-valuenow="<?php echo $perc_pag_vencer?>" aria-valuemin="0" aria-valuemax="100"></div>
												</div><br>
												<div class="d-flex">
												   Contas Vencidas
													<span class="d-inline-block ml-auto">R$ <?php echo $conta_pag_atr1?></span>
												</div>
												<div class="progress progress-sm mb-3" style="height:16px;">
													<div class="progress-bar" role="progressbar" style="width: <?php echo $perc_pag_atraso?>%;background-color:#CD5C5C" aria-valuenow="<?php echo $perc_pag_atraso?>" aria-valuemin="0" aria-valuemax="100"></div>
												</div><br>
												<div class="d-flex" style="border:#CCC 1px solid;">
												  Total de Contas a Pagar
													<span class="d-inline-block ml-auto"><b>R$ <?php echo $total_pagar1?></b></span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-12">
							
								<div class="card" style="border:#CCC 1px solid;">
									<div class="card-header">
										<h4 class="card-title"><b>BALANÇO FINANCEIRO ULTIMOS 12 MESES</b></h4>
									</div>
									<div class="card-content">
										<div class="row">
											<div class="col-md-12">
												<div class="card-body">
													<div class="height-300">
														<div id="despesas" style="height:400px"></div>
													</div>
												</div>
											</div>
											
										</div>
									</div>
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-12">
							
								<div class="card" style="border:#CCC 1px solid;">
									<div class="card-header">
										<h4 class="card-title"><b>INADIMPLÊNCIA ULTIMOS 12 MESES</b></h4>
									</div>
									<div class="card-content">
										<div class="row">
											<div class="col-md-12">
												<div class="card-body">
													<div class="height-300">
														<div id="inadimplencia" style="height:400px"></div>
													</div>
												</div>
											</div>
											
										</div>
									</div>
								</div>
							</div>
						</div>
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
      
		<?php
	
		include('dados_contas_pagar2.php');
		include('dados_inadimplencia2.php');
		//include('dados_despesas.php');
		?>
	  
	  
	  
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
		Highcharts.chart('receber', {
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
            name: 'Em Aberto',
            y: <?php echo $conta_rec_aberto?>, 
			color: '#4682B4',
        }, {
            name: 'Pago',
            y: <?php echo $conta_rec_pago?>, 
			color: '#9ACD32',
        }, {
            name: 'Em Atraso',
            y: <?php echo $conta_rec_atr?>,
			color: '#CD5C5C',

        
        }]
    }]
});
	</script>		
<script>
		Highcharts.chart('pagar', {
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
            name: 'Em Aberto',
            y: <?php echo $conta_pag_aberto?>, 
			color: '#4682B4',
        }, {
            name: 'Pago',
            y: <?php echo $conta_pag_pago?>, 
			color: '#9ACD32',
        }, {
            name: 'Em Atraso',
            y: <?php echo $conta_pag_atr?>,
			color: '#CD5C5C',

        
        }]
    }]
});
	</script>
 <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart'], 'language': 'pt'});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
          ['Mês', 'Receitas', { role: 'style' }, 'Despesas', { role: 'style' }, 'Lucro Período', { role: 'style' }],
          ['<?php echo $mes12?>',  <?php echo $total_receb12?>, '#66CDAA',      <?php echo $total_pagar12?>, '#FA8072',      <?php echo $lucro_mes12?>, '#000000'],
          ['<?php echo $mes11?>',  <?php echo $total_receb11?>, '#66CDAA',     <?php echo $total_pagar11?>,  '#FA8072',     <?php echo $lucro_mes11?>, '#000000'],
          ['<?php echo $mes10?>',  <?php echo $total_receb10?>, '#66CDAA',     <?php echo $total_pagar10?>,   '#FA8072',    <?php echo $lucro_mes10?>, '#000000'],
          ['<?php echo $mes9?>',  <?php echo $total_receb9?>,  '#66CDAA',    <?php echo $total_pagar9?>,    '#FA8072',   <?php echo $lucro_mes9?>, '#000000'],
          ['<?php echo $mes8?>',  <?php echo $total_receb8?>, '#66CDAA',     <?php echo $total_pagar8?>,   '#FA8072',    <?php echo $lucro_mes8?>, '#000000'],
          ['<?php echo $mes7?>',  <?php echo $total_receb7?>, '#66CDAA',     <?php echo $total_pagar7?>,   '#FA8072',    <?php echo $lucro_mes7?>, '#000000'],
          ['<?php echo $mes6?>',  <?php echo $total_receb6?>, '#66CDAA',     <?php echo $total_pagar6?>,   '#FA8072',    <?php echo $lucro_mes6?>, '#000000'],
          ['<?php echo $mes5?>',  <?php echo $total_receb5?>,  '#66CDAA',    <?php echo $total_pagar5?>,   '#FA8072',    <?php echo $lucro_mes5?>, '#000000'],
          ['<?php echo $mes4?>',  <?php echo $total_receb4?>,  '#66CDAA',    <?php echo $total_pagar4?>,   '#FA8072',    <?php echo $lucro_mes4?>, '#000000'],
          ['<?php echo $mes3?>',  <?php echo $total_receb3?>,  '#66CDAA',    <?php echo $total_pagar3?>,   '#FA8072',    <?php echo $lucro_mes3?>, '#000000'],
          ['<?php echo $mes2?>',  <?php echo $total_receb2?>,  '#66CDAA',    <?php echo $total_pagar2?>,   '#FA8072',    <?php echo $lucro_mes2?>, '#000000'],
          ['<?php echo $mes1?>',  <?php echo $total_receb1?>,  '#66CDAA',    <?php echo $total_pagar1?>,   '#FA8072',    <?php echo $lucro_mes1?>, '#000000'],
          ['<?php echo $mes_atual1?>',  <?php echo $total_receb?>,  '#66CDAA',    <?php echo $total_pagar?>,   '#FA8072',    <?php echo $lucro_mes_atual?>, '#000000']
        ]);

        var options = {
          title : '',
		  vAxis: {title: 'Montante'},
          hAxis: {title: 'Período'},
          seriesType: 'bars',
		  bar: {groupWidth: "80%"},
          series: {2: {type: 'line'}},
		  colors: ['#66CDAA', '#FA8072', '#000000']
        };

        var chart = new google.visualization.ComboChart(document.getElementById('despesas'));
        chart.draw(data, options);
      }
    </script>		
 <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart'], 'language': 'pt'});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
          ['Mês', 'Pago', {type: 'string', role: 'tooltip'}, 'Em Atraso', {type: 'string', role: 'tooltip'}, 'Em Aberto', {type: 'string', role: 'tooltip'}, '% Inadimplência', {type: 'string', role: 'tooltip'}],
          ['<?php echo $mes12?>', 
		  <?php echo $qtd_pago_mes_12?>, 'Títulos Pagos: <?php echo $qtd_pago_mes_12?>\nValor Pago: R$ <?php echo $total_pago_mes121?>', 
		  <?php echo $qtd_atraso_mes_12?>, 'Títulos Atraso: <?php echo $qtd_atraso_mes_12?>\nValor Atraso: R$ <?php echo $total_atraso_mes121?>', 
		  <?php echo $qtd_atraso_mes?>, '#FFD700', 
		  <?php echo $qtd_pago_mes_12/2?>, 'Inadimplência: <?php echo $inadimp_mes12?>%'],
          ['<?php echo $mes11?>', 
		  <?php echo $qtd_pago_mes_11?>, 'Títulos Pagos: <?php echo $qtd_pago_mes_11?>\nValor Pago: R$ <?php echo $total_pago_mes111?>', 
		  <?php echo $qtd_atraso_mes_11?>, 'Títulos Atraso: <?php echo $qtd_atraso_mes_11?>\nValor Atraso: R$ <?php echo $total_atraso_mes111?>', 
		  <?php echo $qtd_atraso_mes?>, '#FFD700', 
		  <?php echo $qtd_pago_mes_11/2?>, 'Inadimplência: <?php echo $inadimp_mes11?>%'],
          ['<?php echo $mes10?>',
		  <?php echo $qtd_pago_mes_10?>, 'Títulos Pagos: <?php echo $qtd_pago_mes_10?>\nValor Pago: R$ <?php echo $total_pago_mes101?>', 
		  <?php echo $qtd_atraso_mes_10?>, 'Títulos Atraso: <?php echo $qtd_atraso_mes_10?>\nValor Atraso: R$ <?php echo $total_atraso_mes101?>', 
		  <?php echo $qtd_atraso_mes?>, '#FFD700', 
		  <?php echo $qtd_pago_mes_10/2?>, 'Inadimplência: <?php echo $inadimp_mes10?>%'],
          ['<?php echo $mes9?>', 
		  <?php echo $qtd_pago_mes_9?>, 'Títulos Pagos: <?php echo $qtd_pago_mes_9?>\nValor Pago: R$ <?php echo $total_pago_mes91?>', 
		  <?php echo $qtd_atraso_mes_9?>, 'Títulos Atraso: <?php echo $qtd_atraso_mes_9?>\nValor Atraso: R$ <?php echo $total_atraso_mes91?>', 
		  <?php echo $qtd_atraso_mes?>, '#FFD700', 
		  <?php echo $qtd_pago_mes_9/2?>, 'Inadimplência: <?php echo $inadimp_mes9?>%'],
          ['<?php echo $mes8?>', 
		  <?php echo $qtd_pago_mes_8?>, 'Títulos Pagos: <?php echo $qtd_pago_mes_8?>\nValor Pago: R$ <?php echo $total_pago_mes81?>', 
		  <?php echo $qtd_atraso_mes_8?>, 'Títulos Atraso: <?php echo $qtd_atraso_mes_8?>\nValor Atraso: R$ <?php echo $total_atraso_mes81?>', 
		  <?php echo $qtd_atraso_mes?>, '#FFD700', 
		  <?php echo $qtd_pago_mes_8/2?>, 'Inadimplência: <?php echo $inadimp_mes8?>%'],
          ['<?php echo $mes7?>', 
		  <?php echo $qtd_pago_mes_7?>, 'Títulos Pagos: <?php echo $qtd_pago_mes_7?>\nValor Pago: R$ <?php echo $total_pago_mes71?>', 
		  <?php echo $qtd_atraso_mes_7?>, 'Títulos Atraso: <?php echo $qtd_atraso_mes_7?>\nValor Atraso: R$ <?php echo $total_atraso_mes71?>', 
		  <?php echo $qtd_atraso_mes?>, '#FFD700', 
		  <?php echo $qtd_pago_mes_7/2?>, 'Inadimplência: <?php echo $inadimp_mes7?>%'],
          ['<?php echo $mes6?>', 
		  <?php echo $qtd_pago_mes_6?>, 'Títulos Pagos: <?php echo $qtd_pago_mes_6?>\nValor Pago: R$ <?php echo $total_pago_mes61?>', 
		  <?php echo $qtd_atraso_mes_6?>, 'Títulos Atraso: <?php echo $qtd_atraso_mes_6?>\nValor Atraso: R$ <?php echo $total_atraso_mes61?>', 
		  <?php echo $qtd_atraso_mes?>, '#FFD700', 
		  <?php echo $qtd_pago_mes_6/2?>, 'Inadimplência: <?php echo $inadimp_mes6?>%'],
          ['<?php echo $mes5?>', 
		  <?php echo $qtd_pago_mes_5?>, 'Títulos Pagos: <?php echo $qtd_pago_mes_5?>\nValor Pago: R$ <?php echo $total_pago_mes51?>', 
		  <?php echo $qtd_atraso_mes_5?>, 'Títulos Atraso: <?php echo $qtd_atraso_mes_5?>\nValor Atraso: R$ <?php echo $total_atraso_mes51?>', 
		  <?php echo $qtd_atraso_mes?>, '#FFD700', 
		  <?php echo $qtd_pago_mes_5/2?>, 'Inadimplência: <?php echo $inadimp_mes5?>%'],
          ['<?php echo $mes4?>', 
		  <?php echo $qtd_pago_mes_4?>, 'Títulos Pagos: <?php echo $qtd_pago_mes_4?>\nValor Pago: R$ <?php echo $total_pago_mes41?>', 
		  <?php echo $qtd_atraso_mes_4?>, 'Títulos Atraso: <?php echo $qtd_atraso_mes_4?>\nValor Atraso: R$ <?php echo $total_atraso_mes41?>', 
		  <?php echo $qtd_atraso_mes?>, '#FFD700', 
		  <?php echo $qtd_pago_mes_4/2?>, 'Inadimplência: <?php echo $inadimp_mes4?>%'],
          ['<?php echo $mes3?>', 
		  <?php echo $qtd_pago_mes_3?>, 'Títulos Pagos: <?php echo $qtd_pago_mes_3?>\nValor Pago: R$ <?php echo $total_pago_mes31?>', 
		  <?php echo $qtd_atraso_mes_3?>, 'Títulos Atraso: <?php echo $qtd_atraso_mes_3?>\nValor Atraso: R$<?php echo $total_atraso_mes31?>', 
		  <?php echo $qtd_atraso_mes?>, '#FFD700', 
		  <?php echo $qtd_pago_mes_3/2?>, 'Inadimplência: <?php echo $inadimp_mes3?>%'],
          ['<?php echo $mes2?>', 
		  <?php echo $qtd_pago_mes_2?>, 'Títulos Pagos: <?php echo $qtd_pago_mes_2?>\nValor Pago: R$ <?php echo $total_pago_mes21?>', 
		  <?php echo $qtd_atraso_mes_2?>, 'Títulos Atraso: <?php echo $qtd_atraso_mes_2?>\nValor Atraso: R$ <?php echo $total_atraso_mes21?>', 
		  <?php echo $qtd_atraso_mes?>, '#FFD700', 
		  <?php echo $qtd_pago_mes_2 / 2?>, 'Inadimplência: <?php echo $inadimp_mes2?>%'],
          ['<?php echo $mes1?>', 
		  <?php echo $qtd_pago_mes_1?>, 'Títulos Pagos: <?php echo $qtd_pago_mes_1?>\nValor Pago: R$ <?php echo $total_pago_mes11?>', 
		  <?php echo $qtd_atraso_mes_1?>, 'Títulos Atraso: <?php echo $qtd_atraso_mes_1?>\nValor Atraso: R$ <?php echo $total_atraso_mes11?>', 
		  <?php echo $qtd_atraso_mes?>, '#FFD700', 
		  <?php echo $qtd_pago_mes_1/ 2?>,'Inadimplência: <?php echo $inadimp_mes1?>%'],
          ['<?php echo $mes_atual?>',
		  <?php echo $qtd_pago_mes_atual?>, 'Títulos Pagos: <?php echo $qtd_pago_mes_atual?>\nValor Pago: R$<?php echo $total_pago_atual1?>', 
		  <?php echo $qtd_atraso_mes_atual?>,  'Títulos Atraso: <?php echo $qtd_atraso_mes_atual?>\nValor Atraso: R$ <?php echo $total_atraso_atual1?>', 
		  <?php echo $qtd_aberto_mes_atual?>, 'Títulos Aberto: <?php echo $qtd_aberto_mes_atual?>\nValor Aberto: R$ <?php echo $total_aberto_atual1?>', 
		  <?php echo $qtd_pago_mes_atual/2?>, 'Inadimplência: <?php echo $inadimp_atual?>%']
        ]);

        var options = {
          title : '',
		   vAxis: {title: 'Montante'},
		    tooltip: {isHtml: true},
          hAxis: {title: 'Período'},
          seriesType: 'bars',
		  bar: {groupWidth: "95%"},
          series: {3: {type: 'line'}},
		  lineWidth: 2,
		  colors: ['#1E90FF', '#FA8072', '#FFD700', '#000000']
        };

        var chart = new google.visualization.ComboChart(document.getElementById('inadimplencia'));
        chart.draw(data, options);
      }
    </script>
 <style>div.google-visualization-tooltip { border:#000 2px solid; width:300px }</style>		
		
    </body>
</html>
