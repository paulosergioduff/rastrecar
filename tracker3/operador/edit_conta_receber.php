<?php


include_once("conexao.php");
$data_login = date("Y-m-d H:i");

$date = date('Y-m-d');
$data_agora = date('Y-m-d H:i');

$data_vencimento = $_REQUEST['data_vencimento'];
$data_vencimento1 = date('d/m/Y', strtotime("$data_vencimento"));
$valor_bruto1 = 	$_REQUEST['valor_bruto'];
$valor_bruto = str_replace(".","","$valor_bruto1");
$valor_bruto = str_replace(",",".","$valor_bruto");
$id_conta = $_REQUEST['id_conta'];
$observacoes = $_REQUEST['observacoes'];


$sql_contas = mysqli_query($conn, "UPDATE contas_receber SET data_vencimento='$data_vencimento', valor_bruto='$valor_bruto', observacoes='$observacoes' WHERE id_conta='$id_conta'");


$base64 = 'id_conta:'.$id_conta;
$base64 = base64_encode($base64);
	
header('Location: view_conta_receber.php?c='.$base64.'');




	?>