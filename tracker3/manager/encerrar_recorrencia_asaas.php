  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('conexao.php');


$data_delete = date('Y-m-d');
$id_recorrencia = $_GET['c'];

$id_empresa = 	'1361';

$cons_recorrencia = mysqli_query($conn,"SELECT * FROM recorrencia WHERE id_recorrencia='$id_recorrencia'");
	if(mysqli_num_rows($cons_recorrencia) > 0){
while ($resp_recor = mysqli_fetch_assoc($cons_recorrencia)) {
$assinatura = 	$resp_recor['id_assinatura'];

	}}

echo $assinatura;

$dados_empresa = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa = '$id_empresa'");
	if(mysqli_num_rows($dados_empresa) > 0){
		while ($resp_dados = mysqli_fetch_assoc($dados_empresa)) {
		$asaas_key = 	$resp_dados['asaas_key'];

}}

if($assinatura != '0'){
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, 'https://www.asaas.com/api/v3/subscriptions/'.$assinatura.'');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_HEADER, FALSE);

	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	  "Content-Type: application/json",
		"access_token: $asaas_key"
	));

	$response = curl_exec($ch);
	curl_close($ch);

	var_dump($response);
}
	
	$sql = mysqli_query($conn, "UPDATE recorrencia SET ativo='NAO', id_assinatura='0', data_termino='$data_delete' WHERE id_recorrencia='$id_recorrencia'");
	$sql2 = mysqli_query($conn, "UPDATE veiculos_clientes SET recorrencia='NAO', id_recorrencia='0' WHERE id_recorrencia='$id_recorrencia'");


header('Location: recorrencias.php');














?>
