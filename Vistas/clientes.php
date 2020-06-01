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
		<title>Clientes</title>
		<?php require_once "menu.php"; ?>
		<link rel="stylesheet" href="">
	</head>
	<body>
		<div class="container">
			<h1>Clientes</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frm_clientes" method="POST">
						<label>Nombre</label>
						<input type="text"  class="form-control input-sm"name="nombre"   id="nombre">
						<label>Apellidos</label>
						<input type="text"  class="form-control input-sm" name="apellido"  id="apellido">
						<label>Direccion</label>
						<input type="text"  class="form-control input-sm" name="direccion" id="direccion">
						<label>Correo</label>
						<input type="text"  class="form-control input-sm" name="correo" id="correo">
						<label>Telefono</label>
						<input type="number"  class="form-control input-sm"name="telefono" value="" id="telefono">
						<label>RFC</label>
						<input type="text"  class="form-control input-sm" name="rfc" id="rfc">

						<p></p>
						<span id="btn_clientes" class="btn btn-primary">Registar</span>
					</form>
				</div>

				<div class="col-sm-8">
					<div id="table_clientes">

					</div>
				</div>
			</div>

		</div>


		<!-- Modal -->
		<div class="modal fade" id="actualizarCliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Actualizar Cliente </h4>
					</div>
					<div class="modal-body">
						<form id="frm_actualizarcliente">
							<input type="text" hidden="" name="idcliente"   id="idcliente">
							<label>Nombre</label>
							<input type="text"  class="form-control input-sm"name="Anombre"   id="Anombre">
							<label>Apellidos</label>
							<input type="text"  class="form-control input-sm" name="Aapellido"  id="Aapellido">
							<label>Direccion</label>
							<input type="text"  class="form-control input-sm" name="Adireccion" id="Adireccion">
							<label>Correo</label>
							<input type="text"  class="form-control input-sm" name="Acorreo" id="Acorreo">
							<label>Telefono</label>
							<input type="number"  class="form-control input-sm"name="Atelefono" value="" id="Atelefono">
							<label>RFC</label>
							<input type="text"  class="form-control input-sm" name="Arfc" id="Arfc">

							<p></p>

						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button id="btn_actualizarCliente" type="button" class="btn btn-warning" data-dismiss="modal">Actualizar</button>

					</div>
				</div>
			</div>
		</body>
		</html>

		<script type="text/javascript">
			function OptenerDatosCliente(idcliente){
				$.ajax({
					url: '../Procesos/Clientes/optenerDatosCliente.php',
					type: 'POST',
					data: 'idcliente='+idcliente,
					success: function(r){
						//alert(r);
						$datos=jQuery.parseJSON(r);
						$('#idcliente').val($datos['idcliente']);
						$('#Anombre').val($datos['nombre']);
						$('#Aapellido').val($datos['apellidos']);
						$('#Adireccion').val($datos['direccion']);
						$('#Acorreo').val($datos['correo']);
						$('#Atelefono').val($datos['telefono']);
						$('#Arfc').val($datos['rft']);


					}
				});


			}
			function EliminarCliente(idcliente){

				alertify.confirm('¿Desea eliminar cliente?', function(){
					$.ajax({
						url: '../Procesos/Clientes/eliminarCliente.php',
						type: 'POST',
						data: 'idcliente='+idcliente,
						success:function(r){
							//alert(r);
							if(r==1){
								$('#table_clientes').load("Clientes/tablaClientes.php");
								alertify.success("Cliente eliminado");
							}else{
								alertify.error("Error al eliminar cliente");
							}

						}
					});



				}, function(){ alertify.error('Cancelado')});


			}

		</script>
		<script type="text/javascript">
			$(document).ready(function() {
				$('#btn_actualizarCliente').click(function(event) {
					/* Act on the event */
					vacios=ValidarFormularioVacio('frm_actualizarcliente');
					if(vacios >0){
						alertify.alert("Debes llenar todos los campos");
						return false;;
					}
					datos=$('#frm_actualizarcliente').serialize();
					$.ajax({
						url: '../Procesos/Clientes/actualizarCliente.php',
						type: 'POST',
						data: datos,
						success:function(r){
							//alert(r);
							if(r==1){
								$('#table_clientes').load("Clientes/tablaClientes.php");
								alertify.success("Cliente actualizado");
							}else{
								alertify.error("Error al actualizar cliente");
							}

						}
					});


				});
			});
		</script>
		<script type="text/javascript">
			$(document).ready(function() {
				$('#table_clientes').load("Clientes/tablaClientes.php");
				$('#btn_clientes').click(function(event) {
					/* Act on the event */
					vacios=ValidarFormularioVacio('frm_clientes');
					if(vacios >0){
						alertify.alert("Debes llenar todos los campos");
						return false;
					}
					datos=$('#frm_clientes').serialize();
					$.ajax({
						url: '../Procesos/Clientes/agregarClientes.php',
						type: 'POST',
						data: datos,
						success:function(r){
							//alert(r);
							if(r==1){
								$('#frm_clientes')[0].reset();
								$('#table_clientes').load("Clientes/tablaClientes.php");
								alertify.success("Cliente agregado");
							}else{
								alertify.error("Error al agregar cliente");
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