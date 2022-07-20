<?php

include('conexao.php');
$date = date('Y-m-d');
$mes_atual1 = date("m");
$ano_atual = date('Y');
$mes_atual = ''.$mes_atual1.'/'.$ano_atual.'';
$data_inicio = ''.$ano_atual.'-'.$mes_atual1.'-01';

$id_empresa = '1361';

$pago_mes_atual = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_receber WHERE MONTH(data_vencimento)='$mes_atual1' AND YEAR(data_vencimento)='$ano_atual' AND status='Pago' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($pago_mes_atual) > 0){
		while ($pg_mes_atual = mysqli_fetch_assoc($pago_mes_atual)) {
		$total_pago_atual = 	$pg_mes_atual['SOMA'];
		$total_pago_atual = round($total_pago_atual, 2);
		$total_pago_atual1 = number_format($total_pago_atual, 2, ",", ".");
		if($total_pago_atual == ''){
		$total_pago_atual = 0.00;
		}
		
	}}


$aberto_mes_atual = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_receber WHERE data_vencimento >= '$date' AND MONTH(data_vencimento)='$mes_atual1' AND status='Em Aberto' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($aberto_mes_atual) > 0){
		while ($row_aberto_mes_atual = mysqli_fetch_assoc($aberto_mes_atual)) {
		$total_aberto_atual = 	$row_aberto_mes_atual['SOMA'];
		$total_aberto_atual = round($total_aberto_atual, 2);
		$total_aberto_atual1 = number_format($total_aberto_atual, 2, ",", ".");
		if($total_aberto_atual == ''){
		$total_aberto_atual = 0.00;
		}
		//echo ''.$mes_atual.' - ABERTO: '.$total_aberto_atual.'<br>';
	}}


$atraso_mes_atual = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_receber WHERE data_vencimento < '$date' AND data_vencimento >= '$data_inicio' AND status='Em Aberto' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($atraso_mes_atual) > 0){
		while ($row_atraso_mes_atual = mysqli_fetch_assoc($atraso_mes_atual)) {
		$total_atraso_atual = 	$row_atraso_mes_atual['SOMA'];
		$total_atraso_atual = round($total_atraso_atual, 2);
		$total_atraso_atual1 = number_format($total_atraso_atual, 2, ",", ".");
		if($total_atraso_atual == ''){
		$total_atraso_atual = 0.00;
		}
		
		//echo ''.$mes_atual.' - ABERTO: '.$total_atraso_atual.'<br>';
	}}
	
	$inadimp_atual = $total_atraso_atual / $total_pago_atual * 100;
	$inadimp_atual = round($inadimp_atual, 2);
	//echo $inadimp_atual.'% <br><br>';
	
	
$qtd_pago_mes_atual = mysqli_query($conn,"SELECT * FROM contas_receber WHERE MONTH(data_vencimento)='$mes_atual1' AND YEAR(data_vencimento)='$ano_atual' AND status='Pago' AND id_empresa='$id_empresa'");
$qtd_pago_mes_atual = mysqli_num_rows($qtd_pago_mes_atual);

$qtd_aberto_mes_atual = mysqli_query($conn,"SELECT * FROM contas_receber WHERE data_vencimento >= '$date' AND MONTH(data_vencimento)='$mes_atual1' AND status='Em Aberto' AND id_empresa='$id_empresa'");
$qtd_aberto_mes_atual = mysqli_num_rows($qtd_aberto_mes_atual);

$qtd_atraso_mes_atual = mysqli_query($conn,"SELECT * FROM contas_receber  WHERE (data_vencimento < '$date' AND data_vencimento >= '$data_inicio') AND status='Em Aberto' AND id_empresa='$id_empresa'");
$qtd_atraso_mes_atual = mysqli_num_rows($qtd_atraso_mes_atual);

$qtd_atraso_mes = 0;

#===================================================================================

$mes_11 = date('Y-m-d', strtotime('-1 month', strtotime($date)));
$mes_1 = date('m', strtotime("$mes_11"));
$ano_1 = date('Y', strtotime("$mes_11"));
$mes1 = ''.$mes_1.'/'.$ano_1.'';


$pago_mes_1 = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_receber WHERE MONTH(data_vencimento)='$mes_1' AND YEAR(data_vencimento)='$ano_1' AND status='Pago' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($pago_mes_1) > 0){
		while ($pg_mes_1 = mysqli_fetch_assoc($pago_mes_1)) {
		$total_pago_mes1 = 	$pg_mes_1['SOMA'];
		$total_pago_mes1 = round($total_pago_mes1, 2);
		$total_pago_mes11 = number_format($total_pago_mes1, 2, ",", ".");
		if($total_pago_mes1 == ''){
		$total_pago_mes1 = 0.00;
		}
		//echo ''.$mes1.' - PAGO: '.$total_pago_mes1.'<br>';
	}}	
	
	
