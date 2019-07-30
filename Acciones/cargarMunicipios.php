<?php  
  # Clases de Base de datos inserciones
  include("../Clases/Conexion.php");

  # Creacion de la conexion a la Base de Datos
  $conexion = new Conexion();
  $conexion->mysql_set_charset("utf8");

  $id = $_POST['idd'];

  $consulta = sprintf("SELECT NombreMunicipio FROM tbl_municipio WHERE IDDepartamento = '%s' ORDER BY IDMunicipio ASC", $conexion->antiInyeccion($id));
  $cadena = '';
  $resultado = $conexion->ejecutarconsulta($consulta);
  $iter = $conexion->cantidadRegistros($resultado);
  for ($i=0; $i < $iter; $i++) { 
    $cadena.= '<option>'.$conexion->obtenerFila($resultado)[0].'</option>';
  }

  echo $cadena;
 ?>
