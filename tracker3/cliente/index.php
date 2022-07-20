<?php include('conexao.php');

$cons_usuario20 = mysqli_query($conn,"SELECT * FROM usuarios WHERE id_usuarios='$user_id'");
	if(mysqli_num_rows($cons_usuario20) > 0){
while ($resp_usuario11 = mysqli_fetch_assoc($cons_usuario20)) {
$id_cliente_1 = 	$resp_usuario11['id_cliente'];
$ativo = 	$resp_usuario11['ativo'];

	}}

if($ativo != 'SIM'){
	header('Location: ../../tracker/index.php?active=error');
}

$cons_cli10 = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente_1'");
	if(mysqli_num_rows($cons_cli10) > 0){
while ($resp_cor30 = mysqli_fetch_assoc($cons_cli10)) {
$id_cliente_pai_ini = 	$resp_cor30['id_cliente_pai'];

	}}
	
$cons_cli_cor = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente_pai_ini'");
	if(mysqli_num_rows($cons_cli_cor) > 0){
while ($resp_cor = mysqli_fetch_assoc($cons_cli_cor)) {
$cor_sistema1 = 	$resp_cor['cor_sistema'];
$logo1 = 	$resp_cor['logo'];
$login_padrao1 = 	$resp_cor['subdominio'];
$telefone_residencial1 = 	$resp_cor1['telefone_residencial'];
	}}
	
if($id_cliente_pai_ini == 1361){
	$logo = '/tracker/Imagens/logo1.png';
	$cor_sistema = '#14145A';
	$login_padrao = 'RMB';
}

if($id_cliente_pai_ini != 1361){
	$logo = '/tracker3/manager/logos/'.$logo1;
	$cor_sistema = $cor_sistema1;
	$login_padrao = $login_padrao1;

}
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
           <?php echo $login_padrao?> | Sistema de Gestão Rastreamento
        </title>
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
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $logo?>">
        <link rel="mask-icon" href="/tracker3/app-assets/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/datagrid/datatables/datatables.bundle.css">
		<link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/fa-solid.css">
		<link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/statistics/chartjs/chartjs.css">
		<script src="https://kit.fontawesome.com/a132241e15.js"></script>
<style>
.Ligada{
color: #08700a;
}
.Desligada{
  color: #bd0202
}
.mapboxgl-popup {
  width: 500px;
}

.mapboxgl-popup-content {
   width: 500px;
}

.mapboxgl-popup-tip{
  margin-bottom: 35px;
}
#botoes {
  position: absolute;
  bottom: 5%;
  right: 3%;
  z-index: 5;
  background-color:  rgb(255, 255, 255, 0);
  padding: 5px;
  text-align: center;
  font-family: 'Roboto','sans-serif';
  line-height: 30px;
  padding-left: 10px;
}
#floating-panel5 {
  position: absolute;
  top: 4%;
  left: 4%;
  z-index: 5;
  background-color:  rgb(255, 255, 255, 0);
  padding: 5px;
  text-align: center;
  font-family: 'Roboto','sans-serif';
  line-height: 30px;
  padding-left: 10px;
}
#floating-panel6 {
  position: absolute;
  top: 4%;
  left: 18%;
  z-index: 5;
  background-color:  rgb(255, 255, 255, 0);
  padding: 5px;
  text-align: center;
  font-family: 'Roboto','sans-serif';
  line-height: 30px;
  padding-left: 10px;
}
#floating-panel7 {
  position: absolute;
  top: 4%;
  left: 32%;
  z-index: 5;
  background-color:  rgb(255, 255, 255, 0);
  padding: 5px;
  text-align: center;
  font-family: 'Roboto','sans-serif';
  line-height: 30px;
  padding-left: 10px;
}
#floating-panel8 {
  position: absolute;
  top: 4%;
  left: 46%;
  z-index: 5;
  background-color:  rgb(255, 255, 255, 0);
  padding: 5px;
  text-align: center;
  font-family: 'Roboto','sans-serif';
  line-height: 30px;
  padding-left: 10px;
}

