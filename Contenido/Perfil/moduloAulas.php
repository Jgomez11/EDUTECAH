<?php
session_start();
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1 align="center">Asignaturas creadas:</h1>
		</div>
	</div>

	<div class="row mt-4">
		<div class="col-md-4 mx-auto">
			<?php if ($_SESSION["TipoUsuario"] == '3') : ?>
				<button class="ui teal fluid button agregar" id="aula"><br>
					<i class="add icon"></i><br><br>Agregar nueva aula<br><br>
				</button>
			<?php endif ?>
		</div>
	</div>

	<div class="row" id="listaAulas"></div>
</div>