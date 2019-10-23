<?php
session_start();

#	Importar Clases
include("../Clases/Conexion.php");

#	Utilidad de fecha
date_default_timezone_set('America/Tegucigalpa');

#	Crear conexion
$conexion = new Conexion();
$conexion->mysql_set_charset("utf8");

if (isset($_SESSION["ID"])) {
    $consulta = sprintf(
        "SELECT CONCAT(Nombre, ' ', Apellido) AS Nombre, Imagen, Anuncio, Fecha, Hora 
        FROM tblanuncios 
        INNER JOIN tblusuario ON tblusuario.IDUsuario = tblanuncios.IDUsuario
        WHERE tblanuncios.IDInstituto = '%s'
        ORDER BY IDAnuncio DESC
        ",
        $conexion->antiInyeccion($_SESSION['Instituto'])
    );
} else {
    $consulta = sprintf(
        "SELECT CONCAT(Nombre, ' ', Apellido) AS Nombre, Imagen, Anuncio, Fecha, Hora, CodigoCurso
        FROM tblanuncios t1
        INNER JOIN tblusuario t2 ON t2.IDUsuario = t1.IDUsuario
        INNER JOIN tblcursoxinstituto t3 ON t1.IDInstituto = t3.IDInstituto
        WHERE CodigoCurso = '%s'
        ORDER BY IDAnuncio DESC
        LIMIT 3",
        $conexion->antiInyeccion($_SESSION['CodigoCurso'])
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
                    <p>Aun no se han creado anuncios.</p>
                </div>
            </div>
        </div>
    </div>
<?php else : ?>
        <?php
            for ($i = 0; $i < $iter; $i++) {
                $data = $conexion->obtenerFila($resultado); ?>
            <div class="col-md-12 mb-4">
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
                            <p><?php echo str_replace("\n", '<br>', $data['Anuncio']);  ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
<?php endif ?>