<?php
session_start();
include("../../Clases/Conexion.php");
$conexion = new Conexion();
$conexion->mysql_set_charset("utf8");
?>

<?php if (!empty($_SESSION) && isset($_SESSION['Tema'])) : ?>
<div class="ui <?php echo $_SESSION['Tema'] ?> inverted secondary menu fixed top navbar navbar-expand-md browser">
    <?php else : ?>
    <div class="ui teal inverted secondary menu fixed top navbar navbar-expand-md browser">
        <?php endif ?>
        <!--Botones de izquierda-->
        <a class="navbar-brand" href="index.php"><img height="40px" src="Recursos/Imagenes/logo.png"></a>
        <a class="item navlink" href="index.php">Inicio</a>

        <?php if (empty($_SESSION) && !isset($_SESSION["ID"]) && !isset($_SESSION["CodigoCurso"])) : ?>
        <a class="item navlink" href="login.php">Iniciar Sesión</a>
        <a class="item navlink" href="registro.php">Registrarse</a>
        <a class="item navlink" href="soporte.php">Soporte</a>
        <?php endif ?>

        <?php if (isset($_SESSION["CodigoCurso"])) : ?>
        <a class="item navlink" href="curso.php">Curso: <?php echo $_SESSION["CodigoCurso"] ?></a>
        <?php endif ?>

        <?php if (isset($_SESSION['TipoUsuario']) && $_SESSION['TipoUsuario'] == '2') : ?>
        <a class="item navlink" href="planes.php">Planes</a>
        <?php endif ?>

        <!--Barra de busqueda DESACTIVADA MOMENTANEAMENTE-->
        <div class="ui search mx-auto navlink">
            <form method="get" action="index.php">
                <div class="ui icon input">
                    <input class="prompt" type="text" placeholder="Buscar...">
                    <i class="search icon"></i>
                </div>
            </form>
            <div class="results"></div>
        </div>

        <!--Botones de derecha-->
        <?php if (!empty($_SESSION) && isset($_SESSION["ID"])) : ?>
        <?php
				if ($_SESSION['Imagen'] == NULL || $_SESSION['Imagen'] == "") {
					$img = 'Recursos/Imagenes/perfilDefecto.jpg';
				} else {
					$img = 'data:image/png;base64,' . base64_encode($_SESSION['Imagen']);
				}
				?>

        <a class="item" href="perfil.php"><img class="ui avatar image"
                src="<?php echo $img ?>"><span><?php echo $_SESSION['Nombre'] ?></span></a>

        <div class="ui dropdown link item">
            <i class="bars icon"></i>
            <div class="menu">
                <?php if (isset($_SESSION['TipoUsuario']) && $_SESSION['TipoUsuario'] == '2') : ?>
                <a class="item" href="planes.php"><i class="alternate list icon"></i> Actualizar plan</a>
                <?php endif ?>
                <a class="item" href="perfil.php"><span><i class="user icon"></i>Tu perfil</span></a>
                <div class="divider"></div>
                <a class="item" href="Acciones/cerrarSesion.php"><i class="sign out icon"></i>Cerrar sesion</a>
            </div>
        </div>
        <?php endif ?>

        <?php if (isset($_SESSION['CodigoCurso'])) : ?>
        <div class="ui top pointing dropdown item">
            <a><i class="dropdown  icon"></i></a>
            <div class="menu">
                <a class="item" href="Acciones/cerrarSesion.php"><i class="sign out icon"></i>Cerrar sesion</a>
            </div>
        </div>
        <?php endif ?>
    </div>
</div>


<?php if (!empty($_SESSION) && isset($_SESSION['Tema'])) : ?>
<div class="ui <?php echo $_SESSION['Tema'] ?> inverted secondary menu fixed top navbar navbar-expand-md movil">
    <?php else : ?>
    <div class="ui teal inverted secondary menu fixed top navbar navbar-expand-md movil">
        <?php endif ?>
        <!--Botones de izquierda-->
        <a class="navbar-brand" href="index.php"><img height="40px" src="Recursos/Imagenes/logo.png"></a>
        <a class="item" href="index.php">Inicio</a>

        <div class="ui dropdown link item ml-auto">
            <i class="bars icon"></i>
            <?php if (isset($_SESSION["CodigoCurso"])) : ?>
            <a class="item" href="curso.php">Curso: <?php echo $_SESSION["CodigoCurso"] ?></a>
            <?php endif ?>

            <div class="menu">

                <?php if (empty($_SESSION) && !isset($_SESSION["ID"]) && !isset($_SESSION["CodigoCurso"])) : ?>
                <a class="item navlink" href="login.php">Iniciar Sesión</a>
                <a class="item navlink" href="registro.php">Registrarse</a>
                <a class="item navlink" href="soporte.php">Soporte</a>
                <?php endif ?>
                <?php if (!empty($_SESSION) && isset($_SESSION["ID"])) : ?>
                <?php if (isset($_SESSION['TipoUsuario']) && $_SESSION['TipoUsuario'] == '2') : ?>
                <a class="item" href="planes.php"><i class="alternate list icon"></i> Actualizar plan</a>
                <?php endif ?>
                <a class="item" href="perfil.php"><span><i class="user icon"></i>Tu perfil</span></a>
                <div class="divider"></div>
                <a class="item" href="Acciones/cerrarSesion.php"><i class="sign out icon"></i>Cerrar sesion</a>

                <?php if (isset($_SESSION['CodigoCurso'])) : ?>
                <a class="item" href="Acciones/cerrarSesion.php"><i class="sign out icon"></i>Cerrar sesion</a>
                <?php endif ?>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>