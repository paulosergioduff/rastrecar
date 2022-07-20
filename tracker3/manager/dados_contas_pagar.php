<?php

include('conexao.php');
$date = date('Y-m-d');
$mes_atual = date("m");
$ano_atual = date('Y');
$mes_atual1 = ''.$mes_atual.'/'.$ano_atual.'';

$id_empresa = '1361';

$pag_mes_atual = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_pagar WHERE MONTH(data_vencimento)='$mes_atual' AND YEAR(data_vencimento)='$ano_atual' AND status='Pago' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($pag_mes_atual) > 0){
		while ($res_mes_atual = mysqli_fetch_assoc($pag_mes_atual)) {
		$total_pagar = 	$res_mes_atual['SOMA'];
		$total_pagar = round($total_pagar, 2);
		$total_pagar0 = number_format($total_pagar, 2, ",", ".");
		if($total_pagar == ''){
		$total_pagar = 0.00;
		}
		
	
	}}
	

$rec_mes_atual = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_receber WHERE MONTH(data_vencimento)='$mes_atual' AND YEAR(data_vencimento)='$ano_atual' AND status='Pago' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($rec_mes_atual) > 0){
		while ($row_mes_atual = mysqli_fetch_assoc($rec_mes_atual)) {
		$total_receb = 	$row_mes_atual['SOMA'];
		$total_receb = round($total_receb, 2);
		$total_receb0 = number_format($total_receb, 2, ",", ".");
		if($total_receb == ''){
		$total_receb = 0.00;
		}
		
		
	}}
	
	$lucro_mes_atual = $total_receb - $total_pagar;

	
#===================================================================================

$mes_11 = date('Y-m-d', strtotime('-1 month', strtotime($date)));
$mes_1 = date('m', strtotime("$mes_11"));
$ano_1 = date('Y', strtotime("$mes_11"));
$mes1 = ''.$mes_1.'/'.$ano_1.'';

$pag_mes_1 = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_pagar WHERE MONTH(data_vencimento)='$mes_1' AND YEAR(data_vencimento)='$ano_1' AND status='Pago' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($pag_mes_1) > 0){
		while ($resp_mes_1 = mysqli_fetch_assoc($pag_mes_1)) {
		$total_pagar1 = 	$resp_mes_1['SOMA'];
		$total_pagar1 = round($total_pagar1, 2);
		$total_pagar11 = number_format($total_pagar1, 2, ",", ".");
		if($total_pagar1 == ''){
		$total_pagar1 = 0.00;
		}

	}}
	

$rec_mes_1 = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_receber WHERE MONTH(data_vencimento)='$mes_1' AND YEAR(data_vencimento)='$ano_1' AND status='Pago' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($rec_mes_1) > 0){
		while ($row_mes_1 = mysqli_fetch_assoc($rec_mes_1)) {
		$total_receb1 = 	$row_mes_1['SOMA'];
		$total_receb1 = round($total_receb1, 2);
		$total_receb11 = number_format($total_receb1, 2, ",", ".");
		if($total_receb1 == ''){
		$total_receb1 = 0.00;
		}
		

	}}
	
	$lucro_mes1 = $total_receb1 - $total_pagar1;

	
#===================================================================================

$mes_22 = date('Y-m-d', strtotime('-2 month', strtotime($date)));
$mes_2 = date('m', strtotime("$mes_22"));
$ano_2 = date('Y', strtotime("$mes_22"));
$mes2 = ''.$mes_2.'/'.$ano_2.'';

$pag_mes_2 = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_pagar WHERE MONTH(data_vencimento)='$mes_2' AND YEAR(data_vencimento)='$ano_2' AND status='Pago' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($pag_mes_2) > 0){
		while ($resp_mes_2 = mysqli_fetch_assoc($pag_mes_2)) {
		$total_pagar2 = 	$resp_mes_2['SOMA'];
		$total_pagar2 = round($total_pagar2, 2);
		$total_pagar22 = number_format($total_pagar2, 2, ",", ".");
		if($total_pagar2 == ''){
		$total_pagar2 = 0.00;
		}
		

	}}



