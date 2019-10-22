<?php
session_start();
if (empty($_SESSION)) {
  header('Location: index.php');
} elseif (!isset($_SESSION['IDAula'])) {
  header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Aula </title>
  <link rel="stylesheet" type="text/css" href="Frameworks/Semantic/semantic.css">
  <link rel="stylesheet" href="Frameworks/Bootstrap/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="Recursos/Estilos/styles.css">

  <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
  <script src="Frameworks/Flipbook/js/jquery.min.js"></script>
  <script src="Frameworks/Semantic/semantic.min.js"></script>
  <script type="text/javascript" src="Recursos/Scripts/scripts.js"></script>
  <script src="Recursos/Scripts/controlador.js"></script>

</head>

<body>
  <!-- Barra Principal-->
  <div id="barra" class="ui fixed top"></div>
  <!--Fin de Barra Principal-->
  <div id="cargar"></div>
  <div class="row" style="margin-top: 80px;">
    <div id="columnaContenido" class="col-md-12"></div>
    <div id="modal" class="col-md-12"></div>
  </div>
  
</body>

</html>