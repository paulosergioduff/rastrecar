<?php 

$servidor = "localhost";
$usuario = "root";
$senha = "TR4vcijU6T9Keaw";
$dbname = "traccar";

//Criar a conexao
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
$con = mysqli_connect($servidor, $usuario, $senha, $dbname);

$data = date('d/m/Y H:i:s');

$cliente = $_GET['cliente'];
$cliente_pai = $_GET['cliente_pai'];
$deviceid = $_GET['deviceid'];
$data_inicial = $_GET['data_inicial'];
$data_inic  =  date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_inicial)));
$data_inicial1 = date('d/m/Y H:i:s', strtotime("$data_inicial"));
$data_final = $_GET['data_final'];
$data_fin  =  date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_final)));
$data_final1 = date('d/m/Y H:i:s', strtotime("$data_final"));

$agrupar = 'SIM';

$delete = mysqli_query($conn, "DELETE FROM mapa_posicoes WHERE deviceid='$deviceid'");

$cons_empresa = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='1361'");
	if(mysqli_num_rows($cons_empresa) > 0){
while ($resp_empresa = mysqli_fetch_assoc($cons_empresa)) {
$nome_url = $resp_empresa['nome_url'];

$login_traccar = $resp_empresa['login_traccar'];
$senha_traccar = $resp_empresa['senha_traccar'];
$token_traccar = $login_traccar.':'.$senha_traccar;
$token_traccar = base64_encode($token_traccar);
	}}	
	
	
$cons_veiculo = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE deviceid='$deviceid'");
	if(mysqli_num_rows($cons_veiculo) > 0){
while ($resp_veiculo = mysqli_fetch_assoc($cons_veiculo)) {
$placa = $resp_veiculo['placa'];
$marca_veiculo = $resp_veiculo['marca_veiculo'];
$modelo_veiculo = $resp_veiculo['modelo_veiculo'];
$veiculo = $placa.' - '.$marca_veiculo.'/'.$modelo_veiculo;
$id_cliente = $resp_veiculo['id_cliente'];
	}}	
	
$cons_cliente = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
	if(mysqli_num_rows($cons_cliente) > 0){
while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
$nome_cliente = $resp_cliente['nome_cliente'];
$logo1 = $resp_cliente['logo'];
	}}	

if($logo1 == ''){
	$logo = '20210903100915-1361.jpg';
} else {
	$logo = $logo1;
}


$data_ini1 = explode(" ", $data_inic);
$data1 = $data_ini1[0];
$hora1 = $data_ini1[1];
$data_inicial2 = $data1.'T'.$hora1.'Z';

$data_fim1 = explode(" ", $data_fin);
$data2 = $data_fim1[0];
$hora2 = $data_fim1[1];
$data_final2 = $data2.'T'.$hora2.'Z';




$html = '<table width="100%"';	
$html .= '<thead>';
$html .= '<tr>';
$html .= '<th style="border:#000 1px solid; font-size:12px"><b>Data/Hora</b></th>';
$html .= '<th style="border:#000 1px solid; font-size:12px"><b>Endereço</b></th>';
$html .= '<th style="border:#000 1px solid; font-size:12px"><b>Valocidade</b></th>';
$html .= '<th style="border:#000 1px solid; font-size:12px"><b>Ignição</b></th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';



$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://5.189.185.179:8082/api/reports/route?from='.$data_inicial2.'&to='.$data_final2.'&deviceId='.$deviceid.'',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',

  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Authorization: Basic '.$token_traccar.''
  ),
));

$response = curl_exec($curl);

//curl_close($curl);
//echo $response;

$json = json_decode($response);

