<?php


include_once("conexao.php");

$date = date('Y-m-d H:i:s');	

$cons_empresa = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='1361'");
	if(mysqli_num_rows($cons_empresa) > 0){
while ($resp_empresa = mysqli_fetch_assoc($cons_empresa)) {
$nome_url = $resp_empresa['nome_url'];
$logo = $resp_empresa['logo'];
$texto_rodape = $resp_empresa['texto_rodape'];
$texto_topo = $resp_empresa['texto_topo'];
$cor_sistema = $resp_empresa['cor_sistema'];
	}}	

$data_i1 = $_POST['data_inicial'];

$data_inicial = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_i1)));
$data_inicial_1 = date('d/m/Y H:i' , strtotime($data_i1));


$data_f1 = $_POST['data_final'];

$data_final = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($data_f1)));
$data_final_1 = date('d/m/Y H:i' , strtotime($data_f1));


$deviceid = $_POST['veiculo'];


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



#------------------------


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
										<i class='subheader-icon fal fa-bell'></i> Relatório de Viagens
										<small>
											Viagens Realizadas.
										</small>
									</h1>
								</div>
							</div>
							<div class="col-xl-4 text-right">
								<a href="pdf_files/relatorio_viagens.php?data_inicial=<?php echo $data_i1?>&data_final=<?php echo $data_f1?>&deviceid=<?php echo $deviceid?>" target="_blank"><button type="button" class="btn btn-danger btn-sm" style="font-size:14px"><i class="fas fa-file-pdf"></i> PDF</button></a>
								 <button type="button" onclick="imprimir();" class="btn btn-primary btn-sm" style="font-size:14px">Imprimir</button>
								  
							</div>
						</div>
                        
                       
                        <div class="row">
                            <div class="col-xl-12">
                                <div id="panel-1" class="panel">
                                    
                                    <div class="panel-container show">
                                        <div class="panel-content">
											
											 <div class="row">
												<div class="col-md-8">
														<input type="hidden" id="data_ini" value="<?php echo $data_ini1 ?>">
														<input type="hidden" id="data_fin" value="<?php echo $data_fin1 ?>">
														<input type="hidden" id="device_id" value="<?php echo $deviceid ?>">
														<input type="hidden" id="agrupar" value="<?php echo $agrupar ?>">
														<b>Período:</b> <?php echo $data_inicial_1?> até <?php echo $data_final_1?><br>
														<b>Cliente:</b> <?php echo $nome_cliente?><br>
														<b>Veículo:</b> <?php echo $marca_veiculo?>/<?php echo $modelo_veiculo?><br>
														<b>Placa: </b><?php echo $placa?>
												</div>
												
											</div>
											<hr>
											<div class="row">
					<div class="col-md-12">
						
					<?php
	


	$parada = 0;
	$temp_velocidade_media = '';
	$temp_tempo_percurso = '';
	$temp_end_inicial = '';
	$temp_end_final = '';
	$temp_html = '';
	$temp_data_inicial = '';
	$temp_data_final = '';
	$velocidades = 0;
	$velocidade_soma = 0;
	$velocidade_media = 0;
	$temp_km = 0;
	$temp_duracao = 0;
	$temp_hod_inicial = 0;
	$temp_hod_final = 0;
	$speed1 = 0;
	$iniciado = false;
	$cons_conta = mysqli_query($conn,"SELECT * FROM tc_positions WHERE deviceid='$deviceid' AND (servertime >= '$data_inicial' AND servertime <= '$data_final') ORDER BY id ASC");
	$total = mysqli_num_rows($cons_conta);
	/*$html_final = '<table border="1" class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th>.</th>
								<th>HORA</th>
								<th>ENDEREÇO</th>
								<th>Velocidade Média</th>
                                <th>KM PERCORRIDA</th>
						   		 <th>DURAÇÃO</th>
								<th>MAPA</th>
							</tr>
						</thead>
						<tbody>
						
						';*/
						
	if(mysqli_num_rows($cons_conta) > 0){
		while ($resp_conta = mysqli_fetch_array($cons_conta)) {
			//Tratamentos Padroes
			$data = $resp_conta['servertime'];
			$data = date('Y-m-d H:i:s', strtotime('-3 hour', strtotime($data))); 
			$id_pos = $resp_conta['id'];
			$address = $resp_conta['address'];
			$speed = 	$resp_conta['speed'];
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
			
			
			
			$attributes = $resp_conta['attributes'];
			$obj = json_decode($attributes);
			$ignicao = $obj->{'ignition'};
			
			$ignicao = (string)$ignicao;
			
			$total_km = $obj->{'totalDistance'};
			$total_km = $total_km / 1000;
			$total_km = round($total_km, 2);
			//$total_km = number_format($total_km, 2, ",", ".");
			//Colocar aqui os calculos de distancia e velocidade
			$velocidades = $velocidades + 1;
			$velocidade_soma = $velocidade_soma + $speed;
		
			
			$temp_km +=  $total_km;
			
			if($ignicao == 0){
				//Inicio da logica para montar os retornos
				if($iniciado == true){
					if($ignicao != $parada){
						$parada = 0;
						
						$temp_data_final  = $data;
						$temp_end_final = $address;
						$temp_hod_final = $total_km;
						$velocidade_media = round($velocidade_soma/$velocidades,2);
						//Printar uma Linha, e resetar as temporarias
						$km_percurso = $temp_hod_final - $temp_hod_inicial;
						$km_percurso = round($km_percurso, 2);
						
						if($km_percurso == 0){
							continue;
						}
						
						$diferenca = strtotime($temp_data_final) - strtotime($temp_data_inicial);
						$dias = floor($diferenca / (60 * 60 * 24));


						$data_ini  = $temp_data_final;
						$data_end  = $temp_data_inicial;

						$dif = strtotime($data_end) - strtotime($data_ini);



						$date_time  = new DateTime($temp_data_inicial);
						$diff       = $date_time->diff( new DateTime($temp_data_final));
						$horas = $diff->format('%H horas(s), %i minutos');
						
						$data_format_inicial = date('d/m/Y H:i:s', strtotime($temp_data_inicial)); 
						$data_format_final = date('d/m/Y H:i:s', strtotime($temp_data_final)); 
						
						$data_inicial_vel = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($temp_data_inicial)));
						$data_final_vel = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($temp_data_final)));
						$cons_speed = mysqli_query($conn,"SELECT * FROM tc_positions WHERE deviceid='$deviceid' AND (servertime >= '$data_inicial_vel' AND servertime <= '$data_final_vel') ORDER BY speed DESC LIMIT 1");
							if(mysqli_num_rows($cons_speed) > 0){
						while ($resp_speed = mysqli_fetch_assoc($cons_speed)) {
						$vel_maxima = 	$resp_speed['speed'];
						$vel_maxima = $vel_maxima * 1.609;
						$vel_maxima = round($vel_maxima, 2);
							}}
						
						?>								
									
									 <div class="card border-dark bg-transparent" style="border-left-color:#000; border-bottom:#000 1px solid; border-top:#000 1px solid; border-right:#000 1px solid">
									 <div class="form-group">
										<div class="row">
											<div class="col-md-3">
												<label><b>Data Inicial</b></label><br>
												<i class="far fa-clock"></i> <?php echo $data_format_inicial?>
											</div>
											<div class="col-md-7">
												<label><b>Endereço Inicial</b></label><br>
												<i class="fas fa-map-marker-alt"></i> <?php echo $temp_end_inicial?>
											</div>
											<div class="col-md-2 text-right">
												<p>													
												<a href="#" onclick="window.open('http://rastreiamaisbrasil.com.br/tracker3/manager/mapa_rel1.php?data_inicial=<?php echo $temp_data_inicial?>&data_final=<?php echo $temp_data_final?>&deviceid=<?php echo $deviceid?>','Janela', width='900',height='900'); return false;"><button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#mapa"><b><i class="fas fa-route"></i> Visualizar Percurso</b></button></a> 	
													
												</p>
											 </div>
										</div><br>
										<div class="row">
											<div class="col-md-3">
												<label><b>Data Final</b></label><br>
												<i class="far fa-clock"></i> <?php echo $data_format_final?>
											</div>
											<div class="col-md-7">
												<label><b>Endereço Final</b></label><br>
												<i class="fas fa-map-marker-alt"></i> <?php echo $temp_end_final?>
											</div>
										</div>
										<hr>
										<div class="row">
											<div class="col-md-3">
												<label><b>Distância Total:</b></label><br>
												<i class="fas fa-road"></i> <?php echo $km_percurso?> km rodados
											</div>
											<div class="col-md-3">
												<label><b>Tempo Percurso:</b></label><br>
												<i class="fas fa-history"></i> <?php echo $horas?>
											</div>
											<div class="col-md-3">
												<label><b>Velocidade Média:</b></label><br>
												<i class="fas fa-tachometer-alt"></i> <?php echo $velocidade_media?> km/h
											</div>
											<div class="col-md-3">
												<label><b>Velocidade Máxima:</b></label><br>
												<i class="fas fa-tachometer-alt"></i> <?php echo $vel_maxima?> km/h
											</div>
										 </div>
										</div>
										</div>
										<br>
									
									<?php
									
									
									
						$velocidades = 0;
						$velocidade_soma = 0;
						$velocidade_media = 0;
						$temp_hod_final = 0;
						$temp_hod_inicial = 0;
						$temp_km = 0;
					};
				};
				$ign = '<font color="#006600"><b>LIGADO</b></font>';
			} else {
				if($iniciado == false){
					//Primeiro load
					$iniciado = true;
					$temp_data_inicial  = $data;
					$temp_end_inicial = $address;
					$temp_hod_inicial = $total_km;

				}else{
					if($ignicao != $parada){
						//Mudanca para um novo
						$temp_data_inicial  = $data;
						$temp_end_inicial = $address;
						$temp_hod_inicial = $total_km;
						$parada = 1;
					};
				};
				$ign = '<font color="#990000"><b>Desligado</b></font>';
			};
			
		
		};
	};
	/*$html_final .= '
					</tbody>
				</table>';*/
	//echo($html_final);
?>
				 

				 
					
                 
					 </div>
				 </div>
                                       
											
											
											
											
											
											

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
<script>
	var base64 = document.getElementById("base64").value;


function imprimir(){
window.open("http://rastreiamaisbrasil.com.br/tracker3/manager/imprimir_relatorio_viagens.php?c="+base64, "minhaJanela", "height=700,width=1000");
}
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
