<?php



$cons_usuario = mysqli_query($conn,"SELECT * FROM usuarios WHERE id_usuarios='$user_id'");
	if(mysqli_num_rows($cons_usuario) > 0){
while ($resp_usuario = mysqli_fetch_assoc($cons_usuario)) {
$nome_usuario = 	$resp_usuario['nome_usuario'];
	}}
?>
<?php

$cons_empresa = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE login_padrao='$login_padrao'");
	if(mysqli_num_rows($cons_empresa) > 0){
while ($resp_empresa = mysqli_fetch_assoc($cons_empresa)) {
$id_empresa = 	$resp_empresa['id_empresa'];
$nome_fantasia = 	$resp_empresa['nome_fantasia'];
$banrisul = $resp_empresa['banrisul'];
	}}
	
if($banrisul == 'SIM'){
	$retorno_vero = '<li>
						<a href="arquivos_retorno_vero.php" title="Retorno Vero" data-filter-tags="retorno_vero">
						   <i class="fal fa-file"></i><span class="nav-link-text" data-i18n="nav.retorno_vero">Retorno Vero</span>
						</a>
					</li>';
}
?>
<link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/fa-brands.css">
<!-- BEGIN PRIMARY NAVIGATION -->
                    <nav id="js-primary-nav" class="primary-nav" style="background-color:#14145A" role="navigation">
                        <div class="nav-filter">
                            <div class="position-relative">
                                <input type="text" id="nav_filter_input" placeholder="Buscar Menu" class="form-control" tabindex="0">
                                <a href="#" onclick="return false;" class="btn-primary btn-search-close js-waves-off" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar">
                                    <i class="fal fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                       
                        <ul id="js-nav-menu" class="nav-menu" style="background-color:#14145A">
                            <li class="nav-title" style="color:#fff">Menu Administrativo</li>
							<li>
                                <a href="#" title="DASHBOARD" data-filter-tags="dashboard">
									<i class="fal fa-desktop"></i>
                                    <span class="nav-link-text" data-i18n="nav.dashboard">DASHBOARD</span>
                                </a>
                                <ul>
                                    <li>
                                        <a href="index.php" title="Analitico" data-filter-tags="analitico">
                                         <i class="fal fa-chart-line"></i><span class="nav-link-text" data-i18n="nav.analitico">Analítico</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="dashboard_financeiro.php" title="financeiro" data-filter-tags="financeiro">
                                             <i class="fal fa-chart-pie"></i><span class="nav-link-text" data-i18n="nav.financeiro">Financeiro</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="dashboard_devices.php" title="financeiro" data-filter-tags="devices">
                                             <i class="fal fa-mobile"></i><span class="nav-link-text" data-i18n="nav.devices">Dispositivos</span>
                                        </a>
                                    </li>
                                </ul>
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
                                    <li>
                                        <a href="assistencia.php" title="assistencia" data-filter-tags="assistencia">
                                            <i class="fal fa-wrench"></i><span class="nav-link-text" data-i18n="nav.assistencia">Assistência 24h</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="vendedores.php" title="vendedores" data-filter-tags="vendedores">
                                            <i class="fal fa-user"></i><span class="nav-link-text" data-i18n="nav.vendedores">Vendedores</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="instaladores.php" title="instaladores" data-filter-tags="instaladores">
                                            <i class="fal fa-user-circle"></i><span class="nav-link-text" data-i18n="nav.instaladores">Instaladores</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="usuarios.php" title="pedidos" data-filter-tags="usuarios">
                                            <i class="fal fa-users"></i><span class="nav-link-text" data-i18n="nav.usuarios">Usuários</span>
                                        </a>
                                    </li>
									 <li>
                                        <a href="pedidos.php" title="pedidos" data-filter-tags="usuarios">
                                            <i class="fal fa-file"></i><span class="nav-link-text" data-i18n="nav.usuarios">Pedidos Site</span>
                                        </a>
                                    </li>
                                 </ul>
                            </li>
							<li>
								<a href="estoque_equipamentos.php" title="Estoque" data-filter-tags="contas a receber">
									<i class="fal fa-boxes"></i><span class="nav-link-text" data-i18n="nav.estoque">ESTOQUE</span>
								</a>
							</li>
                            <li>
                                <a href="#" title="Financeiro" data-filter-tags="financeiro">
                                    <i class="fal fa-usd-circle"></i>
                                    <span class="nav-link-text" data-i18n="nav.financeiro">FINANCEIRO</span>
                                </a>
                                <ul>
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
                                </ul>
                            </li>
							
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
                            </li>
                           
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
                                    <li>
                                        <a href="ordens_servico.php?p=os" title="Envio SMS" data-filter-tags="ordens de serviço">
                                            <i class="fal fa-wrench"></i><span class="nav-link-text" data-i18n="nav.ordens_servico">Relatório Instalações</span>
                                        </a>
                                    </li>
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
                                    <li>
                                        <a href="manutencoes.php" title="Manutenções" data-filter-tags="manutencoes">
                                            <i class="fal fa-wrench"></i><span class="nav-link-text" data-i18n="nav.manutencoes">Manutenções</span>
                                        </a>
                                    </li>
  
                                </ul>
                            </li>
							<li class="nav-title" style="color:#fff">Menu Sinistros</li>
							
                        </ul>

                    </nav>
					

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
					
					
