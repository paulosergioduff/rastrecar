<?php
include_once("../../conexao.php");

$data_hoje = date('Y-m-d');
$data_inicial = date('Y-m-01');
$data_inicial_br = date('d/m/Y', strtotime("$data_inicial"));

$id_empresa = $_REQUEST['id_empresa'];

$ult_dia = date("t");
$mes1 = date("m");
$data_final = date('Y-m-').$ult_dia;
$data_final_br = date('d/m/Y', strtotime("$data_final"));

$meses = array("01" => "Janeiro", "02" => "Fevereiro", "03" => "Março", "04" => "Abril", "05" => "Maio", "06" => "Junho", "07" => "Julho", "08" => "Agosto", "09" => "Setembro", "10" => "Outubro", "11" => "Novembro", "12" => "Dezembro");

$mes = $meses[$mes1];
		

	$sql_pago = mysqli_query($conn, "SELECT * FROM contas_receber WHERE id_empresa='$id_empresa' AND (data_vencimento >= '$data_inicial' AND data_vencimento <= '$data_final')");
	if(mysqli_num_rows($sql_pago) <= 0){
		$total_pago = '0,00';
	}
	if(mysqli_num_rows($sql_pago) > 0){
		while($row_pago = mysqli_fetch_assoc($sql_pago)){
			$total_pago1 += $row_pago['valor_bruto'];
			$total_contas = number_format($total_pago1, 2, ",", ".");

	}}
	echo $total_contas;
		
	


?>