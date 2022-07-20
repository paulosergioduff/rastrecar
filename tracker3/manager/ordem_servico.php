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
$dados = explode("&", $base);

$id_cliente = $dados[0];
$cliente = explode(":", $id_cliente);
$id_cliente = $cliente[1];

$id_os = $dados[1];
$veiculo = explode(":", $id_os);
$id_os = $veiculo[1];


$cons_cliente = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
	if(mysqli_num_rows($cons_cliente) > 0){
while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
$nome_cliente = 	$resp_cliente['nome_cliente'];
$doc_cliente = 	$resp_cliente['doc_cliente'];
$rg_cliente	 = 	$resp_cliente['rg_cliente'];
$data_nascimento = 	$resp_cliente['data_nascimento'];
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
$data_cadastro = 	$resp_cliente['data_cadastro'];
$data_cadastro = date('d/m/Y', strtotime("$data_cadastro"));
$email = 	$resp_cliente['email'];
$pacote = 	$resp_cliente['pacote'];	
	}}
	
$cons_os = mysqli_query($conn,"SELECT * FROM ordem_servico WHERE id_os='$id_os'");
	if(mysqli_num_rows($cons_os) > 0){
while ($result3 = mysqli_fetch_assoc($cons_os)) {
	$parceiro = $result3['parceiro'];
	$tipo_os = $result3['tipo_os'];
	$descricao	 = $result3['descricao'];
	$valor = $result3['valor'];
	$data_criacao = $result3['data_criacao'];
	$data_criacao = date('d/m/Y', strtotime("$data_criacao"));
	$prioridade = $result3['prioridade'];
	$informacoes = $result3['informacoes'];
	$imei = $result3['imei'];
	$id_veiculo = $result3['id_veiculo'];
	$status = $result3['status'];
	$data_encerramento = $result3['data_encerramento'];
	
	
	if($tipo_os == 'INSTALACAO'){
	$check1 = '<img src="/tracker/Imagens/check1.png" width="20" height="20"/>';
	} else {
	$check1 = '<img src="/tracker/Imagens/check.png"  width="20" height="20"/>';
	}
	
	
	if($tipo_os == 'MANUTENCAO'){
	$check2 = '<img src="/tracker/Imagens/check1.png"  width="20" height="20"/>';
	} else {
	$check2 = '<img src="/tracker/Imagens/check.png"  width="20" height="20"/>';
	}
	
	if($tipo_os == 'RETIRADA'){
	$check3 = '<img src="/tracker/Imagens/check1.png" width="20" height="20"/>';
	} else {
	$check3 = '<img src="/tracker/Imagens/check.png"  width="20" height="20"/>';
	}
	

}}


	$sql1 = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE id_veiculo = '$id_veiculo'");
	if(mysqli_num_rows($sql1) > 0){
while ($rows4 = mysqli_fetch_assoc($sql1)) {
	$marca_veiculo = $rows4['marca_veiculo'];
	$modelo_veiculo = $rows4['modelo_veiculo'];
	$chassi = $rows4['chassi'];
	$placa = $rows4['placa'];
	$renavan = $rows4['renavan'];
	$cor_veiculo = $rows4['cor_veiculo'];
	$tipo_veiculo = $rows4['tipo_veiculo'];
	$ano_veiculo = $rows4['ano_veiculo'];
	$proprietario = $rows4['proprietario'];
	$nr_contrato = $rows4['nr_contrato'];
	}}
	
	
$cons_parceiro = mysqli_query($conn,"SELECT * FROM parceiros WHERE id_parceiro='$parceiro'");
	if(mysqli_num_rows($cons_parceiro) <= 0){
		$nome_parceiro = '--';
	}
	if(mysqli_num_rows($cons_parceiro) > 0){
while ($result34 = mysqli_fetch_assoc($cons_parceiro)) {
	$nome_parceiro = $result34['nome_parceiro'];
}}

$base64 = 'id_cliente:'.$id_cliente.'';
$base64 = base64_encode($base64);

