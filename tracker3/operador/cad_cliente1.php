<?php include('conexao.php');
					$base64 = $_GET['c'];
$base = base64_decode($base64);
$cliente = explode(":", $base);
$id_cliente = $cliente[1];

?>

<!DOCTYPE html>

<html lang="en">
    <head>
           <meta charset="utf-8"/>
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
        <link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/botoes.css">
		<link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/formplugins/select2/select2.bundle.css">
        <!-- Place favicon.ico in the root directory -->
        <link rel="apple-touch-icon" sizes="180x180" href="/tracker3/app-assets/img/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/tracker3/app-assets/img/favicon/favicon-32x32.png">
        <link rel="mask-icon" href="/tracker3/app-assets/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
		<link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/fa-solid.css">
		
		
    </head>
    <body class="mod-bg-1 nav-function-fixed">
        <!-- DOC: script to save and load page settings -->
      
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

					$id_empresa = 	'1361';
					$cons_limite_veic = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='$id_empresa'");
						if(mysqli_num_rows($cons_limite_veic) > 0){
							while ($resp_limite = mysqli_fetch_assoc($cons_limite_veic)) {
							$limite_veiculos = 	$resp_limite['limite_veiculos'];
							
							$pj_bank = 	$resp_limite['pj_bank'];
							$asaas = 	$resp_limite['asaas'];

						}}
						
					
					
$base_cliente = 'id_cliente:'.$id_cliente;
$base_cliente = base64_encode($base_cliente);
					
					$cons_veic = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='$id_empresa'");
					$total_veic = mysqli_num_rows($cons_veic);
					
					$botao_veiculo_add = '<a href="novo_veiculo.php?c='.$base_cliente.'"><button type="button" class="btn btn-success btn-sm"><i class="fal fa-car"></i> Novo Veículo</button></a>';
					$botao_contrato = '<a href="gerar_contrato.php?c='.$base_cliente.'"><button type="button" class="btn btn-dark btn-sm"><i class="fal fa-file"></i> Gerar Contrato</button></a>';
					



$cons_cliente = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
	if(mysqli_num_rows($cons_cliente) > 0){
while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
$nome_cliente = 	$resp_cliente['nome_cliente'];
$doc_cliente = 	$resp_cliente['doc_cliente'];
$rg_cliente	 = 	$resp_cliente['rg_cliente'];
$data_nascimento = 	$resp_cliente['data_nascimento'];
$data_nascimento = date('d/m/Y', strtotime("$data_nascimento"));
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
$status = 	$resp_cliente['status'];
$email = 	$resp_cliente['email'];
$indicacao = 	$resp_cliente['indicacao'];
$tipo_cliente = $resp_cliente['tipo_cliente'];
$nr_contrato = $resp_cliente['nr_contrato'];
$pacote_cliente = $resp_cliente['pacote'];
$forma_pagamento = $resp_cliente['forma_pagamento'];
$data_vencimento = $resp_cliente['data_vencimento'];
$vendedor = $resp_cliente['vendedor'];
$assinatura = $resp_cliente['assinatura'];
$id_asaas = $resp_cliente['id_asaas'];
$dias_bloqueio = $resp_cliente['dias_bloqueio'];
$migrado = $resp_cliente['migrado'];
$id_empresa = $resp_cliente['id_empresa'];
$id_cliente_pai = $resp_cliente['id_cliente_pai'];
	}}
	

if($id_cliente_pai == '1361'){
	$nome_cliente_pai = 'RMB';
}
if($id_cliente_pai != '1361'){
	$cons_cliente_pai = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente_pai'");
		if(mysqli_num_rows($cons_cliente_pai) > 0){
			while ($resp_cliente_pai = mysqli_fetch_assoc($cons_cliente_pai)) {
			$nome_cliente_pai = $resp_cliente_pai['nome_cliente'];
		}}
}
	

$base64 = 'id_cliente:'.$id_cliente.'';
$base64 = base64_encode($base64);

if($asaas == 'SIM'){
	
	if($id_asaas == '0'){
		$botao_carne_asaas = '<button class="dropdown-item" type="button" data-toggle="modal" data-target="#cad_asaas"><i class="fal fa-barcode-read"></i> Gerar Carnê Asaas</button>';
		$botao_recorrencia_asaas = '<button class="dropdown-item" type="button" data-toggle="modal" data-target="#cad_asaas"><i class="fal fa-barcode-read"></i> Recorrência Asaas Boleto</button>';
		$botao_recorrencia_asaas_card = '<button class="dropdown-item" type="button" data-toggle="modal" data-target="#cad_asaas"><i class="fal fa-barcode-read"></i> Assinatura Asaas</button>';
		$botao_boleto_asaas = '<button class="dropdown-item" type="button" data-toggle="modal" data-target="#cad_asaas"><i class="fal fa-barcode-read"></i> Boleto Avulso</button>';
	}
	else if($id_asaas == ''){
		$botao_carne_asaas = '<button class="dropdown-item" type="button" data-toggle="modal" data-target="#cad_asaas"><i class="fal fa-barcode-read"></i> Gerar Carnê Asaas</button>';
		$botao_recorrencia_asaas = '<button class="dropdown-item" type="button" data-toggle="modal" data-target="#cad_asaas"><i class="fal fa-barcode-read"></i> Recorrência Asaas Boleto</button>';
		$botao_recorrencia_asaas_card = '<button class="dropdown-item" type="button" data-toggle="modal" data-target="#cad_asaas"><i class="fal fa-barcode-read"></i> Assinatura Asaas</button>';
		$botao_boleto_asaas = '<button class="dropdown-item" type="button" data-toggle="modal" data-target="#cad_asaas"><i class="fal fa-barcode-read"></i> Boleto Avulso</button>';
	} else {
		$botao_carne_asaas = '<a href="add/add_cliente_asaas.php?c='.$base64.'&tipo=carne"><button class="dropdown-item" type="button" data-toggle="modal" data-target="#carregar"><i class="fal fa-barcode-read"></i> Gerar Carnê Asaas</button></a>';
		$botao_recorrencia_asaas = '<a href="add/add_cliente_asaas.php?c='.$base64.'&tipo=recorrencia"><button class="dropdown-item" type="button"><i class="fal fa-barcode-read"></i> Recorrência Asaas Boleto</button></a>';
		$botao_recorrencia_asaas_card = '<a href="add/add_cliente_asaas.php?c='.$base64.'&tipo=cartao"><button class="dropdown-item" type="button"><i class="fal fa-barcode-read"></i> Assinatura Asaas</button></a>';
		$botao_boleto_asaas = '<a href="add/add_cliente_asaas.php?c='.$base64.'&tipo=boleto"><button class="dropdown-item" type="button" data-toggle="modal" data-target="#carregar"><i class="fal fa-barcode-read"></i> Boleto Avulso</button></a>';
	}
	
	
	
}

if($asaas == 'NAO'){
	$botao_carne_asaas = '';
	$botao_recorrencia_asaas = '';
	$botao_recorrencia_asaas_card = '';
	$botao_boleto_asaas = '';
}

if($pj_bank == 'SIM'){
	
	$botao_recorrencia_pjb = '<a href="gerar_recorrencia_pjb.php?c='.$base64.'"><button class="dropdown-item" type="button"><i class="fal fa-barcode-read"></i> Recorrência PJ Bank Boleto</button></a>';
	//$botao_recorrencia_pjb_card = '<a href="gerar_recorrencia_pjb_card.php?c='.$base64.'"><button class="dropdown-item" type="button"><i class="fal fa-credit-card"></i> Recorrência PJ Bank Cartão</button></a>';
	$botao_recorrencia_pjb_card = '';
	$botao_boleto_pjb = '<a href="gerar_boleto_pjb.php?c='.$base64.'"><button class="dropdown-item" type="button"><i class="fal fa-barcode-read"></i> Boleto Avulso</button></a>';
}
if($pj_bank == 'NAO'){

	$botao_recorrencia_pjb = '<button class="dropdown-item" data-toggle="modal" data-target="#pjbank" type="button"><i class="fal fa-barcode-read"></i> Recorrência PJ Bank Boleto</button>';
	$botao_recorrencia_pjb_card = '';
	$botao_boleto_pjb = '';
}
	
if($migrado == 'NAO'){
	$bt_migra = '<a href="migrar.php?id_cliente='.$id_cliente.'"><button type="button" class="btn btn-dark btn-sm">Migrar</button></a>';
}	
	
$cons_s = mysqli_query($conn,"SELECT * FROM status WHERE id_status='$status'");
	if(mysqli_num_rows($cons_s) > 0){
while ($resp_s = mysqli_fetch_assoc($cons_s)) {
$status3 = 	$resp_s['status'];
$cor = 	$resp_s['cor'];
$img_status = 	$resp_s['img_status'];
$img_lista = 	$resp_s['img_lista'];
}}

$cons_veiculos2 = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE id_cliente='$id_cliente' AND status='1'");
$total_veiculos = mysqli_num_rows($cons_veiculos2);

if($total_veiculos >= 1){
	$botao_del = '<button class="dropdown-item" type="button" data-toggle="modal" data-target="#Excluir_no"><i class="fas fa-trash-alt"></i> Excluir Cliente</button>';
}
if($total_veiculos <= 0){
	$botao_del = '<button class="dropdown-item" type="button" data-toggle="modal" data-target="#Excluir"><i class="fas fa-trash-alt"></i> Excluir Cliente</button>';
}


if($status == 1){
	$status5 = '<h3><span class="badge" style="background-color:#009900;color:#FFF">'.$status3.'</span></h3>';
}
if($status == 2){
	$status5 = '<h3><span class="badge badge-dark">'.$status3.'</span></h3>';
}
if($status == 4){
	$status5 = '<h3><span class="badge badge-dark">'.$status3.'</span></h3>';
}
if($status == 5){
	$status5 = '<h3><span class="badge badge-dark">'.$status3.'</span></h3>';
}
if($status == 7){
	$status5 = '<h3><span class="badge badge-info">'.$status3.'</span></h3>';
}
if($status == 11){
	$status5 = '<h3><span class="badge badge-info">'.$status3.'</span></h3>';
}
if($status == 13){
	$status5 = '<h3><span class="badge badge-info">'.$status3.'</span></h3>';
}
if($status == 99){
	$status5 = '<h3><span class="badge badge-warning">'.$status3.'</span></h3>';
}

