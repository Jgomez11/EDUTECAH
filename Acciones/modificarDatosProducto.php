<?php  
include("../Clases/Conexion.php");
$conexion = new Conexion();
$conexion->mysql_set_charset("utf8");
date_default_timezone_set('America/Tegucigalpa');
session_start();

$identificador= $_POST['txtIdentificador'];
$nombre=$_POST['txtNombreProducto'];
$precio=$_POST['txtPrecio'];
$cantidad=$_POST['txtCantidad'];
$estado=$_POST['slcEstado'];
$categoria=$_POST['slcCategoria'];
$color=$_POST['slcColor'];
$descripcion=$_POST['txtArea'];



$consulta = "SELECT PrecioActual FROM tbl_producto WHERE IDProducto=".$identificador;
$resultado = $conexion->ejecutarconsulta($consulta);
$res=$conexion->obtenerfila($resultado);

//echo $nombre.$descripcion.$precio.$cantidad.$identificador.$estado.$color.$categoria.$res['PrecioActual'] ;

$consultaB = sprintf("UPDATE tbl_producto SET NombreProducto='%s', Descripcion='%s', PrecioActual='%s', PrecioAnterior='%s', Cantidad='%s', IDEstado='%s', IDColor='%s', IDCategoria='%s' WHERE IDProducto='%s'",
	$conexion->antiInyeccion($nombre),
	$conexion->antiInyeccion($descripcion),
	$conexion->antiInyeccion($precio),
	$conexion->antiInyeccion($res['PrecioActual']),
	$conexion->antiInyeccion($cantidad),
	$conexion->antiInyeccion($estado),
	$conexion->antiInyeccion($color),
	$conexion->antiInyeccion($categoria),
	$conexion->antiInyeccion($identificador));
$resultado=$conexion->ejecutarconsulta($consultaB);
header('Location: ../perfil.php');


$fecha=date("Y-m-d");
$hora=date("G:i:s");

$sql="SELECT Correo FROM tbl_usuario Where IDUsuario=".$_SESSION['ID'];
$resul=$conexion->ejecutarconsulta($sql);
$correo=$conexion->obtenerfila($resul);

$consultaC = sprintf("INSERT INTO tbl_log(evento, descripcion, fecha, hora,direccion_ip_usuario ,usuarioid) values('%s','%s','%s','%s','%s','%s')",$conexion->antiInyeccion("Modificacion de producto"),$conexion->antiInyeccion("El usuario con correo:"." ".$correo['Correo']." "."ha modificado los datos del producto con nombre"." ".$nombre),$conexion->antiInyeccion($fecha),$conexion->antiInyeccion($hora), $conexion->antiInyeccion($conexion->ip()),$conexion->antiInyeccion($_SESSION['ID']));

$conexion->ejecutarconsulta($consultaC);

mysqli_close($conexion->getLink());
?>