<?php


include_once("conexao.php");

$cons_empresa = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='1361'");
	if(mysqli_num_rows($cons_empresa) > 0){
	while ($resp_empresa = mysqli_fetch_assoc($cons_empresa)) {
$nome_url = $resp_empresa['nome_url'];
$logo = $resp_empresa['logo'];
$texto_rodape = $resp_empresa['texto_rodape'];
$texto_topo = $resp_empresa['texto_topo'];
$cor_sistema = $resp_empresa['cor_sistema'];
	}}


$date = date('Y-m-d');	

$agrupar = $_POST['agrupar'];

$data_i1 = $_POST['data_inicial'];
$data_inicial = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_i1)));
$data_inicial_1 = date('d/m/Y H:i' , strtotime($data_i1));


$agrupar = $_POST['agrupar'];

$data_f1 = $_POST['data_final'];
$data_final = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_f1)));
$data_final_1 = date('d/m/Y H:i' , strtotime($data_f1));



$deviceid = $_POST['veiculo'];


$sql = mysqli_query($conn, "SELECT * FROM tc_positions WHERE deviceid='$deviceid' AND (servertime >= '$data_inicial' AND servertime <= '$data_final') ORDER BY id DESC LIMIT 1");
	if(mysqli_num_rows($sql) > 0){
while ($resp_sql = mysqli_fetch_assoc($sql)) {
		$km_1 = $resp_sql['attributes'];
		$obj_km1 = json_decode($km_1);
		$km_1 = $obj_km1->{'totalDistance'};;
	}}
	
	$sql1 = mysqli_query($conn, "SELECT * FROM tc_positions WHERE deviceid='$deviceid' AND (servertime >= '$data_inicial' AND servertime <= '$data_final') ORDER BY id ASC LIMIT 1");
	if(mysqli_num_rows($sql1) > 0){
while ($resp_sql1 = mysqli_fetch_assoc($sql1)) {
		$km_2 = $resp_sql1['attributes'];
		$obj_km2 = json_decode($km_2);
		$km_2 = $obj_km2->{'totalDistance'};;
	}}
	
	$totalkm = $km_1 - $km_2;
	$totalkm = $totalkm / 1000;
	$totalkm = round($totalkm, 2);
	$totalkm = number_format($totalkm, 2, ",", ".");


$cons_veiculo = mysqli_query($conn, "SELECT * FROM veiculos_clientes WHERE deviceid='$deviceid'");
if(mysqli_num_rows($cons_veiculo) > 0){
while ($resp_veic = mysqli_fetch_assoc($cons_veiculo)) {
		$id_cliente = $resp_veic['id_cliente'];
		$marca_veiculo =  $resp_veic['marca_veiculo'];
		$modelo_veiculo =  $resp_veic['modelo_veiculo'];
		$placa =  $resp_veic['placa'];
}}

