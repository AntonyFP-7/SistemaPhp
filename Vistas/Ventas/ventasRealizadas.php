<?php 
require_once "../../Clases/conexion.php";
require_once "../../Clases/ventas.php";

$obj=new ventas;
$lista=$obj->MostarVentas();


?>
<h4>Reportes y Ventas</h4>
<div class="row">
	<div class="col-sm-1"></div>
	<div class="col-sm-10">
		<div class="table-responsive">
			<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
				<caption><label>Ventas Relaizadas</label></caption>
				<thead>

					<tr>
						<th>Folio</th>
						<th>Fecha</th>
						<th>Cliente</th>
						<th>Total de Compra</th>
						<th>Ticket</th>
						<th>Reporte</th>

					</tr>
				</thead>
				<tbody>
					<?php 
					$var=0;
					$longitud=sizeof($lista);
					while ($var <$longitud) {
						# code...


						?>
						<tr>
							<td><?php echo $lista[$var][0] ; ?></td>
							<td><?php echo $lista[$var][1]; ?></td>
							<td><?php 
							$nombre=$obj->OptenerCliente($lista[$var][2]);
							if ($nombre[0]=="" or $nombre[1]== "") {
								echo "S/C";
								# code...
							}else{
								echo $nombre[0]." ".$nombre[1];

							}
							?></td>

							<td><?php $Total=$obj->ObtenerTotal($lista[$var][0]) ; 
							echo "$".$Total;

							?></td>
							<td>
								<a href="../Procesos/Ventas/crearTicked.php?idventa=<?php echo $lista[$var][0] ?>" class="btn btn-danger btn-sm" title="">Ticket <span class="glyphicon glyphicon-list-alt"></span>
								</a>

							</td>
							<td>
								<a href="../Procesos/Ventas/crearReportePDF.php?idventa=<?php echo $lista[$var][0] ?>"  class="btn btn-danger btn-sm" title="">Reporte <span class="glyphicon glyphicon-file"></span></a>
								
							</td>

						</tr>
						<?php 
						$var++;
					}

					?>
				</tbody>
			</table>
		</div>

	</div>

</div>