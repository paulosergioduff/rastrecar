  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('conexao.php');

$date = date('Y-m-d');
$hora = date('H:i:s');
$user = $_POST['user_nome'];

$id_conta	 = 	$_POST['id_conta'];
$data_pagamento = 	$_POST['data_pagamento'];
$valor_pago = 	$_POST['valor_pago'];
$valor_pago = str_replace(".","","$valor_pago");
$valor_pago = str_replace(",",".","$valor_pago");
$obs_baixa	 = 	$_POST['obs_baixa'];
$banco	 = 	$_POST['banco'];
$status = $_POST['status'];
$user_baixa = $_POST['user_baixa'];


$cons_contas = mysqli_query($conn,"SELECT * FROM contas_pagar WHERE id_conta='$id_conta'");
	if(mysqli_num_rows($cons_contas) > 0){
while ($resp_contas = mysqli_fetch_array($cons_contas)) {
	$descricao = $resp_contas['descricao'];
	$especie = $resp_contas['especie'];
	$duplicata = $resp_contas['duplicata'];
	$class_financeira = $resp_contas['class_financeira'];
	$especie = $resp_contas['especie'];
	$id_os = $resp_contas['id_os'];
	
}}


$sql11 = mysqli_query($conn,"UPDATE contas_pagar SET data_pagamento='$data_pagamento', valor_pago='$valor_pago', obs_baixa='$obs_baixa', banco='$banco', status='$status', user_baixa='$user_baixa' WHERE id_conta='$id_conta'");


if($id_os != '0'){
	$cons_assist = mysqli_query($conn,"SELECT * FROM ordem_servico WHERE id_os IN ($id_os)");
		if(mysqli_num_rows($cons_assist) > 0){
			while ($resp_assist = mysqli_fetch_assoc($cons_assist)) {
				$id_os2 = $resp_assist['id_os'];
				$sql = mysqli_query($conn, "UPDATE ordem_servico SET status_pgto_tecnico='Pago', data_pagto_tecnico='$date', nfse='$duplicata' WHERE id_os='$id_os2'");
		}}
}



$base64 = 'id_conta:'.$id_conta;
$base64 = base64_encode($base64);

header('Location: view_conta_pagar.php?c='.$base64.'');





?>
