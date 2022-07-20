<?php

$servidor = "localhost";
$usuario = "root";
$senha = "TR4vcijU6T9Keaw";
$dbname = "traccar";

//Criar a conexao
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
$con = mysqli_connect($servidor, $usuario, $senha, $dbname);


$hora = date('H:i');

$data_hoje = date('Y-m-d');
$data_agora = date('Y-m-d H:i:s');



if($hora >= '09:01'&& $hora <= '10:30'){

$cons_faturas = mysqli_query($conn,"SELECT * FROM contas_receber WHERE data_vencimento='$data_hoje' AND status='Em Aberto' AND especie='2'");
		if(mysqli_num_rows($cons_faturas) > 0){
			while ($row_fat = mysqli_fetch_assoc($cons_faturas)) {
			$id_conta12 = $row_fat['id_conta'];
			$id_empresa = $row_fat['id_empresa'];
			$link_boleto = $row_fat['link_boleto'];
			$descricao = $row_fat['descricao'];
			$duplicata_av = $row_fat['duplicata'];
			$descricao1 = str_replace(' ', '_', $descricao);
			$data_venci = 	$row_fat['data_vencimento'];
			$data_venci1 = date('d/m/Y', strtotime("$data_venci"));
			$banco = $row_fat['banco'];
			$valor_bruto = $row_fat['valor_bruto'];
			$valor_bruto = number_format($valor_bruto, 2, ",", ".");
			$alerta = 'Sua fatura no valor de R$ '.$valor_bruto.' vence hoje. Acesse seu boleto pelo app ou em nosso site.';
			$style = 'AVISO_VENCIMENTO';
			$id_unico12 = date('Ymd');
			$id_unico12 = 'AVIS-'.$id_unico12.''.$id_conta12.'';
			
			$sql_vuser = mysqli_query($conn, "SELECT * FROM clientes WHERE nome_cliente = '$descricao'");
			if(mysqli_num_rows($sql_vuser) > 0){
			while ($resp_vuser = mysqli_fetch_assoc($sql_vuser)) {
			$id_cliente12 = 	$resp_vuser['id_cliente'];
			$nome_cliente4 = 	$resp_vuser['nome_cliente'];
			$telefone_celular12 = 	$resp_vuser['telefone_celular'];
			$telefone_celular12 = preg_replace("/[^0-9]/", "", $telefone_celular12);
			$doc_cliente = 	$resp_vuser['doc_cliente'];
			$usuario = preg_replace("/[^0-9]/", "", $doc_cliente);
			$descricao1111 = str_replace(' ', '_', $nome_cliente4);
			}}
			
			$dados_empresa = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa = '$id_empresa'");
			if(mysqli_num_rows($dados_empresa) > 0){
			while ($resp_dados = mysqli_fetch_assoc($dados_empresa)) {
			$credencial = 	$resp_dados['credencial'];
			$login_padrao = 	$resp_dados['login_padrao'];
			$whats = 	$resp_dados['whats'];
			$sessao_whats = 	$resp_dados['sessao_whats'];
			$chave_pix = 	$resp_dados['chave_pix'];
			$nome_fantasia = 	$resp_dados['nome_fantasia'];
			$producao = 	$resp_dados['producao'];
			}}
			
			echo $nome_cliente4;
			
			
			
			if($banco == 1){

				$texto_push12 = '%F0%9F%97%93%EF%B8%8F+AVISO+VENCIMENTO+%F0%9F%97%93%EF%B8%8F%0A%0APrezado%28a%29+'.$descricao.'%2C%0ASua+fatura+no+valor+de+R%24+'.$valor_bruto.'+vence+hoje.+Acesse+sua+fatura+pelo+app+ou+pelo+link+abaixo.%0A%0A'.$link_boleto.'%0A%0APara+sua+comodidade%2C+tamb%C3%A9m+poder%C3%A1+efetuar+o+pagamento+via+PIX.+Basta+fazer+a+transfer%C3%AAncia+usando+nossa+chave+PIX%3A+'.$chave_pix.'.%0A%0A_%2AMensagem+autom%C3%A1tica.+Por+favor%2C+n%C3%A3o+responda.%2A_';
				
				
				//$insere_alerta1 = mysqli_query($conn, "INSERT IGNORE INTO envios_whats (id_unico, telefone, mensagem, enviado, data_envio) VALUES ('$id_unico12', '$telefone_celular12', '$texto_push12', 'NAO', '$data_agora')");
			 
				$insere_alerta1 = mysqli_query($conn, "INSERT IGNORE INTO envios_whats (id_unico, telefone, mensagem, enviado, id_cliente, data_envio, id_empresa, session, tipo) VALUES ('$id_unico12', '$telefone_celular12', '$texto_push12', 'NAO', '$id_cliente12', '$data_agora', '$id_empresa', '$sessao_whats', 'FINANCEIRO')");
			}
			if($banco == 2){

			$texto_push12 = '%F0%9F%97%93%EF%B8%8F+AVISO+VENCIMENTO+%F0%9F%97%93%EF%B8%8F%0A%0APrezado%28a%29+'.$descricao.'%2C%0ASua+fatura+no+valor+de+R%24+'.$valor_bruto.'+vence+hoje.+Acesse+sua+fatura+pelo+app+ou+pelo+link+abaixo.%0A%0A'.$link_boleto.'%0A%0APara+sua+comodidade%2C+tamb%C3%A9m+poder%C3%A1+efetuar+o+pagamento+via+PIX.+Basta+fazer+a+transfer%C3%AAncia+usando+nossa+chave+PIX%3A+'.$chave_pix.'.%0A%0A_%2AMensagem+autom%C3%A1tica.+Por+favor%2C+n%C3%A3o+responda.%2A_';
			
			$insere_alerta1 = mysqli_query($conn, "INSERT IGNORE INTO envios_whats (id_unico, telefone, mensagem, enviado, id_cliente, data_envio, id_empresa, session, tipo) VALUES ('$id_unico12', '$telefone_celular12', '$texto_push12', 'NAO', '$id_cliente12', '$data_agora', '$id_empresa', '$sessao_whats', 'FINANCEIRO')");
			}
			
			
			
		}}}
