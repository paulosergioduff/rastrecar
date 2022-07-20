<?php
	include_once("conexao.php"); 
	
	$id_usuarios = $_GET['id'];
	
	
	$cons_cliente = mysqli_query($conn,"SELECT * FROM usuarios WHERE id_usuarios='$id_usuarios'");
	if(mysqli_num_rows($cons_cliente) > 0){
while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
$usuario = 	$resp_cliente['usuario'];
	}}
	
	echo $usuario;
	 $update_log = mysqli_query($conn, "UPDATE usuarios SET logado='NAO' WHERE id_usuarios='$id_usuarios'");

	
header("location: logoff.php");
?>