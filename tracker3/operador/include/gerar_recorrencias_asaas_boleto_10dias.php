<?php

$servidor = "localhost";
$usuario = "root";
$senha = "M196619m210300";
$dbname = "traccar";

//Criar a conexao
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
$con = mysqli_connect($servidor, $usuario, $senha, $dbname);


$hora = date('H:i');

$data_hoje = date('Y-m-d');
$data_agora = date('Y-m-d H:i:s');


$dia_cont_5 = date('Y-m-d', strtotime('+5 days', strtotime($data_hoje)));
$dia_cont_10 = date('Y-m-d', strtotime('+10 days', strtotime($data_hoje)));

$dias_5 = date('d', strtotime("$dia_cont_5"));
$dias_10 = date('d', strtotime("$dia_cont_10"));


if($hora >= '11:00' && $hora <= '14:30'){
	$cons_recorrencia_5 = mysqli_query($conn, "SELECT * FROM recorrencia WHERE ativo='SIM' AND banco = '2' AND (dia_vencimento='$dia_cont_10' AND dias_cobranca='10') AND ultima_cobranca != '$data_hoje' AND forma_pagamento='Boleto Bancario' AND tipo='MENSAL' ORDER BY id_recorrencia ASC");
	if(mysqli_num_rows($cons_recorrencia_5) > 0){
		while ($resp_recorrencia_5 = mysqli_fetch_assoc($cons_recorrencia_5)) {
		$id_recorrencia = 	$resp_recorrencia_5['id_recorrencia'];
		$id_cliente = 	$resp_recorrencia_5['id_cliente'];
		$id_empresa = 	'1361';
		$valor = 	$resp_recorrencia_5['valor'];
		$valor_br = number_format($valor, 2, ",", ".");
		$multa = 	$resp_recorrencia_5['multa'];
		$juros = 	$resp_recorrencia_5['juros'];
		$banco = 	$resp_recorrencia_5['banco'];
		$descricao = 	$resp_recorrencia_5['descricao'];
		
		$dados_empresa = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa = '$id_empresa'");
			if(mysqli_num_rows($dados_empresa) > 0){
			while ($resp_dados = mysqli_fetch_assoc($dados_empresa)) {
			$asaas_key = 	$resp_dados['asaas_key'];
			$login_padrao = 	$resp_dados['login_padrao'];
			$whats = 	$resp_dados['whats'];
			$sessao_whats = 	$resp_dados['sessao_whats'];
			$chave_pix = 	$resp_dados['chave_pix'];
			$nome_fantasia = 	$resp_dados['nome_fantasia'];
			}}
			
		
		$cons_cliente = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
			if(mysqli_num_rows($cons_cliente) > 0){
			while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
				$nome_cliente = 	$resp_cliente['nome_cliente'];
				$doc_cliente = 	$resp_cliente['doc_cliente'];
				$doc_cliente = preg_replace("/[^0-9]/", "", $doc_cliente);
				$rg_cliente	 = 	$resp_cliente['rg_cliente'];
				$data_nascimento = 	$resp_cliente['data_nascimento'];
				$data_nascimento = date('d/m/Y', strtotime("$data_nascimento"));
				$cep = 	$resp_cliente['cep'];
				$endereco = 	$resp_cliente['endereco'];
				$numero = 	$resp_cliente['numero'];
				$complemento = 	$resp_cliente['complemento'];
				$bairro = 	$resp_cliente['bairro'];
				$cidade = 	$resp_cliente['cidade'];
				$estado = 	$resp_cliente['estado'];
				$telefone_residencial = 	$resp_cliente['telefone_residencial'];
				$telefone_celular = 	$resp_cliente['telefone_celular'];
				$telefone_celular = preg_replace("/[^0-9]/", "", $telefone_celular);
				$telefone_outros = 	$resp_cliente['telefone_outros'];
				$email = 	$resp_cliente['email'];
				$id_asaas = 	$resp_cliente['id_asaas'];
			}}
			
		
		$data_vencimento = $dia_cont_5;

		$class_financeira = '5';
		$especie = '2';
		
		$pedido = date('Ymd');
		$pedido = $pedido.$id_cliente;
		
		if($banco == 5){
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "https://www.asaas.com/api/v3/payments");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);

			curl_setopt($ch, CURLOPT_POST, TRUE);

			curl_setopt($ch, CURLOPT_POSTFIELDS, "{
			  \"customer\": \"$id_asaas\",
			  \"billingType\": \"BOLETO\",
			  \"dueDate\": \"$data_vencimento\",
			  \"value\": \"$valor\",
			  \"description\": \"$descricao\",
			  \"externalReference\": \"$id_cliente\",
			  \"discount\": {
				\"value\": 0,
				\"dueDateLimitDays\": 0
			  },
			  \"fine\": {
				\"value\": \"$multa\"
			  },
			  \"interest\": {
				\"value\": \"$juros\"
			  },
			  \"postalService\": false
			}");

			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			  "Content-Type: application/json",
			  "access_token: $asaas_key"
			));

			

			$response = curl_exec($ch);
			echo $response;
			
			$obj = json_decode($response);
			$id_fatura = $obj->{'id'};
			$invoiceNumber = $obj->{'invoiceNumber'};
			$url_pdf = $obj->{'bankSlipUrl'};
			
			
			
			if($id_fatura != ''){
				$sql_contas = mysqli_query($conn, "INSERT IGNORE INTO contas_receber (id_cliente, id_empresa, data_emissao, duplicata, descricao, nosso_numero, banco, nr_banco, valor_bruto, class_financeira, especie, link_boleto, data_vencimento, id_recorrencia) VALUES ('$id_cliente', '$id_empresa', '$data_hoje', '$invoiceNumber', '$nome_cliente', '$invoiceNumber', '$banco', '$id_fatura', '$valor', '$class_financeira', '$especie', '$url_pdf', '$data_vencimento', '$id_recorrencia')");
				
				$sql_rec = mysqli_query($conn, "UPDATE recorrencia SET ultima_cobranca='$data_hoje' WHERE id_recorrencia = '$id_recorrencia'");
				
					$id_unico_msg = 'FAT-'.$id_unico.'-'.$id_cliente;
					
					$cons_msg = mysqli_query($conn,"SELECT * FROM mensagens WHERE id_mensagem='1'");
						if(mysqli_num_rows($cons_msg) > 0){
							while ($resp_msg = mysqli_fetch_assoc($cons_msg)) {
							$vencimento_dia = 	$resp_msg['novo_boleto'];
							$vencimento_dia = str_replace('CLIENTE', $nome_cliente, $vencimento_dia);
							$vencimento_dia = str_replace('VENC', $data_vencimento_br, $vencimento_dia);
							$vencimento_dia = str_replace('VALOR', $valor_br, $vencimento_dia);
							$vencimento_dia = str_replace('CHAVE_PIX', $chave_pix, $vencimento_dia);
							$vencimento_dia = str_replace('NOMEEMPRESA', $nome_fantasia, $vencimento_dia);
							$vencimento_dia = str_replace('LINK', $linkBoleto, $vencimento_dia);
							}	
							}
				
					$insere_alerta1 = mysqli_query($conn, "INSERT IGNORE INTO envios_whats (id_unico, telefone, mensagem, enviado, id_cliente, data_envio, id_empresa, session, tipo) VALUES ('$id_unico_msg', '$telefone_celular', '$vencimento_dia', 'NAO', '$id_cliente', '$data_agora', '$id_empresa', '$sessao_whats', 'FINANCEIRO')");
				
			}
			
			
			
		}
		
		
		
		

	}}
}


?>