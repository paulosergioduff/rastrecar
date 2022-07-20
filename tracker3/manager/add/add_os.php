  <?php

include_once('../conexao.php');



$data_emissao = date('Y-m-d');
$data_criacao = date('Y-m-d H:i');
$parceiro = 	$_POST['parceiro'];
$tipo_os = 	$_POST['tipo_os'];
$prioridade = 	$_POST['prioridade'];
$data_vencimento = 	$_POST['data_vencimento'];

$imei = 	$_POST['imei'];
$contas1 = $_POST['contas1'];
$chip = 	$_POST['chip'];
$descricao = 	$_POST['descricao'];
$id_empresa = 	'1361';
$id_cliente = 	$_POST['id_cliente'];
$id_veiculo = 	$_POST['id_veiculo'];
$valor_instalacao	 = 	$_POST['valor_instalacao'];
$valor_instalacao = str_replace(".","","$valor_instalacao");
$valor_instalacao = str_replace(",",".","$valor_instalacao");
$status	 = 	'1';
$class_financeira = 3;
$especie = 1;
$banco = 7;
$pedido_numero = date('Ymd');


$cons_cliente = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
	if(mysqli_num_rows($cons_cliente) > 0){
while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
$nome_cliente = 	$resp_cliente['nome_cliente'];
$doc_cliente = 	$resp_cliente['doc_cliente'];
$telefone_celular = 	$resp_cliente['telefone_celular'];
$telefone_celular1 = preg_replace("/[^0-9]/", "", $telefone_celular);
$endereco = 	$resp_cliente['endereco'];
$endereco_cod = str_replace(' ', '+', $endereco);
$numero = 	$resp_cliente['numero'];
$bairro = 	$resp_cliente['bairro'];
$bairro_cod = str_replace(' ', '+', $bairro);
$cidade = 	$resp_cliente['cidade'];
$cidade_cod = str_replace(' ', '+', $cidade);
$endereco1 = $endereco.', '.$numero.' - '.$bairro.' - '.$cidade;
	}}





$sql = mysqli_query($conn, "INSERT INTO ordem_servico (data_criacao, id_cliente, id_veiculo, id_empresa, parceiro, status, tipo_os, prioridade, descricao, imei, chip, valor_instalacao) VALUES ('$data_criacao', '$id_cliente', '$id_veiculo', '$id_empresa', '$parceiro', '$status', '$tipo_os', '$prioridade', '$descricao', '$imei', '$chip', '$valor_instalacao')");

$cons_os = mysqli_query($conn,"SELECT * FROM ordem_servico WHERE id_veiculo='$id_veiculo' ORDER BY id_os DESC LIMIT 1");
	if(mysqli_num_rows($cons_os) > 0){
while ($resp_cliente = mysqli_fetch_assoc($cons_os)) {
$id_os = 	$resp_cliente['id_os'];

	}}
	
$pedido_numero = 'OS'.$pedido_numero.''.$id_os.'';
if($contas1 == '1'){
	$sql_contas = mysqli_query($conn, "INSERT IGNORE INTO contas_receber (id_cliente, id_empresa, data_emissao, duplicata, descricao, nosso_numero, banco, nr_banco, valor_bruto, class_financeira, especie, data_vencimento) VALUES ('$id_cliente', '$id_empresa', '$data_emissao', '$pedido_numero', '$nome_cliente', '$pedido_numero', '$banco', '$pedido_numero', '$valor_instalacao', '$class_financeira', '$especie', '$data_vencimento')");
}

#============================================


$cons_parceiro = mysqli_query($conn,"SELECT * FROM parceiros WHERE id_parceiro='$parceiro'");
	if(mysqli_num_rows($cons_parceiro) > 0){
while ($result1 = mysqli_fetch_assoc($cons_parceiro)) {
	$telefone_parceiro = 	$result1['celular'];
$telefone_parceiro1 = preg_replace("/[^0-9]/", "", $telefone_parceiro);
$nome_parceiro = $result1['nome_parceiro'];
}}


$data_agenda = $_POST['data_agenda'];
$data_agenda =  date('Y-m-d H:i', strtotime($data_agenda));
$dt_agenda2 =  date('Y-m-d', strtotime($data_agenda));
$dt_agenda = date('d/m/Y', strtotime($data_agenda));
$hora_agenda = date('H:i', strtotime($data_agenda));
$fim_agenda =  date('Y-m-d H:i', strtotime('+120 minute', strtotime($data_agenda)));

$dt_msg = $dt_agenda.' - '.$hora_agenda;

if($tipo_os == 'INSTALACAO'){
$color = '#7367f0';
}
if($tipo_os == 'RETIRADA'){
$color = '#ea5455';
}
if($tipo_os == 'MANUTENCAO'){
$color = '#ff9f43';
}

$local_instalacao	 = 	$_POST['local_instalacao'];
if($local_instalacao == 'DOMICILIAR'){
	$link_a = 'https://www.google.com/maps/place/'.$endereco_cod.','.$numero.'-'.$bairro_cod.'-'.$cidade_cod.'';

	$endereco33 = urlencode($link_a);

}
if($local_instalacao != 'DOMICILIAR'){
	$endereco33 = 'INSTALAÇÃO NA LOJA';
}

