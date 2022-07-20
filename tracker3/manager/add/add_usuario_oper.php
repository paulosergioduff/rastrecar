  <?php

include_once('../conexao.php');

$id_empresa = 	$_POST['customer_fact'];
$cliente = 	$_POST['cliente'];
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

$cons_user = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$cliente'");
if(mysqli_num_rows($cons_user) >= 1){
while ($result_user = mysqli_fetch_assoc($cons_user)) {
$nome = $result_user['nome_cliente'];
}}

$sql2 = mysqli_query($conn, "UPDATE clientes SET subdominio='$subdominio'");

$sql = mysqli_query($conn, "INSERT INTO usuarios (nome, usuario, nivel, id_cliente, email, ativo, cargo, senha, acesso) VALUES ('$nome', '$usuario', '$nivel', '$cliente', '$email', '$ativo', '$cargo', '$senha', '$acesso')");

header('Location: ../usuarios.php?p=usuarios');






















#==================================================
/*
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


#==================================================




$cons_user = mysqli_query($conn,"SELECT * FROM usuarios WHERE usuario='$usuario'");
if(mysqli_num_rows($cons_user) >= 1){
while ($result_user = mysqli_fetch_assoc($cons_user)) {
$id_usuarios = $result_user['id_usuarios'];
}}

$sql2 = mysqli_query($conn, "INSERT INTO usuarios_permissoes (id_usuarios, dash_analitico, dash_financeiro, dash_dispositivos, cad_clientes, cad_veiculos, cad_vendedores, cad_instaladores, cad_usuarios, contas_pagar, contas_receber, rel_percurso, rel_alertas, rel_viagens, rel_comandos, rel_cercas) VALUES ('$id_usuarios', '$dash_analitico', '$dash_financeiro',  '$dash_dispositivos', '$cad_clientes', '$cad_veiculos', '$cad_vendedores', '$cad_instaladores', '$cad_usuarios', '$contas_pagar', '$contas_receber', '$rel_percurso', '$rel_alertas', '$rel_viagens', '$rel_comandos', '$rel_cercas')");
*/

?>
