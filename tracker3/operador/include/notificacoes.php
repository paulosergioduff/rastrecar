<?php

$servidor = "localhost";
$usuario = "root";
$senha = "TR4vcijU6T9Keaw";
$dbname = "traccardb";

//Criar a conexao
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
$con = mysqli_connect($servidor, $usuario, $senha, $dbname);

$hora_atual = date('H:i');
$data_hoje = date('Y-m-d');
$date = date('Y-m-d H:i');

#========== CONTAS A PAGAR VENCENDO HOJE ================

if($hora_atual >= '09:00' && $hora_atual <= '13:00'){
$cons_notif = mysqli_query($conn,"SELECT * FROM contas_pagar WHERE data_vencimento = '$data_hoje' ORDER BY id_conta ASC");
	if(mysqli_num_rows($cons_notif) > 0){
		while ($row_notif = mysqli_fetch_assoc($cons_notif)) {
		$data_vencimento = $row_notif['data_vencimento'];
		$data_vencimento = date('d/m/Y', strtotime("$data_vencimento"));
		$id_conta = $row_notif['id_conta'];
		$descricao = $row_notif['descricao'];
		$id_empresa = $row_notif['id_empresa'];
		$valor_bruto = $row_notif['valor_bruto'];
		$valor_bruto = number_format($valor_bruto, 2, ",", ".");
		
		$id_unico = date('Ymd').$id_conta;
	
		
		$mensagem[] = $descricao.' - R$ '.$valor_bruto;
	}}
	
	$mensag = implode('-br', $mensagem);
	$tipo = 'CONTAS_PAGAR';
	$titulo = 'CONTAS A PAGAR';
	$mensagem = 'Existem contas a pagar vencendo hoje.-br-br'.$mensag;
	
$sql = mysqli_query($conn, "INSERT INTO notificacoes (id_unico, id_empresa, data, tipo, titulo, mensagem) VALUES ('$id_unico', '$id_empresa', '$date', '$tipo', '$titulo', '$mensagem')");
	
}

?>
