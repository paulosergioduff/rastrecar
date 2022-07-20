

 <?php

$servidor = "localhost";
$usuario = "root";
$senha = "TR4vcijU6T9Keaw";
$dbname = "traccar";

//Criar a conexao
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
$con = mysqli_connect($servidor, $usuario, $senha, $dbname);

$data_agora = date('Y-m-d H:i:s');
$data_agora = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_agora)));
$data_agora1 = date('Y-m-d H:i:s', strtotime('-5 minutes', strtotime($data_agora)));


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
				$lastupdate = 	$row_usuario['lastupdate'];
				$lastupdate1 = date('d/m/Y H:i', strtotime('-3 hour', strtotime($lastupdate)));
				
				if($lastupdate < $data_agora1){
					$conect = 'Offline';
					$status_conexao = 'off';
					$cor_conexao = '#CD5C5C';
				} else {
					$conect = 'Online';
					$status_conexao = 'on';
					$cor_conexao = '#009900';
				}
				
				
				$cons_cliente = mysqli_query($conn,"SELECT * FROM tc_positions WHERE id='$positionid' ORDER BY id DESC");
					if(mysqli_num_rows($cons_cliente) > 0){
				while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
				$address = 	$resp_cliente['address'];
				$devicetime = 	$resp_cliente['devicetime'];
				$fixtime = 	$resp_cliente['fixtime'];
				$fixtime = date('d/m/Y H:i', strtotime('-3 hour', strtotime($fixtime)));
				
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
				
				$attributes = $resp_cliente['attributes'];
				$protocol = $resp_cliente['protocol'];
				$obj = json_decode($attributes);
				$ignicao = $obj->{'ignition'};

				
				
					}}
					
				$deviceid = $id_device;
			
				
			
				
				
			
				
				?>				
					
				
				<div class="col-12 d-flex flex-row align-items-center">
					<div class="p-1 mr-1">
					   <i class="fas fa-map-marker-alt fa-2x"></i>
					</div>
					<div>
						<label class="fs-sm mb-0"><?php echo $address?></label>
					</div>
				</div>
				<div class="col-12 d-flex flex-row align-items-center">
					<div class="col-6 align-items-center">
						<div>
							<i class="fas fa-satellite"></i> <label class="fs-sm mb-0"><?php echo $fixtime?></label>
						</div>
					</div>
					<div class="col-6 align-items-center">
						<div>
							<i class="fas fa-clock"></i> <label class="fs-sm mb-0"><?php echo $lastupdate1?></label>
						</div>
					</div>
				</div>
							
				<?php
					}}?>

