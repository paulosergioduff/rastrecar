<!DOCTYPE html>
<html>
<?php
include("conexao.php");

$base64 = $_GET['c'];
$base64 = base64_decode($base64);
$base = explode("@", $base64);
$id_relatorio = $base[0];
$deviceid = $base[1];
$data_inicial = $base[2];
$data_final = $base[3];

$agrupar = 'SIM';

$cons_empresa = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='1361'");
	if(mysqli_num_rows($cons_empresa) > 0){
while ($resp_empresa = mysqli_fetch_assoc($cons_empresa)) {
$nome_url = $resp_empresa['nome_url'];
$logo = $resp_empresa['logo'];
$texto_rodape = $resp_empresa['texto_rodape'];
$texto_topo = $resp_empresa['texto_topo'];
$cor_sistema = $resp_empresa['cor_sistema'];
	}}

$data_inicial_br = date('d/m/Y H:i:s', strtotime('-3 hour', strtotime($data_inicial)));
$data_final_br = date('d/m/Y H:i:s', strtotime('-3 hour', strtotime($data_final)));

	$sql1 = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE deviceid = '$deviceid'");
	if(mysqli_num_rows($sql1) > 0){
while ($rows4 = mysqli_fetch_assoc($sql1)) {
	$id_cliente = $rows4['id_cliente'];

	}}
	


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




$sql = mysqli_query($conn, "SELECT * FROM tc_positions WHERE deviceid='$deviceid' AND (servertime >= '$data_inicial' AND servertime <= '$data_final') ORDER BY id DESC LIMIT 1");
	if(mysqli_num_rows($sql) > 0){
while ($resp_sql = mysqli_fetch_assoc($sql)) {
		$latitude_final = $resp_sql['latitude'];
		$longitude_final = $resp_sql['longitude'];
		$km_1 = $resp_sql['attributes'];
		$obj_km1 = json_decode($km_1);
		$km_1 = $obj_km1->{'totalDistance'};;
	}}
	
	$sql1 = mysqli_query($conn, "SELECT * FROM tc_positions WHERE deviceid='$deviceid' AND (servertime >= '$data_inicial' AND servertime <= '$data_final') ORDER BY id ASC LIMIT 1");
	if(mysqli_num_rows($sql1) > 0){
while ($resp_sql1 = mysqli_fetch_assoc($sql1)) {
		$latitude_inicial = $resp_sql1['latitude'];
		$longitude_inicial = $resp_sql1['longitude'];
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
		$tipo_veiculo =  $resp_veic['tipo_veiculo'];
		$veiculo = $placa.' - '.$marca_veiculo.' / '.$modelo_veiculo;
		
}}

if($tipo_veiculo == 'Automovel'){
	$imagem = 'car.png';
}
else if($tipo_veiculo == 'Caminhao'){
	$imagem = 'truck.png';
}
else if($tipo_veiculo == 'PickUp'){
	$imagem = 'car.png';
}
else if($tipo_veiculo == 'Motocicleta'){
	$imagem = 'moto.png';
} else {
$imagem = 'car.png';
}

$cons_cliente = mysqli_query($conn, "SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
if(mysqli_num_rows($cons_cliente) > 0){
while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
		$nome_cliente = $resp_cliente['nome_cliente'];
}}



