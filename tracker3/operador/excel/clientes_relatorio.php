<?php 

header ("Content-type: application/x-msexcel");
header('Content-Disposition: attachment; filename=relatorio_clientes.xls');
header("Pragma: no-cache");
header("Expires: 0");


$cliente = $_GET['cliente'];
$bloqueados = $_GET['bloqueados'];
$cliente_pai = $_GET['cliente_pai'];


include('../conexao.php');										
if($cliente == '1'){
	if($bloqueados == 'SIM'){
		$tabela = "SELECT * FROM clientes WHERE status='1' AND id_cliente_pai='$cliente_pai' ORDER BY nome_cliente ASC";
	}
	if($bloqueados != 'SIM'){
		$tabela = "SELECT * FROM clientes AND id_cliente_pai='$cliente_pai' ORDER BY nome_cliente ASC";
	}
	
}

if($cliente != '1'){
	if($bloqueados == 'SIM'){
		$tabela = "SELECT * FROM clientes WHERE id_cliente='$cliente' OR id_cliente_pai='$cliente_pai' ORDER BY nome_cliente ASC";
	}
	if($bloqueados != 'SIM'){
		$tabela = "SELECT * FROM clientes WHERE (id_cliente='$cliente' OR id_cliente_pai='$cliente_pai') AND status='1'  ORDER BY nome_cliente ASC";
	}
}

$soma_total = mysqli_query($conn, $tabela);
$soma_total = mysqli_num_rows($soma_total);

?><table id="Exportar_para_Excel">
    <tr>
    <td colspan="2"><img src="http://rastreiamaisbrasil.com.br/tracker/Imagens/logo_excel.png"></td>
    <td colspan="5">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="5" style="font-size:25px; text-align: center;"><b>RELATORIO DE CLIENTES</b></td>
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
    <td style="border:#000 1px solid"><b>CPF/CNPJ</b></td>
    <td style="border:#000 1px solid"><b>Tipo</b></td>
    <td style="border:#000 1px solid"><b>Cliente</b></td>
    <td style="border:#000 1px solid"><b>Endereco</b></td>
    <td style="border:#000 1px solid"><b>Bairro</b></td>
    <td style="border:#000 1px solid"><b>Cidade</b></td>
    <td style="border:#000 1px solid"><b>UF</b></td>
    <td style="border:#000 1px solid"><b>Telefone</b></td>
    <td style="border:#000 1px solid"><b>Celular</b></td>
    <td style="border:#000 1px solid"><b>Veiculos</b></td>
    <td style="border:#000 1px solid"><b>Status</b></td>
  </tr>
<?php


$resultado_usuario = mysqli_query($conn, $tabela);
if(mysqli_num_rows($resultado_usuario) > 0){
while($resp_cliente = mysqli_fetch_assoc($resultado_usuario)){
$nome_cliente = 	$resp_cliente['nome_cliente'];
$doc_cliente = 	$resp_cliente['doc_cliente'];
$documento = preg_replace("/[^0-9]/", "", $doc_cliente);
$cep = 	$resp_cliente['cep'];
$endereco = 	$resp_cliente['endereco'];
$numero = 	$resp_cliente['numero'];
$complemento = 	$resp_cliente['complemento'];
$bairro = 	$resp_cliente['bairro'];
$cidade = 	$resp_cliente['cidade'];
$estado = 	$resp_cliente['estado'];
$telefone_residencial = 	$resp_cliente['telefone_residencial'];
$telefone_celular = 	$resp_cliente['telefone_celular'];
$telefone_outros = 	$resp_cliente['telefone_outros'];
$status = 	$resp_cliente['status'];
$id_cliente = 	$resp_cliente['id_cliente'];

if(strlen($documento) == 14){
	$tipo = 'P. Fisica';
}
if(strlen($documento) == 11){
	$tipo = 'P. Juridica';
}

if($status == 1){
	$status1 = 'ATIVO';
}
if($status != 1){
	$status1 = 'INATIVO';
}

$cons_veiculos = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE id_cliente='$id_cliente' AND status='1'");
$total_veiculos = mysqli_num_rows($cons_veiculos);
	


?>
<tr>
<td style="border:#CCC 1px solid"><?php echo $doc_cliente; ?></td>
<td style="border:#CCC 1px solid"><?php echo $tipo; ?></td>
<td style="border:#CCC 1px solid"><?php echo $nome_cliente; ?></td>
<td style="border:#CCC 1px solid"><?php echo $endereco; ?>, <?php echo $numero; ?></td>
<td style="border:#CCC 1px solid"><?php echo $bairro; ?></td>
<td style="border:#CCC 1px solid"><?php echo $cidade; ?></td>
<td style="border:#CCC 1px solid"><?php echo $estado; ?></td>
<td style="border:#CCC 1px solid"><?php echo $telefone_residencial; ?></td>
<td style="border:#CCC 1px solid"><?php echo $telefone_celular; ?></td>
<td style="border:#CCC 1px solid"><?php echo $total_veiculos; ?></td>
<td style="border:#CCC 1px solid"><?php echo $status1; ?></td>
</tr>
<?php


		}}


?>
</table>