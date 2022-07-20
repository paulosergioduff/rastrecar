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

	}}



$nome_empesa = 'JC Rastreamento';

$id_empresa = '1361';

$result_usuario = "SELECT * FROM tc_devices WHERE id='$deviceid'";
					$resultado_usuario = mysqli_query($conn, $result_usuario);


					//Verificar se encontrou resultado na tabela "usuarios"
					if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
			while($row_usuario = mysqli_fetch_assoc($resultado_usuario)){
				$id_device = $row_usuario['id'];
				$name = $row_usuario['name'];
				$positionid = $row_usuario['positionid'];
				$category = 	$row_usuario['category'];

				
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
				$devicetime = 	$resp_cliente['devicetime'];
				$latit = 	$resp_cliente['latitude'];
				$longit = 	$resp_cliente['longitude'];
				
				$speed = 	$resp_cliente['speed'];
				
				
				$speed = $speed * 1.609;
				$speed = round($speed, 2);
				$attributes = $resp_cliente['attributes'];
				$obj = json_decode($attributes);
				$ignicao = $obj->{'ignition'};
				if (is_bool($ignicao)) $ignicao ? $ignicao = "true" : $ignicao = "false";
				else if ($ignicao !== null) $ignicao = (string)$ignicao;
				

				
				if($ignicao == 'true' && $speed >= 6){
					$ign = 'LIGADO';
					$movi = '';
					$apeed1 = $speed;
					$cor_ign = 'success';
					$cor_ign2 = '#E7EEE3';
				} else if ($ignicao == 'true' && $speed <= 5){
					$ign = 'LIGADO';
					$movi = 'PARADO';
					$apeed1 = $speed;
					$cor_ign = 'warning';
					$cor_ign2 = '#FBF0E1';
				} else {
					$ign = 'DESLIGADO';
					$movi = '';
					$apeed1 = '0.00';
					$cor_ign = 'dark';
					$cor_ign2 = '#EBEBEB';
				}
				
				$cons_veiculo = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE deviceid='$id_device' ");
					if(mysqli_num_rows($cons_veiculo) > 0){
				while ($resp_veiculo = mysqli_fetch_assoc($cons_veiculo)) {
				$placa = 	$resp_veiculo['placa'];
				$bloqueio = 	$resp_veiculo['bloqueio'];
				$alarme_veic = 	$resp_veiculo['alarme'];
				$status_alarme = 	$resp_veiculo['status_alarme'];
				$marca_veiculo = 	$resp_veiculo['marca_veiculo'];
				$modelo_veiculo = 	$resp_veiculo['modelo_veiculo'];
				//$modelo_img = str_replace(' ', '_', $modelo_veiculo);
				$imei = 	$resp_veiculo['imei'];
				$chip = 	$resp_veiculo['chip'];
				$operadora = 	$resp_veiculo['operadora'];
				$fornecedor_chip = 	$resp_veiculo['fornecedor_chip'];
				$modelo_equip = 	$resp_veiculo['modelo_equip'];
				$odometro = 	$resp_veiculo['odometro'];
				$veic_volts = 	$resp_veiculo['volts'];
				$veic_satelite = 	$resp_veiculo['satelite'];
				$veic_gsm = 	$resp_veiculo['gsm'];
				$veic_bateria_interna = 	$resp_veiculo['bateria_interna'];
				
				if($bloqueio == 'SIM'){
					$status_bloqueio = 'BLOQUEADO';
					$cor_block = '#CD5C5C';
					$icon_block = '<i class="fas fa-lock fa-2x" style="color:#CD5C5C"></i>';
				}
				if($bloqueio != 'SIM'){
					$status_bloqueio = 'DESBLOQUEADO';
					$cor_block = '#009900';
					$icon_block = '<i class="fas fa-lock-open fa-2x" style="color:#000"></i>';
				}
				
			}}}}}}
			
		$cons_ancora = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE deviceid = '$deviceid'");
					if(mysqli_num_rows($cons_ancora) > 0){
				while ($resp_anc = mysqli_fetch_assoc($cons_ancora)) {
				$ancora = 	$resp_anc['ancora'];
				$geofenceid = 	$resp_anc['geofenceid'];	
				
				$sql1 = mysqli_query($conn, "SELECT * FROM tc_geofences WHERE id='$geofenceid'");
			if(mysqli_num_rows($sql1) > 0){
				while ($resp = mysqli_fetch_assoc($sql1)) {
				$area = 	$resp['area'];
				$posicao = strpos($area,"(-");
				$resultado = substr($area,$posicao);
				$area = str_replace('(', '', $resultado);
				$area = str_replace(')', '', $area);
				$area = str_replace(',', '', $area);
				$area = str_replace(' ', ',', $area);
				$area1 = explode(",", $area);
				$anc_lat = $area1[0];
				$anc_long = $area1[1]; 	
				$anc_raio = $area1[2];				
					}}
					
			}}
			
			if($ancora == 'ON'){
				$latitude_ancora = $anc_lat;
				$longitude_ancora = $anc_long;
				$raio_ancora = $anc_raio;
				$info_modal = 'O veiculo está com Âncora ativada.<br>Deseja desativar?';
				$link_ancora = 'comandos/del_ancora.php?deviceid='.$deviceid.'&geofenceid='.$geofenceid.'&id='.$id_push.'&nome_user='.$nome_user.'';
			} else {
				$latitude_ancora = $latit;
				$longitude_ancora =  $longit;
				$raio_ancora = '0.5';
				$info_modal = 'Deseja ativar a Âncora para o veículo?';
				$link_ancora = 'comandos/ancora.php?deviceid='.$deviceid.'&geofenceid='.$geofenceid.'&id='.$id_push.'&nome_user='.$nome_user.'';
			}
		
		
		$cons_cerca = mysqli_query($conn,"SELECT * FROM tc_events WHERE type='geofenceEnter' AND deviceid='$deviceid' ORDER BY id DESC LIMIT 1");
		if(mysqli_num_rows($cons_cerca) > 0){
			while ($row_ev = mysqli_fetch_assoc($cons_cerca)) {
				$deviceid = $row_ev['deviceid'];
				$horario_alarme = $row_ev['servertime'];
				$type = $row_ev{'type'};
				$geofenceid = $row_ev['geofenceid'];
				$id_unico = $row_ev['id'];
				
				$sql11 = mysqli_query($conn, "SELECT * FROM tc_geofences WHERE id='$geofenceid'");
					if(mysqli_num_rows($sql11) > 0){
						while ($resp1 = mysqli_fetch_assoc($sql11)) {
						$name_cerca1 = $resp1['name'];
						$description1 = $resp1['description'];
						$area1 = 	$resp1['area'];
						$posicao1 = strpos($area1,"(-");
						$resultado1 = substr($area1,$posicao1);
						$area1 = str_replace('(', '', $resultado1);
						$area1 = str_replace(')', '', $area1);
						$area1 = str_replace(',', '', $area1);
						$area1 = str_replace(' ', ',', $area1);
						$area1 = explode(",", $area1);
						$anc_lat1 = $area1[0];
						$anc_long1 = $area1[1]; 	
						$anc_raio1 = $area1[2];		

						$latitude_cerca = $anc_lat1;
						$longitude_cerca = $anc_long1;
						$raio_cerca = $anc_raio1;
							}}
							
							

		}}
		$permite_bloqueio = 'SIM';	
		
		if($permite_bloqueio == 'SIM'){
			$botao_bloqueio =  '<a href="#" data-menu="menu-bloqueio" class="circle-nav active-nav"><i class="fas fa-lock"></i><span>Bloqueio</span></a>';
		}
		if($permite_bloqueio != 'SIM'){
			$botao_bloqueio = '';
		}
		
		if($veic_bateria_interna == ''){
						$veic_bateria_interna1 = '100';
					}
					if($veic_bateria_interna != ''){
						$veic_bateria_interna1 = $veic_bateria_interna;
					}
					
					if($veic_gsm == ''){
						$veic_gsm1 = '1';
					}
					if($veic_gsm != ''){
						$veic_gsm1 = $veic_gsm;
					}
					
					if($veic_volts == ''){
						$veic_volts1 = '12.5';
					}
					if($veic_volts != ''){
						$veic_volts1 = $veic_volts;
					}
					
					if($veic_satelite == ''){
						$veic_satelite1 = '1';
					}
					if($veic_satelite != ''){
						$veic_satelite1 = $veic_satelite;
					}
