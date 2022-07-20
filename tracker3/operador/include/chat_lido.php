<?php
$servidor = "localhost";
$usuario = "root";
$senha = "TR4vcijU6T9Keaw";
$dbname = "traccardb";

//Criar a conexao
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
$con = mysqli_connect($servidor, $usuario, $senha, $dbname);

$telefone = $_REQUEST['telefone'];
$telefone = substr($telefone, 0, -5);
$telefone = substr($telefone, 2);
$session = $_REQUEST['session'];

echo $telefone;

$sql = mysqli_query($conn, "UPDATE envios_whats SET visualizado = '1' WHERE telefone like '%".$telefone."%' AND visualizado='0'");
?>
	