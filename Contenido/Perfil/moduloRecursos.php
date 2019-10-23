<?php
session_start();
?>

<div class="container">
	<h1 style="text-align: center;">
		Gestión de Recursos
	</h1>

	<label>
		Buscar un documento
	</label>

	<div class="row">
		<div class="col-md-12">
			<div class="ui fluid input">
				<input type="text" name="srcRecurso" id="srcRecurso" placeholder="Buscar" onkeyup="cargarRecursos(this.value);">
			</div>
		</div>
	</div>

	<div id="error" class="my-2"></div>

	<div id="ListarRecursos" class="row"></div>
</div>