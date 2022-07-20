  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('../conexao.php');

$data = date('Y-m-d');
$hora = date('H:i:s');

$deviceid = 	$_POST['deviceid20'];
$user_nome = 	$_POST['user_nome'];
$tipo	 = 	$_POST['tipo'];
$data_trat = date('Y-m-d H:i:s');
$titulo = 	$_POST['titulo'];
$descricao = 	$_POST['descricao'];
$time = 	$_POST['time'];
$id_cliente = 	$_POST['id_cliente'];
$id_veiculo = 	$_POST['id_veiculo'];

$result_usuario = mysqli_query($conn, "SELECT * FROM veiculos_clientes WHERE id_veiculo='$id_veiculo'");
if(mysqli_num_rows($result_usuario) >0){
	while($row_usuario = mysqli_fetch_assoc($result_usuario)){
	$id_cliente = $row_usuario['id_cliente'];
	$id_veiculo = $row_usuario['id_veiculo'];
	$placa = $row_usuario['placa'];
	$modelo_veiculo = $row_usuario['modelo_veiculo'];
	$marca_veiculo = $row_usuario['marca_veiculo'];
	$modelo_equip = $row_usuario['modelo_equip'];
	$chip = $row_usuario['chip'];
	$imei = $row_usuario['imei'];
	$operadora = $row_usuario['operadora'];
	$fornecedor_chip = $row_usuario['fornecedor_chip'];
	$veiculo = $placa.' - '.$modelo_veiculo.'/'.$marca_veiculo;
}}

$descricao_crm = $descricao.' - '.$veiculo;


$sql = mysqli_query($conn, "INSERT INTO tratativas (deviceid, id_cliente, data_trat, titulo, descricao, user_trat) VALUES ('$deviceid', '$id_cliente', '$data_trat', '$titulo', '$descricao', '$user_nome')");

$sql1 = mysqli_query($conn, "INSERT INTO crm (tipo_crm, id_cliente, id_veiculo, data, hora, user, info) VALUES ('$titulo', '$id_cliente', '$id_veiculo', '$data',  '$hora', '$user_nome', '$descricao_crm')");







header('Location: ../veiculos_offline.php?time='.$time.'');


?>
