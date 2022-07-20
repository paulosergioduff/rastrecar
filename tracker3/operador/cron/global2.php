<?php
date_default_timezone_set('America/Sao_Paulo');
include_once("conexao.php");

$data_hoje = date('Y-m-d H:i');
$hora_agora = date('H:i');






?>
<?php

$hora = date('H:i');

$data_hoje = date('Y-m-d');
//$data_hoje = '2021-07-02';
$data_agora = date('Y-m-d H:i:s');


$dia_cont_5 = date('Y-m-d', strtotime('+5 days', strtotime($data_hoje)));
$dia_cont_10 = date('Y-m-d', strtotime('+19 days', strtotime($data_hoje)));

$dias_5 = date('d', strtotime("$dia_cont_5"));
$dias_10 = date('d', strtotime("$dia_cont_10"));
$dias_hoje = date('d', strtotime("$data_hoje"));

$mes_vencimento = date('m', strtotime("$data_hoje"));
$ano_vencimento = date('Y', strtotime("$data_hoje"));

if($dias_hoje == '01' && $hora >= '06:00' && $hora <= '07:00'){
$cons_recorrencia_5 = mysqli_query($conn, "SELECT * FROM recorrencia_pagar WHERE ultima_conta != '$data_hoje' ORDER BY id_recorrencia ASC");
	if(mysqli_num_rows($cons_recorrencia_5) > 0){
		while ($resp_recorrencia_5 = mysqli_fetch_assoc($cons_recorrencia_5)) {
		$id_recorrencia = 	$resp_recorrencia_5['id_recorrencia'];
		$duplicata = 	$resp_recorrencia_5['duplicata'];
		$descricao = 	$resp_recorrencia_5['descricao'];
		$valor_bruto = 	$resp_recorrencia_5['valor_bruto'];
		$banco = 	$resp_recorrencia_5['banco'];
		$observacoes = 	$resp_recorrencia_5['observacoes'];
		$especie = 	$resp_recorrencia_5['juros'];
		$class_financeira = 	$resp_recorrencia_5['class_financeira'];
		$dia_vencimento = 	$resp_recorrencia_5['dia_vencimento'];
		$data_vencimento = 	$ano_vencimento.'-'.$mes_vencimento.'-'.$dia_vencimento;
		
		echo $duplicata.' - '.$descricao.'<br>';
		
		$sql11 = mysqli_query($conn, "INSERT INTO contas_pagar (duplicata, data_emissao, data_vencimento,  descricao, valor_bruto, observacoes, banco, especie, class_financeira, status, qtd_parcelas) VALUES ('$duplicata', '$data_hoje', '$data_vencimento',  '$descricao', '$valor_bruto', '$observacoes', '$banco', '$especie', '$class_financeira', 'Em Aberto', '1')");
		
		$sql_rec = mysqli_query($conn, "UPDATE recorrencia_pagar SET ultima_conta='$data_hoje' WHERE id_recorrencia = '$id_recorrencia'");

	}}
}



#=====================================

$data_v = date('Y-m-d');
$data_v = date('Y-m-d', strtotime('-2 days', strtotime($data_v)));


if($hora >= '06:00' && $hora <= '07:00'){
$cons_cliente = mysqli_query($conn,"SELECT * FROM clientes ORDER BY id_cliente ASC");
	if(mysqli_num_rows($cons_cliente) > 0){
		while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
		$status = 	$resp_cliente['status'];
		$id_cliente = 	$resp_cliente['id_cliente'];
		$nome_cliente = 	$resp_cliente['nome_cliente'];

	$cons_status = mysqli_query($conn,"SELECT * FROM status WHERE id_status='$status'");
		if(mysqli_num_rows($cons_status) > 0){
			while ($resp_status = mysqli_fetch_assoc($cons_status)) {
				$status_cliente = 	$resp_status['status'];
		}}
		
	$cons_contas = mysqli_query($con,"SELECT * FROM contas_receber WHERE descricao='$nome_cliente' AND status='Em Aberto' AND data_vencimento < '$data_v'");
	$total_c = mysqli_num_rows($cons_contas);
	
	if($total_c >= 1){
		$sql = mysqli_query($con,"UPDATE clientes SET status_pg='ATRASO' WHERE id_cliente='$id_cliente'");
	} 
	if($total_c <= 0){
		$inform = $nome_cliente;
		$sql = mysqli_query($con,"UPDATE clientes SET status_pg='EM DIA' WHERE id_cliente='$id_cliente'");
	}

	$sql2 = mysqli_query($conn,"UPDATE clientes SET status2='$status_cliente' WHERE id_cliente='$id_cliente'");

	}}
}


