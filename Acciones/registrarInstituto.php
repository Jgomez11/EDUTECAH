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

	$existePase = 0;
	
	while ($existePase == 0) {
		$consulta = sprintf("SELECT count(*) FROM tblInstituto WHERE Pase = '%s'",
		$conexion->antiInyeccion($pase));
		$resultado = $conexion->ejecutarconsulta($consulta);
		
		if ($resultado->fetch_assoc()['count(*)'] != '0') {
			$pase = generarCodigo(8);
		} else{
			$existePase = 1;
		}
	}

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
	#	Datos Personales
			$consulta = sprintf("SELECT IDUsuario, TipoUsuario FROM tblUsuario WHERE Correo = '%s'",$conexion->antiInyeccion($correo));
			$_SESSION['ID'] = $conexion->ejecutarconsulta($consulta)->fetch_assoc()['IDUsuario'];
			$_SESSION['TipoUsuario'] = $conexion->ejecutarconsulta($consulta)->fetch_assoc()['TipoUsuario'];
			$_SESSION['Usuario'] = $nombre." ".$apellido;
			$_SESSION['Nombre'] = $nombre;
			$_SESSION['Apellido'] = $apellido;
			$_SESSION['Correo'] = $correo;
			$_SESSION['Imagen'] = NULL;
			$_SESSION['Pase'] = $pase;
			$_SESSION['Plan'] = '1';

#	Insercion en tblINSTTUTO
			$consulta = sprintf("INSERT INTO tblInstituto(CodigoIns, NombreIns, Pase, IDMunicipio, Direccion, Director) values('%s','%s','%s','%s','%s','%s')",
				$conexion->antiInyeccion($codIns),
				$conexion->antiInyeccion($nombreIns),
				$conexion->antiInyeccion($pase),
				$conexion->antiInyeccion($municipio),
				$conexion->antiInyeccion($direccion),
				$conexion->antiInyeccion($_SESSION['ID']));
			$conexion->ejecutarconsulta($consulta);
			
#	Insercion en tblDocentesXInstituto
	#	Datos Instituto
			$consulta = sprintf("SELECT IDInstituto FROM tblInstituto WHERE Director = '%s'", $conexion->antiInyeccion($_SESSION['ID']));
			$_SESSION['Instituto'] = $conexion->ejecutarconsulta($consulta)->fetch_assoc()['IDInstituto'];

			$consulta = sprintf("INSERT INTO tblDocxInstituto(IDDocente, IDInstituto) values('%s','%s')",
				$conexion->antiInyeccion($_SESSION['ID']),
				$conexion->antiInyeccion($_SESSION['Instituto']));
			$conexion->ejecutarconsulta($consulta);
			
#	Insercion en tblPlan
			$consulta = sprintf("INSERT INTO tblPlan(IDTipoPlan, IDInstituto, DiasPrueba, AulasDisponibles) values('%s','%s','%s','%s')",
				$conexion->antiInyeccion('1'),
				$conexion->antiInyeccion($_SESSION['Instituto']),
				$conexion->antiInyeccion('30'),
				$conexion->antiInyeccion('10'));
			$conexion->ejecutarconsulta($consulta);
			
#	Insercion en tblLOGS
			$fecha=date("Y-m-d");
			$hora=date("G:i:s");
			$consultaLog = sprintf("INSERT INTO tbllogs(Evento, Descripcion, Fecha, Hora, IPusuario, IDUsuario) values('%s','%s','%s','%s','%s','%s')",
				$conexion->antiInyeccion("Nuevo registro"),
				$conexion->antiInyeccion("Nuevo usuario con la direccion de correo: ".$correo),
				$conexion->antiInyeccion($fecha),
				$conexion->antiInyeccion($hora),
				$conexion->antiInyeccion($conexion->ip()),
				$conexion->antiInyeccion($_SESSION['ID']));
			$conexion->ejecutarconsulta($consultaLog);
			
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