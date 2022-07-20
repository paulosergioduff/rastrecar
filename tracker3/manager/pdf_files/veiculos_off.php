<?php 

include('../conexao.php');	

$data = date('d/m/Y H:i:s');
$data_agora = date('Y-m-d H:i:s');
$data_agora = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_agora)));
$data_5 = date('Y-m-d H:i:s', strtotime('-5 minutes', strtotime($data_agora)));
$data_12 = date('Y-m-d H:i:s', strtotime('-12 hour', strtotime($data_agora)));
$data_24 = date('Y-m-d H:i:s', strtotime('-24 hour', strtotime($data_agora)));

$cons_empresa = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='1361'");
	if(mysqli_num_rows($cons_empresa) > 0){
while ($resp_empresa = mysqli_fetch_assoc($cons_empresa)) {
$nome_url = $resp_empresa['nome_url'];
$logo = $resp_empresa['logo'];
$texto_rodape = $resp_empresa['texto_rodape'];
$texto_topo = $resp_empresa['texto_topo'];
$cor_sistema = $resp_empresa['cor_sistema'];
	}}	

$time = $_GET['time'];


if($time == '12'){
	$tempo = 'até 12h';
	$tabela = "SELECT * FROM tc_devices WHERE lastupdate < '$data_5' AND lastupdate >= '$data_12' AND contact != 'ESTOQUE' ORDER BY lastupdate DESC";
}
if($time == '12x24'){
	$tempo = 'entre 12h e 24h';
	$tabela = "SELECT * FROM tc_devices WHERE lastupdate < '$data_12' AND lastupdate >= '$data_24' AND contact != 'ESTOQUE' ORDER BY lastupdate DESC";
}
if($time == '24'){
	$tempo = 'acima 24h';
	$tabela = "SELECT * FROM tc_devices WHERE lastupdate < '$data_24' AND contact != 'ESTOQUE' ORDER BY lastupdate DESC";
}

$soma_total = mysqli_query($conn, $tabela);
$soma_total = mysqli_num_rows($soma_total);



$html = '<table width="100%"';	
$html .= '<thead>';
$html .= '<tr>';
$html .= '<th style="border:#000 1px solid; font-size:12px"><b>Descricao</b></th>';
$html .= '<th style="border:#000 1px solid; font-size:12px"><b>Ultima Conexao</b></th>';
$html .= '<th style="border:#000 1px solid; font-size:12px"><b>Operadora</b></th>';
$html .= '<th style="border:#000 1px solid; font-size:12px"><b>Fornecedor Linha</b></th>';
$html .= '<th style="border:#000 1px solid; font-size:12px"><b>IMEI Equipamento</b></th>';
$html .= '<th style="border:#000 1px solid; font-size:12px"><b>Modelo Equipamento</b></th>';
$html .= '<th style="border:#000 1px solid; font-size:12px"><b>No da Linha</b></th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';



