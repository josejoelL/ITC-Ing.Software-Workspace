<?php

require 'db.php';
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

	if($_POST['nuevopassword'] === $_POST['confirmarpassword']){
		$nuevo_password = password_hash($_POST['nuevopassword'], PASSWORD_BCRYPT);
		$email = $mysqli->escape_string($_POST['email']);
		$hash = $mysqli->escape_string($_POST['hash']);

		$sql = "UPDATE usuarios SET password='$nuevo_password', hash='$hash' WHERE email='$email'";

		if($mysqli->query($sql)){
			$_SESSION['message'] = "Tu contraseña ha sido actualizada!";
            header("location: success.php");    
            exit(); 
		}
	}else{
		 $_SESSION['message'] = "Las dos contraseñas que ingresastes no coinciden!";
		    header("location: error.php"); 
            exit();  
	}
}


?>