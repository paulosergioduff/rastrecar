<?php 

include('../conexao.php');	
$deviceid = $_GET['deviceid'];
$data_inicial = $_GET['data_inicial'];
$data_inic  =  date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_inicial)));
$data_inicial1 = date('d/m/Y H:i:s', strtotime("$data_inicial"));
$data_final = $_GET['data_final'];
$data_fin  =  date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_final)));
$data_final1 = date('d/m/Y H:i:s', strtotime("$data_final"));

$data = date('d/m/Y H:i:s');

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




	$parada = 0;
	$temp_velocidade_media = '';
	$temp_tempo_percurso = '';
	$temp_end_inicial = '';
	$temp_end_final = '';
	$temp_html = '';
	$temp_data_inicial = '';
	$temp_data_final = '';
	$velocidades = 0;
	$velocidade_soma = 0;
	$velocidade_media = 0;
	$temp_km = 0;
	$temp_duracao = 0;
	$temp_hod_inicial = 0;
	$temp_hod_final = 0;
	$speed1 = 0;
	$iniciado = false;
	$cons_conta = mysqli_query($conn,"SELECT * FROM tc_positions WHERE deviceid='$deviceid' AND (servertime >= '$data_inic' AND servertime <= '$data_fin') ORDER BY id ASC");
	$total = mysqli_num_rows($cons_conta);
	/*$html_final = '<table border="1" class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th>.</th>
								<th>HORA</th>
								<th>ENDEREÇO</th>
								<th>Velocidade Média</th>
                                <th>KM PERCORRIDA</th>
						   		 <th>DURAÇÃO</th>
								<th>MAPA</th>
							</tr>
						</thead>
						<tbody>
						
						';*/
						
	if(mysqli_num_rows($cons_conta) > 0){
		while ($resp_conta = mysqli_fetch_array($cons_conta)) {
			//Tratamentos Padroes
			$data = $resp_conta['servertime'];
			$data = date('Y-m-d H:i:s', strtotime('-3 hour', strtotime($data))); 
			$id_pos = $resp_conta['id'];
			$address = $resp_conta['address'];
			$speed = 	$resp_conta['speed'];
			$speed = $speed * 1.609;
			$speed = round($speed, 2);
			$address = str_replace(', BR', '', $address);
			$address1 = explode(",", $address);
			$estado1 = end($address1);
			$estado = ','.$estado1;
			$address = str_replace($estado, '', $address);
			$address1 = explode(",", $address);
			$cep = end($address1);
			$cep = ','.$cep;
			$address = str_replace($cep, '', $address);
			$address = $address.' /'.$estado1;
			
			
			
			$attributes = $resp_conta['attributes'];
			$obj = json_decode($attributes);
			$ignicao = $obj->{'ignition'};
			
			$ignicao = (string)$ignicao;
			
			$total_km = $obj->{'totalDistance'};
			$total_km = $total_km / 1000;
			$total_km = round($total_km, 2);
			//$total_km = number_format($total_km, 2, ",", ".");
			//Colocar aqui os calculos de distancia e velocidade
			$velocidades = $velocidades + 1;
			$velocidade_soma = $velocidade_soma + $speed;
		
			
			$temp_km +=  $total_km;
			
			if($ignicao == 0){
				//Inicio da logica para montar os retornos
				if($iniciado == true){
					if($ignicao != $parada){
						$parada = 0;
						
						$temp_data_final  = $data;
						$temp_end_final = $address;
						$temp_hod_final = $total_km;
						$velocidade_media = round($velocidade_soma/$velocidades,2);
						$velocidade_media = round($velocidade_media);
						//Printar uma Linha, e resetar as temporarias
						$km_percurso = $temp_hod_final - $temp_hod_inicial;
						$km_percurso = round($km_percurso);
						
						if($km_percurso == 0){
							continue;
						}
						
						$diferenca = strtotime($temp_data_final) - strtotime($temp_data_inicial);
						$dias = floor($diferenca / (60 * 60 * 24));


						$data_ini  = $temp_data_final;
						$data_end  = $temp_data_inicial;

						$dif = strtotime($data_end) - strtotime($data_ini);



						$date_time  = new DateTime($temp_data_inicial);
						$diff       = $date_time->diff( new DateTime($temp_data_final));
						$horas = $diff->format('%H horas(s), %i minutos');
						
						$data_format_inicial = date('d/m/Y H:i:s', strtotime($temp_data_inicial)); 
						$data_format_final = date('d/m/Y H:i:s', strtotime($temp_data_final)); 
						
						$data_inicial_vel = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($temp_data_inicial)));
						$data_final_vel = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($temp_data_final)));
						$cons_speed = mysqli_query($conn,"SELECT * FROM tc_positions WHERE deviceid='$deviceid' AND (servertime >= '$data_inicial_vel' AND servertime <= '$data_final_vel') ORDER BY speed DESC LIMIT 1");
							if(mysqli_num_rows($cons_speed) > 0){
						while ($resp_speed = mysqli_fetch_assoc($cons_speed)) {
						$vel_maxima = 	$resp_speed['speed'];
						$vel_maxima = $vel_maxima * 1.609;
						$vel_maxima = round($vel_maxima);
							}}


$html .= '

<table width="100%" border="0" cellspacing="0" style="font-size:12px;">
  <tr>
    <td><table width="100%" border="1" bordercolor="#000000" cellspacing="0">
      <tr>
        <td><table width="100%" border="0" cellspacing="0">
          <tr>
            <td width="21%"><b>Data Inicial</b></td>
            <td width="37%"><b>Endereço Inicial</b></td>
            <td width="21%">&nbsp;</td>
            <td width="21%">&nbsp;</td>
          </tr>
          <tr>
            <td>'.$data_format_inicial.'</td>
            <td colspan="3">'.$temp_end_inicial.'</td>
            </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><b>Data Final</b></td>
            <td><b>Endereço Final</b></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>'.$data_format_final.'</td>
            <td colspan="3">'.$temp_end_final.'</td>
            </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><b>Distância Total</b></td>
            <td><b>Tempo de Percurso</b></td>
            <td><b>Velocidade Média</b></td>
            <td><b>Velocidade Máxima</b></td>
          </tr>
          <tr>
            <td>'.$km_percurso.' km rodados</td>
            <td>'.$horas.'</td>
            <td>'.$velocidade_media.' km/h</td>
            <td>'.$vel_maxima.' km/h</td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
';

		
									
						$velocidades = 0;
						$velocidade_soma = 0;
						$velocidade_media = 0;
						$temp_hod_final = 0;
						$temp_hod_inicial = 0;
						$temp_km = 0;
					};
				};
				$ign = '<font color="#006600"><b>LIGADO</b></font>';
			} else {
				if($iniciado == false){
					//Primeiro load
					$iniciado = true;
					$temp_data_inicial  = $data;
					$temp_end_inicial = $address;
					$temp_hod_inicial = $total_km;

				}else{
					if($ignicao != $parada){
						//Mudanca para um novo
						$temp_data_inicial  = $data;
						$temp_end_inicial = $address;
						$temp_hod_inicial = $total_km;
						$parada = 1;
					};
				};
				$ign = '<font color="#990000"><b>Desligado</b></font>';
			};
			
		
		};
	};

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
    <td width="80%" style="font-size:18px; text-align: center;"><b>RELATORIO DE VIAGENS</b></td>
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