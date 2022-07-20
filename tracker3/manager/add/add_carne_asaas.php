<?php

include_once("../conexao.php");

$date = date('Y-m-d');
$data_agora = date('Y-m-d H:i');

$banco = '5';
$id_cliente = $_REQUEST['id_cliente'];
$id_empresa = $_REQUEST['id_empresa'];
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
$parcelas = $_REQUEST['parcelas'];
$valor_desconto = $_REQUEST['valor_desconto'];
$valor_desconto = str_replace(".","","$valor_desconto");
$valor_desconto = str_replace(",",".","$valor_desconto");

$desconto = $_REQUEST['desconto'];
$desconto = str_replace(".","","$desconto");
$desconto = str_replace(",",".","$desconto");

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

$cons_nivel = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='$id_empresa'");
	if(mysqli_num_rows($cons_nivel) > 0){
while ($resp_nivel = mysqli_fetch_assoc($cons_nivel)) {
$asaas_key = 	$resp_nivel['asaas_key'];
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
  \"installmentValue\": \"$valor_bruto\",
  \"installmentCount\": \"$parcelas\",
  \"description\": \"$descricao\",
  \"externalReference\": \"$id_cliente\",
  \"discount\": {
    \"value\": \"$desconto\",
    \"dueDateLimitDays\": 0,
	\"type\": \"FIXED\"
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

var_dump($response);


$obj = json_decode($response);
$id = $obj->{'id'};
$invoiceNumber = $obj->{'invoiceNumber'};
$installment = $obj->{'installment'};
$cod_parc = explode("_", $installment);
$id_carne = $cod_parc[1];


if($id != ''){
	
	$valor_total = $parcelas * $valor_bruto;
	
	$dias_final = $parcelas * 30;
	$final = date('Y-m-d', strtotime('+'.$parcelas.' months', strtotime($data_vencimento)));

$sql2 = mysqli_query($conn, "UPDATE clientes SET id_carne='$id_carne' WHERE id_cliente='$id_cliente'");

$sql3 =  mysqli_query($conn, "INSERT INTO carnes (id_carne, id_cliente, id_empresa, parcelas, valor_parcela, valor_total, data_criacao, data_termino) VALUES ('$id_carne', '$id_cliente', '$id_empresa', '$parcelas', '$valor_bruto', '$valor_total', '$data_agora', '$final')");

header('Location: add_carne_asaas2.php?installment='.$installment.'&id_cliente='.$id_cliente.'&id_carne='.$id_carne.'&tipo_carn='.$tipo_carn.'');
} else{
	
$base64 = 'id_cliente:'.$id_cliente;
$base64 = base64_encode($base64);
header('Location: ../gerar_carne_asaas.php?c='.$base64.'&n=error');
}
	
	?>