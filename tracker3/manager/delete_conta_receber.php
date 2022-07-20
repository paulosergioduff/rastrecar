
  <?php

include_once('conexao.php');



$id_cliente =	$_GET['id_cliente'];
$id_conta =	$_GET['id_conta'];
$pag =	$_GET['pag'];






$del_conta = mysqli_query($conn, "DELETE FROM contas_receber WHERE id_conta='$id_conta'");

$base64 = 'id_cliente:'.$id_cliente.'';
$base64 = base64_encode($base64);


if($pag == 'contas'){
header('Location: contas_receber.php');
}
if($pag == 'cad'){
header('Location: cad_cliente.php?c='.$base64.'');
}

?>
