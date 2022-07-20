<?php

include("../conexao.php"); // Inclui o arquivo com o sistema de segurança

$retorno = $_POST['nr_contrato'];
$sel = mysqli_query($conn,"SELECT * FROM clientes_contratos WHERE nr_contrato = '$retorno'");

if(mysqli_num_rows($sel) <= '0'){
echo '<input type="text" class="form-control" name="valor_bruto" id="valor_bruto" onkeypress="return(MascaraMoeda(this,'.',',',event))" value="0,00" required>';
}else{
	while($res = mysqli_fetch_array($sel)){
	$nr_contrato = $res['nr_contrato'];
	$valor    = $res['valor'];
	$valor = number_format($valor, 2, ",", ".");
	echo '<input type="text" class="form-control" name="valor_bruto" id="valor_bruto" onkeypress="return(MascaraMoeda(this,'.',',',event))" value="'.$valor.'" required>';
	}
	}

?>
	
	