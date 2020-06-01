<?php 
session_start();

#print_r($_SESSION['tablaComprasTem']);
$total=0; //esta variable tendra el total de al compra
$cliente="";
if (isset($_SESSION['tablaComprasTem'])): 

	?>


	<h4>Hacer Venta</h4>

	<h4><strong><div id="nombreClienteVenta"></div></strong></h4>
	<div class="table-responsive">

		<table class="table table-bordered table-hover table-condensed" style="text-align: center;">
			<caption>
				<span class="btn btn-success" onclick="CrearVenta()">Generar Venta

					<span class="glyphicon glyphicon-usd"></span>
				</span>

			</caption>
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Descripcion</th>
					<th>Precio</th>
					<th>Cantidad</th>
					<th>Quitar</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				
 			# code...
				foreach (@$_SESSION['tablaComprasTem'] as $key) {
					$i=0;
 				# code...
					$dato=explode("||", @$key)

					?>

					<tr>
						<td><?php echo $dato[1]; ?></td>
						<td><?php echo $dato[2]; ?></td>
						<td><?php echo $dato[3]; ?></td>
						<td><?php echo 1; ?></td>
						<td>
							<span class="btn btn-danger btn-xs" onclick="QuitarProducto('<?php echo $i;?>')">
								<span class="glyphicon glyphicon-remove"></span>
							</span>
						</td>
					</tr>

					<?php 
					$total=$total+$dato[3];
					$i++;
					$cliente=$dato[4];
				}
			endif;
			?>
		</tbody>
		<tr>
			<td>Total de venta: <?php echo "$".$total; ?></td>
		</tr>
	</table>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		nombre="<?php echo @$cliente; ?>";
		$('#nombreClienteVenta').text("Nombre de cliente: "+nombre);
	});
</script>