function segundos_em_tempo($segundos) {
 
 $horas = floor($segundos / 3600);
 $minutos = floor($segundos % 3600 / 60);
 $segundos = $segundos % 60;
 
 return sprintf("%02d:%02d:%02d", $horas, $minutos, $segundos);
 
}
	


	
	
		$cons_eventos_off = mysqli_query($conn,"SELECT * FROM tc_events WHERE deviceid='$deviceid' AND (eventtime >= '$data_inicial' AND eventtime <= '$data_final') AND (type='ignitionOn' OR type='ignitionOff') ORDER BY eventtime ASC");
	if(mysqli_num_rows($cons_eventos_off) > 0){
		while ($row_ev_off = mysqli_fetch_assoc($cons_eventos_off)) {
			
			
			$listagem[] = $row_ev_off;  
			
		}
		
		for ($i=0; $i < count($listagem); $i++) { 
			
		if($listagem[$i]["type"]=='ignitionOn' && $listagem[$i+1]["type"] == 'ignitionOff'){
		
				$date_time  = new DateTime($listagem[$i]['eventtime']);
				$diff       = $date_time->diff( new DateTime($listagem[$i+1]['eventtime']));
				$horas_mov[] = $diff->format('%H:%i:%s');
				
				//echo ''.$listagem[$i]['type'].': '.$listagem[$i]['servertime'].' - '.$listagem[$i+1]['type'].': '.$listagem[$i+1]['servertime'].' - Tempo Movimento: '.$horas.'<br>';

		}
		if($listagem[$i]["type"]=='ignitionOn' && $listagem[$i+1]["type"] == ''){

				$date_time  = new DateTime($listagem[$i]['eventtime']);
				$diff       = $date_time->diff( new DateTime($data_final));
				$horas_mov[] = $diff->format('%H:%i:%s');
				
				//echo ''.$listagem[$i]['type'].': '.$listagem[$i]['servertime'].' - '.$listagem[$i+1]['type'].': '.$listagem[$i+1]['servertime'].' - Tempo Movimento: '.$horas.'<br>';


		} 
		
		if($listagem[$i]["type"]=='ignitionOff' && $listagem[$i+1]["type"] == 'ignitionOn'){
		
				$date_time  = new DateTime($listagem[$i]['eventtime']);
				$diff       = $date_time->diff( new DateTime($listagem[$i+1]['eventtime']));
				$horas_stop[] = $diff->format('%H:%i:%s');
				
				//echo ''.$listagem[$i]['type'].': '.$listagem[$i]['servertime'].' - '.$listagem[$i+1]['type'].': '.$listagem[$i+1]['servertime'].' - Tempo Parado: '.$horas.'<br>';

		}
		if($listagem[$i]["type"]=='ignitionOff' && $listagem[$i+1]["type"] == ''){

				$date_time  = new DateTime($listagem[$i]['eventtime']);
				$diff       = $date_time->diff( new DateTime($data_final));
				$horas_stop[] = $diff->format('%H:%i:%s');
				
				//echo ''.$listagem[$i]['type'].': '.$listagem[$i]['servertime'].' - '.$listagem[$i+1]['type'].': '.$listagem[$i+1]['servertime'].' - Tempo Parado: '.$horas.'<br>';


		} 
		
	//echo ''.$horas.'<br>';

	}}
	
	
	
	$soma = 0;
	$soma1 = 0;
 
foreach($horas_stop as $item1) {
	list($horas,$minutos,$segundos) = explode(":",$item1);
	$calc1 = $horas * 3600 + $minutos * 60 + $segundos;
	$soma1 = $calc1 + $soma1;
}



foreach($horas_mov as $item) {
	list($horas,$minutos,$segundos) = explode(":",$item);
	$calc = $horas * 3600 + $minutos * 60 + $segundos;
	$soma = $calc + $soma;
}
 
$total_mov = segundos_em_tempo($soma);
$total_mov = explode(":", $total_mov);
$hora_mov = $total_mov[0];
$min_mov = $total_mov[1];

$total_stop = segundos_em_tempo($soma1);
$total_stop = explode(":", $total_stop);
$hora_stop = $total_stop[0];
$min_stop = $total_stop[1];

$total_movimento =  ''.$hora_mov.' hora(s) e '.$min_mov.' minutos <br>';
$total_parado = ''.$hora_stop.' hora(s) e '.$min_stop.' minutos';

	
	
	
#------------------------------------------------
#------------------------------------------------
$valor_comb = $_POST['valor_comb'];
$valor_comb = str_replace(".","","$valor_comb");
$valor_comb = str_replace(",",".","$valor_comb");
$km_litro = $_POST['km_litro'];

$consumo = $totalkm / $km_litro;

