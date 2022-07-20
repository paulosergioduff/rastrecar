<?php
session_start(); 
        //Incluindo a conexão com banco de dados   
    include_once("config.php");    
	
	$codigo_sms = $_GET['codigo'];
   
  $cons_user = mysqli_query($conn,"SELECT * FROM usuarios WHERE codigos_sms='$codigo_sms' ");
	if(mysqli_num_rows($cons_user) > 0){
while ($resp_user = mysqli_fetch_assoc($cons_user)) {
$codigos_sms = 	$resp_user['codigos_sms'];
$id_cliente = $resp_user['id_cliente'];

if($codigo_sms == $codigos_sms){
	echo $id_cliente;
} else {
	echo '0';
}
	}} else {
		echo '0';
	}
   
   
?>

