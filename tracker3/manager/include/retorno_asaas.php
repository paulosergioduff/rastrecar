<?php
header('Access-Control-Allow-Origin: https://asaas.com');
date_default_timezone_set('America/Sao_Paulo');


$servidor = "localhost";
$usuario = "root";
$senha = "TR4vcijU6T9Keaw";
$dbname = "traccar";

//Criar a conexao
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
$con = mysqli_connect($servidor, $usuario, $senha, $dbname);


$data_agora = date('Y-m-d H:i');

$data = file_get_contents('php://input');


$json = json_decode($data);
$evento = $json->{'event'};
$event = $json->{'payment'};
$json = json_encode($event);

$json1 = json_decode($json);


$invoiceNumber = $json1->{'invoiceNumber'};
$id_fatura = $json1->{'id'};
$status = $json1->{'status'};
$valor_pago = $json1->{'netValue'};
$data_pagamento = $json1->{'paymentDate'};
$data_emissao = $json1->{'dateCreated'};
$data_credito = $json1->{'creditDate'};
$observacoes = $json1->{'description'};
$print_fatura = $json1->{'bankSlipUrl'};
$billingType = $json1->{'billingType'};

if($billingType == 'CREDIT_CARD'){
	$forma_pagamento = 'CARTAO DE CREDITO';
}
if($billingType != 'CREDIT_CARD'){
	$forma_pagamento = $billingType;
}

$data_vencimento_cob = $json1->{'dueDate'};
$value1 = $json1->{'value'};
$value = number_format($value1, 2, ",", ".");
$alerta = 'Seu pagamento via Boleto Bancario foi recebido.';
$style = 'AVISO';
$id_unico_pg = 'PG'.$invoiceNumber.'';


$id_asaas = $json1->{'customer'};





if($evento == 'PAYMENT_CREATED' && $status == 'PENDING'){
	$cons_cliente1 = mysqli_query($conn,"SELECT * FROM clientes WHERE id_asaas='$id_asaas'");
	if(mysqli_num_rows($cons_cliente1) > 0){
while ($resp_cliente1 = mysqli_fetch_assoc($cons_cliente1)) {
$nome_cliente1 = 	$resp_cliente1['nome_cliente'];
$id_cliente1 = 	$resp_cliente1['id_cliente'];
$doc_cliente1 = 	$resp_cliente1['doc_cliente'];
$doc_cliente_as1 = preg_replace("/[^0-9]/", "", $doc_cliente1);
$telefone_celular1 = 	$resp_cliente1['telefone_celular'];
$telefone_celular_as1 = preg_replace("/[^0-9]/", "", $telefone_celular1);


	$sql20 = mysqli_query($conn,"INSERT IGNORE INTO contas_receber (descricao, duplicata, nr_banco, data_emissao, data_vencimento, especie, observacoes, class_financeira, status, qtd_parcelas, valor_bruto, banco, juros, multa, nr_contrato, nsu, id_cliente, pdf, url_pdf, valor_pago, data_pagamento, forma_pagamento) VALUES ('$nome_cliente1', '$invoiceNumber', '$id_fatura', '$data_emissao', '$data_vencimento_cob', '2', '$observacoes', '5', 'Em Aberto', '1', '$value1', '5', '0', '0', '0', '0', '$id_cliente1', 'SIM', '$print_fatura', '0.00', '0000-00-00', '$forma_pagamento')");
	
	echo 'COBRANÇA PARA '.$nome_cliente1.' CRIADA COM SUCESSO.';
	}}
	
	

	
}





$hora_venc = date('H:i');


$date = date('Y-m-d');

$cons_conta = mysqli_query($conn,"SELECT * FROM contas_receber WHERE nsu='$id_fatura' OR nr_banco='$id_fatura'");
	if(mysqli_num_rows($cons_conta) > 0){
while ($resp_conta = mysqli_fetch_assoc($cons_conta)) {
$nsu = 	$resp_conta['nsu'];
$id_cliente = 	$resp_conta['id_cliente'];
$id_conta = 	$resp_conta['id_conta'];
$nr_banco = 	$resp_conta['nr_banco'];
$descricao = 	$resp_conta['descricao'];
$duplicata = 	$resp_conta['duplicata'];
$class_financeira = 	$resp_conta['class_financeira'];
$banco = 	$resp_conta['banco'];
$especie = 	$resp_conta['especie'];
$data_vencimento = 	$resp_conta['data_vencimento'];
$data_vencimento = date('d/m/Y', strtotime("$data_vencimento"));
	}}


