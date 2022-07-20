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



 $cons_user1 = mysqli_query($conn,"SELECT * FROM usuarios_push WHERE id_push='$id_push' ");
	if(mysqli_num_rows($cons_user1) <= 0){
		header('Location: logoff.php');
	}
	if(mysqli_num_rows($cons_user1) > 0){
		while ($resp_user1 = mysqli_fetch_assoc($cons_user1)) {
		$tipo = 	$resp_user1['tipo'];
		$id_usuarios = $resp_user1['id_usuarios'];
		$id_cliente_login = $resp_user1['id_cliente'];

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

$cons_veiculo = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE deviceid = '$deviceid'");
	if(mysqli_num_rows($cons_veiculo) > 0){
		while ($resp_veiculos = mysqli_fetch_assoc($cons_veiculo)) {
		$placa = 	$resp_veiculos['placa'];
		$modelo_veiculo = 	$resp_veiculos['modelo_veiculo'];
		$marca_veiculo = 	$resp_veiculos['marca_veiculo'];
		$modelo_img = str_replace(' ', '_', $modelo_veiculo);
	}}

$nome_empesa = 'JC Rastreamento';

$agrupar = 'SIM';

$data_ini = $_REQUEST['data_inicial'];



$date = date('Y-m-d H:i:s');
$data_final = date('Y-m-d H:i:s');
$data_final_ev  =  date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_final)));

if($data_ini == '2'){
	$data_inic  =  date('Y-m-d H:i:s', strtotime('-2 hour', strtotime($date)));
	$tempo_p  = 'Últimas 2 horas';
}
if($data_ini == '4'){
	$data_inic  =  date('Y-m-d H:i:s', strtotime('-4 hour', strtotime($date)));
	$tempo_p  = 'Últimas 4 horas';
}
if($data_ini == '8'){
	$data_inic  =  date('Y-m-d H:i:s', strtotime('-8 hour', strtotime($date)));
	$tempo_p  = 'Últimas 8 horas';
}
if($data_ini == '12'){
	$data_inic  =  date('Y-m-d H:i:s', strtotime('-12 hour', strtotime($date)));
	$tempo_p  = 'Últimas 12 horas';
}
if($data_ini == '24'){
	$data_inic  =  date('Y-m-d H:i:s', strtotime('-24 hour', strtotime($date)));
	$tempo_p  = 'Últimas 24 horas';
}
if($data_ini == '48'){
	$data_inic  =  date('Y-m-d H:i:s', strtotime('-48 hour', strtotime($date)));
	$tempo_p  = 'Últimas 48 horas';
}

$data_ini_ev  =  date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_inic)));

#======================================

$data_ini1 = explode(" ", $data_ini_ev);
$data1 = $data_ini1[0];
$hora1 = $data_ini1[1];
$data_inicial22 = $data1.'T'.$hora1.'Z';

$data_fim1 = explode(" ", $data_final_ev);
$data2 = $data_fim1[0];
$hora2 = $data_fim1[1];
$data_final22 = $data2.'T'.$hora2.'Z';


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://5.189.185.179:8082/api/reports/summary?from='.$data_inicial22.'&to='.$data_final22.'&deviceId='.$deviceid.'',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Authorization: Basic YWRtaW46VFI0dmNpalU2VDlLZWF3'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

$json = json_decode($response);
 

// Loop para percorrer o Objeto
foreach($json as $registro):
    $deviceId = $registro->deviceId;
    $distance = $registro->distance;
	$distance = $distance / 1000;
	$distance = round($distance, 2);


endforeach;



