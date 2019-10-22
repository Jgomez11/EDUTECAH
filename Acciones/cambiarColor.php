<?php
session_start();
date_default_timezone_set('America/Tegucigalpa');
include("../Clases/Conexion.php");
$conexion = new Conexion();
$conexion->mysql_set_charset("utf8");

$color = $_POST['color'];

$consulta = sprintf("UPDATE tblTema SET IDColor = '%s' WHERE IDUsuario = '%s'", $conexion->antiInyeccion($color), $conexion->antiInyeccion($_SESSION['ID']));
$conexion->ejecutarconsulta($consulta);

$consulta = sprintf(
    "SELECT color FROM tblcolor  WHERE IDColor = '%s'",
    $conexion->antiInyeccion($color)
);
$_SESSION['Tema'] = $conexion->ejecutarconsulta($consulta)->fetch_assoc()['color'];