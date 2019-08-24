<?php
session_start();
#   Importar Clases
include("../Clases/Conexion.php");
#   Utilidad de fecha
date_default_timezone_set('America/Tegucigalpa');
#   Crear conexion
$conexion = new Conexion();
$conexion->mysql_set_charset("utf8");
?>
<div class="col-md-12">
	<?php
	if ($_SESSION["TipoUsuario"]=='2') {
		if ($_SESSION['Plan'] == '1') {
			$consulta = sprintf("SELECT DiasPrueba FROM tblplan WHERE IDInstituto = '%s'",
				$conexion->antiInyeccion($_SESSION['Instituto']));
			$dias = $conexion->ejecutarconsulta($consulta)->fetch_assoc()['DiasPrueba'];
			if ($dias != '0') {
				echo '
				<div class="row mb-4">
				<div class="col-md-12">
				<div class="ui olive icon message">
				<i class="info circle icon"></i>
				<div class="content">
				<p>Quedan '.$dias.' dias de prueba actualiza tu plan siguiendo <a href="planes.php">este enlace</a></p>
				</div>
				</div>
				</div>
				</div>';
			} else {
				echo '
				<div class="row mb-4">
				<div class="col-md-12">
				<div class="ui red icon message">
				<i class="info circle icon"></i>
				<div class="content">
				<p>El periodo de prueba termino. Si quieres seguir usando la plataforma actualiza tu plan siguiendo <a href="planes.php">este enlace</a></p>
				</div>
				</div>
				</div>
				</div>';
			}
		}
		echo '
		<br>
		<h1 style="text-align: center;">
		Gestión de Docentes
		</h1>
		<div class="container">
		<label>
		Buscar un Docente
		</label>
		';
	}
	if ($_SESSION["TipoUsuario"]=='1') {
		echo '
		<h1 style="text-align: center;">
		Gestión de Usuarios
		</h1>
		<div class="container">
		<label>
		Buscar un Usuario
		</label>
		';
	}
	?>

	<div id="error"></div>
	<div class="row">
		<div class="col-md-12">
			<input type="text" name="srcRecurso" id="srcRecurso" class="form-control" placeholder="Buscar" onkeyup="listarRecur(this.value);">
		</div>
	</div>
</div>
<div id="ListarRecursos" class="row mt-4"></div>
<br><br>
<br><br><br>
