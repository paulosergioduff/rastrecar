<?php

include_once("conexao.php");

$deviceid = $_REQUEST['deviceid'];		

	$cons_device = mysqli_query($conn,"SELECT * FROM tc_devices WHERE id='$deviceid'");
	if(mysqli_num_rows($cons_device) <= 0){
		$btn_conexao = '<div class="badge badge-danger badge-xl"><i class="fas fa-wifi"></i> <br><span style="font-size:13px">Offline</span></div>';	
	
	}
	if(mysqli_num_rows($cons_device) > 0){
		while ($row_device = mysqli_fetch_assoc($cons_device)) {
		$name = $row_device['name'];
		$positionid = $row_device['positionid'];
		$uniqueid = $row_device['uniqueid'];
		$servertime_dev = $row_device['lastupdate'];
		$servertime_dev1 = date('d/m/Y H:i:s', strtotime('-3 hour', strtotime($servertime_dev)));			
		
			if($servertime_dev != ''){
				$btn_conexao = '<div class="badge badge-success badge-xl" data-toggle="popover" data-container="body" data-content="'.$servertime_dev1.'" data-placement="top" data-original-title="ULTIMA CONEXÃO"><i class="fas fa-wifi"></i> <br><span style="font-size:13px">Disp. Conectado</span></div>';	
			}
			if($servertime_dev == ''){	
				$btn_conexao = '<div class="badge badge-danger badge-xl"><i class="fas fa-wifi"></i> <br><span style="font-size:13px">Disp. Offline</span></div>';	
			}
			
			if($positionid >= 1){
				$cons_posicao = mysqli_query($conn,"SELECT * FROM tc_positions WHERE id='$positionid'");
				if(mysqli_num_rows($cons_posicao) > 0){
					while ($resp_posicao = mysqli_fetch_assoc($cons_posicao)) {
					$address = 	$resp_posicao['address'];
					$devicetime = 	$resp_posicao['devicetime'];
					$devicetime = date('d/m/Y H:i:s', strtotime('-3 hours', strtotime($devicetime)));
					$attributes = $resp_posicao['attributes'];
					$obj = json_decode($attributes);
					$ignicao = $obj->{'ignition'};
					$alarm = $obj->{'alarm'};
					if (is_bool($ignicao)) $ignicao ? $ignicao = "true" : $ignicao = "false";
					else if ($ignicao !== null) $ignicao = (string)$ignicao;
						
					$btn_gps =  '<div class="badge badge-success badge-xl" data-toggle="popover" data-container="body" data-content="'.$address.'" data-placement="top" data-original-title="ENDEREÇO"><i class="fas fa-satellite-dish"></i> <br><span style="font-size:13px">GPS Conectado</span></div>';	
					
					if($ignicao == 'true'){	
						$btn_ign = '<div class="badge badge-success badge-xl"><i class="fas fa-key"></i> <br><span style="font-size:13px">Ligado</span></div>';	
					}
					if($ignicao != 'true'){
						$btn_ign = '<div class="badge badge-dark badge-xl"><i class="fas fa-key"></i> <br><span style="font-size:13px">Desligado</span></div>';
					}
					if($alarm == 'powerCut'){
						$btn_bateria = '<div class="badge badge-danger badge-xl"><i class="fas fa-plug"></i> <br><span style="font-size:13px">Sem Alimentação</span></div>';
					}
					if($alarm != 'powerCut' or $alarm == '' or $alarm == null){
						$btn_bateria = '<div class="badge badge-success badge-xl"><i class="fas fa-plug"></i> <br><span style="font-size:13px">Alimentação OK</span></div>';
					}
					
				}}
			}
			if($positionid <= 0 or $positionid == ''){
				$btn_ign = '<div class="badge badge-warning badge-xl"><i class="fas fa-key"></i> <br><span style="font-size:13px">Aguardando GPS</span></div>';
				$btn_gps =  '<div class="badge badge-danger badge-xl"><i class="fas fa-satellite-dish"></i> <br><span style="font-size:13px">Aguardando GPS</span></div>';
				$btn_bateria = '<div class="badge badge-warning badge-xl"><i class="fas fa-plug"></i> <br><span style="font-size:13px">Aguardando GPS</span></div>';
			}
		
		}
	}
	
	
	


echo ''.$btn_ign.' '.$btn_conexao.' '.$btn_gps.' '.$btn_bateria.'';


?>
<script src="../app-assets/js/scripts/popover/popover.js"></script>
