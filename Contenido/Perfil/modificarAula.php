<?php
session_start();
#	Importar Clases
include("../../Clases/Conexion.php");
#	Utilidad de fecha
date_default_timezone_set('America/Tegucigalpa');
#	Crear conexion
$conexion = new Conexion();
$conexion->mysql_set_charset("utf8");

$consultaW = sprintf(
	"SELECT CONCAT(tblUsuario.Nombre, ' ', tblUsuario.Apellido) AS Nombre, tblaula.IDAula, tblaula.IDDocente, tblaula.CodigoCurso, tblaula.Asignatura,tblaula.IDEstado,tblEstado.Estado, tblcursos.NombreCurso, tblgrado.Grado FROM tblUsuario, tblaula, tblcursos, tblcursoxinstituto, tblgrado, tblEstado WHERE tblaula.IDAula = '%s' AND tblaula.CodigoCurso = tblcursoxinstituto.CodigoCurso AND tblcursos.IDCurso = tblcursoxinstituto.IDCurso AND tblgrado.IDGrado = tblcursoxinstituto.IDGrado AND tblUsuario.IDUsuario = tblaula.IDDocente AND tblaula.IDEstado = tblEstado.IDEstado",
	$conexion->antiInyeccion($_POST['IDAula'])
);
$resultadoW = $conexion->ejecutarconsulta($consultaW);
$dataW = $conexion->obtenerfila($resultadoW);
?>
<div class="col-md-12">
	<div class="col-md-12">
		<h1 style="text-align: center;">
			Modificar aula
		</h1>

		<br>

		<div class="row mb-4">
			<input type="number" name="txtIdentificador" id="txtIdentificador" value="<?php echo $_POST['IDAula']; ?>" style="display: none;">
			<input type="number" name="txtIDEstado" id="txtIDEstado" value="<?php echo $dataW['IDEstado']; ?>" style="display: none;">
			<input type="number" name="txtIDDocente" id="txtIDDocente" value="<?php echo $dataW['IDDocente']; ?>" style="display: none;">
			<input type="text" name="txtIDCurso" id="txtIDCurso" value="<?php echo $dataW['CodigoCurso']; ?>" style="display: none;">

			<div class="col-lg-6">
				<label>Selecciona un nuevo curso:</label>
				<div class="ui fluid selection dropdown" id="ddCurso">
					<input type="hidden" name="txtNuevoCurso" id="txtNuevoCurso">
					<i class="dropdown icon"></i>
					<div class="text">
						<?php echo $dataW["CodigoCurso"] . ': ' . $dataW["Grado"] . ' ' . $dataW["NombreCurso"]; ?>
					</div>
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

			<div class="col-lg-6">
				<label>Establecer nueva asignatura:</label>
				<input type="text" name="txtAsignatura" id="txtAsignatura" value="<?php echo $dataW['Asignatura']; ?>" class="form-control">
			</div>

		</div>
		<div class="row mb-4">

			<div class="col-lg-6">
				<label>Seleccionar estado:</label>
				<div class="ui fluid selection dropdown" id="ddEstado">
					<input type="hidden" name="txtEstado" id="txtEstado">
					<div class="text">
						<?php echo $dataW["Estado"]; ?>
					</div>
					<i class="dropdown icon"></i>
					<div class="menu">
						<?php
						$consulta = sprintf("SELECT IDEstado, Estado From tblEstado");
						$resultado = $conexion->ejecutarconsulta($consulta);
						$iter = $conexion->cantidadRegistros($resultado);
						for ($i = 0; $i < $iter; $i++) {
							$data = $conexion->obtenerFila($resultado);
							echo '<div class="item" data-value="' . $data["IDEstado"] . '">' . $data["Estado"] . '</div>';
						}
						?>
					</div>
				</div>
			</div>
			<?php if ($_SESSION["TipoUsuario"] == 2) : ?>
				<div class="col-lg-6">
					<label>Seleccionar docente:</label>
					<div class="ui fluid selection dropdown" id="ddDocente">
						<input type="hidden" name="txtDocente" id="txtDocente">
						<div class="text">
							<?php echo $dataW["Nombre"]; ?>
						</div>
						<i class="dropdown icon"></i>
						<div class="menu">
							<?php
								$consulta = sprintf(
									"SELECT CONCAT(tblUsuario.Nombre, ' ', tblUsuario.Apellido) AS Nombre, tblUsuario.IDUsuario From tblUsuario, tbldocxinstituto WHERE tbldocxinstituto.IDDocente = tblUsuario.IDUsuario and tbldocxinstituto.IDInstituto = '%s' AND tblusuario.TipoUsuario != 2",
									$conexion->antiInyeccion($_SESSION["Instituto"])
								);
								$resultado = $conexion->ejecutarconsulta($consulta);
								$iter = $conexion->cantidadRegistros($resultado);
								for ($i = 0; $i < $iter; $i++) {
									$data = $conexion->obtenerFila($resultado);
									echo '<div class="item" data-value="' . $data["IDUsuario"] . '">' . $data["Nombre"] . '</div>';
								}
								?>
						</div>
					</div>
				</div>
			<?php endif ?>

		</div>
		<div id="error"></div>
		<br>
		<div class="row mb-3 ml-2">
			<div class="col-lg-4"></div>
			<div class="col-lg-4">
				<button class="ui fluid blue button aceptar" id="aula">Aceptar</button>
			</div>
		</div>
		<div class="row mb-3 ml-2">
			<div class="col-lg-4"></div>
			<div class="col-lg-4">
				<a class="ui fluid red button cancelar" id="aula">Cancelar</a>
			</div>
		</div>
		<div class="col-lg-4"></div>
	</div>
</div>