  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('conexao.php');

$id_cliente = 	$_POST['id_cliente'];
$id_cliente_pai = 	$_POST['id_cliente_pai'];
$id_veiculo = 	$_POST['id_veiculo'];
$data_cadastro = date('Y-m-d');





//DADOS DO VEICULO
$tipo_veiculo = 	$_POST['tipo_veiculo'];
$marca_veiculo = 	$_POST['marca_veiculo'];
$modelo_veiculo = 	$_POST['modelo_veiculo'];
$ano_veiculo = 	$_POST['ano_veiculo'];
$ano_modelo = 	$_POST['ano_modelo'];
$placa = 	$_POST['placa'];
$renavan = 	$_POST['renavan'];
$chassi = 	$_POST['chassi'];
$cor_veiculo = 	$_POST['cor_veiculo'];
$combustivel = 	$_POST['combustivel'];
$veiculo = ''.$placa.' - '.$marca_veiculo.'/'.$modelo_veiculo.'';
$status = $_POST['status_veic'];
$deviceid = $_POST['deviceid'];



//DADOS RASTREADOR
$modelo_equip = 	$_POST['modelo_equip'];
$imei = 	$_POST['imei'];
$chip = 	$_POST['chip'];
$iccid = 	$_POST['iccid'];
$operadora = 	$_POST['operadora'];
$fornecedor_chip = 	$_POST['fornecedor_chip'];

//DADOS FINANCEIROS
$pacote = 	$_POST['pacote'];
$valor_mensal = 	$_POST['valor_mensal'];
$valor_mensal = str_replace(".","","$valor_mensal");
$valor_mensal = str_replace(",",".","$valor_mensal");
$forma_pagamento = 	$_POST['forma_pagamento'];
$vendedor = 	$_POST['vendedor'];
$vencimento_contrato = 	$_POST['vencimento_contrato'];

//ALERTAS

$bateria_removida = 	$_POST['bateria_removida'];
if($bateria_removida == ''){
	$bateria_removida1 = 'NAO';
} else {
	$bateria_removida1 = $bateria_removida;
}

$bateria_baixa = 	$_POST['bateria_baixa'];
if($bateria_baixa == ''){
	$bateria_baixa1 = 'NAO';
} else {
	$bateria_baixa1 = $bateria_baixa;
}

$movimento = 	$_POST['movimento'];
if($movimento == ''){
	$movimento1 = 'NAO';
} else {
	$movimento1 = $movimento;
}

$vibracao = 	$_POST['vibracao'];
if($vibracao == ''){
	$vibracao1 = 'NAO';
} else {
	$vibracao1 = $vibracao;
}

$ignicao = 	$_POST['ignicao'];
if($ignicao == ''){
	$ignicao1 = 'NAO';
} else {
	$ignicao1 = $ignicao;
}

$panico = 	$_POST['panico'];
if($panico == ''){
	$panico1 = 'NAO';
} else {
	$panico1 = $panico;
}

$voltagem = $_POST['voltagem'];
if($voltagem == ''){
	$voltagem1 = 'NAO';
} else {
	$voltagem1 = $voltagem;
}

if($status == 'SIM'){
	$status1 = 1;
	$id_cliente2 = $id_cliente;
} else {
	$status1 = 2;
	$sql20 = '0';
}





if($modelo_equip == 'CRX3-MINI'){
	$atributos = array('gt06.alternative' => true);
} else if($modelo_equip == 'EV02'){
	$atributos = array('gt06.alternative' => true);
} else {
$obj1 = new \stdClass; // Instantiate stdClass object
$obj2 = new class{}; // Instantiate anonymous class
$obj3 = (object)[]; 
$atributos = $obj3;
}

$cons_nivel = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='1361'");
	if(mysqli_num_rows($cons_nivel) > 0){
while ($resp_nivel = mysqli_fetch_assoc($cons_nivel)) {
$ip_traccar = 	$resp_nivel['ip_traccar'];
$login_traccar = 	$resp_nivel['login_traccar'];
$senha_traccar = 	$resp_nivel['senha_traccar'];
$token_traccar = ''.$login_traccar.':'.$senha_traccar.'';
$token_traccar = base64_encode($token_traccar);
}}


if($deviceid == ''){
	$object = array('name' => $veiculo, 'attributes' => $atributos, 'uniqueId' => $imei, 'category' => $tipo_veiculo, 'contact' => $id_cliente, 'phone' => $chip);
	$json = json_encode($object);
	$url = 'http://5.189.185.179:8082/api/devices';
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
		'Authorization: Basic '.$token_traccar.''
	));
	$output = curl_exec($ch);
	$response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
}

if($deviceid == '0'){
	$object = array('name' => $veiculo, 'attributes' => $atributos, 'uniqueId' => $imei, 'category' => $tipo_veiculo, 'contact' => $id_cliente, 'phone' => $chip);
	$json = json_encode($object);
	$url = 'http://5.189.185.179:8082/api/devices';
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
		'Authorization: Basic '.$token_traccar.''
	));
	$output = curl_exec($ch);
	$response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
}


if($deviceid >= '1'){
	$object = array('name' => $veiculo, 'attributes' => $atributos, 'uniqueId' => $imei, 'category' => $tipo_veiculo, 'contact' => $id_cliente2, 'phone' => $chip, 'id'=> $deviceid);
	$json = json_encode($object);
	$url = 'http://5.189.185.179:8082/api/devices/'.$deviceid.'';
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
		'Authorization: Basic '.$token_traccar.''
	));
	$output = curl_exec($ch);
	$response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
}
//echo $output;
$obj = json_decode($output);
$deviceid_id = $obj->{'id'};

if($deviceid_id == ''){
	$base64 = 'id_cliente:'.$id_cliente.'&id_veiculo:'.$id_veiculo.'';
	$base64 = base64_encode($base64);
	header('Location: editar_veiculo.php?c='.$base64.'&error=1');
}
if($deviceid_id != ''){
	
	$base64 = 'id_cliente:'.$id_cliente.'';
	$base64 = base64_encode($base64);
	
	$sql_dev = mysqli_query($conn, "UPDATE tc_devices SET id_cliente_pai='$id_cliente_pai' WHERE id='$deviceid'");
	
	$sql_veiculo = "UPDATE veiculos_clientes SET status='$status1', id_cliente='$id_cliente', marca_veiculo='$marca_veiculo', tipo_veiculo='$tipo_veiculo', modelo_veiculo='$modelo_veiculo', ano_veiculo='$ano_veiculo', ano_modelo='$ano_modelo', placa='$placa', renavan='$renavan', chassi='$chassi', combustivel='$combustivel', cor_veiculo='$cor_veiculo', chip='$chip', operadora='$operadora', fornecedor_chip='$fornecedor_chip', iccid='$iccid', imei='$imei', modelo_equip='$modelo_equip', alerta_ign='$ignicao1', alerta_bateria='$bateria_removida1', alerta_bateria_baixa='$bateria_baixa1', alerta_movimento='$movimento1', alerta_vibracao='$vibracao1', alerta_panico='$panico1', pacote='$pacote', valor_mensal='$valor_mensal', forma_pagamento='$forma_pagamento', vendedor='$vendedor', vencimento_contrato='$vencimento_contrato', id_cliente_pai='$id_cliente_pai' WHERE id_veiculo='$id_veiculo'";
	
	if (mysqli_query($conn, $sql_veiculo)) {
      echo "New record created successfully";
} else {
      echo "Error OS: " . $sql_veiculo . "<br>" . mysqli_error($conn);
}
	
	header('Location: cad_cliente_veiculos.php?c='.$base64.'');
}







?>
