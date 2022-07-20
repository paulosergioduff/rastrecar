<?php

include("../conexao.php"); // Inclui o arquivo com o sistema de segurança

$pacote = $_POST['cliente'];
$id_empresa = $_POST['id_empresa'];
$sql = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente = '$pacote'");

if(mysqli_num_rows($sql) <= '0'){
echo '<input type="text" name="usuario" id="usuario" class="form-control" required>';
}else{
	while($x = mysqli_fetch_assoc($sql)){
	$nome_cliente    = $x['nome_cliente'];
	$nome = explode(" ", $nome_cliente);
	$nome_cliente = $nome[0];
	
	echo '<input type="text" name="usuario" id="usuario" value="'.$nome_cliente.'" class="form-control" required>';
		
	}
}	






?>
	
	