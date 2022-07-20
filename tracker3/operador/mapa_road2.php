<?php


$servidor = "localhost";
$usuario = "root";
$senha = "TR4vcijU6T9Keaw";
$dbname = "traccar";

//Criar a conexao
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
$con = mysqli_connect($servidor, $usuario, $senha, $dbname);
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
$nome_cliente = 	$resp_cliente['nome_cliente'];	
$id_cliente_pai= 	$resp_cliente['id_cliente_pai'];	
}}

$cons_cli_cor = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente_pai'");
	if(mysqli_num_rows($cons_cli_cor) > 0){
while ($resp_cor = mysqli_fetch_assoc($cons_cli_cor)) {
$cor_sistema = 	$resp_cor['cor_sistema'];
$logo = 	$resp_cor['logo'];
$login_padrao = 	$resp_cor['subdominio'];

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

<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            Relatório Veículo
        </title>
        <meta name="description" content="Login">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
        <!-- Call App Mode on ios devices -->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <!-- Remove Tap Highlight on Windows Phone IE -->
        <meta name="msapplication-tap-highlight" content="no">
        <!-- base css -->
        <link rel="stylesheet" media="screen, print" href="http://virtualtracker.com.br/tracker2/app-assets/css/vendors.bundle.css">
        <link rel="stylesheet" media="screen, print" href="http://virtualtracker.com.br/tracker2/app-assets/css/app.bundle.css">
        <!-- Place favicon.ico in the root directory -->
        <link rel="apple-touch-icon" sizes="180x180" href="http://virtualtracker.com.br/tracker2/app-assets/img/favicon/apple-touch-icon.png">
      
        <link rel="mask-icon" href="http://virtualtracker.com.br/tracker2/app-assets/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <!-- Optional: page related CSS-->
        <link rel="stylesheet" media="screen, print" href="http://virtualtracker.com.br/tracker2/app-assets/css/fa-brands.css">
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
	height: 200px;
    border: #000 1px solid;
    width: 470px;
    position: fixed;
    top: -1px;
    left: 3px;
}
</style>
    </head>

    <body onLoad="AutoCenter();">
        <div class="page-wrapper">
            <div class="page-inner" style="background-color:#FFF">
                <div class="page-content-wrapper bg-transparent m-0">
                    <div class="height-10 w-100 shadow-lg px-4" style="background-color:#FFF">
                        <div class="d-flex align-items-center container p-0">
                            <div class="page-logo width-mobile-auto m-0 align-items-center justify-content-center p-0 bg-transparent bg-img-none shadow-0 height-9">
                                <a href="javascript:void(0)" class="page-logo-link press-scale-down d-flex align-items-center">
                                    <img src="/tracker3/manager/logos/<?php echo $logo?>" style="width:150px; height:auto;">
                                    
                                </a>
                            </div>
                            
                            <a href="page_login-alt.html" class="btn-link text-white ml-auto ml-sm-0">
                                Relatório de Percurso/Viagens
                            </a>
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="container py-4 py-lg-8 my-lg-8 px-4 px-sm-0">
                            <div class="row">
                                <div class="col-xl-12 ml-auto mr-auto">
                                    <div class="card p-4 rounded-plus bg-faded">
                                        <div class="alert alert-primary text-dark" role="alert">
                                            <h5>PERCURSO REALIZADO - PERÍODO: <?php echo $data_inicial_1?> ATÉ <?php echo $data_final_1?><h5>
                                            <h5>VEÍCULO: <?php echo $placa?> - <?php echo $veiculo_mapa ?><h5>
                                        </div>
                                    </div>
                                </div>
                            </div><br>
							 <div class="row">
								<div class="col-lg-12">
									 <div id="map" style="width:100%; height:600px;"><div class="spinner-border text-dark" role="status"><span class="sr-only">Loading...</span></div></div>
									
									<input type="hidden" id="data_ini" value="<?php echo $data_inicial ?>">
								<input type="hidden" id="data_fin" value="<?php echo $data_final ?>">
								<input type="hidden" id="device_id" value="<?php echo $deviceid ?>">
								<input type="hidden" id="agrupar" value="<?php echo $agrupar ?>">
									
								</div>

							</div><br>
							<div class="row">
													<div class="col-lg-12">
														<?php
	


	$parada = 0;
	$temp_velocidade_media = '';
	$temp_tempo_percurso = '';
	$temp_end_inicial = '';
	$temp_end_final = '';
	$temp_html = '';
	$temp_data_inicial = '';
	$temp_data_final = '';
	$velocidades = 0;
	$velocidade_soma = 0;
	$velocidade_media = 0;
	$temp_km = 0;
	$temp_duracao = 0;
	$temp_hod_inicial = 0;
	$temp_hod_final = 0;
	$speed1 = 0;
	$iniciado = false;
	$cons_conta = mysqli_query($conn,"SELECT * FROM tc_positions WHERE deviceid='$deviceid' AND (servertime >= '$data_inicial' AND servertime <= '$data_final') ORDER BY id ASC");
	$total = mysqli_num_rows($cons_conta);
	/*$html_final = '<table border="1" class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th>.</th>
								<th>HORA</th>
								<th>ENDEREÇO</th>
								<th>Velocidade Média</th>
                                <th>KM PERCORRIDA</th>
						   		 <th>DURAÇÃO</th>
								<th>MAPA</th>
							</tr>
						</thead>
						<tbody>
						
						';*/
						
	if(mysqli_num_rows($cons_conta) > 0){
		while ($resp_conta = mysqli_fetch_array($cons_conta)) {
			//Tratamentos Padroes
			$data = $resp_conta['servertime'];
			$data = date('Y-m-d H:i:s', strtotime('-3 hour', strtotime($data))); 
			$id_pos = $resp_conta['id'];
			$address = $resp_conta['address'];
			$speed = 	$resp_conta['speed'];
			$speed = $speed * 1.609;
			$speed = round($speed, 2);
			$address = str_replace(', BR', '', $address);
			$address1 = explode(",", $address);
			$estado1 = end($address1);
			$estado = ','.$estado1;
			$address = str_replace($estado, '', $address);
			$address1 = explode(",", $address);
			$cep = end($address1);
			$cep = ','.$cep;
			$address = str_replace($cep, '', $address);
			$address = $address.' /'.$estado1;
			
			
			
			$attributes = $resp_conta['attributes'];
			$obj = json_decode($attributes);
			$ignicao = $obj->{'ignition'};
			
			$ignicao = (string)$ignicao;
			
			$total_km = $obj->{'totalDistance'};
			$total_km = $total_km / 1000;
			$total_km = round($total_km, 2);
			//$total_km = number_format($total_km, 2, ",", ".");
			//Colocar aqui os calculos de distancia e velocidade
			$velocidades = $velocidades + 1;
			$velocidade_soma = $velocidade_soma + $speed;
		
			
			$temp_km +=  $total_km;
			
			if($ignicao == 0){
				//Inicio da logica para montar os retornos
				if($iniciado == true){
					if($ignicao != $parada){
						$parada = 0;
						
						$temp_data_final  = $data;
						$temp_end_final = $address;
						$temp_hod_final = $total_km;
						$velocidade_media = round($velocidade_soma/$velocidades,2);
						//Printar uma Linha, e resetar as temporarias
						$km_percurso = $temp_hod_final - $temp_hod_inicial;
						$km_percurso = round($km_percurso, 2);
						
						$diferenca = strtotime($temp_data_final) - strtotime($temp_data_inicial);
						$dias = floor($diferenca / (60 * 60 * 24));


						$data_ini  = $temp_data_final;
						$data_end  = $temp_data_inicial;

						$dif = strtotime($data_end) - strtotime($data_ini);



						$date_time  = new DateTime($temp_data_inicial);
						$diff       = $date_time->diff( new DateTime($temp_data_final));
						$horas = $diff->format('%H horas(s), %i minutos');
						
						$data_format_inicial = date('d/m/Y H:i:s', strtotime($temp_data_inicial)); 
						$data_format_final = date('d/m/Y H:i:s', strtotime($temp_data_final)); 
						
						$data_inicial_vel = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($temp_data_inicial)));
						$data_final_vel = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($temp_data_final)));
						$cons_speed = mysqli_query($conn,"SELECT * FROM tc_positions WHERE deviceid='$deviceid' AND (servertime >= '$data_inicial_vel' AND servertime <= '$data_final_vel') ORDER BY speed DESC LIMIT 1");
							if(mysqli_num_rows($cons_speed) > 0){
						while ($resp_speed = mysqli_fetch_assoc($cons_speed)) {
						$vel_maxima = 	$resp_speed['speed'];
						$vel_maxima = $vel_maxima * 1.609;
						$vel_maxima = round($vel_maxima, 2);
							}}
						
						?>								
									
									 <div class="card border-dark bg-transparent" style="border-left-color:#000; border-bottom:#000 1px solid; border-top:#000 1px solid; border-right:#000 1px solid">
									 <div class="form-group">
										<div class="row">
											<div class="col-md-12">
												<table width="100%" border="0" cellspacing="0">
  <tr>
    <td>Data Inicial</td>
    <td colspan="3">Endereço Inicial</td>
  </tr>
  <tr>
    <td><b><i class="far fa-clock"></i> <?php echo $data_format_inicial?></b></td>
    <td colspan="3"><b><i class="fas fa-map-marker-alt"></i> <?php echo $temp_end_inicial?></b></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Data Final</td>
    <td colspan="3">Endereço Final</td>
  </tr>
  <tr>
    <td><b><i class="far fa-clock"></i> <?php echo $data_format_final?></b></td>
    <td colspan="3"><b><i class="fas fa-map-marker-alt"></i> <?php echo $temp_end_final?></b></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Distância Total:</td>
    <td>Tempo Percurso:</td>
    <td>Velocidade Média:</td>
    <td>Velocidade Máxima:</td>
  </tr>
  <tr>
    <td><b><i class="fas fa-road"></i> <?php echo $km_percurso?> km rodados</b></td>
    <td><b><i class="fas fa-history"></i> <?php echo $horas?></b></td>
    <td><b><i class="fas fa-tachometer-alt"></i> <?php echo $velocidade_media?> km/h</b></td>
    <td><b><i class="fas fa-tachometer-alt"></i> <?php echo $vel_maxima?> km/h</b></td>
  </tr>
</table>

											</div>
											
										</div><br>
										
										
										</div>
										</div>
										<br>
									
									<?php
									
									
									
						$velocidades = 0;
						$velocidade_soma = 0;
						$velocidade_media = 0;
						$temp_hod_final = 0;
						$temp_hod_inicial = 0;
						$temp_km = 0;
					};
				};
				$ign = '<font color="#006600"><b>LIGADO</b></font>';
			} else {
				if($iniciado == false){
					//Primeiro load
					$iniciado = true;
					$temp_data_inicial  = $data;
					$temp_end_inicial = $address;
					$temp_hod_inicial = $total_km;

				}else{
					if($ignicao != $parada){
						//Mudanca para um novo
						$temp_data_inicial  = $data;
						$temp_end_inicial = $address;
						$temp_hod_inicial = $total_km;
						$parada = 1;
					};
				};
				$ign = '<font color="#990000"><b>Desligado</b></font>';
			};
			
		
		};
	};
	/*$html_final .= '
					</tbody>
				</table>';*/
	//echo($html_final);
