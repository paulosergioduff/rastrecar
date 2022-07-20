

 <?php
 header('Content-Type: application/json');

 
include_once("conexao.php");



$id_empresa = '1';

$data_agora = date('Y-m-d H:i');
$data_agora1 = date('d/m/Y H:i');	





$cons_eventos = mysqli_query($conn,"SELECT * FROM tc_events ORDER BY id DESC LIMIT 50");
if(mysqli_num_rows($cons_eventos) > 0){
	while ($row_ev = mysqli_fetch_assoc($cons_eventos)) {
		$deviceid = $row_ev['deviceid'];
		$horario_alarme = $row_ev['servertime'];
		$eventos = $row_ev['attributes'];
		$eventos1 = json_decode($eventos);
		$alarme = $eventos1->{'alarm'};
		$speed = $eventos1->{'speed'};
		$speed = $speed * 1.609;
		$speed = round($speed, 2);
		$type = $row_ev{'type'};
		$geofenceid = $row_ev['geofenceid'];
		$id_unico = $row_ev['id'];
		$positionid = $row_ev['positionid'];
		
		$cons_veiculos = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE deviceid='$deviceid'");
		if(mysqli_num_rows($cons_veiculos) > 0){
			while ($row_veic = mysqli_fetch_assoc($cons_veiculos)) {
				$placa = $row_veic['placa'];
				$id_cliente = $row_veic['id_cliente'];
				$alerta_alarme = $row_veic['alerta_alarme'];
				$alerta_ign = $row_veic['alerta_ign'];
				$alerta_bateria = $row_veic['alerta_bateria'];
				$alerta_bateria_baixa = $row_veic['alerta_bateria_baixa'];
				$alerta_velocidade = $row_veic['alerta_velocidade'];
				$alerta_cerca = $row_veic['alerta_cerca'];
				$marca_veiculo = $row_veic['marca_veiculo'];
				$modelo_veiculo = $row_veic['modelo_veiculo'];
				$veiculo = ''.$marca_veiculo.'/'.$modelo_veiculo.'';
				
				$sql_vuser = mysqli_query($conn, "SELECT * FROM clientes WHERE id_cliente = '$id_cliente'");
				if(mysqli_num_rows($sql_vuser) > 0){
				while ($resp_vuser = mysqli_fetch_assoc($sql_vuser)) {
				$doc_cliente = 	$resp_vuser['doc_cliente'];
				$usuario = preg_replace("/[^0-9]/", "", $doc_cliente);
				$alertas_whats = $resp_vuser['alertas_whats'];
				$telefone_celular = 	$resp_vuser['telefone_celular'];
				$telefone_celular = preg_replace("/[^0-9]/", "", $telefone_celular);
				}}
				
				$sql_coord = mysqli_query($conn, "SELECT * FROM tc_positions WHERE id = '$positionid'");
				if(mysqli_num_rows($sql_coord) > 0){
				while ($resp_coord = mysqli_fetch_array($sql_coord)) {
					$latitude = 	$resp_coord['latitude'];
					$longitude = 	$resp_coord['longitude'];
				}}
		
		
				if($type == 'deviceOverspeed' &&  $alerta_velocidade == 'SIM'){
					$alerta = 'Velocidade Excedida - '.$speed.' km/h';
					$style = 'ALERTA';
					$insere_alerta = mysqli_query($conn, "INSERT IGNORE INTO envios_push (id, id_unico, alerta, cpf, placa, tipo, data_envio, enviado, id_cliente, deviceid) VALUES ('0', '$id_unico', '$alerta', '$usuario', '$placa', '$style', '$data_agora', 'NAO', '$id_cliente', '$deviceid')");
					
					$insere_alerta_master = mysqli_query($conn, "INSERT IGNORE INTO envios_push_master (id, id_unico, alerta, cpf, placa, tipo, data_envio, enviado, id_cliente, deviceid) VALUES ('0', '$id_unico', '$alerta', '$usuario', '$placa', '$style', '$data_agora', 'NAO', '$id_cliente', '$deviceid')");
					
					if($alertas_whats == 'SIM'){					
						$texto_push = '%F0%9F%94%94+ALERTA+JC+RASTREAMENTO+%F0%9F%94%94%0A%0AVelocidade+Excedida%3A+'.$speed.'+km%2Fk%0AVe%C3%ADculo%3A+'.$veiculo.'%0APlaca%3A+'.$placa.'%0AData%3A+'.$data_agora1.'%0A%0Ahttps%3A%2F%2Fwww.google.com%2Fmaps%3Flayer%3Dc%26cbll%3D'.$latitude.'%2C'.$longitude .'%0A%0A%2A_Alerta+autom%C3%A1tico.+Por+favor%2C+n%C3%A3o+responda._%2A';
			
						$insere_alerta1 = mysqli_query($conn, "INSERT IGNORE INTO envios_whats (id_unico, telefone, mensagem, enviado, id_cliente, data_envio) VALUES ('$id_unico', '$telefone_celular', '$texto_push', 'NAO', '$id_cliente', '$data_agora')");
					}
				} 
				
				
				
				if($type == 'ignitionOn' &&  $alerta_ign == 'SIM'){
					$alerta = 'Ignicao Ligada';
					$style = 'NOTIFICACAO';
					$insere_alerta = mysqli_query($conn, "INSERT IGNORE INTO envios_push (id, id_unico, alerta, cpf, placa, tipo, data_envio, enviado, id_cliente, deviceid) VALUES ('0', '$id_unico', '$alerta', '$usuario', '$placa', '$style', '$data_agora', 'NAO', '$id_cliente', '$deviceid')");
					
					$insere_alerta_master = mysqli_query($conn, "INSERT IGNORE INTO envios_push_master (id, id_unico, alerta, cpf, placa, tipo, data_envio, enviado, id_cliente, deviceid) VALUES ('0', '$id_unico', '$alerta', '$usuario', '$placa', '$style', '$data_agora', 'NAO', '$id_cliente', '$deviceid')");
					
					if($alertas_whats == 'SIM'){
						$texto_push = '%F0%9F%9A%98+ALERTA+JC+RASTREAMENTO+%F0%9F%9A%98%0A%0A%2AIGNI%C3%87%C3%83O+LIGADA%2A%0AVe%C3%ADculo%3A+'.$veiculo.'%0APlaca%3A+'.$placa.'%0AData%3A+'.$data_agora1.'%0A%0Ahttps%3A%2F%2Fwww.google.com%2Fmaps%3Flayer%3Dc%26cbll%3D'.$latitude.'%2C'.$longitude .'%0A%0A%2A_Alerta+autom%C3%A1tico.+Por+favor%2C+n%C3%A3o+responda._%2A';
			
						$insere_alerta1 = mysqli_query($conn, "INSERT IGNORE INTO envios_whats (id_unico, telefone, mensagem, enviado, id_cliente, data_envio) VALUES ('$id_unico', '$telefone_celular', '$texto_push', 'NAO', '$id_cliente', '$data_agora')");
					}
					
				} 
				if($type == 'ignitionOff' &&  $alerta_ign == 'SIM'){
					$alerta = 'Ignicao Desligada';
					$style = 'NOTIFICACAO';
					$insere_alerta = mysqli_query($conn, "INSERT IGNORE INTO envios_push (id, id_unico, alerta, cpf, placa, tipo, data_envio, enviado, id_cliente, deviceid) VALUES ('0', '$id_unico', '$alerta', '$usuario', '$placa', '$style', '$data_agora', 'NAO', '$id_cliente', '$deviceid')");
					
					$insere_alerta_master = mysqli_query($conn, "INSERT IGNORE INTO envios_push_master (id, id_unico, alerta, cpf, placa, tipo, data_envio, enviado, id_cliente, deviceid) VALUES ('0', '$id_unico', '$alerta', '$usuario', '$placa', '$style', '$data_agora', 'NAO', '$id_cliente', '$deviceid')");
					
					if($alertas_whats == 'SIM'){
						$texto_push = '%F0%9F%9A%98+ALERTA+JC+RASTREAMENTO+%F0%9F%9A%98%0A%0A%2AIGNI%C3%87%C3%83O+DESLIGADA%2A%0AVe%C3%ADculo%3A+'.$veiculo.'%0APlaca%3A+'.$placa.'%0AData%3A+'.$data_agora1.'%0A%0Ahttps%3A%2F%2Fwww.google.com%2Fmaps%3Flayer%3Dc%26cbll%3D'.$latitude.'%2C'.$longitude .'%0A%0A%2A_Alerta+autom%C3%A1tico.+Por+favor%2C+n%C3%A3o+responda._%2A';
			
						$insere_alerta1 = mysqli_query($conn, "INSERT IGNORE INTO envios_whats (id_unico, telefone, mensagem, enviado, id_cliente, data_envio) VALUES ('$id_unico', '$telefone_celular', '$texto_push', 'NAO', '$id_cliente', '$data_agora')");
					}
					
				}			
				if($alarme == 'powerCut' && $type == 'alarm' &&  $alerta_bateria == 'SIM'){
					$alerta = 'BATERIA REMOVIDA';
					$style = 'ALERTA';
					$insere_alerta = mysqli_query($conn, "INSERT IGNORE INTO envios_push (id, id_unico, alerta, cpf, placa, tipo, data_envio, enviado, id_cliente, deviceid) VALUES ('0', '$id_unico', '$alerta', '$usuario', '$placa', '$style', '$data_agora', 'NAO', '$id_cliente', '$deviceid')");
					
					$insere_alerta_master = mysqli_query($conn, "INSERT IGNORE INTO envios_push_master (id, id_unico, alerta, cpf, placa, tipo, data_envio, enviado, id_cliente, deviceid) VALUES ('0', '$id_unico', '$alerta', '$usuario', '$placa', '$style', '$data_agora', 'NAO', '$id_cliente', '$deviceid')");
					
					$id_unico_adm = ''.$id_unico.'adm';
						
					//$insere_alerta2 = mysqli_query($conn, "INSERT IGNORE INTO envios_whats (id_unico, telefone, mensagem, enviado, id_cliente, data_envio) VALUES ('$id_unico_adm', '8594253306', '$texto_push', 'NAO', '$id_cliente', '$data_agora')");
					
					if($alertas_whats == 'SIM'){
						$texto_push = '%F0%9F%9A%98+ALERTA+JC+RASTREAMENTO+%F0%9F%9A%98%0A%0A%F0%9F%9A%A8+%2AFALHA+BATERIA+VEICULO%2A%0AVe%C3%ADculo%3A+'.$veiculo.'%0APlaca%3A+'.$placa.'%0AData%3A+'.$data_agora1.'%0A%0Ahttps%3A%2F%2Fwww.google.com%2Fmaps%3Flayer%3Dc%26cbll%3D'.$latitude.'%2C'.$longitude .'%0A%0A%2A_Alerta+autom%C3%A1tico.+Por+favor%2C+n%C3%A3o+responda._%2A';
			
						$insere_alerta1 = mysqli_query($conn, "INSERT IGNORE INTO envios_whats (id_unico, telefone, mensagem, enviado, id_cliente, data_envio) VALUES ('$id_unico', '$telefone_celular', '$texto_push', 'NAO', '$id_cliente', '$data_agora')");
						
						
					}
				
					
				}
				if($alarme == 'sos' && $type == 'alarm'){
					$alerta = 'ALERTA DE PÂNICO';
					$style = 'ALERTA';
					
						$texto_push = '%F0%9F%9A%98+ALERTA+%F0%9F%9A%98%0A%0A%F0%9F%9A%A8+%2APANICO+ACIONADO%2A%0AVe%C3%ADculo%3A+'.$veiculo.'%0APlaca%3A+'.$placa.'%0AData%3A+'.$data_agora1.'%0A%0Ahttps%3A%2F%2Fwww.google.com%2Fmaps%3Flayer%3Dc%26cbll%3D'.$latitude.'%2C'.$longitude .'%0A%0A%2A_Alerta+autom%C3%A1tico.+Por+favor%2C+n%C3%A3o+responda._%2A';
			
						$insere_alerta1 = mysqli_query($conn, "INSERT IGNORE INTO envios_whats (id_unico, telefone, mensagem, enviado, id_cliente, data_envio, id_cliente) VALUES ('$id_unico', '$telefone_celular', '$texto_push', 'NAO', '$id_cliente', '$data_agora', '$id_cliente')");
						
						$id_unico_adm = ''.$id_unico.'adm1';
						
						$insere_alerta11 = mysqli_query($conn, "INSERT IGNORE INTO envios_whats (id_unico, telefone, mensagem, enviado, data_envio, id_cliente) VALUES ('$id_unico_adm', '8594253306', '$texto_push', 'NAO', '$data_agora', '$id_cliente')");
					
					
				}

				/*
				if($alarme == 'vibration' && $type == 'alarm'){
					$alerta = 'ALARME DE VIBRAÇÃO';
					$style = 'ALERTA';
					$insere_alerta = mysqli_query($conn, "INSERT IGNORE INTO envios_push (id, id_unico, alerta, cpf, placa, tipo, data_envio, enviado, id_cliente) VALUES ('0', '$id_unico', '$alerta', '$usuario', '$placa', '$style', '$data_agora', 'NAO', '$id_cliente')");
					
					if($alertas_whats == 'SIM'){
						$texto_push = '%F0%9F%9A%98+ALERTA+JC+RASTREAMENTO+%F0%9F%9A%98%0A%0A%F0%9F%9A%A8+%2AALARME+VIBRAÇÃO%2A%0AVe%C3%ADculo%3A+'.$veiculo.'%0APlaca%3A+'.$placa.'%0AData%3A+'.$data_agora1.'%0A%0Ahttps%3A%2F%2Fwww.google.com%2Fmaps%3Flayer%3Dc%26cbll%3D'.$latitude.'%2C'.$longitude .'%0A%0A%2A_Alerta+autom%C3%A1tico.+Por+favor%2C+n%C3%A3o+responda._%2A';
			
						$insere_alerta1 = mysqli_query($conn, "INSERT IGNORE INTO envios_whats (id_unico, telefone, mensagem, enviado, id_cliente, data_envio) VALUES ('$id_unico', '$telefone_celular', '$texto_push', 'NAO', '$id_cliente', '$data_agora')");
						
						$id_unico_adm = ''.$id_unico.'adm';
						
						$insere_alerta11 = mysqli_query($conn, "INSERT IGNORE INTO envios_whats (id_unico, telefone, mensagem, enviado, data_envio, id_cliente) VALUES ('$id_unico_adm', '8594253306', '$texto_push', 'NAO', '$data_agora', '$id_cliente')");
					}
				}
			
				if($alarme == 'shock' && $type == 'alarm'){
					$alerta = 'ALARME SENSOR';
					$style = 'ALERTA';
					$insere_alerta = mysqli_query($conn, "INSERT IGNORE INTO envios_push (id, id_unico, alerta, cpf, placa, tipo, data_envio, enviado, id_cliente) VALUES ('0', '$id_unico', '$alerta', '$usuario', '$placa', '$style', '$data_agora', 'NAO', '$id_cliente')");
					
					if($alertas_whats == 'SIM'){
						$texto_push = '%F0%9F%9A%98+ALERTA+JC+RASTREAMENTO+%F0%9F%9A%98%0A%0A%F0%9F%9A%A8+%2AALARME+SENSOR%2A%0AVe%C3%ADculo%3A+'.$veiculo.'%0APlaca%3A+'.$placa.'%0AData%3A+'.$data_agora1.'%0A%0Ahttps%3A%2F%2Fwww.google.com%2Fmaps%3Flayer%3Dc%26cbll%3D'.$latitude.'%2C'.$longitude .'%0A%0A%2A_Alerta+autom%C3%A1tico.+Por+favor%2C+n%C3%A3o+responda._%2A';
			
						$insere_alerta1 = mysqli_query($conn, "INSERT IGNORE INTO envios_whats (id_unico, telefone, mensagem, enviado, id_cliente, data_envio) VALUES ('$id_unico', '$telefone_celular', '$texto_push', 'NAO', '$id_cliente', '$data_agora')");
						
						$id_unico_adm = ''.$id_unico.'adm';
						
						$insere_alerta11 = mysqli_query($conn, "INSERT IGNORE INTO envios_whats (id_unico, telefone, mensagem, enviado, data_envio, id_cliente) VALUES ('$id_unico_adm', '8594253306', '$texto_push', 'NAO', '$data_agora', '$id_cliente')");
					}
				}
				*/

				
				if($type == 'geofenceExit'){
					$cons_fence = mysqli_query($conn,"SELECT * FROM tc_geofences WHERE id='$geofenceid'");
					if(mysqli_num_rows($cons_fence) > 0){
						while ($row_fence = mysqli_fetch_assoc($cons_fence)) {
						$name_cerca = $row_fence['name'];
						$description = $row_fence['description'];
							if($name_cerca == 'ANCORA'){
								$alerta = 'ANCORA VIOLADA';
								$style = 'ALERTA';
								
								$insere_alerta = mysqli_query($conn, "INSERT IGNORE INTO envios_push (id_unico, alerta, cpf, placa, tipo, data_envio, enviado, id_cliente, deviceid) VALUES ('$id_unico', '$alerta', '$usuario', '$placa', '$style', '$data_agora', 'NAO', '$id_cliente', '$deviceid')");
						
								$insere_alerta_master = mysqli_query($conn, "INSERT IGNORE INTO envios_push_master (id, id_unico, alerta, cpf, placa, tipo, data_envio, enviado, id_cliente, deviceid) VALUES ('0', '$id_unico', '$alerta', '$usuario', '$placa', '$style', '$data_agora', 'NAO', '$id_cliente', '$deviceid')");
					
								if($alertas_whats == 'SIM'){
									$texto_push = '%F0%9F%9A%98+ALERTA+JC+RASTREAMENTO+%F0%9F%9A%98%0A%0A%F0%9F%9A%A7+'.$alerta.'+%F0%9F%9A%A7%0AVe%C3%ADculo%3A+'.$veiculo.'%0APlaca%3A+'.$placa.'%0AData%3A+'.$data_agora1.'%0A%0Ahttps%3A%2F%2Fwww.google.com%2Fmaps%3Flayer%3Dc%26cbll%3D'.$latitude.'%2C'.$longitude .'%0A%0A%2A_Alerta+autom%C3%A1tico.+Por+favor%2C+n%C3%A3o+responda._%2A';
						
									$insere_alerta1 = mysqli_query($conn, "INSERT IGNORE INTO envios_whats (id_unico, telefone, mensagem, enviado, id_cliente, data_envio) VALUES ('$id_unico', '$telefone_celular', '$texto_push', 'NAO', '$id_cliente', '$data_agora')");
								}
							} 
							if($name_cerca != 'ANCORA' && $alerta_cerca == 'SIM') {
								$alerta = 'SAIDA '.$name_cerca.'';
								$style = 'NOTIFICACAO';
								
								$insere_alerta = mysqli_query($conn, "INSERT IGNORE INTO envios_push (id_unico, alerta, cpf, placa, tipo, data_envio, enviado, id_cliente, deviceid) VALUES ('$id_unico', '$alerta', '$usuario', '$placa', '$style', '$data_agora', 'NAO', '$id_cliente', '$deviceid')");
						
								$insere_alerta_master = mysqli_query($conn, "INSERT IGNORE INTO envios_push_master (id, id_unico, alerta, cpf, placa, tipo, data_envio, enviado, id_cliente, deviceid) VALUES ('0', '$id_unico', '$alerta', '$usuario', '$placa', '$style', '$data_agora', 'NAO', '$id_cliente', '$deviceid')");
					
								if($alertas_whats == 'SIM'){
									$texto_push = '%F0%9F%9A%98+ALERTA+JC+RASTREAMENTO+%F0%9F%9A%98%0A%0A%F0%9F%9A%A7+'.$alerta.'+%F0%9F%9A%A7%0AVe%C3%ADculo%3A+'.$veiculo.'%0APlaca%3A+'.$placa.'%0AData%3A+'.$data_agora1.'%0A%0Ahttps%3A%2F%2Fwww.google.com%2Fmaps%3Flayer%3Dc%26cbll%3D'.$latitude.'%2C'.$longitude .'%0A%0A%2A_Alerta+autom%C3%A1tico.+Por+favor%2C+n%C3%A3o+responda._%2A';
						
									$insere_alerta1 = mysqli_query($conn, "INSERT IGNORE INTO envios_whats (id_unico, telefone, mensagem, enviado, id_cliente, data_envio) VALUES ('$id_unico', '$telefone_celular', '$texto_push', 'NAO', '$id_cliente', '$data_agora')");
								}
							}
						
						
					}}
				}

				if($type == 'geofenceEnter' && $alerta_cerca == 'SIM'){
					$cons_fence1 = mysqli_query($conn,"SELECT * FROM tc_geofences WHERE id='$geofenceid'");
					if(mysqli_num_rows($cons_fence1) > 0){
				while ($row_fence1 = mysqli_fetch_assoc($cons_fence1)) {
					$name_cerca1 = $row_fence1['name'];
					$alerta1 = 'ENTROU NA CERCA '.$name_cerca1.'';
					$style = 'NOTIFICACAO';
					$insere_alerta = mysqli_query($conn, "INSERT IGNORE INTO envios_push (id, id_unico, alerta, cpf, placa, tipo, data_envio, enviado, id_cliente, deviceid) VALUES ('0', '$id_unico', '$alerta1', '$usuario', '$placa', '$style', '$data_agora', 'NAO', '$id_cliente', '$deviceid')");
					
					$insere_alerta_master = mysqli_query($conn, "INSERT IGNORE INTO envios_push_master (id, id_unico, alerta, cpf, placa, tipo, data_envio, enviado, id_cliente, deviceid) VALUES ('0', '$id_unico', '$alerta1', '$usuario', '$placa', '$style', '$data_agora', 'NAO', '$id_cliente', '$deviceid')");
					
					if($alertas_whats == 'SIM'){
						$texto_push = '%F0%9F%9A%98+ALERTA+JC+RASTREAMENTO+%F0%9F%9A%98%0A%0A%F0%9F%9A%A7+'.$alerta1.'+%F0%9F%9A%A7%0AVe%C3%ADculo%3A+'.$veiculo.'%0APlaca%3A+'.$placa.'%0AData%3A+'.$data_agora1.'%0A%0Ahttps%3A%2F%2Fwww.google.com%2Fmaps%3Flayer%3Dc%26cbll%3D'.$latitude.'%2C'.$longitude .'%0A%0A%2A_Alerta+autom%C3%A1tico.+Por+favor%2C+n%C3%A3o+responda._%2A';
			
						$insere_alerta1 = mysqli_query($conn, "INSERT IGNORE INTO envios_whats (id_unico, telefone, mensagem, enviado, id_cliente, data_envio) VALUES ('$id_unico', '$telefone_celular', '$texto_push', 'NAO', '$id_cliente', '$data_agora')");
					}
					
				}}}
				
				


				
				
				
				
}
		}
	}
	}
	
	

	

				?>

