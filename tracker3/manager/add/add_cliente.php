  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('../conexao.php');

$nome_cliente = 	$_POST['nome_cliente'];
$nome_cliente = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$nome_cliente);
$nome_cliente = strtoupper($nome_cliente);
$doc_cliente = 	$_POST['doc_cliente'];
$rg_cliente	 = 	$_POST['rg_cliente'];
$data_nascimento = 	$_POST['data_nascimento'];
$data_nascimento = substr($data_nascimento,6,4) . "-" . substr($data_nascimento,3,2) . "-" . substr($data_nascimento,0,2);
$cep = 	$_POST['cep'];
$endereco = 	$_POST['endereco'];
$endereco = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$endereco);
$endereco = strtoupper($endereco);
$numero = 	$_POST['numero'];
$complemento = 	$_POST['complemento'];
$bairro = 	$_POST['bairro'];
$bairro = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$bairro);
$bairro = strtoupper($bairro);
$cidade = 	$_POST['cidade'];
$cidade = strtoupper($cidade);
$cidade = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$cidade);
$estado = 	$_POST['estado'];
$estado = strtoupper($estado);
$telefone_residencial = 	$_POST['telefone_residencial'];
$telefone_celular = 	$_POST['telefone_celular'];
$telefone_outros = 	$_POST['telefone_outros'];
$data_cadastro = 	date('Y-m-d');
$email = 	$_POST['email'];
$status = 	$_POST['status'];
$vendedor = $_POST['vendedor'];
$senha_atendimento = $_POST['senha_atendimento'];
$dias_bloqueio = $_POST['dias_bloqueio'];
$id_empresa = $_POST['id_empresa'];
$id_cliente_pai = $_POST['id_cliente_pai'];


$celular = preg_replace("/[^0-9]/", "", $telefone_celular);



$sql = mysqli_query($conn, "INSERT INTO clientes (id_cliente_pai, nome_cliente, doc_cliente, rg_cliente,  data_nascimento, cep, endereco, numero, complemento, bairro, cidade, estado, telefone_residencial, telefone_celular, telefone_outros, data_cadastro, email, status,  senha_atendimento, vendedor, indicacao, assinatura, id_rast, dias_bloqueio) VALUES ('$id_cliente_pai', '$nome_cliente', '$doc_cliente', '$rg_cliente',  '$data_nascimento', '$cep', '$endereco', '$numero', '$complemento', '$bairro', '$cidade', '$estado', '$telefone_residencial', '$telefone_celular', '$telefone_outros', '$data_cadastro', '$email', '11', '$senha_atendimento', '', 'NAO', ' ', ' ', '$dias_bloqueio')");






$cons_cliente = mysqli_query($conn,"SELECT * FROM clientes ORDER BY id_cliente DESC LIMIT 1");
	if(mysqli_num_rows($cons_cliente) > 0){
while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
	$nome_cliente = 	$resp_cliente['nome_cliente'];
$id_cliente = 	$resp_cliente['id_cliente'];


	}}



$cons_nivel = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='1361'");
	if(mysqli_num_rows($cons_nivel) > 0){
	while ($resp_nivel = mysqli_fetch_assoc($cons_nivel)) {
		$asaas_key = 	$resp_nivel['asaas_key'];
	}}	


$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://www.asaas.com/api/v3/customers");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);

curl_setopt($ch, CURLOPT_POST, TRUE);

curl_setopt($ch, CURLOPT_POSTFIELDS, "{
  \"name\": \"$nome_cliente\",
  \"email\": \"$email\",
  \"phone\": \"$telefone_outros\",
  \"mobilePhone\": \"$telefone_outros\",
  \"cpfCnpj\": \"$doc_cliente\",
  \"postalCode\": \"$cep\",
  \"address\": \"$endereco\",
  \"addressNumber\": \"$numero\",
  \"complement\": \"$complemento\",
  \"province\": \"$bairro\",
  \"externalReference\": \"$id_cliente\",
  \"notificationDisabled\": false
}");

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  "Content-Type: application/json",
  "access_token: $asaas_key"
));

$response = curl_exec($ch);
curl_close($ch);

//var_dump($response);
	
$obj = json_decode($response);
$id_asaas = $obj->{'id'};

$sql_customer = mysqli_query($conn, "UPDATE clientes SET id_asaas='$id_asaas' WHERE id_cliente='$id_cliente'");

$base64 = 'id_cliente:'.$id_cliente.'';
$base64 = base64_encode($base64);

header('Location: ../cad_cliente.php?c='.$base64.'&cad_cliente=ok');


?>
