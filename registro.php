<!DOCTYPE html>
<html>
<head>
  <title>Registrarse</title>

  <link rel="icon" type="png" href="Recursos/Imagenes/logo.png">
  
  <link rel="stylesheet" type="text/css" href="Frameworks/Semantic/semantic.min.css">
  <link rel="stylesheet" type="text/css" href="Frameworks/Bootstrap/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="Recursos/Estilos/floating-labels.css">

  <script src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
    crossorigin="anonymous"></script>

    <script src="Frameworks/Flipbook/js/jquery.min.js"></script>
  <script src="Frameworks/Bootstrap/js/bootstrap.min.js"></script>
  <script src="Frameworks/Semantic/semantic.min.js"></script>
  <script type="text/javascript" src="Recursos/Scripts/scripts.js"></script>
</head>

<body style="background-color: #eafbf1">
  <div id="cargar"></div>
  <form class="form-signin" method="post" id="form">
    <div class="text-center mb-4">
      <img class="mb-4" src="Recursos/Imagenes/logoDark.png" alt="" width="200">
      <h1 class="h3 mb-3 font-weight-normal">Registrarse</h1>
      <p>Pruebe nuestros servicios durante 30 dias luego podra seleccionar el plan que mejor se adapte a sus necesidades</p>
    </div>  

    <div class="ui buttons btn-block">
      <button class="ui gray button" type="button" onclick="cargarDiv('contenido','Contenido/registroInstituto.php')">Instituto</button>
      <div class="or" data-text="O"></div>
      <button class="ui teal button" type="button" onclick="cargarDiv('contenido','Contenido/registroDocente.php');">Docente</button>
    </div>

    <div id="contenido" class="mt-3">
      <a href="index.php" class="btn btn-block ui red button">Cancelar</a>
    </div>
    <p class="mt-5 mb-3 text-muted text-center">&copy; 2018-2019</p>


  <div id="cargar"></div>
  </form>
  <script type="text/javascript">
    $(document).ready(function(){
      $('#form').on('submit', function(e){
        e.preventDefault();
        
        if (registrar($('#boton').val())) {
          this.submit();
        }
      });
    });
    
    $('.ui.checkbox')
      .checkbox();
  </script>
</body>
</html>