  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('conexao.php');


$data_delete = date('Y-m-d');
$id_recorrencia = $_GET['c'];


	
	$sql = mysqli_query($conn, "UPDATE recorrencia SET ativo='NAO', id_repay='0', data_termino='$data_delete' WHERE id_recorrencia='$id_recorrencia'");
	$sql2 = mysqli_query($conn, "UPDATE veiculos_clientes SET recorrencia='NAO', id_recorrencia='0' WHERE id_recorrencia='$id_recorrencia'");


header('Location: recorrencias.php');














?>
