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


$IDC= $_POST['txtIDC'];
$Nota1=$_POST['txtNot1'];
$Nota2=$_POST['txtNot2'];
$Nota3=$_POST['txtNot3'];
$Acumulativo=$_POST['txtAcum'];
$Proyecto=$_POST['txtProy'];
$NotaF=$_POST['txtNotF'];




	#	Insercion en tblCursoXInstituto
	#	UPDATE `tblcalificaciones` SET `IDCalificacion`= ,`IDAula`=,`CodigoAlumno`=,`NotaIP`=,`NotaIIP`=,`NotaIIIP`=,`Acumulativo`=,`Proyecto`=,`Recuperacion`=,`NotaFinal`= WHERE

$consultaB = sprintf("UPDATE tblcalificaciones SET NotaIP='%s',NotaIIP='%s',NotaIIIP='%s',Acumulativo='%s',Proyecto='%s',NotaFinal='%s' WHERE IDCalificacion='%s'",
	$conexion->antiInyeccion($Nota1),
	$conexion->antiInyeccion($Nota2),
	$conexion->antiInyeccion($Nota3),
	$conexion->antiInyeccion($Acumulativo),
	$conexion->antiInyeccion($Proyecto),
	$conexion->antiInyeccion($NotaF),
	$conexion->antiInyeccion($IDC)
);


$resultado=$conexion->ejecutarconsulta($consultaB);



	#	Insercion en tblLOGS FALTA COMPLETAR MAS DATOS

mysqli_close($conexion->getLink());
?>