foreach($json as $registro){
    $positionid = $registro->id;
    $endereco = $registro->address;
    $longitude = $registro->longitude;
    $latitude = $registro->latitude;
    $total_km = $registro->totalDistance;
    $devicetime = $registro->deviceTime;
	$devicetime1  =  date('Y-m-d H:i:s',strtotime($devicetime));
	$devicetime  =  date('d/m/Y H:i:s',strtotime($devicetime1));
    $speed = $registro->speed;
    $speed = $speed * 1.609;
	$veloc = round($speed);	
	$attr = $registro->attributes;
	$json1 = json_encode($attr);
	$json1 = json_decode($json1);
	$ignicao = $json1->{'ignition'};
	if (is_bool($ignicao)) $ignicao ? $ignicao = "ligada" : $ignicao = "desligada";
	else if ($ignicao !== null) $ignicao = (string)$ignicao;
	
	$ign2 = $ignicao;
		if($ign2 == 'desligada'){

			$velocidade = '0.00';
			$ign3 = '<span style="color:#990000"><i class="fas fa-stop-circle"></i><b>  '.$ign2.'</b></span>';
		}
		
		$str_ign = 'Desligado';
		if($ign2 == 'ligada'){
			$str_ign = 'Ligada';
			$data_pos = $horario_br;
			$velocidade = $veloc;
			$ign3 = '<span style="color:#228B22"><b><i class="fas fa-key"></i> '.$ign2.'</b></span>';
		};
		if($agrupar == 'SIM'){
			if($last_ign == 'Desligado' && $str_ign == 'Desligado'){
				continue;
			};
		};
		$last_ign = $str_ign;
	
	$sql_up = mysqli_query($conn,"INSERT IGNORE INTO mapa_posicoes (positionid, devicetime, ignicao, endereco, speed, latitude, longitude, deviceid, total_km) VALUES ('$positionid', '$devicetime1', '$ignicao', '$endereco', '$veloc', '$latitude', '$longitude', '$deviceid', '$total_km')");
}



$curl1 = curl_init();

curl_setopt_array($curl1, array(
  CURLOPT_URL => 'http://5.189.185.179:8082/api/reports/summary?from='.$data_inicial2.'&to='.$data_final2.'&deviceId='.$deviceid.'',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Authorization: Basic '.$token_traccar.''
  ),
));

$response1 = curl_exec($curl1);

curl_close($curl1);

$json4 = json_decode($response1);
 

// Loop para percorrer o Objeto
foreach($json4 as $registro1):
    $deviceId = $registro1->deviceId;
    $distance = $registro1->distance;
	$distance = $distance / 1000;
	$distance = round($distance, 2);


endforeach;



function segundos_em_tempo($segundos) {
					 
 $horas = floor($segundos / 3600);
 $minutos = floor($segundos % 3600 / 60);
 $segundos = $segundos % 60;
 
 return sprintf("%02d:%02d:%02d", $horas, $minutos, $segundos);
 
}
	


	
	
		$cons_eventos_off = mysqli_query($conn,"SELECT * FROM mapa_posicoes WHERE deviceid='$deviceid' ORDER BY devicetime ASC");
	if(mysqli_num_rows($cons_eventos_off) > 0){
		while ($row_ev_off = mysqli_fetch_assoc($cons_eventos_off)) {
			
			
			$listagem[] = $row_ev_off;  
			
		}
		
		for ($i=0; $i < count($listagem); $i++) { 
			
		if($listagem[$i]["ignicao"]=='ligada' && $listagem[$i+1]["ignicao"] == 'desligada'){
		
				$date_time  = new DateTime($listagem[$i]['devicetime']);
				$diff       = $date_time->diff( new DateTime($listagem[$i+1]['devicetime']));
				$horas_mov[] = $diff->format('%H:%i:%s');
				
				//echo ''.$listagem[$i]['type'].': '.$listagem[$i]['servertime'].' - '.$listagem[$i+1]['type'].': '.$listagem[$i+1]['servertime'].' - Tempo Movimento: '.$horas.'<br>';

		}
		if($listagem[$i]["ignicao"]=='ligada' && $listagem[$i+1]["ignicao"] == 'ligada'){

				$date_time  = new DateTime($listagem[$i]['devicetime']);
				$diff       = $date_time->diff( new DateTime($listagem[$i+1]['devicetime']));
				$horas_mov[] = $diff->format('%H:%i:%s');
				
				//echo ''.$listagem[$i]['type'].': '.$listagem[$i]['servertime'].' - '.$listagem[$i+1]['type'].': '.$listagem[$i+1]['servertime'].' - Tempo Movimento: '.$horas.'<br>';


		} 
		
		if($listagem[$i]["ignicao"]=='desligada' && $listagem[$i+1]["ignicao"] == 'ligada'){
		
				$date_time  = new DateTime($listagem[$i]['devicetime']);
				$diff       = $date_time->diff( new DateTime($listagem[$i+1]['devicetime']));
				$horas_stop[] = $diff->format('%H:%i:%s');
				
				//echo ''.$listagem[$i]['type'].': '.$listagem[$i]['servertime'].' - '.$listagem[$i+1]['type'].': '.$listagem[$i+1]['servertime'].' - Tempo Parado: '.$horas.'<br>';

		}
		if($listagem[$i]["ignicao"]=='desligada' && $listagem[$i+1]["ignicao"] == 'desligada'){

				$date_time  = new DateTime($listagem[$i]['devicetime']);
				$diff       = $date_time->diff( new DateTime($listagem[$i+1]['devicetime']));
				$horas_stop[] = $diff->format('%H:%i:%s');
				
				//echo ''.$listagem[$i]['type'].': '.$listagem[$i]['servertime'].' - '.$listagem[$i+1]['type'].': '.$listagem[$i+1]['servertime'].' - Tempo Parado: '.$horas.'<br>';


		} 
		
	//echo ''.$horas.'<br>';

	}}
	
	
	
	$soma = 0;
	$soma1 = 0;
 
