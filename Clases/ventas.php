<?php 
/**
 * 
 */
class ventas{
	
	public function OptenDatosProducto($idproducto){

		$obj =new conectar();
		$conexion=$obj->conexion();

		$sql="SELECT productos.nombre,productos.descripcion,productos.cantidad, imagenes.ruta,productos.precio from productos inner JOIN categorias on(productos.categorias_id_categorias=categorias.id_categorias)  INNER JOIN imagenes on(imagenes.id_imagene=productos.imagenes_id_imagene) WHERE id_productos='$idproducto'";

		$result= mysqli_query($conexion,$sql);

		$ver=mysqli_fetch_row($result);

		#$ruta=explode('/', $ver[4]);
		#$img=$ruta[1].'/'.$ruta[2].'/'.$ruta[3];
		$img=substr($ver[3], 15);

		$datos = array(
			'nombre' => $ver[0],
			'descripcion' => $ver[1],
			'cantidad' => $ver[2],
			'ruta' => $img,
			'precio' => $ver[4]
			
		);

		return $datos;
	}

	public function OptenerCliente($idcliente){

		$obj =new conectar();
		$conexion=$obj->conexion();

		$sql="SELECT nombre, apellido FROM clientes  WHERE id_clientes='$idcliente'";
		$result=mysqli_query($conexion,$sql);

		return mysqli_fetch_row($result);

	}

	public function OptenerProducto($idproducto){
		$obj =new conectar();
		$conexion=$obj->conexion();

		$sql="SELECT nombre FROM productos  WHERE id_productos='$idproducto'";
		$result=mysqli_query($conexion,$sql);

		return mysqli_fetch_row($result);

	}

	public function CrearFolio(){
		$obj =new conectar();
		$conexion=$obj->conexion();
		$sql="SELECT id_ventas FROM ventas GROUP BY id_ventas DESC";
		$result=mysqli_query($conexion,$sql);
		$id=mysqli_fetch_row($result)[0];

		if ($id=="" or $id==null or $id==0) {
			# code...
			return 1;
		}else{
			return $id + 1;
		}

	}
	public function CrearVenta(){
		$obj =new conectar();
		$conexion=$obj->conexion();
		$fecha=date('Y-m-d');
		$idventa=self::CrearFolio();
		$datos=$_SESSION['tablaComprasTem'];
		$idiusuario=$_SESSION['idusuario'];
		$r=0;
		
		for ($i=0; $i <count($datos) ; $i++) { 
			# code...
			$d=explode("||", $datos[$i]);

			$sql="INSERT INTO ventas (id_ventas,precio,fechaCompra,clientes_id_clientes,productos_id_productos,usuarios_id_usuarios) VALUES ('$idventa','$d[3]','$fecha','$d[5]','$d[0]','$idiusuario')";
			$result=mysqli_query($conexion,$sql);
			$r=$r+$result;
			self::DescontarCantidad($d[0],1);
		}
		return $r;

	}
	public function DescontarCantidad($idproducto,$cantidad){
		$obj =new conectar();
		$conexion=$obj->conexion();
		$sql="SELECT cantidad FROM productos WHERE id_productos='$idproducto'";
		$result=mysqli_query($conexion,$sql);
		$cantidad1=mysqli_fetch_row($result)[0];
		$cantidadNueva=abs($cantidad1-$cantidad);

		$sql1="UPDATE productos SET cantidad='$cantidadNueva'WHERE id_productos='$idproducto'";
		mysqli_query($conexion,$sql1);

	}
	public function ObtenerTotal($idventa){
		$obj =new conectar();
		$conexion=$obj->conexion();

		$sql="SELECT precio FROM ventas WHERE id_ventas='$idventa'";
		$result=mysqli_query($conexion,$sql);
		$total=0;
		while ($ver=mysqli_fetch_row($result)) {
			# code...
			$total=$total +$ver[0];
		}

		return $total;
	}
	public function MostarVentas(){

		$obj =new conectar();
		$conexion=$obj->conexion();
		$sql="SELECT id_ventas,fechaCompra,clientes_id_clientes FROM ventas GROUP BY id_ventas";
		$datos=array();
		$result=mysqli_query($conexion,$sql);
		while ($ver=mysqli_fetch_row($result)) {
			# code...
			array_push($datos, $ver[0],$ver[1],$ver[2]);

		}
		$lista=array_chunk($datos, 3);
		return $lista;
	}

	public function DatosReporte($idventa){
		$obj =new conectar();
		$conexion=$obj->conexion();

		$sql="SELECT  ventas.id_ventas,ventas.fechaCompra,clientes.nombre,clientes.apellido,productos.nombre,productos.precio,productos.descripcion FROM ventas INNER JOIN clientes on(ventas.clientes_id_clientes=clientes.id_clientes) JOIN productos on(ventas.productos_id_productos=productos.id_productos) and ventas.id_ventas='$idventa'";
		$datos=array();
		$result=mysqli_query($conexion,$sql);
		while ($ver=mysqli_fetch_row($result)) {
			# code...
			array_push($datos, $ver[0],$ver[1],$ver[2], $ver[3],$ver[4],$ver[5],$ver[6]);

		}
		$lista=array_chunk($datos, 7);
		return $lista;
	}
}


?>