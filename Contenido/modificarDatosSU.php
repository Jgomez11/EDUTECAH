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
	<div class="col-md-12" style="border-width: 1px 1px 1px 1px; border-style: solid; border-color: lightgray;">	<br>
		<h5 style="text-align: center;">
			Gestión de Docentes
		</h5>
		<br>
		<div class="ui inverter divider">
			
		</div>

		<form method="post" action="Acciones/modificarRegistrosSU.php">
			<div class="row mb-4" >
				
				<div class="col-lg-6">
					<label>Selecciona un nuevo Cargo:</label>
					<select class="custom-select" name="slcCargo"  class="form-control">
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
					<input type="email" name="txtCorreo" value="<?php echo $dataW['Correo']; ?>" class="form-control">
					<input type="number" name="txtIdentificador" id="txtIdentificador" value="<?php echo $_POST['IDUsuario'];?>" style="display: none;">
				</div>
				
			</div>



			<div class="row mb-4" >
				
				<div class="col-lg-6">
					<label>Ingresa Nuevo nombre:</label>
					<input type="text" name="txtNombre"  value="<?php echo $dataW['Nombre']; ?>" class="form-control">
				</div>
				<div class="col-lg-6">
					<label>Ingresa nuevo apellido:</label>
					<input type="text" name="txtApellido" value="<?php echo $dataW['Apellido']; ?>" class="form-control">
				</div>
				
			</div>

			<div class="row mb-4" >
				
				<div class="col-lg-6">
					<label>Ingresa Nueva Cedula:</label>
					<input type="text" name="txtCedula"  value="<?php echo $dataW['Cedula']; ?>" class="form-control">
				</div>
				<div class="col-lg-6">
					<label>Ingresa nuevo Telefono:</label>
					<input type="text" name="txtTelefono" value="<?php echo $dataW['Telefono']; ?>" class="form-control">
				</div>
				
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