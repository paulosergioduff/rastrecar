<?php 
$servidor = "localhost";
$usuario = "root";
$senha = "TR4vcijU6T9Keaw";
$dbname = "traccar";

//Criar a conexao
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
$con = mysqli_connect($servidor, $usuario, $senha, $dbname);

$data_agora = date('H:i');
$data_login = date('Y-m-d H:i');
$deviceid = $_REQUEST['deviceid'];
$id_push = $_REQUEST['id'];

$data_limite = date('Y-m-d H:i');
$data_limite = date('Y-m-d H:i', strtotime('+24 hour', strtotime($data_limite)));

$link = $deviceid.'@'.$data_limite;

$link_base = base64_encode($link);

 $cons_user1 = mysqli_query($conn,"SELECT * FROM usuarios_push WHERE id_push='$id_push' ");
	if(mysqli_num_rows($cons_user1) <= 0){
		header('Location: logoff.php');
	}
	if(mysqli_num_rows($cons_user1) > 0){
		while ($resp_user1 = mysqli_fetch_assoc($cons_user1)) {
		$tipo = 	$resp_user1['tipo'];
		$id_usuarios = $resp_user1['id_usuarios'];
		$id_cliente_login = $resp_user1['id_cliente'];
		if($tipo == 'ADMIN'){
			header('Location: admin/index.php?id='.$id_push.'');
		}
		if($tipo == 'TECNICO'){
			header('Location: tecnico/index.php?id='.$id_push.'');
		}

		$sql = mysqli_query($conn, "UPDATE usuarios_push SET versao='V2', ultimo_login='$data_login' WHERE id_push='$id_push' ");
	}}

$cons_user = mysqli_query($conn, "SELECT * FROM usuarios WHERE id_usuarios = '$id_usuarios'");
	if(mysqli_num_rows($cons_user) > 0){
while ($resp_user = mysqli_fetch_assoc($cons_user)) {
$nome_user = 	$resp_user['nome'];
$nome_us = explode(" ", $nome_user);
$nome_user = $nome_us[0];
$email_user = 	$resp_user['email'];
$nivel = 	$resp_user['nivel'];
$ativo = 	$resp_user['ativo'];
$veiculos_user = 	$resp_user['veiculos'];
$permite_bloqueio = 	$resp_user['permite_bloqueio'];
$permite_bloqueio = 	$resp_user['permite_bloqueio'];

	}}



$nome_empesa = 'JC Rastreamento';

$id_conta = $_GET['id_conta'];

