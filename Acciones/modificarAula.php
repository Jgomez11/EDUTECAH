<?php
session_start();

	#	Importar clases
include("../Clases/Conexion.php");
include("../Clases/Usuario.php");

	#	Utilidad de fecha
date_default_timezone_set('America/Tegucigalpa');

	#	Crear conexion
$conexion = new Conexion();
$conexion->mysql_set_charset("utf8");

$id = $_POST['IDAula'];
$curso = $_POST['IDCurso'];
$asignatura = $_POST['Asignatura'];
$estado = $_POST['IDEstado'];
$docente = $_POST['IDDocente'];



	#	Insercion en tblCursoXInstituto

$consultaB = sprintf("UPDATE tblaula SET CodigoCurso='%s', Asignatura='%s', IDEstado='%s', IDDocente='%s' WHERE IDAula='%s'",
	$conexion->antiInyeccion($curso),
	$conexion->antiInyeccion($asignatura),
	$conexion->antiInyeccion($estado),
	$conexion->antiInyeccion($docente),
	$conexion->antiInyeccion($id));


$resultado=$conexion->ejecutarconsulta($consultaB);



	#	Insercion en tblLOGS FALTA COMPLETAR MAS DATOS
$fecha=date("Y-m-d");
$hora=date("G:i:s");
$consultaLog = sprintf("INSERT INTO tbllogs(Evento, Descripcion, Fecha, Hora, IPusuario, IDUsuario) values('%s','%s','%s','%s','%s','%s')",
	$conexion->antiInyeccion("Nuevos datos"),
	$conexion->antiInyeccion("Se ha actualizado un registro en la tabla aulas"),
	$conexion->antiInyeccion($fecha),
	$conexion->antiInyeccion($hora),
	$conexion->antiInyeccion($conexion->ip()),
	$conexion->antiInyeccion($_SESSION['ID']));
$conexion->ejecutarconsulta($consultaLog);

mysqli_close($conexion->getLink());
?>