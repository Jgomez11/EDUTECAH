<?php
# Clases de Base de datos inserciones
include("../Clases/Conexion.php");

# Creacion de la conexion a la Base de Datos
$conexion = new Conexion();
$conexion->mysql_set_charset("utf8");
$id = $_POST['idd'];

$consulta = sprintf("SELECT IDMunicipio, NombreMunicipio FROM tblMunicipio WHERE IDDepartamento = '%s' ORDER BY IDMunicipio", 
  $conexion->antiInyeccion($id));

$resultado = $conexion->ejecutarconsulta($consulta);
$iter = $conexion->cantidadRegistros($resultado);

$cadena = '';

for ($i=0; $i < $iter; $i++) {
  $data = $conexion->obtenerFila($resultado);
  $cadena.= '<div class="item" data-value="'.$data["IDMunicipio"].'">'.$data["NombreMunicipio"].'</div>';
}

echo $cadena;
?>