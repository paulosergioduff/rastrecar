<?php include('conexao.php');
					$base64 = $_GET['c'];
$base = base64_decode($base64);
$cliente = explode(":", $base);
$id_cliente = $cliente[1];


$cons_cli_cor = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
	if(mysqli_num_rows($cons_cli_cor) > 0){
while ($resp_cor = mysqli_fetch_assoc($cons_cli_cor)) {
$cor_sistema = 	$resp_cor['cor_sistema'];
$logo_cliente = 	$resp_cor['logo'];
	}}
	
if($logo_cliente == ''){
	$logo_cliente1 = '/tracker/Imagens/logo1.png';
	$logo_perfil = '/tracker3/app-assets/img/demo/avatars/profile_small.png';
}
if($logo_cliente != ''){
	$logo_cliente1 = 'logos/'.$logo_cliente;
	$logo_perfil = 'logos/'.$logo_cliente;
}

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
$telefone_cel = preg_replace("/[^0-9]/", "", $telefone_celular);
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
	$botao_del = '<button type="button" class="btn btn-danger btn-sm shadow-0" style="width:90%" data-toggle="modal" data-target="#Excluir_no"><i class="fal fa-trash-alt"></i> Excluir</button>';
}
if($total_veiculos <= 0){
	$botao_del = '<button type="button" class="btn btn-danger btn-sm shadow-0" style="width:90%" data-toggle="modal" data-target="#Excluir"><i class="fal fa-trash-alt"></i> Excluir</button>';
}


