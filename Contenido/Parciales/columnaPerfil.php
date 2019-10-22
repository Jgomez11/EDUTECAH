<?php
session_start();
?>
<div class="container" align="center">
    <?php
	if ($_SESSION['Imagen'] == NULL || $_SESSION['Imagen'] == "") {
		$img = 'Recursos/Imagenes/perfilDefecto.jpg';
	} else {
		$img = 'data:image/png;base64,' . base64_encode($_SESSION['Imagen']);
	}
	?>

    <img style="width: 200px; height: 200px" class="ui circular small bordered image" src="<?php echo $img ?>">
    <p>
        <h5><?php echo $_SESSION['Usuario']; ?>
            <!-- &nbsp;<button class="circular ui icon teal button" onclick="cargarDiv('columnaContenido', 'Contenido/modificarPerfil.php')" title="Modifica tu perfil"><i class="edit icon"></i> </button>-->
        </h5>
    </p>
	
    <div class="ui secondary teal pointing fluid vertical menu" align="left">
        <a class="opcion item active" id="aulas">
            <i class="clipboard list icon"></i>
            Asignaturas
        </a>

        <?php if ($_SESSION["TipoUsuario"] == '2') : ?>
        <a class="opcion item" id="cursos">
            <i class="columns icon"></i>
            Cursos
        </a>

        <a class="opcion item" id="docentes">
            <i class="users icon"></i>
            Docentes
        </a>
		<?php endif ?>
		
        <a class="opcion item" id="recursos">
            <i class="book icon"></i>
            Recursos
        </a>
        <a class="opcion item" id="soporte">
            <i class="info circle icon"></i>
            Soporte
        </a>
    </div>
    <div id="plan"></div>
</div>