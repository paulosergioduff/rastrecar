<?php
include("../conexao.php"); // Inclui o arquivo com o sistema de segurança

$placa = $_REQUEST['placa'];

if($placa == ''){
	echo '400';
}

if($placa != ''){
$sql = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE placa = '$placa'");

if(mysqli_num_rows($sql) <= 0){
echo '0';
}else{
	while($x = mysqli_fetch_assoc($sql)){
	
	echo '1';
	}
}	
}





?>
	
	