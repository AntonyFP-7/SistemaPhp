<?php 
   require_once "Clases/usuarios.php";
   require_once "Clases/conexion.php";
   $obj=new usuarios();
  $validar=$obj->Admin();
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login de Usuario </title>
	<link rel="stylesheet" href="Librerias/bootstrap/css/bootstrap.css">
	<script type="text/javascript" src="Librerias/jquery-3.2.1.min.js"></script>
	<script src="Js/funciones.js"></script>
	<script src="librerias/alertifyjs/alertify.js"></script>
	<link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/alertify.css">
	<link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/themes/default.css">


</head>
<body style="background-color: gray">
	<br><br><br>
	<div class="container"><!--establece las dimeciones -->
		<div class="row"><!-- para que el contenigo este dentro del contenedor -->
			<div class="col-sm-4"></div> <!--para centar -->
			<div class="col-sm-4">
				<div class="panel panel-primary"><!-- agrega el borde  del contenedor-->
					<div class="panel panel-heading">Sistema de Ventas y Almacen</div><!-- agrega un cuado  con el texto dado -->
					<div class="panel panel-body">
						<p>
							<img src="Img/carrito-de-la-compra.jpg"  height="190" width="320" alt="">
						</p>
						<form  id="fmr_usuarios">
							<label>Usuario</label>
							<input type="text" class="form-control input-sm" name="usuario" id="usuario" value="">
							<label>Contraseña</label>
							<input type="password" class="form-control input-sm" name="contra" id="contra" value="">
							<p></p>
							<span id="btn_entrar" class="btn btn-primary btn-sm">Entrar</span>
							<?php if(!$validar):?>
							<a href="registro.php" class="btn btn-danger btn-sm">Registrar</a>
							<?php endif; ?>

						</form>
					</div><!-- ayuda al diseño ase mas grande el contenedor -->
				</div>
			</div>
			<div class="col-sm-4"></div>
		</div>
	</div>
</body>
</html>
<script type="text/javascript">

	$(document).ready(function() {
		$('#btn_entrar').click(function() {
		/* Act on the event */
		vacios=ValidarFormularioVacio('fmr_usuarios');

		if (vacios > 0) {
		alertify.alert("Debes llenar todos los campos");

		return false;
		}
		datos=$('#fmr_usuarios').serialize();
		$.ajax({
			type:"POST",
			data:datos,
			url:"Procesos/RegLogin/Autenticar.php",
			success:function(r){
				
               if(r==1){
                  window.location="Vistas/inicio.php";
               }else{
               alertify.alert("Usuario Incorrecto");
               }
			}
		});
		return false;
	});

	});

</script>