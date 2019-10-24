<?php  
include("../Clases/Conexion.php");
$conexion = new Conexion();
$conexion->mysql_set_charset("utf8");
date_default_timezone_set('America/Tegucigalpa');
session_start();

$consulta = "DELETE FROM tblcalificaciones WHERE tblcalificaciones.IDCalificacion=".$_POST['IDCalificacion'];
$conexion->ejecutarconsulta($consulta);

#	Insercion en tblLogs
#$hora = date("G:i:s");
#$consultaB = sprintf("INSERT INTO tbllogs(Evento, Descripcion, Fecha, Hora, IPusuario, IDUsuario) VALUES ('%s','%s','%s','%s','%s','%s')",
#	$conexion->antiInyeccion("Eliminacion de Recursos"),
#	$conexion->antiInyeccion("El usuario con correo:"." ".$Correo." "."ha Eliminado un Recurso"),
#	$conexion->antiInyeccion($fecha),
#	$conexion->antiInyeccion($hora),
#	$conexion->antiInyeccion($conexion->ip()),
#	$conexion->antiInyeccion($_SESSION['ID']));
#$conexion->ejecutarconsulta($consultaB);
?>