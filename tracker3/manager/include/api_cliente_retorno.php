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
$assinatura_asaas = $_REQUEST['assinatura_asaas'];
$dia_vencimento = $_REQUEST['dia_vencimento'];


$sql = mysqli_query($conn, "UPDATE recorrencia SET id_assinatura = '$assinatura_asaas' WHERE id_recorrencia='$id_recorrencia'");



?>

					