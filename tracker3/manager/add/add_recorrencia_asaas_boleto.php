  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('../conexao.php');

$data_agora = date('Y-m-d');
$data_criacao = date('Y-m-d H:i');
$banco = 	$_POST['banco'];
$data_vencimento = 	$_POST['data_vencimento'];
$dia_vencimento = date('d', strtotime("$data_vencimento"));

$termino_recorrencia = 	$_POST['termino_recorrencia'];
$data_termino = date('Y-m-d', strtotime('+'.$termino_recorrencia.' month', strtotime($data_vencimento)));

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
$id_empresa = '1361';
$tipo = 	$_POST['tipo'];

$forma_pagamento = 'Boleto Bancario';

$banco_credito = '0';
$agencia_credito = '0';
$conta_credito = '0';

$dados_empresa = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa = '$id_empresa'");
	if(mysqli_num_rows($dados_empresa) > 0){
while ($resp_dados = mysqli_fetch_assoc($dados_empresa)) {
$credencial = 	$resp_dados['credencial'];
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
	
$itens_fatura = implode('\n', $itens_fatura);
$itens_fatura = $descricao.'\n\n'.$itens_fatura.'\n';


$sql_recorrencia = mysqli_query($conn, "INSERT INTO recorrencia (data_criacao, id_cliente, banco, forma_pagamento, primeiro_vencimento, valor, multa, juros, descricao, dias_cobranca, dia_vencimento, id_empresa, banco_credito, agencia_credito, conta_credito, data_termino, tipo) VALUES ('$data_criacao', '$id_cliente', '$banco', '$forma_pagamento', '$data_vencimento', '$valor', '$multa', '$juros', '$descricao', '$dias_cobranca', '$dia_vencimento', '$id_empresa', '$banco_credito', '$agencia_credito', '$conta_credito', '$data_termino', '$tipo')");


$cons_recorr = mysqli_query($conn,"SELECT * FROM recorrencia WHERE id_cliente = '$id_cliente' ORDER BY id_recorrencia DESC LIMIT 1");
	if(mysqli_num_rows($cons_recorr) > 0){
while ($resp_recor = mysqli_fetch_assoc($cons_recorr)) {
$id_recorrencia = 	$resp_recor['id_recorrencia'];
	}}

$up_veic = mysqli_query($conn, "UPDATE veiculos_clientes SET recorrencia='SIM', id_recorrencia='$id_recorrencia' WHERE id_veiculo IN ($id_veiculo)");






$base64 = 'id_cliente:'.$id_cliente.'';
$base64 = base64_encode($base64);









header('Location: ../gerar_recorrencia_asaas.php?c='.$base64.'&status=1');

























?>
