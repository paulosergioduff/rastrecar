<?php
include("../conexao.php"); // Inclui o arquivo com o sistema de segurança

$imei = $_REQUEST['imei'];

if($imei == ''){
	echo '400';
}

if($imei != ''){
$sql = mysqli_query($conn,"SELECT * FROM tc_devices WHERE uniqueid = '$imei'");

if(mysqli_num_rows($sql) <= 0){
echo '0';
}else{
	while($x = mysqli_fetch_assoc($sql)){
		echo '1';
	}
}	
}





?>
	
	