<?php

include("../conexao.php"); // Inclui o arquivo com o sistema de segurança

$resposta = $_POST['chip'];

echo $resposta;


$obj = json_encode($resposta);
$json = json_decode($obj);

foreach($json as $registro):
	$chip = $registro->chip;
	
	$sql = mysqli_query($conn,"SELECT * FROM chips_clientes WHERE chip = '$chip'");
	
	echo mysqli_num_rows($sql);
	endforeach;

?>
	
	