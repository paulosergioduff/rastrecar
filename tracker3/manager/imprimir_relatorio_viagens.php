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
$data_inicial_1 = date('d/m/Y H:i', strtotime('-3 hour', strtotime($data_i1)));



$data_final = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_f1)));
$data_final_1 = date('d/m/Y H:i', strtotime('-3 hour', strtotime($data_f1)));




$cons_veiculo = mysqli_query($conn, "SELECT * FROM veiculos_clientes WHERE deviceid='$deviceid'");
if(mysqli_num_rows($cons_veiculo) > 0){
while ($resp_veic = mysqli_fetch_assoc($cons_veiculo)) {
		$id_cliente = $resp_veic['id_cliente'];
		$marca_veiculo =  $resp_veic['marca_veiculo'];
		$modelo_veiculo =  $resp_veic['modelo_veiculo'];
		$placa =  $resp_veic['placa'];
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
						<h4>Relatório de Viagens Realizadas</h4><BR>
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
							
							<?php
	


	$parada = 0;
	$temp_velocidade_media = '';
	$temp_tempo_percurso = '';
	$temp_end_inicial = '';
	$temp_end_final = '';
	$temp_html = '';
	$temp_data_inicial = '';
	$temp_data_final = '';
	$velocidades = 0;
	$velocidade_soma = 0;
	$velocidade_media = 0;
	$temp_km = 0;
	$temp_duracao = 0;
	$temp_hod_inicial = 0;
	$temp_hod_final = 0;
	$speed1 = 0;
	$iniciado = false;
	$cons_conta = mysqli_query($conn,"SELECT * FROM tc_positions WHERE deviceid='$deviceid' AND (servertime >= '$data_inicial' AND servertime <= '$data_final') ORDER BY id ASC");
	$total = mysqli_num_rows($cons_conta);
	/*$html_final = '<table border="1" class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th>.</th>
								<th>HORA</th>
								<th>ENDEREÇO</th>
								<th>Velocidade Média</th>
                                <th>KM PERCORRIDA</th>
						   		 <th>DURAÇÃO</th>
								<th>MAPA</th>
							</tr>
						</thead>
						<tbody>
						
						';*/
						
	if(mysqli_num_rows($cons_conta) > 0){
		while ($resp_conta = mysqli_fetch_array($cons_conta)) {
			//Tratamentos Padroes
			$data = $resp_conta['servertime'];
			$data = date('Y-m-d H:i:s', strtotime('-3 hour', strtotime($data))); 
			$id_pos = $resp_conta['id'];
			$address = $resp_conta['address'];
			$speed = 	$resp_conta['speed'];
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
			
			
			
			$attributes = $resp_conta['attributes'];
			$obj = json_decode($attributes);
			$ignicao = $obj->{'ignition'};
			
			$ignicao = (string)$ignicao;
			
			$total_km = $obj->{'totalDistance'};
			$total_km = $total_km / 1000;
			$total_km = round($total_km, 2);
			//$total_km = number_format($total_km, 2, ",", ".");
			//Colocar aqui os calculos de distancia e velocidade
			$velocidades = $velocidades + 1;
			$velocidade_soma = $velocidade_soma + $speed;
		
			
			$temp_km +=  $total_km;
			
			if($ignicao == 0){
				//Inicio da logica para montar os retornos
				if($iniciado == true){
					if($ignicao != $parada){
						$parada = 0;
						
						$temp_data_final  = $data;
						$temp_end_final = $address;
						$temp_hod_final = $total_km;
						$velocidade_media = round($velocidade_soma/$velocidades,2);
						//Printar uma Linha, e resetar as temporarias
						$km_percurso = $temp_hod_final - $temp_hod_inicial;
						$km_percurso = round($km_percurso, 2);
						
						$diferenca = strtotime($temp_data_final) - strtotime($temp_data_inicial);
						$dias = floor($diferenca / (60 * 60 * 24));


						$data_ini  = $temp_data_final;
						$data_end  = $temp_data_inicial;

						$dif = strtotime($data_end) - strtotime($data_ini);



						$date_time  = new DateTime($temp_data_inicial);
						$diff       = $date_time->diff( new DateTime($temp_data_final));
						$horas = $diff->format('%H horas(s), %i minutos');
						
						$data_format_inicial = date('d/m/Y H:i:s', strtotime($temp_data_inicial)); 
						$data_format_final = date('d/m/Y H:i:s', strtotime($temp_data_final)); 
						
						$data_inicial_vel = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($temp_data_inicial)));
						$data_final_vel = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($temp_data_final)));
						$cons_speed = mysqli_query($conn,"SELECT * FROM tc_positions WHERE deviceid='$deviceid' AND (servertime >= '$data_inicial_vel' AND servertime <= '$data_final_vel') ORDER BY speed DESC LIMIT 1");
							if(mysqli_num_rows($cons_speed) > 0){
						while ($resp_speed = mysqli_fetch_assoc($cons_speed)) {
						$vel_maxima = 	$resp_speed['speed'];
						$vel_maxima = $vel_maxima * 1.609;
						$vel_maxima = round($vel_maxima, 2);
							}}
						
						?>								
									
									 <div class="card border-dark bg-transparent" style="border-left-color:#000; border-bottom:#000 1px solid; border-top:#000 1px solid; border-right:#000 1px solid">
									 <div class="form-group">
										<div class="row">
											<div class="col-md-3">
												<label><b>Data Inicial</b></label><br>
												<i class="far fa-clock"></i> <?php echo $data_format_inicial?>
											</div>
											<div class="col-md-7">
												<label><b>Endereço Inicial</b></label><br>
												<i class="fas fa-map-marker-alt"></i> <?php echo $temp_end_inicial?>
											</div>
											
										</div><br>
										<div class="row">
											<div class="col-md-3">
												<label><b>Data Final</b></label><br>
												<i class="far fa-clock"></i> <?php echo $data_format_final?>
											</div>
											<div class="col-md-7">
												<label><b>Endereço Final</b></label><br>
												<i class="fas fa-map-marker-alt"></i> <?php echo $temp_end_final?>
											</div>
										</div>
										<hr>
										<div class="row">
											<div class="col-md-3">
												<label><b>Distância Total:</b></label><br>
												<i class="fas fa-road"></i> <?php echo $km_percurso?> km rodados
											</div>
											<div class="col-md-3">
												<label><b>Tempo Percurso:</b></label><br>
												<i class="fas fa-history"></i> <?php echo $horas?>
											</div>
											<div class="col-md-3">
												<label><b>Velocidade Média:</b></label><br>
												<i class="fas fa-tachometer-alt"></i> <?php echo $velocidade_media?> km/h
											</div>
											<div class="col-md-3">
												<label><b>Velocidade Máxima:</b></label><br>
												<i class="fas fa-tachometer-alt"></i> <?php echo $vel_maxima?> km/h
											</div>
										 </div>
										</div>
										</div>
										<br>
									
									<?php
									
									
									
						$velocidades = 0;
						$velocidade_soma = 0;
						$velocidade_media = 0;
						$temp_hod_final = 0;
						$temp_hod_inicial = 0;
						$temp_km = 0;
					};
				};
				$ign = '<font color="#006600"><b>LIGADO</b></font>';
			} else {
				if($iniciado == false){
					//Primeiro load
					$iniciado = true;
					$temp_data_inicial  = $data;
					$temp_end_inicial = $address;
					$temp_hod_inicial = $total_km;

				}else{
					if($ignicao != $parada){
						//Mudanca para um novo
						$temp_data_inicial  = $data;
						$temp_end_inicial = $address;
						$temp_hod_inicial = $total_km;
						$parada = 1;
					};
				};
				$ign = '<font color="#990000"><b>Desligado</b></font>';
			};
			
		
		};
	};
	/*$html_final .= '
					</tbody>
				</table>';*/
	//echo($html_final);
?>
					
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
