<?php

include("../conexao.php"); // Inclui o arquivo com o sistema de segurança

$resposta = $_POST['imei'];
$sql = mysqli_query($conn,"SELECT * FROM tc_devices WHERE uniqueid = '$resposta'");

if(mysqli_num_rows($sql) <= '0'){
echo '0';
}else{
	while($x = mysqli_fetch_assoc($sql)){
	echo '1';
	
	}
}	




?>
	
	