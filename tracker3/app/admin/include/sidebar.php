<?php

session_start();
$servidor = "localhost";
$usuario = "root";
$senha = "TR4vcijU6T9Keaw";
$dbname = "traccar";

//Criar a conexao
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
$con = mysqli_connect($servidor, $usuario, $senha, $dbname);

$id_push = $_REQUEST['id'];
$id_agente = strlen($id_push);


  $cons_user1 = mysqli_query($conn,"SELECT * FROM usuarios_push WHERE id_push='$id_push' ");
	if(mysqli_num_rows($cons_user1) > 0){
while ($resp_user1 = mysqli_fetch_assoc($cons_user1)) {
$tipo = 	$resp_user1['tipo'];
$id_usuarios = $resp_user1['id_usuarios'];
$id_cliente_login = $resp_user1['id_cliente'];

}}

$cons_user = mysqli_query($conn, "SELECT * FROM usuarios WHERE id_usuarios = '$id_cliente_login'");
	if(mysqli_num_rows($cons_user) > 0){
while ($resp_user = mysqli_fetch_assoc($cons_user)) {
$nome_user = 	$resp_user['nome'];
$email_user = 	$resp_user['email'];
$nivel = 	$resp_user['nivel'];
$ativo = 	$resp_user['ativo'];
$id_cliente_login = 	$resp_user['id_cliente_login'];
	}}
	
	
	
	
$cons_cliente = mysqli_query($conn, "SELECT * FROM clientes WHERE id_cliente = '$id_cliente_login'");
	if(mysqli_num_rows($cons_cliente) > 0){
while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {

$email_user = 	$resp_cliente['email'];
$migrado = 	$resp_cliente['migrado'];
$status_cliente = 	$resp_cliente['status'];
$id_cliente_pai_ini = 	$resp_cliente['id_cliente_pai'];
	}}
	
$cons_cli_cor = mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente='$id_cliente_pai_ini'");
	if(mysqli_num_rows($cons_cli_cor) > 0){
while ($resp_cor = mysqli_fetch_assoc($cons_cli_cor)) {
$cor_sistema1 = 	$resp_cor['cor_sistema'];
$logo1 = 	$resp_cor['logo'];
$login_padrao1 = 	$resp_cor['subdominio'];
$telefone_residencial1 = 	$resp_cor1['telefone_residencial'];
	}}
	
$cons_empresa = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='1361'");
	if(mysqli_num_rows($cons_empresa) > 0){
while ($resp_empresa = mysqli_fetch_assoc($cons_empresa)) {
$nome_url = $resp_empresa['nome_url'];
$logo1 = $resp_empresa['logo'];
$texto_rodape = $resp_empresa['texto_rodape'];
$texto_topo = $resp_empresa['texto_topo'];
$cor_sistema1 = $resp_empresa['cor_sistema'];
	}}
	
if($id_cliente_pai_ini == 1361){
	$logo = $logo1;
	$cor_sistema = $cor_sistema1;
	$login_padrao = 'RMB';
}

if($id_cliente_pai_ini == ''){
	$logo = $logo1/
	$cor_sistema = $cor_sistema1;
	$login_padrao = 'RMB';
}

if($id_cliente_pai_ini != 1361){
	$logo = '/tracker3/manager/logos/'.$logo1;
	$cor_sistema = $cor_sistema1;
	$login_padrao = $login_padrao1;

}
	
?>
<input id="cliente" type="hidden" value="<?php echo $id_cliente_login?>">
<input id="migrado" type="hidden" value="<?php echo $migrado?>">
<input id="status_cliente" type="hidden" value="<?php echo $status_cliente?>">
<input id="tipo" type="hidden" value="<?php echo $tipo?>">
<input id="id_push" type="hidden" value="<?php echo $id_push?>">






				 <aside class="page-sidebar" style="background-color:#FFF">
                    <div style="background-color:#FFF">
                        <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative">
                           <img src="<?php echo $logo?>" style="width:200px; heigth:auto" alt="SmartAdmin WebApp" aria-roledescription="logo">
                            
                            
                        </a>
                    </div>
                    
               
<!-- BEGIN PRIMARY NAVIGATION -->
                  <nav id="js-primary-nav" class="primary-nav" style="background-color:<?php echo $cor_sistema?>" role="navigation">
                        
                       
                        <ul id="js-nav-menu" class="nav-menu" style="background-color:<?php echo $cor_sistema?>">
                            <li class="nav-title" style="color:#fff">Cliente:<br><?php echo $nome_user?>
								
							</li><hr>
                            <li class="nav-title" style="color:#fff">Menu Principal</li>
							<li>
                                <a href="index.php?id=<?php echo $id_push?>&app=on" title="DASHBOARD" data-filter-tags="dashboard">
									<i class="fal fa-car"></i>
                                    <span class="nav-link-text" data-i18n="nav.dashboard">MEUS VEÍCULOS</span>
                                </a>
                            </li>
							
							<!--
                            <li>
                                <a href="faturas.php?id=<?php echo $id_push?>&app=on" title="Mapa Veiculos" data-filter-tags="mapa veiculos">
                                   <i class="fal fa-dollar-sign"></i>
                                    <span class="nav-link-text" data-i18n="nav.mapa_veiculos">MINHAS FATURAS</span>
                                </a>
							</li>
							-->
                            <li>
                                <a href="perfil.php?id=<?php echo $id_push?>&app=on" title="Mapa Veiculos" data-filter-tags="mapa veiculos">
                                   <i class="fal fa-user-circle"></i>
                                    <span class="nav-link-text" data-i18n="nav.mapa_veiculos">MEU PERFIL</span>
                                </a>
							</li>
							
						
							 <li>
                                <a href="tel:081998802625" title="Mapa Veiculos" data-filter-tags="mapa veiculos">
                                   <i class="fal fa-phone"></i>
                                    <span class="nav-link-text" data-i18n="nav.mapa_veiculos">LIGAR PARA CENTRAL</span>
                                </a>
							</li>
							
							 <li>
                                <a href="whats.php" title="Mapa Veiculos" data-filter-tags="mapa veiculos">
                                   <i class="fab fa-whatsapp"></i>
                                    <span class="nav-link-text" data-i18n="nav.mapa_veiculos">WHATSAPP SUPORTE</span>
                                </a>
							</li>
							
							 <li>
                                <a href="logoff.php" title="Mapa Veiculos" data-filter-tags="mapa veiculos">
                                  <i class="fal fa-power-off"></i>
                                    <span class="nav-link-text" data-i18n="nav.mapa_veiculos">SAIR</span>
                                </a>
							</li>
                        </ul>

                    </nav>
					
 </aside>
					
					
