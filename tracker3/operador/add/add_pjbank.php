<?php

include_once("../conexao.php");
$data_login = date("Y-m-d H:i");

$nome_empresa = $_REQUEST['nome_empresa'];
$cnpj = $_REQUEST['cnpj'];
$banco_repasse = $_REQUEST['banco_repasse'];
$agencia_repasse = $_REQUEST['agencia_repasse'];
$conta_repasse = $_REQUEST['conta_repasse'];
$endereco = $_REQUEST['endereco'];
$bairro = $_REQUEST['bairro'];
$cidade1 = $_REQUEST['cidade'];
$uf = explode("/",$cidade1);
$cidade = $uf[0];
$estado = $uf[1];
$cep = $_REQUEST['cep'];
$email = $_REQUEST['email'];
$ddd = $_REQUEST['ddd'];
$telefone = $_REQUEST['telefone'];



$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.pjbank.com.br/recebimentos',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
  "nome_empresa": "'.$nome_empresa.'",
  "conta_repasse": "'.$conta_repasse.'",
  "agencia_repasse": "'.$agencia_repasse.'",
  "banco_repasse": "'.$banco_repasse.'",
  "cnpj": "'.$cnpj.'",
  "ddd": "'.$ddd.'",
  "telefone": "'.$telefone.'",
  "email": "'.$email.'",
  "endereco": "'.$endereco.'",
  "bairro": "'.$bairro.'",
  "cidade": "'.$cidade.'",
  "estado": "'.$estado.'",
  "cep": "'.$cep.'",
  "agencia": "1266"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Accept: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

	
$obj = json_decode($response);
$status = $obj->{'status'};
$msg = $obj->{'msg'};
$credencial = $obj->{'credencial'};
$chave = $obj->{'chave'};
$chave_webhook = $obj->{'chave_webhook'};

if($status == 400 or $status == 500 or $status == 401){
	//header('Location ../cad_pjbank.php?erro=erro&msg='.$msg.'');
	echo $msg;
}
if($status == 201 or $status == 200){
	$sql = mysqli_query($conn, "UPDATE dados_empresa SET pj_bank='SIM', credencial='$credencial', chave='$chave', chave_webhook='$chave_webhook' WHERE id_empresa='1361'");
	
	
	header('Location ../index.php?retorno=ok');
	
}





	?>