</style>
    </head>
    <body class="mod-bg-1 nav-function-fixed header-function-fixed" onload="AutoCenter();">
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
                <aside class="page-sidebar" style="background-color:#FFF">
                    <div style="background-color:#FFF">
                        <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative">
                           <img src="<?php echo $logo?>" style="width:200px; heigth:auto" alt="SmartAdmin WebApp" aria-roledescription="logo">
                            
                            
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
	
$data = date('d/m/Y');
$date = date('Y-m-d');


$cons_usuarios = mysqli_query($conn,"SELECT * FROM usuarios WHERE id_usuarios ='$user_id'");
if(mysqli_num_rows($cons_usuarios) > 0){
	while ($resp_usuario = mysqli_fetch_assoc($cons_usuarios)) {
    $id_cliente = $resp_usuario['id_cliente'];
}}


$cont_veiculos = mysqli_query($conn,"SELECT * FROM tc_devices WHERE contact ='$id_cliente'");
if(mysqli_num_rows($cont_veiculos) > 0){
  while ($resp_device = mysqli_fetch_assoc($cont_veiculos)) {
    $id_device = $resp_device['id'];
    $id_position = $resp_device['positionid'];
    
    $cont_posicao = mysqli_query($conn,"SELECT * FROM tc_positions WHERE id='$id_position'");
    $cont_ligado = 0;
    $cont_desligado = 0;
		if(mysqli_num_rows($cont_posicao) > 0){
      while ($resp_position = mysqli_fetch_assoc($cont_posicao)) {
        $attributes = $resp_position['attributes'];
        $obj = json_decode($attributes);
        $ignicao = $obj->{'ignition'};
        if (is_bool($ignicao)) $ignicao ? $ignicao = "true" : $ignicao = "false";
        else if ($ignicao !== null) $ignicao = (string)$ignicao;
        if($ignicao == 'true'){
          $cont_ligado++;
        } else{
          $cont_desligado++;	
        }

      }
    }
  }
}





