<?php 
     require_once "Clases/conexion.php";
     require_once "Clases/usuarios.php";

     $obj = new usuarios();

     $validar=$obj->Admin();

     if($validar==1):
    header("location:index.php");
     endif;
 ?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="Librerias/bootstrap/css/bootstrap.css">
	<script type="text/javascript" src="Librerias/jquery-3.2.1.min.js"></script>
	<script src="Js/funciones.js"></script>
</head>
<body style="background-color: gray">
	
	<br><br><br>

	<div class="container">
		<div class="row">
			<div class="col-sm-4"></div>
			<div class="col-sm-4">
				<div class="panel panel-danger">
					<div class="panel panel-heading">
						Registar Administrador</div>
					<div class="panel panel-body">
						<form id="registroadmin" method="POST">
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
							<span id="registrar" class="btn btn-primary">Registar</span>
							<a href="index.php" class="btn btn-default">Regresar login</a>
						</form>
					</div>
				</div>
				
			</div>
			<div class="col-sm-4"></div>
		</div>
		
	</div>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function() {
		$('#registrar').click(function() {
		/* Act on the event */
		vacios=ValidarFormularioVacio('registroadmin');

		if (vacios > 0) {
		alert("Debes llenar todos los campos");

		return false;
		}
		datos=$('#registroadmin').serialize();
		
		$.ajax({
			
			url:"Procesos/RegLogin/registrarUsuario.php",
			type:"POST",
			data:datos,
			
			success:function(r){
					//alert(r);
				if (r==1) {
				alert("Usuario Agregado");
				header("location:index.php");
				
				
				}else{
					alert("Error al registrar usuario");
				}

			}
		});
		return false;
	});

	});

</script>