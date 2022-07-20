  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('../conexao.php');

$categoria = 	$_REQUEST['categoria'];
$id_empresa = 	$_REQUEST['id_empresa'];

$categoria = ucfirst($categoria);
$categoria = ucfirst(strtolower($categoria));




$sql = mysqli_query($conn, "INSERT INTO categorias_contas_pagar (categoria) VALUES ('$categoria')");


$cons_pacote = mysqli_query($conn,"SELECT * FROM categorias_contas_pagar ORDER BY categoria DESC LIMIT 1");
if(mysqli_num_rows($cons_pacote) > 0){
while ($res = mysqli_fetch_assoc($cons_pacote)) {
$id_categoria = $res['id_categoria'];
$categoria = $res['categoria'];
echo $id_categoria;
}}


?>
