<?php 
$servidor = "localhost";
$usuario = "root";
$senha = "TR4vcijU6T9Keaw";
$dbname = "traccar";

//Criar a conexao
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
$con = mysqli_connect($servidor, $usuario, $senha, $dbname);

$data_agora = date('H:i');
$data_login = date('Y-m-d H:i');
$deviceid = $_REQUEST['deviceid'];
$id_push = $_REQUEST['id'];

$data_limite = date('Y-m-d H:i');
$data_limite = date('Y-m-d H:i', strtotime('+24 hour', strtotime($data_limite)));

$link = $deviceid.'@'.$data_limite;

$link_base = base64_encode($link);

 $cons_user1 = mysqli_query($conn,"SELECT * FROM usuarios_push WHERE id_push='$id_push' ");
	if(mysqli_num_rows($cons_user1) <= 0){
		header('Location: logoff.php');
	}
	if(mysqli_num_rows($cons_user1) > 0){
		while ($resp_user1 = mysqli_fetch_assoc($cons_user1)) {
		$tipo = 	$resp_user1['tipo'];
		$id_usuarios = $resp_user1['id_usuarios'];
		$id_cliente_login = $resp_user1['id_cliente'];
		if($tipo == 'ADMIN'){
			header('Location: admin/index.php?id='.$id_push.'');
		}
		if($tipo == 'TECNICO'){
			header('Location: tecnico/index.php?id='.$id_push.'');
		}

		$sql = mysqli_query($conn, "UPDATE usuarios_push SET versao='V2', ultimo_login='$data_login' WHERE id_push='$id_push' ");
	}}

$cons_user = mysqli_query($conn, "SELECT * FROM usuarios WHERE id_usuarios = '$id_usuarios'");
	if(mysqli_num_rows($cons_user) > 0){
while ($resp_user = mysqli_fetch_assoc($cons_user)) {
$id_cliente = 	$resp_user['id_cliente'];
$nome_user = 	$resp_user['nome'];
$email_user = 	$resp_user['email'];
$email = explode("@", $email_user);
$ini_email = $email[0];
$ini_email1 = substr_replace($ini_email, '*****', 2, 5);
$email_user = $ini_email1.'@'.$email[1];


$email_user = strtolower($email_user);
$nivel = 	$resp_user['nivel'];
$ativo = 	$resp_user['ativo'];
$veiculos_user = 	$resp_user['veiculos'];
$alertas_whats = 	$resp_user['alertas_whats'];
	}}
	
if($alertas_whats == 'SIM'){
	$pergunta = 'Desativar Notificações Whatsapp?';
	$botao_active = '<a href="active_whats.php?id='.$id_push.'&id_usuarios='.$id_usuarios.'&alerta=NAO" class="btn btn-full btn-m bg-red2-dark font-600 rounded-s">Desativar</a>';
}
if($alertas_whats != 'SIM'){
	$pergunta = 'Ativar Notificações Whatsapp?';
	$botao_active = '<a href="active_whats.php?id='.$id_push.'&id_usuarios='.$id_usuarios.'&alerta=SIM" class="btn btn-full btn-m bg-green2-dark font-600 rounded-s">Ativar</a>';
}	

$cons_cliente = mysqli_query($conn, "SELECT * FROM clientes WHERE id_cliente = '$id_cliente'");
	if(mysqli_num_rows($cons_cliente) > 0){
while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {

$migrado = 	$resp_cliente['migrado'];
$status_cliente = 	$resp_cliente['status'];
$telefone_celular10 = 	$resp_cliente['telefone_celular'];
$telefone_celular10 = substr_replace($telefone_celular10, '****', 7, 5);
	

	}}



$nome_empesa = 'JC Rastreamento';

?>

<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
<title>APP</title>
<link rel="stylesheet" type="text/css" href="styles/bootstrap.css">
<link rel="stylesheet" type="text/css" href="styles/style.css">
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900|Roboto:300,300i,400,400i,500,500i,700,700i,900,900i&amp;display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="fonts/css/fontawesome-all.min.css">    
<link rel="manifest" href="_manifest.json" data-pwa-version="set_in_manifest_and_pwa_js">
<link rel="apple-touch-icon" sizes="180x180" href="app/icons/icon-192x192.png">
<script src="https://kit.fontawesome.com/a132241e15.js"></script>
</head>
    