$atraso_mes_1 = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_receber WHERE MONTH(data_vencimento)='$mes_1' AND YEAR(data_vencimento)='$ano_1' AND status='Em Aberto' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($atraso_mes_1) > 0){
		while ($row_atraso_mes_1 = mysqli_fetch_assoc($atraso_mes_1)) {
		$total_atraso_mes1 = 	$row_atraso_mes_1['SOMA'];
		$total_atraso_mes1 = round($total_atraso_mes1, 2);
		$total_atraso_mes11 = number_format($total_atraso_mes11, 2, ",", ".");
		if($total_atraso_mes1 == ''){
		$total_atraso_mes1 = 0.00;
		}
		
		//echo ''.$mes1.' - ATRASO: '.$total_atraso_mes1.'<br>';
	}}	
	
	$inadimp_mes1 = $total_atraso_mes1 / $total_pago_mes1 * 100;
	$inadimp_mes1 = round($inadimp_mes1, 2);
	$total_aberto1 = 0.00;
	//echo $inadimp_mes1.'<br><br>';
	
$qtd_pago_mes_1 = mysqli_query($conn,"SELECT * FROM contas_receber WHERE MONTH(data_vencimento)='$mes_1' AND YEAR(data_vencimento)='$ano_1' AND status='Pago' AND id_empresa='$id_empresa'");
$qtd_pago_mes_1 = mysqli_num_rows($qtd_pago_mes_1);


$qtd_atraso_mes_1 = mysqli_query($conn,"SELECT * FROM contas_receber WHERE MONTH(data_vencimento)='$mes_1' AND YEAR(data_vencimento)='$ano_1' AND status='Em Aberto' AND id_empresa='$id_empresa'");
$qtd_atraso_mes_1 = mysqli_num_rows($qtd_atraso_mes_1);
	
	
#===================================================================================

$mes_22 = date('Y-m-d', strtotime('-2 month', strtotime($date)));
$mes_2 = date('m', strtotime("$mes_22"));
$ano_2 = date('Y', strtotime("$mes_22"));
$mes2 = ''.$mes_2.'/'.$ano_2.'';


$pago_mes_2 = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_receber WHERE MONTH(data_vencimento)='$mes_2' AND YEAR(data_vencimento)='$ano_2' AND status='Pago' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($pago_mes_2) > 0){
		while ($pg_mes_2 = mysqli_fetch_assoc($pago_mes_2)) {
		$total_pago_mes2 = 	$pg_mes_2['SOMA'];
		$total_pago_mes2 = round($total_pago_mes2, 2);
		$total_pago_mes21 = number_format($total_pago_mes2, 2, ",", ".");
		if($total_pago_mes2 == ''){
		$total_pago_mes2 = 0.00;
		}
		//echo ''.$mes2.' - PAGO: '.$total_pago_mes2.'<br>';
	}}	
	
	
$atraso_mes_2 = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_receber WHERE MONTH(data_vencimento)='$mes_2' AND YEAR(data_vencimento)='$ano_2' AND status='Em Aberto' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($atraso_mes_2) > 0){
		while ($row_atraso_mes_2 = mysqli_fetch_assoc($atraso_mes_2)) {
		$total_atraso_mes2 = 	$row_atraso_mes_2['SOMA'];
		$total_atraso_mes2 = round($total_atraso_mes2, 2);
		$total_atraso_mes21 = number_format($total_atraso_mes2, 2, ",", ".");
		if($total_atraso_mes2 == ''){
		$total_atraso_mes2 = 0.00;
		}
		
		//echo ''.$mes2.' - ATRASO: '.$total_atraso_mes2.'<br>';
	}}	
	
	$inadimp_mes2 = $total_atraso_mes2 / $total_pago_mes2 * 100;
	$inadimp_mes2 = round($inadimp_mes2, 2);
	$total_aberto2 = 0.00;
	
$qtd_pago_mes_2 = mysqli_query($conn,"SELECT * FROM contas_receber WHERE MONTH(data_vencimento)='$mes_2' AND YEAR(data_vencimento)='$ano_2' AND status='Pago' AND id_empresa='$id_empresa'");
$qtd_pago_mes_2 = mysqli_num_rows($qtd_pago_mes_2);


$qtd_atraso_mes_2 = mysqli_query($conn,"SELECT * FROM contas_receber WHERE MONTH(data_vencimento)='$mes_2' AND YEAR(data_vencimento)='$ano_2' AND status='Em Aberto' AND id_empresa='$id_empresa'");
$qtd_atraso_mes_2 = mysqli_num_rows($qtd_atraso_mes_2);
	
