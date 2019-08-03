<?php  
  session_start();

# Importar Clases
  include("../Clases/Conexion.php");

# Utilidad de fecha
  date_default_timezone_set('America/Tegucigalpa');

# Crear conexion
  $conexion = new Conexion();
  $conexion->mysql_set_charset("utf8");
 ?>

	<div class="ui first small modal">
  		<div class="header">Agregar nuevo curso</div>
  		<div class="content">
  				<div class="field">
      				<label>Seleccionar curso</label>
					<div class="ui fluid search selection dropdown">
  						<input type="hidden" name="txtIDCurso" id="txtIDCurso">
  						<i class="dropdown icon"></i>
  						<div class="default text">Curso</div>
  						<div class="menu">
  							<?php
								$consulta = sprintf("SELECT IDCurso, NombreCurso FROM tblcursos");
								$resultado = $conexion->ejecutarconsulta($consulta);
								$iter = $conexion->cantidadRegistros($resultado);

								for ($i=0; $i < $iter; $i++) { 
									$data = $conexion->obtenerFila($resultado);

									echo '<div class="item" data-value="'.$data["IDCurso"].'">'.$data["NombreCurso"].'</div>';
								}
  							 ?>
  						</div>
					</div>
      			</div>
      			<div class="field">
      				<label>Seleccionar grado</label>
					<div class="ui fluid search selection dropdown">
  						<input type="hidden" name="txtIDGrado" id="txtIDGrado">
  						<i class="dropdown icon"></i>
  						<div class="default text">Grado</div>
  						<div class="menu">
  							<?php
								$consulta = sprintf("SELECT IDGrado, Grado FROM tblgrado");
								$resultado = $conexion->ejecutarconsulta($consulta);
								$iter = $conexion->cantidadRegistros($resultado);

								for ($i=0; $i < $iter; $i++) { 
									$data = $conexion->obtenerFila($resultado);

									echo '<div class="item" data-value="'.$data["IDGrado"].'">'.$data["Grado"].'</div>';
								}
  							 ?>
  						</div>
					</div>
      			</div>
      	</div>
  		<div class="actions">
    		<button class="ui approve teal button" onclick="registrarCurso();">Aceptar</button>
    		<div class="ui cancel red button">Cancelar</div>
  		</div>
	</div>
		<div class="ui second small modal">
  		<div class="header">Agregar nuevo curso</div>
  		<div class="content" id="contenido"></div>
  		<div class="actions">
    		<button class="ui approve button">Aceptar</button>
  		</div>
	</div>