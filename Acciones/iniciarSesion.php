<?php
	#	Clases de Base de datos y de horarios para inserciones
	date_default_timezone_set('America/Tegucigalpa');
 	include("../Clases/Conexion.php");

 	#	Creacion de la conexion a la Base de Datos
 	$conexion = new Conexion();
 	$conexion->mysql_set_charset("utf8");

 	#	Datos de fecha para la insercion en la tabla de logs
	$fecha = date("Y-m-d");
					
 	#	Carga de los elementos recibidios por el HTML via POST
 	$correo = $_POST["correo"];
 	$password = sha1($_POST["password"]);

 	#	Consulta de busqueda de correo
 	$consulta= sprintf("SELECT count(*) FROM tbl_usuario where correo='%s'", $conexion->antiInyeccion($correo));
 	$resultado=$conexion->ejecutarconsulta($consulta);

 	# 	Caso verdadero, continuar. Caso falso, redirigir a pagina de registro indicando que el correo esta disponible para su uso en la plataforma
 	if ($resultado->fetch_assoc()['count(*)'] == '1') {

 		#	Consulta de verificacion de sesion
 		$consulta=sprintf("SELECT Estado FROM tbl_sesion where idusuario=(SELECT idusuario FROM tbl_usuario where correo='%s')",$conexion->antiInyeccion($correo));
 		$aux=$conexion->ejecutarconsulta($consulta);

 		#	Caso verdadero, continuar. Caso falso, no permitir el inicio de sesion
 		if ($aux->fetch_assoc()['Estado']== '0') {

 			#	Consulta de comparacion de contraseña
 			$cons= sprintf("SELECT password FROM tbl_usuario where correo='%s'", $conexion->antiInyeccion($correo));

 			#	Caso verdadero, continuar. Caso falso, mostrar mensaje de contraseña incorrecta
	 		if ($password==$conexion->ejecutarconsulta($cons)->fetch_assoc()['password']) {
					
					#	Inicializar la variable $_SESSION
					session_start();

					#	Consulta de obtencion de datos para almacenar en la variable $_SESSION
					$consulta=sprintf("SELECT idusuario, correo, tipousuario, nombre, apellido, imagen FROM tbl_usuario WHERE correo = '%s'",$conexion->antiInyeccion($correo));

					#	Almacenamiento de datos
					$_SESSION['ID'] = $conexion->ejecutarconsulta($consulta)->fetch_assoc()['idusuario'];
					$_SESSION['TipoUsuario'] = $conexion->ejecutarconsulta($consulta)->fetch_assoc()['tipousuario'];
					$_SESSION['Usuario']=$conexion->ejecutarconsulta($consulta)->fetch_assoc()['nombre']." ".$conexion->ejecutarconsulta($consulta)->fetch_assoc()['apellido'];
					$_SESSION['Correo']=$conexion->ejecutarconsulta($consulta)->fetch_assoc()['correo'];
					$_SESSION['Nombre']=$conexion->ejecutarconsulta($consulta)->fetch_assoc()['nombre'];
					$_SESSION['Apellido']=$conexion->ejecutarconsulta($consulta)->fetch_assoc()['apellido'];
					$_SESSION['Imagen']=$conexion->ejecutarconsulta($consulta)->fetch_assoc()['imagen'];

					#	Verificacion del tipo de usuario (Cliente, Proveedor, Administrador), Caso verdadero, almacenar en indice Proveedor
					if ($_SESSION['TipoUsuario'] == '2') {
						
						#	Consulta para obtener el IDProveedor
						$consultaProv = sprintf("SELECT IDProveedor FROM tbl_proveedor WHERE IDUsuario = '%s'", $conexion->antiInyeccion($_SESSION['ID']));

						#	Almacenamiento en la variable $_SESSION
						$_SESSION['Proveedor'] = $conexion->ejecutarconsulta($consultaProv)->fetch_assoc()['IDProveedor'];
					}

					#	Establecer el nuevo estado del usuario como conectado
					$sql = sprintf("UPDATE tbl_sesion SET Estado = '1' WHERE idusuario = '%s'",$conexion->antiInyeccion($_SESSION['ID']));
					$conexion->ejecutarconsulta($sql);

					#	Insertar en la tabla de logs el inicio de sesion exitoso
					$hora = date("G:i:s");
					$consultaB = sprintf("INSERT INTO tbl_log(evento, descripcion, fecha, hora,direccion_ip_usuario ,usuarioid) values('%s','%s','%s','%s','%s','%s')",$conexion->antiInyeccion("Inicio de sesion"),$conexion->antiInyeccion("El usuario con correo:"." ".$correo." "."ha iniciado sesion"),$conexion->antiInyeccion($fecha),$conexion->antiInyeccion($hora), $conexion->antiInyeccion($conexion->ip()),$conexion->antiInyeccion($_SESSION['ID']));
					$conexion->ejecutarconsulta($consultaB);
					
					#	En caso de que el usuario tenga un carrito activo antes de iniciar sesion, asignarle el ID de la sesion
					if (isset($_SESSION["Carrito"])) {
						#	Consulta de verificacion de carrito existente registrado al usuario
						$consulta = sprintf("SELECT IDCarrito FROM tbl_carrito WHERE Pagado = 0 AND IDUsuario = '%s'", $conexion->antiInyeccion($_SESSION["ID"]));
						$resultado = $conexion->ejecutarconsulta($consulta);

						#	De no encontrar, simplemente enlazar el IDUsuario al Carrito. Caso contrario, modificar los datos del carrito actual
						if ($conexion->cantidadRegistros($resultado) == 0) {
							#	Consulta de actualizacion de Carrito
							$consulta = sprintf("UPDATE tbl_carrito SET IDUsuario = '%s' WHERE IDCarrito = '%s'", $conexion->antiInyeccion($_SESSION["ID"]), $conexion->antiInyeccion($_SESSION["Carrito"]));
							$conexion->ejecutarconsulta($consulta);
						} else {
							#	Consulta de actualizacion de Items en el carrito
							$data = $conexion->obtenerFila($resultado);
							$consulta = sprintf("UPDATE tbl_productos_carrito SET IDCarrito = '%s' WHERE IDCarrito = '%s'", $conexion->antiInyeccion($data["IDCarrito"]), $conexion->antiInyeccion($_SESSION["Carrito"]));
							$conexion->ejecutarconsulta($consulta);

							#	Consulta de eliminacion del carrito temporal
							$consulta = sprintf("DELETE FROM tbl_carrito WHERE IDCarrito = '%s'", $conexion->antiInyeccion($_SESSION["Carrito"]));
							$conexion->ejecutarconsulta($consulta);

							#	Actualizacion del IDCarrito en la variable $_SESSION
							$_SESSION["Carrito"] = $data["IDCarrito"];
						}

					} else {
						#	Consulta de verificacion de carrito existente registrado al usuario
						$consulta = sprintf("SELECT IDCarrito FROM tbl_carrito WHERE Pagado = 0 AND IDUsuario = '%s'", $conexion->antiInyeccion($_SESSION["ID"]));
						$resultado = $conexion->ejecutarconsulta($consulta);

						#	De encontrar, agregar el IDCarrito a la variable $_SESSION
						if ($conexion->cantidadRegistros($resultado) > 0) {
							$_SESSION["Carrito"] = $conexion->obtenerFila($resultado)["IDCarrito"];
						}
					}

					
					mysqli_close($conexion->getLink());
					echo '0';
					
				} else {
					mysqli_close($conexion->getLink());
					$var = "password erroneo";		
					echo '1';
				}	
 		}else {
 			$consulta = sprintf("SELECT idusuario FROM tbl_usuario where correo='%s'", $conexion->antiInyeccion($correo));
 			$id = $conexion->ejecutarconsulta($consulta)->fetch_assoc()['idusuario'];
 			$consulta = sprintf("INSERT INTO tbl_notificacion(Descripcion, Redireccion, IDUsuario) VALUES('%s','%s','%s')", $conexion->antiInyeccion("Intento de Inicio de Sesion"), $conexion->antiInyeccion("perfil.php"), $conexion->antiInyeccion($id));
 			$conexion->ejecutarconsulta($consulta);
			mysqli_close($conexion->getLink());
			$var = "Inicio de Sesion no Autorizado";		
			echo '2';
		}
 	} else {
 		$var = "El usuario no existe, registralo ahora";		
		echo '3';
 	}

?>