// Select all the rows in the markers table
$result_markers = "SELECT * FROM tc_devices WHERE contact ='$id_cliente'";
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
					
                    <main id="js-page-content" role="main" class="page-content">
					
						<div class="row">
							<div class="col-md-4">
							</div>
							<div class="col-md-2">
								<div class="row bg-white" style="border-radius:5px; border:#000000 2px solid; color:#000; width:90%;" data-toggle="tooltip" data-placement="bottom" data-offset="0,10" data-original-title="Veículos Desligados">
									<div class="col-md-6 text-left" >
										<span> <b><i class="fas fa-key"></i></b></span>
									</div>
									<div class="col-md-6">
										<b><div id="desligados"></div></b>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="row bg-white" style="border-radius:5px; border:#009900 2px solid; color:#009900; width:90%;" data-toggle="tooltip" data-placement="bottom" data-offset="0,10" data-original-title="Veículos em Movimento">
									<div class="col-md-6 text-left" >
										<span style="color:#009900"> <b><i class="fas fa-key"></i></b></span>
									</div>
									<div class="col-md-6">
										<b><div id="ligados"><img src="/tracker2/Imagens/load.gif" style="width:20px; height:auto;"></div></b>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="row bg-white" style="border-radius:5px; border:#FF9900 2px solid; color:#FF9900; width:90%;" data-toggle="tooltip" data-placement="bottom" data-offset="0,10" data-original-title="Veículos Ligados e Parados">
									<div class="col-md-6 text-left" >
										<span style="color:#FF9900"> <b><i class="fas fa-key"></i></b></span>
									</div>
									<div class="col-md-6">
										<b><div id="parados"><img src="/tracker2/Imagens/load.gif" style="width:20px; height:auto;"></div></b>
									</div>
								</div>
							</div>
							
                        </div>
                        
						
						<div class="row">
                            <div class="col-xl-4">
                                <div id="panel-1" class="panel">
                                    
                                    <div class="panel-container show">
                                        <div class="panel-content">
											<div class="row">
												<div class="col-md-8">
													<input type="hidden" id="customer" value="<?php echo $id_empresa?>">
													<input type="hidden" id="id_cliente" value="<?php echo $id_cliente?>">
													<div class="input-group flex-nowrap">
														<div class="input-group-prepend">
															<span class="input-group-text"><i class="fal fa-car fs-xl"></i></span>
														</div>
														<input  type="text" id="table_search" class="form-control" placeholder="Filtro..." autocomplete="off">
													</div><br>
												</div>
												<div class="col-md-4 text-right">
													<button type="button" class="btn btn-outline-dark" onclick="att_veiculos();">Atualizar</button>
												</div>
											</div>
											<div id="grid_veiculos" style="width:100%; height: 600px; overflow: auto;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
							<div class="col-xl-8">
                                <div id="panel-1" class="panel">
                                    <div class="panel-container show">
                                        <div class="panel-content">
											<div id="map" style="height: 80vh;"></div>
											<div id="botoes">
												<nav class="d-none d-sm-block">
													<input type="checkbox" class="menu-open" name="menu-open" id="menu_open" />
													<label for="menu_open" class="menu-open-button ">
														<span class="app-shortcut-icon d-block"></span>
													</label>
													<a href="#" class="menu-item btn" onclick="setSatellite()" data-toggle="tooltip" data-placement="right" title="Mapa Satélite">
														<i class="fas fa-satellite"></i>
													</a>
													<a href="#" class="menu-item btn" onclick="setMap()" data-toggle="tooltip" data-placement="right" title="Mapa Normal">
														<i class="fas fa-map-marked-alt"></i>	
													</a>
													<a href="#" class="menu-item btn" onclick="setNoite()" data-toggle="tooltip" data-placement="right" title="Mapa Noturno">
														<i class="far fa-moon"></i>	
													</a>
													<a href="#" class="menu-item btn" data-action="app-fullscreen" data-toggle="tooltip" data-placement="right" title="Tela Cheia">
														<i class="fal fa-expand"></i>
													</a>
												</nav>
											</div>
											
											
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						
						
						
						
						
                    </main>
                    <!-- this overlay is activated only when mobile menu is triggered -->
                    <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div> <!-- END Page Content -->
                    <!-- BEGIN Page Footer -->
						<?php include('include/footer.php');?>
                    <!-- END Page Footer -->
                    <!-- BEGIN Shortcuts -->
                   
                </div>
            </div>
        </div>
        <!-- END Page Wrapper -->
        <!-- BEGIN Quick Menu -->
		
        <!-- END Quick Menu -->
        <!-- BEGIN Messenger -->
			<?php include('include/messenger.php');?>
        <!-- END Messenger -->
        <!-- BEGIN Page Settings -->
			<?php include('include/settings.php');?>
        <!-- END Page Settings -->
      <?php
		
		
		
		$cons_token = mysqli_query($conn,"SELECT * FROM chaves_maps ORDER BY id DESC LIMIT 1");
			if(mysqli_num_rows($cons_token) > 0){
		while ($resp_token = mysqli_fetch_assoc($cons_token)) {
		$token = 	$resp_token['chave'];
			}}
		?>
		
	  
<script src="/tracker3/app-assets/js/vendors.bundle.js"></script>
<script src="/tracker3/app-assets/js/app.bundle.js"></script>
<script src="/tracker3/app-assets/js/datagrid/datatables/datatables.bundle.js"></script>
<script src='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css' rel='stylesheet' />


<script>
function hide_menu(){
	 $('body').addClass('nav-function-hidden')
}
</script>

