  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);

include_once('conexao.php');
$data_retorno = date('Y-m-d H:i:s');

$codigosms = $_GET['codigosms'];
$resposta = $_GET['mensagem'];
$status = $_GET['status'];

$query = mysqli_query ($conn, "UPDATE log_sms SET status='$status' WHERE id_log = '$codigosms' AND recebido = 'NAO'");

if($resposta != ''){
	$query = mysqli_query ($conn, "UPDATE log_sms SET resposta = '$resposta', recebido='SIM', data_retorno='$data_retorno', status='$status' WHERE id_log = '$codigosms' AND recebido = 'NAO'");
	
}











?>
