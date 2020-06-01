<?php 

class usuarios{
	public function registroUsuario($datos)
	{
		$c=new conectar();
		$conexion=$c->conexion();

		$fecha=date('Y-m-d');
		$sql ="INSERT into usuarios(nombre,
		apellidos,
		email,
		usuario,
		contra,
		fechaCaptura)
		values ('$datos[0]',
		'$datos[1]',
		'$datos[2]',
		'$datos[3]',
		'$datos[4]',
		'$fecha')";


		return mysqli_query($conexion,$sql);
	}

	public function Autenticar($datos){
		$c= new conectar();
		$conexion=$c->conexion();
		$pasword =sha1($datos[1]);
		$_SESSION['usuario']=$datos[0];
		$_SESSION['idusuario']=self::traerID($datos);

		$sql="SELECT*from usuarios where usuario='$datos[0]' and contra='$pasword'";

		$result= mysqli_query($conexion,$sql);
		if (mysqli_num_rows($result) > 0) {
			# code...
			return 1;
		}else{
			return 0;
		}
	}
	public function traerID($datos){
		$c= new conectar();
		$conexion=$c->conexion();
		$pasword =sha1($datos[1]);
		$sql="SELECT id_usuario from usuarios where usuario='$datos[0]' and contra='$pasword'";
		$result=mysqli_query($conexion,$sql);

		return mysqli_fetch_row($result)[0];
	}
	public function Admin(){

		$c= new conectar();
		$conexion=$c->conexion();

		$sql ="SELECT * from usuarios where usuario='admin'";
		$result=mysqli_query($conexion,$sql);
		if(mysqli_num_rows($result)>0){
			return 1;
		}else{

			return 0;
		}
	}
	public function MostarUsuarios(){
		$c= new conectar();
		$conexion=$c->conexion();

		$sql ="SELECT nombre, apellidos,email, usuario ,id_usuario from usuarios";

		$datos=array();
		$result=mysqli_query($conexion,$sql);

		while ($ver=mysqli_fetch_row($result)) {
			# code...
			array_push($datos, $ver[0],$ver[1],$ver[2],$ver[3],$ver[4]);
		}
		$lista=array_chunk($datos, 5);
		return $lista;


	}
	public function OptenerUsuario($idusuario){
		$c= new conectar();
		$conexion=$c->conexion();

		$sql ="SELECT id_usuario, nombre, apellidos,email, usuario from usuarios WHERE id_usuario='$idusuario'";
		$result=mysqli_query($conexion,$sql);

		$ver= mysqli_fetch_row($result);
		$datos = array(

			'idusuario' =>$ver[0] , 
			'nombre' => $ver[1],
			'apellidos' =>$ver[2] ,
			'correo' => $ver[3],
			'usuario' =>$ver[4] 
		);
		return $datos;

	}
	public function ActualizarUsuario($datos){
		$c= new conectar();
		$conexion=$c->conexion();

		$sql ="UPDATE usuarios set  nombre='$datos[1]', apellidos='$datos[2]',email='$datos[3]', usuario='$datos[4]'  WHERE id_usuario='$datos[0]'";
		$result=mysqli_query($conexion,$sql);
		return $result;

	}
	public function EliminarUsuario($idusuario){
		$c= new conectar();
		$conexion=$c->conexion();

		$sql ="DELETE from usuarios  WHERE id_usuario='$idusuario'";
		$result=mysqli_query($conexion,$sql);
		return $result;

	}
}

?>
