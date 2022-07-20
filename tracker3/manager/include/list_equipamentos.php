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
	$searchQuery = " AND status='ESTOQUE' AND (modelo_equip LIKE :modelo_equip OR imei LIKE :imei OR chip LIKE :chip OR operadora LIKE :operadora OR fornecedor_chip LIKE :fornecedor_chip) ";
       
    $searchArray = array( 
        'modelo_equip'=>"%$searchValue%", 
        'imei'=>"%$searchValue%",
        'chip'=>"%$searchValue%",
        'operadora'=>"%$searchValue%",
        'fornecedor_chip'=>"%$fornecedor_chip%"
    );
}

## Total number of records without filtering
$stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM estoque_rastreadores WHERE id_cliente='ESTOQUE' ");
$stmt->execute();
$records = $stmt->fetch();
$totalRecords = $records['allcount'];

## Total number of records with filtering
$stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM estoque_rastreadores WHERE 1 ".$searchQuery." AND status='ESTOQUE' ");
$stmt->execute($searchArray);
$records = $stmt->fetch();
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$stmt = $conn->prepare("SELECT * FROM estoque_rastreadores WHERE 1 ".$searchQuery." AND status='ESTOQUE' ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

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
	$id_equip = $row['id_equip'];
	$modelo_equip = $row['modelo_equip'];
	$imei = $row['imei'];
	$chip = $row['chip'];
	$operadora = $row['operadora'];
	$deviceid = $row['deviceid'];
	$fornecedor_chip = $row['fornecedor_chip'];
	
		$data_agora = date('Y-m-d H:i:s');
		$data_agora = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_agora)));

		$data_inicial_12 = date('Y-m-d H:i:s', strtotime('-5 minutes', strtotime($data_agora)));
		
		$cons_posicao = mysqli_query($con,"SELECT * FROM tc_positions WHERE deviceid='$deviceid' ORDER BY id DESC LIMIT 1");
			if(mysqli_num_rows($cons_posicao) <= 0){
				$data_gps = '<b>Sem Posição</b>';
			}
			if(mysqli_num_rows($cons_posicao) > 0){
				while ($resp_posicao = mysqli_fetch_assoc($cons_posicao)) {
				$devicetime = 	$resp_posicao['devicetime'];
				$data_gps = date('d/m/Y H:i:s', strtotime('-3 hour', strtotime($devicetime)));
		}}
		
		$cons_device = mysqli_query($con,"SELECT * FROM tc_devices WHERE id='$deviceid'");
		if(mysqli_num_rows($cons_device) > 0){
			while ($resp_device = mysqli_fetch_assoc($cons_device)) {
			$lastupdate = 	$resp_device['lastupdate'];
			$lastupdate1 = date('d/m/Y H:i:s', strtotime('-3 hour', strtotime($lastupdate)));
		if($lastupdate <= $data_inicial_12){
			$conect = '<h5><span class="badge" style="background-color:#CD5C5C;color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" title="Offline" data-content="Dispositivo sem comunicação desde '.$lastupdate1.'" data-original-title="ONLINE"><i class="fas fa-wifi"></i></span></h5>';
			$data_server = $lastupdate1;
		} 
		if($lastupdate > $data_inicial_12){
			$conect = '<h5><span class="badge" style="background-color:#009900;color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" title="ONLINE" data-content="Data/hora: '.$lastupdate1.'" data-original-title="OFFLINE"><i class="fas fa-wifi"></i></span></h5>';
			$icon_conect = '<h4><span class="badge" style="background-color:#009900;color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" title="ONLINE" data-content="Data/hora: '.$lastupdate1.'" data-original-title="OFFLINE"><i class="fas fa-wifi"></i></span></h4>';
			$data_server = $lastupdate1;
		}
		if($lastupdate == '' or $lastupdate == null){
			$conect = '<h5><span class="badge" style="background-color:#999;color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" title="Offline" data-content="Dispositivo sem comunicação" data-original-title="O"><i class="fas fa-wifi"></i></span></h5>';
			$icon_conect = '<h4><span class="badge" style="background-color:#CD5C5C;color:#FFF" data-toggle="popover" data-trigger="hover" data-placement="top" title="Offline" data-content="Dispositivo sem comunicação" data-original-title="O"><i class="fas fa-wifi"></i></span></h4>';
			$data_server = '<b>Sem Comunicação</b>';
		}
	}}
	
	
	
	$base64 = 'id_cliente:'.$id_cliente.'';
	$base64 = base64_encode($base64);
	
	$botao = '<a href="cad_cliente.php?c='.$base64.'"><button type="button" class="btn btn-dark btn-icon btn-sm"><i class="fab fa-elementor"></i></button></a>';
	
	
    $data[] = array(
            "id_equip"=>$id_equip,
            "botao"=>$botao,
            "conect"=>$conect,
            "modelo_equip"=>$modelo_equip,
            "imei"=>$imei,
            "chip"=>$chip,
            "operadora"=>$operadora,
            "fornecedor_chip"=>$fornecedor_chip,
            "data_server"=>$data_server,
            "data_gps"=>$data_gps
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