$cons_veiculo = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE id_veiculo='$id_veiculo'");
if(mysqli_num_rows($cons_veiculo) > 0){
while ($resp_veic = mysqli_fetch_assoc($cons_veiculo)) {
$status_veiculo = $resp_veic['status'];
$marca_veiculo = $resp_veic['marca_veiculo'];
$placa = $resp_veic['placa'];
$modelo_veiculo = $resp_veic['modelo_veiculo'];
$modelo = ''.$marca_veiculo.'/'.$modelo_veiculo.'';
}}

$sql_whats = mysqli_query($conn, "SELECT * FROM envios_whats ORDER BY id DESC LIMIT 1");
	if(mysqli_num_rows($sql_whats) > 0){
	while ($resp_whats = mysqli_fetch_assoc($sql_whats)) {
	$id_whats = 	$resp_whats['id'] +1;
	}}

$sql_agenda = mysqli_query($conn,"INSERT INTO agenda_instalacao (data_agenda, parceiro,  valor_instalacao, local_instalacao, observacoes, id_cliente, id_veiculo, status, tipo_agenda, fim_agenda, color, id_os) VALUES ('$data_agenda', '$nome_parceiro',  '$valor_instalacao', '$local_instalacao', '$descricao_agenda', '$id_cliente', '$id_veiculo', 'Pendente', '$tipo_os', '$fim_agenda', '$color', '$id_os')");


$id_unico1 = date('Ymdis');
$id_unico = ''.$id_unico1.'-'.$id_veiculo.'';
$id_unico2 = ''.$id_unico1.'-'.$parceiro.'';




$texto_push9 = '%E2%8F%B1%EF%B8%8F+AGENDAMENTO+JC+RASTREAMENTO+%E2%8F%B1%EF%B8%8F%0A%0APrezado%28a%29+cliente+'.$nome_cliente.'%2C+informamos+que+sua+%2A'.$tipo_os.'%2A+foi+agendada+conforme+dados+abaixo%3A%0A%0AVe%C3%ADculo%3A+%2A'.$modelo.'%2A%0APlaca%3A+%2A'.$placa.'%2A%0AData%3A+%2A'.$dt_agenda.'%2A%0AHor%C3%A1rio%3A++%2A'.$hora_agenda.'%2A%0ALocal%3A+%2A'.$endereco1.'%2A%0ACaso+precise+reagendar+para+outra+data%2C+por+favor+nos+contate+pelo+telefone+%2885%29+4042-6721.%0A%0A%2A_Mensagem+autom%C3%A1tica.+Por+favor%2C+n%C3%A3o+responda_%2A';

 $insere_alerta1 = mysqli_query($conn, "INSERT IGNORE INTO envios_whats (id, id_unico, telefone, mensagem, enviado, id_cliente, data_envio, tipo) VALUES ('$id_whats', '$id_unico', '$telefone_celular1', '$texto_push9', 'NAO', '$id_cliente', '$data_criacao', 'AGENDAMENTO')");


//$texto_push1 = '%2AMOBI+DRIVE+INFORMA%2A%0ANova+OS+dispon%C3%ADvel.%0A%0AParceiro%3A+'.$nome_parceiro.'%0A%0ATipo%3A+'.$tipo_os.'%0ALocal%3A+'.$endereco1.'%0AVe%C3%ADculo%3A+'.$modelo.'%0ACliente%3A+'.$nome_cliente.'%0ATelefone%3A+'.$telefone_celular.'%0A%0AData+Agendamento%3A+'.$dt_msg.'%0A%0A_Em+caso+de+d%C3%BAvidas%2C+acione+o+suporte._%0A%0A_%2AMensagem+automatica%2C+por+favor+nao+responda%2A_';

$texto_push1 = '%2AJC+CAR+INFORMA%2A%0ANova+OS+dispon%C3%ADvel.%0A%0AInstalador%3A+%0A%2A'.$nome_parceiro.'%2A%0A%0ATipo%3A+'.$tipo_os.'%0ALocal%3A+'.$endereco1.'%0AVe%C3%ADculo%3A+'.$modelo.'%0ACliente%3A++'.$nome_cliente.'%0ATelefone%3A+'.$telefone_celular.'%0A%0AData+Agendamento%3A+'.$dt_msg.'%0A%0A%2AClique+no+link+para+navegar%3A%2A%0A%0A'.$endereco33.'%0A%0A_Em+caso+de+d%C3%BAvidas%2C+acione+o+suporte._%0A%0A_%2AMensagem+autom%C3%A1tica%2C+por+favor+n%C3%A3o+responda%2A_';

 $insere_alerta2 = mysqli_query($conn, "INSERT IGNORE INTO envios_whats (id_unico, telefone, mensagem, enviado, id_cliente, data_envio, tipo) VALUES ('$id_unico2', '$telefone_parceiro1', '$texto_push1', 'NAO', '$id_cliente', '$data_criacao', 'AGENDAMENTO')");











$base64 = 'id_cliente:'.$id_cliente.'&id_os:'.$id_os.'';
$base64 = base64_encode($base64);

header('Location: ../ordem_servico.php?c='.$base64.'');


?>