foreach($horas_stop as $item1) {
	list($horas,$minutos,$segundos) = explode(":",$item1);
	$calc1 = $horas * 3600 + $minutos * 60 + $segundos;
	$soma1 = $calc1 + $soma1;
}



foreach($horas_mov as $item) {
	list($horas,$minutos,$segundos) = explode(":",$item);
	$calc = $horas * 3600 + $minutos * 60 + $segundos;
	$soma = $calc + $soma;
}
 
$total_mov = segundos_em_tempo($soma);
$total_mov = explode(":", $total_mov);
$hora_mov = $total_mov[0];
$min_mov = $total_mov[1];

$total_stop = segundos_em_tempo($soma1);
$total_stop = explode(":", $total_stop);
$hora_stop = $total_stop[0];
$min_stop = $total_stop[1];

$total_movimento =  ''.$hora_mov.'h'.$min_mov.'min';
$total_parado = ''.$hora_stop.'h'.$min_stop.'min';



$cons_posicoes = mysqli_query($conn,"SELECT * FROM mapa_posicoes WHERE deviceid='$deviceid' ORDER BY devicetime ASC");
	if(mysqli_num_rows($cons_posicoes) > 0){
while ($resp_posicoes = mysqli_fetch_assoc($cons_posicoes)) {
$horario = $resp_posicoes['devicetime'];
$horario  =  date('d/m/Y H:i:s',strtotime($horario));
$ign4 = $resp_posicoes['ignicao'];
$address = $resp_posicoes['endereco'];
$speed1 = $resp_posicoes['speed'];
$speed1 = round($speed1);
		

if($ign4 == 'ligada'){
	$ign5 = '<span style="color:#2E8B57">Ligada</span>';
}
if($ign4 != 'ligada'){
	$ign5 = '<span style="color:#990000">Desligado</span>';
}


$html .= '<tr><td style="border-bottom:#000 1px solid; font-size:10px">'.$horario.'</td>';
$html .= '<td style="border-bottom:#000 1px solid; font-size:10px">'.$address.'</td>';
$html .= '<td style="border-bottom:#000 1px solid; font-size:10px">'.$speed1.' km/h</td>';
$html .= '<td style="border-bottom:#000 1px solid; font-size:10px">'.$ign5.'</td></tr>';

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
	$dompdf->setPaper('A4', 'portrait'); //Paisagem
	// Carrega seu HTML
	$dompdf->load_html('

<table width="100%">
  <tr>
    <td width="20%" rowspan="5" style="font-size:18px; text-align: center;"><img src="http://rastreiamaisbrasil.com.br/tracker3/manager/logos/'.$logo.'" style="width:100px;height:auto;"></td>
    <td width="80%" style="font-size:18px; text-align: center;"><b>RELATORIO DE PERCURSO</b></td>
  </tr>
  <tr>
    <td style="font-size:14px; text-align: center;">Periodo: '.$data_inicial1.' ate '.$data_final1.'</td>
  </tr>
  <tr>
    <td style="font-size:14px; text-align: center;">Data Processamento: '.$data.'</td>
  </tr>
  <tr>
    <td style="font-size:14px; text-align: center;">Veículo: '.$veiculo.'</td>
  </tr>
  <tr>
    <td style="font-size:14px; text-align: center;">Cliente: '.$nome_cliente.'</td>
  </tr>
  <tr>
    <td colspan="2" style="font-size:14px; text-align: center;"><hr style="border:#000 1px solid;"></td>
  </tr>
  <tr>
    <td colspan="2" style="font-size:14px; text-align: center;"><table width="90%" border="0" cellspacing="0">
      <tr>
        <td align="center">Distância Total</td>
        <td>&nbsp;</td>
        <td align="center">Tempo Parado</td>
        <td>&nbsp;</td>
        <td align="center">Tempo Movimento</td>
      </tr>
      <tr>
        <td align="center">'.$distance.' km</td>
        <td>&nbsp;</td>
        <td align="center">'.$total_parado.'</td>
        <td>&nbsp;</td>
        <td align="center">'.$total_movimento.'</td>
      </tr>
    </table></td>
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