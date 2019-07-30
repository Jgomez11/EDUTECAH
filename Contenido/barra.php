<div class="ui inverted secondary menu fixed top navbar navbar-expand-md" style="background-color: #55876d;">
  
  <!--Botones de izquierda-->
  <a class="navbar-brand" href="#"><img height="40px" src="Recursos/Imagenes/logo.png"></a>
  <a class="item" href="index.php">Inicio</a>
  <a class="item" href="login.php">Iniciar Sesión</a>
  <a class="item" href="registro.php">Registrarse</a>
  
  <!--Barra de busqueda-->
  <div class="ui search mx-auto">
    <form method="get" action="index.php">
      <div class="ui icon input">
        <input class="prompt" type="text" placeholder="Buscar libros..." onkeyup="buscar()">
        <i class="search icon"></i>
      </div>
    </form>
    <div class="results"></div>
  </div>
  
  <!--Botones de derecha-->
  <a class="item" href="#"><i class="user circle icon"></i>Perfil</a>
  <a class="item" href="#"><i class="envelope icon"></i><div class="floating ui red circular label">2</div></a>
  <a class="item" href="#"><i class="bell icon"></i><div class="floating ui red circular label">2</div></a>
  
  <!--Dropdown Opciones-->
  <div class="ui top pointing dropdown item">
    <span onclick="$('.ui.dropdown').dropdown();"><i class="dropdown  icon"></i></span>
    <div class="menu">
      <div class="header">Categorías</div>
      <div class="item">Notificaciones</div>
      <div class="item"><img class="ui avatar image" src="Recursos/Imagenes/perfilDefecto.png">Perfil</div>
      <div class="divider"></div>
      <div class="item">Cerrar sesion</div>
    </div>
  </div>
</div>
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