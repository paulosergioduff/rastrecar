<?php 

header ("Content-type: application/x-msexcel");
header('Content-Disposition: attachment; filename=relatorio_veiculos.xls');
header("Pragma: no-cache");
header("Expires: 0");

include('../conexao.php');										

$cons_empresa = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='1361'");
	if(mysqli_num_rows($cons_empresa) > 0){
while ($resp_empresa = mysqli_fetch_assoc($cons_empresa)) {
$nome_url = $resp_empresa['nome_url'];
$logo = $resp_empresa['logo'];
$texto_rodape = $resp_empresa['texto_rodape'];
$texto_topo = $resp_empresa['texto_topo'];
$cor_sistema = $resp_empresa['cor_sistema'];
	}}

$data = date('d/m/Y H:i:s');
$data_agora = date('Y-m-d H:i:s');
$data_agora = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_agora)));
$data_5 = date('Y-m-d H:i:s', strtotime('-5 minutes', strtotime($data_agora)));
$data_12 = date('Y-m-d H:i:s', strtotime('-12 hour', strtotime($data_agora)));
$data_24 = date('Y-m-d H:i:s', strtotime('-24 hour', strtotime($data_agora)));

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

?><table id="Exportar_para_Excel">
    <tr>
    <td colspan="2"><img src="http://rastreiamaisbrasil.com.br/tracker3/manager/logos/excel.jpg"></td>
    <td colspan="5">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="5" style="font-size:25px; text-align: center;"><b>RELATORIO DE VEICULOS OFFLINE</b></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="5" style="text-align: center;">Veículos offline <?php echo $tempo?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="5" style="text-align: center;">Data Processamento: <?php echo date('d/m/Y H:i:s')?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td style="border:#000 1px solid"><b>Descricao</b></td>
    <td style="border:#000 1px solid"><b>Ultima Conexao</b></td>
    <td style="border:#000 1px solid"><b>Operadora</b></td>
    <td style="border:#000 1px solid"><b>IMEI Equipamento</b></td>
    <td style="border:#000 1px solid"><b>Modelo Equipamento</b></td>
    <td style="border:#000 1px solid"><b>No da Linha</b></td>
  </tr>
<?php


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
	


?>
<tr>
<td style="border:#CCC 1px solid"><?php echo $veiculo; ?></td>
<td style="border:#CCC 1px solid"><?php echo $lastupdate1; ?></td>
<td style="border:#CCC 1px solid"><?php echo $operadora; ?></td>
<td style="border:#CCC 1px solid"><?php echo $imei; ?></td>
<td style="border:#CCC 1px solid"><?php echo $modelo_equip; ?></td>
<td style="border:#CCC 1px solid"><?php echo $chip; ?></td>
</tr>
<?php


		}}


?>
</table>