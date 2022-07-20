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
		<script src="https://kit.fontawesome.com/a132241e15.js"></script>
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
                <div class="page-content-wrapper ">
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
										<i class='subheader-icon fal fa-arrows-alt'></i> Recorrências
										<small>
											Lista de Recorrências de Cobranças
										</small>
									</h1>
								</div>
							</div>
							
						</div>
                        
                        
                        <div class="row">
                            <div class="col-xl-12">
                                <div id="panel-1" class="panel">
                                    
                                    <div class="panel-container show">
                                        <div class="panel-content">
											<table id="dt-basic-example" class="table table-bordered table-hover table-striped nowrap" style="width:100%">
												<thead>
													<tr>
														
														<th></th>
														<th></th>
														<th>Data Inicio</th>
														<th>Cliente</th>
														<th>Forma de Pagamento</th>
														<th>Banco</th>
														<th>Valor Mensal</th>
														<th>Status</th>
														<th>Data Término</th>
														<th>Dia Vencimento</th>
														<th>Descrição</th>
														<th>Juros Mensal</th>
														<th>Multa Mensal</th>
														<th>Ultima Cobrança</th>
														<th></th>
													</tr>
												</thead>
											<tbody>
											<?php
				
											$resultado_usuario = mysqli_query($conn,"SELECT * FROM recorrencia ORDER BY id_recorrencia ASC");
											if(mysqli_num_rows($resultado_usuario) > 0){
											while($row_usuario = mysqli_fetch_assoc($resultado_usuario)){
											$data_criacao = $row_usuario['data_criacao'];
											$data_criacao = date('d/m/Y', strtotime("$data_criacao"));
											$data_termino1 = $row_usuario['data_termino'];
											$data_termino = date('d/m/Y', strtotime("$data_termino1"));
											$id_recorrencia = $row_usuario['id_recorrencia'];
											$id_cliente = $row_usuario['id_cliente'];
											$banco = $row_usuario['banco'];
											$forma_pagamento = $row_usuario['forma_pagamento'];
											$primeiro_vencimento = $row_usuario['primeiro_vencimento'];
											$valor = $row_usuario['valor'];
											$valor = number_format($valor, 2, ",", ".");
											$descricao = $row_usuario['descricao'];
											$dias_cobranca = $row_usuario['dias_cobranca'];
											$ativo = $row_usuario['ativo'];
											$juros = $row_usuario['juros'];
											$multa = $row_usuario['multa'];
											$id_repay = $row_usuario['id_repay'];
											$ultima_cobranca1 = $row_usuario['ultima_cobranca'];
											$dia_vencimento = $row_usuario['dia_vencimento'];
											$id_assinatura = $row_usuario['id_assinatura'];
											$ref_pag = $row_usuario['ref_pag'];
											
											
											$prazo_termino = date('Y-m-d', strtotime('-30 days', strtotime($data_termino1)));
											$data_hoje = date('Y-m-d');
											
											if($data_termino1 > $prazo_termino){
												$vencimento_recorrencia = '<h5><span class="badge" style="background-color:#009900;color:#FFF">'.$data_termino.'</span></h5>';
											}
											if($data_termino1 <= $prazo_termino && $data_termino1 > $data_hoje){
												$vencimento_recorrencia = '<h5><span class="badge" style="background-color:#F4A460;color:#FFF">'.$data_termino.'</span></h5>';
											}
											if($data_termino1 < $data_hoje){
												$vencimento_recorrencia = '<h5><span class="badge" style="background-color:#CD5C5C;color:#FFF">'.$data_termino.'</span></h5>';
											}
											
											
											$cons_cliente = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
												if(mysqli_num_rows($cons_cliente) > 0){
													while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
													$nome_cliente = 	$resp_cliente['nome_cliente'];
												}}
											
											
											$cons_status = mysqli_query($conn,"SELECT * FROM bancos WHERE id_banco='$banco'");
												if(mysqli_num_rows($cons_status) > 0){
													while ($resp_status = mysqli_fetch_assoc($cons_status)) {
													$nome_banco = 	$resp_status['nome_banco'];
												}}
											
											$cons_veiculos = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE id_recorrencia='$id_recorrencia'");
											$qtd_veiculos = mysqli_num_rows($cons_veiculos);
											
											
											if($ativo == 'SIM'){
												$status1 = '<h5><span class="badge" style="background-color:#009900;color:#FFF">ATIVO</span></h5>';
											}
											if($ativo != 'SIM'){
												$status1 = '<h5><span class="badge" style="background-color:#FF6347;color:#FFF" >INATIVO</span></h5>';
											}
											
											if($forma_pagamento == 'Boleto Bancario'){
												$forma_pagamento1 = '<i class="fal fa-barcode-read"></i> Boleto Bancario';
											}
											if($forma_pagamento != 'Boleto Bancario'){
												$forma_pagamento1 = '<i class="fal fa-credit-card"></i> Cartao de Credito';
											}

											
											if($ultima_cobranca1 == '0000-00-00'){
												$ultima_cobranca = '';
											}
											if($ultima_cobranca1 != '0000-00-00'){
												$ultima_cobranca = date('d/m/Y', strtotime("$ultima_cobranca1"));
											}
											
											$data_hj = date('Y-m-d');
											
											$cons_fat_atraso = mysqli_query($conn,"SELECT * FROM contas_receber WHERE id_recorrencia='$id_recorrencia' AND status='Em Aberto' AND data_vencimento < '$data_hj'");
											$fat_atraso = mysqli_num_rows($cons_fat_atraso);
											
											if($fat_atraso >= 1){
												$alerta_atraso = '<span style="color:#990000" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Recorrência com faturas em atraso"><b>'.$nome_cliente.' <i class="fas fa-file-invoice-dollar"></i></b></span>';
												$cor = 'style="background-color:#EBD7D3"';
											}
											if($fat_atraso <= 0){
												$alerta_atraso = $nome_cliente;
												$cor = '';
											}
											
											
											
											$base64 = 'id_recorrencia:'.$id_recorrencia.'';
											$base64 = base64_encode($base64);
											
											if($banco == 1){
												$banco_emissor = '<img src="/tracker2/Imagens/pjb.png" style="width:20px; heigth:17px"> PJ BANK';
												$botao_editar = '<a href="editar_recorrencia.php?c='.$base64.'"><button type="button" class="btn btn-primary btn-sm"><i class="fal fa-edit"></i> Alterar</button></a>';
												$imagem = 'PJ BANK';
												$btn_encerrar = '<a href="encerrar_recorrencia.php?c='.$id_recorrencia.'"><button type="button" class="btn btn-danger btn-sm shadow-0"><i class="fal fa-window-close"></i> Encerrar</button></a>';
												$status_cartao = '';
											}
											if($banco == 5){
												$banco_emissor = '<img src="/tracker2/Imagens/asaas.jpg" style="width:20px; heigth:17px"> ASAAS';
												$botao_editar = '<a href="editar_recorrencia_asaas.php?c='.$base64.'"><button type="button" class="btn btn-primary btn-sm"><i class="fal fa-edit"></i> Alterar</button></a>';
												$imagem = 'ASAAS BANK';
												$btn_encerrar = '<a href="encerrar_recorrencia_asaas.php?c='.$id_recorrencia.'"><button type="button" class="btn btn-danger btn-sm shadow-0"><i class="fal fa-window-close"></i> Encerrar</button></a>';
												if($id_assinatura != '0'){
													$status_cartao = '<h5><span class="badge" style="background-color:#009900;color:#FFF">CARTÃO CADASTRADO</span></h5>';
												}
												if($id_assinatura == '0'){
													$status_cartao = '<h5><span class="badge" style="background-color:#FF6347;color:#FFF" >SEM CARTÃO</span></h5>';
												}
											}
											
											
											
											$botao_excluir = '<button type="button" class="btn btn-danger btn-xs shadow-0"  data-toggle="modal" data-target="#encerrar'.$id_recorrencia.'">Encerrar Recorrência</button>';
											
											
											?>
											<tr <?php echo $cor?>>
												<td></td>
												<td><button type="button" class="btn btn-dark btn-icon btn-sm" data-toggle="modal" data-target="#recorr<?php echo $id_recorrencia?>"><i class="fab fa-elementor" data-toggle="tooltip" data-placement="top" data-original-title="Ver Detalhes"></i></button></td>
												<td><?php echo $data_criacao; ?></td>
												<td><?php echo $alerta_atraso; ?></td>
												<td><?php echo $forma_pagamento1; ?></td>
												<td><?php echo $banco_emissor; ?></td>
												<td>R$ <?php echo $valor; ?></td>
												<td><?php echo $status1; ?></td>
												<td><?php echo $vencimento_recorrencia; ?></td>
												<td><?php echo $dia_vencimento; ?></td>
												<td><?php echo $descricao; ?></td>
												<td><?php echo $juros; ?>%</td>
												<td><?php echo $multa; ?>%</td>
												<td><?php echo $ultima_cobranca; ?></td>
												<td><?php echo $botao_excluir; ?></td>
											</tr>
											
											
											
											
											<div class="modal fade" id="encerrar<?php echo $id_recorrencia?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered">
													<div class="modal-content">
														<div class="modal-header bg-danger text-white">
															<h4 class="modal-title" id="myLargeModalLabel" style="color:#FFF;">ATENÇÃO!</h4>
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
														</div>
														<div class="modal-body">
															<b>ENCERRAR RECORRÊNCIA?</b><BR />
															<?php echo $id_recorrencia?> - <?php echo $nome_cliente; ?><br><br>
															R$ <?php echo $valor?> - Término: <?php echo $data_termino; ?><br><br>

															Deseja prosseguir?
														</div>
														<div class="modal-footer">
															 <button type="button" class="btn btn-success btn-sm shadow-0" data-dismiss="modal">Cancelar</button>
															 <?php echo $btn_encerrar?>
														</div>
													</div>
												</div>
											</div>
												
											<div class="modal fade default-example-modal-right" id="recorr<?php echo $id_recorrencia?>" tabindex="-1" role="dialog" aria-hidden="true">
													<div class="modal-dialog modal-dialog-right  modal-lg">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title h4">RECORRÊNCIA</h5>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true"><i class="fal fa-times"></i></span>
																</button>
															</div>
															<div class="modal-body">
																<div class="row">
																	<div class="col-md-4">
																		<?php echo $botao_editar?>
																		
																		
																	</div>
																	
																</div><br>
																<div class="card mb-5" style="border:#ccc 1px solid;">
																	<div class="card-body p-3">
																		<h4><span class="badge badge-dark">INFORMAÇÕES DA RECORRÊNCIA</span></h4><br>
																		<div class="row">
																			<div class="col-md-12">
																				<label>Cliente</label><br>
																				<span ><b><?php echo $nome_cliente?></b></span>
																			</div>
																			
																		</div><br>
																		<div class="row">
																			<div class="col-md-4">
																				<label>Data Criação da Recorrência</label><br>
																				<span ><b><?php echo $data_criacao; ?></b></span>
																			</div>
																			<div class="col-md-4">
																				<label>Forma de Pagamento:</label><br>
																				<span ><b><?php echo $forma_pagamento1?></b></span>
																			</div>
																			<div class="col-md-4">
																				<label>Banco:</label><br>
																				<span ><b><?php echo $nome_banco?></b></span>
																			</div>
																		</div><br>
																		<div class="row">
																			<div class="col-md-4">
																				<label>Valor Mensal</label><br>
																				<span ><b>R$ <?php echo $valor?></b></span>
																			</div>
																			<div class="col-md-4">
																				<label>Dia do Vencimento:</label><br>
																				<span ><b>todo dia <?php echo $dia_vencimento?></b></span>
																			</div>
																			
																			<div class="col-md-4">
																				<label>Status</label><br>
																				<span ><b><?php echo $status1; ?></b></span>
																			</div>
																		</div><br>
																		<div class="row">
																			<div class="col-md-4">
																				<label>Término Recorrência</label><br>
																				<span ><b><?php echo $vencimento_recorrencia; ?></b></span>
																			</div>
																			<div class="col-md-8">
																				<label>Descrição</label><br>
																				<span ><b><?php echo $descricao?></b></span>
																			</div>
																		</div><br>
																		<div class="row">
																			<div class="col-md-4">
																				<label>Status Cartão</label><br>
																				<span ><b><?php echo $status_cartao; ?></b></span>
																			</div>
																			
																		</div><br>
																	</div>
																</div>
																<div class="card mb-5" style="border:#ccc 1px solid;">
																	<div class="card-body p-3">
																		<h4><span class="badge badge-dark">VEÍCULOS DA RECORRÊNCIA</span></h4><br>
																		<?php
																		$cons_veic = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE id_recorrencia='$id_recorrencia'");
																		if(mysqli_num_rows($cons_veic) > 0){
																			while ($resp_veic = mysqli_fetch_assoc($cons_veic)) {
																			$placa = 	$resp_veic['placa'];
																			$marca_veiculo = 	$resp_veic['marca_veiculo'];
																			$modelo_veiculo = 	$resp_veic['modelo_veiculo'];
																			$valor_mensal = 	$resp_veic['valor_mensal'];
																			$valor_mensal = number_format($valor_mensal, 2, ",", ".");
																			
																		?>
																		<div class="row">
																			<div class="col-md-8">
																				<label>Veículo:</label><br>
																				<span ><b><?php echo $placa; ?> - <?php echo $marca_veiculo; ?>/<?php echo $modelo_veiculo; ?></b></span>
																			</div>
																			<div class="col-md-4">
																				<label>Valor Mensal:</label><br>
																				<span ><b>R$ <?php echo $valor_mensal?></b></span>
																			</div>
																		</div><br>
																		
																		<?php
																		
																		}}
																		?>	
																	</div>
																</div>
																<div class="card mb-5" style="border:#ccc 1px solid;">
																	<div class="card-body p-3">
																		<h4><span class="badge badge-dark">FATURAS EMITIDAS</span></h4><br>
																		<?php
																		$cons_veic = mysqli_query($conn,"SELECT * FROM contas_receber WHERE id_recorrencia='$id_recorrencia' ORDER BY data_vencimento DESC");
																		if(mysqli_num_rows($cons_veic) > 0){
																			while ($resp_veic = mysqli_fetch_assoc($cons_veic)) {
																			$data_vencimento_fat1 = 	$resp_veic['data_vencimento'];
																			$data_vencimento_fat = date('d/m/Y', strtotime("$data_vencimento_fat1"));
																			$valor_bruto = 	$resp_veic['valor_bruto'];
																			$status_fat = 	$resp_veic['status'];
																			$valor_bruto = number_format($valor_bruto, 2, ",", ".");
																			
																			$data_hj1 = date('Y-m-d');
																			
																		if($status_fat == 'Em Aberto' && $data_vencimento_fat1 < $data_hj1){
																			$status_conta1 = '<h5><span class="badge" style="background-color:#FF6347;color:#FFF">EM ATRASO</span></h5>';
																			
																		}
																		if($status_fat == 'Em Aberto' && $data_vencimento_fat1 >= $data_hj1){
																			$status_conta1 = '<h5><span class="badge" style="background-color:#4682B4;color:#FFF">AGUAR. PGTO</span></h5>';
																			
																			
																		}
																		
																		if($status_fat == 'Pago'){
																			$status_conta1 = '<h5><span class="badge" style="background-color:#009900;color:#FFF">PAGO</span></h5>';
																			
																		}
																			
																		?>
																		<div class="row">
																			<div class="col-md-4">
																				<label>Data Vencimento:</label><br>
																				<span ><b><?php echo $data_vencimento_fat; ?></b></span>
																			</div>
																			<div class="col-md-4">
																				<label>Valor:</label><br>
																				<span ><b>R$ <?php echo $valor_bruto?></b></span>
																			</div>
																			<div class="col-md-4">
																				<label>Status Pgto:</label><br>
																				<span ><b><?php echo $status_conta1?></b></span>
																			</div>
																		</div>
																		<hr style="border:#CCC 1px dashed;">
																		
																		<?php
																		
																		}}else{
																		echo 'Nenhuma Fatura Gerada';
																		}
																		?>	
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
											}}?>
											</tbody>
											</table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
    </body>
</html>
