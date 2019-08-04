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

<br><br>
<div id="zonaContenido">

	<div class="col-md-12">
		<div class="col-md-12" style="border-width: 1px 1px 1px 1px; border-style: solid; border-color: lightgray;">
			<br>
			<h4 style="text-align: center;">
				Gestion de Docentes
			</h4>

			<hr>

			<div class="container">
				<label>Buscar un docente</label>
				<div class="col-lg-12 mb-3">
					<input type="text" name="srcDocente" id="srcDocente" class="form-control" placeholder="Buscar un docente" onkeyup="listar(this.value);">
				</div>
			</div>

			<br><br>
			<div id="Docente"></div>

			<br><br>
		</div>
		<br><br><br>
	</div>

</div>


