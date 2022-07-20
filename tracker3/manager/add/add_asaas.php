<?php

include_once("../conexao.php");
$data_login = date("Y-m-d H:i");

$id_cliente = $_REQUEST['id_cliente'];
$tipo = $_REQUEST['tipo'];
	
	

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
$cep = preg_replace("/[^0-9]/", "", $cep);
$endereco = 	$resp_cliente['endereco'];
$numero = 	$resp_cliente['numero'];
$complemento = 	$resp_cliente['complemento'];
$bairro = 	$resp_cliente['bairro'];
$cidade = 	$resp_cliente['cidade'];
$estado = 	$resp_cliente['estado'];
$telefone_residencial = 	$resp_cliente['telefone_residencial'];
$telefone_celular = 	$resp_cliente['telefone_celular'];
$telefone_celular = preg_replace("/[^0-9]/", "", $telefone_outros);

$email = 	$resp_cliente['email'];
$id_empresa = 	$resp_cliente['id_empresa'];

	}}
	
	
$cons_nivel = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='$id_empresa'");
	if(mysqli_num_rows($cons_nivel) > 0){
	while ($resp_nivel = mysqli_fetch_assoc($cons_nivel)) {
		$asaas_key = 	$resp_nivel['asaas_key'];
	}}	


$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://www.asaas.com/api/v3/customers");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);

curl_setopt($ch, CURLOPT_POST, TRUE);

curl_setopt($ch, CURLOPT_POSTFIELDS, "{
  \"name\": \"$nome_cliente\",
  \"email\": \"$email\",
  \"phone\": \"$telefone_outros\",
  \"mobilePhone\": \"$telefone_outros\",
  \"cpfCnpj\": \"$doc_cliente\",
  \"postalCode\": \"$cep\",
  \"address\": \"$endereco\",
  \"addressNumber\": \"$numero\",
  \"complement\": \"$complemento\",
  \"province\": \"$bairro\",
  \"externalReference\": \"$id_cliente\",
  \"notificationDisabled\": false
}");

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  "Content-Type: application/json",
  "access_token: $asaas_key"
));

$response = curl_exec($ch);
curl_close($ch);

//var_dump($response);
	
$obj = json_decode($response);
$id_asaas = $obj->{'id'};

$sql_customer = mysqli_query($conn, "UPDATE clientes SET id_asaas='$id_asaas' WHERE id_cliente='$id_cliente'");


$base64 = 'id_cliente:'.$id_cliente;
$base64 = base64_encode($base64);


if($tipo == 'carne'){
	header('Location: ../gerar_carne_asaas.php?c='.$base64.'');
}
if($tipo == 'recorrencia'){
	header('Location: ../gerar_recorrencia_asaas.php?c='.$base64.'');
}
if($tipo == 'boleto'){
	header('Location: ../gerar_boleto_asaas.php?c='.$base64.'');
}

	?>