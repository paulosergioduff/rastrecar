
<?php

include("../conexao.php"); // Inclui o arquivo com o sistema de segurança

$retorno = $_POST['campo'];


if($retorno == 'ENTRADA'){
	?>
	
	
		<label>Cliente:</label>
		<select class=" form-control w-100" name="descricao" id="descricao"  required>
		  <option value="">Selecione o Cliente</option>
			<?php
				
				$cons_parceiro = mysqli_query($conn,"SELECT * FROM clientes ORDER BY nome_cliente ASC");
				if(mysqli_num_rows($cons_parceiro) <= 0){
				echo '<option value="0">Nenhum Veiculo Encontrado</option>';
				}else{
				
				while ($res = mysqli_fetch_assoc($cons_parceiro)) {
				$id_cliente = $res['id_cliente'];
				
				$nome_cliente = $res['nome_cliente'];
				echo '<option value="'.$nome_cliente.'">'.$nome_cliente.'</option>';
				}
				}
				?>
		</select>
	
	
	<?php
}




if($retorno == 'SAIDA'){
		?>
	
	
		<label>Origem / Destino:</label>
		<input type="text" name="descricao" id="descricao" class="form-control" required>
	
	
	<?php
}




?>
	
	