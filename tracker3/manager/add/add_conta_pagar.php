  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('../conexao.php');

$date = date('Y-m-d');
$hora = date('H:i:s');
$user = $_POST['user_nome'];

$duplicata	 = 	$_POST['duplicata'];
$data_emissao = 	$_POST['data_emissao'];
$data_vencimento = 	$_POST['data_vencimento'];
$descricao = 	$_POST['descricao'];
$valor_bruto = 	$_POST['valor_bruto'];
$valor_bruto = str_replace(".","","$valor_bruto");
$valor_bruto = str_replace(",",".","$valor_bruto");
$observacoes	 = 	$_POST['observacoes'];
$banco	 = 	$_POST['banco'];
$especie	 = 	$_POST['especie'];
$class_financeira = 	$_POST['class_financeira'];
$status = $_POST['status_c'];
$qtd_parcelas = $_POST['qtd_parcelas'];

$user_baixa1 = $_POST['user_baixa'];
$recorrencia = 	$_POST['recorrencia'];
$id_empresa = 	$_POST['id_empresa'];

if($status == 'SIM'){
	$status_conta = 'Pago';
	$valor_pago = $valor_bruto;
	$data_pagamento = $data_vencimento;
	$user_baixa = $user_baixa1;
}
if($status != 'SIM'){
	$status_conta = 'Em Aberto';
	$valor_pago = '0.00';
	$data_pagamento = '0';
	$user_baixa = '';
}

if($recorrencia == ''){
	$sql_recorrencia = '';
} else {
	$sql_recorrencia = mysqli_query($conn, "INSERT INTO recorrencia_pagar (duplicata, descricao, valor_bruto, observacoes, banco, especie, class_financeira, ultima_conta, dia_vencimento) VALUES ('$duplicata', '$descricao', '$valor_bruto', '$observacoes', '$banco', '$especie', '$class_financeira', '$date', '$dia_vencimento')");
}


for($x = 0; $x < $qtd_parcelas; $x++){
	$dt_parcelas[] = date('Y-m-d', strtotime('+'.$x.' month', strtotime($data_vencimento)));
	
}


foreach($dt_parcelas as $indice => $datas){
	$indice1 = $indice+1;
	$nr_parcela = ''.$indice1.' de '.$qtd_parcelas.'';

$sql11 = "INSERT INTO contas_pagar (duplicata, data_emissao, data_vencimento,  descricao, valor_bruto, observacoes, banco, especie, class_financeira, status, qtd_parcelas, id_empresa, nr_parcela, valor_pago, data_pagamento, user_baixa) VALUES ('$duplicata', '$data_emissao', '$datas',  '$descricao', '$valor_bruto', '$observacoes', '$banco', '$especie', '$class_financeira', '$status_conta', '$qtd_parcelas', '$id_empresa', '$nr_parcela', '$valor_pago', '$data_pagamento', '$user_baixa')";

if (mysqli_query($conn, $sql11)) {
      echo "New record created successfully";
} else {
      echo "Error OS: " . $sql11 . "<br>" . mysqli_error($conn);
}
}


header('Location: ../contas_pagar.php');














/*
$contador = 0;
while($contador < $qtd_parcelas){
	

$prox_venc = date('Y-m-d', strtotime('+30 days', strtotime($vencimento)));

echo $descricao.' - Data Vencimento:'.$prox_venc.'<br>';


$contador++;
}
*/

//$sql11 = "INSERT INTO contas_pagar (id_conta, duplicata, data_emissao, data_vencimento,  descricao, valor_bruto, nr_banco, observacoes, banco, especie, class_financeira, status, qtd_parcelas) VALUES ('0', '$duplicata', '$data_emissao', '$datas',  '$descricao', '$valor_bruto', '$nr_banco', '$observacoes', '$banco', '$especie', '$class_financeira', '$status', '$qtd_parcelas')";




?>
