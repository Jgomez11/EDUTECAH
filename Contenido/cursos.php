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
		if ($_SESSION['Plan'] == '1' && $_SESSION["TipoUsuario"]=='2') {
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
			<button class="ui green fluid button" onclick="$('.ui.modal').modal('show')"><br><i class="add icon"></i><br><br>Agregar nuevo curso<br><br></button>
		</div>
	</div>
	<div class="row mt-4">
		<div class="col-md-12"> 
			<h1 align="center">Cursos creados:</h1>
		</div>
	</div>
	<?php  
		$consulta = sprintf("SELECT tblcursos.NombreCurso, tblcursoxinstituto.CodigoCurso, tblgrado.Grado FROM tblcursoxinstituto, tblcursos, tblgrado WHERE tblcursoxinstituto.IDInstituto = '%s' AND tblcursoxinstituto.IDCurso = tblcursos.IDCurso AND tblgrado.IDGrado = tblcursoxinstituto.IDGrado",
			$conexion->antiInyeccion($_SESSION['Instituto']));
			
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
								<p>Prueba a añadir un nuevo curso.</p>
							</div>
						</div>
					</div>
				</div>';
		} else {
			$contador = 0;

			for ($i=0; $i < $iter ; $i++) { 
				if ($contador == 0) {
					echo '<div class="row mt-4">';
				}

				$data = $conexion->obtenerFila($resultado);

				echo '
					<div class="col-md-4">
						<div class="ui card">
  							<div class="content">
    							<div class="header">Codigo: '.$data["CodigoCurso"].'</div>
  							</div>	
  							<div class="content">
    							<h4 class="ui sub header">Curso: </h4><h6>'.$data["NombreCurso"].'</h6>
    							<h4 class="ui sub header">Grado: </h4><h6>'.$data["Grado"].'</h6>
								<h4 class="ui sub header">Seccion: </h4><h6>'.$data["CodigoCurso"].'</h6>
  							</div>
  							<div class="extra content">
  								    <button class="ui blue button"><i class="pencil alternate icon"></i>Editar</button>
  								    <button class="ui red button"><i class="trash icon"></i>Borrar</button>
  							</div>
						</div>
					</div>
  				';

  				$contador++;
			
				if ($contador == 3) {
					echo '</div>';
					$contador = 0;
				}
			}
		}
	?> 
	</div>

	<div class="ui modal">
  		<div class="header">Header</div>
	</div>
</div>
