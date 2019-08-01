<?php
    session_start();

#	Importar Clases
 	include("../Clases/Conexion.php");

#	Utilidad de fecha
	date_default_timezone_set('America/Tegucigalpa');

#	Crear conexion
 	$conexion = new Conexion();
 	$conexion->mysql_set_charset("utf8");


 	$fecha = date("Y-m-d");				

#	Obtener los datos POST desde JavaScript
 	$correo = $_POST["correo"];
 	$password = sha1($_POST["password"]);

#	Verificacion 1: Correo
 	$consulta= sprintf("SELECT count(*) FROM tblUsuario where Correo='%s'", $conexion->antiInyeccion($correo));
 	$resultado=$conexion->ejecutarconsulta($consulta);
 	$data = $conexion->obtenerFila($resultado);
 	if ($data['count(*)'] == '1') {

#	Verificacion 2: Contraseña
 		$consulta = sprintf("SELECT password FROM tblUsuario where correo='%s'", $conexion->antiInyeccion($correo));
	 	$resultado=$conexion->ejecutarconsulta($consulta);
 		$data = $conexion->obtenerFila($resultado);
 	
	 	if ($password == $data['password']) {
#	Crear Sesion
			$consulta = sprintf("SELECT idusuario, correo, tipousuario, nombre, apellido FROM tblUsuario WHERE correo = '%s'",
				$conexion->antiInyeccion($correo));
			$resultado = $conexion->ejecutarconsulta($consulta);
			$data = $conexion->obtenerFila($resultado);
							
			$_SESSION['ID'] = $data['idusuario'];
			$_SESSION['TipoUsuario'] = $data['tipousuario'];
			$_SESSION['Usuario']= $data['nombre']." ".$data['apellido'];
			$_SESSION['Correo']= $correo;
			$_SESSION['Nombre']= $data['nombre'];
			$_SESSION['Apellido']= $data['apellido'];
			$_SESSION['Imagen']= NULL;

			$consulta = sprintf("SELECT idinstituto FROM tbldocxinstituto WHERE IDDocente = '%s'",
				$conexion->antiInyeccion($_SESSION['ID']));
			$_SESSION['Instituto'] = $conexion->ejecutarconsulta($consulta)->fetch_assoc()['idinstituto'];

			$consulta = sprintf("SELECT pase FROM tblinstituto WHERE IDInstituto = '%s'",
				$conexion->antiInyeccion($_SESSION['Instituto']));
			$_SESSION['Pase'] = $conexion->ejecutarconsulta($consulta)->fetch_assoc()['pase'];
			
#	Insercion en tblLogs
			$hora = date("G:i:s");
			$consultaB = sprintf("INSERT INTO tbllogs(Evento, Descripcion, Fecha, Hora, IPusuario, IDUsuario) VALUES ('%s','%s','%s','%s','%s','%s')",
				$conexion->antiInyeccion("Inicio de sesion"),
				$conexion->antiInyeccion("El usuario con correo:"." ".$correo." "."ha iniciado sesion"),
				$conexion->antiInyeccion($fecha),
				$conexion->antiInyeccion($hora),
				$conexion->antiInyeccion($conexion->ip()),
				$conexion->antiInyeccion($_SESSION['ID']));
			$conexion->ejecutarconsulta($consultaB);	
#	Exito			
			echo '0';
		
#	Contrase;a invalida		
		} else {		
			echo '1';
		}	
#	Correo Inexistente
 	} else {		
		echo '2';
 	}
?>