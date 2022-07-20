<?php
include_once("conexao_ext.php");
$date = date('Y-m-d');
$date2 = date('Y-m-d H:i');
$limite = $_GET['p'];

$data_base = base64_decode($limite);

$base = explode("&", $data_base);
$id_veic = $base[0];
$data_limite = $base[1];


$base1 = explode("=", $data_limite);
$data_limite1 = $base1[1];
if($data_limite1 < $date2){
	header('Location: position.php');
}


$base2 = explode("=", $id_veic);
$deviceid = $base2[1];

$id_empresa = '1361';



$dados_empresa = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='$id_empresa'");
	if(mysqli_num_rows($dados_empresa) > 0){
while ($resp_conta = mysqli_fetch_assoc($dados_empresa)) {
$nome_fantasia	 = 	$resp_conta['nome_fantasia'];
	}}
	
	$chave_google = mysqli_query($conn,"SELECT * FROM api_google ORDER BY id DESC LIMIT 1");
	if(mysqli_num_rows($chave_google) > 0){
while ($resp_google = mysqli_fetch_assoc($chave_google)) {
$chave	 = 	$resp_google['chave'];

	}}

$result_usuario = "SELECT * FROM tc_devices WHERE id='$deviceid'";
					$resultado_usuario = mysqli_query($conn, $result_usuario);


					//Verificar se encontrou resultado na tabela "usuarios"
					if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
					?>

				  <?php
			while($row_usuario = mysqli_fetch_assoc($resultado_usuario)){
				$id_device = $row_usuario['id'];
				$name = $row_usuario['name'];
				$positionid = $row_usuario['positionid'];
				$category = 	$row_usuario['category'];
				if($category == 'car'){
					$tipo_veiculo = '<font style="font-size:26px"><i class="fas fa-car" title="Automóvel"></i></font>';
				}
				else if($category == 'motorcycle'){
					$tipo_veiculo = '<font style="font-size:26px"><i class="fas fa-motorcycle" title="Motocicleta"></i></font>';
				} 
				else if($category == 'pickup'){
					$tipo_veiculo = '<font style="font-size:26px"><i class="fas fa-pickup" title="Pick-up"></i></font>';
				}
				
				
				$cons_cliente = mysqli_query($conn,"SELECT * FROM tc_positions WHERE id='$positionid' ORDER BY id DESC");
					if(mysqli_num_rows($cons_cliente) > 0){
				while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
				$address = 	$resp_cliente['address'];
				$devicetime = 	$resp_cliente['devicetime'];
				$latit = 	$resp_cliente['latitude'];
				$longit = 	$resp_cliente['longitude'];
				
				date_default_timezone_set('America/Sao_Paulo');
				$objDate = DateTime::createFromFormat('Y-m-d H:i:s', $devicetime);
				$date_dev = $objDate->format('Y-m-d');
				$date_dev = date('Y-m-d', time());
				$time_dev = $objDate->format('H:i:s');
				$time_dev = date('H:i:s', strtotime('-3 hour', strtotime($time_dev)));
				$devicetime = ''.$date_dev.' '.$time_dev.'';
				$devicetime = date('d/m/Y H:i:s', strtotime("$devicetime"));
				
				$hora =  date('H:i:s');
				
				$inicio = DateTime::createFromFormat('H:i:s', $time_dev);
				$fim = DateTime::createFromFormat('H:i:s', $hora);
				$intervalo = $inicio->diff($fim);
				$inter = $intervalo->format('%H:%I:%S');
				
					$address1 = explode(',', $address);
					$result = count($address1);
					
					$estado_n = $result -1;
					$estado = $address1[$estado_n];
					$rua = $address1[0];
					$cidade_n = $result -4;
					$cidade = $address1[$cidade_n];
					
					

					if($estado = 'Rio Grande do Sul'){
						$uf = 'RS';
					}
					
					$address_db = ''.$rua.' - '.$cidade.' / '.$uf.'';
				
				
				$address = utf8_encode($address_db);
				$speed = 	$resp_cliente['speed'];
				
				
				
								
				
				
				
				$speed = $speed * 1.609;
				$speed = round($speed, 2);
				$attributes = $resp_cliente['attributes'];
				$obj = json_decode($attributes);
				$power = $obj->{'power'};
				$ignicao = $obj->{'ignition'};
				$total_km = $obj->{'totalDistance'};
				$total_km = $total_km / 1000;
				$total_km = round($total_km, 2);
				$total_km = number_format($total_km, 2, ",", ".");
				$km = '<button type="button" class="btn btn-info" style="font-size:13px; top:0; width:auto;" title="Hodometro: '.$total_km.' KM"><i class="fas fa-road" title="Hodometro: '.$total_km.' KM"></i></button>';
				if (is_bool($ignicao)) $ignicao ? $ignicao = "true" : $ignicao = "false";
				else if ($ignicao !== null) $ignicao = (string)$ignicao;
				
				
				
				$cons_conexao = mysqli_query($conn,"SELECT * FROM tc_events WHERE deviceid='$id_device' ORDER BY id DESC LIMIT 1");
					if(mysqli_num_rows($cons_conexao) > 0){
				while ($resp_conexao = mysqli_fetch_assoc($cons_conexao)) {
				$status_conexao = 	$resp_conexao['type'];
				$servertime = 	$resp_conexao['servertime'];
				
				$block = '<button type="button" id="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" style="font-size:13px; top:0; width:auto;"><i class="fas fa-lock-open" title="Desbloqueado"></i></button>';
				
				
				
				if($status_conexao == 'deviceOffline'){
					$conect = '<button type="button"  class="btn btn-danger" style="font-size:13px; top:0; width:auto;" title="Desconetado a '.$inter.'"><i class="fas fa-wifi" title="Desconetado a '.$inter.'"></i></button>';
				} else {
					$conect = '<button type="button" class="btn btn-success" style="font-size:13px; top:0; width:auto;" title="Conectado"><i class="fas fa-wifi" title="Conectado"></i></button>';
				}
				
				if($ignicao == 'true' && $speed >= 6){
					$ign = '<button type="button" class="btn btn-success" style="font-size:13px; top:0; width:auto;" title="Ignição Ligada"><i class="fas fa-key" title="Ignição Ligada"></i></button>';
					$apeed1 = '<button type="button" class="btn btn-info" style="font-size:13px; top:0; width:auto;"><i class="fas fa-tachometer-alt"></i> <b>'.$speed.' km/h</b></button>';
				} else if ($ignicao == 'true' && $speed <= 5){
					$ign = '<button type="button" class="btn btn-warning" style="font-size:13px; top:0; width:auto;" title="Ignição Ligada"><i class="fas fa-key" title="Ignição Ligada"></i></button>';
					$apeed1 = '<button type="button" class="btn btn-info" style="font-size:13px; top:0; width:auto;"><i class="fas fa-tachometer-alt"></i> <b>'.$speed.' km/h</b></button>';					
				} else {
					$ign = '<button type="button" class="btn btn-dark" style="font-size:13px; top:0; width:auto;" title="Ignição Desligada"><i class="fas fa-key" title="Ignição Desligada"></i></button>';
					$apeed1 = '<button type="button" class="btn btn-info" style="font-size:13px; top:0; width:auto;"><i class="fas fa-tachometer-alt"></i> <b>0 km/h</b></button>';					
				}
				
				$cons_veiculo = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE deviceid='$id_device' ");
					if(mysqli_num_rows($cons_veiculo) > 0){
				while ($resp_veiculo = mysqli_fetch_assoc($cons_veiculo)) {
				$placa = 	$resp_veiculo['placa'];
				$bloqueio = 	$resp_veiculo['bloqueio'];
				$alarme_veic = 	$resp_veiculo['alarme'];
				$status_alarme = 	$resp_veiculo['status_alarme'];
				$imei = 	$resp_veiculo['imei'];
				$chip = 	$resp_veiculo['chip'];
				$modelo_equip = 	$resp_veiculo['modelo_equip'];
				
				if($modelo_equip == 'ST310U'){
					$volts = ''.$power.'v';
					}
				if($modelo_equip != 'ST310U'){
					$volts = '0.00v';
					}
				
				if($bloqueio == 'SIM'){
					$block = '<button type="button" class="btn btn-danger" style="font-size:13px; top:0; width:auto;" title="BLOQUEADO"><i class="fas fa-lock" title="BLOQUEADO"></i></button>';
					$block2 = '<i class="fa fa-lock-open"></i> Desbloquear';
					$block3 = 'bloqueado';
					$block4 = 'DESBLOQUEIO';
					$block5 = '<button type="button" class="btn btn-success btn-sm"  data-toggle="modal" data-target="#bloqueio" title="DESBLOQUEAR"><i class="fas fa-lock-open" title="DESBLOQUEAR"></i> DESBLOQUEAR</button>';
				} else if($bloqueio == 'NAO'){
					$block = '<button type="button" class="btn btn-success" style="font-size:13px; top:0; width:auto;" title="Desbloqueado"><i class="fas fa-lock-open" title="Desbloqueado"></i></button>';
					$block2 = '<i class="fa fa-lock"></i> Bloquear';
					$block3 = 'desbloqueado';
					$block4 = 'BLOQUEIO';
					$block5 = '<button type="button" class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#bloqueio" title="BLOQUEAR"><i class="fas fa-lock" title="BLOQUEAR"></i> BLOQUEAR</button>';
				} 
				
				if($alarme_veic == 'SIM' && $status_alarme == 'ON'){
					$botao_alarme = '<button type="button" class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#alarme_veiculo" title="DESATIVAR ALARME"><i class="fas fa-bell" title="DESATIVAR ALARME"></i> DESATIVAR ALARME</button>';
					$status_alarme1 = 'ATIVADO';
					$status_alarme2 = 'DESATIVAR';
				} else if($alarme_veic == 'SIM' && $status_alarme == 'OFF'){
					$botao_alarme = '<button type="button" class="btn btn-info btn-sm"  data-toggle="modal" data-target="#alarme_veiculo" title="ATIVAR ALARME"><i class="far fa-bell" title="ATIVAR ALARME"></i> ATIVAR ALARME</button>';
					$status_alarme1 = 'DESATIVADO';
					$status_alarme2 = 'ATIVAR';
				} else {
					$botao_alarme = '';
				}
				
			}}}}}}}}
			
		$cons_ancora = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE deviceid = '$deviceid'");
					if(mysqli_num_rows($cons_ancora) > 0){
				while ($resp_anc = mysqli_fetch_assoc($cons_ancora)) {
				$ancora = 	$resp_anc['ancora'];
				$geofenceid = 	$resp_anc['geofenceid'];	
				$veiculo = 	''.$resp_anc['marca_veiculo'].' / '.$resp_anc['modelo_veiculo'].'';	
				
				
				
				$sql1 = mysqli_query($conn, "SELECT * FROM tc_geofences WHERE id='$geofenceid'");
			if(mysqli_num_rows($sql1) > 0){
				while ($resp = mysqli_fetch_assoc($sql1)) {
				$area = 	$resp['area'];
				$posicao = strpos($area,"(-");
				$resultado = substr($area,$posicao);
				$area = str_replace('(', '', $resultado);
				$area = str_replace(')', '', $area);
				$area = str_replace(',', '', $area);
				$area = str_replace(' ', ',', $area);
				$area1 = explode(",", $area);
				$anc_lat = $area1[0];
				$anc_long = $area1[1]; 	
				$anc_raio = $area1[2];				
					}}
					
			}}
			
			if($ancora == 'ON'){
				$latitude_ancora = $anc_lat;
				$longitude_ancora = $anc_long;
				$raio_ancora = $anc_raio;
				$info_modal = '<p>O veiculo já esta com Âncora ativada.</p><br><p>Deseja destivar?</p>';
				$link_ancora = '<a href="comandos/del_ancora.php?&deviceid='.$deviceid.'&geofenceid='.$geofenceid.'">';
			} else {
			$latitude_ancora = $latit;
				$longitude_ancora =  $longit;
				$raio_ancora = '0.5';
				$info_modal = '<p>A localização do veículo é <b>'.$address.'</b>.</p><br><p>Deseja ancorar neste endereço?</p>';
				$link_ancora = '<a href="comandos/ancora.php?deviceid='.$deviceid.'&geofenceid='.$geofenceid.'">';
			}
		


