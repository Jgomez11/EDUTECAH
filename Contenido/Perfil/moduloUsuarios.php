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
	<div id="error"></div>

	<div class="row">
		<div class="col-md-12">
			<input type="text" name="srcDocente" id="srcDocente" class="form-control" placeholder="Buscar" onkeyup="cargarUsuarios(this.value);">
		</div>
	</div>
	<div id="usuarios" class="row mt-4"></div>
</div>