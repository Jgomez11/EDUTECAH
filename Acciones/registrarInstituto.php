<?php 
	session_start();
#	Importar clases
	include("../Clases/Conexion.php");
	include("../Clases/Usuario.php");

#	Utilidad de fecha
	date_default_timezone_set('America/Tegucigalpa');

#	Crear conexion
	$conexion = new Conexion();
	$conexion->mysql_set_charset("utf8");

#	Obtener los datos POST desde JavaScript
	$nombre = ucwords(strtolower($_POST["txtNombre"]));
	$apellido =ucwords(strtolower($_POST["txtApellido"]));
	$correo = $_POST["txtCorreo"];
	$password = sha1($_POST["txtPassword"]);
	$codIns = $_POST["txtCodInstituto"];
	$nombreIns = $_POST["txtNomInstituto"];
	$municipio = $_POST["txtMunicipio"];
	$direccion = $_POST["txtDireccion"];
	$pase = generarCodigo(8);

#	Creacion de objeto Usuario
	$user = new Usuario(null,
	$nombre,
	$apellido,
	$correo,
	$password,
	'2');

#	Verificacion 1: Correo
	$consulta = sprintf("SELECT count(*) FROM tblUsuario WHERE Correo = '%s'",
		$conexion->antiInyeccion($correo));

	$resultado = $conexion->ejecutarconsulta($consulta);

	if ($resultado->fetch_assoc()['count(*)'] == '0') {		
#	Verificacion 2: Codigo de Colegio
		$consulta = sprintf("SELECT count(*) FROM tblInstituto WHERE CodigoIns = '%s'",
			$conexion->antiInyeccion($codIns));
		$resultado = $conexion->ejecutarconsulta($consulta);

		if ($resultado->fetch_assoc()['count(*)'] == '0'){
			$user->registrar($conexion);
			
#	Crear sesion
			$consulta = sprintf("SELECT IDUsuario, TipoUsuario FROM tblUsuario WHERE Correo = '%s'",$conexion->antiInyeccion($correo));
			$_SESSION['ID'] = $conexion->ejecutarconsulta($consulta)->fetch_assoc()['IDUsuario'];
			$_SESSION['TipoUsuario'] = $conexion->ejecutarconsulta($consulta)->fetch_assoc()['TipoUsuario'];
			$_SESSION['Usuario'] = $nombre." ".$apellido;
			$_SESSION['Nombre'] = $nombre;
			$_SESSION['Apellido'] = $apellido;
			$_SESSION['Correo'] = $correo;
			$_SESSION['Imagen'] = NULL;

#	Insercion en tblINSTTUTO
			$consulta = sprintf("INSERT INTO tblInstituto(CodigoIns, NombreIns, Pase, IDMunicipio, Direccion, Director) values('%s','%s','%s','%s','%s','%s')",
				$conexion->antiInyeccion($codIns),
				$conexion->antiInyeccion($nombreIns),
				$conexion->antiInyeccion($pase),
				$conexion->antiInyeccion($municipio),
				$conexion->antiInyeccion($direccion),
				$conexion->antiInyeccion($_SESSION['ID']));
			$conexion->ejecutarconsulta($consulta);

#	Insercion en tblLOGS
			$fecha=date("Y-m-d");
			$hora=date("G:i:s");
			$consulta = sprintf("INSERT INTO tblLogs(evento, descripcion, fecha, hora, ipusuario, usuarioid) values('%s','%s','%s','%s','%s','%s')",
				$conexion->antiInyeccion("Nuevo registro"),
				$conexion->antiInyeccion("Se ha registrado un nuevo usuario con la direccion de correo:"." ".$correo),
				$conexion->antiInyeccion($fecha),
				$conexion->antiInyeccion($hora),
				$conexion->antiInyeccion($conexion->ip()),
				$conexion->antiInyeccion($_SESSION['ID']));
			$conexion->ejecutarconsulta($consulta);
			
#	Retorno a JavaScript Exito
			echo '0';
		} else {
#	Retorno a JavaScript ERROR Colegio registrado
			echo '1';
		}

	} else {
# 	Retorno a JavaScript ERROR Correo registrado
		echo '2';
	}

#	Funcion codigo random
	function generarCodigo($longitud) {
 		$key = '';
 		$pattern = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
 		$max = strlen($pattern)-1;
 		for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
 		return $key;
	}
 ?>