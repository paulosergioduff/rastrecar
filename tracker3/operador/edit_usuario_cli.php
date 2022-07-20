  <?php

include_once('conexao.php');

$nome = 	$_POST['nome'];
$usuario = 	$_POST['usuario'];
$id_cliente = 	$_POST['id_cliente'];
$senha = 	$_POST['senha'];
$senha1 = md5($senha);
$usuario = 	''.$usuario.'@jcrastreamento';
$email	 = 	$_POST['email'];
$ativo	 = 	$_POST['ativo'];
$id_usuarios = $_POST['id_usuarios'];
$bloqueio = $_POST['bloqueio'];
if($bloqueio != 'SIM'){
	$permite_bloqueio = 'NAO';
}
if($bloqueio == 'SIM'){
	$permite_bloqueio = 'SIM';
}
$whats = $_POST['whats'];
if($whats != 'SIM'){
	$alertas_whats = 'NAO';
}
if($whats == 'SIM'){
	$alertas_whats = 'SIM';
}

if($senha != ''){
	$up_senha = mysqli_query($conn, "UPDATE usuarios SET senha='$senha1' WHERE id_usuarios='$id_usuarios'");
}

$sql_w = mysqli_query($conn, "UPDATE clientes SET alertas_whats = '$alertas_whats' WHERE id_cliente='$id_cliente'");


if (mysqli_connect_errno())
{echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sql = "UPDATE usuarios SET nome='$nome', usuario='$usuario',  email='$email', ativo='$ativo', permite_bloqueio='$permite_bloqueio', alertas_whats='$alertas_whats' WHERE id_usuarios='$id_usuarios'";

if (mysqli_query($conn, $sql)) {
      echo "New record created successfully";
} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);

header('Location: usuarios.php?p=usuarios');






?>
