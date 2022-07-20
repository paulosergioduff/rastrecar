<?php
include_once("conexao.php");

$deviceid = $_REQUEST['deviceid'];	


$cons_estoque = mysqli_query($conn,"SELECT * FROM estoque_rastreadores WHERE deviceid='$deviceid'");
	if(mysqli_num_rows($cons_estoque) > 0){
while ($resp_estoque = mysqli_fetch_assoc($cons_estoque)) {
$imei = 	$resp_estoque['imei'];
$modelo_equip = 	$resp_estoque['modelo_equip'];
$operadora = 	$resp_estoque['operadora'];
$chip = 	$resp_estoque['chip'];
$iccid = 	$resp_estoque['iccid'];
$fornecedor_chip = 	$resp_estoque['fornecedor_chip'];
$obs_bateria = 	$resp_estoque['obs_bateria'];
$data_server = 	$resp_estoque['data_server'];
$data_server1 = date('d/m/Y H:i:s', strtotime('-3 hour', strtotime($data_server)));
$data_gps = 	$resp_estoque['data_gps'];
$data_gps1 = date('d/m/Y H:i:s', strtotime('-3 hour', strtotime($data_gps)));
$positionid = 	$resp_estoque['positionid'];

}}


$data_agora = date('Y-m-d H:i:s');
$data_agora = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_agora)));
$data_inicial_12 = date('Y-m-d H:i:s', strtotime('-5 minutes', strtotime($data_agora)));

if($data_server <= $data_inicial_12){
	$conect = '<span class="badge" style="background-color:#CD5C5C;color:#FFF;width:45%;"><i class="fas fa-wifi fa-2x"></i><br>OFFLINE<br>'.$data_server1.'</span>';
} 
if($data_server > $data_inicial_12){
	$conect = '<span class="badge" style="background-color:#009900;color:#FFF;width:45%;""><i class="fas fa-wifi fa-2x"></i><br>ONLINE<br>'.$data_server1.'</span>';
}
if($data_server == 'Sem Conexao' or $data_server == null){
	$conect = '<span class="badge" style="background-color:#999;color:#FFF;width:45%;""><i class="fas fa-wifi fa-2x"></i><br>DESCONECTADO<br>S/Inf</span><';
}

if($data_gps <= $data_inicial_12){
	$btn_gps = '<span class="badge" style="background-color:#CD5C5C;color:#FFF;width:45%;"><i class="fas fa-satellite-dish fa-2x"></i><br>SEM GPS<br>'.$data_gps1.'</span>';
} 
if($data_gps > $data_inicial_12){
	$btn_gps = '<span class="badge" style="background-color:#009900;color:#FFF;width:45%;""><i class="fas fa-satellite-dish fa-2x"></i><br>GPS Conectado<br>'.$data_gps1.'</span>';
}
if($data_gps == 'Sem Posicao' or $data_gps == null){
	$btn_gps = '<span class="badge" style="background-color:#999;color:#FFF;width:45%;""><i class="fas fa-satellite-dish fa-2x"></i><br>Aguardando GPS<br>S/Inf</span>';
	$btn_bateria = '<span class="badge" style="background-color:#009900;color:#FFF;width:45%;"><i class="fas fa-plug fa-2x"></i><br>Alimentação<br>Conectada</span>';
}


