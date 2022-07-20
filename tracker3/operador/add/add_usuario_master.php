  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('../conexao.php');


$nome = 	$_POST['nome'];
$telefone = 	$_POST['telefone_celular'];
$usuario = 	$_POST['usuario'];
$usuario = ''.$usuario.'@jcrastreamento';
$nivel	 = '5';
$email	 = 	$_POST['email'];
$ativo	 = 	$_POST['ativo'];
$cargo	 = 	'Master';
$senha	 = 	$_POST['senha'];
$senha = md5($senha);

$bloqueio = $_POST['bloqueio'];
if($bloqueio != 'SIM'){
	$permite_bloqueio = 'NAO';
}
if($bloqueio == 'SIM'){
	$permite_bloqueio = 'SIM';
}

$sql = mysqli_query($conn, "INSERT INTO usuarios (nome, usuario, nivel, id_cliente, email, ativo, cargo, senha, permite_bloqueio, telefone) VALUES ('$nome', '$usuario', '$nivel', '0', '$email', '$ativo', '$cargo', '$senha', '$permite_bloqueio', '$telefone')");


$cons_user = mysqli_query($conn,"SELECT * FROM usuarios WHERE usuario='$usuario'");
	if(mysqli_num_rows($cons_user) > 0){
while ($resp_user = mysqli_fetch_assoc($cons_user)) {
$id_usuarios = 	$resp_user['id_usuarios'];
	}}

#-------------------------------------------------
#-------------------------------------------------



$veiculos1 = 	$_POST['veiculos'];
//$veiculos1[] = $veiculos1;
$veiculos = implode(",",$veiculos1);

$veiculos = str_replace(',Array', '', $veiculos);



$sql = mysqli_query($conn,"UPDATE usuarios SET veiculos='$veiculos' WHERE id_usuarios='$id_usuarios'");
	





header('Location: ../usuarios.php');








?>
