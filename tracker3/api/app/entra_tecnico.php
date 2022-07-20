<?php
session_start(); 
        //Incluindo a conexão com banco de dados   
    include_once("config.php");    
	$id_push = $_GET['id_push'];
	$modelo = $_GET['modelo'];
	$date_hoje = date('Y-m-d H:i');
    //O campo usuário e senha preenchido entra no if para validar
    if((isset($_GET['usuario'])) && (isset($_GET['senha']))){
        $usuario = mysqli_real_escape_string($conn, $_GET['usuario']); //Escapar de caracteres especiais, como aspas, prevenindo SQL injection
        $senha = mysqli_real_escape_string($conn, $_GET['senha']);
        $senha = md5($senha);
            
        //Buscar na tabela usuario o usuário que corresponde com os dados digitado no formulário
        $result_usuario = "SELECT * FROM usuarios WHERE usuario = '$usuario' && senha = '$senha' LIMIT 1";
        $resultado_usuario = mysqli_query($conn, $result_usuario);
        $resultado = mysqli_fetch_assoc($resultado_usuario);
        
        //Encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
		// Niveis:
		// 1 - Motorista
		// 2 - Adm
        if(isset($resultado)){
            $_SESSION['usuarioId'] = $resultado['id_usuarios'];
            $_SESSION['usuarioNome'] = $resultado['nome'];
            $_SESSION['usuarioNivel'] = $resultado['nivel'];
            $_SESSION['usuarioEmail'] = $resultado['email'];
			$_SESSION['usuarioSenha'] = $resultado['senha'];
			$_SESSION['usuarioCargo'] = $resultado['cargo'];
			$_SESSION['id_cliente'] = $resultado['id_cliente'];
			$id_usuarios = $resultado['id_usuarios'];
			$id_parceiro = $resultado['id_parceiro'];
			
	
           if($_SESSION['usuarioNivel'] == "1" && $_SESSION['usuarioSenha'] != '202cb962ac59075b964b07152d234b70'){
			   $gravar_push = mysqli_query($conn, "INSERT IGNORE INTO usuarios_push (id, id_cliente, id_push, logado) VALUES ('0', '$id_cliente', '$id_push', 'SIM')");
			   $update_push = mysqli_query($conn, "UPDATE usuarios_push SET logado='SIM', modelo='$modelo', ultimo_login='$date_hoje' WHERE id_push='$id_push'");
			   
			   

				$fields = array( 
				'app_id' => '3abaea79-1774-4b00-b465-7ec421533144', 
				'external_user_id' => $id_cliente
				); 
				$fields = json_encode($fields); 

				$ch = curl_init(); 
				curl_setopt($ch, CURLOPT_URL, 'https://onesignal.com/api/v1/players/'.$id_push); 
				curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
				curl_setopt($ch, CURLOPT_HEADER, false); 
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
				curl_setopt($ch, CURLOPT_POSTFIELDS, $fields); 
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
				$response = curl_exec($ch); 
				curl_close($ch); 

				$resultData = json_decode($response, true);
				
			   
			   
			   
			   
			   
			   
			   
			   
                header('Location: ../app/master/index.php?id='.$id_usuarios.'');
            }elseif($_SESSION['usuarioNivel'] == "2" && $_SESSION['usuarioSenha'] != '202cb962ac59075b964b07152d234b70'){
                header('Location: ../app/index.php?id='.$resultado['id_cliente'].'');
				$gravar_push = mysqli_query($conn, "INSERT IGNORE INTO usuarios_push (id, id_cliente, id_push, logado) VALUES ('0', '$id_cliente', '$id_push', 'SIM')");
			   $update_push = mysqli_query($conn, "UPDATE usuarios_push SET logado='SIM', modelo='$modelo', ultimo_login='$date_hoje' WHERE id_push='$id_push'");
			   
			   

				$fields = array( 
				'app_id' => '3abaea79-1774-4b00-b465-7ec421533144', 
				'external_user_id' => $id_cliente
				); 
				$fields = json_encode($fields); 

				$ch = curl_init(); 
				curl_setopt($ch, CURLOPT_URL, 'https://onesignal.com/api/v1/players/'.$id_push); 
				curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
				curl_setopt($ch, CURLOPT_HEADER, false); 
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
				curl_setopt($ch, CURLOPT_POSTFIELDS, $fields); 
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
				$response = curl_exec($ch); 
				curl_close($ch); 

				$resultData = json_decode($response, true);
            }elseif($_SESSION['usuarioNivel'] == "3"){
            header('Location: ../app2/tecnico/index.php?id='.$id_parceiro.'');
			
			$gravar_push = mysqli_query($conn, "INSERT IGNORE INTO usuarios_push (id_cliente, id_parceiro, id_push, logado) VALUES ('0', '$id_parceiro', '$id_push', 'SIM')");
			   $update_push = mysqli_query($conn, "UPDATE usuarios_push SET logado='SIM', modelo='$modelo', ultimo_login='$date_hoje' WHERE id_push='$id_push'");
			   
			   

				$fields = array( 
				'app_id' => '3abaea79-1774-4b00-b465-7ec421533144', 
				'external_user_id' => $id_parceiro
				); 
				$fields = json_encode($fields); 

				$ch = curl_init(); 
				curl_setopt($ch, CURLOPT_URL, 'https://onesignal.com/api/v1/players/'.$id_push); 
				curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
				curl_setopt($ch, CURLOPT_HEADER, false); 
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
				curl_setopt($ch, CURLOPT_POSTFIELDS, $fields); 
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
				$response = curl_exec($ch); 
				curl_close($ch); 

				$resultData = json_decode($response, true);
			
            }elseif($_SESSION['usuarioNivel'] == "4"){
             echo "erro2
					";
            }		
			
			
        //Não foi encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
        //redireciona o usuario para a página de login
        }else{    
            //Váriavel global recebendo a mensagem de erro
            $_SESSION['loginErro'] = "Usuário ou senha Inválido";
            header("Location: index.php?res=res");
        }
    //O campo usuário e senha não preenchido entra no else e redireciona o usuário para a página de login
    }else{
        $_SESSION['loginErro'] = "Usuário ou senha inválido";
       echo 'erro 3';
    }
?>
