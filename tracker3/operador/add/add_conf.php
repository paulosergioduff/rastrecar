  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('conexao.php');

$id_empresa = 	$_POST['id_empresa'];
$cor_sistema = 	$_POST['cor_sistema'];
$arquivo = 	$_POST['arquivo'];

echo $cor_sistema;



//$sql = mysqli_query($conn, "INSERT INTO caixa (data, data_inicial, user_inicio, status,  valor_inicial, id_empresa) VALUES ('$data', '$data_inicial', '$user_inicio', '$status',  '$valor_inicial', '$id_empresa')");









//header('Location: ../relatorios_caixa.php?caixa=ok&valor_caixa='.$valor_inicial.'');


?>
