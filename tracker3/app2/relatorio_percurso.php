<?php 
include_once("conexao.php");

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
$permite_bloqueio = 	$resp_user['permite_bloqueio'];

	}}

$cons_veiculo = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE deviceid = '$deviceid'");
	if(mysqli_num_rows($cons_veiculo) > 0){
		while ($resp_veiculos = mysqli_fetch_assoc($cons_veiculo)) {
		$placa = 	$resp_veiculos['placa'];
		$modelo_veiculo = 	$resp_veiculos['modelo_veiculo'];
		$marca_veiculo = 	$resp_veiculos['marca_veiculo'];
		$modelo_img = str_replace(' ', '_', $modelo_veiculo);
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
        <a href="index.html" class="header-title"><?php echo $nome_url?></a>
        <a href="#" data-menu="menu-main" class="header-icon header-icon-1"><i class="fas fa-bars"></i></a>
        <a href="#" data-toggle-theme class="header-icon header-icon-2 show-on-theme-dark"><i class="fas fa-sun"></i></a>
        <a href="#" data-toggle-theme class="header-icon header-icon-2 show-on-theme-light"><i class="fas fa-moon"></i></a>
        <a href="#" data-menu="menu-highlights" class="header-icon header-icon-3"><i class="fas fa-brush"></i></a>
    </div>
    <div id="footer-bar" class="footer-bar-5">
         <a href="perfil.php?id=<?php echo $id_push?>" onclick="carregar();"><i class="fas fa-user-circle"></i><span>Perfil</span></a>
        <a href="faturas.php?id=<?php echo $id_push?>" onclick="carregar();"><i class="fas fa-file-invoice-dollar"></i><span>Faturas</span></a>
        <a href="index.php?id=<?php echo $id_push?>" onclick="carregar();" class="active-nav"><i class="fas fa-car"></i><span>Veículos</span></a>
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
                <h3>Relatório Percurso</h3>
				<p>Este relatório irá demonstrar o percurso realizado pelo veículo, com endereço, velocidade e status de Ignição. Selecione o período desejado. Para períodos maiores, por favor, acesse o sistema web.</p>
            </div>
			
        </div>
       <div class="card card-style shadow-xl">        
            <div class="content">
                <div class="row">
					
					<div class="col-10">
						<h5><?php echo $placa?></h5>
						<h5><?php echo $marca_veiculo?> / <?php echo $modelo_veiculo?></h5>
					</div>
					 <input type="hidden" id="deviceid" name="deviceid" value="<?php echo $deviceid?>">
					<input type="hidden" id="id_push" name="id_push" value="<?php echo $id_push?>">
				</div>
				<hr style="border:#999 1px solid;">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label>Período:</label>
							<select class="form-control" name="data_inicial" id="data_inicial">
								<option value="2">Últimas 2 horas</option>
								<option value="4">Últimas 4 horas</option>
								<option value="8">Últimas 8 horas</option>
								<option value="12">Últimas 12 horas</option>
								<option value="24">Últimas 24 horas</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<button type="button" id="bt-iniciar" onclick="carregar();" class="btn btn-dark" style="width:100%">Gerar Relatório</button>
						</div>
					</div>
				</div><br><br>
				
            </div>
        </div> 
		
    
	
	
	

        <!-- footer and footer card-->
        
    </div>    
    <!-- end of page content-->
    

	

	
	<div id="aguarde" class="menu menu-box-modal rounded-m" 
         data-menu-height="200" 
         data-menu-width="310">
        <h1 class="text-center mt-3 pt-1"><i class="fa fa-sync fa-spin mr-3 fa-2x"></i></h1>
        
        <p class="boxed-text-l" id="informa">
            Gerando Relatório...
        </p>
		<p class="boxed-text-l">
            <progress max="100" id="myBar" value="0" class="progressBar" style="height:20px"></progress>
		</div>
		<div ></div>
		
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript" src="scripts/bootstrap.min.js"></script>
<script type="text/javascript" src="scripts/custom.js"></script>

<script>
	function carregar(){
		$('#aguarde').showMenu();

		
		var device_id = document.getElementById("deviceid").value;
		var data_ini = document.getElementById("data_inicial").value;
		var id_push = document.getElementById("id_push").value;
		location.href = "relatorio_percurso1.php?deviceid="+device_id+"&data_inicial="+data_ini+"&id_push="+id_push;
	}
	function carregar2(){
	$('#aguarde').showMenu();
	$('#menu-main').hideMenu();
}
</script>
<script>
document.getElementById('bt-iniciar').addEventListener('click', iniciarProgressBar);

function iniciarProgressBar(){
    var bar = document.getElementById("myBar");  
    bar.value = 0;
    adicionarDezPorcento();
}

function adicionarDezPorcento() {
  var bar = document.getElementById("myBar");
  bar.value += 5;
  
  if(bar.value == 30) { 
    // aos 30%, esperar 3 segundos
    setTimeout(adicionarDezPorcento, 5000); 
	$('#informa').html('Gerando Relatório...');
  }
  else if(bar.value < 100) {
    setTimeout(adicionarDezPorcento, 4000);
	$('#informa').html('Gerando Relatório');
  }
  else if(bar.value >= 100) {
    $('#informa').html('Aguarde...');
  }
};
</script>

</body>
