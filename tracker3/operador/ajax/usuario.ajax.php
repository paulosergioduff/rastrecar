<?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include("../conexao.php"); // Inclui o arquivo com o sistema de segurança

$usuario = $_REQUEST['usuario'];
$customer_name = $_REQUEST['customer_name'];
$usuario = ''.$usuario.'@rmb';
if($usuario == '@rmb'){
	echo '400';
}

if($usuario != '@rmb'){
$sql = mysqli_query($conn,"SELECT * FROM usuarios WHERE usuario = '$usuario' ORDER BY id_usuarios DESC LIMIT 1");

if(mysqli_num_rows($sql) <= 0){
echo '0';
}else{
	while($x = mysqli_fetch_assoc($sql)){
	
	echo '1';
	}
}	
}





?>
	
	