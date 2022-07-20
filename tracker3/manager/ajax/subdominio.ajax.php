<?php

include("../conexao.php"); // Inclui o arquivo com o sistema de segurança

$pacote = $_POST['cliente'];
$id_empresa = $_POST['id_empresa'];
$sql = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente = '$pacote'");

if(mysqli_num_rows($sql) <= '0'){
echo '<input type="text" class="form-control" name="acesso_link" id="acesso_link" value="" readonly>';
}else{
	while($x = mysqli_fetch_assoc($sql)){
	$nome_cliente    = $x['nome_cliente'];
	$nome = explode(" ", $nome_cliente);
	$nome_cliente = $nome[0];
	$nome_cliente = strtolower($nome_cliente);
	echo '<input type="text" class="form-control" name="acesso_link" id="acesso_link" value="http://'.$nome_cliente.'.rastreiamaisbrasil.com.br" readonly>';
		
	}
}	






?>
	
	