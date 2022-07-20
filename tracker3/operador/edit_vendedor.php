  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('conexao.php');

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
$id_vendedor = 	$_POST['customer_sales'];
$tipo_fixa = $_POST['tipo_fixa'];
$comissao_fixa = $_POST['comissao_fixa'];
$comissao_fixa = str_replace(".","","$comissao_fixa");
$comissao_fixa = str_replace(",",".","$comissao_fixa");
$tipo_recorrente = $_POST['tipo_recorrente'];
$comissao_recorrente = $_POST['comissao_recorrente'];
$comissao_recorrente = str_replace(".","","$comissao_recorrente");
$comissao_recorrente = str_replace(",",".","$comissao_recorrente");

$usuario = $_POST['usuario'];
$senha1 = $_POST['senha'];
$id_empresa = $_POST['customer_fact'];
$login_padrao = $_POST['customer_name'];
$usuario = $usuario.'@jcrastreamento';
$senha = md5($senha1);

$nivel = 5;
$status_vendedor = $_POST['status_vendedor'];

if($status_vendedor == 'SIM'){
	$ativo = 'SIM';
	$status = '1';
}
if($status_vendedor != 'SIM'){
	$ativo = 'NAO';
	$status = '2';
}

if($senha1 == ''){
	$sql_user = "UPDATE usuarios SET nome='$nome_vendedor', id_vendedor='$id_vendedor', email='$email', usuario='$usuario', ativo='$ativo' WHERE id_vendedor='$id_vendedor'";
	
	if (mysqli_query($conn, $sql_user)) {
		  echo "New record created successfully";
	} else {
		  echo "Error OS: " . $sql_user . "<br>" . mysqli_error($conn);
	}
}
if($senha1 != ''){
	$sql_user = mysqli_query($conn, "UPDATE usuarios SET nome='$nome_vendedor', nivel='$nivel' id_vendedor='$id_vendedor', email='$email', usuario='$usuario', senha='$senha', ativo='$ativo' WHERE id_vendedor='$id_vendedor'");
}



$sql = "UPDATE vendedores SET nome_vendedor='$nome_vendedor', doc_vendedor='$doc_vendedor', cep='$cep', endereco='$endereco', numero='$numero', bairro='$bairro', cidade='$cidade', estado='$estado', telefone_celular='$telefone_celular', email='$email', tipo_fixa='$tipo_fixa', comissao_fixa='$comissao_fixa', tipo_recorrente='$tipo_recorrente', comissao_recorrente='$comissao_recorrente', status='$status' WHERE id_vendedor = '$id_vendedor'";

	if (mysqli_query($conn, $sql)) {
		  echo "New record created successfully";
	} else {
		  echo "Error OS: " . $sql . "<br>" . mysqli_error($conn);
	}







header('Location: vendedores.php');


?>