#===========================================

#---- AVISO FALTA DE PAGAMENTO ------
$date_venc = date('Y-m-d');
$data2 = date('Y-m-d', strtotime('-2 days', strtotime($date_venc)));
$ano = date("Y");
$hora_aviso = date('H:i');

$data3 = date('Y-m-d', strtotime('-1 month', strtotime($data2)));

$mes = date("m");
$data_inicial = '01/'.$mes.'/'.$ano.'';
$data_inicial1 = 	substr($data_inicial,6,4) . "-" . substr($data_inicial,3,2) . "-" . substr($data_inicial,0,2);
$ultimo_dia = date("t", mktime(0,0,0,$mês,'01',$ano));
$data_final = ''.$ultimo_dia.'/'.$mes.'/'.$ano.'';
$data_final1 = 	substr($data_final,6,4) . "-" . substr($data_final,3,2) . "-" . substr($data_final,0,2);


if($hora_aviso >= '09:30' && $hora_aviso <= '09:45'){
$cons_faturas1 = mysqli_query($conn,"SELECT * FROM contas_receber WHERE (data_vencimento >= '$data3' AND data_vencimento <= '$data2') AND status='Em Aberto'");
		if(mysqli_num_rows($cons_faturas1) > 0){
			while ($row_fat1 = mysqli_fetch_assoc($cons_faturas1)) {
			$nr_banco = $row_fat1['nr_banco'];
			$descricao1 = $row_fat1['descricao'];
			$id_empresa1 = $row_fat1['id_empresa'];
			$descricao1 = $row_fat1['descricao'];
			$valor_bruto1 = $row_fat1['valor_bruto'];
			
			$id_cliente20 = $row_fat1['id_cliente'];
			$valor_bruto1 = number_format($valor_bruto, 2, ",", ".");
			$alerta1 = 'Prezado cliente. Existem pendencias de pagamento. Verifique suas faturas pelo app.';
			$style1 = 'ATRASO';
			$id_unico1 = date('Ymd');
			$id_unico1 = 'ATRASO-'.$id_unico1.'-'.$id_cliente20.'';
			
			$sql_vuser1 = mysqli_query($conn, "SELECT * FROM clientes WHERE id_cliente = '$id_cliente20'");
			if(mysqli_num_rows($sql_vuser1) > 0){
			while ($resp_vuser1 = mysqli_fetch_assoc($sql_vuser1)) {
			$doc_cliente1 = 	$resp_vuser1['doc_cliente'];
			$usuario1 = preg_replace("/[^0-9]/", "", $doc_cliente1);
			$nome_cliente5 = 	$resp_vuser1['nome_cliente'];
			$telefone_celular30 = 	$resp_vuser1['telefone_celular'];
			$telefone_celular30 = preg_replace("/[^0-9]/", "", $telefone_celular30);
			}}
			
			$dados_empresa = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa = '$id_empresa1'");
			if(mysqli_num_rows($dados_empresa) > 0){
			while ($resp_dados = mysqli_fetch_assoc($dados_empresa)) {
			$credencial = 	$resp_dados['credencial'];
			$login_padrao = 	$resp_dados['login_padrao'];
			$whats = 	$resp_dados['whats'];
			$sessao_whats = 	$resp_dados['sessao_whats'];
			$chave_pix = 	$resp_dados['chave_pix'];
			$nome_fantasia = 	$resp_dados['nome_fantasia'];
			$producao = 	$resp_dados['producao'];
			}}
			
			
			
			$dia = date('d');
			$dia_semana = date('D');
			
			if($dia % 2 == 0 && $dia_semana != 'Sun'){
			
			$texto_push = '%F0%9F%94%94AVISO+'.$nome_fantasia.'%F0%9F%94%94%0A%0APrezado%28a%29+'.$nome_cliente5.'%2C%0A%0AInformamos+que+existem+mensalidades+em+aberto.+Lembramos+que+atrasos+superiores+a+15+dias%2C+est%C3%A3o+sujeitos+a+suspens%C3%A3o+dos+servi%C3%A7os.+Efetue+seu+pagamento+em+qualquer+banco+ou+casa+lot%C3%A9rica.+%0A%0APara+sua+comodidade%2C+o+pagamento+tamb%C3%A9m+pode+ser+efetuado+via+PIX.+%0A%0A%0A_%2AMensagem+autom%C3%A1tica.+Por+favor+n%C3%A3o+responda%2A_';
			//$texto_push = '%F0%9F%94%94AVISO+'.$nome_fantasia.'%F0%9F%94%94%0A%0APrezado%28a%29+'.$nome_cliente5.'%2C%0A%0AInformamos+que+existem+mensalidades+em+aberto.+Lembramos+que+atrasos+superiores+a+15+dias%2C+est%C3%A3o+sujeitos+a+suspens%C3%A3o+dos+servi%C3%A7os.+%0A%0APara+sua+comodidade%2C+o+pagamento+tamb%C3%A9m+pode+ser+efetuado+via+PIX.+%0A%0AChave+CNPJ+-+32391694000121%0AValor%3A+R%24+'.$valor_bruto_total.'%0A%0A_%2AMensagem+autom%C3%A1tica.+Por+favor+n%C3%A3o+responda%2A_';

			 
			 $insere_alerta1 = mysqli_query($conn, "INSERT IGNORE INTO envios_whats (id_unico, telefone, mensagem, enviado, id_cliente, data_envio, id_empresa, session, tipo) VALUES ('$id_unico1', '$telefone_celular30', '$texto_push', 'NAO', '$id_cliente20', '$data_agora', '$id_empresa', '$sessao_whats', 'FINANCEIRO')");
			}
			
		
		
		
		}}
}
	
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
			
			
			
			if($hora24 >= '16:00' && $hora24 <= '17:30'){
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
					$insere_alerta2 = mysqli_query($conn, "INSERT IGNORE INTO envios_push (id_unico, alerta, cpf, placa, tipo, data_envio, enviado, id_cliente) VALUES ('$id_unico_desb', '$alerta4', '$usuario3', ' ', '$style4', ' $date_241', 'NAO', '$id_cliente3')");
				}
			}
			
			
			}}
			
