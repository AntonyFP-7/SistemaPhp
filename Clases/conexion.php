<?php
class conectar{
	private $servidor ="localhost";
	private $usuario="root";
	private $contraseña="";
	private $db="ventasantony";

	public function conexion (){
		$conexion=mysqli_connect($this->servidor,
			$this->usuario,
			$this->contraseña,
			$this->db);
		return $conexion;

	}
}

?>