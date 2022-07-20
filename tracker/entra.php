<?php
session_start(); 
        //Incluindo a conexão com banco de dados   
    include_once("config.php");   
	$date_hoje = date('Y-m-d H:i');	
	$date_2 = date('Y-m');	
$ip = $_SERVER['REMOTE_ADDR'];
    //O campo usuário e senha preenchido entra no if para validar
    if((isset($_POST['usuario'])) && (isset($_POST['senha']))){
        $usuario = mysqli_real_escape_string($conn, $_POST['usuario']); //Escapar de caracteres especiais, como aspas, prevenindo SQL injection
        $senha = mysqli_real_escape_string($conn, $_POST['senha']);
        $senha = md5($senha);
		$usuario_l = ''.$usuario.'@rmb';
            
        //Buscar na tabela usuario o usuário que corresponde com os dados digitado no formulário
        $result_usuario = "SELECT * FROM usuarios WHERE usuario = '$usuario_l' && senha = '$senha' LIMIT 1";
        $resultado_usuario = mysqli_query($conn, $result_usuario);
        $resultado = mysqli_fetch_assoc($resultado_usuario);
        
        //Encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
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
			
			
        //Não foi encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
        //redireciona o usuario para a página de login
        }else{    
            //Váriavel global recebendo a mensagem de erro
            $_SESSION['loginErro'] = "Usuário ou senha Inválido";
            header("Location: index.php?error=login");
        }
    //O campo usuário e senha não preenchido entra no else e redireciona o usuário para a página de login
    }else{
        $_SESSION['loginErro'] = "Usuário ou senha inválido";
        header("Location: index.php?p=error");
    }
?>
