  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('../conexao.php');

$data_agora = date('Y-m-d');
$data_criacao = date('Y-m-d H:i');
$banco = 	$_POST['banco'];
$data_vencimento = 	$_POST['data_vencimento'];
$dia_vencimento = date('d', strtotime("$data_vencimento"));
$prazo_boleto = date('d/m/Y', strtotime('+30 days', strtotime($data_vencimento)));

$termino_recorrencia = 	$_POST['termino_recorrencia'];
$data_termino = date('Y-m-d', strtotime('+'.$termino_recorrencia.' month', strtotime($data_vencimento)));

$valor = 	$_POST['valor'];
$valor = str_replace(".","","$valor");
$valor = str_replace(",",".","$valor");

$multa = 	$_POST['multa'];
$multa = str_replace(".","","$multa");
$multa = str_replace(",",".","$multa");

$juros = 	$_POST['juros'];
$juros = str_replace(".","","$juros");
$juros = str_replace(",",".","$juros");

$descricao = 	$_POST['descricao'];
$dias_cobranca = 	$_POST['dias_cobranca'];
$id_veiculo = 	$_POST['id_veiculo'];
$id_cliente = 	$_POST['id_cliente'];
$id_empresa = 	$_POST['id_empresa'];
$tipo = 	$_POST['tipo'];

$forma_pagamento = 'Boleto Bancario';

$banco_credito = '0';
$agencia_credito = '0';
$conta_credito = '0';

$dados_empresa = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa = '1361'");
	if(mysqli_num_rows($dados_empresa) > 0){
while ($resp_dados = mysqli_fetch_assoc($dados_empresa)) {
$credencial = 	$resp_dados['credencial'];
$producao = 	$resp_dados['producao'];
$login_padrao = 	$resp_dados['login_padrao'];
	}}

$cons_veiculos = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE id_veiculo IN ($id_veiculo)");
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


$sql_recorrencia = mysqli_query($conn, "INSERT INTO recorrencia (data_criacao, id_cliente, banco, forma_pagamento, primeiro_vencimento, valor, multa, juros, descricao, dias_cobranca, dia_vencimento, id_empresa, banco_credito, agencia_credito, conta_credito, data_termino, tipo) VALUES ('$data_criacao', '$id_cliente', '$banco', '$forma_pagamento', '$data_vencimento', '$valor', '$multa', '$juros', '$descricao', '$dias_cobranca', '$dia_vencimento', '$id_empresa', '$banco_credito', '$agencia_credito', '$conta_credito', '$data_termino', '$tipo')");


$cons_recorr = mysqli_query($conn,"SELECT * FROM recorrencia WHERE id_cliente = '$id_cliente' ORDER BY id_recorrencia DESC LIMIT 1");
	if(mysqli_num_rows($cons_recorr) > 0){
while ($resp_recor = mysqli_fetch_assoc($cons_recorr)) {
$id_recorrencia = 	$resp_recor['id_recorrencia'];
	}}

$up_veic = mysqli_query($conn, "UPDATE veiculos_clientes SET recorrencia='SIM', id_recorrencia='$id_recorrencia' WHERE id_veiculo IN ($id_veiculo)");



//----------------------------------------------------
//----------------------------------------------------
//----------------------------------------------------


$cons_cliente = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
	if(mysqli_num_rows($cons_cliente) > 0){
while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
$nome_cliente = 	$resp_cliente['nome_cliente'];
$doc_cliente = 	$resp_cliente['doc_cliente'];
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
$telefone_outros = 	$resp_cliente['telefone_outros'];
$email = 	$resp_cliente['email'];

	}}


$data_vencimento1 = date('m/d/Y', strtotime("$data_vencimento"));
$telefone_celular = preg_replace("/[^0-9]/", "", $telefone_celular);
$doc_cliente = preg_replace("/[^0-9]/", "", $doc_cliente);

$pedido = date('Ymd');
$pedido = $pedido.$id_cliente;

$instrucoes = 'Nao receber apos '.$prazo_boleto.'';
$instrucao_adicional = 'Este boleto não deve ser pago pois é um exemplo';
$class_financeira = '5';
$especie = '2';


$base64 = 'id_cliente:'.$id_cliente.'';
$base64 = base64_encode($base64);

if($data_vencimento == $data_agora){
	
	if($producao == 'NAO'){
		$url = 'https://sandbox.pjbank.com.br/recebimentos/'.$credencial.'/transacoes';
	}
	if($producao == 'SIM'){
		$url = 'https://api.pjbank.com.br/recebimentos/'.$credencial.'/transacoes';
	}

	$curl = curl_init();

	$dados = array('vencimento' => $data_vencimento1, 'valor' => $valor, 'juros' => $juros, 'multa' => $multa, 'multa_fixo' => '0', 'nome_cliente' => $nome_cliente, 'email_cliente' => $email, 'telefone_cliente' => $telefone_celular, 'endereco_cliente' => $endereco, 'numero_cliente' => $numero, 'bairro_cliente' => $bairro, 'cidade_cliente' => $cidade, 'estado_cliente' => $estado, 'cep_cliente' => $cep, 'cpf_cliente' => $doc_cliente, 'logo_url' => 'http://jctracker.com.br/tracker2/Imagens/logo_pjbank.png', 'texto' => $itens_fatura, 'instrucoes' => $instrucoes, 'pedido_numero' => $pedido, 'especie_documento' => 'DS', 'pix' => 'pix-e-boleto', 'webhook' => 'http://jctracker.com.br/tracker3/manager/include/retorno_pjb.php');
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
	
	if($status == 200){
		$sql_contas = mysqli_query($conn, "INSERT IGNORE INTO contas_receber (id_cliente, id_empresa, data_emissao, duplicata, descricao, nosso_numero, banco, nr_banco, valor_bruto, class_financeira, especie, link_boleto, data_vencimento, linha_digitavel, id_recorrencia) VALUES ('$id_cliente', '$id_empresa', '$data_agora', '$pedido_numero', '$nome_cliente', '$nossonumero', '$banco', '$id_unico', '$valor', '$class_financeira', '$especie', '$linkBoleto', '$data_vencimento', '$linhaDigitavel', '$id_recorrencia')");
		
		header('Location: ../gerar_recorrencia_pjb.php?c='.$base64.'&status=1');
	}
	if($status == 201){
		$sql_contas = mysqli_query($conn, "INSERT IGNORE INTO contas_receber (id_cliente, id_empresa, data_emissao, duplicata, descricao, nosso_numero, banco, nr_banco, valor_bruto, class_financeira, especie, link_boleto, data_vencimento, linha_digitavel, id_recorrencia) VALUES ('$id_cliente', '$id_empresa', '$data_agora', '$pedido_numero', '$nome_cliente', '$nossonumero', '$banco', '$id_unico', '$valor', '$class_financeira', '$especie', '$linkBoleto', '$data_vencimento', '$linhaDigitavel', '$id_recorrencia')");
		
		header('Location: ../gerar_recorrencia_pjb.php?c='.$base64.'&status=1');
	}
	if($status != 200 or $status != 201){
		header('Location: ../gerar_recorrencia_pjb.php?c='.$base64.'&status=0');
	}
} else {
	header('Location: ../gerar_recorrencia_pjb.php?c='.$base64.'&status=1');
}

































?>