$cons_fatura = mysqli_query($conn, "SELECT * FROM contas_receber WHERE id_conta='$id_conta'");
	if(mysqli_num_rows($cons_fatura) > 0){
		while($rouw_fat = mysqli_fetch_assoc($cons_fatura)){
		$id_conta = $rouw_fat['id_conta'];
		$id_recorrencia1 = $rouw_fat['id_recorrencia'];
		$data_vencimento = $rouw_fat['data_vencimento'];
		$data_vencimento1 = date('d/m/Y', strtotime("$data_vencimento"));
		$linha_digitavel = $rouw_fat['linha_digitavel'];
		$nr_banco = $rouw_fat['nr_banco'];
		$nsu = $rouw_fat['nsu'];

		
		if($nr_banco == '0'){
			$nsu1 = explode("_", $nsu);
			$nsu = $nsu1[1];
			$link_boleto = 'https://www.asaas.com/i/'.$nsu;
		}
		
		if($nr_banco != '0'){
			$nr_banco1 = explode("_", $nr_banco);
			$nr_banco = $nr_banco1[1];
			$link_boleto = 'https://www.asaas.com/i/'.$nr_banco;
		}
		$status = $rouw_fat['status'];
		$especie = $rouw_fat['especie'];
		$class_financeira = $rouw_fat['class_financeira'];
		$valor_bruto = $rouw_fat['valor_bruto'];
		$valor_bruto1 = number_format($valor_bruto, 2, ",", ".");
		
		$card_number = $rouw_fat['card_number'];
		$card = explode(" ", $card_number);
		$bandeira = $card[0];
		$numero = $card[1];
		
		$data_pagamento = $rouw_fat['data_pagamento'];
		$data_pagamento1 = date('d/m/Y', strtotime("$data_pagamento"));
		
		if($id_recorrencia1 == 0){
			$id_recorrencia = 999999999999;
		}
		if($id_recorrencia1 != 0){
			$id_recorrencia = $id_recorrencia1;
		}
		
		if($especie == 13){
			if($card_number != ''){
				if($bandeira == 'MASTERCARD'){
					$bandeira1 = 'mastercard.jpg';
					$forma_pagamento = 'Cartão de Crédito';
					$final = '<span class="badge bg-dark font-11">Final '.$numero.'</span>';
					$botao_boleto = '<a href="baixar1.php?link='.$link_boleto.'" class="external-link"><button type="button" class="btn btn-full btn-m shadow-l rounded-s bg-highlight font-600 top-20" style="width:100%">ALTERAR CARTÃO</button></a>';
				}
				elseif($bandeira == 'VISA'){
					$bandeira1 = 'visa.jpg';
					$forma_pagamento = 'Cartão de Crédito';
					$final = '<span class="badge bg-dark font-11">Final '.$numero.'</span>';
					$botao_boleto = '<a href="baixar1.php?link='.$link_boleto.'" class="external-link"><button type="button" class="btn btn-full btn-m shadow-l rounded-s bg-highlight font-600 top-20" style="width:100%">ALTERAR CARTÃO</button></a>';
				}
				elseif($bandeira == 'ELO'){
					$bandeira1 = 'elo.jpg';
					$forma_pagamento = 'Cartão de Crédito';
					$final = '<span class="badge bg-dark font-11">Final '.$numero.'</span>';
					$botao_boleto = '<a href="baixar1.php?link='.$link_boleto.'" class="external-link"><button type="button" class="btn btn-full btn-m shadow-l rounded-s bg-highlight font-600 top-20" style="width:100%">ALTERAR CARTÃO</button></a>';
				}
				elseif($bandeira == 'HIPERCARD'){
					$bandeira1 = 'hipercard.jpg';
					$forma_pagamento = 'Cartão de Crédito';
					$final = '<span class="badge bg-dark font-11">Final '.$numero.'</span>';
					$botao_boleto = '<a href="baixar1.php?link='.$link_boleto.'" class="external-link"><button type="button" class="btn btn-full btn-m shadow-l rounded-s bg-highlight font-600 top-20" style="width:100%">ALTERAR CARTÃO</button></a>';
				}
				elseif($bandeira == 'AMEX'){
					$bandeira1 = 'amex.jpg';
					$forma_pagamento = 'Cartão de Crédito';
					$final = '<span class="badge bg-dark font-11">Final '.$numero.'</span>';
					$botao_boleto = '<a href="baixar1.php?link='.$link_boleto.'" class="external-link"><button type="button" class="btn btn-full btn-m shadow-l rounded-s bg-highlight font-600 top-20" style="width:100%">ALTERAR CARTÃO</button></a>';
				}
				elseif($bandeira == 'DINNERS'){
					$bandeira1 = 'dinners.jpg';
					$forma_pagamento = 'Cartão de Crédito';
					$final = '<span class="badge bg-dark font-11">Final '.$numero.'</span>';
					$botao_boleto = '<a href="baixar1.php?link='.$link_boleto.'" class="external-link"><button type="button" class="btn btn-full btn-m shadow-l rounded-s bg-highlight font-600 top-20" style="width:100%">ALTERAR CARTÃO</button></a>';
				}
				else {
					$bandeira1 = '<i class="far fa-credit-card fa-3x"></i>';
					$forma_pagamento = 'Cartão de Crédito';
					$final = '';
					$botao_boleto = '<a href="baixar1.php?link='.$link_boleto.'" class="external-link"><button type="button" class="btn btn-full btn-m shadow-l rounded-s bg-highlight font-600 top-20" style="width:100%">ALTERAR CARTÃO</button></a>';
				}
			}
			if($card_number == ''){
				$bandeira1 = '<i class="far fa-credit-card" fa-3x></i>';
				$forma_pagamento = 'Cartão de Crédito';
				$final = '';
			}
		}
		if($especie == 2){
			$bandeira1 = '<i class="fas fa-barcode fa-3x"></i>';
			$forma_pagamento = 'Boleto Bancário';
			$final = '';
			$botao_boleto = '<a href="baixar1.php?link='.$link_boleto.'" class="external-link"><button type="button" class="btn btn-full btn-m shadow-l rounded-s bg-highlight font-600 top-20" style="width:100%">ABRIR BOLETO</button></a>';
			$botao_cod_barras = '<button type="button" data-menu="menu-barras" class="btn btn-full btn-m shadow-l rounded-s bg-highlight font-600 top-20" style="width:100%">CÓDIGO DE BARRAS</button>';
			$botao_pix = '<button type="button" data-menu="menu-pix" class="btn btn-full btn-m shadow-l rounded-s bg-highlight font-600 top-20" style="width:100%">PAGAR COM PIX</button>';
		}
	}}


