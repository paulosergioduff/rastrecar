  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('conexao.php');


$id_usuarios = 	$_POST['id_usuarios'];
$telefone	 = 	$_POST['telefone_celular'];
$email	 = 	$_POST['email'];
$ativo	 = 	$_POST['ativo'];
$senha	 = 	$_POST['senha'];
$senha1 = md5($senha);

$bloqueio = $_POST['bloqueio'];
if($bloqueio != 'SIM'){
	$permite_bloqueio = 'NAO';
}
if($bloqueio == 'SIM'){
	$permite_bloqueio = 'SIM';
}

if($senha != ''){
	$sql = mysqli_query($conn, "UPDATE usuarios SET email='$email', telefone='$telefone', permite_bloqueio='$permite_bloqueio', senha='$senha' WHERE id_usuarios='$id_usuarios'");
}
if($senha == ''){
	$sql = mysqli_query($conn, "UPDATE usuarios SET email='$email', telefone='$telefone', permite_bloqueio='$permite_bloqueio' WHERE id_usuarios='$id_usuarios'");
}

#-------------------------------------------------
#-------------------------------------------------


$veiculos1 = 	$_POST['veiculos'];
//$veiculos1[] = $veiculos1;
$veiculos = implode(",",$veiculos1);

$veiculos = str_replace(',Array', '', $veiculos);



$sql = mysqli_query($conn,"UPDATE usuarios SET veiculos='$veiculos' WHERE id_usuarios='$id_usuarios'");



	

$base_user = 'id_usuarios:'.$id_usuarios;
$base_user = base64_encode($base_user);



header('Location: editar_usuario_master.php?c='.$base_user.'');








?>
