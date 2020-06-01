<?php 
session_start();
require_once "../../Clases/conexion.php";
require_once "../../Clases/articulos.php";

$idusuario=$_SESSION['idusuario'];
$obj=new articulos();
$fecha=date('Y-m-d');

$nombreImg=$_FILES['imagen']['name'];
$rutaAlmacenamiento=$_FILES['imagen']['tmp_name'];
$carpeta='../../Archivos/';
$rutaFinal=$carpeta.$nombreImg;

$datosImg=array(
	$nombreImg,
	$rutaFinal,
	$fecha,
	$_POST['categoriaSelect']     
);

if (move_uploaded_file($rutaAlmacenamiento, $rutaFinal)) {  	
	 $idImagen=$obj->agregarImagen($datosImg);

	if ($idImagen > 0) {
		# code...
		$datos=array(
			$_POST['nombre'],
			$_POST['descripcion'],
			$_POST['cantidad'],
			$_POST['precio'],
			$fecha,
			$_POST['categoriaSelect'],
			$idImagen,
			$idusuario
		);
		echo $obj->InsertarArticulo($datos);

	}else{
		echo 0;
	}
}

?>