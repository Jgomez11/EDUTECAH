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
	$idGrado = $_POST["txtIDGrado"];
	$idInstituto = $_SESSION["Instituto"];
	$pase = generarCodigo(8);

	#	Verificacion de pase
	$existePase = 0;
	
	while ($existePase == 0) {
		$consulta = sprintf("SELECT count(*) FROM tblcursoxinstituto WHERE CodigoCurso = '%s'",
		$conexion->antiInyeccion($pase));
		$resultado = $conexion->ejecutarconsulta($consulta);
		
		if ($resultado->fetch_assoc()['count(*)'] != '0') {
			$pase = generarCodigo(8);
		} else{
			$existePase = 1;
		}
	}
			
	#	Insercion en tblCursoXInstituto
		$consulta = sprintf("INSERT INTO tblcursoxInstituto(IDInstituto, IDCurso, IDGrado, CodigoCurso) values('%s', '%s','%s','%s')",
			$conexion->antiInyeccion($idInstituto),
			$conexion->antiInyeccion($idCurso),
			$conexion->antiInyeccion($idGrado),
			$conexion->antiInyeccion($pase));
		$conexion->ejecutarconsulta($consulta);
						
	#	Insercion en tblLOGS
		$fecha=date("Y-m-d");
		$hora=date("G:i:s");
		$consultaLog = sprintf("INSERT INTO tbllogs(Evento, Descripcion, Fecha, Hora, IPusuario, IDUsuario) values('%s','%s','%s','%s','%s','%s')",
			$conexion->antiInyeccion("Nuevo curso"),
			$conexion->antiInyeccion("Se ha registrado un nuevo curso con el codigo: ".$pase),
			$conexion->antiInyeccion($fecha),
			$conexion->antiInyeccion($hora),
			$conexion->antiInyeccion($conexion->ip()),
			$conexion->antiInyeccion($_SESSION['ID']));
		$conexion->ejecutarconsulta($consultaLog);
			
	#	Retorno a JavaScript Exito
		echo $pase;

	#	Funcion codigo random
	function generarCodigo($longitud) {
		$key = '';
		$pattern = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$max = strlen($pattern)-1;
		for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
		return $key;
	}
?>