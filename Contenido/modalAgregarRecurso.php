<?php
#    Session
session_start();
#    Importar Clases
include("../Clases/Conexion.php");
#    Crear conexion
$conexion = new Conexion();
$conexion->mysql_set_charset("utf8");

?>
<div class="ui first small modal" id="modalRecursos">
	<div class="header">Agregar nueva aula</div>
	<div class="content">
		<div class="field">
			<label>Titulo</label>
			<div class="ui fluid input">
			  <input id="txtTitulo" type="text" placeholder="Escribe un titulo">
			</div>
		</div>
		<div class="field mt-4">
			<label>Archivo</label>
			<div class="ui fluid action input">
				<input type="text" id="_attachmentName" placeholder="Seleccionar un archivo">
				<label for="archivoAdjunto" class="ui icon button btn-file">Explorar 
					<i class="paperclip basic icon"></i>
					<input type="file" id="archivoAdjunto" name="archivoAdjunto" onchange="cargarElemento()" style="display: none">
				</label>
			</div>
			<div id="error" class="mt-4"></div>
		</div>
		<div class="field">
			<label>Seleccionar categorias (max. 3)</label>
			<div class="ui fluid multiple search selection dropdown" id="ddCategorias">
				<input type="hidden" name="txtCat" id="txtCat">
				<div class="default text">Seleccionar Categoria</div>
				<i class="dropdown icon"></i>
				<div class="menu">
					<?php
					$consulta  = sprintf("SELECT IDCategoria, Categoria From tblCategorias ORDER BY Categoria");
					$resultado = $conexion->ejecutarconsulta($consulta);
					$iter      = $conexion->cantidadRegistros($resultado);
					for ($i = 0; $i < $iter; $i++) {
						$data = $conexion->obtenerFila($resultado);
						echo '<div class="item" data-value="' . $data["IDCategoria"] . '">' . $data["Categoria"] . '</div>';
					}
					?>
				</div>
			</div>
		</div>
	</div>
	<div class="actions">
	  <div class="ui teal button" onclick="subirRecurso()">Aceptar</div>
	  <div class="ui cancel red button">Cancelar</div>
	</div>
</div>