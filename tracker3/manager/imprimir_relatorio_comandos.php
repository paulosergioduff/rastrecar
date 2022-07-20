<!DOCTYPE html>
<html>
<?php
include("conexao.php");

$base64 = $_GET['c'];
$base64 = base64_decode($base64);
$base = explode("@", $base64);
$deviceid = $base[0];
$data_i1 = $base[1];
$data_f1 = $base[2];


$cons_empresa = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='1361'");
	if(mysqli_num_rows($cons_empresa) > 0){
while ($resp_empresa = mysqli_fetch_assoc($cons_empresa)) {
$nome_url = $resp_empresa['nome_url'];
$logo = $resp_empresa['logo'];
$texto_rodape = $resp_empresa['texto_rodape'];
$texto_topo = $resp_empresa['texto_topo'];
$cor_sistema = $resp_empresa['cor_sistema'];
	}}







$cons_veiculo = mysqli_query($conn, "SELECT * FROM veiculos_clientes WHERE deviceid='$deviceid'");
if(mysqli_num_rows($cons_veiculo) > 0){
while ($resp_veic = mysqli_fetch_assoc($cons_veiculo)) {
		$id_cliente = $resp_veic['id_cliente'];
		$marca_veiculo =  $resp_veic['marca_veiculo'];
		$modelo_veiculo =  $resp_veic['modelo_veiculo'];
		$placa =  $resp_veic['placa'];
		$veiculo = $placa.' - '.$marca_veiculo.'/'.$modelo_veiculo;
}}

$cons_cliente = mysqli_query($conn, "SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
if(mysqli_num_rows($cons_cliente) > 0){
while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
		$nome_cliente = $resp_cliente['nome_cliente'];
}}

	  ?>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>RELATÓRIO DE COMANDOS | <?php echo $veiculo?></title>

    <link href="/tracker/css/bootstrap.min.css" rel="stylesheet">
    <link href="/tracker/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="/tracker/css/animate.css" rel="stylesheet">
    <link href="/tracker/css/style.css" rel="stylesheet">
<script src="https://kit.fontawesome.com/a132241e15.js"></script>

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
						<img src="logos/<?php echo $logo?>" style="width:50%;height:auto" />
					</div>
				</div>
				<div class="col-md-8 text-center" style="color:#000;">
					<div class="form-group">
						<h3><b>SISTEMA DE GESTÃO DE VEÍCULOS</b></h3>
						<h4>Relatório de Comandos</h4><BR>
						<h4><?php echo $nome_cliente?></h4>
						
						<h4><?php echo $veiculo?></h4>
						
						
						
					</div>
				</div>
				
			</div>
			<hr style="border:#000 2px dashed;">
			
			<div class="row" style="color:#000;">
				<div class="col-md-12" >
					<table class="table table-striped table-bordered table-hover">
							
							<thead>
								<tr>
									<th>Data/Hora</th>
									<th>Comando</th>
									<th>Endereço</th>
									<th>Enviado por:</th>
								</tr>
							 </thead>
							<tbody>
						<?php 
						
							$cons_comandos = mysqli_query($conn,"SELECT * FROM comandos_enviados WHERE deviceid='$deviceid' AND executado='SIM' AND (data >='$data_i1' AND data<='$data_f1') ORDER BY id_log DESC ");
								if(mysqli_num_rows($cons_comandos) > 0){
									while ($resp_comandos = mysqli_fetch_assoc($cons_comandos)) {
									$executado = 	$resp_comandos['executado'];
									$address = 	$resp_comandos['address'];
									$comando = 	$resp_comandos['comando'];
									$nome_user = 	$resp_comandos['nome_user'];
									$data_comand = 	$resp_comandos['data'];
									$data_comand = date('d/m/Y H:i:s', strtotime("$data_comand"));
									
									if($comando == 'BLOQUEIO'){
										$comand = '<h4><span class="badge" style="background-color:#CD5C5C; color:#FFF"><i class="fas fa-lock"></i> BLOQUEIO</span></h4>';
									}
									if($comando == 'DESBLOQUEIO'){
										$comand = '<h4><span class="badge" style="background-color:#009900; color:#FFF"><i class="fas fa-lock-open"></i> DESBLOQUEIO</span></h4>';
									}
									if($comando == 'ANCORA'){
										$comand = '<h4><span class="badge" style="background-color:#999; color:#FFF"><i class="fas fa-anchor"></i> ANCORA</span></h4>';
									}
							
						?>
						 <tr>
							<th><font style="font-size:14px;"><?php echo $data_comand?></font></th>
							<td><font style="font-size:14px;"><?php echo $comand; ?></font></td>
							<td><font style="font-size:14px;"><?php echo $address; ?></font></td>
							<td><font style="font-size:14px;"><?php echo $nome_user; ?></font></td>
						</tr>
								<?php }}?>
							</tbody>
					</table>

					
				</div>
				
			</div>
			
		
			
			
		
		
			
			
			
		
			
		
				
			
			
			
		
			
		</div>
		<?php 
		$data = date('d/m/Y');
		$hora = date('H:i:s');
		?>
		<div class="row" style="color:#000;">
				<div class="col-md-6">
					<div class="form-group">
						<p>RMB - Rastreia Mais Brasil - Sistema de Gestão de Veículos</p>
					</div>
				</div>
				<div class="col-md-6 text-right">
					<div class="form-group">
						<p>Documento emitido em <?php echo $data?> às <?php echo $hora?></p>
					</div>
				</div>
			</div>
		
		
		
		
		
		
		
    </div>

    <!-- Mainly scripts -->
    <script src="/tracker/js/jquery-3.1.1.min.js"></script>
    <script src="/tracker/js/popper.min.js"></script>
    <script src="/tracker/js/bootstrap.js"></script>
    <script src="/tracker/js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="/tracker/js/inspinia.js"></script>



</body>

</html>
