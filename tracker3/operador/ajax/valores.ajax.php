<?php

include("../conexao.php"); // Inclui o arquivo com o sistema de segurança

$veiculos = $_POST['veiculos'];
$id_empresa = $_POST['id_empresa'];
$sql = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE id_veiculo = '$veiculos' AND id_empresa='$id_empresa'");

if(mysqli_num_rows($sql) <= '0'){
echo '<input class="form-control" name="valor_mensal" id="valor_mensal" onkeypress="return(MascaraMoeda(this,\'.\',\',\',event))" value="0,00" autocomplete="off" type="text">';
}else{
	while($x = mysqli_fetch_assoc($sql)){
	$valor    += $x['valor'];
	$valor = number_format($valor, 2, ",", ".");
	
	echo '<input class="form-control" name="valor_mensal" id="valor_mensal" value="'.$valor.'" onkeypress="return(MascaraMoeda(this,\'.\',\',\',event))"  autocomplete="off" type="text">';
		
	}
}	






?>
	
	