#===========================================
#================= RELATORIO CONEXOES =================


$data_agora = date('Y-m-d H:i:s');
$data_agora = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_agora)));

$data_inicial_12 = date('Y-m-d H:i:s', strtotime('-5 minutes', strtotime($data_agora)));

$id_unico = date('YmdHi');
$hora_rel = date('H:i');
$minuto_rel = date('i');
$data_rel = date('Y-m-d');

$cont_veiculos_off = mysqli_query($conn,"SELECT * FROM tc_devices WHERE lastupdate < '$data_inicial_12' AND contact != 'ESTOQUE' AND id_empresa='1361'");
$total_off = mysqli_num_rows($cont_veiculos_off);
	
	
$cont_veiculos_on = mysqli_query($conn,"SELECT * FROM tc_devices WHERE lastupdate >= '$data_inicial_12' AND contact != 'ESTOQUE' AND id_empresa='1361'");
$total_on = mysqli_num_rows($cont_veiculos_on);

if($minuto_rel == '00' or $minuto_rel == '10' or $minuto_rel == '20' or $minuto_rel == '30' or $minuto_rel == '40' or $minuto_rel == '50'){
	$sql_conex = mysqli_query($conn,"INSERT IGNORE INTO relatorio_conexoes (id_unico, data, hora, offline, online, id_empresa) VALUES ('$id_unico', '$data_rel', '$hora_rel', '$total_off', '$total_on', '1361')");
}

if($minuto_rel == '05' or $minuto_rel == '15' or $minuto_rel == '25' or $minuto_rel == '35' or $minuto_rel == '45' or $minuto_rel == '55'){
	$sql_conex = mysqli_query($conn,"INSERT IGNORE INTO relatorio_conexoes (id_unico, data, hora, offline, online, id_empresa) VALUES ('$id_unico', '$data_rel', '$hora_rel', '$total_off', '$total_on', '1361')");
}


$data_delete = date('Y-m-d');
$data_delete = date('Y-m-d', strtotime('-1 day', strtotime($data_delete)));

$sql_del = mysqli_query($conn, "DELETE FROM relatorio_conexoes WHERE data <= '$data_delete'");

#========================================
/*
$cons_estoque_novo = mysqli_query($conn,"SELECT * FROM tc_devices WHERE contact = 'ESTOQUE'");		
if(mysqli_num_rows($cons_estoque_novo) > 0){
	while ($resp_estoque_novo = mysqli_fetch_assoc($cons_estoque_novo)) {
	$deviceid = 	$resp_estoque_novo['id'];
	$imei = 	$resp_estoque_novo['uniqueid'];
	$lastupdate = 	$resp_estoque_novo['lastupdate'];
	$positionid = 	$resp_estoque_novo['positionid'];
	
	if($lastupdate == ''){
		$data_server = 'Sem Conexao';
	}
	
	if($lastupdate != ''){
		$data_server = $lastupdate;
	}
	
	$cons_posicao = mysqli_query($con,"SELECT * FROM tc_positions WHERE id='$positionid'");
			if(mysqli_num_rows($cons_posicao) <= 0){
				$data_gps = 'Sem Posicao';
			}
			if(mysqli_num_rows($cons_posicao) > 0){
				while ($resp_posicao = mysqli_fetch_assoc($cons_posicao)) {
				$data_gps = 	$resp_posicao['devicetime'];
		}}
	
	//$sql_estoque = mysqli_query($conn, "UPDATE estoque_rastreadores SET data_server='$data_server', data_gps='$data_gps', positionid='$positionid' WHERE imei='$imei'");
}}
*/
	
?>