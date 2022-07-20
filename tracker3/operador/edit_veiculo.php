  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('conexao.php');

$id_cliente = 	$_POST['id_cliente'];
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
$nome_veiculo = $placa.' - '.$marca_veiculo.'/'.$modelo_veiculo;


$sql_veiculo_novo = mysqli_query($conn, "UPDATE veiculos_clientes SET status='$status1', id_cliente='$id_cliente', marca_veiculo='$marca_veiculo', tipo_veiculo='$tipo_veiculo', modelo_veiculo='$modelo_veiculo', ano_veiculo='$ano_veiculo', ano_modelo='$ano_modelo', placa='$placa', renavan='$renavan', chassi='$chassi', combustivel='$combustivel', cor_veiculo='$cor_veiculo' WHERE id_veiculo='$id_veiculo'");


$base64 = 'id_cliente:'.$id_cliente.'';
$base64 = base64_encode($base64);


header('Location: cad_cliente_veiculos.php?c='.$base64.'');





?>
