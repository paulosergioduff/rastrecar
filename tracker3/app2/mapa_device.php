<?php 
include_once("conexao.php");

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
$permite_bloqueio = 	$resp_user['permite_bloqueio'];

	}}



$nome_empesa = 'JC Rastreamento';




$agrupar = 'SIM';

$data_inicial = $_REQUEST['data_inicial'];
//$data_i1 = '2021-02-17 06:00:00';

$data_inicial_1 = date('d/m/Y H:i' , strtotime($data_i1));


$data_final = $_REQUEST['data_final'];
//$data_f1 = '2021-02-17 14:00:00';

$data_final_1 = date('d/m/Y H:i' , strtotime($data_f1));




$deviceid = $_REQUEST['deviceid'];
//$id_relatorio = $_REQUEST['id_relatorio'];
//$deviceid = '17';




$cons_veiculo = mysqli_query($conn, "SELECT * FROM veiculos_clientes WHERE deviceid='$deviceid'");
if(mysqli_num_rows($cons_veiculo) > 0){
while ($resp_veic = mysqli_fetch_assoc($cons_veiculo)) {
		$id_cliente = $resp_veic['id_cliente'];
		$marca_veiculo =  $resp_veic['marca_veiculo'];
		$modelo_veiculo =  $resp_veic['modelo_veiculo'];
		$placa =  $resp_veic['placa'];
		$tipo_veiculo =  $resp_veic['tipo_veiculo'];
		$veiculo_mapa = ''.$marca_veiculo.'/'.$modelo_veiculo.'';
}}

if($tipo_veiculo == 'Automovel'){
	$imagem = 'car.png';
}
else if($tipo_veiculo == 'Caminhao'){
	$imagem = 'truck.png';
}
else if($tipo_veiculo == 'PickUp'){
	$imagem = 'car.png';
}
else if($tipo_veiculo == 'Motocicleta'){
	$imagem = 'moto.png';
} else {
$imagem = 'car.png';
}

$cons_cliente = mysqli_query($conn, "SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
if(mysqli_num_rows($cons_cliente) > 0){
while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
		$nome_cliente = $resp_cliente['nome_cliente'];
}}

			


#------------------------



// Select all the rows in the markers table

	
$cons_pos = mysqli_query($conn,"SELECT * FROM mapa_posicoes WHERE deviceid='$deviceid' AND (devicetime >= '$data_inicial' AND devicetime <= '$data_final') ORDER BY devicetime ASC");
	if(mysqli_num_rows($cons_pos) > 0){
		while ($resp_pos = mysqli_fetch_assoc($cons_pos)) {
		$horario = $resp_pos['devicetime'];
		$horario_br = date('d/m/Y H:i:s', strtotime("$horario"));
		$ign2 = $resp_pos['ignicao'];
		$latitude = $resp_pos['latitude'];
		$longitude = $resp_pos['longitude'];
		$endereco = $resp_pos['endereco'];
		$veloc = $resp_pos['speed'];
		$veloc = round($veloc);
		$movimento = $resp_pos['movimento'];
		$id_pos = $resp_pos['id'];
		
			
		if($ign2 == 'desligada'){
			$cons_posicao_desl = mysqli_query($conn,"SELECT * FROM mapa_posicoes WHERE deviceid = '$deviceid' AND devicetime > '$horario' AND ignicao = 'Ligada' ORDER BY id ASC LIMIT 1");
				
				if(mysqli_num_rows($cons_posicao_desl) > 0){
					while ($resp_posicao_desl = mysqli_fetch_assoc($cons_posicao_desl)) {
					$hora_proximo = $resp_posicao_desl['devicetime'];
					$hora_proximo_br = date('d/m/Y H:i:s', strtotime("$hora_proximo"));
					
					if($hora_proximo < $horario){
						$data_pos = $horario_br;
					} else {
						$data_pos = $horario_br.' até <br>'.$hora_proximo_br;
					}
				}}
			$velocidade = '0.00';
		}
		
		
		
		$str_ign = 'Desligado';
		if($ign2 == 'ligada'){
			$str_ign = 'Ligada';
			$data_pos = $horario_br;
			$velocidade = $veloc;
		};
		if($agrupar == 'SIM'){
			if($last_ign == 'Desligado' && $str_ign == 'Desligado'){
				continue;
			};
		};
		$last_ign = $str_ign;

	
$popup = '<div id="detalhes" class="menu menu-box-bottom rounded-m"
         data-menu-height="450" 
         data-menu-effect="menu-over">
        <div class="menu-title">
            
            <h1 class="font-20">Informações do Veículo</h1>
            <a href="#" class="close-menu"><i class="fa fa-times-circle"></i></a>
        </div><br>
        <div class="content mt-0">
			<div class="row">
				<div class="d-flex rounded-m">
					<div class="me-3">
						xxxxxx
					</div>
					
					<div>
						<h5>xxxxxx</h5>
						<h5>xxxxx</h5>
					</div>
					
				</div>
			</div>
			<hr style="border:#CCC 1px dashed">
			<div class="row">
				<div class="col-12">
					x
				</div>
			</div>
			
        </div>
    </div> ';
	
	
	$marker = array($longitude, $latitude);
	

				$json[] = $marker;
				
				
				
	$marker1 = array('type' => 'Feature',
					'name' => $name, 
					'address' => $endereco, 
					'lat' => $latitude,
					'lng' => $longitude,
					'speed' => $veloc,
					'placa' => $placa,
					'veiculo' => $veiculo,
					'data_format' => $data_pos,
					'ignicao' => $ign2,
					'properties' => array('description' => $popup, 'message' => $veiculo, 'iconSize' => array('99', '73')),
					'geometry' => array('type' => 'Point', 'coordinates' => array($longitude, $latitude)));

				$json1[] = $marker1;

				$mark = array('type' => 'FeatureCollection',
			  'features' => $json1);
			  
			  
			  
			  
			

}}