$cons_cerca = mysqli_query($conn,"SELECT * FROM tc_events WHERE type='geofenceEnter' AND deviceid='$deviceid' ORDER BY id DESC LIMIT 1");
if(mysqli_num_rows($cons_cerca) > 0){
	while ($row_ev = mysqli_fetch_assoc($cons_cerca)) {
		$deviceid = $row_ev['deviceid'];
		$horario_alarme = $row_ev['servertime'];
		$type = $row_ev{'type'};
		$geofenceid = $row_ev['geofenceid'];
		$id_unico = $row_ev['id'];
		
		$sql11 = mysqli_query($conn, "SELECT * FROM tc_geofences WHERE id='$geofenceid'");
			if(mysqli_num_rows($sql11) > 0){
				while ($resp1 = mysqli_fetch_assoc($sql11)) {
				$name_cerca1 = $resp1['name'];
				$description1 = $resp1['description'];
				$area1 = 	$resp1['area'];
				$posicao1 = strpos($area1,"(-");
				$resultado1 = substr($area1,$posicao1);
				$area1 = str_replace('(', '', $resultado1);
				$area1 = str_replace(')', '', $area1);
				$area1 = str_replace(',', '', $area1);
				$area1 = str_replace(' ', ',', $area1);
				$area1 = explode(",", $area1);
				$anc_lat1 = $area1[0];
				$anc_long1 = $area1[1]; 	
				$anc_raio1 = $area1[2];		

				$latitude_cerca = $anc_lat1;
				$longitude_cerca = $anc_long1;
				$raio_cerca = $anc_raio1;
					}}
					
					

}}


	?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>POSICAO VEICULO</title>
    <link rel="apple-touch-icon" href="http://jctracker.com.br/tracker2/app-assets/images/ico/apple-icon-120.png">
   
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
  top: 5%;
  left: 2%;
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
  top: 34%;
  right: 1.2%;
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
  top: 44%;
  right: 1.2%;
  z-index: 5;
  background-color:  rgb(255, 255, 255, 0);
  padding: 5px;
  text-align: center;
  font-family: 'Roboto','sans-serif';
  line-height: 30px;
  padding-left: 10px;
}
#floating-pane20 {
  position: absolute;
  bottom: 2%;
  left: 1.2%;
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
  top: 41%;
  left: 2%;
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
  bottom: 1%;
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
<style>
	.Ligada{
		color: #08700a;
	}
	.Desligada{
		color: #bd0202
	}
	.mapboxgl-popup-tip{
		margin-bottom: 35px;
	}

