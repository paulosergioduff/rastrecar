<?php

include("../conexao.php"); // Inclui o arquivo com o sistema de segurança

$retorno = $_POST['cliente'];

if($retorno == '1361'){
	$nome_cliente_pai = 'RMB';
}
if($retorno != '1361'){
	$cons_pacote = mysqli_query($con,"SELECT * FROM clientes WHERE id_cliente='$retorno'");
	if(mysqli_num_rows($cons_pacote) > 0){
		while ($resp_pac = mysqli_fetch_assoc($cons_pacote)) {
		$nome_cliente_pai = 	$resp_pac['nome_cliente'];
		}}

}


$sel = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente_pai = '$retorno' AND cliente_pai = 'NAO'");

if(mysqli_num_rows($sel) <= '0'){
echo '<option value="">Nenhum Cliente encontrado</option>';
}else{
echo '<option value="">Selecione</option>';
echo '<option value="1">Selecionar Todos</option>';
	while($res = mysqli_fetch_array($sel)){
		
	
	$nome_cliente = $res['nome_cliente'];
	$id_cliente    = $res['id_cliente'];
	echo '<option value="'.$id_cliente.'">'.$nome_cliente_pai.' > '.$nome_cliente.'</option>';
	}
	}

?>
	
	