$cons_cliente = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
	if(mysqli_num_rows($cons_cliente) > 0){
while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
$nome_cliente = 	$resp_cliente['nome_cliente'];
$doc_cliente = 	$resp_cliente['doc_cliente'];
$doc_cliente_as = preg_replace("/[^0-9]/", "", $doc_cliente);
$telefone_celular = 	$resp_cliente['telefone_celular'];
$telefone_celular_as = preg_replace("/[^0-9]/", "", $telefone_celular);

	}}
	




if($evento == 'PAYMENT_DELETED'){
	$sql_del = mysqli_query($conn,"DELETE FROM contas_receber WHERE id_conta='$id_conta'");
	echo 'EXCLUSAO: BOLETO DO CLIENTE '.$nome_cliente.' E FATURA '.$invoiceNumber.' EXCLUIDO COM SUCESSO';
}
if($evento == 'PAYMENT_UPDATED'){
	$sql_up = mysqli_query($conn,"UPDATE contas_receber SET data_vencimento='$data_vencimento_cob', valor_bruto='$value1' WHERE id_conta='$id_conta'");
	echo 'ALTERACAO: BOLETO DO CLIENTE '.$nome_cliente.' E FATURA '.$invoiceNumber.' ALTERADO COM SUCESSO';
}



if($evento == 'PAYMENT_RECEIVED' && $status == 'RECEIVED'){
	
	$sql11 = mysqli_query($conn,"UPDATE contas_receber SET data_pagamento='$data_pagamento', data_credito='$data_credito', valor_pago='$valor_pago', status='Pago', user_baixa='Asaas/Sistema', forma_pagamento='$forma_pagamento' WHERE id_conta='$id_conta'");
	
	
	echo 'BAIXA DO CLIENTE '.$nome_cliente.' E FATURA '.$invoiceNumber.' REALIZADA COM SUCESSO';
}
if($evento == 'PAYMENT_RECEIVED' && $status == 'CONFIRMED'){
	
	
	$sql11 = mysqli_query($conn,"UPDATE contas_receber SET data_pagamento='$data_pagamento', data_credito='$data_credito', valor_pago='$valor_pago', status='Pago', user_baixa='Asaas/Sistema', forma_pagamento='$forma_pagamento' WHERE id_conta='$id_conta'");
	
	
	echo 'BAIXA DO CLIENTE '.$nome_cliente.' E FATURA '.$invoiceNumber.' REALIZADA COM SUCESSO';
}
if($evento == 'PAYMENT_CONFIRMED' && $status == 'CONFIRMED'){
	
	
	$sql11 = mysqli_query($conn,"UPDATE contas_receber SET data_pagamento='$data_pagamento', data_credito='$data_credito', valor_pago='$valor_pago', status='Pago', user_baixa='Asaas/Sistema', forma_pagamento='$forma_pagamento' WHERE id_conta='$id_conta'");
	
	
	echo 'BAIXA DO CLIENTE '.$nome_cliente.' E FATURA '.$invoiceNumber.' REALIZADA COM SUCESSO';
}
if($evento == 'PAYMENT_RECEIVED' && $status == 'RECEIVED_IN_CASH'){
	
	$sql11 = mysqli_query($conn,"UPDATE contas_receber SET data_pagamento='$data_pagamento', data_credito='$data_credito', valor_pago='$valor_pago', status='Pago', user_baixa='Asaas/Sistema', forma_pagamento='$forma_pagamento' WHERE id_conta='$id_conta'");
	
	
	echo 'BAIXA DO CLIENTE '.$nome_cliente.' E FATURA '.$invoiceNumber.' REALIZADA COM SUCESSO';
}




















?>