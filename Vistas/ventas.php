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
	<title>Ventas</title>
	<?php require_once "menu.php"; ?>
	<link rel="stylesheet" href="">
</head>
<body>
	<div class="container">
		<h1>Venta de Productos</h1>
		<div class="row">
			<div class="col.sm-12">
				<span id="btn_ventaProductos" class="btn btn-default">Vender Productos</span>
				<span id="btn_ventasRealizada" class="btn btn-default">Ventas Realizadas</span>
				
			</div>
			
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div id="ventaProductos"></div>
				<div id="ventasRealizadas"></div>
				
			</div>
		</div>
	</div>
           
</body>
</html>

<script type="text/javascript">
	$(document).ready(function() {
		$('#btn_ventaProductos').click(function() {
			/* Act on the event */
			esconderSeccionVentas();
			$('#ventaProductos').load("Ventas/ventaProductos.php");
			$('#ventaProductos').show();
		});
		$('#btn_ventasRealizada').click(function() {
			/* Act on the event */
			esconderSeccionVentas();
			$('#ventasRealizadas').load("Ventas/ventasRealizadas.php");
			$('#ventasRealizadas').show();
		});
	});
function esconderSeccionVentas(){
	$('#ventaProductos').hide();
	$('#ventasRealizadas').hide();

}
</script>
<?php 
}else{
	header("location:../index.php");
}

 ?>