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
if(isset($_POST['consulta'])){
    $sql  = "SELECT IDCalificacion , Asignatura, CodigoAlumno, NotaIP, NotaIIP, NotaIIIP, Acumulativo, Proyecto, Recuperacion, NotaFinal FROM tblcalificaciones, tblaula where tblaula.IDAula=tblcalificaciones.IDAula and (Asignatura like '%".$_POST['consulta']."%' or CodigoAlumno like '%".$_POST['consulta']."%' ) order by CodigoAlumno";


    $resultado = $conexion->ejecutarconsulta($sql);
    $iter = $conexion->cantidadRegistros($resultado);
    if ($iter == 0) {
        echo '<div class="col-md-12 mt-4 mb-4 table-responsive">
        <table class="ui striped table">
        <thead>
        <tr id="titulo">
        <th class="center aligned">Asignatura</th>
        <th class="center aligned">CodigoAlumno</th>
        <th class="center aligned">NotaIP</th>
        <th class="center aligned">NotaIIP</th>
        <th class="center aligned">NotaIIIP</th>
        <th class="center aligned">Acumulativo</th>
        <th class="center aligned">Proyecto</th>
        <th class="center aligned">Recuperacion</th>
        <th class="center aligned">NotaFinal</th>
        </tr>
        <tr><td colspan=\'7\' style=\'text-align:center\'>
        <div class=\'ui red icon message\'>
        <i class=\'info circle icon\'></i>
        <div class=\'content\'>
        <p>No hay resultados</p>
        </div>
        </div></td></tr></div>';
    } else {
        echo '<div class="col-md-12 mt-4 mb-4 table-responsive">
        <table class="ui striped table">
        <thead>
        <tr id="titulo">
        
        <th class="center aligned">Asignatura</th>
        <th class="center aligned">CodigoAlumno</th>
        <th class="center aligned">NotaIP</th>
        <th class="center aligned">NotaIIP</th>
        <th class="center aligned">NotaIIIP</th>
        <th class="center aligned">Acumulativo</th>
        <th class="center aligned">Proyecto</th>
        <th class="center aligned">Recuperacion</th>
        <th class="center aligned">NotaFinal</th>
        '


        ;

        if (isset($_SESSION['TipoUsuario']) && $_SESSION['TipoUsuario']=='3') {
            echo '<th class="center aligned">Opciones</th>';
        }
        echo '
        </tr>

        </thead>
        <tbody>
        ';


        for ($i = 0; $i < $iter; $i++) {
            $data        = $conexion->obtenerFila($resultado);


            echo '
            <tr>
            <td class="center aligned">' . $data["Asignatura"] . '</td>'
            ;

            echo '
            <td class="center aligned">' . $data["CodigoAlumno"] . '</td>'
            ;

            echo '
            <td class="center aligned">' . $data["NotaIP"] . '</td>'
            ;
            echo '
            <td class="center aligned">' . $data["NotaIIP"] . '</td>'
            ;

            echo '
            <td class="center aligned">' . $data["NotaIIIP"] . '</td>'
            ;

            echo '
            <td class="center aligned">' . $data["Acumulativo"] . '</td>'
            ;

            echo '
            <td class="center aligned">' . $data["Proyecto"] . '</td>'
            ;

            echo '
            <td class="center aligned">' . $data["Recuperacion"] . '</td>'
            ;

            echo '
            <td class="center aligned">' . $data["NotaFinal"] . '</td>'
            ;




            if (isset($_SESSION['TipoUsuario']) && $_SESSION['TipoUsuario']=='3') {


                echo'
                <td class="center aligned">
                <div class="mini ui fluid buttons">
                <button class="ui blue button" onclick="modificarCalificacion('.$data["IDCalificacion"].');setTimeout(\'activadorBotonesModificar()\', 150)"><i class="pencil alternate icon"></i>Editar</button>
                <button class="ui red button" onclick="$(\'#modalBorrarAlumno\')
                .modal(
                {
                    onApprove: function(){
                        eliminarAlumno('.$data["IDCalificacion"].');
                    }
                    })
                    .modal(\'setting\', \'transition\', \'scale\')
                    .modal(\'show\');"><i class="trash icon"></i>Borrar</button>
                    </div></td></tr>';
                }

                echo '</tr>';
            }
            echo '
            </tbody>
            </table>
            </div>';

        }

    }
    ?>  