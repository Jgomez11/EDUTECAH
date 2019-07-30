<?php 
	# Clases de Base de datos inserciones
  	include("../Clases/Conexion.php");

  	# Creacion de la conexion a la Base de Datos
  	$conexion = new Conexion();
  	$conexion->mysql_set_charset("utf8");

  	$idPedido = $_POST["idp"];
  	$idEstado = $_POST["ide"];
	
	$consulta = sprintf("UPDATE tbl_pedido SET IDEstado = '%s' WHERE IDPedido = '%s'", $idEstado, $idPedido);
	$conexion->ejecutarconsulta($consulta);

	echo "Cambio de estado exitoso";
 ?>