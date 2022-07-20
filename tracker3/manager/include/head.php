<?php
$url2 = $_SERVER['REQUEST_URI'];
$url2 = str_replace('tracker3', 'tracker2', $url2);


$cons_empresa = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='1361'");
if(mysqli_num_rows($cons_empresa) > 0){
while ($resp_empresa = mysqli_fetch_assoc($cons_empresa)) {

$texto_rodape = $resp_empresa['texto_rodape'];
$texto_topo = $resp_empresa['texto_topo'];
}}
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
   <span><?php echo $texto_topo?></span>
	<div class="ml-auto d-flex">
		
	   
	   <!-- app notification -->
	 
	   
	
	
	   
	   
	   
	   
	   
		
		
		
		
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
				<a href="cad_sistema.php" class="dropdown-item">
					<i class="fal fa-cogs"></i> <span>Conf. Sistema</span>
					<i class="float-right text-muted fw-n">F11</i>
				</a>
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



			
	
					
















