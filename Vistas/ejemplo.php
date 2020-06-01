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
					<form id="frm_ejemplo" method="POST">
						<label>Nombre</label>
						<input type="text"  class="form-control input-sm" name="nombre"   id="nombre">
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
						<span id="btn_ejemplo" class="btn btn-primary">Registar</span>
					</form>
				</div>

				<div class="col-sm-8">
					<div id="table_ejemplo">
					</div>
				</div>
			</div>

		</div>
	</body>
	</html>
	<script  type="text/javascript" >
		$(document).ready(function() {
          $('#table_ejemplo').load('ejemplo/tablaEjemplo.php');

          $('#btn_ejemplo').click(function(event) {
          	/* Act on the event */
          	vacios=ValidarFormularioVacio('frm_ejemplo');


				if (vacios > 0) {
					alertify.alert("Los campos no peuden estar vacios");

					return false;
				}
				datos= $('#frm_ejemplo').serialize();
				$.ajax({
					url: '../Procesos/Ejemplo/agregarEjemplo.php',
					type: 'POST',
					data: datos,
					success:function(r){
						if (r==1) {

							alertify.success("exito");
						}else{
							alertify.error("error");
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