$posicoes = json_encode($mark, JSON_PRETTY_PRINT);


  $positions = array('type' => 'Feature',
					'geometry' => array('type' => 'LineString', 'coordinates' => $json));

				$json_pos[] = $positions;

				$pos = array('type' => 'FeatureCollection',
			  'features' => $json_pos);





$geojson = json_encode($pos, JSON_PRETTY_PRINT);



$sql2 = mysqli_query($conn, "DELETE FROM mapa_posicoes WHERE deviceid='$deviceid'");
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
    
<body class="theme-light" data-highlight="blue2" onLoad="AutoCenter();">
    
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
        <a href="faturas.php?id=<?php echo $id_push?>" class="active-nav" onclick="carregar();"><i class="fas fa-file-invoice-dollar"></i><span>Faturas</span></a>
        <a href="index.php?id=<?php echo $id_push?>" onclick="carregar();"><i class="fas fa-car"></i><span>Veículos</span></a>
        <a href="#" data-menu="menu-main"><i class="fa fa-bars"></i><span>Menu</span></a>
    </div>
    
    <div class="page-content">
        
        <div class="page-title page-title-large">
            <h2><a href="relatorio_percurso.php?id=<?php echo $id_push?>&deviceid=<?php echo $deviceid?>" onclick="carregar()" class="color-white"><i class="fa fa-arrow-left"></i> Voltar</a> </h2><br>
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
                <h3>Percurso realizado</h3>
				<h5>VEÍCULO: <?php echo $placa?> - <?php echo $veiculo_mapa ?><h5>
            </div>
			<div id="map" style=" height: 85vh;"></div>
        </div>
       
		
    
	
	
	

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
    
	<div id="detalhes" class="menu menu-box-bottom rounded-m" 
         data-menu-height="260" 
         data-menu-effect="menu-over" style="z-index:999999">
        <div class="menu-title">
            <h1 class="font-24"><span id="information"></span></h1>
            <a href="#" class="close-menu"><i class="fa fa-times-circle"></i></a>
        </div>

        <div class="content mb-0 mt-0">
            <div class="row">
				<div class="col-12">
					<h5><i class="fas fa-clock"></i> <span id="horario"></span></label></h5>
					<h5><i class="fas fa-map-marker-alt"></i> <span id="endereco"></span></label></h5>
					<h5><i class="fas fa-key"></i> Ignição: <span id="ignicao1"></span></label></h5>
					<h5><i class="fas fa-tachometer-alt"></i> Velocidade: <span id="velocidade"></span> km/h</label></h5>
				</div>
            </div>
            
        </div>
    </div>     
        
	<div id="detalhes1" class="menu menu-box-bottom rounded-m" 
         data-menu-height="260" 
         data-menu-effect="menu-over" style="z-index:999999">
        <div class="menu-title">
            <h1 class="font-24"><i class="fas fa-play-circle"></i> Posição Inicial</h1>
            <a href="#" class="close-menu"><i class="fa fa-times-circle"></i></a>
        </div>

        <div class="content mb-0 mt-0">
            <div class="row">
				<div class="col-12">
					<h5><i class="fas fa-clock"></i> <span id="horario1"></span></label></h5>
					<h5><i class="fas fa-map-marker-alt"></i> <span id="endereco1"></span></label></h5>
					<h5><i class="fas fa-key"></i> Ignição: <span id="ignicao11"></span></label></h5>
					<h5><i class="fas fa-tachometer-alt"></i>Velocidade: <span id="velocidade1"></span> km/h</label></h5>
				</div>
            </div>
            
        </div>
    </div> 
	
	<div id="detalhes2" class="menu menu-box-bottom rounded-m" 
         data-menu-height="260" 
         data-menu-effect="menu-over" style="z-index:999999">
        <div class="menu-title">
            <h1 class="font-24"><i class="fas fa-flag-checkered"></i> Posição Final</h1>
            <a href="#" class="close-menu"><i class="fa fa-times-circle"></i></a>
        </div>

        <div class="content mb-0 mt-0">
            <div class="row">
				<div class="col-12">
					<h5><i class="fas fa-clock"></i> <span id="horario2"></span></label></h5>
					<h5><i class="fas fa-map-marker-alt"></i> <span id="endereco2"></span></label></h5>
					<h5><i class="fas fa-key"></i> Ignição: <span id="ignicao2"></span></label></h5>
					<h5><i class="fas fa-tachometer-alt"></i>Velocidade: <span id="velocidade2"></span> km/h</label></h5>
				</div>
            </div>
            
        </div>
    </div> 

    