#===================================================================================

$mes_33 = date('Y-m-d', strtotime('-3 month', strtotime($date)));
$mes_3 = date('m', strtotime("$mes_33"));
$ano_3 = date('Y', strtotime("$mes_33"));
$mes3 = ''.$mes_3.'/'.$ano_3.'';


$pago_mes_3 = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_receber WHERE MONTH(data_vencimento)='$mes_3' AND YEAR(data_vencimento)='$ano_3' AND status='Pago' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($pago_mes_3) > 0){
		while ($pg_mes_3 = mysqli_fetch_assoc($pago_mes_3)) {
		$total_pago_mes3 = 	$pg_mes_3['SOMA'];
		$total_pago_mes3 = round($total_pago_mes3, 2);
		$total_pago_mes31 = number_format($total_pago_mes3, 2, ",", ".");
		if($total_pago_mes3 == ''){
		$total_pago_mes3 = 0.00;
		}
		//echo ''.$mes3.' - PAGO: '.$total_pago_mes3.'<br>';
	}}	
	
	
$atraso_mes_3 = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_receber WHERE MONTH(data_vencimento)='$mes_3' AND YEAR(data_vencimento)='$ano_3' AND status='Em Aberto' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($atraso_mes_3) > 0){
		while ($row_atraso_mes_3 = mysqli_fetch_assoc($atraso_mes_3)) {
		$total_atraso_mes3 = 	$row_atraso_mes_3['SOMA'];
		$total_atraso_mes3 = round($total_atraso_mes3, 2);
		$total_atraso_mes31 = number_format($total_atraso_mes3, 2, ",", ".");
		if($total_atraso_mes3 == ''){
		$total_atraso_mes3 = 0.00;
		}
		
		//echo ''.$mes3.' - ATRASO: '.$total_atraso_mes3.'<br>';
	}}	
	
	$inadimp_mes3 = $total_atraso_mes3 / $total_pago_mes3 * 100;
	$inadimp_mes3 = round($inadimp_mes3, 2);
	$total_aberto3 = 0.00;

$qtd_pago_mes_3 = mysqli_query($conn,"SELECT * FROM contas_receber WHERE MONTH(data_vencimento)='$mes_3' AND YEAR(data_vencimento)='$ano_3' AND status='Pago' AND id_empresa='$id_empresa'");
$qtd_pago_mes_3 = mysqli_num_rows($qtd_pago_mes_3);


$qtd_atraso_mes_3 = mysqli_query($conn,"SELECT * FROM contas_receber WHERE MONTH(data_vencimento)='$mes_3' AND YEAR(data_vencimento)='$ano_3' AND status='Em Aberto' AND id_empresa='$id_empresa'");
$qtd_atraso_mes_3 = mysqli_num_rows($qtd_atraso_mes_3);

#===================================================================================

$mes_44 = date('Y-m-d', strtotime('-4 month', strtotime($date)));
$mes_4 = date('m', strtotime("$mes_44"));
$ano_4 = date('Y', strtotime("$mes_44"));
$mes4 = ''.$mes_4.'/'.$ano_4.'';


$pago_mes_4 = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_receber WHERE MONTH(data_vencimento)='$mes_4' AND YEAR(data_vencimento)='$ano_4' AND status='Pago' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($pago_mes_4) > 0){
		while ($pg_mes_4 = mysqli_fetch_assoc($pago_mes_4)) {
		$total_pago_mes4 = 	$pg_mes_4['SOMA'];
		$total_pago_mes4 = round($total_pago_mes4, 2);
		$total_pago_mes41 = number_format($total_pago_mes4, 2, ",", ".");
		if($total_pago_mes4 == ''){
		$total_pago_mes4 = 0.00;
		}
		//echo ''.$mes4.' - PAGO: '.$total_pago_mes4.'<br>';
	}}	
	
	
$atraso_mes_4 = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_receber WHERE MONTH(data_vencimento)='$mes_4' AND YEAR(data_vencimento)='$ano_4' AND status='Em Aberto' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($atraso_mes_4) > 0){
		while ($row_atraso_mes_4 = mysqli_fetch_assoc($atraso_mes_4)) {
		$total_atraso_mes4 = 	$row_atraso_mes_4['SOMA'];
		$total_atraso_mes4 = round($total_atraso_mes4, 2);
		$total_atraso_mes41 = number_format($total_atraso_mes4, 2, ",", ".");
		if($total_atraso_mes4 == ''){
		$total_atraso_mes4 = 0.00;
		}
		
		//echo ''.$mes4.' - ATRASO: '.$total_atraso_mes4.'<br>';
	}}	
	
	$inadimp_mes4 = $total_atraso_mes4 / $total_pago_mes4 * 100;
	$inadimp_mes4 = round($inadimp_mes4, 2);
	$total_aberto4 = 0.00;
	
