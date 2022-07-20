

<?php
//header("Content-Type: text/html;  charset=ISO-8859-1",true);

include('conexao.php');

	$cons_especie = mysqli_query($conn,"SELECT * FROM veiculos_clientes ORDER BY id_veiculo ASC");
		if(mysqli_num_rows($cons_especie) > 0){
			while ($resp_especie = mysqli_fetch_assoc($cons_especie)) {
			$data_contrato	 = 	$resp_especie['data_contrato'];
			$id_veiculo	 = 	$resp_especie['id_veiculo'];
			
			$sql = mysqli_query($conn,"UPDATE veiculos_clientes SET data_cadastro = '$data_contrato' WHERE id_veiculo='$id_veiculo'");
		}}
?>