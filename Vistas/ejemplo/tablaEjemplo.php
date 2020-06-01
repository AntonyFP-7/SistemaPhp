<?php 
require_once "../../Clases/conexion.php";
require_once "../../Clases/ejemplo.php";

$obj= new ejemplo();

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
			$long =sizeof($lista);

			while ($var < $long) {

			 ?>
		
				<tr>
					<td><?php echo ($var+1); ?></td>
					<td><?php echo $lista[$var][0]; ?></td>
					<td><?php echo $lista[$var][1]; ?></td>
					<td><?php echo $lista[$var][2]; ?></td>
					<td><?php echo $lista[$var][3]; ?></td>
					<td><?php echo $lista[$var][4]; ?></td>
					<td><?php echo $lista[$var][5]; ?></td>
					<td>
						<span class="btn btn-warning btn-sm" >
							<span class="glyphicon glyphicon-pencil"></span>
						</span>
					</td>
					<td>
						<span class="btn btn-danger btn-sm" >
							<span class="glyphicon glyphicon-remove"></span>
						</span>
					</td>
				</tr>
			<?php 
			$var++;
		}

			 ?>
		</tbody>
	</table>
</div>