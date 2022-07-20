<?php


include_once("conexao.php");

$cons_empresa = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='1361'");
	if(mysqli_num_rows($cons_empresa) > 0){
while ($resp_empresa = mysqli_fetch_assoc($cons_empresa)) {
$nome_url = $resp_empresa['nome_url'];
$logo = $resp_empresa['logo'];
$texto_rodape = $resp_empresa['texto_rodape'];
$texto_topo = $resp_empresa['texto_topo'];
$cor_sistema = $resp_empresa['cor_sistema'];
	}}

$date = date('Y-m-d');	

$agrupar = 'SIM';

$data_i1 = $_POST['data_inicial'];
$data_ini1 = date('Y-m-d H:i' , strtotime($data_i1));
//$data_i1 = '2020-12-29 06:00:00';

$data_inicial = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_i1)));
$data_inicial_1 = date('d/m/Y H:i' , strtotime($data_i1));


$data_f1 = $_POST['data_final'];
$data_fin1 = date('Y-m-d H:i' , strtotime($data_f1));
//$data_f1 = '2020-12-29 21:00:00';

$data_final = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_f1)));
$data_final_1 = date('d/m/Y H:i' , strtotime($data_f1));




$deviceid = $_POST['veiculo'];
//$deviceid = '178';


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



function segundos_em_tempo($segundos) {
 
 $horas = floor($segundos / 3600);
 $minutos = floor($segundos % 3600 / 60);
 $segundos = $segundos % 60;
 
 return sprintf("%02d:%02d:%02d", $horas, $minutos, $segundos);
 
}
	


	
	
		$cons_eventos_off = mysqli_query($conn,"SELECT * FROM tc_events WHERE deviceid='$deviceid' AND (servertime >= '$data_inicial' AND servertime <= '$data_final') AND (type='ignitionOn' OR type='ignitionOff') ORDER BY servertime ASC");
	if(mysqli_num_rows($cons_eventos_off) > 0){
		while ($row_ev_off = mysqli_fetch_assoc($cons_eventos_off)) {
			
			
			$listagem[] = $row_ev_off;  
			
		}
		
		for ($i=0; $i < count($listagem); $i++) { 
			
		if($listagem[$i]["type"]=='ignitionOn' && $listagem[$i+1]["type"] == 'ignitionOff'){
		
				$date_time  = new DateTime($listagem[$i]['servertime']);
				$diff       = $date_time->diff( new DateTime($listagem[$i+1]['servertime']));
				$horas_mov[] = $diff->format('%H:%i:%s');
				
				//echo ''.$listagem[$i]['type'].': '.$listagem[$i]['servertime'].' - '.$listagem[$i+1]['type'].': '.$listagem[$i+1]['servertime'].' - Tempo Movimento: '.$horas.'<br>';

		}
		if($listagem[$i]["type"]=='ignitionOn' && $listagem[$i+1]["type"] == ''){

				$date_time  = new DateTime($listagem[$i]['servertime']);
				$diff       = $date_time->diff( new DateTime($data_final));
				$horas_mov[] = $diff->format('%H:%i:%s');
				
				//echo ''.$listagem[$i]['type'].': '.$listagem[$i]['servertime'].' - '.$listagem[$i+1]['type'].': '.$listagem[$i+1]['servertime'].' - Tempo Movimento: '.$horas.'<br>';


		} 
		
		if($listagem[$i]["type"]=='ignitionOff' && $listagem[$i+1]["type"] == 'ignitionOn'){
		
				$date_time  = new DateTime($listagem[$i]['servertime']);
				$diff       = $date_time->diff( new DateTime($listagem[$i+1]['servertime']));
				$horas_stop[] = $diff->format('%H:%i:%s');
				
				//echo ''.$listagem[$i]['type'].': '.$listagem[$i]['servertime'].' - '.$listagem[$i+1]['type'].': '.$listagem[$i+1]['servertime'].' - Tempo Parado: '.$horas.'<br>';

		}
		if($listagem[$i]["type"]=='ignitionOff' && $listagem[$i+1]["type"] == ''){

				$date_time  = new DateTime($listagem[$i]['servertime']);
				$diff       = $date_time->diff( new DateTime($data_final));
				$horas_stop[] = $diff->format('%H:%i:%s');
				
				//echo ''.$listagem[$i]['type'].': '.$listagem[$i]['servertime'].' - '.$listagem[$i+1]['type'].': '.$listagem[$i+1]['servertime'].' - Tempo Parado: '.$horas.'<br>';


		} 
		
	//echo ''.$horas.'<br>';

	}}
	
	
	
	$soma = 0;
	$soma1 = 0;
 