</div>    

<a href="#" id="teste20" data-menu="detalhes"><i class="fas fa-info-circle"></i><span>Detalhes</span></a>
<a href="#" id="teste21" data-menu="detalhes1"><i class="fas fa-info-circle"></i><span>Detalhes</span></a>
<a href="#" id="teste22" data-menu="detalhes2"><i class="fas fa-info-circle"></i><span>Detalhes</span></a>
<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript" src="scripts/bootstrap.min.js"></script>
<script type="text/javascript" src="scripts/custom.js"></script>
<link href="https://api.mapbox.com/mapbox-gl-js/v2.4.1/mapbox-gl.css" rel="stylesheet">
<script src="https://api.mapbox.com/mapbox-gl-js/v2.4.1/mapbox-gl.js"></script>
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
mapboxgl.accessToken = 'pk.eyJ1IjoicmFzdHJlYW1lbnRvamMiLCJhIjoiY2tsNmxuNDF5MDEwcjJwbm95cGVpeXhuNCJ9.T5AnJGLIVwj02mjOzz1Oaw';	

var animationStep = 50;
	var map = new mapboxgl.Map({
		container: 'map',
			style: 'mapbox://styles/mapbox/streets-v11',
			center: [-51.1811529394706, -30.01559373149247],
			zoom: 5,
			attributionControl: false
		});	
			
	function AutoCenter() {
var bounds = new mapboxgl.LngLatBounds();

position.features.forEach(function(feature) {
	 bounds.extend(feature.geometry.coordinates);
});

map.fitBounds(bounds, {padding: 40});
  }

