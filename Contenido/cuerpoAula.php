<?php
#    Session
session_start();

#    Importar Clases
include("../Clases/Conexion.php");

#    Crear conexion
$conexion = new Conexion();
$conexion->mysql_set_charset("utf8");
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<?php
			$consulta  = sprintf("SELECT tblAula.CodigoCurso, tblAula.Asignatura,CONCAT(tblUsuario.Nombre, ' ', tblUsuario.Apellido) AS Nombre, tblAula.IDDocente FROM tblAula, tblUsuario WHERE tblAula.IDAula = '%s' AND tblAula.IDDocente = tblUsuario.IDUsuario", $conexion->antiInyeccion($_SESSION['IDAula']));
			$resultado = $conexion->ejecutarconsulta($consulta);
			$data      = $conexion->obtenerFila($resultado);
			echo '
			<h1 align="center">Bienvenido al aula de ' . $data["Asignatura"] . '</h1>
			<p align="center">Codigo de curso: ' . $data["CodigoCurso"] . '<br>
			Docente: ' . $data["Nombre"] . '</p>';
			?>
		</div>
	</div>
	<?php if (isset($_SESSION["TipoUsuario"]) && $_SESSION["TipoUsuario"]==3): ?>
		
	<div class="row mt-4">
		<div class="col-md-4">
		</div>
		<div class="col-md-4">
			<button class="ui teal fluid button" onclick="
									$('#modalRecursos')
										.modal(
											{
												onVisible: function () {
													$('.dropdown').dropdown();
												},

												onApprove: function(){
													cargarDiv('columnaContenido','Contenido/cuerpoAula.php');
												}
											})
										.modal('setting', 'transition', 'scale')
										.modal('show');
									$('.second.modal')
			  							.modal('attach events', '.first.modal .approve.button');"><br>
			<i class="add icon"></i><br><br>Agregar un recurso<br><br>
			</button>
		</div>
	</div>
	<?php endif ?>
	<?php
		$consulta  = sprintf("SELECT IDRecurso, Titulo, Categorias, Tipo FROM tblRecurso WHERE IDAula = '%s'",
			$conexion->antiInyeccion($_SESSION['IDAula']));
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
												<p>El maestro no ha subido ningun recurso</p>
										</div>
								</div>
						</div>
				</div>';
		} else {
			echo '<div class="col-md-12 mt-4 table-responsive">
					<table class="ui striped table">
					<thead>
						<tr id="titulo">
							<th class="center aligned">Titulo</th>
							<th class="center aligned">Tipo de archivo</th>
							<th class="center aligned">Etiquetas</th>
							<th class="center aligned">Enlaces</th>
						</tr>
					</thead>
					<tbody>
				';
			for ($i = 0; $i < $iter; $i++) {
				$data        = $conexion->obtenerFila($resultado);
				$cadena      = $data["Categorias"];
				$arregloTags = explode(',', $cadena);
		
				echo '
						<tr>
							<td class="center aligned">' . $data["Titulo"] . '</td>';

				switch ($data['Tipo']) {
					case '.pdf':
						echo '<td class="center aligned"><i class="large red file pdf outline icon"></i></td>';
						break;

					case '.doc':
					case '.docx':
						echo '<td class="center aligned"><i class="large blue file word outline icon"></i></td>';
						break;

					case '.ppt':
					case '.pptx':
						echo '<td class="center aligned"><i class="large orange file powerpoint outline icon"></i></td>';
						break;

					case '.xls':
					case '.xlsx':
						echo '<td class="center aligned"><i class="large green file excel outline icon"></i></td>';
						break;

					default:
						echo '<td class="center aligned"><i class="large file alternate outline icon"></i></td>';
						break;
				}

				echo '
							<td class="center aligned">
								<div class="ui labels">';
				for ($j = 0; $j < count($arregloTags); $j++) {
					$subConsulta  = sprintf("SELECT Color, Categoria From tblCategorias WHERE IDCategoria =" . $arregloTags[$j]);
					$subResultado = $conexion->ejecutarconsulta($subConsulta);
					$subData      = $conexion->obtenerFila($subResultado);
					echo '
								<a class="ui ' . $subData['Color'] . ' label">' . $subData['Categoria'] . '</a>';
				}
				
				echo '</div></td><td class="center aligned">';

				switch ($data['Tipo']) {
					case '.pdf':
						echo'<button class="mini ui teal button" onclick="leerPDF('.$data['IDRecurso'].')"><i class="eye icon"></i>Leer</button>';
						break;

					case '.doc':
					case '.docx':
						echo'<button class="mini ui green button"><i class="save icon"></i>Descargar</button>';
						break;

					case '.ppt':
					case '.pptx':
						echo'<button class="mini ui green button"><i class="save icon"></i>Descargar</button>';
						break;

					case '.xls':
					case '.xlsx':
						echo'<button class="mini ui green button"><i class="save icon"></i>Descargar</button>';
						break;

					default:
						echo '<td class="center aligned">Sin Opciones</td>';
						break;
				}

								
				echo '</td></tr>';
			}
			echo '
					</tbody>
					</table>
				</div>';
		}
		?>
	</div>
</div>