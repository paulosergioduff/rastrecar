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
		$credencial = 	$resp_dados['credencial'];
		$login_padrao = 	$resp_dados['login_padrao'];
		$whats = 	$resp_dados['whats'];
		$sessao_whats = 	$resp_dados['sessao_whats'];
		$chave_pix = 	$resp_dados['chave_pix'];
		$nome_fantasia = 	$resp_dados['nome_fantasia'];
		$chave = 	$resp_dados['chave'];
		$producao = 	$resp_dados['producao'];
}}

$cons_conta = mysqli_query($conn,"SELECT * FROM contas_receber WHERE id_conta='$id_conta'");
	if(mysqli_num_rows($cons_conta) > 0){
while ($resp_conta = mysqli_fetch_assoc($cons_conta)) {
$duplicata = 	$resp_conta['duplicata'];
	}}
	
	
	if($producao == 'NAO'){
		$url = 'https://sandbox.pjbank.com.br/recebimentos/'.$credencial.'/transacoes/'.$duplicata.'';
	}
	if($producao == 'SIM'){
		$url = 'https://api.pjbank.com.br/recebimentos/'.$credencial.'/transacoes/'.$duplicata.'';
	}


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'DELETE',
  CURLOPT_HTTPHEADER => array(
    "X-CHAVE: $chave"
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

$obj = json_decode($response);
$msg = $obj->{'msg'};	
$status = $obj->{'status'};


$base64 = 'id_cliente:'.$id_cliente.'';
$base64 = base64_encode($base64);

if($status == 200){
	if($pag == 'cad'){

		$del_conta = mysqli_query($conn, "DELETE FROM contas_receber WHERE id_conta='$id_conta'");

		header('Location: cad_cliente.php?c='.$base64.'');
	}
	if($pag == 'contas'){

		$del_conta = mysqli_query($conn, "DELETE FROM contas_receber WHERE id_conta='$id_conta'");

		header('Location: contas_receber.php');
	}
}
if($status == 500){
	if($pag == 'cad'){
		header('Location: cad_cliente.php?c='.$base64.'&del=erro&msg='.$msg.'');
	}
	if($pag == 'contas'){
		header('Location: contas_receber.php?del=erro&msg='.$msg.'');
	}
}












?>
