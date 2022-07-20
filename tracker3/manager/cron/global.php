<?php
date_default_timezone_set('America/Sao_Paulo');
include_once("conexao.php");

$data_hoje = date('Y-m-d H:i');
$hora_agora = date('H:i');

$cons_nivel = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='1361'");
	if(mysqli_num_rows($cons_nivel) > 0){
while ($resp_nivel = mysqli_fetch_assoc($cons_nivel)) {
$login_traccar = 	$resp_nivel['login_traccar'];
$senha_traccar = 	$resp_nivel['senha_traccar'];
$token_traccar = ''.$login_traccar.':'.$senha_traccar.'';
$token_traccar = base64_encode($token_traccar);
$asaas_key = 	$resp_nivel['asaas_key'];
}}

$data_agora = date('Y-m-d H:i:s');
$data_agora = date('Y-m-d H:i:s', strtotime('-90 days', strtotime($data_agora)));

#------ DELETE EVENTS IGN ------------
$off = '{"alarm":"powerOff"}';
$on = '{"alarm":"powerOn"}';

//$del = mysqli_query($conn, "DELETE FROM tc_events WHERE attributes='$off'");
//$del1 = mysqli_query($conn, "DELETE FROM tc_events WHERE attributes='$on'");
//$del4 = mysqli_query($conn, "DELETE FROM tc_events WHERE servertime <= '$data_agora'");
$del5 = mysqli_query($conn, "DELETE FROM tc_positions WHERE servertime <= '$data_agora'");
$del5 = mysqli_query($conn, "DELETE FROM usuarios_push WHERE id_push = '-1' OR id_push = '0'");




#----------- POSICAO INICIAL -------------------

if($hora_agora >= '00:01' && $hora_agora <= '00:02'){
	
	$sql_dev = mysqli_query($conn, "SELECT * FROM tc_devices WHERE contact != 'ESTOQUE' AND positionid > '1' ORDER BY id DESC");
	if(mysqli_num_rows($sql_dev) > 0){
while ($resp_sql_dev = mysqli_fetch_assoc($sql_dev)) {
		$deviceid3 = $resp_sql_dev['id'];
		$positionid = $resp_sql_dev['positionid'];
		$name = $resp_sql_dev['name'];
		

		$insere_pos = mysqli_query($conn, "UPDATE IGNORE veiculos_clientes SET pos_inicial = '$positionid' WHERE deviceid = '$deviceid3'");
	}}
} 




