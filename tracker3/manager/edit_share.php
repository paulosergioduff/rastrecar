  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('conexao.php');


$id_veiculo = 	$_POST['id_veiculo'];
$deviceid = 	$_POST['deviceid'];
$usuarios = 	$_POST['usuarios'];
$id_cliente = 	$_POST['customer'];






$usuarios1 = 	$_POST['usuarios'];
//$veiculos1[] = $veiculos1;
$usuarios = implode(",",$usuarios1);

$usuarios = str_replace(',Array', '', $usuarios);


	$cons_veic = mysqli_query($conn,"SELECT * FROM usuarios WHERE id_usuarios IN ($usuarios)");
		if(mysqli_num_rows($cons_veic) > 0){
			while ($resp_veic = mysqli_fetch_assoc($cons_veic)) {
			$id_usuarios = 	$resp_veic['id_usuarios'];
			$veiculos = 	$resp_veic['veiculos'];
			$nome = 	$resp_veic['nome'];
			$veiculos2 = $veiculos.','.$deviceid;
			
			$sql = mysqli_query($conn, "UPDATE usuarios SET veiculos='$veiculos2' WHERE id_usuarios='$id_usuarios'");
		}}


$sql2 = mysqli_query($conn, "UPDATE veiculos_clientes SET share='$usuarios' WHERE deviceid='$deviceid'");


$base64 = 'id_cliente:'.$id_cliente.'&id_veiculo:'.$id_veiculo.'';
$base64 = base64_encode($base64);

header ('location: share_veiculos.php?c='.$base64.'');












?>
