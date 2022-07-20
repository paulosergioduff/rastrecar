<?php include('conexao.php');


$cons_usuario20 = mysqli_query($conn,"SELECT * FROM usuarios WHERE id_usuarios='$user_id'");
	if(mysqli_num_rows($cons_usuario20) > 0){
while ($resp_usuario11 = mysqli_fetch_assoc($cons_usuario20)) {
$id_cliente10 = 	$resp_usuario11['id_cliente'];
	}}
	
$cons_cli_cor = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente10'");
	if(mysqli_num_rows($cons_cli_cor) > 0){
while ($resp_cor = mysqli_fetch_assoc($cons_cli_cor)) {
$cor_sistema = 	$resp_cor['cor_sistema'];
$logo = 	$resp_cor['logo'];
$login_padrao = 	$resp_cor['subdominio'];

	}}
?>

<!DOCTYPE html>

<html lang="en">
    <head>
           <meta charset="utf-8"/>
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
       
        <link rel="mask-icon" href="/tracker3/app-assets/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/datagrid/datatables/datatables.bundle.css">
		<link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/formplugins/select2/select2.bundle.css">
		<script src="https://kit.fontawesome.com/a132241e15.js"></script>
		<style>
	/* Always set the map height explicitly to define the size of the div
 * element that contains the map. */
#map {
  height: 100%;
}
/* Optional: Makes the sample page fill the window. */
html, body {
  height: 100%;
  margin: 0;
  padding: 0;
}
#description {
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
}

#infowindow-content .title {
  font-weight: bold;
}

#infowindow-content {
  display: none;
}

#map #infowindow-content {
  display: inline;
}

.pac-card {
  margin: 10px 10px 0 0;
  border-radius: 2px 0 0 2px;
  box-sizing: border-box;
  -moz-box-sizing: border-box;
  outline: none;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
  background-color: #fff;
  font-family: Roboto;
}

#pac-container {
  padding-bottom: 12px;
  margin-right: 12px;
}

.pac-controls {
  display: inline-block;
  padding: 5px 11px;
}

.pac-controls label {
  font-family: Roboto;
  font-size: 13px;
  font-weight: 300;
}

#pac-input {
  background-color: #fff;
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
  margin-left: 12px;
  padding: 0 11px 0 13px;
  text-overflow: ellipsis;
  width: 400px;
}

#pac-input:focus {
  border-color: #4d90fe;
}