$cons_user = mysqli_query($conn,"SELECT * FROM usuarios WHERE id_cliente='$id_cliente'");
if(mysqli_num_rows($cons_user) <= 0){
	$usuario = '';
	$msn = '<font color="#990000"><i class="fal fa-user"></i> Cliente sem acesso cadastrado</font>';
}else{

while ($result_user = mysqli_fetch_assoc($cons_user)) {
$id_usuarios = $result_user['id_usuarios'];
	$usuario = $result_user['usuario'];
	$usuario1 = explode("@", $usuario);
	$usuario = $usuario1[0];
	$permite_bloqueio = $result_user['permite_bloqueio'];
	$msn = '<font color="#009900"><i class="fal fa-user"></i> Acesso já cadastrado</font>';
	if($permite_bloqueio == 'SIM'){
		$block = 'checked';
	} else {
		$block = '';
	}
}}

if($id_empresa == '1361'){
	$loja = ' - LOJA HORIZONTE';
}
if($id_empresa == '1362'){
	$loja = ' - LOJA FORTALEZA';
}
	
$base64 = 'id_cliente:'.$id_cliente.'';
$base64 = base64_encode($base64);
					?>
					<div class="modal fade" id="limite" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-sm modal-dialog-centered">
							<div class="modal-content bg-warning text-black">
								<div class="modal-body text-center">
									<h3 class="text-black mb-15"><i class="fa fa-exclamation-triangle"></i> ATENÇÃO</h3>
									<p>LIMITE DE VEÍCULOS ATINGIDO.</p>
									<p>Contate o setor comercial para liberação.</p>
									<button type="button" class="btn btn-dark" data-dismiss="modal">Ok</button>
								</div>
							</div>
						</div>
					</div>
                    <!-- END Page Header -->
                    <!-- BEGIN Page Content -->
                    <!-- the #js-page-content id is needed for some plugins to initialize -->
					
                    <main id="js-page-content" role="main" class="page-content">
					<form name="forml" id="forml">
						<div class="row">
                            <div class="col-xl-8">
								<div class="subheader">
									<h1 class="subheader-title">
										<i class='subheader-icon fal fa-user'></i> <?php echo $nome_cliente?>
										<small>
											CLIENTE PAI: <?php echo $nome_cliente_pai?>
										</small>
									</h1>
								</div>
							</div>
							<div class="col-xl-4 text-right">
								 <div class="btn-group">
									<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
										Opções
									</button>
									<div class="dropdown-menu dropdown-menu-lg-right">
										<a href="editar_cliente.php?c=<?php echo $base64?>"><button class="dropdown-item" type="button" data-toggle="modal" data-target="#carregar"><i class="fal fa-edit"></i> Editar Cadastro</button></a>
										<button class="dropdown-item" type="button" data-toggle="modal" data-target="#alterar_status"><i class="fas fa-user"></i> Alterar Status</button>
										<?php echo $botao_del?>
									</div>
								</div>
							</div>
						</div>
                        
                        
                        <div class="row">
                            <div class="col-md-2">
								<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
									<a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">
										<i class="fal fa-user"></i>
										<span class="hidden-sm-down ml-1"> Dados Pessoais</span>
									</a>
									<a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">
										<i class="fal fa-car"></i>
										<span class="hidden-sm-down ml-1"> Veículos</span>
									</a>
									<a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">
										<i class="fal fa-dollar-sign"></i>
										<span class="hidden-sm-down ml-1"> Faturas</span>
									</a>
									<a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#ordens" role="tab" aria-controls="ordens" aria-selected="false">
										<i class="fal fa-file-edit"></i>
										<span class="hidden-sm-down ml-1"> Ordens de Serviço</span>
									</a>
									<a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#crm" role="tab" aria-controls="crm" aria-selected="false">
										<i class="fal fa-comments"></i>
										<span class="hidden-sm-down ml-1"> CRM/Atendimentos</span>
									</a>
									<a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#acesso" role="tab" aria-controls="acesso" aria-selected="false">
										<i class="fal fa-sign-in-alt"></i>
										<span class="hidden-sm-down ml-1"> Acesso Web / App</span>
									</a>
									
								</div>
                            </div>
							
							<div class="col-md-10">
                                <div id="panel-1" class="panel">
                                    
                                    <div class="panel-container show">
                                        <div class="panel-content">
											<div class="tab-content" id="v-pills-tabContent">
												<div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
													<div class="row">
														<div class="col-md-8">
															<h3>DADOS PESSOAIS</h3>
														</div>
														<div class="col-md-4">
															<?php echo $bt_migra?>
														</div>
													</div>
													<hr style="border:#999999 1px solid">
													<div class="row">
														<div class="col-md-4">
															<div class="form-group">
																<label>Nome Completo:</label>
																<input type="text" name="nome_cliente" id="nome_cliente" class="form-control text-uppercase" value="<?php echo $nome_cliente?>" readonly>
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label>CPF/CNPJ:</label>
																<input type="text" name="doc_cliente" id="doc_cliente" class="form-control" value="<?php echo $doc_cliente?>" readonly>
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label>RG/Inscrição Estadual:</label>
																<input type="text" name="rg_cliente" id="rg_cliente" class="form-control"  value="<?php echo $rg_cliente?>" readonly>
															</div>
														</div>
													</div><br>
													<div class="row">
														<div class="col-md-4">
															<div class="form-group">
																<label>Data Nascimento / Fundação:</label>
																<input type="text" name="data_nascimento" id="data_nascimento" class="form-control"  value="<?php echo $data_nascimento?>" readonly>
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label>E-mail:</label>
																<input type="text" name="email" id="email" class="form-control text-lowercase" autocomplete="off"  value="<?php echo $email?>" readonly>
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label>CEP:</label>
																<input type="text" name="cep" id="cep" class="form-control"  value="<?php echo $cep?>" readonly>
															</div>
														</div>
													</div><br>
													<div class="row">
														<div class="col-md-4">
															<div class="form-group">
																<label>Endereço:</label>
																<input type="text" name="endereco" id="endereco" class="form-control text-uppercase"  value="<?php echo $endereco?>" readonly>
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label>Número:</label>
																<input type="text" name="numero" id="numero" class="form-control"   value="<?php echo $numero?>" readonly>
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label>Complemento:</label>
																<input type="text" name="complemento" id="complemento" class="form-control text-uppercase"  value="<?php echo $complemento?>" readonly>
															</div>
														</div>
													</div><br>
													<div class="row">
														<div class="col-md-4">
															<div class="form-group">
																<label>Bairro:</label>
																<input type="text" name="bairro" id="bairro" class="form-control text-uppercase"  value="<?php echo $bairro?>" readonly>
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label>Cidade:</label>
																<input type="text" name="cidade" id="cidade" class="form-control text-uppercase"   value="<?php echo $cidade?>" readonly>
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label>Estado (UF):</label>
																<input type="text" name="estado" id="estado" class="form-control text-uppercase"  value="<?php echo $estado?>" readonly>
															</div>
														</div>
													</div><br>
													<div class="row">
														<div class="col-md-4">
															<div class="form-group">
																<label>Telefone Residencial:</label>
																<input type="text" name="telefone_residencial" id="telefone_residencial" class="form-control"  value="<?php echo $telefone_residencial?>" readonly>
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label>Telefone Celular (Principal):</label>
																<input type="text" name="telefone_celular" id="telefone_celular" class="form-control" value="<?php echo $telefone_celular?>" readonly>
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label>Outro Telefone:</label>
																<input type="text" name="telefone_outros" id="telefone_outros" class="form-control"  value="<?php echo $telefone_outros?>" readonly>
															</div>
														</div>
													</div><br>
													<div class="row">
														<div class="col-md-4">
															<div class="form-group">
																<label>Bloqueio Inadimplência:</label>
																<input type="text" name="bloqueio" id="bloqueio" class="form-control"  value="<?php echo $dias_bloqueio?> dias" readonly>
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label>Cliente Pai:</label><br>
																<input type="text" name="nome_cliente_pai" id="nome_cliente_pai" class="form-control"  value="<?php echo $nome_cliente_pai?>" readonly>
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label>Status do Cliente:</label><br>
																<?php echo $status5?>
															</div>
														</div>
													</div><br>
												</div>
												
												<div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
													<div class="row">
														<div class="col-md-6">
															<h3>VEÍCULOS</h3>
														</div>
														<div class="col-md-6 text-right">
															<?php echo $botao_contrato?>
															<?php echo $botao_veiculo_add?>
														</div>
													</div>
													<hr style="border:#999999 1px solid">
													<div class="row">
														<div class="col-md-12">
															<?php
																$result_veiculo = "SELECT * FROM veiculos_clientes WHERE id_cliente='$id_cliente' ORDER BY id_veiculo ASC";
																$resultado_veiculo = mysqli_query($conn, $result_veiculo);


																//Verificar se encontrou resultado na tabela "usuarios"
																if(($resultado_veiculo) AND ($resultado_veiculo->num_rows != 0)){
															?>
															<table class="table table-sm table-hover">
																<thead>
																	<tr>
																		<th>#</th>
																		<th>Veículo</th>
																		<th>Ano</th>
																		<th>Plano</th>
																		<th>Valor Mensal</th>
																		<th>Recorrência</th>
																		<th>Status</th>
																		<th class="text-right">Ações</th>
																	</tr>
																</thead>
																<tbody>
															<?php
								while($row_veiculo = mysqli_fetch_assoc($resultado_veiculo)){
								$status_veic = $row_veiculo['status'];
								$forma_pagamento = $row_veiculo['forma_pagamento'];
								$id_veiculo = $row_veiculo['id_veiculo'];
								$data_cadastro_veic = $row_veiculo['data_cadastro'];
								$data_cadastro_veic = date('d/m/Y', strtotime("$data_cadastro_veic"));
								$tipo_veiculo = $row_veiculo['tipo_veiculo'];
								$chassi = $row_veiculo['chassi'];
								$combustivel = $row_veiculo['combustivel'];
								$renavan = $row_veiculo['renavan'];
								$ano_veiculo = $row_veiculo['ano_veiculo'];
								$cor_veiculo = $row_veiculo['cor_veiculo'];
								$imei = $row_veiculo['imei'];
								$chip = $row_veiculo['chip'];
								$iccid = $row_veiculo['iccid'];
								$deviceid = $row_veiculo['deviceid'];
								$operadora = $row_veiculo['operadora'];
								$fornecedor_chip = $row_veiculo['fornecedor_chip'];
								$placa = $row_veiculo['placa'];
								$modelo_equip = $row_veiculo['modelo_equip'];
								$bloqueio_inst = $row_veiculo['bloqueio_inst'];
								$tipo_bloqueio = $row_veiculo['tipo_bloqueio'];
								$local_equipamento = $row_veiculo['local_equipamento'];
								$foto_local = $row_veiculo['foto_local'];
								$foto_veiculo = $row_veiculo['foto_veiculo'];
								$recorrencia_veic = $row_veiculo['recorrencia'];
								$pacote = $row_veiculo['pacote'];
								$vendedor = $row_veiculo['vendedor'];
								$valor_mensal = $row_veiculo['valor_mensal'];
								$valor_mensal = number_format($valor_mensal, 2, ",", ".");
								
								
								$cons_vendedor = mysqli_query($con,"SELECT * FROM vendedores WHERE id_vendedor='$vendedor'");
										if(mysqli_num_rows($cons_vendedor) > 0){
									while ($resp_tipo = mysqli_fetch_assoc($cons_vendedor)) {
										$nome_vendedor = 	$resp_tipo['nome_vendedor'];
										$id_vendedor = 	$resp_tipo['id_vendedor'];
									}}

								$cons_stat1 = mysqli_query($con,"SELECT * FROM status WHERE id_status='$status_veic'");
								if(mysqli_num_rows($cons_stat1) > 0){
							while ($resp_stat1 = mysqli_fetch_assoc($cons_stat1)) {
							$status_veic1 = 	$resp_stat1['status'];
							}}
							
							$cons_pacote = mysqli_query($con,"SELECT * FROM pacotes WHERE id_pacote='$pacote'");
								if(mysqli_num_rows($cons_pacote) > 0){
							while ($resp_pac = mysqli_fetch_assoc($cons_pacote)) {
							$pacote1 = 	$resp_pac['pacote'];
							}}
							
							$cons_tipo = mysqli_query($con,"SELECT * FROM veiculos_tipos WHERE categoria='$tipo_veiculo' ORDER BY categoria DESC LIMIT 1");
								if(mysqli_num_rows($cons_tipo) > 0){
							while ($resp_tipo = mysqli_fetch_assoc($cons_tipo)) {
							$tipo_veiculo1 = 	$resp_tipo['tipo_veiculo'];
							}}
											
							if($status_veic == 1){
							$status_veic2 = '<h5><span class="badge" style="background-color:#009900;color:#FFF">ATIVO</span></h5>';
							} else if($status_veic == 4){
							$status_veic2 = '<h5><span class="badge badge-dark">CANCELADO</span></h5>';
							} else if($status_veic == 5){
							$status_veic2 = '<h5><span class="badge badge-success">CANCELADO</span></h5>';
							} else if($status_veic == 11){
							$status_veic2 = '<h5><span class="badge badge-info">NOVO</span></h5>';
							} else if($status_veic == 7){
							$status_veic2 = '<h5><span class="badge badge-info">AGENDADO</span></h5>';
							} else if($status_veic == 99){
							$status_veic2 = '<h5><span class="badge badge-warning">PENDENTE</span></h5>';
							} else {
							$status_veic2 = '<h5><span class="badge badge-dark">'.$status_veic1.'</span></h5>';
								}
							
							$data_agora = date('Y-m-d H:i:s');
							$data_agora = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_agora)));

							$data_inicial_12 = date('Y-m-d H:i:s', strtotime('-5 minutes', strtotime($data_agora)));
							
							$cons_device = mysqli_query($con,"SELECT * FROM tc_devices WHERE id='$deviceid'");
								if(mysqli_num_rows($cons_device) > 0){
							while ($resp_device = mysqli_fetch_assoc($cons_device)) {
							$lastupdate = 	$resp_device['lastupdate'];
							$lastupdate1 = date('d/m/Y H:i:s', strtotime('-3 hour', strtotime($lastupdate)));
							if($lastupdate <= $data_inicial_12){
								$conect = '<h4><span class="badge" style="background-color:#CD5C5C;color:#FFF"><i class="fas fa-wifi"></i> OFFLINE</span></h4>';
								$icon_conect = '<h4><span class="badge" style="background-color:#CD5C5C;color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" title="Offline" data-content="Dispositivo sem comunicação desde '.$lastupdate1.'" data-original-title="ONLINE"><i class="fas fa-wifi"></i></span></h4>';
							} 
							if($lastupdate > $data_inicial_12){
								$conect = '<h4><span class="badge" style="background-color:#009900;color:#FFF"><i class="fas fa-wifi"></i> ONLINE</span></h4>';
								$icon_conect = '<h4><span class="badge" style="background-color:#009900;color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" title="ONLINE" data-content="Data/hora: '.$lastupdate1.'" data-original-title="OFFLINE"><i class="fas fa-wifi"></i></span></h4>';	
							}
							if($lastupdate == '' or $lastupdate == null){
								$conect = '<h4><span class="badge" style="background-color:#CD5C5C;color:#FFF"><i class="fas fa-wifi"></i> OFFLINE</span></h4>';
								$icon_conect = '<h4><span class="badge" style="background-color:#999;color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" title="Offline" data-content="Dispositivo sem comunicação" data-original-title="O"><i class="fas fa-wifi"></i></span></h4>';
							}
							}}
							
							$base64 = 'id_cliente:'.$id_cliente.'&id_veiculo:'.$id_veiculo.'';
							$base64 = base64_encode($base64);
							
							$device_id = 'deviceid:'.$deviceid.'';
							$device_id = base64_encode($device_id);
							
															?>
														<tr>
															<th><?php echo $icon_conect; ?></th>
															<th><?php echo $placa?> - <?php echo $row_veiculo['marca_veiculo']; ?> / <?php echo $row_veiculo['modelo_veiculo']; ?></th>
															<td><?php echo $row_veiculo['ano_veiculo']; ?></td>
															<td><?php echo $pacote1 ?></td>
															<td>R$ <?php echo $valor_mensal ?></td>
															<td><?php echo $recorrencia_veic ?></td>
															<td><?php echo $status_veic2 ?></td>
															<td class="text-right">
															 <div class="btn-group">
																<button type="button" class="btn btn-secondary btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ações</button>
																<div class="dropdown-menu dropdown-menu-right">
																	<button class="dropdown-item" type="button" data-toggle="modal" data-target="#veic<?php echo $id_veiculo?>"><i class="fas fa-car"></i> Detalhes</button>
																	<a href="editar_veiculo.php?c=<?php echo $base64?>"><button class="dropdown-item" type="button"><i class="fas fa-edit"></i> Editar Veículo</button></a>
																	<a href="nova_os.php?c=<?php echo $base64?>"><button class="dropdown-item" type="button"><i class="fas fa-wrench"></i> Gerar Ordem de Serviço</button></a>
																	<a href="contrato_cliente_print.php?c=<?php echo $base64?>" target="_blank"><button class="dropdown-item" type="button"><i class="fas fa-print"></i> Imprimir Contrato</button></a>
																	<a href="grid_device.php?c=<?php echo $device_id?>"><button class="dropdown-item" type="button"><i class="fal fa-map-marker-alt"></i> Abrir no mapa</button></a>
																	<button class="dropdown-item" type="button" data-toggle="modal" data-target="#del<?php echo $id_veiculo?>"><i class="fas fa-trash-alt"></i> Excluir Veículo</button>
																</div>
															</div>

															</td>
														</tr>
										<div class="modal fade" id="del<?php echo $id_veiculo?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
											<div class="modal-dialog modal-dialog-centered">
												<div class="modal-content">
													<div class="modal-header bg-danger text-white">
														<h4 class="modal-title" id="myLargeModalLabel" style="color:#FFF;">EXCLUIR VEÍCULO!</h4>
														<button type="button" class="close text-white" data-dismiss="modal" aria-hidden="true">×</button>
													</div>
													<div class="modal-body">
														<b>EXCLUIR VEÍCULO?</b><BR />
														<?php echo $placa?> - <?php echo $row_veiculo['marca_veiculo']; ?> / <?php echo $row_veiculo['modelo_veiculo']; ?><br />
														<p>Esta ação é irreverssível.</p>
														Deseja prosseguir?
													</div>
													<div class="modal-footer">
														 <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
														 <a href="del_veiculo.php?id_veiculo=<?php echo $id_veiculo?>&id_cliente=<?php echo $id_cliente?>&deviceid=<?php echo $deviceid?>"><button type="button" class="btn btn-danger">Excluir</button></a>
													</div>
												</div>
											</div>
										</div>			
											
														
														
										<div class="modal fade default-example-modal-right" id="veic<?php echo $id_veiculo?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-right  modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title h4">DETALHES DO VEÍCULO</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="card mb-5" style="border:#ccc 1px solid;">
                                                                <div class="card-body p-3">
																	<h4><span class="badge badge-dark"><i class="fas fa-car"></i> DADOS DO VEÍCULO</span></h4><br>
																	<div class="row">
																		<div class="col-md-4">
																			<label>Data Cadastro:</label><br>
																			<span ><b><?php echo $data_cadastro_veic?></b></span>
																		</div>
																		<div class="col-md-4">
																			<label>Placa:</label><br>
																			<span ><b><?php echo $placa?></b></span>
																		</div>
																		<div class="col-md-4">
																			<label>Veículo:</label><br>
																			<span><b><?php echo $row_veiculo['marca_veiculo'];?> / <?php echo $row_veiculo['modelo_veiculo'];?></b></span>
																		</div>
																	</div><br>
																	<div class="row">
																		<div class="col-md-4">
																			<label>Ano:</label><br>
																			<span ><b><?php echo $ano_veiculo?>/<?php echo $row_veiculo['ano_modelo'];?></b></span>
																		</div>
																		<div class="col-md-4">
																			<label>Combustível:</label><br>
																			<span ><b><?php echo $combustivel?></b></span>
																		</div>
																		<div class="col-md-4">
																			<label>Tipo:</label><br>
																			<span ><b><?php echo $tipo_veiculo1?></b></span>
																		</div>
																	</div><br>
																	<div class="row">
																		<div class="col-md-4">
																			<label>Chassi:</label><br>
																			<span ><b><?php echo $chassi?></b></span>
																		</div>
																		<div class="col-md-4">
																			<label>Renavam:</label><br>
																			<span ><b><?php echo $renavan?></b></span>
																		</div>
																		<div class="col-md-4">
																			<label>Cor:</label><br>
																			<span ><b><?php echo $cor_veiculo?></b></span>
																		</div>
																	</div><br>
																	<div class="row">
																		<div class="col-md-4">
																			<label>Bloqueio Instalado:</label><br>
																			<span ><b><?php echo $bloqueio_inst?></b></span>
																		</div>
																		<div class="col-md-4">
																			<label>Tipo Bloqueio:</label><br>
																			<span ><b><?php echo $tipo_bloqueio?></b></span>
																		</div>
																		<div class="col-md-4">
																			<label>Local Equipamento:</label><br>
																			<span ><b><?php echo $local_equipamento?></b></span>
																		</div>
																	</div>
                                                                </div>
                                                            </div>
                                                            <div class="card mb-5" style="border:#ccc 1px solid;">
                                                                <div class="card-body p-3">
																	<h4><span class="badge badge-dark"><i class="fas fa-mobile"></i> DADOS DO EQUIPAMENTO</span></h4><br>
																	<div class="row">
																		<div class="col-md-4">
																			<label>Modelo:</label><br>
																			<span ><b><?php echo $modelo_equip?></b></span>
																		</div>
																		<div class="col-md-4">
																			<label>IMEI:</label><br>
																			<span ><b><?php echo $imei?></b></span>
																		</div>
																		<div class="col-md-4">
																			<label>Linha M2M:</label><br>
																			<span><b><?php echo $chip;?> </b></span>
																		</div>
																	</div><br>
																	<div class="row">
																		<div class="col-md-4">
																			<label>Operadora:</label><br>
																			<span ><b><?php echo $operadora?></b></span>
																		</div>
																		<div class="col-md-4">
																			<label>Fornecedor M2M:</label><br>
																			<span ><b><?php echo $fornecedor_chip?></b></span>
																		</div>
																		<div class="col-md-4">
																			<label>ICCID:</label><br>
																			<span ><b><?php echo $iccid?></b></span>
																		</div>
																	</div><br>
																	<div class="row">
																		<div class="col-md-4">
																			<label>Status:</label><br>
																			<span ><b><?php echo $conect?></b></span>
																		</div>
																		<div class="col-md-4">
																			<label>Data Servidor:</label><br>
																			<span ><b><?php echo $lastupdate1?></b></span>
																		</div>
																	</div><br>
                                                                </div>
                                                            </div>
															<div class="card mb-5" style="border:#ccc 1px solid;">
                                                                <div class="card-body p-3">
																	<h4><span class="badge badge-dark"><i class="fas fa-dollar-sign"></i> DADOS FINANCEIROS</span></h4><br>
																	<div class="row">
																		<div class="col-md-3">
																			<label>Plano Pacote:</label><br>
																			<span ><b><?php echo $pacote1?></b></span>
																		</div>
																		<div class="col-md-3">
																			<label>Valor Mensal:</label><br>
																			<span><b>R$ <?php echo $valor_mensal?></b></span>
																		</div>
																		<div class="col-md-3">
																			<label>Forma de Pagamento:</label><br>
																			<span><b><?php echo $forma_pagamento;?> </b></span>
																		</div>
																		<div class="col-md-3">
																			<label>Recorrência:</label><br>
																			<span><b><?php echo $recorrencia_veic;?> </b></span>
																		</div>
																	</div><br>
																	<div class="row">
																		<div class="col-md-3">
																			<label>Vendedor:</label><br>
																			<span ><b><?php echo $nome_vendedor?></b></span>
																		</div>
																		
																	</div><br>
                                                                </div>
                                                            </div>
														</div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>				
													
														
														
										
										
										
										
													<?php
													}?>
															</tbody>
														</table>
														<?php
													} else {
														echo "<div class='alert alert-dark text-center' role='alert'>Nenhum Veículo encontrado!</div>";
													}
													?>
														</div>
													</div>
												</div>
												<div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
													<div class="row">
														<div class="col-md-6">
															<h3>FATURAS</h3>
														</div>
														<div class="col-md-6 text-right">
															<div class="btn-group">
																<button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fal fa-bars"></i></button>
																<div class="dropdown-menu dropdown-menu-right">
																	<span class="dropdown-item text-center"><h5><B>-- OPÇÕES PJ BANK --</B></h5></span>
																	<?php echo $botao_recorrencia_pjb?>
																	<?php echo $botao_recorrencia_pjb_card?>
																	<?php echo $botao_boleto_pjb?>
																	
																	<span class="dropdown-item text-center"><h5><B>-- OPÇÕES ASAAS --</B></h5></span>


																	<?php echo $botao_recorrencia_asaas_card?>
																	<?php echo $botao_boleto_asaas?>
																	
																	
																	
																</div>
															</div>
														</div>
													</div>
													<hr style="border:#999999 1px solid"><br>
													<div class="row">
                                                        <?php
											
											$result_fatura = "SELECT * FROM contas_receber WHERE id_cliente='$id_cliente' ORDER BY data_vencimento DESC LIMIT 15";
											$resultado_fatura = mysqli_query($conn, $result_fatura);


											//Verificar se encontrou resultado na tabela "usuarios"
											if(($resultado_fatura) AND ($resultado_fatura->num_rows != 0)){
										?>
										<table class="table table-sm table-hover">
											<thead>
												<tr>
													
													<th>Data Vencimento</th>
													<th>Forma de Pagamento</th>
													<th>Tipo Cobrança</th>
													<th>Valor</th>
													<th>Tipo Documento</th>
													<th>Status</th>
													<th>Ações</th>
												</tr>
											</thead>
											<tbody>
										<?php
											while($row_fatura = mysqli_fetch_assoc($resultado_fatura)){
											$data_emissao = $row_fatura['data_emissao'];
											$data_emissao = date('d/m/Y', strtotime("$data_emissao"));
											$data_vencimento = $row_fatura['data_vencimento'];
											$data_vencimento1 = date('d/m/Y', strtotime("$data_vencimento"));
											$data_pagamento = $row_fatura['data_pagamento'];
											
											$nr_banco = $row_fatura['nr_banco'];
											$valor_bruto = $row_fatura['valor_bruto'];
											$valor_bruto = number_format($valor_bruto, 2, ",", ".");
											$valor_pago = $row_fatura['valor_pago'];
											$valor_pago = number_format($valor_pago, 2, ",", ".");
											$especie = $row_fatura['especie'];
											$status_conta = $row_fatura['status'];
											$id_conta = $row_fatura['id_conta'];
											$class_financeira = $row_fatura['class_financeira'];
											$duplicata = $row_fatura['duplicata'];
											$banco = $row_fatura['banco'];
											$id_recorrencia = $row_fatura['id_recorrencia'];
											$forma_pagamento_conta = $row_fatura['forma_pagamento'];
											$user_baixa = $row_fatura['user_baixa'];
											$obs_baixa = $row_fatura['obs_baixa'];
											$linha_digitavel = $row_fatura['linha_digitavel'];
											$descricao = $row_fatura['descricao'];
											$link_boleto = $row_fatura['link_boleto'];
											$nosso_numero = $row_fatura['nosso_numero'];
											$id_carne = $row_fatura['id_carne'];
											
											$data_hj = date('Y-m-d');
											
											if($data_pagamento == ''){
												$data_pagamento1 = '';
											}
											else if($data_pagamento == '0000-00-00'){
												$data_pagamento1 = '';
											}
											else{
												$data_pagamento1 = date('d/m/Y', strtotime("$data_pagamento"));
											}
											
											if($id_carne != ''){
												$botao_carne = '<a href="https://www.asaas.com/installment/paymentBook/'.$id_carne.'" target="_blank"><button type="button" class="btn btn-primary btn-xs"><i class="fal fa-print"></i> Imprimir Carnê</button></a>';
												
											}
											
											$cons_class = mysqli_query($conn,"SELECT * FROM categorias_contas_receber WHERE id_categoria='$class_financeira'");
												if(mysqli_num_rows($cons_class) > 0){
													while ($resp_especie = mysqli_fetch_assoc($cons_class)) {
													$categoria	 = 	$resp_especie['categoria'];
													//$categoria = utf8_encode($categoria);
												}}
											
											$cons_especie = mysqli_query($conn,"SELECT * FROM tipo_pagamento WHERE id_tipo='$especie'");
												if(mysqli_num_rows($cons_especie) > 0){
													while ($resp_especie = mysqli_fetch_assoc($cons_especie)) {
													$especie1	 = 	$resp_especie['tipo_pagamento'];
												}}
												
											if($banco == 1){
												$banco_emissor = 'PJ BANK';
												$link_excluir = 'delete_boleto_pjb.php?id_conta='.$id_conta.'&id_cliente='.$id_cliente.'&id_empresa='.$id_empresa.'&pag=cad';
												$botao_excluir = '<button type="button" class="btn btn-danger btn-xs" onclick="excluir'.$id_conta.'();"><i class="fal fa-trash-alt"></i> Excluir Boleto</button>';
											}
											if($banco == 5){
												$banco_emissor = 'ASAAS';
												$link_excluir = 'delete_boleto_asaas.php?id_conta='.$id_conta.'&id_cliente='.$id_cliente.'&id_empresa='.$id_empresa.'&pag=cad';
												$botao_excluir = '<button type="button" class="btn btn-danger btn-xs" onclick="excluir'.$id_conta.'();"><i class="fal fa-trash-alt"></i> Excluir Boleto</button>';
											}
											if($banco == 3){
												$banco_emissor = 'CAIXA INTERNO';
												$link_excluir = 'delete_conta_receber.php?id_conta='.$id_conta.'&id_cliente='.$id_cliente.'&id_empresa='.$id_empresa.'&pag=cad';
												$botao_excluir = '<button type="button" class="btn btn-danger btn-xs" onclick="excluir'.$id_conta.'();"><i class="fal fa-trash-alt"></i> Excluir Boleto</button>';
											}
											
											
											if($id_recorrencia > 0){
												$tipo_cob = 'Recorrência - '.$banco_emissor.'';
											}
											if($id_recorrencia == 0){
												$recorrencia = '';
											}
											if($id_carne == 0){
												$tipo_cob = '';
											}
											if($id_carne != 0){
												$tipo_cob = 'Carnê - '.$banco_emissor.'';
											}
											
											if($status_conta == 'Pago'){
												$status_conta1 = '<h5><span class="badge" style="background-color:#009900;color:#FFF">PAGO</span></h5>';
												$botao_baixa = '';
											}
											
											$base_conta = 'id_conta:'.$id_conta.'';
											$base_conta = base64_encode($base_conta);
											
											if($status_conta == 'Em Aberto' && $data_vencimento < $data_hj){
												$status_conta1 = '<h5><span class="badge" style="background-color:#FF6347;color:#FFF">EM ATRASO</span></h5>';
												$botao_baixa = '<a href="view_conta_receber.php?c='.$base_conta.'"><button type="button" class="btn btn-info btn-xs"><i class="fal fa-download"></i> Baixar</button></a>';
												
											}
											if($status_conta == 'Em Aberto' && $data_vencimento >= $data_hj){
												$status_conta1 = '<h5><span class="badge" style="background-color:#4682B4;color:#FFF">AGUAR. PGTO</span></h5>';
												$botao_baixa = '<a href="view_conta_receber.php?c='.$base_conta.'"><button type="button" class="btn btn-info btn-xs"><i class="fal fa-download"></i> Baixar</button></a>';
											}
											
											if($status_conta == 'Em Aberto' && $especie == 2){
												$botao_boleto = '<a href="'.$link_boleto.'" target="_blank"><button type="button" class="btn btn-xs btn-dark "><i class="fal fa-print"></i> Imprimir Boleto</button></a>';
											}
											
											if($status_conta == 'Pago'){
												$status_conta1 = '<h5><span class="badge" style="background-color:#009900;color:#FFF">PAGO</span></h5>';
											}
													

										?>
										<tr>
					
					<td><?php echo $data_vencimento1?></td>
                    <td><?php echo $especie1?></td>
					<td><?php echo $categoria?></td>
                    <td>R$ <?php echo $valor_bruto?></td>
                    <td><?php echo $tipo_cob?></td>
                    <td><?php echo $status_conta1?></td>
					<td>
						<button type="button" class="btn btn-dark btn-icon btn-sm" data-toggle="modal" data-target="#conta<?php echo $id_conta?>" ><i class="fal fa-file-alt" data-toggle="tooltip" data-offset="0,10" title="Ver Detalhes da Conta"></i></button>
						<a href="view_conta_receber.php?c=<?php echo $base_conta?>"><button type="button" data-toggle="tooltip" data-offset="0,10" class="btn btn-dark btn-icon btn-sm" title="Ir para Conta"><i class="fal fa-search"></i></button></a>
					</td>
				</tr>
				

				
				
				
				
											<div class="modal fade default-example-modal-right" id="conta<?php echo $id_conta?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-right  modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title h4">DETALHES DA FATURA <?php echo $nosso_numero?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
															<div class="row">
																<div class="col-md-12">
																	<?php echo $botao_boleto?>
																	<?php echo $botao_baixa?>
																</div>
															</div>
															<br>
                                                            <div class="card mb-5" style="border:#ccc 1px solid;">
                                                                <div class="card-body p-3">
																	<h4><span class="badge badge-dark">INFORMAÇÕES GERAIS</span></h4><br>
																	<div class="row">
																		<div class="col-md-12">
																			<label>Cliente</label><br>
																			<span ><b><?php echo $descricao?></b></span>
																		</div>
																		
																	</div><br>
																	<div class="row">
																		<div class="col-md-4">
																			<label>Duplicata</label><br>
																			<span ><b><?php echo $duplicata?></b></span>
																		</div>
																		<div class="col-md-4">
																			<label>Data Emissão</label><br>
																			<span ><b><?php echo $data_emissao?></b></span>
																		</div>
																		<div class="col-md-4">
																			<label>Data Vencimento</label><br>
																			<span ><b><?php echo $data_vencimento1?></b></span>
																		</div>
																	</div><br>
																	<div class="row">
																		<div class="col-md-4">
																			<label>Espécie Fatura</label><br>
																			<span ><b><?php echo $especie1?></b></span>
																		</div>
																		<div class="col-md-4">
																			<label>Tipo de Cobrança</label><br>
																			<span ><b><?php echo $categoria?></b></span>
																		</div>
																		<div class="col-md-4">
																			<label>Status</label><br>
																			<span ><b><?php echo $status_conta1?></b></span>
																		</div>
																	</div><br>
																	<div class="row">
																		<div class="col-md-4">
																			<label>Banco Emissor:</label><br>
																			<span ><b><?php echo $banco_emissor?></b></span>
																		</div>
																		<div class="col-md-4">
																			<label>Valor da Fatura</label><br>
																			<span ><b>R$ <?php echo $valor_bruto?></b></span>
																		</div>
																		<div class="col-md-4">
																			<label>Recorrência</label><br>
																			<span ><b><?php echo $recorrencia?></b></span>
																		</div>
																	</div><br>
																	<div class="row">
																		<div class="col-md-12">
																			<label>Linha Digitável:</label><br>
																			<span ><b><?php echo $linha_digitavel?></b></span>
																		</div>
																		
																	</div>
                                                                </div>
                                                            </div>
															<div class="card mb-5" style="border:#ccc 1px solid;">
                                                                <div class="card-body p-3">
																	<h4><span class="badge badge-dark">INFORMAÇÕES BAIXA</span></h4><br>
																	<div class="row">
																		<div class="col-md-4">
																			<label>Data Pagamento</label><br>
																			<span ><b><?php echo $data_pagamento1?></b></span>
																		</div>
																		<div class="col-md-4">
																			<label>Valor Pago:</label><br>
																			<span ><b><?php echo $valor_pago?></b></span>
																		</div>
																		<div class="col-md-4">
																			<label>Forma de Pagamento:</label><br>
																			<span ><b><?php echo $forma_pagamento_conta?></b></span>
																		</div>
																	</div><br>
																	<div class="row">
																		<div class="col-md-4">
																			<label>Usuário Baixa:</label><br>
																			<span ><b><?php echo $user_baixa?></b></span>
																		</div>
																		
																	</div><br>
																	<div class="row">
																		<div class="col-md-12">
																			<label>Observações da Baixa:</label><br>
																			<span ><b><?php echo $obs_baixa?></b></span>
																		</div>
																		
																	</div>
                                                                </div>
                                                            </div>
                                                        </div>   
                                                        <div class="modal-footer">
															
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                        </div>
                                                    </div>
												</div>				
											</div>
				
				
				<?php
											}?>
		</tbody>
	</table>
    
  
	<?php
} else {
	echo "<div class='alert alert-dark' role='alert'>Nenhuma Fatura encontrada!</div>";
}
?>
                                                      

                                                    </div>
													
													
													
													
												</div>
												<div class="tab-pane fade" id="ordens" role="tabpanel" aria-labelledby="ordens">
													<div class="row">
														<div class="col-md-6">
															<h3>ORDENS DE SERVIÇO</h3>
														</div>
														<div class="col-md-6 text-right">
															<?php echo $botao_veiculo_add?>
														</div>
													</div>
													<hr style="border:#999999 1px solid">
													<div class="row">
                                                     <?php
													$result_os = "SELECT * FROM ordem_servico WHERE id_cliente='$id_cliente' ORDER BY data_criacao DESC";
													$resultado_os = mysqli_query($conn, $result_os);


													//Verificar se encontrou resultado na tabela "usuarios"
													if(($resultado_os) AND ($resultado_os->num_rows != 0)){
														?>
	
												<table class="table table-sm table-hover" style="width:100%;">
													<thead>
														<tr>
															<th>No da OS</th>
															<th>Data OS</th>
															<th>Veículo</th>
															<th>Tipo de OS</th>
															<th>Status</th>
															<th>Data Instalação</th>
															<th>Ações</th>
														</tr>
													</thead>
													<tbody>
													<?php
													while($row_os = mysqli_fetch_assoc($resultado_os)){
													$id_os = $row_os['id_os'];
													$id_veiculo = $row_os['id_veiculo'];
													$tipo_os = $row_os['tipo_os'];
													$status_os = $row_os['status'];
													$data_criacao = $row_os['data_criacao'];
													$data_criacao = date('d/m/Y', strtotime("$data_criacao"));
													$data_encerramento = 	$row_os['data_encerramento'];
													
													if($data_encerramento == '0000-00-00'){
														$data_encerramento1 = '';	
													}
													if($data_encerramento != '0000-00-00'){
														$data_encerramento1 = date('d/m/Y', strtotime("$data_encerramento"));	
													}
													
													
													$cons_veic = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE id_veiculo='$id_veiculo'");
														if(mysqli_num_rows($cons_veic) > 0){
													while ($resp_veic = mysqli_fetch_assoc($cons_veic)) {
													$marca_veiculo = 	$resp_veic['marca_veiculo'];
													$modelo_veiculo = 	$resp_veic['modelo_veiculo'];
													$tipo_veiculo = 	$resp_veic['tipo_veiculo'];
													$placa_veiculo = 	$resp_veic['placa'];
													
														
														
														$cons_stat1 = mysqli_query($con,"SELECT * FROM status_os WHERE id_status='$status_os'");
														if(mysqli_num_rows($cons_stat1) > 0){
													while ($resp_stat1 = mysqli_fetch_assoc($cons_stat1)) {
													$status_os1 = 	$resp_stat1['status_os'];

													if($status_os == 2){
														$botao_act = '<a href="#" data-toggle="modal" data-target="#nao_permitido"><button data-toggle="tooltip" data-offset="0,10" data-original-title="Tratar OS" type="button" class="btn btn-outline-dark btn-sm btn-icon"><i class="fas fa-check-circle"></i></button></a>';
														$botao_edit = '<a class="btn-block dropdown-item" href="#" data-toggle="modal" data-target="#nao_permitido"><i class="fas fa-edit"></i> Editar OS</a>';
														} else {
														$botao_act = '<a href="tratar_os.php?id_os='.$id_os.'&id_cliente='.$id_cliente.'"><button data-toggle="tooltip" data-offset="0,10" data-original-title="Tratar OS" type="button" class="btn btn-outline-dark btn-sm btn-icon"><i class="fas fa-check-circle"></i></button></a>';
														$botao_edit = '<a class="dropdown-item" href="editar_os.php?id_cliente='.$id_cliente.'&id_os='.$id_os.'&id_veiculo='.$id_veiculo.'"><i class="fa fa-edit"></i> Editar OS</a>';
															}
		
														if($status_os == 2){
														$cor1 = '<h5><span class="badge" style="background-color:#009900;color:#FFF">'.$status_os1.'</span></h5>';
														} else if ($status_os == 1){
														$cor1 = '<h5><span class="badge" style="background-color:#4169E1;color:#FFF">'.$status_os1.'</span></h5>';
														} else {
														$cor1 = '<h5><span class="badge badge-dark">'.$status_os1.'</span></h5>';	
															}
															
														$base64_os = 'id_cliente:'.$id_cliente.'&id_os:'.$id_os.'';
														$base64_os = base64_encode($base64_os);
																		?>
															<tr>
																<th><?php echo $id_os; ?></th>
																<td><?php echo $data_criacao; ?></td>
																<td><?php echo $placa_veiculo?> - <?php echo $marca_veiculo?> / <?php echo $modelo_veiculo?></td>
																<td><?php echo $tipo_os?></td>
																<td><?php echo $cor1?></td>
																<td><?php echo $data_encerramento1?></td>
																<td>
							
																<?php echo $botao_act;?>		
																<a href="ordem_servico.php?c=<?php echo $base64_os?>"><button type="button" data-toggle="tooltip" data-offset="0,10" data-original-title="Imprimir OS" class="btn btn-outline-dark btn-sm btn-icon"><i class="fas fa-print"></i></button></a>		
																<a href="#" data-toggle="modal" data-target="#del<?php echo $id_os?>"><button data-toggle="tooltip" data-offset="0,10" data-original-title="Excluir OS" type="button" class="btn1 btn1-danger btn-sm btn-icon1"><i class="fas fa-trash-alt"></i></button></a>		
																		
																</td>
															</tr>
															<div class="modal fade" id="nao_permitido" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
																<div class="modal-dialog modal-sm modal-dialog-centered">
																	<div class="modal-content bg-warning">
																		<div class="modal-body text-center">
																			<h3 class="mb-15"><font color="#000"><i class="fas fa-exclamation-triangle"></i> ATENÇÃO</font></h3>
																			<p><font color="#000">AÇÃO NÃO PERMITIDA.</font></p>
																			<p><font color="#000">ORDEM DE SERVIÇO ENCERRADA.</font></p>
																			<button type="button" class="btn btn-dark btn-sm" data-dismiss="modal">Ok</button>
																		</div>
																	</div>
																</div>
															</div>
						
																	<div class="modal fade" id="del<?php echo $id_os?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
																			<div class="modal-dialog modal-dialog-centered">
																				<div class="modal-content">
																					<div class="modal-header bg-danger text-white">
																						<h4 class="modal-title" id="myLargeModalLabel" style="color:#FFF;">ATENÇÃO!</h4>
																						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
																					</div>
																					<div class="modal-body">
																						<p><b>EXCLUIR ORDEM DE SERVIÇO?</b><br>
																						<b>OS:</b> <?php echo $id_os?><br>
																						<b>VEICULO:</b> <?php echo $marca_veiculo; ?> / <?php echo $modelo_veiculo; ?></p>
													
																						<b>Deseja prosseguir?</b>
																					</div>
																					<div class="modal-footer">
																						 <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
																						 <a href="del_os.php?id_os=<?php echo $id_os?>&id_cliente=<?php echo $id_cliente?>"><button type="button" class="btn btn-danger">Excluir</button></a>
																					</div>
																				</div>
																			</div>
																		</div>
															<?php
											}}}}}?>
													</tbody>
												</table>
												
											  
												<?php
											} else {
												echo "<div class='alert alert-danger' role='alert'>Nenhuma OS encontrada!</div>";
											}

											?>
                                                </div>
												</div>
												
												
												<?php
												$base_crm = 'id_cliente:'.$id_cliente.'';
												$base_crm = base64_encode($base_crm);
												?>
												<div class="tab-pane fade" id="crm" role="tabpanel" aria-labelledby="ordens">
													<div class="row">
														<div class="col-md-6">
															<h3>CRM / Atendimentos</h3>
														</div>
														<div class="col-md-6">
															<div class="form-group float-right">
																<a href="novo_crm.php?c=<?php echo $base_crm?>"><button type="button" class="btn btn-success btn-sm">+ Novo Registro</button></a>
															</div>
														</div>
													</div>
													<hr style="border:#999999 1px solid">
													<div class="row">
														<div class="col-md-12">
														<?php
		
														$result_crm = "SELECT * FROM crm WHERE id_cliente='$id_cliente' ORDER BY id_crm DESC";
														$resultado_crm = mysqli_query($conn, $result_crm);


														//Verificar se encontrou resultado na tabela "usuarios"
														if(($resultado_crm) AND ($resultado_crm->num_rows != 0)){
															?>
															<table class="table table-sm table-hover" >
																<thead>
																	<tr>
																		<th style="width:20%;">Data/hora</th>
																		<th style="width:20%;">Usuário Registro</th>
																		<th style="width:20%;">Tipo Atendimento</th>
																		<th style="width:40%;">Descrição</th>
																		<th style="width:40%;">Ações</th>
																	</tr>
																</thead>
																<tbody>
																<?php
																while($row_crm = mysqli_fetch_assoc($resultado_crm)){
																$data = $row_crm['data'];
																$data = date('d/m/Y', strtotime("$data"));
																$hora = $row_crm['hora'];
																$tipo_crm = $row_crm['tipo_crm'];
																$info1 = $row_crm['info'];
																$info = substr($info1, 0, 30);
																$user = $row_crm['user'];
																$id_crm = $row_crm['id_crm'];
																$protocolo = $row_crm['protocolo'];
																

																	?>
																	<tr>
																		<th><?php echo $data; ?> - <?php echo $hora?> Protocolo: <?php echo $protocolo?></th>
																		<td><?php echo $user?></td>
																		<td><?php echo $tipo_crm?></td>
																		<td><?php echo $info ?>...</td>
																		<td>
																			<button type="button" class="btn btn-dark btn-icon btn-sm" data-toggle="modal" data-target="#crm<?php echo $id_crm?>" ><i class="fal fa-file-alt" data-toggle="tooltip" data-offset="0,10" title="Ver Detalhes"></i></button>
																		</td>
																	</tr>
																	
											
											<div class="modal fade default-example-modal-right" id="crm<?php echo $id_crm?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-right  modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title h4">CRM/ATENDIMENTO</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
															
                                                            <div class="card mb-5" style="border:#ccc 1px solid;">
                                                                <div class="card-body p-3">
																	<h4><span class="badge badge-dark">INFORMAÇÕES DO ATENDIMENTO</span></h4><br>
																	<div class="row">
																		<div class="col-md-12">
																			<label>Cliente</label><br>
																			<span ><b><?php echo $nome_cliente?></b></span>
																		</div>
																		
																	</div><br>
																	<div class="row">
																		<div class="col-md-4">
																			<label>Data Atendimetno</label><br>
																			<span ><b><?php echo $data; ?> - <?php echo $hora?></b></span>
																		</div>
																		<div class="col-md-4">
																			<label>Protocolo</label><br>
																			<span ><b><?php echo $protocolo?></b></span>
																		</div>
																		<div class="col-md-4">
																			<label>Operador</label><br>
																			<span ><b><?php echo $user?></b></span>
																		</div>
																	</div><br>
																	<div class="row">
																		<div class="col-md-4">
																			<label>Tipo de Atendimento</label><br>
																			<span ><b><?php echo $tipo_crm?></b></span>
																		</div>
																		
																	</div><br>
																	<div class="row">
																		<div class="col-md-12">
																			<label>Descrição Atendimento</label><br>
																			<span ><b><?php echo $info1?></b></span>
																		</div>
																		
																	</div><br>
                                                                </div>
                                                            </div>
															
                                                        </div>   
                                                        <div class="modal-footer">
															
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                        </div>
                                                    </div>
												</div>				
											</div>
											
											
													
													
																	<?php
													}?>
															</tbody>
														</table>
    
  
															<?php
														} else {
															echo "<div class='alert alert-dark' role='alert'>Nenhum Registro encontrado!</div>";
														}
														?>
														</div>
                                                   
                                                    
                                                    
                                                    
													</div>
												</div>
												
												
												
												
												<div class="tab-pane fade" id="acesso" role="tabpanel" aria-labelledby="ordens">
													<div class="row">
														<div class="col-md-6">
															<h3>ACESSO WEB / APP</h3>
														</div>
														<div class="col-md-6">
															<div class="form-group float-right">
																<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#novo_usuario"><i class="fal fa-user-plus"></i> Novo Usuário</button>
															</div>
														</div>
													</div>
													<hr style="border:#999999 1px solid">
													<div class="panel-container show">
														<div class="panel-content">
															
															<ul class="nav nav-tabs" role="tablist">
																<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab_default-1" role="tab">Usuários</a></li>
																
																<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab_default-2" role="tab">Telefones Conectados</a></li>
																
															</ul>
															<div class="tab-content p-3">
																<div class="tab-pane fade show active" id="tab_default-1" role="tabpanel">
																	<div class="row">
																		<div class="col-md-12">
																		<table class="table table-sm table-hover" >
																			<thead>
																				<tr>
																					<th>Nome do Usuário</th>
																					<th>Login de Acesso</th>
																					<th>Último Acesso</th>
																					<th>Ações</th>
																				</tr>
																			</thead>
																			<tbody>
																		
																		<?php
																		$cons_users = mysqli_query($conn,"SELECT * FROM usuarios WHERE id_cliente = '$id_cliente'");
																		if(mysqli_num_rows($cons_users) > 0){
																			while ($resp_users = mysqli_fetch_assoc($cons_users)) {
																			$id_usuarios1 = 	$resp_users['id_usuarios'];
																			$nome_user = 	$resp_users['nome'];
																			$login_user = 	$resp_users['usuario'];
																			$login1 = explode("@", $login_user);
																			$login_user = $login1[0];
																			$tipo_user = 	$resp_users['tipo_user'];
																			$ultimo_login = 	$resp_users['ultimo_login'];
																			$veiculos_1 = 	$resp_users['veiculos'];
																			
																			
																			$permite_bloqueio1 = 	$resp_users['permite_bloqueio'];
																			
																			if($permite_bloqueio1 == 'SIM'){
																				$permite_bloqueio111 = 'SIM';
																			}
																			if($permite_bloqueio1 != 'SIM'){
																				$permite_bloqueio111 = 'NÂO';
																			}
																			
																			
																		$base_user = 'id_usuarios:'.$id_usuarios1;
																		$base_user = base64_encode($base_user);
																				
																			
																		?>
																		<tr>
																			<th><?php echo $nome_user; ?></th>
																			<td><?php echo $login_user?></td>
																			<td><?php echo $ultimo_login?></td>
																			<td>
																				<button type="button" class="btn btn-dark btn-icon btn-sm" data-toggle="modal" data-target="#detalhes<?php echo $id_usuarios1?>" ><i class="fal fa-file-alt" data-toggle="tooltip" data-offset="0,10" title="Detalhes"></i></button>
																				<button type="button" class="btn1 btn1-danger btn-icon1 btn-sm" data-toggle="modal" data-target="#delete<?php echo $id_usuarios1?>" ><i class="fal fa-trash-alt" data-toggle="tooltip" data-offset="0,10" title="Excluir Usuário"></i></button>
																			</td>
																		</tr>
																		
																		
																	<div class="modal fade" id="delete<?php echo $id_usuarios1?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
																		<div class="modal-dialog modal-dialog-centered">
																			<div class="modal-content">
																				<div class="modal-header bg-danger text-white">
																					<h4 class="modal-title" id="myLargeModalLabel" style="color:#FFF;">EXCLUIR USUÁRIOS!</h4>
																					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
																				</div>
																				<div class="modal-body">
																					<p><b>EXCLUIR USUÁRIO?</b><br>
																					
																					<?php echo $login_user; ?></p>
												
																					<b>Deseja prosseguir?</b>
																				</div>
																				<div class="modal-footer">
																					 <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
																					 <a href="delete_usuario.php?id_usuarios=<?php echo $id_usuarios1?>&id_cliente=<?php echo $id_cliente?>&local=cad"><button type="button" class="btn btn-danger">Excluir</button></a>
																				</div>
																			</div>
																		</div>
																	</div>
																		
																		
																		<!-- MODAL NOVO USUARIO -->
									
																		<div class="modal fade default-example-modal-right" id="detalhes<?php echo $id_usuarios1?>" tabindex="-1" role="dialog" aria-hidden="true">
																	<div class="modal-dialog modal-dialog-right  modal-lg">
																		<div class="modal-content">
																			<div class="modal-header">
																				<h5 class="modal-title h4">DETALHES DO USUÁRIO</h5>
																				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																					<span aria-hidden="true"><i class="fal fa-times"></i></span>
																				</button>
																			</div>
																			<div class="modal-body">
																				<div class="row">
																					<div class="col-md-12">
																						<a href="editar_usuario.php?c=<?php echo $base_user?>&pag=cad"><button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#carregar">Editar Usuário</button></a>
																					</div>
																				</div>
																				<br>
																				<div class="card mb-5" style="border:#ccc 1px solid;">
																					<div class="card-body p-3">
																						<h4><span class="badge badge-dark">INFORMAÇÕES DO USUÁRIO</span></h4><br>
																						<div class="row">
																							<div class="col-md-12">
																								<label>Nome do Usuário</label><br>
																								<span ><b><?php echo $nome_user?></b></span>
																							</div>
																							
																						</div><br>
																						<div class="row">
																							<div class="col-md-4">
																								<label>Login:</label><br>
																								<span ><b><?php echo $login_user; ?></b></span>
																							</div>
																							<div class="col-md-4">
																								<label>Tipo de Acesso:</label><br>
																								<span ><b><?php echo $tipo_user?></b></span>
																							</div>
																							<div class="col-md-4">
																								<label>Bloqueio Veiculos no app:</label><br>
																								<span ><b><?php echo $permite_bloqueio111?></b></span>
																							</div>
																						</div><br>
																						
																						
																					</div>
																					<div class="card-body p-3">
																						<h4><span class="badge badge-dark">VEÍCULOS DO USUÁRIO</span></h4><br>
																						<div class="row">
																							<div class="col-md-12">
																								<?php
																								
																								$cons_veiculos1 = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE deviceid IN ($veiculos_1)");
																								if(mysqli_num_rows($cons_veiculos1) > 0){
																									while ($resp_veiculos = mysqli_fetch_assoc($cons_veiculos1)) {
																									$id_veiculo11 = 	$resp_veiculos['id_veiculo'];
																									$deviceid21 = 	$resp_veiculos['deviceid'];
																									$placa_veic1 = 	$resp_veiculos['placa'];
																									$modelo_veic1 = 	$resp_veiculos['modelo_veiculo'];
																									$marca_veic1 = 	$resp_veiculos['marca_veiculo'];
																									$veiculo11 = $placa_veic1.' - '.$marca_veic1.'/'.$modelo_veic1;
																								?>
																								<div class="row">
																									<div class="col-md-12">
																									<i class="fas fa-car"></i> <?php echo $placa_veic1?> - <?php echo $marca_veic1?>/<?php echo $modelo_veic1?>
																									</div>
																								</div><br>
																								
																								
																								<?php
																									
																									
																									
																								}}
																								?>
																							</div>
																							
																							
																						</div><br>
																						
																						
																					</div>
																				</div>
																				
																			</div>   
																			<div class="modal-footer">
																				
																				<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
																			</div>
																		</div>
																	</div>				
																</div>
																		
																		<!-- FIM MODAL NOVO USUARIO -->
																		
																		
																		
																		

																		<?php }} else {
																		?>
																		<tr>
																			<td colspan="4"><span class="text-center">NENHUM USUÁRIO ENCONTRADO</span></td>
																			
																		</tr>
																		<?php
																		}?>
																			</tbody>
																		</table>
																		</div>
																		
																	</div>
																</div>
																<div class="tab-pane fade" id="tab_default-2" role="tabpanel">
																	<div class="row">
																		<div class="col-md-12">
																			<table class="table table-sm table-hover" >
																				<thead>
																					<tr>
																						<th>Modelo Conectado</th>
																						<th>Login de Acesso</th>
																						<th>Último Acesso</th>
																						<th>Ações</th>
																					</tr>
																				</thead>
																				<tbody>
																				<?php
																				$cons_model = mysqli_query($conn,"SELECT * FROM usuarios_push WHERE id_cliente = '$id_cliente'");
																				if(mysqli_num_rows($cons_model) > 0){
																					while ($resp_model = mysqli_fetch_assoc($cons_model)) {
																					$id_push = 	$resp_model['id_push'];
																					$id_usuarios = 	$resp_model['id_usuarios'];
																					$modelo = 	$resp_model['modelo'];
																					$ultimo_login2 = 	$resp_model['ultimo_login'];
																					$ultimo_login2 = date('d/m/Y H:i:s', strtotime("$ultimo_login2"));
																					
																				$cons_user2 = mysqli_query($conn,"SELECT * FROM usuarios WHERE id_usuarios = '$id_usuarios'");
																				if(mysqli_num_rows($cons_user2) > 0){
																					while ($resp_user2 = mysqli_fetch_assoc($cons_user2)) {
																					$usuario = 	$resp_user2['usuario'];
																					$user1 = explode("@", $usuario);
																					$login = $user1[0];
																				}}
																					
																				?>
																				<tr>
																			<th><?php echo $modelo; ?></th>
																			<td><?php echo $login?></td>
																			<td><?php echo $ultimo_login2?></td>
																			<td>
																				
																				<button type="button" class="btn1 btn1-danger btn-icon1 btn-sm shadow-0" data-toggle="modal" data-target="#dele<?php echo $id_push?>" ><i class="fal fa-trash-alt" data-toggle="tooltip" data-offset="0,10" title="Excluir Usuário"></i></button>
																			</td>
																		</tr>
																		
																		
																	<div class="modal fade" id="dele<?php echo $id_push?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
																		<div class="modal-dialog modal-dialog-centered">
																			<div class="modal-content">
																				<div class="modal-header bg-danger text-white">
																					<h4 class="modal-title" id="myLargeModalLabel" style="color:#FFF;">EXCLUIR ACESSO/TELEFONE!</h4>
																					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
																				</div>
																				<div class="modal-body">
																					<p><b>EXCLUIR REGISTRO?</b><br>
																					
																					<?php echo $modelo; ?></p>
												
																					<b>Deseja prosseguir?</b>
																				</div>
																				<div class="modal-footer">
																					 <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
																					 <a href="delete_usuario_push.php?id_push=<?php echo $id_push?>&id_cliente=<?php echo $id_cliente?>&local=cad"><button type="button" class="btn btn-danger">Excluir</button></a>
																				</div>
																			</div>
																		</div>
																	</div>
																	
																	<?php
																									
																									
																									
																								}}
																								?>
																	
																		</tbody>
																		</table>
																		</div>
																	</div>
																</div>
																
															</div>
														</div>
													</div>
													
													
												</div>
												
												
												
												<!--
												<div class="tab-pane fade" id="documentos" role="tabpanel" aria-labelledby="ordens">
													<div class="row">
														<div class="col-md-6">
															<h3>DOCUMENTOS DO CLIENTE</h3>
														</div>
														
													</div>
													
												</div>
												-->
											</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						
						<!-- MODAL ALTERAR STATUS -->
					
					<div class="modal fade" id="alterar_status" >
						<div class="modal-dialog modal-lg">
						  <div class="modal-content">
							<div class="modal-header bg-info text-white">
							  <h3 class="modal-title text-white">ALTERAR STATUS CLIENTE</h3>
							  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
							</div>
							<div class="modal-body">
							  <div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Status Cliente:</label>
										<select name="status" id="status" class="select2 form-control w-100" id="single-default">
										<option value="<?php echo $status?>"><?php echo $status3?></option>
										<?php
										
										$cons_status = mysqli_query($conn,"SELECT * FROM status WHERE id_status != '$status' ORDER BY id_status ASC");
										if(mysqli_num_rows($cons_status) <= 0){
										echo '<option value="0">N/A</option>';
										}else{
										
										while ($res_status = mysqli_fetch_assoc($cons_status)) {
										$id_status = $res_status['id_status'];
										$status_at = $res_status['status'];
										echo '<option value="'.$id_status.'">'.$status_at.'</option>';
										}
										}
										?>
										</select><input name="id_cliente" id="id_cliente" type="hidden" value="<?php echo $id_cliente?>">
									</div>
								</div>
							
								</div><br>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Motivo Alteração:</label>
												<textarea name="informacao" id="informacao" cols="60" rows="5" class="form-control" required>.</textarea>
												<input name="user" id="user" type="hidden" value="<?php echo $user_nome?>">
										</div>
									</div>
								</div>
								
							</div>
							<div class="modal-footer">
							  <button type="button" class="btn btn-dark btn-sm" style="font-size:13px" data-dismiss="modal">Cancelar</button>
							<button type="button" class="btn btn-info btn-sm" style="font-size:13px" onClick="envia_status();"  data-style="expand-left">Alterar</button>
							</div>
						  </div>
						  <!-- /.modal-content -->
						</div>
						<!-- /.modal-dialog -->
					</div>
					
					<!-- FIM MODAL ALTERAR STATUS -->
						
						
						<!-- MODAL NOVO USUARIO -->
					
					<div class="modal fade" id="novo_usuario" >
						<div class="modal-dialog modal-dialog-centered modal-lg">
						  <div class="modal-content">
							<div class="modal-header bg-info text-white">
							  <h3 class="modal-title text-white">NOVO USUARIO CLIENTE</h3>
							  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
							</div>
							<div class="modal-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Usuário:</label><br>
											<input class="form-control" name="usuario" id="usuario" type="text" value="">
											<div id="retorno_user"></div><br>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Senha:</label><br>
											<input class="form-control" name="senha" id="senha" type="text">
											<input class="form-control" name="id_cliente2" id="id_cliente2" type="hidden" value="<?php echo $id_cliente?>">
											<input type="hidden" name="login_padrao1" id="login_padrao1" autocomplete="off" value="<?php echo $login_padrao?>">
											<input type="hidden" name="id_empresa" id="id_empresa" autocomplete="off" value="<?php echo $id_empresa?>">
										</div>
									</div>
									
								</div><br>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Selecione os veículos para este usuário:</label><br>
												<div class="row">
												<?php
												$cons_veiculos = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE id_cliente = '$id_cliente'");
													if(mysqli_num_rows($cons_veiculos) > 0){
														while ($resp_veiculos = mysqli_fetch_assoc($cons_veiculos)) {
														$id_veiculo1 = 	$resp_veiculos['id_veiculo'];
														$deviceid2 = 	$resp_veiculos['deviceid'];
														$placa_veic = 	$resp_veiculos['placa'];
														$modelo_veic = 	$resp_veiculos['modelo_veiculo'];
														$marca_veic = 	$resp_veiculos['marca_veiculo'];
														$veiculo1 = $placa_veic.' - '.$marca_veic.'/'.$modelo_veic;
												?>
												
													<div class="col-md-4">
														<div class="form-group">
															 <div class="custom-control custom-checkbox custom-control-inline">
																<input type="checkbox" class="custom-control-input" name="id_veiculo2[]" id="check<?php echo $id_veiculo1?>" value="<?php echo $deviceid2?>" checked>
																<label class="custom-control-label" for="check<?php echo $id_veiculo1?>"><?php echo $veiculo1?></label>
															</div>
														</div>
													</div>
												
													<?php }} ?>
												</div><br>
										</div>
									</div>
								</div><br>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Permite Bloqueio do(s) Veículo(s) no App:</label><br>
											 <div class="custom-control custom-switch" >
												<input type="checkbox" class="custom-control-input" value="SIM" name="permite_bloqueio" id="permite_bloqueio" <?php echo $block?> checked>
												<label class="custom-control-label" for="permite_bloqueio" > </label>
											</div>
										</div>
									</div>
								</div><br>
								
								
							</div>
							<div class="modal-footer">
							  <button type="button" class="btn btn-dark btn-sm" style="font-size:13px" data-dismiss="modal">Cancelar</button>
							<button type="button" id="botao" class="btn btn-info btn-sm" style="font-size:13px" onClick="envia_user();"  data-style="expand-left">Cadastrar</button>
							</div>
						  </div>
						  <!-- /.modal-content -->
						</div>
						<!-- /.modal-dialog -->
					</div>
					
					<!-- FIM MODAL NOVO USUARIO -->
						
						</form>
                    </main>
					
					<!-- DIV Carregar -->
					<div class="modal fade" id="carregar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-sm modal-dialog-centered">
							<div class="modal-content">
								
								<div class="modal-body" id="informacoes">
									<span style="font-size:20px">Aguarde... </span> <img src="/tracker3/Imagens/load.gif" width="40px" height="40px">
								</div>
								
							</div>
						</div>
					</div>	
                    <!-- FIM DIV Carregar -->
					
					<!-- MODAL EXCLUIR -->
					<div class="modal modal-alert fade" id="Excluir" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Excluir Cliente</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true"><i class="fal fa-times"></i></span>
									</button>
								</div>
								<div class="modal-body">
									<br>Esta ação é irreverssível.<br>
									Deseja prosseguir?
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
									<a href="del_cliente.php?id_cliente=<?php echo $id_cliente?>"><button type="button" class="btn1 btn1-danger">Excluir</button></a>
								</div>
							</div>
						</div>
					</div>
					
					<!-- FIM MODAL EXCLUIR -->
					
					<!-- MODAL PJBANK -->
						<div class="modal fade" id="pjbank" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header bg-info text-white">
										<h4 class="modal-title" id="myLargeModalLabel" style="color:#FFF;">PJBANK!</h4>
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									</div>
									<div class="modal-body">
										<img src="/tracker2/Imagens/pjbank.jpg" style="width:100%;height:auto;">
										
									</div>
									<div class="modal-footer">
										 <button type="button" class="btn btn-dark" data-dismiss="modal">Fechar</button>
										 <a href="cad_pjbank.php"><button type="button" class="btn btn-success">Habilitar</button></a>
									</div>
								</div>
							</div>
						</div>
					<!-- FIM MODAL PJBANK -->
					
					<!-- MODAL PJBANK -->
						<div class="modal fade" id="cad_asaas" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered">
								<div class="modal-content">
									<div class="modal-header bg-info text-white">
										<h4 class="modal-title" id="myLargeModalLabel" style="color:#FFF;">CADASTRO ASAAS!</h4>
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									</div>
									<div class="modal-body">
										<h3>ATENÇÃO</h3>
										<p>Cliente não vinculado no Asaas Bank!</p><br>
										<p>Deseja Consultar/Vincular?</p>
										
									</div>
									<div class="modal-footer">
										 <button type="button" class="btn btn-dark" data-dismiss="modal">Fechar</button>
										 <a href="consulta_asaas.php?id_cliente=<?php echo $id_cliente?>"><button type="button" class="btn btn-success">Prosseguir</button></a>
									</div>
								</div>
							</div>
						</div>
					<!-- FIM MODAL PJBANK -->
					
					
					
					
				
					<?php
					$os = $_GET['os'];
					if($os == 1){

					?>
						<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
					<script>
								$(document).ready(function(){
									$('#os_fim').modal('show');
								});
							</script>
						<?php } ?>
						<div class="modal fade" id="os_fim" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-body text-center font-18">
										
										<div class="mb-30 text-center"><img src="/tracker3/Imagens/success.png"></div><br><br>
										<h4 class="mb-20">ORDEM DE SERVIÇO FINALIZADA COM SUCESSO!</h4>
									</div>
									<div class="modal-footer justify-content-center">
										
										<button type="button" class="btn btn-dark" data-dismiss="modal">Fechar</button>
									</div>
								</div>
							</div>
						</div>
					
					
						<div class="modal fade" id="Excluir_no" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-sm modal-dialog-centered">
								<div class="modal-content bg-warning">
									<div class="modal-body text-center">
										<h3 class="mb-15"><font color="#000"><i class="fas fa-exclamation-triangle"></i> ATENÇÃO</font></h3>
										<p><font color="#000">AÇÃO NÃO PERMITIDA.</font></p>
										<p><font color="#000">CLIENTE POSSUI VEICULOS ATIVOS.</font></p>
										<button type="button" class="btn btn-dark btn-sm" data-dismiss="modal">Ok</button>
									</div>
								</div>
							</div>
						</div>
					
					
					<?php
					$del = $_GET['del'];
					$msg = $_GET['msg'];
					if($del == 'erro'){

					?>
						<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
					<script>
								$(document).ready(function(){
									$('#os_fim1').modal('show');
								});
							</script>
						<?php } ?>
						<div class="modal fade" id="os_fim1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-body text-center font-18">
										<h4 class="mb-20">ERRO</h4>
										<div class="mb-30 text-center"><img src="/tracker3/Imagens/cross.png"></div><br><br>
										<h4 class="mb-20"><?php echo $msg?></h4>
									</div>
									<div class="modal-footer justify-content-center">
										
										<button type="button" class="btn btn-dark" data-dismiss="modal">Fechar</button>
									</div>
								</div>
							</div>
						</div>
					
					<div class="modal fade" id="aviso_contas_pagar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content text-white" style="background-color:#CD5C5C">
								<div class="modal-body text-center">
									<h3 class="text-white mb-15"><i class="fa fa-exclamation-triangle"></i> ATENÇÃO</h3>
									<h5>CLIENTE POSSUI PENDENCIAS FINANCEIRAS</h5>
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
								</div>
							</div>
						</div>
					</div>
