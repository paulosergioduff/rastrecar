<?php

include_once("../conexao.php");
$data_login = date("Y-m-d H:i");

$tipo = $_GET['tipo'];
$base64 = $_GET['c'];
$base = base64_decode($base64);
$cliente = explode(":", $base);
$id_cliente = $cliente[1];



$cons_cliente = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
	if(mysqli_num_rows($cons_cliente) > 0){
while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
$id_empresa = 	$resp_cliente['id_empresa'];
$id_asaas = 	$resp_cliente['id_asaas'];
$doc_cliente = 	$resp_cliente['doc_cliente'];
$doc_cliente = preg_replace("/[^0-9]/", "", $doc_cliente);
	}}

echo $id_asaas;


if($id_asaas != '0'){
	if($tipo == 'carne'){
		header('Location: ../gerar_carne_asaas.php?c='.$base64.'');
	}
	if($tipo == 'recorrencia'){
		header('Location: ../gerar_recorrencia_asaas.php?c='.$base64.'');
	}
	if($tipo == 'boleto'){
		header('Location: ../gerar_boleto_asaas.php?c='.$base64.'');
	}
	if($tipo == 'cartao'){
		header('Location: ../gerar_recorrencia_asaas_card.php?c='.$base64.'');
	}
} else {
	$cons_nivel = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='$id_empresa'");
	if(mysqli_num_rows($cons_nivel) > 0){
	while ($resp_nivel = mysqli_fetch_assoc($cons_nivel)) {
		$asaas_key = 	$resp_nivel['asaas_key'];
	}}	
	
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, 'https://www.asaas.com/api/v3/customers?cpfCnpj='.$doc_cliente.'');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_HEADER, FALSE);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	  "access_token: $asaas_key"
	));

	$response = curl_exec($ch);
	curl_close($ch);

	var_dump($response);
		
	$obj = json_decode($response);
	$totalCount = $obj->{'totalCount'};
	$id_asaas = $obj->{'id'};
	
	if($totalCount <= '0'){
		header('Location: add_asaas.php?id_cliente='.$id_cliente.'&tipo='.$tipo.'');
	}
	if($totalCount == '1'){
	
		$json = json_decode($response);
		foreach($json->data as $registro):
		$customer = $registro->id;
		
		$sql_customer = mysqli_query($conn, "UPDATE clientes SET id_asaas='$customer' WHERE id_cliente='$id_cliente'");
		endforeach;
		
		if($tipo == 'carne'){
			header('Location: ../gerar_carne_asaas.php?c='.$base64.'');
		}
		if($tipo == 'recorrencia'){
			header('Location: ../gerar_recorrencia_asaas.php?c='.$base64.'');
		}
		if($tipo == 'boleto'){
			header('Location: ../gerar_boleto_asaas.php?c='.$base64.'');
		}
		if($tipo == 'cartao'){
		header('Location: ../gerar_recorrencia_asaas_card.php?c='.$base64.'');
	}
	}
	
	if($totalCount >= '2'){

		$json = json_decode($response);
		foreach($json->data as $registro):
		$customer = $registro->id;
		
		endforeach;
		
		$customer1 = $customer;
		
		$sql_customer = mysqli_query($conn, "UPDATE clientes SET id_asaas='$customer1' WHERE id_cliente='$id_cliente'");
		
		if($tipo == 'carne'){
			header('Location: ../gerar_carne_asaas.php?c='.$base64.'');
		}
		if($tipo == 'recorrencia'){
			header('Location: ../gerar_recorrencia_asaas.php?c='.$base64.'');
		}
		if($tipo == 'boleto'){
			header('Location: ../gerar_boleto_asaas.php?c='.$base64.'');
		}
		if($tipo == 'cartao'){
		header('Location: ../gerar_recorrencia_asaas_card.php?c='.$base64.'');
	}
	}
	
}

	

	
	





	?>