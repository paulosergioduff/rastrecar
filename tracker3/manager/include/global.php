
<?php
$servidor = "localhost";
$usuario = "root";
$senha = "TR4vcijU6T9Keaw";
$dbname = "traccar";

//Criar a conexao
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
$con = mysqli_connect($servidor, $usuario, $senha, $dbname);
	

$data_now = date('Y-m-d H:i:s');
$data_now = date('Y-m-d H:i:s', strtotime('-60 days', strtotime($data_now)));

$off = '{"alarm":"powerOff"}';
$on = '{"alarm":"powerOn"}';

$del = mysqli_query($conn, "DELETE FROM tc_events WHERE attributes='$off'");
$del1 = mysqli_query($conn, "DELETE FROM tc_events WHERE attributes='$on'");
$del4 = mysqli_query($conn, "DELETE FROM tc_events WHERE servertime <= '$data_now'");
$del5 = mysqli_query($conn, "DELETE FROM tc_positions WHERE servertime <= '$data_now'");
$del5 = mysqli_query($conn, "DELETE FROM usuarios_push WHERE id_push = '-1' OR id_push = '0' OR id_push = 'null'");


	
#================== VOLTS CRX =======================
/*
$cons_veiculo = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE deviceid > '1' AND (modelo_equip='CRX3-MINI' OR modelo_equip='CRX3')");
	if(mysqli_num_rows($cons_veiculo) > 0){
		while ($resp_veiculo = mysqli_fetch_assoc($cons_veiculo)) {
		$deviceid = 	$resp_veiculo['deviceid'];
		$imei = 	$resp_veiculo['imei'];
		




//$imei = '359857080849581';


$arquivo = fopen ('/opt/traccar/logs/tracker-server.log', 'r');


while(!feof($arquivo)){

	$linha = fgets($arquivo, 1024);
	
	
	if (strpos($linha, 'id: '.$imei) !== false) {
		$registros[] = $linha;	
		}

}

$num = count($registros);

fclose($arquivo);

$ultima_linha =  $registros[$num - 1];

$ultima_linha = explode("[", $ultima_linha);

$retorno_linha = $ultima_linha[1];

$ultima_linha = explode("]", $retorno_linha);

$chave = $ultima_linha[0];

$arquivo1 = fopen ('/opt/traccar/logs/tracker-server.log', 'r');
while(!feof($arquivo1)){

	$linha1 = fgets($arquivo1, 1024);
	
	
	if (strpos($linha1, $chave) !== false) {
		if (strpos($linha1, '79790008') !== false) {
			$protocol = explode("HEX: ", $linha1);
			$protocol2 = $protocol[1];
			
			$volt =  substr($protocol2, 12, -13);
			$volt =  hexdec($volt).'<br>';
			$volts[] = $volt;	
		}
	}

}

$num1 = count($volts);

fclose($arquivo1);

$bateria_ext = $volts[$num1 - 1];
$bateria_ext = $bateria_ext * 1;
$bateria_ext = substr_replace($bateria_ext, '.', -2, 0);


$sql = mysqli_query($conn, "UPDATE veiculos_clientes SET volts='$bateria_ext' WHERE deviceid='$deviceid'");


	}}
*/


#======================== ATUALIZA POSIÇÃO ================================


