<?php 
require_once "../../Clases/conexion.php";
require_once "../../Clases/categorias.php";

$obj=new categorias();

$datos = array($_POST['idcategoria']);

echo $obj->EliminarCategoria($datos);


 ?>