  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('conexao.php');


$data_delete = date('Y-m-d');
$id_conta = $_GET['id_conta'];
$id_cliente = $_GET['id_cliente'];
$id_empresa = $_GET['id_empresa'];
$pag =  $_GET['pag'];


$dados_empresa = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa = '$id_empresa'");
	if(mysqli_num_rows($dados_empresa) > 0){
		while ($resp_dados = mysqli_fetch_assoc($dados_empresa)) {
		$asaas_key = 	$resp_dados['asaas_key'];

}}

$cons_conta = mysqli_query($conn,"SELECT * FROM contas_receber WHERE id_conta='$id_conta'");
	if(mysqli_num_rows($cons_conta) > 0){
while ($resp_conta = mysqli_fetch_assoc($cons_conta)) {
$nr_banco = 	$resp_conta['nr_banco'];
	}}
	
	


$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://www.asaas.com/api/v3/payments/'.$nr_banco.'');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  "Content-Type: application/json",
  "access_token: $asaas_key"
));

$response = curl_exec($ch);
curl_close($ch);

echo $response;

$obj = json_decode($response);
$deleted = $obj->{'deleted'};

if($deleted == true){
	if($pag == 'cad'){

		$base64 = 'id_cliente:'.$id_cliente.'';
		$base64 = base64_encode($base64);
		
		$del_conta = mysqli_query($conn, "DELETE FROM contas_receber WHERE id_conta='$id_conta'");

		header('Location: cad_cliente.php?c='.$base64.'');
	}
	if($pag == 'contas'){

		$base64 = 'id_cliente:'.$id_cliente.'';
		$base64 = base64_encode($base64);
		
		$del_conta = mysqli_query($conn, "DELETE FROM contas_receber WHERE id_conta='$id_conta'");

		header('Location: contas_receber.php');
	}
} 
if($deleted == false){
	if($pag == 'cad'){

		$base64 = 'id_cliente:'.$id_cliente.'';
		$base64 = base64_encode($base64);

		header('Location: cad_cliente.php?c='.$base64.'&del=erro&msg='.$msg.'');
	}
	if($pag == 'contas'){

		$base64 = 'id_cliente:'.$id_cliente.'';
		$base64 = base64_encode($base64);

		header('Location: contas_receber.php?del=erro&msg='.$msg.'');
	}
} 














?>
