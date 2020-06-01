<?php 
session_start();
require_once "../../Clases/conexion.php";
require_once "../../Clases/ventas.php";
$obj= new ventas();

if (count($_SESSION['tablaComprasTem'])==0) {
	# code...
	echo 0;
}else{
	$result=$obj->CrearVenta();
	unset($_SESSION['tablaComprasTem']);

	echo $result;

}


 ?>