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
	
if($tipo == 'TECNICO'){
	//$id_cliente_login = $resp_user1['id_cliente'];
	header('Location: tecnico/index.php?id='.$id_push.'');
}
if($tipo == 'ADMIN'){
	//$id_cliente_login = $resp_user1['id_cliente'];
	header('Location: admin/index.php?id='.$id_push.'');
}

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



?>

<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
<title>GRID</title>
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
        <a href="faturas.php?id=<?php echo $id_push?>" onclick="carregar();"><i class="fas fa-file-invoice-dollar"></i><span>Faturas</span></a>
        <a href="index.php?id=<?php echo $id_push?>" class="active-nav" onclick="carregar();"><i class="fas fa-car"></i><span>Veículos</span></a>
        <a href="#" data-menu="menu-forgot"><i class="fas fa-search"></i><span>Buscar</span></a>
        <a href="#" data-menu="menu-main"><i class="fa fa-bars"></i><span>Menu</span></a>
    </div>
    
    <div class="page-content">
        
        <div class="page-title page-title-large">
            <h2 data-username="<?php echo mb_convert_case($nome_user, MB_CASE_TITLE, "UTF-8");?>" class="greeting-text"></h2>
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
                <h2 class="font-24 font-700 mb-2"></h2>
                <p class="mb-1">
                    Abaixo estão listados os seus veículos. Para ver no mapa, por favor, clique no nome do veículo.
                </p>
            </div>
        </div>
        
        <?php




$data_agora = date('Y-m-d H:i:s');
$data_agora = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_agora)));
$data_agora1 = date('Y-m-d H:i:s', strtotime('-5 minutes', strtotime($data_agora)));



$cons_user = mysqli_query($conn,"SELECT * FROM usuarios WHERE id_usuarios='$id_usuarios' ");
	if(mysqli_num_rows($cons_user) > 0){
while ($resp_user = mysqli_fetch_assoc($cons_user)) {
$permite_bloqueio = 	$resp_user['permite_bloqueio'];
$veiculos = 	$resp_user['veiculos'];

	}}

