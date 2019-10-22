<?php
session_start();

#	Importar Clases
include("../../Clases/Conexion.php");


#	Utilidad de fecha
date_default_timezone_set('America/Tegucigalpa');

#	Crear conexion
$conexion = new Conexion();
$conexion->mysql_set_charset("utf8");

?>
<?php if ($_SESSION['Plan'] == '1' && $_SESSION["TipoUsuario"] == '2') : ?>
    <?php
        $consulta = sprintf(
            "SELECT DiasPrueba FROM tblplan WHERE IDInstituto = '%s'",
            $conexion->antiInyeccion($_SESSION['Instituto'])
        );
        $dias = $conexion->ejecutarconsulta($consulta)->fetch_assoc()['DiasPrueba'];
        ?>
    <?php if ($dias != '0') : ?>
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="ui yellow icon message">
                    <i class="info circle icon"></i>
                    <div class="content">
                        <p>Quedan <?php echo $dias ?> dias de prueba actualiza tu plan siguiendo <a href="planes.php">este
                                enlace</a></p>
                    </div>
                </div>
            </div>
        </div>
    <?php else : ?>
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="ui red icon message">
                    <i class="info circle icon"></i>
                    <div class="content">
                        <p>El periodo de prueba termino. Si quieres seguir usando la plataforma actualiza tu plan siguiendo
                            <a href="planes.php">este enlace</a></p>
                    </div>
                </div>
            </div>
        </div>
    <?php endif ?>
<?php endif ?>