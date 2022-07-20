  <?php
//header("Content-Type: text/html;  charset=ISO-8859-1",true);


$servidor = "localhost";
$usuario = "root";
$senha = "TR4vcijU6T9Keaw";
$dbname = "traccar";

//Criar a conexao
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
$con = mysqli_connect($servidor, $usuario, $senha, $dbname);

$cons_nivel = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='1361'");
	if(mysqli_num_rows($cons_nivel) > 0){
		while ($resp_nivel = mysqli_fetch_assoc($cons_nivel)) {
			$login_traccar = 	$resp_nivel['login_traccar'];
			$senha_traccar = 	$resp_nivel['senha_traccar'];
			$token_traccar = ''.$login_traccar.':'.$senha_traccar.'';
			$token_traccar = base64_encode($token_traccar);
}}

$date = date('Y-m-d H:i:s');
$data_fim2  =  date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($date)));

$deviceid = $_REQUEST['deviceid'];
$data_ini = $_REQUEST['data_inicial'];
$agrupar = 'SIM';

$delete = mysqli_query($conn, "DELETE FROM mapa_posicoes WHERE deviceid='$deviceid'");

if($data_ini == '2'){
	$data_inic1  =  date('Y-m-d H:i:s', strtotime('-2 hour', strtotime($date)));
	$data_inic  =  date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_inic1)));
	$tempo_p  = 'Últimas 2 horas';
}
if($data_ini == '4'){
	$data_inic1  =  date('Y-m-d H:i:s', strtotime('-4 hour', strtotime($date)));
	$data_inic  =  date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_inic1)));
	$tempo_p  = 'Últimas 4 horas';
}
if($data_ini == '8'){
	$data_inic1  =  date('Y-m-d H:i:s', strtotime('-8 hour', strtotime($date)));
	$data_inic  =  date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_inic1)));
	$tempo_p  = 'Últimas 8 horas';
}
if($data_ini == '12'){
	$data_inic1  =  date('Y-m-d H:i:s', strtotime('-12 hour', strtotime($date)));
	$data_inic  =  date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_inic1)));
	$tempo_p  = 'Últimas 12 horas';
}
if($data_ini == '24'){
	$data_inic1  =  date('Y-m-d H:i:s', strtotime('-24 hour', strtotime($date)));
	$data_inic  =  date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_inic1)));
	$tempo_p  = 'Últimas 24 horas';
}
if($data_ini == '48'){
	$data_inic1  =  date('Y-m-d H:i:s', strtotime('-48 hour', strtotime($date)));
	$data_inic  =  date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_inic1)));
	$tempo_p  = 'Últimas 48 horas';
}


$data_ini1 = explode(" ", $data_inic);
$data1 = $data_ini1[0];
$hora1 = $data_ini1[1];
$data_inicial = $data1.'T'.$hora1.'Z';

$data_fim1 = explode(" ", $data_fim2);
$data2 = $data_fim1[0];
$hora2 = $data_fim1[1];
$data_final = $data2.'T'.$hora2.'Z';

$data_inicial_1 = date('Y-m-d H:i:s', strtotime($data_inic1));
$data_final_1 = $date;

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://5.189.185.179:8082/api/reports/route?from='.$data_inicial.'&to='.$data_final.'&deviceId='.$deviceid.'',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',

  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Authorization: Basic '.$token_traccar.''
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;


$json = json_decode($response);
 

// Loop para percorrer o Objeto
foreach($json as $registro):
    $positionid = $registro->id;
    $endereco = $registro->address;
    $longitude = $registro->longitude;
    $latitude = $registro->latitude;
    $total_km = $registro->totalDistance;
    $devicetime = $registro->deviceTime;
	$devicetime1  =  date('Y-m-d H:i:s',strtotime($devicetime));
	$devicetime  =  date('d/m/Y H:i:s',strtotime($devicetime1));
    $speed = $registro->speed;
    $speed = $speed * 1.609;
	$veloc = round($speed);
	
	if($endereco == ''){
		continue;
	}
	
	$attr = $registro->attributes;
	$json1 = json_encode($attr);
	$json1 = json_decode($json1);
	$ignicao = $json1->{'ignition'};
	if (is_bool($ignicao)) $ignicao ? $ignicao = "ligada" : $ignicao = "desligada";
	else if ($ignicao !== null) $ignicao = (string)$ignicao;
		
		$ign2 = $ignicao;
		if($ign2 == 'desligada'){

			$velocidade = '0.00';
			$ign3 = '<span style="color:#990000"><i class="fas fa-stop-circle"></i><b>  '.$ign2.'</b></span>';
		}
		
		$str_ign = 'Desligado';
		if($ign2 == 'ligada'){
			$str_ign = 'Ligada';
			$data_pos = $horario_br;
			$velocidade = $veloc;
			$ign3 = '<span style="color:#228B22"><b><i class="fas fa-key"></i> '.$ign2.'</b></span>';
		};
		if($agrupar == 'SIM'){
			if($last_ign == 'Desligado' && $str_ign == 'Desligado'){
				continue;
			};
		};
		$last_ign = $str_ign;

	$sql_up = mysqli_query($conn,"INSERT IGNORE INTO mapa_posicoes (positionid, devicetime, ignicao, endereco, speed, latitude, longitude, deviceid, total_km) VALUES ('$positionid', '$devicetime1', '$ignicao', '$endereco', '$speed', '$latitude', '$longitude', '$deviceid', '$total_km')");

		
		echo '<div class="card card-style">
				<div class="content">
					<p class="mb-0 font-600 color-highlight"><i class="fas fa-clock"></i>'.$devicetime.'</p>
					<h5><i class="fas fa-map-marker-alt"></i> '.$endereco.'</h5>
					<i class="fas fa-tachometer-alt"></i> '.$veloc.' km/h<br>
					'.$ign3.'
				</div>
			</div>';
			
			
endforeach;



#================================


		


							

										
														
									?>
													


