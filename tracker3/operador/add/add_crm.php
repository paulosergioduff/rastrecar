  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);

include_once('../conexao.php');

$date = date('Y-m-d');
$hora = date('H:i:s');
$id_cliente = 	$_POST['id_cliente'];
$descricao = 	$_POST['descricao'];
$tipo_crm = 	$_POST['tipo_crm'];
$user_nome = 	$_POST['user_nome'];
$telefone_celular = 	$_POST['telefone_celular'];
$protocolo = date('Ymd-His');

#---------------------------------------------------------------------------------------



$sql11 = mysqli_query($conn,"INSERT INTO crm (id_cliente, info, tipo_crm, data,  hora, user, protocolo) VALUES ('$id_cliente', '$descricao', '$tipo_crm', '$date', '$hora', '$user_nome', '$protocolo')");



$base64 = 'id_cliente:'.$id_cliente.'';
$base64 = base64_encode($base64);

header('Location: ../cad_cliente.php?c='.$base64.'');



?>
