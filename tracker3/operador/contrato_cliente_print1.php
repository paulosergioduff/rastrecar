<!DOCTYPE html>
<html>
<?php
//include("conexao2.php");
include("conexao.php");

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');
$date = date('y-m-d H:i:s');
?>
<?php
$semana = date("w"); 
$dia = date("j");
$mês = date("n");
$ano = date("Y");

$meses = array(1 => "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", 
"Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro");

$semanas = array("Domingo", "Segunda-Feira", "Terça-Feira", "Quarta-Feira", "Quinta-Feira", "Sexta-Feira", "Sábado");

$id_cliente = $_REQUEST['id_cliente'];
$veiculos = $_REQUEST['veiculos'];
$veic = implode(",", $veiculos);






$cons_cliente = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
	if(mysqli_num_rows($cons_cliente) > 0){
while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
$nome_cliente = 	$resp_cliente['nome_cliente'];
$doc_cliente = 	$resp_cliente['doc_cliente'];
$rg_cliente	 = 	$resp_cliente['rg_cliente'];
$data_nascimento = 	$resp_cliente['data_nascimento'];
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
$data_cadastro = 	$resp_cliente['data_cadastro'];
$data_cadastro = date('d/m/Y', strtotime("$data_cadastro"));
$status = 	$resp_cliente['status'];
$email = 	$resp_cliente['email'];
$assinatura = 	$resp_cliente['assinatura'];
$id_empresa = 	$resp_cliente['id_empresa'];
	
}}



	$sql11 = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE id_veiculo IN ($veic) ORDER BY id_veiculo DESC");
	if(mysqli_num_rows($sql11) > 0){						
	while ($rows44 = mysqli_fetch_assoc($sql11)) {
	$marca_veiculo = $rows44['marca_veiculo'];
	$modelo_veiculo = $rows44['modelo_veiculo'];
	$chassi = $rows44['chassi'];
	$placa = $rows44['placa'];
	$pacote = $rows44['pacote'];
	$renavan = $rows44['renavan'];
	$cor_veiculo = $rows44['cor_veiculo'];
	$tipo_veiculo = $rows44['tipo_veiculo'];
	$ano_veiculo = $rows44['ano_veiculo'];
	$forma_pagamento = $rows44['forma_pagamento'];
	$valor_mensal = $rows44['valor_mensal'];
	$valor_mensal = number_format($valor_mensal, 2, ",", ".");
	}}
	



	$sql1 = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='$id_empresa'");
	if(mysqli_num_rows($sql1) > 0){						
	while($rows4 = $sql1->fetch_array(MYSQLI_ASSOC)){
	$razao_social = $rows4['razao_social'];
	$cnpj = $rows4['cnpj'];
	$endereco_emp = $rows4['endereco'];
	$numero_emp = $rows4['numero'];
	$complemento_emp = $rows4['complemento'];
	$bairro_emp = $rows4['bairro'];
	$cidade_emp = $rows4['cidade'];
	$estado_emp = $rows4['estado'];
	$cep_emp = $rows4['cep'];
	$telefone_emp = $rows4['telefone'];

	}}


	$cons_pacote = mysqli_query($conn,"SELECT * FROM pacotes WHERE id_pacote='$pacote_cliente'");
	if(mysqli_num_rows($cons_pacote) > 0){
while ($resp_pacote = mysqli_fetch_assoc($cons_pacote)) {
$pacote1 = 	$resp_pacote['pacote'];
$info = 	$resp_pacote['info'];
$info = utf8_encode($info);
$valor_pacote = $resp_pacote['valor'];
}}




	$conta_veic = mysqli_query($conn,"SELECT * FROM veiculos_clientes WHERE nr_contrato='$nr_contrato'");
	$total = mysqli_num_rows($conta_veic);


$soma_contrato = $total * $valor;
$valor1 = number_format($valor_contrato, 2, ",", ".");





	  ?>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CONTRATO | <?php echo $nome_cliente?></title>

    <link href="/tracker/css/bootstrap.min.css" rel="stylesheet">
    <link href="/tracker/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="/tracker/css/animate.css" rel="stylesheet">
    <link href="/tracker/css/style.css" rel="stylesheet">


<style>
.break { page-break-before: always; }
body{
	font-size:16px;
}
</style>
</head>

