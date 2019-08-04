<!DOCTYPE html>
<html>
<head>
	<title>Lector</title>
	<link rel="stylesheet" type="text/css" href="Frameworks/Semantic/semantic.css">
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
    	<div id="columnaContenido" class="col-md-12">
    	</div>
	</div>

        <script type="text/javascript">
      $(document).ready(function() {
          cargarDiv("barra","Contenido/barra.php");
      });
    </script>
</body>
</html>