$cons_devices = mysqli_query($conn, $tabela);
if(mysqli_num_rows($cons_devices) > 0){
while($row_devices = mysqli_fetch_assoc($cons_devices)){
$deviceid = $row_devices['id'];
$lastupdate = $row_devices['lastupdate'];
$positionid = $row_devices['positionid'];
$lastupdate = date('Y-m-d H:i:s', strtotime('-3 hour', strtotime($lastupdate)));
$lastupdate1 = date('d/m/Y H:i:s', strtotime("$lastupdate"));

$result_usuario = mysqli_query($conn, "SELECT * FROM veiculos_clientes WHERE deviceid='$deviceid'");
if(mysqli_num_rows($result_usuario) >0){
while($row_usuario = mysqli_fetch_assoc($result_usuario)){
$id_cliente = $row_usuario['id_cliente'];
$id_veiculo = $row_usuario['id_veiculo'];
$placa = $row_usuario['placa'];
$modelo_veiculo = $row_usuario['modelo_veiculo'];
$marca_veiculo = $row_usuario['marca_veiculo'];
$modelo_equip = $row_usuario['modelo_equip'];
$chip = $row_usuario['chip'];
$imei = $row_usuario['imei'];
$operadora = $row_usuario['operadora'];
$fornecedor_chip = $row_usuario['fornecedor_chip'];
$veiculo = $placa.' - '.$modelo_veiculo.'/'.$marca_veiculo;
}}


$cons_cliente = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
	if(mysqli_num_rows($cons_cliente) > 0){
		while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
		$nome_cliente = 	$resp_cliente['nome_cliente'];
		$telefone_celular = 	$resp_cliente['telefone_celular'];
	}}

$cons_trat = mysqli_query($conn,"SELECT * FROM tratativas WHERE deviceid='$deviceid' ORDER BY data_trat DESC LIMIT 1");
	if(mysqli_num_rows($cons_trat) <= 0){
		$data_tratativa = '';
	}
	if(mysqli_num_rows($cons_trat) > 0){
		while ($resp_trat = mysqli_fetch_assoc($cons_trat)) {
		$data_tratativa = 	$resp_trat['data_trat'];
		$data_tratativa = date('d/m/Y H:i', strtotime("$data_tratativa"));
		
		
	}}


$cons_posicao = mysqli_query($conn,"SELECT * FROM tc_positions WHERE id='$positionid'");
	if(mysqli_num_rows($cons_posicao) > 0){
		while ($resp_posicao = mysqli_fetch_assoc($cons_posicao)) {
		$devicetime = 	$resp_posicao['fixtime'];
		$devicetime = date('Y-m-d H:i:s', strtotime('-3 hour', strtotime($devicetime)));
		$devicetime = date('d/m/Y H:i:s', strtotime("$devicetime"));
	}}

	



$html .= '<tr><td style="border-bottom:#000 1px solid; font-size:10px">'.$veiculo.'</td>';
$html .= '<td style="border-bottom:#000 1px solid; font-size:10px">'.$lastupdate1.'</td>';
$html .= '<td style="border-bottom:#000 1px solid; font-size:10px">'.$operadora.'</td>';
$html .= '<td style="border-bottom:#000 1px solid; font-size:10px">'.$fornecedor_chip.'</td>';
$html .= '<td style="border-bottom:#000 1px solid; font-size:10px">'.$imei.'</td>';
$html .= '<td style="border-bottom:#000 1px solid; font-size:10px">'.$modelo_equip.'</td>';
$html .= '<td style="border-bottom:#000 1px solid; font-size:10px">'.$chip.'</td></tr>';






		}}



$html .= '</tbody>';
$html .= '</table';

//referenciar o DomPDF com namespace
	use Dompdf\Dompdf;

	// include autoloader
	require_once("../dompdf/autoload.inc.php");

	//Criando a Instancia
	$dompdf = new DOMPDF();
	$dompdf = new Dompdf(array('enable_remote' => true));
	$dompdf->setPaper('A4', 'landscape'); //Paisagem
	// Carrega seu HTML
	$dompdf->load_html('

<table width="100%">
  <tr>
    <td width="8%"><img src="http://rastreiamaisbrasil.com.br/tracker3/manager/logos/'.$logo.'" style="width:150px;height:auto;"></td>
    <td width="92%" style="font-size:22px; text-align: center;"><b>RELATORIO DE VEICULOS OFFLINE</b></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td style="font-size:14px; text-align: center;">Veículos offline '.$tempo.'</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td style="font-size:14px; text-align: center;">Data Processamento: '.$data.'</td>
  </tr>

</table>
			'. $html .'
		');

	//Renderizar o html
	$dompdf->render();

	//Exibibir a página
	$dompdf->stream(
		"Relatorio_veiculos.pdf", 
		array(
			"Attachment" => false //Para realizar o download somente alterar para true
		)
	);



?>