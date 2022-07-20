  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('../conexao.php');

$login_padrao = 	$_POST['login_padrao1'];
//$id_empresa = 	'1361';
$usuario = 	$_POST['usuario'].'@rmb';
$senha = mysqli_real_escape_string($conn, $_POST['senha']);
$senha = md5($senha);


$permite_bloqueio = $_POST['permite_bloqueio'];
if($permite_bloqueio == ''){
	$block = 'NAO';
} else {
	$block = $permite_bloqueio;
}
$id_cliente = 	$_POST['id_cliente2'];


$veiculos1 = 	$_POST['id_veiculo2'];
//$veiculos1[] = $veiculos1;
$veiculos = implode(",",$veiculos1);

$veiculos = str_replace(',Array', '', $veiculos);

$tipo_user = 'Cliente';
$nivel = 2;


$cons_cliente = mysqli_query($con,"SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
	if(mysqli_num_rows($cons_cliente) > 0){
while ($result = mysqli_fetch_assoc($cons_cliente)) {
	$nome_cliente = $result['nome_cliente'];
	$email = $result['email'];
	$id_empresa = $result['id_empresa'];
	}}

$sql1 = mysqli_query($conn, "INSERT INTO usuarios (nome, id_cliente, usuario, senha, ativo, nivel, permite_bloqueio, id_empresa, email, veiculos, cargo) VALUES ('$nome_cliente', '$id_cliente', '$usuario', '$senha', 'SIM', '$nivel', '$block', '$id_empresa', '$email', '$veiculos', '$tipo_user')");


$base64 = 'id_cliente:'.$id_cliente.'';
$base64 = base64_encode($base64);


header('Location: ../cad_cliente_acesso.php?c='.$base64.'');
#--------------------------------------------------------------------







?>
