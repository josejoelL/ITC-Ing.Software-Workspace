<?php 

require "send_email.php";
require 'db.php';
ob_start();
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

	$email = $mysqli->escape_string($_POST['email']);

	$result = $mysqli->query("SELECT * FROM usuarios WHERE email = '$email'");

	if($result->num_rows === 0){
		$_SESSION['message'] = "El usuario con ese correo no fue encontrado!";
		header('Location: error.php');
		exit();
	}else{
		$user = $result->fetch_assoc();

		$email = $user['email'];
		$hash  = $user['hash'];
		$nombre = $user['nombre'];

		$_SESSION['message'] = 'Por favor revisa tu correo <strong>'.$email.'</strong>'
		. ' por un link de confirmación para completar el cambio de contraseña!';

		$para_usuario = $email;
		$subject = 'Cambiar password (codigomentor.com)';
		$message_body = '
		Hola '.$nombre.',
		<br/>Has pedido un cambio de contraseña!
		Por favor hacer click en el link para cambiar tu contraseña

		http://localhost/php/login/reset.php?email='.$email.'&hash='.$hash;

		sendEmail($para_usuario, $subject, $message_body);
		header('Location: success.php');
		exit();
	}

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Recupera tu contraseña</title>
	<?php include 'css/css.html'; ?>
</head>
<body>

	<div class="form">
		
		<h1>Recupera tu contraseña</h1>

		<form action="forgot.php" method = "post">
			<div>
             <input class="form-control" type="email" placeholder= "Ingresa tu correo" required autocomplete="off" name="email"/>			
			</div>
			<br/>
			<button class="button button-block"/>Enviar</button>
		</form>

	</div>
	
</body>
</html>