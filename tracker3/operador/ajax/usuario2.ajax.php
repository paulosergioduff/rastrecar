<?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include("../conexao.php"); // Inclui o arquivo com o sistema de segurança

$usuario = $_REQUEST['usuario'];
$id_user = $_REQUEST['id_usuarios'];
$customer_name = $_REQUEST['customer_name'];
$usuario = ''.$usuario.'@'.$customer_name;

if($usuario == '@'.$customer_name){
	echo '400';
}

if($usuario != '@'.$customer_name){
	
	$cons_users = mysqli_query($conn,"SELECT * FROM usuarios WHERE usuario = '$usuario'");
	if(mysqli_num_rows($cons_users) <= 0){
		echo '0';
	}
	if(mysqli_num_rows($cons_users) > 0){
		while ($resp_users = mysqli_fetch_assoc($cons_users)) {
		$id_user2 = 	$resp_users['id_usuarios'];
		
		if($id_user2 == $id_user){
			echo '0';
		}
		if($id_user2 != $id_user){
			echo '1';
		}
	
	}}
	
	

	
}





?>
	
	