<script>
$(document).ready(function(){
  $("#table_search").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#grid_veiculos .buscar").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>


<script>
  function att_veiculos(){
	$("#grid_veiculos").html('');
	$.post('include/grid_veiculos_col.php?id_cliente='+id_cliente, function(grid_veiculos){
			
			$("#grid_veiculos").html(grid_veiculos);
		});
  }
</script>
  
  
  
  
  
<script>
	$(document).ready(function () {
		
		$.post('include/grid_veiculos_col.php?id_cliente='+id_cliente, function(grid_veiculos){
			$("#grid_veiculos").html(grid_veiculos);
			
			
		});
	});
</script>
<script>
  var intervalo_desl = setInterval(function() { $('#desligados').load('include/status_ign_desligado.php?id_cliente='+id_cliente); }, 1500);
</script>
    <script>
  var intervalo4 = setInterval(function() { $('#ligados').load('include/status_ign_ligado.php?id_cliente='+id_cliente); }, 1500);
  </script>

  <script>
  var intervalo6 = setInterval(function() { $('#parados').load('include/status_ign_parado.php?id_cliente='+id_cliente); }, 1500);
  </script>


<script>
mapboxgl.accessToken = '<?php echo $token?>';
		

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
var id_cliente = document.getElementById("id_cliente").value;
function refreshMap(){
  downloadUrl('resultado.php?id_cliente='+id_cliente, (data) => {
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
          var ignicao = markerElem.getAttribute('ignicao');
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
                            var infotitle = `
                                 <div>
                                  <strong><b><a href="grid_device.php?id_device=${deviceid}">${name}</a></b></strong>
                                  <br>
                                  <text>${address}</text>
                                  <br>
                                  <text><b>Data/Hora:</b> ${data_format}</text>
                                  <br>
                                  <text><b>Ignicao:</b> <i class="fas fa-key ${ignicao}"></i> <span class="${ignicao}">${ignicao}</span></text>
								 <br>
								<text><b>Cliente:</b> ${cliente}</span></text>
                                </div>`
                    
                      
                            var popup = new mapboxgl.Popup({ closeOnClick: false }).setLngLat([-96, 37.8]).setHTML(infotitle)
                            var marker = new mapboxgl.Marker(el).setLngLat([longitude, latitude]).setPopup(popup).addTo(map);
							
							
							
							 
                            
                            var tagg = {
                                name: name,
                                point: point,
                                ign: ign,
                                marcador: marker
                            }
							
							el.addEventListener('click', () => 
							   { 
								 top.location.href = 'grid_device.php?id_device='+deviceid;
							   }
							); 
							
							el.addEventListener('mouseenter', () => 
							   { 
								 popup.setLngLat([longitude, latitude]).setHTML(infotitle).addTo(map);
								 
							   }
							); 
							
							el.addEventListener('mouseleave', () => 
							   { 
								 popup.remove();
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
				  
				 
				  
                  var infotitle = `
                      <div>
						  <strong><b><a href="grid_device.php?id_device=${deviceid}">${name}</a></strong>
						  <br>
						  <text>${address}</text>
						  <br>
						  <text><b>Data/Hora:</b> ${data_format}</text>
						  <br>
						  <text><b>Ignicao:</b> <i class="fas fa-key ${ignicao}"></i> <span class="${ignicao}">${ignicao}</span></text>
						 <br>
						<text><b>Cliente:</b> ${cliente}</span></text>
						</div>`
					 
					  
                  var popup = new mapboxgl.Popup({ closeOnClick: false }).setLngLat([-96, 37.8]).setHTML(infotitle)
                  var marker = new mapboxgl.Marker(el).setLngLat([longitude, latitude]).setPopup(popup).addTo(map);
				  
				  
                  
                  var tagg = {
                      name: name,
                      point: point,
                      ign: ign,
                      marcador: marker
                  }
				  
				el.addEventListener('click', () => 
				   { 
					 top.location.href = 'grid_device.php?id_device='+deviceid;
				   }
				); 
				
				el.addEventListener('mouseenter', () => 
				   { 
					 popup.setLngLat([longitude, latitude]).setHTML(infotitle).addTo(map);
					 
				   }
				); 
				
				el.addEventListener('mouseleave', () => 
							   { 
								 popup.remove();
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
</html>
