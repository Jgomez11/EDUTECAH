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

$salida="<div class='col-md-12 table-responsive'>
<table class='ui celled padded table'>
<thead>
<tr id='titulo'>
<th>Cargo</th>
<th>Nombre</th>
<th>Correo</th>
<th>Instituto</th>
<th></th>
</tr>

</thead>
<tbody>";


if(isset($_POST['consulta'])){
    $sql = "SELECT tblusuario.IDUsuario, tbltipousuario.Tipo, CONCAT(tblusuario.Nombre,' ',tblusuario.Apellido) AS Nombre,tblusuario.Correo, tblinstituto.NombreIns from tbldocxinstituto, tblinstituto, tblusuario, tbltipousuario WHERE tblinstituto.IDInstituto = ".$_SESSION['Instituto']." AND tblinstituto.IDInstituto=tbldocxinstituto.IDInstituto and tbldocxinstituto.IDDocente=tblusuario.IDUsuario and tblusuario.TipoUsuario=tbltipousuario.IDTipoUs and tbltipousuario.Tipo='Docente' and tblusuario.Nombre like '%".$_POST['consulta']."%'";

}
$resultado=$conexion->ejecutarconsulta($sql);
if ($conexion->cantidadregistros($resultado)>0) {


    while ($arreglo = $resultado->fetch_assoc()) {
        $salida.='<tr>
        <td>'.$arreglo['Tipo'].'</td>
        <td>'.$arreglo['Nombre'].'</td>
        <td>'.$arreglo['Correo'].'</td>
        <td>'.$arreglo['NombreIns'].'</td>
        <td><a role="button"'.'class='.'"ui blue button"'.'href="#"'.' onclick="modificar('.$arreglo["IDUsuario"].')"><i class='.'"pencil alternate icon"'.'></i>&nbsp;Modificar</a><a role="button" class='.'"ui red button"'.' href="#" onclick="eliminar('.$arreglo["IDUsuario"].')"><i class='.'"trash icon"'.'></i>&nbsp;Eliminar</a></td></tr>';
    }
    $salida.="</tbody> </table>";
}else{
    $salida.="<tr><td colspan='5' style='text-align:center'>Aun no hay docentes registrados</td></tr></div>";
}


echo $salida;

mysqli_close($conexion->getLink());

?>