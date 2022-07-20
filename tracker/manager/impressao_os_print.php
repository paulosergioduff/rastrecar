<!DOCTYPE html>
<html>
<?php
include("conexao.php");
date_default_timezone_set('Brazil/East');
$data = date('d/m/Y');
$hora = date('H:i');
$date = date('y-m-d H:i:s');

$semana = date("w"); 
$dia = date("j");
$mês = date("n");
$ano = date("Y");

$meses = array(1 => "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", 
"Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro");

$semanas = array("Domingo", "Segunda-Feira", "Terça-Feira", "Quarta-Feira", "Quinta-Feira", "Sexta-Feira", "Sábado");
$user = $_SESSION['usuarioNome'];

$id_cliente = $_GET['id_cliente'];
$id_os = $_GET['id_os'];
$id_veiculo = $_GET['id_veiculo'];


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
	
	if($tipo_os == 'INSTALACAO'){
	$check1 = '<img src="../Imagens/check1.png" width="20" height="20"/>';
	} else {
	$check1 = '<img src="../Imagens/check.png"  width="20" height="20"/>';
	}
	
	
	if($tipo_os == 'MANUTENCAO'){
	$check2 = '<img src="../Imagens/check1.png"  width="20" height="20"/>';
	} else {
	$check2 = '<img src="../Imagens/check.png"  width="20" height="20"/>';
	}
	
	if($tipo_os == 'RETIRADA'){
	$check3 = '<img src="../Imagens/check1.png" width="20" height="20"/>';
	} else {
	$check3 = '<img src="../Imagens/check.png"  width="20" height="20"/>';
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
	
$cons_contrato = mysqli_query($conn,"SELECT * FROM clientes_contratos WHERE nr_contrato='$nr_contrato'");
	if(mysqli_num_rows($cons_contrato) > 0){
while ($resp_contrato = mysqli_fetch_assoc($cons_contrato)) {
$forma_pagamento = 	$resp_contrato['forma_pagamento'];
	}}
	
$cons_parceiro = mysqli_query($conn,"SELECT * FROM parceiros WHERE id_parceiro='$parceiro'");
	if(mysqli_num_rows($cons_parceiro) > 0){
while ($result34 = mysqli_fetch_assoc($cons_parceiro)) {
	$nome_parceiro = $result34['nome_parceiro'];
}}


	  ?>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ORDEM DE SERVIÇO | <?php echo $nome_cliente?></title>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">


<style>
.break { page-break-before: always; }
</style>
</head>

<body class="white-bg" >
    <div class="wrapper wrapper-content p-xl" >
	
	<!-- PÁGINA 1 -->
		<div class="ibox-content p-xl break" style="border-radius:5px; border:#000000 2px solid;">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<img src="/tracker/Imagens/logo2.png" width="161" height="75" />
					</div>
				</div>
				<div class="col-md-8 text-center" style="color:#000;">
					<div class="form-group">
						<h3><b>ORDEM DE SERVIÇO Nº <?php echo $id_os?></b></h3>
						<h4>Instalação / Manutenção / Retirada</h4>
						<p>Prioridade: <b><?php echo $prioridade?></b></p>
					</div>
				</div>
				
			</div>
			<div class="row" style="color:#000;">
				<div class="col-md-12" >
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
				
			</div>
			<div class="row" style="color:#000;">
				<div class="col-md-4" >
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
				<div class="col-md-4" >
					<div class="form-group" style="border-radius:5px; border:#000000 1px solid;">
						<table width="100%" border="0" cellspacing="0">
						  <tr>
							<td>Data Conclusão:</td>
						  </tr>
						  <tr>
							<td align="center" height="22">______/______/______</td>
						  </tr>
						</table>
					</div>
				</div>
				<div class="col-md-4" >
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
				
			</div>
			<div class="row" style="color:#000;">
				<div class="col-md-6" >
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
				<div class="col-md-6" >
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
				
				
			</div>
			<div class="row" style="color:#000;">
				<div class="col-md-12">
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
				
			</div>
			<div class="row" style="color:#000;">
				<div class="col-md-12">
					<div class="form-group" style="border-radius:5px; border:#000000 1px solid;">
						<table width="100%" border="0" cellspacing="0">
							<tr>
							  <td>Endereço:</td>
							  </tr>
							<tr>
							  <td><b><?php echo $endereco?>, <?php echo $numero?> - Compl: <?php echo $complemento?> - <?php echo $bairro?> - <?php echo $cidade?> / <?php echo $estado?> - <?php echo $cep?></b></td>
							  </tr>
							</table>
					</div>
				</div>
				
			</div>
			<div class="row" style="color:#000;">
				<div class="col-md-4" >
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
				<div class="col-md-4" >
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
				<div class="col-md-4" >
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
				
			</div>
			<div class="row" style="color:#000;">
				<div class="col-md-12">
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
				
			</div>
			<div class="row" style="color:#000;">
				<div class="col-md-12">
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
				
			</div>
			<div class="row" style="color:#000;">
				<div class="col-md-12">
					<div class="form-group" style="border-radius:5px; border:#000000 1px solid;"><br>
						<table width="100%" border="0" cellspacing="0">
						  <tr>
							<td width="13%" rowspan="3"><b>Cor dos Fios:</b></td>
							<td width="43%" height="25">Pós Chave:_________________________________</td>
							<td width="44%">Bomba Combustível:_________________________________</td>
						  </tr>
						  <tr>
							<td height="25">Negativo:__________________________________</td>
							<td>Positivo: _____________________________________</td>
						  </tr>
						  <tr>
							<td height="25">Corte Ignição:______________________________</td>
							<td>&nbsp;</td>
						  </tr>
						</table><br>

					</div>
				</div>
				
			</div>
			<div class="row" style="color:#000;">
				<div class="col-md-12">
					<div class="form-group" style="border-radius:5px; border:#000000 1px solid;">
						<table width="100%" border="0" cellspacing="0">
							<tr>
							  <td>Local da Instalação do Equipamento:</td>
							</tr>
							<tr>
							  <td>&nbsp;</td>
							</tr>
						  </table><br><br>
					</div>
				</div>
				
			</div>
			<div class="row" style="color:#000;">
				<div class="col-md-12">
					<div class="form-group" style="border-radius:5px; border:#000000 1px solid;">
						<table width="100%" border="0" cellspacing="0">
							<tr>
							  <td>Serviço Realizado:</td>
							</tr>
							<tr>
							  <td>&nbsp;</td>
							</tr>
						  </table><br><br><br>
					</div>
				</div>
				
			</div>
			<div class="row" style="color:#000;">
				<div class="col-md-6" >
					<div class="form-group" style="border-radius:5px; border:#000000 1px solid;">
						<table width="100%" border="0" cellspacing="0">
						<tr>
						  <td>Valor dos Serviços/Instalação:</td>
						  </tr>
						<tr>
						  <td><b>R$ <?php echo $valor?></b></td>
						  </tr>
						</table>
					</div>
				</div>
				<div class="col-md-6" >
					<div class="form-group" style="border-radius:5px; border:#000000 1px solid;">
						<table width="100%" border="0" cellspacing="0">
							<tr>
							  <td>Forma de Pagamento Mensalidade:</td>
							  </tr>
							<tr>
							  <td><b><?php echo $forma_pagamento?></b></td>
							  </tr>
							</table>
					</div>
				</div>
				
				
			</div>
			<div class="row" style="color:#000;">
				<div class="col-md-12">
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
		
		<div class="row" style="color:#000;">
				<div class="col-md-12 text-right">
					<div class="form-group">
						<p>Documento emitido em <?php echo $data?> às <?php echo $hora?></p>
					</div>
				</div>

			</div>
		
		
		
		
		
		
		
    </div>

    <!-- Mainly scripts -->
    <script src="../js/jquery-3.1.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="../js/inspinia.js"></script>

<script>
    window.print();
    window.addEventListener("afterprint", function(event) { window.close(); });
    window.onafterprint();
</script>

</body>

</html>
