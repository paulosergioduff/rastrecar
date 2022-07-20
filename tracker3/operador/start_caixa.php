<?php
session_start();
include('conexao.php');

$data = date('Y-m-d');

$base64 = $_GET['c'];
$base = base64_decode($base64);
$cliente = explode(":", $base);
$id_empresa = $cliente[1];

$sql_caixa = mysqli_query($conn,"SELECT * FROM caixa WHERE data = '$data' AND id_empresa='$id_empresa' ORDER BY id_caixa DESC LIMIT 1");
if(mysqli_num_rows($sql_caixa) <= 0){
	header('Location: abrir_caixa.php?p=caixa');
}
if(mysqli_num_rows($sql_caixa) > 0){
	while ($resp_caixa = mysqli_fetch_assoc($sql_caixa)) {
	$status = 	$resp_caixa['status'];
	$id_caixa = 	$resp_caixa['id_caixa'];
}}

if($status == 'ABERTO'){
	header('Location: fechar_caixa.php?id_caixa='.$id_caixa.'&p=caixa');
}
if($status == 'FECHADO'){
	header('Location: abrir_caixa.php?id_caixa='.$id_caixa.'&p=caixa&caixa=exist');
}





?>