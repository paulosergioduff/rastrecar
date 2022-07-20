  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('../conexao.php');

$nome_fornecedor = 	$_REQUEST['nome_fornecedor'];
$doc_fornecedor = 	$_REQUEST['doc_fornecedor'];
$telefone_comercial = 	$_REQUEST['telefone_comercial'];
$id_empresa = 	$_REQUEST['customer_emp'];

$nome_fornecedor = strtoupper($nome_fornecedor);





$sql = mysqli_query($conn, "INSERT INTO fornecedores (nome_fornecedor, doc_fornecedor, telefone_comercial) VALUES ('$nome_fornecedor', '$doc_fornecedor', '$telefone_comercial')");


$cons_pacote = mysqli_query($conn,"SELECT * FROM fornecedores ORDER BY id_fornecedor DESC LIMIT 1");
if(mysqli_num_rows($cons_pacote) > 0){
while ($res = mysqli_fetch_assoc($cons_pacote)) {
$id_fornecedor = $res['id_fornecedor'];
$nome_fornecedor1 = $res['nome_fornecedor'];
echo $id_fornecedor;
}}


?>
