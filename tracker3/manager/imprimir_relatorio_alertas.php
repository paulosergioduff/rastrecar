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


$data_inicial = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_i1)));
$data_inicial_1 = date('d/m/Y H:i' , strtotime($data_i1));


$agrupar = $_POST['agrupar'];

$data_final = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_f1)));
$data_final_1 = date('d/m/Y H:i' , strtotime($data_f1));






$sql = mysqli_query($conn, "SELECT * FROM tc_positions WHERE deviceid='$deviceid' AND (servertime >= '$data_inicial' AND servertime <= '$data_final') ORDER BY id DESC LIMIT 1");
	if(mysqli_num_rows($sql) > 0){
while ($resp_sql = mysqli_fetch_assoc($sql)) {
		$km_1 = $resp_sql['attributes'];
		$obj_km1 = json_decode($km_1);
		$km_1 = $obj_km1->{'totalDistance'};;
	}}
	
	$sql1 = mysqli_query($conn, "SELECT * FROM tc_positions WHERE deviceid='$deviceid' AND (servertime >= '$data_inicial' AND servertime <= '$data_final') ORDER BY id ASC LIMIT 1");
	if(mysqli_num_rows($sql1) > 0){
while ($resp_sql1 = mysqli_fetch_assoc($sql1)) {
		$km_2 = $resp_sql1['attributes'];
		$obj_km2 = json_decode($km_2);
		$km_2 = $obj_km2->{'totalDistance'};;
	}}
	
	$totalkm = $km_1 - $km_2;
	$totalkm = $totalkm / 1000;
	$totalkm = round($totalkm, 2);
	$totalkm = number_format($totalkm, 2, ",", ".");


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

    <title>RELATÓRIO DE ALERTAS | <?php echo $veiculo?></title>

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
						<h4>Relatório de Alertas</h4><BR>
						<h4><?php echo $nome_cliente?></h4>
						
						<h4><?php echo $veiculo?></h4>
						<h4>Período: <?php echo $data_inicial_1?> até <?php echo $data_final_1?></h4>
						
						
					</div>
				</div>
				
			</div>
			<hr style="border:#000 2px dashed;">
			
			<div class="row" style="color:#000;">
				<div class="col-md-12" >
					<table class="table table-striped table-bordered table-hover">
							
							<thead>
								<tr>
									<th>#</th>
									<th>Data/Hora</th>
									<th>Tipo de Alera</th>
									<th>Endereço</th>
									<th>Velocidade</th>
								</tr>
							 </thead>
							<tbody>
						<?php
						
						
							$cons_conta = mysqli_query($conn,"SELECT * FROM tc_events WHERE deviceid='$deviceid' AND (eventtime >= '$data_inicial' AND eventtime <= '$data_final') AND (type='ignitionOff' OR type='ignitionOn' OR type='alarm' OR type='geofenceExit' OR type='geofenceEnter' OR type='deviceOverspeed') ORDER BY id ASC");
							$total = mysqli_num_rows($cons_conta);
								if(mysqli_num_rows($cons_conta) > 0){
									
									

							?>
						
						<?php 
						
							$i = $total;
						while ($row_ev = mysqli_fetch_assoc($cons_conta)) {
							--$i;
									$positionid = $row_ev['positionid'];
									$geofenceid = $row_ev['geofenceid'];
									$horario_alarme = $row_ev['eventtime'];
									$horario_alarme = date('d/m/Y H:i:s', strtotime('-3 hour', strtotime($horario_alarme)));
									$eventos = $row_ev['attributes'];
									$eventos1 = json_decode($eventos);
									$alarme = $eventos1->{'alarm'};
									$type = $row_ev['type'];
									$speed1 = $eventos1->{'speed'};
									$speed1 = $speed1 + 1.609;
									$speed1 = round($speed1, 2);
								
								if($type == 'deviceOverspeed'){
									$notific = '<font color="#990000"><i class="fas fa-tachometer-alt"></i> <b>EXC. VELOCIDADE</b></font>';	
								} 

								if($type == 'ignitionOn'){
									$notific = '<font color="#009900"><i class="fas fa-key"></i> <b>IGNIÇÃO LIGADA</b></font>';	
								} 
								if($type == 'ignitionOff'){
									$notific = '<i class="fas fa-key"></i> <b>IGNIÇÃO DESLIGADA<b/>';
								}
								
								if($alarme == 'powerCut' && $type == 'alarm'){
									$notific = '<font color="#990000"><i class="fas fa-car-battery"></i> <b>BATERIA REMOVIDA</b></font>';
								}
								if($alarme == 'shock' && $type == 'alarm' ){
									$notific = '<font color="#990000"><i class="far fa-bell"></i> <b>ALARME DISPARADO SENSOR</b></font>';
								}
								
								if($alarme == 'door' && $type == 'alarm'){
									$notific = '<font color="#990000"><i class="far fa-bell"></i> <b>ALARME DISPARADO PORTAS</b></font>';
								}
								if($alarme == null && $type == 'geofenceExit'){
									$cons_fence = mysqli_query($conn,"SELECT * FROM tc_geofences WHERE id='$geofenceid'");
								if(mysqli_num_rows($cons_fence) > 0){
							while ($row_fence = mysqli_fetch_assoc($cons_fence)) {
								$name_cerca = $row_fence['name'];
								$description = $row_fence['description'];
								if($description == 'ANCORA'){
									$tipo = '<font color="#990000"><i class="fas fa-anchor"></i> <b>ANCORA VIOLADA</b></font>';

								} else {
									$tipo = '<i class="far fa-vector-square"></i> </b>SAIDA CERCA '.$name_cerca.'</b>';
								}
								
									$notific = $tipo;
								}}}
								if($alarme == null && $type == 'geofenceEnter'){
									$notific = '<i class="far fa-bell"></i> </b>ENTRADA CERCA '.$name_cerca.'</b>';
								}

								
								
															
								$cons_position = mysqli_query($conn,"SELECT * FROM tc_positions WHERE id='$positionid'");
							
								if(mysqli_num_rows($cons_position) > 0){
										while ($resp_posi = mysqli_fetch_assoc($cons_position)) {
											
								$id_pos = $resp_posi['id'];
								$address = $resp_posi['address'];
								$speed = 	$resp_posi['speed'];
								$speed = $speed * 1.609;
								$speed = round($speed, 2);
								$address = str_replace(', BR', '', $address);
								$address1 = explode(",", $address);
								$estado1 = end($address1);
								$estado = ','.$estado1;
								$address = str_replace($estado, '', $address);
								$address1 = explode(",", $address);
								$cep = end($address1);
								$cep = ','.$cep;
								$address = str_replace($cep, '', $address);
								$address = $address.' /'.$estado1;
								
							
						?>
						 <tr>
							<th><font style="font-size:11px;"><?php echo $i?></font></th>
							<th><font style="font-size:11px;"><?php echo $horario_alarme?></font></th>
							<td><font style="font-size:11px;"><?php echo $notific; ?></font></td>
							<td><font style="font-size:11px;"><?php echo $address; ?></font></td>
							<td><font style="font-size:11px;"><?php echo $speed; ?> km/h</font></td>
						</tr>
								<?php }}}}?>
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
