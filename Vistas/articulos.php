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
		<title>Articulos</title>
		<?php 
		require_once "menu.php";
		require_once "../Clases/conexion.php";
		require_once "../Clases/categorias.php";

		$obj= new categorias();
		$lista=$obj->lista();


		?>
		<link rel="stylesheet" href="">
	</head>
	<body>
		<div class="container">
			<h1>Articulos</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frm_articulos" enctype="multipart/form-data"> 
						<!--para poder enviar archivos -->
						<label>Categorias</label>

						<select class="form-control input-sm" name="categoriaSelect" id="categoriaSelect">
							<option value="A">Selecciona Categoria</option>	
							<?php
							$var=0;
							$longitud=sizeof($lista);
							while ( $var < $longitud):

								?>	
								<option value="<?php echo $lista[$var][0]; ?>"><?php echo  $lista[$var][1]; ?></option>

								<?php
								$var++;
							endwhile; ?>

						</select>

						<label>Nombre</label>
						<input type="text"  class="form-control input-sm" name="nombre" id="nombre">
						<label>Descripcion</label>
						<input type="text" class="form-control input-sm"  name="descripcion" id="descripcion">
						<label>Cantidad</label>
						<input type="number"  class="form-control input-sm" name="cantidad" id="cantidad">
						<label>	Precio</label>
						<input type="number"  class="form-control input-sm" name="precio" id="precio">
						<label>Imagen</label>
						<input type="file"  name="imagen" id="imagen">
						<p></p>
						<span id="btnAgregarArticulo" class="btn btn-primary ">Agregar</span> 
					</form>
				</div>
				<div class="col-sm-8">
					<div id="tablaArticulos">

					</div>
				</div>

			</div>

		</div>

		<!-- Modal -->
		<div class="modal fade" id="actualizarArticulos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Actualizar Articulo</h4>
					</div>
					<div class="modal-body">
						<form id="frm_actualizarArticulos"> 
							<!--para poder enviar archivos -->
							<input type="" hidden=""  id="idarticulo" name="idarticulo">
							<label>Categorias</label>


							<select class="form-control input-sm" name="AcategoriaSelect" id="AcategoriaSelect">
								<option value="A">Selecciona Categoria</option>	
								<?php
								$var=0;
								$longitud=sizeof($lista);
								while ( $var < $longitud):

									?>	
									<option value="<?php echo $lista[$var][0]; ?>"><?php echo  $lista[$var][1]; ?></option>

									<?php
									$var++;
								endwhile; ?>

							</select>

							<label>Nombre</label>
							<input type="text"  class="form-control input-sm" name="Anombre" id="Anombre">
							<label>Descripcion</label>
							<input type="text" class="form-control input-sm"  name="Adescripcion" id="Adescripcion">
							<label>Cantidad</label>
							<input type="number"  class="form-control input-sm" name="Acantidad" id="Acantidad">
							<label>	Precio</label>
							<input type="number"  class="form-control input-sm" name="Aprecio" id="Aprecio">

						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
						<button id="btn_actualizarArticulo" type="button" class="btn btn-warning" data-dismiss="modal">Actualizar</button>

					</div>
				</div>
			</div>
		</div>

	</body>
	</html>

	<script type="text/javascript">		
		function agregarDatosArticulo(idarticulo){
			$.ajax({
				url: '../Procesos/Articulos/optenerArticulo.php',
				type: 'POST',
				data: 'idarticulo='+idarticulo,
				success:function(r){
				//alert(r);
				dato=jQuery.parseJSON(r);
				$('#idarticulo').val(dato['idarticulo']);
				$('#Anombre').val(dato['nombre']);
				$('#Adescripcion').val(dato['descripcion']);
				$('#Acantidad').val(dato['cantidad']);
				$('#Aprecio').val(dato['precio']);
				$('#AcategoriaSelect').val(dato['idcategoria']);
			}
		});
		}

		function eliminarArticulo(articulo){

			alertify.confirm('¿Desea Eliminar este Articulo?', function(){ 

				$.ajax({
					url: '../Procesos/Articulos/eliminarArticulo.php',
					type: 'POST',
					data: 'articulo=' + articulo,
					success:function(r){
						//alert(r);
						if (r == 1) {
							$('#tablaArticulos').load("Articulos/tablaArticulos.php");
							alertify.success("Articulo Eliminado");
						}else{
							alertify.error("Articulo no eliminado");
						}
					}
				});

			},function(){ alertify.error('Cancelado')


		});

		}
	</script>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#btn_actualizarArticulo').click(function(event) {
				/* Act on the event */
				vacios=ValidarFormularioVacio('frm_actualizarArticulos');
				if (vacios > 0) {
					alertify.alert("Debe Llenar todos los campos"
						);
					return false;
				}
				datos=$('#frm_actualizarArticulos').serialize();

				$.ajax({
					url: '../Procesos/Articulos/actualizarArticulos.php',
					type: 'POST',
					data: datos,
					success:function(r){
						if (r == 1) {
							$('#tablaArticulos').load("Articulos/tablaArticulos.php");
							alertify.success("Articulo actualizado correctamente");
						}else{
							alertify.error("Articulo no actualizado");
						}

					}
				});
				

			});
		});
	</script>
	
	<script type="text/javascript">
		$(document).ready(function() {
			$('#tablaArticulos').load("Articulos/tablaArticulos.php");
			$("#btnAgregarArticulo").click(function() {

				vacios=ValidarFormularioVacio('frm_articulos');
				if (vacios > 0) {
					alertify.alert("Debe Llenar todos los campos"
						);
					return false;
				}

	//datos=$('#frm_articulos').serialize();
	var frmdatos= new FormData(document.getElementById("frm_articulos"));

	$.ajax({
		url: '../Procesos/Articulos/agregarArticulos.php',
		type: 'POST',
		dataType:'html',
		data: frmdatos,
		cache: false,
		contentType:false,
		processData:false,

		success:function(r){
			//alert(r);
			if (r == 1) {
				$('#frm_articulos')[0].reset();
				$('#tablaArticulos').load("Articulos/tablaArticulos.php");
				alertify.success("Articulo agregado correctamente");
			}else{
				alertify.error("Articulo no agregado");
			}
		}
	});	

});

		});

	</script>

	<?php 
}else{
	header("location:../index.php");
}

?>