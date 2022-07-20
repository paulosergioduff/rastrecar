<?php
	include_once("conexao.php"); 
	
	$id_usuarios = $_GET['id'];
	
	
	$cons_cliente = mysqli_query($conn,"SELECT * FROM usuarios WHERE id_usuarios='$id_usuarios'");
	if(mysqli_num_rows($cons_cliente) > 0){
	while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
	$id_cliente = 	$resp_cliente['id_cliente'];
		}}
	
	$cons_cliente1 = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
	if(mysqli_num_rows($cons_cliente1) > 0){
	while ($resp_cliente = mysqli_fetch_assoc($cons_cliente1)) {
		$subdominio = 	$resp_cliente['subdominio'];
		}}



	 $update_log = mysqli_query($conn, "UPDATE usuarios SET logado='NAO' WHERE id_usuarios='$id_usuarios'");

	
header('location: logoff.php?c='.$subdominio.'');
?>