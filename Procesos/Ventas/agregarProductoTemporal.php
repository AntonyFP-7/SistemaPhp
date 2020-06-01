<?php 
session_start();
require_once "../../Clases/conexion.php";
require_once "../../Clases/ventas.php";

$obj= new ventas();

$idcliente=$_POST['cmb_cliente'];
$idproducto=$_POST['cmb_producto'];
$descripcion=$_POST['descripcion'];
$cantidad=$_POST['cantidad'];
$precio=$_POST['precio'];

$datosCliente = $obj->OptenerCliente($idcliente);

$nombre=$datosCliente[1]." ".$datosCliente[0];

$nombreProducto=$obj->OptenerProducto($idproducto);

$registroVenta=$idproducto."||".$nombreProducto[0]."||".$descripcion."||".$precio."||".$nombre."||".$idcliente;

$_SESSION['tablaComprasTem'][]=$registroVenta;

echo $registroVenta;

 ?>