$qtd_pago_mes_4 = mysqli_query($conn,"SELECT * FROM contas_receber WHERE MONTH(data_vencimento)='$mes_4' AND YEAR(data_vencimento)='$ano_4' AND status='Pago' AND id_empresa='$id_empresa'");
$qtd_pago_mes_4 = mysqli_num_rows($qtd_pago_mes_4);


$qtd_atraso_mes_4 = mysqli_query($conn,"SELECT * FROM contas_receber WHERE MONTH(data_vencimento)='$mes_4' AND YEAR(data_vencimento)='$ano_4' AND status='Em Aberto' AND id_empresa='$id_empresa'");
$qtd_atraso_mes_4 = mysqli_num_rows($qtd_atraso_mes_4);	

#===================================================================================

$mes_55 = date('Y-m-d', strtotime('-5 month', strtotime($date)));
$mes_5 = date('m', strtotime("$mes_55"));
$ano_5 = date('Y', strtotime("$mes_55"));
$mes5 = ''.$mes_5.'/'.$ano_5.'';


$pago_mes_5 = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_receber WHERE MONTH(data_vencimento)='$mes_5' AND YEAR(data_vencimento)='$ano_5' AND status='Pago' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($pago_mes_5) > 0){
		while ($pg_mes_5 = mysqli_fetch_assoc($pago_mes_5)) {
		$total_pago_mes5 = 	$pg_mes_5['SOMA'];
		$total_pago_mes5 = round($total_pago_mes5, 2);
		$total_pago_mes51 = number_format($total_pago_mes5, 2, ",", ".");
		if($total_pago_mes5 == ''){
		$total_pago_mes5 = 0.00;
		}
		//echo ''.$mes5.' - PAGO: '.$total_pago_mes5.'<br>';
	}}	
	
	
$atraso_mes_5 = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_receber WHERE MONTH(data_vencimento)='$mes_5' AND YEAR(data_vencimento)='$ano_5' AND status='Em Aberto' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($atraso_mes_5) > 0){
		while ($row_atraso_mes_5 = mysqli_fetch_assoc($atraso_mes_5)) {
		$total_atraso_mes5 = 	$row_atraso_mes_5['SOMA'];
		$total_atraso_mes5 = round($total_atraso_mes5, 2);
		$total_atraso_mes51 = number_format($total_atraso_mes5, 2, ",", ".");
		if($total_atraso_mes5 == ''){
		$total_atraso_mes5 = 0.00;
		}
		
		//echo ''.$mes5.' - ATRASO: '.$total_atraso_mes5.'<br>';
	}}	
	
	$inadimp_mes5 = $total_atraso_mes5 / $total_pago_mes5 * 100;
	$inadimp_mes5 = round($inadimp_mes5, 2);
	$total_aberto5 = 0.00;	

$qtd_pago_mes_5 = mysqli_query($conn,"SELECT * FROM contas_receber WHERE MONTH(data_vencimento)='$mes_5' AND YEAR(data_vencimento)='$ano_5' AND status='Pago' AND id_empresa='$id_empresa'");
$qtd_pago_mes_5 = mysqli_num_rows($qtd_pago_mes_5);


$qtd_atraso_mes_5 = mysqli_query($conn,"SELECT * FROM contas_receber WHERE MONTH(data_vencimento)='$mes_5' AND YEAR(data_vencimento)='$ano_5' AND status='Em Aberto' AND id_empresa='$id_empresa'");
$qtd_atraso_mes_5 = mysqli_num_rows($qtd_atraso_mes_5);
	
#===================================================================================

$mes_66 = date('Y-m-d', strtotime('-6 month', strtotime($date)));
$mes_6 = date('m', strtotime("$mes_66"));
$ano_6 = date('Y', strtotime("$mes_66"));
$mes6 = ''.$mes_6.'/'.$ano_6.'';


$pago_mes_6 = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_receber WHERE MONTH(data_vencimento)='$mes_6' AND YEAR(data_vencimento)='$ano_6' AND status='Pago' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($pago_mes_6) > 0){
		while ($pg_mes_6 = mysqli_fetch_assoc($pago_mes_6)) {
		$total_pago_mes6 = 	$pg_mes_6['SOMA'];
		$total_pago_mes6 = round($total_pago_mes6, 2);
		$total_pago_mes61 = number_format($total_pago_mes6, 2, ",", ".");
		if($total_pago_mes6 == ''){
		$total_pago_mes6 = 0.00;
		}
		//echo ''.$mes6.' - PAGO: '.$total_pago_mes6.'<br>';
	}}	
	
	
