<?php 
require_once "../../Clases/conexion.php";
require_once "../../Clases/categorias.php";

$obj= new categorias();
$lista=$obj->lista();
?>

<div class="table-responsive">
	<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
		<caption><label for="">Categorias</label>
		</caption>
		<thead>
			<tr>
				<th>ID</th>
				<th>Categoria</th>
				<th>Editar</th>
				<th>Eliminar</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$var=0;
			$longitud=sizeof($lista);
			while ( $var < $longitud):
				?>
				<tr>
					<td> <?php echo ($var+1); ?></td>
					<td><?php echo $lista[$var][1]; ?></td>

					<td>
						<span class="btn btn-warning btn-sm" data-toggle="modal" data-target="#actualizarCategoria" onclick="agregaDatos('<?php echo $lista[$var][0] ?>','<?php echo $lista[$var][1] ?>')"> 
							<span class="glyphicon glyphicon-pencil"></span>
						</span>
					</td>
					<td>
					
						<span class="btn btn-danger btn-sm" onclick="eliminarCategoria('<?php  echo $lista[$var][0]?>')">
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