  <?php

$servidor = "localhost";
$usuario = "root";
$senha = "TR4vcijU6T9Keaw";
$dbname = "traccardb";


$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
$con = mysqli_connect($servidor, $usuario, $senha, $dbname);
#==============================

$data_agora = date('Y-m-d H:i');

$data = file_get_contents('php://input');



$json = json_decode($data);
$json1 = json_encode($json);

$tipo = $json->{'tipo'};
$forma_liquidacao = $json->{'forma_liquidacao'};
$operacao = $json->{'operacao'};
$valor_pago = $json->{'valor_pago'};
$valor_pago1 = number_format($valor_pago, 2, ",", ".");
$valor_bruto = $json->{'valor'};
$valor_bruto1 = number_format($valor_bruto, 2, ",", ".");
$valor_liquido = $json->{'valor_liquido'};
$nosso_numero = $json->{'nosso_numero'};
$id_unico = $json->{'id_unico'};

$data_pagamento = $json->{'data_pagamento'};
$data_pagamento = date('Y-m-d', strtotime("$data_pagamento"));
$data_pagamento1 = date('d/m/Y', strtotime("$data_pagamento"));
$data_credito = $json->{'data_credito'};
$data_credito = date('Y-m-d', strtotime("$data_credito"));


$cons_conta = mysqli_query($conn,"SELECT * FROM contas_receber WHERE nosso_numero='$id_unico'");
	if(mysqli_num_rows($cons_conta) > 0){	
	while ($resp_conta = mysqli_fetch_assoc($cons_conta)) {
$id_conta = 	$resp_conta['id_conta'];
$id_cliente = 	$resp_conta['id_cliente'];
$data_vencimento = 	$resp_conta['data_vencimento'];
$data_vencimento = date('d/m/Y', strtotime("$data_vencimento"));
	}}
	
$cons_cliente = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
	if(mysqli_num_rows($cons_cliente) > 0){
while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
$nome_cliente = 	$resp_cliente['nome_cliente'];
$id_empresa = 	$resp_cliente['id_empresa'];
$doc_cliente = 	$resp_cliente['doc_cliente'];
$doc_cliente_as = preg_replace("/[^0-9]/", "", $doc_cliente);
$telefone_celular = 	$resp_cliente['telefone_celular'];
$telefone_celular_as = preg_replace("/[^0-9]/", "", $telefone_celular);
	}}

$dados_empresa = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa = '1361'");
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






#---------------- RETORNO COBRANÇA BOLETO ---------------------



if($valor_pago != ''){
	$status = 'Pago';
	$atualiza_conta = mysqli_query($conn, "UPDATE contas_receber SET data_pagamento='$data_pagamento', valor_pago='$valor_pago', data_credito='$data_credito' , status='$status', user_baixa='SISTEMA', obs_baixa='$forma_liquidacao', conta_repasse='$conta_repasse', agencia_repasse='$agencia_repasse', banco_repasse='$banco_repasse', valor_liquido='$valor_liquido' WHERE id_conta='$id_conta'");	
	
	
	$id_unico_msg = 'PAG-'.$id_unico.'-'.$id_cliente;
		
	$confirmacao = '%E2%9C%85+CONFIRMA%C3%87%C3%83O+DE+PAGAMENTO+%E2%9C%85%0A%0APrezado%28a%29%2C+'.$nome_cliente.'%0Aseu+pagamento+foi+identificado+em+nosso+sistema.+%0A%0AValor%3A+R%24+'.$valor_bruto1.'%0AVencimento%3A+'.$data_vencimento.'%0A%0AData+Pagto%3A+'.$data_pagamento1.'%0AValor+Pago%3A+R%24+'.$valor_pago1.'%0A%0AAgradecemos%0A%2AFinanceiro+JC+CAR+RASTREAMENTO%2A%0A%0A%2A_Mensagem+autom%C3%A1tica.+Por+favor+n%C3%A3o+responda._%2A';

	$insere_alerta1 = mysqli_query($conn, "INSERT IGNORE INTO envios_whats (id_unico, telefone, mensagem, enviado, id_cliente, data_envio, id_empresa, session, tipo) VALUES ('$id_unico_msg', '$telefone_celular', '$vencimento_dia', 'NAO', '$id_cliente', '$data_agora', '$id_empresa', '$sessao_whats', 'FINANCEIRO')");
		
	
}



$atualiza_conta1 = mysqli_query($conn, "INSERT INTO	a_teste (texto, data, nosso_numero) VALUES ('$json1', '$data_agora', '$nosso_numero')");











?>