#title {
  color: #fff;
  background-color: #4d90fe;
  font-size: 25px;
  font-weight: 500;
  padding: 6px 12px;
}
#floating-panel {
  position: absolute;
  top: 1%;
  right: 3%;
  z-index: 5;
  background-color:  rgb(255, 255, 255, 0);
  padding: 5px;
  text-align: center;
  font-family: 'Roboto','sans-serif';
  line-height: 30px;
  padding-left: 10px;
}
#floating-panel2 {
  position: absolute;
  top: 7%;
  right: 3%;
  z-index: 5;
  background-color:  rgb(255, 255, 255, 0);
  padding: 5px;
  text-align: center;
  font-family: 'Roboto','sans-serif';
  line-height: 30px;
  padding-left: 10px;
}
#floating-panel3 {
  position: absolute;
  top: 22%;
  right: 3%;
  z-index: 5;
  background-color:  rgb(255, 255, 255, 0);
  padding: 5px;
  text-align: center;
  font-family: 'Roboto','sans-serif';
  line-height: 30px;
  padding-left: 10px;
}
#floating-panel4 {
  position: absolute;
  top: 27%;
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
  top: 12%;
  right: 3%;
  z-index: 5;
  background-color:  rgb(255, 255, 255, 0);
  padding: 5px;
  text-align: center;
  font-family: 'Roboto','sans-serif';
  line-height: 30px;
  padding-left: 10px;
}
 #panel {
        width: 200px;
        font-family: Arial, sans-serif;
        font-size: 13px;
        float: right;
        margin: 10px;
      }

      #color-palette {
        clear: both;
      }

      .color-button {
        width: 14px;
        height: 14px;
        font-size: 0;
        margin: 2px;
        float: left;
        cursor: pointer;
      }

      #delete-button {
        margin-top: 5px;
      }
	</style>
    </head>
    <body class="mod-bg-1 nav-function-fixed">
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
                           <img src="/tracker3/manager/logos/<?php echo $logo?>" style="width:200px; heigth:auto" alt="SmartAdmin WebApp" aria-roledescription="logo">
                            
                            
                        </a>
                    </div>
                    <?php include('include/sidebar.php')?>
                    
                </aside>
                <!-- END Left Aside -->
                <div class="page-content-wrapper header-function-fixed">
                    <!-- BEGIN Page Header -->
                    <?php include('include/head.php')?>
                    <!-- END Page Header -->
                    <!-- BEGIN Page Content -->
                    <!-- the #js-page-content id is needed for some plugins to initialize -->
                    <main id="js-page-content" role="main" class="page-content">
					
						<div class="row">
                            <div class="col-xl-8">
								<div class="subheader">
									<h1 class="subheader-title">
										<i class='subheader-icon fal fa-object-ungroup'></i> Nova Cerca Virtual
										<small>
											Criar Cerca Virtual
										</small>
									</h1>
								</div>
							</div>
							
						</div>
                        
                        
                        <div class="row">
                            <div class="col-xl-12">
                                <div id="panel-1" class="panel">
                                    
                                    <div class="panel-container show">
                                        <div class="panel-content">
											
											 <form action="add/add_cerca.php" method="post">
                                           
											<div class="row">
												<div class="col-md-6">
													<div id="map" style="width:100%; height:600px; "></div>
														<div id="floating-panel">
														<button type="button" id="delete-button" onclick="cercas();" class="btn btn-dark btn-icon btn-sm" data-toggle="tooltip" data-trigger="hover" data-placement="top" title="Excluir Cerca" ><i class="fas fa-trash" title="Excluir Cerca"></i></button>							
														</div>
														<div id="floating-panel2">				
													<button type="button" id="circle"  class="btn btn-dark btn-icon btn-sm" data-toggle="tooltip" data-trigger="hover" data-placement="top" title="Desenhar Cerca"><i class="far fa-dot-circle" title="Desenhar Circulo"></i></button>							
														</div>
														<div id="floating-panel5">				
													<button type="button" id="polygon" class="btn btn-dark btn-icon btn-sm" data-toggle="tooltip" data-trigger="hover" data-placement="top" title="Desenhar Cerca"><i class="fas fa-draw-polygon" title="Desenhar Forma"></i></button>							
														</div>
														<div id="floating-panel3">				
													<button type="button" onClick="setRoadMap();" class="btn btn-primary btn-icon btn-sm" data-toggle="tooltip" data-trigger="hover" data-placement="top" title="Mapa"><i class="fas fa-map-marked-alt" title="Mapa"></i></button>							
														</div>
														<div id="floating-panel4">				
													<button type="button" onClick="setSatellite();" class="btn btn-primary btn-icon btn-sm" data-toggle="tooltip" data-trigger="hover" data-placement="top" title="Satélite"><i class="fas fa-satellite" title="Satélite"></i></button>							
														</div>
												</div>
												<div class="col-md-6">
													<label>Nome da Cerca:</label>
													<input type="text" class="form-control" name="nome_cerca" id="nome_cerca" required><br>
													<label>Endereço:</label>
													<input type="text" class="form-control" name="endereco" id="endereco" required><br>
													
													<input type="hidden" class="form-control" name="latitude" id="latitude">
													
													<input type="hidden" class="form-control" name="longitude" id="longitude">
													
													<input type="hidden" class="form-control" name="coordenadas" id="coordenadas">	
													
													
													<input type="hidden" class="form-control" name="tipo_cerca" id="tipo_cerca">
													<input type="hidden" class="form-control" name="radius_size" id="radius_size">
													<input type="hidden" class="form-control" name="customer" id="customer" value="<?php echo $id_empresa?>">
													<input type="hidden" name="id_cliente_pai" id="id_cliente_pai" value="<?php echo $id_cliente10?>">
													<label>Selecione os Veículo para esta cerca:</label>
													<select class="select2-placeholder-multiple form-control" multiple="multiple" name="veiculos[]" id="veiculos">
														<?php
																						
														$cons_veic = mysqli_query($conn,"SELECT * FROM veiculos_clientes ORDER BY placa ASC");
														if(mysqli_num_rows($cons_veic) <= 0){
														echo '<option value="0">Nenhum Cliente Encontrado</option>';
														}else{
														
														while ($res_veic = mysqli_fetch_assoc($cons_veic)) {
														$deviceid = $res_veic['deviceid'];
														$marca_veiculo = $res_veic['marca_veiculo'];
														$modelo_veiculo = $res_veic['modelo_veiculo'];
														$placa = $res_veic['placa'];
														echo '<option value="'.$deviceid.'">'.$placa.' | '.$marca_veiculo.' '.$modelo_veiculo.'</option>';
														}
														}
														?>
													</select><br><br>
													
														<button type="submit" class="btn btn-primary">Criar Cerca</button> 
														<a href="cerca_virtual.php"><button type="button" class="btn btn-dark">Voltar</button></a>
												</div>
												
											</div><br>
															
											<div id="infowindow-content">
											  <img src="" width="16" height="16" id="place-icon">
											  <span id="place-name"  class="title"></span><br>
											  <span id="place-address"></span>
											</div>
											<div class="pac-card" id="pac-card">
											  <div style="display:none;">
												<div id="title">
												  Autocomplete search
												</div>
												<div id="type-selector" class="pac-controls">
												  <input type="radio" name="type" id="changetype-all" checked="checked">
												  <label for="changetype-all">All</label>

												  <input type="radio" name="type" id="changetype-establishment">
												  <label for="changetype-establishment">Establishments</label>

												  <input type="radio" name="type" id="changetype-address">
												  <label for="changetype-address">Addresses</label>

												  <input type="radio" name="type" id="changetype-geocode">
												  <label for="changetype-geocode">Geocodes</label>
												</div>
												<div id="strict-bounds-selector" class="pac-controls">
												  <input type="checkbox" id="use-strict-bounds" value="">
												  <label for="use-strict-bounds">Strict Bounds</label>
												</div>
											  </div>
											  <div id="pac-container" style="display:none;">
												<input id="pac-input" type="text"
													placeholder="Enter a location">
											  </div>
											</div>
										
                                        </form>
											
											
											
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
			<?php include('include/quick_menu.php');?>
        <!-- END Quick Menu -->
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
        <script src="/tracker3/app-assets/js/formplugins/select2/select2.bundle.js"></script>
