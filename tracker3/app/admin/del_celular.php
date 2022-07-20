  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('conexao.php');

$date = date('Y-m-d');
$hora = date('H:i:s');
$user = $_POST['user_nome'];


$id_push = $_POST['id'];
$id_push_2 = $_POST['id_push'];

$sql = mysqli_query($conn, "DELETE FROM usuarios_push WHERE id_push='$id_push_2'");


header ('Location: celulares.php?id='.$id_push.'&app=on');


?>
