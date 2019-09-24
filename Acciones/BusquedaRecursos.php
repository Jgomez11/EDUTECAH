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
    $sql  = "SELECT IDRecurso, Titulo, Categorias, Tipo, Asignatura, NombreCurso, Grado FROM tblrecurso, tblaula, tblcursoxinstituto, tblcursos, tblgrado where tblaula.IDAula=tblrecurso.IDAula and tblaula.CodigoCurso=tblcursoxinstituto.CodigoCurso and tblcursoxinstituto.IDCurso=tblcursos.IDCurso and tblcursoxinstituto.IDGrado=tblgrado.IDGrado and (titulo like '%".$_POST['consulta']."%' or tipo like '%".$_POST['consulta']."%' or NombreCurso like '%".$_POST['consulta']."%')  order by NombreCurso";


    $resultado = $conexion->ejecutarconsulta($sql);
    $iter = $conexion->cantidadRegistros($resultado);
    if ($iter == 0) {
        echo '<div class="col-md-12 mt-4 mb-4 table-responsive">
        <table class="ui striped table">
        <thead>
        <tr id="titulo">
        <th class="center aligned">Curso</th>
        <th class="center aligned">Grado</th>
        <th class="center aligned">Aula</th>
        <th class="center aligned">Titulo</th>
        <th class="center aligned">Tipo</th>
        <th class="center aligned">Etiquetas</th>
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
        <th class="center aligned">Curso</th>
        <th class="center aligned">Grado</th>
        <th class="center aligned">Aula</th>
        <th class="center aligned">Titulo</th>
        <th class="center aligned">Tipo</th>
        <th class="center aligned">Etiquetas</th>

        ';

        if (isset($_SESSION['TipoUsuario']) && $_SESSION['TipoUsuario']=='2') {
            echo '<th class="center aligned">Opciones</th>';
        }
        echo '
        </tr>

        </thead>
        <tbody>
        ';


        for ($i = 0; $i < $iter; $i++) {
            $data        = $conexion->obtenerFila($resultado);
            $cadena      = $data["Categorias"];
            $arregloTags = explode(',', $cadena);

            echo '
            <tr>
            <td class="center aligned">' . $data["NombreCurso"] . '</td>'
            ;

            echo '
            <td class="center aligned">' . $data["Grado"] . '</td>'
            ;

            echo '
            <td class="center aligned">' . $data["Asignatura"] . '</td>'
            ;
            echo '
            <td class="center aligned">' . $data["Titulo"] . '</td>'
            ;



            switch ($data['Tipo']) {
                case '.pdf':
                echo '<td class="center aligned"><i class="large red file pdf outline icon"></i></td>';
                break;

                case '.doc':
                case '.docx':
                echo '<td class="center aligned"><i class="large blue file word outline icon"></i></td>';
                break;

                case '.ppt':
                case '.pptx':
                echo '<td class="center aligned"><i class="large orange file powerpoint outline icon"></i></td>';
                break;

                case '.xls':
                case '.xlsx':
                echo '<td class="center aligned"><i class="large green file excel outline icon"></i></td>';
                break;

                default:
                echo '<td class="center aligned"><i class="large file alternate outline icon"></i></td>';
                break;
            }

            echo '
            <td class="center aligned">
            <div class="ui labels">';

            for ($j = 0; $j < count($arregloTags); $j++) {
                $subConsulta  = sprintf("SELECT Color, Categoria From tblCategorias WHERE IDCategoria =" . $arregloTags[$j]);
                $subResultado = $conexion->ejecutarconsulta($subConsulta);
                $subData      = $conexion->obtenerFila($subResultado);
                echo '
                <a class="ui ' . $subData['Color'] . ' label">' . $subData['Categoria'] . '</a>';
            }

            echo '</div></td>';

            if (isset($_SESSION['TipoUsuario']) && $_SESSION['TipoUsuario']=='2') {


                echo'<td class="center aligned">
                <button class="mini ui red button" onclick="$(\'#modalBorrarRecursoMOD\')
                .modal(
                {
                    onVisible: function () {
                        },

                        onApprove: function(){
                            eliminarRecurso('.$data["IDRecurso"].', 2)
                        }
                        })
                        .modal(\'setting\', \'transition\', \'scale\')
                        .modal(\'show\');"><i class="trash icon"></i>Borrar</button>';
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