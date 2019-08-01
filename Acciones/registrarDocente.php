<?php 
	date_default_timezone_set('America/Tegucigalpa');
	include("../Clases/Conexion.php");
	$conexion = new Conexion();
	$conexion->mysql_set_charset("utf8");
	include("../Clases/Usuario.php");

	$nombre= ucwords(strtolower($_POST["txtNombre"]));
	$apellido=ucwords(strtolower($_POST["txtApellido"]));
	$correo=$_POST["txtCorreo"];
	$password=sha1($_POST["txtPassword"]);
	
	$reg = new registro(null,
	$nombre,
	$apellido,
	$correo,
	$password,
	null);

	

	$consulta = sprintf("SELECT count(*) FROM tbl_usuario WHERE Correo = '%s'",$conexion->antiInyeccion($correo));
		$resultado = $conexion->ejecutarconsulta($consulta);

		//	Verificar que no se haya registrado el correo, insertar si no hay coincidencias
		if ($resultado->fetch_assoc()['count(*)'] == '0') {		
			//	Realizar insercion

			$reg ->registrar($conexion);
			
			//	Crear sesion
			session_start();
			$consulta = sprintf("SELECT IDUsuario, TipoUsuario FROM tbl_usuario WHERE Correo = '%s'",$conexion->antiInyeccion($correo));
			$_SESSION['ID'] = $conexion->ejecutarconsulta($consulta)->fetch_assoc()['IDUsuario'];
			$_SESSION['TipoUsuario'] = $conexion->ejecutarconsulta($consulta)->fetch_assoc()['TipoUsuario'];
			$_SESSION['Usuario'] = $nombre." ".$apellido;
			$_SESSION['Nombre'] = $nombre;
			$_SESSION['Apellido'] = $apellido;
			$_SESSION['Correo'] = $correo;
			$_SESSION['Imagen'] = NULL;
			if (isset($_SESSION["Carrito"])) {
				$consulta = sprintf("UPDATE tbl_carrito SET IDUsuario = '%S' WHERE IDCarrito = '%s'", $conexion->antiInyeccion($_SESSION["ID"]), $conexion->antiInyeccion($_SESSION["Carrito"]));
				$conexion->ejecutarconsulta($consulta);
			}
			
			// Redirigir
			header('Location: ../index.php');

			//
			$consulta =sprintf("INSERT INTO tbl_sesion(idusuario, estado) values('%s','%s')", $conexion->antiInyeccion($_SESSION['ID']), $conexion->antiInyeccion("1"));
			$conexion->ejecutarconsulta($consulta);

			$fecha=date("Y-m-d");
			$hora=date("G:i:s");
			$consultaB = sprintf("INSERT INTO tbl_log(evento, descripcion, fecha, hora,direccion_ip_usuario,usuarioid) values('%s','%s','%s','%s','%s','%s')",$conexion->antiInyeccion("Nuevo registro"),$conexion->antiInyeccion("Se ha registrado un nuevo usuario con la direccion de correo:"." ".$correo),$conexion->antiInyeccion($fecha),$conexion->antiInyeccion($hora),$conexion->antiInyeccion($conexion->ip()) ,$conexion->antiInyeccion($_SESSION['ID']));
			$conexion->ejecutarconsulta($consultaB);
			
			mysqli_close($conexion);
		//	En caso de encontrarse un error, se retornara a la pagina de registro
		} else {
			mysqli_close($conexion);
			$var = "Este correo ya fue registrado previamente";		
			echo "<script>
					alert('".$var."'); 
  					window.location='../registro.php';
				  </script>";
		}


 ?>