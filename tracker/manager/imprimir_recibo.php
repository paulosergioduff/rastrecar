<!DOCTYPE html>
<html>
<?php
include("conexao.php");
date_default_timezone_set('Brazil/East');
$data = date('d/m/Y');
$hora = date('H:i');
$date = date('y-m-d H:i:s');
$date1 = date('Y-m-d');

$semana = date("w"); 
$dia = date("j");
$mês = date("n");
$ano = date("Y");

$meses = array(1 => "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", 
"Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro");

$semanas = array("Domingo", "Segunda-Feira", "Terça-Feira", "Quarta-Feira", "Quinta-Feira", "Sexta-Feira", "Sábado");
$user = $_SESSION['usuarioNome'];

$id_cliente = $_GET['id_cliente'];
$id_conta = $_GET['id_conta'];



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
$email = 	$resp_cliente['email'];
$pacote = 	$resp_cliente['pacote'];	
}}



$cons_conta = mysqli_query($conn,"SELECT * FROM contas_receber WHERE id_conta='$id_conta'");
	if(mysqli_num_rows($cons_conta) > 0){
while ($resp_conta = mysqli_fetch_assoc($cons_conta)) {
$duplicata	 = 	$resp_conta['duplicata'];
$data_emissao = 	$resp_conta['data_emissao'];
$data_emissao = date('d/m/Y', strtotime("$data_emissao"));
$data_vencimento = 	$resp_conta['data_vencimento'];
$data_vencimento1 = date('d/m/Y', strtotime("$data_vencimento"));
$descricao = 	$resp_conta['descricao'];
$valor_bruto1 = 	$resp_conta['valor_bruto'];
$valor_bruto = number_format($valor_bruto1, 2, ",", ".");
$nr_banco = 	$resp_conta['nr_banco'];
$observacoes	 = 	$resp_conta['observacoes'];
$observacoes = html_entity_decode($observacoes);
$banco	 = 	$resp_conta['banco'];
$especie	 = 	$resp_conta['especie'];
$id_cliente1	 = 	$resp_conta['id_cliente'];
$class_financeira = 	$resp_conta['class_financeira'];
$status	 = 	$resp_conta['status'];
$status_banco	 = 	$resp_conta['status_banco'];
$forma_pagamento = $resp_conta['forma_pagamento'];
$nr_contrato = $resp_conta['nr_contrato'];
}}






	
$cons_contrato = mysqli_query($conn,"SELECT * FROM clientes_contratos WHERE nr_contrato='$nr_contrato'");
	if(mysqli_num_rows($cons_contrato) > 0){
while ($resp_contrato = mysqli_fetch_assoc($cons_contrato)) {
$forma_pagamento = 	$resp_contrato['forma_pagamento'];
	}}
	
	$cons_cat = mysqli_query($conn,"SELECT * FROM categorias_contas_receber WHERE id_categoria='$class_financeira'");
	if(mysqli_num_rows($cons_cat) > 0){
while ($resp_cons_cat = mysqli_fetch_assoc($cons_cat)) {
$categoria	 = 	$resp_cons_cat['categoria'];

}}
	
	
class Extenso
{
    public static function removerFormatacaoNumero( $strNumero )
    {

        $strNumero = trim( str_replace( "R$", null, $strNumero ) );

        $vetVirgula = explode( ",", $strNumero );
        if ( count( $vetVirgula ) == 1 )
        {
            $acentos = array(".");
            $resultado = str_replace( $acentos, "", $strNumero );
            return $resultado;
        }
        else if ( count( $vetVirgula ) != 2 )
        {
            return $strNumero;
        }

        $strNumero = $vetVirgula[0];
        $strDecimal = mb_substr( $vetVirgula[1], 0, 2 );

        $acentos = array(".");
        $resultado = str_replace( $acentos, "", $strNumero );
        $resultado = $resultado . "." . $strDecimal;

        return $resultado;

    }

