
<!DOCTYPE html>

<html lang="en">
    <head>
           <meta charset="utf-8"/>
        <title>APP</title>
        <meta name="description" content="Basic">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
        <!-- Call App Mode on ios devices -->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <!-- Remove Tap Highlight on Windows Phone IE -->
        <meta name="msapplication-tap-highlight" content="no">
        <!-- base css -->
        <link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/vendors.bundle.css">
        <link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/app.bundle.css">
        <!-- Place favicon.ico in the root directory -->
        <link rel="apple-touch-icon" sizes="180x180" href="/tracker3/app-assets/img/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/tracker3/app-assets/img/favicon/favicon-32x32.png">
        <link rel="mask-icon" href="/tracker3/app-assets/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/datagrid/datatables/datatables.bundle.css">
				<link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/fa-solid.css">
		<link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/statistics/chartjs/chartjs.css">
		<link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/formplugins/select2/select2.bundle.css">
		<script src="https://kit.fontawesome.com/a132241e15.js"></script>
		<style>
#floating-panel {
  position: absolute;
  top: 3%;
  left: 3%;
  z-index:99;
  background-color:  rgb(255, 255, 255, 0);
  padding: 5px;
  text-align: center;
  font-family: 'Roboto','sans-serif';
  line-height: 30px;
  padding-left: 10px;
}
#floating-panel1 {
  position: absolute;
  bottom: 10%;
  left: 3%;
  z-index:99;
  background-color:  rgb(255, 255, 255, 0);
  padding: 5px;
  text-align: center;
  font-family: 'Roboto','sans-serif';
  line-height: 30px;
  padding-left: 10px;
}
.mapboxgl-popup {
  width: 300px;
  height: 200px;
}

.mapboxgl-popup-content {
   width: 300px;
   
}

.mapboxgl-popup-tip{
  margin-bottom: 35px;
}

</style>
    </head>
    <body class="mod-bg-1 nav-function-fixed" onload="AutoCenter()">
        <!-- DOC: script to save and load page settings -->
        <script>
            /**
             *	This script should be placed right after the body tag for fast execution 
             *	Note: the script is written in pure javascript and does not depend on thirdparty library
             **/
            'use strict';

            var classHolder = document.getElementsByTagName("BODY")[0],
                /** 
                 * Load from localstorage
                 **/
                themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) :
                {},
                themeURL = themeSettings.themeURL || '',
                themeOptions = themeSettings.themeOptions || '';
            /** 
             * Load theme options
             **/
            if (themeSettings.themeOptions)
            {
                classHolder.className = themeSettings.themeOptions;
                console.log("%c✔ Theme settings loaded", "color: #148f32");
            }
            else
            {
                console.log("Heads up! Theme settings is empty or does not exist, loading default settings...");
            }
            if (themeSettings.themeURL && !document.getElementById('mytheme'))
            {
                var cssfile = document.createElement('link');
                cssfile.id = 'mytheme';
                cssfile.rel = 'stylesheet';
                cssfile.href = themeURL;
                document.getElementsByTagName('head')[0].appendChild(cssfile);
            }
            /** 
             * Save to localstorage 
             **/
            var saveSettings = function()
            {
                themeSettings.themeOptions = String(classHolder.className).split(/[^\w-]+/).filter(function(item)
                {
                    return /^(nav|header|mod|display)-/i.test(item);
                }).join(' ');
                if (document.getElementById('mytheme'))
                {
                    themeSettings.themeURL = document.getElementById('mytheme').getAttribute("href");
                };
                localStorage.setItem('themeSettings', JSON.stringify(themeSettings));
            }
            /** 
             * Reset settings
             **/
            var resetSettings = function()
            {
                localStorage.setItem("themeSettings", "");
            }

        </script>
        <!-- BEGIN Page Wrapper -->
        <div class="page-wrapper">
            <div class="page-inner">
                <!-- BEGIN Left Aside -->
                <aside class="page-sidebar">
                  <div style="background-color:#F3F3F3">
                        <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative">
                            <img src="http://mobidrive.mtracker.com.br/logo.png" style="width:200px; heigth:auto" alt="SmartAdmin WebApp" aria-roledescription="logo">
                            
                            
                        </a>
                    </div>
                    <?php include('include/sidebar.php')?>
                    
                </aside>
                <!-- END Left Aside -->
                <div class="page-content-wrapper header-function-fixed">
                    <!-- BEGIN Page Header -->
                    <?php include('include/head.php')?>
					
					<?php
