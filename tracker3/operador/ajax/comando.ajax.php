<?php

include("../conexao.php"); // Inclui o arquivo com o sistema de segurança

$resposta = $_POST['comando'];
$imei = $_POST['imei'];
$sql = mysqli_query($conn,"SELECT * FROM comandos_equip WHERE id_comando = '$resposta'");

if(mysqli_num_rows($sql) <= '0'){
echo '';
}else{
	while($x = mysqli_fetch_assoc($sql)){
	$comando    = $x['comando'];
	$comando_st = str_replace('XXXXXXXXX', $imei, $comando); 
	$equipamento    = $x['equipamento'];
	if($equipamento == 'ST310U'){
		echo '<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label>Comando:</label>
					<input type="text" class="form-control" name="sms_comando" id="sms_comando" value="'.$comando_st.'">
				</div>
			</div>
		</div>';
		}
	else if($equipamento == 'ST350'){
		echo '<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label>Comando:</label>
					<input type="text" class="form-control" name="sms_comando" id="sms_comando" value="'.$comando_st.'">
				</div>
			</div>
		</div>';
		}
	else if($equipamento == 'ST240'){
		echo '<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label>Comando:</label>
					<input type="text" class="form-control" name="sms_comando" id="sms_comando" value="'.$comando_st.'">
				</div>
			</div>
		</div>';
		}
	else {
		echo '<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label>Comando:</label>
					<input type="text" class="form-control" name="sms_comando" id="sms_comando" value="'.$comando.'">
				</div>
			</div>
		</div>';
		}
	
	}
}	






?>
	
	