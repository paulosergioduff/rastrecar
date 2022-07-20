  <?php

include_once('conexao.php');


$usuario = 	$_REQUEST['usuario'];
$usuario = 	''.$usuario.'@jcrastreamento';
$senha = 	$_REQUEST['senha'];
$senha1 = 	md5($senha);
$id_conta = 	$_REQUEST['id_conta_del'];
$id_cliente = 	$_REQUEST['id_cliente_del'];
$id_empresa = 	$_REQUEST['customer'];
$banco = 	$_REQUEST['banco_del'];

echo $id_cliente.' - '.$id_empresa.' - '.$banco.' - '.$id_conta;


$base64_conta = 'id_conta:'.$id_conta;
$base64_conta = base64_encode($base64_conta);

$cons_cliente = mysqli_query($conn,"SELECT * FROM usuarios WHERE usuario='$usuario' ORDER BY id_usuarios DESC LIMIT 1");
	if(mysqli_num_rows($cons_cliente) <= 0){
		header('Location: view_conta_receber.php?c='.$base64_conta.'&error=user');
	}
	if(mysqli_num_rows($cons_cliente) > 0){
		while ($row_usuario = mysqli_fetch_assoc($cons_cliente)) {
		$senha_user = $row_usuario['senha'];
		$acesso = $row_usuario['acesso'];
		
		if($acesso == 'GERAL'){
			if($senha_user == $senha1){
				
				if($banco == 1){
					header('Location: delete_boleto_pjb.php?id_conta='.$id_conta.'&id_cliente='.$id_cliente.'&id_empresa='.$id_empresa.'&pag=contas');
				}
				if($banco == 5){
					header('Location: delete_boleto_asaas.php?id_conta='.$id_conta.'&id_cliente='.$id_cliente.'&id_empresa='.$id_empresa.'&pag=contas');
				}
				if($banco == 7){
					$sql4 = mysqli_query($conn,"DELETE FROM contas_receber WHERE id_conta='$id_conta'");
					header('Location: contas_receber.php');
				}
			}
			elseif($senha_user != $senha1){
				header('Location: view_conta_receber.php?c='.$base64_conta.'&error=psw');
			}
		}
		if($acesso != 'GERAL'){
			header('Location: view_conta_receber.php?c='.$base64_conta.'&error=profile');
		}
		
	}}


















?>
