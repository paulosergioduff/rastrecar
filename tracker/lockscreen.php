<?php
session_start();
if(!empty($_SESSION['usuarioNome'])){
}else{
	
	header("Location: index.php");	
}

include_once("config.php");

$user = $_GET['user'];

$cons_user = mysqli_query($conn,"SELECT * FROM usuarios WHERE id_usuarios='$user' ");
	if(mysqli_num_rows($cons_user) > 0){
while ($resp_user = mysqli_fetch_assoc($cons_user)) {
$nome_user = 	$resp_user['nome'];
$email_user = 	$resp_user['email'];
$usuario = 	$resp_user['usuario'];

	}}
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MOBI DRIVE | Sistema de Gestão</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="gray-bg" >


    <div class="middle-box text-center lockscreen animated fadeInDown">
        <div>
            <div class="m-b-md">
            <img alt="image" class="rounded-circle circle-border" src="Imagens/logo22.jpg" width="128" height="128">
            </div>
            <h2>SISTEMA BLOQUEADO</h2><br>
			<h3><?php echo $nome_user?></h3>
            <p>O sistema foi bloqueado por inatividade. Para retornar, digite sua senha.</p>
            <form class="m-t" role="form" action="entra.php" method="post">
                <div class="form-group">
                    <input autofocus  type="password" name="senha" id="senha" class="form-control" placeholder="******" required>
					 <input type="hidden" name="usuario" id="usuario" class="form-control" value="<?php echo $usuario?>">
                </div>
                <button type="submit" class="btn btn-primary block full-width">Desbloquear</button><br><br>
				<a href="index.php"><button type="button" class="btn btn-success block full-width">Outra Conta</button></a>
            </form>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>

</body>

</html>
