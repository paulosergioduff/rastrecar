<?php

include_once("conexao.php");
$data_login = date("Y-m-d H:i");

$date = date('Y-m-d');
$data_agora = date('Y-m-d H:i');

$id_conta = $_REQUEST['id_conta'];
$observacoes = $_REQUEST['observacoes'];
$data_vencimento = $_REQUEST['data_vencimento'];
$data_vencimento1 = date('d/m/Y', strtotime("$data_vencimento"));
$valor_bruto1 = 	$_REQUEST['valor'];
$valor_bruto = str_replace(".","","$valor_bruto1");
$valor_bruto = str_replace(",",".","$valor_bruto");
$juros = 10;
$multa = 2;
$id_empresa = '1361';

$dados_boleto = mysqli_query($conn,"SELECT * FROM contas_receber WHERE id_conta = '$id_conta'");
if(mysqli_num_rows($dados_boleto) > 0){
while ($resp_bolet = mysqli_fetch_assoc($dados_boleto)) {
$pedido = 	$resp_bolet['duplicata'];

$id_cliente = 	$resp_bolet['id_cliente'];
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
$telefone_celular = preg_replace("/[^0-9]/", "", $telefone_celular	);

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

	$dados = array('vencimento' => $data_vencimento1, 'valor' => $valor_bruto, 'juros' => $juros, 'multa' => $multa, 'multa_fixo' => '0', 'nome_cliente' => $nome_cliente, 'email_cliente' => $email, 'telefone_cliente' => $telefone_celular, 'endereco_cliente' => $endereco, 'numero_cliente' => $numero, 'bairro_cliente' => $bairro, 'cidade_cliente' => $cidade, 'estado_cliente' => $estado, 'cep_cliente' => $cep, 'cpf_cliente' => $doc_cliente, 'logo_url' => 'http://'.$login_padrao.'.mtracker.com.br/logo_pjbank.png', 'instrucoes' => $instrucoes, 'instrucao_adicional' => $instrucao_adicional, 'pedido_numero' => $pedido, 'especie_documento' => 'DS', 'pix' => 'pix-e-boleto', 'webhook' => 'http://virtualtracker.com.br/tracker2/manager/include/retorno_pjb.php');
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
	$msg = $obj->{'msg'};
	$msg = str_replace('#', ' ', $msg);
	$msg = str_replace('pedido', 'boleto', $msg);
	
	$base64 = 'id_conta:'.$id_conta.'';
	$base64 = base64_encode($base64);
	
	if($status == 200){
		$sql_contas = mysqli_query($conn, "UPDATE contas_receber SET data_vencimento='$data_vencimento', valor_bruto='$valor_bruto', observacoes='$observacoes' WHERE id_conta='$id_conta'");
		
		header('Location: view_conta_receber.php?c='.$base64.'&edit=ok');
	}
	if($status == 201){
		$sql_contas = mysqli_query($conn, "UPDATE contas_receber SET data_vencimento='$data_vencimento', valor_bruto='$valor_bruto', observacoes='$observacoes' WHERE id_conta='$id_conta'");
		
		header('Location: view_conta_receber.php?c='.$base64.'&edit=ok');
	}
	if($status == 500){
		header('Location: view_conta_receber.php?c='.$base64.'&edit=erro&msg='.$msg.'');
	}
	






	?>