$link1 = 'https://www.google.com/maps?q='.$latit.','.$longit.'&ll='.$latit.','.$longit.'&z=17';

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
<style>
#floating-panel2 {
  position: absolute;
  top: 60px;
  left: 5px;
  z-index: 99999999;
  background-color:  rgb(255, 255, 255, 0);
  padding: 5px;
  text-align: center;
  font-family: 'Roboto','sans-serif';
  line-height: 30px;
  padding-left: 10px;
}
</style>
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
        <a href="#" data-menu="detalhes_device" ><i class="fas fa-mobile"></i><span>Dispositivo</span></a>
		<a href="#" id="teste20" data-menu="detalhes"><i class="fas fa-info-circle"></i><span>Detalhes</span></a>
       <?php echo $botao_bloqueio?>
        <a href="#" data-menu="opcoes"><i class="fas fa-cog"></i><span>Opções</span></a>
        <a href="#" data-menu="menu-main"><i class="fa fa-bars"></i><span>Menu</span></a>
    </div>
    
    <div class="page-content">
        
        <div class="page-title page-title-large">
		<br>
            <h2><a href="#" class="color-white" data-back-button><i class="fa fa-arrow-left"></i> Voltar</a> </h2>
            <a href="#" data-menu="menu-main" class="bg-fade-gray1-dark shadow-xl preload-img" data-src="../images/avatars/5s.png"></a>
        </div>
        <div class="card header-card shape-rounded" data-card-height="210">
            <div class="card-overlay bg-highlight opacity-95"></div>
            <div class="card-overlay dark-mode-tint"></div>
            <div class="card-bg preload-img" data-src="../images/pictures/20s.jpg"></div>
        </div>
        

        <!-- Homepage Slider-->
        
		 <div class="card card-style shadow-xl">        
            <div class="content mt-1 mb-0">
                <div id="top_veiculo">
							<div class="col-12 d-flex flex-row align-items-center">
								<div class="p-1 mr-1">
								   <i class="fas fa-map-marker-alt fa-2x"></i>
								</div>
								<div>
									<label class="fs-sm mb-0"><?php echo $address?></label>
									
								</div>
							</div>
						</div>
            </div>
			<div id="map" style=" height: 78vh;"></div>
			<div id="floating-panel2">
			<br>
			<br>
				<a href="#" onClick="setSatellite();setHybrid1();" class="btn btn-s bg-highlight rounded-xl shadow-xl text-uppercase font-900 font-11 mt-2"><i class="fa fas fa-satellite font-14"></i></a><br>
				<a href="https://www.google.com/maps?layer=c&cbll=<?php echo $latit?>,<?php echo $longit?>" class="btn btn-s bg-highlight rounded-xl shadow-xl text-uppercase font-900 font-11 mt-2"><i class="fas fa-street-view font-14"></i></a><br>
				<a href="/app2/baixar1.php?link=<?php echo $link1?>" class="btn btn-s bg-highlight rounded-xl shadow-xl text-uppercase font-900 font-11 mt-2"><i class="fas fa-map-marked-alt font-14"></i></a><br>
			</div>
        </div>
        
        
		
    
	
	
	
        
        
        <div id="snackbar-1" class="snackbar-toast bg-highlight color-white" data-delay="60000" data-autohide="false"><i class="fa fa-sync fa-spin mr-3"></i>Carregando veículo</div>
        <!-- footer and footer card-->
        
    </div>    
    <!-- end of page content-->
    <div id="detalhes_device" class="menu menu-box-bottom rounded-m"
         data-menu-height="350" 
         data-menu-effect="menu-over">
        <div class="menu-title">
            
            <h1 class="font-20">Informações do Dispositivo</h1>
            <a href="#" class="close-menu"><i class="fa fa-times-circle"></i></a>
        </div><br>
        <div class="content mt-0">
			<div class="row">
				<div class="d-flex rounded-m">
					<div class="me-4">
						<img width="50" class="fluid-img rounded-m shadow-xl" src="imagens/dispositivos/<?php echo $modelo_equip?>.jpg">
					</div>
					
					<div>
						<h5><?php echo $modelo_equip?></h5>
						<h6>Imei: <?php echo $imei?></h6>
					</div>
					
				</div>
			</div>
			<hr style="border:#CCC 1px dashed">
			<div class="row">
				<div class="col-12">
					<div class="row text-center">
						<div class="col-4 align-items-center">
							<span class="text-center">
								<a href="#" class="btn btn-xxs rounded-s font-900 shadow-s bg-dark text-white"><i class="fas fa-sim-card fa-2x"></i></a><br>
								<span style="font-size:11px"><b>Linha</b><br><?php echo $chip?></span>
							</span>
						</div>
						<div class="col-4 align-items-center">
							<span class="text-center">
								<a href="#" class="btn btn-xxs rounded-s font-900 shadow-s bg-dark text-white"><i class="fas fa-home fa-2x"></i></a><br>
								<span style="font-size:11px"><b>Operadora</b><br><?php echo $operadora?></span>
							</span>
						</div>
						<div class="col-4 align-items-center">
							<span class="text-center">
								<a href="#" class="btn btn-xxs rounded-s font-900 shadow-s bg-dark text-white"><i class="fas fa-hotel fa-2x"></i></a><br>
								<span style="font-size:11px"><b>Fornecedor</b><br><?php echo $fornecedor_chip?></span>
							</span>
						</div>
						
					</div>
				</div>
				<div class="col-12">
					<!--<a href="#" data-menu="menu-comandos" class="btn btn-full btn-m shadow-l rounded-s font-600 bg-dark mt-4">Comando SMS</a>-->
				</div>
			</div>
			
        </div>
    </div> 

	
	<div id="menu-bloqueio" class="menu menu-box-bottom menu-box-detached rounded-m"
         data-menu-height="230" 
         data-menu-effect="menu-over">
        <h2 class="text-center font-700 mt-3 pt-1">Bloqueio / Desbloqueio</h2>
        <p class="boxed-text-l">
            Escolha a opção desejada.
        </p>
        <div class="row mr-3 ml-3">
            <div class="col-6">
                <a href="#" data-menu="bloqueio" class="btn btn-sm btn-full button-s shadow-l rounded-s text-uppercase font-900 bg-red2-dark"><i class="fas fa-lock"></i> Bloquear</a>
            </div>
            <div class="col-6">
                <a href="#" data-menu="desbloqueio" class="btn btn-sm btn-full button-s shadow-l rounded-s text-uppercase font-900 bg-green1-dark"><i class="fas fa-lock-open"></i> Desbloquear</a>
            </div>
        </div>
    </div>
	
	

	
	<div id="bloqueio" class="menu menu-box-modal rounded-m" 
         data-menu-height="260" 
         data-menu-width="330">
        <h1 class="text-center mt-3 pt-1"><i class="fa fa-2x fa-lock color-red2-dark shadow-xl rounded-circle"></i></h1>
        <h1 class="text-center mt-3 font-700">Bloquear</h1>
        <p class="boxed-text-l">
            Deseja bloquear o veículo?
        </p>
        <div class="row mr-3 ml-3 mb-0">
            <div class="col-6">
                <a href="#"  class="close-menu btn btn-sm btn-full button-s shadow-l rounded-s text-uppercase font-900 bg-dark1-dark">Cancelar</a>
            </div>
            <div class="col-6">
                <a href="comandos/comandos.php?deviceid=<?php echo $deviceid?>&id=<?php echo $id_push?>&nome_user=<?php echo $nome_user?>&t=BLOQUEIO&model=<?php echo $modelo_equip?>"  onclick="bloqueio();" class="close-menu btn btn-sm btn-full button-s shadow-l rounded-s text-uppercase font-900 bg-blue1-dark">Confirmar</a>
            </div>
        </div>
    </div> 
	
	<div id="ancora-menu" class="menu menu-box-modal rounded-m" 
         data-menu-height="260" 
         data-menu-width="330">
        <h1 class="text-center mt-3 pt-1"><i class="fa fa-2x fa-anchor color-dark1-dark shadow-xl rounded-circle"></i></h1>
        <h1 class="text-center mt-3 font-700">Ancora</h1>
        <p class="boxed-text-l">
           <?php echo $info_modal?>
        </p>
        <div class="row mr-3 ml-3 mb-0">
            <div class="col-6">
                <a href="#"  class="close-menu btn btn-sm btn-full button-s shadow-l rounded-s text-uppercase font-900 bg-dark1-dark">Cancelar</a>
            </div>
            <div class="col-6">
                <a href="<?php echo $link_ancora?>"  onclick="ancora1();" class="close-menu btn btn-sm btn-full button-s shadow-l rounded-s text-uppercase font-900 bg-blue1-dark">Confirmar</a>
            </div>
        </div>
    </div> 
	
	<div id="desbloqueio" class="menu menu-box-modal rounded-m" 
         data-menu-height="260" 
         data-menu-width="330">
         <h1 class="text-center mt-3 pt-1"><i class="fa fa-2x fa-lock-open color-green1-dark shadow-xl rounded-circle"></i></h1>
        <h1 class="text-center mt-3 font-700">Desbloquear</h1>
        <p class="boxed-text-l">
            Deseja desbloquear o veículo?
        </p>
        <div class="row mr-3 ml-3 mb-0">
            <div class="col-6">
                <a href="#"  class="close-menu btn btn-sm btn-full button-s shadow-l rounded-s text-uppercase font-900 bg-dark1-dark">Cancelar</a>
            </div>
            <div class="col-6">
                <a href="comandos/comandos.php?deviceid=<?php echo $deviceid?>&id=<?php echo $id_push?>&nome_user=<?php echo $nome_user?>&t=DESBLOQUEIO&model=<?php echo $modelo_equip?>"  onclick="bloqueio();" class="close-menu btn btn-sm btn-full button-s shadow-l rounded-s text-uppercase font-900 bg-blue1-dark">Confirmar</a>
            </div>
        </div>
    </div>
	
	
	
	
	<div id="opcoes" class="menu menu-box-bottom menu-box-detached rounded-m"
         data-menu-height="330" 
         data-menu-effect="menu-over">
		<h2 class="text-center font-700 mt-3 pt-1">Opções</h2>
        <p class="boxed-text-l">
            Selecione uma das opções abaixo.
        </p>
        <div class="row mr-3 ml-3">
            <div class="col-6">
                <a href="#" data-menu="ancora-menu" class="btn btn-sm btn-full button-s shadow-l rounded-s text-uppercase font-900 bg-blue2-dark"><i class="fas fa-anchor"></i> Âncora</a>
            </div>
            <div class="col-6">
                <a href="relatorio_percurso.php?id=<?php echo $id_push?>&deviceid=<?php echo $deviceid?>" class="btn btn-sm btn-full button-s shadow-l rounded-s text-uppercase font-900 bg-dark1-light" onclick="opcoes1();"><i class="fas fa-road"></i> Percurso</a>
            </div>
        </div>
		<div class="row mr-3 ml-3">
            <div class="col-6">
                <a href="relatorio_eventos.php?id=<?php echo $id_push?>&deviceid=<?php echo $deviceid?>" class="btn btn-sm btn-full button-s shadow-l rounded-s text-uppercase font-900 bg-dark1-light" onclick="opcoes1();"><i class="fas fa-flag"></i> Eventos</a>
            </div>
            <div class="col-6">
                <a href="alertas.php?id=<?php echo $id_push?>&deviceid=<?php echo $deviceid?>" class="btn btn-sm btn-full button-s shadow-l rounded-s text-uppercase font-900 bg-dark1-light" onclick="opcoes1();"><i class="fas fa-bell"></i> Habilitar Alertas</a>
            </div>
        </div>
		<div class="row mr-3 ml-3">
            <div class="col-12">
                <a href="#" data-menu="menu-compartilhar" class="btn btn-sm btn-full button-s shadow-l rounded-s text-uppercase font-900 bg-green2-dark"><i class="fa fa-share-alt"></i> Compartilhar</a>
            </div>
            
        </div>
    </div>
	


	<div id="menu-compartilhar" class="menu menu-box-bottom menu-box-detached rounded-m"
         data-menu-height="330" 
         data-menu-effect="menu-over">
		<h2 class="text-center font-700 mt-3 pt-1">Compartilhar</h2>
        <p class="boxed-text-l">
            O link será válido por 24 horas.
        </p>
        <div class="row mb-0">
                <div class="col-12">
                    <input type="text" class="form-control font-14" value="http://localrast.com.br/compartilhar.php?link=<?php echo $link_base?>"  name="link" id="link">
                </div>
                 
            </div>
    </div>
	
	<div id="detalhes" class="menu menu-box-bottom rounded-m"
         data-menu-height="450" 
         data-menu-effect="menu-over">
        <div class="menu-title">
            
            <h1 class="font-20">Informações do Veículo</h1>
            <a href="#" class="close-menu"><i class="fa fa-times-circle"></i></a>
        </div><br>
        <div class="content mt-0">
			<div class="row">
				<div class="col-1">
					
				</div>
				<div class="col-11">
					<div>
						<h5><?php echo $placa?></h5>
						<h5><?php echo $marca_veiculo?> / <?php echo $modelo_veiculo?></h5>
					</div>
					
				</div>
			</div>
			<hr style="border:#CCC 1px dashed">
			<div class="row">
				<div class="col-12">
					<div id="informacoes">
						<div class="row text-center">
							<div class="col-3 align-items-center">
								<span class="text-center">
									<a href="#" class="btn btn-xxs rounded-s font-900 shadow-s bg-<?php echo $cor_ign?>"><i class="fas fa-key fa-2x color-white"></i></a><br>
									<span style="font-size:11px"><b>Ignição</b><br><?php echo $ign?></span>
								</span>
							</div>
							<div class="col-3 align-items-center">
								<span class="text-center">
									<a href="#" class="btn btn-xxs rounded-s font-900 shadow-s bg-dark"><i class="fas fa-tachometer-alt fa-2x color-white"></i></a><br>
									<text style="font-size:11px"><b>Velocidade</b><br><?php echo $apeed1?> Km/h</text>
								</span>
							</div>
							<div class="col-3 align-items-center">
								<span class="text-center">
									<a href="#" class="btn btn-xxs rounded-s font-900 shadow-s bg-success"><i class="fas fa-lock-open fa-2x color-white"></i></a><br>
									<span style="font-size:11px"><b>Bloqueio</b><br><?php echo $status_bloqueio; ?></span>
								</span>
							</div>
							<div class="col-3 align-items-center">
								<span class="text-center">
									<a href="#" class="btn btn-xxs rounded-s font-900 shadow-s bg-dark"><i class="fas fa-road fa-2x color-white"></i></a><br>
									<span style="font-size:11px"><b>Km dia</b><br><?php echo $totalkm; ?> km</span>
								</span>
							</div>	
						</div>
						<div class="row text-center">
							<div class="col-3 align-items-center">
								<span class="text-center">
									<a href="#" class="btn btn-xxs rounded-s font-900 shadow-s bg-blue-dark"  data-toast="notification-2"><i class="fas fa-battery-full fa-2x"></i></a><br>
									<span style="font-size:11px"><b>Bateria</b><br><?php echo $veic_bateria_interna1?>%</span>
								</span>
							</div>
							<div class="col-3 align-items-center">
								<span class="text-center">
									<a href="#" class="btn btn-xxs rounded-s font-900 shadow-s bg-blue-dark"  data-toast="notification-2"><i class="fas fa-satellite fa-2x"></i></a><br>
									<span style="font-size:11px"><b>Satétiles</b><br><?php echo $veic_satelite1?> Sát.</span>
								</span>
							</div>
							<div class="col-3 align-items-center">
								<span class="text-center">
									<a href="#" class="btn btn-xxs rounded-s font-900 shadow-s bg-blue-dark"  data-toast="notification-2"><i class="fas fa-signal fa-2x"></i></a><br>
									<span style="font-size:11px"><b>Nível GSM</b><br><?php echo $veic_gsm1?>%</span>
								</span>
							</div>
							<div class="col-3 align-items-center">
								<span class="text-center">
									<a href="#" class="btn btn-xxs rounded-s font-900 shadow-s bg-blue-dark"  data-toast="notification-2"><i class="fas fa-car-battery fa-2x"></i></a><br>
									<span style="font-size:11px"><b>Voltagem</b><br><?php echo $veic_volts1?> v</span>
								</span>
							</div>
						</div>
						
					</div>
				</div>
			</div>
			
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
         data-menu-active="nav-welcome"
         data-menu-effect="menu-over">  
    </div>
    
   		 <input type="hidden" id="id_cliente_login" value="<?php echo $id_cliente_login?>">
		<input type="hidden" id="id_push" value="<?php echo $id_push?>">
		<input type="hidden" id="id_usuarios" value="<?php echo $id_usuarios?>">
		<input type="hidden" id="veiculos_user" value="<?php echo $veiculos_user?>">
		<input type="hidden" value="http://virtualtracker.com.br/tracker2/admin/posicao.php?p=<?php echo $link_base?>" id="flink">
		<input type="hidden" name="id" id="id" value="<?php echo $id_cliente_login?>">
		<input type="hidden" name="deviceid" id="deviceid" value="<?php echo $deviceid?>">
		<input type="hidden" value="<?php echo $latitude_ancora?>" id="latitude_ancora">
		<input type="hidden" value="<?php echo $longitude_ancora?>" id="longitude_ancora">
		<input type="hidden" value="<?php echo $raio_ancora?>" id="raio_ancora">	
		<input type="hidden" value="<?php echo $ancora?>" id="anc_raio">
		<input type="hidden" value="<?php echo $name_cerca1?>" id="tipo_cerca">	
		<input type="hidden" value="<?php echo $ancora?>" id="ancora_on">
		<input type="hidden" value="<?php echo $ign?>" id="ign">

    
