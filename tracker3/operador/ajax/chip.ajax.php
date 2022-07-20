<?php
include("../conexao.php"); // Inclui o arquivo com o sistema de segurança

$chip = $_REQUEST['chip'];

if($chip == ''){
	echo '400';
}

if($chip != ''){
$sql = mysqli_query($conn,"SELECT * FROM tc_devices WHERE phone = '$chip'");

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
	
	