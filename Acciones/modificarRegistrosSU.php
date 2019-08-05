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


$identificador= $_POST['txtIdentificador'];
$Nombre=$_POST['txtNombre'];
$Apellido=$_POST['txtApellido'];
$TipoUsuario=$_POST['slcCargo'];
$Cedula=$_POST['txtCedula'];
$Telefono=$_POST['txtTelefono'];
$Correo=$_POST['txtCorreo'];



	#	Insercion en tblCursoXInstituto

$consultaB = sprintf("UPDATE tblusuario SET Nombre='%s', Apellido='%s', Cedula='%s', Telefono='%s', Correo='%s',TipoUsuario='%s' WHERE IDUsuario='%s'",
	$conexion->antiInyeccion($Nombre),
	$conexion->antiInyeccion($Apellido),
	$conexion->antiInyeccion($Cedula),
	$conexion->antiInyeccion($Telefono),
	$conexion->antiInyeccion($Correo),
	$conexion->antiInyeccion($TipoUsuario),
	$conexion->antiInyeccion($identificador));


$resultado=$conexion->ejecutarconsulta($consultaB);



	#	Insercion en tblLOGS FALTA COMPLETAR MAS DATOS
$fecha=date("Y-m-d");
$hora=date("G:i:s");
$consultaLog = sprintf("INSERT INTO tbllogs(Evento, Descripcion, Fecha, Hora, IPusuario, IDUsuario) values('%s','%s','%s','%s','%s','%s')",
	$conexion->antiInyeccion("Nuevos datos"),
	$conexion->antiInyeccion("Se ha actualizado un registro en la tabla usuario"),
	$conexion->antiInyeccion($fecha),
	$conexion->antiInyeccion($hora),
	$conexion->antiInyeccion($conexion->ip()),
	$conexion->antiInyeccion($_SESSION['ID']));
$conexion->ejecutarconsulta($consultaLog);

mysqli_close($conexion->getLink());
?>