</style>
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern semi-dark-layout 2-columns" data-open="click">

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
												  POSIÇÃO VEÍCULO
												</h4>
												
											</div>
                                           <div class="row">
												<div class="col-lg-12">
													 <div id="map" style="width:100%; height:400px;"></div>
													
													<div id="floating-panel2">				
														<button type="button" onClick="setSatellite();setHybrid1();" class="btn btn-dark btn-sm btn-icon" title="Troca de Mapa" data-toggle="tooltip" data-offset="0,10" data-original-title="Troca de Mapa"><i class="fas fa-satellite" title="Satélite"></i></button>							
													</div>
													<div id="floating-panel3">				
														<a href="https://www.google.com/maps?layer=c&cbll=<?php echo $latit?>,<?php echo $longit?>" target="_blank"><button type="button" class="btn btn-dark btn-sm btn-icon" title="Street View" title="Troca de Mapa" data-toggle="tooltip" data-offset="0,10" data-original-title="Street View"><i class="fas fa-street-view"></i></button></a>						
													</div>
													<div id="floating-pane20">				
														<a href="https://www.google.com/maps/dir//<?php echo $latit?>,<?php echo $longit?>/@<?php echo $latit?>,<?php echo $longit?>,17z" target="_blank"><button type="button" class="btn btn-dark btn-sm btn-icon" title="Navegar" data-toggle="tooltip" data-offset="0,10" ><i class="fas fa-directions"></i> Navegar</button></a>						
													</div>
												</div>

											</div><br>
											<div class="row">
												<div class="col-lg-12">
													<div class="ibox ">
														<div class="ibox-content">
															
															<div class="row">
																<div class="col-lg-12">
																	<div style="width:100%; height: 400px; overflow: auto;">
																	<table class="table table-striped table-bordered table-hover">
																	  <thead>
																		<tr>
																		  
																		  <th>Placa</th>
																		  <th>Veículo</th>
																		  <th>Endereço</th>
																		  <th>Velocidade</th>
																		  
																		  
																		</tr>
																	  </thead>
																	  <tbody id="grid_veiculos"> 
																	
																		</tbody>
																	</table><br>
																		<input type="hidden" value="<?php echo $id_device?>" id="deviceid">	  
																		<input type="hidden" value="<?php echo $latitude_ancora?>" id="latitude_ancora">
																		<input type="hidden" value="<?php echo $longitude_ancora?>" id="longitude_ancora">
																		<input type="hidden" value="<?php echo $raio_ancora?>" id="raio_ancora">	
																		<input type="hidden" value="<?php echo $ancora?>" id="anc_raio">	
																		<input type="hidden" value="<?php echo $name_cerca1?>" id="tipo_cerca">	
																		<input type="hidden" value="<?php echo $ancora?>" id="ancora_on">
																		<input type="hidden" value="<?php echo $imei?>" id="imei">
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
        </div>
    </div>
    <!-- END: Content-->
	<input type="hidden" value="<?php echo $_GET['codigo_sms']?>" id="codigo_sms">
	<div id="status_comando" style="display:none"></div>
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
  <?php include('include/footer.php');?>
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
	<?php
		$cons_token = mysqli_query($conn,"SELECT * FROM chaves_maps ORDER BY id DESC LIMIT 1");
			if(mysqli_num_rows($cons_token) > 0){
		while ($resp_token = mysqli_fetch_assoc($cons_token)) {
		$token = 	$resp_token['chave'];
			}}
		?>
        <script src="js/datagrid/datatables/datatables.bundle.js"></script>
		<script src="js/formplugins/select2/select2.bundle.js"></script>
		<script>
			function comando_ok(){
				$('#comando_sms').modal('hide');
				$('#envios_sms1').modal('show');
				}
		</script>
      <script type="text/javascript">
	$(function(){
	  $("select[name=comando]").change(function(){
	var comando = document.getElementById("comando").value;
	var imei = document.getElementById("imei").value;
	$(document).ready(function () {
				listar_comando(comando); //Chamar a função para listar os registros
			});
			
			function listar_comando(comando){
				var dados = {
					comando: comando, imei: imei
				}
				$.post('ajax/comando.ajax.php', dados , function(retorna){
					//Subtitui o valor no seletor id="conteudo"
					$("#retorno_comando").html(retorna);
				});
			}
	  })	
	})
	
	
