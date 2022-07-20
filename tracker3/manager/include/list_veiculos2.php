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

$inicio = '1';

## Search 
$searchQuery = " ";
if($searchValue != ''){
	$searchQuery = " AND deviceid >= '1' AND (status='1' OR status='99' OR status='7') AND (placa LIKE :placa or 
        marca_veiculo LIKE :marca_veiculo OR modelo_veiculo LIKE :modelo_veiculo OR 
        status LIKE :status OR imei LIKE :imei OR chip LIKE :chip OR operadora LIKE :operadora OR nome_cliente LIKE :nome_cliente OR modelo_equip LIKE :modelo_equip ) ";
    $searchArray = array( 
        'placa'=>"%$searchValue%", 
        'marca_veiculo'=>"%$searchValue%",
        'modelo_veiculo'=>"%$searchValue%",
        'status'=>"%$searchValue%",
        'imei'=>"%$searchValue%",
        'chip'=>"%$searchValue%",
        'operadora'=>"%$searchValue%",
        'modelo_equip'=>"%$searchValue%",
        'nome_cliente'=>"%$searchValue%"
    );
}

## Total number of records without filtering
$stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM veiculos_clientes WHERE deviceid != '' AND (status='1' OR status='99' OR status='7') AND id_empresa='1362'");
$stmt->execute();
$records = $stmt->fetch();
$totalRecords = $records['allcount'];

