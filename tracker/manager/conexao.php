<?php
session_start(); 
$servidor = "localhost";
$usuario = "root";
$senha = "TR4vcijU6T9Keaw";
$dbname = "traccardb";

//Criar a conexao
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
$con = mysqli_connect($servidor, $usuario, $senha, $dbname);



$nivel = $_SESSION['usuarioNivel'];
$cargo = $_SESSION['usuarioCargo'];
$user_nome = $_SESSION['usuarioNome'];	


//-------------------

?>
