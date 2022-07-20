  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('conexao.php');

$nome_cliente = 	$_POST['nome_cliente'];
$nome_cliente = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$nome_cliente);
$nome_cliente = strtoupper($nome_cliente);
$doc_cliente = 	$_POST['doc_cliente'];
$rg_cliente	 = 	$_POST['rg_cliente'];
$data_nascimento = 	$_POST['data_nascimento'];
$data_nascimento = substr($data_nascimento,6,4) . "-" . substr($data_nascimento,3,2) . "-" . substr($data_nascimento,0,2);
$cep = 	$_POST['cep'];
$endereco = 	$_POST['endereco'];
$endereco = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$endereco);
$endereco = strtoupper($endereco);
$numero = 	$_POST['numero'];
$complemento = 	$_POST['complemento'];
$bairro = 	$_POST['bairro'];
$bairro = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$bairro);
$bairro = strtoupper($bairro);
$cidade = 	$_POST['cidade'];
$cidade = strtoupper($cidade);
$cidade = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$cidade);
$estado = 	$_POST['estado'];
$estado = strtoupper($estado);
$telefone_residencial = 	$_POST['telefone_residencial'];
$telefone_celular = 	$_POST['telefone_celular'];
$telefone_outros = 	$_POST['telefone_outros'];
$data_cadastro = 	date('Y-m-d');
$email = 	$_POST['email'];
$vendedor = $_POST['vendedor'];
$senha_atendimento = $_POST['senha_atendimento'];
$dias_bloqueio = $_POST['dias_bloqueio'];
$id_cliente = $_POST['id_cliente'];
$id_cliente_pai = $_POST['id_cliente_pai'];





$sql = mysqli_query($conn, "UPDATE clientes SET nome_cliente='$nome_cliente', doc_cliente='$doc_cliente', rg_cliente='$rg_cliente',  data_nascimento='$data_nascimento', cep='$cep', endereco='$endereco', numero='$numero', complemento='$complemento', bairro='$bairro', cidade='$cidade', estado='$estado', telefone_residencial='$telefone_residencial', telefone_celular='$telefone_celular', telefone_outros='$telefone_outros', data_cadastro='$data_cadastro', email='$email', vendedor='$vendedor', senha_atendimento='$senha_atendimento', dias_bloqueio='$dias_bloqueio', id_cliente_pai='$id_cliente_pai' WHERE id_cliente='$id_cliente'");




$base64 = 'id_cliente:'.$id_cliente.'';
$base64 = base64_encode($base64);








header('Location: cad_cliente.php?c='.$base64.'');


?>
