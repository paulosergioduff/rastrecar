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
$id_push = $_REQUEST['id_push'];

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


$nome_empesa = 'JC Rastreamento';

$data_ini = $_REQUEST['data_inicial'];


$date = date('Y-m-d H:i:s');
$data_final = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($date)));

if($data_ini == '2'){
	$data_inic  =  date('Y-m-d H:i:s', strtotime('-2 hour', strtotime($date)));
}
if($data_ini == '4'){
	$data_inic  =  date('Y-m-d H:i:s', strtotime('-4 hour', strtotime($date)));
}
if($data_ini == '8'){
	$data_inic  =  date('Y-m-d H:i:s', strtotime('-8 hour', strtotime($date)));
}
if($data_ini == '12'){
	$data_inic  =  date('Y-m-d H:i:s', strtotime('-12 hour', strtotime($date)));
}
if($data_ini == '24'){
	$data_inic  =  date('Y-m-d H:i:s', strtotime('-24 hour', strtotime($date)));
}
if($data_ini == '48'){
	$data_inic  =  date('Y-m-d H:i:s', strtotime('-48 hour', strtotime($date)));
}


$data_inicial = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_inic)));
$data_inicial2 = date('d/m/Y H:i', strtotime("$data_inic"));
$data_final2 = date('d/m/Y H:i', strtotime("$date"));

