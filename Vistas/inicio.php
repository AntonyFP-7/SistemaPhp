<?php 
session_start();
if (isset($_SESSION['usuario'])) {
	# code...
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Inicio</title>
	<?php require_once "menu.php"; ?>
	<link rel="stylesheet" href="">
</head>
<body>
	
           
</body>
</html>
<?php 
}else{
	header("location:../index.php");
}

 ?>