var position = <?php echo $posicoes?>;
var geojson = <?php echo $geojson?>;

 
	map.on('load', function () {
		map.addSource('LineString', {
			'type': 'geojson',
			'data': geojson
		});
		map.addLayer({
			'id': 'LineString',
			'type': 'line',
			'source': 'LineString',
			'layout': {
			'line-join': 'round',
			'line-cap': 'round'
			},
			'paint': {
			'line-color': '#293185',
			'line-width': 5
			}
		});
		
		function addLayer(map) {

  var url = '/tracker2/manager/icons/arrow.png';
  map.loadImage(url, function(err, image) {
    if (err) {
      console.error('err image', err);
      return;
    }
    map.addImage('arrow', image);
    map.addLayer({
      'id': 'arrow-layer',
      'type': 'symbol',
      'source': 'LineString',
      'layout': {
        'symbol-placement': 'line',
        'symbol-spacing': 1,
        'icon-allow-overlap': true,
        // 'icon-ignore-placement': true,
        'icon-image': 'arrow',
        'icon-size': 0.075,
        'visibility': 'visible'
      }
    });
  });

}
		
		map.addSource('mapDataSourceId', {
			type: "geojson",
			data: geojson
		  });
		  addLayer(map);
		
		
		
		//informações ponto de inicio
		var endereco_inicial = [position.features[0].address];
		var horario_inicial = [position.features[0].data_format];
		var ign_inicial = [position.features[0].ignicao];
		var speed_inicial = [position.features[0].speed];
		var posicao_inicial = [position.features[0].lng, position.features[0].lat];
		var popup_inicial = new mapboxgl.Popup({ closeOnClick: false }).setLngLat(posicao_inicial).setHTML(position.features[0].properties.description);
		
		//informações ponto final
		let endereco_final = [position.features[position.features.length-1].address];
		let horario_final = [position.features[position.features.length-1].data_format];
		let ign_final = [position.features[position.features.length-1].ignicao];
		let speed_final = [position.features[position.features.length-1].speed];
		let posicao_final = [position.features[position.features.length-1].lng, position.features[position.features.length-1].lat];
		var popup_final = new mapboxgl.Popup({ closeOnClick: false }).setLngLat(posicao_final).setHTML(position.features[position.features.length-1].properties.description);
		
		
		var el_ini = document.createElement('div');
			el_ini.className = 'marker';
			el_ini.style.backgroundImage ='url(/tracker2/manager/icons/inicio.png)';
			el_ini.style.width = '35px';
			el_ini.style.height = '42px';
			el_ini.style.zIndex  = '999';
		
		var el_fim = document.createElement('div');
			el_fim.className = 'marker';
			el_fim.style.backgroundImage ='url(/tracker2/manager/icons/chegada.png)'
			el_fim.style.width = '42px';
			el_fim.style.height = '50px';
			el_fim.style.zIndex  = '999';
		
		
		var marker_inicial = new mapboxgl.Marker(el_ini).setLngLat(posicao_inicial).addTo(map);
		
		
		var marker_final = new mapboxgl.Marker(el_fim).setLngLat(posicao_final).addTo(map);
		
		el_ini.addEventListener('click', () => 
		   { 
				$('#endereco1').html('');
				$('#endereco1').html(endereco_inicial);
				$('#horario1').html('');
				$('#horario1').html(horario_inicial);
				$('#ignicao11').html('');
				$('#ignicao11').html(ign_inicial);
				$('#velocidade1').html('');
				$('#velocidade1').html(speed_inicial);
			 document.getElementById("teste21").click();
		   }
		);
		
		el_fim.addEventListener('click', () => 
		   { 
				$('#endereco2').html('');
				$('#endereco2').html(endereco_final);
				$('#horario2').html('');
				$('#horario2').html(horario_final);
				$('#ignicao2').html('');
				$('#ignicao2').html(ign_final);
				$('#velocidade2').html('');
				$('#velocidade2').html(speed_final);
			 document.getElementById("teste22").click();
		   }
		);
		
		
		
		
		
		position.features.forEach(function (marker) {

			
			var info_ponto = marker.properties.description;
			
		
			var el_ponto = document.createElement('div');
			el_ponto.className = 'marker';
			el_ponto.style.backgroundImage ='url(/tracker2/manager/icons/map2.png)';
			el_ponto.style.width = '13px';
			el_ponto.style.height = '13px';
			
			var el_parada = document.createElement('div');
			el_parada.className = 'marker';
			el_parada.style.backgroundImage ='url(/tracker2/manager/icons/map3.png)';
			el_parada.style.width = '35px';
			el_parada.style.height = '73px';
			
			
			
			if(marker.ignicao == 'Ligada'){
				
				var marker_ponto = new mapboxgl.Marker(el_ponto).setLngLat(marker.geometry.coordinates).addTo(map);
				
				el_ponto.addEventListener('click', () => 
							   { 
									$('#endereco').html('');
									$('#endereco').html(marker.address);
									$('#horario').html('');
									$('#horario').html(marker.data_format);
									$('#ignicao1').html('');
									$('#ignicao1').html(marker.ignicao);
									$('#velocidade').html('');
									$('#velocidade').html(marker.speed);
									$('#information').html('<i class="far fa-circle"></i> Informações Ponto');
								 document.getElementById("teste20").click();
							   }
							);
			}
			if(marker.ignicao == 'Desligada'){
				
				var marker_ponto = new mapboxgl.Marker(el_parada).setLngLat(marker.geometry.coordinates).addTo(map);
				
				el_parada.addEventListener('click', () => 
							   { 
									$('#endereco').html('');
									$('#endereco').html(marker.address);
									$('#horario').html('');
									$('#horario').html(marker.data_format);
									$('#ignicao1').html('');
									$('#ignicao1').html(marker.ignicao);
									$('#velocidade').html('');
									$('#velocidade').html(marker.speed);
									$('#information').html('<i class="fab fa-product-hunt"></i> Informações da Parada');
								 document.getElementById("teste20").click();
							   }
							);
			}
			
			
			
		});
		
	 

	});
</script>

</body>
