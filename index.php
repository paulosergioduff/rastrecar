<?php 

$login_padrao = $_SERVER['SERVER_NAME'];
$login = explode(".", $login_padrao);
$login_padrao = $login[0];

$servidor = "localhost";
$usuario = "root";
$senha = "Murilo19781984";
$dbname = "traccar";


/*
//Criar a conexao
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
$con = mysqli_connect($servidor, $usuario, $senha, $dbname);


$cons_empresa = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='1361'");
	if(mysqli_num_rows($cons_empresa) > 0){
while ($resp_empresa = mysqli_fetch_assoc($cons_empresa)) {
$nome_url = $resp_empresa['nome_url'];
$logo = $resp_empresa['logo'];
$texto_rodape = $resp_empresa['texto_rodape'];
$texto_topo = $resp_empresa['texto_topo'];
$cor_sistema = $resp_empresa['cor_sistema'];
	}}

$cons_cli = mysqli_query($conn,"SELECT * FROM clientes WHERE subdominio='$login_padrao' ORDER BY id_cliente ASC");
	if(mysqli_num_rows($cons_cli) <= 0){
		$logo = '/tracker3/manager/logos/'.$logo.'';
	}
	if(mysqli_num_rows($cons_cli) > 0){
		while ($resp_cor = mysqli_fetch_assoc($cons_cli)) {
		$logo = 	'/tracker3/manager/logos/'.$resp_cor['logo'];

	}}*/

	$nome_url = "Rastrecar - Rastreamento de veículos";
$logo = ra;
$texto_rodape = "Rastrecar - Rastreamento de veículos";
$texto_topo = "Rastrecar";
$cor_sistema = "orange";

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>RMB RASTREAMENTO | Login</title>

   
<script src="https://kit.fontawesome.com/a132241e15.js"></script>
    <link href="http://jctracker.com.br/tracker/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://jctracker.com.br/tracker/font-awesome/css/font-awesome.css" rel="stylesheet">
	<link rel="icon" type="image/png" sizes="32x32" href="/tracker3/app-assets/img/favicon/favicon-32x32.png">
    <link href="http://jctracker.com.br/tracker/css/animate.css" rel="stylesheet">
    <link href="http://jctracker.com.br/tracker/css/style.css" rel="stylesheet">

</head>
<style>
body{
     background-image: url(/tracker/Imagens/word_map.png);
	 background-repeat: no-repeat;
	 background-position: top center;
	
}
</style>


<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <img src="tracker3/manager/logos/rastrecar.png" style="width:80%; height:auto">

            </div><br>
            <h3><span style="color:#000"><b>SISTEMA DE GESTÃO DE VEÍCULOS</b></span></h3><br>
            
            
            <p><b>Digite seus dados de acesso.</b></p>
            <form class="m-t" role="form" action="/tracker/entra.php" method="post">
                <div class="form-group">
                    <div class="input-group date">
						<span class="input-group-addon"><i class="fas fa-user"></i></span><input type="text" class="form-control" name="usuario" id="usuario" placeholder="Usuário" autocomplete="off"  type="text" required>
					</div>
                </div>
                <div class="form-group">
                   <div class="input-group date">
						<span class="input-group-addon"><i class="fas fa-key"></i></span><input type="password" class="form-control" name="senha" id="senha" placeholder="Senha" autocomplete="off"  type="text" required>
					</div>
                </div>
                <button type="submit" class="btn block full-width m-b" style="background-color:#002776; color:#FFF">Login</button>

               
              
              
            </form>
			
			
			<?php
		$date = date('Y-m-d');
		$error = $_GET['error'];
		if($error == 'login'){

		?>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script>
					$(document).ready(function(){
						$('#nova_conta').modal('show');
					});
				</script>
			<?php } ?>
			<div class="modal fade" id="nova_conta" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-body text-center font-18">
							<h3 class="mb-20">Erro!</h3>
							<div class="mb-30 text-center"><img src="Imagens/cross.png"></div><br><br>
							Usuário ou senha inválidos!
						</div>
						<div class="modal-footer justify-content-center">
							
							<button type="button" class="btn btn-dark" data-dismiss="modal">Tentar Novamente</button>
						</div>
					</div>
				</div>
			</div>
			
				<?php
		$date = date('Y-m-d');
		$active = $_GET['active'];
		if($active == 'error'){

		?>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script>
					$(document).ready(function(){
						$('#erro_login').modal('show');
					});
				</script>
			<?php } ?>
			<div class="modal fade" id="erro_login" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-body text-center font-18">
							<h3 class="mb-20">Erro!</h3>
							<div class="mb-30 text-center"><img src="Imagens/cross.png"></div><br><br>
							Acesso Bloqueado! Contate o Suporte.
						</div>
						<div class="modal-footer justify-content-center">
							
							<button type="button" class="btn btn-dark" data-dismiss="modal">OK</button>
						</div>
					</div>
				</div>
			</div>
			
			
            <p class="m-t"> <small>Direitos Reservados @RMB Rastreamento Veicular</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="http://jctracker.com.br/tracker/js/jquery-3.1.1.min.js"></script>
    <script src="http://jctracker.com.br/tracker/js/popper.min.js"></script>
    <script src="http://jctracker.com.br/tracker/js/bootstrap.js"></script>
<!-- Hello server -->
</body>

</html>
