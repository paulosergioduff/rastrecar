<?php
$url2 = $_SERVER['REQUEST_URI'];
$url2 = str_replace('tracker3', 'tracker2', $url2);

$cons_cli10 = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente50'");
	if(mysqli_num_rows($cons_cli10) > 0){
while ($resp_cor1 = mysqli_fetch_assoc($cons_cli10)) {
$id_cliente_pai100 = $resp_cor1['id_cliente_pai'];
	}}
	
$cons_cli101 = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente_pai100'");
	if(mysqli_num_rows($cons_cli101) > 0){
while ($resp_cor1111 = mysqli_fetch_assoc($cons_cli101)) {
$telefone_residencial = 	$resp_cor1111['telefone_residencial'];
	}}
	
if($id_cliente_pai100 == '1361'){
	$telefone_central = '(81) 9 9880-2625';
}
if($id_cliente_pai100 != '1361'){
	$telefone_central = $telefone_residencial;
}
?>

<header class="page-header" role="banner">
	<!-- we need this logo when user switches to nav-function-top -->
 
	<!-- DOC: nav menu layout change shortcut -->
	<div class="hidden-md-down dropdown-icon-menu position-relative">
		<a href="#" class="header-btn btn js-waves-off"  data-action="toggle" data-class="nav-function-hidden" title="Hide Navigation">
			<i class="ni ni-menu"></i>
		</a>
		
	</div>
	<!-- DOC: mobile button appears during mobile width -->
	<div class="hidden-lg-up">
		<a href="#" class="header-btn btn press-scale-down"  data-action="toggle" data-class="mobile-nav-on">
			<i class="ni ni-menu"></i>
		</a>
	</div>
     <h3><span class="badge  badge-dark" style="text-align: left;"><b>Central de Atendimento: <i class="fas fa-phone-square"></i> <?php echo $telefone_central?></b></span></h3>
	<div class="ml-auto d-flex">
		
	   
	   <!-- app notification -->
	 
	   
		<div>
			<a href="#" class="header-icon" data-toggle="modal" data-target="#notificacoes" style="cursor: pointer;">
				<i class="fal fa-info-circle"></i>
				<span class="badge badge-icon" style="background-color:#DAA520;color:#FFF;display:none" id="cont_notif"></span>
			</a>
			
		</div>
		<!-- app user menu -->
	   
	
	   
	   
	   
	   
	   
		<!-- app notification -->
		<div>
			<a href="#" class="header-icon" data-toggle="dropdown">
				<i class="fal fa-bell"></i>
				
			</a>
			<div class="dropdown-menu dropdown-menu-animated dropdown-xl">
				<div class="dropdown-header bg-trans-gradient d-flex justify-content-center align-items-center rounded-top mb-2">
					<h4 class="m-0 text-center color-white">
						Alertas Emitidos - Veículos
						<small class="mb-0 opacity-80 bg-fadedz">Últimos 20 registros</small>
					</h4>
				</div>
			   
				<div class="tab-content tab-notification" >
					
					
					
					<div style="height:500px">
						<div class="custom-scroll h-100">
							<ul class="notification" id="avisos">
								
							   
								
							   
							   
								
							   
							</ul>
						</div>
					</div>
				</div>
				<div class="py-2 px-3 bg-faded d-block rounded-bottom text-right border-faded border-bottom-0 border-right-0 border-left-0">
					<a href="#" class="fs-xs fw-500 ml-auto">view all notifications</a>
				</div>
			</div>
		</div>
		<!-- app user menu -->
		
		
		
		
		<div>
			<a href="#" data-toggle="dropdown" title="drlantern@gotbootstrap.com" class="header-icon d-flex align-items-center justify-content-center ml-2">
				<img src="/tracker3/app-assets/img/demo/avatars/profile_small.png" class="profile-image rounded-circle" alt="Dr. Codex Lantern">
				<!-- you can also add username next to the avatar with the codes below:
				<span class="ml-1 mr-1 text-truncate text-truncate-header hidden-xs-down">Me</span>
				<i class="ni ni-chevron-down hidden-xs-down"></i> -->
			</a>
			<div class="dropdown-menu dropdown-menu-animated dropdown-lg">
				<div class="dropdown-header bg-trans-gradient d-flex flex-row py-4 rounded-top">
					<div class="d-flex flex-row align-items-center mt-1 mb-1 color-white">
						<span class="mr-2">
							<img src="/tracker3/app-assets/img/demo/avatars/profile_small.png" class="rounded-circle profile-image" alt="Dr. Codex Lantern">
						</span>
						<div class="info-card-text">
							<div class="fs-lg text-truncate text-truncate-lg"><?php echo $user_nome?></div>
							<span class="text-truncate text-truncate-md opacity-80"><?php echo $nome_fantasia?></span>
						</div>
					</div>
				</div>
			  
				
				<div class="dropdown-divider m-0"></div>
				<a href="#" class="dropdown-item" data-action="app-fullscreen">
					<i class="fal fa-desktop"></i> <span data-i18n="drpdwn.fullscreen">Tela Cheia</span>
					<i class="float-right text-muted fw-n">F11</i>
				</a>
			   
				
				<div class="dropdown-divider m-0"></div>
				<a class="dropdown-item fw-500 pt-3 pb-3" href="logout.php?id=<?php echo $user_id?>&customer=<?php echo $id_empresa?>">
					<i class="fal fa-power-off"></i> <span data-i18n="drpdwn.page-logout">Sair do Sistema</span>
					
				</a>
			</div>
		</div>
	</div>
</header>
					

					
		<div class="modal fade" id="notificacoes" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog  modal-lg">
				<div class="modal-content">
					<div class="modal-header bg-info text-white">
						<h4 class="modal-title" id="myLargeModalLabel" style="color:#FFF;">NOTIFICAÇÕES DE SISTEMA</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						 <div id="avisos_notif"></div>
						 <div id="avisos_notif1" style="display:none;"></div>
						
					</div>
					<div class="modal-footer">
						 <button type="button" class="btn btn-dark" data-dismiss="modal">Fechar</button>
						 
					</div>
				</div>
			</div>
		</div>
	<input type="hidden" id="user_lido" value="<?php echo $user_nome?>">
	<script>
		function notific(val){
			var id_notif = val;
			var user_lido =  document.getElementById('user_lido').value;
			//console.log(val);
			 $('#avisos_notif1').load('include/marcar_nofitic_lido.php?id_notif='+id_notif+'&user_lido='+user_lido);
		}
	</script>					


<script>
	var empresa = <?php echo $id_empresa?>;
  var intervalo1 = setInterval(function() { $('#avisos_notif').load('include/notific_sistema.php?id_empresa='+empresa); }, 1500);
 
</script>
<script>
	
  setInterval( ()=> {
	 $.get('include/notific_sistema1.php?id_empresa='+empresa, function(data2){
		if(data2 >= 1){
			$("#cont_notif").html(data2);
			$("#cont_notif").show();
		}
		if(data2 <= 0){
			$("#cont_notif").html('');
			$("#cont_notif").hide();
		}
	  });
	
	
}, 1500);
</script>















