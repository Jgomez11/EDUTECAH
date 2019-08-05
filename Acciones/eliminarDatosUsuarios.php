<?php  
include("../Clases/Conexion.php");
$conexion = new Conexion();
$conexion->mysql_set_charset("utf8");
date_default_timezone_set('America/Tegucigalpa');
session_start();

$consulta = "DELETE FROM tblusuario WHERE tblusuario.IDUsuario=".$_POST['IDUsuario'];
$conexion->ejecutarconsulta($consulta);

#	Insercion en tblLogs
$hora = date("G:i:s");
$consultaB = sprintf("INSERT INTO tbllogs(Evento, Descripcion, Fecha, Hora, IPusuario, IDUsuario) VALUES ('%s','%s','%s','%s','%s','%s')",
	$conexion->antiInyeccion("Eliminacion de Usuarios"),
	$conexion->antiInyeccion("El usuario con correo:"." ".$Correo." "."ha Eliminado un usuario"),
	$conexion->antiInyeccion($fecha),
	$conexion->antiInyeccion($hora),
	$conexion->antiInyeccion($conexion->ip()),
	$conexion->antiInyeccion($_SESSION['ID']));
$conexion->ejecutarconsulta($consultaB);
?>