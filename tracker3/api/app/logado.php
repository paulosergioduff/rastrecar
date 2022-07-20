<?php
session_start(); 
        //Incluindo a conexão com banco de dados   
    include_once("config.php");
$data = date('Y-m-d H:i');	
	$id_push = $_GET['id_push'];
   
  $cons_user = mysqli_query($conn,"SELECT * FROM usuarios_push WHERE id_push='$id_push' ");
	if(mysqli_num_rows($cons_user) > 0){
while ($resp_user = mysqli_fetch_assoc($cons_user)) {
$logado = 	$resp_user['logado'];
$id_cliente = 	$resp_user['id_cliente'];
$tipo = 	$resp_user['tipo'];
$tipo = explode(" ", $tipo);
$modelo = $tipo[0];

if($logado == 'SIM'){
	$sql = mysqli_query($conn,"UPDATE usuarios_push SET ultimo_login = '$data' WHERE id_push='$id_push'");
	echo $id_push;
	
} else {
	echo '0';
}
	}} else {
		echo '0';
	}
   
   
?>

