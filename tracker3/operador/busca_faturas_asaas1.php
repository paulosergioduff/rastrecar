<?php

include_once("conexao.php");
$data_login = date("Y-m-d H:i");

$id_cliente = $_REQUEST['id_cliente'];
$id_asaas = $_REQUEST['id_asaas'];

$base64 = 'id_cliente:'.$id_cliente;
$base64 = base64_encode($base64);

$cons_nivel = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='1361'");
	if(mysqli_num_rows($cons_nivel) > 0){
while ($resp_nivel = mysqli_fetch_assoc($cons_nivel)) {
$asaas_key = 	$resp_nivel['asaas_key'];
}}

$cons_consulta = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
	if(mysqli_num_rows($cons_consulta) > 0){
while ($resp_nivel1 = mysqli_fetch_assoc($cons_consulta)) {
$nome_cliente = 	$resp_nivel1['nome_cliente'];
}}
	
#--------------------------------------------------

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://www.asaas.com/api/v3/payments?customer='.$id_asaas.'&offset=0&limit=20');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  "access_token: $asaas_key"
));

$response = curl_exec($ch);
curl_close($ch);

var_dump($response);

$json = json_decode($response);

foreach($json->data as $registro):
	$nr_fatura = $registro->invoiceNumber;
	$id_fatura = $registro->id;
	$valor = $registro->value;
	$valor1 = number_format($valor, 2, ",", ".");
	$valor = str_replace(".","","$valor1");
	$valor = str_replace(",",".","$valor");
	$valor_pago1 = $registro->netValue;
	$valor_pago1 = number_format($valor_pago1, 2, ",", ".");
	$valor_pago1 = str_replace(".","","$valor_pago1");
	$valor_pago1 = str_replace(",",".","$valor_pago1");
	$data_emissao = $registro->dateCreated;
	$data_vencimento = $registro->dueDate;
	$data_vencimento1 = date('d/m/Y', strtotime("$data_vencimento"));
	$data_pagamento = $registro->clientPaymentDate;
	$status = $registro->status;
	$print_fatura = $registro->bankSlipUrl;
	$observacoes = $registro->description;
	$installment = $registro->installment;
	$cod_parc = explode("_", $installment);
	$id_carne = $cod_parc[1];
	
	

	
	if($status == 'RECEIVED_IN_CASH'){
		$status1 = 'Pago';
		$cor = 'success';
		$data_pg = $data_pagamento1;
		$icone_pg = '<i class="fas fa-thumbs-up"></i>';
		$data_pgto = $data_pagamento;
		$valor_pago = $valor_pago1;
		$forma_pagamento = 'DINHEIRO';
		}
	if($status == 'RECEIVED'){
		$status1 = 'Pago';
		$cor = 'success';
		$data_pg = $data_pagamento1;
		$icone_pg = '<i class="fas fa-thumbs-up"></i>';
		$data_pgto = $data_pagamento;
		$valor_pago = $valor_pago1;
		$forma_pagamento = 'BOLETO';
		}
	if($status == 'PENDING'){
		$status1 = 'Em Aberto';
		$cor = 'info';
		$data_pg = '------';
		$icone_pg = '<i class="fas fa-thumbs-up"></i>';
		$data_pgto = '0000-00-00';
		$valor_pago = '0.00';
		}
	if($status == 'OVERDUE'){
		$status1 = 'Em Aberto';
		$cor = 'danger';
		$data_pg = '------';
		$icone_pg = '<i class="fas fa-thumbs-down"></i>';
		$data_pgto = '0000-00-00';
		$valor_pago = '0.00';
		}
	
	$sql = mysqli_query($conn,"INSERT IGNORE INTO contas_receber (descricao, duplicata, nr_banco, data_emissao, data_vencimento, especie, observacoes, class_financeira, status, qtd_parcelas, valor_bruto, banco, juros, multa, nr_contrato, nsu, id_cliente, pdf, url_pdf, valor_pago, data_pagamento, forma_pagamento, id_carne) VALUES ('$nome_cliente', '$nr_fatura', '$id_fatura', '$data_emissao', '$data_vencimento', '2', '$observacoes', '5', '$status1', '1', '$valor', '5', '0', '0', '0', '0', '$id_cliente', 'SIM', '$print_fatura', '$valor_pago', '$data_pgto', '$forma_pagamento', '$id_carne')");
	

   


	
endforeach;

header('Location: cad_cliente.php?c='.$base64.'&cad_asaas=ok');



	?>