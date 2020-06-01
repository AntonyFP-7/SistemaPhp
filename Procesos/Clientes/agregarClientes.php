<?php 

 session_start();
require_once "../../Clases/conexion.php";
require_once "../../Clases/clientes.php";

$obj=new clientes();

$idusuario=$_SESSION['idusuario'];
$datos= array(
	$_POST['nombre'],
	$_POST['apellido'],
	$_POST['direccion'],
	$_POST['correo'],
	$_POST['telefono'],
	$_POST['rfc'],
	$idusuario
);

echo $obj->InsertarCliente($datos);


?>