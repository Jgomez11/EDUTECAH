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
			<?php
			if ($_SESSION["TipoUsuario"]=='2') {
				echo '

				<h4 style="text-align: center;">
				Gestión de Docentes 
				</h4>
				<hr>

				<div class="container">

				<label>
				Buscar un Docente 
				</label>
				';
			}

			if ($_SESSION["TipoUsuario"]=='1') {
				echo '

				<h4 style="text-align: center;">
				Gestión de Usuarios 
				</h4>
				<hr>

				<div class="container">

				<label>
				Buscar un Usuario 
				</label>
				';
			}


			?>

			


			<div class="col-lg-12 mb-3">
				<input type="text" name="srcDocente" id="srcDocente" class="form-control" placeholder="Buscar" onkeyup="listar(this.value);">
			</div>
		</div>

		<br><br>
		<div id="ListarUsuarios"></div>

		<br><br>
	</div>
	<br><br><br>
</div>

</div>


