<?php
require("conexao.php");

$deviceid = $_GET['id_device'];
$id_empresa = $_GET['customer'];

$data_agora = date('Y-m-d H:i:s');
$data_agora = date('Y-m-d H:i:s', strtotime('-4 hour', strtotime($data_agora)));

function parseToXML($htmlStr){
	$xmlStr=str_replace('<','&lt;',$htmlStr);
	$xmlStr=str_replace('>','&gt;',$xmlStr);
	$xmlStr=str_replace('"','&quot;',$xmlStr);
	$xmlStr=str_replace("'",'&#39;',$xmlStr);
	$xmlStr=str_replace("&",'&amp;',$xmlStr);
	return $xmlStr;
}

// Select all the rows in the markers table
$result_markers = "SELECT * FROM tc_devices WHERE id='$deviceid'";
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
					
	$estado_n = $result -1;
	$estado = $address1[$estado_n];
	$rua = $address1[0];
	$cidade_n = $result -4;
	$cidade = $address1[$cidade_n];
	
	$attributes = $resp_posicao['attributes'];
	$obj = json_decode($attributes);
	$ignicao = $obj->{'ignition'};
if (is_bool($ignicao)) $ignicao ? $ignicao = "true" : $ignicao = "false";
else if ($ignicao !== null) $ignicao = (string)$ignicao;


$cons_veiculo = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE deviceid='$deviceid' ");
	if(mysqli_num_rows($cons_veiculo) > 0){
while ($resp_veiculo = mysqli_fetch_assoc($cons_veiculo)) {
$id_motorista = 	$resp_veiculo['id_motorista'];
$placa = 	$resp_veiculo['placa'];
$bloqueio = 	$resp_veiculo['bloqueio'];
$veiculo = ''.$resp_veiculo['marca_veiculo'].'/'.$resp_veiculo['modelo_veiculo'].'';

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
} else if ($ignicao == '' && $speed <= 5 && $bloqueio == 'NAO'){
	$ign = ''.$category.'.png';	
	$ign2 = 'Desligada';
} else if ($ignicao == '' && $speed <= 5 && $bloqueio == 'SIM'){
	$ign = ''.$category.'_d.png';
	$ign2 = 'Desligada';	
} else {
	$ign = ''.$category.'.png';	
	$ign2 = 'Desligada';
}

	$cons_motorista = mysqli_query($conn,"SELECT * FROM motoristas WHERE id_motorista='$id_motorista' ");
	if(mysqli_num_rows($cons_motorista) > 0){
while ($resp_mot = mysqli_fetch_assoc($cons_motorista)) {
$nome_motorista = 	$resp_mot['nome_motorista'];
	}}
	
	

	if($estado = 'Rio Grande do Sul'){
		$uf = 'RS';
	}
	else if($estado = 'Santa Catarina'){
		$uf = 'SC';
	}
	else if($estado = 'Rio de Janeiro'){
		$uf = 'RJ';
	}
	else if($estado = 'São Paulo'){
		$uf = 'SP';
	}
	else if($estado = 'Paraná'){
		$uf = 'PR';
	}
	
	$address_db = ''.$rua.' - '.$cidade.' / '.$uf.'';
	

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
  echo 'address="' . parseToXML($address) . '" ';
  echo 'lat="' . $resp_posicao['latitude'] . '" ';
  echo 'lng="' . $resp_posicao['longitude'] . '" ';
  echo 'ign="' . $ign1 . '" ';
  echo 'placa="' . $placa . '" ';
  echo 'veiculo="' . $veiculo . '" ';
  echo 'data_format="' . $data_format . '" ';
  echo 'ignicao="' . $ign3 . '" ';
  echo 'motorista="' . $nome_motorista . '" ';
  echo '/>';
}}}}}

// End XML file
echo '</markers>';



