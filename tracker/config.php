<?php


$servidor = "localhost";
$usuario = "root";
$senha = "TR4vcijU6T9Keaw";
$dbname = "traccar";
    
    //Criar a conexao
    $conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
    
    if(!$conn){
        die("Falha na conexao: " . mysqli_connect_error());
    }else{
        //echo "Conexao realizada com sucesso";
    }   
	
$nivel = $_SESSION['usuarioNivel'];
$id_user = $_SESSION['usuarioId'];
$user_nome = $_SESSION['usuarioNome'];		

?>