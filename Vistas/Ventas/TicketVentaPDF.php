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
	<title>Ticked de Ventas</title>
	<style type="text/css" >
		@page{
			margin-top: 0.3em;
			margin-left: 0.6em;

		}
		body{
			font-size: xx-small;
		}
	</style>
	
</head>
<body>
	
	<p>Ticked de venta</p>
	<p>
		Fecha: <?php echo $lista[0][1]; ?>
	</p>
	<p> 
		Folio <?php echo $lista[0][0]; ?>
	</p>
	<p> 		
		Cliente: <?php echo $nombrecliente; ?>

	</p>
	
	<table>
		<caption></caption>
		<thead>
			<tr>
				
				<th>Nombre Producto</th>
				<th>Precio</th>
				<th>Cantidad</th>

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