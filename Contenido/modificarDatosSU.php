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
$consultaW="SELECT  tblinstituto.NombreIns,tbltipousuario.IDTipoUs, tbltipousuario.Tipo, tblusuario.IDUsuario, tblusuario.Nombre ,tblusuario.Apellido, tblusuario.Cedula, tblusuario.Telefono ,tblusuario.Correo from  tbldocxinstituto, tblinstituto, tblusuario, tbltipousuario WHERE  tblinstituto.IDInstituto=tbldocxinstituto.IDInstituto and tbldocxinstituto.IDDocente=tblusuario.IDUsuario and tblusuario.TipoUsuario=tbltipousuario.IDTipoUs and tblusuario.IDUsuario=".$_POST['IDUsuario'];
$resultadoW=$conexion->ejecutarconsulta($consultaW);
$dataW=$conexion->obtenerfila($resultadoW);
?>
<div class="col-md-12">
	<div class="col-md-12">	<br>
		<h1 style="text-align: center;">
		Gestión de Usuarios
		</h1>
		<br>
		<div class="ui inverter divider">
			
		</div>
		<div class="row mb-4" >
			
			<div class="col-lg-6">
				<label>Selecciona un nuevo Cargo:</label>
				<select class="custom-select" name="slcCargo" id="slcCargo" class="form-control">
					<option value="<?php echo $dataW['IDTipoUs']; ?>" selected> <?php echo $dataW['Tipo']  ?></option>
					<?php
					$consulta="SELECT IDTipoUs, Tipo FROM tbltipousuario";
					$resultado=$conexion->ejecutarconsulta($consulta);
					while ($arreglo=$resultado->fetch_array()) {
						echo '<option value="'.$arreglo[IDTipoUs].'">'.$arreglo[Tipo]."</option>";
					}
					?>
				</select>
			</div>
			
			<div class="col-lg-6">
				<label>Ingresa nuevo correo:</label>
				<input type="email" name="txtCorreo" id="txtCorreo" value="<?php echo $dataW['Correo']; ?>" class="form-control">
				<input type="number" name="txtIdentificador" id="txtIdentificador" value="<?php echo $_POST['IDUsuario'];?>" style="display: none;">
			</div>
			
		</div>
		<div class="row mb-4" >
			
			<div class="col-lg-6">
				<label>Ingresa Nuevo nombre:</label>
				<input type="text" name="txtNombre" id="txtNombre"  value="<?php echo $dataW['Nombre']; ?>" class="form-control">
			</div>
			<div class="col-lg-6">
				<label>Ingresa nuevo apellido:</label>
				<input type="text" name="txtApellido" id="txtApellido" value="<?php echo $dataW['Apellido']; ?>" class="form-control">
			</div>
			
		</div>
		<div class="row mb-4" >
			
			<div class="col-lg-6">
				<label>Ingresa Nueva Cedula:</label>
				<input type="text" name="txtCedula" id="txtCedula"  value="<?php echo $dataW['Cedula']; ?>" class="form-control">
			</div>
			<div class="col-lg-6">
				<label>Ingresa nuevo Telefono:</label>
				<input type="text" name="txtTelefono" id="txtTelefono" value="<?php echo $dataW['Telefono']; ?>" class="form-control">
			</div>
			
		</div>
		<div id="error"></div>
		<br>
		<div class="row mb-3 ml-2">
			<div class="col-lg-4"></div>
			<div class="col-lg-4">
				<button class="ui fluid blue button" onclick="actualizarUsuario()">Modificar Docente</button>
			</div>
		</div>
		<div class="row mb-3 ml-2">
			<div class="col-lg-4"></div>
			<div class="col-lg-4">
				<a href="#" class="ui fluid red button" onclick="cargarDiv('columnaContenido', 'Contenido/modificarUsuarios.php'); listar('')">Cancelar</a>
			</div>
		</div>
		<div class="col-lg-4"></div>
	</div>
</div>