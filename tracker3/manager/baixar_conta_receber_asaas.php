  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('conexao.php');

$date = date('Y-m-d');
$hora = date('H:i:s');
$user_baixa = $_POST['user_baixa'];
$data_agora = date('Y-m-d H:i');

$id_conta	 = 	$_POST['id_conta'];
$data_pagamento = 	$_POST['data_pagamento'];
$forma_pagamento = 	$_POST['forma_pagamento'];

$valor_pago1 = 	$_POST['valor_pago'];
$valor_pago = str_replace(".","","$valor_pago1");
$valor_pago = str_replace(",",".","$valor_pago");
$obs_baixa	 = 	$_POST['obs_baixa'];
$banco	 = 	$_POST['banco'];
$status = $_POST['status'];
$id_empresa = '1361';

$cons_contas = mysqli_query($conn,"SELECT * FROM contas_receber WHERE id_conta='$id_conta'");
	if(mysqli_num_rows($cons_contas) > 0){
while ($resp_contas = mysqli_fetch_array($cons_contas)) {
	$descricao = $resp_contas['descricao'];
	$especie = $resp_contas['especie'];
	
	$duplicata = $resp_contas['duplicata'];
	$class_financeira = $resp_contas['class_financeira'];
	$especie = $resp_contas['especie'];
	$especie = $resp_contas['especie'];
	$nr_banco = $resp_contas['nr_banco'];
	$nsu = $resp_contas['nsu'];
	$id_cliente = $resp_contas['id_cliente'];
	$data_vencimento = $resp_contas['data_vencimento'];
	$data_vencimento1 = date('d/m/Y', strtotime("$data_vencimento"));
	$id_data = date('Ymd');
	$id_unico = 'PG-'.$id_data.'-'.$duplicata.'-'.$id_cliente.'';
}}
if($nr_banco == '0'){
	$id_fatura = $nsu;
} 

if($nr_banco != '0') {
	$id_fatura = $nr_banco;
}	


$sql_vuser = mysqli_query($conn, "SELECT * FROM clientes WHERE id_cliente = '$id_cliente'");
	if(mysqli_num_rows($sql_vuser) > 0){
		while ($resp_vuser = mysqli_fetch_assoc($sql_vuser)) {
		$nome_cliente = 	$resp_vuser['nome_cliente'];
		$doc_cliente = 	$resp_vuser['doc_cliente'];
		$usuario = preg_replace("/[^0-9]/", "", $doc_cliente);
		$telefone_celular2 = 	$resp_vuser['telefone_celular'];
		$telefone_celular2 = preg_replace("/[^0-9]/", "", $telefone_celular2);
	}}
	
$cons_nivel = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='$id_empresa'");
	if(mysqli_num_rows($cons_nivel) > 0){
	while ($resp_nivel = mysqli_fetch_assoc($cons_nivel)) {
		$asaas_key = 	$resp_nivel['asaas_key'];
		$whats = 	$resp_nivel['whats'];
		$sessao_whats = 	$resp_nivel['sessao_whats'];
		$nome_fantasia = 	$resp_nivel['nome_fantasia'];
	}}	


$sql11 = mysqli_query($conn,"UPDATE contas_receber SET data_pagamento='$data_pagamento', data_credito='$data_pagamento', valor_pago='$valor_pago', obs_baixa='$obs_baixa', banco='$banco', status='$status', user_baixa='$user_baixa', forma_pagamento='$forma_pagamento' WHERE id_conta='$id_conta'");





	$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://www.asaas.com/api/v3/payments/'.$id_fatura.'/receiveInCash');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);

curl_setopt($ch, CURLOPT_POST, TRUE);

curl_setopt($ch, CURLOPT_POSTFIELDS, "{
    \"paymentDate\": \"$data_pagamento\",
    \"value\": $valor_pago
}");

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  "Content-Type: application/json",
  "access_token: $asaas_key"
));

$response = curl_exec($ch);
curl_close($ch);

var_dump($response);


	$texto_push1 = '%E2%9C%85+CONFIRMA%C3%87%C3%83O+DE+PAGAMENTO+%E2%9C%85%0A%0APrezado%28a%29%2C+'.$descricao.'%2C+%0Aseu+pagamento+foi+identificado+em+nosso+sistema.+%0A%0AValor%3A+R%24+'.$valor_pago1.'%0AVencimento%3A+'.$data_vencimento1.'%0A%0AAgradecemos%0A%2AFinanceiro+JC+CAR+Rastreamento%2A%0A%0A%2A_Mensagem+autom%C3%A1tica.+Por+favor+n%C3%A3o+responda._%2A';

	$insere_whats1 = mysqli_query($conn, "INSERT IGNORE INTO envios_whats (id_unico, telefone, mensagem, enviado, id_cliente, data_envio, session, id_empresa) VALUES ('$id_unico', '$telefone_celular2', '$texto_push1', 'NAO', '$id_cliente', '$data_agora', '$$sessao_whats', '$id_empresa')");


$base64 = 'id_conta:'.$id_conta;
$base64 = base64_encode($base64);

header('Location: view_conta_receber.php?c='.$base64.'&baixa=ok');


?>
