<?php

$servidor = "localhost";
$usuario1 = "root";
$senha = "TR4vcijU6T9Keaw";
$dbname = "traccardb";

//Criar a conexao
$conn = mysqli_connect($servidor, $usuario1, $senha, $dbname);
$con = mysqli_connect($servidor, $usuario1, $senha, $dbname);




$id_cliente = $_REQUEST['id_cliente'];
$id_recorrencia = $_REQUEST['id_recorrencia'];

$cons_cliente = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
	if(mysqli_num_rows($cons_cliente) > 0){
while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
$nome_cliente = 	$resp_cliente['nome_cliente'];
$doc_cliente = 	$resp_cliente['doc_cliente'];
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
$telefone_celular = preg_replace("/[^0-9]/", "", $telefone_celular);
$telefone_outros = 	$resp_cliente['telefone_outros'];
$data_cadastro = 	$resp_cliente['data_cadastro'];
$data_cadastro = date('d/m/Y', strtotime("$data_cadastro"));
$status = 	$resp_cliente['status'];
$email = 	$resp_cliente['email'];
$indicacao = 	$resp_cliente['indicacao'];
$tipo_cliente = $resp_cliente['tipo_cliente'];
$pacote_cliente = $resp_cliente['pacote'];
$forma_pagamento = $resp_cliente['forma_pagamento'];
$data_vencimento = $resp_cliente['data_vencimento'];
$vendedor = $resp_cliente['vendedor'];
$id_asaas = $resp_cliente['id_asaas'];

}}

$cons_contrato = mysqli_query($conn,"SELECT * FROM recorrencia WHERE id_recorrencia='$id_recorrencia'");
	if(mysqli_num_rows($cons_contrato) > 0){
while ($resp_contrato = mysqli_fetch_assoc($cons_contrato)) {
	$valor = 	$resp_contrato['valor'];
	$valor1 = number_format($valor, 2, ",", ".");
	}}

$cons_pacote = mysqli_query($conn,"SELECT * FROM pacotes WHERE id_pacote='$pacote'");
	if(mysqli_num_rows($cons_pacote) > 0){
while ($resp_pacote = mysqli_fetch_assoc($cons_pacote)) {
	$pacote1 = 	$resp_pacote['pacote'];
	
	}}
	

$dados = array('nome_cliente' => $nome_cliente,
				'id_asaas' => $id_asaas,
				'pacote' => $pacote1,
				'valor' => $valor,
				'valor1' => $valor,
				'email' => $email,
				'telefone_celular' => $telefone_celular,
				'cep' => $cep,
				'numero' => $numero
				);
				
echo json_encode($dados, JSON_PRETTY_PRINT);

?>

					