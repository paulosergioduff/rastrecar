<?php
session_start();
	
	unset(
		$_SESSION['usuarioId'],
		$_SESSION['usuarioNome'],
		$_SESSION['usuarioNiveisAcessoId'],
		$_SESSION['usuarioEmail'],
		$_SESSION['usuarioSenha']
	);

$subdominio = $_GET['c'];
	
header('location: http://'.$subdominio.'.rastreiamaisbrasil.com.br'); // vai para a pagina login.html
?>