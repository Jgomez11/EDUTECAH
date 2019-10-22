<?php
session_start();
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1 align="center">Cursos creados:</h1>
		</div>
	</div>

	<div class="row mt-4">
		<div class="col-md-4 mx-auto">
			<button class="ui teal fluid button agregar" id="curso"><br>
				<i class="add icon"></i><br><br>Agregar nuevo curso<br><br>
			</button>
		</div>
	</div>

	<div id="listaCursos"></div>
</div>