<?php
session_start();
if(!empty($_SESSION['usuarioNome'])){
}else{
	
	header("Location: ../../index.php");	
}

$user_nome = $_SESSION['usuarioNome'];	
$user_id = $_SESSION['usuarioId'];
$nivel = $_SESSION['usuarioNivel'];

if($user_id <= 0){
	header("Location: ../../index.php");
} 
if($user_id == null){
	header("Location: ../../index.php");
} 
if($nivel == ''){
	header("Location: ../../index.php");
} 
if($nivel == 0){
	header("Location: ../../index.php");
} 

?>

 <title>JC Rastreamento | Sistema de Gestão</title>

<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars fa-2x"></i> </a>
			<button class="navbar-minimalize minimalize-styl-2 btn btn-primary"><i class="fas fa-users"></i> Listar Todos</button>
        </div>
		
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm welcome-message" style="color:#000"><b>JC Rastreamento</b> | Sistema de Gestão.</span>
                </li>
				
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <span style="color:#000"><i class="fas fa-bell" title="Alertas Disparados"></i> </span>
                    </a>
                    <ul id="avisos" class="dropdown-menu dropdown-messages" style="height: 400px; overflow: auto;">
                       
                       
                        
                       
                    </ul>
                </li>
				
                


                <li>
                    <a href="logout.php" style="color:#000">
                        <i class="fa fa-sign-out"></i> Sair do Sistema
                    </a>
                </li>
            </ul>

        </nav>
		



		<input type="hidden" value="<?php echo $user_id?>" id="user">
		<div id="avisos1" style="display:none;"></div>



	<!-- Jquery Validate -->
    <script src="../../js/plugins/validate/jquery.validate.min.js"></script>
	


    <!-- Page-Level Scripts -->



		<script>
			$(document).ready(function () {
				
				$.post('include/alertas_header.php', function(alertas_aviso){
					$("#avisos").html(alertas_aviso);
					
					
				});
			});
		</script>

<script>
  var intervalo = setInterval(function() { $('#avisos').load('include/alertas_header.php'); }, 3000);
</script>