?>
<?php

#---------- AVISO VENCIMENTO BOLETO 2 DIAS ----------------
$data_venc = date('Y-m-d');
$hora_venc = date('H:i');
$data_venc = date('Y-m-d', strtotime('+2 days', strtotime($data_venc)));

if($hora_venc >= '10:15' && $hora_venc <= '10:30'){

$cons_faturas1 = mysqli_query($conn,"SELECT * FROM contas_receber WHERE data_vencimento = '$data_venc' AND status='Em Aberto' AND especie='2'");
		if(mysqli_num_rows($cons_faturas1) > 0){
			while ($row_fat1 = mysqli_fetch_assoc($cons_faturas1)) {
			$nr_banco = $row_fat1['nr_banco'];
			$id_empresa23 = $row_fat1['id_empresa'];
			$id_conta = $row_fat1['id_conta'];
			$duplicata2222 = $row_fat1['duplicata'];
			$link_boleto22 = $row_fat1['link_boleto'];
			$descricao1 = $row_fat1['descricao'];
			$valor_bruto1 = $row_fat1['valor_bruto'];
			$valor_bruto1 = number_format($valor_bruto1, 2, ",", ".");
			$style_venc = 'AVISO';
			$id_unico1 = date('Ymd');
			$id_unico1 = 'AVI-'.$id_unico1.''.$duplicata2222.'';
			
			$sql_vuser1 = mysqli_query($conn, "SELECT * FROM clientes WHERE nome_cliente = '$descricao1'");
			if(mysqli_num_rows($sql_vuser1) > 0){
			while ($resp_vuser1 = mysqli_fetch_assoc($sql_vuser1)) {
			$id_cliente23 = 	$resp_vuser1['id_cliente'];
			$doc_cliente1 = 	$resp_vuser1['doc_cliente'];
			$usuario1 = preg_replace("/[^0-9]/", "", $doc_cliente1);
			$nome_cliente5 = 	$resp_vuser1['nome_cliente'];
			$telefone_celular23 = 	$resp_vuser1['telefone_celular'];
			$telefone_celular23 = preg_replace("/[^0-9]/", "", $telefone_celular23);
			$descricao1111 = str_replace(' ', '_', $nome_cliente5);
			}}
			
			$dados_empresa = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa = '$id_empresa'");
			if(mysqli_num_rows($dados_empresa) > 0){
			while ($resp_dados = mysqli_fetch_assoc($dados_empresa)) {
			$credencial = 	$resp_dados['credencial'];
			$login_padrao = 	$resp_dados['login_padrao'];
			$whats = 	$resp_dados['whats'];
			$sessao_whats = 	$resp_dados['sessao_whats'];
			$chave_pix = 	$resp_dados['chave_pix'];
			$nome_fantasia = 	$resp_dados['nome_fantasia'];
			$producao = 	$resp_dados['producao'];
			}}
			

	
	
	//$texto_push = '%27%F0%9F%97%93%EF%B8%8F+AVISO+VENCIMENTO+%F0%9F%97%93%EF%B8%8F%0A%0APrezado%28a%29+'.$nome_cliente5.'%2C+%0A%0ASua+fatura+no+valor+de+R%24+'.$valor_bruto1.'+vence+em+2+dias.+Acesse+sua+fatura+pelo+app+ou+pelo+link+abaixo.%0A%0Ahttps%3A%2F%2Fwww.mobidrive.com.br%2Fapi%2Ffaturas%2F'.$duplicata2222.'-'.$descricao1111.'.pdf%0A%0APara+sua+comodidade%2C+voc%C3%AA+pode+efetuar+o+pagamento+via+PIX.+Basta+usar+nossa+chave+CNPJ+32391694000121.%0A%0A_%2AMensagem+autom%C3%A1tica.+Por+favor%2C+n%C3%A3o+responda.%2A_';
	
	$texto_push23 = '%F0%9F%97%93%EF%B8%8F+LEMBRETE+VENCIMENTO+%F0%9F%97%93%EF%B8%8F%0A%0APrezado%28a%29+'.$nome_cliente5.'%2C+%0A%0ASua+fatura+no+valor+de+R%24+'.$valor_bruto1.'+vence+em+2+dias.+Acesse+sua+fatura+pelo+app+ou+pelo+link+abaixo.%0A%0A'.$link_boleto22.'%0A%0APara+sua+comodidade%2C+voc%C3%AA+pode+efetuar+o+pagamento+via+PIX.+Basta+usar+nossa+chave+CNPJ+32391694000121.%0A%0A_%2AMensagem+autom%C3%A1tica.+Por+favor%2C+n%C3%A3o+responda.%2A_';
	
	$insere_alerta11 = mysqli_query($conn, "INSERT IGNORE INTO envios_whats (id_unico, telefone, mensagem, enviado, id_cliente, data_envio, id_empresa, session, tipo) VALUES ('$id_unico1', '$telefone_celular23', '$texto_push23', 'NAO', '$id_cliente23', '$data_agora', '$id_empresa23', '$sessao_whats', 'FINANCEIRO')");

		}}

}


?>