<?php

include_once("../conexao.php");

$date = date('Y-m-d');
$data_agora = date('Y-m-d H:i');

$banco = '5';

$installment = $_REQUEST['installment'];
$id_cliente = $_REQUEST['id_cliente'];
$id_carne = $_REQUEST['id_carne'];


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
}}

	$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www.asaas.com/api/v3/payments?installment=$installment&offset=0&limit=20");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  "Content-Type: application/json",
  "access_token: $asaas_key"
));

$response = curl_exec($ch);
curl_close($ch);

echo $response;

$class_financeira = '5';
$especie = '2';
$banco = '5';



$json = json_decode($response);

foreach($json->data as $registro):
    $id_fatura = $registro->{'id'};
	$invoiceNumber = $registro->{'invoiceNumber'};
	$valor_bruto = $registro->{'value'};
	$valor_bruto = number_format($valor_bruto, 2, ",", ".");
	$valor_bruto = str_replace(".","","$valor_bruto");
	$valor_bruto = str_replace(",",".","$valor_bruto");
	$data_vencimento = $registro->{'dueDate'};
	$descricao = $registro->{'description'};
	$url_pdf = $registro->{'bankSlipUrl'};
	
	$parc = explode(".", $descricao);
	$parcela = $parc[0];
	$id_carne = $_REQUEST['id_carne'];
	//echo 'Fatura: '.$invoiceNumber.' - venc: '.$data_vencimento.' - Valor: '.$valor_bruto.'<br>';
	
	$sql_contas = mysqli_query($conn, "INSERT IGNORE INTO contas_receber (id_cliente, id_empresa, data_emissao, duplicata, descricao, nosso_numero, banco, nr_banco, valor_bruto, class_financeira, especie, link_boleto, data_vencimento, id_carne, parcela, url_pdf) VALUES ('$id_cliente', '$id_empresa', '$date', '$invoiceNumber', '$nome_cliente', '$invoiceNumber', '$banco', '$id_fatura', '$valor_bruto', '$class_financeira', '$especie', '$url_pdf', '$data_vencimento', '$id_carne', '$parcela', '$url_pdf')");
	
endforeach;

$base64 = 'id_cliente:'.$id_cliente;
$base64 = base64_encode($base64);

header('Location: ../gerar_carne_asaas.php?c='.$base64.'&status=1&p=https://www.asaas.com/installment/paymentBook/'.$id_carne.'');

echo '<script>
top.location.href = "../gerar_carne_asaas.php?c='.$base64.'&status=1&p=https://www.asaas.com/installment/paymentBook/'.$id_carne.'";
</script>';
?>
