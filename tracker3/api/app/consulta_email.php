<?php
session_start(); 
        //Incluindo a conexão com banco de dados   
    include_once("config.php");    
	$email = $_GET['email'];
	
	
	
	$cons_cod = mysqli_query($conn,"SELECT * FROM codigos_sms ORDER BY id_cod DESC LIMIT 1");
	if(mysqli_num_rows($cons_cod) > 0){
while ($resp_cod = mysqli_fetch_assoc($cons_cod)) {
$codigo_sms = 	$resp_cod['codigo_sms'];
$codigo_sms = $codigo_sms + 2;
	}}
	$gerar_codigo = mysqli_query($conn, "INSERT IGNORE INTO codigos_sms (id_cod, codigo_sms) VALUES ('0', '$codigo_sms')");
	
	
	$cons_cod2 = mysqli_query($conn,"SELECT * FROM codigos_sms ORDER BY id_cod DESC LIMIT 1");
	if(mysqli_num_rows($cons_cod2) > 0){
while ($resp_cod2 = mysqli_fetch_assoc($cons_cod2)) {
$codigo_sms2 = 	$resp_cod2['codigo_sms'];
$codigo_sms2 = $codigo_sms2 + 2;
	}}
	
	
	  $cons_email = mysqli_query($conn,"SELECT * FROM clientes WHERE email='$email' ORDER BY id_cliente DESC LIMIT 1");
	if(mysqli_num_rows($cons_email) > 0){
while ($resp_email = mysqli_fetch_assoc($cons_email)) {
$email_cliente = 	$resp_email['email'];
$id_cliente = 	$resp_email['id_cliente'];
$telefone = 	$resp_email['telefone_celular'];
$telefone = preg_replace("/[^0-9]/", "", $telefone);
	}}
	
	$gravar_sms = mysqli_query($conn, "UPDATE usuarios SET codigos_sms='$codigo_sms2' WHERE id_cliente='$id_cliente'");
   
  $cons_user = mysqli_query($conn,"SELECT * FROM usuarios WHERE id_cliente='$id_cliente' ORDER BY id_usuarios DESC LIMIT 1");
	if(mysqli_num_rows($cons_user) > 0){
while ($resp_user = mysqli_fetch_assoc($cons_user)) {
$id_cliente = 	$resp_user['id_cliente'];
$id_usuarios = 	$resp_user['id_usuarios'];





if($email == $email_cliente){
	
	$url = 'http://www.iagentesms.com.br/webservices/http.php';
$tipo_envio = 'envio';

 $sms1 = 'Ninguem da JC Rastreamento vai pedir esta informacao, nao compartilhe. Seu codigo e  '.$codigo_sms2.'.';
//Dados a serem enviados via requisição POST
$data = array('usuario' => 'financeiro@rastreamentojc.com.br' ,'senha' => 'Belinha2020', 'metodo' => $tipo_envio, 'mensagem' => $sms1 ,'celular' => $telefone);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
$output = curl_exec($ch);
$response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

} else {
	echo '0';
}
	}} else {
		echo '0';
	}
   
?>

