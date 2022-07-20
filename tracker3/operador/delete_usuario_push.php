  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('conexao.php');


$id_push = 	$_REQUEST['id_push'];
$id_cliente = 	$_REQUEST['id_cliente'];




$base64 = 'id_cliente:'.$id_cliente;
$base64 = base64_encode($base64);


$sql = mysqli_query($conn,"DELETE FROM usuarios_push WHERE id_push='$id_push'");


header('Location: cad_cliente.php?c='.$base64.'');

?>
