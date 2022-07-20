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
$id_push = $_REQUEST['id'];
$id_cliente = $_GET['id_cliente'];

 $cons_user1 = mysqli_query($conn,"SELECT * FROM usuarios_push WHERE id_push='$id_push' ");
	if(mysqli_num_rows($cons_user1) <= 0){
		header('Location: logoff.php');
	}
	if(mysqli_num_rows($cons_user1) > 0){
		while ($resp_user1 = mysqli_fetch_assoc($cons_user1)) {
		$tipo = 	$resp_user1['tipo'];
		$id_usuarios = $resp_user1['id_usuarios'];
		$sql = mysqli_query($conn, "UPDATE usuarios_push SET versao='V2', ultimo_login='$data_login' WHERE id_push='$id_push' ");
	}}

$cons_user = mysqli_query($conn, "SELECT * FROM usuarios WHERE id_usuarios = '$id_usuarios'");
	if(mysqli_num_rows($cons_user) > 0){
		while ($resp_user = mysqli_fetch_assoc($cons_user)) {
		$nome_user = 	$resp_user['nome'];
		$nome_us = explode(" ", $nome_user);
		$nome_user = $nome_us[0];
		$email_user = 	$resp_user['email'];
		$nivel = 	$resp_user['nivel'];
		$ativo = 	$resp_user['ativo'];
		$veiculos_user = 	$resp_user['veiculos'];
		$ultimo_login_app = 	$resp_user['ultimo_login_app'];
		$id_cliente_login = $resp_user['id_cliente'];
	}}

$result_veiculos = mysqli_query($conn, "SELECT * FROM clientes WHERE status = '1' OR status='2'");
$total_veiculos = mysqli_num_rows($result_veiculos);