## Total number of records with filtering
$stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM veiculos_clientes WHERE 1 ".$searchQuery." AND deviceid != '' AND (status='1' OR status='99' OR status='7') AND id_empresa='1362'");
$stmt->execute($searchArray);
$records = $stmt->fetch();
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$stmt = $conn->prepare("SELECT * FROM veiculos_clientes WHERE 1 ".$searchQuery." AND deviceid >= '1' AND (status='1' OR status='99' OR status='7') AND id_empresa='1362' ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

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
	$veiculo = $marca_veiculo.'/'.$modelo_veiculo;
	$deviceid = $row['deviceid'];
	$status = $row['status'];
	$data_cadastro = $row['data_cadastro'];
	$data_cadastro = date('d/m/Y', strtotime("$data_cadastro"));
	$modelo_equip = $row['modelo_equip'];
	$chip = $row['chip'];
	$imei = $row['imei'];
	$iccid = $row['iccid'];
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
	
	$cons_posicao = mysqli_query($con,"SELECT * FROM tc_positions WHERE deviceid='$deviceid' ORDER BY id DESC LIMIT 1");
		if(mysqli_num_rows($cons_posicao) <= 0){
			$data_gps = '<h5><span class="badge" style="background-color:#999;color:#FFF"> SEM POSIÇÃO</span></h5>';
		}
		if(mysqli_num_rows($cons_posicao) > 0){
			while ($resp_posicao = mysqli_fetch_assoc($cons_posicao)) {
			$devicetime = 	$resp_posicao['devicetime'];
			$data_gps = date('d/m/Y H:i:s', strtotime('-3 hour', strtotime($devicetime)));
		}}
		
	$data_agora = date('Y-m-d H:i:s');
	$data_agora = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_agora)));

	$data_inicial_12 = date('Y-m-d H:i:s', strtotime('-5 minutes', strtotime($data_agora)));
	
	$cons_device = mysqli_query($con,"SELECT * FROM tc_devices WHERE id='$deviceid'");
		if(mysqli_num_rows($cons_device) > 0){
	while ($resp_device = mysqli_fetch_assoc($cons_device)) {
		$lastupdate = 	$resp_device['lastupdate'];
		$lastupdate1 = date('d/m/Y H:i:s', strtotime('-3 hour', strtotime($lastupdate)));
		if($lastupdate <= $data_inicial_12){
			$conect = '<h5><span class="badge" style="background-color:#CD5C5C;color:#FFF"><i class="fas fa-wifi"></i> OFFLINE</span></h5>';
			$data_server = $lastupdate1;
		} 
		if($lastupdate > $data_inicial_12){
			$conect = '<h5><span class="badge" style="background-color:#009900;color:#FFF"><i class="fas fa-wifi"></i> ONLINE</span></h5>';
			$icon_conect = '<h4><span class="badge" style="background-color:#009900;color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" title="ONLINE" data-content="Data/hora: '.$lastupdate1.'" data-original-title="OFFLINE"><i class="fas fa-wifi"></i></span></h4>';
			$data_server = $lastupdate1;
		}
		if($lastupdate == '' or $lastupdate == null){
			$conect = '<h5><span class="badge" style="background-color:#999;color:#FFF"><i class="fas fa-wifi"></i> SEM COMUNICAÇÃO</span></h5>';
			$icon_conect = '<h4><span class="badge" style="background-color:#CD5C5C;color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" title="Offline" data-content="Dispositivo sem comunicação" data-original-title="O"><i class="fas fa-wifi"></i></span></h4>';
			$data_server = '<h5><span class="badge" style="background-color:#999;color:#FFF"> SEM COMUNICAÇÃO</span></h5>';
		}
	}}
		
	
	if($status == 1){
		$status1 = '<h5><span class="badge" style="background-color:#009900;color:#FFF">'.$status_cliente.'</span></h5>';
	}
	if($status == 2){
		$status1 = '<h5><span class="badge badge-danger">'.$status_cliente.'</span></h5>';
	}
	if($status == 4){
		$status1 = '<h5><span class="badge badge-dark">'.$status_cliente.'</span></h5>';
	}
	if($status == 5){
		$status1 = '<h5><span class="badge badge-dark">'.$status_cliente.'</span></h5>';
	}
	if($status == 7){
		$status1 = '<h5><span class="badge badge-info">'.$status_cliente.'</span></h5>';
	}
	if($status == 11){
		$status1 = '<h5><span class="badge badge-info">'.$status_cliente.'</span></h5>';
	}
	if($status == 13){
		$status1 = '<h5><span class="badge badge-info">'.$status_cliente.'</span></h5>';
	}
	if($status == 99){
		$status1 = '<h5><span class="badge badge-warning">'.$status_cliente.'</span></h5>';
	}
	
	$base64 = 'id_cliente:'.$id_cliente.'';
	$base64 = base64_encode($base64);
	
	$device_id = 'deviceid:'.$deviceid.'';
	$device_id = base64_encode($device_id);
	
	$base64_veic = 'id_cliente:'.$id_cliente.'&id_veiculo:'.$id_veiculo;
	$base64_veic = base64_encode($base64_veic);
	
	$opcoes = '<a href="editar_veiculo.php?c='.$base64_veic.'&pag=veic"><button type="button" class="btn btn-dark btn-icon btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Abrir Cadastro"><i class="fab fa-elementor"></i></button></a> 
	<a href="grid_device.php?c='.$device_id.'"><button type="button" class="btn btn-primary btn-icon btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Abrir no Mapa"><i class="fal fa-map-marker-alt"></i></button></a>';
	
    $data[] = array(
            "id_veiculo"=>$id_veiculo,
            "opcoes"=>$opcoes,
            "placa"=>$placa,
            "modelo_veiculo"=>$veiculo,
            "conect"=>$conect,
            "data_server"=>$data_server,
            "data_gps"=>$data_gps,
            "status"=>$status1,
            "nome_cliente"=>$nome_cliente,
            "modelo_equip"=>$modelo_equip,
            "imei"=>$imei,
            "chip"=>$chip,
            "iccid"=>$iccid,
			"operadora"=>$operadora,
            "fornecedor_chip"=>$fornecedor_chip,
            "pacote"=>$pacote1,
            "valor_mensal"=>"R$ $valor_mensal",
            "forma_pagamento"=>$forma_pagamento
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
