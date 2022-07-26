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


$dia_cont_5 = date('Y-m-d', strtotime('+5 days', strtotime($data_hoje)));
$dia_cont_10 = date('Y-m-d', strtotime('+10 days', strtotime($data_hoje)));

$dias_5 = date('d', strtotime("$dia_cont_5"));
$dias_10 = date('d', strtotime("$dia_cont_10"));


if($hora >= '06:00' && $hora <= '07:20'){
	$cons_recorrencia_5 = mysqli_query($conn, "SELECT * FROM recorrencia WHERE primeiro_vencimento <= '$dia_cont_5' AND ativo='SIM' AND banco = '1' AND (dia_vencimento='$dias_5' AND dias_cobranca='5') AND ultima_cobranca != '$data_hoje' AND forma_pagamento='Boleto Bancario' AND tipo='MENSAL' ORDER BY id_recorrencia ASC");
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
			$credencial = 	$resp_dados['credencial'];
			$login_padrao = 	$resp_dados['login_padrao'];
			$whats = 	$resp_dados['whats'];
			$sessao_whats = 	$resp_dados['sessao_whats'];
			$chave_pix = 	$resp_dados['chave_pix'];
			$nome_fantasia = 	$resp_dados['nome_fantasia'];
			$producao = 	$resp_dados['producao'];
			}}
			
		$cons_veiculos = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE id_recorrencia = '$id_recorrencia'");
			if(mysqli_num_rows($cons_veiculos) > 0){
			while ($resp_veiculos = mysqli_fetch_assoc($cons_veiculos)) {
			$valor_mensal = 	$resp_veiculos['valor_mensal'];
			$valor_mensal = number_format($valor_mensal, 2, ",", ".");
			$veiculo = $resp_veiculos['placa'].'-'.$resp_veiculos['marca_veiculo'].'/'.$resp_veiculos['modelo_veiculo'];
			$veiculos = str_pad($veiculo, 74, "_", STR_PAD_RIGHT);
			$itens_fatura[] = $veiculos.' '.$valor_mensal;
				}}
				
			$itens_fatura = implode('\n', $itens_fatura);
			$itens_fatura = $descricao.'\n\n'.$itens_fatura.'\n';
		
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
			}}
			
		
		$data_vencimento = $dia_cont_5;
		$data_vencimento1 = date('m/d/Y', strtotime("$data_vencimento"));
		$data_vencimento_br = date('d/m/Y', strtotime("$data_vencimento"));
		$prazo_boleto = date('d/m/Y', strtotime('+30 days', strtotime($data_vencimento)));
		$instrucoes = 'Não receber após '.$prazo_boleto.'';
		$instrucao_adicional = 'Cobrança sujeita a negativação em caso de não pagamento.';
		$class_financeira = '5';
		$especie = '2';
		
		$pedido = date('mdHms');
		$pedido = $pedido.$id_empresa;

		
		
			
			if($producao == 'NAO'){
				$url = 'https://sandbox.pjbank.com.br/recebimentos/'.$credencial.'/transacoes';
				}
			if($producao == 'SIM'){
				$url = 'https://api.pjbank.com.br/recebimentos/'.$credencial.'/transacoes';
			}
			
			$curl = curl_init();

			$dados = array('vencimento' => $data_vencimento1, 'valor' => $valor, 'juros' => $juros, 'multa' => $multa, 'multa_fixo' => '0', 'nome_cliente' => $nome_cliente, 'email_cliente' => $email, 'telefone_cliente' => $telefone_celular, 'endereco_cliente' => $endereco, 'numero_cliente' => $numero, 'bairro_cliente' => $bairro, 'cidade_cliente' => $cidade, 'estado_cliente' => $estado, 'cep_cliente' => $cep, 'logo_url' => 'http://jctracker.com.br/tracker2/Imagens/logo_pjbank.png', 'texto' => $itens_fatura, 'instrucoes' => $instrucoes, 'instrucao_adicional' => $instrucao_adicional, 'pedido_numero' => $pedido, 'especie_documento' => 'DS', 'pix' => 'pix-e-boleto', 'webhook' => 'http://virtualtracker.com.br/tracker2/manager/include/retorno_pjb.php', 'cpf_cliente' => $doc_cliente);
			$dados = json_encode($dados);
			
			curl_setopt_array($curl, array(
			  CURLOPT_URL => $url,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'POST',
			  CURLOPT_POSTFIELDS => $dados,
			  CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json'
			  ),
			));

			$response = curl_exec($curl);
			echo $response;
			
			curl_close($curl);
			$obj = json_decode($response);
			$id_unico = $obj->{'id_unico'};
			$status = $obj->{'status'};
			$nossonumero = $obj->{'nossonumero'};
			$linkBoleto = $obj->{'linkBoleto'};
			$linhaDigitavel = $obj->{'linhaDigitavel'};
			$pedido_numero = $obj->{'pedido_numero'};
			
			
			
			if($status == 200 or $status == 201){
				$sql_contas = mysqli_query($conn, "INSERT IGNORE INTO contas_receber (id_cliente, id_empresa, data_emissao, duplicata, descricao, nosso_numero, banco, nr_banco, valor_bruto, class_financeira, especie, link_boleto, data_vencimento, linha_digitavel, id_recorrencia) VALUES ('$id_cliente', '$id_empresa', '$data_hoje', '$pedido_numero', '$nome_cliente', '$nossonumero', '$banco', '$id_unico', '$valor', '$class_financeira', '$especie', '$linkBoleto', '$data_vencimento', '$linhaDigitavel', '$id_recorrencia')");
				
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
			
			
			
		
		
		
		
		

	}}
}


?>