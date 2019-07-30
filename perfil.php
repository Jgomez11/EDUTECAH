<!DOCTYPE html>
<html>
<head>
	<title>Nombre Usuario</title>
	<link rel="stylesheet" type="text/css" href="Frameworks/Semantic/semantic.min.css">
  <link rel="stylesheet" href="Frameworks/Bootstrap/css/bootstrap.css">
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"
  		integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  		crossorigin="anonymous"></script>

  <script src="Frameworks/Flipbook/js/jquery.min.js"></script>
	<script src="Frameworks/Semantic/semantic.min.js"></script>
  <script type="text/javascript" src="Recursos/Scripts/scripts.js"></script>

    <style type="text/css">
#myiframe {width:600px; height:100%;} 
</style>
</head>
<body style="background-color: #eafbf1">
    <!-- Barra Principal-->
    <div id="barra" class="ui fixed top"></div>
    <!--Fin de Barra Principal-->
    <div id="cargar"></div>

    <div class="row" style="margin-top: 80px;">
      <!--Zona #1 Reservada para navegación del usuario-->
      <div id="columnaOpciones" class="col-md-3"></div>
      <!--Zona #2 Reservada para información del contacto y productos del usuario-->
      <div id="columnaContenido" class="col-md-7">
        <div class="flip-book-container solid-container" style="height: 85vh" src="1.pdf">
      </div>
      <!--Zona #3 Reservada para publicidad-->
      <div class="col-md-2"></div>
    </div>

    <script src="Frameworks/Flipbook/js/html2canvas.min.js"></script>
    <script src="Frameworks/Flipbook/js/three.min.js"></script>
    <script src="Frameworks/Flipbook/js/pdf.min.js"></script>

    <script src="Frameworks/Flipbook/js/3dflipbook.min.js"></script>
  
    <script type="text/javascript">
      $(document).ready(function() {
          cargarDiv("barra","Contenido/barra.php");
          cargarDiv("columnaOpciones","Contenido/columnaPerfil.php");
      });
    </script>
</body>
</html>