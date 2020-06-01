<?php 
require_once "../../Clases/conexion.php";
require_once "../../Clases/usuarios.php";

$obj= new usuarios();

$datos=array(
	$_POST['idusuario'],
	$_POST['Anombre'],
	$_POST['Aapellido'],
	$_POST['Acorreo'],
	$_POST['Ausuario']
);
echo $obj->ActualizarUsuario($datos);

?>