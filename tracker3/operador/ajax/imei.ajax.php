<?php
include("../conexao.php"); // Inclui o arquivo com o sistema de seguran�a

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
		$contact = $x['contact'];
		if($contact == 'ESTOQUE'){
			echo '0';
		}
		if($contact != 'ESTOQUE'){
			echo '1';
		}
	}
}	
}





?>
	
	