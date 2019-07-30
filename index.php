<!DOCTYPE html>
<html>
<head>
	<title>EDUTECAH</title>
	<link rel="stylesheet" type="text/css" href="Frameworks/Semantic/semantic.min.css">
  <link rel="stylesheet" href="Frameworks/Bootstrap/css/bootstrap.css">
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"
  		integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  		crossorigin="anonymous"></script>
  <script src="Frameworks/Flipbook/js/jquery.min.js"></script>
	<script src="Frameworks/Semantic/semantic.min.js"></script>
  <script type="text/javascript" src="Recursos/Scripts/scripts.js"></script>
</head>
<body style="background-color: #eafbf1">
  <!-- Barra Principal-->
  <div id="barra"></div>
  <!--Fin de Barra Principal-->

  <img class="ui fluid image mt-0" src="Recursos/Imagenes/indexImgPrincipal.jpg">

  <div id="cuerpo"></div>

  <div id="cargar"></div>

  <script type="text/javascript">
    $(document).ready(function() {
      cargarDiv("barra","Contenido/barra.php");
      cargarDiv("cuerpo","Contenido/indexCuerpo.php");
    });
  </script> 
</body>
</html> 	