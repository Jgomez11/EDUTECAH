<?php
session_start();
?>

<div class="container">
	<h1 style="text-align: center;">
		Gestión de Recursos
	</h1>

	<div id="error"></div>

	<label>
		Buscar un documento
	</label>

	<div class="row">
		<div class="col-md-12">
			<input type="text" name="srcRecurso" id="srcRecurso" class="form-control" placeholder="Buscar" onkeyup="cargarRecursos(this.value);">
		</div>
	</div>

	<div id="ListarRecursos" class="row mt-4"></div>
</div>