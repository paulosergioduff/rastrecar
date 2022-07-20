	<?php
 
include_once("../conexao.php");

$data_vencimento = date('Y-m-d');
$data_agora = date('Y-m-d H:i');
$hora_aviso1 = date('H:i');


		
#----- DESBLOQUEIO / BLOQUEIO -----------		
			$date_24 = date('Y-m-d');
			$date_241 = date('Y-m-d H:i');
			$hora24 = date('H:i');
	
	
			$data_desb = date('Ymd');
			$sql_cliente = mysqli_query($conn, "SELECT * FROM clientes WHERE status='1' OR status='2' ORDER BY id_cliente ASC");
			if(mysqli_num_rows($sql_cliente) > 0){
			while ($resp_cliente = mysqli_fetch_assoc($sql_cliente)) {
			$doc_cliente3 = 	$resp_cliente['doc_cliente'];
			$id_empresa1 = 	$resp_cliente['id_empresa'];
			$dias_bloqueio1 = 	$resp_cliente['dias_bloqueio'];
			$usuario3 = preg_replace("/[^0-9]/", "", $doc_cliente3);
			$status_cliente = 	$resp_cliente['status'];
			$telefone_celular21 = 	$resp_cliente['telefone_celular'];
			$telefone_celular21 = preg_replace("/[^0-9]/", "", $telefone_celular21);
			$id_cliente3 = 	$resp_cliente['id_cliente'];
			$nome_cliente3 = 	$resp_cliente['nome_cliente'];
			$id_unico_desb = ''.$data_desb.'-'.$id_cliente3.'BLOC';
			$id_unico_desb1 = ''.$data_desb.'-'.$id_cliente3.'DESB';
			
			$dados_empresa1 = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa = '$id_empresa1'");
			if(mysqli_num_rows($dados_empresa1) > 0){
				while ($resp_dados1 = mysqli_fetch_assoc($dados_empresa1)) {
			$credencial = 	$resp_dados1['credencial'];
			$login_padrao = 	$resp_dados1['login_padrao'];
			$whats = 	$resp_dados1['whats'];
			$sessao_whats1 = 	$resp_dados1['sessao_whats'];
			$chave_pix = 	$resp_dados1['chave_pix'];
			$nome_fantasia = 	$resp_dados1['nome_fantasia'];
			$producao = 	$resp_dados1['producao'];
			$telefone_emp = 	$resp_dados1['telefone'];
			}}
			
			$alerta4 = 'Seus servicos foram liberados';
			$style4 = 'DESBLOQUEIO';
			
			$alerta3 = 'Seus servicos foram suspensos. Entre em contato conosco. Telefone: '.$telefone_emp.'';
			$style3 = 'BLOQUEIO';
			
			$data_bl = date('Y-m-d', strtotime('-'.$dias_bloqueio1.' days', strtotime($date_24)));
			
			
			
			if($hora24 >= '07:00' && $hora24 <= '08:00'){
				if($status_cliente == 1){
					$cons_faturas3 = mysqli_query($conn,"SELECT * FROM contas_receber WHERE id_cliente = '$id_cliente3' AND status='Em Aberto' AND data_vencimento <= '$data_bl'  ORDER BY id_conta ASC");
					$total_aberto = mysqli_num_rows($cons_faturas3);
					
					if($total_aberto >= 1){
						$sql4 = mysqli_query($conn,"DELETE FROM envios_push WHERE id_cliente='$id_cliente3' AND tipo='DESBLOQUEIO' OR tipo='BLOQUEIO'");
						$sql = mysqli_query($conn, "UPDATE usuarios SET ativo = 'NAO' WHERE id_cliente = '$id_cliente3'");
						$sql_cli = mysqli_query($conn,"UPDATE clientes SET status='2' WHERE id_cliente='$id_cliente3'");
						$sql_cli = mysqli_query($conn,"UPDATE usuarios_push SET logado='NAO' WHERE id_cliente='$id_cliente3'");
						$insere_alerta2 = mysqli_query($conn, "INSERT IGNORE INTO envios_push (id_unico, alerta, cpf, placa, tipo, data_envio, enviado, id_cliente) VALUES ('$id_unico_desb', '$alerta3', '$usuario3', ' ', '$style3', ' $date_241', 'NAO', '$id_cliente3')");
						
						//$texto_push1 = '%F0%9F%9A%AB+%2AAVISO+DE+BLOQUEIO%2A+%F0%9F%9A%AB+%0A%0A'.$nome_fantasia.'+informa%3A+%0A%0ASeus+servi%C3%A7os+foram+suspensos+por+falta+de+pagamento.+Entre+em+contato+conosco+para+regularizar.%0A%0ATelefone%3A+'.$telefone_emp.'%0A%0A%2A_Mensagem+autom%C3%A1tica.+Por+favor+n%C3%A3o+responda._%2A';
						
						//$insere_alerta2 = mysqli_query($conn, "INSERT IGNORE INTO envios_whats (id_unico, telefone, mensagem, enviado, id_cliente, data_envio, id_empresa, session, tipo) VALUES ('$id_unico_desb', '$telefone_celular21', '$texto_push1', 'NAO', '$id_cliente3', '$date_241', '$id_empresa1', '$sessao_whats1', 'FINANCEIRO')");
						
						
					}
				}
			}
			
			
			if($status_cliente == 2){
				$cons_faturas3 = mysqli_query($conn,"SELECT * FROM contas_receber WHERE id_cliente = '$id_cliente3' AND status='Em Aberto' AND data_vencimento <= '$data_bl'  ORDER BY id_conta ASC");
				$total_aberto = mysqli_num_rows($cons_faturas3);
				if($total_aberto <= 0){
					
					$sql4 = mysqli_query($conn,"DELETE FROM envios_push WHERE id_cliente='$id_cliente3' AND tipo='DESBLOQUEIO' OR tipo='BLOQUEIO'");
					$sql = mysqli_query($conn, "UPDATE usuarios SET ativo = 'SIM' WHERE id_cliente = '$id_cliente3'");
					$sql_cli = mysqli_query($conn,"UPDATE clientes SET status='1' WHERE id_cliente='$id_cliente3'");
					//$insere_alerta2 = mysqli_query($conn, "INSERT IGNORE INTO envios_push (id_unico, alerta, cpf, placa, tipo, data_envio, enviado, id_cliente) VALUES ('$id_unico_desb', '$alerta4', '$usuario3', ' ', '$style4', ' $date_241', 'NAO', '$id_cliente3')");
				}
			}
			
			
			}}
	


		
		

?>
