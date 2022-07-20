<?php



$cons_usuario = mysqli_query($conn,"SELECT * FROM usuarios WHERE id_usuarios='$user_id'");
	if(mysqli_num_rows($cons_usuario) > 0){
while ($resp_usuario = mysqli_fetch_assoc($cons_usuario)) {
$nome_usuario = 	$resp_usuario['nome_usuario'];
$id_cliente50 = 	$resp_usuario['id_cliente'];
	}}

$cons_cli11 = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente50'");
	if(mysqli_num_rows($cons_cli11) > 0){
while ($resp_cor301 = mysqli_fetch_assoc($cons_cli11)) {
$id_cliente_pai_1 = 	$resp_cor301['id_cliente_pai'];

	}}
	
$cons_cli_cor1 = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente_pai_1'");
	if(mysqli_num_rows($cons_cli_cor1) > 0){
while ($resp_cor1 = mysqli_fetch_assoc($cons_cli_cor1)) {
$cor_sistema1 = 	$resp_cor1['cor_sistema'];


	}}
	
if($id_cliente_pai_1 == 1361){
	$cor_sistema = '#3A5975';
}

if($id_cliente_pai_1 != 1361){
	$cor_sistema = $cor_sistema1;
}
?>
<?php

$cons_empresa = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE login_padrao='$login_padrao'");
	if(mysqli_num_rows($cons_empresa) > 0){
while ($resp_empresa = mysqli_fetch_assoc($cons_empresa)) {
$id_empresa = 	$resp_empresa['id_empresa'];
$nome_fantasia = 	$resp_empresa['nome_fantasia'];
$banrisul = $resp_empresa['banrisul'];
	}}
	
	


?>
<!-- BEGIN PRIMARY NAVIGATION -->
                    <nav id="js-primary-nav" class="primary-nav" style="background-color:<?php echo $cor_sistema?>" role="navigation">
                        <div class="nav-filter">
                            <div class="position-relative">
                                <input type="text" id="nav_filter_input" placeholder="Buscar Menu" class="form-control" tabindex="0">
                                <a href="#" onclick="return false;" class="btn-primary btn-search-close js-waves-off" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar">
                                    <i class="fal fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                       
                         <ul id="js-nav-menu" class="nav-menu" style="background-color:<?php echo $cor_sistema?>">
                            <li class="nav-title" style="color:#fff">Menu Administrativo</li>
							<li>
                                <a href="index.php" title="Mapa Veiculos" data-filter-tags="mapa veiculos">
                                   <i class="fal fa-map-marker-alt"></i>
                                    <span class="nav-link-text" data-i18n="nav.mapa_veiculos">MAPA VEÍCULOS</span>
                                </a>
							</li>
                            <li>
                                <a href="faturas.php?p=grid" title="Faturas" data-filter-tags="mapa veiculos">
                                   <i class="fal fa-dollar-sign"></i>
                                    <span class="nav-link-text" data-i18n="nav.mapa_veiculos">MINHAS FATURAS</span>
                                </a>
							</li>
                           
                            <li>
                                <a href="#" title="relatorios" data-filter-tags="relatorios">
                                    <i class="fal fa-file-alt"></i>
                                    <span class="nav-link-text" data-i18n="nav.relatorios">RELATÓRIOS</span>
                                </a>
                                <ul>
                                    <li>
                                        <a href="relatorio_percurso.php" title="Relatorio Percurso" data-filter-tags="relatorio percurso">
                                            <i class="fal fa-code-branch"></i><span class="nav-link-text" data-i18n="nav.relatorio_percurso">Percurso</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="relatorio_alertas.php" title="Relatorio Alertas" data-filter-tags="relatorio alertas">
                                            <i class="fal fa-bell"></i><span class="nav-link-text" data-i18n="nav.relatorio_alertas">Alertas</span>
                                        </a>
                                    </li>
									<li>
                                        <a href="relatorio_viagens.php" title="Relatorio Viagens" data-filter-tags="relatorio viagens">
                                            <i class="fal fa-road"></i><span class="nav-link-text" data-i18n="nav.relatorio_viagens">Viagens</span>
                                        </a>
                                    </li>
									<li>
                                        <a href="relatorio_comandos.php" title="Relatorio Comandos" data-filter-tags="relatorio alertas">
                                            <i class="fal fa-external-link-alt"></i><span class="nav-link-text" data-i18n="nav.relatorio_comandos">Comandos</span>
                                        </a>
                                    </li>
									<li>
                                        <a href="relatorio_cerca.php" title="Relatorio Cercas" data-filter-tags="relatorio cercas">
                                            <i class="fal fa-object-ungroup"></i><span class="nav-link-text" data-i18n="nav.relatorio_cerca">Movimento Cercas</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
							<li>
                                <a href="#" title="modulos" data-filter-tags="modulos">
                                   <i class="fal fa-server"></i>
                                    <span class="nav-link-text" data-i18n="nav.modulos">MÓDULOS</span>
                                </a>
                                <ul>
                                    <li>
                                        <a href="cerca_virtual.php" title="Cerca Virtual" data-filter-tags="cerca virtual">
                                            <i class="fal fa-object-ungroup"></i><span class="nav-link-text" data-i18n="nav.cerca_virtual">Cerca Virtual</span>
                                        </a>
                                    </li>
                                   
                                </ul>
                            </li>
							
                        </ul>

                    </nav>
					

					
					
					
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
	<!-- Styles -->
	<style type="text/css">
		#success{background: green;}
		#error{background: red;}
		#warning{background: coral;}
		#info{background: cornflowerblue;}
		#question{background: grey;}
	</style>
	<script>
	toastr.options = {
		'closeButton': true,
		'debug': false,
		'newestOnTop': false,
		'progressBar': true,
		'positionClass': 'toast-top-right',
		'preventDuplicates': false,
		'showDuration': '1000',
		'hideDuration': '1000',
		'timeOut': '5000',
		'extendedTimeOut': '1000',
		'showEasing': 'swing',
		'hideEasing': 'linear',
		'showMethod': 'fadeIn',
		'hideMethod': 'fadeOut',
	}

	</script>

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-119386393-1');
	</script>