?>
													 </div>
											</div>
                        </div>
						<div id="status_comando" style="display:none"></div>
                        <div class="position-absolute pos-bottom pos-left pos-right p-3 text-center text-white">
                           Relatório gerado em <?php echo date('d/m/Y H:i:s')?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- base vendor bundle: 
			 DOC: if you remove pace.js from core please note on Internet Explorer some CSS animations may execute before a page is fully loaded, resulting 'jump' animations 
						+ pace.js (recommended)
						+ jquery.js (core)
						+ jquery-ui-cust.js (core)
						+ popper.js (core)
						+ bootstrap.js (core)
						+ slimscroll.js (extension)
						+ app.navigation.js (core)
						+ ba-throttle-debounce.js (core)
						+ waves.js (extension)
						+ smartpanels.js (extension)
						+ src/../jquery-snippets.js (core) -->
        <script src="http://virtualtracker.com.br/tracker2/app-assets/js/vendors.bundle.js"></script>
        <script src="http://virtualtracker.com.br/tracker2/app-assets/js/app.bundle.js"></script>
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

  var url = '/tracker2/Imagens/icons/arrow.png';
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
			el_ini.style.backgroundImage ='url(/tracker2/imagens/icons/inicio.png)';
			el_ini.style.width = '35px';
			el_ini.style.height = '42px';
			el_ini.style.zIndex  = '9999999';
		
		var el_fim = document.createElement('div');
			el_fim.className = 'marker';
			el_fim.style.backgroundImage ='url(/tracker2/imagens/icons/chegada.png)'
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
			el_ponto.style.backgroundImage ='url(/tracker2/Imagens/icons/map2.png)';
			el_ponto.style.width = '13px';
			el_ponto.style.height = '13px';
			
			var el_parada = document.createElement('div');
			el_parada.className = 'marker';
			el_parada.style.backgroundImage ='url(/tracker2/Imagens/icons/map3.png)';
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
</html>
