<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Success</title>
	 <?php include 'css/css.html'; ?>
</head>
<body>
<div class="form">
	<h1>Success</h1>
	<p>
	<?php 
		if(isset($_SESSION['message']) AND !empty($_SESSION['message'])){
			echo "<p class = 'alert alert-success'>".$_SESSION['message']."</p>";
		}else{
			header("Location: index.php");
			exit();
		}
	?>
	</p>
	<a href="index.php"><button class="button button-block"/>HOME</button></a>

</div>
	
</body>
</html>