 

 <?php

$servidor = "localhost";
$usuario = "root";
$senha = "TR4vcijU6T9Keaw";
$dbname = "traccardb";

//Criar a conexao
$con = mysqli_connect($servidor, $usuario, $senha, $dbname);

	//adiciono meu arquivo de functions
	require_once('includes/functions.php');
	//recebo via post minha variavel enviada pelo ajax
	$page = $_POST['page'];
	$id_push = $_POST['id'];
	//defino a quantidade de registro trazidos a cada pesquisa
	$qntd = 10;
	//defino a partir de qual registro ele começa a buscar
	$inicio = $qntd * $page;
	//instacio minha classe
	$Wall = new Wall_Updates();
	//chamo meu método passando as variaveis de controle da query e guardo numa variavel
	$updatesarray = $Wall->UpdatesAjax($inicio,$qntd);
	//se houve registros retornados entra no if
	if(count($updatesarray)){
		foreach($updatesarray as $data){
		//percorre o array e joga na tela seu valor até seu final
		
	
	$deviceid = $data['id'];
	$name = $data['name'];
	$positionid = $data['positionid'];
	$category = 	$data['category'];
	$lastupdate = 	$data['lastupdate'];
	$lastupdate_data = date('d/m/Y H:i', strtotime('-3 hour', strtotime($lastupdate)));
	$lastupdate_hora = date('H:i:s', strtotime('-3 hour', strtotime($lastupdate)));	
	
	$data_agora = date('Y-m-d H:i:s');
	$data_agora = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_agora)));
	$data_agora1 = date('Y-m-d H:i:s', strtotime('-5 minutes', strtotime($data_agora)));
	
	if($lastupdate < $data_agora1){
		$conect = '<a href="#" class="btn btn-xxs rounded-s font-900 shadow-s color-red2-dark" style="width:50%"><i class="fas fa-wifi fa-2x"></i></a>';
		$status_conexao = 'off';
		$cor_status = 'danger';
		$status_conexao = 'Offline';
	} else {
		$conect = '<a href="#" class="btn btn-xxs rounded-s font-900 shadow-s color-green2-dark" style="width:50px"><i class="fas fa-wifi fa-2x"></i></a>
					';
		$status_conexao = 'on';
		$cor_status = 'success';
		$status_conexao = 'Online';
	}
	
	if($category == 'car'){
		$modelo_img = 'car.png';
	}
	if($category == 'Automovel'){
		$modelo_img = 'car.png';
	}
	if($category == 'motorcycle'){
		$modelo_img = 'motorcycle.png';
	}
	if($category == 'Motocicleta'){
		$modelo_img = 'motorcycle.png';
	}
	if($category == 'bus'){
		$modelo_img = 'bus.png';
	}
	if($category == 'Onibus'){
		$modelo_img = 'bus.png';
	}
	if($category == 'truck'){
		$modelo_img = 'truck.png';
	}
	if($category == 'Caminhao'){
		$modelo_img = 'truck.png';
	}
	
	//========= DADOS POSIÇÃO ============
	$cons_cliente = mysqli_query($con,"SELECT * FROM tc_positions WHERE id='$positionid'");
	if(mysqli_num_rows($cons_cliente) > 0){
	while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
	
	$address = 	$resp_cliente['address'];
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
	$address = str_replace('Corredor de Transporte Coletivo', 'Av.', $address);
	
	
	$devicetime = 	$resp_cliente['fixtime'];
	$devicetime11 = date('d/m/Y H:i', strtotime('-3 hour', strtotime($devicetime)));
	
	$speed = 	$resp_cliente['speed'];
	
	$speed = $speed * 1.609;
	$speed = round($speed, 2);
	$attributes = $resp_cliente['attributes'];
	$obj = json_decode($attributes);
	$ignicao = $obj->{'ignition'};
	}}
	
	if (is_bool($ignicao)) $ignicao ? $ignicao = "true" : $ignicao = "false";
	else if ($ignicao !== null) $ignicao = (string)$ignicao;
	
	if($ignicao == 'true' && $speed >= 6){
		$ign = 'Ligado';
		$movi = 'EM MOVIMENTO';
		$apeed1 = $speed;
		$cor_ign = '#009900';
		$cor_ign2 = 'success';
		$icon_ign = 'ign_on.jpg';
	} else if ($ignicao == 'true' && $speed <= 5){
		$ign = 'Ligado';
		$movi = 'PARADO';
		$apeed1 = $speed;
		$cor_ign = '#F4A460';
		$cor_ign2 = 'warning';
		$icon_ign = 'ign_stop.jpg';
	} else {
		$ign = 'Desligado';
		$movi = '';
		$apeed1 = '0.00';
		$cor_ign = '#000';
		$cor_ign2 = 'dark';
		$icon_ign = 'ign_off.jpg';
	}
	
	//========= DADOS POSIÇÃO ============
	
	
	//========= DADOS VEICULO ============
	$cons_veiculo = mysqli_query($con,"SELECT * FROM veiculos_clientes WHERE deviceid='$deviceid' ");
	if(mysqli_num_rows($cons_veiculo) > 0){
	while ($resp_veiculo = mysqli_fetch_assoc($cons_veiculo)) {
	$placa = 	$resp_veiculo['placa'];
	$bloqueio = 	$resp_veiculo['bloqueio'];
	$pos_inicial = 	$resp_veiculo['pos_inicial'];
	$ancora = 	$resp_veiculo['ancora'];
	$marca_veiculo = 	$resp_veiculo['marca_veiculo'];
	$modelo_veiculo = 	$resp_veiculo['modelo_veiculo'];
	//$modelo_img = str_replace(' ', '_', $modelo_veiculo);
	$id_cliente = 	$resp_veiculo['id_cliente'];
	$veiculo = $placa.' - '.$marca_veiculo.'/'.$modelo_veiculo;
	$veic_volts = 	$resp_veiculo['volts'];
	$veic_satelite = 	$resp_veiculo['satelite'];
	$veic_gsm = 	$resp_veiculo['gsm'];
	$veic_bateria_interna = 	$resp_veiculo['bateria_interna'];
	}}
	
	if($bloqueio == 'SIM'){
		$status_bloqueio = '<h3><span class="badge" style="background-color:#CD5C5C; color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Veículo Bloqueado"><i class="fas fa-lock"></i></span></h3>';
		$cor_block = '#CD5C5C';
		$icon_block = '<i class="fas fa-lock fa-2x" style="color:#990000;"></i>';
		$nome_block = 'Bloqueado';
	}
	if($bloqueio != 'SIM'){
		$status_bloqueio = '<h3><span class="badge" style="background-color:#009900; color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Veículo Desbloqueado"><i class="fas fa-lock-open"></i></span></h3>';
		$cor_block = '#009900';
		$icon_block = '';
		$nome_block = 'Desbloqueado';
	}
	
	if($veic_bateria_interna == ''){
		$veic_bateria_interna1 = '100';
	}
	if($veic_bateria_interna != ''){
		$veic_bateria_interna1 = $veic_bateria_interna;
	}
	
	if($veic_gsm == ''){
		$veic_gsm1 = '1';
	}
	if($veic_gsm != ''){
		$veic_gsm1 = $veic_gsm;
	}
	
	if($veic_volts == ''){
		$veic_volts1 = '12.5';
	}
	if($veic_volts != ''){
		$veic_volts1 = $veic_volts;
	}
	
	if($veic_satelite == ''){
		$veic_satelite1 = '1';
	}
	if($veic_satelite != ''){
		$veic_satelite1 = $veic_satelite;
	}
	//========= DADOS VEICULO ============
	
	//========= DADOS km dia ============
	$sql = mysqli_query($con, "SELECT * FROM tc_positions WHERE id='$positionid'");
	if(mysqli_num_rows($sql) > 0){
	while ($resp_sql = mysqli_fetch_assoc($sql)) {
		$km_1 = $resp_sql['attributes'];
		$obj_km1 = json_decode($km_1);
		$km_1 = $obj_km1->{'totalDistance'};;
	}}
	
	$sql1 = mysqli_query($con, "SELECT * FROM tc_positions WHERE id='$pos_inicial'");
	if(mysqli_num_rows($sql1) <= 0){
		$km_2 = 0;
	}
	if(mysqli_num_rows($sql1) > 0){
	while ($resp_sql1 = mysqli_fetch_assoc($sql1)) {
		$km_2 = $resp_sql1['attributes'];
		$obj_km2 = json_decode($km_2);
		$km_2 = $obj_km2->{'totalDistance'};;
	}}
	
	$totalkm = $km_1 - $km_2;
	$totalkm = $totalkm / 1000;
	$totalkm = round($totalkm, 2);
	$totalkm = number_format($totalkm, 2, ",", ".");
	//========= DADOS km dia ============
	
	$cons_cli = mysqli_query($con,"SELECT * FROM clientes WHERE id_cliente='$id_cliente' ");
		if(mysqli_num_rows($cons_cli) > 0){
	while ($resp_cli = mysqli_fetch_assoc($cons_cli)) {
	$nome_cliente = 	$resp_cli['nome_cliente'];
		}}
		
		
