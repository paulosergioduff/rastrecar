<?php include('conexao.php');?>

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
        <link rel="icon" type="image/png" sizes="32x32" href="/tracker3/app-assets/img/favicon/favicon-32x32.png">
        <link rel="mask-icon" href="/tracker3/app-assets/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
		<link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/datagrid/datatables/datatables.bundle.css">
		<link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/fa-solid.css">
		<link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/statistics/chartjs/chartjs.css">
		<script src="https://kit.fontawesome.com/a132241e15.js"></script>
<style>
.Ligada{
color: #FFF;
background-color: #08700a;
}
.Desligada{
  color: #FFF;
  background-color: #000;
}

.Online{
color: #FFF;
background-color: #08700a;
}
.Offline{
  color: #FFF;
  background-color: #bd0202;
}

.Desbloqueado{
color: #FFF;
background-color: #08700a;
}
.Bloqueado{
  color: #FFF;
  background-color: #bd0202;
}
.mapboxgl-popup {
  width: 1000px;
}

.mapboxgl-popup-content {
   width: 1000px;
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
#floating-panel9 {
  position: absolute;
  bottom: 3%;
  left: 1%;
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
    <body class="mod-bg-1 nav-function-fixed header-function-fixed" onload="hide_menu();AutoCenter();">
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
                           <img src="/tracker2/Imagens/logo11.png" style="width:200px; heigth:auto" alt="SmartAdmin WebApp" aria-roledescription="logo">
                            
                            
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



$cont_veiculos = mysqli_query($conn,"SELECT * FROM tc_devices WHERE contact !='ESTOQUE'");
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
					
                    <main id="js-page-content" role="main" class="page-content">
					
						
                        
						
						<div class="row">
                           <input type="hidden" id="customer" value="<?php echo $id_empresa?>">
							<div class="col-xl-12">
                                <div id="panel-1" class="panel">
                                    <div class="panel-container show">
                                        <div class="panel-content">
											<div id="map" style="height: 50vh;"></div>
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
											<div id="floating-panel5" >				
												<div class="row bg-white" style="border-radius:5px; border:#000000 2px solid; color:#000; width:130px;" data-toggle="tooltip" data-placement="bottom" data-offset="0,10" data-original-title="Veículos Desligados">
													<div class="col-md-6 text-left" >
														<span> <b><i class="fas fa-key"></i></b></span>
													</div>
													<div class="col-md-6">
														<b><div id="desligados"></div></b>
													</div>
												</div>
											</div>
											<div id="floating-panel6" >	
												<div class="row bg-white" style="border-radius:5px; border:#009900 2px solid; color:#009900; width:130px;" data-toggle="tooltip" data-placement="bottom" data-offset="0,10" data-original-title="Veículos em Movimento">
													<div class="col-md-6 text-left" >
														<span style="color:#009900"> <b><i class="fas fa-key"></i></b></span>
													</div>
													<div class="col-md-6">
														<b><div id="ligados"><img src="/tracker2/Imagens/load.gif" style="width:20px; height:auto;"></div></b>
													</div>
												</div>								
											</div>
											<div id="floating-panel7" >
												<div class="row bg-white" style="border-radius:5px; border:#FF9900 2px solid; color:#FF9900; width:130px;" data-toggle="tooltip" data-placement="bottom" data-offset="0,10" data-original-title="Veículos Ligados e Parados">
													<div class="col-md-6 text-left" >
														<span style="color:#FF9900"> <b><i class="fas fa-key"></i></b></span>
													</div>
													<div class="col-md-6">
														<b><div id="parados"><img src="/tracker2/Imagens/load.gif" style="width:20px; height:auto;"></div></b>
													</div>
												</div>
											</div>
											<div id="floating-panel8" data-toggle="modal" data-target="#rel_desc">
												<a href="#">
												<div class="row bg-white" style="border-radius:5px; border:#CCC 2px solid; color:#000; width:130px;" data-toggle="tooltip" data-placement="bottom" data-offset="0,10" data-original-title="Veículos Offline">
													<div class="col-md-6 text-left" >
														<span style="color:#000"> <b><i class="fas fa-wifi"></i></b></span>
													</div>
													<div class="col-md-6">
														<b><div id="desconectados"><img src="/tracker2/Imagens/load.gif" style="width:20px; height:auto;"></div></b>
													</div>
												</div></a>							
											</div>
											<div id="floating-panel9">				
													<a href="grid.php"><button type="button" class="btn btn-dark btn-sm"><i class="fas fa-table"></i> Grid Coluna</button></a>							
												</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						<div class="row">
							<div class="col-xl-12">
								<div id="panel-1" class="panel">
                                    <div class="panel-container show">
                                        <div class="panel-content">
										<div style="width:100%; height: 400px; overflow: auto;">
												<div class="row">
													<div class="col-lg-6">
														<div class="input-group flex-nowrap">
															<div class="input-group-prepend">
																<span class="input-group-text"><i class="fal fa-car fs-xl"></i></span>
															</div>
															<input  type="text" id="table_search" class="form-control" placeholder="Filtro..." autocomplete="off">
														</div><br>
													</div>
													<div class="col-lg-6 text-right">
														<button type="button" onclick="att_veiculos()" class="btn btn-icon btn-dark"><i class="fas fa-sync"></i></button>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-12">
														
														<table id="dt-basic-example" class="table table-bordered table-hover table-striped nowrap" >
														  <thead>
															<tr>
															  <th></th>
															  <th>Cliente</th>
															  <th>Veículo</th>
															  <th>GPS</th>
															  <th>Servidor</th>
															  <th>Endereço</th>
															  <th>Velocidade</th>
															  <th style="width:16%">Informações</th>
															  
															</tr>
														  </thead>
														  <tbody  id="grid_veiculos"> 
														
															</tbody>
														</table>
														</div>
													</div>
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
    $("#grid_veiculos tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>


<script>
  function att_veiculos(){
	$("#grid_veiculos").html('');
	$.post('include/grid_veiculos.php?customer='+customer, function(grid_veiculos){
			
			$("#grid_veiculos").html(grid_veiculos);
		});
  }
</script>
  
  
  
  
  
<script>
	$(document).ready(function () {
		
		$.post('include/grid_veiculos.php?customer='+customer, function(grid_veiculos){
			$("#grid_veiculos").html(grid_veiculos);
			
			
		});
	});
</script>
<script>
  var intervalo_desl = setInterval(function() { $('#desligados').load('include/status_ign_desligado.php?customer='+customer); }, 1500);
</script>
    <script>
  var intervalo4 = setInterval(function() { $('#ligados').load('include/status_ign_ligado.php?customer='+customer); }, 1500);
  </script>
  <script>
  var intervalo5 = setInterval(function() { $('#desconectados').load('include/status_conexao.php?customer='+customer); }, 1500);
  </script>
  <script>
  var intervalo6 = setInterval(function() { $('#parados').load('include/status_ign_parado.php?customer='+customer); }, 1500);
  </script>

	<script>
$(function () {
	$('[data-toggle="popover"]').popover()
})
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

function refreshMap(){
  downloadUrl('resultado.php', (data) => {
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
		  var base64 = btoa("id_device:"+deviceid);

            
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
                              <div class="row">
	<div class="col-md-12">
		<text><h4><span class="badge badge-dark"><i class="fas fa-car"></i> <b>${name}</b></span></h4> </text>
	</div>
</div><br>
<div class="row">
	<div class="col-md-4">
		<text><i class="fas fa-map-marker-alt"></i> ${address}</text>
		<br>
		<br>
		<text><b><i class="fas fa-satellite-dish"></i> Data Servidor:</b><br> ${lastupdate}</text>
		<br>
		<br>
		<text><b><i class="fas fa-user"></i> Cliente:</b><br> ${cliente}</span></text>
		
	</div>
	<div class="col-md-4">
		<text><b><i class="fas fa-mobile"></i> Equipamento:</b><br> ${modelo_equip}</text>
		<br><br>
		<text><b><i class="fas fa-map-marked-alt"></i> Data GPS:</b><br> ${data_format}</text>
		<br><br>
	</div>
	<div class="col-md-4">
		
		<text><b><i class="fas fa-qrcode"></i> IMEI:</b><br> ${imei}</text>
		<br><br>
		<text><b><i class="fas fa-sim-card"></i> Chip:</b><br> ${chip}</text>
		<br><br>
		<text><b><i class="fas fa-laptop-house"></i> Operadora:</b><br> ${operadora}</text>
	</div>
</div><br>
<div class="row">
	<div class="col-md-12">
		<span class="badge ${ignicao}"><i class="fas fa-key"></i> ${ignicao}</span> 
		<span class="badge ${conexao}"><i class="fas fa-wifi"></i> ${conexao}</span> 
		<span class="badge ${bloqueio}"><i class="fas fa-lock"></i> ${bloqueio}</span>
		<span class="badge" style="background-color:#${cor_alimentacao}; color:#FFF"><i class="fas fa-plug"></i>Alimentação ${alimentacao}</span><br>
		<span class="badge badge-info"><i class="fas fa-plug"></i> Satélites ${veic_satelite}</span>
		<span class="badge badge-info"><i class="fas fa-signal"></i> GSM ${veic_gsm}%</span>
		<span class="badge badge-info"><i class="fas fa-car-battery"></i> Bat Veic: ${veic_volts}v</span>
		<span class="badge badge-info"><i class="fas fa-battery-full"></i> Bat Interna: ${veic_bateria_interna}%</span>
		
	</div>
</div><br>
<div class="row">
	<div class="col-md-12">
		<button class="btn btn-xs btn-dark" onclick="window.open('grid_device.php?c=${base64}');"><i class="fas fa-play-circle"></i> Mapa</button>
		<button class="btn btn-xs btn-dark" onclick="window.open('grid_device.php?c=${base64}');"><i class="fas fa-clipboard-list"></i> Histórico Dia</button>
		<button class="btn btn-xs btn-warning" onclick="window.open('grid_device.php?c=${base64}');"><i class="fas fa-file-signature"></i> Tratar</button>
		<button class="btn btn-xs btn-danger" onclick="window.open('grid_device.php?c=${base64}');"><i class="fas fa-lock"></i> Bloquear</button>
		<button class="btn btn-xs btn-success" onclick="window.open('grid_device.php?c=${base64}');"><i class="fas fa-lock-open"></i> Desbloquear</button>
	</div>
</div>
`
                    
                      
                            var popup = new mapboxgl.Popup({ closeOnClick: false,  offset: 25 }).setLngLat([-96, 37.8]).setHTML(infotitle)
                            var marker = new mapboxgl.Marker(el).setLngLat([longitude, latitude]).setPopup(popup).addTo(map);
							
							
							
							 
                            
                            var tagg = {
                                name: name,
                                point: point,
                                ign: ign,
                                marcador: marker
                            }
							
							el.addEventListener('click', () => 
							   { 
								  popup
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
                       <div class="row">
	<div class="col-md-12">
		<text><h4><span class="badge badge-dark"><i class="fas fa-car"></i> <b>${name}</b></span></h4> </text>
	</div>
</div><br>
<div class="row">
	<div class="col-md-4">
		<text><i class="fas fa-map-marker-alt"></i> ${address}</text>
		<br>
		<br>
		<text><b><i class="fas fa-satellite-dish"></i> Data Servidor:</b><br> ${lastupdate}</text>
		<br>
		<br>
		<text><b><i class="fas fa-user"></i> Cliente:</b><br> ${cliente}</span></text>
		
	</div>
	<div class="col-md-4">
		<text><b><i class="fas fa-mobile"></i> Equipamento:</b><br> ${modelo_equip}</text>
		<br><br>
		<text><b><i class="fas fa-map-marked-alt"></i> Data GPS:</b><br> ${data_format}</text>
		<br><br>
	</div>
	<div class="col-md-4">
		
		<text><b><i class="fas fa-qrcode"></i> IMEI:</b><br> ${imei}</text>
		<br><br>
		<text><b><i class="fas fa-sim-card"></i> Chip:</b><br> ${chip}</text>
		<br><br>
		<text><b><i class="fas fa-laptop-house"></i> Operadora:</b><br> ${operadora}</text>
	</div>
</div><br>
<div class="row">
	<div class="col-md-12">
		<span class="badge ${ignicao}"><i class="fas fa-key"></i> ${ignicao}</span> 
		<span class="badge ${conexao}"><i class="fas fa-wifi"></i> ${conexao}</span> 
		<span class="badge ${bloqueio}"><i class="fas fa-lock"></i> ${bloqueio}</span>
		<span class="badge" style="background-color:#${cor_alimentacao}; color:#FFF"><i class="fas fa-plug"></i>Alimentação ${alimentacao}</span><br>
		<span class="badge badge-info"><i class="fas fa-plug"></i> Satélites ${veic_satelite}</span>
		<span class="badge badge-info"><i class="fas fa-signal"></i> GSM ${veic_gsm}%</span>
		<span class="badge badge-info"><i class="fas fa-car-battery"></i> Bat Veic: ${veic_volts}v</span>
		<span class="badge badge-info"><i class="fas fa-battery-full"></i> Bat Interna: ${veic_bateria_interna}%</span>
		
	</div>
</div><br>
<div class="row">
	<div class="col-md-12">
		<button class="btn btn-xs btn-dark" onclick="window.open('grid_device.php?c=${base64}');"><i class="fas fa-play-circle"></i> Mapa</button>
		<button class="btn btn-xs btn-dark" onclick="window.open('grid_device.php?c=${base64}');"><i class="fas fa-clipboard-list"></i> Histórico Dia</button>
		<button class="btn btn-xs btn-warning" onclick="window.open('grid_device.php?c=${base64}');"><i class="fas fa-file-signature"></i> Tratar</button>
		<button class="btn btn-xs btn-danger" onclick="window.open('grid_device.php?c=${base64}');"><i class="fas fa-lock"></i> Bloquear</button>
		<button class="btn btn-xs btn-success" onclick="window.open('grid_device.php?c=${base64}');"><i class="fas fa-lock-open"></i> Desbloquear</button>
	</div>
</div>
`
					 
					  
                   var popup = new mapboxgl.Popup({ closeOnClick: false,  offset: 25 }).setLngLat([-96, 37.8]).setHTML(infotitle)
                  var marker = new mapboxgl.Marker(el).setLngLat([longitude, latitude]).setPopup(popup).addTo(map);
				  
				  
                  
                  var tagg = {
                      name: name,
                      point: point,
                      ign: ign,
                      marcador: marker
                  }
				  
				el.addEventListener('click', () => 
							   { 
								popup
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
  'url(/tracker2/manager/imagens/icons/car.png';
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
