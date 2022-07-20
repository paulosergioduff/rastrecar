<?php



$cons_usuario = mysqli_query($conn,"SELECT * FROM usuarios WHERE id_usuarios='$user_id'");
	if(mysqli_num_rows($cons_usuario) > 0){
while ($resp_usuario = mysqli_fetch_assoc($cons_usuario)) {
$nome_usuario = 	$resp_usuario['nome_usuario'];
$acesso = 	$resp_usuario['acesso'];
$id_empresa = 	$resp_usuario['id_empresa'];
$id_cliente50 = 	$resp_usuario['id_cliente'];
$cad_equip = 	$resp_usuario['cad_equip'];
$cad_operadores = 	$resp_usuario['cad_operadores'];
$cad_instaladores = 	$resp_usuario['cad_instaladores'];
	}}
	

if($cad_equip != 'SIM'){
	$cad_equip1 = '<!--';
	$cad_equip2 = '-->';
}
if($cad_operadores != 'SIM'){
	$cad_operadores1 = '<!--';
	$cad_operadores2 = '-->';
}
if($cad_instaladores != 'SIM'){
	$cad_instaladores1 = '<!--';
	$cad_instaladores2 = '-->';
}	

?>
<?php

$cons_empresa = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE login_padrao='$login_padrao'");
	if(mysqli_num_rows($cons_empresa) > 0){
while ($resp_empresa = mysqli_fetch_assoc($cons_empresa)) {
$nome_fantasia = 	$resp_empresa['nome_fantasia'];
$banrisul = $resp_empresa['banrisul'];
	}}
	
	
$cons_cli_cor = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente50'");
	if(mysqli_num_rows($cons_cli_cor) > 0){
while ($resp_cor = mysqli_fetch_assoc($cons_cli_cor)) {
$cor_sistema = 	$resp_cor['cor_sistema'];
$logo = 	$resp_cor['logo'];

	}}
	
$base64 = 'id_empresa:'.$id_empresa;
$base64 = base64_encode($base64);
?>
<link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/fa-brands.css">
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
                                <a href="index.php" title="DASHBOARD" data-filter-tags="dashboard">
									<i class="fal fa-desktop"></i>
                                    <span class="nav-link-text" data-i18n="nav.dashboard">DASHBOARD</span>
                                </a>
                               
                            </li>
							
                            <li>
                                <a href="#" title="cadastros" data-filter-tags="cadastros">
                                    <i class="fal fa-edit"></i>
                                    <span class="nav-link-text" data-i18n="nav.cadastros">CADASTROS</span>
                                </a>
                                <ul>
								
                                    <li>
                                        <a href="clientes.php" data-filter-tags="clientes">
										 
                                           <i class="fal fa-users"></i><span class="nav-link-text">Clientes</span>
                                        </a>
                                    </li>
								
                                    <li>
                                        <a href="veiculos.php" title="veiculos" data-filter-tags="veiculos">
                                            <i class="fal fa-car"></i><span class="nav-link-text" data-i18n="nav.veiculos">Veículos</span>
                                        </a>
                                    </li>
									<?php echo $cad_instaladores1?>
									<li>
                                        <a href="instaladores.php" title="veiculos" data-filter-tags="veiculos">
                                            <i class="fal fa-user-circle"></i><span class="nav-link-text" data-i18n="nav.veiculos">Instaladores</span>
                                        </a>
                                    </li>
									<?php echo $cad_instaladores2?>
									<?php echo $cad_operadores1?>
									<li>
                                        <a href="usuarios.php" title="veiculos" data-filter-tags="veiculos">
                                            <i class="fal fa-users"></i><span class="nav-link-text" data-i18n="nav.veiculos">Usuários</span>
                                        </a>
                                    </li>
									<?php echo $cad_operadores2?>
                                 </ul>
                            </li>
						
							<li>
                                <a href="ordens_servico.php" title="Comunicação" data-filter-tags="servicos">
                                   <i class="fal fa-wrench"></i>
                                    <span class="nav-link-text" data-i18n="nav.servicos">ORDENS SERVIÇO</span>
                                </a>
                               
                            </li>
                           
                            <li>
                                <a href="grid.php?p=grid" title="Mapa Veiculos" data-filter-tags="mapa veiculos">
                                   <i class="fal fa-map-marker-alt"></i>
                                    <span class="nav-link-text" data-i18n="nav.mapa_veiculos">MAPA VEÍCULOS</span>
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
					

			