<?php
session_start();

#	Importar Clases
include("../../Clases/Conexion.php");

#	Utilidad de fecha
date_default_timezone_set('America/Tegucigalpa');

#	Crear conexion
$conexion = new Conexion();
$conexion->mysql_set_charset("utf8");
?>


<?php
$consulta = "SELECT tblusuario.IDUsuario, tblusuario.Nombre ,tblusuario.Apellido, tblusuario.Cedula, tblusuario.Telefono ,tblusuario.Correo from  tbldocxinstituto, tblinstituto, tblusuario WHERE  tblinstituto.IDInstituto=tbldocxinstituto.IDInstituto and tbldocxinstituto.IDDocente=tblusuario.IDUsuario  and tblusuario.IDUsuario=" . $_POST['IDUsuario'];
$resultado = $conexion->ejecutarconsulta($consulta);
$data = $conexion->obtenerfila($resultado);
?>



<div class="col-md-12">
	<div class="col-md-12">
		<h1 style="text-align: center;">
			Editar datos de <?php echo $data['Nombre']; ?>
		</h1>

		<div class="row mb-4">
			<div class="col-lg-6">
				<label>Nombre:</label>
				<div class="ui fluid input">
					<input type="text" name="txtNombre" id="txtNombre" value="<?php echo $data['Nombre']; ?>">
				</div>
			</div>
			<div class="col-lg-6">
				<label>Apellido:</label>
				<div class="ui fluid input">
					<input type="text" name="txtApellido" id="txtApellido" value="<?php echo $data['Apellido']; ?>">

				</div>
			</div>
		</div>

		<div class="row mb-4">
			<div class="col-lg-6">
				<label>Cédula:</label>
				<div class="ui fluid input">
					<input type="text" name="txtCedula" id="txtCedula" value="<?php echo $data['Cedula']; ?>">
				</div>
			</div>
			<div class="col-lg-6">
				<label>Teléfono:</label>
				<div class="ui fluid input">
					<input type="text" name="txtTelefono" id="txtTelefono" value="<?php echo $data['Telefono']; ?>">
				</div>
			</div>
		</div>

		<div class="row mb-4">
			<div class="col-lg-12">
				<label>Correo:</label>
				<div class="ui fluid input">
					<input type="email" name="txtCorreo" id="txtCorreo" value="<?php echo $data['Correo']; ?>">
				</div>
				<input type="number" name="txtIdentificador" id="txtIdentificador" value="<?php echo $_POST['IDUsuario']; ?>" style="display: none;">
			</div>
		</div>

		<div id="error"></div>
		<br>
		<div class="row mb-3 ml-2">
			<div class="col-lg-4"></div>
			<div class="col-lg-4">
				<button class="ui fluid blue button aceptar" id="director">Guardar cambios</button>
			</div>
		</div>
		<div class="row mb-3 ml-2">
			<div class="col-lg-4"></div>
			<div class="col-lg-4">
				<a href="#" class="ui fluid red button cancelar" id="director">Cancelar</a>
			</div>
		</div>


	</div>
</div>