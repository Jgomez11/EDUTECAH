<?php
session_start();
?>
<div class="container">
	<?php if ($_SESSION["TipoUsuario"] == '2') : ?>
		<h1 style="text-align: center;">
			Gestión de docentes
		</h1>
		<label>
			Buscar un docente
		</label>
		<?php else : ?>
			<h1 style="text-align: center;">
				Gestión de Usuarios
			</h1>
			<label>
				Buscar un usuario
			</label>
		<?php endif ?>

		<div class="row">
			<div class="col-md-12">
				<div class="ui fluid input">
					<input type="text" name="srcDocente" id="srcDocente" placeholder="Buscar" onkeyup="cargarUsuarios(this.value);">
				</div>
			</div>
		</div>

		<div id="error" class="my-2"></div>

		<div id="usuarios" class="row mt-4"></div>
	</div>