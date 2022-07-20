
    

<?php

include_once('conexao.php');

$id_conta = $_REQUEST['id_conta'];

$cons_especie = mysqli_query($conn,"SELECT * FROM contas_receber WHERE id_conta='$id_conta'");
	if(mysqli_num_rows($cons_especie) > 0){
		while ($resp_especie = mysqli_fetch_assoc($cons_especie)) {
$link_boleto	 = 	$resp_especie['link_boleto'];
}}



//header('Location: '.$url_pdf.'');
?>

<title><?php echo $link_boleto;?></title>
<body onload="atualiza()">
	
	<form name="forml">
	<input type="hidden" value="<?php echo $id_conta?>" name="id_conta">
	</form>
 <script>

  function atualiza(){

document.forml.action="baixar.php"
document.forml.method = 'POST';
document.forml.submit()
  }
  </script> 
  </body>