$valor_gasto = $consumo * $valor_comb;
$valor_gasto1 = number_format($valor_gasto, 2, ",", ".");


	


	  ?>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>RELATÓRIO DE PERCURSO | <?php echo $veiculo?></title>

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
						<h4><?php echo $nome_cliente?></h4>
						<h4>Relatório de Percurso</h4><BR>
						<h4><?php echo $veiculo?></h4>
						<h4>Período: <?php echo $data_inicial_br?> até <?php echo $data_final_br?></h4>
						
						
					</div>
				</div>
				
			</div>
			<hr style="border:#000 2px dashed;">
			<div class="row" style="color:#000;">
				<div class="col-md-4" >
					<div class="form-group text-center" style="border-radius:5px; border:#000000 1px solid;">
						<b>TEMPO PARADO</b><br>
						<?php echo $total_parado?>
					</div>
				</div>
				<div class="col-md-4" >
					<div class="form-group text-center" style="border-radius:5px; border:#000000 1px solid;">
						<b>TEMPO EM MOVIMENTO</b><br>
						<?php echo $total_movimento?>
						  
					</div>
				</div>
				<div class="col-md-4" >
					<div class="form-group text-center" style="border-radius:5px; border:#000000 1px solid;">
						<b>DISTÂNCIA PERCORRIDA</b><br>
						<?php echo $totalkm?> Km
					</div>
				</div>
				
			</div>
			<div class="row" style="color:#000;">
				<div class="col-md-12" >
					<table class="table table-striped table-bordered table-hover">
														<thead>
															<tr>
																<th>Data/Hora</th>
																<th>Endereço</th>
																<th>Velocidade</th>
																<th>Ignição</th>
															</tr>
														 </thead>
														<tbody>
														<?php 
								$data_hoje = date('Y-m-d H:i');


								


								$cons_pos = mysqli_query($conn,"SELECT * FROM posicoes_relatorios WHERE id_relatorio='$id_relatorio' ORDER BY fixtime ASC");
									if(mysqli_num_rows($cons_pos) > 0){
										while ($resp_pos = mysqli_fetch_assoc($cons_pos)) {
										$horario = $resp_pos['fixtime'];
										$horario_br = date('d/m/Y H:i:s', strtotime("$horario"));
										$ign2 = $resp_pos['ignicao'];
										$latitude = $resp_pos['latitude'];
										$longitude = $resp_pos['longitude'];
										$endereco = $resp_pos['endereco'];
										$veloc = $resp_pos['speed'];
										$movimento = $resp_pos['movimento'];
										$id_pos = $resp_pos['id'];
										$nome_motorista = $resp_pos['nome_motorista'];
										


										if($ign2 == 'Desligada'){
											$cons_posicao_desl = mysqli_query($conn,"SELECT * FROM posicoes_relatorios WHERE id_relatorio = '$id_relatorio' AND fixtime > '$horario' AND ignicao = 'Ligada' ORDER BY id ASC LIMIT 1");
												
												if(mysqli_num_rows($cons_posicao_desl) > 0){
													while ($resp_posicao_desl = mysqli_fetch_assoc($cons_posicao_desl)) {
													$hora_proximo = $resp_posicao_desl['fixtime'];
													$hora_proximo_br = date('d/m/Y H:i:s', strtotime("$hora_proximo"));
													
													if($hora_proximo < $horario){
														$data_pos = $horario_br;
													} else {
														$data_pos = $horario_br.' até <br>'.$hora_proximo_br;
														
													}
												}}
												$date1 = new DateTime($horario);
												$date2 = new DateTime($hora_proximo);

												// The diff-methods returns a new DateInterval-object...
												$diff = $date2->diff($date1);

												// Call the format method on the DateInterval-object
												$horas = $diff->format('%h horas e %i minutos');
												$velocidade = '0.00';
												$ign3 = '<span style="color:#990000"><i class="fab fa-product-hunt"></i>  PARADA</b></span>';
										}
										
										
										
										
										$str_ign = 'Desligado';
										if($ign2 == 'Ligada'){
											$str_ign = 'Ligada';
											$data_pos = $horario_br;
											$velocidade = $veloc;
											
											$horas = '';
											if($veloc == 0){
												$ign3 = '<span style="color:#F4A460"><b><i class="fas fa-key"></i> Parado com IGN ligada</b></span>';
											} else {
												$ign3 = '<span style="color:#228B22"><b><i class="fas fa-key"></i> '.$ign2.' em Movimento</b></span>';
											}
										};
										if($agrupar == 'SIM'){
											if($last_ign == 'Desligado' && $str_ign == 'Desligado'){
												continue;
											};
										};
										$last_ign = $str_ign;
										
										

										if($veloc > '60'){
											$alerta = ' ';
											$veloc1 = '<span style="color:#990000"><b>'.$veloc.' km/h</b></span> <i class="fas fa-exclamation-triangle" style="color:#F4A460"></i>'; 
										}
										if($veloc <= '60'){
											$alerta = ' ';
											$veloc1 = $veloc.' km/h'; 
										}
										if($nome_motorista == ''){
											$motorista = '';
										}
										if($nome_motorista != ''){
											$motorista = '<hr style="border:#999 1px solid;"><i class="fas fa-user-tie"></i>  <b>Motorista: '.$nome_motorista.'</b>';
										}
										
										
														
													?>
													<tr>
														<td><b><?php echo $data_pos?></b></td>
														<td><?php echo $endereco; ?><br><?php echo $motorista?></td>
														<td><?php echo $veloc1; ?></td>
														<td><?php echo $ign3; ?><br><b><?php echo $horas?></b></td>
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