#======================================



	
	$totalkm = $km_1 - $km_2;
	$totalkm = round($totalkm, 2);
	$totalkm = number_format($totalkm, 2, ",", ".");
							
					$cons_veiculo = mysqli_query($conn, "SELECT * FROM veiculos_clientes WHERE deviceid='$deviceid'");
					if(mysqli_num_rows($cons_veiculo) > 0){
					while ($resp_veic = mysqli_fetch_assoc($cons_veiculo)) {
							$id_cliente = $resp_veic['id_cliente'];
							$marca_veiculo =  $resp_veic['marca_veiculo'];
							$modelo_veiculo =  $resp_veic['modelo_veiculo'];
							$placa =  $resp_veic['placa'];
							$veiculo_nome = $placa.' - '.$marca_veiculo.'/'.$modelo_veiculo;
					}}

					$cons_cliente = mysqli_query($conn, "SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
					if(mysqli_num_rows($cons_cliente) > 0){
					while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
							$nome_cliente = $resp_cliente['nome_cliente'];
					}}

						
					?>
					<?php



					function segundos_em_tempo($segundos) {
					 
					 $horas = floor($segundos / 3600);
					 $minutos = floor($segundos % 3600 / 60);
					 $segundos = $segundos % 60;
					 
					 return sprintf("%02d:%02d:%02d", $horas, $minutos, $segundos);
					 
					}
						


						
						
							$cons_eventos_off = mysqli_query($conn,"SELECT * FROM tc_events WHERE deviceid='$deviceid' AND (eventtime >= '$data_ini_ev' AND eventtime <= '$data_final_ev') AND (type='ignitionOn' OR type='ignitionOff') ORDER BY eventtime ASC");
						if(mysqli_num_rows($cons_eventos_off) > 0){
							while ($row_ev_off = mysqli_fetch_assoc($cons_eventos_off)) {
								
								
								$listagem[] = $row_ev_off;  
								
							}
							
							for ($i=0; $i < count($listagem); $i++) { 
								
							if($listagem[$i]["type"]=='ignitionOn' && $listagem[$i+1]["type"] == 'ignitionOff'){
							
									$date_time  = new DateTime($listagem[$i]['eventtime']);
									$diff       = $date_time->diff( new DateTime($listagem[$i+1]['eventtime']));
									$horas_mov[] = $diff->format('%H:%i:%s');
									
									//echo ''.$listagem[$i]['type'].': '.$listagem[$i]['servertime'].' - '.$listagem[$i+1]['type'].': '.$listagem[$i+1]['servertime'].' - Tempo Movimento: '.$horas.'<br>';

							}
							if($listagem[$i]["type"]=='ignitionOn' && $listagem[$i+1]["type"] == ''){

									$date_time  = new DateTime($listagem[$i]['eventtime']);
									$diff       = $date_time->diff( new DateTime($data_final));
									$horas_mov[] = $diff->format('%H:%i:%s');
									
									//echo ''.$listagem[$i]['type'].': '.$listagem[$i]['servertime'].' - '.$listagem[$i+1]['type'].': '.$listagem[$i+1]['servertime'].' - Tempo Movimento: '.$horas.'<br>';


							} 
							
							if($listagem[$i]["type"]=='ignitionOff' && $listagem[$i+1]["type"] == 'ignitionOn'){
							
									$date_time  = new DateTime($listagem[$i]['eventtime']);
									$diff       = $date_time->diff( new DateTime($listagem[$i+1]['eventtime']));
									$horas_stop[] = $diff->format('%H:%i:%s');
									
									//echo ''.$listagem[$i]['type'].': '.$listagem[$i]['servertime'].' - '.$listagem[$i+1]['type'].': '.$listagem[$i+1]['servertime'].' - Tempo Parado: '.$horas.'<br>';

							}
							if($listagem[$i]["type"]=='ignitionOff' && $listagem[$i+1]["type"] == ''){

									$date_time  = new DateTime($listagem[$i]['eventtime']);
									$diff       = $date_time->diff( new DateTime($data_final));
									$horas_stop[] = $diff->format('%H:%i:%s');
									
									//echo ''.$listagem[$i]['type'].': '.$listagem[$i]['servertime'].' - '.$listagem[$i+1]['type'].': '.$listagem[$i+1]['servertime'].' - Tempo Parado: '.$horas.'<br>';


							} 
							
						//echo ''.$horas.'<br>';

						}}
						
						
						
						$soma = 0;
						$soma1 = 0;
					 
					foreach($horas_stop as $item1) {
						list($horas,$minutos,$segundos) = explode(":",$item1);
						$calc1 = $horas * 3600 + $minutos * 60 + $segundos;
						$soma1 = $calc1 + $soma1;
					}



					foreach($horas_mov as $item) {
						list($horas,$minutos,$segundos) = explode(":",$item);
						$calc = $horas * 3600 + $minutos * 60 + $segundos;
						$soma = $calc + $soma;
					}
					 
					$total_mov = segundos_em_tempo($soma);
					$total_mov = explode(":", $total_mov);
					$hora_mov = $total_mov[0];
					$min_mov = $total_mov[1];

					$total_stop = segundos_em_tempo($soma1);
					$total_stop = explode(":", $total_stop);
					$hora_stop = $total_stop[0];
					$min_stop = $total_stop[1];

					$total_movimento =  ''.$hora_mov.'h'.$min_mov.'min';
					$total_parado = ''.$hora_stop.'h'.$min_stop.'min';


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
<link rel="stylesheet" type="text/css" href=".fonts/css/fontawesome-all.min.css">    
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
				<p>Este relatório irá demonstrar o percurso realizado pelo veículo, com endereço, velocidade e status de Ignição. Selecione o período desejado. Para períodos maiores, por favor, acesse o sistema web</p>
            </div>
			
        </div>
       <div class="card card-style text-center">
            <div class="content">
                <p class="mb-0 font-600 color-highlight">Veículo</p>
                <h4><?php echo $veiculo_nome?></h4>
                    
            </div>
        </div>
		<div class="card card-style text-center">
            <div class="content">
                <p class="mb-0 font-600 color-highlight">Distância Percorrida no período:</p>
                <h1><?php echo $distance?> Km</h1>
                    
            </div>
        </div>
		<div class="row mb-0">
            <div class="col-6 pe-0 text-center">
                <div class="card card-style">
                    <div class="p-2">
                        <p class="font-600 color-highlight mb-n2">Tempo Parado:</p>
                        <h4 class="pt-2"><?php echo $total_parado?></h4>
                        
                    </div>
                </div>
            </div>
            <div class="col-6 ps-0 text-center">
                <div class="card card-style">
                    <div class="p-2">
                        <p class="font-600 color-highlight mb-n2">Em Movimento:</p>
                        <h4 class="pt-2"><?php echo $total_movimento?></h4>
                    </div>
                </div>
            </div>
        </div>
		<button onclick="abrir();" type="button" class="btn btn-full btn-m bg-blue2-dark font-600 rounded-s" style="width:100%"><i class="fas fa-map-marked-alt"></i> Ver Percurso no Mapa</button><br>
		
		<div class="row">
			<div class="col-md-12 text-center" id="positions">
				<img src="/tracker2/Imagens/load.gif" width="40px" height="40px">
			</div>
		</div>
	
		<input type="hidden" id="data_ini" value="<?php echo $data_inic ?>">
		<input type="hidden" id="data_ini1" value="<?php echo $data_ini ?>">
		<input type="hidden" id="data_fin" value="<?php echo $data_final ?>">
		<input type="hidden" id="device_id" value="<?php echo $deviceid ?>">
		<input type="hidden" id="agrupar" value="<?php echo $agrupar ?>">		
		<input type="hidden" id="id_push" value="<?php echo $id_push?>">		
		<input type="hidden" id="id_relatorio" value="<?php echo $id_relatorio?>">
	

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
		
		var device_id = document.getElementById("deviceid").value;
		var data_ini = document.getElementById("data_inicial").value;
		var id_push = document.getElementById("id_push").value;
		location.href = "relatorio_percurso1.php?deviceid="+device_id+"&data_inicial="+data_ini+"&id_push="+id_push;
	}
function carregar2(){
	$('#aguarde').showMenu();
	$('#menu-main').hideMenu();
}

function abrir(){
	
	$('#aguarde').showMenu();
	
	var device_id = document.getElementById("device_id").value;
	var data_ini = document.getElementById("data_ini").value;
	var data_fin = document.getElementById("data_fin").value;
	var id_relatorio = document.getElementById("id_relatorio").value;
	var id_push = document.getElementById("id_push").value;
	location.href = "mapa_device.php?id_relatorio="+id_relatorio+"&deviceid="+device_id+"&data_inicial="+data_ini+"&data_final="+data_fin+"&id_push="+id_push;
}
</script>
<script>

		var device_id = document.getElementById("device_id").value;
		var data_ini1 = document.getElementById("data_ini1").value;
		var data_fin = document.getElementById("data_fin").value;
		

	var intervalo = setTimeout(function() { 
		$('#positions').load('result_posicoes.php?deviceid='+device_id+'&data_inicial='+data_ini1); 
		$("#positions").removeClass("text-center");
	}, 3000);
	
</script>

</body>
