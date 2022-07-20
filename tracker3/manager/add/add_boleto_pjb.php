<?php

include_once("../conexao.php");
$data_login = date("Y-m-d H:i");

$date = date('Y-m-d');
$data_agora = date('Y-m-d H:i');

$banco = '1';
$id_cliente = $_REQUEST['id_cliente'];
$data_vencimento = $_REQUEST['data_vencimento'];
$data_vencimento1 = date('d/m/Y', strtotime("$data_vencimento"));
$valor_bruto1 = 	$_REQUEST['valor'];
$valor_bruto = str_replace(".","","$valor_bruto1");
$valor_bruto = str_replace(",",".","$valor_bruto");


$multa = $_REQUEST['multa'];
$multa = str_replace(".","","$multa");
$multa = str_replace(",",".","$multa");

$juros = $_REQUEST['juros'];
$juros = str_replace(".","","$juros");
$juros = str_replace(",",".","$juros");
$descricao = $_REQUEST['descricao'];
$id_empresa = '1361';
$class_financeira = $_REQUEST['class_financeira'];
$especie = '2';




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
$telefone_celular = preg_replace("/[^0-9]/", "", $telefone_celular	);
$telefone_outros = 	$resp_cliente['telefone_outros'];
$telefone_outros = preg_replace("/[^0-9]/", "", $telefone_outros);
$data_cadastro = 	$resp_cliente['data_cadastro'];
$data_cadastro = date('d/m/Y', strtotime("$data_cadastro"));
$status = 	$resp_cliente['status'];
$email = 	$resp_cliente['email'];
$indicacao = 	$resp_cliente['indicacao'];
$tipo_cliente = $resp_cliente['tipo_cliente'];
$id_asaas = $resp_cliente['id_asaas'];

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


$pedido = date('mdHms');

$pedido = $pedido.$id_empresa;

$data_vencimento1 = date('m/d/Y', strtotime("$data_vencimento"));

$data_vencimento_br = date('d/m/Y', strtotime("$data_vencimento"));
$prazo_boleto = date('d/m/Y', strtotime('+30 days', strtotime($data_vencimento)));

