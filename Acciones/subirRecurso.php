<?php 
	session_start();

	#    Importar Clases
	include("../Clases/Conexion.php");
	#    Crear conexion
	$conexion = new Conexion();
	$conexion->mysql_set_charset("utf8");

	$titulo 	= $_POST["Titulo"];
	$categorias = $_POST["Categorias"];
	$extension 	= $_POST["Extension"];

	$archivo 	= $_FILES["Archivo"];

	#	Insercion en tblAula
	$consulta = sprintf("INSERT INTO tblRecurso(IDAula, Titulo, Tipo, Categorias) values('%s', '%s','%s','%s')",
		$conexion->antiInyeccion($_SESSION['IDAula']),
		$conexion->antiInyeccion($titulo),
		$conexion->antiInyeccion($extension),
		$conexion->antiInyeccion($categorias));
	$conexion->ejecutarconsulta($consulta);

	$consulta = sprintf("SELECT IDRecurso FROM tblRecurso WHERE IDAula = '%s' AND Titulo = '%s'",
		$conexion->antiInyeccion($_SESSION['IDAula']),
		$conexion->antiInyeccion($titulo));
	
	$id = $conexion->ejecutarconsulta($consulta)->fetch_assoc()['IDRecurso'];
	
	$directorio = "../Recursos/Data/".$id.$extension;
	move_uploaded_file($archivo['tmp_name'], $directorio);
 ?>