</div>    


<script type="text/javascript" src="../scripts/jquery.js"></script>
<script type="text/javascript" src="../scripts/bootstrap.min.js"></script>
<script type="text/javascript" src="../scripts/custom.js"></script>
<link href="https://api.mapbox.com/mapbox-gl-js/v2.4.1/mapbox-gl.css" rel="stylesheet">
<script src="https://api.mapbox.com/mapbox-gl-js/v2.4.1/mapbox-gl.js"></script>

<script>
	var deviceid = document.getElementById("deviceid").value;
	var intervalo2 = setInterval(function() { $('#top_veiculo').load('include/grid_device1.php?id_device='+deviceid); }, 5000);
</script>
<!--
<script>
	var deviceid2 = document.getElementById("deviceid").value; 
	var intervalo3 = setInterval(function() { $('#informacoes').load('include/grid_device2.php?id_device='+deviceid2); }, 5000);
</script>
-->

<script>
function bloqueio(){
	$('#aguarde').showMenu();
	$('#bloqueio').hideMenu();
	$('#desbloqueio').hideMenu();
}
function ancora1(){
	$('#aguarde').showMenu();
	$('#ancora-menu').hideMenu();
}
function opcoes1(){
	$('#aguarde').showMenu();
	$('#opcoes').hideMenu();
}
</script>
<script>

