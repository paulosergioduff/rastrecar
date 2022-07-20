  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('conexao.php');

$id_empresa = 	$_POST['id_empresa'];
$data_inicial = 	$_POST['data_inicial'];
$user_inicio = 	$_POST['user_inicio'];
$status	 = 	$_POST['status'];
$valor_inicial = 	$_POST['valor_inicial'];
$valor_inicial = str_replace(".","","$valor_inicial");
$valor_inicial = str_replace(",",".","$valor_inicial");
$data = date('Y-m-d');




$sql = mysqli_query($conn, "INSERT INTO caixa (data, data_inicial, user_inicio, status,  valor_inicial, id_empresa) VALUES ('$data', '$data_inicial', '$user_inicio', '$status',  '$valor_inicial', '$id_empresa')");









header('Location: ../relatorios_caixa.php?caixa=ok&valor_caixa='.$valor_inicial.'');


?>