    public static function converte( $valor = 0, $bolExibirMoeda = true, $bolPalavraFeminina = false )
    {

        $valor = self::removerFormatacaoNumero( $valor );

        $singular = null;
        $plural = null;

        if ( $bolExibirMoeda )
        {
            $singular = array("centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
            $plural = array("centavos", "reais", "mil", "milhões", "bilhões", "trilhões","quatrilhões");
        }
        else
        {
            $singular = array("", "", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
            $plural = array("", "", "mil", "milhões", "bilhões", "trilhões","quatrilhões");
        }

        $c = array("", "cem", "duzentos", "trezentos", "quatrocentos","quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos");
        $d = array("", "dez", "vinte", "trinta", "quarenta", "cinquenta","sessenta", "setenta", "oitenta", "noventa");
        $d10 = array("dez", "onze", "doze", "treze", "quatorze", "quinze","dezesseis", "dezesete", "dezoito", "dezenove");
        $u = array("", "um", "dois", "três", "quatro", "cinco", "seis","sete", "oito", "nove");

        if ( $bolPalavraFeminina )
        {
            if ($valor == 1)
                $u = array("", "uma", "duas", "três", "quatro", "cinco", "seis","sete", "oito", "nove");
            else
                $u = array("", "um", "duas", "três", "quatro", "cinco", "seis","sete", "oito", "nove");

            $c = array("", "cem", "duzentas", "trezentas", "quatrocentas","quinhentas", "seiscentas", "setecentas", "oitocentas", "novecentas");
        }

        $z = 0;

        $valor = number_format( $valor, 2, ".", "." );
        $inteiro = explode( ".", $valor );

        for ( $i = 0; $i < count( $inteiro ); $i++ )
            for ( $ii = mb_strlen( $inteiro[$i] ); $ii < 3; $ii++ )
                $inteiro[$i] = "0" . $inteiro[$i];

        // $fim identifica onde que deve se dar junção de centenas por "e" ou por "," ;)
        $rt = null;
        $fim = count( $inteiro ) - ($inteiro[count( $inteiro ) - 1] > 0 ? 1 : 2);
        for ( $i = 0; $i < count( $inteiro ); $i++ )
        {
            $valor = $inteiro[$i];
            $rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
            $rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
            $ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";

            $r = $rc . (($rc && ($rd || $ru)) ? " e " : "") . $rd . (($rd && $ru) ? " e " : "") . $ru;
            $t = count( $inteiro ) - 1 - $i;
            $r .= $r ? " " . ($valor > 1 ? $plural[$t] : $singular[$t]) : "";
            if ( $valor == "000")
                $z++;
            elseif ( $z > 0 )
                $z--;

            if ( ($t == 1) && ($z > 0) && ($inteiro[0] > 0) )
                $r .= ( ($z > 1) ? " de " : "") . $plural[$t];

            if ( $r )
                $rt = $rt . ((($i > 0) && ($i <= $fim) && ($inteiro[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " e ") : " ") . $r;
        }

        $rt = mb_substr( $rt, 1 );

        return($rt ? trim( $rt ) : "zero");

    }
}




	  ?>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>RECIBO DE PAGAMENTO | <?php echo $nome_cliente?></title>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">


<style>
.break { page-break-before: always; }
</style>
</head>

<body class="white-bg" >
    <div class="wrapper wrapper-content p-xl" >
	
	<!-- PÁGINA 1 -->
		<div class="ibox-content p-xl break">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<img src="/tracker/Imagens/logo2.png" width="161" height="75" />
					</div>
				</div>
				<div class="col-md-6" style="color:#000;">
					<div class="form-group">
						<h3><b>RECIBO DE PAGAMENTO</b></h3>
						
					</div>
				</div>
				<div class="col-md-2 text-center" style="color:#000; border-radius:5px; border:#000000 2px solid;">
					<div class="form-group">
						<h3><b>Nº <?php echo $id_conta?></b></h3>
						<h4>Valor: R$ <?php echo $valor_bruto?></h4>
					</div>
				</div>
			</div><br><hr>
			<div class="row">
				<div class="col-md-12" style="color:#000; font-size:15px;">
					<div class="form-group">
						<p>Recebemos de <b><?php echo $nome_cliente?></b>, a importância no valor de <span style="background:#D2D2D2"><b>R$ <?php echo $valor_bruto?> (<?php echo Extenso::converte($valor_bruto, true, false);?>)</b></span>, referente ao(s) item(s) descrito(s) abaixo:</p>
					
					</div>
				</div>
			</div>
			<div class="row" style="color:#000; border-radius:5px; border:#000000 1px solid;">
				<div class="col-md-12">
					<div class="row"  >
						<div class="col-md-4" style="color:#000; font-size:15px;">
							<div class="form-group">
								<p>Duplicata: <br><b><?php echo $duplicata?> </b></p>
							</div>
						</div>
						<div class="col-md-4" style="color:#000; font-size:15px;">
							<div class="form-group">
								<p>Vencimento Original: <br><b><?php echo $data_vencimento1?></b> </p>
							</div>
						</div>
						<div class="col-md-4" style="color:#000; font-size:15px;">
							<div class="form-group">
								<p>Duplicada referente a <br><b><?php echo $categoria?></b> </p>
							</div>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-4" style="color:#000; font-size:15px;">
							<div class="form-group">
								<p>Valor Original: <br><b>R$ <?php echo $valor_bruto?> </b></p>
							</div>
						</div>
						
					</div>
				</div>
			</div><br>
			<div class="row">
				<div class="col-md-12" style="color:#000; font-size:15px;">
					<div class="form-group">
						<p>e pela clareza firmo(amos) o presente.</p>
					
					</div>
				</div>
			</div><br><br>
			<div class="row">
				<div class="col-md-12" style="color:#000; font-size:15px;">
					<div class="form-group">
						<p>Horizonte, <?php echo $data?></p>
					
					</div>
				</div>
			</div>
			<br><br>
			<div class="row">
				<div class="col-md-12 text-center" style="color:#000; font-size:15px;">
					<div class="form-group">
						
						<p>______________________________________________________</p>
						<p> JC CAR RASTREAMENTO<br>CNPJ: 27.050.542/0001-25</p>
					
					</div>
				</div>
			</div>
			
			
			
			
			
			
			
			
			
		
			
		
				
			
			
			
		
			
		</div>
		
		<div class="row" style="color:#000;">
				<div class="col-md-12 text-right">
					<div class="form-group">
						<p>Documento emitido em <?php echo $data?> às <?php echo $hora?></p>
					</div>
				</div>

			</div>
		
		
		
		
		
		
		
    </div>

    <!-- Mainly scripts -->
    <script src="../js/jquery-3.1.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="../js/inspinia.js"></script>
<!--
<script>
    window.print();
    window.addEventListener("afterprint", function(event) { window.close(); });
    window.onafterprint();
</script>
-->
</body>

</html>