</script>


		


<script src='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css' rel='stylesheet' />
<script>

var deviceid = document.getElementById("deviceid").value;
var latitude_ancora = document.getElementById("latitude_ancora").value;
var longitude_ancora = document.getElementById("longitude_ancora").value;
var raio_ancora = document.getElementById("raio_ancora").value;
var tipo_cerca = document.getElementById("tipo_cerca").value;
var ancora_on = document.getElementById("ancora_on").value;





	mapboxgl.accessToken = 'pk.eyJ1IjoibG9jYWxyYXN0IiwiYSI6ImNqeXN4czV1ODAwd2YzbnA5a2k4MnFhNTAifQ.k_bVUpB4zPA2dQtHPQHSUQ';
		

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
center: [<?php echo $longit?>, <?php echo $latit?>],
zoom: 16,
pitch: 65,
bearing: -17.6,
antialias: true
});



if(tipo_cerca != 'ANCORA'){
	map.on('load', function() {
      map.addSource("source_circle_500", {
        "type": "geojson",
        "data": {
          "type": "FeatureCollection",
		  
          "features": [{
            "type": "Feature",
				 
            "geometry": {
              "type": "Point",
              "coordinates": [<?php echo $longitude_cerca?>, <?php echo $latitude_cerca?>]
			 
            },
			"properties": {
				"title": "CERCA <?php echo $name_cerca1?>"
				}
          }]
        }
      });

      map.addLayer({
        "id": "circle500",
        "type": "circle",
        "source": "source_circle_500",
		
        "paint": {
          "circle-radius": {
            stops: [
              [5, 1],
              [15, <?php echo $raio_cerca?>]
            ],
            base: 2
          },

          "circle-color": "#003366",
          "circle-opacity": 0.2,
	      "circle-stroke-color": "#003366",
		  "circle-stroke-width": 4,
        }
      });
	  // Add a symbol layer
		map.addLayer({
			'id': 'source_circle_500',
			'type': 'symbol',
			'source': 'source_circle_500',
			'layout': {
			// get the title name from the source's "title" property
			'text-field': ['get', 'title'],
			'text-font': [
			'Open Sans Semibold',
			'Arial Unicode MS Bold'
			],
			'text-offset': [0, 1.25],
			'text-anchor': 'top'
			}
		});
	  
 });
} 
if(ancora_on == 'ON') {
	map.on('load', function() {
      map.addSource("source_circle_400", {
        "type": "geojson",
        "data": {
          "type": "FeatureCollection",
		  
          "features": [{
            "type": "Feature",
				 
            "geometry": {
              "type": "Point",
              "coordinates": [<?php echo $longitude_ancora?>, <?php echo $latitude_ancora?>]
			 
            },
			"properties": {
				"title": "ANCORA"
				}
          }]
        }
      });

      map.addLayer({
        "id": "circle400",
        "type": "circle",
        "source": "source_circle_400",
		
        "paint": {
          "circle-radius": {
            stops: [
              [5, 1],
              [15, <?php echo $raio_ancora?>]
            ],
            base: 2
          },

          "circle-color": "#006666",
          "circle-opacity": 0.4,
	      "circle-stroke-color": "#006666",
		  "circle-stroke-width": 4
        }
      });
	  

	  
	  // Add a symbol layer
		map.addLayer({
			'id': 'source_circle_400',
			'type': 'symbol',
			'source': 'source_circle_400',
			'layout': {
			// get the title name from the source's "title" property
			'text-field': ['get', 'title'],
			'text-font': [
			'Open Sans Semibold',
			'Arial Unicode MS Bold'
			],
			'text-offset': [0, 1.25],
			'text-anchor': 'top'
			}
		});
		
	  
 });
}