if($veiculos == '0'){
	$tabela1 = "SELECT * FROM tc_devices WHERE contact='$id_cliente_login' AND positionid >= '1' ORDER BY lastupdate DESC";
}
elseif($veiculos == ''){
	$tabela1 = "SELECT * FROM tc_devices WHERE contact='$id_cliente_login' AND positionid >= '1' ORDER BY lastupdate DESC";
}
else{
	$tabela1 = "SELECT * FROM tc_devices WHERE id IN ($veiculos) ORDER BY lastupdate DESC";
}
					
			$result_usuario = mysqli_query($conn, $tabela1);
				$total_devices = mysqli_num_rows($result_usuario);
				if(mysqli_num_rows($result_usuario) > 0){
				while ($row_usuario = mysqli_fetch_assoc($result_usuario)) {
				$deviceid = $row_usuario['id'];
				$name = $row_usuario['name'];
				$positionid = $row_usuario['positionid'];
				$category = 	$row_usuario['category'];
				$lastupdate = 	$row_usuario['lastupdate'];
				$lastupdate_data = date('d/m/Y', strtotime('-3 hour', strtotime($lastupdate)));
				$lastupdate_hora = date('H:i:s', strtotime('-3 hour', strtotime($lastupdate)));
				
				if($lastupdate < $data_agora1){
					$conect = '<h3><span class="badge" style="background-color:#CD5C5C;color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Dispositivo Offline"><i class="fas fa-wifi"></i></span></h3>';
					$status_conexao = 'off';
				} else {
					$conect = '<h3><span class="badge" style="background-color:#009900;color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Dispositivo Online"><i class="fas fa-wifi"></i></span></h3>';
					$status_conexao = 'on';
				}
				
				if($total_devices <= 5){
					$abrir = 'show';
				}
				if($total_devices > 5){
					$abrir = '';
				}
				
				if($category == 'car'){
					$modelo_img = 'car.png';
				}
				if($category == 'Automovel'){
					$modelo_img = 'car.png';
				}
				if($category == 'motorcycle'){
					$modelo_img = 'motorcycle.png';
				}
				if($category == 'Motocicleta'){
					$modelo_img = 'motorcycle.png';
				}
				if($category == 'bus'){
					$modelo_img = 'bus.png';
				}
				if($category == 'Onibus'){
					$modelo_img = 'bus.png';
				}
				if($category == 'truck'){
					$modelo_img = 'truck.png';
				}
				if($category == 'Caminhao'){
					$modelo_img = 'truck.png';
				}
				
				$cons_cliente = mysqli_query($conn,"SELECT * FROM tc_positions WHERE id='$positionid' ORDER BY id DESC");
					if(mysqli_num_rows($cons_cliente) > 0){
				while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
				
				$address = 	$resp_cliente['address'];
				$address = str_replace(', BR', '', $address);
				$address1 = explode(",", $address);
				$estado1 = end($address1);
				$estado = ','.$estado1;
				$address = str_replace($estado, '', $address);
				$address1 = explode(",", $address);
				$cep = end($address1);
				$cep = ','.$cep;
				$address = str_replace($cep, '', $address);
				$address = $address.' /'.$estado1;
				$address = str_replace('Corredor de Transporte Coletivo', 'Av.', $address);
				
				
				$devicetime = 	$resp_cliente['fixtime'];
				$devicetime11 = date('d/m/Y H:i:s', strtotime('-3 hour', strtotime($devicetime)));
				
				$speed = 	$resp_cliente['speed'];
				
				$speed = $speed * 1.609;
				$speed = round($speed, 2);
				$attributes = $resp_cliente['attributes'];
				$protocol = 	$resp_cliente['protocol'];
				$obj = json_decode($attributes);
				$ignicao = $obj->{'ignition'};
				}}
				if (is_bool($ignicao)) $ignicao ? $ignicao = "true" : $ignicao = "false";
				else if ($ignicao !== null) $ignicao = (string)$ignicao;
				
				$cons_conexao = mysqli_query($conn,"SELECT * FROM tc_events WHERE deviceid='$deviceid' ORDER BY id DESC LIMIT 1");
					if(mysqli_num_rows($cons_conexao) > 0){
				while ($resp_conexao = mysqli_fetch_assoc($cons_conexao)) {
				$type = 	$resp_conexao['type'];
				$eventos = $resp_conexao['attributes'];
				$eventos1 = json_decode($eventos);
				$alarme = $eventos1->{'alarm'};
				
				if($status_conexao == 'on'){
					if($type == 'alarm' && $alarme == 'powerCut'){
						$bateria = '<h3><span class="badge" style="background-color:#CD5C5C;color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Sem Alimentação"><i class="fas fa-plug"></i></span></h3>';
					}
					if($type == 'alarm' && $alarme == 'powerRestored' or $alarme != 'powerCut'){
						$bateria = '<h3><span class="badge" style="background-color:#009900;color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Alimentação Conectada"><i class="fas fa-plug"></i></span></h3>';
					}
				}
				if($status_conexao == 'off'){
					$bateria = '<h3><span class="badge badge-secondary" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Sem Informação"><i class="fas fa-plug"></i></span></h3>';
					$div_off = '<div style="display:none">offline</div>';
				}
				}}
				
				
				
				
				
				
				$cons_veiculo = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE deviceid='$deviceid' ");
					if(mysqli_num_rows($cons_veiculo) > 0){
				while ($resp_veiculo = mysqli_fetch_assoc($cons_veiculo)) {
				$placa = 	$resp_veiculo['placa'];
				$bloqueio = 	$resp_veiculo['bloqueio'];
				$pos_inicial = 	$resp_veiculo['pos_inicial'];
				$ancora = 	$resp_veiculo['ancora'];
				$marca_veiculo = 	$resp_veiculo['marca_veiculo'];
				$modelo_veiculo = 	$resp_veiculo['modelo_veiculo'];
				
				$id_cliente = 	$resp_veiculo['id_cliente'];
				$veiculo = $placa.' - '.$marca_veiculo.'/'.$modelo_veiculo;
				}}
				
				$cons_cli = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente' ");
					if(mysqli_num_rows($cons_cli) > 0){
				while ($resp_cli = mysqli_fetch_assoc($cons_cli)) {
				$nome_cliente = 	$resp_cli['nome_cliente'];
					}}
					
				if($ignicao == 'true' && $speed >= 6){
					$ign = 'Ligada';
					$movi = 'EM MOVIMENTO';
					$apeed1 = $speed;
					$cor_ign = '#009900';
					$cor_ign2 = 'success';
					$icon_ign = 'ign_on.jpg';
				} else if ($ignicao == 'true' && $speed <= 5){
					$ign = 'Ligada';
					$movi = 'PARADO';
					$apeed1 = $speed;
					$cor_ign = '#F4A460';
					$cor_ign2 = 'warning';
					$icon_ign = 'ign_stop.jpg';
				} else {
					$ign = 'Desligada';
					$movi = '';
					$apeed1 = '0.00';
					$cor_ign = '#000';
					$cor_ign2 = 'dark';
					$icon_ign = 'ign_off.jpg';
				}
				
				if($bloqueio == 'SIM'){
					$status_bloqueio = '<h3><span class="badge" style="background-color:#CD5C5C; color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Veículo Bloqueado"><i class="fas fa-lock"></i></span></h3>';
					$cor_block = '#CD5C5C';
					$icon_block = '<i class="fas fa-lock fa-2x" style="color:#990000;"></i>';
					$nome_block = 'Ativo';
				}
				if($bloqueio != 'SIM'){
					$status_bloqueio = '<h3><span class="badge" style="background-color:#009900; color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Veículo Desbloqueado"><i class="fas fa-lock-open"></i></span></h3>';
					$cor_block = '#009900';
					$icon_block = '';
					$nome_block = 'Desativado';
				}
				
				$base64 = 'deviceid:'.$deviceid;
				$base64 = base64_encode($base64);
				
				
				
						$sql = mysqli_query($conn, "SELECT * FROM tc_positions WHERE id='$positionid'");
							if(mysqli_num_rows($sql) > 0){
						while ($resp_sql = mysqli_fetch_assoc($sql)) {
								$km_1 = $resp_sql['attributes'];
								$obj_km1 = json_decode($km_1);
								$km_1 = $obj_km1->{'totalDistance'};;
							}}
							
							$sql1 = mysqli_query($conn, "SELECT * FROM tc_positions WHERE id='$pos_inicial'");
							if(mysqli_num_rows($sql1) <= 0){
								$km_2 = 0;
							}
							if(mysqli_num_rows($sql1) > 0){
						while ($resp_sql1 = mysqli_fetch_assoc($sql1)) {
								$km_2 = $resp_sql1['attributes'];
								$obj_km2 = json_decode($km_2);
								$km_2 = $obj_km2->{'totalDistance'};;
							}}
							
							$totalkm = $km_1 - $km_2;
							$totalkm = $totalkm / 1000;
							$totalkm = round($totalkm, 2);
							$totalkm = number_format($totalkm, 2, ",", ".");
						
				
				?>

			<div class="card card-style">
				<div class="content">
				<a href="grid_device.php?deviceid=<?php echo $deviceid?>&id=<?php echo $id_push?>" onclick="carregar()">
					<div class='alert alert-<?php echo $cor_ign2?>' role='alert'>
						<div class="row mt-1 mb-0">
							
							<div class="col-10">
								<h5><?php echo $placa?></h5>
								<h5><?php echo $marca_veiculo?> / <?php echo $modelo_veiculo?></h5>
							</div>
							<div class="col-2 text-right">
								<i class="fa fa-angle-right fa-2x"></i>
							</div>
							
						</div>
					</div>
					</a>
					<div class="row">
						<div class="col-12 d-flex flex-row align-items-center">
							<div class="p-1 mr-1">
							   <i class="fas fa-map-marker-alt fa-2x"></i>
							</div>
							<div>
								<span style="font-size:12px"><?php echo $address?></span>
							</div>
						</div>
						
					</div>
					 <div class="row text-center">
						<div class="col-3 align-items-center">
							<span class="text-center">
								<a href="#" class="btn btn-xxs rounded-s font-900 shadow-s bg-<?php echo $cor_ign2?> color-white"  data-toast="notification-2"><i class="fas fa-key"></i></a><br>
								<span style="font-size:11px"><b>Ignição</b><br><?php echo $ign?></span>
							</span>
						</div>
						<div class="col-3 align-items-center">
							<span class="text-center">
								<a href="#" class="btn btn-xxs rounded-s font-900 shadow-s bg-dark color-white"><i class="fas fa-tachometer-alt"></i></a><br>
								<text style="font-size:11px"><b>Velocidade</b><br><?php echo $apeed1?> Km/h</text>
							</span>
						</div>
						<div class="col-3 align-items-center">
							<span class="text-center">
								<a href="#" class="btn btn-xxs rounded-s font-900 shadow-s bg-success color-white"><i class="fas fa-lock-open"></i></a><br>
								<span style="font-size:11px"><b>Bloqueio</b><br><?php echo $nome_block; ?></span>
							</span>
						</div>
						<div class="col-3 align-items-center">
							<span class="text-center">
								<a href="#" class="btn btn-xxs rounded-s font-900 shadow-s bg-dark color-white"><i class="fas fa-road"></i></a><br>
								<span style="font-size:11px"><b>Km dia</b><br><?php echo $totalkm; ?> km</span>
							</span>
						</div>
						
					</div>
					<div class="row">
						<div class="col-12 text-center">
							<i class="far fa-clock"></i> <?php echo $lastupdate_data; ?> - <?php echo $lastupdate_hora; ?>
						</div>
					</div>
				</div>
			</div>
			

				
							
							
				<?php
					}}?>
        
       

        
        
        <div id="snackbar-1" class="snackbar-toast bg-highlight color-white" data-delay="60000" data-autohide="false"><i class="fa fa-sync fa-spin mr-3"></i>Carregando veículo</div>
        <div id="snackbar-2" class="snackbar-toast bg-highlight color-white" data-delay="60000" data-autohide="false"><i class="fa fa-sync fa-spin mr-3"></i>Aguarde</div>
        <!-- footer and footer card-->
        
    </div>    
    <!-- end of page content-->
    <form id="forml" action="index1.php?id=<?php echo $id_push?>" method="post">
	
	
	<div id="menu-forgot" class="menu menu-box-bottom menu-box-detached rounded-m" 
         data-menu-height="320" 
         data-menu-effect="menu-over">
        <div class="content mb-0">
            <h1 class="font-700 mb-0">Buscar Veículo</h1>
            <p class="font-11  mt-n1 mb-0">
               Digite a placa ou modelo abaixo.
            </p>
			<br>
            <div class="input-style has-icon input-style-1 input-required">
                <i class="input-icon fa fa-car font-16"></i>
                <input type="text" name="dados" id="dados" placeholder="Placa ou Modelo">
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
