  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('../conexao.php');

$data_agora = date('Y-m-d');
$data_criacao = date('Y-m-d H:i');
$banco = 	$_POST['banco'];
$data_vencimento = 	$_POST['data_vencimento'];


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
$id_empresa = 	'1361';

$id_assinatura = 	$_POST['id_assinatura'];

$forma_pagamento = 'Cartao de Credito';

$banco_credito = '0';
$agencia_credito = '0';
$conta_credito = '0';

$dados_empresa = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa = '$id_empresa'");
	if(mysqli_num_rows($dados_empresa) > 0){
while ($resp_dados = mysqli_fetch_assoc($dados_empresa)) {
$credencial = 	$resp_dados['credencial'];
$asaas_key = 	$resp_dados['asaas_key'];
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
	



$up_veic = mysqli_query($conn, "UPDATE veiculos_clientes SET recorrencia='SIM', id_recorrencia='$id_recorrencia' WHERE id_veiculo IN ($id_veiculo)");


#==========================================

$dados_cliente = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente = '$id_cliente'");
	if(mysqli_num_rows($dados_cliente) > 0){
while ($resp_cliente = mysqli_fetch_assoc($dados_cliente)) {
$id_asaas = 	$resp_cliente['id_asaas'];
$nome_cliente = 	$resp_cliente['nome_cliente'];
	}}



$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://www.asaas.com/api/v3/subscriptions");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);

curl_setopt($ch, CURLOPT_POST, TRUE);

curl_setopt($ch, CURLOPT_POSTFIELDS, "{
  \"customer\": \"$id_asaas\",
  \"billingType\": \"UNDEFINED\",
  \"nextDueDate\": \"$data_vencimento\",
  \"value\": $valor,
  \"cycle\": \"MONTHLY\",
  \"description\": \"$descricao\",
  \"discount\": {
    \"value\": 0,
    \"dueDateLimitDays\": 0
  },
  \"fine\": {
    \"value\": $multa
  },
  \"interest\": {
    \"value\": $juros
  }
}");

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  'Content-Type: application/json',
  'access_token: '.$asaas_key.''
));

$response = curl_exec($ch);
curl_close($ch);

//var_dump($response);


$base64 = 'id_cliente:'.$id_cliente.'';
$base64 = base64_encode($base64);

$obj = json_decode($response);
$assinatura_asaas = $obj->{'id'};

if($assinatura_asaas == '0' or $assinatura_asaas == ''){
	header('Location: cad_cliente.php?c='.$base64.'&error=404');
} else {
$sql33 = mysqli_query($conn,"INSERT IGNORE INTO assinaturas_asaas (assinatura_asaas, id_cliente, valor, id_empresa, data_criacao) VALUES ('$assinatura_asaas', '$id_cliente', '$valor', '$id_empresa', '$data_agora')");


header('Location: ../gerar_recorrencia_asaas_card.php?c='.$base64.'&status=1');
}













?>
