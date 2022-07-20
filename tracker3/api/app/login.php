<?php
session_start(); 
        //Incluindo a conexão com banco de dados   
    include_once("config.php");    
    //O campo usuário e senha preenchido entra no if para validar

        $usuario = mysqli_real_escape_string($conn, $_GET['usuario']); //Escapar de caracteres especiais, como aspas, prevenindo SQL injection
        $senha = mysqli_real_escape_string($conn, $_GET['senha']);
		$usuario = ''.$usuario.'@rmb';
        $senha = md5($senha);
            
        $cons_user = mysqli_query($conn,"SELECT * FROM usuarios WHERE usuario='$usuario' ");
			if(mysqli_num_rows($cons_user) > 0){
		while ($resp_user = mysqli_fetch_assoc($cons_user)) {
		$senha_bd = 	$resp_user['senha'];
		$ativo = 	$resp_user['ativo'];
		
		if($ativo == 'SIM' && $senha == $senha_bd){
				echo '200';
			} else if($ativo == 'SIM' && $senha != $senha_bd){
				echo '400';
			} else if($ativo == 'NAO' && $senha == $senha_bd){
				echo '401';
			} else if($ativo == 'NAO' && $senha != $senha_bd){
				echo '401';
			} 
		
		
			}} else {
				echo '400';
			}
        
			

    
?>
