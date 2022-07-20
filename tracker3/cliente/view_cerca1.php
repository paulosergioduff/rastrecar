<?php include('conexao.php');





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
        <link rel="icon" type="image/png" sizes="32x32" href="/tracker3/app-assets/img/favicon/favicon-32x32.png">
        <link rel="mask-icon" href="/tracker3/app-assets/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/datagrid/datatables/datatables.bundle.css">
		<link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/formplugins/select2/select2.bundle.css">
		 <link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/botoes.css">
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
                <aside class="page-sidebar" style="background-color:#14145A">
                    <div style="background-color:#14145A">
                        <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative">
                           <img src="/tracker/Imagens/logo1.png" style="width:200px; heigth:auto" alt="SmartAdmin WebApp" aria-roledescription="logo">
                            
                            
                        </a>
                    </div>
                    <?php include('include/sidebar.php')?>
                    
                </aside>
                <!-- END Left Aside -->
                <div class="page-content-wrapper header-function-fixed">
                    <!-- BEGIN Page Header -->
                    <?php include('include/head.php')?>
                    
					<?php
					$id_cerca = $_REQUEST['c'];
					$cons_devices = mysqli_query($conn,"SELECT * FROM cerca_virtual WHERE id_cerca='$id_cerca'");
					$total = mysqli_num_rows($cons_devices);
						if(mysqli_num_rows($cons_devices) > 0){
					while ($resp_p = mysqli_fetch_assoc($cons_devices)) {
					$area = 	$resp_p['area'];
					$tipo = 	$resp_p['tipo'];
					$latitude = 	$resp_p['latitude'];
					$longitude = 	$resp_p['longitude'];
					$radius = 	$resp_p['radius'];
					$nome_cerca = 	$resp_p['nome_cerca'];
					$endereco = 	$resp_p['endereco'];
					$geofenceid = 	$resp_p['geofenceid'];
					
						}}
					
					if($tipo == 'CIRCLE'){
						$latitude = 	$latitude;
						$longitude = 	$longitude;
						$radius = 	$radius;
						$coord_ini = '{lat: '.$latitude.', lng: '.$longitude.'}';
						$center = $latitude.','.$longitude;
					}
					if($tipo == 'POLYGON'){
					
						$coord1 = explode("),(", $area);
						$coord_ini = $coord1[0];
						$coord_ini = str_replace('(', '', $coord_ini);
						$center = $coord_ini;
						
						$coordenadas = str_replace('),(', '}@{', $area);
						$coordenadas = str_replace('(', '{', $coordenadas);
						$coordenadas = str_replace('{', '{lat: ', $coordenadas);
						$coordenadas = str_replace(',', ', lng: ', $coordenadas);
						$coordenadas = str_replace(')', '}', $coordenadas);
						$coordenadas = str_replace('@', ',', $coordenadas);
					}
					
					
					?>
					
                    <main id="js-page-content" role="main" class="page-content">
					
						<div class="row">
                            <div class="col-xl-8">
								<div class="subheader">
									<h1 class="subheader-title">
										<i class='subheader-icon fal fa-object-ungroup'></i>CERCA: <?php echo $nome_cerca?>
										<small>
											Cerca Virtual
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
											
											 <form action="add/add_cerca_veiculos.php" method="post">
                                           
											<div class="row">
												<div class="col-md-6">
													<div id="map" style="width:100%; height:600px; "></div>
														
												</div>
												<div class="col-md-6">
													<label>NOME CERCA:</label>
													<input type="text" id="nome_cerca" class="form-control" value="<?php echo $nome_cerca?>" readonly><br>
													<label>ENDERÇO:</label>
													<input type="text" id="endereco" class="form-control" value="<?php echo $endereco?>" readonly>
													<hr style="border:#000 1px solid;">
													<label><b>VEÍCULOS CERCA:</b></label>
													<?php
													$cons_devices_g = mysqli_query($conn,"SELECT * FROM tc_device_geofence WHERE geofenceid='$geofenceid'");
														if(mysqli_num_rows($cons_devices_g) > 0){
														while ($resp_g = mysqli_fetch_assoc($cons_devices_g)) {
														$deviceid = 	$resp_g['deviceid'];
														$veiculos[] = $deviceid;
														
													$cons_veiculos = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE deviceid='$deviceid'");
														if(mysqli_num_rows($cons_veiculos) > 0){
														while ($resp_veiculos = mysqli_fetch_assoc($cons_veiculos)) {
														$placa = 	$resp_veiculos['placa'];
														$marca_veiculo = 	$resp_veiculos['marca_veiculo'];
														$modelo_veiculo = 	$resp_veiculos['modelo_veiculo'];
														}}
													
													?>
													<div class="row">
														<div class="col-md-8">
															<?php echo $placa?> - <?php echo $marca_veiculo?>/<?php echo $modelo_veiculo?>
														</div>
														<div class="col-md-4">
															<a href="delete_veic_cerca.php?deviceid=<?php echo $deviceid?>&geofenceid=<?php echo $geofenceid?>&pag=1"><button type="button" class="btn btn-danger btn-sm"><i class="fal fa-trash-alt"></i> Excluir</button></a>
														</div>
													</div>
													<hr style="border:#CCC 1px dashed">
													<?php

														}}
														$veiculos1 = implode(",", $veiculos);
													?>
													<hr style="border:#000 1px solid;">
													<label>Incluir Veículos nesta cerca:</label>
													<select class="select2-placeholder-multiple form-control" multiple="multiple" name="veiculos[]" id="veiculos">
														<?php
																						
														$cons_veic = mysqli_query($conn,"SELECT * FROM veiculos_clientes ORDER BY placa ASC");
														if(mysqli_num_rows($cons_veic) <= 0){
														echo '<option value="0">Nenhum Veículo Encontrado</option>';
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
													<button type="submit" class="btn btn-primary">Atualizar Cerca</button> 
													<input type="hidden" id="geofenceid" name="geofenceid" value="<?php echo $geofenceid?>">
													<input type="hidden" id="pag"  name="pag" value="1">
													<input type="hidden" id="id_cerca" name="id_cerca" value="<?php echo $id_cerca?>">
												</div>
												
											</div><br>
										
                                        </form>
											
											
										<input type="hidden" id="tipo" value="<?php echo $tipo?>">	
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



  var map;

function setRoadMap(){
	map.setOptions({mapTypeId: google.maps.MapTypeId.ROADMAP});
}

function setSatellite(){
	map.setOptions({mapTypeId: google.maps.MapTypeId.SATELLITE});
}



      function initMap() {
	  var tipo = document.getElementById("tipo").value;
        map = new google.maps.Map(document.getElementById('map'), {
       
        center: new google.maps.LatLng(<?php echo $center?>),
		zoom: 17,
		disableDefaultUI : true,
		zoomControl: true,
		mapTypeControl: false,
		options: {
			gestureHandling: 'greedy',
			mapTypeControl: false
		}

		});
		datacircle = new google.maps.Circle({
				 
				  strokeWeight: 2,
				  fillColor: "#6495ED",
				  title:"SOMETHING",
				  fillOpacity: 0.5,
				  center: <?php echo $coord_ini?>,
				  radius: <?php echo $radius?>,
				});
			 datacircle.setMap(map);
		
		
	  
	  } 
	  
	   
	
      google.maps.event.addDomListener(window, 'load', initMap);
	  
	     
	  

    </script>
	


    <script 
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBAjYPDhYHQGSg1WzmL8wdIWIKpuTB7Jsg&callback=initMap&libraries=drawing,places">
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
