  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('conexao.php');


$id = 	$_REQUEST['id'];
$id_usuarios = 	$_REQUEST['id_usuarios'];



$sql = mysqli_query($conn,"UPDATE usuarios SET senha='4badaee57fed5610012a296273158f5f' WHERE id_usuarios='$id_usuarios'");



$cons_user = mysqli_query($conn,"SELECT * FROM usuarios WHERE id_usuarios='$id_usuarios'");
if(mysqli_num_rows($cons_user) >= 1){
while ($result_user = mysqli_fetch_assoc($cons_user)) {
$nivel = $result_user['nivel'];
}}

if($nivel == 1){
	header('Location: editar_usuario_adm.php?id_usuarios='.$id_usuarios.'&p=usuarios&reset=ok');
}
if($nivel == 2){
	header('Location: editar_usuario_cli.php?id_usuarios='.$id_usuarios.'&p=usuarios&reset=ok');
}
if($nivel == 3){
	header('Location: editar_usuario_tec.php?id_usuarios='.$id_usuarios.'&p=usuarios&reset=ok');
}
if($nivel == 6){
	header('Location: editar_usuario_vend.php?id_usuarios='.$id_usuarios.'&p=usuarios&reset=ok');
}
if($nivel == 4){
	header('Location: editar_usuario_master.php?id_usuarios='.$id_usuarios.'&p=usuarios&reset=ok');
}

?>