$rec_mes_2 = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_receber WHERE MONTH(data_vencimento)='$mes_2' AND YEAR(data_vencimento)='$ano_2' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($rec_mes_2) > 0){
		while ($row_mes_2 = mysqli_fetch_assoc($rec_mes_2)) {
		$total_receb2 = 	$row_mes_2['SOMA'];
		$total_receb2 = round($total_receb2, 2);
		$total_receb22 = number_format($total_receb2, 2, ",", ".");


	}}
	
	$lucro_mes2 = $total_receb2 - $total_pagar2;

#===================================================================================

$mes_33 = date('Y-m-d', strtotime('-3 month', strtotime($date)));
$mes_3 = date('m', strtotime("$mes_33"));
$ano_3 = date('Y', strtotime("$mes_33"));
$mes3 = ''.$mes_3.'/'.$ano_3.'';

$pag_mes_3 = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_pagar WHERE MONTH(data_vencimento)='$mes_3' AND YEAR(data_vencimento)='$ano_3' AND status='Pago' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($pag_mes_3) > 0){
		while ($resp_mes_3 = mysqli_fetch_assoc($pag_mes_3)) {
		$total_pagar3 = 	$resp_mes_3['SOMA'];
		$total_pagar3 = round($total_pagar3, 2);
		$total_pagar33 = number_format($total_pagar3, 2, ",", ".");
		if($total_pagar3 == ''){
		$total_pagar3 = 0.00;
		}

	}}

$rec_mes_3 = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_receber WHERE MONTH(data_vencimento)='$mes_3' AND YEAR(data_vencimento)='$ano_3' AND status='Pago' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($rec_mes_3) > 0){
		while ($row_mes_3 = mysqli_fetch_assoc($rec_mes_3)) {
		$total_receb3 = 	$row_mes_3['SOMA'];
		$total_receb3 = round($total_receb3, 2);
		$total_receb33 = number_format($total_receb3, 2, ",", ".");
		if($total_receb3 == ''){
		$total_receb3 = 0.00;
		}
		

	}}
	
	$lucro_mes3 = $total_receb3 - $total_pagar3;

	
#===================================================================================

$mes_44 = date('Y-m-d', strtotime('-4 month', strtotime($date)));
$mes_4 = date('m', strtotime("$mes_44"));
$ano_4 = date('Y', strtotime("$mes_44"));
$mes4 = ''.$mes_4.'/'.$ano_4.'';

$pag_mes_4 = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_pagar WHERE MONTH(data_vencimento)='$mes_4' AND YEAR(data_vencimento)='$ano_4' AND status='Pago' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($pag_mes_4) > 0){
		while ($resp_mes_4 = mysqli_fetch_assoc($pag_mes_4)) {
		$total_pagar4 = 	$resp_mes_4['SOMA'];
		$total_pagar4 = round($total_pagar4, 2);
		$total_pagar33 = number_format($total_pagar4, 2, ",", ".");
		if($total_pagar4 == ''){
		$total_pagar4 = 0.00;
		}
		

	}}
	
$rec_mes_4 = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_receber WHERE MONTH(data_vencimento)='$mes_4' AND YEAR(data_vencimento)='$ano_3' AND status='Pago' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($rec_mes_4) > 0){
		while ($row_mes_4 = mysqli_fetch_assoc($rec_mes_4)) {
		$total_receb4 = 	$row_mes_4['SOMA'];
		$total_receb4 = round($total_receb4, 2);
		$total_receb44 = number_format($total_receb4, 2, ",", ".");
		if($total_receb4 == ''){
		$total_receb4 = 0.00;
		}
		

	}}
	
	$lucro_mes4 = $total_receb4 - $total_pagar4;

	
#===================================================================================

$mes_55 = date('Y-m-d', strtotime('-5 month', strtotime($date)));
$mes_5 = date('m', strtotime("$mes_55"));
$ano_5 = date('Y', strtotime("$mes_55"));
$mes5 = ''.$mes_5.'/'.$ano_5.'';