?>

<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
<title>APP</title>
<link rel="stylesheet" type="text/css" href="styles/bootstrap.css">
<link rel="stylesheet" type="text/css" href="styles/style.css">
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900|Roboto:300,300i,400,400i,500,500i,700,700i,900,900i&amp;display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="fonts/css/fontawesome-all.min.css">    
<link rel="manifest" href="_manifest.json" data-pwa-version="set_in_manifest_and_pwa_js">
<link rel="apple-touch-icon" sizes="180x180" href="app/icons/icon-192x192.png">
<script src="https://kit.fontawesome.com/a132241e15.js"></script>
</head>
    
<body class="theme-light" data-highlight="blue2">
    
<div id="preloader"><div class="spinner-border color-highlight" role="status"></div></div>
    
<div id="page">
    
    <!-- header and footer bar go here-->
    <div class="header header-fixed header-auto-show header-logo-app">
        <a href="index.html" class="header-title">LocalRast</a>
        <a href="#" data-menu="menu-main" class="header-icon header-icon-1"><i class="fas fa-bars"></i></a>
        <a href="#" data-toggle-theme class="header-icon header-icon-2 show-on-theme-dark"><i class="fas fa-sun"></i></a>
        <a href="#" data-toggle-theme class="header-icon header-icon-2 show-on-theme-light"><i class="fas fa-moon"></i></a>
        <a href="#" data-menu="menu-highlights" class="header-icon header-icon-3"><i class="fas fa-brush"></i></a>
    </div>
    <div id="footer-bar" class="footer-bar-5">
         <a href="perfil.php?id=<?php echo $id_push?>" onclick="carregar();"><i class="fas fa-user-circle"></i><span>Perfil</span></a>
        <a href="faturas.php?id=<?php echo $id_push?>" class="active-nav" onclick="carregar();"><i class="fas fa-file-invoice-dollar"></i><span>Faturas</span></a>
        <a href="index.php?id=<?php echo $id_push?>" onclick="carregar();"><i class="fas fa-car"></i><span>Veículos</span></a>
        <a href="#" data-menu="menu-main"><i class="fa fa-bars"></i><span>Menu</span></a>
    </div>
    
    <div class="page-content">
        
        <div class="page-title page-title-large">
            <h2><a href="#" class="color-white" data-back-button><i class="fa fa-arrow-left"></i> Voltar</a> </h2><br>
            <a href="#" data-menu="menu-main" class="bg-fade-gray1-dark shadow-xl preload-img" data-src="images/avatars/5s.png"></a>
        </div>
        <div class="card header-card shape-rounded" data-card-height="210">
            <div class="card-overlay bg-highlight opacity-95"></div>
            <div class="card-overlay dark-mode-tint"></div>
            <div class="card-bg preload-img" data-src="images/pictures/20s.jpg"></div>
        </div>
        

        <!-- Homepage Slider-->
        
		  <div class="card card-style shadow-xl">        
            <div class="content">
                <p class="mb-1">
                    <h2 class="font-24 font-700 mb-2">R$ <?php echo $valor_bruto1?></h2>
					 <h2 class="font-14 font-700 mb-2"><?php echo $data_vencimento1?></h2>
                    <h2 class="font-14 font-700 mb-2"><i class="fas fa-calendar-times fa-2x" style="color:#990000"></i> Fatura em Atraso</h2>
					<div class="list-group list-custom-large">
						<a href="#">
							<?php echo $bandeira1?>
							<span>Forma de Pagamento</span>
							<strong><?php echo $forma_pagamento?></strong>
							<?php echo $final?>
							<i class="fa fa-angle-right" style="color:#FFF"></i>
						</a>
					</div>
					<?php echo $botao_boleto?><br>
					<?php echo $botao_pix?><br>

					
                </p>

        </div> 
        </div> 
        
        
		
    
	
	
	

        <!-- footer and footer card-->
        
    </div>    
    <!-- end of page content-->
    
	<div id="menu-pix" class="menu menu-box-bottom rounded-m"
         data-menu-height="500" 
         data-menu-effect="menu-over">
        <div class="menu-title">
            
            <h1 class="font-20">Pagamento PIX</h1>
            <a href="#" class="close-menu"><i class="fa fa-times-circle"></i></a>
        </div>
        <div class="content mt-0">
            <p class="pe-3">
               Para fazer o pagamento por PIX, leia o QRCode ou use a chave Copia e Cola.
            </p>
            <div class="row mb-0" id="qrcode">
                
               
            </div>
			<div class="row mb-0">
                <div class="col-12 text-center">
                    <button class="btn btn-outline-primary" onclick="copyText()">Copiar Chave</button>
                </div>
               
            </div>
			 
        </div>
    </div>
	<input type="text" class="form-control font-20" id="id_conta" value="<?php echo $id_conta?>">
	

	
	<div id="aguarde" class="menu menu-box-modal rounded-m" 
         data-menu-height="120" 
         data-menu-width="310">
        <h1 class="text-center mt-3 pt-1"><i class="fa fa-sync fa-spin mr-3 fa-2x"></i></h1>
        
        <p class="boxed-text-l">
            Por favor, aguarde...
        </p>
    </div>
    
    <div id="menu-share" 
         class="menu menu-box-bottom menu-box-detached rounded-m" 
         data-menu-load="menu-share.html"
         data-menu-height="420" 
         data-menu-effect="menu-over">
    </div>    
    
    <div id="menu-highlights" 
         class="menu menu-box-bottom menu-box-detached rounded-m" 
         data-menu-load="menu-colors.html"
         data-menu-height="510" 
         data-menu-effect="menu-over">        
    </div>
    
    <div id="menu-main"
         class="menu menu-box-left menu-box-detached rounded-m"
         data-menu-width="300"
         data-menu-load="menu-main.php?id=<?php echo $id_push?>"
         data-menu-active="nav-starters"
         data-menu-effect="menu-over">  
    </div>
    
	<div id="toast-7" class="toast toast-tiny toast-bottom bg-green1-dark" data-delay="3000" data-autohide="true"><i class="fa fa-check mr-3"></i>Chave Copiada</div> 

    
</div>    


<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript" src="scripts/bootstrap.min.js"></script>
<script type="text/javascript" src="scripts/custom.js"></script>
<script>
	var id_conta = document.getElementById("id_conta").value;
	var intervalo2 = setInterval(function() { $('#qrcode').load('teste.php?id_conta='+id_conta); }, 1000);
</script>
<script>
	function carregar(){
		$('#aguarde').showMenu();
	}
	function carregar2(){
	$('#aguarde').showMenu();
	$('#menu-main').hideMenu();
}


function copyText() {
	let input = document.getElementById("chave_pix").value;
	let textarea = document.createElement('textarea');
	textarea.setAttribute('type', 'hidden');
	textarea.textContent = input;
	document.body.appendChild(textarea);
	textarea.select();
	document.execCommand('copy');
	$('#menu-pix').hideMenu();
	$('#toast-7').toast('show');
}
</script>

</body>
