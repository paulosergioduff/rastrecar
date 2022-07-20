  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('conexao.php');

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
$id_instalador = 	$_POST['customer_sales'];

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
$senha1 = $_POST['senha'];
$id_empresa = $_POST['customer_fact'];
$login_padrao = $_POST['customer_name'];
$usuario = $usuario.'@'.$login_padrao;
$senha = md5($senha1);

$nivel = 5;
$status_instalador = $_POST['status_instalador'];

if($status_instalador == 'SIM'){
	$ativo = 'SIM';
	$status = '1';
}
if($status_instalador != 'SIM'){
	$ativo = 'NAO';
	$status = '2';
}

if($senha1 == ''){
	$sql_user = "UPDATE usuarios SET nome='$nome_instalador', email='$email', usuario='$usuario', ativo='$ativo' WHERE id_instalador='$id_instalador'";
	
	if (mysqli_query($conn, $sql_user)) {
		  echo "New record created successfully";
	} else {
		  echo "Error OS: " . $sql_user . "<br>" . mysqli_error($conn);
	}
}
if($senha1 != ''){
	$sql_user = mysqli_query($conn, "UPDATE usuarios SET nome='$nome_instalador', email='$email', usuario='$usuario', senha='$senha', ativo='$ativo' WHERE id_instalador='$id_instalador'");
}



$sql = "UPDATE instaladores SET nome_parceiro='$nome_instalador', documento='$doc_instalador', cep='$cep', endereco='$endereco', numero='$numero', bairro='$bairro', cidade='$cidade', estado='$estado', celular='$telefone_celular', email='$email', vlr_inst_bloqueio='$vlr_inst_bloqueio', vlr_inst='$vlr_inst', vlr_manutencao='$vlr_manutencao', vlr_retirada='$vlr_retirada', status='$status' WHERE id_parceiro = '$id_instalador'";

	if (mysqli_query($conn, $sql)) {
		  echo "New record created successfully";
	} else {
		  echo "Error OS: " . $sql . "<br>" . mysqli_error($conn);
	}







header('Location: instaladores.php');


?>
