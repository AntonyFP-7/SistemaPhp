<?php 
    session_start();
    require_once "../../Clases/conexion.php";
    require_once "../../Clases/usuarios.php";

    $obj=new usuarios();

   $datos = array(
   	$_POST['usuario'],
   	$_POST['contra']

   );

   echo $obj->Autenticar($datos);

 ?>