$cons_cli = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
	if(mysqli_num_rows($cons_cli) > 0){
		while ($resp_cli = mysqli_fetch_assoc($cons_cli)) {
		$nome_cliente = 	$resp_cli['nome_cliente'];
		$telefone_celular = 	$resp_cli['telefone_celular'];
		$email = 	$resp_cli['email'];

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
<link rel="stylesheet" type="text/css" href="../styles/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../styles/style.css">
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900|Roboto:300,300i,400,400i,500,500i,700,700i,900,900i&amp;display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../fonts/css/fontawesome-all.min.css">    
<link rel="manifest" href="../_manifest.json" data-pwa-version="set_in_manifest_and_pwa_js">
<link rel="apple-touch-icon" sizes="180x180" href="../app/icons/icon-192x192.png">
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
        <a href="index.php?id=<?php echo $id_push?>" onclick="carregar();"><i class="fas fa-car"></i><span>Veículos</span></a>
        <a href="clientes.php?id=<?php echo $id_push?>" class="active-nav" onclick="carregar();"><i class="fas fa-user"></i><span>Clientes</span></a>
        <a href="#" data-menu="menu-forgot"><i class="fas fa-search"></i><span>Buscar</span></a>
        <a href="#" data-menu="menu-main"><i class="fa fa-bars"></i><span>Menu</span></a>
    </div>
    
    <div class="page-content">
        
        <div class="page-title page-title-large">
            <h2 data-username="<?php echo mb_convert_case($nome_user, MB_CASE_TITLE, "UTF-8");?>" class="greeting-text"></h2>
            <a href="#" data-menu="menu-main" class="bg-fade-gray1-dark shadow-xl preload-img" data-src="../images/avatars/5s.png"></a>
        </div>
        <div class="card header-card shape-rounded" data-card-height="210">
            <div class="card-overlay bg-highlight opacity-95"></div>
            <div class="card-overlay dark-mode-tint"></div>
            <div class="card-bg preload-img" data-src="../images/pictures/20s.jpg"></div>
        </div>
        

        <!-- Homepage Slider-->
        
		<div class="card card-style">        
            <div class="content mb-2">
                <a href="#" class="d-flex mb-3">
                    <div>
                        <img src="../images/pictures/user.jpg" width="60" class="rounded-xl me-3">
                    </div>
                    <div>
                        <h5 class="font-16 font-600">Nome</h5>
                        <p class="line-height-s mt-1"><?php echo mb_convert_case($nome_cliente, MB_CASE_TITLE, "UTF-8");?></p>
                    </div>
                    
                </a>
                <div class="divider mb-3"></div>
                <a href="#" class="d-flex mb-3">
                    <div>
                        <img src="../images/pictures/email.jpg" width="60" class="rounded-xl me-3">
                    </div>
                    <div>
                        <h5 class="font-16 font-600">E-mail</h5>
                        <p class="line-height-s mt-1"><?php echo $email?></p>
                    </div>
                    
                </a>
				<div class="divider mb-3"></div>
                <a href="tel:<?php echo $telefone_celular?>" class="d-flex mb-3">
                    <div>
                        <img src="../images/pictures/phone.jpg" width="60" class="rounded-xl me-3">
                    </div>
                    <div>
                        <h5 class="font-16 font-600">Telefone Celular</h5>
                        <p class="line-height-s mt-1"><?php echo $telefone_celular?></p>
                    </div>
                    
                </a>  
            </div>
        </div>
        
		<div class="card card-style">        
            <div class="content mb-2">
			<h3>Veículos</h3>
			<div class="divider mb-3"></div>
        <?php
		$cons_veiculo = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE id_cliente='$id_cliente' AND status='1' ORDER BY placa ASC");
			if(mysqli_num_rows($cons_veiculo) > 0){
				while ($resp_v = mysqli_fetch_assoc($cons_veiculo)) {
				$placa = 	$resp_v['placa'];
				$deviceid = 	$resp_v['deviceid'];
				$marca_veiculo = 	$resp_v['marca_veiculo'];
				$modelo_veiculo = 	$resp_v['modelo_veiculo'];
				$modelo_img = str_replace(' ', '_', $modelo_veiculo);

				
		?>

				<a href="grid_device.php?deviceid=<?php echo $deviceid?>&id=<?php echo $id_push?>" class="d-flex mb-3">
                    <div>
                        <h5 class="font-14 font-600"><?php echo $placa?></h5>
                        <p class="line-height-s mt-1"><?php echo $marca_veiculo?>/<?php echo $modelo_veiculo?></p>
                    </div>
                    <div class="align-self-right ps-3">
                        <i class="fa fa-angle-right fa-2x"></i>
                    </div>
                </a>
				<div class="divider mb-3"></div>
			
				
		<?php
			}}
		
		?>

			</div>
		</div>
			
        <input type="hidden" id="id_push" value="<?php echo $id_push?>">

        <!-- footer and footer card-->
        
    </div>    
    <!-- end of page content-->
    <form id="forml" action="clientes1.php?id=<?php echo $id_push?>" method="post">
	
	
	<div id="menu-forgot" class="menu menu-box-bottom menu-box-detached rounded-m" 
         data-menu-height="320" 
         data-menu-effect="menu-over">
        <div class="content mb-0">
            <h1 class="font-700 mb-0">Buscar Cliente</h1>
            <p class="font-11  mt-n1 mb-0">
               Digite o nome do cliente.
            </p>
			<br>
            <div class="input-style has-icon input-style-1 input-required">
                <i class="input-icon fa fa-user font-16"></i>
                <input type="text" name="dados" id="dados" placeholder="Nome do cliente">
            </div> 
             <br>
            
            <button type="submit" onclick="carregar()" class="btn btn-full btn-m shadow-l rounded-s bg-highlight font-600 top-20" style="width:100%">BUSCAR</button>
        </div>
    </div> 
	</form>
    
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
         data-menu-active="nav-welcome"
         data-menu-effect="menu-over">  
    </div>
    
   <div id="aguarde" class="menu menu-box-modal rounded-m" 
         data-menu-height="120" 
         data-menu-width="310">
        <h1 class="text-center mt-3 pt-1"><i class="fa fa-sync fa-spin mr-3 fa-2x"></i></h1>
        
        <p class="boxed-text-l">
            Por favor, aguarde...
        </p>
    </div>

    
</div>    


<script type="text/javascript" src="../scripts/jquery.js"></script>
<script type="text/javascript" src="../scripts/bootstrap.min.js"></script>
<script type="text/javascript" src="../scripts/custom.js"></script>
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
		//variavel para controle de registros retornados
		var pagina = 0;
		var id_push = $('#id_push').val();
		//function carrega
		function carrega(){
			$('#loading').html("<img src='img/loader.gif'/> Carregando Veículos...").fadeIn('fast');
			$.ajax({
				type: "POST",
				url: "loadAjax.php",
				data: "page="+pagina+"&id="+id_push,//variavel passada via post 
				cache: false,
				success: function(html){
					$('#loading').fadeOut('fast');
					$("#content").append(html);//mostra resultado na div content
				},
				error:function(html){
					$('#loading').html("erro...").fadeIn('fast');
				}
			});
		};
		//chama minha funcao ao carregar a pagina
		$(document).ready(function(){
			carrega();
		});
		//funcao de controle do scroll da pagina, na qual ela chega ao fim é acionada chamando
		//minha function carrega novamente para trazer mais dados dinamicamente
		$(window).scroll(function(){
			
			if($('#content').scrollTop() + $('#content').height() >= $('#content').height()){
				pagina += 1;
				carrega();
			};
		});
	</script>
</body>