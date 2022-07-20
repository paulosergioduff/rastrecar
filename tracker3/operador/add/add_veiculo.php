  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('../conexao.php');

$id_cliente_pai = 	$_POST['id_cliente_pai'];
$id_cliente = 	$_POST['id_cliente'];
$id_empresa = 	'1361';
$data_cadastro = date('Y-m-d');

$base64 = 'id_cliente:'.$id_cliente.'';
$base64 = base64_encode($base64);

//DADOS DO VEICULO
$vendedor = 	$_POST['vendedor'];
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
$status = '1';



$sql_veiculo = mysqli_query($conn, "INSERT INTO veiculos_clientes (data_cadastro, status, id_cliente, id_empresa, marca_veiculo, tipo_veiculo, modelo_veiculo, ano_veiculo, ano_modelo, placa, renavan, chassi, combustivel, cor_veiculo, id_cliente_pai) VALUES ('$data_cadastro', '$status', '$id_cliente', '$id_empresa', '$marca_veiculo', '$tipo_veiculo', '$modelo_veiculo', '$ano_veiculo', '$ano_modelo', '$placa', '$renavan', '$chassi', '$combustivel', '$cor_veiculo', '$id_cliente_pai')");
	
header('Location: ../cad_cliente_veiculos.php?c='.$base64.'');








?>
