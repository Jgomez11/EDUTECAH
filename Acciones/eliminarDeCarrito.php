<?php 
	include("../Clases/Conexion.php");
	$conexion = new Conexion();
	$conexion->mysql_set_charset("utf8");
	session_start();

	$producto = $_POST['id'];

	$consulta = sprintf("DELETE FROM tbl_productos_carrito WHERE IDProducto = '%s'", $conexion->antiInyeccion($producto));
	$conexion->ejecutarconsulta($consulta);