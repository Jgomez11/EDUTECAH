<?php  
include("../Clases/Conexion.php");
$conexion = new Conexion();
$conexion->mysql_set_charset("utf8");
session_start();
//Primera parte algoritmo de busqueda dinamica
/*function listarProductos($valor,$conexion){
	$consulta="SELECT NombreProducto,PrecioActual FROM tbl_producto WHERE NombreProducto like '%".$valor."%' and IDProveedor=".$_SESSION['Proveedor'];
	$resultado=$conexion->ejecutarconsulta($consulta);
	$arreglo=array();
	while ($re=$resultado->fetch_array(MYSQLI_NUM)) {
		$arreglo[]=$re;
	}
	return $arreglo;
	mysqli_close($conexion->getLink());

}

	$val=$_POST['val'];
	echo json_Encode(listarProductos($val,$conexion));*/

   $salida="<div class='col-md-12 table-responsive'>
            <table class='table table-bordered'>
    			<thead>
    				<tr id='titulo'>
    					<th>Nombre</th>
    					<th>Precio</th>
                        <th>Cantidad</th>
                        <th>Estado</th>
    					<th>Opciones</th>
    				</tr>

    			</thead>
    	<tbody>";
	if(isset($_POST['consulta'])){
		$sql="SELECT IDProducto,NombreProducto,PrecioActual,PrecioAnterior,Cantidad,NombreEstado FROM tbl_producto, tbl_estado WHERE tbl_producto.IDEstado=tbl_estado.IDEstado and NombreProducto like '%".$_POST['consulta']."%' and IDProveedor=".$_SESSION['Proveedor'];
	}
	$resultado=$conexion->ejecutarconsulta($sql);
	if ($conexion->cantidadregistros($resultado)>0) {
    	

    	while ($arreglo = $resultado->fetch_assoc()) {
    		$salida.='<tr>
    					<td>'.$arreglo['NombreProducto'].'</td>
    					<td>'.$arreglo['PrecioActual'].'</td>
                        <td>'.$arreglo['Cantidad'].'</td>
                        <td>'.$arreglo['NombreEstado'].'</td>
    					<td><a role="button"'.'class='.'"btn btn-block btn-primary mr-2 mb-2"'.'href="#"'.' onclick="modificar('.$arreglo["IDProducto"].')"><i class='.'"glyphicon glyphicon-pencil"'.'></i>&nbsp;Modificar</a><a role="button" class='.'"btn btn-danger btn-block mb-2"'.' href="#" onclick="eliminar('.$arreglo["IDProducto"].')"><i class='.'"glyphicon glyphicon-remove"'.'></i>&nbsp;Eliminar</a></td></tr>';
    	}
    	$salida.="</tbody></table>";
    }else{
    	$salida.="<tr><td colspan='4' style='text-align:center'>Aun no hay Productos en su inventario</td></tr></div>";
    }


    echo $salida;

    mysqli_close($conexion->getLink());

?>