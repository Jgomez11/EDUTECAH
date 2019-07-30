<?php  
include("../Clases/Conexion.php");
include("../Clases/Producto.php");
$conexion = new Conexion();
$conexion->mysql_set_charset("utf8");
date_default_timezone_set('America/Tegucigalpa');
session_start();

$precio = $_POST["txtPrecio"];
$nombreProducto = ucwords(strtolower($_POST["txtNombreProducto"]));
$categoria = $_POST["slcCategoria"];
$color = $_POST["slcColor"];
$descripcion = $_POST["txtArea"];
$cantidad=$_POST["txtCantidad"];
$proveedor = $_SESSION['Proveedor'];

    // Verificamos si el tipo de archivo es un tipo de imagen permitido.
    // y que el tamaño del archivo no exceda los 16MB
$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
$limite_kb = 16384;

if (in_array($_FILES['chsImagen']['type'][0], $permitidos) && $_FILES['chsImagen']['size'][0] <= $limite_kb * 1024){
        // Archivo temporal
	$imagenTemporal = $_FILES['chsImagen']['tmp_name'][0];

        // Leemos el contenido del archivo temporal en binario.

	$contenidoImagen = file_get_contents($imagenTemporal);
        //$fp = fopen($imagenTemporal, 'r+b');
        //$data = fread($fp, filesize($imagenTemporal));
        //fclose($fp);

	$prod= new Producto(null,$nombreProducto,$descripcion,$precio,null,null,$contenidoImagen,$cantidad,null,$color,$categoria,$proveedor,null);
	$consulta = sprintf("SELECT count(NombreProducto) FROM tbl_producto WHERE NombreProducto='%s' AND IDProveedor='%s'",
		$conexion->antiInyeccion($nombreProducto),	
		$conexion->antiInyeccion($proveedor));
	$resultado=$conexion->ejecutarconsulta($consulta);
	if ($resultado->fetch_assoc()['count(NombreProducto)']=='0') {
		$prod->agregar($conexion);


		$consulta = sprintf("SELECT IDProducto FROM tbl_producto WHERE NombreProducto='%s' AND IDProveedor='%s'",$conexion->antiInyeccion($nombreProducto),$conexion->antiInyeccion($proveedor));
		$result=$conexion->ejecutarconsulta($consulta);
		$idprod=$result->fetch_assoc(); 

			//$imagenTemporal1=$_FILES['chsImagen']['tmp_name'][1];
			//$contenidoImagen = file_get_contents($imagenTemporal1);
			//$cons = sprintf("INSERT INTO tbl_imagenes(IDProducto,Imagen) VALUES('%s','%s')",$conexion->antiInyeccion($idprod['IDProducto']),$conexion->antiInyeccion($contenidoImagen));
			//$conexion->ejecutarconsulta($cons);
			//for ($i=1; $i<5; $i++){
		foreach ($_FILES['chsImagen']['tmp_name'] as $key => $tmp_name) {
				# code...
			if (in_array($_FILES['chsImagen']['type'][$key], $permitidos) && $_FILES['chsImagen']['size'][$key] <= $limite_kb * 1024){
				$imagenTemporal = $_FILES['chsImagen']['tmp_name'][$key];
				$contenidoImagen = file_get_contents($imagenTemporal);
				$cons = sprintf("INSERT INTO tbl_imagenes(IDProducto,Imagen) VALUES('%s','%s')",$conexion->antiInyeccion($idprod['IDProducto']),$conexion->antiInyeccion($contenidoImagen));
				$conexion->ejecutarconsulta($cons);
			}	
		}
			//}

		$fecha=date("Y-m-d");
		$hora=date("G:i:s");

		$sql="SELECT Correo FROM tbl_usuario Where IDUsuario=".$_SESSION['ID'];
		$resul=$conexion->ejecutarconsulta($sql);
		$correo=$conexion->obtenerfila($resul);

		$consultaC = sprintf("INSERT INTO tbl_log(evento, descripcion, fecha, hora,direccion_ip_usuario ,usuarioid) values('%s','%s','%s','%s','%s','%s')",$conexion->antiInyeccion("Agregar producto"),$conexion->antiInyeccion("El usuario con correo:"." ".$correo['Correo']." "."ha agregado el producto con nombre"." ".$nombreProducto),$conexion->antiInyeccion($fecha),$conexion->antiInyeccion($hora), $conexion->antiInyeccion($conexion->ip()),$conexion->antiInyeccion($_SESSION['ID']));

		$conexion->ejecutarconsulta($consultaC);
		header('Location: ../perfil.php');
		mysqli_close($conexion->getLink());
	}else{
		$var = "ERROR: Ya existe un producto con este nombre";		
		echo "<script>
		alert('".$var."'); 
		window.location='../perfil.php';
		</script>";
	}
}else{
	$var = "Error archivo no permitido";		
	echo "<script>
	alert('".$var."'); 
	window.location='../perfil.php';
	</script>";   
}





?>