if($data_gps != 'Sem Posicao'){
	$cons_posicao = mysqli_query($conn,"SELECT * FROM tc_positions WHERE id='$positionid'");
	if(mysqli_num_rows($cons_posicao) > 0){
		while ($resp_posicao = mysqli_fetch_assoc($cons_posicao)) {
		$address = 	$resp_posicao['address'];
		$devicetime = 	$resp_posicao['devicetime'];
		$devicetime = date('d/m/Y H:i:s', strtotime('-3 hours', strtotime($devicetime)));
		$attributes = $resp_posicao['attributes'];
		$protocol = $resp_posicao['protocol'];
		$obj = json_decode($attributes);
		$ignicao = $obj->{'ignition'};
		$alarm = $obj->{'alarm'};
		if (is_bool($ignicao)) $ignicao ? $ignicao = "true" : $ignicao = "false";
		else if ($ignicao !== null) $ignicao = (string)$ignicao;	
		
		if($ignicao == 'true'){	
			$btn_ign = '<span class="badge" style="background-color:#009900;color:#FFF;width:30%;"><i class="fas fa-key fa-2x"></i><br>Ignição<br>Ligada</span>';	
		}
		if($ignicao != 'true'){
			$btn_ign = '<span class="badge" style="background-color:#000;color:#FFF;width:30%;"><i class="fas fa-key fa-2x"></i><br>Ignição<br>Desligada</span>';
		}
		if($alarm == 'powerCut'){
			$btn_bateria = '<span class="badge" style="background-color:#CD5C5C;color:#FFF;width:30%;"><i class="fas fa-plug fa-2x"></i><br>Alimentação<br>Desconectada</span>';
		}
		if($alarm != 'powerCut' or $alarm == '' or $alarm == null){
			
			if($data_gps <= $data_inicial_12){
				$btn_bateria = '<span class="badge" style="background-color:#F4A460;color:#FFF;width:30%;"><i class="fas fa-plug fa-2x"></i><br>Aguardando<br>GPS</span>';
			} 
			if($data_gps > $data_inicial_12){
				$btn_bateria = '<span class="badge" style="background-color:#009900;color:#FFF;width:30%;"><i class="fas fa-plug fa-2x"></i><br>Alimentação<br>Conectada</span>';
			}
		}
		
		if($protocol == 'easytrack'){
			$blocked = $obj->{'blocked'};
			if (is_bool($blocked)) $blocked ? $blocked = "true" : $blocked = "false";
			else if ($blocked !== null) $blocked = (string)$blocked;
			

				if($blocked == 'true'){
					$status_bloqueio = '<span class="badge" style="background-color:#CD5C5C;color:#FFF;width:30%;"><i class="fas fa-lock fa-2x"></i><br>Dispositivo<br>Bloqueado</span>';
					
				}
				if($blocked == 'false'){
					$status_bloqueio = '<span class="badge" style="background-color:#009900;color:#FFF;width:30%;"><i class="fas fa-lock-open fa-2x"></i><br>Dispositivo<br>Desbloqueado</span>';
					
				}

		}
		else if($protocol == 'suntech'){
			$blocked = $obj->{'out1'};
			if (is_bool($blocked)) $blocked ? $blocked = "true" : $blocked = "false";
			else if ($blocked !== null) $blocked = (string)$blocked;
			

				if($blocked == 'true'){
					$status_bloqueio = '<span class="badge" style="background-color:#CD5C5C;color:#FFF;width:30%;"><i class="fas fa-lock fa-2x"></i><br>Dispositivo<br>Bloqueado</span>';
					
				}
				if($blocked == 'false'){
					$status_bloqueio = '<span class="badge" style="background-color:#009900;color:#FFF;width:30%;"><i class="fas fa-lock-open fa-2x"></i><br>Dispositivo<br>Desbloqueado</span>';
					
				}

		}
		else if($protocol == 'teltonika'){
			$blocked = $obj->{'out1'};
			if (is_bool($blocked)) $blocked ? $blocked = "true" : $blocked = "false";
			else if ($blocked !== null) $blocked = (string)$blocked;
			

				if($blocked == 'true'){
					$status_bloqueio = '<span class="badge" style="background-color:#CD5C5C;color:#FFF;width:30%;"><i class="fas fa-lock fa-2x"></i><br>Dispositivo<br>Bloqueado</span>';
				}
				if($blocked == 'false'){
					$status_bloqueio = '<span class="badge" style="background-color:#009900;color:#FFF;width:30%;"><i class="fas fa-lock-open fa-2x"></i><br>Dispositivo<br>Desbloqueado</span>';
				}

		}
		else if($protocol == 'gt06'){
			$blocked = $obj->{'blocked'};
			if (is_bool($blocked)) $blocked ? $blocked = "true" : $blocked = "false";
			else if ($blocked !== null) $blocked = (string)$blocked;
			

				if($blocked == 'true'){
					$status_bloqueio = '<span class="badge" style="background-color:#CD5C5C;color:#FFF;width:30%;"><i class="fas fa-lock fa-2x"></i><br>Dispositivo<br>Bloqueado</span>';
					
				}
				if($blocked == 'false'){
					$status_bloqueio = '<span class="badge" style="background-color:#009900;color:#FFF;width:30%;"><i class="fas fa-lock-open fa-2x"></i><br>Dispositivo<br>Desbloqueado</span>';
					
				}

		}
		else if($protocol == 'gps103'){
			$blocked = $obj->{'event'};
			
				if($blocked == 'jt'){
					$status_bloqueio = '<span class="badge" style="background-color:#CD5C5C;color:#FFF;width:30%;"><i class="fas fa-lock fa-2x"></i><br>Dispositivo<br>Bloqueado</span>';
					
				}
				if($blocked != 'jt'){
					$status_bloqueio = '<span class="badge" style="background-color:#009900;color:#FFF;width:30%;"><i class="fas fa-lock-open fa-2x"></i><br>Dispositivo<br>Desbloqueado</span>';
					
				}

		}
		
		
	}}
}
if($data_gps == 'Sem Posicao'){
	$btn_ign = '<span class="badge" style="background-color:#F4A460;color:#FFF;width:30%%;"><i class="fas fa-key fa-2x"></i><br>Aguardando GPS</span>';
	$btn_bateria = '<span class="badge" style="background-color:#F4A460;color:#FFF;width:30%%;"><i class="fas fa-plug fa-2x"></i><br>Aguardando GPS</span>';
}

echo $btn_ign.' '.$btn_bateria.' '.$status_bloqueio.'<br><br>'.$conect.' '.$btn_gps;

?>