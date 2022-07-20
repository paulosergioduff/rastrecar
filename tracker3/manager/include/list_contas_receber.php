<?php
$server = "localhost";
$username = "root";
$password = "TR4vcijU6T9Keaw";
$dbname = "traccardb";

$con = mysqli_connect($server, $username, $password, $dbname);

$data_hoje = date('Y-m-d');
$data_inicial = date('Y-m-01');

$ult_dia = date("t");
$mes1 = date("m");
$data_final = date('Y-m-').$ult_dia;


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
	$searchQuery = " AND (descricao LIKE :descricao or 
        duplicata LIKE :duplicata OR data_vencimento LIKE :data_vencimento OR 
        valor_bruto LIKE :valor_bruto ) ";
    $searchArray = array( 
        'descricao'=>"%$searchValue%", 
        'duplicata'=>"%$searchValue%",
        'data_vencimento'=>"%$searchValue%",
        'valor_bruto'=>"%$searchValue%"
    );
}

## Total number of records without filtering
$stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM contas_receber WHERE data_vencimento >= '$data_inicial' AND data_vencimento <= '$data_final'");
$stmt->execute();
$records = $stmt->fetch();
$totalRecords = $records['allcount'];

## Total number of records with filtering
$stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM contas_receber WHERE 1 ".$searchQuery." AND (data_vencimento >= '$data_inicial' AND data_vencimento <= '$data_final')");
$stmt->execute($searchArray);
$records = $stmt->fetch();
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$stmt = $conn->prepare("SELECT * FROM contas_receber WHERE 1 ".$searchQuery." AND (data_vencimento >= '$data_inicial' AND data_vencimento <= '$data_final') ORDER BY data_vencimento DESC LIMIT :limit,:offset");

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
	

	$id_conta = $row['id_conta'];
	$descricao1 = $row['descricao'];

	$categoria = $row['categoria'];
	$duplicata = $row['duplicata'];
	$class_financeira = $row['class_financeira'];
	$data_emissao = $row['data_emissao'];
	$data_emissao1 = date('d/m/Y', strtotime("$data_emissao"));
	$data_vencimento = $row['data_vencimento'];
	$data_vencimento1 = date('d/m/Y', strtotime("$data_vencimento"));
	$banco = $row['banco'];
	$especie = $row['especie'];
	$valor_bruto = $row['valor_bruto'];
	$valor_bruto1 = number_format($valor_bruto, 2, ",", ".");
	$forma_pagamento_conta = $row['forma_pagamento'];
	$status_conta = $row['status'];
	$data_pagamento = $row['data_pagamento'];
	$valor_pago = $row['valor_pago'];
	$valor_pago1 = number_format($valor_pago, 2, ",", ".");
	
	
	if(strlen($descricao1) <= 20){
		$descricao = $descricao1;
	}
	if(strlen($descricao1) > 20){
		$descricao = substr($descricao1, 0, 20).'...';
	}
	
	$data_hj = date('Y-m-d');
	
	$d1 = strtotime($data_hoje); 
	$d2 = strtotime($data_vencimento);
	
	$dataFinal = ($d2 - $d1) /86400;
	
	if($dataFinal < 0)
	$dataFinal *= -1;
	
	if($status_conta == 'Em Aberto' && $data_vencimento < $data_hj){
		$status_conta1 = '<h5><span class="badge" style="background-color:#FF6347;color:#FFF">'.$dataFinal.' DIA(S) EM ATRASO</span></h5>';
		$botao_baixa = '<a href="baixar_conta_pagar.php?c='.$base_conta.'"><button type="button" class="btn btn-info"><i class="fal fa-download"></i> Baixar</button></a>';
		$cor = 'style="background-color:#EBD7D3"';
	}
	if($status_conta == 'Em Aberto' && $data_vencimento >= $data_hj){
		$status_conta1 = '<h5><span class="badge" style="background-color:#4682B4;color:#FFF">AGUAR. PGTO</span></h5>';
		$botao_baixa = '<a href="baixar_conta_pagar.php?c='.$base_conta.'"><button type="button" class="btn btn-info"><i class="fal fa-download"></i> Baixar</button></a>';
		$cor = '';
		
	}
	if($status_conta == 'Em Aberto' && $data_vencimento == $data_hj){
		
		$cor = 'style="background-color:#FFF8DC"';
	}
	if($status_conta == 'Pago'){
		$status_conta1 = '<h5><span class="badge" style="background-color:#009900;color:#FFF">PAGO</span></h5>';
		$botao_baixa = '';
		$cor = '';
	}
	
	$cons_especie = mysqli_query($con,"SELECT * FROM tipo_pagamento WHERE id_tipo='$especie'");
		if(mysqli_num_rows($cons_especie) > 0){
			while ($resp_especie = mysqli_fetch_assoc($cons_especie)) {
			$especie1	 = 	$resp_especie['tipo_pagamento'];
		}}
	
	$cons_banco = mysqli_query($con,"SELECT * FROM bancos WHERE id_banco='$banco'");
		if(mysqli_num_rows($cons_banco) > 0){
			while ($resp_banco = mysqli_fetch_assoc($cons_banco)) {
			$banco1	 = 	$resp_banco['nome_banco'];
		}}
	
	$cons_class = mysqli_query($con,"SELECT * FROM categorias_contas_receber WHERE id_categoria='$class_financeira'");
		if(mysqli_num_rows($cons_class) > 0){
			while ($resp_especie = mysqli_fetch_assoc($cons_class)) {
			$categoria	 = 	$resp_especie['categoria'];
			//$categoria = utf8_encode($categoria);
		}}
	
	if($status_conta == 'Em Aberto'){
		$data_pagamento1 = '';
	}
	
	if($status_conta == 'Pago'){
		$data_pagamento1 = date('d/m/Y', strtotime("$data_pagamento"));
	}
	
	if($id_recorrencia > 0){
		$recorrencia = 'SIM';
	}
	if($id_recorrencia == 0){
		$recorrencia = 'NÃO';
	}
	
	
	if($banco == 1){
		$banco_emissor = '<img src="/tracker2/Imagens/pjb.png" style="width:20px; heigth:17px"> PJ BANK';
		$link_excluir = 'delete_boleto_pjb.php?id_conta='.$id_conta.'&id_cliente='.$id_cliente.'&id_empresa='.$id_empresa.'&pag=contas';
		$botao_excluir = '<button type="button" class="btn1 btn1-danger btn-sm btn-icon1" data-toggle="modal" data-target="#excluir'.$id_conta.'" ><i class="fal fa-trash-alt"></i></button>';
	}
	if($banco == 5){
		$banco_emissor = '<img src="/tracker2/Imagens/asaas.jpg" style="width:20px; heigth:17px"> ASAAS';
		$link_excluir = 'delete_boleto_asaas.php?id_conta='.$id_conta.'&id_cliente='.$id_cliente.'&id_empresa='.$id_empresa.'&pag=contas';
		$botao_excluir = '<button type="button" class="btn1 btn1-danger btn-sm btn-icon1" data-toggle="modal" data-target="#excluir'.$id_conta.'" ><i class="fal fa-trash-alt"></i></button>';
	}
	if($banco == 7){
		$banco_emissor = '<i class="fas fa-cash-register"></i> CAIXA INTERNO';
		$link_excluir = 'delete_conta_receber.php?id_conta='.$id_conta.'&id_cliente='.$id_cliente.'&id_empresa='.$id_empresa.'&pag=contas';
		$botao_excluir = '<button type="button" class="btn1 btn1-danger btn-sm btn-icon1" data-toggle="modal" data-target="#excluir'.$id_conta.'" ><i class="fal fa-trash-alt"></i></button>';
	}

	if($banco == 1 && $status_conta == 'Em Aberto'){
		$botao_boleto = '<a href="'.$link_boleto.'" target="_blank"><button type="button" class="btn btn-primary btn-sm"><i class="fas fa-barcode-alt"></i> Imprimir Boleto</button></a>';
	}
	if($banco == 2 && $status_conta == 'Em Aberto'){
		$botao_boleto = '<a href="'.$link_boleto.'" target="_blank"><button type="button" class="btn btn-primary btn-sm"><i class="fas fa-barcode-alt"></i> Imprimir Boleto</button></a>';
	}
	
	if($especie == 2){
		$tipo = '<i class="fal fa-barcode-alt"></i> Boleto';
	}
	if($especie == 13){
		$tipo = '<i class="fal fa-credit-card"></i> Cartão de Crédito';
	}

	
	$base64 = 'id_conta:'.$id_conta.'';
	$base64 = base64_encode($base64);
	
	$valor_bruto1 = 'R$ '.$valor_bruto1;

	
	$botao = '<a href="view_conta_receber.php?c='.$base64.'"><button type="button" class="btn btn-dark btn-icon btn-sm" data-toggle="tooltip" title="Default tooltip"><i class="fab fa-elementor"></i></button></a>';
	
    $data[] = array(
            "duplicata"=>$duplicata,
            "descricao"=>$descricao,
            "data_vencimento"=>$data_vencimento1,
            "valor_bruto"=>$valor_bruto1,
            "banco"=>$banco_emissor,
            "tipo"=>$tipo,
            "status_conta1"=>$status_conta1,
            "data_pagamento"=>$data_pagamento1,
            "botao"=>$botao
			
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
