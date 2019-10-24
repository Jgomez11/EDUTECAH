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
						$('.dropdown').dropdown({maxSelections : 3});
					}
				})
				.modal('setting', 'transition', 'scale')
				.modal('show');
				$('.second.modal')
				.modal({
					onApprove: function(){
						cargarDiv('columnaContenido','Contenido/cuerpoAula.php');
					}
				}
				);"><br>
				<i class="add icon"></i><br><br>Agregar un recurso<br><br>
			</button>
		</div>
	</div>
<?php endif ?>
<div id="info"></div>
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
	echo '<div class="col-md-12 mt-4 mb-4 table-responsive">
	<table class="ui striped table">
	<thead>
	<tr id="titulo">
	<th class="center aligned">Titulo</th>
	<th class="center aligned">Tipo de archivo</th>
	<th class="center aligned">Etiquetas</th>
	<th class="center aligned">Enlaces</th>';
	if (isset($_SESSION['TipoUsuario']) && $_SESSION['TipoUsuario']=='3') {
		echo '<th class="center aligned">Opciones</th>';
	}
	echo '
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
			echo '<td class="center aligned"><i class="large red file pdf  icon"></i></td>';
			break;

			case '.doc':
			case '.docx':
			echo '<td class="center aligned"><i class="large blue file word  icon"></i></td>';
			break;

			case '.ppt':
			case '.pptx':
			echo '<td class="center aligned"><i class="large orange file powerpoint  icon"></i></td>';
			break;

			case '.xls':
			case '.xlsx':
			echo '<td class="center aligned"><i class="large green file excel  icon"></i></td>';
			break;

			default:
			echo '<td class="center aligned"><i class="large file alternate  icon"></i></td>';
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
			echo'<a class="mini ui green button" href="Recursos/Data/'.$data['IDRecurso'].'.doc" download ="'.$data["Titulo"].'"><i class="save icon"></i>Descargar</a>';
			break;

			case '.docx':
			echo'<a class="mini ui green button" href="Recursos/Data/'.$data['IDRecurso'].'.docx" download ="'.$data["Titulo"].'"><i class="save icon"></i>Descargar</a>';
			break;

			case '.ppt':
			echo'<a class="mini ui green button" href="Recursos/Data/'.$data['IDRecurso'].'.ppt" download ="'.$data["Titulo"].'"><i class="save icon"></i>Descargar</a>';
			break;

			case '.pptx':
			echo'<a class="mini ui green button" href="Recursos/Data/'.$data['IDRecurso'].'.pptx" download ="'.$data["Titulo"].'"><i class="save icon"></i>Descargar</a>';
			break;

			case '.xls':
			echo'<a class="mini ui green button" href="Recursos/Data/'.$data['IDRecurso'].'.xls" download ="'.$data["Titulo"].'"><i class="save icon"></i>Descargar</a>';
			break;

			case '.xlsx':
			echo'<a class="mini ui green button" href="Recursos/Data/'.$data['IDRecurso'].'.xlsx" download ="'.$data["Titulo"].'"><i class="save icon"></i>Descargar</a>';
			break;

			default:
			echo 'Sin Opciones';
			break;
		}


		echo '</td>';

		if (isset($_SESSION['TipoUsuario']) && $_SESSION['TipoUsuario']=='3') {


			echo'<td class="center aligned"> <button class="mini ui red button" onclick="$(\'#modalBorrarRecurso\')
			.modal(
			{
				onVisible: function () {
					},

					onApprove: function(){
						eliminarRecurso('.$data["IDRecurso"].', 1);
					}
					})
					.modal(\'setting\', \'transition\', \'scale\')
					.modal(\'show\');"><i class="trash icon"></i>Borrar</button>';
				}

				echo '</tr>';
			}
			echo '
			</tbody>
			</table>
			</div>';
		}
		?>
		<br>
		<br>	
		 <div id="contenido" class="container">
		 	<div class="row">
		 		<div class="col-md-4  m-auto">
		 			<?php
		 			if($_SESSION['TipoUsuario']==2){ 
      					echo '<a href="index.php" class="btn btn-block ui red button">Regresar</a>';
      				}elseif ($_SESSION['TipoUsuario']==3) {
      					echo '<a href="index.php" class="btn btn-block ui red button">Regresar</a>';
      				}
      				 ?>
      			</div>
      		</div>	
    	</div>
	</div>
</div>