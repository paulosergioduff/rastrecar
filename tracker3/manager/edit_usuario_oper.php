  <?php

include_once('conexao.php');

$id_usuarios = 	$_POST['id_usuarios'];
$id_empresa = 	$_POST['customer_fact'];
$id_cliente = 	$_POST['id_cliente'];
$nome = 	$_POST['nome'];
$usuario1 = 	$_POST['usuario'];
$usuario = ''.$usuario1.'@rmb';
$nivel	 = '5';
$email	 = 	$_POST['email'];
$ativo	 = 	$_POST['ativo'];
$acesso	 = 	$_POST['acesso'];
$cargo	 = 	'Operador';
$senha	 = 	$_POST['senha'];
$senha = md5($senha);

$subdominio = strtolower($usuario1);

$equipamentos = 	$_POST['equipamentos'];
$usuarios = 	$_POST['usuarios'];
$instaladores = 	$_POST['instaladores'];


if($equipamentos == 'SIM'){
	$equipamentos1 = 'SIM';
}
if($equipamentos != 'SIM'){
	$equipamentos1 = 'NAO';
}

if($usuarios == 'SIM'){
	$usuarios1 = 'SIM';
}
if($usuarios != 'SIM'){
	$usuarios1 = 'NAO';
}

if($instaladores == 'SIM'){
	$instaladores1 = 'SIM';
}
if($instaladores != 'SIM'){
	$instaladores1 = 'NAO';
}



$sql2 = mysqli_query($conn, "UPDATE clientes SET subdominio='$subdominio' WHERE id_cliente='$id_cliente'");

if($senha == ''){
	$sql = mysqli_query($conn, "UPDATE usuarios SET nome='$nome', usuario='$usuario', email='$email', ativo='$ativo', cad_equip='$equipamentos1', cad_operadores='$usuarios1', cad_instaladores='$instaladores1' WHERE id_usuarios='$id_usuarios'");
}
if($senha != ''){
	$sql = mysqli_query($conn, "UPDATE usuarios SET nome='$nome', usuario='$usuario', email='$email', ativo='$ativo', senha='$senha', cad_equip='$equipamentos1', cad_operadores='$usuarios1', cad_instaladores='$instaladores1' WHERE id_usuarios='$id_usuarios'");
}







$base_user = 'id_usuarios:'.$id_usuarios;
$base_user = base64_encode($base_user);

header('Location: usuarios.php');






?>
