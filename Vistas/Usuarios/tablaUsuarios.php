<?php 
require_once "../../Clases/conexion.php";
require_once "../../Clases/usuarios.php";

$obj=new usuarios();

$lista=$obj->MostarUsuarios();

?>
<div class="table-responsive">
	
	<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
		<caption><label>Usuarios</label></caption>
		<thead>
			<tr>
				<th>ID</th>
				<th>Nombre</th>
				<th>Aplellidos</th>
				<th>correo</th>
				<th>Usuario</th>
				<th>Editar</th>
				<th>Eliminar</th>

			</tr>
		</thead>
		<tbody>
			<?php 
			$var=0;
			$longitud=sizeof($lista);
			while ($var < $longitud ) {
				?>
				<tr>
					<td><?php echo ($var+1); ?></td>
					<td><?php echo $lista[$var][0]; ?></td>
					<td><?php echo $lista[$var][1]; ?></td>
					<td><?php echo $lista[$var][2]; ?></td>
					<td><?php echo $lista[$var][3]; ?></td>

					<td>
						<span class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ActualizarUsuario" onclick="TraerDatos('<?php  echo $lista[$var][4]?>')">
							<span class="glyphicon glyphicon-pencil"></span>
						</span>
					</td>
					<td>
						<span class="btn btn-danger btn-sm" onclick="EliminarUsuario('<?php  echo $lista[$var][4]?>')">
							<span class="glyphicon glyphicon-remove"></span>
						</span>
					</td>
				</tr>
				<?php 
				$var ++;
			}
			?>
		</tbody>
	</table>
</div>