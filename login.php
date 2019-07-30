<!DOCTYPE html>
<html>
<head>
  <title>Iniciar Sesión</title>

  <link rel="icon" type="png" href="Recursos/Imagenes/logo.png">
  
  <link rel="stylesheet" type="text/css" href="Frameworks/Semantic/semantic.min.css">
  <link rel="stylesheet" type="text/css" href="Frameworks/Bootstrap/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="Recursos/Estilos/floating-labels.css">

  <script src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
    crossorigin="anonymous"></script>


  <script src="Frameworks/Bootstrap/js/bootstrap.min.js"></script>
  <script src="Frameworks/Semantic/semantic.min.js"></script>
  <script type="text/javascript" src="Recursos/Scripts/scripts.js"></script>
</head>

<body style="background-color: #eafbf1">
  <form class="form-signin" method="post" id="form">
    <div class="text-center mb-4">
      <img class="mb-4" src="Recursos/Imagenes/logoDark.png" alt="" width="200">
      <h1 class="h3 mb-3 font-weight-normal">Iniciar Sesión</h1>
    </div>  

    <div class="form-label-group">
      <input type="email" id="txtCorreo" name="txtCorreo" class="form-control" placeholder="Email address" required autofocus>
      <label for="inputEmail">Correo electrónico</label>
    </div>

    <div class="form-label-group">
      <input type="password" id="txtPassword" name="txtPassword" class="form-control" placeholder="Password" required autofocus>
      <label for="inputPassword">Contraseña</label>
    </div>

    <div class="checkbox mb-3">
      <div class="ui toggle checkbox">
        <input type="checkbox" tabindex="0" class="hidden">
        <label>Recuérdame</label>
      </div>
    </div>

    <div id="error"></div>
    
    <div id="cargar" class="form-signin">
    </div>
    <button class="btn btn-block ui primary button" type="submit">Iniciar Sesión</button>
    <a href="index.php" class="btn btn-block ui red button">Cancelar</a>
    <p class="mt-5 mb-3 text-muted text-center">&copy; 2018-2019</p>
  </form>
  <script type="text/javascript">
    $(document).ready(function(){
      $('#form').on('submit', function(e){
        e.preventDefault();
        
        if (validarLogin()) {
          this.submit();
        }
      });
    });
    
    $('.ui.checkbox')
      .checkbox();
  </script>
</body>
</html>