<?php 

require_once "../../Clases/conexion.php";
require_once "../../Clases/clientes.php";
 $obj= new clientes();

 $idcliente=$_POST['idcliente'];

echo $obj->EliminarCliente($idcliente);

 ?>