<script>

function cercas(){
	document.getElementById("circle").disabled = false;
	document.getElementById("polygon").disabled = false;
}

var drawingManager;
      var drawings = [];
      var selectedShape;
     

      function clearSelection() {
        if (selectedShape) {
          selectedShape.setEditable(false);
          selectedShape = null;
        }
      }

      function setSelection(shape) {
        clearSelection();
        selectedShape = shape;
        shape.setEditable(true);
   
      }

      function deleteSelectedShape() {
        if (selectedShape) {
          selectedShape.setMap(null);
		  $('#latitude').val('')
		$('#longitude').val('')
		$('#radius_size').val('')
        }
      }

      function deleteAllShape() {
        for (var i=0; i < drawings.length; i++)
        {
          drawings[i].overlay.setMap(null);
        }
        drawings = [];
      }

  var map;

function setRoadMap(){
	map.setOptions({mapTypeId: google.maps.MapTypeId.ROADMAP});
}

function setSatellite(){
	map.setOptions({mapTypeId: google.maps.MapTypeId.SATELLITE});
}



      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
       
          center: new google.maps.LatLng(-30.0275588, -51.229147),
		zoom: 10,
		disableDefaultUI : true,
		zoomControl: true,
		mapTypeControl: false,
		options: {
			gestureHandling: 'greedy',
			mapTypeControl: false
		}

	});
		
		
		var card = document.getElementById('pac-card');
  var input = document.getElementById('endereco');
  var types = document.getElementById('type-selector');
  var strictBounds = document.getElementById('strict-bounds-selector');

  map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

  var autocomplete = new google.maps.places.Autocomplete(input);
  


  // Bind the map's bounds (viewport) property to the autocomplete object,
  // so that the autocomplete requests use the current map bounds for the
  // bounds option in the request.
  autocomplete.bindTo('bounds', map);

  // Set the data fields to return when the user selects a place.
  autocomplete.setFields(
      ['address_components', 'geometry', 'icon', 'name']);

  var infowindow = new google.maps.InfoWindow();
  var infowindowContent = document.getElementById('infowindow-content');
  infowindow.setContent(infowindowContent);
  var marker = new google.maps.Marker({
    map: map,
    anchorPoint: new google.maps.Point(0, -29)
  });

  autocomplete.addListener('place_changed', function() {
    infowindow.close();
    marker.setVisible(false);
    var place = autocomplete.getPlace();
    if (!place.geometry) {
      // User entered the name of a Place that was not suggested and
      // pressed the Enter key, or the Place Details request failed.
      window.alert("No details available for input: '" + place.name + "'");
      return;
    }

    // If the place has a geometry, then present it on a map.
    if (place.geometry.viewport) {
      map.fitBounds(place.geometry.viewport);
	  beforeSend: loadInputs(input.value);
    } else {
      map.setCenter(place.geometry.location);
      map.setZoom(17);  // Why 17? Because it looks good.
	  
    }
    marker.setPosition(place.geometry.location);
    marker.setVisible(true);

    var address = '';
    if (place.address_components) {
      address = [
        (place.address_components[0] && place.address_components[0].short_name || ''),
        (place.address_components[1] && place.address_components[1].short_name || ''),
        (place.address_components[2] && place.address_components[2].short_name || '')
      ].join(' ');
    }


	
	
  });

  // Sets a listener on a radio button to change the filter type on Places
  // Autocomplete.
  function setupClickListener(id, types) {
    var radioButton = document.getElementById(id);
    radioButton.addEventListener('click', function() {
      autocomplete.setTypes(types);
	 
    });
  }

  setupClickListener('changetype-all', []);
  setupClickListener('changetype-address', ['address']);
  setupClickListener('changetype-establishment', ['establishment']);
  setupClickListener('changetype-geocode', ['geocode']);

  document.getElementById('use-strict-bounds')
      .addEventListener('click', function() {
        console.log('Checkbox clicked! New state=' + this.checked);
        autocomplete.setOptions({strictBounds: this.checked});
      });

        var polyOptions = {
          fillColor: '#6495ED',
            fillOpacity: 0.5,
            strokeWeight: 2,
            clickable: true,
            editable: true,
            draggable:true
        };
        // Creates a drawing manager attached to the map that allows the user to draw
        // markers, lines, and shapes.
        drawingManager = new google.maps.drawing.DrawingManager({
            drawingControl: false,
          drawingMode: google.maps.drawing.OverlayType.POLYGON,
          markerOptions: {
            draggable: true
          },
            
          polylineOptions: {
            editable: true
          },
          rectangleOptions: polyOptions,
          circleOptions: polyOptions,
          polygonOptions: polyOptions,
          map: map
        });

        google.maps.event.addListener(drawingManager, 'overlaycomplete', function(e) {
            drawings.push(e);
            if (e.type != google.maps.drawing.OverlayType.MARKER) {
            // Switch back to non-drawing mode after drawing a shape.
            drawingManager.setDrawingMode(null);

            // Add an event listener that selects the newly-drawn shape when the user
            // mouses down on it.
            var newShape = e.overlay;
            newShape.type = e.type;
            google.maps.event.addListener(newShape, 'click', function() {
              setSelection(newShape);
            });
            setSelection(newShape);
          }
        });

 google.maps.event.addDomListener(circle, 'click', function () {
	 google.maps.event.addListener(drawingManager, 'circlecomplete', function(circle) {
      var radius = circle.getRadius();
	  var centerLat = circle.getCenter().lat();
	  var centerLng = circle.getCenter().lng();
        $('#radius_size').val(radius.toFixed(2))
		$('#latitude').val(centerLat)
		$('#longitude').val(centerLng)
		$('#tipo_cerca').val('CIRCLE')
		document.getElementById("circle").disabled = true;
		document.getElementById("polygon").disabled = true;
    });
 drawingManager.setDrawingMode(google.maps.drawing.OverlayType.CIRCLE);
    });
	
 google.maps.event.addDomListener(polygon, 'click', function () {
	 google.maps.event.addListener(drawingManager, 'overlaycomplete', function(polygon) {
      var coordinatesArray = polygon.overlay.getPath().getArray();
	  $('#coordenadas').val(coordinatesArray)
	 
	  $('#tipo_cerca').val('POLYGON')
	 document.getElementById("circle").disabled = true;
	document.getElementById("polygon").disabled = true;
    });
 drawingManager.setDrawingMode(google.maps.drawing.OverlayType.POLYGON);
    });
	
	
	
  
        // Clear the current selection when the drawing mode is changed, or when the
        // map is clicked.
        google.maps.event.addListener(drawingManager, 'drawingmode_changed', clearSelection);
        google.maps.event.addListener(map, 'click', clearSelection);
        google.maps.event.addDomListener(document.getElementById('delete-button'), 'click', deleteSelectedShape);
        google.maps.event.addDomListener(document.getElementById('delete-all-button'), 'click', deleteAllShape);

      }
	  
	  
	   
	
      google.maps.event.addDomListener(window, 'load', initMap);
	  
	      function loadInputs(value){
      $('#endereco').val(value)
  	  let endereco = document.getElementById('endereco').value;
      GetLocation(endereco)
    }
	  
			function GetLocation(endereco) {
				
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({ 'address': endereco }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                var latitude = results[0].geometry.location.lat();
                var longitude = results[0].geometry.location.lng();
                $('#latitude').val(latitude)
                $('#longitude').val(longitude)
            } else {
                alert("Request failed.")
            }
        });
      };
	  

    </script>
	


    <script 
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjn8zVxj0-JFyQ5jAaSvy25ufLHD0Z9OE&callback=initMap&libraries=drawing,places">
    </script>
      
		
      <script>
            $(document).ready(function()
            {
                $(function()
                {
                    $('.select2').select2();

                    $(".select2-placeholder-multiple").select2(
                    {
                        placeholder: "Selecione"
                    });
                    $(".js-hide-search").select2(
                    {
                        minimumResultsForSearch: 1 / 0
                    });
                    $(".js-max-length").select2(
                    {
                        maximumSelectionLength: 1,
                        placeholder: "Select maximum 2 items"
                    });
                    $(".select2-placeholder").select2(
                    {
                        placeholder: "Select a state",
                        allowClear: true
                    });



                    $(".js-select2-icons").select2(
                    {
                        minimumResultsForSearch: 1 / 0,
                        templateResult: icon,
                        templateSelection: icon,
                        escapeMarkup: function(elm)
                        {
                            return elm
                        }
                    });

                    function icon(elm)
                    {
                        elm.element;
                        return elm.id ? "<i class='" + $(elm.element).data("icon") + " mr-2'></i>" + elm.text : elm.text
                    }

                    $(".js-data-example-ajax").select2(
                    {
                        ajax:
                        {
                            url: "https://api.github.com/search/repositories",
                            dataType: 'json',
                            delay: 250,
                            data: function(params)
                            {
                                return {
                                    q: params.term, // search term
                                    page: params.page
                                };
                            },
                            processResults: function(data, params)
                            {
                                // parse the results into the format expected by Select2
                                // since we are using custom formatting functions we do not need to
                                // alter the remote JSON data, except to indicate that infinite
                                // scrolling can be used
                                params.page = params.page || 1;

                                return {
                                    results: data.items,
                                    pagination:
                                    {
                                        more: (params.page * 30) < data.total_count
                                    }
                                };
                            },
                            cache: true
                        },
                        placeholder: 'Search for a repository',
                        escapeMarkup: function(markup)
                        {
                            return markup;
                        }, // let our custom formatter work
                        minimumInputLength: 1,
                        templateResult: formatRepo,
                        templateSelection: formatRepoSelection
                    });

                    function formatRepo(repo)
                    {
                        if (repo.loading)
                        {
                            return repo.text;
                        }

                        var markup = "<div class='select2-result-repository clearfix d-flex'>" +
                            "<div class='select2-result-repository__avatar mr-2'><img src='" + repo.owner.avatar_url + "' class='width-2 height-2 mt-1 rounded' /></div>" +
                            "<div class='select2-result-repository__meta'>" +
                            "<div class='select2-result-repository__title fs-lg fw-500'>" + repo.full_name + "</div>";

                        if (repo.description)
                        {
                            markup += "<div class='select2-result-repository__description fs-xs opacity-80 mb-1'>" + repo.description + "</div>";
                        }

                        markup += "<div class='select2-result-repository__statistics d-flex fs-sm'>" +
                            "<div class='select2-result-repository__forks mr-2'><i class='fal fa-lightbulb'></i> " + repo.forks_count + " Forks</div>" +
                            "<div class='select2-result-repository__stargazers mr-2'><i class='fal fa-star'></i> " + repo.stargazers_count + " Stars</div>" +
                            "<div class='select2-result-repository__watchers mr-2'><i class='fal fa-eye'></i> " + repo.watchers_count + " Watchers</div>" +
                            "</div>" +
                            "</div></div>";

                        return markup;
                    }

                    function formatRepoSelection(repo)
                    {
                        return repo.full_name || repo.text;
                    }

                });
            });

        </script>
    </body>
</html>
