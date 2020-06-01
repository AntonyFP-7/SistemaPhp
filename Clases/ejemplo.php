<?php 

/**
 * 
 */
class ejemplo{
	
	public function agregarEjemplo($datos){
		$obj= new conectar();
		$con=$obj->conexion();

		$sql="INSERT INTO clientes(nombre,apellido,direccion,email,telefono,rft,usuarios_id_usuario) VALUES('$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','$datos[5]','$datos[6]')";

		$resultado=mysqli_query($con,$sql);

		return $resultado;
	}

	 public function MostrarClientes(){
	 	$obj= new conectar();
	 	$con=$obj->conexion();
	 	$sql="SELECT nombre,apellido,direccion,email,telefono,rft FROM clientes";

	 	$resulado=mysqli_query($con,$sql);
	 	$datos=array();
	 	while ($ver=mysqli_fetch_row($resulado)) {
	 		# code...
	 		array_push($datos, $ver[0],$ver[1],$ver[2],$ver[3],$ver[4],$ver[5]);
	 	}
	 	$lis=array_chunk($datos, 6);

	 	return $lis; 
	 }
}


?>