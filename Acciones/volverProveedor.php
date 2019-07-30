<?php
	#	Inicio de sesion
	session_start();

	#	Función para la fecha local, se usa en LOGS
	date_default_timezone_set('America/Tegucigalpa');

	#	Conexión a la Base de Datos
 	include("../Clases/Conexion.php");
 	$conexion = new Conexion();
 	$conexion->mysql_set_charset("utf8");

 	#	Carga de los datos recibidos por el método POST de HTML
 	$nombreEmp = $_POST["txtNombreEmp"];
 	$depto = $_POST["optDepto"];
 	$municipio = $_POST["optMun"];
 	$direccion = $_POST["txtDireccion"];
 	$telefono = $_POST["txtTelefono"];
 	$rtn = $_POST["txtRTN"];

 	#	Actualizar la tabla usuario
	$sql = sprintf("UPDATE tbl_usuario SET TipoUsuario = '2' WHERE idusuario = '%s'", $conexion->antiInyeccion($_SESSION['ID']));

 	$conexion->ejecutarconsulta($sql);
 	#	Fin de actualizacion

 	#	Insercion en tabla proveedor
 	#	1. Obtencion de IDMunicipio
	$consulta = sprintf("SELECT IDMunicipio FROM tbl_municipio WHERE NombreMunicipio = '%s' ORDER BY IDDepartamento ASC", $municipio);
	$resultado = $conexion->ejecutarconsulta($consulta);

	#	2. Realizar el insert
	$consulta = sprintf("INSERT INTO tbl_proveedor(NombreProveedor, Direccion, IDMunicipio, Telefono, RTN, IDUsuario) values('%s','%s','%s','%s','%s','%s')", $conexion->antiInyeccion($nombreEmp), $conexion->antiInyeccion($direccion), $conexion->obtenerFila($resultado)[0], $conexion->antiInyeccion($telefono), $conexion->antiInyeccion($rtn), $conexion->antiInyeccion($_SESSION['ID']));

	$conexion->ejecutarconsulta($consulta);

	#	Insercion en tabla de LOGS
 	$fecha=date("Y-m-d");
	$hora=date("G:i:s");
	
	$consulta = sprintf("INSERT INTO tbl_log(evento, descripcion, fecha, hora,direccion_ip_usuario ,usuarioid) values('%s','%s','%s','%s','%s','%s')",$conexion->antiInyeccion("Transicion a Vendedor"),$conexion->antiInyeccion("El usuario con correo:"." ".$_SESSION['Correo']." "."se ha vuelto vendedor"),$conexion->antiInyeccion($fecha),$conexion->antiInyeccion($hora), $conexion->antiInyeccion($conexion->ip()), $conexion->antiInyeccion($_SESSION['ID']));

	$conexion->ejecutarconsulta($consulta);

	# Actualizacion de la sesion y alerta 
	$consulta = sprintf("SELECT IDProveedor FROM tbl_proveedor WHERE IDUsuario = '%s'", $conexion->antiInyeccion($_SESSION['ID']));
	
	$_SESSION['Proveedor'] = $conexion->ejecutarconsulta($consulta)->fetch_assoc()['IDProveedor'];
	$_SESSION['TipoUsuario'] = '2';
	
	$var = "Te has vuelto proveedor";		
					echo "<script>
							alert('".$var."'); 
  							window.location='../perfil.php';
  							$(function(){
  								cargarDiv('zonaContenido','Contenido/agregar')
  								});
				  		</script>";
?>
