<?php

include("../conexao.php"); // Inclui o arquivo com o sistema de segurança

$nome = $_POST['nome'];
$sql = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente = '$nome'");

if(mysqli_num_rows($sql) <= '0'){
echo '';
}else{
	while($x = mysqli_fetch_assoc($sql)){
	$doc_cliente    = $x['doc_cliente'];
	$doc_cliente = preg_replace("/[^0-9]/", "", $doc_cliente);
	echo '<input type="text" name="usuario" id="usuario" class="form-control" value="'.$doc_cliente.'" required>';
	}
}	






?>
	
	