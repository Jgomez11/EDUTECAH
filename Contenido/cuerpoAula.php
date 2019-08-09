<?php
						#	Session
	session_start();
						#	Importar Clases
	include("../Clases/Conexion.php");
						#	Crear conexion
	$conexion = new Conexion();
	$conexion->mysql_set_charset("utf8");
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<?php
				$consulta = sprintf("SELECT tblAula.CodigoCurso, tblAula.Asignatura,CONCAT(tblUsuario.Nombre, ' ', tblUsuario.Apellido) AS Nombre, tblAula.IDDocente FROM tblAula, tblUsuario WHERE tblAula.IDAula = '%s' AND tblAula.IDDocente = tblUsuario.IDUsuario",
					$conexion->antiInyeccion($_SESSION['IDAula']));
				$resultado = $conexion->ejecutarconsulta($consulta);
				$data = $conexion->obtenerFila($resultado);
				echo '
					<h1 align="center">Bienvenido al aula de '.$data["Asignatura"].'</h1>
					<p align="center">Codigo de curso: '.$data["CodigoCurso"].'<br>
					Docente: '.$data["Nombre"].'</p>';
			?>
		</div>
	</div>
	<div class="row mt-4">
		<div class="col-md-4">
		</div>
		<div class="col-md-4">
			<button class="ui teal fluid button"><br>
			<i class="add icon"></i><br><br>Agregar un recurso<br><br>
			</button>
		</div>
	</div>
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
	</div>
	<div class="row mt-4">
		<div class="col-md-12">
			<div class="ui fluid multiple search selection dropdown" id="ddCategorias" onmouseover="$('.dropdown').dropdown();">
				<input type="hidden" name="txtCat" id="txtCat">
				<div class="default text">Seleccionar Categoria</div>
				<i class="dropdown icon"></i>
				<div class="menu">
					<?php
						$consulta = sprintf("SELECT IDCategoria, Categoria From tblCategorias");
						$resultado = $conexion->ejecutarconsulta($consulta);
						$iter = $conexion->cantidadRegistros($resultado);
						for ($i=0; $i < $iter; $i++) {
							$data = $conexion->obtenerFila($resultado);
							echo '<div class="item" data-value="'.$data["IDCategoria"].'">'.$data["Categoria"].'</div>';
						}
					?>
				</div>
			</div>
		</div>
		<button class="ui button" onclick="alert($('#txtCat').val())">
		prueba
		</button>
	</div>
	<div class="row mt-4">
		<div class='col-md-12 table-responsive'>
			<table class='ui striped table'>
				<thead>
					<tr id='titulo'>
						<th class='center aligned'>Titulo</th>
						<th class='center aligned'>Categorias</th>
						<th class='center aligned'>Enlaces</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$consulta = sprintf("SELECT tblRecurso.IDRecurso, Titulo, Categorias FROM tblRecurso WHERE IDAula = '%s'",
					$conexion->antiInyeccion($_SESSION['IDAula']));
					$resultado = $conexion->ejecutarconsulta($consulta);
					
					$data = $conexion->obtenerFila($resultado);
					
					echo '
					<tr>
						<td class="center aligned">'.$data["Titulo"].'</td>
						<td class="center aligned">
							<div class="ui labels">';
							$cadena=$data["Categorias"];
							$arregloTags = explode(',', $cadena);
									for ($i=0; $i < count($arregloTags); $i++) {
										$subConsulta = sprintf("SELECT Color, Categoria From tblCategorias WHERE IDCategoria =".$arregloTags[$i]);
										$subResultado = $conexion->ejecutarconsulta($subConsulta);
										$subData = $conexion->obtenerFila($subResultado);
												echo '	<a class="ui '.$subData['Color'].' label">'.$subData['Categoria'].'</a>';
									}
					?>
							</div>
						</td>
						<td class="center aligned"><button class="mini ui teal button" onclick="window.location.href='lector.php?q=1'"><i class="eye icon"></i>Leer</button></td>
					</tr>
				</tbody>
			</div>
		</div>
	</div>
</div>