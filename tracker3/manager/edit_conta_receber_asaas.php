<?php

include_once("conexao.php");
$data_login = date("Y-m-d H:i");

$date = date('Y-m-d');
$data_agora = date('Y-m-d H:i');

$data_vencimento = $_REQUEST['data_vencimento'];
$data_vencimento1 = date('d/m/Y', strtotime("$data_vencimento"));
$valor_bruto1 = 	$_REQUEST['valor_bruto'];
$valor_bruto = str_replace(".","","$valor_bruto1");
$valor_bruto = str_replace(",",".","$valor_bruto");
$id_conta = $_REQUEST['id_conta'];
$observacoes = $_REQUEST['observacoes'];
$id_empresa = '1361';


$dados_boleto = mysqli_query($conn,"SELECT * FROM contas_receber WHERE id_conta = '$id_conta'");
if(mysqli_num_rows($dados_boleto) > 0){
while ($resp_bolet = mysqli_fetch_assoc($dados_boleto)) {
$nr_banco = 	$resp_bolet['nr_banco'];
$nsu = 	$resp_bolet['nsu'];

$id_cliente = 	$resp_bolet['id_cliente'];
}}	

if($nr_banco == '0' or $nr_banco == ''){
	$id_fatura = $nsu;
} else {
	$id_fatura = $nr_banco;
}
	


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
curl_setopt($ch, CURLOPT_URL, 'https://www.asaas.com/api/v3/payments/'.$id_fatura.'');
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

$base64 = 'id_conta:'.$id_conta;
$base64 = base64_encode($base64);

if($id_fatura != ''){
	$sql_contas = mysqli_query($conn, "UPDATE contas_receber SET data_vencimento='$data_vencimento', valor_bruto='$valor_bruto', observacoes='$observacoes' WHERE id_conta='$id_conta'");
		
		header('Location: view_conta_receber.php?c='.$base64.'&edit=ok');
	
} else {
	header('Location: view_conta_receber.php?c='.$base64.'&edit=erro&msg=Não Foi Possivel Alterar o boleto.');
}






	?>