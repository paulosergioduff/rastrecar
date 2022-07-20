  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('conexao.php');


$data_delete = date('Y-m-d');
$id_parceiro = $_GET['id_parceiro'];



$sql = mysqli_query($conn, "DELETE FROM usuarios WHERE id_instalador='$id_instalador'");
$sql2 = mysqli_query($conn, "DELETE FROM parceiros WHERE id_parceiro='$id_parceiro'");





header('Location: instaladores.php');












?>
