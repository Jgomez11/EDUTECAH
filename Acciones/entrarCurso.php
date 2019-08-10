<?php
    session_start();

#	Importar Clases
 	include("../Clases/Conexion.php");

#	Utilidad de fecha
	date_default_timezone_set('America/Tegucigalpa');

#	Crear conexion
 	$conexion = new Conexion();
 	$conexion->mysql_set_charset("utf8");


 	$fecha = date("Y-m-d");				

#	Obtener los datos POST desde JavaScript
 	$password = $_POST["password"];

#	Verificacion 1: Codigo
 	$consulta= sprintf("SELECT count(*) FROM tblCursoxInstituto where CodigoCurso = '%s'", $conexion->antiInyeccion($password));
 	$resultado=$conexion->ejecutarconsulta($consulta);
 	$data = $conexion->obtenerFila($resultado);

 	if ($data['count(*)'] == '1') {

#	Crear Sesion							
			$_SESSION['CodigoCurso'] = $password;
#	Exito			
			echo '0';
	
#	Correo Inexistente
 	} else {		
		echo '1';
 	}
?>