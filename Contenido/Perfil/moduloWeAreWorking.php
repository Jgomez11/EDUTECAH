<?php  
session_start();

#   Importar Clases
include("../../Clases/Conexion.php");

#   Utilidad de fecha
date_default_timezone_set('America/Tegucigalpa');

#   Crear conexion
$conexion = new Conexion();
$conexion->mysql_set_charset("utf8");
?>


<div>
	<br><br>	
	<center>	
		<img src="Recursos/Imagenes/weareworking.png"" alt="">
		<H1>Estamos Trabajando en Este Servicio ¡Pronto estara disponible!</H1>
	</center>
</div>	



