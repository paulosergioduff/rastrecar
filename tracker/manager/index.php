<!DOCTYPE html>
<html>
<?php



include_once("conexao.php");
$date = date('Y-m-d');



  

?>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

   
<script src="https://kit.fontawesome.com/a132241e15.js"></script>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="../css/plugins/dataTables/datatables.min.css" rel="stylesheet">

    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
	<link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico">

			

	
	
	
</head>

<body>

    <div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <?php include('include/sidebar.php');?>
    </nav>

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <?php include ('include/header.php');?>
        </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Dashboard</h2>
                    
                </div>
                <div class="col-lg-2">
					
                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
		<div class="col-lg-6">
             <div class="ibox-content">
		<div class="row">
            <div class="col-lg-12">
				<h3 style="color:#000;"><b>CONTAS A RECEBER</b></h3>
			</div>
        </div>
		<div class="row">
            <div class="col-lg-6">
                <div class="widget style1 lazur-bg">
                    <div class="row">
                        <div class="col-4">
                            <i class="fas fa-funnel-dollar fa-5x"></i>
                        </div>
                        <div class="col-8 text-right">
                            <span> A RECEBER HOJE </span>
							<p style="font-size:25px"><b><?php echo $valor_brut1?></b></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="widget style1 red-bg">
                    <div class="row">
                        <div class="col-4">
                            <i class="fas fa-funnel-dollar fa-5x"></i>
                        </div>
                        <div class="col-8 text-right">
                            <span> A RECEBER VENCIDAS </span>
                            <p style="font-size:25px"><b><?php echo $valor_brut3?></b></p>
                        </div>
                    </div>
                </div>
            </div>
            
            
        </div>
			 </div>
		</div>	
			<div class="col-lg-6">
             <div class="ibox-content">
		<div class="row">
            <div class="col-lg-12">
				<h3 style="color:#000;"><b>CONTAS A PAGAR</b></h3>
			</div>
        </div>
		<div class="row">
            <div class="col-lg-6">
                <div class="widget style1 lazur-bg">
                    <div class="row">
                        <div class="col-4">
                            <i class="fas fa-funnel-dollar fa-5x"></i>
                        </div>
                        <div class="col-8 text-right">
                            <span> A PAGAR HOJE </span>
                             <p style="font-size:25px"><b><?php echo $valor_pagar11?></b></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="widget style1 red-bg">
                    <div class="row">
                        <div class="col-4">
                            <i class="fas fa-funnel-dollar fa-5x"></i>
                        </div>
                        <div class="col-8 text-right">
                            <span> A PAGAR VENCIDAS </span>
                             <p style="font-size:25px"><b><?php echo $valor_pagar3?></b></p>
                        </div>
                    </div>
                </div>
            </div>
            
            
        </div>
			 </div>
		</div>	
		</div>
		<br>
		
		
		
		<div class="row">
		<div class="col-lg-6">
             <div class="ibox-content">
		<div class="row">
            <div class="col-lg-12">
				<h3 style="color:#000;"><b>VEÍCULOS</b></h3>
			</div>
        </div>
		<div class="row">
            <div class="col-lg-6">
                <div class="widget style1 bg-primary">
                    <div class="row">
                        <div class="col-4">
                            <i class="fas fa-car fa-5x"></i>
                        </div>
                        <div class="col-8 text-right">
                            <span> VEÍCULOS ATIVOS </span>
							<p style="font-size:25px"><b><?php echo $total_veiculos1?></b></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="widget style1 lazur-bg">
                    <div class="row">
                        <div class="col-4">
                            <i class="fas fa-funnel-dollar fa-5x"></i>
                        </div>
                        <div class="col-8 text-right">
                            <span> TICKET MÉDIO </span>
                            <p style="font-size:25px"><b>R$ <?php echo $ticket1?></b></p>
                        </div>
                    </div>
                </div>
            </div>
            
            
        </div>
			 </div>
		</div>	
			<div class="col-lg-6">
             <div class="ibox-content">
		<div class="row">
            <div class="col-lg-12">
				<h3 style="color:#000;"><b>USUÁRIOS</b></h3>
			</div>
        </div>
		<div class="row">
            <div class="col-lg-6">
                <div class="widget style1 lazur-bg">
                    <div class="row">
                        <div class="col-4">
                            <i class="fas fa-user fa-5x"></i>
                        </div>
                        <div class="col-8 text-right">
                            <span> CLIENTES ATIVOS </span>
                             <p style="font-size:25px"><b><?php echo $total_cliente1?></b></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="widget style1 red-bg">
                    <div class="row">
                        <div class="col-4">
                            <i class="fas fa-user-slash fa-5x"></i>
                        </div>
                        <div class="col-8 text-right">
                            <span> BLOQUEADOS </span>
                             <p style="font-size:25px"><b><?php echo $total_cliente_b1?></b></p>
                        </div>
                    </div>
                </div>
            </div>
            
            
        </div>
			 </div>
		</div>	
		</div>
		
		
		
			 
        </div>
        <div class="footer">
           
            <div>
               <strong>Mobi Drive Rastreamento Veicular</strong> 
            </div>
        </div>

        </div>
        </div>



    <!-- Mainly scripts -->
    <script src="../js/jquery-3.1.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="../js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="../js/plugins/dataTables/datatables.min.js"></script>
    <script src="../js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>
	


    <!-- Custom and plugin javascript -->
    <script src="../js/inspinia.js"></script>
    <script src="../js/plugins/pace/pace.min.js"></script>
	

	


</body>

</html>
