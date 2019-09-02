
<h4>Informacion Personal</h4>

<div class="form-label-group">
	<input type="text" id="txtNombre" name="txtNombre" class="form-control" placeholder="Nombre" required autofocus>
	<label for="inputEmail">Nombre</label>
</div>


<div class="form-label-group">
	<input type="text" id="txtApellido" name="txtApellido" class="form-control" placeholder="Apellido" required >
	<label for="inputEmail">Apellido</label>
</div>

<div class="form-label-group">
	<input type="email" id="txtCorreo" name="txtCorreo" class="form-control" placeholder="Correo electrónico" required >
	<label for="inputEmail">Correo electrónico</label>
</div>

<div class="form-label-group">
	<input type="password" id="txtPassword" name="txtPassword" class="form-control" placeholder="Contraseña" required >
	<label for="inputPassword">Contraseña</label>
</div>

<div class="form-label-group">
	<input type="text" id="txtPase" name="txtPase" class="form-control" placeholder="Pase virtual" required >
	<label for="inputEmail">Pase virtual</label>
</div>

<div class="ui toggle checkbox">
	<input type="checkbox" required>
	<label><a href="Contenido/politicas_usuario.php" target="_blank"> He leído los términos y condiciones </a></label><br>
</div>


<div id="error"></div>
<button id="boton" class="btn btn-block ui primary button" type="submit" value="1">Registrar</button>
<a href="index.php" class="btn btn-block ui red button">Cancelar</a>

<div id="cargar" class="form-signin"></div>