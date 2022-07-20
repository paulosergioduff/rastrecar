

<?php
//header("Content-Type: text/html;  charset=ISO-8859-1",true);

$offset = $_GET['offset'];
$limit = $_GET['limit'];

include('conexao.php');


$cons_conta = mysqli_query($conn,"SELECT * FROM contas_receber WHERE data_vencimento > '2021-07-01' AND id_carne != '0'");
		if(mysqli_num_rows($cons_conta) > 0){
			while ($resp_conta = mysqli_fetch_assoc($cons_conta)) {
			$id_carne = 	$resp_conta['id_carne'];
			$id_cliente = 	$resp_conta['id_cliente'];
			
			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, 'https://www.asaas.com/api/v3/installments/ins_'.$id_carne.'');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);

			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			  "Content-Type: application/json",
			  "access_token: a803439c310f0d39055beb715e51c9dfa68c10895036bd8bfb1b57c8b0a8ea1f"
			));

			$response = curl_exec($ch);
			curl_close($ch);

			//var_dump($response);
			
			$obj = json_decode($response);
			$ignicao = $obj->{'ignition'};
			$valor_parcela = $obj->{'paymentValue'};
			$parcelas = $obj->{'installmentCount'};
			$dateCreated = $obj->{'dateCreated'};
			$customer = $obj->{'customer'};
			$valor_total = $obj->{'value'};
			
			$dias_final = $parcelas * 30;
			$final = date('Y-m-d', strtotime('+'.$parcelas.' months', strtotime($dateCreated)));

			$sql = mysqli_query($conn, "INSERT IGNORE INTO carnes (id_carne, id_cliente, id_empresa, parcelas, valor_parcela, valor_total, data_criacao, data_termino) VALUES ('$id_carne', '$id_cliente', '1361', '$parcelas', '$valor_parcela', '$valor_total', '$dateCreated', '$final')");
		}}



























/*

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://www.asaas.com/api/v3/installments?offset='.$offset.'&limit=100');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  "access_token: a803439c310f0d39055beb715e51c9dfa68c10895036bd8bfb1b57c8b0a8ea1f"
));

$response = curl_exec($ch);
curl_close($ch);

var_dump($response);

echo '<br><br><br>';

$json = json_decode($response);

foreach($json->data as $registro):
	$id_carne = $registro->id;
	$valor_parcela = $registro->paymentValue;
	$parcelas = $registro->installmentCount;
	$dateCreated = $registro->dateCreated;
	$customer = $registro->customer;
	$valor_total = $registro->value;
	$deleted = $registro->deleted;
	
	if (is_bool($deleted)) $deleted ? $deleted = "true" : $deleted = "false";
	else if ($deleted !== null) $deleted = (string)$deleted;
	
	if($deleted == 'false'){
		$deleted1 = 'FALSO';
	}
	if($deleted == 'true'){
		$deleted1 = 'VERDADEIRO';
	}
	
	$id_carne1 = explode("_", $id_carne);
	$id_carne = $id_carne1[1];
	
	$dias_final = $parcelas * 30;
	$final = date('Y-m-d', strtotime('+'.$parcelas.' months', strtotime($dateCreated)));
	
	$cons_cliente = mysqli_query($conn,"SELECT * FROM clientes WHERE id_asaas='$customer'");
		if(mysqli_num_rows($cons_cliente) > 0){
			while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
			$nome_cliente = 	$resp_cliente['nome_cliente'];
			$id_cliente = 	$resp_cliente['id_cliente'];			
		}}
		
	//$sql = mysqli_query($conn, "INSERT IGNORE INTO carnes (id_carne, id_cliente, id_empresa, parcelas, valor_parcela, valor_total, data_criacao, data_termino, deleted) VALUES ('$id_carne', '$id_cliente', '1361', '$parcelas', '$valor_parcela', '$valor_total', '$dateCreated', '$final', '$deleted1')");
		


endforeach;
*/
?>