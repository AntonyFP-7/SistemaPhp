<?php 

require_once "../../Clases/conexion.php";
require_once "../../Clases/articulos.php";

$obj= new articulos();

$datos = array(
	$_POST['idarticulo'],
	$_POST['Anombre'],
	$_POST['Adescripcion'],
	$_POST['Acantidad'],
	$_POST['Aprecio'],
	$_POST['AcategoriaSelect']
);

echo $obj->ActulizarCategoria($datos);

?>