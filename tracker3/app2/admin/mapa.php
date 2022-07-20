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

$result_veiculos = mysqli_query($conn, "SELECT * FROM veiculos_clientes WHERE status = '1'");
$total_veiculos = mysqli_num_rows($result_veiculos);

$nome_empesa = 'JC Rastreamento';





// Select all the rows in the markers table
$result_markers = "SELECT * FROM tc_devices WHERE contact !='ESTOQUE'";
$resultado_markers = mysqli_query($conn, $result_markers);


// Iterate through the rows, printing XML nodes for each
while ($row_markers = mysqli_fetch_assoc($resultado_markers)){
	
	$id_device = $row_markers['id'];
	$position_id = $row_markers['positionid'];
	$name = $row_markers['name'];
	$category = $row_markers['category'];
	
	$cons_posicao = mysqli_query($conn,"SELECT * FROM tc_positions WHERE id='$position_id' ");
	if(mysqli_num_rows($cons_posicao) > 0){
while ($resp_posicao = mysqli_fetch_assoc($cons_posicao)) {
		$servertime1 = $resp_posicao['servertime'];
	$servertime = date('Y-m-d H:i:s', strtotime('-3 hour', strtotime($servertime1)));
	$data_format = date('d/m/Y H:i:s', strtotime('-3 hour', strtotime($servertime1)));
	$latitude = $resp_posicao['latitude'];
	$longitude = $resp_posicao['longitude'];
	$address = $resp_posicao['address'];
	$speed = $resp_posicao['speed'];
	$address = utf8_encode($address);
	
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
	
			$address = utf8_encode($address_db);
	
	
	
	$deviceid = $resp_posicao['deviceid'];
	
	
	
	$attributes = $resp_posicao['attributes'];
	$obj = json_decode($attributes);
	$ignicao = $obj->{'ignition'};
if (is_bool($ignicao)) $ignicao ? $ignicao = "true" : $ignicao = "false";
else if ($ignicao !== null) $ignicao = (string)$ignicao;


	$cons_veiculo = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE deviceid='$id_device' ");
					if(mysqli_num_rows($cons_veiculo) > 0){
				while ($resp_veiculo = mysqli_fetch_assoc($cons_veiculo)) {
				$placa = 	$resp_veiculo['placa'];
				$bloqueio = 	$resp_veiculo['bloqueio'];
				$veiculo = ''.$resp_veiculo['marca_veiculo'].'/'.$resp_veiculo['modelo_veiculo'].'';

if($ignicao == 'true' && $speed >= 6 && $bloqueio == 'NAO'){
	$ign = ''.$category.'_s.png';
	$ign2 = 'Ligada';
} else if ($ignicao == 'true' && $speed <= 5 && $bloqueio == 'NAO'){
	$ign = ''.$category.'_w.png';	
	$ign2 = 'Ligada';
} else if ($ignicao == 'true' && $speed <= 5 && $bloqueio == 'SIM'){
	$ign = ''.$category.'_d.png';
$ign2 = 'Desligada';	
} else if ($ignicao == 'false' && $speed <= 5 && $bloqueio == 'SIM'){
	$ign = ''.$category.'_d.png';	
	$ign2 = 'Desligada';
} else {
	$ign = ''.$category.'.png';	
	$ign2 = 'Desligada';
}
	
	
	$marker = array('type' => 'Feature',
					'name' => $name, 
					'address' => $address, 
					'lat' => $latitude,
					'lng' => $longitude,
					'icon' => $ign,
					'placa' => $placa,
					'veiculo' => $veiculo,
					'data_format' => $data_format,
					'ignicao' => $ignicao,
					'properties' => array('message' => $veiculo, 'iconSize' => array('99', '73')),
					'geometry' => array('type' => 'Point', 'coordinates' => array($longitude, $latitude)));

				$json[] = $marker;

				$mark = array('type' => 'FeatureCollection',
			  'features' => $json);

}}}}}



$posicoes = json_encode($mark, JSON_PRETTY_PRINT);

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
    
<body class="theme-light" data-highlight="blue2" onload="AutoCenter();">
    
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
       <a href="#" onclick="AutoCenter();"><i class="fas fa-car"></i><span>Todos</span></a>
        <a href="index.php?id=<?php echo $id_push?>" class="active-nav" onclick="carregar();"><i class="fas fa-car"></i><span>Veículos</span></a>
        <a href="#" data-menu="menu-main"><i class="fa fa-bars"></i><span>Menu</span></a>
    </div>
    
    <div class="page-content">
        <br>
        <div class="page-title page-title-large">
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
            <div class="content">
                <h2 class="font-24 font-700 mb-2"></h2>
                <p class="mb-1">
                    Foram encontrados <?php echo $total_veiculos?> veículos. Para ver no mapa, clique no endereço.
                </p>
            </div>
			<div id="map" style=" height: 85vh;"></div>
        </div>

			
        <input type="hidden" id="id_push" value="<?php echo $id_push?>">

        <!-- footer and footer card-->
        
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
    
   <div id="aguarde" class="menu menu-box-modal rounded-m" 
         data-menu-height="120" 
         data-menu-width="310">
        <h1 class="text-center mt-3 pt-1"><i class="fa fa-sync fa-spin mr-3 fa-2x"></i></h1>
        
        <p class="boxed-text-l">
            Por favor, aguarde...
        </p>
    </div>

    
</div>    


<script type="text/javascript" src="../scripts/jquery.js"></script>
<script type="text/javascript" src="../scripts/bootstrap.min.js"></script>
<script type="text/javascript" src="../scripts/custom.js"></script>
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