$atraso_mes_6 = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_receber WHERE MONTH(data_vencimento)='$mes_6' AND YEAR(data_vencimento)='$ano_6' AND status='Em Aberto' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($atraso_mes_6) > 0){
		while ($row_atraso_mes_5 = mysqli_fetch_assoc($atraso_mes_6)) {
		$total_atraso_mes6 = 	$row_atraso_mes_5['SOMA'];
		$total_atraso_mes6 = round($total_atraso_mes6, 2);
		$total_atraso_mes61 = number_format($total_atraso_mes6, 2, ",", ".");
		if($total_atraso_mes6 == ''){
		$total_atraso_mes6 = 0.00;
		}
		
		//echo ''.$mes6.' - ATRASO: '.$total_atraso_mes6.'<br>';
	}}	
	
	$inadimp_mes6 = $total_atraso_mes6 / $total_pago_mes6 * 100;
	$inadimp_mes6 = round($inadimp_mes6, 2);
	//echo $inadimp_mes6.'<br><br>';		
	
	
$qtd_pago_mes_6 = mysqli_query($conn,"SELECT * FROM contas_receber WHERE MONTH(data_vencimento)='$mes_6' AND YEAR(data_vencimento)='$ano_6' AND status='Pago' AND id_empresa='$id_empresa'");
$qtd_pago_mes_6 = mysqli_num_rows($qtd_pago_mes_6);


$qtd_atraso_mes_6 = mysqli_query($conn,"SELECT * FROM contas_receber WHERE MONTH(data_vencimento)='$mes_6' AND YEAR(data_vencimento)='$ano_6' AND status='Em Aberto' AND id_empresa='$id_empresa'");
$qtd_atraso_mes_6 = mysqli_num_rows($qtd_atraso_mes_6);

#===================================================================================
$mes_77 = date('Y-m-d', strtotime('-7 month', strtotime($date)));
$mes_7 = date('m', strtotime("$mes_77"));
$ano_7 = date('Y', strtotime("$mes_77"));
$mes7 = ''.$mes_7.'/'.$ano_7.'';


$pago_mes_7 = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_receber WHERE MONTH(data_vencimento)='$mes_7' AND YEAR(data_vencimento)='$ano_7' AND status='Pago' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($pago_mes_7) > 0){
		while ($pg_mes_7 = mysqli_fetch_assoc($pago_mes_7)) {
		$total_pago_mes7 = 	$pg_mes_7['SOMA'];
		$total_pago_mes7 = round($total_pago_mes7, 2);
		$total_pago_mes71 = number_format($total_pago_mes7, 2, ",", ".");
		if($total_pago_mes7 == ''){
		$total_pago_mes7 = 0.00;
		}
		//echo ''.$mes7.' - PAGO: '.$total_pago_mes7.'<br>';
	}}	
	
	
$atraso_mes_7 = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_receber WHERE MONTH(data_vencimento)='$mes_7' AND YEAR(data_vencimento)='$ano_7' AND status='Em Aberto' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($atraso_mes_7) > 0){
		while ($row_atraso_mes_6 = mysqli_fetch_assoc($atraso_mes_7)) {
		$total_atraso_mes7 = 	$row_atraso_mes_6['SOMA'];
		$total_atraso_mes7 = round($total_atraso_mes7, 2);
		$total_atraso_mes71 = number_format($total_atraso_mes7, 2, ",", ".");
		if($total_atraso_mes7 == ''){
		$total_atraso_mes7 = 0.00;
		}
		
		//echo ''.$mes7.' - ATRASO: '.$total_atraso_mes7.'<br>';
	}}	
	
	$inadimp_mes7 = $total_atraso_mes7 / $total_pago_mes7 * 100;
	$inadimp_mes7 = round($inadimp_mes7, 2);
	//echo $inadimp_mes7.'<br><br>';	
	
$qtd_pago_mes_7 = mysqli_query($conn,"SELECT * FROM contas_receber WHERE MONTH(data_vencimento)='$mes_7' AND YEAR(data_vencimento)='$ano_7' AND status='Pago' AND id_empresa='$id_empresa'");
$qtd_pago_mes_7 = mysqli_num_rows($qtd_pago_mes_7);


$qtd_atraso_mes_7 = mysqli_query($conn,"SELECT * FROM contas_receber WHERE MONTH(data_vencimento)='$mes_7' AND YEAR(data_vencimento)='$ano_7' AND status='Em Aberto' AND id_empresa='$id_empresa'");
$qtd_atraso_mes_7 = mysqli_num_rows($qtd_atraso_mes_7);
	
#===================================================================================
$mes_88 = date('Y-m-d', strtotime('-8 month', strtotime($date)));
$mes_8 = date('m', strtotime("$mes_88"));
$ano_8 = date('Y', strtotime("$mes_88"));
$mes8 = ''.$mes_8.'/'.$ano_8.'';


