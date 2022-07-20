  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once('conexao.php');

$date = date('Y-m-d');
$hora = date('H:i:s');
$user = $_POST['user_nome'];
$id_conta = $_POST['id_conta'];

$duplicata	 = 	$_POST['duplicata'];
$data_emissao = 	$_POST['data_emissao'];
$data_vencimento = 	$_POST['data_vencimento'];
$descricao = 	$_POST['descricao'];
$valor_bruto = 	$_POST['valor_bruto'];
$valor_bruto = str_replace(".","","$valor_bruto");
$valor_bruto = str_replace(",",".","$valor_bruto");
$observacoes	 = 	$_POST['observacoes'];
$banco	 = 	$_POST['banco'];
$especie	 = 	$_POST['especie'];
$class_financeira = 	$_POST['class_financeira'];
$qtd_parcelas = $_POST['qtd_parcelas'];
$id_empresa = $_POST['customer_emp'];
$user_baixa1 = $_POST['user_baixa'];



for($x = 0; $x < $qtd_parcelas; $x++){
	$dt_parcelas[] = date('Y-m-d', strtotime('+'.$x.' month', strtotime($data_vencimento)));
	
}


foreach($dt_parcelas as $indice => $datas){
	$indice1 = $indice+1;
	$nr_parcela = ''.$indice1.' de '.$qtd_parcelas.'';

$sql11 = "UPDATE contas_pagar SET duplicata='$duplicata', data_emissao='$data_emissao', data_vencimento='$datas',  descricao='$descricao', valor_bruto='$valor_bruto', observacoes='$observacoes', banco='$banco', especie='$especie', class_financeira='$class_financeira', qtd_parcelas='$qtd_parcelas', nr_parcela='$nr_parcela' WHERE id_conta='$id_conta'";

if (mysqli_query($conn, $sql11)) {
      echo "New record created successfully";
} else {
      echo "Error OS: " . $sql11 . "<br>" . mysqli_error($conn);
}
}

$base64 = 'id_conta:'.$id_conta;
$base64 = base64_encode($base64);

header('Location: view_conta_pagar.php?c='.$base64.'');







?>
