  <?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);

include_once('../conexao.php');


$chip = $_GET['chip'];

$cons_retorno = mysqli_query($conn,"SELECT * FROM log_sms WHERE destino='$chip' ORDER BY id_log DESC");
	if(mysqli_num_rows($cons_retorno) <= 0){
	?>
<tr>
	<th>--</th>
	<td>Sem Envios</td>	
	<td>--</td>
	<td>--</td>
</tr>
	<?php
	}
	if(mysqli_num_rows($cons_retorno) > 0){
while ($resp_comando = mysqli_fetch_assoc($cons_retorno)) {
$data_envio = 	$resp_comando['data_envio'];
$data_envio = date('d/m/Y', strtotime("$data_envio"));
$hora_envio = 	$resp_comando['hora_envio'];
$sms = 	$resp_comando['sms'];
$status = 	$resp_comando['status'];
$resposta = 	$resp_comando['resposta'];
$resposta = html_entity_decode($resposta);
?>
 <tr>
	<th><?php echo $data_envio?> - <?php echo $hora_envio?></th>
	<td><?php echo $sms?></td>	
	<td><?php echo $status?></td>
	<td><?php echo $resposta?></td>
</tr>
<?php

}}


?>
