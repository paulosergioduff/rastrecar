  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('../conexao.php');


$user_inicio = 	$_POST['user_inicio'];
$pacote	 = 	$_POST['pacote'];
$valor = 	$_POST['valor'];
$valor = str_replace(".","","$valor");
$valor = str_replace(",",".","$valor");





$sql = mysqli_query($conn, "INSERT INTO pacotes (pacote, valor) VALUES ('$pacote', '$valor')");









header('Location: ../pacotes.php');


?>