//include_once("conexao.php");
//include_once("tipo_celular.php");


$id_push = $_REQUEST['id'];
$deviceid = $_REQUEST['deviceid'];
//$tipo_celular = $_REQUEST['tipo_celular'];
$data_inicial = $_REQUEST['data_inicial'];
$data_final = $_REQUEST['data_final'];
$app = 'on';


$date = date('Y-m-d');	

$agrupar = 'SIM';

  $cons_user1 = mysqli_query($conn,"SELECT * FROM usuarios_push WHERE id_push='$id_push' ");
	if(mysqli_num_rows($cons_user1) > 0){
while ($resp_user1 = mysqli_fetch_assoc($cons_user1)) {
$tipo = 	$resp_user1['tipo'];
$id_cliente_login = $resp_user1['id_cliente'];

}}	


$cons_user = mysqli_query($conn,"SELECT * FROM usuarios WHERE id_usuarios='$id_cliente_login'");
	if(mysqli_num_rows($cons_user) > 0){
while ($resp_user = mysqli_fetch_assoc($cons_user)) {
$nome_user = 	$resp_user['nome'];
$email_user = 	$resp_user['email'];
$ativo = 	$resp_user['ativo'];
$id_empresa = 	$resp_user['id_empresa'];
	}}
	
$dados_empresa = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='$id_empresa'");
	if(mysqli_num_rows($dados_empresa) > 0){
while ($resp_empresa = mysqli_fetch_array($dados_empresa)) {
$logo = $resp_empresa['logo'];
$telefone_app	 = 	$resp_empresa['telefone_app'];
	}}	
	
$veiculos_cont = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE id_cliente = '$id_cliente_login' AND deviceid >= '1'");
$total_veiculos = mysqli_num_rows($veiculos_cont);
if(mysqli_num_rows($veiculos_cont) > 0){
while ($resp_veic = mysqli_fetch_assoc($veiculos_cont)) {
$placa = 	$resp_veic['placa'];

	}}	
	
	
	
	$sql = mysqli_query($conn, "SELECT * FROM tc_positions WHERE deviceid='$deviceid' AND (servertime >= '$data_inicial' AND servertime <= '$data_final') ORDER BY id DESC LIMIT 1");
	if(mysqli_num_rows($sql) > 0){
while ($resp_sql = mysqli_fetch_assoc($sql)) {
		$latitude_final = $resp_sql['latitude'];
		$longitude_final = $resp_sql['longitude'];
		$km_1 = $resp_sql['attributes'];
		$obj_km1 = json_decode($km_1);
		$km_1 = $obj_km1->{'totalDistance'};;
	}}
	
	$sql1 = mysqli_query($conn, "SELECT * FROM tc_positions WHERE deviceid='$deviceid' AND (servertime >= '$data_inicial' AND servertime <= '$data_final') ORDER BY id ASC LIMIT 1");
	if(mysqli_num_rows($sql1) > 0){
while ($resp_sql1 = mysqli_fetch_assoc($sql1)) {
		$latitude_inicial = $resp_sql1['latitude'];
		$longitude_inicial = $resp_sql1['longitude'];
		$km_2 = $resp_sql1['attributes'];
		$obj_km2 = json_decode($km_2);
		$km_2 = $obj_km2->{'totalDistance'};;
	}}
	
	$totalkm = $km_1 - $km_2;
	$totalkm = $totalkm / 1000;
	$totalkm = round($totalkm, 2);
	$totalkm = number_format($totalkm, 2, ",", ".");