$cons_cliente = mysqli_query($conn, "SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
if(mysqli_num_rows($cons_cliente) > 0){
while ($resp_cliente = mysqli_fetch_assoc($cons_cliente)) {
		$nome_cliente = $resp_cliente['nome_cliente'];
}}


?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
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
		<link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/formplugins/select2/select2.bundle.css">
        <!-- Place favicon.ico in the root directory -->
        <link rel="apple-touch-icon" sizes="180x180" href="/tracker3/app-assets/img/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/tracker3/app-assets/img/favicon/favicon-32x32.png">
        <link rel="mask-icon" href="/tracker3/app-assets/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
		<link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/fa-brands.css">
		<link rel="stylesheet" media="screen, print" href="/tracker3/app-assets/css/fa-solid.css">
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
               <aside class="page-sidebar" style="background-color:#FFF">
                    <div style="background-color:#FFF">
                        <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative">
                           <img src="logos/<?php echo $logo?>" style="width:200px; heigth:auto" alt="SmartAdmin WebApp" aria-roledescription="logo">
                            
                            
                        </a>
                    </div>
                    <?php include('include/sidebar.php')?>
                    
                </aside>
                <!-- END Left Aside -->
                <div class="page-content-wrapper header-function-fixed">
                    <!-- BEGIN Page Header -->
                    <?php include('include/head.php')?>
                    <!-- END Page Header -->
                    <!-- BEGIN Page Content -->
                    <!-- the #js-page-content id is needed for some plugins to initialize -->
                    <main id="js-page-content" role="main" class="page-content">
					
						<div class="row">
                            <div class="col-xl-8">
								<div class="subheader">
									<h1 class="subheader-title">
										<i class='subheader-icon fal fa-bell'></i> Relatório de Alertas
										<small>
											Alertas emitidos pelo dispositivo.
										</small>
									</h1>
								</div>
							</div>
							<div class="col-xl-4 text-right">
								 <a href="pdf_files/relatorio_eventos.php?data_inicial=<?php echo $data_i1?>&data_final=<?php echo $data_f1?>&deviceid=<?php echo $deviceid?>" target="_blank"><button type="button" class="btn btn-danger btn-sm" style="font-size:14px"><i class="fas fa-file-pdf"></i> PDF</button></a>
								 <button type="button" onclick="imprimir();" class="btn btn-primary btn-sm" style="font-size:14px">Imprimir</button>
								 
							</div>
						</div>
                        
                        <form name="forml" id="forml" action="relatorio_alertas1.php" method="post">
                        <div class="row">
                            <div class="col-xl-12">
                                <div id="panel-1" class="panel">
                                    
                                    <div class="panel-container show">
                                        <div class="panel-content">
											<form action="relatorio_percurso1.php" method="post" name="forml">
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox ">
                  
					<input type="hidden" id="pagina" value="resultado_rota.php?data_inicial=<?php echo $data_inicial ?>&data_final=<?php echo $data_final ?>&deviceid=<?php echo $deviceid?>">
					<div id="relatorio_geral">
						<div class="ibox-content">
							<div class="row">
								<div class="col-md-8">
									
										<b>Período:</b> <?php echo $data_inicial_1?> até <?php echo $data_final_1?><br>
										<b>Cliente:</b> <?php echo $nome_cliente?><br>
										<b>Veículo:</b> <?php echo $marca_veiculo?>/<?php echo $modelo_veiculo?><br>
										<b>Placa: </b><?php echo $placa?>
								</div>
								
							</div>
							<hr>
							
						<div class="row">
						<div class="col-md-12">
						<table class="table table-striped table-bordered table-hover">
							
							<thead>
								<tr>
									<th>#</th>
									<th>Data/Hora</th>
									<th>Tipo de Alera</th>
									<th>Endereço</th>
									<th>Velocidade</th>
								</tr>
							 </thead>
							<tbody>
						<?php
						
						
							$cons_conta = mysqli_query($conn,"SELECT * FROM tc_events WHERE deviceid='$deviceid' AND (eventtime >= '$data_inicial' AND eventtime <= '$data_final') AND (type='ignitionOff' OR type='ignitionOn' OR type='alarm' OR type='geofenceExit' OR type='geofenceEnter' OR type='deviceOverspeed') ORDER BY id DESC");
							$total = mysqli_num_rows($cons_conta);
								if(mysqli_num_rows($cons_conta) > 0){
									
									

							?>
						
						<?php 
						
							$i = $total;
						while ($row_ev = mysqli_fetch_assoc($cons_conta)) {
							--$i;
									$positionid = $row_ev['positionid'];
									$geofenceid = $row_ev['geofenceid'];
									$horario_alarme = $row_ev['eventtime'];
									$horario_alarme = date('d/m/Y H:i:s', strtotime('-3 hour', strtotime($horario_alarme)));
									$eventos = $row_ev['attributes'];
									$eventos1 = json_decode($eventos);
									$alarme = $eventos1->{'alarm'};
									$type = $row_ev['type'];
									$speed1 = $eventos1->{'speed'};
									$speed1 = $speed1 + 1.609;
									$speed1 = round($speed1, 2);
								
								if($type == 'deviceOverspeed'){
									$notific = '<font color="#990000"><i class="fas fa-tachometer-alt"></i> <b>EXC. VELOCIDADE</b></font>';	
								} 

								if($type == 'ignitionOn'){
									$notific = '<font color="#009900"><i class="fas fa-key"></i> <b>IGNIÇÃO LIGADA</b></font>';	
								} 
								if($type == 'ignitionOff'){
									$notific = '<i class="fas fa-key"></i> <b>IGNIÇÃO DESLIGADA<b/>';
								}
								
								if($alarme == 'powerCut' && $type == 'alarm'){
									$notific = '<font color="#990000"><i class="fas fa-car-battery"></i> <b>BATERIA REMOVIDA</b></font>';
								}
								if($alarme == 'shock' && $type == 'alarm' ){
									$notific = '<font color="#990000"><i class="far fa-bell"></i> <b>ALARME DISPARADO SENSOR</b></font>';
								}
								
								if($alarme == 'door' && $type == 'alarm'){
									$notific = '<font color="#990000"><i class="far fa-bell"></i> <b>ALARME DISPARADO PORTAS</b></font>';
								}
								if($alarme == null && $type == 'geofenceExit'){
									$cons_fence = mysqli_query($conn,"SELECT * FROM tc_geofences WHERE id='$geofenceid'");
								if(mysqli_num_rows($cons_fence) > 0){
							while ($row_fence = mysqli_fetch_assoc($cons_fence)) {
								$name_cerca = $row_fence['name'];
								$description = $row_fence['description'];
								if($description == 'ANCORA'){
									$tipo = '<font color="#990000"><i class="fas fa-anchor"></i> <b>ANCORA VIOLADA</b></font>';

								} else {
									$tipo = '<i class="far fa-vector-square"></i> </b>SAIDA CERCA '.$name_cerca.'</b>';
								}
								
									$notific = $tipo;
								}}}
								if($alarme == null && $type == 'geofenceEnter'){
									$notific = '<i class="far fa-bell"></i> </b>ENTRADA CERCA '.$name_cerca.'</b>';
								}

								
								
															
								$cons_position = mysqli_query($conn,"SELECT * FROM tc_positions WHERE id='$positionid'");
							
								if(mysqli_num_rows($cons_position) > 0){
										while ($resp_posi = mysqli_fetch_assoc($cons_position)) {
											
								$id_pos = $resp_posi['id'];
								$address = $resp_posi['address'];
								$speed = 	$resp_posi['speed'];
								$speed = $speed * 1.609;
								$speed = round($speed, 2);
								$address = str_replace(', BR', '', $address);
								$address1 = explode(",", $address);
								$estado1 = end($address1);
								$estado = ','.$estado1;
								$address = str_replace($estado, '', $address);
								$address1 = explode(",", $address);
								$cep = end($address1);
								$cep = ','.$cep;
								$address = str_replace($cep, '', $address);
								$address = $address.' /'.$estado1;
								
							
						?>
						 <tr>
							<th><font style="font-size:14px;"><?php echo $i?></font></th>
							<th><font style="font-size:14px;"><?php echo $horario_alarme?></font></th>
							<td><font style="font-size:14px;"><?php echo $notific; ?></font></td>
							<td><font style="font-size:14px;"><?php echo $address; ?></font></td>
							<td><font style="font-size:14px;"><?php echo $speed; ?> km/h</font></td>
						</tr>
								<?php }}}}?>
							</tbody>
					</table>
					
						</div>
						</div>
					
					
						
						
						
						
					
					
						</div>
                </div>
            </div>
            </div>
        </div>
		</form>
											
											
											
											
											
											

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						</form>
                    </main>
					
					<!-- DIV Carregar -->
					<div class="modal fade" id="carregar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-sm modal-dialog-centered">
							<div class="modal-content">
								
								<div class="modal-body" id="informacoes">
									<span style="fonta-size:20px"> Aguarde... </span> <img src="/tracker2/Imagens/load.gif" width="40px" height="40px">
								</div>
								
							</div>
						</div>
					</div>	
                    <!-- FIM DIV Carregar -->
					
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
        <!-- BEGIN Messenger -->
			<?php include('include/messenger.php');?>
        <!-- END Messenger -->
        <!-- BEGIN Page Settings -->
			<?php include('include/settings.php');?>
        <!-- END Page Settings -->
      	<?php 
				$base64 = $deviceid.'@'.$data_inicial.'@'.$data_final;
				$base64 = base64_encode($base64);
				
				?>
				<input type="hidden" id="id_relatorio" value="<?php echo $id_relatorio?>">
				<input type="hidden" id="base64" value="<?php echo $base64?>">
        <script src="/tracker3/app-assets/js/vendors.bundle.js"></script>
        <script src="/tracker3/app-assets/js/app.bundle.js"></script>
        <script src="/tracker3/app-assets/js/formplugins/select2/select2.bundle.js"></script>
<script>
$('#forml').on('submit', function(e){
  $('#carregar').modal('show');
});
</script>   
    <script type="text/javascript">
	$(function(){
	  $("select[name=cliente]").change(function(){
	    beforeSend:$("select[name=veiculo]").html('<option value="0">Carregando...</option>')
	
		var veiculo = $("select[name=cliente]").val();
		$.post("ajax/veiculo.ajax.php",{veiculo: veiculo},function(pega_veiculo){
		complete:$("select[name=veiculo]").html(pega_veiculo);
		
		})
	  })	
	})
</script>
<script>
function imprimir(){
	var base64 = document.getElementById("base64").value;
	window.open("http://rastreiamaisbrasil.com.br/tracker3/manager/imprimir_relatorio_alertas.php?c="+base64, "minhaJanela", "height=700,width=1000");
		}
</script>






 <script>
	$(document).ready(function()
            {
                $(function()
                {
                    $('.select2').select2();

                    $(".select2-placeholder-multiple").select2(
                    {
                        placeholder: "Select State"
                    });
                    $(".js-hide-search").select2(
                    {
                        minimumResultsForSearch: 1 / 0
                    });
                    $(".js-max-length").select2(
                    {
                        maximumSelectionLength: 2,
                        placeholder: "Select maximum 2 items"
                    });
                    $(".select2-placeholder").select2(
                    {
                        placeholder: "Select a state",
                        allowClear: true
                    });



                    $(".js-select2-icons").select2(
                    {
                        minimumResultsForSearch: 1 / 0,
                        templateResult: icon,
                        templateSelection: icon,
                        escapeMarkup: function(elm)
                        {
                            return elm
                        }
                    });

                    function icon(elm)
                    {
                        elm.element;
                        return elm.id ? "<i class='" + $(elm.element).data("icon") + " mr-2'></i>" + elm.text : elm.text
                    }

                    $(".js-data-example-ajax").select2(
                    {
                        ajax:
                        {
                            url: "https://api.github.com/search/repositories",
                            dataType: 'json',
                            delay: 250,
                            data: function(params)
                            {
                                return {
                                    q: params.term, // search term
                                    page: params.page
                                };
                            },
                            processResults: function(data, params)
                            {
                                // parse the results into the format expected by Select2
                                // since we are using custom formatting functions we do not need to
                                // alter the remote JSON data, except to indicate that infinite
                                // scrolling can be used
                                params.page = params.page || 1;

                                return {
                                    results: data.items,
                                    pagination:
                                    {
                                        more: (params.page * 30) < data.total_count
                                    }
                                };
                            },
                            cache: true
                        },
                        placeholder: 'Search for a repository',
                        escapeMarkup: function(markup)
                        {
                            return markup;
                        }, // let our custom formatter work
                        minimumInputLength: 1,
                        templateResult: formatRepo,
                        templateSelection: formatRepoSelection
                    });

                    function formatRepo(repo)
                    {
                        if (repo.loading)
                        {
                            return repo.text;
                        }

                        var markup = "<div class='select2-result-repository clearfix d-flex'>" +
                            "<div class='select2-result-repository__avatar mr-2'><img src='" + repo.owner.avatar_url + "' class='width-2 height-2 mt-1 rounded' /></div>" +
                            "<div class='select2-result-repository__meta'>" +
                            "<div class='select2-result-repository__title fs-lg fw-500'>" + repo.full_name + "</div>";

                        if (repo.description)
                        {
                            markup += "<div class='select2-result-repository__description fs-xs opacity-80 mb-1'>" + repo.description + "</div>";
                        }

                        markup += "<div class='select2-result-repository__statistics d-flex fs-sm'>" +
                            "<div class='select2-result-repository__forks mr-2'><i class='fal fa-lightbulb'></i> " + repo.forks_count + " Forks</div>" +
                            "<div class='select2-result-repository__stargazers mr-2'><i class='fal fa-star'></i> " + repo.stargazers_count + " Stars</div>" +
                            "<div class='select2-result-repository__watchers mr-2'><i class='fal fa-eye'></i> " + repo.watchers_count + " Watchers</div>" +
                            "</div>" +
                            "</div></div>";

                        return markup;
                    }

                    function formatRepoSelection(repo)
                    {
                        return repo.full_name || repo.text;
                    }

                });
            });

        </script>
	<script>
function MascaraMoeda(objTextBox, SeparadorMilesimo, SeparadorDecimal, e){
    var sep = 0;
    var key = '';
    var i = j = 0;
    var len = len2 = 0;
    var strCheck = '0123456789';
    var aux = aux2 = '';
    var whichCode = (window.Event) ? e.which : e.keyCode;
    if (whichCode == 13) return true;
    key = String.fromCharCode(whichCode); // Valor para o código da Chave
    if (strCheck.indexOf(key) == -1) return false; // Chave inválida
    len = objTextBox.value.length;
    for(i = 0; i < len; i++)
        if ((objTextBox.value.charAt(i) != '0') && (objTextBox.value.charAt(i) != SeparadorDecimal)) break;
    aux = '';
    for(; i < len; i++)
        if (strCheck.indexOf(objTextBox.value.charAt(i))!=-1) aux += objTextBox.value.charAt(i);
    aux += key;
    len = aux.length;
    if (len == 0) objTextBox.value = '';
    if (len == 1) objTextBox.value = '0'+ SeparadorDecimal + '0' + aux;
    if (len == 2) objTextBox.value = '0'+ SeparadorDecimal + aux;
    if (len > 2) {
        aux2 = '';
        for (j = 0, i = len - 3; i >= 0; i--) {
            if (j == 3) {
                aux2 += SeparadorMilesimo;
                j = 0;
            }
            aux2 += aux.charAt(i);
            j++;
        }
        objTextBox.value = '';
        len2 = aux2.length;
        for (i = len2 - 1; i >= 0; i--)
        objTextBox.value += aux2.charAt(i);
        objTextBox.value += SeparadorDecimal + aux.substr(len - 2, len);
    }
    return false;
}

function MascaraFloat3(objTextBox, SeparadorMilesimo, SeparadorDecimal, e){
	var sep = 0;
	var key = '';
	var i = j = 0;
	var len = len2 = 0;
	var strCheck = '0123456789';
	var aux = aux2 = '';
	var whichCode = (window.Event) ? e.which : e.keyCode;
	if (whichCode == 13 || whichCode == 8) return true;
	key = String.fromCharCode(whichCode); // Valor para o código da Chave
	if (strCheck.indexOf(key) == -1) return false; // Chave inválida
	len = objTextBox.value.length;
	for(i = 0; i < len; i++)
	if ((objTextBox.value.charAt(i) != '0') && (objTextBox.value.charAt(i) != SeparadorDecimal)) break;
	aux = '';
	for(; i < len; i++)
	if (strCheck.indexOf(objTextBox.value.charAt(i))!=-1) aux += objTextBox.value.charAt(i);
	aux += key;
	len = aux.length;
	if (len == 0) objTextBox.value = '';
	if (len == 1) objTextBox.value = '0'+ SeparadorDecimal + '00' + aux;
	if (len == 2) objTextBox.value = '0'+ SeparadorDecimal + '0' + aux;
	if (len == 3) objTextBox.value = '0'+ SeparadorDecimal + aux;
	if (len > 3) {
		aux2 = '';
		for (j = 0, i = len - 4; i >= 0; i--) {
			if (j == 3) {
				aux2 += SeparadorMilesimo;
				j = 0;
			}
			aux2 += aux.charAt(i);
			j++;
		}
		objTextBox.value = '';
		len2 = aux2.length;
		for (i = len2 - 1; i >= 0; i--)
		objTextBox.value += aux2.charAt(i);
		objTextBox.value += SeparadorDecimal + aux.substr(len - 3, len);
	}
	return false;
}

function fmtMoney(n, c, d, t){ 
   var m = (c = Math.abs(c) + 1 ? c : 2, d = d || ",", t = t || ".", 
      /(\d+)(?:(\.\d+)|)/.exec(n + "")), x = m[1].length > 3 ? m[1].length % 3 : 0; 
   return (x ? m[1].substr(0, x) + t : "") + m[1].substr(x).replace(/(\d{3})(?=\d)/g, 
      "$1" + t) + (c ? d + (+m[2] || 0).toFixed(c).substr(2) : ""); 
};
</script>
</body>
</html>
