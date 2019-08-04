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
	<div class="col-md-12" style="border-width: 1px 1px 1px 1px; border-style: solid; border-color: lightgray;">	<br>
		<h5 style="text-align: center;">
			Gestión de Docentes
		</h5>
		<br>
		<div class="ui inverter divider">
			
		</div>

		<form method="post" action="Acciones/modificarRegistroDocente.php">
			<div class="row mb-4" >
				<div class="col-lg-4"></div>
				<div class="col-lg-4">
					<label>Ingresa Nuevo nombre:</label>
					<input type="text" name="txtNombre"  value="<?php echo $data['Nombre']; ?>" class="form-control">
				</div>
				<div class="col-lg-4"></div>
				
			</div>

			<div class="row mb-4" >
				<div class="col-lg-4"></div>
				<div class="col-lg-4">
					<label>Ingresa nuevo apellido:</label>
					<input type="text" name="txtApellido" value="<?php echo $data['Apellido']; ?>" class="form-control">
				</div>
				<div class="col-lg-4"></div>
			</div>
			
			
			<div class="row mb-4" >
				<div class="col-lg-4"></div>
				<div class="col-lg-4">
					<label>Ingresa nuevo Cedula:</label>
					<input type="text" name="txtCedula" value="<?php echo $data['Cedula']; ?>" class="form-control">
				</div>
				<div class="col-lg-4"></div>
			</div>


			<div class="row mb-4" >
				<div class="col-lg-4"></div>
				<div class="col-lg-4">
					<label>Ingresa nuevo Telefono:</label>
					<input type="text" name="txtTelefono" value="<?php echo $data['Telefono']; ?>" class="form-control">
				</div>
				<div class="col-lg-4"></div>
			</div>


			<div class="row mb-4" >
				<div class="col-lg-4"></div>
				<div class="col-lg-4">	
					<label>Ingresa nuevo correo:</label>
					<input type="email" name="txtCorreo" value="<?php echo $data['Correo']; ?>" class="form-control">
					<input type="number" name="txtIdentificador" id="txtIdentificador" value="<?php echo $_POST['IDUsuario'];?>" style="display: none;">
				</div>
				<div class="col-lg-4"></div>
			</div>

			<br>
			<div class="row mb-3 ml-2">
				<div class="col-lg-4"></div>
				<button type="submit" class="ui blue button ">Modificar Docente</button>
				<a href="#" class="ui red button" onclick="cargarDiv('zonaContenido', 'Contenido/modificarUsuarios.php')">Cancelar</a>
			</div>
			<div class="col-lg-4"></div>
		</form>

	</div>
</div>	