  <?php


include_once('../conexao.php');


$data_agora = date('Y-m-d H:i:s');
$data_agora = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_agora)));

$data_inicial_12 = date('Y-m-d H:i:s', strtotime('-5 minutes', strtotime($data_agora)));

	

$cont_veiculos = mysqli_query($conn,"SELECT * FROM tc_devices WHERE lastupdate < '$data_inicial_12' AND contact > '0'");
	if(mysqli_num_rows($cont_veiculos) > 0){
while ($resp_nfse = mysqli_fetch_assoc($cont_veiculos)) {
$deviceid	 = 	$resp_nfse['id'];

$cont_veiculos1 = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE deviceid = '$deviceid'");
	if(mysqli_num_rows($cont_veiculos1) > 0){
while ($resp_veic = mysqli_fetch_assoc($cont_veiculos1)) {
$operadora[]	 = 	$resp_veic['operadora'];

}}

}}
$total = array_count_values($operadora);

foreach($total as $key => $value){
	$operad = $key;
    $valor = $value;
	$despesas = array('categoria' => $key, 'valor' => $value);
	
	$json[] = $despesas;
}

echo json_encode($json, JSON_PRETTY_PRINT);





