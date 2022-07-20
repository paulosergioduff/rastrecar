<?php

include("../conexao.php"); // Inclui o arquivo com o sistema de segurança

$retorno = $_POST['contratos'];
$sel = mysqli_query($conn,"SELECT * FROM clientes_contratos WHERE id_cliente = '$retorno' AND (status='1' OR status='11' OR status='2')");

if(mysqli_num_rows($sel) <= '0'){
echo '<option value="0">Nenhum contrato encontrado</option>';
}else{
echo '<option value="0">Selecione o Contrato</option>';
	while($res = mysqli_fetch_array($sel)){
	$nr_contrato = $res['nr_contrato'];
	$valor    = $res['valor'];
	$valor = number_format($valor, 2, ",", ".");
	echo '<option value="'.$nr_contrato.'">Contrato: '.$nr_contrato.' - Mensalidade: R$ '.$valor.'</option>';
	}
	}

?>
	
	