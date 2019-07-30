<?php  
	session_start();
	date_default_timezone_set('America/Tegucigalpa');
 	include("../Clases/Conexion.php");
 	$conexion = new Conexion();
 	$conexion->mysql_set_charset("utf8");

 	$nombre = ucwords(strtolower($_POST['txtNombre']));
 	$apellido = ucwords(strtolower($_POST['txtApellido']));
 	$correo = $_POST['txtEmail'];

 	$consulta = sprintf("SELECT count(*) FROM tbl_usuario WHERE Correo = '%s'",$conexion->antiInyeccion($correo));
	$resultado = $conexion->ejecutarconsulta($consulta);

	//	Verificar que no se haya registrado el correo, insertar si no hay coincidencias
	if ($resultado->fetch_assoc()['count(*)'] == '0' || $correo == $_SESSION['Correo']) {		
	

 	$sql = sprintf("UPDATE tbl_usuario SET Nombre ='%s' , Apellido='%s', Correo='%s' WHERE idusuario = '%s'",$conexion->antiInyeccion($nombre), $conexion->antiInyeccion($apellido), $conexion->antiInyeccion($correo), $conexion->antiInyeccion($_SESSION['ID']));

 	$conexion->ejecutarconsulta($sql);

 	$fecha=date("Y-m-d");
	$hora=date("G:i:s");
	$consultaB = sprintf("INSERT INTO tbl_log(evento, descripcion, fecha, hora,direccion_ip_usuario ,usuarioid) values('%s','%s','%s','%s','%s','%s')",$conexion->antiInyeccion("Modificacion de datos"),$conexion->antiInyeccion("El usuario con correo:"." ".$correo." "."ha modificado sus datos"),$conexion->antiInyeccion($fecha),$conexion->antiInyeccion($hora), $conexion->antiInyeccion($conexion->ip()),$conexion->antiInyeccion($_SESSION['ID']));

	$conexion->ejecutarconsulta($consultaB);

	$_SESSION['Usuario'] = $nombre." ".$apellido;
	$_SESSION['Correo'] = $correo;
	$_SESSION['Nombre'] = $nombre;
	$_SESSION['Apellido'] = $apellido;

	$var = "Datos modificados con exito";		
					echo "<script>
							alert('".$var."'); 
  							window.location='../perfil.php';
				  		</script>";
	} else {
		mysqli_close($conexion);
			$var = "Este correo ya fue registrado previamente";		
			echo "<script>
					alert('".$var."'); 
  					window.location='../perfil.php';
				  </script>";
	}
?>
