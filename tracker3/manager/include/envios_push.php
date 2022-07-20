 <?php
 header('Content-Type: application/json');

 
$servidor = "localhost";
$usuario = "root";
$senha = "TR4vcijU6T9Keaw";
$dbname = "traccar";

//Criar a conexao
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
$con = mysqli_connect($servidor, $usuario, $senha, $dbname);



$data_agora = date('Y-m-d H:i');
$data_agora1 = date('d/m/Y H:i');	

				

			
 function sendMessage(){
 }

			$cons_push = mysqli_query($conn,"SELECT * FROM envios_push WHERE enviado = 'NAO' ORDER BY id ASC LIMIT 1");
		if(mysqli_num_rows($cons_push) > 0){
			while ($row_push = mysqli_fetch_assoc($cons_push)) {
				$id_unico = $row_push['id_unico'];
				$alerta = $row_push['alerta'];
				$usuario = $row_push['cpf'];
				$id_cliente3 = $row_push['id_cliente'];
				$placa = $row_push['placa'];
				$data_envio = $row_push['data_envio'];
				$data_envio = date('d/m/Y H:i', strtotime("$data_envio"));
				$tipo_alerta = $row_push['tipo'];
				$id_unico = $row_push['id_unico'];

				

				if($data_envio == '' or $data_envio == '0'){
					$data_envio1 = '';
				} else {
					$data_envio1 = $data_envio;
				}
		}}

		
		$sql_vuser = mysqli_query($conn, "SELECT * FROM usuarios_push WHERE id_cliente = '$id_cliente3'");
				if(mysqli_num_rows($sql_vuser) > 0){
				while ($resp_vuser = mysqli_fetch_assoc($sql_vuser)) {
				$id_push[] = 	$resp_vuser['id_push'];
	

	

	 
        $content = array(
            "en" => ''.$placa.' | '.$alerta.' - '.$data_envio1.''
            );
        
        $fields = array(
            'app_id' => "d9e6f76a-2caa-44f2-920d-ed12a69f3fa9",
            'include_player_ids' => $id_push,
            'contents' => $content,
			'template_id' => '118ca5e6-8c3a-45de-8ce1-7b7af0053a64'
			
        );
        	}}
		
		$up = mysqli_query($conn, "UPDATE envios_push SET enviado='SIM' WHERE id_unico='$id_unico'");
		
        $fields = json_encode($fields);
        print("\nJSON sent:\n");
        print($fields);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                                   'Authorization: Basic OTE3M2Q0YjctYWYwMC00ZmFmLWIzNTUtNzkyNDczMTkyMDA1'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);
        
        return $response;
    
    
    $response = sendMessage();
    $return["allresponses"] = $response;
    $return = json_encode( $return);
    
    print("\n\nJSON received:\n");
    print($return);
    print("\n");
	


	
 

	

				?>