<body class="white-bg" >
    <div class="wrapper wrapper-content p-xl" >
	
	<!-- PÁGINA 1 -->
		<div class="ibox-content p-xl break" style="border-radius:5px; border:#000000 2px solid;">
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<img src="/tracker/Imagens/logo2.png" width="161" height="75" />
					</div>
				</div>
				<div class="col-md-6 text-center" style="color:#000;">
					<div class="form-group">
						<h3>FORMULÁRIO DE ADESÃO</h3>
						<h4>RASTREAMENTO E MONITORAMENTO VEICULAR</h4>
					</div>
				</div>
				<div class="col-md-3 text-right" style="color:#000;">
					<div class="form-group">
						<span>Contrato: <?php echo $id_veiculo?></span>
					</div>
				</div>
			</div>
			<hr style="border:#000 1px solid;">	
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<span><b>DADOS DA CONTRATADA</b></span>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6" style="color:#000;">
					<div class="form-group">
						<span>Razão Social: <b>JC RASTREAMENTO</b></span><br>
						<span>CNPJ: <b>27.050.542/0001-25</b></span><br>
						<span>Endereço: <b>AV PRESIDENTE CASTELO BRANCO, 4251</b></span>
						</div>
				</div>
				<div class="col-md-6" style="color:#000;">
					<div class="form-group">
						<span>Telefone: <b>0800 042 0128</b></span><br>
						<span>Insc. Estadual: <b>06.638783-3</b></span><br>
						<span>Bairro/Cidade: <b>CENTRO, HORIZONTE/CE</b></span>
					</div>
				</div>
			</div>
			<hr style="border:#000 1px solid;">	
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<span><b>DADOS DO CONTRATANTE</b></span>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6" style="color:#000;">
					<div class="form-group">
						<span>Nome/Razão Social: <b><?php echo $nome_cliente?></b></span><br>
						<span>CPF/CNPJ: <b><?php echo $doc_cliente?></b></span><br>
						<span>Endereço: <b><?php echo $endereco?>, <?php echo $numero?> - <?php echo $complemento?></b></span><br>
						<span>CEP: <b><?php echo $cep?></b></span>
					</div>
				</div>
				<div class="col-md-6" style="color:#000;">
					<div class="form-group">
						<span>Telefone: <b><?php echo $telefone_celular?></b></span><br>
						<span>RG/Insc. Estadual: <b><?php echo $rg_cliente?></b></span><br>
						<span>Bairro/Cidade: <b><?php echo $cidade?>/<?php echo $estado?></b></span>
						<span>Email: <b><?php echo $email?></b></span><br>
					</div>
				</div>
			</div>
			<hr style="border:#000 1px solid;">	
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<p><b>ESPECIFICAÇÕES DO(S) VEÍCULO(S)</b></p>
					</div>
				</div>
			</div>
			<?php

					$result_usuario = "SELECT * FROM veiculos_clientes WHERE id_veiculo IN ($veic) ORDER BY id_veiculo DESC";
					$resultado_usuario = mysqli_query($conn, $result_usuario);
					if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
						while($rows4 = mysqli_fetch_assoc($resultado_usuario)){
								$marca_veiculo = $rows4['marca_veiculo'];
								$modelo_veiculo = $rows4['modelo_veiculo'];
								$chassi = $rows4['chassi'];
								$combustivel = $rows4['combustivel'];
								$placa = $rows4['placa'];
								$pacote = $rows4['pacote'];
								$renavan = $rows4['renavan'];
								$cor_veiculo = $rows4['cor_veiculo'];
								$tipo_veiculo1 = $rows4['tipo_veiculo'];
								$ano_veiculo = $rows4['ano_veiculo'];
								$data_vencimento = $rows4['data_vencimento'];
								$proprietario = $rows4['proprietario'];
								
									if($tipo_veiculo1 == 'motorcycle'){
										$tipo_veiculo = 'Motocicleta';
									}
									elseif($tipo_veiculo1 == 'car'){
										$tipo_veiculo = 'Automovel';
									} else {
										$tipo_veiculo = $tipo_veiculo1;
									}
								
								$cons_tipo = mysqli_query($con,"SELECT * FROM veiculos_tipos WHERE categoria='$tipo_veiculo' ORDER BY categoria DESC LIMIT 1");
									if(mysqli_num_rows($cons_tipo) > 0){
								while ($resp_tipo = mysqli_fetch_assoc($cons_tipo)) {
								$tipo_veiculo1 = 	$resp_tipo['tipo_veiculo'];
								}}
					?>
					<div class="row">
				<div class="col-md-6" style="color:#000;">
					<div class="form-group">
						<span>Marca / Modelo: <b><?php echo $marca_veiculo?> / <?php echo $modelo_veiculo?></b></span><br>
						<span>Cor: <b><?php echo $cor_veiculo?></b></span><br>
						<span>Chassi: <b><?php echo $chassi?></b></span><br>
						<span>Categoria: <b><?php echo $tipo_veiculo?></b></span>
					</div>
				</div>
				<div class="col-md-6" style="color:#000;">
					<div class="form-group">
						<span>Ano: <b><?php echo $ano_veiculo?></b></span><br>
						<span>Renavam: <b><?php echo $renavan?></b></span><br>
						<span>Placa: <b><?php echo $placa?></b></span><br>
						<span>Combustível: <b><?php echo $combustivel?></b></span>
					</div>
				</div>
			</div>
					<hr style="border:#000 1px dashed;">	
					<?php }}?>
					<hr style="border:#000 1px solid;">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<p><b>DADOS FINANCEIROS AFETOS AOS SERVIÇOS CONTRATADOS / PRESTADOS</b></p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6" style="color:#000;">
					<div class="form-group">
						<span>Periodicidade: <b>MENSAL</b></span><br>
						<span>Forma de Pagamento: <b><?php echo $forma_pagamento?></b></span>
						
					</div>
				</div>
				<div class="col-md-6" style="color:#000;">
					<div class="form-group">
						<span>Valor Mensal: <b><?php echo $valor_mensal?></b></span><br>
						<span>Espécie de Contrato: <b>Comodato de Equipamento</b></span>
						
					</div>
				</div>
			</div>
			<hr style="border:#000 1px solid;">
			<div class="row">
				<div class="col-md-12" style="color:#000;">
					<div class="form-group">
						<span>Na qualidade de contratante, declaro que li e estou ciente de todos os termos e condições ajustados no formulário de adesão e respectivo contrato de prestação de serviços de instalação, manutenção e monitoramento eletrônico e assim, concordo com os mesmos em sua integralidade e sem qualquer oposição; bem como declaro a veracidade de todas as informações e dados por mim noticiados por meio presente instrumento, pelo que firmo o presente.</span>
						
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-justify" style="color:#000;">
					<div class="form-group">
						<span>Horizonte, <?php echo date('d/m/Y')?></span>
						
					</div>
				</div>
			</div><br><br>
			<div class="row">
				<div class="col-md-12 text-center" style="color:#000;">
					<div class="form-group">