$cons_veiculo = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE deviceid = '$deviceid'");
if(mysqli_num_rows($cons_veiculo) > 0){
	while ($resp_veiculos = mysqli_fetch_assoc($cons_veiculo)) {
	$placa = 	$resp_veiculos['placa'];
	$modelo_veiculo = 	$resp_veiculos['modelo_veiculo'];
	$marca_veiculo = 	$resp_veiculos['marca_veiculo'];
	$veiculo_nome = $placa.' - '.$marca_veiculo.'/'.$modelo_veiculo;
}}

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
         <a href="perfil.php?id=<?php echo $id_push?>" onclick="carregar();"><i class="fas fa-user-circle"></i><span>Perfil</span></a>
        <a href="faturas.php?id=<?php echo $id_push?>" onclick="carregar();"><i class="fas fa-file-invoice-dollar"></i><span>Faturas</span></a>
        <a href="index.php?id=<?php echo $id_push?>" onclick="carregar();" class="active-nav"><i class="fas fa-car"></i><span>Veículos</span></a>
        <a href="#" data-menu="menu-main"><i class="fa fa-bars"></i><span>Menu</span></a>
    </div>
    
    <div class="page-content">
        
        <div class="page-title page-title-large">
            <h2><a href="#" class="color-white" data-back-button><i class="fa fa-arrow-left"></i> Voltar</a> </h2><br>
            <a href="#" data-menu="menu-main" class="bg-fade-gray1-dark shadow-xl preload-img" data-src="../images/avatars/5s.png"></a>
        </div>
        <div class="card header-card shape-rounded" data-card-height="210">
            <div class="card-overlay bg-highlight opacity-95"></div>
            <div class="card-overlay dark-mode-tint"></div>
            <div class="card-bg preload-img" data-src="../images/pictures/20s.jpg"></div>
        </div>
        

        <!-- Homepage Slider-->
        
		 <div class="card card-style shadow-xl">        
            <div class="content">
                <h3>Relatório Eventos</h3>
				<p><?php echo $veiculo_nome?></p>
            </div>
			
        </div>
      <div class="row">
							<div class="col-md-12">
								<?php
						
						
							$cons_conta = mysqli_query($conn,"SELECT * FROM tc_events WHERE deviceid='$deviceid' AND (eventtime >= '$data_inicial' AND eventtime <= '$data_final') ORDER BY id DESC");
							$total = mysqli_num_rows($cons_conta);
								if(mysqli_num_rows($cons_conta) > 0){
									
									


						
							$i = $total;
						while ($row_ev = mysqli_fetch_assoc($cons_conta)) {
							--$i;
									$positionid = $row_ev['positionid'];
									$geofenceid = $row_ev['geofenceid'];
									$horario_alarme = $row_ev['eventtime'];
									$horario_alarme = date('d/m/Y H:i:s', strtotime('-3 hour', strtotime($horario_alarme)));
									$eventos = $row_ev['attributes'];
									$eventos1 = json_decode($eventos);
									$alarme = $eventos1->{'alarm'};
									$type = $row_ev['type'];
									$speed1 = $eventos1->{'speed'};
									$speed1 = $speed1 + 1.609;
									$speed1 = round($speed1, 2);
								
								if($type == 'deviceOverspeed'){
									$notific = '<h3><span class="badge badge-warning"><i class="fas fa-tachometer-alt"></i> <b>EXC. VELOCIDADE</b></span></h3>';
									$cor = 'red';
								}

								if($type == 'ignitionOn'){
									$notific = '<h3><span class="badge" style="background-color:#009900;color:#FFF"><i class="fas fa-key"></i> <b>IGNIÇÃO LIGADA</b></span></h3>';
									$cor = 'green';									
								} 
								if($type == 'ignitionOff'){
									$notific = '<h3><span class="badge" style="background-color:#000;color:#FFF"><i class="fas fa-key"></i> <b>IGNIÇÃO DESLIGADA</b></span></h3>';
									$cor = 'black';
								}
								
								if($alarme == 'powerCut' && $type == 'alarm'){
									$notific = '<h3><span class="badge" style="background-color:#CD5C5C;color:#FFF"><i class="fas fa-car-battery"></i> <b>FALHA BATERIA VEICULO</b></span></h3>';
									$cor = 'red';
								}
								if($alarme == 'shock' && $type == 'alarm' ){
									$notific = '<h3><span class="badge" style="background-color:#CD5C5C;color:#FFF"><i class="fas fa-bell"></i> <b>ALARME SENSOR MOV.</b></span></h3>';
									$cor = 'red';
								}
								
								if($alarme == 'door' && $type == 'alarm'){
									$notific = '<h3><span class="badge" style="background-color:#CD5C5C;color:#FFF"><i class="fas fa-bell"></i> <b>ALARME SENSOR PORTAS</b></span></h3>';
									$cor = 'red';
								}
								if($alarme == null && $type == 'geofenceExit'){
									$cons_fence = mysqli_query($conn,"SELECT * FROM tc_geofences WHERE id='$geofenceid'");
								if(mysqli_num_rows($cons_fence) > 0){
							while ($row_fence = mysqli_fetch_assoc($cons_fence)) {
								$name_cerca = $row_fence['name'];
								$description = $row_fence['description'];
								if($description == 'ANCORA'){
									$tipo = '<h3><span class="badge" style="background-color:#CD5C5C;color:#FFF"><i class="fas fa-anchor"></i> <b>ANCORA VIOLADA</b></span></h3>';
									$cor = 'red';
								} else {
									$tipo = '<h3><span class="badge" style="background-color:#CD5C5C;color:#FFF"><i class="fas fa-anchor"></i> <b><i class="fas fa-bell"></i> SAIDA CERCA '.$name_cerca.'</b></span></h3>';
									$cor = 'black';
								}
								
									$notific = $tipo;
								}}}
								if($alarme == null && $type == 'geofenceEnter'){
									$tipo = '<h3><span class="badge" style="background-color:#CD5C5C;color:#FFF"><i class="fas fa-anchor"></i> <b><i class="fas fa-bell"></i> ENTRADA CERCA '.$name_cerca.'</b></span></h3>';
									$cor = 'black';
								}

								
								
															
								$cons_position = mysqli_query($conn,"SELECT * FROM tc_positions WHERE id='$positionid'");
							
								if(mysqli_num_rows($cons_position) > 0){
										while ($resp_posi = mysqli_fetch_assoc($cons_position)) {
											
								$id_pos = $resp_posi['id'];
								
								$speed = 	$resp_posi['speed'];
								$speed = $speed * 1.609;
								$speed = round($speed, 2);
								
								if($type == 'ignitionOff'){
									$speed2 = '0.00';
								}
								if($type == 'ignitionOn'){
									$speed2 = $speed;
								}
								
								
								$address = $resp_posi['address'];
								
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
						?>
								
															
								<div class="card card-style">
									<div class="content">
										<?php echo $notific?>
										<h6><i class="fas fa-map-marker-alt"></i> <?php echo $address; ?></h6><br>
										<h6><i class="fas fa-tachometer-alt"></i> <?php echo $speed2; ?> km/h</h6>	
										<h6><i class="far fa-clock"></i> <?php echo $horario_alarme?></h6>	
									</div>
								</div>


								<?php }}}} else {
									echo '<div class="callout callout-warning">
							  <h5><i class="fas fa-exclamation-triangle"></i> ATENÇÃO:</h5>
							  <p>Sem Notificações no período selecionado</p>
							</div>';
								}?>
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
<script type="text/javascript" src="../scripts/jquery.js"></script>
<script type="text/javascript" src="../scripts/bootstrap.min.js"></script>
<script type="text/javascript" src="../scripts/custom.js"></script>

<script>
	function carregar(){
		$('#aguarde').showMenu();

		
		var device_id = document.getElementById("deviceid").value;
		var data_ini = document.getElementById("data_inicial").value;
		var id_push = document.getElementById("id_push").value;
		location.href = "relatorio_eventos1.php?deviceid="+device_id+"&data_inicial="+data_ini+"&id_push="+id_push;
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