$instrucoes = 'Não receber após '.$prazo_boleto.'';
$instrucao_adicional = 'Cobrança sujeita a negativação em caso de não pagamento.';


	if($producao == 'NAO'){
		$url = 'https://sandbox.pjbank.com.br/recebimentos/'.$credencial.'/transacoes';
	}
	if($producao == 'SIM'){
		$url = 'https://api.pjbank.com.br/recebimentos/'.$credencial.'/transacoes';
	}
	
	$curl = curl_init();

	$dados = array('vencimento' => $data_vencimento1, 'valor' => $valor_bruto, 'juros' => $juros, 'multa' => $multa, 'multa_fixo' => '0', 'nome_cliente' => $nome_cliente, 'email_cliente' => $email, 'telefone_cliente' => $telefone_celular, 'endereco_cliente' => $endereco, 'numero_cliente' => $numero, 'bairro_cliente' => $bairro, 'cidade_cliente' => $cidade, 'estado_cliente' => $estado, 'cep_cliente' => $cep, 'cpf_cliente' => $doc_cliente, 'logo_url' => 'http://jctracker.com.br/tracker2/Imagens/logo_pjbank.png', 'texto' => $descricao, 'instrucoes' => $instrucoes, 'instrucao_adicional' => $instrucao_adicional, 'pedido_numero' => $pedido, 'especie_documento' => 'DS', 'pix' => 'pix-e-boleto', 'webhook' => 'http://jctracker.com.br/tracker3/manager/include/retorno_pjb.php');
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


	
	$base64 = 'id_cliente:'.$id_cliente.'';
	$base64 = base64_encode($base64);
	
	if($status == 200){
		$sql_contas = mysqli_query($conn, "INSERT IGNORE INTO contas_receber (id_cliente, id_empresa, data_emissao, duplicata, descricao, nosso_numero, banco, nr_banco, valor_bruto, class_financeira, especie, link_boleto, data_vencimento, linha_digitavel) VALUES ('$id_cliente', '$id_empresa', '$date', '$pedido', '$nome_cliente', '$nossonumero', '$banco', '$id_unico', '$valor_bruto', '$class_financeira', '$especie', '$linkBoleto', '$data_vencimento', '$linhaDigitavel')");
		
		$id_unico_msg = 'FAT-'.$id_unico.'-'.$id_cliente;
	
			
		$mensagem2 = '%F0%9F%92%B2+FATURA+DISPONIVEL.%0A%0APrezado%28a%29+'.$nome_cliente.'%2C%0A%0AA+%2AJC+RASTREAMENTO%2A+informa+que+sua+fatura+j%C3%A1+est%C3%A1+dispon%C3%ADvel+para+pagamento.+%0A%0AVencimento%3A+%2A'.$data_vencimento_br.'%2A%0AValor%3A+%2AR%24+'.$valor_bruto1.'%2A%0A%0AAcesse+a+fatura+pelo+link+abaixo%0A%0A'.$linkBoleto.'%0A%0A%0A_%2AMensagem+autom%C3%A1tica+enviada+pelo+sistema%2A_';
	
		$insere_alerta1 = mysqli_query($conn, "INSERT IGNORE INTO envios_whats (id_unico, telefone, mensagem, enviado, id_cliente, data_envio, id_empresa, session, tipo) VALUES ('$id_unico_msg', '$telefone_celular', '$mensagem2', 'NAO', '$id_cliente', '$data_agora', '$id_empresa', '$sessao_whats', 'FINANCEIRO')");
	
		
		header('Location: ../gerar_boleto_pjb.php?c='.$base64.'&status=1&fat='.$linkBoleto.'');
	}
	
	if($status == 201){
		$sql_contas = mysqli_query($conn, "INSERT IGNORE INTO contas_receber (id_cliente, id_empresa, data_emissao, duplicata, descricao, nosso_numero, banco, nr_banco, valor_bruto, class_financeira, especie, link_boleto, data_vencimento, linha_digitavel) VALUES ('$id_cliente', '$id_empresa', '$date', '$pedido', '$nome_cliente', '$nossonumero', '$banco', '$id_unico', '$valor_bruto', '$class_financeira', '$especie', '$linkBoleto', '$data_vencimento', '$linhaDigitavel')");
		
		$id_unico_msg = 'FAT-'.$id_unico.'-'.$id_cliente;
	
			
		$mensagem2 = '%F0%9F%92%B2+FATURA+DISPONIVEL.%0A%0APrezado%28a%29+'.$nome_cliente.'%2C%0A%0AA+%2AJC+RASTREAMENTO%2A+informa+que+sua+fatura+j%C3%A1+est%C3%A1+dispon%C3%ADvel+para+pagamento.+%0A%0AVencimento%3A+%2A'.$data_vencimento_br.'%2A%0AValor%3A+%2AR%24+'.$valor_bruto1.'%2A%0A%0AAcesse+a+fatura+pelo+link+abaixo%0A%0A'.$linkBoleto.'%0A%0A%0A_%2AMensagem+autom%C3%A1tica+enviada+pelo+sistema%2A_';
	
		$insere_alerta1 = mysqli_query($conn, "INSERT IGNORE INTO envios_whats (id_unico, telefone, mensagem, enviado, id_cliente, data_envio, id_empresa, session, tipo) VALUES ('$id_unico_msg', '$telefone_celular', '$mensagem2', 'NAO', '$id_cliente', '$data_agora', '$id_empresa', '$sessao_whats', 'FINANCEIRO')");
	
		
		header('Location: ../gerar_boleto_pjb.php?c='.$base64.'&status=1&fat='.$linkBoleto.'');
	}
	if($status != 200 or $status != 201){
		//header('Location: ../gerar_boleto_pjb.php?c='.$base64.'&status=erro');
	}






	?>