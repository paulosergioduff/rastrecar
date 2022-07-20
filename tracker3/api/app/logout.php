<?php
session_start(); 
        //Incluindo a conexão com banco de dados   
    include_once("config.php");    
	$id_push = $_GET['id_push'];
   
   $update_push = mysqli_query($conn, "UPDATE usuarios_push SET logado='NAO' WHERE id_push='$id_push'");
   
   echo '200';
?>