var deviceid = document.getElementById("deviceid").value;
var latitude_ancora = document.getElementById("latitude_ancora").value;
var longitude_ancora = document.getElementById("longitude_ancora").value;
var raio_ancora = document.getElementById("raio_ancora").value;
var tipo_cerca = document.getElementById("tipo_cerca").value;
var ancora_on = document.getElementById("ancora_on").value;




	mapboxgl.accessToken = 'pk.eyJ1IjoicmFzdHJlYW1lbnRvamMiLCJhIjoiY2tsNmxuNDF5MDEwcjJwbm95cGVpeXhuNCJ9.T5AnJGLIVwj02mjOzz1Oaw';
		

function downloadUrl(url, callback) {
  var request = window.ActiveXObject ?
  new ActiveXObject('Microsoft.XMLHTTP') :
  new XMLHttpRequest;

  request.onreadystatechange = function() {
  if (request.readyState == 4) {
      request.onreadystatechange = function(){};
      callback(request, request.status);
      }
  };

  request.open('GET', url, true);
  request.send(null);
}		

var iconBase = '/tracker2/manager/imagens/icons/';
 
var map = new mapboxgl.Map({
container: 'map',
style: 'mapbox://styles/mapbox/streets-v11',
center: [<?php echo $longit?>, <?php echo $latit?>],
zoom: 16,
pitch: 65,
bearing: -17.6,
antialias: true
});

