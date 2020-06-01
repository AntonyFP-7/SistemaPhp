<?php 

require_once "../../Clases/conexion.php";
require_once "../../Clases/articulos.php";

$obj=new articulos();

$idarticulo=$_POST['articulo'];

echo $obj-> EliminarArticulo($idarticulo);

 ?>