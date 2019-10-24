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
$consulta="SELECT tblcalificaciones.IDCalificacion , tblaula.Asignatura, tblcalificaciones.CodigoAlumno, tblcalificaciones.NotaIP, tblcalificaciones.NotaIIP, tblcalificaciones.NotaIIIP, tblcalificaciones.Acumulativo, tblcalificaciones.Proyecto, tblcalificaciones.Recuperacion, tblcalificaciones.NotaFinal FROM tblcalificaciones, tblaula where tblaula.IDAula=tblcalificaciones.IDAula and tblcalificaciones.IDCalificacion=".$_POST['IDCalificacion'] ;
$resultado=$conexion->ejecutarconsulta($consulta);
$data=$conexion->obtenerfila($resultado);
?>



<div class="col-md-12">
	<div class="col-md-12">	<br>
		<h1 style="text-align: center;">
			Editar Calificación
			
		</h1>
		<br>
		<input type="number" name="txtIDC" id="txtIDC" value="<?php echo $_POST['IDCalificacion'];?>">
		<h5><label>Codigo de Alumno: <?php echo $data['CodigoAlumno']; ?></label></h5>
		<div class="ui inverter divider">
		</div>

		<div class="row mb-4" >
			<div class="col-lg-2">
				<label>Nota IParcial:</label>
				<input type="text" name="txtNot1" id="txtNot1" value="<?php echo $data['NotaIP']; ?>" class="form-control">
			</div>
			<div class="col-lg-2">
				<label>Nota IIParcial:</label>
				<input type="text" name="txtNot2" id="txtNot2" value="<?php echo $data['NotaIIP']; ?>" class="form-control">
			</div>

			<div class="col-lg-2">
				<label>Nota IIIParcial:</label>
				<input type="text" name="txtNot2" id="txtNot2" value="<?php echo $data['NotaIIIP']; ?>" class="form-control">
			</div>

			<div class="col-lg-2">
				<label>Acumulativo:</label>
				<input type="text" name="txtAcum" id="txtAcum" value="<?php echo $data['Acumulativo']; ?>" class="form-control">
			</div>
			<div class="col-lg-2">
				<label>Proyecto:</label>
				<input type="text" name="txtProy" id="txtProy" value="<?php echo $data['Proyecto']; ?>" class="form-control">
			</div>

			<div class="col-lg-2">
				<label>Recuperacion:</label>
				<input type="text" name="txtRecu" id="txtRecu" value="<?php echo $data['Recuperacion']; ?>" class="form-control">
			</div>
		</div>


		<div class="row mb-4" >
			<div class="col-lg-12">
				<label>Nota Final:</label>
				<input type="text" name="txtNotF" id="txtNotF" value="<?php echo $data['NotaFinal']; ?>" class="form-control">

			</div>
		</div>


		<div id="error"></div>
		<br>
		<div class="row mb-3 ml-2">
			<div class="col-lg-4"></div>
			<div class="col-lg-4">
				<button class="ui fluid blue button aceptar" id="ECalificacion">Guardar cambios</button>
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