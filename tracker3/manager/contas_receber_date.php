<?php 
include('conexao.php');


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
        <!-- Place favicon.ico in the root directory -->
        <link rel="apple-touch-icon" sizes="180x180" href="/tracker3/app-assets/img/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/tracker3/app-assets/img/favicon/favicon-32x32.png">
        <link rel="mask-icon" href="/tracker3/app-assets/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/datagrid/datatables/datatables.bundle.css">
		<script src="https://kit.fontawesome.com/a132241e15.js"></script>
    </head>
    <body class="mod-bg-1">
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
                <div class="page-content-wrapper ">
                    <!-- BEGIN Page Header -->
                    <?php include('include/head.php');
					$data_inicial_2 = $_REQUEST['data_inicial'];
					$data_final_2 = $_REQUEST['data_final'];
					
					$data_inicial_br2 = date('d/m/Y', strtotime("$data_inicial_2"));
					$data_final_br2 = date('d/m/Y', strtotime("$data_final_2"));
					
					$date_hoje = date('Y-m-d');

					
					
					$sql_vencidas = mysqli_query($conn, "SELECT * FROM contas_receber WHERE status='Em Aberto' AND (data_vencimento >= '$data_inicial_2' AND data_vencimento <= '$data_final_2')  ");
					if(mysqli_num_rows($sql_vencidas) <= 0){
						$total_vencido2 = '<span style="font-size:24px;color:#000">0,00</span>';
					}
					if(mysqli_num_rows($sql_vencidas) > 0){
						while($row_vencidas = mysqli_fetch_assoc($sql_vencidas)){
						$data_venc1 = $row_vencidas['data_vencimento'];
						$total_vencido1 += $row_vencidas['valor_bruto'];
						$total_vencido2 = number_format($total_vencido1, 2, ",", ".");
						
						if($data_venc1 < $date_hoje){
							$total_vencido2 = number_format($total_vencido1, 2, ",", ".");
						}
						if($data_venc1 >= $date_hoje){
							$total_vencido2 = '<span style="font-size:24px;color:#000">0,00</span>';
						}
						
					}}
					
					$sql_aberto = mysqli_query($conn, "SELECT * FROM contas_receber WHERE status='Em Aberto' AND (data_vencimento >= '$data_inicial_2' AND data_vencimento <= '$data_final_2')  ");
					
					if(mysqli_num_rows($sql_aberto) > 0){
						while($row_aberto = mysqli_fetch_assoc($sql_aberto)){
						$data_venc = $row_aberto['data_vencimento'];
						$total_aberto1 += $row_aberto['valor_bruto'];
						
						if($data_venc >= $date_hoje){
							$total_aberto12 = number_format($total_aberto1, 2, ",", ".");
						}
						if($data_venc < $date_hoje){
							$total_aberto12 = '<span style="font-size:24px;color:#000">0,00</span>';
						}
						
					}}
					
					$sql_pago = mysqli_query($conn, "SELECT * FROM contas_receber WHERE status='Pago' AND (data_vencimento >= '$data_inicial_2' AND data_vencimento <= '$data_final_2')  ");
					
					if(mysqli_num_rows($sql_pago) > 0){
						while($row_pago = mysqli_fetch_assoc($sql_pago)){
						$total_pago1 += $row_pago['valor_bruto'];
						$total_pago12 = number_format($total_pago1, 2, ",", ".");
						
						
					}}
					
					$sql_total = mysqli_query($conn, "SELECT * FROM contas_receber WHERE data_vencimento >= '$data_inicial_2' AND data_vencimento <= '$data_final_2'  ");
					
					if(mysqli_num_rows($sql_total) > 0){
						while($row_total = mysqli_fetch_assoc($sql_total)){
						$total_periodo1 += $row_total['valor_bruto'];
						$total_periodo12 = number_format($total_periodo1, 2, ",", ".");
						
						
					}}
	
					?>
					
                    <!-- END Page Header -->
                    <!-- BEGIN Page Content -->
                    <!-- the #js-page-content id is needed for some plugins to initialize -->
                    <main id="js-page-content" role="main" class="page-content">
					
						<div class="row">
                            <div class="col-xl-8">
								<div class="subheader">
									<h1 class="subheader-title">
										<i class='subheader-icon fal fa-dollar-sign'></i> Contas a Receber por Período
										<small>
											Período: <?php echo $data_inicial_br2?> até <?php echo $data_final_br2?>
										</small>
									</h1>
								</div>
							</div>
							<div class="col-xl-4 text-right">
							<button type="button" class="btn btn-dark btn-sm" style="font-size:14px" data-toggle="modal" data-target="#periodo"><i class="fal fa-search"></i> Buscar Período</button>
							
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-3">
								<div class="card mb-2">
									<div class="card-body">
										<div class="d-flex flex-row align-items-center">
											<div class='icon-stack display-3 flex-shrink-0'>
												<i class="fal fa-circle icon-stack-3x opacity-100 color-info-400"></i>
												<i class="fas fas fa-calendar-minus icon-stack-1x opacity-100 color-info-500"></i>
											</div>
											<div class="ml-3">
												<strong>
													<span style="font-size:24px;" id="em_aberto"><?php echo $total_aberto12?></span>
												</strong>
												<br>
												<b>A Vencer no período</b>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="card mb-2">
									<div class="card-body">
										<div class="d-flex flex-row align-items-center">
											<div class='icon-stack display-3 flex-shrink-0'>
												<i class="fal fa-circle icon-stack-3x opacity-100" style="color:#990000"></i>
												<i class="fas fa-calendar-times icon-stack-1x opacity-100" style="color:#990000"></i>
											</div>
											<div class="ml-3">
												<strong>
													<span style="font-size:24px;"><?php echo $total_vencido2?></span>
												</strong>
												<br>
												<b>Vencidas no período</b>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="card mb-2">
									<div class="card-body">
										<div class="d-flex flex-row align-items-center">
											<div class='icon-stack display-3 flex-shrink-0'>
												<i class="fal fa-circle icon-stack-3x opacity-100" style="color:#228B22"></i>
												<i class="fas fas fa-calendar-check icon-stack-1x opacity-100" style="color:#228B22"></i>
											</div>
											<div class="ml-3">
												<strong>
													<span style="font-size:24px;" id="pagas"><?php echo $total_pago12?></span>
												</strong>
												<br>
												<b>Pagas no período</b>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="card mb-2">
									<div class="card-body">
										<div class="d-flex flex-row align-items-center">
											<div class='icon-stack display-3 flex-shrink-0'>
												<i class="fal fa-circle icon-stack-3x opacity-100" style="color:#000"></i>
												<i class="fas fas fa-dollar-sign icon-stack-1x opacity-100" style="color:#000"></i>
											</div>
											<div class="ml-3">
												<strong>
													<span style="font-size:24px;" id="total"><?php echo $total_periodo12?></span>
												</strong>
												<br>
												<b>Total Período</b>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
                        
                        <form action="contas_receber_date.php" method="post" name="forml" id="forml">
                        <div class="row">
                            <div class="col-xl-12">
                                <div id="panel-1" class="panel">
                                    
                                    <div class="panel-container show">
                                        <div class="panel-content">
												<table id="dt-basic-example" class="table table-bordered table-hover table-striped nowrap" >
												<thead>
													<tr>
														<th></th>
														<th>Descrição</th>
														<th>Vencimento</th>
														<th>Valor</th>
														<th>Banco</th>
														<th>Tipo</th>
														<th>Status</th>
														<th>Data Pagto</th>

													</tr>
												</thead>
											<tbody>
											<?php
											$data_hoje = date('Y-m-d');
											$data_inicial = $_REQUEST['data_inicial'];
											$data_inicial_br = date('d/m/Y', strtotime("$data_inicial"));


											$ult_dia = date("t");
											
											$data_final = $_REQUEST['data_final'];
											$data_final_br = date('d/m/Y', strtotime("$data_final"));

											
											$result_usuario = mysqli_query($conn,"SELECT * FROM contas_receber WHERE (data_vencimento >= '$data_inicial' AND data_vencimento <= '$data_final') ORDER BY data_vencimento DESC");
											if(mysqli_num_rows($result_usuario) > 0){
											
											while($row_usuario = mysqli_fetch_assoc($result_usuario)){
											$id_conta = $row_usuario['id_conta'];
											$descricao1 = $row_usuario['descricao'];
											$linha_digitavel = $row_usuario['linha_digitavel'];

											$categoria = $row_usuario['categoria'];
											$duplicata = $row_usuario['duplicata'];
											$class_financeira = $row_usuario['class_financeira'];
											$data_emissao = $row_usuario['data_emissao'];
											$data_emissao1 = date('d/m/Y', strtotime("$data_emissao"));
											$data_vencimento = $row_usuario['data_vencimento'];
											$data_vencimento1 = date('d/m/Y', strtotime("$data_vencimento"));
											$banco = $row_usuario['banco'];
											$especie = $row_usuario['especie'];
											$valor_bruto = $row_usuario['valor_bruto'];
											$valor_bruto1 = number_format($valor_bruto, 2, ",", ".");
											$id_recorrencia = $row_usuario['id_recorrencia'];
											$forma_pagamento_conta = $row_usuario['forma_pagamento'];
											$user_baixa = $row_usuario['user_baixa'];
											$qtd_parcelas = $row_usuario['qtd_parcelas'];
											$status_conta = $row_usuario['status'];
											$data_pagamento = $row_usuario['data_pagamento'];
											$user_baixa = $row_usuario['user_baixa'];
											$link_boleto = $row_usuario['link_boleto'];
											$valor_pago = $row_usuario['valor_pago'];
											$valor_pago1 = number_format($valor_pago, 2, ",", ".");
											$observacoes = $row_usuario['observacoes'];
											$nr_parcela = $row_usuario['nr_parcela'];
											$obs_baixa = $row_usuario['obs_baixa'];
											$id_cliente = $row_usuario['id_cliente'];
											
											if(strlen($descricao1) <= 20){
												$descricao = $descricao1;
											}
											if(strlen($descricao1) > 20){
												$descricao = substr($descricao1, 0, 20).'...';
											}
											$descricao = utf8_encode($descricao);
											$data_hj = date('Y-m-d');
											
											$d1 = strtotime($data_hoje); 
											$d2 = strtotime($data_vencimento);
											
											$dataFinal = ($d2 - $d1) /86400;
											
											if($dataFinal < 0)
											$dataFinal *= -1;
										
											
											if($status_conta == 'Em Aberto' && $data_vencimento < $data_hj){
												$status_conta1 = '<h5><span class="badge" style="background-color:#FF6347;color:#FFF">'.$dataFinal.' DIA(S) EM ATRASO</span></h5>';
												$botao_baixa = '<a href="baixar_conta_pagar.php?c='.$base_conta.'"><button type="button" class="btn btn-info"><i class="fal fa-download"></i> Baixar</button></a>';
												$cor = 'style="background-color:#EBD7D3"';
											}
											if($status_conta == 'Em Aberto' && $data_vencimento >= $data_hj){
												$status_conta1 = '<h5><span class="badge" style="background-color:#4682B4;color:#FFF">AGUAR. PGTO</span></h5>';
												$botao_baixa = '<a href="baixar_conta_pagar.php?c='.$base_conta.'"><button type="button" class="btn btn-info"><i class="fal fa-download"></i> Baixar</button></a>';
												$cor = '';
												
											}
											if($status_conta == 'Em Aberto' && $data_vencimento == $data_hj){
												
												$cor = 'style="background-color:#FFF8DC"';
											}
											if($status_conta == 'Pago'){
												if($forma_pagamento_conta == 'BOLETO'){
													$status_conta1 = '<h5><span class="badge" style="background-color:#009900;color:#FFF">PAGO VIA BOLETO</span></h5>';
												}
												elseif($forma_pagamento_conta == 'CARTAO DE CREDITO'){
													$status_conta1 = '<h5><span class="badge" style="background-color:#009900;color:#FFF">PAGO VIA CARTÃO</span></h5>';
												}
												elseif($forma_pagamento_conta == 'PIX'){
													$status_conta1 = '<h5><span class="badge" style="background-color:#009900;color:#FFF">PAGO VIA PIX</span></h5>';
												}
												elseif($forma_pagamento_conta == 'DINHEIRO'){
													$status_conta1 = '<h5><span class="badge" style="background-color:#009900;color:#FFF">PAGO EM DINHEIRO</span></h5>';
												} else {
													$status_conta1 = '<h5><span class="badge" style="background-color:#009900;color:#FFF">PAGO</span></h5>';
												}
												
												$botao_baixa = '';
												$cor = '';
											}
											
											$cons_especie = mysqli_query($conn,"SELECT * FROM tipo_pagamento WHERE id_tipo='$especie'");
												if(mysqli_num_rows($cons_especie) > 0){
													while ($resp_especie = mysqli_fetch_assoc($cons_especie)) {
													$especie1	 = 	$resp_especie['tipo_pagamento'];
												}}
											
											$cons_banco = mysqli_query($conn,"SELECT * FROM bancos WHERE id_banco='$banco'");
												if(mysqli_num_rows($cons_banco) > 0){
													while ($resp_banco = mysqli_fetch_assoc($cons_banco)) {
													$banco1	 = 	$resp_banco['nome_banco'];
												}}
											
											$cons_class = mysqli_query($conn,"SELECT * FROM categorias_contas_receber WHERE id_categoria='$class_financeira'");
												if(mysqli_num_rows($cons_class) > 0){
													while ($resp_especie = mysqli_fetch_assoc($cons_class)) {
													$categoria	 = 	$resp_especie['categoria'];
													//$categoria = utf8_encode($categoria);
												}}
											
											if($status_conta == 'Em Aberto'){
												$data_pagamento1 = '';
											}
											
											if($status_conta == 'Pago'){
												$data_pagamento1 = date('d/m/Y', strtotime("$data_pagamento"));
											}
											
											if($id_recorrencia > 0){
												$recorrencia = 'SIM';
											}
											if($id_recorrencia == 0){
												$recorrencia = 'NÃO';
											}
											
											
											if($banco == 1){
												$banco_emissor = '<img src="/tracker3/Imagens/pjb.png" style="width:20px; heigth:17px"> PJ BANK';
												$link_excluir = 'delete_boleto_pjb.php?id_conta='.$id_conta.'&id_cliente='.$id_cliente.'&id_empresa='.$id_empresa.'&pag=contas';
												$botao_excluir = '<button type="button" class="btn1 btn1-danger btn-sm btn-icon1" data-toggle="modal" data-target="#excluir'.$id_conta.'" ><i class="fal fa-trash-alt"></i></button>';
											}
											if($banco == 5){
												$banco_emissor = '<img src="/tracker3/Imagens/asaas.jpg" style="width:20px; heigth:17px"> ASAAS';
												$link_excluir = 'delete_boleto_asaas.php?id_conta='.$id_conta.'&id_cliente='.$id_cliente.'&id_empresa='.$id_empresa.'&pag=contas';
												$botao_excluir = '<button type="button" class="btn1 btn1-danger btn-sm btn-icon1" data-toggle="modal" data-target="#excluir'.$id_conta.'" ><i class="fal fa-trash-alt"></i></button>';
											}
											
											
											
											if($banco == 5 && $status_conta == 'Em Aberto'){
												$botao_boleto = '<a href="'.$link_boleto.'" target="_blank"><button type="button" class="btn btn-primary btn-sm"><i class="fas fa-barcode-alt"></i> Imprimir Boleto</button></a>';
											}
											if($banco == 2 && $status_conta == 'Em Aberto'){
												$botao_boleto = '<a href="'.$link_boleto.'" target="_blank"><button type="button" class="btn btn-primary btn-sm"><i class="fas fa-barcode-alt"></i> Imprimir Boleto</button></a>';
											}
											
											if($especie == 2){
												$tipo = '<i class="fal fa-barcode-alt"></i> Boleto';
											}
											if($especie == 13){
												$tipo = '<i class="fal fa-credit-card"></i> Cartão de Crédito';
											}

											
											$base64 = 'id_conta:'.$id_conta.'';
											$base64 = base64_encode($base64);
											

											
											?>
											<tr <?php echo $cor?>>
													<td><a href="view_conta_receber.php?c=<?php echo $base64?>"><button type="button" class="btn btn-dark btn-icon btn-sm"><i class="fal fa-file-alt" data-toggle="tooltip" data-offset="0,10" title="Ver Detalhes"></i></button></a></td>
													<td><span data-toggle="popover" data-trigger="hover" data-placement="top" data-content="<?php echo $descricao1?>"><?php echo $descricao; ?></span></td>
													<td><?php echo $data_vencimento1; ?></td>
													<td>R$ <?php echo $valor_bruto1; ?></td>
													<td><?php echo $banco_emissor; ?></td>
													<td><?php echo $tipo; ?></td>
													<td><?php echo $status_conta1; ?></td>
													<td><?php echo $data_pagamento1; ?></td>

													

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
						
						<div class="modal fade" id="periodo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered">
								<div class="modal-content">
									<div class="modal-header bg-info text-white">
										<h4 class="modal-title" id="myLargeModalLabel">BUSCAR PERÍODO</h4>
										<button type="button" class="close text-white" data-dismiss="modal" aria-hidden="true">×</button>
									</div>
									<div class="modal-body">
										<div class="row">
											<div class="col-md-6">
												<label>Data Inicial:</label>
												<input type="date" class="form-control" name="data_inicial" id="data_inicial" required >
											</div>
											<div class="col-md-6">
												<label>Data Final:</label>
												<input type="date" class="form-control" name="data_final" id="data_final" required >
											</div>
										</div>
									</div>
									<div class="modal-footer">
										 <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
										 <button type="submit" class="btn btn-success">Buscar</button>
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
									<span style="fonta-size:20px">Aguarde... </span> <img src="/tracker3/Imagens/load.gif" width="40px" height="40px">
								</div>
								
							</div>
						</div>
					</div>	
                   
					
					
					
                    <!-- this overlay is activated only when mobile menu is triggered -->
                    <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div> <!-- END Page Content -->
                    <!-- BEGIN Page Footer -->
						<?php include('include/messenger.php');?>
                    <!-- END Page Footer -->
                    <!-- BEGIN Shortcuts -->
                   
                </div>
            </div>
        </div>

      
        <script src="/tracker3/app-assets/js/vendors.bundle.js"></script>
        <script src="/tracker3/app-assets/js/app.bundle.js"></script>
        <script src="/tracker3/app-assets/js/datagrid/datatables/datatables.bundle.js"></script>
<script>
	$('#forml').on('submit', function(e){
	  $('#carregar').modal('show');
	});
</script> 
<!--
<script>
	var empresa = 1361;
	var intervalo1 = setTimeout(function() { $('#em_aberto').load('include/contas_receber/aberto.php?id_empresa='+empresa); }, 500);
	var intervalo2 = setTimeout(function() { $('#em_atraso').load('include/contas_receber/atraso.php?id_empresa='+empresa); }, 500);
	var intervalo3 = setTimeout(function() { $('#pagas').load('include/contas_receber/pago.php?id_empresa='+empresa); }, 500);
	var intervalo4 = setTimeout(function() { $('#total').load('include/contas_receber/total.php?id_empresa='+empresa); }, 500);

</script>
-->
<script>
	$(document).ready(function()
	{
		
		$('#dt-basic-example').DataTable(
		{
			
			responsive: true,
			colReorder: true
			
		});

	  

	});

</script>
    </body>
</html>