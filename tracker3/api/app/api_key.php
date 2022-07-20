<?php
session_start(); 
        //Incluindo a conexão com banco de dados   
    include_once("config.php");    
	$id_empresa = $_REQUEST['id_empresa'];
	
	

	$cons_cod = mysqli_query($conn,"SELECT * FROM api_key WHERE id_empresa='$id_empresa'");
	if(mysqli_num_rows($cons_cod) > 0){
while ($resp_cod = mysqli_fetch_assoc($cons_cod)) {
$api_key = 	$resp_cod['api_key'];

if($api_key != ''){
	$ip = $api_key;
} else {
$ip = '0';
}


$alertas = array('ip_server' => $ip);

				$json[] = $alertas;
	
	}}




echo json_encode($json, JSON_PRETTY_PRINT);
	
	

   
?>

