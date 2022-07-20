  <?php

include_once('conexao.php');

$nome = 	$_POST['nome'];
$usuario = 	$_POST['usuario'];
$usuario = 	''.$usuario.'@rmb';
$email	 = 	$_POST['email'];
$ativo	 = 	$_POST['ativo'];
$acesso = $_POST['acesso'];
$id_usuarios = $_POST['id_usuarios'];
$senha = $_POST['senha'];
$senha = md5($senha);


$dash_analitico	 = 	$_POST['dash_analitico'];
$dash_financeiro	 = 	$_POST['dash_financeiro'];
$dash_dispositivos	 = 	$_POST['dash_dispositivos'];
$cad_clientes	 = 	$_POST['cad_clientes'];
$cad_veiculos	 = 	$_POST['cad_veiculos'];
$cad_vendedores	 = 	$_POST['cad_vendedores'];
$cad_instaladores	 = 	$_POST['cad_instaladores'];
$cad_usuarios	 = 	$_POST['cad_usuarios'];
$contas_pagar	 = 	$_POST['contas_pagar'];
$contas_receber	 = 	$_POST['contas_receber'];
$rel_percurso	 = 	$_POST['rel_percurso'];
$rel_alertas	 = 	$_POST['rel_alertas'];
$rel_viagens	 = 	$_POST['rel_viagens'];
$rel_comandos	 = 	$_POST['rel_comandos'];
$rel_cercas	 = 	$_POST['rel_cercas'];



if($senha != ''){
	$upsenha = mysqli_query($conn, "UPDATE usuarios SET senha='$senha' WHERE id_usuarios='$id_usuarios'");
}

$sql = mysqli_query($conn, "UPDATE usuarios SET nome='$nome', usuario='$usuario', acesso='$acesso',  email='$email', ativo='$ativo' WHERE id_usuarios='$id_usuarios'");

if (mysqli_connect_errno())
{echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sql2 = "UPDATE usuarios_permissoes SET dash_analitico='$dash_analitico', dash_financeiro='$dash_financeiro', dash_dispositivos='$dash_dispositivos', cad_clientes='$cad_clientes', cad_veiculos='$cad_veiculos', cad_vendedores='$cad_vendedores', cad_instaladores='$cad_instaladores', cad_usuarios='$cad_usuarios', contas_pagar='$contas_pagar', contas_receber='$contas_receber', rel_percurso='$rel_percurso', rel_alertas='$rel_alertas', rel_viagens='$rel_viagens', rel_comandos='$rel_comandos', rel_cercas='$rel_cercas' WHERE id_usuarios='$id_usuarios'";

if (mysqli_query($conn, $sql2)) {
      echo "New record created successfully";
} else {
      echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);





$base_user = 'id_usuarios:'.$id_usuarios;
$base_user = base64_encode($base_user);

header('Location: editar_usuario_adm.php?c='.$base_user.'');






?>
