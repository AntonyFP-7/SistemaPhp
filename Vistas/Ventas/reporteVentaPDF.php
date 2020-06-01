<?php 
require_once "../../Clases/conexion.php";
require_once "../../Clases/ventas.php";
$obj= new ventas();
$ideventas=$_GET['id'];
$total=0;

$lista=$obj->DatosReporte($ideventas);

$nombrecliente=$lista[0][2]." ".$lista[0][3];


echo ".";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Reporte de Ventas</title>
	<link rel="stylesheet" type="text/css" href="../../Librerias/bootstrap/css/bootstrap.css">
</head>
<body>
	<img src="../../Img/carrito-de-la-compra.jpg" width="200" height="200" alt="">
	<br>
	<table class="table">
		<caption></caption>
		<thead>
			<tr>
				<th>Fecha: <?php echo $lista[0][1]; ?></th>
			</tr>
			<tr>
				<th>Folio <?php echo $lista[0][0]; ?></th>
			</tr>
		</thead>

	</table>
	<p>Cliente: <?php echo $nombrecliente; ?></p>
	<table class="table">
		<caption></caption>
		<thead>
			<tr>
				<br>
				<th>Nombre Producto</th>
				<th>Precio</th>
				<th>Cantidad</th>
				<th>descripcion</th>
				<br><br><br><br><br>
			</tr>
		</thead>
		<tbody>

			<?php 
			$var=0;
			$longitud=sizeof($lista);
			while ( $var< $longitud) {
				?>
				<tr>
					<td><?php echo $lista[$var][4]; ?></td>
					<td><?php echo $lista[$var][5]; ?></td>
					<td><?php echo 1; ?></td>
					<td><?php echo $lista[$var][6]; ?></td>
				</tr>
				<?php
				$total= $total+$lista[$var][5];

				$var++; 
			}

			?>

		</tbody>
		<tr>
			<td> Total= <?php  echo $total; ?></td>
		</tr>
	</table>

</body>
</html>