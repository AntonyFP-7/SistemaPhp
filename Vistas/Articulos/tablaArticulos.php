<?php 
require_once "../../Clases/conexion.php";
require_once "../../Clases/articulos.php";
$obj= new articulos();
$lista=$obj->MostrarArticulos();
?>


<div class="table-responsive">
	<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
		<caption><label>Articulo</label>
		</caption>
		<thead>
			<tr>
				<th>ID</th>
				<th>Nombre</th>
				<th>Descripcion</th>
				<th>Cantidad</th>
				<th>Precio</th>
				<th>Categoria</th>
				<th>Imagen</th>
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
					<td><?php echo  $lista[$var][0];?></td>
					<td><?php echo $lista[$var][1]; ?></td>
					<td><?php echo $lista[$var][2]; ?></td>
					<td><?php echo $lista[$var][3]; ?></td>
					<td><?php echo $lista[$var][4]; ?></td>
					<td>
						<?php 
				#$verImg=explode("/",$lista[$var][5]);
				 #$imgRuta=$verImg[1]."/".$verImg[2]."/".$verImg[3];
				#<img  width="80" height="80" src="<?php echo $imgRuta

								$resultado=substr($lista[$var][5], 3);
								?>
								<img  width="80" height="80" src="<?php echo $resultado ?>"   alt="">

							</td>
							<td>
								<span data-toggle="modal" data-target="#actualizarArticulos" class="btn btn-warning btn-sm" onclick="agregarDatosArticulo('<?php echo $lista[$var][6]  ?>')"> 
									<span class="glyphicon glyphicon-pencil"></span>
								</span>
							</td>
							<td>
								<span class="btn btn-danger btn-sm" onclick="eliminarArticulo('<?php echo $lista[$var][6]  ?>')">
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