  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('conexao.php');


$id_pacote	 = 	$_POST['id_pacote'];
$pacote	 = 	$_POST['pacote'];
$valor = 	$_POST['valor'];
$valor = str_replace(".","","$valor");
$valor = str_replace(",",".","$valor");





$sql = mysqli_query($conn, "UPDATE pacotes SET pacote='$pacote', valor='$valor' WHERE id_pacote='$id_pacote'");









header('Location: pacotes.php');


?>
