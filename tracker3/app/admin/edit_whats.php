  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('conexao.php');

$date = date('Y-m-d');
$hora = date('H:i:s');
$user = $_POST['user_nome'];


$id_push = $_POST['id_push'];

$id_usuarios = $_POST['id_usuarios'];
$alerta_whats = $_POST['alerta_whats'];

if($alerta_whats == ''){
	$alerta_whats1 = 'NAO';
	
} else {
	$alerta_whats1 = $alerta_whats;
}


$cons_user1 = mysqli_query($conn,"SELECT * FROM usuarios_push WHERE id_push='$id_push' ");
			if(mysqli_num_rows($cons_user1) > 0){
				while ($resp_user1 = mysqli_fetch_assoc($cons_user1)) {
				$tipo = 	$resp_user1['tipo'];
				$id_cliente = $resp_user1['id_cliente'];
				$id_usuarios = $resp_user1['id_usuarios'];
				
			}}


$sql = mysqli_query($conn, "UPDATE usuarios SET alertas_whats='$alerta_whats1' WHERE id_usuarios='$id_usuarios'");
$sql1 = mysqli_query($conn, "UPDATE clientes SET alertas_whats='$alerta_whats1' WHERE id_cliente='$id_cliente'");

header ('Location: index.php?id='.$id_push.'&app=on');










?>
