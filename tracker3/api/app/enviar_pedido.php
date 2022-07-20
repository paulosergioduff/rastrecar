<?php
session_start(); 
        //Incluindo a conexão com banco de dados   
    include_once("config.php");    
	$nome_cliente = 	$_POST['nome_cliente'];
$doc_cliente = 	$_POST['doc_cliente'];
$rg_cliente	 = 	$_POST['rg_cliente'];
$data_nascimento = 	$_POST['data_nascimento'];
$cep = 	$_POST['cep'];
$endereco = 	$_POST['endereco'];
$numero = 	$_POST['numero'];
$complemento = 	$_POST['complemento'];
$bairro = 	$_POST['bairro'];
$cidade = 	$_POST['cidade'];
$estado = 	$_POST['estado'];
$telefone_celular = 	$_POST['telefone_celular'];
$data_cadastro = 	date("Y-m-d H:i");
$email = 	$_POST['email'];
$status = 	'11';
$pacote = 	$_POST['pacote'];
$placa_veiculo = 	$_POST['placa_veiculo'];
$renavam = 	$_POST['renavam'];
$forma_pagamento = 	$_POST['forma_pagamento'];
$pgto_instalacao = 	$_POST['pgto_instalacao'];
$vendedor = 	$_POST['vendedor'];
$observacoes = 	$_POST['observacoes'];
   
  $sql = mysqli_query($conn,"INSERT INTO pedidos (nome_cliente, doc_cliente, rg_cliente, data_nascimento, cep, endereco, numero, complemento, bairro, cidade, estado, telefone_celular, data_cadastro, email, status, pacote, placa_veiculo, renavam, forma_pagamento, pgto_instalacao, vendedor, observacoes) VALUES ('$nome_cliente', '$doc_cliente', '$rg_cliente',  '$data_nascimento', '$cep', '$endereco', '$numero', '$complemento', '$bairro', '$cidade', '$estado', '$telefone_celular', '$data_cadastro', '$email', '$status', '$pacote', '$placa_veiculo', '$renavam', '$forma_pagamento', '$pgto_instalacao', '$vendedor', '$observacoes')") or die (mysqli_error());
   
   
?>