$pago_mes_8 = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_receber WHERE MONTH(data_vencimento)='$mes_8' AND YEAR(data_vencimento)='$ano_8' AND status='Pago' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($pago_mes_8) > 0){
		while ($pg_mes_8 = mysqli_fetch_assoc($pago_mes_8)) {
		$total_pago_mes8 = 	$pg_mes_8['SOMA'];
		$total_pago_mes8 = round($total_pago_mes8, 2);
		$total_pago_mes81 = number_format($total_pago_mes8, 2, ",", ".");
		if($total_pago_mes8 == ''){
		$total_pago_mes8 = 0.00;
		}
		//echo ''.$mes8.' - PAGO: '.$total_pago_mes8.'<br>';
	}}	
	
	
$atraso_mes_8 = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_receber WHERE MONTH(data_vencimento)='$mes_8' AND YEAR(data_vencimento)='$ano_8' AND status='Em Aberto' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($atraso_mes_8) > 0){
		while ($row_atraso_mes_8 = mysqli_fetch_assoc($atraso_mes_8)) {
		$total_atraso_mes8 = 	$row_atraso_mes_8['SOMA'];
		$total_atraso_mes8 = round($total_atraso_mes8, 2);
		$total_atraso_mes81 = number_format($total_atraso_mes8, 2, ",", ".");
		if($total_atraso_mes8 == ''){
		$total_atraso_mes8 = 0.00;
		}
		
		//echo ''.$mes8.' - ATRASO: '.$total_atraso_mes8.'<br>';
	}}	
	
	$inadimp_mes8 = $total_atraso_mes8 / $total_pago_mes8 * 100;
	$inadimp_mes8 = round($inadimp_mes8, 2);
	//echo $inadimp_mes8.'<br><br>';		


$qtd_pago_mes_8 = mysqli_query($conn,"SELECT * FROM contas_receber WHERE MONTH(data_vencimento)='$mes_8' AND YEAR(data_vencimento)='$ano_8' AND status='Pago' AND id_empresa='$id_empresa'");
$qtd_pago_mes_8 = mysqli_num_rows($qtd_pago_mes_8);


$qtd_atraso_mes_8 = mysqli_query($conn,"SELECT * FROM contas_receber WHERE MONTH(data_vencimento)='$mes_8' AND YEAR(data_vencimento)='$ano_8' AND status='Em Aberto' AND id_empresa='$id_empresa'");
$qtd_atraso_mes_8 = mysqli_num_rows($qtd_atraso_mes_8);
	
#===================================================================================
$mes_99 = date('Y-m-d', strtotime('-9 month', strtotime($date)));
$mes_9 = date('m', strtotime("$mes_99"));
$ano_9 = date('Y', strtotime("$mes_99"));
$mes9 = ''.$mes_9.'/'.$ano_9.'';


$pago_mes_9 = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_receber WHERE MONTH(data_vencimento)='$mes_9' AND YEAR(data_vencimento)='$ano_9' AND status='Pago' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($pago_mes_9) > 0){
		while ($pg_mes_9 = mysqli_fetch_assoc($pago_mes_9)) {
		$total_pago_mes9 = 	$pg_mes_9['SOMA'];
		$total_pago_mes9 = round($total_pago_mes9, 2);
		$total_pago_mes91 = number_format($total_pago_mes9, 2, ",", ".");
		if($total_pago_mes9 == ''){
		$total_pago_mes9 = 0.00;
		}
		//echo ''.$mes9.' - PAGO: '.$total_pago_mes9.'<br>';
	}}	
	
	
$atraso_mes_9 = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_receber WHERE MONTH(data_vencimento)='$mes_9' AND YEAR(data_vencimento)='$ano_9' AND status='Em Aberto' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($atraso_mes_9) > 0){
		while ($row_atraso_mes_9 = mysqli_fetch_assoc($atraso_mes_9)) {
		$total_atraso_mes9 = 	$row_atraso_mes_9['SOMA'];
		$total_atraso_mes9 = round($total_atraso_mes9, 2);
		$total_atraso_mes91 = number_format($total_atraso_mes9, 2, ",", ".");
		if($total_atraso_mes9 == ''){
		$total_atraso_mes9 = 0.00;
		}
		
		//echo ''.$mes9.' - ATRASO: '.$total_atraso_mes9.'<br>';
	}}	
	
	$inadimp_mes9 = $total_atraso_mes9 / $total_pago_mes9 * 100;
	$inadimp_mes9 = round($inadimp_mes9, 2);
	//echo $inadimp_mes9.'<br><br>';	
	
	
