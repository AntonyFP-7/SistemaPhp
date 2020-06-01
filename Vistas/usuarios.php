<?php 
session_start();
if (isset($_SESSION['usuario']) and $_SESSION['usuario']=='admin') {
	# code...
	?>

	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Usuarios</title>
		<?php require_once "menu.php"; ?>
		<link rel="stylesheet" href="">
	</head>
	<body>
		<div class="container">
			<h1>Administrar Usuarios</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frm_usuarios" method="POST">
						<label>Nombre</label>
						<input type="text"  class="form-control input-sm"name="nombre"   id="nombre">
						<label>Apellidos</label>
						<input type="text"  class="form-control input-sm" name="apellido"  id="apellido">
						<label>Correo</label>
						<input type="text"  class="form-control input-sm" name="correo" id="correo">
						<label>Usuario</label>
						<input type="text"  class="form-control input-sm"name="usuario" value="" id="usuario">
						<label>Contraseña</label>
						<input type="password"  class="form-control input-sm" name="contra" value="" id="contra">
						<p></p>
						<span id="btn_usuarios" class="btn btn-primary">Registar</span>
					</form>
				</div>

				<div class="col-sm-8">
					<div id="table_usuarios">

					</div>
				</div>
			</div>

		</div>


		<!-- Modal -->
		<div class="modal fade" id="ActualizarUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Actualizar Usuario</h4>
					</div>
					<div class="modal-body">
						<form id="frm_actualizarUsuarios" >
							<input type="" hidden="" name="idusuario" id="idusuario">
							<label>Nombre</label>
							<input type="text"  class="form-control input-sm"name="Anombre"   id="Anombre">
							<label>Apellidos</label>
							<input type="text"  class="form-control input-sm" name="Aapellido"  id="Aapellido">
							<label>Correo</label>
							<input type="text"  class="form-control input-sm" name="Acorreo" id="Acorreo">
							<label>Usuario</label>
							<input type="text"  class="form-control input-sm"name="Ausuario"  id="Ausuario">

						</form>
						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button id="btn_actualizarUsuario" type="button" class="btn btn-warning" data-dismiss="modal">Actualizar</button>

					</div>
				</div>
			</div>
		</div>

	</body>
	</html>
	<script type="text/javascript">
		function TraerDatos(idusuario){
			$.ajax({
				url: '../Procesos/RegLogin/mostarUsuarios.php',
				type: 'POST',
				data: 'idusuario='+ idusuario,
				success:function(r){
					//alert(r);
					$datos=jQuery.parseJSON(r);
					$('#idusuario').val($datos['idusuario']);
					$('#Anombre').val($datos['nombre']);
					$('#Aapellido').val($datos['apellidos']);
					$('#Acorreo').val($datos['correo']);
					$('#Ausuario').val($datos['usuario']);

				}

			});

		}

		function EliminarUsuario(idusuario){
			alertify.confirm('Confirm Message', function(){
				$.ajax({
					url: '../Procesos/RegLogin/eliminarUsuario.php',
					type: 'POST',
					data: 'idusuario='+ idusuario,
					success:function(r){
						//alert(r);
						if(r==1){
							$('#table_usuarios').load("Usuarios/tablaUsuarios.php");
							/* para cada vez q aya una insercion se recargue la tabla */
							alertify.success("Usuario eliminado correctamente");
						}else{
							alertify.error("Error al eliminar usuario ");
						}

					}

				});
			}, function(){ alertify.error('Cancelado')});


		}
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#btn_actualizarUsuario').click(function(event) {
				/* Act on the event */
				vacios=ValidarFormularioVacio('frm_actualizarUsuarios');

				if (vacios > 0) {

					alertify.alert("Debe llenar todos los campos");
					return false;
				}

				datos=$('#frm_actualizarUsuarios').serialize();
				$.ajax({
					url: '../Procesos/RegLogin/actualizarUsuario.php',
					type: 'POST',
					data: datos,
					success:function(r){
						//alert(r);
						if(r==1){
							$('#table_usuarios').load("Usuarios/tablaUsuarios.php");
							/* para cada vez q aya una insercion se recargue la tabla */
							alertify.success("Usuario actualizado correctamente");
						}else{
							alertify.error("Error al actualizar usuario ");
						}

					}

				});			
				
			});
		});
	</script>



	<script type="text/javascript">
		$(document).ready(function() {
			$('#table_usuarios').load("Usuarios/tablaUsuarios.php");
			$('#btn_usuarios').click(function() {

				vacios=ValidarFormularioVacio('frm_usuarios');

				if (vacios > 0) {

					alertify.alert("Debe llenar todos los campos");
					return false;
				}

				datos=$('#frm_usuarios').serialize();
				$.ajax({
					url: '../Procesos/RegLogin/registrarUsuario.php',
					type: 'POST',
					data: datos,
					success:function(r){
						//alert(r);
						if(r==1){
							$('#table_usuarios').load("Usuarios/tablaUsuarios.php");
							/* para cada vez q aya una insercion se recargue la tabla */
							alertify.success("Usuario agregado correctamente");
						}else{
							alertify.error("Error al registrar usuario ");
						}

					}
				})



			});
		});

	</script>


	<?php 
}else{
	header("location:../index.php");
}

?>