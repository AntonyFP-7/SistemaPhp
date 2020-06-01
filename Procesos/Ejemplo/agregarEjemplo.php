<?php 
session_start();
require_once "../../Clases/conexion.php";
require_once "../../Clases/ejemplo.php";

$obj= new ejemplo();

$IDUSUARIO=$_SESSION['idusuario'];

$datos = array(
	$_POST['nombre'],
	$_POST['apellido'],
	$_POST['direccion'],
	$_POST['correo'],
	$_POST['telefono'],
	$_POST['rfc'],
	$IDUSUARIO

);

echo $obj->agregarEjemplo($datos);




?>