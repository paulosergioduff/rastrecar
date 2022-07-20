<?php include('conexao.php');
	
$base64 = $_GET['c'];
$base = base64_decode($base64);
$cliente = explode(":", $base);
$id_conta = $cliente[1];


$cons_empresa = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='1361'");
	if(mysqli_num_rows($cons_empresa) > 0){
while ($resp_empresa = mysqli_fetch_assoc($cons_empresa)) {
$nome_url = $resp_empresa['nome_url'];
$logo = $resp_empresa['logo'];
$texto_rodape = $resp_empresa['texto_rodape'];
$texto_topo = $resp_empresa['texto_topo'];
$cor_sistema = $resp_empresa['cor_sistema'];
	}}

$hora = date('H:i:s');
$date = date('Y-m-d');

$cons_cliente = mysqli_query($conn,"SELECT * FROM contas_receber WHERE id_conta='$id_conta'");
	if(mysqli_num_rows($cons_cliente) > 0){
while ($row_usuario = mysqli_fetch_assoc($cons_cliente)) {
$nr_banco = $row_usuario['nr_banco'];
$nr_b = explode("_", $nr_banco);
$id_fatura = $nr_b[1];
$link_fatura = 'https://www.asaas.com/i/'.$id_fatura.'';
$link_pdf = 'https://www.asaas.com/b/pdf/'.$id_fatura.'';
$descricao = $row_usuario['descricao'];
$categoria = $row_usuario['categoria'];
$duplicata = $row_usuario['duplicata'];
$class_financeira = $row_usuario['class_financeira'];
$data_emissao = $row_usuario['data_emissao'];
$data_emissao1 = date('d/m/Y', strtotime("$data_emissao"));

$data_credito1 = $row_usuario['data_credito'];


$data_vencimento = $row_usuario['data_vencimento'];
$data_vencimento1 = date('d/m/Y', strtotime("$data_vencimento"));
$banco = $row_usuario['banco'];
$especie = $row_usuario['especie'];
$link_boleto = $row_usuario['link_boleto'];
$valor_bruto = $row_usuario['valor_bruto'];
$valor_bruto1 = number_format($valor_bruto, 2, ",", ".");

$qtd_parcelas = $row_usuario['qtd_parcelas'];
$forma_pagamento = $row_usuario['forma_pagamento'];

$status_conta = $row_usuario['status'];
$data_pagamento = $row_usuario['data_pagamento'];
$id_carne = $row_usuario['id_carne'];
$user_baixa = $row_usuario['user_baixa'];

$valor_pago = $row_usuario['valor_pago'];
$valor_pago1 = number_format($valor_pago, 2, ",", ".");
$observacoes = $row_usuario['observacoes'];
$nr_parcela = $row_usuario['nr_parcela'];
$obs_baixa = $row_usuario['obs_baixa'];
$nfse_emitida = $row_usuario['nfse_emitida'];
$id_empresa2 = $row_usuario['id_empresa'];
$id_cliente = $row_usuario['id_cliente'];
	}}
	
	
if($data_pagamento != '' or $data_pagamento != 0){
	$data_pagamento1 = date('d/m/Y', strtotime("$data_pagamento"));
}	
if($data_pagamento == '' or $data_pagamento == 0){
	$data_pagamento1 ='';
}

if($data_credito1 != '' or $data_credito1 != 0){
	$data_credito = date('d/m/Y', strtotime("$data_credito1"));
}	
if($data_credito1 == '' or $data_credito1 == 0){
	$data_credito ='';
}


$data_hj = date('Y-m-d');
											
