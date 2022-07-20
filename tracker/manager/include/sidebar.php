


 <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <img alt="image" src="/tracker/Imagens/logo1.png" style="width:50%; height:auto;"/>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="block m-t-xs font-bold"><?php echo $user_id?> - <?php echo $user_nome?></span>
                                <span class="text-muted text-xs block">Gerente <b class="caret"></b></span>
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a class="dropdown-item" href="profile.html">Profile</a></li>
                                <li><a class="dropdown-item" href="contacts.html">Contacts</a></li>
                                <li><a class="dropdown-item" href="mailbox.html">Mailbox</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="login.html">Logout</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            MD
                        </div>
                    </li>
                    <li>
                        <a href="index.php"><i class="fa fa-th-large"></i> <span class="nav-label">DASHBOARD</span></a>
                       
                    </li>
                    <li>
                        <a href="#"><i class="fas fa-pen-square"></i> <span class="nav-label">CADASTROS</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="clientes.php"><i class="fas fa-users"></i> Clientes</a></li>
                            <li><a href="contratos.php"><i class="far fa-file-alt"></i> Contratos</a></li>
                            <li><a href="veiculos.php"><i class="fas fa-car"></i> Veículos</a></li>
							<li><a href="assistencia.php"><i class="fas fa-car-crash"></i> Assistência 24h</a></li>
                            <li><a href="fornecedores.php"><i class="fas fa-house-user"></i> Fornecedores</a></li>
                            <li><a href="instaladores.php"><i class="fas fa-user-shield"></i> Instaladores</a></li>
                            <li><a href="pedidos.php"><i class="fas fa-file-export"></i> Pedidos Novos</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fas fa-funnel-dollar"></i> <span class="nav-label">FINANCEIRO </span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            
                            <li><a href="dashboard_contas.php"><i class="fas fa-chart-line"></i> Dashboard</a></li>
							
							<li><a href="gerar_faturamento.php"><i class="fas fa-file-invoice-dollar"></i> Gerar Faturamento</a></li>
                            
							<li>
                                <a href="#" id="damian"><i class="fas fa-sort-numeric-up-alt"></i> Contas a Pagar <span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="nova_conta_pagar.php"><i class="fas fa-angle-right"></i> Nova Conta</a>
                                    </li>
                                    <li>
                                        <a href="contas_pagar.php"><i class="fas fa-angle-right"></i> Listar Contas</a>
                                    </li>
                                    <li>
                                        <a href="contas_pagar_vencidas.php"><i class="fas fa-angle-right"></i> Vencidas</a>
                                    </li>
									<li>
                                        <a href="contas_pagar_hoje.php"><i class="fas fa-angle-right"></i> Vencendo Hoje</a>
                                    </li>
                                </ul>
                            </li>
							<li>
                                <a href="#" id="damian"><i class="fas fa-sort-numeric-down"></i> Contas a Receber <span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="nova_conta_receber.php">Nova Conta</a>
                                    </li>
                                    <li>
                                        <a href="contas_receber.php"> Listar Contas</a>
                                    </li>
                                     <li>
                                        <a href="contas_receber_vencidas.php"> Vencidas <span class="label label-danger float-right"> <?php echo $conta_contas_receber_v1?></span></a>
                                    </li>
									<li>
                                        <a href="contas_receber_hoje.php"> Vencendo Hoje</a>
                                    </li>

                                </ul>
                            </li>
							<li>
                                <a href="#" id="damian"><i class="fas fa-file-alt"></i> Relatórios <span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="inadimp.php"><i class="fas fa-angle-right"></i> Inadimplência</a>
                                    </li>
                                    
                                     
                                </ul>
                            </li>
                        </ul>
                    </li>
					 <li>
                        <a href="#"><i class="fas fa-copy"></i> <span class="nav-label">REMESSA ELETRÔNICA </span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li>
                                <a href="#" id="damian"><i class="fas fa-file-export"></i> Arquivo Remessa <span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="gerar_remessa.php"><i class="fas fa-angle-right"></i> Gerar Remessa</a>
                                    </li>
                                    <li>
                                        <a href="arquivos_remessa.php"><i class="fas fa-angle-right"></i> Arquivos</a>
                                    </li>
                                    
                                </ul>
                            </li>
                           <li>
                                <a href="#" id="damian"><i class="fas fa-file-import"></i> Arquivo Retorno <span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="arquivos_retorno.php"><i class="fas fa-angle-right"></i> Retorno Itaú</a>
                                    </li>
                                    <li>
                                        <a href="arquivos_retorno_vero.php"><i class="fas fa-angle-right"></i> Retorno VERO</a>
                                    </li>
                                    
                                </ul>
                            </li>
                        </ul>
                    </li>
					<li>
                        <a href="#"><i class="fas fa-file-invoice-dollar"></i> <span class="nav-label">NOTAS FISCAIS</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="nfse_servicos.php"><i class="fas fa-file-invoice"></i> NFS-e Serviços</a></li>
                            <li><a href="nfe_vendas.php"><i class="fas fa-file-invoice"></i> NF-e Vendas</a></li>
                        </ul>
                    </li>
					<li>
                        <a href="#"><i class="fas fa-mail-bulk"></i> <span class="nav-label">COMUNICAÇÃO</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="sms.php"><i class="fas fa-sms"></i> Envio SMS</a></li>
                            <li><a href="push_app.php"><i class="fas fa-paper-plane"></i> Envio Push App</a></li>
							 <li><a href="push_enviados.php"><i class="fas fa-paper-plane"></i> Push Enviados</a></li>
                        </ul>
                    </li>
					<li>
                        <a href="#"><i class="fas fa-user-cog"></i> <span class="nav-label">SERVIÇOS</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="ordens_servico.php"><i class="fas fa-tools"></i> Ordens de Serviço</a></li>
                            <li><a href="agenda.php"><i class="fas fa-calendar-alt"></i> Agenda Serviços</a></li>
                        </ul>
                    </li>
					<li>
                        <a href="grid.php"><i class="fas fa-map-marked-alt"></i> <span class="nav-label">MAPA VEÍCULOS</span></a>
                       
                    </li>
					<li>
                        <a href="#"><i class="fas fa-file"></i> <span class="nav-label">RELATÓRIOS</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="relatorio_percurso.php"><i class="fas fa-road"></i> Percurso</a></li>
                            <li><a href="relatorio_alertas.php"><i class="fas fa-bell"></i> Alertas</a></li>
                        </ul>
                    </li>
					<li>
                        <a href="#"><i class="fas fa-box-open"></i> <span class="nav-label">ESTOQUE</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="rastreadores.php"><i class="fas fa-mobile"></i> Equipamentos</a></li>
                            <li><a href="simcards.php"><i class="fas fa-sim-card"></i> Sim Cards</a></li>
                        </ul>
                    </li>
					 <li>
                        <a href="rastreaveis.php"><i class="fas fa-microchip"></i> <span class="nav-label">RASTREÁVEIS</span></a>
                       
                    </li>
					<li>
                        <a href="#"><i class="fas fa-database"></i> <span class="nav-label">MÓDULOS</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="cerca_virtual.php"><i class="fas fa-draw-polygon"></i> Cerca Virtual</a></li>
							 <li><a href="manutencoes.php"><i class="fas fa-tools"></i> Manutenções</a></li>
							 <li><a href="motoristas.php"><i class="fas fa-user-tie"></i> Motoristas</a></li>
                        </ul>
                    </li>

                </ul>

            </div>
			
				<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!-- Toastr -->
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
		'timeOut': '10000',
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