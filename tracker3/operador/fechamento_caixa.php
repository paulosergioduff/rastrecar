  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('conexao.php');

$id_caixa = 	$_POST['id_caixa'];
$data_final = 	$_POST['data_final'];
$user_fim = 	$_POST['user_fim'];
$status	 = 	$_POST['status'];
$valor_final = 	$_POST['valor_final'];
$valor_final = str_replace(".","","$valor_final");
$valor_final = str_replace(",",".","$valor_final");




$sql = mysqli_query($conn, "UPDATE caixa SET data_final='$data_final', user_fim='$user_fim', status='$status', montante='$valor_final' WHERE id_caixa='$id_caixa'");









header('Location: relatorios_caixa.php?caixa=fechado&valor_caixa='.$valor_final.'');


?>
