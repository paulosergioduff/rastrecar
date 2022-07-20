<?php include('conexao.php');

?>

<!DOCTYPE html>

<html lang="en">
    <head>
           <meta charset="utf-8"/>
        <title>
           <?php echo $login_padrao?> | Sistema de Gestão Rastreamento
        </title>
        <meta name="description" content="Basic">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
        <!-- Call App Mode on ios devices -->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <!-- Remove Tap Highlight on Windows Phone IE -->
        <meta name="msapplication-tap-highlight" content="no">
        <!-- base css -->
        <link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/vendors.bundle.css">
        <link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/app.bundle.css">
        <!-- Place favicon.ico in the root directory -->
        <link rel="apple-touch-icon" sizes="180x180" href="/tracker3/app-assets/img/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/tracker3/app-assets/img/favicon/favicon-32x32.png">
        <link rel="mask-icon" href="/tracker3/app-assets/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/datagrid/datatables/datatables.bundle.css">
		<script src="https://kit.fontawesome.com/a132241e15.js"></script>
    </head>
    <body class="mod-bg-1 nav-function-fixed">
        <!-- DOC: script to save and load page settings -->
        <script>
            /**
             *	This script should be placed right after the body tag for fast execution 
             *	Note: the script is written in pure javascript and does not depend on thirdparty library
             **/
            'use strict';

            var classHolder = document.getElementsByTagName("BODY")[0],
                /** 
                 * Load from localstorage
                 **/
                themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) :
                {},
                themeURL = themeSettings.themeURL || '',
                themeOptions = themeSettings.themeOptions || '';
            /** 
             * Load theme options
             **/
            if (themeSettings.themeOptions)
            {
                classHolder.className = themeSettings.themeOptions;
                console.log("%c✔ Theme settings loaded", "color: #148f32");
            }
            else
            {
                console.log("Heads up! Theme settings is empty or does not exist, loading default settings...");
            }
            if (themeSettings.themeURL && !document.getElementById('mytheme'))
            {
                var cssfile = document.createElement('link');
                cssfile.id = 'mytheme';
                cssfile.rel = 'stylesheet';
                cssfile.href = themeURL;
                document.getElementsByTagName('head')[0].appendChild(cssfile);
            }
            /** 
             * Save to localstorage 
             **/
            var saveSettings = function()
            {
                themeSettings.themeOptions = String(classHolder.className).split(/[^\w-]+/).filter(function(item)
                {
                    return /^(nav|header|mod|display)-/i.test(item);
                }).join(' ');
                if (document.getElementById('mytheme'))
                {
                    themeSettings.themeURL = document.getElementById('mytheme').getAttribute("href");
                };
                localStorage.setItem('themeSettings', JSON.stringify(themeSettings));
            }
            /** 
             * Reset settings
             **/
            var resetSettings = function()
            {
                localStorage.setItem("themeSettings", "");
            }

        </script>
        <!-- BEGIN Page Wrapper -->
        <div class="page-wrapper">
            <div class="page-inner">
                <!-- BEGIN Left Aside -->
                <aside class="page-sidebar" style="background-color:#14145A">
                    <div style="background-color:#14145A">
                        <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative">
                           <img src="/tracker/Imagens/logo1.png" style="width:200px; heigth:auto" alt="SmartAdmin WebApp" aria-roledescription="logo">
                            
                            
                        </a>
                    </div>
                    <?php include('include/sidebar.php')?>
                    
                </aside>
                <!-- END Left Aside -->
                <div class="page-content-wrapper header-function-fixed">
                    <!-- BEGIN Page Header -->
                    <?php include('include/head.php')?>
                    
					<?php 
					$cons_nivel = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='$id_empresa'");
						if(mysqli_num_rows($cons_nivel) > 0){
					while ($resp_nivel = mysqli_fetch_assoc($cons_nivel)) {
					$sessao_whats = 	$resp_nivel['sessao_whats'];
					
					if($sessao_whats != 'SIM'){
						header('Location: index.php');
					}
					
					}}
					?>
					
                    <main id="js-page-content" role="main" class="page-content">
					
						<div class="row">
                            <div class="col-xl-8">
								<div class="subheader">
									<h1 class="subheader-title">
										<i class='subheader-icon fal fa-qrcode'></i> Parear Whatsapp / Status
										<small>
											Status API Whatsapp
										</small>
									</h1>
								</div>
							</div>
							
						</div>
                        
                        
                        <div class="row">
                            <div class="col-xl-12">
                                <div id="panel-1" class="panel">
                                    
                                    <div class="panel-container show">
                                        <div class="panel-content">
											 <form action="#" class="steps-validation wizard-circle">
												<div class="row">
													<div class="col-md-4">
														<div class="form-group">
															
															<input class="form-control" name="session" id="session" type="hidden" value="jcrast" required><br>
															<button class="btn btn-dark" onclick="startarSession()"> Start Sessão </button><br><br><br><br>
															Status: <div id="status"> 
																	<button type="button" class="btn btn-warning shadow-0">
																	<img src="/tracker2/Imagens/load.gif" width="30px" height="30px"> <b>AGUARDE</b>
																	</button></div>
														</div>
													</div>
													<div class="col-md-8 text-center">
														<img id="qrcode" style="width: 420px; height: 420px; text-align: center;">
													</div>
												</div>
											</form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                    <!-- this overlay is activated only when mobile menu is triggered -->
                    <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div> <!-- END Page Content -->
                    <!-- BEGIN Page Footer -->
						<?php include('include/footer.php');?>
                    <!-- END Page Footer -->
                    <!-- BEGIN Shortcuts -->
                   
                </div>
            </div>
        </div>
        <!-- END Page Wrapper -->
        <!-- BEGIN Quick Menu -->
			<?php include('include/quick_menu.php');?>
        <!-- END Quick Menu -->
        <!-- END Messenger -->
        <!-- BEGIN Page Settings -->
			<?php include('include/settings.php');?>
        <!-- END Page Settings -->
      
        <script src="/tracker3/app-assets/js/vendors.bundle.js"></script>
        <script src="/tracker3/app-assets/js/app.bundle.js"></script>
        <script src="/tracker3/app-assets/js/datagrid/datatables/datatables.bundle.js"></script>
        <script>
            /* demo scripts for change table color */
            /* change background */


            $(document).ready(function()
            {
                $('#dt-basic-example').dataTable(
                {

                    responsive: true,
					colReorder: true
					
                });

                $('.js-thead-colors a').on('click', function()
                {
                    var theadColor = $(this).attr("data-bg");
                    console.log(theadColor);
                    $('#dt-basic-example thead').removeClassPrefix('bg-').addClass(theadColor);
                });

                $('.js-tbody-colors a').on('click', function()
                {
                    var theadColor = $(this).attr("data-bg");
                    console.log(theadColor);
                    $('#dt-basic-example').removeClassPrefix('bg-').addClass(theadColor);
                });

            });

        </script>
