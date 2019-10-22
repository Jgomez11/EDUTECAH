<?php 
session_start();
if (empty($_SESSION)) {
  header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php  echo $_SESSION["Usuario"]; ?></title>
	<link rel="stylesheet" type="text/css" href="Frameworks/Semantic/semantic.css">
  <link rel="stylesheet" href="Frameworks/Bootstrap/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="Recursos/Estilos/floating-labels.css">
  <link rel="stylesheet" type="text/css" href="Recursos/Estilos/styles.css">

  <script src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>

  <script src="Frameworks/Flipbook/js/jquery.min.js"></script>
  <script src="Frameworks/Semantic/semantic.min.js"></script>
  <script type="text/javascript" src="Recursos/Scripts/scripts.js"></script>
  <script src="Recursos/Scripts/controlador.js"></script>

</head>
<body>
  <div id="barra" class="ui fixed top"></div>
  <div id="cargar"></div>
  <div class="row" style="margin-top: 80px;">
    <div id="columnaOpciones" class="col-md-3"></div>
    <div id="columnaContenido" class="col-md-9"></div>
  </div>
  <div id="modal"></div>

  <script src="Frameworks/Flipbook/js/html2canvas.min.js"></script>
  <script src="Frameworks/Flipbook/js/three.min.js"></script>
  <script src="Frameworks/Flipbook/js/pdf.min.js"></script>
  <script src="Frameworks/Flipbook/js/3dflipbook.min.js"></script>
</body>
</html>