$cons_veiculo = mysqli_query($conn, "SELECT * FROM veiculos_clientes WHERE deviceid='$deviceid'");
if(mysqli_num_rows($cons_veiculo) > 0){
while ($resp_veic = mysqli_fetch_assoc($cons_veiculo)) {
		$id_cliente = $resp_veic['id_cliente'];
		$marca_veiculo =  $resp_veic['marca_veiculo'];
		$modelo_veiculo =  $resp_veic['modelo_veiculo'];
		$placa =  $resp_veic['placa'];
		$tipo_veiculo =  $resp_veic['tipo_veiculo'];
}}

if($tipo_veiculo == 'Automovel'){
	$carro = 'car.png';
}
else if($tipo_veiculo == 'Caminhao'){
	$carro = 'truck.png';
}
else if($tipo_veiculo == 'PickUp'){
	$carro = 'car.png';
}
else if($tipo_veiculo == 'Motocicleta'){
	$carro = 'moto.png';
} else {
$carro = 'car.png';
}

$cons_cliente = mysqli_query($conn, "SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
if(mysqli_num_rows($cons_cliente) > 0){
while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
		$nome_cliente = $resp_cliente['nome_cliente'];
}}


#----------------

		$cons_posicao = mysqli_query($conn,"SELECT * FROM tc_positions WHERE deviceid='$deviceid' AND (servertime >= '$data_inicial' AND servertime <= '$data_final') ORDER BY id ASC");
	if(mysqli_num_rows($cons_posicao) > 0){
	$i = $total;
	$last_ign = '';
while ($resp_posicao = mysqli_fetch_assoc($cons_posicao)) {
	--$i;
		$servertime1 = $resp_posicao['servertime'];
	$servertime = date('Y-m-d H:i:s', strtotime('-3 hour', strtotime($servertime1)));
	$data_format = date('d/m/Y H:i:s', strtotime('-3 hour', strtotime($servertime1)));
	$latitude = $resp_posicao['latitude'];
	$longitude = $resp_posicao['longitude'];
	$address = $resp_posicao['address'];
	$speed = $resp_posicao['speed'];
	$speed = $speed * 1.609;
	$speed = round($speed, 2);

		
		
	$cons_events = mysqli_query($conn, "SELECT * FROM tc_events WHERE deviceid='$deviceid' AND servertime > '$servertime1' AND type='ignitionOn' ORDER BY id ASC LIMIT 1");
		if(mysqli_num_rows($cons_events) > 0){
		while ($resp_events = mysqli_fetch_assoc($cons_events)) {
			$hora_partida = $resp_events['servertime'];
			$hora_partida1 = date('d/m/Y H:i:s', strtotime('-3 hour', strtotime($hora_partida)));
		}}
	
	
	$address1 = explode(',', $address);
					$result = count($address1);
					
					$bairro_n = $result -5;
					$bairro = $address1[$bairro_n];
					$estado_n = $result -2;
					$uf = $address1[$estado_n];
					$rua = $address1[0];
					$cidade_n = $result -4;
					$cidade = $address1[$cidade_n];
					
					$cidade_n2 = $result -3;
					$cidade2 = $address1[$cidade_n2];
					
					if($bairro == $rua){
						$bairro1 = '';
					} else {
						$bairro1 = $bairro;
					}
		
			$address_db = ''.$rua.' '.$bairro1.' - '.$cidade.' / '.$uf.'';
			$address_db = str_replace('Corredor de Transporte Coletivo', 'Av.', $address_db);
	
			$address = $address_db;
	
	
	

	
	
	
	$attributes = $resp_posicao['attributes'];
	$obj = json_decode($attributes);
	$ignicao = $obj->{'ignition'};
if (is_bool($ignicao)) $ignicao ? $ignicao = "true" : $ignicao = "false";
else if ($ignicao !== null) $ignicao = (string)$ignicao;


	$cons_veiculo = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE deviceid='$deviceid' ");
					if(mysqli_num_rows($cons_veiculo) > 0){
				while ($resp_veiculo = mysqli_fetch_assoc($cons_veiculo)) {
				$placa = 	$resp_veiculo['placa'];
				$bloqueio = 	$resp_veiculo['bloqueio'];
				$veiculo = ''.$resp_veiculo['marca_veiculo'].'/'.$resp_veiculo['modelo_veiculo'].'';

if($ignicao == 'true'){
	$ign2 = 'Ligada';
	$partida = '';
} elseif($ignicao == 'false' && $speed > 2){
	$ign2 = 'Ligada';
	$partida = '';
} else if ($ignicao == 'false'){
	$ign2 = 'Desligada';
	$cons_events = mysqli_query($conn, "SELECT * FROM tc_events WHERE deviceid='$deviceid' AND servertime < '$servertime1' AND type='ignitionOn' ORDER BY id DESC LIMIT 1");
		if(mysqli_num_rows($cons_events) > 0){
			while ($resp_events = mysqli_fetch_assoc($cons_events)) {
			$hora_partida = $resp_events['servertime'];
			$hora_partida1 = date('d/m/Y H:i:s', strtotime('-3 hour', strtotime($hora_partida)));
		}}
	$partida = '<span>Tempo Parado <br>das: <b>'.$hora_partida1.'</b> até: <b>'.$data_format.'</b></span>';
} 

$str_ign = 'Desligado';
	if($ignicao == 'true'){
		$str_ign = 'LIGADO';
	};
	if($agrupar == 'SIM'){
		if($last_ign == 'Desligado' && $str_ign == 'Desligado'){
			continue;
		};
	};
	$last_ign = $str_ign;
	
$popup = '<div class="card central" style="border:#000 1px solid;">
			<div class="card-header bg-dark">
				<span style="font-size:16px;color:#FFF"><b>'.$placa.' - '.$veiculo.'</b></span>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-8">
						<span><i class="fas fa-map-marker-alt"></i> '.$address_db.'</span><br>
						<span><b><i class="far fa-clock"></i> Data/Hora:</b> '.$data_format.'</span><br>
						<span><b><i class="fas fa-key"></i> Ignição:</b> '.$ign2.'</span><br>
						<span><b><i class="fas fa-tachometer-alt"></i> Velocidade:</b> '.$speed.' km/l</span><br><br>
						
						<span>Tempo Parado <br>de: <b>'.$hora_partida1.'</b> <br>até: <b>'.$data_format.'</b></span>
					</div>
					<div class="col-md-4 text-right">
						<span><a href="https://www.google.com/maps?layer=c&cbll='.$latitude.','.$longitude.'" target="_blank"><button type="button" class="btn btn-dark btn-sm btn-icon"><i class="fas fa-street-view"></i></button></a><br>
					</div>
				</div>
				
			</div>
		</div>';
	
	
	$marker = array($longitude, $latitude);
	

				$json[] = $marker;
				
				
				
	$marker1 = array('type' => 'Feature',
					'name' => $name, 
					'address' => $address, 
					'lat' => $latitude,
					'lng' => $longitude,
					'icon' => $ign,
					'placa' => $placa,
					'veiculo' => $veiculo,
					'data_format' => $data_format,
					'ignicao' => $ign2,
					'properties' => array('description' => $popup, 'message' => $veiculo, 'iconSize' => array('99', '73')),
					'geometry' => array('type' => 'Point', 'coordinates' => array($longitude, $latitude)));

				$json1[] = $marker1;

				$mark = array('type' => 'FeatureCollection',
			  'features' => $json1);
			  
			  
			  
			  
			

}}}}






  $positions = array('type' => 'Feature',
					'geometry' => array('type' => 'LineString', 'coordinates' => $json));

				$json_pos[] = $positions;

				$pos = array('type' => 'FeatureCollection',
			  'features' => $json_pos);





