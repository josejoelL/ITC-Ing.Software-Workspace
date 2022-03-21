<?php 

$email = $mysqli->escape_string($_POST['email']);
$result = $mysqli->query("SELECT * FROM usuarios WHERE email = '$email'");

if($result->num_rows === 0){
    $_SESSION['message'] = 'No existe alguna cuenta registrada con ese correo!';
    header("Location: error.php");
    exit();
}else{
	$user = $result->fetch_assoc();

	if(password_verify($_POST['password'], $user['password'])){
			$_SESSION['email']    = $user['email'];	
			$_SESSION['nombre']	  = $user['nombre'];
			$_SESSION['apellido'] = $user['apellido'];

			$_SESSION['logged_in'] = true;
			header("Location: perfil.php");
			exit();
	}else{
		$_SESSION['message'] = 'La contraseña es incorrecta!';
		header("Location: error.php");
		exit();
	}	
}

?>