$pag_mes_5 = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_pagar WHERE MONTH(data_vencimento)='$mes_5' AND YEAR(data_vencimento)='$ano_5' AND status='Pago' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($pag_mes_5) > 0){
		while ($resp_mes_5 = mysqli_fetch_assoc($pag_mes_5)) {
		$total_pagar5 = 	$resp_mes_5['SOMA'];
		$total_pagar5 = round($total_pagar5, 2);
		$total_pagar55 = number_format($total_pagar5, 2, ",", ".");
		if($total_pagar5 == ''){
		$total_pagar5 = 0.00;
		}
		

	}}	
	
$rec_mes_5 = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_receber WHERE MONTH(data_vencimento)='$mes_5' AND YEAR(data_vencimento)='$ano_5' AND status='Pago' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($rec_mes_5) > 0){
		while ($row_mes_5 = mysqli_fetch_assoc($rec_mes_5)) {
		$total_receb5 = 	$row_mes_5['SOMA'];
		$total_receb5 = round($total_receb5, 2);
		$total_receb55 = number_format($total_receb5, 2, ",", ".");
		if($total_receb5 == ''){
		$total_receb5 = 0.00;
		}

	}}
	$lucro_mes5 = $total_receb5 - $total_pagar5;

	
#===================================================================================

$mes_66 = date('Y-m-d', strtotime('-6 month', strtotime($date)));
$mes_6 = date('m', strtotime("$mes_66"));
$ano_6 = date('Y', strtotime("$mes_66"));
$mes6 = ''.$mes_6.'/'.$ano_6.'';

$pag_mes_6 = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_pagar WHERE MONTH(data_vencimento)='$mes_6' AND YEAR(data_vencimento)='$ano_6' AND status='Pago' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($pag_mes_6) > 0){
		while ($resp_mes_6 = mysqli_fetch_assoc($pag_mes_6)) {
		$total_pagar6 = 	$resp_mes_6['SOMA'];
		$total_pagar6 = round($total_pagar6, 2);
		$total_pagar66 = number_format($total_pagar6, 2, ",", ".");
		if($total_pagar6 == ''){
		$total_pagar6 = 0.00;
		}

	}}	


$rec_mes_6 = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_receber WHERE MONTH(data_vencimento)='$mes_6' AND YEAR(data_vencimento)='$ano_6' AND status='Pago' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($rec_mes_6) > 0){
		while ($row_mes_6 = mysqli_fetch_assoc($rec_mes_6)) {
		$total_receb6 = 	$row_mes_6['SOMA'];
		$total_receb6 = round($total_receb6, 2);
		$total_receb66 = number_format($total_receb6, 2, ",", ".");
		if($total_receb6 == ''){
		$total_receb6 = 0.00;
		}

	}}
	
	$lucro_mes6 = $total_receb6 - $total_pagar6;

	
#===================================================================================

$mes_77 = date('Y-m-d', strtotime('-7 month', strtotime($date)));
$mes_7 = date('m', strtotime("$mes_77"));
$ano_7 = date('Y', strtotime("$mes_77"));
$mes7 = ''.$mes_7.'/'.$ano_7.'';

$pag_mes_7 = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_pagar WHERE MONTH(data_vencimento)='$mes_7' AND YEAR(data_vencimento)='$ano_7' AND status='Pago' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($pag_mes_7) > 0){
		while ($resp_mes_7 = mysqli_fetch_assoc($pag_mes_7)) {
		$total_pagar7 = 	$resp_mes_7['SOMA'];
		$total_pagar7 = round($total_pagar7, 2);
		$total_pagar77 = number_format($total_pagar7, 2, ",", ".");
		if($total_pagar7 == ''){
		$total_pagar7 = 0.00;
		}
		

	}}	
	
$rec_mes_7 = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_receber WHERE MONTH(data_vencimento)='$mes_7' AND YEAR(data_vencimento)='$ano_7' AND status='Pago' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($rec_mes_7) > 0){
		while ($row_mes_7 = mysqli_fetch_assoc($rec_mes_7)) {
		$total_receb7 = 	$row_mes_7['SOMA'];
		$total_receb7 = round($total_receb7, 2);
		$total_receb77 = number_format($total_receb7, 2, ",", ".");
		if($total_receb7 == ''){
		$total_receb7 = 0.00;
		}
		

	}}
	
	$lucro_mes7 = $total_receb7 - $total_pagar7;
	