<body class="theme-light" data-highlight="blue2">
    
<div id="preloader"><div class="spinner-border color-highlight" role="status"></div></div>
    
<div id="page">
    
    <!-- header and footer bar go here-->
    <div class="header header-fixed header-auto-show header-logo-app">
        <a href="index.html" class="header-title">LocalRast</a>
        <a href="#" data-menu="menu-main" class="header-icon header-icon-1"><i class="fas fa-bars"></i></a>
        <a href="#" data-toggle-theme class="header-icon header-icon-2 show-on-theme-dark"><i class="fas fa-sun"></i></a>
        <a href="#" data-toggle-theme class="header-icon header-icon-2 show-on-theme-light"><i class="fas fa-moon"></i></a>
        <a href="#" data-menu="menu-highlights" class="header-icon header-icon-3"><i class="fas fa-brush"></i></a>
    </div>
    <div id="footer-bar" class="footer-bar-5">
         <a href="perfil.php?id=<?php echo $id_push?>" onclick="carregar();" class="active-nav"><i class="fas fa-user-circle"></i><span>Perfil</span></a>
        <a href="faturas.php?id=<?php echo $id_push?>" onclick="carregar();"><i class="fas fa-file-invoice-dollar"></i><span>Faturas</span></a>
        <a href="index.php?id=<?php echo $id_push?>" onclick="carregar();"><i class="fas fa-car"></i><span>Veículos</span></a>
        <a href="#" data-menu="menu-main"><i class="fa fa-bars"></i><span>Menu</span></a>
    </div>
    
    <div class="page-content">
        
        <div class="page-title page-title-large">
            <h2><a href="#" class="color-white" data-back-button><i class="fa fa-arrow-left"></i> Voltar</a> </h2><br>
            <a href="#" data-menu="menu-main" class="bg-fade-gray1-dark shadow-xl preload-img" data-src="images/avatars/5s.png"></a>
        </div>
        <div class="card header-card shape-rounded" data-card-height="210">
            <div class="card-overlay bg-highlight opacity-95"></div>
            <div class="card-overlay dark-mode-tint"></div>
            <div class="card-bg preload-img" data-src="images/pictures/20s.jpg"></div>
        </div>
        

        <!-- Homepage Slider-->
        
		 <div class="card card-style shadow-xl">        
            <div class="content">
                <h3>Perfil</h3>
				<p>Abaixo estão as informações do seu perfil, celulares que estão conectados com seu usuário, alertas pelo whatsapp e alteração de senha.</p>
            </div>
			
        </div>
		<div class="card card-style">        
            <div class="content mb-2">
                <a href="#" class="d-flex mb-3">
                    <div>
                        <img src="images/pictures/user.jpg" width="50" class="rounded-xl me-3">
                    </div>
                    <div>
                        <h5 class="font-16 font-600">Nome</h5>
                        <p class="line-height-s mt-1"><?php echo mb_convert_case($nome_user, MB_CASE_TITLE, "UTF-8");?></p>
                    </div>
                    
                </a>
                <div class="divider mb-3"></div>
                <a href="#" class="d-flex mb-3">
                    <div>
                        <img src="images/pictures/email.jpg" width="50" class="rounded-xl me-3">
                    </div>
                    <div>
                        <h5 class="font-16 font-600">E-mail</h5>
                        <p class="line-height-s mt-1"><?php echo $email_user?></p>
                    </div>
                    
                </a>
				<div class="divider mb-3"></div>
                <a href="#" class="d-flex mb-3">
                    <div>
                        <img src="images/pictures/phone.jpg" width="50" class="rounded-xl me-3">
                    </div>
                    <div>
                        <h5 class="font-16 font-600">Telefone Celular</h5>
                        <p class="line-height-s mt-1"><?php echo $telefone_celular10?></p>
                    </div>
                    
                </a>
				<div class="divider mb-3"></div>
                <a href="#" data-menu="celulares" class="d-flex mb-3">
                    <div>
                        <img src="images/pictures/phones.jpg" width="50" class="rounded-xl me-3">
                    </div>
                    <div>
                        <h5 class="font-16 font-600">Celulares Conectados</h5>
                        <p class="line-height-s mt-1">Celulares que fizeram login com seu usuário.</p>
                    </div>
                    <div class="align-self-right ps-3">
                        <i class="fa fa-angle-right fa-2x"></i>
                    </div>
                </a>
				
				<div class="divider mb-3"></div>
                <a href="#" data-menu="menu-signin" class="d-flex mb-3">
                    <div>
                        <img src="images/pictures/password.jpg" width="50" class="rounded-xl me-3">
                    </div>
                    <div>
                        <h5 class="font-16 font-600">Alterar Senha</h5>
                        <p class="line-height-s mt-1">Clique aqui para alterar a sua senha de acesso.</p>
                    </div>
                    <div class="align-self-right ps-3">
                        <i class="fa fa-angle-right fa-2x"></i>
                    </div>
                </a>
            </div>
        </div> 
		
    
	
	
	

        <!-- footer and footer card-->
        
    </div>    
    <!-- end of page content-->
    
	<form id="forml" action="alterar_senha.php?id=<?php echo $id_push?>" method="post">
	<div id="menu-signin" class="menu menu-box-bottom rounded-m" 
         data-menu-height="400" 
         data-menu-effect="menu-over">
        <div class="menu-title">
            <h1 class="font-24">Alterar Senha</h1>
            <a href="#" class="close-menu"><i class="fa fa-times-circle"></i></a>
        </div>

		<div class="content mb-0 mt-0">
            <div class="input-group ">
				<input type="password" class="form-control font-16" name="senha" id="senha" Placeholder="Senha Atual" required>
				<div class="input-group-append">
					<button class="btn btn-border border-dark2-dark color-dark-dark bg-theme" onclick="mostrar_senha();" type="button" id="bt_senha"><i class="fas fa-eye"></i></button>
				</div>
			</div><br>
             <div class="input-group">
				<input type="password" class="form-control font-16" name="nova_senha" id="nova_senha" Placeholder="Nova Senha" required>
				<div class="input-group-append">
					<button class="btn btn-border border-dark2-dark color-dark-dark bg-theme" onclick="mostrar_senha1();" type="button" id="bt_senha1"><i class="fas fa-eye"></i></button>
				</div>
			</div><br><br><br>
			<div class="row">
				
				<div class="col-auto">
				<div class="ms-auto me-4 pe-2">
                        <div class="custom-control ios-switch ios-switch-icon">
                            <input type="checkbox" class="ios-input" id="todos" name="todos" value="SIM">
                            <label class="custom-control-label" for="todos"></label>
                            <span>SIM</span>
                            <span>NÂO</span>
                        </div>
                    </div>Desconectar todos os dispositivos
				</div>
			</div>
			<input type="hidden" id="id_push2" name="id_push2" value="<?php echo $id_push?>">
			<input type="hidden" id="id_usuarios2" name="id_usuarios2" value="<?php echo $id_usuarios?>">
            
            <button type="submit" onclick="carregar();" class="btn btn-full btn-m shadow-l rounded-s font-600 bg-blue1-dark mt-4" style="width:100%">Alterar</button>
        </div>
    </div>   
	</form>
	
	<div id="menu-option-1" class="menu menu-box-bottom rounded-m"
         data-menu-height="250" 
         data-menu-effect="menu-over">
        <div class="menu-title">

            <h1 class="font-20"><?php echo $pergunta?></h1>
            <a href="#" class="close-menu"><i class="fa fa-times-circle"></i></a>
        </div><br>
        <div class="content mt-0">
			 <p class="pe-3">
                Nº telefone: <?php echo $telefone_celular10?>.
            </p>
            <div class="row mb-0">
                <div class="col-12">
                   <?php echo $botao_active?>
                </div>
                
            </div>
        </div>
    </div> 
	
	<div id="celulares" class="menu menu-box-bottom rounded-m"
         data-menu-height="450" 
         data-menu-effect="menu-over">
        <div class="menu-title">
            
            <h1 class="font-20">Celulares conectados</h1>
            <a href="#" class="close-menu"><i class="fa fa-times-circle"></i></a>
        </div><br>
        <div class="content mt-0">
			 <?php
											
				 $cons_cel = mysqli_query($conn,"SELECT * FROM usuarios_push WHERE id_usuarios='$id_usuarios'");
				if(mysqli_num_rows($cons_cel) > 0){
					while ($resp_cel = mysqli_fetch_assoc($cons_cel)) {
					$id_push_2 = 	$resp_cel['id_push'];
					$modelo = 	$resp_cel['modelo'];
					$ultimo_login = 	$resp_cel['ultimo_login'];
					$ultimo_login = date('d/m/Y H:i', strtotime("$ultimo_login"));
					
					if($id_push_2 == $id_push){
						$meu_dispositivo = '<span style="color:#4169E1"><i>(Este Aparelho)</i></span>';
						$excluir = '';
					}
					if($id_push_2 != $id_push){
						$meu_dispositivo = '';
						$excluir = '<a href="del_celular.php?id='.$id_push.'&id_push='.$id_push_2.'"><button type="button" data-toggle="modal" data-target="#carregar" class="btn btn-dark btn-sm btn-icon"><i class="fal fa-trash-alt"></i></button></a>';
					}
				?>	
				
				
				
				<a href="#" class="d-flex mb-3">
					<div>
						<img src="images/pictures/phones.jpg" width="40" class="rounded-xl me-3">
					</div>
					<div>
						<h5 class="font-16 font-600"><?php echo $modelo?> <?php echo $meu_dispositivo?></h5>
						<p class="line-height-s mt-1">Último acesso: <?php echo $ultimo_login?></p>
					</div>
					
				</a>
				
				
				<?php
				}}	

				?>
        </div>
    </div> 
	
	
	<div id="aguarde" class="menu menu-box-modal rounded-m" 
         data-menu-height="120" 
         data-menu-width="310">
        <h1 class="text-center mt-3 pt-1"><i class="fa fa-sync fa-spin mr-3 fa-2x"></i></h1>
        
        <p class="boxed-text-l">
            Por favor, aguarde...
        </p>
    </div>
    
    <div id="menu-share" 
         class="menu menu-box-bottom menu-box-detached rounded-m" 
         data-menu-load="menu-share.html"
         data-menu-height="420" 
         data-menu-effect="menu-over">
    </div>    
    
    <div id="menu-highlights" 
         class="menu menu-box-bottom menu-box-detached rounded-m" 
         data-menu-load="menu-colors.html"
         data-menu-height="510" 
         data-menu-effect="menu-over">        
    </div>
    
    <div id="menu-main"
         class="menu menu-box-left menu-box-detached rounded-m"
         data-menu-width="300"
         data-menu-load="menu-main.php?id=<?php echo $id_push?>"
         data-menu-active="nav-starters"
         data-menu-effect="menu-over">  
    </div>
    

	<input type="hidden" id="valor_senha" value="0">
		<input type="hidden" id="valor_senha1" value="0">
    