$qtd_pago_mes_9 = mysqli_query($conn,"SELECT * FROM contas_receber WHERE MONTH(data_vencimento)='$mes_9' AND YEAR(data_vencimento)='$ano_9' AND status='Pago' AND id_empresa='$id_empresa'");
$qtd_pago_mes_9 = mysqli_num_rows($qtd_pago_mes_9);


$qtd_atraso_mes_9 = mysqli_query($conn,"SELECT * FROM contas_receber WHERE MONTH(data_vencimento)='$mes_9' AND YEAR(data_vencimento)='$ano_9' AND status='Em Aberto' AND id_empresa='$id_empresa'");
$qtd_atraso_mes_9 = mysqli_num_rows($qtd_atraso_mes_9);
		
	#===================================================================================
$mes_101 = date('Y-m-d', strtotime('-10 month', strtotime($date)));
$mes_10 = date('m', strtotime("$mes_101"));
$ano_10 = date('Y', strtotime("$mes_101"));
$mes10 = ''.$mes_10.'/'.$ano_10.'';


$pago_mes_10 = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_receber WHERE MONTH(data_vencimento)='$mes_10' AND YEAR(data_vencimento)='$ano_10' AND status='Pago' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($pago_mes_10) > 0){
		while ($pg_mes_10 = mysqli_fetch_assoc($pago_mes_10)) {
		$total_pago_mes10 = 	$pg_mes_10['SOMA'];
		$total_pago_mes10 = round($total_pago_mes10, 2);
		$total_pago_mes101 = number_format($total_pago_mes10, 2, ",", ".");
		if($total_pago_mes10 == ''){
		$total_pago_mes10 = 0.00;
		}
		//echo ''.$mes10.' - PAGO: '.$total_pago_mes10.'<br>';
	}}	
	
	
$atraso_mes_10 = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_receber WHERE MONTH(data_vencimento)='$mes_10' AND YEAR(data_vencimento)='$ano_10' AND status='Em Aberto' AND id_empresa='$id_empresa' ");
	if(mysqli_num_rows($atraso_mes_10) > 0){
		while ($row_atraso_mes_10 = mysqli_fetch_assoc($atraso_mes_10)) {
		$total_atraso_mes10 = 	$row_atraso_mes_10['SOMA'];
		$total_atraso_mes10 = round($total_atraso_mes10, 2);
		$total_atraso_mes101 = number_format($total_atraso_mes10, 2, ",", ".");
		if($total_atraso_mes10 == ''){
		$total_atraso_mes10 = 0.00;
		}
		
		//echo ''.$mes10.' - ATRASO: '.$total_atraso_mes10.'<br>';
	}}	
	
	$inadimp_mes10 = $total_atraso_mes10 / $total_pago_mes10 * 100;
	$inadimp_mes10 = round($inadimp_mes10, 2);
	//echo $inadimp_mes10.'<br><br>';	
	
	
$qtd_pago_mes_10 = mysqli_query($conn,"SELECT * FROM contas_receber WHERE MONTH(data_vencimento)='$mes_10' AND YEAR(data_vencimento)='$ano_10' AND status='Pago' AND id_empresa='$id_empresa'");
$qtd_pago_mes_10 = mysqli_num_rows($qtd_pago_mes_10);


$qtd_atraso_mes_10 = mysqli_query($conn,"SELECT * FROM contas_receber WHERE MONTH(data_vencimento)='$mes_10' AND YEAR(data_vencimento)='$ano_10' AND status='Em Aberto' AND id_empresa='$id_empresa'");
$qtd_atraso_mes_10 = mysqli_num_rows($qtd_atraso_mes_10);
	
	#===================================================================================
$mes_111 = date('Y-m-d', strtotime('-11 month', strtotime($date)));
$mes_11 = date('m', strtotime("$mes_111"));
$ano_11 = date('Y', strtotime("$mes_111"));
$mes11 = ''.$mes_11.'/'.$ano_11.'';


$pago_mes_11 = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_receber WHERE MONTH(data_vencimento)='$mes_11' AND YEAR(data_vencimento)='$ano_11' AND status='Pago' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($pago_mes_11) > 0){
		while ($pg_mes_11 = mysqli_fetch_assoc($pago_mes_11)) {
		$total_pago_mes11 = 	$pg_mes_11['SOMA'];
		$total_pago_mes11 = round($total_pago_mes11, 2);
		$total_pago_mes111 = number_format($total_pago_mes11, 2, ",", ".");
		if($total_pago_mes11 == ''){
		$total_pago_mes11 = 0.00;
		}
		//echo ''.$mes11.' - PAGO: '.$total_pago_mes11.'<br>';
	}}	
	
	
