<?php 

header ("Content-type: application/x-msexcel");
header('Content-Disposition: attachment; filename=relatorio_veiculos.xls');
header("Pragma: no-cache");
header("Expires: 0");

$cliente = $_GET['cliente'];
$cliente_pai = $_GET['cliente_pai'];
$equipamentos = $_GET['equipamentos'];
$data_inicial = $_GET['data_inicial'];
$data_inicial1 = date('d/m/Y', strtotime("$data_inicial"));
$data_final = $_GET['data_final'];
$data_final1 = date('d/m/Y', strtotime("$data_final"));


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

if($equipamentos != '1'){
	$equip = "AND modelo_equip='$equipamentos'";
}
if($equipamentos == '1'){
	$equip = '';
}

if($cliente == '1'){
	$tabela = "SELECT * FROM veiculos_clientes WHERE id_cliente_pai='$cliente_pai' AND (data_cadastro >= '$data_inicial' AND data_cadastro <= '$data_final') ".$equip." ORDER BY data_cadastro ASC";
}
if($cliente != '1'){
	$tabela = "SELECT * FROM veiculos_clientes WHERE id_cliente IN ($clientes) AND (data_cadastro >= '$data_inicial' AND data_cadastro <= '$data_final') ".$equip." ORDER BY data_cadastro ASC";
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
    <td colspan="5" style="font-size:25px; text-align: center;"><b>RELATORIO DE VEICULOS</b></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="5" style="text-align: center;">Periodo: <?php echo $data_inicial1?> ate <?php echo $data_final1?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="5" style="text-align: center;">Data Processamento: <?php echo date('d/m/Y H:i:s')?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="5" style="text-align: center;">Total de Registros: <?php echo $soma_total?></td>
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
    <td style="border:#000 1px solid"><b>Placa</b></td>
    <td style="border:#000 1px solid"><b>Cliente</b></td>
    <td style="border:#000 1px solid"><b>Data Cadastro</b></td>
    <td style="border:#000 1px solid"><b>Dispositivo</b></td>
    <td style="border:#000 1px solid"><b>Modelo Equipamento</b></td>
    <td style="border:#000 1px solid"><b>Data Instalacao</b></td>
  </tr>
<?php


$resultado_usuario = mysqli_query($conn, $tabela);
if(mysqli_num_rows($resultado_usuario) > 0){
while($row_usuario = mysqli_fetch_assoc($resultado_usuario)){
$id_cliente = $row_usuario['id_cliente'];
$id_veiculo = $row_usuario['id_veiculo'];
$placa = $row_usuario['placa'];
$modelo_veiculo = $row_usuario['modelo_veiculo'];
$marca_veiculo = $row_usuario['marca_veiculo'];
$data_cadastro = $row_usuario['data_cadastro'];
$data_cadastro = date('d/m/Y', strtotime("$data_cadastro"));
$encerramento_os1 = $row_usuario['encerramento_os'];

$modelo_equip = $row_usuario['modelo_equip'];
$imei = $row_usuario['imei'];
$veiculo = $marca_veiculo.'/'.$modelo_veiculo;

if($encerramento_os1 == ''){
	$encerramento_os = '';
}
if($encerramento_os1 != ''){
	$encerramento_os = date('d/m/Y', strtotime("$encerramento_os"));
}

$cons_cliente = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
	if(mysqli_num_rows($cons_cliente) > 0){
		while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
		$nome_cliente = 	$resp_cliente['nome_cliente'];
	}}

	


?>
<tr>
<td style="border:#CCC 1px solid"><?php echo $veiculo; ?></td>
<td style="border:#CCC 1px solid"><?php echo $placa; ?></td>
<td style="border:#CCC 1px solid"><?php echo $nome_cliente; ?></td>
<td style="border:#CCC 1px solid"><?php echo $data_cadastro; ?></td>
<td style="border:#CCC 1px solid"><?php echo $imei; ?></td>
<td style="border:#CCC 1px solid"><?php echo $modelo_equip; ?></td>
<td style="border:#CCC 1px solid"><?php echo $encerramento_os; ?></td>
</tr>
<?php


		}}


?>
</table>