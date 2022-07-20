<?php
session_start(); 
        //Incluindo a conexão com banco de dados   
    include_once("config.php");    
	$id_push = $_GET['id_push'];
   
  $cons_user = mysqli_query($conn,"SELECT * FROM usuarios_push WHERE id_push='$id_push' ");
	if(mysqli_num_rows($cons_user) > 0){
while ($resp_user = mysqli_fetch_assoc($cons_user)) {
$logado = 	$resp_user['logado'];
$id_parceiro = 	$resp_user['id_parceiro'];

if($logado == 'SIM'){
	echo $id_parceiro;
} else {
	echo '0';
}
	}} else {
		echo '0';
	}
   
   
?>

