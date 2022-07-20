<?php

$servidor = "localhost";
$usuario = "root";
$senha = "TR4vcijU6T9Keaw";
$dbname = "traccardb";

//Criar a conexao
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
$con = mysqli_connect($servidor, $usuario, $senha, $dbname);

$id_empresa = $_REQUEST['id_empresa'];

	$cons_notif = mysqli_query($conn,"SELECT * FROM notificacoes ORDER BY id_notific DESC LIMIT 10");
	if(mysqli_num_rows($cons_notif) > 0){
	while ($row_notif = mysqli_fetch_assoc($cons_notif)) {
	$data = $row_notif['data'];
	$data = date('d/m/Y H:i', strtotime("$data"));
	$data_lido = $row_notif['data_lido'];
	$data_lido = date('d/m/Y H:i', strtotime("$data_lido"));
	$id_notific = $row_notif['id_notific'];
	$titulo = $row_notif['titulo'];
	$tipo = $row_notif['tipo'];
	$lido = $row_notif['lido'];
	$user_lido = $row_notif['user_lido'];
	$mensagem1 = $row_notif['mensagem'];
	$mensagem1 = str_replace('-br', '<br>', $mensagem1);
	
	
	

?>
		<link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/fa-brands.css">
		<link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/fa-solid.css">
	<div class="card border-dark bg-transparent" style="border-left-color:#000; border-bottom:#000 1px solid; border-top:#000 1px solid; border-right:#000 1px solid">
		<div class="forml-control">	
		<div class="row">	
			<div class="col-md-7">
				<span><h5><span class="badge" style="background-color:#4682B4;color:#FFF"><?php echo $data?></span></h5></span><br>
				<span><b><i class="fal fa-info-circle"></i> <?php echo $titulo?></b></span><br>
				
				<span><?php echo $mensagem1?></span><br>
			</div>
			<div class="col-md-5 text-right">
				<?php
				if($lido == 'NAO'){
				?>
				<button type="button" class="btn btn-primary btn-xs" onClick="notific('<?php echo $id_notific;?>')">Marcar como lida</button>
				<?php
				}
				?>
				
				<?php
				if($lido == 'SIM'){
				?>
				<span><i class="fas fa-check-circle" style="color:#009900"></i> Lido em <?php echo $data_lido?></span>
				<?php
				}
				?>
				
			</div>
		</div>
		</div>
	</div>
	<br>


						
							
						<?php	
							}}
							
						?>	