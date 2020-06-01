<?php 
 /**
  * 
  */
 class categorias {
 	
 	public function agregarCategoria($datos){

 		$obj= new conectar();
 		$conexion=$obj->conexion();

 		$sql="INSERT into categorias(nombrecategoria,fechaCaptura,usuarios_id_usuario) values('$datos[0]','$datos[1]','$datos[2]')";

 		return mysqli_query($conexion,$sql);
 		
 	}

 	public function lista(){
 		$obj= new conectar();
 		$conexion=$obj->conexion();

 		$sql="SELECT id_categorias,nombrecategoria from categorias";
 		$result=mysqli_query($conexion,$sql);

 		$ver = array();

 		while ($list=mysqli_fetch_row($result)) {
 			array_push($ver,$list[0], $list[1]);
 		}
 		$lis=array_chunk($ver, 2);

 		return $lis;

 	}
 	public function ActulizarCategoria($datos){

 		$obj= new conectar();
 		$conexion=$obj->conexion();

 		$sql="UPDATE categorias set nombrecategoria='$datos[1]' where id_categorias='$datos[0]'";
 		return mysqli_query($conexion,$sql);


 	}

 	public function EliminarCategoria($datos){
 		$obj= new conectar();
 		$conexion=$obj->conexion();
 		$sql="DELETE from categorias where id_categorias='$datos[0]'";
 		return mysqli_query($conexion,$sql);

 	}
 }



 ?>