if($status == 1){
	$status5 = '<h5><span class="badge" style="background-color:#009900;color:#FFF">'.$status3.'</span></h5>';
}
if($status == 2){
	$status5 = '<h5><span class="badge badge-dark">'.$status3.'</span></h5>';
}
if($status == 4){
	$status5 = '<h5><span class="badge badge-dark">'.$status3.'</span></h5>';
}
if($status == 5){
	$status5 = '<h5><span class="badge badge-dark">'.$status3.'</span></h5>';
}
if($status == 7){
	$status5 = '<h5><span class="badge badge-info">'.$status3.'</span></h5>';
}
if($status == 11){
	$status5 = '<h5><span class="badge badge-info">'.$status3.'</span></h5>';
}
if($status == 13){
	$status5 = '<h5><span class="badge badge-info">'.$status3.'</span></h5>';
}
if($status == 99){
	$status5 = '<h5><span class="badge badge-warning">'.$status3.'</span></h5>';
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
$cons_contas = mysqli_query($conn,"SELECT * FROM contas_receber WHERE id_cliente='$id_cliente' AND status='Em Aberto' AND data_vencimento < '$data_aviso'");
	if(mysqli_num_rows($cons_contas) > 0){
		$status10 = '<i class="fas fa-thumbs-down fa-2x" style="color:#990000" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Cliente com faturas em atraso"></i>';
	}
	if(mysqli_num_rows($cons_contas) <= 0){
		$status10 = '<i class="fas fa-thumbs-up fa-2x" style="color:#009900"  data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Cliente sem Pendências"></i>';
	}
	

	
$base64_cliente = 'id_cliente:'.$id_cliente.'';
$base64_cliente = base64_encode($base64_cliente);
					?>
					
                    <!-- END Page Header -->
                    <!-- BEGIN Page Content -->
                    <!-- the #js-page-content id is needed for some plugins to initialize -->
					
                    <main id="js-page-content" role="main" class="page-content">
					<form name="forml" id="forml">
						
                        <div class="row">
                            <div class="col-md-3">
								<div class="card mb-g rounded-top">
                                    <div class="row no-gutters row-grid">
                                        <div class="col-12">
                                            <div class="d-flex flex-column align-items-center justify-content-center p-4">
                                               <img src="<?php echo $logo_perfil?>" style="width:25%; height;auto;" class="rounded-circle shadow-2 img-thumbnail" alt="">
                                                <h5 class="mb-0 fw-700 text-center mt-3">
                                                    <?php echo $nome_cliente?><br>
                                                </h5>
												<a href="https://api.whatsapp.com/send?phone=55<?php echo $telefone_cel?>" target="_blank" class="btn-link font-weight-bold"><i class="fab fa-whatsapp"></i> <?php echo $telefone_celular?></a>
												 
                                                
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-center py-3">
                                                <h5 class="mb-0 fw-700">
                                                    Status
                                                    <?php echo $status5?>
                                                   
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-center py-3">
                                                <h5 class="mb-0 fw-700">
                                                    <?php echo $status10?>
                                                </h5>
                                            </div>
                                        </div>
                                       
										 <div class="col-12">
                                            <div class="p-3 text-center">
                                                <a href="cad_cliente.php?c=<?php echo $base64_cliente?>"><button type="button" onclick="carrega()" class="btn btn-outline-dark btn-sm shadow-0" style="width:90%"><i class="fal fa-user"></i> Dados Pessoais</button></a><br><br>
											   <a href="cad_cliente_veiculos.php?c=<?php echo $base64_cliente?>"><button type="button" class="btn btn-outline-dark btn-sm" style="width:90%" onclick="carrega()"><i class="fal fa-car"></i> Veículos</button></a><br><br>
											  <button type="button" class="btn btn-dark btn-sm" style="width:90%"><i class="fal fa-dollar-sign"></i> Faturas</button><br><br>
											   <a href="cad_cliente_os.php?c=<?php echo $base64_cliente?>"><button type="button" class="btn btn-outline-dark btn-sm" style="width:90%"><i class="fal fa-file-edit"></i> Ordens de Serviço</button></a><br><br>
											   <a href="cad_cliente_crm.php?c=<?php echo $base64_cliente?>"><button type="button" class="btn btn-outline-dark btn-sm" style="width:90%"><i class="fal fa-comments"></i> CRM/Atendimentos</button></a><br><br>
											   <a href="cad_cliente_acesso.php?c=<?php echo $base64_cliente?>"<button type="button" class="btn btn-outline-dark btn-sm" style="width:90%"><i class="fal fa-sign-in-alt"></i> Acesso Web/App</button></a><br><br>
												<a href="cad_cliente_conf.php?c=<?php echo $base64_cliente?>"><button type="button" class="btn btn-outline-dark btn-sm" style="width:90%"><i class="fal fa-cogs"></i> Conf. Sistema</button></a><br><br>
												<?php echo $botao_del?>
                                            </div>
											
                                        </div>
										
                                    </div>
                                </div>
                            </div>
							
							<div class="col-md-9">
                                <div id="panel-1" class="panel">
                                    
                                    <div class="panel-container show">
                                        <div class="panel-content">
											<div class="row">
												<div class="col-md-6">
													<h3>FATURAS</h3>
												</div>
												<div class="col-md-6 text-right">
													<div class="btn-group">
																<button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fal fa-bars"></i> Opções</button>
																<div class="dropdown-menu dropdown-menu-right">
																	
																	
																	<span class="dropdown-item text-center"><h5><B>-- OPÇÕES ASAAS --</B></h5></span>


																	<?php echo $botao_recorrencia_asaas_card?>
																	<?php echo $botao_boleto_asaas?>
																	
																	
																	
																</div>
															</div>
												</div>
											</div>
											<hr style="border:#999999 1px solid">
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
	echo '<h5><span class="badge badge-warning">NENHUMA FATURA ENCONTRADA</span></h5>';
}
?>
                                                      

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
					
					
					<!-- FIM MODAL NOVO USUARIO -->
						
						</form>
                    </main>
					
					<!-- DIV Carregar -->
					<div class="modal fade" id="carregar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="static">
						<div class="modal-dialog modal-sm modal-dialog-centered">
							<div class="modal-content">
								
								<div class="modal-body" id="informacoes">
									<span style="font-size:18px">Aguarde... </span> <img src="/tracker3/Imagens/load.gif" width="40px" height="40px">
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
<script>
function carrega(){
  $('#carregar').modal('show');
};
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
