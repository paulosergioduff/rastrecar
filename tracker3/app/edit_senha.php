  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('conexao.php');

$date = date('Y-m-d');
$hora = date('H:i:s');
$user = $_POST['user_nome'];


$id_push = $_POST['id_push'];
$senha = $_POST['senha'];
$senha = md5($senha);
$nova_senha = $_POST['nova_senha'];
$nova_senha = md5($nova_senha);
$id_usuarios = $_POST['id_usuarios'];


  $cons_user1 = mysqli_query($conn,"SELECT * FROM usuarios WHERE id_usuarios='$id_usuarios' ");
	if(mysqli_num_rows($cons_user1) > 0){
		while ($resp_user1 = mysqli_fetch_assoc($cons_user1)) {
		$senha_atual = 	$resp_user1['senha'];

	}}	

if($senha != $senha_atual){
	header('Location: alterar_senha.php?id='.$id_push.'&app=on&error=error');
}

if($senha == $senha_atual){
	$sql = mysqli_query($conn, "UPDATE usuarios SET senha='$nova_senha' WHERE id_usuarios='$id_usuarios'");
	header ('Location: index.php?id='.$id_push.'&app=on');
}










?>
