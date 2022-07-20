  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('conexao.php');


$id_cliente = 	$_REQUEST['id_cliente'];







$sql4 = mysqli_query($conn,"DELETE FROM usuarios WHERE id_cliente='$id_cliente'");
$sql1 = mysqli_query($conn,"DELETE FROM clientes WHERE id_cliente='$id_cliente'");
$sql1 = mysqli_query($conn,"DELETE FROM usuarios_push WHERE id_cliente='$id_cliente'");


header ('Location: clientes.php');












?>