function setNoite(){
	map.setStyle('mapbox://styles/mapbox/navigation-night-v1');
    tipo_mapbox = 0
}

function setMap(){
	map.setStyle('mapbox://styles/mapbox/streets-v11');
    tipo_mapbox = 0
}


if(tipo_cerca != 'ANCORA'){
	map.on('load', function() {
      map.addSource("source_circle_500", {
        "type": "geojson",
        "data": {
          "type": "FeatureCollection",
		  
          "features": [{
            "type": "Feature",
				 
            "geometry": {
              "type": "Point",
              "coordinates": [<?php echo $longitude_cerca?>, <?php echo $latitude_cerca?>]
			 
            },
			"properties": {
				"title": "CERCA <?php echo $name_cerca1?>"
				}
          }]
        }
      });

      map.addLayer({
        "id": "circle500",
        "type": "circle",
        "source": "source_circle_500",
		
        "paint": {
          "circle-radius": {
            stops: [
              [5, 1],
              [15, <?php echo $raio_cerca?>]
            ],
            base: 2
          },
		  "circle-color": "#003366",
          "circle-opacity": 0.2,
	      "circle-stroke-color": "#003366",
		  "circle-stroke-width": 4
        }
      });
	  // Add a symbol layer
		map.addLayer({
			'id': 'source_circle_500',
			'type': 'symbol',
			'source': 'source_circle_500',
			'layout': {
			// get the title name from the source's "title" property
			'text-field': ['get', 'title'],
			'text-font': [
			'Open Sans Semibold',
			'Arial Unicode MS Bold'
			],
			'text-offset': [0, 1.25],
			'text-anchor': 'top'
			}
		});
	  
 });
} 
if(ancora_on == 'ON') {
	map.on('load', function() {
      map.addSource("source_circle_400", {
        "type": "geojson",
        "data": {
          "type": "FeatureCollection",
		  
          "features": [{
            "type": "Feature",
				 
            "geometry": {
              "type": "Point",
              "coordinates": [<?php echo $longitude_ancora?>, <?php echo $latitude_ancora?>]
			 
            },
			"properties": {
				"title": "ANCORA"
				}
          }]
        }
      });

      map.addLayer({
        "id": "circle400",
        "type": "circle",
        "source": "source_circle_400",
		
        "paint": {
          "circle-radius": {
            stops: [
              [5, 1],
              [15, <?php echo $raio_ancora?>]
            ],
            base: 2
          },

          "circle-color": "#006666",
          "circle-opacity": 0.4,
	      "circle-stroke-color": "#006666",
		  "circle-stroke-width": 4
        }
      });
	  // Add a symbol layer
		map.addLayer({
			'id': 'source_circle_400',
			'type': 'symbol',
			'source': 'source_circle_400',
			'layout': {
			// get the title name from the source's "title" property
			'text-field': ['get', 'title'],
			'text-font': [
			'Open Sans Semibold',
			'Arial Unicode MS Bold'
			],
			'text-offset': [0, 1.25],
			'text-anchor': 'top'
			}
		});
		
	  
 });
}




