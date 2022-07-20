<?php


include_once("conexao.php");
//header('Content-Type: application/json');
$date = date('Y-m-d');	

$agrupar = 'SIM';

$data_i1 = $_REQUEST['data_inicial'];
//$data_i1 = '2021-02-17 06:00:00';

$data_inicial = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_i1)));
$data_inicial_1 = date('d/m/Y H:i' , strtotime($data_i1));


$data_f1 = $_REQUEST['data_final'];
//$data_f1 = '2021-02-17 14:00:00';

$data_final = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_f1)));
$data_final_1 = date('d/m/Y H:i' , strtotime($data_f1));




$deviceid = $_REQUEST['deviceid'];
$id_relatorio = $_REQUEST['id_relatorio'];
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

			
$cons_relatorio = mysqli_query($conn, "SELECT * FROM relatorios_posicoes WHERE id_relatorio='$id_relatorio'");
	if(mysqli_num_rows($cons_relatorio) > 0){
		while ($resp_rel = mysqli_fetch_assoc($cons_relatorio)) {
		$id_relatorio = $resp_rel['id_relatorio'];
		$posicao_inicial = $resp_rel['posicao_inicial'];
		$posicao_final = $resp_rel['posicao_final'];

	}}

#------------------------



// Select all the rows in the markers table

	
$cons_pos = mysqli_query($conn,"SELECT * FROM posicoes_relatorios WHERE id_relatorio='$id_relatorio' ORDER BY fixtime ASC");
	if(mysqli_num_rows($cons_pos) > 0){
		while ($resp_pos = mysqli_fetch_assoc($cons_pos)) {
		$horario = $resp_pos['fixtime'];
		$horario_br = date('d/m/Y H:i:s', strtotime("$horario"));
		$ign2 = $resp_pos['ignicao'];
		$latitude = $resp_pos['latitude'];
		$longitude = $resp_pos['longitude'];
		$endereco = $resp_pos['endereco'];
		$veloc = $resp_pos['speed'];
		$movimento = $resp_pos['movimento'];
		$id_pos = $resp_pos['id'];
		
			
		if($ign2 == 'Desligada'){
			$cons_posicao_desl = mysqli_query($conn,"SELECT * FROM posicoes_relatorios WHERE id_relatorio = '$id_relatorio' AND fixtime > '$horario' AND ignicao = 'Ligada' ORDER BY id ASC LIMIT 1");
				
				if(mysqli_num_rows($cons_posicao_desl) > 0){
					while ($resp_posicao_desl = mysqli_fetch_assoc($cons_posicao_desl)) {
					$hora_proximo = $resp_posicao_desl['fixtime'];
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
		if($ign2 == 'Ligada'){
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

	
$popup = '<div class="card central" style="border:#000 1px solid; background-color:#FFF">
			<div class="card-header bg-dark">
				<span style="font-size:16px;color:#FFF"><b>'.$placa.' - '.$veiculo_mapa.'</b></span>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-8">
						<span><i class="fas fa-map-marker-alt"></i> '.$endereco.'</span><br>
						<span><b><i class="far fa-clock"></i> Data/Hora:</b> '.$data_format.'</span><br>
						<span><b><i class="fas fa-key"></i> Ignição:</b> '.$ign2.'</span><br>
						<span><b><i class="fas fa-tachometer-alt"></i> Velocidade:</b> '.$veloc.' km/l</span><br><br>
						'.$data_pos.'
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
			  
			  
			  
			  
			

}}



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
    <link rel="apple-touch-icon" href="http://jctracker.com.br/tracker2/app-assets/images/ico/apple-icon-120.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/tracker3/app-assets/img/favicon/favicon-32x32.png">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="http://jctracker.com.br/tracker2/app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="http://jctracker.com.br/tracker2/app-assets/vendors/css/charts/apexcharts.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="http://jctracker.com.br/tracker2/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="http://jctracker.com.br/tracker2/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="http://jctracker.com.br/tracker2/app-assets/css/colors.css">


    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="http://jctracker.com.br/tracker2/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="http://jctracker.com.br/tracker2/app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="http://jctracker.com.br/tracker2/app-assets/css/pages/dashboard-ecommerce.css">
    <link rel="stylesheet" type="text/css" href="http://jctracker.com.br/tracker2/app-assets/css/pages/card-analytics.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="http://jctracker.com.br/tracker2/assets/css/style.css">
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
												  PERCURSO - PERÍODO: <?php echo $data_inicial_1?> ATÉ <?php echo $data_final_1?>
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
    <script src="http://jctracker.com.br/tracker2/app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="http://jctracker.com.br/tracker2/app-assets/vendors/js/charts/apexcharts.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="http://jctracker.com.br/tracker2/app-assets/js/core/app-menu.js"></script>
    <script src="http://jctracker.com.br/tracker2/app-assets/js/core/app.js"></script>
    <script src="http://jctracker.com.br/tracker2/app-assets/js/scripts/components.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="http://jctracker.com.br/tracker2/app-assets/js/scripts/pages/dashboard-ecommerce.js"></script>
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
			el_parada.style.width = '35px';
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