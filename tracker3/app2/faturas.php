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
$nome_user = 	$resp_user['nome'];
$nome_us = explode(" ", $nome_user);
$nome_user = $nome_us[0];
$email_user = 	$resp_user['email'];
$nivel = 	$resp_user['nivel'];
$ativo = 	$resp_user['ativo'];
$veiculos_user = 	$resp_user['veiculos'];
$permite_bloqueio = 	$resp_user['permite_bloqueio'];
$id_cliente = 	$resp_user['id_cliente'];

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
        <a href="index.html" class="header-title">RMB</a>
        <a href="#" data-menu="menu-main" class="header-icon header-icon-1"><i class="fas fa-bars"></i></a>
        <a href="#" data-toggle-theme class="header-icon header-icon-2 show-on-theme-dark"><i class="fas fa-sun"></i></a>
        <a href="#" data-toggle-theme class="header-icon header-icon-2 show-on-theme-light"><i class="fas fa-moon"></i></a>
        <a href="#" data-menu="menu-highlights" class="header-icon header-icon-3"><i class="fas fa-brush"></i></a>
    </div>
    <div id="footer-bar" class="footer-bar-5">
         <a href="perfil.php?id=<?php echo $id_push?>" onclick="carregar();"><i class="fas fa-user-circle"></i><span>Perfil</span></a>
        <a href="faturas.php?id=<?php echo $id_push?>" class="active-nav" onclick="carregar();"><i class="fas fa-file-invoice-dollar"></i><span>Faturas</span></a>
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
                <h3>Faturas</h3>
				<p>Abaixo estão listadas as suas 10 útimas faturas.</p>
            </div>
			
        </div>
        <?php
		$data_hoje = date('Y-m-d');
		$data_mes = date('Y-m-01');
		$result_usuario = mysqli_query($conn, "SELECT * FROM contas_receber WHERE id_cliente='$id_cliente'  ORDER BY data_vencimento DESC LIMIT 10");
			if(mysqli_num_rows($result_usuario) > 0){
				while($row_usuario = mysqli_fetch_assoc($result_usuario)){
				$id_conta = $row_usuario['id_conta'];
				$data_vencimento = $row_usuario['data_vencimento'];
				$data_vencimento1 = date('d/m/Y', strtotime("$data_vencimento"));
				$linha_digitavel = $row_usuario['linha_digitavel'];
				$status = $row_usuario['status'];
				$especie = $row_usuario['especie'];
				$class_financeira = $row_usuario['class_financeira'];
				$valor_bruto = $row_usuario['valor_bruto'];
				$valor_bruto1 = number_format($valor_bruto, 2, ",", ".");
				
				if($status == 'Em Aberto' && $data_vencimento < $data_hoje){
					$vencimento = '<h3><span class="badge" style="background-color:#CD5C5C;color:#FFF"><b><i class="fas fa-calendar-times"></i> '.$data_vencimento1.'</b></span></h3>';
					$status1 = 'Em Atraso';
					$img = 'atraso.jpg';
					$link_fat = 'view_fatura_atraso.php?id='.$id_push.'&id_conta='.$id_conta.'';
					
				}
				if($status == 'Em Aberto' && $data_vencimento >= $data_hoje){
					$vencimento = '<h3><span class="badge" style="background-color:#4169E1;color:#FFF"><b><i class="fas fa-calendar"></i> '.$data_vencimento1.'</b></span></h3>';
					$status1 = 'Aguardando Pgto';
					$img = 'waiting.jpg';
					$link_fat = 'view_fatura.php?id='.$id_push.'&id_conta='.$id_conta.'';
				}
				if($status == 'Pago'){
					$vencimento = '<h3><span class="badge" style="background-color:#009900;color:#FFF"><b><i class="fas fa-calendar-check"></i> '.$data_vencimento1.'</b></span></h3>';
					$status1 = 'Pagamento Confirmado';
					$img = 'check.jpg';
					$link_fat = 'view_fatura_paga.php?id='.$id_push.'&id_conta='.$id_conta.'';
				}
				
				if($especie == 2){
					$forma_pgto = '<i class="fas fa-barcode"></i> Boleto Bancário';
				}
				if($especie == 13){
					$forma_pgto = '<i class="far fa-credit-card"></i> Cartão de Crédito';
					
				}
				
				if($especie == 2 && $status == 'Em Aberto'){
					$botao_fat = '<a href="baixar1.php?id_conta='.$id_conta.'"><button type="button" class="btn btn-primary">Abrir Fatura</button></a>';
				}
				if($especie == 2 && $status == 'Pago'){
					$botao_fat = '';
				}
				if($especie != 2){
					$botao_fat = '';
					
				}
				
				
				$cons_class = mysqli_query($conn,"SELECT * FROM categorias_contas_receber WHERE id_categoria='$class_financeira'");
					if(mysqli_num_rows($cons_class) > 0){
						while ($resp_especie = mysqli_fetch_assoc($cons_class)) {
						$categoria	 = 	$resp_especie['categoria'];
						//$categoria = utf8_encode($categoria);
					}}
				
		?>		
		
		 <div class="card card-style mb-1">
			<a href="<?php echo $link_fat?>" onclick="carregar();">
            <div class="content mb-1">
                <div class="d-flex">
                    <div>
                        <img src="images/pictures/<?php echo $img?>" class="rounded-sm" width="40">
                    </div>
                    <div class="w-100 ms-3 pt-1">
                        <h6 class="font-500 font-14 pb-2">Venc: <?php echo $data_vencimento1?></h6>
                        <h4 class="font-700">R$ <?php echo $valor_bruto1; ?></h4>
                        <h6 class="font-500 font-14 pb-2"><?php echo $status1?></h6>
                        <h6 class="font-500 font-14 pb-2"><?php echo $forma_pgto?></h6>
                    </div>
                    <div class="align-self-center me-n2">
                        <i class="fa icon-30 text-end fa-angle-right font-18 color-blue-dark fa-2x"></i>
                        
                    </div>
                </div>
            </div>
			</a>
        </div>
				
				
				
		<?php		
			}}
		?>
        
		
    
	
	
	

        <!-- footer and footer card-->
        
    </div>    
    <!-- end of page content-->
    

	

	
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
    


    
</div>    


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

</body>
