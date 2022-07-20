<?php
include_once("conexao.php");


$date = date('Y-m-d');	

$base64 = $_GET['c'];
$base64 = base64_decode($base64);
$base = explode("@", $base64);
$id_relatorio = $base[0];
$deviceid = $base[1];
$data_inicial = $base[2];
$data_final = $base[3];


$sql = mysqli_query($conn, "DELETE FROM relatorios_posicoes WHERE deviceid='$deviceid'");
$sql2 = mysqli_query($conn, "DELETE FROM posicoes_relatorios WHERE deviceid='$deviceid'");


$cons_veiculo = mysqli_query($conn, "SELECT * FROM veiculos_clientes WHERE deviceid='$deviceid'  ORDER BY id_veiculo ASC LIMIT 1");
	if(mysqli_num_rows($cons_veiculo) > 0){
		while ($resp_veiculo = mysqli_fetch_assoc($cons_veiculo)) {
		$id_veiculo = $resp_veiculo['id_veiculo'];
		$limite_velocidade = $resp_veiculo['limite_velocidade'];
	}}


$cons_events_ini = mysqli_query($conn, "SELECT id FROM tc_positions WHERE deviceid='$deviceid' AND (fixtime >= '$data_inicial' AND fixtime <= '$data_final') ORDER BY id ASC LIMIT 1");
	if(mysqli_num_rows($cons_events_ini) > 0){
		while ($resp_events_ini = mysqli_fetch_assoc($cons_events_ini)) {
		$posicao_ini = $resp_events_ini['id'];
	}}
		
$cons_events_fim = mysqli_query($conn, "SELECT id FROM tc_positions WHERE deviceid='$deviceid' AND (fixtime >= '$data_inicial' AND fixtime <= '$data_final') ORDER BY id DESC LIMIT 1");
	if(mysqli_num_rows($cons_events_fim) > 0){
		while ($resp_events_fim = mysqli_fetch_assoc($cons_events_fim)) {
		$posicao_fim = $resp_events_fim['id'];
	}}
		
$sql_rel = mysqli_query($conn, "INSERT INTO relatorios_posicoes (deviceid, id_veiculo, data_inicial, data_final, posicao_inicial, posicao_final, data_relatorio, limite_velocidade) VALUES ('$deviceid', '$id_veiculo', '$data_i1', '$data_f1', '$posicao_ini', '$posicao_fim', '$data_hoje', '$limite_velocidade')");
			
			
$cons_relatorio = mysqli_query($conn, "SELECT * FROM relatorios_posicoes WHERE deviceid='$deviceid' ORDER BY id_relatorio DESC LIMIT 1");
	if(mysqli_num_rows($cons_relatorio) > 0){
		while ($resp_rel = mysqli_fetch_assoc($cons_relatorio)) {
		$id_relatorio = $resp_rel['id_relatorio'];
		$posicao_inicial = $resp_rel['posicao_inicial'];
		$posicao_final = $resp_rel['posicao_final'];

	}}


$cons_posicao = mysqli_query($conn,"SELECT servertime, devicetime, fixtime, id, latitude, longitude, address, speed, attributes FROM tc_positions WHERE deviceid='$deviceid' AND ( id >= '$posicao_inicial' AND id <= '$posicao_final') ORDER BY servertime ASC");
	if(mysqli_num_rows($cons_posicao) > 0){
		while ($resp_posicao = mysqli_fetch_assoc($cons_posicao)) {
		$servertime = $resp_posicao['servertime'];
		$servertime = date('Y-m-d H:i:s', strtotime('-3 hour', strtotime($servertime)));
		$devicetime = $resp_posicao['devicetime'];
		$devicetime = date('Y-m-d H:i:s', strtotime('-3 hour', strtotime($devicetime)));
		$fixtime = $resp_posicao['fixtime'];
		$fixtime = date('Y-m-d H:i:s', strtotime('-3 hour', strtotime($fixtime)));
		$positionid = $resp_posicao['id'];
		$latitude = $resp_posicao['latitude'];
		$longitude = $resp_posicao['longitude'];
		$address = $resp_posicao['address'];
		$speed = $resp_posicao['speed'];
		$speed = $speed * 1.609;
		$speed = round($speed, 2);
		
		
		$attributes = $resp_posicao['attributes'];
		$obj = json_decode($attributes);
		$ignicao = $obj->{'ignition'};
		$motion = $obj->{'motion'};
		if (is_bool($ignicao)) $ignicao ? $ignicao = "true" : $ignicao = "false";
		else if ($ignicao !== null) $ignicao = (string)$ignicao;
		
		if (is_bool($motion)) $motion ? $motion = "true" : $motion = "false";
		else if ($motion !== null) $motion = (string)$motion;
		
		if($ignicao == 'true'){
			$ign = 'Ligada';
		}  else if ($ignicao == 'false'){
			$ign = 'Desligada';
		}
		
		if($motion == 'true'){
			$movimento = 'SIM';
		}  else if ($motion == 'false'){
			$movimento = 'NAO';
		}

$insere_posicao = mysqli_query($conn,"INSERT INTO  posicoes_relatorios (positionid, endereco, servertime, devicetime, fixtime, latitude, longitude, speed, ignicao, movimento, id_relatorio, deviceid, nome_motorista) VALUES ('$positionid', '$address', '$servertime', '$devicetime', '$fixtime', '$latitude', '$longitude', '$speed', '$ign', '$movimento', '$id_relatorio', '$deviceid', '$nome_motorista')");


	}}
	
	#=======================================================
#=======================================================

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
		
		

		if($velocidade > $limite_velocidade){
			$alerta = ' ';
			$veloc1 = '<span style="color:#990000"><b>'.$velocidade.' km/h</b></span> <i class="fas fa-exclamation-triangle" style="color:#F4A460"></i>'; 
		}
		if($velocidade <= $limite_velocidade){
			$alerta = ' ';
			$veloc1 = $velocidade.' km/h'; 
		}
		
											
													?>
													<tr>
														<td><b><?php echo $data_pos?></b></td>
														<td><i class="fas fa-map-marker-alt"></i> <?php echo $endereco; ?></td>
														<td><?php echo $velocidade; ?> Km/h</td>
														<td><?php echo $ign3; ?><br><b><?php echo $horas?></b></td>
														<td><a href="http://maps.google.com/maps?q=<?php echo $latitude?>,<?php echo $longitude?>&ll=<?php echo $latitude?>,<?php echo $longitude?>&z=17" target="_blank"><button type="button" class="btn btn-dark btn-sm"><i class="fas fa-map-marked-alt"></i></button></a></td>
													</tr>
<?php }} ?>