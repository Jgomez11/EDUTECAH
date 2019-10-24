<?php
session_start();

#   Importar Clases
include("../Clases/Conexion.php");

#   Utilidad de fecha
date_default_timezone_set('America/Tegucigalpa');

#   Crear conexion
$conexion = new Conexion();
$conexion->mysql_set_charset("utf8");

if ($_SESSION["TipoUsuario"] == '1') {
    if (isset($_POST['consulta'])) {
        $sql = "SELECT 
        IDUsuario, Tipo, CONCAT(Nombre,' ',Apellido) as Nombre, Correo, Telefono, Cedula, NombreIns
        FROM tbldocxinstituto t1
        INNER JOIN tblusuario t2 ON t1.IDDocente = t2.IDUsuario
        INNER JOIN tbltipousuario t3 ON t2.TipoUsuario = t3.IDTipoUs
        INNER JOIN tblinstituto t4 ON t1.IDInstituto = t4.IDInstituto
        WHERE Tipo != 'Admin' AND (Nombre like '%" . $_POST['consulta'] . "%' OR Apellido like '%" . $_POST['consulta'] . "%'  OR NombreIns like '%" . $_POST['consulta'] . "%' OR Cedula like '%" . $_POST['consulta'] . "%' OR Correo like '%" . $_POST['consulta'] . "%' OR Tipo like '%" . $_POST['consulta'] . "%')  
        ORDER BY NombreIns";
    }
} elseif ($_SESSION["TipoUsuario"] == '2') {
    if (isset($_POST['consulta'])) {
        $sql = "SELECT 
        IDUsuario, Tipo, CONCAT(Nombre,' ',Apellido) as Nombre, Correo, Telefono, Cedula, NombreIns
        FROM tbldocxinstituto t1
        INNER JOIN tblusuario t2 ON t1.IDDocente = t2.IDUsuario
        INNER JOIN tbltipousuario t3 ON t2.TipoUsuario = t3.IDTipoUs
        INNER JOIN tblinstituto t4 ON t1.IDInstituto = t4.IDInstituto
        WHERE Tipo != 'Director' AND t1.IDInstituto = " . $_SESSION['Instituto'] . " AND (Nombre like '%" . $_POST['consulta'] . "%' OR Apellido like '%" . $_POST['consulta'] . "%' OR Cedula like '%" . $_POST['consulta'] . "%' OR Correo like '%" . $_POST['consulta'] . "%' OR Tipo like '%" . $_POST['consulta'] . "%')  
        ORDER BY IDUsuario";
    }
} ?>
<div class='col-md-12 table-responsive'>
    <table class='ui striped table'>
        <thead>
            <tr id='titulo'>
                <?php if ($_SESSION["TipoUsuario"] == '1') : ?>
                    <th class='center aligned'>Instituto</th>
                <?php endif ?>
                <th class='center aligned'>Cargo</th>
                <th class='center aligned'>Nombre</th>
                <th class='center aligned'>Cedula</th>
                <th class='center aligned'>Telefono</th>
                <th class='center aligned'>Correo</th>
                <th class='center aligned'>Opciones</th>
            </tr>

        </thead>
        <tbody>
            <?php
            $resultado = $conexion->ejecutarconsulta($sql);
            if ($conexion->cantidadregistros($resultado) > 0) {
                while ($arreglo = $resultado->fetch_assoc()) {
                    ?>
                    <tr>
                        <?php if ($_SESSION["TipoUsuario"] == '1') : ?>
                            <td class="center aligned"><?php echo $arreglo['NombreIns'] ?></td>
                        <?php endif ?>
                        <td class="center aligned"><?php echo $arreglo['Tipo'] ?></td>
                        <td class="center aligned"><?php echo $arreglo['Nombre'] ?></td>
                        <td class="center aligned"><?php echo $arreglo['Cedula'] ?></td>
                        <td class="center aligned"><?php echo $arreglo['Telefono'] ?></td>
                        <td class="center aligned"><?php echo $arreglo['Correo'] ?></td>
                        <td class="center aligned">
                            <div class="mini ui fluid buttons">
                                <?php if ($_SESSION["TipoUsuario"] == '1') : ?>
                                    <button class="ui blue button" onclick="modificarSU('<?php echo $arreglo['IDUsuario'] ?>');setTimeout('activadorBotonesModificar()', 150)"><i class="pencil alternate icon"></i>Editar</button>
                                    <?php else : ?>
                                        <button class="ui blue button" onclick="modificar('<?php echo $arreglo['IDUsuario'] ?>');setTimeout('activadorBotonesModificar()', 150)"><i class="pencil alternate icon"></i>Editar</button>
                                    <?php endif ?>
                                    <button class="ui red button" onclick="$('#modalBorrar')
                                    .modal(
                                    {
                                        onApprove: function(){
                                            eliminar('<?php echo $arreglo['IDUsuario'] ?>');
                                            setTimeout(() => {
                                                cargarUsuarios('');
                                            }, 150);
                                        }
                                    })
                                    .modal('setting', 'transition', 'scale')
                                    .modal('show');"><i class="trash icon"></i>Borrar</button>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <tr>
                <?php if ($_SESSION["TipoUsuario"] == '1') : ?>
                    <td colspan='7' style='text-align:center'>
                        <?php else : ?>
                            <td colspan='6' style='text-align:center'>
                            <?php endif ?>
                            <div class='ui red icon message'>
                                <i class='info circle icon'></i>
                                <div class='content'>
                                    <p>No hay resultados</p>
                                </div>
                            </div>
                        </td>
                    </tr>
                </div>
            <?php }


            mysqli_close($conexion->getLink());
