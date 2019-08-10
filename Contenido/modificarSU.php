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
				<div class="ui fluid selection dropdown" id="ddCargo">
					<input type="hidden" name="slcCargo" id="slcCargo">
					<div class="text">
						<?php echo $dataW["Tipo"]; ?>
					</div>
					<i class="dropdown icon"></i>
					<div class="menu">
						<?php
						$consulta="SELECT IDTipoUs, Tipo FROM tbltipousuario";
						$resultado=$conexion->ejecutarconsulta($consulta);
						$iter = $conexion->cantidadRegistros($resultado);
						for ($i=0; $i < $iter; $i++) {
							$data = $conexion->obtenerFila($resultado);
							echo '<div class="item" data-value="'.$data["IDTipoUs"].'">'.$data["Tipo"].'</div>';
						}
						?>
					</div>
				</div>
			</div>
			
			<div class="col-lg-6">
				<label>Ingresa nuevo correo:</label>
				<input type="email" name="txtCorreo" id="txtCorreo" value="<?php echo $dataW['Correo']; ?>" class="form-control">
				<input type="number" name="txtIdentificador" id="txtIdentificador" value="<?php echo $_POST['IDUsuario'];?>" style="display: none;">
				<input type="number" name="txtTipo" id="txtTipo" value="<?php echo $dataW['IDTipoUs'];?>" style="display: none;">
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
				<a href="#" class="ui fluid red button" onclick="cargarDiv('columnaContenido', 'Contenido/moduloModificar.php'); listar('')">Cancelar</a>
			</div>
		</div>
		<div class="col-lg-4"></div>
	</div>
</div>