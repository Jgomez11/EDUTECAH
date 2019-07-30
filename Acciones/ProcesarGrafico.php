<?php
include("../Clases/Conexion.php");






function build_report($year){
	session_start();
	$conexion = new Conexion();
	$conexion->mysql_set_charset("utf8");

	$total = array();
	for($i=0; $i<12; $i++){
		$month = $i+1;
		$consulta="SELECT SUM(tbl_detalle_factura.Total) AS total FROM tbl_detalle_factura,tbl_factura, tbl_producto, tbl_proveedor  WHERE tbl_detalle_factura.IDFactura=tbl_factura.IDFactura AND tbl_detalle_factura.IDProducto=tbl_producto.Idproducto AND tbl_producto.IDProveedor=tbl_proveedor.IDProveedor AND tbl_proveedor.IDProveedor=".$_SESSION['Proveedor']." AND  MONTH(tbl_factura.FechaFactura) = ".$month." AND YEAR(tbl_factura.FechaFactura) = ".$year." LIMIT 1";
		$resultado=$conexion->ejecutarconsulta($consulta);	
		$total[$i] = 0;
		foreach ($resultado as $key){ $total[$i] = ($key['total'] == null)? 0 : $key['total']; }
	}			 
	return $total;
}



echo json_encode(build_report($_POST['year']));

?>