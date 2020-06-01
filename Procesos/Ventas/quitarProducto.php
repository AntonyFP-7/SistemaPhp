<?php 
session_start();
$index=$_POST['index'];

unset($_SESSION['tablaComprasTem'][$index]);
//cuando eliminamos una fila de una rrray en usa secion se elimina por ejemplo elimono la posision 2 el aray seria 0 1 3.. con array_values hacemso q el arrayt vuelva a sus fialas sucesivas
$datos=array_values($_SESSION['tablaComprasTem']);
unset($_SESSION['tablaComprasTem']);
$_SESSION['tablaComprasTem']=$datos;


 ?>