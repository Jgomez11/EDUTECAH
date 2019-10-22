<?php
session_start();
#	Importar Clases
include("../Clases/Conexion.php");
#	Utilidad de fecha
date_default_timezone_set('America/Tegucigalpa');
#	Crear conexion
$conexion = new Conexion();
$conexion->mysql_set_charset("utf8");

$consulta = sprintf(
    "SELECT tblcursos.NombreCurso, tblcursoxinstituto.CodigoCurso, tblgrado.Grado FROM tblcursoxinstituto, tblcursos, tblgrado WHERE tblcursoxinstituto.IDInstituto = '%s' AND tblcursoxinstituto.IDCurso = tblcursos.IDCurso AND tblgrado.IDGrado = tblcursoxinstituto.IDGrado",
    $conexion->antiInyeccion($_SESSION['Instituto'])
);
$resultado = $conexion->ejecutarconsulta($consulta);
$iter = $conexion->cantidadRegistros($resultado); ?>

<?php if ($iter == 0) : ?>
    <div class="row my-4">
        <div class="col-md-12">
            <div class="ui yellow icon message">
                <i class="info circle icon"></i>
                <div class="content">
                    <div class="header">
                        No hay nada aqui
                    </div>
                    <?php if ($_SESSION["TipoUsuario"] == '2') : ?>
                        <p>Ningun docente a abierto aulas todavia.</p>
                    <?php else : ?>
                        <p>Prueba a añadir una aula nueva.</p>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>

<?php else : ?>
    <?php $contador = 0;
        for ($i = 0; $i < $iter; $i++) {
            if ($contador == 0) {  ?>
            <div class="row mt-4">
            <?php }
                    $data = $conexion->obtenerFila($resultado); ?>
            <div class="col-md-4">
                <div class="ui card">
                    <div class="content">
                        <div class="header">
                            <p class="my-2 ui left floated">Codigo: <?php echo $data["CodigoCurso"] ?></p>
                            <button class="circular ui right floated icon red button" data-content="Eliminar"><i class="trash icon"></i></button>
                            <button class="circular ui right floated icon blue button" data-content="Modificar"><i class="pencil alternate icon"></i></button>
                        </div>
                    </div>
                    <div class="content">
                        <h4 class="ui sub header">Curso: </h4>
                        <h6><?php echo $data["NombreCurso"] ?></h6>
                        <h4 class="ui sub header">Grado: </h4>
                        <h6><?php echo $data["Grado"] ?></h6>
                    </div>
                </div>
            </div>
            <?php $contador++;
                    if ($contador == 3 && $iter > 3) { ?>
            </div>
    <?php $contador = 0;
            }
        } ?>
<?php endif ?>