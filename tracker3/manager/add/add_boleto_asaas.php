<?php

include_once("../conexao.php");
$data_login = date("Y-m-d H:i");

$date = date('Y-m-d');
$data_agora = date('Y-m-d H:i');

$banco = '5';
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
$id_empresa = $resp_cliente['id_empresa'];
	}}
	
	
$cons_nivel = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='$id_empresa'");
	if(mysqli_num_rows($cons_nivel) > 0){
	while ($resp_nivel = mysqli_fetch_assoc($cons_nivel)) {
		$asaas_key = 	$resp_nivel['asaas_key'];
		$whats = 	$resp_nivel['whats'];
	}}	


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www.asaas.com/api/v3/payments");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);

curl_setopt($ch, CURLOPT_POST, TRUE);

curl_setopt($ch, CURLOPT_POSTFIELDS, "{
  \"customer\": \"$id_asaas\",
  \"billingType\": \"BOLETO\",
  \"dueDate\": \"$data_vencimento\",
  \"value\": \"$valor_bruto\",
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
curl_close($ch);

echo $response.'<br>'.$id_cliente;
	
$obj = json_decode($response);
$id_fatura = $obj->{'id'};
$invoiceNumber = $obj->{'invoiceNumber'};
$url_pdf = $registro->{'bankSlipUrl'};
$fat1 = explode("_", $id_fatura);
$fat = $fat1[1];



if($id_fatura != ''){
	$sql_contas = mysqli_query($conn, "INSERT IGNORE INTO contas_receber (id_cliente, id_empresa, data_emissao, duplicata, descricao, nosso_numero, banco, nr_banco, valor_bruto, class_financeira, especie, link_boleto, data_vencimento, url_pdf) VALUES ('$id_cliente', '$id_empresa', '$date', '$invoiceNumber', '$nome_cliente', '$invoiceNumber', '$banco', '$id_fatura', '$valor_bruto', '$class_financeira', '$especie', '$url_pdf', '$data_vencimento', '$url_pdf')");
	
	
	if($whats == 'SIM'){
		$id_unico_msg = 'FAT-'.$id_unico.'-'.$id_cliente;
		

		$mensagem2 = '%F0%9F%92%B2+FATURA+DISPONIVEL.%0A%0APrezado%28a%29+'.$nome_cliente.'%2C%0A%0AA+%2AJC+RASTREAMENTO%2A+informa+que+sua+fatura+j%C3%A1+est%C3%A1+dispon%C3%ADvel+para+pagamento.+%0A%0AVencimento%3A+%2A'.$data_vencimento_br.'%2A%0AValor%3A+%2AR%24+'.$valor_br.'%2A%0A%0AAcesse+a+fatura+pelo+link+abaixo%0A%0A'.$linkBoleto.'%0A%0A%0A_%2AMensagem+autom%C3%A1tica+enviada+pelo+sistema%2A_';
	
		$insere_alerta1 = mysqli_query($conn, "INSERT IGNORE INTO envios_whats (id_unico, telefone, mensagem, enviado, id_cliente, data_envio, id_empresa, session, tipo) VALUES ('$id_unico_msg', '$telefone_celular', '$mensagem2', 'NAO', '$id_cliente', '$data_agora', '$id_empresa', 'jcrast', 'FINANCEIRO')");

	}
	
	
	
	$base64 = 'id_cliente:'.$id_cliente;
	$base64 = base64_encode($base64);
	
	header('Location: ../gerar_boleto_asaas.php?c='.$base64.'&status=1&fat='.$fat.'');
} else {
	//header('Location: ../gerar_boleto_asaas.php?c='.$base64.'&status=0');
}






	?>