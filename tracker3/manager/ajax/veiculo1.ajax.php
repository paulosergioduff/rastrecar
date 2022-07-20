<?php

include("../conexao.php"); // Inclui o arquivo com o sistema de segurança

$retorno = $_POST['veiculo'];
$sel = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE id_cliente = '$retorno' AND status='1'");

if(mysqli_num_rows($sel) <= '0'){
echo '<option value="0">Nenhum veiculo encontrado</option>';
}else{
echo '<option value="0">Selecione o Veiculo</option>';
	while($res = mysqli_fetch_array($sel)){
	$id_veiculo = $res['id_veiculo'];
	$marca_veiculo    = $res['marca_veiculo'];
	$modelo_veiculo    = $res['modelo_veiculo'];
	$placa    = $res['placa'];
	echo '<option value="'.$id_veiculo.'">'.$placa.' - '.$marca_veiculo.'/'.$modelo_veiculo.'</option>';
	}
	}

?>
	
	