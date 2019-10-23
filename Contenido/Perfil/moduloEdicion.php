<?php
session_start();
#	Importar Clases
include("../../Clases/Conexion.php");
#	Utilidad de fecha
date_default_timezone_set('America/Tegucigalpa');
#	Crear conexion
$conexion = new Conexion();
$conexion->mysql_set_charset("utf8");

$consultaW = sprintf(
	"SELECT telefono, cedula  FROM tblUsuario WHERE  IDUsuario = '%s'",
	$conexion->antiInyeccion($_SESSION['ID'])
);
$resultadoW = $conexion->ejecutarconsulta($consultaW);
$dataW = $conexion->obtenerfila($resultadoW);

?>
<div class="col-md-12">
	<h1 style="text-align: center;">
		Modificar el perfil
	</h1>
	<div class="row">
		<div class="col-md-8">
			<br>
			<h3>Modifica tus datos personales</h3>

			<div class="row mb-4">
				<div class="col-lg-6">
					<label>Nombre:</label><br>
					<div class="ui fluid input">
						<input type="text" name="txtAsignatura" id="txtAsignatura" value="<?php echo $_SESSION['Nombre']; ?>">
					</div>
				</div>

				<div class="col-lg-6">
					<label>Apellido:</label><br>
					<div class="ui fluid input">
						<input type="text" name="txtAsignatura" id="txtAsignatura" value="<?php echo $_SESSION['Apellido']; ?>">
					</div>
				</div>
			</div>
			<div class="row mb-4">
				<div class="col-lg-6">
					<label>Teléfono:</label><br>
					<div class="ui fluid input">
						<input type="text" name="txtAsignatura" id="txtAsignatura" value="<?php echo $dataW['telefono']; ?>">
					</div>
				</div>

				<div class="col-lg-6">
					<label>Identidad:</label><br>
					<div class="ui fluid input">
						<input type="text" name="txtAsignatura" id="txtAsignatura" value="<?php echo $dataW['cedula']; ?>">
					</div>
				</div>
			</div>
			<div class="row mb-4">
				<div class="col-lg-12">
					<label>Correo:</label><br>
					<div class="ui fluid input">
						<input type="email" name="txtAsignatura" id="txtAsignatura" value="<?php echo $_SESSION['Correo']; ?>">
					</div>
				</div>
			</div>
			<div id="error"></div>
			<br>
			<div class="row mb-3 ml-2">
				<div class="col-lg-6 mx-auto">
					<button class="ui fluid blue button aceptar" id="editar">Aceptar</button>
				</div>
			</div>
			<div class="row mb-3 ml-2">
				<div class="col-lg-6 mx-auto">
					<a class="ui fluid red button cancelar" id="editar">Cancelar</a>
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<br>
			<h3>Otras opciones</h3>
			<div class="row mb-4">
				<div class="col-md-12">
					<div class="ui secondary fluid vertical menu" align="left">
						<a class="item agregar" id="tema">
							<i class="paint brush icon"></i>
							Seleccionar tema
						</a>
						<a class="item" id="password">
							<i class="key icon"></i>
							Cambiar contraseña
						</a>
						<a class="item agregar" id="imagen">
							<i class="image icon"></i>
							Cambiar imagen de perfil
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>