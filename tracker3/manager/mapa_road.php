<?php


include_once("conexao.php");
//header('Content-Type: application/json');
$date = date('Y-m-d');	

$agrupar = $_REQUEST['agrupar'];

$data_i1 = $_REQUEST['data_inicial'];
//$data_i1 = '2021-02-17 06:00:00';

$data_inicial = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_i1)));
$data_inicial_1 = date('d/m/Y H:i' , strtotime($data_i1));


$data_f1 = $_REQUEST['data_final'];
//$data_f1 = '2021-02-17 14:00:00';

$data_final = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_f1)));
$data_final_1 = date('d/m/Y H:i' , strtotime($data_f1));




$deviceid = $_REQUEST['deviceid'];
//$deviceid = '17';


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

	
		$cons_posicao = mysqli_query($conn,"SELECT * FROM tc_positions WHERE deviceid='$deviceid' AND (servertime >= '$data_inicial' AND servertime <= '$data_final') ORDER BY id ASC");
	if(mysqli_num_rows($cons_posicao) > 0){
while ($resp_posicao = mysqli_fetch_assoc($cons_posicao)) {
		$servertime1 = $resp_posicao['servertime'];
	$servertime = date('Y-m-d H:i:s', strtotime('-3 hour', strtotime($servertime1)));
	$data_format = date('d/m/Y H:i:s', strtotime('-3 hour', strtotime($servertime1)));
	$latitude = $resp_posicao['latitude'];
	$longitude = $resp_posicao['longitude'];
	$address = $resp_posicao['address'];
	$speed = $resp_posicao['speed'];
	$speed = $speed * 1.609;
	$speed = round($speed, 2);
	
	
	
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
						'.$partida.'
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



$posicoes = json_encode($mark, JSON_PRETTY_PRINT);


  $positions = array('type' => 'Feature',
					'geometry' => array('type' => 'LineString', 'coordinates' => $json));

				$json_pos[] = $positions;

				$pos = array('type' => 'FeatureCollection',
			  'features' => $json_pos);





$geojson = json_encode($pos, JSON_PRETTY_PRINT);


?>
<?php
		$cons_token = mysqli_query($conn,"SELECT * FROM chaves_maps ORDER BY id DESC LIMIT 1");
			if(mysqli_num_rows($cons_token) > 0){
		while ($resp_token = mysqli_fetch_assoc($cons_token)) {
		$token = 	$resp_token['chave'];
			}}
		?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>MAPA RELÁTORIO</title>
    <link rel="apple-touch-icon" href="../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/charts/apexcharts.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/colors.css">


    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/pages/dashboard-ecommerce.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/pages/card-analytics.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <!-- END: Custom CSS-->
	<script src="https://kit.fontawesome.com/a132241e15.js"></script>
	<style>
#floating-panel {
  position: absolute;
  top: 10%;
  left: 2%;
  z-index: 9999;
  background-color:  rgb(255, 255, 255, 0);
  padding: 5px;
  text-align: center;
  font-family: 'Roboto','sans-serif';
  line-height: 30px;
  padding-left: 10px;
}
.mapboxgl-popup {
  width: 500px;
  height: 200px;
  z-index:9999999;
}

.mapboxgl-popup-content {
   width: 500px;
   
}

.mapboxgl-popup-tip{
  margin-bottom: 35px;
}
.mapboxgl-popup-close-button {
    position: absolute;
    right: 0;
    top: 0;
    border: 0;
    border-radius: 0 3px 0 0;
    cursor: pointer;
    background-color: #000;
    font-size: 30px;
}
.central{
	height: 250px;
    border: #000 1px solid;
    width: 510px;
    position: fixed;
    top: -1px;
    left: 3px;
	
}
</style>
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern semi-dark-layout 2-columns" onLoad="AutoCenter();">

    <!-- BEGIN: Header-->

    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->

    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
       
        <div class="content-wrapper">
            <section id="validation">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                               
                                <div class="card-content">
                                    <div class="card-body">
                                        
											 <div class="panel-hdr">
												<h4>
												  PERCURSO REALIZADO - PERÍODO: <?php echo $data_inicial_1?> ATÉ <?php echo $data_final_1?>
												</h4>
												<h5>
												  VEÍCULO: <?php echo $placa?> - <?php echo $veiculo_mapa ?>
												</h5>
												
											</div>
                                           <div class="row">
												<div class="col-lg-12">
													 <div id="map" style="width:100%; height:600px;"><div class="spinner-border text-dark" role="status"><span class="sr-only">Loading...</span></div></div>
													
													<input type="hidden" id="data_ini" value="<?php echo $data_inicial ?>">
												<input type="hidden" id="data_fin" value="<?php echo $data_final ?>">
												<input type="hidden" id="device_id" value="<?php echo $deviceid ?>">
												<input type="hidden" id="agrupar" value="<?php echo $agrupar ?>">
													
												</div>

											</div><br>
											
											
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
        </div>
    </div>
    <!-- END: Content-->
	
	<div id="status_comando" style="display:none"></div>
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="../app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../app-assets/vendors/js/charts/apexcharts.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../app-assets/js/core/app-menu.js"></script>
    <script src="../app-assets/js/core/app.js"></script>
    <script src="../app-assets/js/scripts/components.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../app-assets/js/scripts/pages/dashboard-ecommerce.js"></script>
    <!-- END: Page JS-->

        <script src="js/datagrid/datatables/datatables.bundle.js"></script>
		<script src="js/formplugins/select2/select2.bundle.js"></script>
		<script src="https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.js"></script>
<link href="https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css" rel="stylesheet" />

<script>

mapboxgl.accessToken = '<?php echo $token?>';

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

  var url = '/tracker2/manager/imagens/icons/arrow.png';
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
		
		
		var posicao_inicial = [position.features[0].lng, position.features[0].lat];
		let posicao_final = [position.features[position.features.length-1].lng, position.features[position.features.length-1].lat];
		
		var popup_inicial = new mapboxgl.Popup({ closeOnClick: false }).setLngLat(posicao_inicial).setHTML(position.features[0].properties.description);
		
		var popup_final = new mapboxgl.Popup({ closeOnClick: false }).setLngLat(posicao_final).setHTML(position.features[position.features.length-1].properties.description);
		
		
		var el_ini = document.createElement('div');
			el_ini.className = 'marker';
			el_ini.style.backgroundImage ='url(/tracker2/manager/imagens/icons/inicio.png)';
			el_ini.style.width = '35px';
			el_ini.style.height = '42px';
			el_ini.style.zIndex  = '9999999';
		
		var el_fim = document.createElement('div');
			el_fim.className = 'marker';
			el_fim.style.backgroundImage ='url(/tracker2/manager/imagens/icons/chegada.png)'
			el_fim.style.width = '42px';
			el_fim.style.height = '50px';
			el_fim.style.zIndex  = '9999999';
		
		
		var marker_inicial = new mapboxgl.Marker(el_ini).setLngLat(posicao_inicial).setPopup(popup_inicial).addTo(map);
		
		
		var marker_final = new mapboxgl.Marker(el_fim).setLngLat(posicao_final).setPopup(popup_final).addTo(map);
		
		
		
		
		
		
		
		position.features.forEach(function (marker) {
		
			var info_ponto = marker.properties.description;
			console.log(info_ponto);
		
			var el_ponto = document.createElement('div');
			el_ponto.className = 'marker';
			el_ponto.style.backgroundImage ='url(/tracker2/manager/imagens/icons/map2.png)';
			el_ponto.style.width = '13px';
			el_ponto.style.height = '13px';
			
			var el_parada = document.createElement('div');
			el_parada.className = 'marker';
			el_parada.style.backgroundImage ='url(/tracker2/manager/imagens/icons/map3.png)';
			el_parada.style.width = '99px';
			el_parada.style.height = '73px';
			
			var popup_ponto = new mapboxgl.Popup({ closeOnClick: false }).setLngLat(marker.geometry.coordinates).setHTML(marker.properties.description)
			
			if(marker.ignicao == 'Ligada'){
				
				var marker_ponto = new mapboxgl.Marker(el_ponto).setLngLat(marker.geometry.coordinates).setPopup(popup_ponto).addTo(map);
			}
			if(marker.ignicao == 'Desligada'){
				
				var marker_ponto = new mapboxgl.Marker(el_parada).setLngLat(marker.geometry.coordinates).setPopup(popup_ponto).addTo(map);
			}
			
			
			
		});
		
	 

	});


    </script>
</body>
<!-- END: Body-->

</html>