$base64_os = 'id_cliente:'.$id_cliente.'&id_os:'.$id_os.'';
$base64_os = base64_encode($base64_os);

	if($status == 1){
		$btn_finaliza = '<a href="tratar_os.php?id_os='.$id_os.'&id_cliente='.$id_cliente.'"><button data-toggle="tooltip" data-offset="0,10" data-original-title="Tratar OS" type="button" class="btn btn-success btn-sm">Finalizar OS</button></a>';
	}
	if($status == 2){
		$btn_finaliza = '';
	}
	
	if($data_encerramento == '0000-00-00'){
		$data_encerramento1 = '______/______/______';
	}
	if($data_encerramento != '0000-00-00'){
		$data_encerramento1 = date('d/m/Y', strtotime("$data_encerramento"));
	}
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
		        <link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/page-invoice.css">
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
                            <div class="col-xl-7">
								<div class="subheader">
									<h1 class="subheader-title">
										<i class='subheader-icon fal fa-users'></i> <?php echo $nome_cliente?>
										<small>
											Ordem de Serviço
										</small>
									</h1>
								</div>
							</div>
							<div class="col-xl-5 text-right">
							<?php echo $btn_finaliza?>
							<button type="button" class="btn btn-info btn-sm" onClick="window.print()" style="font-size:14px"><i class="fal fa-print"></i> Imprimir</button>
							<a href="cad_cliente.php?c=<?php echo $base64?>"><button type="button" class="btn btn-dark btn-sm" style="font-size:14px"><i class="fal fa-user"></i> Voltar</button></a>
							</div>
						</div>
                        
                       <div class="container">
                            <div data-size="A4">
                               
								<div class="row">
									<div class="col-sm-4">
										<div class="form-group">
											<img src="logos/<?php echo $logo?>" style="width:150px; heigth:auto" alt="SmartAdmin WebApp" aria-roledescription="logo">
										</div>
									</div>
									<div class="col-sm-8 text-center" style="color:#000;">
										<div class="form-group">
											<h3><b>ORDEM DE SERVIÇO Nº <?php echo $id_os?></b></h3>
											<h4>Instalação / Manutenção / Retirada</h4>
											<p>Prioridade: <b><?php echo $prioridade?></b></p>
										</div>
									</div>
									
								</div>
								<div class="row" style="color:#000;">
									<div class="col-sm-12" >
										<div class="form-group" style="border-radius:5px; border:#000000 1px solid;">
											<table width="100%" border="0" cellspacing="0" bordercolor="#000000">
											  <tr>
												<td><table width="100%" border="0" cellspacing="0">
												  <tr>
													<td><font face="Verdana, Geneva, sans-serif" size="1"><strong>Tipo de Serviço:</strong></font></td>
												  </tr>
												  <tr>
													<td><table width="100%" border="0" cellspacing="0">
													  <tr>
														<td width="3%"><?php echo $check1?></td>
														<td width="30%">Instalação</td>
														<td width="3%"><?php echo $check2?></td>
														<td width="30%">Manutenção</td>
														<td width="3%"><?php echo $check3?></td>
														<td width="31%">Retirada</td>
													  </tr>
													</table></td>
												  </tr>
												</table></td>
											  </tr>
											</table>
										</div>
									</div>
								</div><br>
                                <div class="row" style="color:#000;">
									<div class="col-sm-4">
										<div class="form-group" style="border-radius:5px; border:#000000 1px solid;">
											<table width="100%" border="0" cellspacing="0">
											  <tr>
												<td>Data Criação da OS:</td>
											  </tr>
											  <tr>
												<td align="left" height="22"><b><?php echo $data_criacao?></b></td>
											  </tr>
											</table>
										</div>
									</div>
									<div class="col-sm-4" >
										<div class="form-group" style="border-radius:5px; border:#000000 1px solid;">
											<table width="100%" border="0" cellspacing="0">
											  <tr>
												<td>Data Conclusão:</td>
											  </tr>
											  <tr>
												<td align="center" height="22"><?php echo $data_encerramento1?></td>
											  </tr>
											</table>
										</div>
									</div>
									<div class="col-sm-4" >
										<div class="form-group" style="border-radius:5px; border:#000000 1px solid;">
											<table width="100%" border="0" cellspacing="0">
											  <tr>
												<td>Horário Conclusão:</td>
											  </tr>
											  <tr>
												<td align="center" height="22">______ <strong>:</strong> ______</td>
											  </tr>
											</table>
										</div>
									</div>
								</div><br>
                                <div class="row" style="color:#000;">
									<div class="col-sm-6" >
										<div class="form-group" style="border-radius:5px; border:#000000 1px solid;">
											<table width="100%" border="0" cellspacing="0">
											<tr>
											  <td>Nome do Técnico/Credenciado:</td>
											  </tr>
											<tr>
											  <td align="left"><b><?php echo $nome_parceiro?></b></td>
											  </tr>
											</table>
										</div>
									</div>
									<div class="col-sm-6" >
										<div class="form-group" style="border-radius:5px; border:#000000 1px solid;">
											<table width="100%" border="0" cellspacing="0">
											<tr>
											  <td>ID do equipamento:</td>
											  </tr>
											<tr>
											  <td align="left"><b><?php echo $imei?></b></td>
											  </tr>
											</table>
										</div>
									</div>
								</div><br>
								<div class="row" style="color:#000;">
									<div class="col-sm-6">
										<div class="form-group" style="border-radius:5px; border:#000000 1px solid;">
											<table width="100%" border="0" cellspacing="0">
												<tr>
												  <td>Cliente:</font></td>
												  </tr>
												<tr>
												  <td><b><?php echo $nome_cliente?></b></td>
												  </tr>
												</table>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group" style="border-radius:5px; border:#000000 1px solid;">
											<table width="100%" border="0" cellspacing="0">
												<tr>
												  <td>Telefones:</font></td>
												  </tr>
												<tr>
												  <td><b><?php echo $telefone_celular?> - <?php echo $telefone_outros?> - <?php echo $telefone_residencial?></b></td>
												  </tr>
												</table>
										</div>
									</div>
								</div><br>
								<div class="row" style="color:#000;">
									<div class="col-sm-12">
										<div class="form-group" style="border-radius:5px; border:#000000 1px solid;">
											<table width="100%" border="0" cellspacing="0">
												<tr>
												  <td>Endereço:</td>
												  </tr>
												<tr>
												  <td><b><?php echo $endereco?>, <?php echo $numero?> - <?php echo $complemento?> - <?php echo $bairro?> - <?php echo $cidade?> / <?php echo $estado?> - <?php echo $cep?></b></td>
												  </tr>
												</table>
										</div>
									</div>
								</div><br>
								<div class="row" style="color:#000;">
									<div class="col-sm-4" >
										<div class="form-group" style="border-radius:5px; border:#000000 1px solid;">
											<table width="100%" border="0" cellspacing="0">
											<tr>
											  <td>Placa Veículo:</td>
											  </tr>
											<tr>
											  <td><b><?php echo $placa?></b></td>
											  </tr>
											</table>
										</div>
									</div>
									<div class="col-sm-4" >
										<div class="form-group" style="border-radius:5px; border:#000000 1px solid;">
											<table width="100%" border="0" cellspacing="0">
												<tr>
												  <td>Marca / Modelo:</td>
												  </tr>
												<tr>
												  <td><b><?php echo $marca_veiculo?> / <?php echo $modelo_veiculo?></b></td>
												  </tr>
												</table>
										</div>
									</div>
									<div class="col-sm-4" >
										<div class="form-group" style="border-radius:5px; border:#000000 1px solid;">
											<table width="100%" border="0" cellspacing="0">
											<tr>
											  <td>Cor / Ano:</td>
											  </tr>
											<tr>
											  <td><b><?php echo $cor_veiculo?> - <?php echo $ano_veiculo?></b></td>
											  </tr>
											</table>
										</div>
									</div>	
								</div><br>
								<div class="row" style="color:#000;">
									<div class="col-sm-12">
										<div class="form-group" style="border-radius:5px; border:#000000 1px solid;">
											<table width="100%" border="0" cellspacing="0">
												<tr>
												  <td>Descrição do Serviço a Realizar:</td>
												  </tr>
												<tr>
												  <td><b><?php echo $descricao?></b></td>
												  </tr>
												</table>
										</div>
									</div>
								</div><br>
								<div class="row" style="color:#000;">
									<div class="col-sm-12">
										<div class="form-group">
											<table width="100%" border="1" bordercolor="#000000"  cellspacing="0">
											  <tr>
												<td width="23%" align="center"><strong><font size="1" face="Verdana, Geneva, sans-serif">Equipamentos do Veículo</font></strong></td>
												<td width="13%" align="center"><strong><font size="1" face="Verdana, Geneva, sans-serif">Antes Serviço</font></strong></td>
												<td width="13%" align="center"><strong><font size="1" face="Verdana, Geneva, sans-serif">Após Serviço</font></strong></td>
												<td width="23%" align="center"><strong><font size="1" face="Verdana, Geneva, sans-serif">Equipamentos do Veículo</font></strong></td>
												<td width="13%" align="center"><strong><font size="1" face="Verdana, Geneva, sans-serif">Antes Serviço</font></strong></td>
												<td width="13%" align="center"><strong><font size="1" face="Verdana, Geneva, sans-serif">Após Serviço</font></strong></td>
											  </tr>
											  <tr>
												<td><font size="1" face="Verdana, Geneva, sans-serif">Setas</font></td>
												<td><table width="100%" border="0" cellspacing="0">
												  <tr>
													<td width="12%">◯</td>
													<td width="37%"><font size="1" face="Verdana, Geneva, sans-serif">OK</font></td>
													<td width="25%">◯</td>
													<td width="26%"><font size="1" face="Verdana, Geneva, sans-serif">D</font></td>
												  </tr>
												</table></td>
												<td><table width="100%" border="0" cellspacing="0">
												  <tr>
													<td width="12%">◯</td>
													<td width="37%"><font size="1" face="Verdana, Geneva, sans-serif">OK</font></td>
													<td width="25%">◯</td>
													<td width="26%"><font size="1" face="Verdana, Geneva, sans-serif">D</font></td>
												  </tr>
												</table></td>
												<td align="left"><font size="1" face="Verdana, Geneva, sans-serif">Tomada 12V</font></td>
												<td align="center"><table width="100%" border="0" cellspacing="0">
												  <tr>
													<td width="12%">◯</td>
													<td width="37%"><font size="1" face="Verdana, Geneva, sans-serif">OK</font></td>
													<td width="25%">◯</td>
													<td width="26%"><font size="1" face="Verdana, Geneva, sans-serif">D</font></td>
												  </tr>
												</table></td>
												<td align="center"><table width="100%" border="0" cellspacing="0">
												  <tr>
													<td width="12%">◯</td>
													<td width="37%"><font size="1" face="Verdana, Geneva, sans-serif">OK</font></td>
													<td width="25%">◯</td>
													<td width="26%"><font size="1" face="Verdana, Geneva, sans-serif">D</font></td>
												  </tr>
												</table></td>
											  </tr>
											  <tr>
												<td><font size="1" face="Verdana, Geneva, sans-serif">Buzina</font></td>
												<td><table width="100%" border="0" cellspacing="0">
												  <tr>
													<td width="12%">◯</td>
													<td width="37%"><font size="1" face="Verdana, Geneva, sans-serif">OK</font></td>
													<td width="25%">◯</td>
													<td width="26%"><font size="1" face="Verdana, Geneva, sans-serif">D</font></td>
												  </tr>
												</table></td>
												<td><table width="100%" border="0" cellspacing="0">
												  <tr>
													<td width="12%">◯</td>
													<td width="37%"><font size="1" face="Verdana, Geneva, sans-serif">OK</font></td>
													<td width="25%">◯</td>
													<td width="26%"><font size="1" face="Verdana, Geneva, sans-serif">D</font></td>
												  </tr>
												</table></td>
												<td align="left"><font size="1" face="Verdana, Geneva, sans-serif">Partida e Func. do motor</font></td>
												<td align="center"><table width="100%" border="0" cellspacing="0">
												  <tr>
													<td width="12%">◯</td>
													<td width="37%"><font size="1" face="Verdana, Geneva, sans-serif">OK</font></td>
													<td width="25%">◯</td>
													<td width="26%"><font size="1" face="Verdana, Geneva, sans-serif">D</font></td>
												  </tr>
												</table></td>
												<td align="center"><table width="100%" border="0" cellspacing="0">
												  <tr>
													<td width="12%">◯</td>
													<td width="37%"><font size="1" face="Verdana, Geneva, sans-serif">OK</font></td>
													<td width="25%">◯</td>
													<td width="26%"><font size="1" face="Verdana, Geneva, sans-serif">D</font></td>
												  </tr>
												</table></td>
											  </tr>
											  <tr>
												<td><font size="1" face="Verdana, Geneva, sans-serif">Luz de Anomalia</font></td>
												<td><table width="100%" border="0" cellspacing="0">
												  <tr>
													<td width="12%">◯</td>
													<td width="37%"><font size="1" face="Verdana, Geneva, sans-serif">OK</font></td>
													<td width="25%">◯</td>
													<td width="26%"><font size="1" face="Verdana, Geneva, sans-serif">D</font></td>
												  </tr>
												</table></td>
												<td><table width="100%" border="0" cellspacing="0">
												  <tr>
													<td width="12%">◯</td>
													<td width="37%"><font size="1" face="Verdana, Geneva, sans-serif">OK</font></td>
													<td width="25%">◯</td>
													<td width="26%"><font size="1" face="Verdana, Geneva, sans-serif">D</font></td>
												  </tr>
												</table></td>
												<td align="left"><font size="1" face="Verdana, Geneva, sans-serif">Corta Corrente</font></td>
												<td align="center"><table width="100%" border="0" cellspacing="0">
												  <tr>
													<td width="12%">◯</td>
													<td width="37%"><font size="1" face="Verdana, Geneva, sans-serif">OK</font></td>
													<td width="25%">◯</td>
													<td width="26%"><font size="1" face="Verdana, Geneva, sans-serif">D</font></td>
												  </tr>
												</table></td>
												<td align="center"><table width="100%" border="0" cellspacing="0">
												  <tr>
													<td width="12%">◯</td>
													<td width="37%"><font size="1" face="Verdana, Geneva, sans-serif">OK</font></td>
													<td width="25%">◯</td>
													<td width="26%"><font size="1" face="Verdana, Geneva, sans-serif">D</font></td>
												  </tr>
												</table></td>
											  </tr>
											  <tr>
												<td><font size="1" face="Verdana, Geneva, sans-serif">Luz do ABS</font></td>
												<td><table width="100%" border="0" cellspacing="0">
												  <tr>
													<td width="12%">◯</td>
													<td width="37%"><font size="1" face="Verdana, Geneva, sans-serif">OK</font></td>
													<td width="25%">◯</td>
													<td width="26%"><font size="1" face="Verdana, Geneva, sans-serif">D</font></td>
												  </tr>
												</table></td>
												<td><table width="100%" border="0" cellspacing="0">
												  <tr>
													<td width="12%">◯</td>
													<td width="37%"><font size="1" face="Verdana, Geneva, sans-serif">OK</font></td>
													<td width="25%">◯</td>
													<td width="26%"><font size="1" face="Verdana, Geneva, sans-serif">D</font></td>
												  </tr>
												</table></td>
												<td align="left"><font size="1" face="Verdana, Geneva, sans-serif">Alarme </font></td>
												<td align="center"><table width="100%" border="0" cellspacing="0">
												  <tr>
													<td width="12%">◯</td>
													<td width="37%"><font size="1" face="Verdana, Geneva, sans-serif">OK</font></td>
													<td width="25%">◯</td>
													<td width="26%"><font size="1" face="Verdana, Geneva, sans-serif">D</font></td>
												  </tr>
												</table></td>
												<td align="center"><table width="100%" border="0" cellspacing="0">
												  <tr>
													<td width="12%">◯</td>
													<td width="37%"><font size="1" face="Verdana, Geneva, sans-serif">OK</font></td>
													<td width="25%">◯</td>
													<td width="26%"><font size="1" face="Verdana, Geneva, sans-serif">D</font></td>
												  </tr>
												</table></td>
											  </tr>
											  <tr>
												<td><font size="1" face="Verdana, Geneva, sans-serif">Luz do Air Bag</font></td>
												<td><table width="100%" border="0" cellspacing="0">
												  <tr>
													<td width="12%">◯</td>
													<td width="37%"><font size="1" face="Verdana, Geneva, sans-serif">OK</font></td>
													<td width="25%">◯</td>
													<td width="26%"><font size="1" face="Verdana, Geneva, sans-serif">D</font></td>
												  </tr>
												</table></td>
												<td><table width="100%" border="0" cellspacing="0">
												  <tr>
													<td width="12%">◯</td>
													<td width="37%"><font size="1" face="Verdana, Geneva, sans-serif">OK</font></td>
													<td width="25%">◯</td>
													<td width="26%"><font size="1" face="Verdana, Geneva, sans-serif">D</font></td>
												  </tr>
												</table></td>
												<td align="left"><font size="1" face="Verdana, Geneva, sans-serif">Pisca Alerta</font></td>
												<td align="center"><table width="100%" border="0" cellspacing="0">
												  <tr>
													<td width="12%">◯</td>
													<td width="37%"><font size="1" face="Verdana, Geneva, sans-serif">OK</font></td>
													<td width="25%">◯</td>
													<td width="26%"><font size="1" face="Verdana, Geneva, sans-serif">D</font></td>
												  </tr>
												</table></td>
												<td align="center"><table width="100%" border="0" cellspacing="0">
												  <tr>
													<td width="12%">◯</td>
													<td width="37%"><font size="1" face="Verdana, Geneva, sans-serif">OK</font></td>
													<td width="25%">◯</td>
													<td width="26%"><font size="1" face="Verdana, Geneva, sans-serif">D</font></td>
												  </tr>
												</table></td>
											  </tr>
											  <tr>
												<td><font size="1" face="Verdana, Geneva, sans-serif">Luz do Teto / Leitura</font></td>
												<td><table width="100%" border="0" cellspacing="0">
												  <tr>
													<td width="12%">◯</td>
													<td width="37%"><font size="1" face="Verdana, Geneva, sans-serif">OK</font></td>
													<td width="25%">◯</td>
													<td width="26%"><font size="1" face="Verdana, Geneva, sans-serif">D</font></td>
												  </tr>
												</table></td>
												<td><table width="100%" border="0" cellspacing="0">
												  <tr>
													<td width="12%">◯</td>
													<td width="37%"><font size="1" face="Verdana, Geneva, sans-serif">OK</font></td>
													<td width="25%">◯</td>
													<td width="26%"><font size="1" face="Verdana, Geneva, sans-serif">D</font></td>
												  </tr>
												</table></td>
												<td align="left"><font size="1" face="Verdana, Geneva, sans-serif">Rádio / Multimidia</font></td>
												<td align="center"><table width="100%" border="0" cellspacing="0">
												  <tr>
													<td width="12%">◯</td>
													<td width="37%"><font size="1" face="Verdana, Geneva, sans-serif">OK</font></td>
													<td width="25%">◯</td>
													<td width="26%"><font size="1" face="Verdana, Geneva, sans-serif">D</font></td>
												  </tr>
												</table></td>
												<td align="center"><table width="100%" border="0" cellspacing="0">
												  <tr>
													<td width="12%">◯</td>
													<td width="37%"><font size="1" face="Verdana, Geneva, sans-serif">OK</font></td>
													<td width="25%">◯</td>
													<td width="26%"><font size="1" face="Verdana, Geneva, sans-serif">D</font></td>
												  </tr>
												</table></td>
											  </tr>
											  <tr>
												<td><font size="1" face="Verdana, Geneva, sans-serif">Fiação do Veículo</font></td>
												<td><table width="100%" border="0" cellspacing="0">
												  <tr>
													<td width="12%">◯</td>
													<td width="37%"><font size="1" face="Verdana, Geneva, sans-serif">OK</font></td>
													<td width="25%">◯</td>
													<td width="26%"><font size="1" face="Verdana, Geneva, sans-serif">D</font></td>
												  </tr>
												</table></td>
												<td><table width="100%" border="0" cellspacing="0">
												  <tr>
													<td width="12%">◯</td>
													<td width="37%"><font size="1" face="Verdana, Geneva, sans-serif">OK</font></td>
													<td width="25%">◯</td>
													<td width="26%"><font size="1" face="Verdana, Geneva, sans-serif">D</font></td>
												  </tr>
												</table></td>
												<td align="left">&nbsp;</td>
												<td align="center"><table width="100%" border="0" cellspacing="0">
												  <tr>
													<td width="12%">◯</td>
													<td width="37%"><font size="1" face="Verdana, Geneva, sans-serif">OK</font></td>
													<td width="25%">◯</td>
													<td width="26%"><font size="1" face="Verdana, Geneva, sans-serif">D</font></td>
												  </tr>
												</table></td>
												<td align="center"><table width="100%" border="0" cellspacing="0">
												  <tr>
													<td width="12%">◯</td>
													<td width="37%"><font size="1" face="Verdana, Geneva, sans-serif">OK</font></td>
													<td width="25%">◯</td>
													<td width="26%"><font size="1" face="Verdana, Geneva, sans-serif">D</font></td>
												  </tr>
												</table></td>
											  </tr>
											</table>
										</div>
									</div>									
								</div><br>
								<div class="row" style="color:#000;">
									<div class="col-sm-12">
										<div class="form-group" style="border-radius:5px; border:#000000 1px solid;">
											<table width="100%" border="0" cellspacing="0">
												<tr>
												  <td>Local da Instalação do Equipamento:</td>
												</tr>
												<tr>
												  <td>&nbsp;</td>
												</tr>
											  </table>
										</div>
									</div>
								</div>
								<div class="row" style="color:#000;">
									<div class="col-sm-12">
										<div class="form-group" style="border-radius:5px; border:#000000 1px solid;">
											<table width="100%" border="0" cellspacing="0">
												<tr>
												  <td>Serviço Realizado:</td>
												</tr>
												<tr>
												  <td>&nbsp;</td>
												</tr>
											  </table><br>
										</div>
									</div>
								</div>
								<div class="row" style="color:#000;">
									<div class="col-sm-12">
										<div class="form-group" style="border-radius:5px; border:#000000 1px solid;">
											<span><b>Informação Importante: O associado é responsavel pelo equipamento, em caso de desistência, deverá agendar para retirada do equipamento. Em caso de não devolução, será cobrado o valor de R$ 350,00 (Trezentos e Cinquenta Reais).</b></span>
										</div>
									</div>
									<div class="col-sm-12">
										<div class="form-group" style="border-radius:5px; border:#000000 1px solid;">
											<table width="100%" border="0" cellspacing="0">
												<tr>
												  <td>&nbsp;</td>
												  <td>&nbsp;</td>
												  <td align="center">&nbsp;</td>
												</tr>
												<tr>
												  <td width="10%">Nome: </td>
												  <td width="42%">___________________________________</td>
												  <td width="48%" align="center">________________________________________</td>
												  </tr>
												<tr>
												  <td>RG ou CPF: </td>
												  <td>___________________________________</td>
												  <td align="center">Assinatura</td>
												  </tr>
												</table><br>
										</div>
									</div>
								</div>
								
								
								
								
								
								
                               
                               
                            </div>
                        </div>
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
