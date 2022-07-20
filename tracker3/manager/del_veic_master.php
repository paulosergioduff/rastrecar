  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('conexao.php');


$id_usuarios = 	$_REQUEST['id_usuarios'];
$deviceid = 	$_REQUEST['deviceid'];


	$cons_veiculo = mysqli_query($conn,"SELECT * FROM usuarios WHERE id_usuarios='$id_usuarios'");
		if(mysqli_num_rows($cons_veiculo) > 0){
			while ($resp_veiculo = mysqli_fetch_array($cons_veiculo)) {
			$veiculos = 	$resp_veiculo['veiculos'];
			$veiculos = explode(",", $veiculos);
			//$veiculos[] = $veiculos;
			
			$key = array_search($deviceid, $veiculos);
			if($key!==false){
				unset($veiculos[$key]);
			}
			$veiculos = implode(",",$veiculos);
			
			
			
			$sql = mysqli_query($conn,"UPDATE usuarios SET veiculos='$veiculos' WHERE id_usuarios='$id_usuarios'");
	}}
	
$base_user = 'id_usuarios:'.$id_usuarios;
$base_user = base64_encode($base_user);
	
	header('Location: editar_usuario_master.php?c='.$base_user.'');

?>
