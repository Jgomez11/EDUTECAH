<?php  
session_start();

#   Importar Clases
include("../Clases/Conexion.php");

#   Utilidad de fecha
date_default_timezone_set('America/Tegucigalpa');

#   Crear conexion
$conexion = new Conexion();
$conexion->mysql_set_charset("utf8");
?>


<?php

if ($_SESSION["TipoUsuario"]=='1') {

    $salida="<div class='col-md-12 table-responsive'>
    <table class='ui striped teal table'>
    <thead>
    <tr id='titulo'>
    <th class='center aligned'>Instituto</th>
    <th class='center aligned'>Cargo</th>
    <th class='center aligned'>Nombre</th>
    <th class='center aligned'>Cedula</th>
    <th class='center aligned'>Telefono</th>
    <th class='center aligned'>Correo</th>
    <th class='center aligned'>Opciones</th>
    </tr>

    </thead>
    <tbody>";


    if(isset($_POST['consulta'])){
        $sql = "SELECT tblusuario.IDUsuario, tbltipousuario.Tipo, CONCAT(tblusuario.Nombre,' ',tblusuario.Apellido) AS Nombre,tblusuario.Correo, tblusuario.Telefono, tblusuario.Cedula, tblinstituto.NombreIns from tbldocxinstituto, tblinstituto, tblusuario, tbltipousuario WHERE  tblinstituto.IDInstituto=tbldocxinstituto.IDInstituto and tbldocxinstituto.IDDocente=tblusuario.IDUsuario and tblusuario.TipoUsuario=tbltipousuario.IDTipoUs  AND tbltipousuario.IDTipoUs!=1 AND (Nombre like '%".$_POST['consulta']."%' OR (CONCAT(Nombre,' ',Apellido)) like '%".$_POST['consulta']."%' OR  (CONCAT(Apellido,' ',Nombre)) like '%".$_POST['consulta']."%' OR NombreIns like '%".$_POST['consulta']."%' or Cedula like '%".$_POST['consulta']."%' or Correo like '%".$_POST['consulta']."%' or Tipo like '%".$_POST['consulta']."%')  order by NombreIns ";

    }
    $resultado=$conexion->ejecutarconsulta($sql);
    if ($conexion->cantidadregistros($resultado)>0) {


        while ($arreglo = $resultado->fetch_assoc()) {
            $salida.='<tr>
            <td class="center aligned">'.$arreglo['NombreIns'].'</td>
            <td class="center aligned">'.$arreglo['Tipo'].'</td>
            <td class="center aligned">'.$arreglo['Nombre'].'</td>
            <td class="center aligned">'.$arreglo['Cedula'].'</td>
            <td class="center aligned">'.$arreglo['Telefono'].'</td>
            <td class="center aligned">'.$arreglo['Correo'].'</td>
            <td class="center aligned">
            <div class="mini ui fluid buttons">
            <button class="ui blue button" onclick="modificarSU('.$arreglo["IDUsuario"].')"><i class="pencil alternate icon"></i>Editar</button>
            <button class="ui red button" onclick="eliminarSU('.$arreglo["IDUsuario"].')"><i class="trash icon"></i>Borrar</button>
            </div></td></tr>';
        }
        $salida.="</tbody> </table>";
    }else{
        $salida.="<tr><td colspan='7' style='text-align:center'>
        <div class='ui red icon message'>
        <i class='info circle icon'></i>
        <div class='content'>
        <p>No hay resultados</p>
        </div>
        </div></td></tr></div>";
    }


    echo $salida;

    mysqli_close($conexion->getLink());
}

if ($_SESSION["TipoUsuario"]=='2') {

    $salida="<div class='col-md-12 table-responsive'>
    <table class='ui striped teal table'>
    <thead>
    <tr id='titulo'>
    <th class='center aligned'>Cargo</th>
    <th class='center aligned'>Nombre</th>
    <th class='center aligned'>Cedula</th>
    <th class='center aligned'>Telefono</th>
    <th class='center aligned'>Correo</th>
    <th class='center aligned'>Opciones</th>
    </tr>

    </thead>
    <tbody>";


    if(isset($_POST['consulta'])){
        $sql = "SELECT tblusuario.IDUsuario, tbltipousuario.Tipo, CONCAT(tblusuario.Nombre,' ',tblusuario.Apellido) AS Nombre,tblusuario.Correo, tblusuario.Telefono, tblusuario.Cedula from tbldocxinstituto, tblinstituto, tblusuario, tbltipousuario WHERE tblinstituto.IDInstituto = ".$_SESSION['Instituto']." AND tblinstituto.IDInstituto=tbldocxinstituto.IDInstituto and tbldocxinstituto.IDDocente=tblusuario.IDUsuario and tblusuario.TipoUsuario=tbltipousuario.IDTipoUs and tbltipousuario.Tipo='Docente' AND (Nombre like '%".$_POST['consulta']."%' OR (CONCAT(Nombre,' ',Apellido)) like '%".$_POST['consulta']."%' OR  (CONCAT(Apellido,' ',Nombre)) like '%".$_POST['consulta']."%' OR NombreIns like '%".$_POST['consulta']."%' or Cedula like '%".$_POST['consulta']."%' or Correo like '%".$_POST['consulta']."%' or Tipo like '%".$_POST['consulta']."%' )";

    }
    $resultado=$conexion->ejecutarconsulta($sql);
    if ($conexion->cantidadregistros($resultado)>0) {


        while ($arreglo = $resultado->fetch_assoc()) {
            $salida.='<tr>
            <td class="center aligned">'.$arreglo['Tipo'].'</td>
            <td class="center aligned">'.$arreglo['Nombre'].'</td>
            <td class="center aligned">'.$arreglo['Cedula'].'</td>
            <td class="center aligned">'.$arreglo['Telefono'].'</td>
            <td class="center aligned">'.$arreglo['Correo'].'</td>
            <td class="center aligned">
            <div class="mini ui fluid buttons">
            <button class="ui blue button" onclick="modificar('.$arreglo["IDUsuario"].')"><i class="pencil alternate icon"></i>Editar</button>
            <button class="ui red button" onclick="eliminar('.$arreglo["IDUsuario"].')"><i class="trash icon"></i>Borrar</button>
            </div></td></tr>';
        }
        $salida.="</tbody> </table>";
    }else{
      $salida.="<tr><td colspan='7' style='text-align:center'>
      <div class='ui red icon message'>
      <i class='info circle icon'></i>
      <div class='content'>
      <p>No hay resultados</p>
      </div>
      </div></td></tr></div>";
  }


  echo $salida;

  mysqli_close($conexion->getLink());
}

?>