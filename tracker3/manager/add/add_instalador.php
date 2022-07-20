  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('../conexao.php');

$nome_instalador = 	$_POST['nome_instalador'];
$nome_instalador = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$nome_instalador);
$nome_instalador = strtoupper($nome_instalador);
$doc_instalador = 	$_POST['doc_instalador'];
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

$vlr_inst_bloqueio = $_POST['vlr_inst_bloqueio'];
$vlr_inst_bloqueio = str_replace(".","","$vlr_inst_bloqueio");
$vlr_inst_bloqueio = str_replace(",",".","$vlr_inst_bloqueio");

$vlr_inst = $_POST['vlr_inst'];
$vlr_inst = str_replace(".","","$vlr_inst");
$vlr_inst = str_replace(",",".","$vlr_inst");

$vlr_manutencao = $_POST['vlr_manutencao'];
$vlr_manutencao = str_replace(".","","$vlr_manutencao");
$vlr_manutencao = str_replace(",",".","$vlr_manutencao");

$vlr_retirada = $_POST['vlr_retirada'];
$vlr_retirada = str_replace(".","","$vlr_retirada");
$vlr_retirada = str_replace(",",".","$vlr_retirada");

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
$id_empresa = '1361';
$login_padrao = $_POST['customer_name'];
$usuario = $usuario.'@jcrastreamento';
$senha = md5($senha);

$nivel = 6;
$ativo = 'SIM';
$status = '1';
$tipo_user = 'TECNICO';



$sql = mysqli_query($conn, "INSERT INTO parceiros (nome_parceiro, documento, cep, endereco, numero, bairro, cidade, estado, celular, data_cadastro, email, vlr_inst_bloqueio, vlr_inst, vlr_manutencao, vlr_retirada, id_empresa, status) VALUES ('$nome_instalador', '$doc_instalador', '$cep', '$endereco', '$numero', '$bairro', '$cidade', '$estado',  '$telefone_celular', '$data_cadastro', '$email', '$vlr_inst_bloqueio', '$vlr_inst', '$vlr_manutencao', '$vlr_retirada', '$id_empresa', '$status')");


$cons_vendedor = mysqli_query($conn,"SELECT * FROM parceiros WHERE id_empresa='$id_empresa' ORDER BY id_instalador DESC LIMIT 1");
	if(mysqli_num_rows($cons_vendedor) > 0){
while ($result = mysqli_fetch_assoc($cons_vendedor)) {
	$id_instalador = $result['id_instalador'];
}}


$sql_user = mysqli_query($conn, "INSERT INTO usuarios (nome, id_empresa, id_instalador, email, usuario, senha, nivel, ativo, tipo_user) VALUES ('$nome_instalador', '$id_empresa', '$id_instalador', '$email', '$usuario', '$senha', '$nivel', '$ativo', '$tipo_user')");




header('Location: ../instaladores.php');


?>
