  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('conexao.php');

$date = date('YmdHms');
$date1 = date('Y-m-d H:i:s');
$id_cliente = 	$_REQUEST['id_cliente'];



	$cont_cliente1 = mysqli_query($conn,"SELECT * FROM usuarios WHERE id_cliente='$id_cliente'");
if(mysqli_num_rows($cont_cliente1) == 1){
while ($resp_cliente1 = mysqli_fetch_assoc($cont_cliente1)) {
	$usuario = $resp_cliente1['usuario'];
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



$id_unico = ''.$date.'-C'.$id_cliente.'';

$mensagem = '%27%2AAVISO+JC+RASTREAMENTO%2A%0A%0APrezado%28a%29+'.$nome_cliente.'%0A%0ASempre+pensando+em+melhorias+para+nossos+clientes%2C+%C3%A9+com+prazer+que+anunciamos+o+lan%C3%A7amento+da+nova+plataforma+de+rastreamento+e+o+novo+Aplicativo.+Ambos+foram+desenvolvidos+visando+mais+qualidade+e+seguran%C3%A7a+nas+informa%C3%A7%C3%B5es+e+servi%C3%A7os.+Estamos+encaminhando+as+informa%C3%A7%C3%B5es+para+que+voc%C3%AA+possa+acessar+o+novo+sistema.%0A%0ALink+para+baixar+Android%3A%0Ahttps%3A%2F%2Fencurtador.com.br%2FACHMR%0A%0ALink+para+baixar+IOS%3A%0Ahttps%3A%2F%2Fapps.apple.com%2Fus%2Fapp%2Fjc-car-rastreamento%2Fid1559599855%0A%0ADados+de+Acesso%3A%0AUsu%C3%A1rio%3A++'.$usuario.'%0ASenha%3A+102030%0A%0A-----------------------------%0APara+que+voc%C3%AA+possa+receber+as+notifica%C3%A7%C3%B5es+via+whatsapp%2C+caso+seja+do+seu+interesse%2C+por+favor+salve+este+telefone+em+sua+agenda+de+contatos.%0A%0AQualquer+d%C3%BAvida+estamos+sempre+a+disposi%C3%A7%C3%A3o.%0A%0AAtenciosamente%2C%0A%2AComercial+JC+Rastreamento%2A';



$insere_alerta1 = mysqli_query($conn, "INSERT IGNORE INTO envios_whats (id_unico, telefone, mensagem, enviado, id_cliente, data_envio, tipo) VALUES ('$id_unico', '$telefone_celular', '$mensagem', 'NAO', '$id_cliente', '$date1', 'ENVIO')");
	
$base_user = 'id_cliente:'.$id_cliente;
$base_user = base64_encode($base_user);

header('Location: cad_cliente.php?c='.$base_user.'');
?>