#===================================================================================

$mes_88 = date('Y-m-d', strtotime('-8 month', strtotime($date)));
$mes_8 = date('m', strtotime("$mes_88"));
$ano_8 = date('Y', strtotime("$mes_88"));
$mes8 = ''.$mes_8.'/'.$ano_8.'';

$pag_mes_8 = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_pagar WHERE MONTH(data_vencimento)='$mes_8' AND YEAR(data_vencimento)='$ano_8' AND status='Pago' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($pag_mes_8) > 0){
		while ($resp_mes_8 = mysqli_fetch_assoc($pag_mes_8)) {
		$total_pagar8 = 	$resp_mes_8['SOMA'];
		$total_pagar8 = round($total_pagar8, 2);
		$total_pagar88 = number_format($total_pagar8, 2, ",", ".");
		if($total_pagar8 == ''){
		$total_pagar8 = 0.00;
		}
		

	}}	
	

$rec_mes_8 = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_receber WHERE MONTH(data_vencimento)='$mes_8' AND YEAR(data_vencimento)='$ano_8' AND status='Pago' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($rec_mes_8) > 0){
		while ($row_mes_8 = mysqli_fetch_assoc($rec_mes_8)) {
		$total_receb8 = 	$row_mes_8['SOMA'];
		$total_receb8 = round($total_receb8, 2);
		$total_receb88 = number_format($total_receb8, 2, ",", ".");
		if($total_receb8 == ''){
		$total_receb8 = 0.00;
		}
		

	}}
	
	$lucro_mes8 = $total_receb8 - $total_pagar8;

	
	#===================================================================================

$mes_99 = date('Y-m-d', strtotime('-9 month', strtotime($date)));
$mes_9 = date('m', strtotime("$mes_99"));
$ano_9 = date('Y', strtotime("$mes_99"));
$mes9 = ''.$mes_9.'/'.$ano_9.'';

$pag_mes_9 = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_pagar WHERE MONTH(data_vencimento)='$mes_9' AND YEAR(data_vencimento)='$ano_9' AND status='Pago' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($pag_mes_9) > 0){
		while ($resp_mes_9 = mysqli_fetch_assoc($pag_mes_9)) {
		$total_pagar9 = 	$resp_mes_9['SOMA'];
		$total_pagar9 = round($total_pagar9, 2);
		$total_pagar99 = number_format($total_pagar9, 2, ",", ".");
		if($total_pagar9 == ''){
		$total_pagar9 = 0.00;
		}
		

	}}	

$rec_mes_9 = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_receber WHERE MONTH(data_vencimento)='$mes_9' AND YEAR(data_vencimento)='$ano_9' AND status='Pago' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($rec_mes_9) > 0){
		while ($row_mes_9 = mysqli_fetch_assoc($rec_mes_9)) {
		$total_receb9 = 	$row_mes_9['SOMA'];
		$total_receb9 = round($total_receb9, 2);
		$total_receb99 = number_format($total_receb9, 2, ",", ".");
		if($total_receb9 == ''){
		$total_receb9 = 0.00;
		}
		

	}}
	
	$lucro_mes9 = $total_receb9 - $total_pagar9;

	
	
	#===================================================================================

$mes_101 = date('Y-m-d', strtotime('-10 month', strtotime($date)));
$mes_10 = date('m', strtotime("$mes_101"));
$ano_10 = date('Y', strtotime("$mes_101"));
$mes10 = ''.$mes_10.'/'.$ano_10.'';

$pag_mes_10 = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_pagar WHERE MONTH(data_vencimento)='$mes_10' AND YEAR(data_vencimento)='$ano_10' AND status='Pago' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($pag_mes_10) > 0){
		while ($resp_mes_10 = mysqli_fetch_assoc($pag_mes_10)) {
		$total_pagar10 = 	$resp_mes_10['SOMA'];
		$total_pagar10 = round($total_pagar10, 2);
		$total_pagar101 = number_format($total_pagar10, 2, ",", ".");
		if($total_pagar10 == ''){
		$total_pagar10 = 0.00;
		}
		

	}}	

