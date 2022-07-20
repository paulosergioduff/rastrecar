  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('conexao.php');


$pag = 	$_POST['pag'];
$nome_user = 	$_POST['nome_user'];
$id_cliente = 	$_POST['customer'];
$login_padrao = 	$_POST['customer_name'];
$id_usuarios = 	$_POST['customer_user'];
$usuario = 	$_POST['usuario'].'@jcrastreamento';
$senha1 = mysqli_real_escape_string($conn, $_POST['nova_senha']);
$senha = md5($senha1);


            
$permite_bloqueio = $_POST['permite_bloqueio'];

if($permite_bloqueio == ''){
	$block = 'NAO';
} else {
	$block = $permite_bloqueio;
}


$ativo = $_POST['ativo'];
if($ativo == ''){
	$ativo1 = 'NAO';
} else {
	$ativo1 = $ativo;
}



$veiculos1 = 	$_POST['id_veiculo2'];
//$veiculos1[] = $veiculos1;
$veiculos = implode(",",$veiculos1);

$veiculos = str_replace(',Array', '', $veiculos);


if($senha1 == ''){
	$sql = mysqli_query($conn, "UPDATE usuarios SET nome='$nome_user', usuario='$usuario', permite_bloqueio='$block', veiculos='$veiculos', ativo='$ativo1' WHERE id_usuarios='$id_usuarios'");
} 
if($senha1 != ''){
	$sql = mysqli_query($conn, "UPDATE usuarios SET nome='$nome_user', usuario='$usuario', senha='$senha', permite_bloqueio='$block', veiculos='$veiculos', ativo='$ativo1' WHERE id_usuarios='$id_usuarios'");
} 






$base64 = 'id_cliente:'.$id_cliente;
$base64 = base64_encode($base64);

if($pag == 'cad'){
	header ('location: cad_cliente.php?c='.$base64.'&user=1');
}
if($pag == 'edit'){
	header ('location: usuarios.php');
}













?>
