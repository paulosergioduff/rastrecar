<?php


include_once("conexao.php");

$date = date('Y-m-d');	

$deviceid = $_REQUEST['deviceid'];
$data_inicial = $_REQUEST['data_inicial'];
$data_final = $_REQUEST['data_final'];
$id_relatorio = $_REQUEST['id_relatorio'];




?>

<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>MAPA RELÁTORIO</title>
    <link rel="apple-touch-icon" href="../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/charts/apexcharts.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/colors.css">


    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/pages/dashboard-ecommerce.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/pages/card-analytics.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <!-- END: Custom CSS-->
	<script src="https://kit.fontawesome.com/a132241e15.js"></script>
	<style>
#floating-panel {
  position: absolute;
  top: 10%;
  left: 2%;
  z-index: 9999;
  background-color:  rgb(255, 255, 255, 0);
  padding: 5px;
  text-align: center;
  font-family: 'Roboto','sans-serif';
  line-height: 30px;
  padding-left: 10px;
}
.mapboxgl-popup {
  width: 500px;
  height: 200px;
}

.mapboxgl-popup-content {
   width: 500px;
   
}

.mapboxgl-popup-tip{
  margin-bottom: 35px;
}
.mapboxgl-popup-close-button {
    position: absolute;
    right: 0;
    top: 0;
    border: 0;
    border-radius: 0 3px 0 0;
    cursor: pointer;
    background-color: transparent;
    font-size: 30px;
}
.central{
	height: 185px;
    border: #000 1px solid;
    width: 470px;
    position: fixed;
    top: -1px;
    left: 3px;
}
</style>
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern semi-dark-layout 2-columns" data-open="click" onLoad="envia_1()">

    <!-- BEGIN: Header-->

    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->

    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
       
        <div class="content-wrapper">
            <section id="validation">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <form id="forml" method="post" name="forml">
                                <div class="card-content">
                                    <div class="card-body">
                                        
											 <div class="panel-hdr">
												<h4>
												  CARREGANDO INFORMAÇÕES
												</h4><BR>
												<span class="sr-only">Aguarde...</span>
											</div>
                                           <div class="row">
												<div class="col-lg-12">
												
													 <div class="spinner-border text-dark" role="status"><span class="sr-only">Loading...</span></div>
													
													<input type="hidden" id="data_inicial" name="data_inicial" value="<?php echo $data_inicial ?>">
												<input type="hidden" id="data_final" name="data_final" value="<?php echo $data_final ?>">
												<input type="hidden" id="deviceid" name="deviceid" value="<?php echo $deviceid ?>">
												<input type="hidden" id="id_relatorio" name="id_relatorio" value="<?php echo $id_relatorio ?>">
													
												</div>

											</div><br>
											
											
                                       
                                    </div>
                                </div>
								</form>
                            </div>
                        </div>
                    </div>
                </section>
        </div>
    </div>
    <!-- END: Content-->
	
	<div id="status_comando" style="display:none"></div>
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="../app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../app-assets/vendors/js/charts/apexcharts.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../app-assets/js/core/app-menu.js"></script>
    <script src="../app-assets/js/core/app.js"></script>
    <script src="../app-assets/js/scripts/components.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../app-assets/js/scripts/pages/dashboard-ecommerce.js"></script>
    <!-- END: Page JS-->

        <script src="js/datagrid/datatables/datatables.bundle.js"></script>
		<script src="js/formplugins/select2/select2.bundle.js"></script>
			
<script>
		function envia_1(){
document.forml.action="mapa_road1.php"
document.forml.method = 'POST';
document.forml.submit()
}
</script>
</body>
<!-- END: Body-->

</html>