$geojson = json_encode($pos, JSON_PRETTY_PRINT);


$posicoes = json_encode($json, JSON_PRETTY_PRINT);
$registros = json_encode($mark, JSON_PRETTY_PRINT);
	
?>
					
					
					
                    <main id="js-page-content" role="main" class="page-content">
					
						                 
						<div class="row">
							<div class="col-md-12">
								<div  id="map" style=" height: 90vh;"></div>
								<div id="floating-panel">
									<button type="button" class="btn btn-dark btn-sm" id="replay">Reiniciar Trajeto</button> <a href="index.php?id=<?php echo $id_push?>&app=on"><button type="button" class="btn btn-primary btn-sm" id="replay">Retornar</button></a>
								</div>
								
							</div>
							
						</div>
						<br>
                        
                       
						
                    </main>
					
					
					 	<?php
							$cons_token = mysqli_query($conn,"SELECT * FROM chaves_maps ORDER BY id DESC LIMIT 1");
								if(mysqli_num_rows($cons_token) > 0){
							while ($resp_token = mysqli_fetch_assoc($cons_token)) {
							$token = 	$resp_token['chave'];
								}}
							?>
					
					
                    <!-- this overlay is activated only when mobile menu is triggered -->
                    <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div> <!-- END Page Content -->
                    <!-- BEGIN Page Footer -->

                    <!-- END Page Footer -->
                    <!-- BEGIN Shortcuts -->
                   
                </div>
            </div>
        </div>
        <!-- END Page Wrapper -->
        <!-- BEGIN Quick Menu -->

        <!-- END Quick Menu -->
        <!-- END Messenger -->
        <!-- BEGIN Page Settings -->

        <!-- END Page Settings -->
      
        <script src="/tracker3/app-assets/js/vendors.bundle.js"></script>
        <script src="/tracker3/app-assets/js/app.bundle.js"></script>
        <script src="/tracker3/app-assets/js/datagrid/datatables/datatables.bundle.js"></script>
