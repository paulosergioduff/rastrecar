<?php
session_start(); 
        //Incluindo a conex�o com banco de dados   
    include_once("config.php");   
	$date_hoje = date('Y-m-d H:i');	
	$date_2 = date('Y-m');	
$ip = $_SERVER['REMOTE_ADDR'];
    //O campo usu�rio e senha preenchido entra no if para validar
    if((isset($_POST['usuario'])) && (isset($_POST['senha']))){
        $usuario = mysqli_real_escape_string($conn, $_POST['usuario']); //Escapar de caracteres especiais, como aspas, prevenindo SQL injection
        $senha = mysqli_real_escape_string($conn, $_POST['senha']);
        $senha = md5($senha);
		$usuario_l = ''.$usuario.'@rmb';
            
        //Buscar na tabela usuario o usu�rio que corresponde com os dados digitado no formul�rio
        $result_usuario = "SELECT * FROM usuarios WHERE usuario = '$usuario_l' && senha = '$senha' LIMIT 1";
        $resultado_usuario = mysqli_query($conn, $result_usuario);
        $resultado = mysqli_fetch_assoc($resultado_usuario);
        
        //Encontrado um usuario na tabela usu�rio com os mesmos dados digitado no formul�rio
		// Niveis:
		// 1 - ADM
		// 2 - CLIENTE
		// 3 - TECNICO
		// 4 - VENDEDOR
		// 5 - OPERADOR
        if(isset($resultado)){
            $_SESSION['usuarioId'] = $resultado['id_usuarios'];
            $_SESSION['usuarioNome'] = $resultado['nome'];
            $_SESSION['usuarioNivel'] = $resultado['nivel'];
            $_SESSION['usuarioEmail'] = $resultado['email'];
			$_SESSION['usuarioSenha'] = $resultado['senha'];
			$_SESSION['usuarioCargo'] = $resultado['cargo'];
			$usuario_login = $resultado['id_usuarios'];
			
	
           if($_SESSION['usuarioNivel'] == "1" && $_SESSION['usuarioSenha'] != '202cb962ac59075b964b07152d234b70'){
				$update_log = mysqli_query($conn, "UPDATE usuarios SET logado='SIM', ultimo_login='$date_hoje', ip='$ip' WHERE id_usuarios='$usuario_login'");
                header("Location: /tracker3/manager/index.php");
            }elseif($_SESSION['usuarioNivel'] == "2" && $_SESSION['usuarioSenha'] != '202cb962ac59075b964b07152d234b70'){
				$update_log = mysqli_query($conn, "UPDATE usuarios SET logado='SIM', ultimo_login='$date_hoje', ip='$ip' WHERE id_usuarios='$usuario_login'");
                header("Location: /tracker3/cliente/index.php?p=index");
            }elseif($_SESSION['usuarioNivel'] == "3"){
			header("Location: index.php?p=error");
            }elseif($_SESSION['usuarioNivel'] == "4"){
             $update_log = mysqli_query($conn, "UPDATE usuarios SET logado='SIM', ultimo_login='$date_hoje', ip='$ip' WHERE id_usuarios='$usuario_login'");
                header("Location: /tracker3/vendas/index.php?p=index&m=$date_2");
            }elseif($_SESSION['usuarioNivel'] == "5"){
             $update_log = mysqli_query($conn, "UPDATE usuarios SET logado='SIM', ultimo_login='$date_hoje', ip='$ip' WHERE id_usuarios='$usuario_login'");
                header("Location: /tracker3/operador/index.php?p=index");
            }		
			
			
        //N�o foi encontrado um usuario na tabela usu�rio com os mesmos dados digitado no formul�rio
        //redireciona o usuario para a p�gina de login
        }else{    
            //V�riavel global recebendo a mensagem de erro
            $_SESSION['loginErro'] = "Usu�rio ou senha Inv�lido";
            header("Location: index.php?error=login");
        }
    //O campo usu�rio e senha n�o preenchido entra no else e redireciona o usu�rio para a p�gina de login
    }else{
        $_SESSION['loginErro'] = "Usu�rio ou senha inv�lido";
        header("Location: index.php?p=error");
    }
?>