?>
		<!--
			<div class="mb-0 card card-full-center card-style">
				<button class="btn accordion-btn no-effect color-theme"  data-bs-toggle="collapse" data-bs-target="#dev<?php echo $deviceid?>">
					<div class='alert alert-<?php echo $cor_ign2?>' role='alert'>
						<div class="d-flex rounded-m">
							<div class="me-3">
								<img width="50" class="fluid-img rounded-m shadow-xl" src="../imagens/veiculos/<?php echo $modelo_img?>">
							</div>
							
							<div>
								<h5><?php echo $placa?></h5>
								<h5><?php echo $marca_veiculo?> / <?php echo $modelo_veiculo?></h5>
							</div>
							
						</div>
						
					</div>
					<div class="row pt-1 pb-2 ps-3 pe-1">
							<div class="col-12">
								<i class="fas fa-user fa-2x"></i> <span style="font-size:12px"><?php echo $nome_cliente?></span>
							</div><br><br>
							<a href="grid_device.php?deviceid=<?php echo $deviceid?>&id=<?php echo $id_push?>">
							<div class="col-12">
								<i class="fas fa-map-marker-alt fa-2x"></i> <span style="font-size:12px"><?php echo $address?></span>
							</div>
							</a>
							
						</div>
				</button>
				<div id="dev<?php echo $deviceid?>" class="collapse"  data-parent="#accordion-1">
					
						
						
					 <div class="row text-center pt-1 pb-2 ps-3 pe-1">
						<div class="col-3 align-items-center">
							<span class="text-center">
								<a href="#" class="btn btn-xxs rounded-s font-900 shadow-s bg-<?php echo $cor_ign2?>" style="width:50%"><i class="fas fa-key"></i></a><br>
								<span style="font-size:11px"><b>Ignicao</b><br><?php echo $ign?></span>
							</span>
						</div>
						<div class="col-3 align-items-center">
							<span class="text-center">
								<a href="#" class="btn btn-xxs rounded-s font-900 shadow-s bg-dark" style="width:50%"><i class="fas fa-tachometer-alt"></i></a><br>
								<text style="font-size:11px"><b>Velocidade</b><br><?php echo $apeed1?> Km/h</text>
							</span>
						</div>
						<div class="col-3 align-items-center">
							<span class="text-center">
								<a href="#" class="btn btn-xxs rounded-s font-900 shadow-s bg-success" style="width:50%"><i class="fas fa-lock-open"></i></a><br>
								<span style="font-size:11px"><b>Bloqueio</b><br><?php echo $nome_block; ?></span>
							</span>
						</div>
						<div class="col-3 align-items-center">
							<span class="text-center">
								<a href="#" class="btn btn-xxs rounded-s font-900 shadow-s bg-dark" style="width:50%"><i class="fas fa-road"></i></a><br>
								<span style="font-size:11px"><b>Km dia</b><br><?php echo $totalkm; ?> km</span>
							</span>
						</div>
						
					</div>
					 <div class="row text-center pt-1 pb-2 ps-3 pe-1">
						<div class="col-3 align-items-center">
							<span class="text-center">
								<a href="#" class="btn btn-xxs rounded-s font-900 shadow-s bg-<?php echo $cor_status?>" style="width:50%"><i class="fas fa-wifi"></i></a><br>
								<span style="font-size:11px"><b>Status</b><br><?php echo $status_conexao?></span>
							</span>
						</div>
						<div class="col-3 align-items-center">
							<span class="text-center">
								<a href="#" class="btn btn-xxs rounded-s font-900 shadow-s bg-blue-dark" style="width:50%"><i class="fas fa-satellite"></i></a><br>
								<span style="font-size:11px"><b>Satelites</b><br><?php echo $veic_satelite1?> Sat.</span>
							</span>
						</div>
						<div class="col-3 align-items-center">
							<span class="text-center">
								<a href="#" class="btn btn-xxs rounded-s font-900 shadow-s bg-blue-dark" style="width:50%"><i class="fas fa-signal"></i></a><br>
								<span style="font-size:11px"><b>Nivel GSM</b><br><?php echo $veic_gsm1?>%</span>
							</span>
						</div>
						<div class="col-3 align-items-center">
							<span class="text-center">
								<a href="#" class="btn btn-xxs rounded-s font-900 shadow-s bg-blue-dark" style="width:50%"><i class="fas fa-car-battery"></i></a><br>
								<span style="font-size:11px"><b>Voltagem</b><br><?php echo $veic_volts1?> v</span>
							</span>
						</div>
					</div>
				</div>
			</div>
			<BR>
			-->
			
			
			
			
			<div class="accordion mt-4" id="accordion-<?php echo $deviceid?>">
				<div class="card card-style shadow-0 mt-1 mb-0">
					<button class="btn accordion-btn border-0" data-toggle="collapse" data-target="#collapse<?php echo $deviceid?>">
						<div class='alert alert-<?php echo $cor_ign2?>' role='alert'>
							<div class="d-flex rounded-m">
								<div class="me-3 align-items-center" style="width:15%">
									<span class="text-center">
									<?php echo $conect?><br><br><br>
									<?php echo $status_conexao?><br>
									</span>
								</div>
								<div>
									<h5><?php echo $placa?></h5>
									<h5><?php echo $marca_veiculo?> / <?php echo $modelo_veiculo?></h5>
									<h6><i class="fas fa-user"></i> <?php echo $nome_cliente?></h6>

								</div>
								
							</div>
							
						</div>
					</button>

					<div id="collapse<?php echo $deviceid?>" class="collapse bg-theme" data-parent="#accordion-<?php echo $deviceid?>">
						
						<div class="row text-center pt-1 pb-2 ps-3 pe-1">
							<div class="col-12">
								<a href="#" class="chip chip-large bg-gray1-dark">
									<i class="fas fa-map-marker-alt bg-green1-dark"></i>
									<strong class="color-black font-400"><?php echo $address?></strong>
								</a>
							</div>
							<div class="col-6 align-items-center">
								<a href="#" class="chip chip-large bg-gray1-dark">
									<i class="fas fa-key bg-<?php echo $cor_ign2?>"></i>
									<strong class="color-black font-400"><?php echo $ign?></strong>
								</a>
							</div>
							<div class="col-6 align-items-center">
								<a href="#" class="chip chip-large bg-gray1-dark">
									<i class="fas fa-tachometer-alt bg-dark"></i>
									<strong class="color-black font-400"><?php echo $apeed1?> Km/h</strong>
								</a>
							</div>
							
						</div>
						<div class="row text-center pt-1 pb-2 ps-3 pe-1">
							<div class="col-4 align-items-center">
								<a href="#" class="chip chip-large bg-gray1-dark">
									<i class="fas fa-lock-open bg-dark"></i>
									<strong class="color-black font-200">Desbloq.</strong>
								</a>
							</div>
						</div>
						<div class="row text-center pt-1 pb-2 ps-3 pe-1">
							<div class="col-3 align-items-center">
								<span class="text-center">
									<a href="#" class="btn btn-xxs rounded-s font-900 shadow-s bg-<?php echo $cor_status?> color-white" style="width:50%"><i class="fas fa-wifi"></i></a><br>
									<span style="font-size:11px"><b><?php echo $status_conexao?></b></span>
								</span>
							</div>
							<div class="col-3 align-items-center">
								<span class="text-center">
									<a href="#" class="btn btn-xxs rounded-s font-900 shadow-s bg-dark color-white" style="width:50%"><i class="fas fa-satellite"></i></a><br>
									<span style="font-size:11px"><b><?php echo $veic_satelite1?> Sat.</b></span>
								</span>
							</div>
							<div class="col-3 align-items-center">
								<span class="text-center">
									<a href="#" class="btn btn-xxs rounded-s font-900 shadow-s bg-dark color-white" style="width:50%"><i class="fas fa-signal"></i></a><br>
									<span style="font-size:11px"><b><?php echo $veic_gsm1?>%</b></span>
								</span>
							</div>
							<div class="col-3 align-items-center">
								<span class="text-center">
									<a href="#" class="btn btn-xxs rounded-s font-900 shadow-s bg-dark color-white" style="width:50%"><i class="fas fa-car-battery"></i></a><br>
									<span style="font-size:11px"><b><?php echo $veic_volts1?> v</b></span>
								</span>
							</div>
						</div>
						<div class="row text-center pt-1 pb-2 ps-3 pe-1">
							<div class="col-6 align-items-center">
								 <a href="#" class="chip chip-large bg-gray1-dark">
									<i class="fas fa-satellite bg-green1-dark"></i>
									<strong class="color-black font-size-10"><?php echo $devicetime11?></strong>
								</a>
							</div>
							<div class="col-6 align-items-center">
								 <a href="#" class="chip chip-large bg-gray1-dark">
									<i class="far fa-clock bg-green1-dark"></i>
									<strong class="color-black font-400"><?php echo $lastupdate_data?></strong>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
<?php
		}
	}else{
		//caso não haja mais registros retornados
		echo "Final de arquivo...";
	}
?>
