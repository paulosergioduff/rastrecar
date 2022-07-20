<?php
include_once("../conexao.php");

	$id_empresa = $_REQUEST['customer'];
	
	$data_agora = date('Y-m-d H:i:s');
$data_agora = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_agora)));

$data_inicial_12 = date('Y-m-d H:i:s', strtotime('-5 minutes', strtotime($data_agora)));

	$cont_veiculos = mysqli_query($conn,"SELECT * FROM tc_devices WHERE contact != 'ESTOQUE' AND lastupdate < '$data_inicial_12' AND id_empresa='$id_empresa'");
	$conexao = mysqli_num_rows($cont_veiculos);
		

		
echo $conexao;
		
		


?>