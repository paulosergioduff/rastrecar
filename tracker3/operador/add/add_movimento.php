  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('conexao.php');

$data_mov = 	$_POST['data_mov'];
$id_empresa = 	$_POST['id_empresa'];
$data = date('Y-m-d');
$user_mov = 	$_POST['user_mov'];
$forma_pagamento = 	$_POST['forma_pagamento'];
$nsu = 	$_POST['nsu'];
$tipo = 	$_POST['tipo'];
$descricao = 	$_POST['descricao'];
$classificacao	 = 	$_POST['classificacao'];
$valor_mov = 	$_POST['valor_mov'];
$valor_mov = str_replace(".","","$valor_mov");
$valor_mov = str_replace(",",".","$valor_mov");

$duplicata = date('mdHis');

$sql_caixa = mysqli_query($conn,"SELECT * FROM caixa WHERE status = 'ABERTO' ORDER BY id_caixa DESC LIMIT 1");

if(mysqli_num_rows($sql_caixa) > 0){
	while ($resp_caixa = mysqli_fetch_assoc($sql_caixa)) {
	$id_caixa = 	$resp_caixa['id_caixa'];
}}


$sql = mysqli_query($conn, "INSERT INTO movimento_caixa (id_caixa, data, data_mov, tipo, classificacao,  descricao, valor_mov, forma_pagamento, user_mov, nsu, id_empresa) VALUES ('$id_caixa', '$data', '$data_mov', '$tipo', '$classificacao',  '$descricao', '$valor_mov', '$forma_pagamento', '$user_mov', '$nsu', '$id_empresa')");


if($tipo == 'SAIDA'){
	$sql2 = mysqli_query($conn, "INSERT INTO contas_pagar (id_conta, duplicata, data_emissao, data_vencimento,  descricao, valor_bruto, nr_banco, observacoes, banco, especie, class_financeira, status, qtd_parcelas, data_pagamento, id_empresa) VALUES ('0', '$duplicata', '$data', '$data',  '$descricao', '$valor_mov', '$duplicata', '$observacoes', '7', '1', '$classificacao', 'Pago', '1', '$data', '$id_empresa')");
}




header('Location: ../movimentos_caixa.php');


?>