<script>


    function getQRCode(callback) {
	let s = document.getElementById('session')
        var total = new XMLHttpRequest();
        total.onreadystatechange = callback
        total.open("GET", "http://167.86.123.220:3333/qrcode?sessionName="+s.value, true);
        total.send();
    }
	
	function setValido(){
		let qr = document.getElementById('qrcode')
		qr.style = 'display: None'
		let status = document.getElementById('status')
		 status.innerHTML = '<button type="button" class="btn btn-success shadow-0"><i class="fas fa-check-square"></i> CONECTADO</button>'
	}
	
	function setInvalido(qrCode){
		let qr = document.getElementById('qrcode')
		qr.setAttribute('src', qrCode)
		qr.style = 'display: inline'
		let status = document.getElementById('status')
		 status.innerHTML = '<button type="button" class="btn btn-danger shadow-0"><i class="fas fa-window-close"></i> DESCONECTADO</button>'
	}


    setInterval(function () {
        let getqrcode = getQRCode(function () {
            if (this.readyState == 4 && this.status == 200) {
                let ret = JSON.parse(this.responseText);
                console.log(ret);
                let qr = document.getElementById('qrcode')
				//Ativo
				if(ret.status == 'inChat'){
					setValido();
				}
				if(ret.status == 'qrReadSuccess'){
					setValido();
				}
                if(ret.message == 'QRCODE' || ret.message == 'UNPAIRED_IDLE' || ret.message == 'UNPAIRED'){
                    if(ret.status == 'qrReadSuccess'){
						setValido();
					}else{
						setInvalido(ret.qrcode);
					}
				}else{
                    if(ret.message == 'CONNECTED'){
                        setValido();
                    }else{
						if(ret.message == 'TIMEOUT'){
							let status = document.getElementById('status')
							status.innerHTML = '<button type="button" class="btn btn-warning shadow-0"><<img src="/tracker2/Imagens/load.gif" width="30px" height="30px"> <b>AGUARDE</b> VERIFICANDO</button>'
						}
							
					}
                }
            }
        })


    }, 1000);

    function startSession(callback) {
	let s = document.getElementById('session')
        var total = new XMLHttpRequest();
        total.onreadystatechange = callback
        total.open("GET", "http://167.86.123.220:3333/start?sessionName="+s.value, true);
        total.send();
    }


    function startarSession() {
        let getsess = startSession(function () {
            if (this.readyState == 4 && this.status == 200) {
                ret = JSON.parse(this.responseText);
                console.log(ret)
            }
        })
    }

    startarSession();

</script>
    </body>
</html>
