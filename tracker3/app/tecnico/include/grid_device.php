

 <?php

$servidor = "localhost";
$usuario = "root";
$senha = "M196619m210300";
$dbname = "traccar";

//Criar a conexao
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
$con = mysqli_connect($servidor, $usuario, $senha, $dbname);

		$id_device = $_GET['id_device'];			
			$result_usuario = "SELECT * FROM tc_devices WHERE id='$id_device' ORDER BY positionid DESC";
					$resultado_usuario = mysqli_query($conn, $result_usuario);


					//Verificar se encontrou resultado na tabela "usuarios"
					if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
					?>

				  <?php
			while($row_usuario = mysqli_fetch_assoc($resultado_usuario)){
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
				
				if($address == ''){
					$cons_cliente1 = mysqli_query($conn,"SELECT * FROM tc_positions WHERE deviceid='$id_device' AND address != '' ORDER BY id DESC LIMIT 1");
					if(mysqli_num_rows($cons_cliente1) > 0){
				while ($resp_cliente1 = mysqli_fetch_assoc($cons_cliente1)) {
				$endereco = $resp_cliente1['address'];
					}}
				}
				if($address != ''){
				$endereco =  $address;
				}
				
				date_default_timezone_set('America/Sao_Paulo');
				$objDate = DateTime::createFromFormat('Y-m-d H:i:s', $devicetime);
				$date_dev = $objDate->format('Y-m-d');
				$date_dev = date('Y-m-d', time());
				$time_dev = $objDate->format('H:i:s');
				$time_dev = date('H:i:s', strtotime('-3 hour', strtotime($time_dev)));
				$devicetime = ''.$date_dev.' '.$time_dev.'';
				$devicetime = date('d/m/Y H:i', strtotime("$devicetime"));
				
				$hora =  date('H:i:s');
				
				$inicio = DateTime::createFromFormat('H:i:s', $time_dev);
				$fim = DateTime::createFromFormat('H:i:s', $hora);
				$intervalo = $inicio->diff($fim);
				$inter = $intervalo->format('%H:%I:%S');
				
				$address1 = explode(',', $endereco);
					$result = count($address1);
					
					$bairro_n = $result -5;
					$bairro = $address1[$bairro_n];
					$estado_n = $result -2;
					$uf = $address1[$estado_n];
					$rua = $address1[0];
					$cidade_n = $result -4;
					$cidade = $address1[$cidade_n];

					if($bairro == $rua){
						$bairro1 = '';
					} else {
						$bairro1 = $bairro;
					}
					
					

					
					$address_db = ''.$rua.' <br> '.$bairro1.' - '.$cidade.' / '.$uf.'';
					$address_db = str_replace('Corredor de Transporte Coletivo', 'Av.', $address_db);
				
				
				$address = utf8_encode($address_db);
				$speed = 	$resp_cliente['speed'];
				
				
				
								
				
				
				
				$speed = $speed * 1.609;
				$speed = round($speed, 2);
				$attributes = $resp_cliente['attributes'];
				$obj = json_decode($attributes);
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
				
				$block = '<button type="button" id="button" class="btn btn-success" style="font-size:13px; top:0; width:auto;"><i class="fas fa-lock-open" title="Desbloqueado"></i></button>';
				
				
				
				if($status_conexao == 'deviceOffline'){
					$conect = '<button type="button"  class="btn btn-danger" style="font-size:13px; top:0; width:auto;" title="Desconetado a '.$inter.'"><i class="fas fa-wifi" title="Desconetado a '.$inter.'"></i></button>';
				} else {
					$conect = '<button type="button" class="btn btn-success" style="font-size:13px; top:0; width:auto;" title="Conectado"><i class="fas fa-wifi" title="Conectado"></i></button>';
				}
				
				if($ignicao == 'true' && $speed >= 6){
					$ign = '<span style="color:Green;"><i class="fas fa-key fa-2x"></i></span>';
					$apeed1 = '<i class="fas fa-tachometer-alt"></i> <b>'.$speed.' km/h';
					$cor = 'green';
				} else if ($ignicao == 'true' && $speed <= 5){
					$ign = '<span style="color:Orange;"><i class="fas fa-key fa-2x"></i></span>';
					$apeed1 = '<i class="fas fa-tachometer-alt"></i> <b>'.$speed.' km/h';		
					$cor = 'orange';
				} else {
					$ign = '<span style="color:Black;"><i class="fas fa-key fa-2x"></i></span>';
					$apeed1 = '<i class="fas fa-tachometer-alt"></i> <b>0 km/h';	
					$cor = 'black';				
				}
				
				$cons_veiculo = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE deviceid='$id_device' ");
					if(mysqli_num_rows($cons_veiculo) > 0){
				while ($resp_veiculo = mysqli_fetch_assoc($cons_veiculo)) {
				$placa = 	$resp_veiculo['placa'];
				$bloqueio = 	$resp_veiculo['bloqueio'];
				$ancora = 	$resp_veiculo['ancora'];
				$marca = 	$resp_veiculo['marca_veiculo'];
				$modelo = 	$resp_veiculo['modelo'];
				
				if($bloqueio == 'SIM'){
					$block = '<button type="button" class="btn btn-danger" style="font-size:13px; top:0; width:auto;" title="BLOQUEADO"><i class="fas fa-lock" title="BLOQUEADO"></i></button>';
					$block2 = '<i class="fa fa-lock-open"></i> Desbloquear';
				} else if($bloqueio == 'NAO'){
					$block = '<button type="button" class="btn btn-success" style="font-size:13px; top:0; width:auto;" title="Desbloqueado"><i class="fas fa-lock-open" title="Desbloqueado"></i></button>';
					$block2 = '<i class="fa fa-lock"></i> Bloquear';
					$block3 = 'desbloqueado';
					$block4 = 'DESBLOQUEIO';
				} else if($bloqueio == ''){
					$block = '<button type="button" class="btn btn-success"  style="font-size:13px; top:0; width:auto;" title="Desbloqueado"><i class="fas fa-lock-open" title="Desbloqueado"></i></button>';
					$block2 = '<i class="fa fa-lock"></i> Bloquear';
					$block3 = 'bloqueado';
					$block4 = 'BLOQUEIO';
				}
				if($ancora == 'ON'){
					$anchor = '<button type="button" class="btn btn-success" style="font-size:13px; top:0; width:auto;" title="Ancora Ativada"><i class="fas fa-anchor" title="Ancora Ativada"></i></button>';
				} else {
					$anchor = '<button type="button" class="btn btn-dark" style="font-size:13px; top:0; width:auto;" title="Ancora Desativada"><i class="fas fa-anchor" title="Ancora Desativada"></i></button>';
				}
				
				?>				
					
				
				 <div class="accordion" id="accordionExample">
				 <div class="card">
					<div class="card-header" id="headingOne">
						<a href="javascript:void(0);" class="card-title" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
							Collapsible Group Item #1
							<span class="ml-auto">
								<span class="collapsed-reveal">
									<i class="fal fa-minus-circle text-danger"></i>
								</span>
								<span class="collapsed-hidden">
									<i class="fal fa-plus-circle text-success"></i>
								</span>
							</span>
						</a>
					</div>
					<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
						<div class="card-body">
							Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
						</div>
					</div>
				</div>
				</div>
							
				<?php
					}}}}}}}}?>

