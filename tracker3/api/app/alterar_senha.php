<?php
session_start(); 
        //Incluindo a conexão com banco de dados   
    include_once("config.php");    
	$id_cliente =  $_GET['id'];
	$senha = $_GET['senha'];
	$senha = md5($senha);
   
  $cons_user = mysqli_query($conn,"SELECT * FROM usuarios WHERE id_cliente='$id_cliente' ORDER BY id_usuarios DESC LIMIT 1 ");
	if(mysqli_num_rows($cons_user) > 0){
while ($resp_user = mysqli_fetch_assoc($cons_user)) {
$nome = 	$resp_user['nome'];

$sql = mysqli_query($conn, "UPDATE usuarios SET senha='$senha' WHERE id_cliente='$id_cliente'");
echo 'OK';

	}} else {
		echo '0';
	}
   
   
?>

