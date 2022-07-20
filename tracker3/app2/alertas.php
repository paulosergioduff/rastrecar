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

$cons_cliente = mysqli_query($conn, "SELECT * FROM clientes WHERE id_cliente = '$id_cliente_login'");
	if(mysqli_num_rows($cons_cliente) > 0){
while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {

$migrado = 	$resp_cliente['migrado'];
$status_cliente = 	$resp_cliente['status'];
$telefone_celular = 	$resp_cliente['telefone_celular'];
$telefone_celular = substr_replace($telefone_celular, '****', 7, 5);
	

	}}



$nome_empesa = 'JC Rastreamento';

$cons_veiculo = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE deviceid = '$deviceid'");
	if(mysqli_num_rows($cons_veiculo) > 0){
		while ($resp_veiculos = mysqli_fetch_assoc($cons_veiculo)) {
		$placa = 	$resp_veiculos['placa'];
		$modelo_veiculo = 	$resp_veiculos['modelo_veiculo'];
		$marca_veiculo = 	$resp_veiculos['marca_veiculo'];
		$alerta_velocidade = $resp_veiculos['alerta_velocidade'];
		$alerta_ign = $resp_veiculos['alerta_ign'];
		$alerta_bateria = $resp_veiculos['alerta_bateria'];
		$alerta_bateria_baixa = $resp_veiculos['alerta_bateria_baixa'];
		$limite_velocidade = 	$resp_veiculos['limite_velocidade'];
		$modelo_img = str_replace(' ', '_', $modelo_veiculo);
	}}
	
		if($alerta_velocidade == 'SIM'){
			$alerta_velocidade1 = 'checked';
			$display = 'block';
		} else {
			$alerta_velocidade1 = '';
			$display = 'none';
		}

		if($alerta_ign == 'SIM'){
			$alerta_ign1 = 'checked';
		} else {
			$alerta_ign1 = '';
		}

		if($alerta_bateria == 'SIM'){
			$alerta_bateria1 = 'checked';
		} else {
			$alerta_bateria1 = '';
		}

		if($alerta_bateria_baixa == 'SIM'){
			$alerta_bateria_baixa1 = 'checked';
		} else {
			$alerta_bateria_baixa1 = '';
		}
		
		
		if($limite_velocidade < 1){
			$lim_vel = 'Selecione';
		} else {
			$lim_vel = ''.$limite_velocidade.' Km/h';
		}

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
        <a href="#" class="header-title">Alertas</a>
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
                <div class="row">
					<div class="col-12">
						<h5><?php echo $placa?></h5>
							<h5><?php echo $marca_veiculo?> / <?php echo $modelo_veiculo?></h5>
						 <input type="hidden" id="deviceid" name="deviceid" value="<?php echo $deviceid?>">
						<input type="hidden" id="id_push" name="id_push" value="<?php echo $id_push?>">
					</div>
				</div>
				
            </div>
        </div> 
		<div class="card card-style shadow-xl">        
            <div class="content">
                <div class="row">                
					<div class="col-10">
						<h5 class="font-600 font-14">
						<a href="#" class="btn btn-xxs rounded-s font-900 shadow-s bg-red-dark"><i class="fas fa-car-battery fa-2x"></i></a> Falha bateria veículo</h5>
					</div>
					<div class="col-2">
						<div class="custom-control ios-switch ios-switch-icon">
							<input type="checkbox" onchange="marcar_bat();" class="ios-input" id="bateria_removida" value="SIM" <?php echo $alerta_bateria1?>>
							<label class="custom-control-label" for="bateria_removida"></label>
							<i class="fa fa-check font-11 color-white"></i>
							<i class="fa fa-times font-11 color-white"></i>
						</div>
					</div>
				</div>
				<div class="row">                    
						<div class="col-10">
							<h5 class="font-600 font-14">
							<a href="#" class="btn btn-xxs rounded-s font-900 shadow-s bg-blue-dark"><i class="fas fa-key fa-2x"></i></a> Alerta Ignição</h5>
						</div>
						<div class="col-2">
							<div class="custom-control ios-switch ios-switch-icon">
								<input type="checkbox" onchange="marcar_ign();" class="ios-input" id="alerta_ignicao" value="SIM" <?php echo $alerta_ign1?>>
								<label class="custom-control-label" for="alerta_ignicao"></label>
								<i class="fa fa-check font-11 color-white"></i>
								<i class="fa fa-times font-11 color-white"></i>
							</div>
							</div>
					</div>

				<div class="row">                   
					<div class="col-10">
						<h5 class="font-600 font-14">
						<a href="#" class="btn btn-xxs rounded-s font-900 shadow-s bg-red-dark"><i class="fas fa-tachometer-alt fa-2x"></i></a> Excesso de Velocidade</h5>
					</div>
					<div class="col-2">
						<div class="custom-control ios-switch ios-switch-icon">
							<input type="checkbox" onchange="marcar_veloc();" class="ios-input" id="alerta_velocidade" value="SIM" <?php echo $alerta_velocidade1?>>
							<label class="custom-control-label" for="alerta_velocidade"></label>
							<i class="fa fa-check font-11 color-white"></i>
							<i class="fa fa-times font-11 color-white"></i>
						</div>
					</div>
				</div>
				<div class="row" id="velocidade" style="display:<?php echo $display?>;">
					<div class="col-1">
					
					</div>
					<div class="col-11 ">
					<label>Limite de Velocidade</label>
					 <select class="form-control" onchange="marcar_veloc1();" name="limite_velocidade" id="limite_velocidade" style="width: 90%; height: 38px;" >
						<option value="<?php echo $limite_velocidade?>"><?php echo $lim_vel?> </option>
						<option value="60">60 Km/h</option>
						<option value="80">80 Km/h</option>
						<option value="100">100 Km/h</option>
						<option value="120">120 Km/h</option>
					 </select>
					</div>
				</div>
            </div>
        </div> 
    
	
	
	

        <!-- footer and footer card-->
        
    </div>    
    <!-- end of page content-->
    
	<div id="notification-2" data-dismiss="notification-2" data-delay="3000" data-autohide="true" class="notification notification-android bg-dark1-dark">
		<i class="fa fa-check bg-green1-dark"></i>
		<h1 class="font-20 color-white">Alerta Ignição Ativado</h1>
		<strong><?php echo date('H:i')?></strong>
		<p class="pb-0">
		Quando ligar/desligar a Ignição, será enviado um alerta.
		</p>
	   
	</div> 

	
	
	
	
		<div id="notification-3" data-dismiss="notification-2" data-delay="3000" data-autohide="true" class="notification notification-android bg-dark1-dark">
			<i class="fa fa-check bg-dark"></i>
			<h1 class="font-20 color-white">Alerta Ignição Desativado</h1>
			<strong><?php echo date('H:i')?></strong>
			<p class="pb-0">
			Não será emitido nenhum alerta de ignição.
			</p>
		   
		</div> 
		
		 <div id="notification-4" data-dismiss="notification-2" data-delay="3000" data-autohide="true" class="notification notification-android bg-dark1-dark">
			<i class="fa fa-check bg-green-dark"></i>
			<h1 class="font-20 color-white">Alerta Bateria Ativado</h1>
			<strong><?php echo date('H:i')?></strong>
			<p class="pb-0">
			Se houver violação ou queda de tensão, será enviado alerta.
			</p>
		   
		</div>  
		<div id="notification-5" data-dismiss="notification-2" data-delay="3000" data-autohide="true" class="notification notification-android bg-dark1-dark">
			<i class="fa fa-check bg-dark"></i>
			<h1 class="font-20 color-white">Alerta Bateria Desativado</h1>
			<strong><?php echo date('H:i')?></strong>
			<p class="pb-0">
			Não será emitido nenhum alerta de bateria. Orientamos a deixar este alerta ativado.
			</p>
		   
		</div> 
		
		 <div id="notification-6" data-dismiss="notification-2" data-delay="3000" data-autohide="true" class="notification notification-android bg-dark1-dark">
			<i class="fa fa-check bg-green-dark"></i>
			<h1 class="font-20 color-white">Alerta Velocidade Ativado</h1>
			<strong><?php echo date('H:i')?></strong>
			<p class="pb-0">
			Se exceder o limite de velocidade, será emitido alerta.
			</p>
		   
		</div>  
		<div id="notification-7" data-dismiss="notification-2" data-delay="3000" data-autohide="true" class="notification notification-android bg-dark1-dark">
			<i class="fa fa-check bg-dark"></i>
			<h1 class="font-20 color-white">Alerta Velocidade Desativado</h1>
			<strong><?php echo date('H:i')?></strong>
			<p class="pb-0">
			Não será emitido nenhum alerta de velocidade.
			</p>
		   
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
	function marcar_ign(){
		var alerta_ignicao =  document.getElementById('alerta_ignicao').value;
		var deviceid =  document.getElementById('deviceid').value;
		if($('#alerta_ignicao').is(":checked")){
			var ign = 'SIM';
			var toastID = document.getElementById('notification-2');
			toastID = new bootstrap.Toast(toastID);
			toastID.show();
		} else {
			var ign = 'NAO';
			var toastID = document.getElementById('notification-3');
			toastID = new bootstrap.Toast(toastID);
			toastID.show();
		}
		$.ajax({
		 method: "POST",
		 url: "include/ativar_ign.php",
		 data: {alerta_ignicao: ign, deviceid: deviceid}
		})
		
	}

	function marcar_bat(){
		var bateria_removida =  document.getElementById('bateria_removida').value;
		var deviceid1 =  document.getElementById('deviceid').value;
		if($('#bateria_removida').is(":checked")){
			var bateria = 'SIM';
			var toastID = document.getElementById('notification-4');
			toastID = new bootstrap.Toast(toastID);
			toastID.show();
		} else {
			var bateria = 'NAO';
			var toastID = document.getElementById('notification-5');
			toastID = new bootstrap.Toast(toastID);
			toastID.show();
		}
		$.ajax({
		 method: "POST",
		 url: "include/ativar_bat.php",
		 data: {bateria_removida: bateria, deviceid: deviceid1}
		})
	}
	
	function marcar_veloc(){
		var alerta_velocidade =  document.getElementById('alerta_velocidade').value;
		var deviceid3 =  document.getElementById('deviceid').value;
		if($('#alerta_velocidade').is(":checked")){
			var veloc = 'SIM';
			document.getElementById('velocidade').style.display = 'block';
		} else {
			var veloc = 'NAO';
			document.getElementById('velocidade').style.display = 'none';
			var toastID = document.getElementById('notification-7');
			toastID = new bootstrap.Toast(toastID);
			toastID.show();
			$.ajax({
			 method: "POST",
			 url: "include/ativar_veloc1.php",
			 data: {deviceid: deviceid3}
			})
		}
	}
	
	function marcar_veloc1(){
		var alerta_velocidade1 =  document.getElementById('alerta_velocidade').value;
		var deviceid2 =  document.getElementById('deviceid').value;
		var limite_velocidade =  document.getElementById('limite_velocidade').value;
		
		$.ajax({
		 method: "POST",
		 url: "include/ativar_veloc.php",
		 data: {deviceid: deviceid2, limite_velocidade: limite_velocidade}
		})
		var toastID = document.getElementById('notification-6');
		toastID = new bootstrap.Toast(toastID);
		toastID.show();
	}
</script>
</body>