</br>
						<span>___________________________________________________________________</span><br>
						<span><?php echo $nome_cliente?></span>
						
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-right" style="color:#000;">
					<div class="form-group">
						<span>Página 1/6</span>
						
					</div>
				</div>
			</div>
		</div>
		
		<!-- PÁGINA 2 -->
		<div class="ibox-content p-xl break" style="border-radius:5px; border:#000000 2px solid;">
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<img src="/tracker/Imagens/logo2.png" width="161" height="75" />
					</div>
				</div>
				<div class="col-md-6 text-center" style="color:#000;">
					<div class="form-group">
						<h4>CONTRATO DE PRESTAÇÃO DE SERVIÇOS DE MONITORAMENTO</h4>
					</div>
				</div>
				<div class="col-md-3 text-right" style="color:#000;">
					<div class="form-group">
						<span>Contrato: <?php echo $id_veiculo?></span>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-justify" style="color:#000;">
					<div class="form-group">
						<p>JC RASTREAMENTO, pessoa jurídica de direito privado, inscrita no CNPJ 27.050.542\0001-25, situada em AV PRESIDENTE CASTELO BRANCO 4251, CENTRO, HORIZONTE-CE, doravante denominada CONTRATADA, neste ato representada por seu contrato social, e de outro lado o adquirente do Rastreador, conforme qualificação preenchida no FORMULÁRIO anexo a este documento, doravante denominado simplesmente CONTRATANTE, tem entre si justo e contratado o seguinte, nos termos e nas condições abaixo:.</p>
						<p><b>Definições:</b></p>
						<p><b>GPS:</b> Sistema de Posicionamento Global. GSM/GPRS: Sistema Global para Comunicação Móvel. RASTREADOR: Conjunto de equipamentos eletrônicos microprocessados, com capacidade de interagir com fornecedores as tecnologias GPS, GSM/GPRS, para compilação de dados de localização e desligamento remoto do veículo.</p>
						<p><b>ÁREAS DE SOMBRA:</b> Áreas que, por razões físicas ou eletromagnéticas, não são alcançadas pelos sinais GPS/GSM/GPRS, tais como, interiores de túneis, garagens subterrâneas, proximidades a morros, serras, topografias diversas, áreas fechadas em geral, dentre outros.</p>
						<p><b>CONSIDERANDO:</b></p>
						<p>- Que a CONTRATADA é uma empresa especializada na montagem, instalação, comercialização e controle na prestação dos serviços de assistência ao consumidor de sistema eletrônico microprocessados, conforme descrito no item "definições";</p>
						<p>- Que a CONTRATADA está apta, técnica e logisticamente, para atender o CONTRATANTE, ressaltadas em áreas de sombra acima definidas;</p>
						<p>- Que o CONTRATANTE tem pleno conhecimento dos equipamentos objeto deste contrato, ficando ciente de seu funcionamento e que a sua eficácia dependerão de sua atuação e procedimentos corretos;</p>
						<p>- Que em caso de algum defeito no produto deverá imediatamente comunicar-se com a CONTRATADA;</p>
						<p>- Que em havendo defeito elétrico em seu veículo ou outro incidente que possa prejudicar o bom funcionamento elétrico do seu veículo o CONTRATANTE comunicará a CONTRATADA a ocorrência e providenciará seu conserto;</p>
						<p>- Que o CONTRATANTE tem pleno conhecimento de que o sistema pode sofrer interferências ou sombras, dependendo da localização em que estiver o veículo onde estão instalados os equipamentos; RESOLVEM, de comum acordo o seguinte:</p>
					</div>
				</div>
			</div><br>
			<div class="row">
				<div class="col-md-12 text-justify" style="color:#000;">
					<div class="form-group">
						<p><b>CLÁUSULA PRIMEIRA – OBJETO</b></p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-justify" style="color:#000;">
					<div class="form-group">
						<p>1. O presente contrato tem por objeto um equipamento eletrônico, prestação de serviços de rastreamento via internet e de bloqueio do veículo automotor à distância, com sinal codificado, por meio de telefonia móvel celular.</p>
						<p><b>Parágrafo 1º:</b> O equipamento tem como objetivo a coleta de dados de localização geográfica do veículo automotor no qual encontra-se instalado o equipamento Rastreador através do sistema GPS.</p>
						<p><b>Parágrafo 2º:</b> A CONTRATADA contratará os serviços da operadora de telefonia celular (CLARO, VIVO, TIM ou outra operadora a critério da CONTRATADA), para que esta proceda ao envio de comandos/sinais GSM/GPRS, destinados a ativação do sistema de bloqueio/desligamento eletrônico/remoto veicular presente ao Rastreador.</p>
						<p><b>Parágrafo 3º:</b> Os serviços acima descritos dependem das seguintes condições:</p>
						<p><b>a)</b> Que o veículo se encontre dentro da área tecnicamente de cobertura de serviços.</p>
						<p><b>b)</b> Que o veículo esteja com seu sistema elétrico em perfeito estado de funcionamento.</p>
						
						
						
					</div>
				</div>
			</div><br>
			
			<div class="row">
				
				<div class="col-md-6 text-right" style="color:#000;">
					<div class="form-group">
						<p>Página 2/6</p>
						
					</div>
				</div>
			</div>
		</div>
		
		<!-- PÁGINA 3 -->
		<div class="ibox-content p-xl break" style="border-radius:5px; border:#000000 2px solid;">
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<img src="/tracker/Imagens/logo2.png" width="161" height="75" />
					</div>
				</div>
				<div class="col-md-6 text-center" style="color:#000;">
					<div class="form-group">
						<h4>CONTRATO DE PRESTAÇÃO DE SERVIÇOS DE MONITORAMENTO</h4>
					</div>
				</div>
				<div class="col-md-3 text-right" style="color:#000;">
					<div class="form-group">
						<span>Contrato: <?php echo $id_veiculo?></span>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-12 text-justify" style="color:#000;">
					<div class="form-group">
						<p><b>c)</b> Que o veículo não se encontre em ÁREAS DE SOMBRA;</p>
						<p><b>d)</b> Que o veículo não sofra avarias que afetem seu sistema elétrico e que possam, ainda que indiretamente, danificar o equipamento.</p>
						<p><b>e)</b> Que o Rastreador não seja removido/desinstalado do veículo por pessoas não autorizadas pela CONTRATADA, ou mesmo testado por pessoas não credenciadas pela CONTRATADA.</p>
						<p><b>Parágrafo 4º:</b> No caso de bloqueio do veículo em movimento, uma vez provocada pelo CONTRATANTE, cabe à CONTRATADA avaliar o melhor momento de fazê-lo, não sendo obrigação sua proceder ao bloqueio, de imediato.</p>
						<p>Parágrafo 5º:<b></b> A visualização da localização do veículo via internet terá o seu bom desempenho condicionado à qualidade e compatibilidade do sistema de informática utilizado pelo CONTRATANTE.</p>
						<p><b>Parágrafo 6º:</b> O CONTRATANTE declara expressamente ter sido esclarecido que:</p>
						<p><b>a)</b> Que não existe garantia de recuperação ou qualquer tipo de serviço de resgate ou socorro no serviço contratado, uma vez que o serviço se restringe à localização e bloqueio do veículo.</p>
						<p><b>b)</b> Que para o resgate do veículo equipado com o Rastreador o CONTRATANTE deverá informar a autoridade policial competente.</p>
						<p><b>c)</b> Que o Rastreador não receberá os comandos enviados pela operadora de telecomunicação na hipótese de mau funcionamento do sistema elétrico/eletrônico do veículo em que estiver instalado.</p>
						<p><b>d)</b> Que a CONTRATADA não se responsabiliza por perdas, danos e lucros cessantes decorrentes de eventual sinistro, tampouco por perdas, danos e lucros cessantes decorrentes do eventual não recebimento da radiocomunicação com tecnologia celular pelo Rastreador, e ainda, por perdas, danos e lucros cessantes causados por quaisquer motivos decorrentes do sinal oriundo do equipamento instalado no veículo.</p>
						<p><b>e)</b> Que a CONTRATADA não garante nem se responsabiliza de qualquer forma ou meio pelo estado de conservação do veículo equipado como equipamento, tampouco pela integridade física de seus ocupantes, ou de eventos que envolvam terceiros.</p>
						<p><b>f)</b> Que todas as funcionalidades do produto dependem da confirmação do usuário, mediante senha ou confirmação de dados cadastrais.</p>
						<p><b>g)</b> Que a CONTRATADA não poderá de nenhuma forma ser responsabilizada por qualquer defeito, atraso ou interrupção na prestação do serviço decorrente de, mas não limitado, falta de manutenção do Rastreador ou no sistema elétrico/eletrônico do veículo, interrupção no fornecimento de energia elétrica, interrupção no sistema de envio de sinais de telefonia móvel pela operadora, defeitos mecânicos ou eletrônicos do veículo, remoção do equipamento rastreador do veículo, seja esta promovida por quem quer que seja, casos fortuitos ou forma maior.</p>
						<p><b>1.2. Este contrato não tem caráter de apólice de seguro e a prestação dos serviços de monitoramento e bloqueio ora ajustada entre as partes não impede a ocorrência de algum sinistro com o veículo do CONTRATANTE e não substitui qualquer outro tipo de equipamento ou dispositivo anti-furto, razão pela qual a CONTRATADA não é responsável por qualquer prejuízo sofrido pelo CONTRATANTE em caso de furto/roubo do referido veículo ou de bens encontrados no interior deste.</b></p>
						<p>1.3. O CONTRATANTE está ciente de que o equipamento opera por sistema de telefonia móvel celular e que o seu desempenho está sujeito às condições de recepção dos sinais de telefonia móvel celular, os quais podem sofrer interferências que impeçam o regular funcionamento do equipamento.</p>
						
						
					</div>
				</div>
			</div><br><br><br>
			
			<div class="row">
				
				<div class="col-md-6 text-right" style="color:#000;">
					<div class="form-group">
						<p>Página 3/6</p>
						
					</div>
				</div>
			</div>
		</div>
		
		
		<!-- PÁGINA 4 -->
		<div class="ibox-content p-xl break" style="border-radius:5px; border:#000000 2px solid;">
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<img src="/tracker/Imagens/logo2.png" width="161" height="75" />
					</div>
				</div>
				<div class="col-md-6 text-center" style="color:#000;">
					<div class="form-group">
						<h4>CONTRATO DE PRESTAÇÃO DE SERVIÇOS DE MONITORAMENTO</h4>
					</div>
				</div>
				<div class="col-md-3 text-right" style="color:#000;">
					<div class="form-group">
						<span>Contrato: <?php echo $id_veiculo?></span>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-justify" style="color:#000;">
					<div class="form-group">
					<p>1.4. Em função do disposto no item anterior, não cabe à CONTRATADA suportar qualquer responsabilidade por problemas na operação do equipamento ocorridos por falhas na rede pública de telecomunicações, em virtude de regiões de sombra para o sinal de rádio frequência ou indisponibilidade, momentânea ou definitiva, dos serviços de telefonia móvel celular.</p>
						<p>1.5. O CONTRATANTE se obriga, em caso de constatação de defeito no equipamento, a informar imediatamente a CONTRATADA com a finalidade de ser indicada uma oficina especializada e credenciada para proceder a verificação e o conserto do equipamento, não sendo admitida a colocação em conserto em oficina não credenciada.<br><b>De acordo com o firmado com a Cláusula 1.5 do contrato, podendo ocorrer PANE FALSA: ação em que o cliente atribui pane mecânica ou elétrica ao equipamento. Será efetuada a visita técnica e caso for comprovado que houve pane devido o equipamento, a empresa efetuará a correção sem custo para o cliente. Entretanto, caso não seja causado pelo equipamento o cliente pagará pela visita técnica no valor de 30,00 acrescida o valor calculado a título de deslocamento R$1,80 por quilometro rodado.</b></p>
						<p>1.6. Em caso de ocorrência de defeito no sistema elétrico do veículo, o CONTRATANTE deverá igualmente informar a CONTRATADA e providenciar a correção do defeito para correto funcionamento do Rastreador.</p>
						<p>1.7. O CONTRATANTE obriga-se a conservar os equipamentos em perfeitas condições de uso, não permitindo que terceiras pessoas venham a manusear suas instalações internas, acarretando avarias e prejudicando seu bom funcionamento..</p>
						<p>1.8. O CONTRATANTE obriga-se a informar seus dados cadastrais em caso de alterações referentes aos dados informados no momento do cadastro inicial, EX: mudança de endereço, telefone, e-mail etc.</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-justify" style="color:#000;">
					<div class="form-group">
						<p><b>CLÁUSULA SEGUNDA - PRAZO DE VIGÊNCIA E EXTINÇÃO</b></p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-justify" style="color:#000;">
					<div class="form-group">
						<p>2.0. O prazo mínimo do contrato é de 12 (doze) meses, a contar da data de instalação do equipamento, salvo se o CONTRATANTE pedir a sua extinção, por escrito, com antecedência de 30 (trinta dias) da data de vencimento do período em curso.</p>
					</div>
				</div>
			</div><BR>
			<div class="row">
				<div class="col-md-12 text-justify" style="color:#000;">
					<div class="form-group">
						<p>2.1. O contrato poderá ser extinto antes do seu vencimento, a pedido do CONTRATANTE, o qual pagará à CONTRATADA multa compensatória de 30% (trinta por cento) da soma dos valores relativos às mensalidades vincendas no período restante do contrato.</p>
						<p>2.2. O presente contrato, assim como os equipamentos a que se refere, não poderá ser cedido ou transferido a pessoas ou coisas, seja, em caso de venda do veículo, obriga-se o CONTRATANTE a comunicar a CONTRATADA sua ocorrência, para que seja procedida a retirada dos equipamentos que deverá ser feita, obrigatoriamente, em oficina credenciada.</p>
						<p>2.3. Igualmente, em caso de troca de veículo pelo CONTRATANTE, obriga-se este a comunicar o fato a CONTRATADA para que possa desinstalar o equipamento do veículo atual, e reinstalado no novo veículo, para isso porem será cobrado uma taxa de acordo com a tabela de serviços da CONTRATADA vigente à época, e em seguida alteradas todas as informações registradas e a transferência do equipamento.</p>
						<p>2.4. A infração a qualquer das cláusulas deste contrato acarretará a multa equivalente a 30% (trinta por cento) do valor anual do contrato, calculado sobre o valor vigente do serviço de monitoramento e será cobrado pela via Judiciária, considerada como dívida líquida e certa. O desacordo destas cláusulas, implicará o bloqueio temporário do ACESSO ao sistema após o quinto dia de atraso, após o décimo dia de atraso, será efetuado o bloqueio TOTAL de acesso ao sistema, não sendo possível o USUÁRIO acessar a localização e bloqueio do veículo e ao trigésimo dia de atraso, será efetuado o CANCELAMENTO TOTAL dos serviços de rastreamento e bloqueio do veículo.</p>
						
					</div>
				</div>
			</div><br><br><br><br>

			<div class="row">
				<div class="col-md-6 text-right" style="color:#000;">
					<div class="form-group">
						<p>Página 4/6</p>
						
					</div>
				</div>
			</div>
		</div>
		
		<!-- PÁGINA 5 -->
		<div class="ibox-content p-xl break" style="border-radius:5px; border:#000000 2px solid;">
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<img src="/tracker/Imagens/logo2.png" width="161" height="75" />
					</div>
				</div>
				<div class="col-md-6 text-center" style="color:#000;">
					<div class="form-group">
						<h4>CONTRATO DE PRESTAÇÃO DE SERVIÇOS DE MONITORAMENTO</h4>
					</div>
				</div>
				<div class="col-md-3 text-right" style="color:#000;">
					<div class="form-group">
						<span>Contrato: <?php echo $id_veiculo?></span>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-justify" style="color:#000;">
					<div class="form-group">
						<p><b>CLÁUSULA TERCEIRA – PREÇO E FORMA DE PAGAMENTO</b></p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-justify" style="color:#000;">
					<div class="form-group">
						<p>3. Pela execução do contrato, além do valor da adesão do rastreador, o CONTRATANTE pagará à CONTRATADA mensalidade pelo serviço de rastreamento do equipamento via internet. Todos os valores encontram-se no FORMULÁRIO anexo a este instrumento, valores estes que devem ser quitados em 12x no boleto, ou da melhor forma cabível entre as partes. O não pagamento e ou o cancelamento do mesmo pelo contratante incidirá a inclusão do nome do contratante aos órgãos de defesa do consumidor: SPC / SERASA; e incluindo o item 2.4 deste contrato.</p>
						<p>3.1. Os preços referentes ao presente contrato serão reajustados anualmente ou na menor periodicidade permitida em lei, pelo índice IGP-M/FGV acumulado do período.</p>
						<p>3.2. O atraso no pagamento das mensalidades pelos serviços de monitoramento e bloqueio importará na cobrança de multa moratória de 2% (dois por cento) e juros moratórios de 1% (um por cento) ao mês sobre o valor contratado, exceto se o CONTRATANTE tiver quitado no cartão de crédito.</p>
						<p>3.3. A CONTRATANTE autoriza de imediato a CONTRATADA a emitir duplicatas de prestação de serviços para a cobrança dos valores decorrentes do presente contrato, podendo proceder ao apontamento desses títulos a protesto por falta de pagamento, independentemente de aceite, cuja falta é suprida pela presente autorização, exceto se o CONTRATANTE tiver quitado no cartão de crédito.</p>
						<p>3.4 Caso de não devolver o equipamento de rastreamento, será cobrado o valor especifico do rastreador que é equivalente a R$ 650,00 reais.</p>
						<p>3.5. Deixamos claro que, na insatisfação por algum PROBLEMA IDENTIFICADO E NÃO SOLUCIONADO, GARANTIMOS A DEVOLUÇÃO INTEGRAL DO VALOR PAGO até o terceiro dia da data assinatura deste contrato, após esse período regerá todas as cláusulas acima mencionadas.</p>
					</div>
				</div>
			</div><br>
			<div class="row">
				<div class="col-md-12 text-justify" style="color:#000;">
					<div class="form-group">
						<p><b>CLÁUSULA QUARTA – REGRAS GERAIS DA EXECUÇÃO DO CONTRATO</b></p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-justify" style="color:#000;">
					<div class="form-group">
						<p>4. Somente o CONTRATANTE e as pessoas indicadas no campo "Pessoas Autorizadas" do FORMULÁRIO anexo a este instrumento e mediante ao seu USUÁRIO e SENHA pessoal, poderão solicitar à CONTRATADA a localização, o bloqueio, a ativação e a desativação do equipamento, ficando a CONTRATADA expressamente autorizada a deixar de atender solicitações feitas por terceiros sem autorização.</p>
						<p>4.1. Comunicada a ocorrência de sinistro do veículo pelo CONTRATANTE ou pelas pessoas autorizadas a operar o equipamento, fica a CONTRATADA, desde já, autorizada a proceder para tentar a sua localização e bloqueio.</p>
						<p>4.2. O CONTRATANTE é responsável pela verificação periódica do correto funcionamento do equipamento para o fim de identificar e informar à CONTRATADOS eventuais problemas técnicos, preventivamente.</p>
						<p>4.3. Para o fim do disposto no item 4.2, o CONTRATANTE solicitará um acionamento do equipamento a cada período de 30 dias, em caráter de teste, sem custo, pelo telefone da CONTRATADA, cumprindo ao CONTRATANTE, sempre, informar à CONTRATADA que se trata de teste técnico e não de sinistro.</p>
						<p>4.4. Ressalvada a hipótese de teste, referida no item anterior, a solicitação de acionamento do equipamento somente deverá ser feita em caso de ocorrência de sinistro no veículo. Do contrário, o acionamento imotivado importará na cobrança de tarifa de utilização na fatura correspondente ao mês de referência.</p>
						<p>4.5. O CONTRATANTE fica responsável pela conservação do equipamento, comprometendo-se a não permitir que pessoa não autorizada pela CONTRATADA realize qualquer espécie de intervenção técnica no mesmo.</p>
						
					</div>
				</div>
			</div><br>
			<div class="row">
				<div class="col-md-6 text-right" style="color:#000;">
					<div class="form-group">
						<p>Página 5/6</p>
						
					</div>
				</div>
			</div>
		</div>
		<div class="ibox-content p-xl break" style="border-radius:5px; border:#000000 2px solid;">
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<img src="/tracker/Imagens/logo2.png" width="161" height="75" />
					</div>
				</div>
				<div class="col-md-6 text-center" style="color:#000;">
					<div class="form-group">
						<h4>CONTRATO DE PRESTAÇÃO DE SERVIÇOS DE MONITORAMENTO</h4>
					</div>
				</div>
				<div class="col-md-3 text-right" style="color:#000;">
					<div class="form-group">
						<span>Contrato: <?php echo $id_veiculo?></span>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="row">
					<div class="col-md-12 text-justify" style="color:#000;">
						<div class="form-group">
							<p>4.6. A assistência técnica somente será realizada por pessoal autorizado pela CONTRATADA. Caso o técnico autorizado pela CONTRATADA se desloque até o local indicado pelo CONTRATANTE para a instalação ou assistência técnica do equipamento e o veículo não esteja disponível, será cobrada a taxa pela visita técnica constante da tabela de serviços da CONTRATADA.</p>
						<p>4.7. Em caso de sinistro, uma vez determinadas as coordenadas de localização do veículo pelo equipamento, a CONTRATADA, certificará o local da suposta localização do veículo e informará o CONTRATANTE caso encontrado o veículo, os quais atuarão com base na informação de localização prestada pela CONTRATADA, desde que o veículo se encontre em local coberto por sinais de telefonia celular e pelo serviço de auxílio ao resgate.</p>
						<p>4.8. O auxílio ao resgate, constante no item 4.7, não garante a restituição do veículo ao CONTRATANTE, nem gera tal obrigação contratual à CONTRATADA, mas apenas serve de apoio às autoridades policiais competentes, as quais continuam sendo as únicas responsáveis pela recuperação do veículo.</p>
						<p>4.9. O USUÁRIO está ciente que a utilização do SIM CARD presente no equipamento somente é permitida em conjunto com o sistema ora contratado, com a finalidade de fruição dos serviços já descritos nesse contrato, sendo o USUÁRIO responsabilizado</p>
						</div>
					</div>
				</div><br>
				<div class="col-md-12 text-justify" style="color:#000;">
					<div class="form-group">
						<p><b>CLÁUSULA QUINTA - DAS DISPOSIÇÕES FINAIS</b></p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-justify" style="color:#000;">
					<div class="form-group">
						<p>5. O CONTRATANTE declara ter sido devidamente instruído pela CONTRATADA sobre o correto funcionamento do equipamento e ter assinado os devidos formulários, check-list e contrato, contendo todas as informações necessárias à sua operacionalização, podendo o CONTRATANTE recorrer à área técnica da CONTRATADA para o esclarecimento de qualquer dúvida, através do telefone (85) 98105-1307.</p>
					</div>
				</div>
			</div><br>
			<div class="row">
				<div class="col-md-12 text-justify" style="color:#000;">
					<div class="form-group">
						<p>Horizonte, <?php echo $data_assinatura?></p>
						
					</div>
				</div>
			</div><br>
			<div class="row">
				<div class="col-md-12 text-center" style="color:#000;">
					<div class="form-group">
						<BR><BR><BR><BR>
						<img src="/tracker2/manager/imagens/carimbo.jpg" style="width:200px;height:auto;">
					</div>
				</div>	
			</div><br><br><br><br><br><br>
			<div class="row">
				<div class="col-md-12 text-center" style="color:#000;">
					<div class="form-group">
						<br>
						
						<p>____________________________________________________________<br><b><?php echo $nome_cliente?></b></p>
					</div>
				</div>	
			</div>
			
			<br><br><br>
			<div class="row">
				<div class="col-md-6 text-right" style="color:#000;">
					<div class="form-group">
						<p>Página 6/6</p>
						
					</div>
				</div>
			</div>
		</div>
		<!-- PÁGINA 6 -->
		<div class="ibox-content p-xl break" style="border-radius:5px; border:#000000 2px solid;">
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<img src="/tracker/Imagens/logo2.png" width="161" height="75" />
					</div>
				</div>
				<div class="col-md-6 text-center" style="color:#000;">
					<div class="form-group">
						<h4>DECLARAÇÃO DE CONHECIMENTO</h4>
						<p>Contrato de Comodato de Equipamentos e Serviços de Rastreamento de veículos.</p>
					</div>
				</div>
				<div class="col-md-3 text-right" style="color:#000;">
					<div class="form-group">
						<span>Contrato: <?php echo $id_veiculo?></span>
					</div>
				</div>
			</div>
			<BR><BR>
			<div class="row">
				<div class="col-md-6" style="color:#000;">
					<div class="form-group">
						<p>Nome/Razão Social: <b><?php echo $nome_cliente?></b></p>
						<p>CPF/CNPJ: <b><?php echo $doc_cliente?></b></p>
						<p>Endereço: <b><?php echo $endereco?>, <?php echo $numero?> - <?php echo $complemento?></b></p>
						<p>CEP: <b><?php echo $cep?></b></p>
					</div>
				</div>
				<div class="col-md-6" style="color:#000;">
					<div class="form-group">
						<p>Telefone: <b><?php echo $telefone_celular?></b></p>
						<p>RG/Insc. Estadual: <b><?php echo $rg_cliente?></b></p>
						<p>Bairro/Cidade: <b><?php echo $cidade?>/<?php echo $estado?></b></p>
						<p>Email: <b><?php echo $email?></b></p>
					</div>
				</div>
			</div><br>
			<div class="row">
				<div class="col-md-12 text-justify" style="color:#000;">
					<div class="form-group">
						<p>Declaro para devidos fins de direito, que mantendo contrato de COMODATO DE EQUIPAMENTOS E PRESTAÇÃO DE SERVIÇOS DE RASTREAMENTO VEICULAR, e tendo pleno conhecimento de que o serviço prestado pela JC CAR RASTREAMENTO é tão somente de localização do(s) veículo(s), não sendo de responsabilidade a recuperação física do bem deste contrato, cabendo esta tarefa às autoridades competentes, bem como que, apenas se inicia a prestação do serviço, e as resposabilidades contratuais das partes, após a instalação do equipamento rastreador no veículo do contrante, o qual está declarado no FORMULÁRIO DE ADESÃO, parte integrante deste contrato.</b></p>
					</div>
				</div>
			</div><br>
			<div class="row">
				<div class="col-md-12 text-justify" style="color:#000;">
					<div class="form-group">
						<p>Horizonte, <?php echo $data_assinatura?></p>
						
					</div>
				</div>
			</div><br><br><br>
			<div class="row">
				<div class="col-md-12 text-center" style="color:#000;">
					<div class="form-group">
						<br>
						<BR><BR><BR>
						<img src="/tracker2/manager/imagens/carimbo.jpg" style="width:200px;height:auto;">
					</div>
				</div>	
			</div><br><br><br><br><br><br><br><br>
			<div class="row">
				<div class="col-md-12 text-center" style="color:#000;">
					<div class="form-group">
						<br>
						<p>____________________________________________________________<br><b><?php echo $nome_cliente?></b></p>
					</div>
				</div>	
			</div>
			
			<br><br><br><br><br><br><br><br>
			
		</div>
		
		
    </div>

    <!-- Mainly scripts -->
    <script src="/tracker/js/jquery-3.1.1.min.js"></script>
    <script src="/tracker/js/popper.min.js"></script>
    <script src="/tracker/js/bootstrap.js"></script>
    <script src="/tracker/js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="/tracker/js/inspinia.js"></script>
<!--
<script>
    window.print();
    window.addEventListener("afterprint", function(event) { window.close(); });
    window.onafterprint();
</script>
-->
</body>

</html>
