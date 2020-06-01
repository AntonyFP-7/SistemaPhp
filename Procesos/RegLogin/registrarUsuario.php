<?php 

 session_start();
  require_once "../../Clases/conexion.php";
  require_once "../../Clases/usuarios.php";

  $obj=new usuarios();

  $pass=sha1($_POST['contra']);

  $datos = array(
  $_POST['nombre'],
  $_POST['apellido'],
  $_POST['correo'],
  $_POST['usuario'],
  $pass
);

  echo $obj->registroUsuario($datos);
 ?>
 