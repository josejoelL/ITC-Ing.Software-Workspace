<?php
require "db.php";
ob_start();
session_start();

if($_SESSION['logged_in'] !== true){
	header("Location: index.php");
	exit();
}else{
	$nombre   = $_SESSION['nombre'];
	$apellido = $_SESSION['apellido'];
	$email    = $_SESSION['email'];

	$result = $mysqli->query("SELECT * FROM usuarios WHERE email = '$email'");

	if($result->num_rows === 0){
		unset($_SESSION['logged_in']);
		$_SESSION['message'] = 'Debes iniciar sesión antes de ver tu página de perfil!';
		header("Location: error.php");
		exit();
	}else{
		$user = $result->fetch_assoc();
		$activo = $user['activo'];
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Bienvenido <?= $nombre. ' '. $apellido ?></title>
	 <?php include 'css/css.html'; ?>
</head>
<body>
	<div class="form">
	<?php
		if(!$activo){
		  echo "<div class = 'alert alert-info'>
			   Tu cuenta fue creada! Te acabamos de enviar un correo, por favor confirma tu cuenta
               haciendo click en el link enviado. 
		  </div>";
		}else{
			echo '<h1>Bienvenido</h1>';
			echo '<h2>'.$nombre. ' '.$apellido.'</h2>';
		}

	?>
	<a href="logout.php"><button class = "button button-block" name = "logout">LOG OUT</button></a>
	</div>
	
</body>
</html>