</div>    

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript" src="scripts/bootstrap.min.js"></script>
<script type="text/javascript" src="scripts/custom.js"></script>

<script>
	function carregar(){
		$('#aguarde').showMenu();
	}
	function carregar2(){
	$('#aguarde').showMenu();
	$('#menu-main').hideMenu();
}
</script>
<script>
function mostrar_senha(){
	var valor_senha = document.getElementById("valor_senha").value;
	if(valor_senha == 0){
		$('#valor_senha').val('1');
		document.getElementById('senha').type = 'text';
		$('#bt_senha').html('<i class="fas fa-eye-slash"></i>');
	}
	if(valor_senha == 1){
		$('#valor_senha').val('0');
		document.getElementById('senha').type = 'password';
		$('#bt_senha').html('<i class="fas fa-eye"></i>');
	}
}
</script>
<script>
function mostrar_senha1(){
	var valor_senha = document.getElementById("valor_senha1").value;
	if(valor_senha == 0){
		$('#valor_senha1').val('1');
		document.getElementById('nova_senha').type = 'text';
		$('#bt_senha1').html('<i class="fas fa-eye-slash"></i>');
	}
	if(valor_senha == 1){
		$('#valor_senha1').val('0');
		document.getElementById('nova_senha').type = 'password';
		$('#bt_senha1').html('<i class="fas fa-eye"></i>');
	}
}
</script>
</body>
