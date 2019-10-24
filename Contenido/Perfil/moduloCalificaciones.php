<?php  
session_start();

#   Importar Clases
include("../../Clases/Conexion.php");

#   Utilidad de fecha
date_default_timezone_set('America/Tegucigalpa');

#   Crear conexion
$conexion = new Conexion();
$conexion->mysql_set_charset("utf8");
?>

<div class="container">
	<h1 style="text-align: center;">
		Calificaciones
	</h1>

	<div id="error"></div>

	<div class="row mt-4">
		<div class="col-md-4 mx-auto">
			<?php if ($_SESSION["TipoUsuario"] == '3') : ?>
				<button class="ui teal fluid button agregar" id="alumno"><br>
					<i class="add icon"></i><br><br>Agregar Alumnos<br><br>
				</button>
			<?php endif ?>
		</div>
	</div>


	<div class= "col-md-18 mt-4 mb-4 table-responsive">
		<label>Seleccionar Asignatura</label>

		<div class="ui fluid search selection dropdown">
			<input type="hidden" name="txtIDAsignatura" id="txtIDAsignatura">
			<i class="dropdown icon"></i>
			<div class="default text">Asignatura</div>
			<div class="menu">
				<?php
				$consulta = sprintf("SELECT IDAula, Asignatura FROM tblaula");
				$resultado = $conexion->ejecutarconsulta($consulta);
				$iter = $conexion->cantidadRegistros($resultado);

				for ($i = 0; $i < $iter; $i++) {
					$data = $conexion->obtenerFila($resultado);
					echo '<div class="item" data-value="' . $data["IDAula"] . '">' . $data["Asignatura"] . '</div>';
				}
				?>
				
			</div>
		</div>
	</div>

	<?php if ($_SESSION["TipoUsuario"] == '2') : ?>
		<div class= "col-md-18 mt-4 mb-4 table-responsive">
			<label>Seleccionar Curso</label>

			<div class="ui fluid search selection dropdown">
				<input type="hidden" name="txtIDAsignatura" id="txtIDAsignatura">
				<i class="dropdown icon"></i>
				<div class="default text">Curso</div>
				<div class="menu">

				</div>
			</div>
		</div>
	<?php endif ?>


	<label>
		Buscar una Calificacion
	</label>

	<div class="row">
		<div class="col-md-12">
			<input type="text" name="srcRecurso" id="srcRecurso" class="form-control" placeholder="Buscar" onkeyup="cargarCalificaciones(this.value);">
		</div>
	</div>



	<div id="ListarCalificaciones" class="row mt-4"></div>
</div>
</div>