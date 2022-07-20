<?php
$server = "localhost";
$username = "root";
$password = "TR4vcijU6T9Keaw";
$dbname = "traccardb";

$con = mysqli_connect($server, $username, $password, $dbname);

// Create connection
try{
  $conn = new PDO("mysql:host=$server;dbname=$dbname","$username","$password");
  $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
  die('Unable to connect with the database');
}

## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Search value

$searchArray = array();

## Search 
$searchQuery = " ";
if($searchValue != ''){
	$searchQuery = " AND (placa LIKE :placa or 
        marca_veiculo LIKE :marca_veiculo OR modelo_veiculo LIKE :modelo_veiculo OR 
        imei LIKE :imei) ";
    $searchArray = array( 
        'placa'=>"%$searchValue%", 
        'marca_veiculo'=>"%$searchValue%",
        'modelo_veiculo'=>"%$searchValue%",
        'imei'=>"%$searchValue%"
    );
}

## Total number of records without filtering
$stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM veiculos_clientes ");
$stmt->execute();
$records = $stmt->fetch();
$totalRecords = $records['allcount'];

## Total number of records with filtering
$stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM veiculos_clientes WHERE 1 ".$searchQuery);
$stmt->execute($searchArray);
$records = $stmt->fetch();
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$stmt = $conn->prepare("SELECT * FROM veiculos_clientes WHERE 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

// Bind values
foreach($searchArray as $key=>$search){
    $stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
}

$stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
$stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
$stmt->execute();
$empRecords = $stmt->fetchAll();

$data = array();

foreach($empRecords as $row){
	$id_cliente = $row['id_cliente'];
	$id_veiculo = $row['id_veiculo'];
	$placa = $row['placa'];
	$modelo_veiculo = $row['modelo_veiculo'];
	$protecao = $row['protecao'];
	$marca_veiculo = $row['marca_veiculo'];
	$deviceid = $row['deviceid'];
	$status = $row['status'];
	$data_cadastro = $row['data_cadastro'];
	$data_cadastro = date('d/m/Y', strtotime("$data_cadastro"));
	$modelo_equip = $row['modelo_equip'];
	$chip = $row['chip'];
	$imei = $row['imei'];
	$operadora = $row['operadora'];
	$fornecedor_chip = $row['fornecedor_chip'];
	$ano_veiculo = $row['ano_veiculo'];
	$ano_modelo = $row['ano_modelo'];
	$cor_veiculo = $row['cor_veiculo'];
	$vendedor = $row['vendedor'];
	$recorrencia_veic = $row['recorrencia'];
	$pacote = $row['pacote'];
	$forma_pagamento = $row['forma_pagamento'];
	$valor_mensal = $row['valor_mensal'];
	$valor_mensal = number_format($valor_mensal, 2, ",", ".");
	
	$cons_cliente = mysqli_query($con,"SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
		if(mysqli_num_rows($cons_cliente) > 0){
			while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
			$nome_cliente = 	$resp_cliente['nome_cliente'];
		}}
	
	
	$cons_status = mysqli_query($con,"SELECT * FROM status WHERE id_status='$status'");
		if(mysqli_num_rows($cons_status) > 0){
			while ($resp_status = mysqli_fetch_assoc($cons_status)) {
			$status_cliente = 	$resp_status['status'];
		}}
	
	$cons_posicao = mysqli_query($con,"SELECT * FROM posicoes WHERE deviceid='$deviceid'");
		if(mysqli_num_rows($cons_posicao) > 0){
			while ($resp_posicao = mysqli_fetch_assoc($cons_posicao)) {
			$devicetime = 	$resp_posicao['devicetime'];
			$devicetime1 = date('d/m/Y H:i:s', strtotime('-3 hour', strtotime($devicetime)));
		}}
	
	$cons_pacote = mysqli_query($con,"SELECT * FROM pacotes WHERE id_pacote='$pacote'");
		if(mysqli_num_rows($cons_pacote) > 0){
	while ($resp_pac = mysqli_fetch_assoc($cons_pacote)) {
	$pacote1 = 	$resp_pac['pacote'];
	}}
	
	if($protecao == 'SIM'){
		$protect = '<img src="/tracker2/manager/imagens/defenf.jpeg" style="width:20px; height:20px">';
	}
	if($protecao != 'SIM'){
		$protect = '';
	}
		
	
	if($status == 1){
		$status1 = '<h5><span class="badge" style="background-color:#009900;color:#FFF">'.$status_cliente.'</span></h5>';
	}
	if($status == 2){
		$status1 = '<h4><span class="badge badge-danger">'.$status_cliente.'</span></h4>';
	}
	if($status == 4){
		$status1 = '<h4><span class="badge badge-dark">'.$status_cliente.'</span></h4>';
	}
	if($status == 5){
		$status1 = '<h4><span class="badge badge-dark">'.$status_cliente.'</span></h4>';
	}
	if($status == 7){
		$status1 = '<h4><span class="badge badge-info">'.$status_cliente.'</span></h4>';
	}
	if($status == 11){
		$status1 = '<h4><span class="badge badge-info">'.$status_cliente.'</span></h4>';
	}
	if($status == 13){
		$status1 = '<h4><span class="badge badge-info">'.$status_cliente.'</span></h4>';
	}
	if($status == 99){
		$status1 = '<h4><span class="badge badge-warning">'.$status_cliente.'</span></h4>';
	}
	
	$data_agora = date('Y-m-d H:i:s');
	$data_agora = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_agora)));

	$data_inicial_12 = date('Y-m-d H:i:s', strtotime('-5 minutes', strtotime($data_agora)));
	
	$cons_device = mysqli_query($con,"SELECT * FROM tc_devices WHERE id='$deviceid'");
		if(mysqli_num_rows($cons_device) > 0){
	while ($resp_device = mysqli_fetch_assoc($cons_device)) {
		$lastupdate = 	$resp_device['lastupdate'];
	$lastupdate1 = date('d/m/Y H:i:s', strtotime('-3 hour', strtotime($lastupdate)));
	if($lastupdate <= $data_inicial_12){
		$conect = '<h4><span class="badge" style="background-color:#CD5C5C;color:#FFF"><i class="fas fa-wifi"></i> OFFLINE</span></h4>';
		$icon_conect = '<h4><span class="badge" style="background-color:#CD5C5C;color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" title="Offline" data-content="Dispositivo sem comunicação desde '.$lastupdate1.'" data-original-title="ONLINE"><i class="fas fa-wifi"></i></span></h4>';
	} 
	if($lastupdate > $data_inicial_12){
		$conect = '<h4><span class="badge" style="background-color:#009900;color:#FFF"><i class="fas fa-wifi"></i> ONLINE</span></h4>';
		$icon_conect = '<h4><span class="badge" style="background-color:#009900;color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" title="ONLINE" data-content="Data/hora: '.$lastupdate1.'" data-original-title="OFFLINE"><i class="fas fa-wifi"></i></span></h4>';	
	}
	if($lastupdate == '' or $lastupdate == null){
		$conect = '<h4><span class="badge" style="background-color:#CD5C5C;color:#FFF"><i class="fas fa-wifi"></i> OFFLINE</span></h4>';
		$icon_conect = '<h4><span class="badge" style="background-color:#CD5C5C;color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" title="Offline" data-content="Dispositivo sem comunicação" data-original-title="O"><i class="fas fa-wifi"></i></span></h4>';
	}
	}}
	
	$data_v = date('Y-m-d');
	$data_v = date('Y-m-d', strtotime('-2 days', strtotime($data_v)));
	
	$cons_contas = mysqli_query($con,"SELECT * FROM contas_receber WHERE descricao='$nome_cliente' AND status='Em Aberto' AND data_vencimento < '$data_v'");
	$total_c = mysqli_num_rows($cons_contas);
	
	if($total_c >= 1){
		$cor = '#FA8072';
		$inform = '<span style="color:#990000" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="'.$total_c.' Fatura(s) em Aberto - Clique para abrir o cadastro."><b><i class="fal fa-info-square"></i> '.$nome_cliente.'</b></span>';
		$atraso = '<div style="display:none">Atraso</div>';
	} 
	if($total_c <= 0){
		$cor = '';
		$inform = '<span style="color:#000000" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Clique para abrir o cadastro.">'.$nome_cliente.'</b></span>';
		$atraso = '<div style="display:none">Atraso</div>';
		$atraso = '';
	}
	
	$veiculo = $protect.' '.$marca_veiculo.'/'.$modelo_veiculo;
	$cliente = '<a href="cad_cliente.php?c='.$base64.'">'.$inform.'</a>';
	$ano = $ano_modelo.'/'.$ano_veiculo;
	$data_server = '<i class="fal fa-clock"></i> '.$lastupdate1;
	$data_gps = '<i class="fal fa-map-marker-alt"></i> '.$devicetime1;
	$valor_mensal = 'R$ '.$valor_mensal;
											
	$base64 = 'id_cliente:'.$id_cliente.'';
	$base64 = base64_encode($base64);
	
	$device_id = 'deviceid:'.$deviceid.'';
	$device_id = base64_encode($device_id);
	
	$base64_veic = 'id_cliente:'.$id_cliente.'&id_veiculo:'.$id_veiculo;
	$base64_veic = base64_encode($base64_veic);
	
    $data[] = array(
            "icon_conect"=>$veiculo,
            "placa"=>$row['placa'],
            "veiculo"=>$veiculo,
            "status1"=>$status1,
            "cliente"=>$cliente,
            "ano"=>$ano,
            "modelo_equip"=>$modelo_equip,
            "imei"=>$imei,
            "chip"=>$chip,
            "operadora"=>$operadora,
            "fornecedor_chip"=>$fornecedor_chip,
            "data_server"=>$data_server,
            "data_gps"=>$data_gps,
            "pacote1"=>$pacote1,
            "valor_mensal"=>$valor_mensal,
            "forma_pagamento"=>$forma_pagamento,
            "recorrencia_veic"=>$recorrencia_veic
        );
}

## Response
$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data
);

echo json_encode($response);
?>
