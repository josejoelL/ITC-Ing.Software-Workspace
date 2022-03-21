<?php

require "db.php";
session_start();

if (isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']) ) {

 	$email = $mysqli->escape_string($_GET['email']);
 	$hash = $mysqli->escape_string($_GET['hash']);

 	$result = $mysqli->query("SELECT * FROM usuarios WHERE email = '$email'  AND hash = '$hash' AND activo = '0'");

 	if($result->num_rows === 0){
 		$_SESSION['message'] = 'Tu cuenta ya fue activada o la URL es incorrecta';
 		header('Location : error.php');
 		exit();

 	}else{
 		$mysqli->query("UPDATE usuarios SET activo = '1' WHERE email = '$email'") or die($mysqli->error);
 		$_SESSION['message'] = 'Tu cuenta ha sido actualizada';
 		header('Location : success.php');
 		exit();

 	}

 } else{
 	$_SESSION['message'] = 'La URL contiene informacion incorrecta';
 	header('Location : error.php');
 	exit();
 	
 }



?>