$cons_cliente33 = mysqli_query($conn, "SELECT * FROM tc_positions ORDER BY id DESC LIMIT 300");
	if(mysqli_num_rows($cons_cliente33) > 0){
		while ($resp_cliente = mysqli_fetch_assoc($cons_cliente33)) {
		$address = 	$resp_cliente['address'];
		$protocol = 	$resp_cliente['protocol'];
		$deviceid = 	$resp_cliente['deviceid'];
		$devicetime = 	$resp_cliente['devicetime'];
		$devicetime = date('Y-m-d H:i:s', strtotime('-3 hour', strtotime($devicetime)));
		$speed = 	$resp_cliente['speed'];
		$speed = $speed * 1.609;
		$speed = round($speed, 2);
		$attributes = $resp_cliente['attributes'];
		$obj = json_decode($attributes);
		$ignicao = $obj->{'ignition'};
		if (is_bool($ignicao)) $ignicao ? $ignicao = "true" : $ignicao = "false";
		else if ($ignicao !== null) $ignicao = (string)$ignicao;
		if($ignicao == 'true'){
			$ignicao1 = 'ligada';
		}
		if($ignicao == 'false'){
			$ignicao1 = 'desligada';
		}
		$sat = $obj->{'sat'};
		$power = $obj->{'power'};
		$power = round($power, 2);
		$adc1 = $obj->{'adc1'};
		$adc1 = round($adc1, 2);
		$batteryLevel = $obj->{'batteryLevel'};
		$battery = $obj->{'battery'};
		$rssi = $obj->{'rssi'};
		if($rssi == 1){
			$gsm = '1';
		}
		if($rssi == 2){
			$gsm = '25';
		}
		if($rssi == 3){
			$gsm = '50';
		}
		if($rssi == 4){
			$gsm = '75';
		}
		if($rssi >= 5){
			$gsm = '100';
		}
		if($rssi == ''){
			$gsm = null;
		}
		if($rssi == null){
			$gsm = null;
		}
		$motion = $obj->{'motion'};
		if (is_bool($motion)) $motion ? $motion = "true" : $motion = "false";
		else if ($motion !== null) $motion = (string)$motion;
		if($motion == 'true'){
			$movimento = 'sim';
		}
		if($motion == 'false'){
			$movimento = 'nao';
		}
		
		$cons_device = mysqli_query($conn, "SELECT * FROM tc_devices WHERE id='$deviceid'");
		if(mysqli_num_rows($cons_device) > 0){
			while ($resp_device = mysqli_fetch_assoc($cons_device)) {
			$uniqueid = 	$resp_device['uniqueid'];
			$lastupdate = 	$resp_device['lastupdate'];
			$lastupdate = date('Y-m-d H:i:s', strtotime('-3 hour', strtotime($lastupdate)));
		}}
		
		$cons_veiculo = mysqli_query($conn, "SELECT * FROM veiculos_clientes WHERE deviceid='$deviceid'");
		if(mysqli_num_rows($cons_veiculo) > 0){
			while ($resp_veiculo = mysqli_fetch_assoc($cons_veiculo)) {
			$modelo_equip = 	$resp_veiculo['modelo_equip'];
			$veic_volts = 	$resp_veiculo['volts'];
			$veic_satelite = 	$resp_veiculo['satelite'];
			$veic_gsm = 	$resp_veiculo['gsm'];
			$veic_bateria_interna = 	$resp_veiculo['bateria_interna'];
		}}
		
		if($protocol == 'gt06'){
			$volts = $battery;
			$bateria_int1 = $batteryLevel;
			if($bateria_int1 >= 200){
				$bateria_int = $power;
			} else {
				$bateria_int = $batteryLevel;
			}
			$satelites = $sat;
		}
		else if($protocol == 'easytrack'){
			$volts = $adc1;
			$bateria_int = $power;
			$satelites = $sat;
		}
		else if($protocol == 'suntech'){
			$volts = $power;
			$bateria_int = '';
			$satelites = $sat;
		}
		else if($protocol == 'gl200'){
			$volts = $power;
			$bateria_int = $batteryLevel;
			$satelites = $sat;
		}
		else {
			$volts = '';
			$bateria_int = '';
			$satelites = '';
		}
		
		if($volts != ''){
			$bateria_externa = $volts;
		}
		if($volts == ''){
			$bateria_externa = $veic_volts;
		}
		
		
		if($bateria_int != ''){
			$bateria_interna = $bateria_int;
		}
		if($bateria_int == ''){
			$bateria_interna = $veic_bateria_interna;
		}
		
		
		if($satelites != ''){
			$satelites1 = $satelites;
		}
		if($satelites == ''){
			$satelites1 = $veic_satelite;
		}
		
		
		if($gsm != ''){
			$gsm1 = $gsm;
		}
		if($gsm == ''){
			$gsm1 = $veic_gsm;
		}
		
		$sql_up = mysqli_query($conn, "UPDATE veiculos_clientes SET volts='$bateria_externa', bateria_interna='$bateria_interna', satelite='$satelites1', gsm='$gsm1' WHERE deviceid='$deviceid'");
		
		echo $deviceid.'<br>';
	
	}}
	
#=============================================
#----- DELETE ANCORA ----------

$data_ancora = date('Y-m-d H:i:s');
$data_ancora = date('Y-m-d H:i:s', strtotime('+185 minutes', strtotime($data_ancora)));

$cons_nivel = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='1'");
	if(mysqli_num_rows($cons_nivel) > 0){
		while ($resp_nivel = mysqli_fetch_assoc($cons_nivel)) {
$login_traccar = 	$resp_nivel['login_traccar'];
$senha_traccar = 	$resp_nivel['senha_traccar'];
$token_traccar = ''.$login_traccar.':'.$senha_traccar.'';
$token_traccar = base64_encode($token_traccar);
}}


