<?php
  session_start();
  include("../Clases/Conexion.php");
  $conexion = new Conexion();
  $conexion->mysql_set_charset("utf8");
?>

<div class="ui teal inverted secondary menu fixed top navbar navbar-expand-md" >
  
  <!--Botones de izquierda-->
  <a class="navbar-brand" href="index.php"><img height="40px" src="Recursos/Imagenes/logo.png"></a>
  <a class="item" href="index.php">Inicio</a>
    <?php
    if (empty($_SESSION) && !isset($_SESSION["ID"]) && !isset($_SESSION["CodigoCurso"]))
    {
      	echo '
        	<a class="item" href="login.php">Iniciar Sesión</a>
        	<a class="item" href="registro.php">Registrarse</a>';
    }elseif (isset($_SESSION["CodigoCurso"])) {
        echo '
          <a class="item">Curso: '.$_SESSION["CodigoCurso"].'</a>
        ';  

    }else if ($_SESSION['TipoUsuario'] == '2') {
    		echo '
    			<a class="item" href="planes.php">Planes</a>
    		';
    }
  ?>
  <!--Barra de busqueda-->
  <div class="ui search mx-auto">
    <form method="get" action="index.php">
      <div class="ui icon input">
        <input class="prompt" type="text" placeholder="Buscar..." onkeyup="buscar()">
        <i class="search icon"></i>
      </div>
    </form>
    <div class="results"></div>
  </div>
  
  <!--Botones de derecha-->
 <?php  
    if (!empty($_SESSION) && isset($_SESSION["ID"])) {
      if ($_SESSION['Imagen'] == NULL || $_SESSION['Imagen'] == "") {
        $img = 'Recursos/Imagenes/perfilDefecto.png';
      } else{
        $img = 'data:image/png;base64,'.base64_encode($_SESSION['Imagen']);
      }
      	echo '
        <a class="item" href="perfil.php"><img class="ui avatar image" src="'.$img.'">'.$_SESSION['Nombre'].'</a>
        <a class="item" href="#"><i class="envelope icon"></i><div class="floating ui red circular label">2</div></a>
        <a class="item" href="#"><i class="bell icon"></i><div class="floating ui red circular label">2</div></a>
        
        <div class="ui top pointing dropdown item">
          <a onclick="$(\'.ui.dropdown\').dropdown();"><i class="dropdown  icon"></i></a>
          <div class="menu">
              <div class="item"><i class="envelope icon"></i><div class="ui empty red circular label"></div> Mensajes </div>
              <div class="item"><i class="bell icon"></i><div class="ui empty red circular label"></div> Notificaciones </div>
              <div class="item"><i class="cog icon"></i> Configuraciones</div>
             '; 
        if ($_SESSION["TipoUsuario"] == '2') {
        	echo '
            <a class="item" href="planes.php"><i class="alternate list icon"></i> Actualizar plan</a>
            <a class="item" href="#"><i class="tasks icon"></i> Administración</a>';
        }
    echo '
            <div class="divider"></div>
              <a class="item" href="perfil.php"><img class="ui avatar image" src="'.$img.'">Tu perfil</a>
            <div class="divider"></div>
            <a class="item" href="Acciones/cerrarSesion.php"><i class="sign out icon"></i>Cerrar sesion</a>
          </div>
        </div>
  ';
    } else {
          echo '          
          <div class="ui top pointing dropdown item">
            <a onclick="$(\'.ui.dropdown\').dropdown();"><i class="dropdown  icon"></i></a>
            <div class="menu">
              <a class="item" href="Acciones/cerrarSesion.php"><i class="sign out icon"></i>Cerrar sesion</a>
            </div>
          </div>';
    }
   ?>
<!--$('.ui.dropdown').dropdown();
        $('.ui.search')
      .search({
      apiSettings: {
        url: '//api.github.com/search/repositories?q={query}'
      },
      fields: {
        results : 'items',
        title   : 'name',
        url     : 'html_url'
      },
      minCharacters : 1});-->
