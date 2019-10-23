<?php
session_start();

#	Importar Clases
include("../Clases/Conexion.php");

#	Utilidad de fecha
date_default_timezone_set('America/Tegucigalpa');

#	Crear conexion
$conexion = new Conexion();
$conexion->mysql_set_charset("utf8");
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1 align="center">Aulas del curso <?php echo $_SESSION["CodigoCurso"]; ?>:</h1>
		</div>
	</div>
	<?php
	$consulta = sprintf(
		"SELECT tblaula.IDAula, tblaula.CodigoCurso, tblaula.Asignatura, tblcursos.NombreCurso, tblEstado.Estado, tblgrado.Grado FROM tblaula, tblcursos, tblcursoxinstituto, tblgrado, tblestado WHERE tblaula.CodigoCurso = '%s' AND tblaula.idestado = 2 AND tblaula.CodigoCurso = tblcursoxinstituto.CodigoCurso AND tblcursos.IDCurso = tblcursoxinstituto.IDCurso AND tblgrado.IDGrado = tblcursoxinstituto.IDGrado AND tblaula.IDEstado = tblEstado.IDEstado",
		$conexion->antiInyeccion($_SESSION['CodigoCurso'])
	);

	$resultado = $conexion->ejecutarconsulta($consulta);
	$iter = $conexion->cantidadRegistros($resultado);

	if ($iter == 0) {
		echo '
		<div class="row mt-4">
		<div class="col-md-12">
		<div class="ui yellow icon message">
		<i class="info circle icon"></i>
		<div class="content">
		<div class="header">
		No hay nada aqui
		</div>
		<p>Ningun docente ha abierto aulas todavia.</p>
		</div>
		</div>
		</div>
		</div>';
	} else {
		$contador = 0;

		for ($i = 0; $i < $iter; $i++) {
			if ($contador == 0) {
				echo '<div class="row mt-4">';
			}

			$data = $conexion->obtenerFila($resultado);

			echo '
			<div class="col-md-4">
			<div class="ui card">
			<div class="content">
			<div class="header">
			<p class="mt-1 ui left floated">Aula de ' . $data["Asignatura"] . '</p>
			</div>
			</div>	
			<div class="content">
			<h4 class="ui sub header">Curso: </h4><h6>' . $data["NombreCurso"] . '</h6>
			<h4 class="ui sub header">Grado: </h4><h6>' . $data["Grado"] . '</h6>
			<h4 class="ui sub header">Codigo de curso: </h4><h6>' . $data["CodigoCurso"] . '</h6>
			<button class="ui fluid teal button mt-4" onclick="cargarAula(' . $data["IDAula"] . ');"><i class="eye icon"></i>Ver Aula</button>
			</div>
			</div>
			</div>
			';

			$contador++;

			if ($contador == 3 && $iter > 3) {
				echo '</div>';
				$contador = 0;
			}
		}

		echo '</div>';
	}
	?>
</div>