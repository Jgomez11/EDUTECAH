<?php
session_start();

# Importar Clases
include("../../Clases/Conexion.php");

# Utilidad de fecha
date_default_timezone_set('America/Tegucigalpa');

# Crear conexion
$conexion = new Conexion();
$conexion->mysql_set_charset("utf8");
?>

<div class="ui first small modal" id="modalAlumno">
	<div class="header">Agregar nueva aula</div>

	<div class="content">

		<div class="field">
			<label>Seleccionar curso</label>
			<div class="ui fluid search selection dropdown">
				<input type="hidden" name="txtIDCurso" id="txtIDCurso">
				<i class="dropdown icon"></i>
				<div class="default text">Curso</div>
				<div class="menu">
					<?php
					$consulta = sprintf(
						"SELECT tblcursoxinstituto.CodigoCurso, tblcursos.NombreCurso, tblgrado.Grado FROM tblcursoxinstituto, tblgrado, tblcursos WHERE IDInstituto = '%s' AND tblcursos.IDCurso = tblcursoxinstituto.IDCurso AND  tblgrado.IDGrado = tblcursoxinstituto.IDGrado",
						$conexion->antiInyeccion($_SESSION['Instituto'])
					);

					$resultado = $conexion->ejecutarconsulta($consulta);
					$iter = $conexion->cantidadRegistros($resultado);

					for ($i = 0; $i < $iter; $i++) {
						$data = $conexion->obtenerFila($resultado);
						echo '<div class="item" data-value="' . $data["CodigoCurso"] . '">' . $data["CodigoCurso"] . ': ' . $data["Grado"] . ' ' . $data["NombreCurso"] . '</div>';
					}
					?>
				</div>
			</div>
		</div>
	
		<br>
		
		<label>Establecer Asignatura</label>
		<div class="ui fluid input">
			<input id="txtAsignatura" type="text" placeholder="Matematica, Ciencias, etc...">
		</div>
	</div>
	
	<div class="actions">
		<div class="ui approve teal button" onclick="registrarAula();">Aceptar</div>
		<div class="ui cancel red button">Cancelar</div>
	</div>
</div>

<div class="ui second small modal">
	<div class="header">Agregar nueva aula</div>
	<div class="content" id="contenido"></div>
	<div class="actions">
		<div class="ui approve button">Aceptar</div>
	</div>
</div>