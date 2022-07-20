<?php

include("../conexao.php"); // Inclui o arquivo com o sistema de segurança

$pacote = $_POST['cliente'];
$id_empresa = $_POST['id_empresa'];
$sql = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente = '$pacote'");

if(mysqli_num_rows($sql) <= '0'){
echo '<input type="text" name="email" id="email" class="form-control" required>';
}else{
	while($x = mysqli_fetch_assoc($sql)){
	$email    = $x['email'];
	$email = strtolower($email);
	echo '<input type="text" name="email" id="email" value="'.$email.'" class="form-control" required>';
		
	}
}	






?>
	
	