<?php
		$data_aviso = date('Y-m-d');
		$cons_contas = mysqli_query($conn,"SELECT * FROM contas_receber WHERE id_cliente='$id_cliente' AND status='Em Aberto' AND data_vencimento < '$data_aviso'");
	if(mysqli_num_rows($cons_contas) > 0){
			

 ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
				<script>
					$(document).ready(function(){
						$('#aviso_contas_pagar').modal('show');
					});
				</script>
			<?php } ?>
			
			
			
			<?php
		$error_asaas = $_GET['error_asaas'];
		if($error_asaas != ''){
		
		?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script>
					$(document).ready(function(){
						$('#asaas_ret2').modal('show');
					});
				</script>
			<?php } ?>
			<div class="modal fade" id="asaas_ret2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-body text-center font-18">
							<h3 class="mb-20">ERRO!</h3>
							<div class="mb-30 text-center"><img src="/tracker/Imagens/cross.png"></div><br><br>
							<?php echo $error_asaas?>
						</div>
						<div class="modal-footer justify-content-center">
							
							<button type="button" class="btn btn-dark" data-dismiss="modal">Fechar</button>
						</div>
					</div>
				</div>
			</div>
			
			
				<?php
		$cad_asaas = $_GET['cad_asaas'];
		if($cad_asaas == 'ok'){
		
		?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script>
					$(document).ready(function(){
						$('#asaas_ret3').modal('show');
					});
				</script>
			<?php } ?>
			<div class="modal fade" id="asaas_ret3" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-body text-center font-18">
							
							<div class="mb-30 text-center"><img src="/tracker/Imagens/success.png"></div><br><br>
							<h3 class="mb-20">CLIENTE CADASTRADO NO ASAAS BANK!</h3>
						</div>
						<div class="modal-footer justify-content-center">
							
							<button type="button" class="btn btn-dark" data-dismiss="modal">Fechar</button>
						</div>
					</div>
				</div>
			</div>
			
			<?php
		$cad_cliente = $_GET['cad_cliente'];
		if($cad_cliente == 'ok'){
		$base_cli = 'id_cliente:'.$id_cliente;
		$base_cli = base64_encode($base_cli);
		
		?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script>
					$(document).ready(function(){
						$('#cad_cliente').modal('show');
					});
				</script>
			<?php } ?>
			<div class="modal fade" id="cad_cliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-body text-center font-18">
							
							<div class="mb-30 text-center"><img src="/tracker/Imagens/success.png"></div><br><br>
							<h3 class="mb-20">CLIENTE CADASTRADO COM SUCESSO!</h3>
							<h4 class="mb-20">Deseja cadastrar o veículo?</h4>
						</div>
						<div class="modal-footer justify-content-center">
							
							<button type="button" class="btn btn-dark" data-dismiss="modal">NÃO</button>
							<a href="novo_veiculo.php?c=<?php echo $base_cli?>"><button type="button" class="btn btn-success">SIM</button></a>
						</div>
					</div>
				</div>
			</div>
			
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
function envia_status(){
	document.forml.action="edit_status_cliente.php"
	document.forml.method = 'POST';
	document.forml.submit()
}

</script>
<script>
function envia_user(){
	document.forml.action="add/add_usuario_cliente.php"
	document.forml.method = 'POST';
	document.forml.submit()
}
function edit_user(){
	document.forml.action="edit_user_cliente.php"
	document.forml.method = 'POST';
	document.forml.submit()
}

</script>
<script>
$('#forml').on('submit', function(e){
  $('#carregar').modal('show');
});
</script>  
<script type="text/javascript">
	$("#usuario").focusout(function(){
		var usuario = document.getElementById("usuario").value;
		var customer_name = document.getElementById("login_padrao1").value;
		$.get( "ajax/usuario.ajax.php?usuario="+usuario, function( data ) {
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