$atraso_mes_11 = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_receber WHERE MONTH(data_vencimento)='$mes_11' AND YEAR(data_vencimento)='$ano_11' AND status='Em Aberto' AND id_empresa='$id_empresa' ");
	if(mysqli_num_rows($atraso_mes_11) > 0){
		while ($row_atraso_mes_11 = mysqli_fetch_assoc($atraso_mes_11)) {
		$total_atraso_mes11 = 	$row_atraso_mes_11['SOMA'];
		$total_atraso_mes11 = round($total_atraso_mes11, 2);
		$total_atraso_mes111 = number_format($total_atraso_mes11, 2, ",", ".");
		if($total_atraso_mes11 == ''){
		$total_atraso_mes11 = 0.00;
		}
		
		//echo ''.$mes11.' - ATRASO: '.$total_atraso_mes11.'<br>';
	}}	
	
	$inadimp_mes11 = $total_atraso_mes11 / $total_pago_mes11 * 100;
	$inadimp_mes11 = round($inadimp_mes11, 2);
	//echo $inadimp_mes11.'<br><br>';	
	
	$qtd_pago_mes_11 = mysqli_query($conn,"SELECT * FROM contas_receber WHERE MONTH(data_vencimento)='$mes_11' AND YEAR(data_vencimento)='$ano_11' AND status='Pago' AND id_empresa='$id_empresa'");
$qtd_pago_mes_11 = mysqli_num_rows($qtd_pago_mes_11);


$qtd_atraso_mes_11 = mysqli_query($conn,"SELECT * FROM contas_receber WHERE MONTH(data_vencimento)='$mes_11' AND YEAR(data_vencimento)='$ano_11' AND status='Em Aberto' AND id_empresa='$id_empresa'");
$qtd_atraso_mes_11 = mysqli_num_rows($qtd_atraso_mes_11);
	
	#===================================================================================
$mes_121 = date('Y-m-d', strtotime('-12 month', strtotime($date)));
$mes_12 = date('m', strtotime("$mes_121"));
$ano_12 = date('Y', strtotime("$mes_121"));
$mes12 = ''.$mes_12.'/'.$ano_12.'';


$pago_mes_12 = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_receber WHERE MONTH(data_vencimento)='$mes_12' AND YEAR(data_vencimento)='$ano_12' AND status='Pago' AND id_empresa='$id_empresa'");
	if(mysqli_num_rows($pago_mes_12) > 0){
		while ($pg_mes_12 = mysqli_fetch_assoc($pago_mes_12)) {
		$total_pago_mes12 = 	$pg_mes_12['SOMA'];
		$total_pago_mes12 = round($total_pago_mes12, 2);
		$total_pago_mes121 = number_format($total_pago_mes12, 2, ",", ".");
		if($total_pago_mes12 == ''){
		$total_pago_mes12 = 0.00;
		}
		//echo ''.$mes12.' - PAGO: '.$total_pago_mes12.'<br>';
	}}	
	
	
$atraso_mes_12 = mysqli_query($conn,"SELECT SUM(valor_bruto) as SOMA FROM contas_receber WHERE MONTH(data_vencimento)='$mes_12' AND YEAR(data_vencimento)='$ano_12' AND status='Em Aberto' AND id_empresa='$id_empresa' ");
	if(mysqli_num_rows($atraso_mes_12) > 0){
		while ($row_atraso_mes_12 = mysqli_fetch_assoc($atraso_mes_12)) {
		$total_atraso_mes12 = 	$row_atraso_mes_12['SOMA'];
		$total_atraso_mes12 = round($total_atraso_mes12, 2);
		$total_atraso_mes121 = number_format($total_atraso_mes12, 2, ",", ".");
		if($total_atraso_mes12 == ''){
		$total_atraso_mes12 = 0.00;
		}
		
		//echo ''.$mes11.' - ATRASO: '.$total_atraso_mes12.'<br>';
	}}	
	
	$inadimp_mes12 = $total_atraso_mes12 / $total_pago_mes12 * 100;
	$inadimp_mes12 = round($inadimp_mes12, 2);
	//echo $inadimp_mes12.'<br><br>';	

$qtd_pago_mes_12 = mysqli_query($conn,"SELECT * FROM contas_receber WHERE MONTH(data_vencimento)='$mes_12' AND YEAR(data_vencimento)='$ano_12' AND status='Pago' AND id_empresa='$id_empresa'");
$qtd_pago_mes_12 = mysqli_num_rows($qtd_pago_mes_12);


$qtd_atraso_mes_12 = mysqli_query($conn,"SELECT * FROM contas_receber WHERE MONTH(data_vencimento)='$mes_12' AND YEAR(data_vencimento)='$ano_12' AND status='Em Aberto' AND id_empresa='$id_empresa'");
$qtd_atraso_mes_12 = mysqli_num_rows($qtd_atraso_mes_12);
	
?>