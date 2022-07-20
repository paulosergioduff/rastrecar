  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('../conexao.php');

$nome_vendedor = 	$_POST['nome_vendedor'];
$nome_vendedor = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$nome_vendedor);
$nome_vendedor = strtoupper($nome_vendedor);
$doc_vendedor = 	$_POST['doc_vendedor'];
$cep = 	$_POST['cep'];
$endereco = 	$_POST['endereco'];
$endereco = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$endereco);
$endereco = strtoupper($endereco);
$numero = 	$_POST['numero'];
$bairro = 	$_POST['bairro'];
$bairro = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$bairro);
$bairro = strtoupper($bairro);
$cidade = 	$_POST['cidade'];
$cidade = strtoupper($cidade);
$cidade = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$cidade);
$estado = 	$_POST['estado'];
$estado = strtoupper($estado);
$telefone_celular = 	$_POST['telefone_celular'];
$data_cadastro = 	date('Y-m-d');
$email = 	$_POST['email'];
$status = 	$_POST['status'];
$tipo_fixa = $_POST['tipo_fixa'];
$comissao_fixa = $_POST['comissao_fixa'];
$comissao_fixa = str_replace(".","","$comissao_fixa");
$comissao_fixa = str_replace(",",".","$comissao_fixa");
$tipo_recorrente = $_POST['tipo_recorrente'];
$comissao_recorrente = $_POST['comissao_recorrente'];
$comissao_recorrente = str_replace(".","","$comissao_recorrente");
$comissao_recorrente = str_replace(",",".","$comissao_recorrente");

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
$id_empresa = $_POST['customer_fact'];
$login_padrao = $_POST['customer_name'];
$usuario = $usuario.'@jcrastreamento';
$senha = md5($senha);

$nivel = 4;
$ativo = 'SIM';
$tipo_user = 'VENDEDOR';



$sql = mysqli_query($conn, "INSERT INTO vendedores (nome_vendedor, doc_vendedor, cep, endereco, numero, bairro, cidade, estado, telefone_celular, data_cadastro, email, tipo_fixa, comissao_fixa, tipo_recorrente, comissao_recorrente, id_empresa) VALUES ('$nome_vendedor', '$doc_vendedor', '$cep', '$endereco', '$numero', '$bairro', '$cidade', '$estado',  '$telefone_celular', '$data_cadastro', '$email', '$tipo_fixa', '$comissao_fixa', '$tipo_recorrente', '$comissao_recorrente', '$id_empresa')");


$cons_vendedor = mysqli_query($conn,"SELECT * FROM vendedores WHERE id_empresa='$id_empresa' ORDER BY id_vendedor DESC LIMIT 1");
	if(mysqli_num_rows($cons_vendedor) > 0){
while ($result = mysqli_fetch_assoc($cons_vendedor)) {
	$id_vendedor = $result['id_vendedor'];
}}


$sql_user = mysqli_query($conn, "INSERT INTO usuarios (nome, id_empresa, id_vendedor, email, usuario, senha, nivel, ativo, cargo) VALUES ('$nome_vendedor', '$id_empresa', '$id_vendedor', '$email', '$usuario', '$senha', '$nivel', '$ativo', '$tipo_user')");




header('Location: ../vendedores.php');


?>