<script src='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css' rel='stylesheet' />
<script src="https://cdn.jsdelivr.net/npm/@turf/turf@5/turf.min.js"></script>

<script>

	mapboxgl.accessToken = '<?php echo $token?>';

	var map = new mapboxgl.Map({
	container: 'map',
	style: 'mapbox://styles/mapbox/streets-v11',
	center: [<?php echo $longitude_inicial?>,<?php echo $latitude_inicial?>],
	zoom: 15
});

function AutoCenter() {
    //  Create a new viewpoint bound

var bounds = new mapboxgl.LngLatBounds();

	posicoes.features.forEach(function(feature) {
		   bounds.extend(feature.geometry.coordinates);
	});

	map.fitBounds(bounds, {padding: 40});

}

let url_chegada = '/tracker2/Imagens/icons/chegada.png'
let url_inicio = '/tracker2/Imagens/icons/inicio.png'
var posicoes = <?php echo $registros?>;
var geojson = <?php echo $geojson?>;

var origin = [<?php echo $longitude_inicial?>,<?php echo $latitude_inicial?>];



var destination = [<?php echo $longitude_final?>,<?php echo $latitude_final?>];
 
// A simple line from origin to destination.
var route = {
	'type': 'FeatureCollection',
	'features': [
		{
		'type': 'Feature',
		'geometry': {
			'type': 'LineString',
			'coordinates': <?php echo $posicoes?>
		}
		}
	]
};
 
// A single point that animates along the route.
// Coordinates are initially set to origin.
var point = {
	'type': 'FeatureCollection',
	'features': [
	{
	'type': 'Feature',
	'properties': {},
	'geometry': {
	'type': 'Point',
	'coordinates': origin
	}
	}
	]
};
 
// Calculate the distance in kilometers between route start/end point.
var lineDistance = turf.length(route.features[0]);
 
var arc = [];

 
// Number of steps to use in the arc and animation, more steps means
// a smoother arc and animation, but too many steps will result in a
// low frame rate
var steps = 2000;
 
// Draw an arc between the `origin` & `destination` of the two points
for (var i = 0; i < lineDistance; i += lineDistance / steps) {
	var segment = turf.along(route.features[0], i);
	arc.push(segment.geometry.coordinates);
}
 
// Update the route with calculated arc coordinates
route.features[0].geometry.coordinates = arc;
 
// Used to increment the value of the point measurement against the route.
var counter = 0;
 
