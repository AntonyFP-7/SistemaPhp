<?php 
require_once "../../Clases/conexion.php";
require_once "../../Clases/clientes.php";
$obj= new clientes();

$datos=array(
	$_POST['idcliente'],
	$_POST['Anombre'],
	$_POST['Aapellido'],
	$_POST['Adireccion'],
	$_POST['Acorreo'],
	$_POST['Atelefono'],
	$_POST['Arfc'],
	);

echo $obj->ActualizarClientes($datos);

?>