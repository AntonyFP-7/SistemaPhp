<?php 
/**
 * 
 */
class clientes{
	
	public  function InsertarCliente($datos){

		$obj=new conectar();
		$conexcion=$obj->conexion();

		$sql="INSERT INTO clientes (nombre,apellido,direccion,email,telefono,rft,usuarios_id_usuario) values('$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','$datos[5]','$datos[6]')";

		return mysqli_query($conexcion,$sql);
	}

	public function MostrarClientes(){

		$obj=new conectar();
		$conexcion=$obj->conexion();
		$sql="SELECT id_clientes,nombre,apellido,direccion,email,telefono,rft FROM clientes";

		$result=mysqli_query($conexcion,$sql);
		$datos=array();

		while ($ver=mysqli_fetch_row($result)) {
			# code...
			array_push($datos, $ver[0],$ver[1],$ver[2],$ver[3],$ver[4],$ver[5],$ver[6]);
		}
		$lista=array_chunk($datos, 7);
		return $lista;

	}
	public function OptenerDatosCliente($idcliente){

		$obj=new conectar();
		$conexcion=$obj->conexion();
		$sql="SELECT id_clientes,nombre,apellido,direccion,email,telefono,rft FROM clientes WHERE id_clientes= '$idcliente' ";
		$result=mysqli_query($conexcion,$sql);
		$ver=mysqli_fetch_row($result);

		$datos=array(
			"idcliente" =>$ver[0],
			"nombre" =>$ver[1],
			"apellidos" =>$ver[2],
			"direccion" =>$ver[3],
			"correo" =>$ver[4],
			"telefono" =>$ver[5],
			"rft" =>$ver[6]
		);
		return $datos;


	}
	public function ActualizarClientes($datos){
		$obj=new conectar();
		$conexcion=$obj->conexion();
		$sql="UPDATE clientes set nombre='$datos[1]',apellido='$datos[2]',direccion='$datos[3]',email='$datos[4]',telefono='$datos[5]',rft='$datos[6]'  WHERE id_clientes='$datos[0]' ";
		$result=mysqli_query($conexcion,$sql);
		return $result; 

	}
	public function EliminarCliente($idcliente){
		$obj=new conectar();
		$conexcion=$obj->conexion();
		$sql="DELETE FROM  clientes WHERE id_clientes= '$idcliente' ";
		$result=mysqli_query($conexcion,$sql);
		return $result; 


	}
}



?>