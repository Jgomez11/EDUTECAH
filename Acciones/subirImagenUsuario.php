<?php
session_start();
date_default_timezone_set('America/Tegucigalpa');
include("../Clases/Conexion.php");
$conexion = new Conexion();
$conexion->mysql_set_charset("utf8");



if (array_key_exists('Archivo', $_FILES) && $_FILES['Archivo']['error'] == 0) {

	$pic = $_FILES['Archivo'];
	$contenidoImagen = file_get_contents($pic['tmp_name']);
	echo var_dump($contenidoImagen);
	$sql = sprintf("UPDATE tblusuario SET Imagen ='%s' WHERE idusuario = '%s'", $conexion->antiInyeccion($contenidoImagen), $conexion->antiInyeccion($_SESSION['ID']));

	$conexion->ejecutarconsulta($sql);

	$_SESSION['Imagen'] = $contenidoImagen;
}
