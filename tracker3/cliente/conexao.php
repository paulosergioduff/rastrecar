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
$cargo = $_SESSION['usuarioCargo'];
$user_nome = $_SESSION['usuarioNome'];	
$user_id = $_SESSION['usuarioId'];	
$login_padrao = $_SESSION['login_padrao'];	

//-------------------

if (!isset($_SESSION['usuarioId']) OR !isset($_SESSION['usuarioNome'])) {
// Não há usuário logado, manda pra página de login

header("Location: ../../");
}
?>
