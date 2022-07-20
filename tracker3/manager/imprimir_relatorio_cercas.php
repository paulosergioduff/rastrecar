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

    <title>RELATÓRIO DE CERCAS | <?php echo $veiculo?></title>

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
						<h4>Relatório de Cercas</h4><BR>
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
									<th>Entrada</th>
									<th>Horário Entrada</th>
									<th>Saida</th>
									<th>Horário Saída</th>
									<th>Tempo Evento</th>
									<th>Mapa</th>
								</tr>
							 </thead>
							<tbody>
						<?php 
													$data_hoje = date('Y-m-d H:i');

													$cons_conexao = mysqli_query($conn,"SELECT * FROM tc_events WHERE deviceid='$deviceid' AND type='geofenceEnter' AND (servertime >= '$data_inicial' AND servertime <= '$data_final') ORDER BY id ASC");
														if(mysqli_num_rows($cons_conexao)<= 0){
														echo 'Nenhuma Informação Encontrada';
														}
														if(mysqli_num_rows($cons_conexao) > 0){
															while ($resp_conexao = mysqli_fetch_assoc($cons_conexao)) {
															$positionid = 	$resp_conexao['positionid'];
															$servertime1 = $resp_conexao['servertime'];
															$servertime = date('d/m/Y H:i:s', strtotime('-3 hour', strtotime($servertime1)));
															$geofenceid = $resp_conexao['geofenceid'];
															$type = $resp_conexao['type'];
														
															
															$cons_fence = mysqli_query($conn,"SELECT * FROM tc_geofences WHERE id='$geofenceid'");
																if(mysqli_num_rows($cons_fence) > 0){
																while ($row_fence = mysqli_fetch_assoc($cons_fence)) {
																$name_cerca = $row_fence['name'];
																$description = $row_fence['description'];
																}}
															
															$entrada = '<i class="fas fa-chevron-circle-right" style="color:#4169E1"></i> CHEGADA '.$description.'';
															
															$cons_cliente = mysqli_query($conn,"SELECT * FROM tc_positions WHERE id='$positionid'");
																if(mysqli_num_rows($cons_cliente) > 0){
															while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
															$latitude = 	$resp_cliente['latitude'];
															$longitude = 	$resp_cliente['longitude'];
															$address = 	$resp_cliente['address'];
															$driver_num = $resp_cliente['driver_num'];
																
																$cons_driver = mysqli_query($conn, "SELECT * FROM motoristas WHERE cartao_rfid='$driver_num'");
																	if(mysqli_num_rows($cons_driver) <= 0){
																	$nome_motorista = '';
																	}
																	if(mysqli_num_rows($cons_driver) > 0){
																		while ($resp_rel10 = mysqli_fetch_assoc($cons_driver)) {
																		$id_motorista = $resp_rel10['id_motorista'];
																		$nome_motorista = $resp_rel10['nome_motorista'];

																	}}
															
																}}
															
															
															
															
															$cons_fence_ent = mysqli_query($conn,"SELECT * FROM tc_events WHERE deviceid='$deviceid' AND servertime > '$servertime1' AND type='geofenceExit' ORDER BY id ASC LIMIT 1");
																if(mysqli_num_rows($cons_fence_ent) <= 0){
																$saida = '<i class="fab fa-product-hunt" style="color:#F4A460"></i> PARADO NO LOCAL';
																$servertime10 = '';
																$tempo ='';
																}
																if(mysqli_num_rows($cons_fence_ent) > 0){
																while ($row_fence1 = mysqli_fetch_assoc($cons_fence_ent)) {
																$servertime11 = $row_fence1['servertime'];
																$servertime10 = date('d/m/Y H:i:s', strtotime('-3 hour', strtotime($servertime11)));
																$date_time  = new DateTime($servertime1);
																 $diff       = $date_time->diff( new DateTime($servertime11));
																 $tempo = $diff->format('%H hora(s), %i minuto(s)');
																 $saida = '<i class="fas fa-chevron-circle-left" style="color:#009900"></i> SAIDA '.$description.'';
																}}
																
																$horario = $ervertime10;
																
																 
															
															
													?>
													<tr>
														<td><b><?php echo $entrada?></b></td>
														<td><?php echo $servertime?></td>
														<td><b><?php echo $saida?></b></td>
														<td><?php echo $servertime10; ?></td>
														<td><i class="far fa-clock"></i> <?php echo $tempo; ?></td>
														<td><a href="http://maps.google.com/maps?q=<?php echo $latitude?>,<?php echo $longitude?>&ll=<?php echo $latitude?>,<?php echo $longitude?>&z=17" target="_blank"><button type="button" class="btn btn-dark btn-sm btn-icon" title="Google Maps" data-toggle="tooltip" data-offset="0,10" data-original-title="Google Maps"><i class="fas fa-map-marked-alt"></i></button></a></td>
													</tr>
													<tr>
													<td colspan="2" style="border-bottom:#999 1px solid;"><i class="fas fa-user"></i> <?php echo $nome_motorista?></td>
													<td colspan="4" style="border-bottom:#999 1px solid;"><i class="fas fa-map-marker-alt"></i> <?php echo $address?></td>
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