$rec_mes_10 = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_receber WHERE MONTH(data_vencimento)='$mes_10' AND YEAR(data_vencimento)='$ano_10' AND status='Pago' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($rec_mes_10) > 0){
		while ($row_mes_10 = mysqli_fetch_assoc($rec_mes_10)) {
		$total_receb10 = 	$row_mes_10['SOMA'];
		$total_receb10 = round($total_receb10, 2);
		$total_receb101 = number_format($total_receb10, 2, ",", ".");
		if($total_receb10 == ''){
		$total_receb10 = 0.00;
		}

	}}
	
	$lucro_mes10 = $total_receb10 - $total_pagar10;

	
#===================================================================================

$mes_111 = date('Y-m-d', strtotime('-11 month', strtotime($date)));
$mes_11 = date('m', strtotime("$mes_111"));
$ano_11 = date('Y', strtotime("$mes_111"));
$mes11 = ''.$mes_11.'/'.$ano_11.'';

$pag_mes_11 = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_pagar WHERE MONTH(data_vencimento)='$mes_11' AND YEAR(data_vencimento)='$ano_11' AND status='Pago' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($pag_mes_11) > 0){
		while ($resp_mes_11 = mysqli_fetch_assoc($pag_mes_11)) {
		$total_pagar11 = 	$resp_mes_11['SOMA'];
		$total_pagar11 = round($total_pagar11, 2);
		$total_pagar111 = number_format($total_pagar11, 2, ",", ".");
		if($total_pagar11 == ''){
		$total_pagar11 = 0.00;
		}
		

	}}		

$rec_mes_11 = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_receber WHERE MONTH(data_vencimento)='$mes_11' AND YEAR(data_vencimento)='$ano_11' AND status='Pago' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($rec_mes_11) > 0){
		while ($row_mes_11 = mysqli_fetch_assoc($rec_mes_11)) {
		$total_receb11 = 	$row_mes_11['SOMA'];
		$total_receb11 = round($total_receb11, 2);
		$total_receb111 = number_format($total_receb11, 2, ",", ".");
		if($total_receb11 == ''){
		$total_receb11 = 0.00;
		}
		

	}}
	$lucro_mes11 = $total_receb11 - $total_pagar11;

	
#===================================================================================

$mes_121 = date('Y-m-d', strtotime('-12 month', strtotime($date)));
$mes_12 = date('m', strtotime("$mes_121"));
$ano_12 = date('Y', strtotime("$mes_121"));
$mes12 = ''.$mes_12.'/'.$ano_12.'';

$pag_mes_12 = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_pagar WHERE MONTH(data_vencimento)='$mes_12' AND YEAR(data_vencimento)='$ano_12' AND status='Pago' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($pag_mes_12) > 0){
		while ($resp_mes_12 = mysqli_fetch_assoc($pag_mes_12)) {
		$total_pagar12 = 	$resp_mes_12['SOMA'];
		$total_pagar12 = round($total_pagar12, 2);
		$total_pagar121 = number_format($total_pagar12, 2, ",", ".");
		if($total_pagar12 == ''){
		$total_pagar12 = 0.00;
		}
		

	}}	
	
$rec_mes_12 = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_receber WHERE MONTH(data_vencimento)='$mes_12' AND YEAR(data_vencimento)='$ano_12' AND status='Pago' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($rec_mes_12) > 0){
		while ($row_mes_12 = mysqli_fetch_assoc($rec_mes_12)) {
		$total_receb12 = 	$row_mes_12['SOMA'];
		$total_receb12 = round($total_receb12, 2);
		$total_receb121 = number_format($total_receb12, 2, ",", ".");
		if($total_receb12 == ''){
		$total_receb12 = 0.00;
		}

	}}
	
	
	$lucro_mes12 = $total_receb12 - $total_pagar12;

	
?>