foreach($horas_stop as $item1) {
	list($horas,$minutos,$segundos) = explode(":",$item1);
	$calc1 = $horas * 3600 + $minutos * 60 + $segundos;
	$soma1 = $calc1 + $soma1;
}



foreach($horas_mov as $item) {
	list($horas,$minutos,$segundos) = explode(":",$item);
	$calc = $horas * 3600 + $minutos * 60 + $segundos;
	$soma = $calc + $soma;
}
 
$total_mov = segundos_em_tempo($soma);
$total_mov = explode(":", $total_mov);
$hora_mov = $total_mov[0];
$min_mov = $total_mov[1];

$total_stop = segundos_em_tempo($soma1);
$total_stop = explode(":", $total_stop);
$hora_stop = $total_stop[0];
$min_stop = $total_stop[1];

$total_movimento =  ''.$hora_mov.' hora(s) e '.$min_mov.' minutos <br>';
$total_parado = ''.$hora_stop.' hora(s) e '.$min_stop.' minutos';

	
	
	
#------------------------------------------------
#------------------------------------------------
$valor_comb = $_POST['valor_comb'];
$valor_comb = str_replace(".","","$valor_comb");
$valor_comb = str_replace(",",".","$valor_comb");
$km_litro = $_POST['km_litro'];

$consumo = $totalkm / $km_litro;