map.on("click", function(e) {
  console.log(e)
  if (e.originalEvent.target) {

  }
    /*
    console.log(marker)

    map.flyTo({
      center: [
         marker.lon,
         marker.lat
      ],
      essential: true // this animation is considered essential with respect to prefers-reduced-motion
      });
    }
    */
});
var tipo_mapbox = 0
function setSatellite(){
  if(tipo_mapbox == 0){
    map.setStyle('mapbox://styles/mapbox/satellite-v9');
    tipo_mapbox = 1
  }else{
    map.setStyle('mapbox://styles/mapbox/streets-v11');
    tipo_mapbox = 0
  }
}

map.addControl(new mapboxgl.FullscreenControl());
map.addControl(new mapboxgl.NavigationControl());
var mapboxMarkers = []








function refreshMap(){
 downloadUrl('resultado_device.php?id_device='+deviceid, (data) => {
    var xml = data.responseXML;
      markers = xml.documentElement.getElementsByTagName('marker');
      

      Array.prototype.forEach.call(markers, function(markerElem) {

          var name = markerElem.getAttribute('name');
          var address = markerElem.getAttribute('address');
          var ign = markerElem.getAttribute('ign');
          var latitude = markerElem.getAttribute('lat');
          var longitude = markerElem.getAttribute('lng');
          var placa = markerElem.getAttribute('placa');
          var data_format = markerElem.getAttribute('data_format')
          var ignicao = markerElem.getAttribute('ignicao')
          var point = [parseFloat(longitude), parseFloat(latitude)]
          
            
            // add marker to map
          var encontrou = false;
          for(let i = 0; i<= mapboxMarkers.length-1; i++){
            if(mapboxMarkers[i].name == name){
                  encontrou = true
                  if(String(ign) != String(mapboxMarkers[i].ign)
                          || String(point) != String(mapboxMarkers[i].point)
                          ){
							map.flyTo({
							center: point,
							speed: 0.2
							});

							let linha = [
								mapboxMarkers[i].point,
								point,
							]
							let ident = Math.random()
							map.addSource('route'+ident, {
								'type': 'geojson',
								'data': {
									'type': 'Feature',
									'properties': {},
									'geometry': {
										'type': 'LineString',
										'coordinates': linha
									}
								}
							});
							map.addLayer({
								'id': 'route'+ident,
								'type': 'line',
								'source': 'route'+ident,
								'layout': {
								'line-join': 'round',
								'line-cap': 'round'
								},
								'paint': {
								'line-color': '#293185',
								'line-width': 4
								}
							});


							var el = document.createElement('div');
							el.className = 'marker';
							el.style.backgroundImage =
							'url(/tracker2/manager/imagens/icons/'+ign;
							el.style.width = '99px';
							el.style.height = '73px';
							var infotitle = `
								`
							var popup = new mapboxgl.Popup({ closeOnClick: false }).setLngLat([longitude, latitude]).setHTML(infotitle)
							var marker = new mapboxgl.Marker(el).setLngLat([longitude, latitude]).addTo(map);
							
							var tagg = {
								name: name,
								point: point,
								ign: ign,
								marcador: marker
							}
							
							el.addEventListener('click', () => 
							   { 
								 document.getElementById("teste20").click();
							   }
							); 
							
                            mapboxMarkers[i].marcador.remove()
							mapboxMarkers = []
							mapboxMarkers.push(tagg)


							
							
							
                          
                  }
              }
          }
		  
		  
		  

		  
          if(encontrou == false){
				
                  var el = document.createElement('div');
                  el.className = 'marker';
                  el.style.backgroundImage =
                  'url(/tracker2/manager/imagens/icons/'+ign;
                  el.style.width = '99px';
                  el.style.height = '73px';
                  var infotitle = `
                      `
                  var popup = new mapboxgl.Popup({ closeOnClick: false }).setLngLat([-96, 37.8]).setHTML(infotitle)
                  var marker = new mapboxgl.Marker(el).setLngLat([longitude, latitude]).addTo(map);
                  
                  var tagg = {
                      name: name,
                      point: point,
                      ign: ign,
                      marcador: marker
                  }
				  
				  el.addEventListener('click', () => 
							   { 
								 document.getElementById("teste20").click();
							   }
							); 
                  mapboxMarkers.push(tagg)
          } 
      });
  });
}
refreshMap();
setInterval(() => {
  refreshMap();
}, 5000);
console.log(mapboxMarkers)
	// add markers to map
/*
geojson.features.forEach(function(marker) {
  // create a DOM element for the marker
  var el = document.createElement('div');
  el.className = 'marker';
  el.style.backgroundImage =
  'url(/sistema/tracker2/manager/imagens/icons/car.png';
  el.style.width = marker.properties.iconSize[0] + 'px';
  el.style.height = marker.properties.iconSize[1] + 'px';



  
  // add marker to map
  new mapboxgl.Marker(el)
  .setLngLat(marker.geometry.coordinates)
  .addTo(map);
});
*/


</script>
</body>