map.on('load', function () {



	map.loadImage(
'/tracker2/Imagens/<?php echo $carro?>',
function (error, image) {
if (error) throw error;
map.addImage('cat', image);


}
);
	

	
	var el_ini = document.createElement('div');
	el_ini.className = 'marker';
	el_ini.style.backgroundImage ='url('+url_inicio+')';
	el_ini.style.width = '35px';
	el_ini.style.height = '42px';

	var el_fim = document.createElement('div');
	el_fim.className = 'marker';
	el_fim.style.backgroundImage ='url('+url_chegada+')';
	el_fim.style.width = '42px';
	el_fim.style.height = '50px';
	
	
	
	var marker_inicial = new mapboxgl.Marker(el_ini).setLngLat(origin).addTo(map);
	
	var marker_final = new mapboxgl.Marker(el_fim).setLngLat(destination).addTo(map);
	
	
// Add a source and layer displaying a point which will be animated in a circle.
	map.addSource('route', {
		'type': 'geojson',
		'data': route
	});
 
	map.addSource('point', {
		'type': 'geojson',
		'data': point
	});
 
	map.addLayer({
		'id': 'route',
		'source': 'route',
		'type': 'line',
		'paint': {
			'line-width': 3,
			'line-color': '#000'
		}
	});
 
	map.addLayer({
		'id': 'point',
		'source': 'point',
		'type': 'symbol',
		'layout': {
			'icon-image': 'cat',
			'icon-size': 0.3,
			'icon-rotate': ['get', 'bearing'],
			'icon-rotation-alignment': 'map',
			'icon-allow-overlap': true,
			'icon-ignore-placement': true
		}
	});


	posicoes.features.forEach(function (marker) {
		
			var info_ponto = marker.properties.description;
			console.log(info_ponto);
		
			var el_ponto = document.createElement('div');
			el_ponto.className = 'marker';
			el_ponto.style.backgroundImage ='url(/tracker2/Imagens/icons/map2.png)';
			el_ponto.style.width = '13px';
			el_ponto.style.height = '13px';
			
			var el_parada = document.createElement('div');
			el_parada.className = 'marker';
			el_parada.style.backgroundImage ='url(/tracker2/Imagens/icons/parada.png)';
			el_parada.style.width = '35px';
			el_parada.style.height = '42px';
			
			var popup_ponto = new mapboxgl.Popup({ closeOnClick: false }).setLngLat(marker.geometry.coordinates).setHTML(marker.properties.description)
			
			
			if(marker.ignicao == 'Desligada'){
				
				var marker_ponto = new mapboxgl.Marker(el_parada).setLngLat(marker.geometry.coordinates).setPopup(popup_ponto).addTo(map);
			}
			
			
			
		});

 
function animate() {
	var start =
	route.features[0].geometry.coordinates[
	counter >= steps ? counter - 1 : counter
	];
	var end =
	route.features[0].geometry.coordinates[
	counter >= steps ? counter : counter + 1
	];
	if (!start || !end) return;
	 
	// Update point geometry to a new position based on counter denoting
	// the index to access the arc
	point.features[0].geometry.coordinates =
	route.features[0].geometry.coordinates[counter];
	 
	// Calculate the bearing to ensure the icon is rotated to match the route arc
	// The bearing is calculated between the current point and the next point, except
	// at the end of the arc, which uses the previous point and the current point
	point.features[0].properties.bearing = turf.bearing(
		turf.point(start),
		turf.point(end)
	);
 
// Update the source with this new data
	map.getSource('point').setData(point);
 
// Request the next frame of animation as long as the end has not been reached
	if (counter < steps) {
		requestAnimationFrame(animate);
	}
 
	counter = counter + 1;
}
 
document
.getElementById('replay')
.addEventListener('click', function () {
	// Set the coordinates of the original point back to origin
	point.features[0].geometry.coordinates = origin;
 
	// Update the source layer
	map.getSource('point').setData(point);
 
	// Reset the counter
	counter = 0;
	 
	// Restart the animation
	animate(counter);
});
 
// Start the animation
animate(counter);
});
</script>
    </body>
</html>
