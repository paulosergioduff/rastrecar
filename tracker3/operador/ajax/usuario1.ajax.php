<?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include("../conexao.php"); // Inclui o arquivo com o sistema de segurança

$nome = $_REQUEST['nome'];



$sql = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente = '$nome'");

if(mysqli_num_rows($sql) <= 0){
echo '';
}else{
	while($x = mysqli_fetch_assoc($sql)){
	$email = $x['email'];
	echo '<input type="text" class="form-control" name="email" id="email" value="'.$email.'" required>';
	}
}	






?>
	
	