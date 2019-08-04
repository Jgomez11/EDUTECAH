<?php  
#   Importar Clases
include("../Clases/Conexion.php");

#   Crear conexion
$conexion = new Conexion();
$conexion->mysql_set_charset("utf8");
?>
<h4>Informacion Personal</h4>

<div class="form-label-group">
    <input type="text" id="txtNombre" name="txtNombre" class="form-control" placeholder="Nombre" required autofocus>
    <label for="inputEmail">Nombre</label>
</div>

<div class="form-label-group">
    <input type="text" id="txtApellido" name="txtApellido" class="form-control" placeholder="Apellido" required>
    <label for="inputEmail">Apellido</label>
</div>

<div class="form-label-group">
    <input type="email" id="txtCorreo" name="txtCorreo" class="form-control" placeholder="Correo electrónico" required>
    <label for="inputEmail">Correo electrónico</label>
</div>

<div class="form-label-group">
    <input type="password" id="txtPassword" name="txtPassword" class="form-control" placeholder="Contraseña" required>
    <label for="inputPassword">Contraseña</label>
</div>

<div class="ui divider"></div>

<h4>Informacion del Instituto</h4>

<div class="form-label-group">
    <input type="text" id="txtCodInstituto" name="txtCodInstituto" class="form-control" placeholder="Codigo de colegio" required>
    <label for="inputEmail">Codigo de colegio</label>
</div>

<div class="form-label-group">
    <input type="text" id="txtNomInstituto" name="txtNomInstituto" class="form-control" placeholder="Nombre del colegio" required>
    <label for="inputEmail">Nombre del colegio</label>
</div>

<h5>Ubicacion del Instituto</h5>
<div class="form-label-group">
    <div class="field">
        <label>Departamento</label>
        <div class="ui search fluid selection dropdown" onmouseover="$('.dropdown').dropdown();">
            <input type="hidden" name="txtIDDepto" id="txtIDDepto" onchange="cargarMun()">
            <i class="dropdown icon"></i>
            <div class="default text">Seleccionar departamento</div>
            <div class="menu">
                <?php
                $consulta = sprintf("SELECT IDDepartamento, NombreDepartamento FROM tblDepartamentos ORDER BY IDDepartamento");
                $resultado = $conexion->ejecutarconsulta($consulta);
                $iter = $conexion->cantidadRegistros($resultado);
                for ($i=0; $i < $iter; $i++) {
                    $data = $conexion->obtenerFila($resultado);
                    echo '<div class="item" data-value="'.$data["IDDepartamento"].'">'.$data["NombreDepartamento"].'</div>';
                }
                ?>
            </div>
        </div>
    </div>
</div>

<div class="form-label-group">
    <div class="field">
        <label>Municipio</label>
        <div class="ui search fluid selection dropdown" onmouseover="$('.dropdown').dropdown();">
            <input type="hidden" class="form-control" name="txtMunicipio" id="txtMunicipio">
            <i class="dropdown icon"></i>
            <div class="default text">Seleccionar municipio</div>
            <div class="menu" id="Municipio">
            </div>
        </div>
    </div>
</div>

<div class="form-label-group">
    <input type="text" id="txtDireccion" name="txtDireccion" class="form-control" placeholder="Direccion" required>
    <label for="inputEmail">Direccion</label>
</div>


<div class="ui toggle checkbox">
    <input type="checkbox" required>
    <label><a href="Contenido/politicas_usuario.php" target="_blank"> He leído los términos y condiciones </a></label><br>
</div>

<div id="error"></div>

<button id="boton" class="btn btn-block ui primary submit button" type="submit" value="0">Registrar</button>
<a href="index.php" class="btn btn-block ui red button">Cancelar</a>