<?php
include_once("../conexao.php");

$data_cricacao = date('Y-m-d');
$data_agora = date('Y-m-d H:i');
$texto_push = $_REQUEST['texto_push'];
$id_cliente = $_REQUEST['cliente'];
$texto_push1 = urlencode($texto_push);

 
for($i=0; $i<count($id_cliente); $i++){
 
 
$sql_vuser2 = mysqli_query($conn, "SELECT * FROM clientes WHERE id_cliente = '$id_cliente[$i]'");

			if(mysqli_num_rows($sql_vuser2) > 0){
				$total = mysqli_num_rows($sql_vuser2);
			while ($resp_vuser2 = mysqli_fetch_assoc($sql_vuser2)) {
			$telefone_celular = 	$resp_vuser2['telefone_celular'];
			$telefone_celular = preg_replace("/[^0-9]/", "", $telefone_celular);
			$id_cliente1 = 	$resp_vuser2['id_cliente'];
			$id_unico = date('YmdHis');
			$id_unico = ''.$id_unico.'-'.$id_cliente1.'';
			$nome_cliente = 	$resp_vuser2['nome_cliente'];
			 
			 
			

	
        }}
		
		$cabecalho = '%F0%9F%94%94+INFORMATIVO+JC+RASTREAMENTO+%F0%9F%94%94%0A%0APrezado%28a%29+'.$nome_cliente.'%2C%0A%0A.';
			$texto_push = ''.$cabecalho.' '.$texto_push1.'';
			
			 $insere_alerta1 = mysqli_query($conn, "INSERT IGNORE INTO envios_whats (id_unico, telefone, mensagem, enviado, id_cliente, data_envio, tipo) VALUES ('$id_unico', '$telefone_celular', '$texto_push', 'NAO', '$id_cliente1', '$data_agora', 'MANUAL')");
}
		header('Location: ../envio_whats.php'); 




?>

