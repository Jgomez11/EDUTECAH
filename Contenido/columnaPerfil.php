<?php 
session_start();
?>
<div class="container" align="center"> 	
	<img style="width: 200px; height: 200px" class="ui rounded small bordered image" src="
	<?php 
	if ($_SESSION['Imagen'] == NULL || $_SESSION['Imagen'] == "") {
		echo 'Recursos/Imagenes/perfilDefecto.png';
		} else{
			echo 'data:image/png;base64,'.base64_encode($_SESSION['Imagen']);
		}
		?>">
		<p class="fixed top">
			<h5><?php echo $_SESSION['Usuario']; ?>
			&nbsp;<button class="circular ui icon teal button" onclick="cargarDiv('columnaContenido', 'Contenido/modificarPerfil.php')" title="Modifica tu perfil"><i class="edit icon"></i>
			</button></h5>
		</p>
		<div class="ui vertical fluid buttons">
			<button class="ui basic button" onclick="cargarDiv('columnaContenido', 'Contenido/contenidoPerfil.php')">Perfil</button>
			<button class="ui basic button" onclick="cargarDiv('columnaContenido', 'Contenido/aulas.php')">Aulas</button>
			<?php
			if ($_SESSION["TipoUsuario"]=='2') {
				echo '
				<button class="ui basic button" onclick="cargarDiv(\'columnaContenido\', \'Contenido/cursos.php\');cargarDiv(\'modal\', \'Contenido/modalCursos.php\');">Cursos</button>
				<button class="ui basic button" onclick="cargarDiv(\'columnaContenido\', \'Contenido/modificarDocente.php\');">Gestionar Docentes</button>
				';
			}
			?>
			<button class="ui basic button">Recursos</button>
			<button class="ui basic button">Wiki</button>
		</div>
	</div>
</div>