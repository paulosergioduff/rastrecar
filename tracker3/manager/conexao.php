<?php error_reporting(0);
session_start(); 
$servidor = "localhost";
$usuario = "root";
$senha = "Murilo19781984";
$dbname = "traccar";

//Criar a conexao
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
$con = mysqli_connect($servidor, $usuario, $senha, $dbname);



$nivel = $_SESSION['usuarioNivel'];
$cargo = $_SESSION['usuarioCargo'];
$user_nome = $_SESSION['usuarioNome'];	
$user_id = $_SESSION['usuarioId'];	
$login_padrao = 'RBM RASTREAMENTO';	


//-------------------

if (!isset($_SESSION['usuarioId']) OR !isset($_SESSION['usuarioNome'])) {
// Não há usuário logado, manda pra página de login

header("Location: /tracker/index.php");
}
?>
