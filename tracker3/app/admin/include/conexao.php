<?php
session_start(); 
$servidor = "localhost";
$usuario = "root";
$senha = "M196619m210300";
$dbname = "traccar";

//Criar a conexao
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
$con = mysqli_connect($servidor, $usuario, $senha, $dbname);



$nivel = $_SESSION['usuarioNivel'];
$cargo = $_SESSION['usuarioCargo'];
$user_nome = $_SESSION['usuarioNome'];	
$user_id = $_SESSION['usuarioId'];	
$login_padrao = $_SESSION['login_padrao'];	


?>
