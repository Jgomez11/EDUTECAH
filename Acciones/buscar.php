<?php 
	#	Clases de Base de datos y de horarios para inserciones
	date_default_timezone_set('America/Tegucigalpa');
 	include("../Clases/Conexion.php");

 	#	Creacion de la conexion a la Base de Datos
 	$conexion = new Conexion();
 	$conexion->mysql_set_charset("utf8");

 	#	Datos de fecha para la insercion en la tabla de logs
	$fecha = date("Y-m-d");
					
 	#	Carga de los elementos recibidios por el HTML via POST
 	$query = $_GET["q"];
 	$arrayJSON = array();

 	$consulta= sprintf("SELECT NombreProducto, IDProducto, Descripcion, PrecioActual FROM tbl_producto where NombreProducto LIKE '%s' ORDER BY (NombreProducto) LIMIT 8" , '%'.$conexion->antiInyeccion($query).'%');
 	$resultado=$conexion->ejecutarconsulta($consulta);

 	$iter = $conexion->cantidadRegistros($resultado);
	
	for ($i=0; $i < $iter; $i++) {
		$data = $conexion->obtenerFila($resultado);

		$arrayJSON[] = array($data['NombreProducto'], $data['IDProducto'], $data['Descripcion'], $data['PrecioActual']); 
	}

	$myJSON = json_encode($arrayJSON);

	echo $myJSON;
	
 ?>