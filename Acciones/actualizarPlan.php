<?php 
	# Clases de Base de datos inserciones
include("../Clases/Conexion.php");

session_start();
  	# Creacion de la conexion a la Base de Datos
$conexion = new Conexion();
$conexion->mysql_set_charset("utf8");


$planID=$_GET["planID"];
$AulasDisponibles=$_GET["Aulas"];

$consulta = "UPDATE tblplan SET IDTipoPlan=".$planID.", AulasDisponibles=".$AulasDisponibles."    WHERE tblplan.IDinstituto=".$_SESSION['Instituto'];

$conexion->ejecutarconsulta($consulta);


header("Location:../Perfil.php");

?>