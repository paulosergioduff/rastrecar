<?php

$servidor = "localhost";
$usuario = "root";
$senha = "TR4vcijU6T9Keaw";
$dbname = "traccar";

//Criar a conexao
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
$con = mysqli_connect($servidor, $usuario, $senha, $dbname);


$id_conta = $_REQUEST['id_conta'];

	$cons_fatura = mysqli_query($conn, "SELECT * FROM contas_receber WHERE id_conta='$id_conta'");
	if(mysqli_num_rows($cons_fatura) > 0){
		while($rouw_fat = mysqli_fetch_assoc($cons_fatura)){
		$id_conta = $rouw_fat['id_conta'];
		$id_empresa = $rouw_fat['id_empresa'];
		$id_recorrencia1 = $rouw_fat['id_recorrencia'];
		$data_vencimento = $rouw_fat['data_vencimento'];
		$data_vencimento1 = date('d/m/Y', strtotime("$data_vencimento"));
		$linha_digitavel = $rouw_fat['linha_digitavel'];
		$nr_banco = $rouw_fat['nr_banco'];
		$nsu = $rouw_fat['nsu'];
	}}
	
	$cons_empresa = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='$id_empresa'");
	if(mysqli_num_rows($cons_empresa) > 0){
		while ($resp_empresa = mysqli_fetch_assoc($cons_empresa)) {
		$asaas_key = $resp_empresa['asaas_key'];

	}}
	
		
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, 'https://www.asaas.com/api/v3/payments/'.$nr_banco.'/pixQrCode');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);

		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		  "Content-Type: application/json",
		  "access_token: $asaas_key"
		));

		$response = curl_exec($ch);
		curl_close($ch);

		$json1 = json_decode($response);

		$encodedImage = $json1->{'encodedImage'};
		$payload = $json1->{'payload'};
		


		


?>
<div class="col-12 text-center" >
    <img src="data:image/jpg;base64,<?php echo $encodedImage?>" style="width:200px"><br>

<input type="hidden" class="form-control font-14" id="chave_pix" value="<?php echo $payload?>" style="height:50px">                
</div>

