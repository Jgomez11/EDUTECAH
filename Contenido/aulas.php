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
	<?php
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
	?>

	<div class="row">
		<div class="col-md-3">
			<button class="ui green fluid button"><br><i class="add icon"></i><br><br>Agregar nueva aula<br><br></button>
		</div>
	</div>
</div>