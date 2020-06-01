<?php 
require_once "../../Clases/conexion.php";
require_once "../../Clases/articulos.php";

$obj=new articulos();

$idarticulo=$_POST['idarticulo'];

echo json_encode($obj->OptenerArticulos($idarticulo));

 ?>