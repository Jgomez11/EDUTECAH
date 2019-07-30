<?php 
	date_default_timezone_set('America/Tegucigalpa');
	include("../Clases/Conexion.php");
	$conexion = new Conexion();
	$conexion->mysql_set_charset("utf8");
	session_start();

	if (!isset($_SESSION["ID"])) {
		echo "Regístrate o inicia sesión para realizar la compra.";	
	} else{

	$subTotal = $_POST["ST"];
	$fecha=date("Y-m-d");
	$consulta = sprintf("SELECT IDProducto, Cantidad FROM tbl_productos_carrito WHERE IDCarrito ='%s'", $conexion->antiInyeccion($_SESSION["Carrito"]));
	$resultado = $conexion->ejecutarconsulta($consulta);
	$iter = $conexion->cantidadRegistros($resultado);

	$consulta = sprintf("INSERT INTO tbl_factura(IDUsuario, FechaFactura, SubTotal) VALUES('%s','%s', '%s')", $conexion->antiInyeccion($_SESSION["ID"]), $conexion->antiInyeccion($fecha), $conexion->antiInyeccion($subTotal));
	$conexion->ejecutarconsulta($consulta);

	$consulta = sprintf("SELECT IDFactura FROM tbl_factura WHERE IDUsuario = '%s' AND FechaFactura = '%s'", $conexion->antiInyeccion($_SESSION["ID"]), $conexion->antiInyeccion($fecha));

	$id = $conexion->ejecutarconsulta($consulta);
	$id = $conexion->obtenerFila($id);
	
	for ($i=0; $i < $iter ; $i++) {
		$data = $conexion->obtenerFila($resultado);
		$consulta = sprintf("SELECT PrecioActual FROM tbl_producto WHERE IDProducto = '%s'", $conexion->antiInyeccion($data["IDProducto"]));
		$precio = $conexion->ejecutarconsulta($consulta);
		$precio = $conexion->obtenerFila($precio)["PrecioActual"];
		
		$consulta = sprintf("INSERT INTO tbl_detalle_factura(IDFactura, IDProducto, Cantidad, Total) VALUES('%s','%s','%s','%s')", $conexion->antiInyeccion($id["IDFactura"]), $conexion->antiInyeccion($data["IDProducto"]), $conexion->antiInyeccion($data["Cantidad"]), $conexion->antiInyeccion($precio));
		$conexion->ejecutarconsulta($consulta);

		$consulta = sprintf("INSERT INTO tbl_pedido(IDProducto, Cantidad, IDFactura) VALUES('%s','%s','%s')", $conexion->antiInyeccion($data["IDProducto"]), $conexion->antiInyeccion($data["Cantidad"]), $conexion->antiInyeccion($id["IDFactura"]));
		$conexion->ejecutarconsulta($consulta);
		
		$consulta = sprintf("SELECT IDUsuario FROM tbl_proveedor, tbl_producto WHERE tbl_producto.IDProveedor = tbl_proveedor.IDProveedor AND tbl_producto.IDProducto = '%s'", $data["IDProducto"]);
		$IDUsuario = $conexion->ejecutarconsulta($consulta);
		$IDUsuario = $conexion->obtenerFila($IDUsuario)["IDUsuario"];

		$consulta = sprintf("INSERT INTO tbl_notificacion(Descripcion, Redireccion, IDUsuario) VALUES('%s','%s','%s')", $conexion->antiInyeccion("Se ha solicitado un producto"), $conexion->antiInyeccion("perfil.php"), $conexion->antiInyeccion($IDUsuario));
 		$conexion->ejecutarconsulta($consulta);
			
	}

	$consulta = sprintf("UPDATE tbl_carrito SET pagado = 1 WHERE IDCarrito ='%s'", $conexion->antiInyeccion($_SESSION["Carrito"]));
	$conexion->ejecutarconsulta($consulta);

	unset($_SESSION["Carrito"]);
	echo "El pago se ha ejecutado correctamente.";
	}

 ?>