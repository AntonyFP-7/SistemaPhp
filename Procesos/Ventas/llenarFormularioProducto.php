<?php 
require_once "../../Clases/conexion.php";
require_once "../../Clases/ventas.php";
 $obj= new ventas();


$idproducto=$_POST['idproducto'];


 echo json_encode($obj->OptenDatosProducto($idproducto));
#echo $obj->OptenDatosProducto($idproducto);
 

 ?>