map.on("click", function(e) {
  console.log(e)
  if (e.originalEvent.target) {

  }
    /*
    console.log(marker)

    map.flyTo({
      center: [
         marker.lon,
         marker.lat
      ],
      essential: true // this animation is considered essential with respect to prefers-reduced-motion
      });
    }
    */
});
var tipo_mapbox = 0
function setSatellite(){
  if(tipo_mapbox == 0){
    map.setStyle('mapbox://styles/mapbox/satellite-v9');
    tipo_mapbox = 1
  }else{
    map.setStyle('mapbox://styles/mapbox/streets-v11');
    tipo_mapbox = 0
  }
}

map.addControl(new mapboxgl.FullscreenControl());
map.addControl(new mapboxgl.NavigationControl());
var mapboxMarkers = []








function refreshMap(){
 downloadUrl('resultado_device_ext.php?id_device='+deviceid, (data) => {
    var xml = data.responseXML;
      markers = xml.documentElement.getElementsByTagName('marker');
      

      Array.prototype.forEach.call(markers, function(markerElem) {

          var name = markerElem.getAttribute('name');
          var address = markerElem.getAttribute('address');
          var ign = markerElem.getAttribute('ign');
          var latitude = markerElem.getAttribute('lat');
          var longitude = markerElem.getAttribute('lng');
          var placa = markerElem.getAttribute('placa');
          var data_format = markerElem.getAttribute('data_format')
          var ignicao = markerElem.getAttribute('ignicao')
          var point = [parseFloat(longitude), parseFloat(latitude)]
          
            
            // add marker to map
          var encontrou = false;
          for(let i = 0; i<= mapboxMarkers.length-1; i++){
            if(mapboxMarkers[i].name == name){
                  encontrou = true
                  if(String(ign) != String(mapboxMarkers[i].ign)
                          || String(point) != String(mapboxMarkers[i].point)
                          ){
							map.flyTo({
							center: point,
							speed: 0.7
							});
							

							

							let linha = [
								mapboxMarkers[i].point,
								point,
							]
							let ident = Math.random()
							map.addSource('route'+ident, {
								'type': 'geojson',
								'data': {
									'type': 'Feature',
									'properties': {},
									'geometry': {
										'type': 'LineString',
										'coordinates': linha
									}
								}
							});
							map.addLayer({
								'id': 'route'+ident,
								'type': 'line',
								'source': 'route'+ident,
								'layout': {
								'line-join': 'round',
								'line-cap': 'round'
								},
								'paint': {
								'line-color': '#293185',
								'line-width': 4
								}
							});


							var el = document.createElement('div');
							el.className = 'marker';
							el.style.backgroundImage =
							'url(/tracker2/manager/imagens/icons/'+ign;
							el.style.width = '99px';
							el.style.height = '73px';
							var infotitle = `
								<div style="margin-bottom: 25px">
									<strong><b>${name}</b></strong>
									<br><br>
									<text>${address}</text>
									<br>
									<br>
									<text><b>Data/Hora:</b> ${data_format}</text>
									<br><br>
									<text><b>Ignicao:</b> <i class="fas fa-key ${ignicao}"></i> <span class="${ignicao}">${ignicao}</span></text>

								</div>`
							var popup = new mapboxgl.Popup({ closeOnClick: false }).setLngLat([longitude, latitude]).setHTML(infotitle)
							var marker = new mapboxgl.Marker(el).setLngLat([longitude, latitude]).setPopup(popup).addTo(map);
							
							var tagg = {
								name: name,
								point: point,
								ign: ign,
								marcador: marker
							}
                            mapboxMarkers[i].marcador.remove()
							mapboxMarkers = []
							mapboxMarkers.push(tagg)


							
							
							
                          
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
                        <strong><b>${name}</b></strong>
                        <br><br>
                        <text>${address}</text>
                        <br>
                        <br>
                        <text><b>Data/Hora:</b> ${data_format}</text>
                        <br><br>
                        <text><b>Ignicao:</b> <i class="fas fa-key ${ignicao}"></i> <span class="${ignicao}">${ignicao}</span></text>

                      </div>`
                  var popup = new mapboxgl.Popup({ closeOnClick: false }).setLngLat([-96, 37.8]).setHTML(infotitle)
                  var marker = new mapboxgl.Marker(el).setLngLat([longitude, latitude]).setPopup(popup).addTo(map);
                  
                  var tagg = {
                      name: name,
                      point: point,
                      ign: ign,
                      marcador: marker
                  }
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

  
	


    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=<?php echo $chave?>&callback=initMap">
    </script>
	

	
		<script>
			$(document).ready(function () {
				
				$.post('include/grid_device_ext.php?id_device='+deviceid, function(grid_veiculos){
					$("#grid_veiculos").html(grid_veiculos);
					
					
				});
			});
		</script>

	
	

 
  <script>
  var intervalo = setInterval(function() { $('#grid_veiculos').load('include/grid_device_ext.php?id_device='+deviceid); }, 3000);
  </script>
    <script>
  var intervalo = setInterval(function() { $('#alertas_avisos').load('include/alertas.php?id_device='+deviceid); }, 7000);
  </script>
      <script>
	  var chip = document.getElementById("chip").value;
  var intervalo = setInterval(function() { $('#status_comando').load('include/retorno_comando.php?chip='+chip); }, 3000);
  </script>
</body>
<!-- END: Body-->

</html>