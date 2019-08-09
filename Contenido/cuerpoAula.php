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
</div>
</div>
</div>