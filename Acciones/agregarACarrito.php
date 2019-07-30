<?php 
	include("../Clases/Conexion.php");
	$conexion = new Conexion();
	$conexion->mysql_set_charset("utf8");
	session_start();

	$producto = $_POST['id'];

	$consulta = sprintf("SELECT Cantidad FROM tbl_producto WHERE IDProducto = '%s'", $conexion->antiInyeccion($producto));
	$inventario = $conexion->ejecutarconsulta($consulta);
	$inventario = $conexion->obtenerFila($inventario)["Cantidad"];

	if ($inventario == 0) {
		echo "El producto está agotado, no puede agregarse.";
	} else {
	if (empty($_SESSION)) {
		$consulta = sprintf("INSERT INTO tbl_carrito(IDUsuario, IP) VALUES(NULL, '%s')", $conexion->ip());
		$conexion->ejecutarconsulta($consulta);

		$consulta = sprintf("SELECT IDCarrito FROM tbl_carrito WHERE IP = '%s' ORDER BY IDCarrito DESC LIMIT 1", $conexion->ip());
		
		$_SESSION["Carrito"] = $conexion->ejecutarconsulta($consulta)->fetch_assoc()['IDCarrito'];

		$consulta = sprintf("INSERT INTO tbl_productos_carrito(IDProducto, IDCarrito, Cantidad) VALUES('%s','%s', 1)", $conexion->antiInyeccion($producto), $conexion->antiInyeccion($_SESSION["Carrito"]));

		$conexion->ejecutarconsulta($consulta);

		$consulta = sprintf("UPDATE tbl_producto SET Cantidad = '%s' WHERE IDProducto = '%s'", $conexion->antiInyeccion($inventario-1), $conexion->antiInyeccion($producto));
		$conexion->ejecutarconsulta($consulta);

	} else {
		if (!isset($_SESSION["ID"])) {
			$consulta = sprintf("SELECT Cantidad FROM tbl_productos_carrito WHERE IDProducto = '%s' AND IDCarrito = '%s'", $conexion->antiInyeccion($producto), $conexion->antiInyeccion($_SESSION["Carrito"]));
			$resultado = $conexion->ejecutarconsulta($consulta);

			if ($conexion->cantidadRegistros($resultado) > 0) {
				$data = $conexion->obtenerFila($resultado);
				$consulta = sprintf("UPDATE tbl_productos_carrito SET Cantidad = '%s' WHERE IDProducto = '%s' AND IDCarrito = '%s'", $conexion->antiInyeccion($data["Cantidad"]+1),$conexion->antiInyeccion($producto), $conexion->antiInyeccion($_SESSION["Carrito"]));
				$conexion->ejecutarconsulta($consulta);
			} else{
				$consulta = sprintf("INSERT INTO tbl_productos_carrito(IDProducto, IDCarrito, Cantidad) VALUES('%s','%s', 1)", $conexion->antiInyeccion($producto), $conexion->antiInyeccion($_SESSION["Carrito"]));
				$conexion->ejecutarconsulta($consulta);

				$consulta = sprintf("UPDATE tbl_producto SET Cantidad = '%s' WHERE IDProducto = '%s'", $conexion->antiInyeccion($inventario-1), $conexion->antiInyeccion($producto));
				$conexion->ejecutarconsulta($consulta);
			}
		} elseif (!isset($_SESSION["Carrito"])) {
			$consulta = sprintf("INSERT INTO tbl_carrito(IDUsuario, IP) VALUES('%s', '%s')",$conexion->antiInyeccion($_SESSION["ID"]), $conexion->ip());
			
			$conexion->ejecutarconsulta($consulta);

			$consulta = sprintf("SELECT IDCarrito FROM tbl_carrito WHERE IP = '%s' AND Pagado = 0", $conexion->ip());
		
			$_SESSION["Carrito"] = $conexion->ejecutarconsulta($consulta)->fetch_assoc()['IDCarrito'];

			$consulta = sprintf("INSERT INTO tbl_productos_carrito(IDProducto, IDCarrito, Cantidad) VALUES('%s','%s', 1)", $conexion->antiInyeccion($producto), $conexion->antiInyeccion($_SESSION["Carrito"]));

			$conexion->ejecutarconsulta($consulta);


			$consulta = sprintf("UPDATE tbl_producto SET Cantidad = '%s' WHERE IDProducto = '%s'", $conexion->antiInyeccion($inventario-1), $conexion->antiInyeccion($producto));
			$conexion->ejecutarconsulta($consulta);
		} else {
			$consulta = sprintf("SELECT Cantidad FROM tbl_productos_carrito WHERE IDProducto = '%s' AND IDCarrito = '%s'", $conexion->antiInyeccion($producto), $conexion->antiInyeccion($_SESSION["Carrito"]));
			$resultado = $conexion->ejecutarconsulta($consulta);

			if ($conexion->cantidadRegistros($resultado) > 0) {
				$data = $conexion->obtenerFila($resultado);
				$consulta = sprintf("UPDATE tbl_productos_carrito SET Cantidad = '%s' WHERE IDProducto = '%s' AND IDCarrito = '%s'", $conexion->antiInyeccion($data["Cantidad"]+1),$conexion->antiInyeccion($producto), $conexion->antiInyeccion($_SESSION["Carrito"]));
				$conexion->ejecutarconsulta($consulta);


				$consulta = sprintf("UPDATE tbl_producto SET Cantidad = '%s' WHERE IDProducto = '%s'", $conexion->antiInyeccion($inventario-1), $conexion->antiInyeccion($producto));
				$conexion->ejecutarconsulta($consulta);
			} else{
				$consulta = sprintf("INSERT INTO tbl_productos_carrito(IDProducto, IDCarrito, Cantidad) VALUES('%s','%s', 1)", $conexion->antiInyeccion($producto), $conexion->antiInyeccion($_SESSION["Carrito"]));
				$conexion->ejecutarconsulta($consulta);


				$consulta = sprintf("UPDATE tbl_producto SET Cantidad = '%s' WHERE IDProducto = '%s'", $conexion->antiInyeccion($inventario-1), $conexion->antiInyeccion($producto));
				$conexion->ejecutarconsulta($consulta);	
			}
		}
	}
	echo "Producto agregado con éxito";
	}

 ?>