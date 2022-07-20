  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('conexao.php');


$data_delete = date('Y-m-d');
$id_usuarios = $_GET['id_usuarios'];
$id_cliente = $_GET['id_cliente'];
$local =  $_GET['local'];


$sql = mysqli_query($conn, "DELETE FROM usuarios WHERE id_usuarios='$id_usuarios'");


if($local == 'cad'){

$base64 = 'id_cliente:'.$id_cliente.'';
$base64 = base64_encode($base64);

header('Location: cad_cliente.php?c='.$base64.'');
}











?>
