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

if($subdominio == ''){
	header('location: http://rastreiamaisbrasil.com.br');
} else {
	header('location: http://'.$subdominio.'.rastreiamaisbrasil.com.br');
}
	

?>