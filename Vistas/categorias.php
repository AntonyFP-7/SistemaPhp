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
		<title>Categorias</title>
		<?php require_once "menu.php"; ?>
		<link rel="stylesheet" href="">
	</head>
	<body>
		<div class="container">
			<h1>Categorias</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frm_categorias">
						<label>Categoria</label>
						<input type="text" class="form-control input-sm" name="categoria">
						<p></p>
						<span class="btn btn-primary" id="btn_agregarCategoria">Agregar</span>

					</form>
				</div>
				<div class="col-sm-6">
					<div id="tabla_categoria">
					</div>		
				</div>
			</div>
		</div>


		<!-- Modal -->
		<div class="modal fade" id="actualizarCategoria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Actualizar Categoria</h4>
					</div>
					<div class="modal-body">
						<form id="frm_actualizarCategoria">
							<input type="text" hidden="" id="idcategoria" name="idcategoria">
							<label>Categoria</label>
							<input class="form-control input-sm" type="text" id="categoriaA" name="categoriaA">
							<p></p>
						</form>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						<button type="button" id="btn_actualizarCategoria" class="btn btn-warning" data-dismiss="modal">Guardar Cambios</button>
					</div>
				</div>
			</div>
		</div>

		

	</body>
	</html>
	<script type="text/javascript">
		$(document).ready(function() {

			$('#tabla_categoria').load("Categorias/tablaCategorias.php");
			$("#btn_agregarCategoria").click(function() {
				vacios=ValidarFormularioVacio('frm_categorias');

				if (vacios > 0) {
					alertify.alert("Debes llenar todos los campos");

					return false;
				}
				/* Act on the event */
				datos=$('#frm_categorias').serialize();

				$.ajax({
					url: "../Procesos/Categorias/agregaCategorias.php",
					type: "POST",
					data: datos,
					success:function(r){
						if (r==1) {
					//para limpiar el formulario
					$('#frm_categorias')[0].reset();
					$('#tabla_categoria').load("Categorias/tablaCategorias.php");
					alertify.success("Categoria agregada con exito");

				}else{
					alertify.error(" no se puedo agregar Categoria");
				}
			}
		});


			});

		});


	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#btn_actualizarCategoria').click(function() {
				vacios=ValidarFormularioVacio('frm_actualizarCategoria');

				if (vacios > 0) {
					alertify.alert("Los campos no peuden estar vacios");

					return false;
				}
				/* Act on the event */
				datos=$('#frm_actualizarCategoria').serialize();
				$.ajax({
					url: '../Procesos/Categorias/actualizarCategoria.php',
					type: 'POST',
					data: datos,
					success:function(r){
						if (r==1) {
					//para limpiar el formulario
					
					$('#tabla_categoria').load("Categorias/tablaCategorias.php");
					alertify.success("Categoria actualizada con exito");

				}else{
					alertify.error(" no se puedo actualizar Categoria");
				}
			}
		})
				
			});
			
		});


	</script>
	<script type="text/javascript">
		function agregaDatos(idCategoria,categoria){
			$('#idcategoria').val(idCategoria);
			$('#categoriaA').val(categoria);
		}
		function eliminarCategoria(idCategoria){

			alertify.confirm('¿Desea Eliminar Esta Categoria?', function(){ 
				$.ajax({
					url: '../Procesos/Categorias/eliminarCategoria.php',
					type:'POST',
					data:"idcategoria="+idCategoria ,
					success:function(r){
						if (r==1) {
							$('#tabla_categoria').load("Categorias/tablaCategorias.php");
							alertify.success("Categoria Eliminada con exito");

						}else{
							alertify.error(" no se puedo eliminar Categoria");
						}
					}
				});	

			}, function(){ alertify.error('Cancelado')
		});
		}



	</script>
	<?php 
}else{
	header("location:../index.php");
}

?>