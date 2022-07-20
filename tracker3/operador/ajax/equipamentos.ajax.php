<?php

include("../conexao.php"); // Inclui o arquivo com o sistema de segurança

$retorno = $_POST['equipamentos'];

if($retorno == '1'){
	$sel = mysqli_query($conn,"SELECT DISTINCT modelo_equip FROM veiculos_clientes ORDER BY modelo_equip ASC");

	if(mysqli_num_rows($sel) <= '0'){
	echo '<option value="">Nenhum Equipamento encontrado</option>';
	}else{
	echo '<option value="">Selecione...</option><option value="1">Selecionar Todos</option>';

		while($res = mysqli_fetch_array($sel)){
			
		
		$modelo_equip = $res['modelo_equip'];
		$id_cliente    = $res['id_cliente'];
		echo '<option value="'.$modelo_equip.'">'.$modelo_equip.'</option>';
		}
		}
}

if($retorno != '1'){
	$sel = mysqli_query($conn,"SELECT DISTINCT modelo_equip FROM veiculos_clientes WHERE id_cliente = '$retorno' ORDER BY modelo_equip ASC");

	if(mysqli_num_rows($sel) <= '0'){
	echo '<option value="">Nenhum Equipamento encontrado</option>';
	}else{
	echo '<option value="">Selecione...</option><option value="1">Selecionar Todos</option>';

		while($res = mysqli_fetch_array($sel)){
			
		
		$modelo_equip = $res['modelo_equip'];
		$id_cliente    = $res['id_cliente'];
		echo '<option value="'.$modelo_equip.'">'.$modelo_equip.'</option>';
		}
		}
}

?>
	
	