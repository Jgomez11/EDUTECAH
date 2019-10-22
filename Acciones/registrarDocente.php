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
$apellido = ucwords(strtolower($_POST["txtApellido"]));
$correo = $_POST["txtCorreo"];
$password = sha1($_POST["txtPassword"]);
$pase = $_POST["txtPase"];

#	Creacion de objeto Usuario
$user = new Usuario(null, $nombre, $apellido, $correo, $password, '3');

#	Verificacion 1: Correo
$consulta = sprintf(
	"SELECT count(*) FROM tblUsuario WHERE Correo = '%s'",
	$conexion->antiInyeccion($correo)
);
$resultado = $conexion->ejecutarconsulta($consulta);
if ($resultado->fetch_assoc()['count(*)'] == '0') {

	#	Verificacion 2: Codigo de Colegio
	$consulta = sprintf(
		"SELECT count(*) FROM tblInstituto WHERE Pase = '%s'",
		$conexion->antiInyeccion($pase)
	);
	$resultado = $conexion->ejecutarconsulta($consulta);
	if ($resultado->fetch_assoc()['count(*)'] == '1') {
		$user->registrar($conexion);


		#	Crear sesion
		#	Datos Personales
		$consulta = sprintf("SELECT IDUsuario, TipoUsuario FROM tblUsuario WHERE Correo = '%s'", $conexion->antiInyeccion($correo));
		$_SESSION['ID'] = $conexion->ejecutarconsulta($consulta)->fetch_assoc()['IDUsuario'];
		$_SESSION['TipoUsuario'] = $conexion->ejecutarconsulta($consulta)->fetch_assoc()['TipoUsuario'];
		$_SESSION['Usuario'] = $nombre . " " . $apellido;
		$_SESSION['Nombre'] = $nombre;
		$_SESSION['Apellido'] = $apellido;
		$_SESSION['Correo'] = $correo;
		$_SESSION['Imagen'] = NULL;
		$_SESSION['Pase'] = $pase;
		$_SESSION['Tema'] = 'teal';

		#	Insercion en tblDocentesXInstituto
		#	Datos Instituto
		$consulta = sprintf(
			"SELECT idinstituto FROM tblInstituto WHERE Pase = '%s'",
			$conexion->antiInyeccion($_SESSION['Pase'])
		);
		$_SESSION['Instituto'] = $conexion->ejecutarconsulta($consulta)->fetch_assoc()['idinstituto'];
		$consulta = sprintf(
			"INSERT INTO tblDocxInstituto(IDDocente, IDInstituto) values('%s','%s')",
			$conexion->antiInyeccion($_SESSION['ID']),
			$conexion->antiInyeccion($_SESSION['Instituto'])
		);
		$conexion->ejecutarconsulta($consulta);

		$consulta = sprintf(
			"SELECT idtipoplan FROM tblplan WHERE IDInstituto = '%s'",
			$conexion->antiInyeccion($_SESSION['Instituto'])
		);
		$_SESSION['Plan'] = $conexion->ejecutarconsulta($consulta)->fetch_assoc()['idtipoplan'];

		$consulta = sprintf(
			"INSERT INTO tblTema(IDUsuario) values('%s')",
			$conexion->antiInyeccion($_SESSION['ID'])
		);
		$conexion->ejecutarconsulta($consulta);

		#	Insercion en tblLOGS
		$fecha = date("Y-m-d");
		$hora = date("G:i:s");
		$consultaLog = sprintf(
			"INSERT INTO tbllogs(Evento, Descripcion, Fecha, Hora, IPusuario, IDUsuario) values('%s','%s','%s','%s','%s','%s')",
			$conexion->antiInyeccion("Nuevo registro"),
			$conexion->antiInyeccion("Se ha registrado un nuevo usuario con la direccion de correo: " . $correo),
			$conexion->antiInyeccion($fecha),
			$conexion->antiInyeccion($hora),
			$conexion->antiInyeccion($conexion->ip()),
			$conexion->antiInyeccion($_SESSION['ID'])
		);
		$conexion->ejecutarconsulta($consultaLog);

		#	Retorno a JavaScript Exito
		echo '0';
	} else {

		#	Retorno a JavaScript ERROR Colegio no registrado
		echo '1';
	}
} else {

	# 	Retorno a JavaScript ERROR Correo registrado
	echo '2';
}