var id_push = document.getElementById("id_push").value;

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
center: [-51.184013, -30.017217666666667],
zoom: 9,
attributionControl: false
});

map.on("load", function(e) {
map.resize();
});

var tipo_mapbox = 0
function setSatellite(){
   map.setStyle('mapbox://styles/mapbox/satellite-streets-v11');
    tipo_mapbox = 1
}

function setMap(){
	map.setStyle('mapbox://styles/mapbox/streets-v11');
    tipo_mapbox = 0
}

function setNoite(){
	map.setStyle('mapbox://styles/mapbox/navigation-night-v1');
    tipo_mapbox = 0
}

map.addControl(new mapboxgl.FullscreenControl());
map.addControl(new mapboxgl.NavigationControl());
var mapboxMarkers = []

function AutoCenter() {
    //  Create a new viewpoint bound

var bounds = new mapboxgl.LngLatBounds();

posicoes.features.forEach(function(feature) {
	   bounds.extend(feature.geometry.coordinates);
});

map.fitBounds(bounds, {padding: 40});

  }

function zoom(){
  AutoCenter()
}

var posicoes = <?php echo $posicoes?>;
function refreshMap(){
  downloadUrl('resultado.php?id_empresa=1361', (data) => {
    var xml = data.responseXML;
      markers = xml.documentElement.getElementsByTagName('marker');
      

      Array.prototype.forEach.call(markers, function(markerElem) {

           var name = markerElem.getAttribute('name');
          var address = markerElem.getAttribute('address');
          var cliente = markerElem.getAttribute('cliente');
          var ign = markerElem.getAttribute('ign');
          var latitude = markerElem.getAttribute('lat');
          var longitude = markerElem.getAttribute('lng');
          var placa = markerElem.getAttribute('placa');
          var data_format = markerElem.getAttribute('data_format');
		   var lastupdate = markerElem.getAttribute('lastupdate');
          var ignicao = markerElem.getAttribute('ignicao');
          var imei = markerElem.getAttribute('imei');
          var chip = markerElem.getAttribute('chip');
          var modelo_equip = markerElem.getAttribute('modelo_equip');
          var operadora = markerElem.getAttribute('operadora');
          var bloqueio = markerElem.getAttribute('bloqueio');
          var conexao = markerElem.getAttribute('conexao');
          var alimentacao = markerElem.getAttribute('alimentacao');
          var cor_alimentacao = markerElem.getAttribute('cor_alimentacao');
          var veic_volts = markerElem.getAttribute('veic_volts');
          var veic_bateria_interna = markerElem.getAttribute('veic_bateria_interna');
          var veic_gsm = markerElem.getAttribute('veic_gsm');
          var veic_satelite = markerElem.getAttribute('veic_satelite');
          var deviceid = markerElem.getAttribute('deviceid');
          var point = [parseFloat(longitude), parseFloat(latitude)]

            
            // add marker to map
          var encontrou = false;
          for(let i = 0; i<= mapboxMarkers.length-1; i++){
            if(mapboxMarkers[i].name == name){
                  encontrou = true
                  if(String(ign) != String(mapboxMarkers[i].ign)
                          || String(latitude) != String(mapboxMarkers[i].latitude)
                          || String(longitude) != String(mapboxMarkers[i].longitude)
						   || String(point) != String(mapboxMarkers[i].point)
                          ){
							
							
							
													  
							
						
							  
                            var el = document.createElement('div');
                            el.className = 'marker';
                            el.style.backgroundImage =
                            'url(/tracker2/manager/imagens/icons/'+ign;
                            el.style.width = '99px';
                            el.style.height = '73px';
                            var infotitle = '';
                    
                      
                            var popup = new mapboxgl.Popup({ closeOnClick: false,  offset: 25 }).setLngLat([-96, 37.8]).setHTML(infotitle)
                            var marker = new mapboxgl.Marker(el).setLngLat([longitude, latitude]).addTo(map);
							
							
							
							 
                            
                            var tagg = {
                                name: name,
                                point: point,
                                ign: ign,
                                marcador: marker
                            }
							
							el.addEventListener('click', () => 
							   { 
								map.flyTo({
								center: point,
								speed: 0.8,
								zoom: 15
								});
								top.location='grid_device.php?deviceid='+deviceid+'&id='+id_push;
							   }
							); 
							
							
										
							
							 
                            mapboxMarkers.push(tagg)
                            mapboxMarkers[i].marcador.remove();
                            mapboxMarkers.splice(i, 1)
						
											   
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
				  
				 
				  
                  var infotitle = '';
					 
					  
                   var popup = new mapboxgl.Popup({ closeOnClick: false,  offset: 25 }).setLngLat([-96, 37.8]).setHTML(infotitle)
                  var marker = new mapboxgl.Marker(el).setLngLat([longitude, latitude]).addTo(map);
				  
				  
                  
                  var tagg = {
                      name: name,
                      point: point,
                      ign: ign,
                      marcador: marker
                  }
				  
				el.addEventListener('click', () => 
							   { 
								map.flyTo({
								center: point,
								speed: 0.8,
								zoom: 15
								});
								top.location='grid_device.php?deviceid='+deviceid+'&id='+id_push;
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
}, 20000);
console.log(mapboxMarkers)
	// add markers to map
/*
geojson.features.forEach(function(marker) {
  // create a DOM element for the marker
  var el = document.createElement('div');
  el.className = 'marker';
  el.style.backgroundImage =
  'url(/tracker2/Imagens/icons/car.png';
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
