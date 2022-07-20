<?php
require("conexao.php");
$id_empresa = $_REQUEST['id_empresa'];

$data_agora = date('Y-m-d H:i:s');
$data_agora = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_agora)));
$data_inicial_12 = date('Y-m-d H:i:s', strtotime('-5 minutes', strtotime($data_agora)));

function parseToXML($htmlStr){
	$xmlStr=str_replace('<','&lt;',$htmlStr);
	$xmlStr=str_replace('>','&gt;',$xmlStr);
	$xmlStr=str_replace('"','&quot;',$xmlStr);
	$xmlStr=str_replace("'",'&#39;',$xmlStr);
	$xmlStr=str_replace("&",'&amp;',$xmlStr);
	return $xmlStr;
}

// Select all the rows in the markers table
$result_markers = "SELECT * FROM tc_devices WHERE contact != 'ESTOQUE' AND lastupdate < '$data_inicial_12' AND id_empresa='$id_empresa'";
$resultado_markers = mysqli_query($conn, $result_markers);

header("Content-type: text/xml");

// Start XML file, echo parent node
echo '<markers>';

// Iterate through the rows, printing XML nodes for each
while ($row_markers = mysqli_fetch_assoc($resultado_markers)){
	
	$id_device = $row_markers['id'];
	$position_id = $row_markers['positionid'];
	$name = $row_markers['name'];
	$category = $row_markers['category'];
	$lastupdate = $row_markers['lastupdate'];
	$lastupdate = date('Y-m-d H:i:s', strtotime('-3 hour', strtotime($lastupdate)));
	
	if($lastupdate <= $data_agora){
		$conexao = 'OFF';
	} else {
		$conexao = 'ON';
	}
	
	$cons_posicao = mysqli_query($conn,"SELECT * FROM tc_positions WHERE id='$position_id'");
	if(mysqli_num_rows($cons_posicao) > 0){
while ($resp_posicao = mysqli_fetch_assoc($cons_posicao)) {
		$servertime1 = $resp_posicao['servertime'];
	$servertime = date('Y-m-d H:i:s', strtotime('-3 hour', strtotime($servertime1)));
	$data_format = date('d/m/Y H:i:s', strtotime('-3 hour', strtotime($servertime1)));
	$latitude = $resp_posicao['latitude'];
	$longitude = $resp_posicao['longitude'];
	$address = $resp_posicao['address'];
	$speed = $resp_posicao['speed'];
	
	
		
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
	
	
	
	$deviceid = $resp_posicao['deviceid'];
	
	
	
	$attributes = $resp_posicao['attributes'];
	$obj = json_decode($attributes);
	$ignicao = $obj->{'ignition'};
if (is_bool($ignicao)) $ignicao ? $ignicao = "true" : $ignicao = "false";
else if ($ignicao !== null) $ignicao = (string)$ignicao;


	$cons_veiculo = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE deviceid='$id_device' ");
					if(mysqli_num_rows($cons_veiculo) <= 0){
						continue;
					}
					if(mysqli_num_rows($cons_veiculo) > 0){
				while ($resp_veiculo = mysqli_fetch_assoc($cons_veiculo)) {
				$placa = 	$resp_veiculo['placa'];
				$bloqueio = 	$resp_veiculo['bloqueio'];
				$veiculo = ''.$resp_veiculo['marca_veiculo'].'/'.$resp_veiculo['modelo_veiculo'].'';
				$chip = $resp_veiculo['chip'];
				$imei = $resp_veiculo['imei'];
				$operadora = $resp_veiculo['operadora'];
				$id_cliente = $resp_veiculo['id_cliente'];
				
				
				$cons_cliente = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
	if(mysqli_num_rows($cons_cliente) > 0){
while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
$nome_cliente = 	$resp_cliente['nome_cliente'];
	}}

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
	
	
if($conexao == 'OFF'){
	$ign1 = ''.$category.'_off.png';
	$ign3 = $ign2;
}
if($conexao == 'ON'){
	$ign1 = $ign;
	$ign3 = $ign2;
}	
	
	
	
	
	
	
	
  // Add to XML document node
  echo '<marker ';
  echo 'name="' . parseToXML($name) . '" ';
  echo 'address="' . parseToXML($address_db) . '" ';
  echo 'lat="' . $resp_posicao['latitude'] . '" ';
  echo 'lng="' . $resp_posicao['longitude'] . '" ';
  echo 'ign="' . $ign1 . '" ';
    echo 'placa="' . $placa . '" ';
  echo 'veiculo="' . $veiculo . '" ';
  echo 'data_format="' . $data_format . '" ';
  echo 'ignicao="' . $ign3 . '" ';
  echo 'cliente="' . $nome_cliente . '" ';
  echo 'deviceid="' . $id_device . '" ';
  echo 'chip="' . $chip . '" ';
  echo 'imei="' . $imei . '" ';
  echo 'operadora="' . $operadora . '" ';
  echo '/>';
}}}}}

// End XML file
echo '</markers>';



