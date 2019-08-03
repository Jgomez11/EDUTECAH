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
			<?php 
				if ($_SESSION["TipoUsuario"] == '3') {
					echo '
					<button class="ui teal fluid button" 
				onclick="
				$(\'.first.modal\')
					.modal(
						{
							onVisible: function () {
								$(\'.dropdown\').dropdown();
							},

							onApprove: function(){
								registrarCurso();
								cargarDiv(\'columnaContenido\', \'Contenido/cursos.php\');
							}
						})
					.modal(\'setting\', \'transition\', \'scale\')
					.modal(\'show\');
					$(\'.second.modal\')
  						.modal(\'attach events\', \'.first.modal .approve.button\');"><br>
				<i class="add icon"></i><br><br>Agregar nueva aula<br><br>
			</button>
					';
				}
			 ?>
		</div>
	</div>
	<div class="row mt-4">
		<div class="col-md-12"> 
			<h1 align="center">Aulas creadas:</h1>
		</div>
	</div>
	<?php
		if ($_SESSION["TipoUsuario"] == '3') {
			$consulta = sprintf("SELECT tblaula.IDAula, tblaula.CodigoCurso, tblaula.Asignatura, tblcursos.NombreCurso, tblgrado.Grado FROM tblaula, tblcursos, tblcursoxinstituto, tblgrado WHERE tblaula.IDInstituto = '%s' AND tblaula.IDDocente = '%s' AND tblaula.CodigoCurso = tblcursoxinstituto.CodigoCurso AND tblcursos.IDCurso = tblcursoxinstituto.IDCurso AND tblgrado.IDGrado = tblcursoxinstituto.IDGrado",
			$conexion->antiInyeccion($_SESSION['Instituto']),
			$conexion->antiInyeccion($_SESSION['ID']));

		} else {
			$consulta = sprintf("SELECT CONCAT(tblUsuario.Nombre, ' ', tblUsuario.Apellido) AS Nombre, tblaula.IDAula, tblaula.CodigoCurso, tblaula.Asignatura, tblcursos.NombreCurso, tblgrado.Grado FROM tblUsuario, tblaula, tblcursos, tblcursoxinstituto, tblgrado WHERE tblaula.IDInstituto = '%s' AND tblaula.CodigoCurso = tblcursoxinstituto.CodigoCurso AND tblcursos.IDCurso = tblcursoxinstituto.IDCurso AND tblgrado.IDGrado = tblcursoxinstituto.IDGrado AND tblUsuario.IDUsuario = tblaula.IDDocente",
			$conexion->antiInyeccion($_SESSION['Instituto']));
		}			
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
							</div>';
			if ($_SESSION["TipoUsuario"]=='2') {
				echo '			<p>Ningun docente a abierto aulas todavia.</p>';
			} else {
				echo '			<p>Prueba a añadir una aula nueva.</p>';
			}

			echo '
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
    							<div class="header">Aula de '.$data["Asignatura"].'</div>
  							</div>	
  							<div class="content">
    							<h4 class="ui sub header">Curso: </h4><h6>'.$data["NombreCurso"].'</h6>
    							<h4 class="ui sub header">Grado: </h4><h6>'.$data["Grado"].'</h6>
    							<h4 class="ui sub header">Codigo de curso: </h4><h6>'.$data["CodigoCurso"].'</h6>';
    			if ($_SESSION["TipoUsuario"] == '2') {
    				echo '
    							<h4 class="ui sub header">Docente: </h4><h6>'.$data["Nombre"].'</h6>';
    			}
					echo
								'<button class="ui fluid teal button mt-4" onclick="window.location.href = \'aula.php?id='.$data["IDAula"].'\';"><i class="eye icon"></i>Ver Aula</button>
  							</div>
  							<div class="extra content">
  								<div class="ui fluid buttons">
	  								<button class="ui blue button"><i class="pencil alternate icon"></i>Editar</button>
									<button class="ui red button"><i class="trash icon"></i>Borrar</button>
								</div>
  							</div>
						</div>
					</div>
  				';

  				$contador++;
			
				if ($contador == 3 && $iter>3) {
					echo '</div>';
					$contador = 0;
				}
			}

			echo '</div>';
		}
	?> 
	</div>
</div>
	<div class="ui first small modal">
  		<div class="header">Agregar nuevo curso</div>
  		<div class="content">
  			<form class="ui form">
  				<div class="field">
      				<label>Seleccionar curso</label>
					<div class="ui search selection dropdown">
  						<input type="hidden" name="txtIDCurso" id="txtIDCurso">
  						<i class="dropdown icon"></i>
  						<div class="default text">Curso</div>
  						<div class="menu">
  							<?php
								$consulta = sprintf("SELECT tblcursoxinstituto.CodigoCurso, tblcursos.NombreCurso, tblgrado.Grado FROM tblcursoxinstituto, tblgrado, tblcursos WHERE IDInstituto = '%s' AND tblcursos.IDCurso = tblcursoxinstituto.IDCurso AND  tblgrado.IDGrado = tblcursoxinstituto.IDGrado", 
									$conexion->antiInyeccion($_SESSION['Instituto']));

								$resultado = $conexion->ejecutarconsulta($consulta);
								$iter = $conexion->cantidadRegistros($resultado);

								for ($i=0; $i < $iter; $i++) { 
									$data = $conexion->obtenerFila($resultado);

									echo '<div class="item" data-value="'.$data["CodigoCurso"].'">'.$data["CodigoCurso"].': '.$data["Grado"].' '.$data["NombreCurso"].'</div>';
								}
  							 ?>
  						</div>
					</div>
      			</div>
      			<div class="field">
      				<label>Establecer Asignatura</label>
      				<input type="text" placeholder="Matematica, Ciencias, etc...">
      			</div>
      		 </form>
      	</div>
  		<div class="actions">
    		<div class="ui approve teal button">Aceptar</div>
    		<div class="ui cancel red button">Cancelar</div>
  		</div>
	</div>
		<div class="ui second small modal">
  		<div class="header">Agregar nuevo curso</div>
  		<div class="content" id="contenido"></div>
  		<div class="actions">
    		<div class="ui approve button">Aceptar</div>
  		</div>
	</div>