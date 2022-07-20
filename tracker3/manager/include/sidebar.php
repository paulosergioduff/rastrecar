<?php



$cons_usuario = mysqli_query($conn,"SELECT * FROM usuarios WHERE id_usuarios='$user_id'");
	if(mysqli_num_rows($cons_usuario) > 0){
while ($resp_usuario = mysqli_fetch_assoc($cons_usuario)) {
$nome_usuario = 	$resp_usuario['nome_usuario'];
$acesso = 	$resp_usuario['acesso'];
$id_empresa = 	$resp_usuario['id_empresa'];
$id_cliente50 = 	$resp_usuario['id_cliente'];
	}}
	
$cons_usuario_permi = mysqli_query($conn,"SELECT * FROM usuarios_permissoes WHERE id_usuarios='$user_id'");
	if(mysqli_num_rows($cons_usuario_permi) > 0){
while ($resp_perm = mysqli_fetch_assoc($cons_usuario_permi)) {
$dash_analitico = 	$resp_perm['dash_analitico'];
$dash_financeiro = 	$resp_perm['dash_financeiro'];
$dash_dispositivos = 	$resp_perm['dash_dispositivos'];
$cad_clientes = 	$resp_perm['cad_clientes'];
$cad_veiculos = 	$resp_perm['cad_veiculos'];
$cad_vendedores = 	$resp_perm['cad_vendedores'];
$cad_instaladores = 	$resp_perm['cad_instaladores'];
$cad_usuarios = 	$resp_perm['cad_usuarios'];
$contas_pagar = 	$resp_perm['contas_pagar'];
$contas_receber = 	$resp_perm['contas_receber'];
$rel_percurso = 	$resp_perm['rel_percurso'];
$rel_alertas = 	$resp_perm['rel_alertas'];
$rel_viagens = 	$resp_perm['rel_viagens'];
$rel_comandos = 	$resp_perm['rel_comandos'];
$rel_cercas = 	$resp_perm['rel_cercas'];

	}}
	
	
if($dash_analitico != 'SIM'){
	$dash_analitico1 = '<!--';
	$dash_analitico2 = '-->';
}

if($dash_financeiro != 'SIM'){
	$dash_financeiro1 = '<!--';
	$dash_financeiro2 = '-->';
}

if($dash_dispositivos != 'SIM'){
	$dash_dispositivos1 = '<!--';
	$dash_dispositivos2 = '-->';
}

if($cad_clientes != 'SIM'){
	$cad_clientes1 = '<!--';
	$cad_clientes2 = '-->';
}

if($cad_veiculos != 'SIM'){
	$cad_veiculos1 = '<!--';
	$cad_veiculos2 = '-->';
}
if($cad_vendedores != 'SIM'){
	$cad_vendedores1 = '<!--';
	$cad_vendedores2 = '-->';
}

if($cad_instaladores != 'SIM'){
	$cad_instaladores1 = '<!--';
	$cad_instaladores2 = '-->';
}

if($cad_usuarios != 'SIM'){
	$cad_usuarios1 = '<!--';
	$cad_usuarios2 = '-->';
}

if($contas_pagar != 'SIM'){
	$contas_pagar1 = '<!--';
	$contas_pagar2 = '-->';
}

if($contas_receber != 'SIM'){
	$contas_receber1 = '<!--';
	$contas_receber2 = '-->';
}

if($rel_percurso != 'SIM'){
	$rel_percurso1 = '<!--';
	$rel_percurso2 = '-->';
}

if($rel_alertas != 'SIM'){
	$rel_alertas1 = '<!--';
	$rel_alertas2 = '-->';
}

if($rel_viagens != 'SIM'){
	$rel_viagens1 = '<!--';
	$rel_viagens2 = '-->';
}

if($rel_comandos != 'SIM'){
	$rel_comandos1 = '<!--';
	$rel_comandos2 = '-->';
}

if($rel_cercas != 'SIM'){
	$rel_cercas1 = '<!--';
	$rel_cercas2 = '-->';
}
?>
<?php

$cons_empresa22 = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='1361'");
	if(mysqli_num_rows($cons_empresa22) > 0){
while ($resp_empresa22 = mysqli_fetch_assoc($cons_empresa22)) {
$cor_sistema22 = 	$resp_empresa22['cor_sistema'];
	}}
	

	