if($status_conta == 'Em Aberto' && $data_vencimento < $data_hj){
	$status_conta1 = '<h3><span class="badge" style="background-color:#FF6347;color:#FFF">EM ATRASO</span></h3>';
	$botao_baixa = '<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#baixar"><i class="fal fa-download"></i> Baixar</button>';
	
}
if($status_conta == 'Em Aberto' && $data_vencimento >= $data_hj){
	$status_conta1 = '<h3><span class="badge" style="background-color:#4682B4;color:#FFF">AGUAR. PGTO</span></h3>';
	$botao_baixa = '<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#baixar"><i class="fal fa-download"></i> Baixar</button>';
}
if($status_conta == 'Pago' && $forma_pagamento == 'DINHEIRO'){
	$status_conta1 = '<h3><span class="badge" style="background-color:#009900;color:#FFF">PAGO EM DINHEIRO</span></h3>';
	$botao_baixa = '';
}
if($status_conta == 'Pago' && $forma_pagamento != 'DINHEIRO'){
	$status_conta1 = '<h3><span class="badge" style="background-color:#009900;color:#FFF">PAGO</span></h3>';
	$botao_baixa = '';
}

if($especie == '2'){
	if($banco == 1 && $status_conta == 'Em Aberto'){
		$botao_boleto = '<a href="'.$link_boleto.'" target="_blank"><button type="button" class="btn btn-primary btn-sm"><i class="fal fa-barcode-alt"></i> Imprimir Boleto</button></a>';
		$botao_carne = '';
		$botao_whats = '<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#whatsapp_pj"><i class="fab fa-whatsapp-square"></i> Enviar Link Fatura</button>';
	}
	if($banco == 5 && $status_conta == 'Em Aberto'){
		$botao_boleto = '<a href="'.$link_pdf.'" target="_blank"><button type="button" class="btn btn-primary btn-sm"><i class="fal fa-barcode-alt"></i> Imprimir Boleto</button></a>';
		$botao_carne = '<a href="https://www.asaas.com/installment/paymentBook/'.$id_carne.'" target="_blank"><button type="button" style="font-size:12px" class="btn btn-primary btn-sm" title="Imprimir Carnê"><i class="fal fa-file-alt"></i> Imprimir Carnê</button></a>';
		$botao_whats = '<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#whatsapp_asaas"><i class="fab fa-whatsapp"></i> Enviar Link Fatura</button>';
	}
}





if($status_conta == 'Pago' && $nfse_emitida == 'NAO'){
	$btn_nfse = '<a href="gerar_nfse.php?id_conta='.$id_conta.'"><button type="button" class="btn btn-success btn-sm">Gerar NFS-e</button></a>';
}

$cons_especie = mysqli_query($conn,"SELECT * FROM tipo_pagamento WHERE id_tipo='$especie'");
	if(mysqli_num_rows($cons_especie) > 0){
while ($resp_especie = mysqli_fetch_assoc($cons_especie)) {
$especie1	 = 	$resp_especie['tipo_pagamento'];

}}

$cons_cat = mysqli_query($conn,"SELECT * FROM categorias_contas_receber WHERE id_categoria='$class_financeira'");
	if(mysqli_num_rows($cons_cat) > 0){
while ($resp_cons_cat = mysqli_fetch_assoc($cons_cat)) {
$categoria	 = 	$resp_cons_cat['categoria'];

}}

$cons_bancos1 = mysqli_query($conn,"SELECT * FROM bancos WHERE id_banco='$banco'");
	if(mysqli_num_rows($cons_bancos1) > 0){
	while ($res_banco1 = mysqli_fetch_assoc($cons_bancos1)) {
		$nome_banco	 = 	$res_banco1['nome_banco'];
	}}
	
