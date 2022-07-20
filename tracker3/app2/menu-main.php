<style>
	.trocar:active,.trocar:hover{
	background-color: #ccc;
	color:#FFF;
}
</style>
<?php

$servidor = "localhost";
$usuario = "root";
$senha = "TR4vcijU6T9Keaw";
$dbname = "traccar";

//Criar a conexao
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
$con = mysqli_connect($servidor, $usuario, $senha, $dbname);

$id_push1 = $_GET['id'];

  $cons_user1 = mysqli_query($conn,"SELECT * FROM usuarios_push WHERE id_push='$id_push1' ");

	if(mysqli_num_rows($cons_user1) > 0){
while ($resp_user1 = mysqli_fetch_assoc($cons_user1)) {
$tipo = 	$resp_user1['tipo'];
$id_cliente_login = $resp_user1['id_cliente'];
$id_usuarios = $resp_user1['id_usuarios'];

}}



$cons_user = mysqli_query($conn, "SELECT * FROM usuarios WHERE id_usuarios = '$id_usuarios'");
	if(mysqli_num_rows($cons_user) > 0){
while ($resp_user = mysqli_fetch_assoc($cons_user)) {
$nome_user = 	$resp_user['nome'];
$nome_us = explode(" ", $nome_user);
$nome_user = $nome_us[0];
$nome_user1 = end($nome_us);
$nome1 = $nome_user.' '.$nome_user1;
$email_user = 	$resp_user['email'];
$nivel = 	$resp_user['nivel'];
$ativo = 	$resp_user['ativo'];
$veiculos_user = 	$resp_user['veiculos'];
$id_empresa = 	$resp_user['id_empresa'];

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
$logo2 = 	$resp_cor['logo'];
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
$telefone1 = $resp_empresa['telefone'];
	}}
	
if($id_cliente_pai_ini == 1361){
	$logo = '/tracker3/manager/logos/'.$logo1;
	$cor_sistema = $cor_sistema1;
	$login_padrao = 'RMB';
	$telefone = $telefone1;

}

if($id_cliente_pai_ini != 1361){
	$logo = '/tracker3/manager/logos/'.$logo2;
	$cor_sistema = $cor_sistema1;
	$login_padrao = $login_padrao1;
	$telefone = $telefone_residencial1;

}
?>
<div class="menu-header">

</div>

<div class="menu-logo text-center">
    <a href="#"><img width="180" src="<?php echo $logo?>"></a>
    
</div>

<div class="menu-items">
    <h5 class="text-uppercase opacity-60 font-12 pl-3">Menu</h5>
    <a id="nav-welcome" href="index.php?id=<?php echo $id_push1?>" class="trocar" onclick="carregar2()">
         <i class="fas fa-car gradient-dark color-dark fa-2x"></i>
        <span>Meus Veículos</span>
        <i class="fa fa-circle"></i>
    </a>
    <a id="nav-starters" href="faturas.php?id=<?php echo $id_push1?>" class="trocar" onclick="carregar2()">
        <i class="fas fa-dollar-sign gradient-dark color-dark fa-2x"></i>
        <span>Faturas</span>
        <i class="fa fa-circle"></i>
    </a>

    <a id="nav-perfil" href="perfil.php?id=<?php echo $id_push1?>" class="trocar" onclick="carregar2()">
        <i class="fas fa-user-circle gradient-dark color-dark fa-2x"></i>
        <span>Meu Perfil</span>
        <i class="fa fa-circle"></i>
    </a>
	<br>
	<h5 class="text-uppercase opacity-60 font-12 pl-3">Contato</h5>

	<a id="nav-central" href="tel:<?php echo $telefone?>" class="trocar">
         <i class="fas fa-phone gradient-dark color-dark fa-2x"></i>
        <span>Chamar Central</span>
        <i class="fa fa-circle fa-2x"></i>
    </a>
	<br>
	<h5 class="text-uppercase opacity-60 font-12 pl-3">Configurações</h5>
	<a id="nav-central" href="" data-toggle-theme class="trocar">
         <i class="fas fa-moon gradient-dark color-dark fa-2x"></i>
        <span>Modo Noturno</span>
        <i class="fa fa-circle fa-2x"></i>
    </a>
	<a id="nav-central" href="#" data-menu="menu-highlights" class="trocar">
         <i class="fas fa-palette gradient-dark color-dark fa-2x"></i>
        <span>Trocar Cores</span>
        <i class="fa fa-circle fa-2x"></i>
    </a>
	<a id="nav-sair" href="logoff.php" class="trocar">
         <i class="fas fa-power-off gradient-dark color-dark fa-2x"></i>
        <span>Sair do App</span>
        <i class="fa fa-circle fa-2x"></i>
    </a>
</div>

<div class="text-center pt-2">
    <p class="mb-0 pt-3 font-10 opacity-70">Versão <span class="copyright-year"></span> 2.0</p>
</div>
