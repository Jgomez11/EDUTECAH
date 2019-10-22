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


<?php
$consulta="SELECT tblusuario.IDUsuario, tblusuario.Nombre ,tblusuario.Apellido, tblusuario.Cedula, tblusuario.Telefono ,tblusuario.Correo from  tbldocxinstituto, tblinstituto, tblusuario WHERE  tblinstituto.IDInstituto=tbldocxinstituto.IDInstituto and tbldocxinstituto.IDDocente=tblusuario.IDUsuario  and tblusuario.IDUsuario=".$_POST['IDUsuario'];
$resultado=$conexion->ejecutarconsulta($consulta);
$data=$conexion->obtenerfila($resultado);
?>



<div class="col-md-12">
	<div class="col-md-12">	<br>
		<h1 style="text-align: center;">
			Gestión de Docentes
		</h1>
		<br>
		<div class="ui inverter divider">
			
		</div>

			<div class="row mb-4" >
				<div class="col-lg-6">
					<label>Ingresa Nuevo nombre:</label>
					<input type="text" name="txtNombre" id="txtNombre" value="<?php echo $data['Nombre']; ?>" class="form-control">
				</div>
				<div class="col-lg-6">
					<label>Ingresa nuevo apellido:</label>
					<input type="text" name="txtApellido" id="txtApellido" value="<?php echo $data['Apellido']; ?>" class="form-control">
				</div>
			</div>
			
			
			<div class="row mb-4" >
				<div class="col-lg-6">
					<label>Ingresa nuevo Cedula:</label>
					<input type="text" name="txtCedula" id="txtCedula" value="<?php echo $data['Cedula']; ?>" class="form-control">
				</div>
				<div class="col-lg-6">
					<label>Ingresa nuevo Telefono:</label>
					<input type="text" name="txtTelefono" id="txtTelefono" value="<?php echo $data['Telefono']; ?>" class="form-control">
				</div>
			</div>

			<div class="row mb-4" >
				<div class="col-lg-12">	
					<label>Ingresa nuevo correo:</label>
					<input type="email" name="txtCorreo" id="txtCorreo" value="<?php echo $data['Correo']; ?>" class="form-control">
					<input type="number" name="txtIdentificador" id="txtIdentificador" value="<?php echo $_POST['IDUsuario'];?>" style="display: none;">
				</div>
			</div>

			<div id="error"></div>
			<br>
			<div class="row mb-3 ml-2">
			<div class="col-lg-4"></div>
				<div class="col-lg-4">
				<button class="ui fluid blue button" onclick="actualizarDocente()">Modificar Docente</button>
				</div>
			</div>
			<div class="row mb-3 ml-2">
							<div class="col-lg-4"></div>
				<div class="col-lg-4">
				<a href="#" class="ui fluid red button" onclick="cargarDiv('columnaContenido', 'Contenido/Perfil/moduloUsuarios.php'); listar('')">Cancelar</a>
				</div>
			</div>


	</div>
</div>