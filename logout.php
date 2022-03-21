<?php 

	session_start();
	session_unset();
	session_destroy();





?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Logout</title>
	<?php include 'css/css.html';?>
</head>
<body>
	<div class="form">
		
		<h1> Haz cerrado tu sesion </h1>
		<a href="index.php "><button class="button button-block">HOME</button></a>
	</div>

</body>
</html>