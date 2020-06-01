<?php 
        session_start();
		require_once "../../Clases/conexion.php";
		require_once "../../Clases/categorias.php";
        
        $obj=new categorias();
		$fecha=date('Y-m-d');
		$usuario=$_SESSION['idusuario'];
  
		$datos = array(
         $_POST['categoria'],
         $fecha,
         $usuario
		 );

		echo $obj->agregarCategoria($datos);
 ?>