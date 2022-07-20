<?php
include_once("../conexao.php");


$id_push = $_GET['id'];
$id_agente = strlen($id_push);


  $cons_user1 = mysqli_query($conn,"SELECT * FROM usuarios_push WHERE id_push='$id_push' ");
	if(mysqli_num_rows($cons_user1) > 0){
while ($resp_user1 = mysqli_fetch_assoc($cons_user1)) {
$tipo = 	$resp_user1['tipo'];
$id_cliente_login = $resp_user1['id_usuarios'];

}}

$cons_user = mysqli_query($conn, "SELECT * FROM usuarios WHERE id_usuarios = '$id_cliente_login'");
	if(mysqli_num_rows($cons_user) > 0){
while ($resp_user = mysqli_fetch_assoc($cons_user)) {
$nome_user = 	$resp_user['nome'];
$email_user = 	$resp_user['email'];
$nivel = 	$resp_user['nivel'];
$ativo = 	$resp_user['ativo'];
	}}
	

	

	
?>


<!-- BEGIN PRIMARY NAVIGATION -->
                    <nav id="js-primary-nav " class="primary-nav" role="navigation">
                        
                       
                        <ul id="js-nav-menu" class="nav-menu">
                            <li class="nav-title" style="color:#fff"><i class="fas fa-user"></i> <?php echo $nome_user?><br>
							
							</li><hr>
                            <li class="nav-title" style="color:#fff">Menu Principal</li>
							<li>
                                <a href="index.php?id=<?php echo $id_push?>&app=on" title="DASHBOARD" data-filter-tags="dashboard">
									<i class="fal fa-car"></i>
                                    <span class="nav-link-text" data-i18n="nav.dashboard">ORDENS DE SERVIÇO</span>
                                </a>
                            </li>
							
							<br>
                            <li>
                                <a href="faturas.php?id=<?php echo $id_push?>&app=on" title="Mapa Veiculos" data-filter-tags="mapa veiculos">
                                   <i class="fal fa-dollar-sign"></i>
                                    <span class="nav-link-text" data-i18n="nav.mapa_veiculos">MINHAS FATURAS</span>
                                </a>
							</li>
							<br>
                            <li>
                                <a href="perfil.php?id=<?php echo $id_push?>&app=on" title="Mapa Veiculos" data-filter-tags="mapa veiculos">
                                   <i class="fal fa-user-circle"></i>
                                    <span class="nav-link-text" data-i18n="nav.mapa_veiculos">MEU PERFIL</span>
                                </a>
							</li>
							
							<li class="nav-title" style="color:#fff">Menu Suporte</li>
							 <li>
                                <a href="tel:08000510051" title="Mapa Veiculos" data-filter-tags="mapa veiculos">
                                   <i class="fal fa-phone"></i>
                                    <span class="nav-link-text" data-i18n="nav.mapa_veiculos">LIGAR PARA CENTRAL</span>
                                </a>
							</li>
							<br>
							 <li>
                                <a href="whats.php" title="Mapa Veiculos" data-filter-tags="mapa veiculos">
                                   <i class="fab fa-whatsapp"></i>
                                    <span class="nav-link-text" data-i18n="nav.mapa_veiculos">WHATSAPP SUPORTE</span>
                                </a>
							</li>
							<br>
							 <li>
                                <a href="/tracker2/app/logoff.php" title="Mapa Veiculos" data-filter-tags="mapa veiculos">
                                  <i class="fal fa-power-off"></i>
                                    <span class="nav-link-text" data-i18n="nav.mapa_veiculos">SAIR</span>
                                </a>
							</li>
                        </ul>

                    </nav>
					

					
					
