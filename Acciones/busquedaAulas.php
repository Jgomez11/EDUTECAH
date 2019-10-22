<?php
session_start();

#	Importar Clases
include("../Clases/Conexion.php");

#	Utilidad de fecha
date_default_timezone_set('America/Tegucigalpa');

#	Crear conexion
$conexion = new Conexion();
$conexion->mysql_set_charset("utf8");

if ($_SESSION["TipoUsuario"] == '3') {
    $consulta = sprintf(
        "SELECT CONCAT(Nombre, ' ', Apellido) AS Nombre, IDAula, tblaula.CodigoCurso, Estado, Asignatura, NombreCurso, Grado FROM tblaula INNER JOIN tblusuario ON tblusuario.IDUsuario = tblaula.IDDocente INNER JOIN tblcursoxinstituto ON tblaula.CodigoCurso = tblcursoxinstituto.CodigoCurso INNER JOIN tblestado ON tblestado.IDEstado = tblaula.IDEstado INNER JOIN tblcursos ON tblcursoxinstituto.IDCurso = tblcursos.IDCurso INNER JOIN tblgrado ON tblcursoxinstituto.IDGrado = tblgrado.IDGrado WHERE tblaula.IDInstituto = '%s' AND tblaula.IDDocente = '%s' ORDER BY IDAula ",
        $conexion->antiInyeccion($_SESSION['Instituto']),
        $conexion->antiInyeccion($_SESSION['ID'])
    );
} else {
    $consulta = sprintf(
        "SELECT CONCAT(Nombre, ' ', Apellido) AS Nombre, IDAula, tblaula.CodigoCurso, Estado, Asignatura, Imagen, NombreCurso, Grado FROM tblaula INNER JOIN tblusuario ON tblusuario.IDUsuario = tblaula.IDDocente INNER JOIN tblcursoxinstituto ON tblaula.CodigoCurso = tblcursoxinstituto.CodigoCurso INNER JOIN tblestado ON tblestado.IDEstado = tblaula.IDEstado INNER JOIN tblcursos ON tblcursoxinstituto.IDCurso = tblcursos.IDCurso INNER JOIN tblgrado ON tblcursoxinstituto.IDGrado = tblgrado.IDGrado WHERE tblaula.IDInstituto = '%s' ORDER BY IDAula ",
        $conexion->antiInyeccion($_SESSION['Instituto'])
    );
}

$resultado = $conexion->ejecutarconsulta($consulta);
$iter = $conexion->cantidadRegistros($resultado);
?>

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
                            <p class="my-1 ui left floated">Aula de
                                <?php echo $data["Asignatura"] ?>
                            </p>
                            <button class="circular ui right floated icon red button" data-content="Eliminar"><i class="trash icon"></i></button>
                            <button class="circular ui right floated icon blue button" data-content="Modificar" onclick="modificarAula('<?php echo $data['IDAula'] ?>');setTimeout('activadorBotonesModificar()', 150)"><i class="pencil alternate icon"></i></button>
                        </div>
                    </div>
                    <div class="content">
                        <h4 class="ui sub header">Curso: </h4>
                        <h6><?php echo $data["NombreCurso"] ?></h6>
                        <h4 class="ui sub header">Grado: </h4>
                        <h6><?php echo $data["Grado"] ?></h6>
                        <h4 class="ui sub header">Codigo de curso: </h4>
                        <h6><?php echo $data["CodigoCurso"] ?></h6>
                        <h4 class="ui sub header">Estado: </h4>
                        <h6><?php echo $data["Estado"] ?></h6>
                        <?php if ($_SESSION["TipoUsuario"] == '2') : ?>
                            <h4 class="ui sub header">Docente: </h4>
                            <?php if ($data["Imagen"] != "NULL") : ?>
                                <h6><img class="ui avatar image" src="<?php echo 'data:image/png;base64,' . base64_encode($data["Imagen"]) ?>"><?php echo $data["Nombre"] ?></h6>
                            <?php else : ?>
                                <h6><img class="ui avatar image" src="Recursos/Imagenes/perfilDefecto.jpg><?php echo $data["Nombre"] ?></h6>
                            <?php endif ?>
                        <?php endif ?>
                        <button class="ui fluid teal button mt-4" onclick="cargarAula('<?php echo $data['IDAula'] ?>');"><i class="eye icon"></i>Ver Aula</button>
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