<?php
session_start(); 
$servidor = "localhost";
$usuario = "root";
$senha = "TR4vcijU6T9Keaw";
$dbname = "traccar";

//Criar a conexao
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
$con = mysqli_connect($servidor, $usuario, $senha, $dbname);



$nivel = $_SESSION['usuarioNivel'];
$user_nome = $_SESSION['usuarioNome'];	
$user_id = $_SESSION['usuarioId'];	



?>
