<?php 
require_once "../../Clases/conexion.php";
require_once "../../Clases/usuarios.php";

$obj= new usuarios();

$idusuario=$_POST['idusuario'];

echo $obj->EliminarUsuario($idusuario);

 ?>