$cons_eventos = mysqli_query($conn,"SELECT * FROM tc_events WHERE type='geofenceExit' AND servertime < '$data_ancora' ORDER BY id DESC LIMIT 5");
if(mysqli_num_rows($cons_eventos) > 0){
	while ($row_ev = mysqli_fetch_assoc($cons_eventos)) {
		$deviceid = $row_ev['deviceid'];
		$horario_alarme = $row_ev['eventtime'];
		$eventos = $row_ev['attributes'];
		$eventos1 = json_decode($eventos);
		$alarme = $eventos1->{'alarm'};
		$speed = $eventos1->{'speed'};
		$speed = $speed * 1.609;
		$speed = round($speed, 2);
		$type = $row_ev{'type'};
		$geofenceid = $row_ev['geofenceid'];
		$id_unico = $row_ev['id'];

			$cons_fence = mysqli_query($conn,"SELECT * FROM tc_geofences WHERE id='$geofenceid'");
					if(mysqli_num_rows($cons_fence) > 0){
				while ($row_fence = mysqli_fetch_assoc($cons_fence)) {
					$name_cerca = $row_fence['name'];
					$description = $row_fence['description'];
					
					
						if($name_cerca == 'ANCORA'){
							$update = mysqli_query($conn, "UPDATE veiculos_clientes SET ancora='OFF', geofenceid=' ' WHERE deviceid='$deviceid'");
					
					$url = 'http://5.189.185.179:8082/api/geofences/'.$geofenceid.'';

					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE"); 
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
					curl_setopt($ch, CURLOPT_HTTPHEADER, array(
						'Content-Type: application/json',
						'Authorization: Basic '.$token_traccar.''
					));

					$output = curl_exec($ch);
					$response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
						}
					}}


}}
#====================================================
/*
$hora_sessao = date('H:i');

if($hora_sessao == '06:00' && $hora_sessao == '10:00' && $hora_sessao == '14:00' && $hora_sessao == '18:00' && $hora_sessao == '00:00' && $hora_sessao == '03:00'){

	$url = 'http://207.244.226.150:3333/start?sessionName=mb';
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_HEADER, FALSE);
	$output = curl_exec($ch);
	$response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	if ($response_code == '404') {
			echo 'Página não existente';
	} else {
			echo $output;
	}
}
*/
#===========================================

#---- POSIÇÃO INICIAL DO DIA ------
	
$hora_pos = date('H:i');
	
if($hora_pos >= '00:01' && $hora_pos <= '00:02'){
	
	$sql_dev = mysqli_query($conn, "SELECT * FROM tc_devices ");
	if(mysqli_num_rows($sql_dev) > 0){
while ($resp_sql_dev = mysqli_fetch_assoc($sql_dev)) {
		$deviceid3 = $resp_sql_dev['id'];
		$positionid = $resp_sql_dev['positionid'];
		$name = $resp_sql_dev['name'];
		

		$insere_pos = mysqli_query($conn, "UPDATE IGNORE veiculos_clientes SET pos_inicial = '$positionid' WHERE deviceid = '$deviceid3'");
	}}
}
#---- FIM POSIÇÃO INICIAL DO DIA ------

#================= RELATORIO CONEXOES =================


$data_agora = date('Y-m-d H:i:s');
$data_agora = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_agora)));

$data_inicial_12 = date('Y-m-d H:i:s', strtotime('-5 minutes', strtotime($data_agora)));

$id_unico = date('YmdHi');
$hora_rel = date('H:i');
$minuto_rel = date('i');
$data_rel = date('Y-m-d');

$cont_veiculos_off = mysqli_query($conn,"SELECT * FROM tc_devices WHERE lastupdate < '$data_inicial_12' AND contact != 'ESTOQUE'");
$total_off = mysqli_num_rows($cont_veiculos_off);
	
	
$cont_veiculos_on = mysqli_query($conn,"SELECT * FROM tc_devices WHERE lastupdate >= '$data_inicial_12' AND contact != 'ESTOQUE'");
$total_on = mysqli_num_rows($cont_veiculos_on);

if($minuto_rel == '00' or $minuto_rel == '10' or $minuto_rel == '20' or $minuto_rel == '30' or $minuto_rel == '40' or $minuto_rel == '50'){
	$sql_conex = mysqli_query($conn,"INSERT IGNORE INTO relatorio_conexoes (id_unico, data, hora, offline, online) VALUES ('$id_unico', '$data_rel', '$hora_rel', '$total_off', '$total_on')");
}

if($minuto_rel == '05' or $minuto_rel == '15' or $minuto_rel == '25' or $minuto_rel == '35' or $minuto_rel == '45' or $minuto_rel == '55'){
	$sql_conex = mysqli_query($conn,"INSERT IGNORE INTO relatorio_conexoes (id_unico, data, hora, offline, online) VALUES ('$id_unico', '$data_rel', '$hora_rel', '$total_off', '$total_on')");
}


$data_delete = date('Y-m-d');
$data_delete1 = date('Y-m-d', strtotime('-1 day', strtotime($data_delete)));

$sql_del = mysqli_query($conn, "DELETE FROM relatorio_conexoes WHERE data<='$data_delete1'");


#========================================
	
	?>