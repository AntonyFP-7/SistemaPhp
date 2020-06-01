<?php 
require_once "../../Clases/conexion.php";
require_once "../../Clases/clientes.php";

$obj=new clientes();

$lista=$obj->MostrarClientes();
?>

<div class="table-responsive">
	<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
		<caption><label>Clientes</label></caption>
		<thead>
			<tr>
				<th>ID</th>
				<th>Nombre</th>
				<th>Aplellidos</th>
				<th>Direccion</th>
				<th>Correo</th>
				<th>Telefono</th>
				<th>RFC</th>
				<th>Editar</th>
				<th>Eliminar</th>

			</tr>
		</thead>
		<tbody>
			<?php 
			$var=0;
			$longitud=sizeof($lista);
			while ( $var < $longitud):
				# code..

				?>
				<tr>
					<td><?php echo ($var+1); ?></td>
					<td><?php echo $lista[$var][1]; ?></td>
					<td><?php echo $lista[$var][2]; ?></td>
					<td><?php echo $lista[$var][3]; ?></td>
					<td><?php echo $lista[$var][4]; ?></td>
					<td><?php echo $lista[$var][5]; ?></td>
					<td><?php echo $lista[$var][6]; ?></td>
					<td>
						<span class="btn btn-warning btn-sm" onclick="OptenerDatosCliente('<?php echo $lista[$var][0]; ?>')" data-toggle="modal" data-target="#actualizarCliente">
							<span class="glyphicon glyphicon-pencil"></span>
						</span>
					</td>
					<td>
						<span class="btn btn-danger btn-sm" onclick="EliminarCliente('<?php echo $lista[$var][0]; ?>')">
							<span class="glyphicon glyphicon-remove"></span>
						</span>
					</td>
				</tr>
				<?php 
				$var++;
			endwhile;

			?>
		</tbody>
	</table>
</div>