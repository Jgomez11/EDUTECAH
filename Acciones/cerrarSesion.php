<?php
	date_default_timezone_set('America/Tegucigalpa');
	include("../Clases/Conexion.php");
	$conexion = new Conexion();
	session_start();
	$consulta = sprintf("UPDATE tbl_sesion set estado='0' where idusuario='%s'", $conexion->antiInyeccion($_SESSION['ID']) );
	$conexion->ejecutarconsulta($consulta);
	$fecha=date("Y-m-d");
	$hora=date("G:i:s");
	$consultaB = sprintf("INSERT INTO tbl_log(evento, descripcion, fecha, hora,direccion_ip_usuario ,usuarioid) values('%s','%s','%s','%s','%s','%s')",$conexion->antiInyeccion("Cierre de sesion"),$conexion->antiInyeccion("El usuario con correo:"." ".$_SESSION['Correo']." "."ha cerrado sesion"),$conexion->antiInyeccion($fecha),$conexion->antiInyeccion($hora), $conexion->antiInyeccion($conexion->ip()),$conexion->antiInyeccion($_SESSION['ID']));
	$conexion->ejecutarconsulta($consultaB);
	mysqli_close($conexion);
	session_destroy();
	header('Location: ../index.php');
  ?>