#----- DELETE ANCORA ----------
$cons_eventos = mysqli_query($conn,"SELECT * FROM tc_events WHERE type='geofenceExit' ORDER BY id DESC LIMIT 5");
if(mysqli_num_rows($cons_eventos) > 0){
	while ($row_ev = mysqli_fetch_assoc($cons_eventos)) {
		$deviceid = $row_ev['deviceid'];
		$horario_alarme = $row_ev['servertime'];
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
					
					$url = 'http://144.91.86.255:8082/api/geofences/'.$geofenceid.'';

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

#------------------------------------------------------------


#-------- MENSAGEM DE ANIVERSARIO -----------------------


if($hora_agora >= '08:00' && $hora_agora <= '08:10'){
	
	$dia = date("d");
$mes11 = date("n");
	

	$style = 'ANIVERSARIO';
	
	$sql_cliente = mysqli_query($conn, "SELECT * FROM clientes WHERE MONTH(data_nascimento) = '$mes11' AND DAY(data_nascimento) = '$dia' AND status = '1' ");
	if(mysqli_num_rows($sql_cliente) > 0){
while ($resp_sql_cliente= mysqli_fetch_assoc($sql_cliente)) {
		$telefone_celular = 	$resp_sql_cliente['telefone_celular'];
		$telefone_celular = preg_replace("/[^0-9]/", "", $telefone_celular);
		$nome_cliente = 	$resp_sql_cliente['nome_cliente'];
		$id_cliente = 	$resp_sql_cliente['id_cliente'];
		$doc_cliente = 	$resp_sql_cliente['doc_cliente'];
		$usuario = preg_replace("/[^0-9]/", "", $doc_cliente);
		$id_unico1 = date('dmY');
		$id_unico_aniver = ''.$id_cliente.'-'.$id_unico1.'';
		
		$alerta = 'Que o seu dia seja carregado de muita felicidade e alegria, e que a sua vida o guie para muitos outros sucessos e novas conquistas. Nossa parceria foi construída de forma muito positiva. É de coração que a JC Rastreamento te deseja um feliz aniversário!';
		
		$insere_alerta = mysqli_query($conn, "INSERT IGNORE INTO envios_push (id_unico, alerta, cpf, placa, tipo, data_envio, enviado) VALUES ('$id_unico_aniver', '$alerta', '$usuario', ' ', '$style', '$data_hoje', 'NAO')");
		
		
		
	
	}}
}
# --- FIM PUSH ANIVERSARIO ------






$hora1 = date('H:i');
if($hora1 >= '06:00' && $hora1 <= '07:00'){

#---------- AVISO VENCIMENTO BOLETO 2 DIAS ----------------
$data_venc = date('Y-m-d');
$hora_venc = date('H:i');
$data_venc = date('Y-m-d', strtotime('+2 days', strtotime($data_venc)));

$cons_faturas1 = mysqli_query($conn,"SELECT * FROM contas_receber WHERE data_vencimento = '$data_venc' AND status='Em Aberto'");
		if(mysqli_num_rows($cons_faturas1) > 0){
			while ($row_fat1 = mysqli_fetch_assoc($cons_faturas1)) {
			$nr_banco = $row_fat1['nr_banco'];
			$id_cliente_b = $row_fat1['id_cliente'];
			$id_conta = $row_fat1['id_conta'];
			$url_pdf = $row_fat1['url_pdf'];
			$duplicata2222 = $row_fat1['duplicata'];
			$descricao1 = $row_fat1['descricao'];
			$valor_bruto1 = $row_fat1['valor_bruto'];
			$valor_bruto1 = number_format($valor_bruto1, 2, ",", ".");
			$style_venc = 'AVISO';
			$id_unico122 = date('Ymd');
			$id_unico_av = 'AVI-'.$id_unico122.''.$duplicata2222.'';
			$duplicata1 = explode("_", $nr_banco);
			$dupli = $duplicata1[1];
			
			$sql_vuser1 = mysqli_query($conn, "SELECT * FROM clientes WHERE id_cliente = '$id_cliente_b'");
			if(mysqli_num_rows($sql_vuser1) > 0){
			while ($resp_vuser1 = mysqli_fetch_assoc($sql_vuser1)) {
			$id_cliente = 	$resp_vuser1['id_cliente'];
			$doc_cliente1 = 	$resp_vuser1['doc_cliente'];
			$usuario1 = preg_replace("/[^0-9]/", "", $doc_cliente1);
			$nome_cliente5 = 	$resp_vuser1['nome_cliente'];
			$telefone_celular = 	$resp_vuser1['telefone_celular'];
			$telefone_celular_av = preg_replace("/[^0-9]/", "", $telefone_celular);
			$descricao1111 = str_replace(' ', '_', $nome_cliente5);
			}}
			
			$nome_cliente1 = str_replace(' ', '_', $nome_cliente5);
			$nome_fatura = ''.$dupli.'-'.$nome_cliente1.'';
			
			if($hora_venc >= '08:30' && $hora_venc <= '14:00'){
				
				
				$texto_push122 = '%F0%9F%97%93%EF%B8%8F+AVISO+VENCIMENTO%0A%0APrezado+'.$nome_cliente5.'%2C%0A%0ASua+fatura+no+valor+de+R%24+'.$valor_bruto1.'+vence+em+2+dias.+Acesse+sua+fatura+pelo+link+abaixo.%0A%0A'.$url_pdf.'%0A%0APara+sua+comodidade%2C+voc%C3%AA+pode+fazer+o+pagamentos+desta+fatura+via+PIX.+Basta+fazer+a+transfer%C3%AAncia+utilizando+a+nossa+chave+PIX+27050542000125%0A%0A_%2AMensagem+autom%C3%A1tica+enviada+pelo+sistema.+JC+CAR+Rastreamento%2A_';
				
				$insere_alerta1 = mysqli_query($conn, "INSERT IGNORE INTO envios_whats (id_unico, telefone, mensagem, enviado, id_cliente, data_envio) VALUES ('$id_unico_av', '$telefone_celular_av', '$texto_push122', 'NAO', '$id_cliente_b', '$data_hoje')");
			}
		}}
}
#-------------------- AVISO VENCIMENTO DIA ----------------------

if($hora1 >= '06:00' && $hora1 <= '07:00'){
	
$data_venc1 = date('Y-m-d');

$cons_faturas = mysqli_query($conn,"SELECT * FROM contas_receber WHERE data_vencimento='$data_venc1' AND status='Em Aberto' AND especie='2'");
		if(mysqli_num_rows($cons_faturas) > 0){
			while ($row_fat = mysqli_fetch_assoc($cons_faturas)) {
			$id_conta12 = $row_fat['id_conta'];
			$nr_banco5 = $row_fat['nr_banco'];
			$id_cliente_v = $row_fat['id_cliente'];
			$descricao = $row_fat['descricao'];
			$duplicata_av = $row_fat['duplicata'];
			$url_pdf1 = $row_fat['url_pdf'];
			$descricao1 = str_replace(' ', '_', $descricao);
			$data_venci = 	$row_fat['data_vencimento'];
			$data_venci1 = date('d/m/Y', strtotime("$data_venci"));
			$banco = $row_fat['banco'];
			$valor_bruto = $row_fat['valor_bruto'];
			$valor_bruto = number_format($valor_bruto, 2, ",", ".");
			$alerta = 'Sua fatura no valor de R$ '.$valor_bruto.' vence hoje. Acesse seu boleto pelo app ou em nosso site.';
			$style = 'AVISO_VENCIMENTO';
			$id_unico12 = date('Ymd');
			$id_unico12 = 'AVIS-'.$id_unico12.''.$id_conta12.'';
			$duplicata10 = explode("_", $nr_banco5);
			$dupli_dia = $duplicata10[1];
			
			$sql_vuser = mysqli_query($conn, "SELECT * FROM clientes WHERE id_cliente = '$id_cliente_v'");
			if(mysqli_num_rows($sql_vuser) > 0){
			while ($resp_vuser = mysqli_fetch_assoc($sql_vuser)) {
			$nome_cliente4 = 	$resp_vuser['nome_cliente'];
			$telefone_celular12 = 	$resp_vuser['telefone_celular'];
			$telefone_celular12 = preg_replace("/[^0-9]/", "", $telefone_celular12);
			$doc_cliente = 	$resp_vuser['doc_cliente'];
			$usuario = preg_replace("/[^0-9]/", "", $doc_cliente);
			$descricao1111 = str_replace(' ', '_', $nome_cliente4);
			}}

			if($hora_venc >= '09:00'&& $hora_venc <= '12:00'){
			
			$nome_cliente_2 = str_replace(' ', '_', $nome_cliente4);
			$nome_fatura_2 = ''.$dupli_dia.'-'.$nome_cliente_2.'';
			
			
			$texto_push12 = '%F0%9F%97%93%EF%B8%8F+AVISO+VENCIMENTO%0A%0APrezado+'.$nome_cliente4.'%2C%0A%0ASua+fatura+no+valor+de+R%24+'.$valor_bruto.'+vence+hoje.+Acesse+sua+fatura+pelo+link+abaixo.%0A%0A'.$url_pdf1.'%0A%0APara+sua+comodidade%2C+voc%C3%AA+pode+fazer+o+pagamentos+desta+fatura+via+PIX.+Basta+fazer+a+transfer%C3%AAncia+utilizando+a+nossa+chave+PIX+CNPJ+27050542000125%0A%0A_%2AMensagem+autom%C3%A1tica+enviada+pelo+sistema%2A_';
			
			 $insere_alerta1 = mysqli_query($conn, "INSERT IGNORE INTO envios_whats (id_unico, telefone, mensagem, enviado, data_envio, id_cliente) VALUES ('$id_unico12', '$telefone_celular12', '$texto_push12', 'NAO', '$data_hoje', '$id_cliente_v')");
			
			}
			
			
		}}

}
#---- AVISO FALTA DE PAGAMENTO ------


if($hora1 >= '06:00' && $hora1 <= '07:00'){


$data2 = date('Y-m-d', strtotime('-2 days', strtotime($data_venc)));
$ano = date("Y");
$hora_aviso = date('H:i');

$data3 = date('Y-m-d', strtotime('-1 month', strtotime($data2)));

$mes = date("m");
$data_inicial = '01/'.$mes.'/'.$ano.'';
$data_inicial1 = 	substr($data_inicial,6,4) . "-" . substr($data_inicial,3,2) . "-" . substr($data_inicial,0,2);
$ultimo_dia = date("t", mktime(0,0,0,$mês,'01',$ano));
$data_final = ''.$ultimo_dia.'/'.$mes.'/'.$ano.'';
$data_final1 = 	substr($data_final,6,4) . "-" . substr($data_final,3,2) . "-" . substr($data_final,0,2);



$cons_faturas1 = mysqli_query($conn,"SELECT * FROM contas_receber WHERE (data_vencimento >= '$data3' AND data_vencimento <= '$data2') AND status='Em Aberto'");
		if(mysqli_num_rows($cons_faturas1) > 0){
			while ($row_fat1 = mysqli_fetch_assoc($cons_faturas1)) {
			$nr_banco = $row_fat1['nr_banco'];
			$cod = explode("_", $nr_banco);
			$id_fatura = $cod[1];
			$descricao1 = $row_fat1['descricao'];
			$valor_bruto1 = $row_fat1['valor_bruto'];
			$url_pdf55 = $row_fat1['url_pdf'];
			$id_cliente20 = $row_fat1['id_cliente'];
			$valor_bruto1 = number_format($valor_bruto, 2, ",", ".");
			$alerta1 = 'Prezado cliente. Existem pendencias de pagamento. Verifique suas faturas pelo app.';
			$style1 = 'ATRASO';
			$id_unico11 = date('Ymd');
			$id_unico11 = 'ATRASO-'.$id_unico11.'-'.$id_cliente20.'';
			
			$sql_vuser1 = mysqli_query($conn, "SELECT * FROM clientes WHERE id_cliente = '$id_cliente20'");
			if(mysqli_num_rows($sql_vuser1) > 0){
			while ($resp_vuser1 = mysqli_fetch_assoc($sql_vuser1)) {
			$doc_cliente1 = 	$resp_vuser1['doc_cliente'];
			$usuario1 = preg_replace("/[^0-9]/", "", $doc_cliente1);
			$nome_cliente55 = 	$resp_vuser1['nome_cliente'];
			$telefone_celular30 = 	$resp_vuser1['telefone_celular'];
			$telefone_celular30 = preg_replace("/[^0-9]/", "", $telefone_celular30);
			}}
			
			$dia = date('d');
			$dia_semana = date('D');
			
			if($dia % 2 == 0 && $dia_semana != 'Sun' && $hora_aviso >= '09:10' && $hora_aviso <= '12:00'){
			
			$texto_push = '%E2%9A%A0%EF%B8%8F+AVISO+JC+RASTREAMENTO%0A%0APrezado%28a%29+'.$nome_cliente55.'%2C%0A%0AInformamos+que+existem+faturas+em+aberto.+Lembramos+que+atrasos++est%C3%A3o+sujeitos+a+suspens%C3%A3o+dos+servi%C3%A7os.+Para+acessar+suas+faturas%2C+acesse+o+link+abaixo%3A%0A%0Ahttps%3A%2F%2Fwww.asaas.com%2Fb%2Fpdf%2F'.$id_fatura.'%0A%0AVoc%C3%AA+tamb%C3%A9m+pode+efetuar+o+pagamento+via+PIX%2C+basta+usar+a+chave+%2A27050542000125%2A%0A%0AD%C3%BAvidas+entre+em+contato+conosco+pelo+whatsapp+de+atendimento%2C+clique+abaixo%3A%0A%0Ahttps%3A%2F%2Fapi.whatsapp.com%2Fsend%3Fl%3Dpt_pt%26phone%3D558591682944%0A%0A_%2AMensagem+autom%C3%A1tica+enviada+pelo+sistema%2A_';
			
			 $insere_alerta1 = mysqli_query($conn, "INSERT IGNORE INTO envios_whats (id_unico, telefone, mensagem, enviado, id_cliente, data_envio) VALUES ('$id_unico11', '$telefone_celular30', '$texto_push', 'NAO', '$id_cliente20', '$data_hoje')");
			}
			
		
		
		
		}}
			
}





#================== VOLTS CRX =======================

$cons_veiculo = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE deviceid > '1' AND (modelo_equip='CRX3-MINI' OR modelo_equip='CRX7' OR modelo_equip='CRX2')");
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



?>
<?php
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
		else if($protocol == 'teltonika'){
			$volts = $power;
			$bateria_int = $battery;
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
		
		$sql_up = mysqli_query($conn, "UPDATE veiculos_clientes SET address='$address', ignicao='$ignicao1', servertime='$lastupdate', devicetime='$devicetime', volts='$bateria_externa', bateria_interna='$bateria_interna', satelite='$satelites1', gsm='$gsm1', speed='$speed' WHERE deviceid='$deviceid'");
		
		echo $deviceid.'<br>';
	
	}}
	

	

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
?>