if($banco == 1){
	$banco_emissor = 'PJ BANK';
	$link_excluir = 'delete_boleto_pjb.php?id_conta='.$id_conta.'&id_cliente='.$id_cliente.'&id_empresa='.$id_empresa.'&pag=contas';
	$botao_excluir = '<button type="button" class="btn btn-danger btn-xs" onclick="excluir'.$id_conta.'();"><i class="fal fa-trash-alt"></i> Excluir Boleto</button>';
	$link_baixar = 'baixar_conta_receber_pj.php';
}
if($banco == 5){
	$banco_emissor = 'ASAAS';
	$link_excluir = 'delete_boleto_asaas.php?id_conta='.$id_conta.'&id_cliente='.$id_cliente.'&id_empresa='.$id_empresa.'&pag=contas';
	$botao_excluir = '<button type="button" class="btn btn-danger btn-xs" onclick="excluir'.$id_conta.'();"><i class="fal fa-trash-alt"></i> Excluir Boleto</button>';
	$link_baixar = 'baixar_conta_receber_asaas.php';
}
if($banco == 7){
	$banco_emissor = 'CAIXA INTERNO';
	$link_excluir = 'delete_conta_receber.php?id_conta='.$id_conta.'&id_cliente='.$id_cliente.'&id_empresa='.$id_empresa.'&pag=contas';
	$botao_excluir = '<button type="button" class="btn btn-danger btn-xs" onclick="excluir'.$id_conta.'();"><i class="fal fa-trash-alt"></i> Excluir Boleto</button>';
	$link_baixar = 'baixar_conta_receber.php';
}

