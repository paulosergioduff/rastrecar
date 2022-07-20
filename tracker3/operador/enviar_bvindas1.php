  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('conexao.php');

$date = date('YmdHms');
$date1 = date('Y-m-d H:i:s');
$id_usuarios = 	$_REQUEST['id_usuarios'];
$origem = 	$_REQUEST['origem'];
$mensagem = 	$_REQUEST['mensagem'];
$mensagem = urlencode($mensagem);


	$cont_cliente1 = mysqli_query($conn,"SELECT * FROM usuarios WHERE id_usuarios='$id_usuarios'");
if(mysqli_num_rows($cont_cliente1) == 1){
while ($resp_cliente1 = mysqli_fetch_assoc($cont_cliente1)) {
	$usuario = $resp_cliente1['usuario'];
	$id_cliente = $resp_cliente1['id_cliente'];
	$user1 = explode("@", $usuario);
	$usuario = $user1[0];
}}

	$cont_cliente = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
if(mysqli_num_rows($cont_cliente) == 1){
while ($resp_cliente = mysqli_fetch_assoc($cont_cliente)) {
	$nome_cliente = $resp_cliente['nome_cliente'];
	$telefone_celular = $resp_cliente['telefone_celular'];
	$telefone_celular = preg_replace("/[^0-9]/", "", $telefone_celular);
}}



$id_unico = ''.$date.'-B'.$id_cliente.'';




$insere_alerta1 = mysqli_query($conn, "INSERT IGNORE INTO envios_whats (id_unico, telefone, mensagem, enviado, id_cliente, data_envio, tipo) VALUES ('$id_unico', '$telefone_celular', '$mensagem', 'NAO', '$id_cliente', '$date1', 'BOAS VINDAS')");
	
$base_user = 'id_usuarios:'.$id_usuarios;
$base_user = base64_encode($base_user);

if($origem == 'MASTER'){
	header('Location: editar_usuario_master.php?c='.$base_user.'&send=ok');
}
if($origem == 'USUARIO'){
	header('Location: editar_usuario_cli.php?c='.$base_user.'&send=ok');
}


?>
