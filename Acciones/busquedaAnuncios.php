<?php
session_start();

#	Importar Clases
include("../Clases/Conexion.php");

#	Utilidad de fecha
date_default_timezone_set('America/Tegucigalpa');

#	Crear conexion
$conexion = new Conexion();
$conexion->mysql_set_charset("utf8");

// if (isset($_SESSION["ID"])) {
$consulta = sprintf(
    "SELECT CONCAT(Nombre, ' ', Apellido) AS Nombre, Imagen, Anuncio, Fecha, Hora 
        FROM tblanuncios 
        INNER JOIN tblusuario ON tblusuario.IDUsuario = tblanuncios.IDUsuario
        WHERE tblanuncios.IDInstituto = '%s'
        ORDER BY IDAnuncio DESC
        ",
    $conexion->antiInyeccion($_SESSION['Instituto'])
);
// } else {
//     $consulta = sprintf(
//         "SELECT CONCAT(Nombre, ' ', Apellido) AS Nombre, IDAula, tblaula.CodigoCurso, Estado, Asignatura, Imagen, NombreCurso, Grado FROM tblaula INNER JOIN tblusuario ON tblusuario.IDUsuario = tblaula.IDDocente INNER JOIN tblcursoxinstituto ON tblaula.CodigoCurso = tblcursoxinstituto.CodigoCurso INNER JOIN tblestado ON tblestado.IDEstado = tblaula.IDEstado INNER JOIN tblcursos ON tblcursoxinstituto.IDCurso = tblcursos.IDCurso INNER JOIN tblgrado ON tblcursoxinstituto.IDGrado = tblgrado.IDGrado WHERE tblaula.IDInstituto = '%s' ORDER BY IDAula ",
//         $conexion->antiInyeccion($_SESSION['Instituto'])
//     );
// }
$resultado = $conexion->ejecutarconsulta($consulta);
$iter = $conexion->cantidadRegistros($resultado);
?>

<?php
for ($i = 0; $i < $iter; $i++) {
    $data = $conexion->obtenerFila($resultado); ?>
    <div class="ui fluid raised card">
        <div class="content">
            <?php if ($data["Imagen"] != NULL) : ?>
                <img class="right floated mini ui avatar image" src="<?php echo 'data:image/png;base64,' . base64_encode($data["Imagen"]) ?>">
            <?php else : ?>
                <img class="right floated mini ui avatar image" src="Recursos/Imagenes/perfilDefecto.jpg">
            <?php endif ?>
            <div class=" header">
                <?php echo $data['Nombre'] ?>
            </div>
            <div class="meta">
                Publicó un anuncio el <?php echo $data['Fecha'] . ', ' . $data['Hora'] ?>
            </div>
            <div class="description">
                <p><?php echo $data['Anuncio'] ?></p>
            </div>
        </div>
    </div>
<?php } ?>