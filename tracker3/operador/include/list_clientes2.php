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
	$searchQuery = " AND (nome_cliente LIKE :nome_cliente or 
        status_pg LIKE :status_pg OR status2 LIKE :status2 OR 
        telefone_celular LIKE :telefone_celular ) ";
    $searchArray = array( 
        'nome_cliente'=>"%$searchValue%", 
        'status_pg'=>"%$searchValue%",
        'status2'=>"%$searchValue%",
        'telefone_celular'=>"%$searchValue%"
    );
}

## Total number of records without filtering
$stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM clientes WHERE id_empresa='1362'");
$stmt->execute();
$records = $stmt->fetch();
$totalRecords = $records['allcount'];

## Total number of records with filtering
$stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM clientes WHERE 1 ".$searchQuery." AND id_empresa='1362'");
$stmt->execute($searchArray);
$records = $stmt->fetch();
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$stmt = $conn->prepare("SELECT * FROM clientes WHERE 1 ".$searchQuery." AND id_empresa='1362' ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

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
	
	$status = $row['status'];
	$id_cliente = $row['id_cliente'];
	$nome_cliente = $row['nome_cliente'];
	
	$data_v = date('Y-m-d');
	$data_v = date('Y-m-d', strtotime('-2 days', strtotime($data_v)));
	
	$cons_veic1 = mysqli_query($con,"SELECT * FROM veiculos_clientes WHERE id_cliente='$id_cliente' AND status='1'");
	$total_veic = mysqli_num_rows($cons_veic1);
	$veiculos = $total_veic.' Veículo(s)';
	
	$cons_status = mysqli_query($con,"SELECT * FROM status WHERE id_status='$status'");
		if(mysqli_num_rows($cons_status) > 0){
			while ($resp_status = mysqli_fetch_assoc($cons_status)) {
			$status_cliente = 	$resp_status['status'];
		}}
		
	$cons_contas = mysqli_query($con,"SELECT * FROM contas_receber WHERE descricao='$nome_cliente' AND status='Em Aberto' AND data_vencimento < '$data_v'");
	$total_c = mysqli_num_rows($cons_contas);
	
	if($total_c >= 1){
		$inform = '<span style="color:#990000" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="'.$total_c.' Fatura(s) em Aberto"><b><i class="fal fa-info-square"></i> '.$nome_cliente.'</b></span>';
	} 
	if($total_c <= 0){
		$inform = $nome_cliente;
	}
	
	if($status == 1){
		$status1 = '<h5><span class="badge" style="background-color:#009900; color:#FFF;">ATIVO</span></h5>';
	}
	if($status == 2){
		$status1 = '<h5><span class="badge" style="background-color:#CD5C5C;color:#FFF;">INATIVO/BLOQUEADO</span></h5>';
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
	
	$status3 = $status1.' '.$status2;
	
	$base64 = 'id_cliente:'.$id_cliente.'';
	$base64 = base64_encode($base64);
	

	
	$botao = '<a href="cad_cliente.php?c='.$base64.'"><button type="button" class="btn btn-dark btn-icon btn-sm" data-toggle="tooltip" title="Default tooltip"><i class="fab fa-elementor"></i></button></a>';
	
    $data[] = array(
            "nome_cliente"=>$inform,
            "telefone_celular"=>$row['telefone_celular'],
            "status"=>$status1,
            "veiculos"=>$veiculos,
            "email"=>$botao
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
