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
	$idCurso = $_POST["txtIDCurso"];
	$asignatura = $_POST["txtAsignatura"];
	$idInstituto = $_SESSION["Instituto"];
	$idDocente = $_SESSION["ID"];
			
	#	Insercion en tblAula
		$consulta = sprintf("INSERT INTO tblAula(IDInstituto, CodigoCurso, IDDocente, Asignatura, IDEstado) values('%s', '%s','%s','%s', 1)",
			$conexion->antiInyeccion($idInstituto),
			$conexion->antiInyeccion($idCurso),
			$conexion->antiInyeccion($idDocente),
			$conexion->antiInyeccion($asignatura));
		$conexion->ejecutarconsulta($consulta);
						
	#	Insercion en tblLOGS
		$fecha=date("Y-m-d");
		$hora=date("G:i:s");
		$consultaLog = sprintf("INSERT INTO tbllogs(Evento, Descripcion, Fecha, Hora, IPusuario, IDUsuario) values('%s','%s','%s','%s','%s','%s')",
			$conexion->antiInyeccion("Nueva aula"),
			$conexion->antiInyeccion("Se ha registrado una nuevo aula para el curso: ".$pase),
			$conexion->antiInyeccion($fecha),
			$conexion->antiInyeccion($hora),
			$conexion->antiInyeccion($conexion->ip()),
			$conexion->antiInyeccion($_SESSION['ID']));
		$conexion->ejecutarconsulta($consultaLog);
			
	#	Retorno a JavaScript Exito
		echo '0';
?>