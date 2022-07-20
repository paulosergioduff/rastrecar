  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('conexao.php');


$id_usuarios = 	$_REQUEST['id_usuarios'];
$deviceid = 	$_REQUEST['deviceid'];



$cons_veic = mysqli_query($conn,"SELECT * FROM usuarios WHERE id_usuarios='$id_usuarios'");
		if(mysqli_num_rows($cons_veic) > 0){
			while ($resp_veic = mysqli_fetch_assoc($cons_veic)) {
			$veiculos = 	$resp_veic['veiculos'];
			$veiculos = explode(",", $veiculos);
			$key = array_search($deviceid, $veiculos);
			if($key!==false){
				unset($veiculos[$key]);
			}
			$veiculos2 = implode(",",$veiculos);
			
			$sql = mysqli_query($conn, "UPDATE usuarios SET veiculos='$veiculos2' WHERE id_usuarios='$id_usuarios'");
		}}


$cons_veic1 = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE deviceid='$deviceid'");
		if(mysqli_num_rows($cons_veic1) > 0){
			while ($resp_veic1 = mysqli_fetch_assoc($cons_veic1)) {
			$id_veiculo = 	$resp_veic1['id_veiculo'];
			$share = 	$resp_veic1['share'];
			$share = explode(",", $share);
			$key = array_search($id_usuarios, $share);
			if($key!==false){
				unset($share[$key]);
			}
			$share2 = implode(",",$share);

			$sql3 = mysqli_query($conn, "UPDATE veiculos_clientes SET share='$share2' WHERE deviceid='$deviceid'");
		}}

$base64 = 'id_cliente:'.$id_cliente.'&id_veiculo:'.$id_veiculo.'';
$base64 = base64_encode($base64);

header ('location: share_veiculos.php?c='.$base64.'');












?>
