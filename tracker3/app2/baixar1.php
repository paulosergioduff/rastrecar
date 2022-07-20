
    

<?php

include_once('conexao.php');

$link_boleto = $_REQUEST['link'];





//header('Location: '.$url_pdf.'');
?>

<title><?php echo $link_boleto;?></title>
<body onload="atualiza()">
	
	<form name="forml">
	<input type="hidden" value="<?php echo $link_boleto?>" name="link_boleto" id="link_boleto">
	</form>
 <script>

  function atualiza(){

document.forml.action="baixar.php"
document.forml.method = 'POST';
document.forml.submit()
  }
  </script> 
  </body>