$base64 = 'id_empresa:'.$id_empresa;
$base64 = base64_encode($base64);
?>
<link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/fa-brands.css">
<!-- BEGIN PRIMARY NAVIGATION -->
                    <nav id="js-primary-nav" class="primary-nav" style="background-color:<?php echo $cor_sistema22?>" role="navigation">
                        <div class="nav-filter">
                            <div class="position-relative">
                                <input type="text" id="nav_filter_input" placeholder="Buscar Menu" class="form-control" tabindex="0">
                                <a href="#" onclick="return false;" class="btn-primary btn-search-close js-waves-off" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar">
                                    <i class="fal fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                       
                        <ul id="js-nav-menu" class="nav-menu" style="background-color:<?php echo $cor_sistema22?>">
                            <li class="nav-title" style="color:#fff">Menu Administrativo</li>
							
						
							
							<li>
                                <a href="#" title="DASHBOARD" data-filter-tags="dashboard">
									<i class="fal fa-desktop"></i>
                                    <span class="nav-link-text" data-i18n="nav.dashboard">DASHBOARD</span>
                                </a>
                                <ul>
								<?php echo $dash_analitico1?>
                                    <li>
                                        <a href="index.php" title="Analitico" data-filter-tags="analitico">
                                         <i class="fal fa-chart-line"></i><span class="nav-link-text" data-i18n="nav.analitico">Analítico</span>
                                        </a>
                                    </li>
								<?php echo $dash_analitico2?>
								<?php echo $dash_financeiro1?>
                                   <li>
										<a href="dashboard_financeiro.php" title="financeiro" data-filter-tags="financeiro">
											 <i class="fal fa-chart-pie"></i><span class="nav-link-text" data-i18n="nav.financeiro">Financeiro</span>
										</a>
									</li>
								<?php echo $dash_financeiro2?>
								<?php echo $dash_dispositivos1?>
                                    <li>
                                        <a href="dashboard_devices.php" title="financeiro" data-filter-tags="devices">
                                             <i class="fal fa-mobile"></i><span class="nav-link-text" data-i18n="nav.devices">Dispositivos</span>
                                        </a>
                                    </li>
								<?php echo $dash_dispositivos2?>
                                </ul>
                            </li>
                            <li>
                                <a href="#" title="cadastros" data-filter-tags="cadastros">
                                    <i class="fal fa-edit"></i>
                                    <span class="nav-link-text" data-i18n="nav.cadastros">CADASTROS</span>
                                </a>
                                <ul>
								<?php echo $cad_clientes1?>
                                    <li>
                                        <a href="clientes.php" data-filter-tags="clientes">
										 
                                           <i class="fal fa-users"></i><span class="nav-link-text">Clientes</span>
                                        </a>
                                    </li>
								<?php echo $cad_clientes2?>
								<?php echo $cad_veiculos1?>
                                    <li>
                                        <a href="veiculos.php" title="veiculos" data-filter-tags="veiculos">
                                            <i class="fal fa-car"></i><span class="nav-link-text" data-i18n="nav.veiculos">Veículos</span>
                                        </a>
                                    </li>
                                 <?php echo $cad_veiculos2?>
                                 <?php echo $cad_vendedores1?>
                                    <li>
                                        <a href="vendedores.php" title="vendedores" data-filter-tags="vendedores">
                                            <i class="fal fa-user"></i><span class="nav-link-text" data-i18n="nav.vendedores">Vendedores</span>
                                        </a>
                                    </li>
								<?php echo $cad_vendedores2?>
								<?php echo $cad_instaladores1?>
                                    <li>
                                        <a href="instaladores.php" title="instaladores" data-filter-tags="instaladores">
                                            <i class="fal fa-user-circle"></i><span class="nav-link-text" data-i18n="nav.instaladores">Instaladores</span>
                                        </a>
                                    </li>
								<?php echo $cad_instaladores2?>
								<?php echo $cad_usuarios1?>
                                    <li>
                                        <a href="usuarios.php" title="pedidos" data-filter-tags="usuarios">
                                            <i class="fal fa-users"></i><span class="nav-link-text" data-i18n="nav.usuarios">Usuários</span>
                                        </a>
                                    </li>
									<li>
                                        <a href="pacotes.php" title="pedidos" data-filter-tags="usuarios">
                                            <i class="fal fa-dolly-flatbed"></i><span class="nav-link-text" data-i18n="nav.usuarios">Planos/Pacotes</span>
                                        </a>
                                    </li>
								<?php echo $cad_usuarios2?>
									  <!--
									 <li>
                                        <a href="pedidos.php" title="pedidos" data-filter-tags="usuarios">
                                            <i class="fal fa-file"></i><span class="nav-link-text" data-i18n="nav.usuarios">Pedidos Site</span>
                                        </a>
                                    </li>
									-->
                                 </ul>
                            </li>
							<!--
							<li>
								<a href="equipamentos.php" title="Estoque" data-filter-tags="contas a receber">
									<i class="fal fa-boxes"></i><span class="nav-link-text" data-i18n="nav.estoque">ESTOQUE</span>
								</a>
							</li>
							-->
                            <li>
                                <a href="#" title="Financeiro" data-filter-tags="financeiro">
                                    <i class="fal fa-usd-circle"></i>
                                    <span class="nav-link-text" data-i18n="nav.financeiro">FINANCEIRO</span>
                                </a>
                                <ul>
								<?php echo $contas_pagar1?>
                                    <li>
                                        <a href="javascript:void(0);" title="Contas a Pagar" data-filter-tags="contas a pagar">
                                            <i class="fal fa-sort-numeric-up"></i><span class="nav-link-text" data-i18n="nav.contas_a_pagar">Contas a Pagar</span>
                                        </a>
                                        <ul>
                                            <li>
                                                <a href="nova_conta_pagar.php" title="Nova Conta a Pagar" data-filter-tags="nova conta pagar">
                                                    <i class="fal fa-plus-circle"></i><span class="nav-link-text" data-i18n="nav.nova_conta">Nova Conta</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="contas_pagar.php" title="Listar Contas a Pagar" data-filter-tags="listar contas a pagar">
                                                    <i class="fal fa-sort-amount-up"></i><span class="nav-link-text" data-i18n="nav.listar_contas">Listar Contas</span>
                                                </a>
                                            </li>
											<li>
                                                <a href="contas_pagar_vencidas.php" title="Contas Vencidas" data-filter-tags="contas a pagar vencidas">
                                                   <i class="fal fa-calendar-times"></i><span class="nav-link-text" data-i18n="nav.contas_vencidas">Vencidas</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
								<?php echo $contas_pagar2?>
								<?php echo $contas_receber1?>
									<li>
                                        <a href="javascript:void(0);" title="Contas a Receber" data-filter-tags="contas a receber">
                                            <i class="fal fa-sort-numeric-down"></i><span class="nav-link-text" data-i18n="nav.contas_receber">Contas a Receber</span>
                                        </a>
                                        <ul>
                                            
                                            <li>
                                                <a href="contas_receber.php" title="Listar Contas" data-filter-tags="listar contas a receber">
                                                    <i class="fal fa-sort-amount-up"></i><span class="nav-link-text" data-i18n="nav.contas_receber">Listar Contas</span>
                                                </a>
                                            </li>
											<li>
                                                <a href="contas_receber_vencidas.php" title="Contas Vencidas" data-filter-tags="contas a receber vencidas">
                                                   <i class="fal fa-calendar-times"></i><span class="nav-link-text" data-i18n="nav.contas_receber_vencidas">Vencidas</span>
                                                </a>
                                            </li>
											<li>
                                                <a href="recorrencias.php" title="recorrencias" data-filter-tags="recorrencias">
                                                   <i class="fal fa-arrows-alt"></i><span class="nav-link-text" data-i18n="nav.recorrencias">Recorrências</span>
                                                </a>
                                            </li>
											
                                        </ul>
                                    </li>
								<?php echo $contas_receber2?>
									<!--
                                    <li>
                                        <a href="javascript:void(0);" title="Contas a Receber" data-filter-tags="contas a receber">
                                            <i class="fal fa-file"></i><span class="nav-link-text" data-i18n="nav.contas_receber">Relatórios</span>
                                        </a>
                                        <ul>
                                            
                                            <li>
                                                <a href="relatorio_vendas.php" title="Listar Contas" data-filter-tags="listar contas a receber">
                                                    <i class="fal fa-file-alt"></i><span class="nav-link-text" data-i18n="nav.contas_receber">Vendas/Vendedores</span>
                                                </a>
                                            </li>
											<li>
                                                <a href="relatorio_instalacoes.php" title="Contas Vencidas" data-filter-tags="contas a receber vencidas">
                                                   <i class="fal fa-calendar-times"></i><span class="nav-link-text" data-i18n="nav.contas_receber_vencidas">Instalações</span>
                                                </a>
                                            </li>
											
                                        </ul>
                                    </li>
									-->
                                </ul>
                            </li>
							 <!--
							<li>
                                <a href="#" title="comunicacao" data-filter-tags="comunicacao">
                                   <i class="fal fa-comments"></i>
                                    <span class="nav-link-text" data-i18n="nav.comunicacao">COMUNICAÇÃO</span>
                                </a>
                                <ul>
                                    <li>
                                        <a href="javascript:void(0);" title="Contas a Pagar" data-filter-tags="contas a pagar">
                                            <i class="fal fa-sort-numeric-up"></i><span class="nav-link-text" data-i18n="nav.contas_a_pagar">Push App</span>
                                        </a>
                                        <ul>
                                            <li>
                                                <a href="envio_push.php" title="Envio Push" data-filter-tags="envio push">
                                                    <i class="fal fa-location-arrow"></i><span class="nav-link-text" data-i18n="nav.push">Enviar Push</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="push_enviado.php" title="Push Enviado" data-filter-tags="Push Enviado">
                                                    <i class="fal fa-sort-amount-up"></i><span class="nav-link-text" data-i18n="nav.push_enviado">Push Enviados</span>
                                                </a>
                                            </li>
											
                                        </ul>
                                    </li>
									<li>
                                        <a href="whatsapp.php" title="whatsapp" data-filter-tags="whatsapp">
                                            <i class="fab fa-whatsapp"></i><span class="nav-link-text" data-i18n="nav.whatsapp">Whatsapp</span>
                                        </a>
                                        
                                    </li>
                                    
                                </ul>
                            </li>-->
                           
							<li>
                                <a href="#" title="Comunicação" data-filter-tags="servicos">
                                   <i class="fal fa-clipboard"></i>
                                    <span class="nav-link-text" data-i18n="nav.servicos">SERVIÇOS</span>
                                </a>
                                <ul>
                                    <li>
                                        <a href="ordens_servico.php?p=os" title="Envio SMS" data-filter-tags="ordens de serviço">
                                            <i class="fal fa-wrench"></i><span class="nav-link-text" data-i18n="nav.ordens_servico">Ordens de Serviço</span>
                                        </a>
                                    </li>
                                    <!--<li>
                                        <a href="ordens_servico.php?p=os" title="Envio SMS" data-filter-tags="ordens de serviço">
                                            <i class="fal fa-wrench"></i><span class="nav-link-text" data-i18n="nav.ordens_servico">Relatório Instalações</span>
                                        </a>
                                    </li>-->
                                </ul>
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
								<?php echo $rel_percurso1?>
                                    <li>
                                        <a href="relatorio_percurso.php" title="Relatorio Percurso" data-filter-tags="relatorio percurso">
                                            <i class="fal fa-code-branch"></i><span class="nav-link-text" data-i18n="nav.relatorio_percurso">Percurso</span>
                                        </a>
                                    </li>
								<?php echo $rel_percurso2?>
								<?php echo $rel_alertas1?>
                                    <li>
                                        <a href="relatorio_alertas.php" title="Relatorio Alertas" data-filter-tags="relatorio alertas">
                                            <i class="fal fa-bell"></i><span class="nav-link-text" data-i18n="nav.relatorio_alertas">Alertas</span>
                                        </a>
                                    </li>
								<?php echo $rel_alertas2?>
								<?php echo $rel_viagens1?>
									<li>
                                        <a href="relatorio_viagens.php" title="Relatorio Viagens" data-filter-tags="relatorio viagens">
                                            <i class="fal fa-road"></i><span class="nav-link-text" data-i18n="nav.relatorio_viagens">Viagens</span>
                                        </a>
                                    </li>
								<?php echo $rel_viagens2?>
								<?php echo $rel_comandos1?>
									<li>
                                        <a href="relatorio_comandos.php" title="Relatorio Comandos" data-filter-tags="relatorio alertas">
                                            <i class="fal fa-external-link-alt"></i><span class="nav-link-text" data-i18n="nav.relatorio_comandos">Comandos</span>
                                        </a>
                                    </li>
								<?php echo $rel_comandos2?>
								<?php echo $rel_cercas1?>
									<li>
                                        <a href="relatorio_cerca.php" title="Relatorio Cercas" data-filter-tags="relatorio cercas">
                                            <i class="fal fa-object-ungroup"></i><span class="nav-link-text" data-i18n="nav.relatorio_cerca">Movimento Cercas</span>
                                        </a>
                                    </li>
								<?php echo $rel_cercas2?>
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
					

			