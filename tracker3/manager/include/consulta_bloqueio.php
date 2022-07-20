<?php

$servidor = "localhost";
$usuario = "root";
$senha = "TR4vcijU6T9Keaw";
$dbname = "traccardb";


//Criar a conexao
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
$con = mysqli_connect($servidor, $usuario, $senha, $dbname);

$deviceid = $_REQUEST['deviceid'];

$cons_cliente = mysqli_query($conn,"SELECT * FROM tc_positions WHERE deviceid='$deviceid' ORDER BY id DESC LIMIT 1");
	if(mysqli_num_rows($cons_cliente) > 0){
		while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
		$protocol = $resp_cliente['protocol'];
		$attributes = $resp_cliente['attributes'];
		$obj = json_decode($attributes);
	
	
	
	if($protocol == 'easytrack'){
		$blocked = $obj->{'blocked'};
		if (is_bool($blocked)) $blocked ? $blocked = "true" : $blocked = "false";
		else if ($blocked !== null) $blocked = (string)$blocked;
		

			if($blocked == 'true'){
				$status_bloqueio = 'BLOQUEADO';
				
			}
			if($blocked == 'false'){
				$status_bloqueio = 'Desbloqueado';
				
			}

	}
	else if($protocol == 'suntech'){
		$blocked = $obj->{'out1'};
		if (is_bool($blocked)) $blocked ? $blocked = "true" : $blocked = "false";
		else if ($blocked !== null) $blocked = (string)$blocked;
		

			if($blocked == 'true'){
				$status_bloqueio = 'BLOQUEADO';
				
			}
			if($blocked == 'false'){
				$status_bloqueio = 'Desbloqueado';
				
			}

	}
	else if($protocol == 'teltonika'){
		$blocked = $obj->{'out1'};
		if (is_bool($blocked)) $blocked ? $blocked = "true" : $blocked = "false";
		else if ($blocked !== null) $blocked = (string)$blocked;
		

			if($blocked == 'true'){
				$status_bloqueio = 'BLOQUEADO';
				
			}
			if($blocked == 'false'){
				$status_bloqueio = 'Desbloqueado';
				
			}

	}
	else if($protocol == 'gt06'){
		$blocked = $obj->{'blocked'};
		if (is_bool($blocked)) $blocked ? $blocked = "true" : $blocked = "false";
		else if ($blocked !== null) $blocked = (string)$blocked;
		

			if($blocked == 'true'){
				$status_bloqueio = 'BLOQUEADO';
				
			}
			if($blocked == 'false'){
				$status_bloqueio = 'Desbloqueado';
				
			}

	}
	else if($protocol == 'gps103'){
		$blocked = $obj->{'event'};
		
		

			if($blocked == 'jt'){
				$status_bloqueio = 'BLOQUEADO';
				
			}
			if($blocked != 'jt'){
				$status_bloqueio = 'Desbloqueado';
				
			}

	}
	else {
		$status_bloqueio = $block;
		
	}
	
	echo $status_bloqueio;
	
	}}
?>
