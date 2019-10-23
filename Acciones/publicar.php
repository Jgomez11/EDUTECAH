<?php
session_start();
date_default_timezone_set('America/Tegucigalpa');
include("../Clases/Conexion.php");
$conexion = new Conexion();
$conexion->mysql_set_charset("utf8");

$publi = $_POST['publi'];
$fecha = date("Y-m-d");
$hora = date("G:i:s");

$consulta = sprintf(
    "INSERT INTO tblAnuncios(IDUsuario, IDInstituto, Anuncio, Fecha, Hora) VALUES('%s','%s','%s','%s','%s')",
    $conexion->antiInyeccion($_SESSION['ID']),
    $conexion->antiInyeccion($_SESSION['Instituto']),
    $conexion->antiInyeccion($publi),
    $conexion->antiInyeccion($fecha),
    $conexion->antiInyeccion($hora)
);

$conexion->ejecutarconsulta($consulta);
