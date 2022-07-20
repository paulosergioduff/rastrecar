  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('conexao.php');

$date = date('Y-m-d');
$hora = date('H:i:s');
$user = $_POST['user_nome'];


$id_push = $_REQUEST['id'];

$id_usuarios = $_REQUEST['id_usuarios'];
$alerta = $_REQUEST['alerta'];




$cons_user1 = mysqli_query($conn,"SELECT * FROM usuarios_push WHERE id_push='$id_push' ");
			if(mysqli_num_rows($cons_user1) > 0){
				while ($resp_user1 = mysqli_fetch_assoc($cons_user1)) {
				$tipo = 	$resp_user1['tipo'];
				$id_cliente = $resp_user1['id_cliente'];
				
			}}


$sql = mysqli_query($conn, "UPDATE usuarios SET alertas_whats='$alerta' WHERE id_usuarios='$id_usuarios'");
$sql1 = mysqli_query($conn, "UPDATE clientes SET alertas_whats='$alerta' WHERE id_cliente='$id_cliente'");

//header('Location: perfil.php?id='.$id_push.'&alerta='.$alerta.'');


echo '<script>
		top.location="perfil.php?id='.$id_push.'&alerta='.$alerta.'"
	  </script>';







?>