$base64_conta = 'id_conta:'.$id_conta;
$base64_conta = base64_encode($base64_conta);
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
                    
                    <main id="js-page-content" role="main" class="page-content">
					
						<div class="row">
                            <div class="col-xl-8">
								<div class="subheader">
									<h1 class="subheader-title">
										<i class='subheader-icon fal fa-dollar-sign'></i> Detalhes Conta a Receber
										<small>
											Cliente: <?php echo $descricao?>
										</small>
									</h1>
								</div>
							</div>
							
						</div>
                        
                        <form name="forml" id="forml" action="<?php echo $link_baixar?>" method="post">
                        <div class="row">
                            <div class="col-xl-12">
                                <div id="panel-1" class="panel">
                                    
                                    <div class="panel-container show">
                                        <div class="panel-content">
											<div class="row">
												<div class="col-md-4">
													<h3>DADOS DA CONTA<?php echo $botao_loja1?></h3>
												</div>
												<div class="col-md-8 text-right">
													
													<?php echo $botao_boleto?>
													<a href="editar_conta_receber.php?c=<?php echo $base64_conta?>"><button type="button" class="btn btn-dark btn-sm"><i class="fal fa-edit"></i> Editar</button></a>
													<?php echo $botao_baixa?>
													<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#excluir"><i class="fal fa-trash-alt"></i> Excluir</button>
													
												</div>
											</div>
											<hr style="border:#CCC 1px solid;">
											 <div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label>Nº Documento:</label>
														<input class="form-control" name="duplicata" id="duplicata" value="<?php echo $duplicata?>" type="text" readonly>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Data Emissão:</label>
														<input class="form-control" name="data_emissao" id="data_emissao" value="<?php echo $data_emissao1?>" type="text" readonly>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
															<label>Data Vencimento:</label>
															<input type="text" class="form-control" name="data_vencimento" id="data_vencimento" value="<?php echo $data_vencimento1?>" readonly>
													</div>
												</div>
											</div><br>
											<div class="row">
												<div class="col-md-4">
															<label>Valor Bruto:</label>
															<input type="text" class="form-control" name="valor_bruto" id="valor_bruto" value="R$ <?php echo $valor_bruto1?>" readonly>

												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Cliente:</label>
														<input type="text" class="form-control" name="descricao" id="descricao" value="<?php echo $descricao?>" readonly>
													</div>

												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Condição de Pagamento:</label><BR>
														<input type="text" class="form-control" name="descricao" id="descricao" value="<?php echo $especie1?> " readonly>
													</div>

												</div>          
											</div><br>
											<div class="row">
												<div class="col-md-4">
															<label>Banco:</label>
															<input type="text" class="form-control" name="nome_banco" id="nome_banco" value="<?php echo $banco_emissor?>" readonly>

												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Classificação Financeira:</label>
														<input type="text" class="form-control" name="categoria" id="categoria" value="<?php echo $categoria?>" readonly>
													</div>

												</div>
												<div class="col-md-4">
												<div class="form-group">
													<label>Status:</label><br>
													<?php echo $status_conta1?>														
												</div>
												</div>                                   
											</div><br>
											<div class="row">
												<div class="col-md-8">
													<div class="form-group">
														<label>Observações:</label>
														<textarea name="observacoes" id="observacoes" cols="60" rows="5" class="form-control" style="height:60px;" readonly><?php echo $observacoes?></textarea>
													</div>                                 
												</div>
											</div>
											<br><br>
											<h3>DADOS DA BAIXA</h3>
											<hr style="border:#CCC 1px solid;">
											<div class="row">
												<div class="col-md-3">
													<label>Data Pagamento:</label>
													<input type="text" class="form-control" name="data_pagamento1" id="data_pagamento1" value="<?php echo $data_pagamento1?>" readonly>

												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label>Valor Pago:</label>
														<input type="text" class="form-control" name="valor_pago1" id="valor_pago1" value="<?php echo $valor_pago1?>" readonly>
													</div>

												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label>Usuário Baixa:</label><br>
														<input type="text" class="form-control" name="user_baixa1" id="user_baixa1" value="<?php echo $user_baixa?>" readonly>							
													</div>
												</div>  
												<div class="col-md-3">
													<div class="form-group">
														<label>Previsão Crédito:</label><br>
														<input type="text" class="form-control" name="data_credito" id="data_credito" value="<?php echo $data_credito?>" readonly>							
													</div>
												</div> 
											</div><br>
											<div class="row">
												<div class="col-md-12">
													<label>Observações Baixa:</label><br>
													<textarea name="obs_baixa" id="obs_baixa" cols="60" rows="5" class="form-control" style="height:60px;" readonly><?php echo $obs_baixa?></textarea>
												</div>
											</div><br>
											<div class="row">
												<div class="col-md-4">
													<a href="contas_receber.php"><button type="button" class="btn btn-dark btn-sm">Voltar</button></a>

												</div>
												                                
											</div><br>
											
											
											
											
							<div class="modal fade" id="baixar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered modal-lg">
									<div class="modal-content">
										<div class="modal-header bg-info text-white">
											<h4 class="modal-title" id="myLargeModalLabel" style="color:#FFF;">BAIXAR CONTA!</h4>
											<button type="button" class="close text-white" data-dismiss="modal" aria-hidden="true">×</button>
										</div>
										<div class="modal-body">
											<div class="row">
												<div class="col-md-4">
													<div class="form-group" id="data_1">
														<label>Data Pagamento:</label>
														<input type="date" class="form-control" name="data_pagamento" id="data_pagamento" autocomplete="off" value="<?php echo $date?>" required>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Tipo Baixa:</label>
														<select name="status" id="status" class="form-control">
															<option value="Pago">Pagamento</option>
															<option value="Devolvido">Devolução</option>
														  </select>
													</div>

												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Valor:</label>
														<input type="text" name="valor_pago" id="valor_pago" size="15" onKeyPress="return(MascaraMoeda(this,'.',',',event))" class="form-control"  value="<?php echo $valor_bruto1?>" required>					
													</div>
												</div> 
																		
											</div><br>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label>Pago pelo banco:</label>
														<select name="banco" id="banco" class="form-control">
														  <option value="<?php echo $banco?>"><?php echo $nome_banco?></option>
																	<?php
																	
																	$cons_bancos = mysqli_query($conn,"SELECT * FROM bancos WHERE id_empresa='$id_empresa' OR id_empresa='1' ORDER BY nome_banco ASC");
																	if(mysqli_num_rows($cons_bancos) <= 0){
																	echo '<option value="0">Nenhum Banco Encontrado</option>';
																	}else{
																	
																	while ($res_banco = mysqli_fetch_assoc($cons_bancos)) {
																	$id_banco = $res_banco['id_banco'];
																	$nome_banco = $res_banco['nome_banco'];
																	//$nome_banco = utf8_encode($nome_banco);
																	echo '<option value="'.$id_banco.'">'.$nome_banco.'</option>';
																	}
																	}
																	?>
														</select>					
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Forma de Pagamento:</label>
														<select name="forma_pagamento" id="forma_pagamento" class="form-control">
															<option value="DINHEIRO">DINHEIRO</option>
															<option value="TRANSFERENCIA">TRANSFERENCIA BANCARIA</option>
															<option value="PIX">PIX</option>
															<option value="CARTAO DE DEBITO">CARTAO DE DEBITO</option>
															<option value="CARTAO DE CREDITO">CARTAO DE CREDITO</option>
														</select>					
													</div>
												</div>	
											</div><br>
											<input type="hidden" name="id_conta" id="id_conta" size="15" value="<?php echo $id_conta?>">
											<input type="hidden" name="user_baixa" id="user_baixa" value="<?php echo $user_nome?>">
											<div class="row">
												<div class="col-md-12">
												<div class="form-group">
														<label>Observações Baixa:</label>
														<input type="text" name="obs_baixa" id="obs_baixa" size="15" class="form-control">				
													</div>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											 <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
											 <button type="button" onclick="baixar_conta();" class="btn btn-success">Baixar</button>
										</div>
									</div>
								</div>
							</div>	
							
							
							<?php
						$whatsapp_asaas1 = '%2AENVIO+DE+FATURA%2A%0A%0APrezado+'.$descricao.'%2C%0A%0APara+sua+comodidade%2C+estamos+encaminhando+sua+fatura.+Acesse+o+link+abaixo+para+visualizar.%0A%0A'.$link_fatura.'%0A%0AQualquer+d%C3%BAvida+estamos+a+disposi%C3%A7%C3%A3o.%0A%0A%2AFinanceiro+JC+CAR+Rastreamento%2A%0A_%2AMensagem+autom%C3%A1tica.+Por+favor+n%C3%A3o+responda%2A_';
						$whatsapp_asaas1 = urldecode($whatsapp_asaas1);
						?>
						
						<div class="modal fade" id="whatsapp_asaas" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header bg-primary text-white">
										<h4 class="modal-title" id="myLargeModalLabel" style="color:#FFF;">ENVIO FATURA WHATSAPP!</h4>
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									</div>
									<div class="modal-body">
										<div class="row">
											<div class="col-md-12">
												<p><b>Mensagem a ser enviada:</b><br><br>
												<textarea class="form-control" style="height:400px;" name="mensagem2" id="mensagem2"><?php echo $boas_vindas2?></textarea>
												<input type="hidden" id="origem2" name="origem2" value="CONTA_RECEBER">
											</div>
										</div>

									</div>
									<div class="modal-footer">
										 <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
										 <button type="button" onclick="enviar_fat();" class="btn btn-success">Enviar Mensagem</button>
									</div>
								</div>
							</div>
						</div>
						
						<?php
						$whatsapp_pj1 = '%2AENVIO+DE+FATURA%2A%0A%0APrezado+'.$descricao.'%2C%0A%0APara+sua+comodidade%2C+estamos+encaminhando+sua+fatura.+Acesse+o+link+abaixo+para+visualizar.%0A%0A'.$link_boleto.'%0A%0AQualquer+d%C3%BAvida+estamos+a+disposi%C3%A7%C3%A3o.%0A%0A%2AFinanceiro+JC+CAR+Rastreamento%2A%0A_%2AMensagem+autom%C3%A1tica.+Por+favor+n%C3%A3o+responda%2A_';
						$whatsapp_pj1 = urldecode($whatsapp_pj1);
						?>
						
						<div class="modal fade" id="whatsapp_pj" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header bg-primary text-white">
										<h4 class="modal-title" id="myLargeModalLabel" style="color:#FFF;">ENVIO FATURA WHATSAPP!</h4>
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									</div>
									<div class="modal-body">
										<div class="row">
											<div class="col-md-12">
												<p><b>Mensagem a ser enviada:</b><br><br>
												<textarea class="form-control" style="height:400px;" name="mensagem2" id="mensagem2"><?php echo $boas_vindas2?></textarea>
												<input type="hidden" id="origem2" name="origem2" value="CONTA_RECEBER">
											</div>
										</div>

									</div>
									<div class="modal-footer">
										 <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
										 <button type="button" onclick="enviar_fat();" class="btn btn-success">Enviar Mensagem</button>
									</div>
								</div>
							</div>
						</div>
											
						<div class="modal fade" id="confirm_adm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-body text-center font-18">
										<h4 class="mb-20">NECESSÁRIO AUTORIZAÇÃO</h4>
										<div class="mb-30 text-center"><i class="fas fa-info-circle fa-3x" style="color:#990000"></i></div><br><br>
										<h4 class="mb-20">Senha Supervisor</h4><br>
										<div class="row">
											<div class="col-md-12">
												
												<input type="text" name="usuario" id="usuario" placeholder="Usuário" class="form-control" >
											</div>
										</div><br>
										<div class="row">
											<div class="col-md-12">
												
												<input type="password" name="senha" id="senha" placeholder="Senha"  class="form-control" >
												<input type="hidden" name="id_conta_del" id="id_conta_del" value="<?php echo $id_conta?>">
												<input type="hidden" name="id_cliente_del" id="id_cliente_del" value="<?php echo $id_cliente?>">
												<input type="hidden" name="customer" id="customer" value="<?php echo $id_empresa?>">
												<input type="hidden" name="banco_del" id="banco_del" value="<?php echo $banco?>">
											</div>
										</div>
									</div>
									<div class="modal-footer justify-content-center">
										<button type="button" class="btn btn-dark" data-dismiss="modal">Fechar</button>
										<button type="button" onclick="excluir_conta()" class="btn btn-primary">Confirmar</button>
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
					
					
					<div class="modal fade" id="excluir" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-header bg-danger text-white">
									<h4 class="modal-title" id="myLargeModalLabel" style="color:#FFF;">ATENÇÃO!</h4>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								</div>
								<div class="modal-body">
									<b>EXCLUIR CONTA A RECEBER?</b><BR />
									<?php echo $nosso_numero?> - <?php echo $descricao; ?><br><br>
									R$ <?php echo $valor_bruto?> - Vencimento: <?php echo $data_vencimento1; ?><br><br>

									Deseja prosseguir?
								</div>
								<div class="modal-footer">
									 <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
									 <a href="<?php echo $link_excluir?>"><button type="button" class="btn btn-danger">Excluir</button></a>
								</div>
							</div>
						</div>
					</div>
					
					<?php
					$edit = $_GET['edit'];
					$msg = $_GET['msg'];
					if($edit == 'erro'){

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
										<h4 class="mb-20">ERRO</h4>
										<div class="mb-30 text-center"><img src="/tracker2/Imagens/cross.png"></div><br><br>
										<h4 class="mb-20"><?php echo $msg?></h4>
									</div>
									<div class="modal-footer justify-content-center">
										
										<button type="button" class="btn btn-dark" data-dismiss="modal">Fechar</button>
									</div>
								</div>
							</div>
						</div>
						
						<?php
					$error = $_GET['error'];
					if($error == 'psw'){

					?>
						<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
					<script>
								$(document).ready(function(){
									$('#os_fim22').modal('show');
								});
							</script>
						<?php } ?>
						<div class="modal fade" id="os_fim22" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-body text-center font-18">
										<h4 class="mb-20">ERRO</h4>
										<div class="mb-30 text-center"><img src="/tracker2/Imagens/cross.png"></div><br><br>
										<h4 class="mb-20">Senha Incorreta</h4>
									</div>
									<div class="modal-footer justify-content-center">
										<button type="button" class="btn btn-dark" data-dismiss="modal">Fechar</button>
										<button type="button" onclick="error_psw()" class="btn btn-primary">Tentar Novamente</button>
									</div>
								</div>
							</div>
						</div>
						
						<?php
					$error = $_GET['error'];
					if($error == 'user'){

					?>
						<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
					<script>
								$(document).ready(function(){
									$('#os_fim222').modal('show');
								});
							</script>
						<?php } ?>
						<div class="modal fade" id="os_fim222" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-body text-center font-18">
										<h4 class="mb-20">ERRO</h4>
										<div class="mb-30 text-center"><img src="/tracker2/Imagens/cross.png"></div><br><br>
										<h4 class="mb-20">Usuário não encontrado</h4>
									</div>
									<div class="modal-footer justify-content-center">
										<button type="button" class="btn btn-dark" data-dismiss="modal">Fechar</button>
										<button type="button" onclick="error_psw2()" class="btn btn-primary">Tentar Novamente</button>
									</div>
								</div>
							</div>
						</div>
						
						<?php
					$error = $_GET['error'];
					if($error == 'profile'){

					?>
						<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
					<script>
								$(document).ready(function(){
									$('#os_fim223').modal('show');
								});
							</script>
						<?php } ?>
						<div class="modal fade" id="os_fim223" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-body text-center font-18">
										<h4 class="mb-20">ERRO</h4>
										<div class="mb-30 text-center"><img src="/tracker2/Imagens/cross.png"></div><br><br>
										<h4 class="mb-20">Usuário não autorizado para esta função.</h4>
									</div>
									<div class="modal-footer justify-content-center">
										<button type="button" class="btn btn-dark" data-dismiss="modal">Fechar</button>
										<button type="button" onclick="error_psw3()" class="btn btn-primary">Tentar Novamente</button>
									</div>
								</div>
							</div>
						</div>
						
						
						
						
						
						<?php
						$baixa = $_GET['baixa'];
						if($baixa == 'ok'){

						?>
							<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
						<script>
									$(document).ready(function(){
										$('#envio_realizado').modal('show');
									});
								</script>
						<?php } ?>
						<div class="modal fade" id="envio_realizado" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-body text-center font-18">
										
										<div class="mb-30 text-center"><img src="/tracker2/Imagens/success.png"></div><br><br>
										<h5>CONTA BAIXADA COM SUCESSO!</h5><br>
										<h5>Deseja gerar uma Nota Fiscal de Serviço?</h5>
									</div>
									<div class="modal-footer justify-content-center">
										<a href="gerar_nfse.php?id_conta=<?php echo $id_conta?>"><button type="button" class="btn btn-success">Gerar NFS-e</button></a>
										<button type="button" class="btn btn-dark" data-dismiss="modal">Não</button>
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
$('#forml').on('submit', function(e){
  $('#carregar').modal('show');
});
</script>

<script>
function delete_conta(){
	 $('#excluir').modal('hide');
	$('#confirm_adm').modal('show');
};
</script>
<script>
function error_psw(){
	 $('#os_fim22').modal('hide');
	$('#confirm_adm').modal('show');
};
</script>
<script>
function error_psw2(){
	 $('#os_fim222').modal('hide');
	$('#confirm_adm').modal('show');
};
</script>
<script>
function error_psw3(){
	 $('#os_fim223').modal('hide');
	$('#confirm_adm').modal('show');
};
</script>
<script>
function baixar_conta(){
	var banco = document.getElementById("banco").value;
	
	if(banco == 1){
		document.forml.action="baixar_conta_receber_pj.php"
		document.forml.method = 'POST';
		document.forml.submit()
	}
	else if(banco == 5){
		document.forml.action="baixar_conta_receber_asaas.php"
		document.forml.method = 'POST';
		document.forml.submit()
	} else {
		document.forml.action="baixar_conta_receber.php"
		document.forml.method = 'POST';
		document.forml.submit()
	}
	
}

function enviar_fat(){
	document.forml.action="enviar_fat_whats.php"
	document.forml.method = 'POST';
	document.forml.submit()
}

function excluir_conta(){
	document.forml.action="delete_conta_receber.php"
	document.forml.method = 'POST';
	document.forml.submit()
}

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
