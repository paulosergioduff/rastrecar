  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('conexao.php');


$data_delete = date('Y-m-d');
$id_carne = $_GET['id_carne'];
$id_cliente = $_GET['id_cliente'];
$local =  $_GET['local'];


$sql = mysqli_query($conn, "DELETE FROM carnes WHERE id_carne='$id_carne'");


header('Location: carnes.php');











?>
