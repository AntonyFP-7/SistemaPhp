<?php 
/**
 * 
 */
class articulos{
	
	public function agregarImagen($datos) {
		$obj=new conectar();

		$conexion=$obj->conexion();

		$sql="INSERT into imagenes (nombre, ruta ,fechaSubida,categorias_id_categorias) values('$datos[0]','$datos[1]','$datos[2]','$datos[3]') ";
		$result=mysqli_query($conexion,$sql);

		return mysqli_insert_id($conexion);
	 	#nos va a regresar el ultimo id agregado en imagenes

	}
	public function InsertarArticulo($datos){

		$obj=new conectar();

		$conexion=$obj->conexion();

		$sql="INSERT into productos (nombre,descripcion,cantidad,precio,fechaCaptura,categorias_id_categorias,imagenes_id_imagene,usuarios_id_usuario) values('$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','$datos[5]','$datos[6]','$datos[7]')";

		return mysqli_query($conexion,$sql);

	}
	public function MostrarArticulos(){

		$obj=new conectar();

		$conexion=$obj->conexion();
		$sql="SELECT productos.nombre,productos.descripcion,productos.cantidad,productos.precio,categorias.nombrecategoria, imagenes.ruta ,productos.id_productos from productos inner JOIN categorias on(productos.categorias_id_categorias=categorias.id_categorias)  INNER JOIN imagenes on(imagenes.id_imagene=productos.imagenes_id_imagene)";
		$result=mysqli_query($conexion,$sql);

		$datos=array();

		while ($lista=mysqli_fetch_row($result)) {
	 		# code...
			array_push($datos,$lista[0],$lista[1] ,$lista[2] ,$lista[3] ,$lista[4],$lista[5],$lista[6] );
		}
		$ver=array_chunk($datos,7);
		return $ver;

	}
	public function OptenerArticulos($idarticulo){

		$obj=new conectar();

		$conexion=$obj->conexion();
		$sql="SELECT 	id_productos, nombre,descripcion,cantidad,precio,categorias_id_categorias FROM productos WHERE id_productos= '$idarticulo'";

		$result=mysqli_query($conexion,$sql);

		$ver=mysqli_fetch_row($result);

		$datos=array(
			"idarticulo" =>$ver[0],
			"nombre" =>$ver[1],
			"descripcion" =>$ver[2],
			"cantidad" =>$ver[3],
			"precio" =>$ver[4],
			"idcategoria" =>$ver[5]

		);

		return $datos;
	}

	public function ActulizarCategoria($datos){
		$obj=new conectar();

		$conexion=$obj->conexion();
		$sql="UPDATE productos	SET  nombre='$datos[1]',descripcion='$datos[2]',cantidad='$datos[3]',precio='$datos[4]',categorias_id_categorias='$datos[5]' WHERE id_productos= '$datos[0]'";

		return mysqli_query($conexion,$sql);
	}


	public function EliminarArticulo($idarticulo){

		$obj=new conectar();

		$conexion=$obj->conexion();

		$datosImg=self::ObtenerIdImg($idarticulo);

		$sql="DELETE FROM productos WHERE id_productos='$idarticulo'";

		$result= mysqli_query($conexion,$sql);

		if ($result) {
			# code...
			#ruta=$datosImg[1];

			$sql1="DELETE FROM imagenes WHERE id_imagene='$datosImg[0]' AND categorias_id_categorias ='$datosImg[2]' ";

					$result1= mysqli_query($conexion,$sql1);

					if ($result1) {
						# code...
						if (unlink($datosImg[1])) {
							# code...
							return 1;
						}
					}

		}
	}

	public function ObtenerIdImg($idarticulo){

		$obj=new conectar();

		$conexion=$obj->conexion();
		$sql="SELECT imagenes.id_imagene ,imagenes.ruta,imagenes.categorias_id_categorias FROM productos INNER JOIN imagenes on (productos.imagenes_id_imagene=imagenes.id_imagene) WHERE productos.id_productos='$idarticulo'";

		$result=mysqli_query($conexion,$sql);
			# mysqli_fetch_row($result)[0]; creo q retorna el array la primera posicion
		return mysqli_fetch_row($result);
	}
}

?>