$valor_gasto = $consumo * $valor_comb;
$valor_gasto1 = number_format($valor_gasto, 2, ",", ".");

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
		<link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/formplugins/select2/select2.bundle.css">
        <!-- Place favicon.ico in the root directory -->
        <link rel="apple-touch-icon" sizes="180x180" href="/tracker3/app-assets/img/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/tracker3/app-assets/img/favicon/favicon-32x32.png">
        <link rel="mask-icon" href="/tracker3/app-assets/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
		<link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/fa-brands.css">
		<link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/fa-solid.css">
		<script src="https://kit.fontawesome.com/a132241e15.js"></script>
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
                           <img src="logos/<?php echo $logo?>" style="width:200px; heigth:auto" alt="SmartAdmin WebApp" aria-roledescription="logo">
                            
                            
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
										<i class='subheader-icon fal fa-bell'></i> Relatório Cercas
										<small>
											Movimento das Cercas Eletrônicas
										</small>
									</h1>
								</div>
							</div>
							<div class="col-xl-4 text-right">
								 <a href="pdf_files/relatorio_cercas.php?data_inicial=<?php echo $data_i1?>&data_final=<?php echo $data_f1?>&deviceid=<?php echo $deviceid?>" target="_blank"><button type="button" class="btn btn-danger btn-sm" style="font-size:14px"><i class="fas fa-file-pdf"></i> PDF</button></a>
								 <button type="button" onclick="imprimir();" class="btn btn-primary btn-sm" style="font-size:14px">Imprimir</button>
							</div>
						</div>
                        
                       
                        <div class="row">
                            <div class="col-xl-12">
                                <div id="panel-1" class="panel">
                                    
                                    <div class="panel-container show">
                                        <div class="panel-content">
											<form action="#" class="steps-validation wizard-circle">
											<div class="row">
												<div class="col-md-12">
												<input type="hidden" id="data_ini" value="<?php echo $data_ini1 ?>">
												<input type="hidden" id="data_fin" value="<?php echo $data_fin1 ?>">
												<input type="hidden" id="device_id" value="<?php echo $deviceid ?>">
												<input type="hidden" id="agrupar" value="<?php echo $agrupar ?>">
												<b>Período:</b> <?php echo $data_inicial_1?>  até <?php echo $data_final_1?><br>
												<b>Cliente:</b> <?php echo $nome_cliente?><br>
												<b>Veículo:</b> <?php echo $marca_veiculo?>/<?php echo $modelo_veiculo?><br>
												<b>Placa: </b><?php echo $placa?>
												</div>
												
											</div>
											<hr>
											
											<!--<div id="map" style="width:100%; height:500px;"></div>--><br>
											
											<div class="row">
												<div class="col-md-12">
													
													<table class="table table-striped table-bordered table-hover">
														<thead>
															<tr>
																<th>Entrada</th>
																<th>Horário Entrada</th>
																<th>Saida</th>
																<th>Horário Saída</th>
																<th>Tempo Evento</th>
																<th>Mapa</th>
															</tr>
														 </thead>
														<tbody>
														<?php 
													$data_hoje = date('Y-m-d H:i');

													$cons_conexao = mysqli_query($conn,"SELECT * FROM tc_events WHERE deviceid='$deviceid' AND type='geofenceEnter' AND (servertime >= '$data_inicial' AND servertime <= '$data_final') ORDER BY id ASC");
														if(mysqli_num_rows($cons_conexao)<= 0){
														echo 'Nenhuma Informação Encontrada';
														}
														if(mysqli_num_rows($cons_conexao) > 0){
															while ($resp_conexao = mysqli_fetch_assoc($cons_conexao)) {
															$positionid = 	$resp_conexao['positionid'];
															$servertime1 = $resp_conexao['servertime'];
															$servertime = date('d/m/Y H:i:s', strtotime('-3 hour', strtotime($servertime1)));
															$geofenceid = $resp_conexao['geofenceid'];
															$type = $resp_conexao['type'];
														
															
															$cons_fence = mysqli_query($conn,"SELECT * FROM tc_geofences WHERE id='$geofenceid'");
																if(mysqli_num_rows($cons_fence) > 0){
																while ($row_fence = mysqli_fetch_assoc($cons_fence)) {
																$name_cerca = $row_fence['name'];
																$description = $row_fence['description'];
																}}
															
															$entrada = '<i class="fas fa-chevron-circle-right" style="color:#4169E1"></i> CHEGADA '.$description.'';
															
															$cons_cliente = mysqli_query($conn,"SELECT * FROM tc_positions WHERE id='$positionid'");
																if(mysqli_num_rows($cons_cliente) > 0){
															while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
															$latitude = 	$resp_cliente['latitude'];
															$longitude = 	$resp_cliente['longitude'];
															$address = 	$resp_cliente['address'];
															$driver_num = $resp_cliente['driver_num'];
																
																$cons_driver = mysqli_query($conn, "SELECT * FROM motoristas WHERE cartao_rfid='$driver_num'");
																	if(mysqli_num_rows($cons_driver) <= 0){
																	$nome_motorista = '';
																	}
																	if(mysqli_num_rows($cons_driver) > 0){
																		while ($resp_rel10 = mysqli_fetch_assoc($cons_driver)) {
																		$id_motorista = $resp_rel10['id_motorista'];
																		$nome_motorista = $resp_rel10['nome_motorista'];

																	}}
															
																}}
															
															
															
															
															$cons_fence_ent = mysqli_query($conn,"SELECT * FROM tc_events WHERE deviceid='$deviceid' AND servertime > '$servertime1' AND type='geofenceExit' ORDER BY id ASC LIMIT 1");
																if(mysqli_num_rows($cons_fence_ent) <= 0){
																$saida = '<i class="fab fa-product-hunt" style="color:#F4A460"></i> PARADO NO LOCAL';
																$servertime10 = '';
																$tempo ='';
																}
																if(mysqli_num_rows($cons_fence_ent) > 0){
																while ($row_fence1 = mysqli_fetch_assoc($cons_fence_ent)) {
																$servertime11 = $row_fence1['servertime'];
																$servertime10 = date('d/m/Y H:i:s', strtotime('-3 hour', strtotime($servertime11)));
																$date_time  = new DateTime($servertime1);
																 $diff       = $date_time->diff( new DateTime($servertime11));
																 $tempo = $diff->format('%H hora(s), %i minuto(s)');
																 $saida = '<i class="fas fa-chevron-circle-left" style="color:#009900"></i> SAIDA '.$description.'';
																}}
																
																$horario = $ervertime10;
																
																 
															
															
													?>
													<tr>
														<td><b><?php echo $entrada?></b></td>
														<td><?php echo $servertime?></td>
														<td><b><?php echo $saida?></b></td>
														<td><?php echo $servertime10; ?></td>
														<td><i class="far fa-clock"></i> <?php echo $tempo; ?></td>
														<td><a href="http://maps.google.com/maps?q=<?php echo $latitude?>,<?php echo $longitude?>&ll=<?php echo $latitude?>,<?php echo $longitude?>&z=17" target="_blank"><button type="button" class="btn btn-dark btn-sm btn-icon" title="Google Maps" data-toggle="tooltip" data-offset="0,10" data-original-title="Google Maps"><i class="fas fa-map-marked-alt"></i></button></a></td>
													</tr>
													<tr>
													<td colspan="2" style="border-bottom:#999 1px solid;"><i class="fas fa-user"></i> <?php echo $nome_motorista?></td>
													<td colspan="4" style="border-bottom:#999 1px solid;"><i class="fas fa-map-marker-alt"></i> <?php echo $address?></td>
													</tr>
													<?php }}?>
															</tbody>
													</table>
													 
												</div>
											</div>
                                        </form>
											 
                                       <input type="hidden" id="id_relatorio" value="<?php echo $id_relatorio?>">
				
				
				
					<?php 
				$base64 = $deviceid.'@'.$data_inicial.'@'.$data_final;
				$base64 = base64_encode($base64);
				
				?>
				<input type="hidden" id="base64" value="<?php echo $base64?>">
											
											
											
											
											
											

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						</form>
                    </main>
					
					<!-- DIV Carregar -->
					<div class="modal fade" id="carregar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-sm modal-dialog-centered">
							<div class="modal-content">
								
								<div class="modal-body" id="informacoes">
									<span style="fonta-size:20px"> Aguarde... </span> <img src="/tracker2/Imagens/load.gif" width="40px" height="40px">
								</div>
								
							</div>
						</div>
					</div>	
                    <!-- FIM DIV Carregar -->
					
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
        <!-- BEGIN Messenger -->
			<?php include('include/messenger.php');?>
        <!-- END Messenger -->
        <!-- BEGIN Page Settings -->
			<?php include('include/settings.php');?>
        <!-- END Page Settings -->
		<?php 
				$base64 = $deviceid.'@'.$data_inicial.'@'.$data_final;
				$base64 = base64_encode($base64);
				
				?>
				<input type="hidden" id="base64" value="<?php echo $base64?>">
        <script src="/tracker3/app-assets/js/vendors.bundle.js"></script>
        <script src="/tracker3/app-assets/js/app.bundle.js"></script>
        <script src="/tracker3/app-assets/js/formplugins/select2/select2.bundle.js"></script>
<script>
$('#forml').on('submit', function(e){
  $('#carregar').modal('show');
});
</script>   
	<script>
			var base64 = document.getElementById("base64").value;
		
		function imprimir(){
		window.open("http://rastreiamaisbrasil.com.br/tracker3/manager/imprimir_relatorio_cercas.php?c="+base64, "minhaJanela", "height=700,width=1000");
		}
	</script>
</body>
</html>
