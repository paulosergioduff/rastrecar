  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('conexao.php');

$date = date('YmdHms');
$date1 = date('Y-m-d H:i:s');
$id_cliente = 	$_REQUEST['id_cliente'];
$id_conta = 	$_REQUEST['id_conta'];
$origem = 	$_REQUEST['origem2'];
$mensagem = 	$_REQUEST['mensagem2'];
$mensagem = urlencode($mensagem);




	$cont_cliente = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
if(mysqli_num_rows($cont_cliente) == 1){
while ($resp_cliente = mysqli_fetch_assoc($cont_cliente)) {
	$nome_cliente = $resp_cliente['nome_cliente'];
	$telefone_celular = $resp_cliente['telefone_celular'];
	$telefone_celular = preg_replace("/[^0-9]/", "", $telefone_celular);
}}



$id_unico = ''.$date.'-FAT'.$id_cliente.'';




$insere_alerta1 = mysqli_query($conn, "INSERT IGNORE INTO envios_whats (id_unico, telefone, mensagem, enviado, id_cliente, data_envio, tipo) VALUES ('$id_unico', '$telefone_celular', '$mensagem', 'NAO', '$id_cliente', '$date1', 'BOAS VINDAS')");
	
$base_user = 'id_conta:'.$id_conta;
$base_user = base64_encode($base_user);

if($origem == 'CONTA_RECEBER'){
	header('Location: view_conta_receber.php?c='.$base_user.'&send=ok');
}

?>
