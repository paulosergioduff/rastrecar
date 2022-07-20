  <?php

include_once('conexao.php');

$id_empresa = '1361';
$texto_rodape = 	$_POST['texto_rodape'];
$texto_topo = 	$_POST['texto_topo'];
$cor_sistema = 	$_POST['cor_sistema'];
$limite_veiculos = 	$_POST['limite_veiculos'];
$valor_placa = 	$_POST['valor_placa'];
$status_revenda = 	$_POST['status_revenda'];
$nome_url = 	$_POST['nome_url'];
$usuario = 	$_POST['usuario'];
$senha1 = 	$_POST['senha'];
$senha = 	md5($senha1);





$sql_empresa = mysqli_query($conn,"UPDATE dados_empresa SET nome_url='$nome_url', cor_sistema='$cor_sistema', texto_rodape='$texto_rodape', texto_topo='$texto_topo' WHERE id_empresa='$id_empresa'");










$arquivo 	= $_FILES['arquivo']['name'];
			
			//Pasta onde o arquivo vai ser salvo
			$_UP['pasta'] = 'logos/';
			
			//Tamanho máximo do arquivo em Bytes
			$_UP['tamanho'] = 1024*1024*100; //5mb
			
			//Array com a extensões permitidas
			$_UP['extensoes'] = array('png', 'jpg', 'jpeg', 'gif');
			
			//Renomeiar
			$_UP['renomeia'] = false;
			
			//Array com os tipos de erros de upload do PHP
			$_UP['erros'][0] = 'Não houve erro';
			$_UP['erros'][1] = 'O arquivo no upload é maior que o limite do PHP';
			$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especificado no HTML';
			$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
			$_UP['erros'][4] = 'Não foi feito o upload do arquivo';
			
			//Verifica se houve algum erro com o upload. Sem sim, exibe a mensagem do erro
			if($_FILES['arquivo']['error'] != 0){
				die("Não foi possivel fazer o upload, erro: <br />". $_UP['erros'][$_FILES['arquivo']['error']]);
				exit; //Para a execução do script
			}
			
			//Faz a verificação da extensao do arquivo
			$extensao = strtolower(end(explode('.', $_FILES['arquivo']['name'])));
			if(array_search($extensao, $_UP['extensoes'])=== false){		
				echo "
										<script type=\"text/javascript\">
						alert(\"A imagem não foi cadastrada extesão inválida.\");
					</script>
				";
			}
			
			//Faz a verificação do tamanho do arquivo
			else if ($_UP['tamanho'] < $_FILES['arquivo']['size']){
				echo "
					<script type=\"text/javascript\">
						alert(\"Arquivo muito grande.\");
					</script>
				";
			}
			
			//O arquivo passou em todas as verificações, hora de tentar move-lo para a pasta foto
			else{
				//Primeiro verifica se deve trocar o nome do arquivo
				if($UP['renomeia'] == true){
					//Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
					$nome_final = time().'.jpg';
				}else{
					//mantem o nome original do arquivo
					$nome_final = $_FILES['arquivo']['name'];
					$nome_final = date('YmdHms').'-'.$id_empresa.'.'.$extensao;
				}
				//Verificar se é possivel mover o arquivo para a pasta escolhida
				if(move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta']. $nome_final)){
					//Upload efetuado com sucesso, exibe a mensagem
								
					
					






$query1 =  mysqli_query($conn,"UPDATE dados_empresa SET logo='$nome_final', cor_sistema='$cor_sistema', nome_url='$nome_url' WHERE id_empresa='$id_empresa'");





				}else{
					//Upload não efetuado com sucesso, exibe a mensagem
					echo "
						<script type=\"text/javascript\">
							alert(\"Erro na foto. Favor repetir o cadastro.\");window.location.href='meus_dados.php';;
						</script>
					";
				}
			}





?>
