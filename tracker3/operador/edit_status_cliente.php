  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('conexao.php');

$date = date('Y-m-d');
$hora = date('H:i:s');
$status = 	$_POST['status'];
$id_cliente = 	$_POST['id_cliente'];
$user = 	$_POST['user'];
$informacao = 	$_POST['informacao'];

$sql11 = mysqli_query($conn,"INSERT INTO crm (id_cliente, info, tipo_crm, data,  hora, user) VALUES ('$id_cliente', '$informacao', 'Outros', '$date', '$hora', '$user')");

if($status == '4'){
	$sql = mysqli_query($conn,"UPDATE clientes SET status='$status' WHERE id_cliente='$id_cliente'");
	$sql2 = mysqli_query($conn,"UPDATE veiculos_clientes SET status='$status' WHERE id_cliente='$id_cliente' AND status='1'");
	$sql3 = mysqli_query($conn,"UPDATE clientes_contratos SET status='$status' WHERE id_cliente='$id_cliente' AND status='1'");
	$sql4 = mysqli_query($conn, "DELETE FROM usuarios_push WHERE id_cliente='$id_cliente'");
	$sql5 = mysqli_query($conn, "DELETE FROM usuarios WHERE id_cliente='$id_cliente'");
} else if($status == '5'){
	$sql = mysqli_query($conn,"UPDATE clientes SET status='$status' WHERE id_cliente='$id_cliente'");
	$sql2 = mysqli_query($conn,"UPDATE veiculos_clientes SET status='$status' WHERE id_cliente='$id_cliente' AND status='1'");
	$sql3 = mysqli_query($conn,"UPDATE clientes_contratos SET status='$status' WHERE id_cliente='$id_cliente' AND status='1'");
	$sql4 = mysqli_query($conn, "DELETE FROM usuarios_push WHERE id_cliente='$id_cliente'");
	$sql5 = mysqli_query($conn, "DELETE FROM usuarios WHERE id_cliente='$id_cliente'");

} else {
	$sql = mysqli_query($conn,"UPDATE clientes SET status='$status' WHERE id_cliente='$id_cliente'");
}

$base64 = 'id_cliente:'.$id_cliente;
$base64 = base64_encode($base64);


header('Location: cad_cliente.php?c='.$base64.''); 








?>
