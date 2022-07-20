<?php

include("../conexao.php"); // Inclui o arquivo com o sistema de segurança

$retorno = $_POST['classificacao'];


if($retorno == 'ENTRADA'){
	$sel = mysqli_query($conn,"SELECT * FROM categorias_contas_receber ORDER BY categoria ASC");

	if(mysqli_num_rows($sel) <= '0'){
	echo '<option value="0">Nenhum veiculo encontrado</option>';
	}else{
	echo '<option value="0">Selecione...</option>';
		while($res = mysqli_fetch_array($sel)){
		$categoria = $res['categoria'];

		echo '<option value="'.$categoria.'">'.$categoria.'</option>';
		}
		}
}




if($retorno == 'SAIDA'){
		$sel = mysqli_query($conn,"SELECT * FROM categorias_contas_pagar ORDER BY categoria ASC");

	if(mysqli_num_rows($sel) <= '0'){
	echo '<option value="0">Nenhum veiculo encontrado</option>';
	}else{
	echo '<option value="0">Selecione...</option>';
		while($res = mysqli_fetch_array($sel)){
		$categoria = $res['categoria'];

		echo '<option value="'.$categoria.'">'.$categoria.'</option>';
		}
		}
}




?>
	
	