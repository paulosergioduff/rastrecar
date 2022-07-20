  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('conexao.php');


$id = 	$_REQUEST['id'];
$id_usuarios = 	$_REQUEST['id_usuarios'];







$sql = mysqli_query($conn,"DELETE FROM usuarios WHERE id_usuarios='$id_usuarios'");


header('Location: usuarios.php');

?>
