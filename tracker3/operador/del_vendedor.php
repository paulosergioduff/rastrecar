  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('conexao.php');


$data_delete = date('Y-m-d');
$id_vendedor = $_GET['id_vendedor'];



$sql = mysqli_query($conn, "DELETE FROM usuarios WHERE id_vendedor='$id_vendedor'");
$sql2 = mysqli_query($conn, "DELETE FROM vendedores WHERE id_vendedor='$id_vendedor'");





header('Location: vendedores.php');












?>
