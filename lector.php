<?php
session_start();
if (empty($_SESSION)) {
header('Location: index.php');
} elseif (!isset($_SESSION['IDLibro'])) {
header('Location: index.php');
}


#    Importar Clases
include("Clases/Conexion.php");

#    Crear conexion
$conexion = new Conexion();
$conexion->mysql_set_charset("utf8");
?>

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
    		<?php 
    			if (isset($_SESSION["IDLibro"])) {
    				$consulta  = sprintf("SELECT Titulo FROM tblRecurso WHERE IDRecurso = '%s'",
              $conexion->antiInyeccion($_SESSION['IDLibro']));
            $resultado = $conexion->ejecutarconsulta($consulta);
            $data      = $conexion->obtenerFila($resultado);

    		    echo '<h1 align="center">'.$data["Titulo"].'</h1>';

            echo '<div id="lector" class="flip-book-container solid-container container" style="height: 85vh" src="Recursos/Data/'.$_SESSION["IDLibro"].'.pdf"></div>';
    			}
    		 ?>
    	</div>
	</div>

        <script type="text/javascript">
      $(document).ready(function() {
          cargarDiv("barra","Contenido/barra.php");
      });
    </script>
    <script src="Frameworks/Flipbook/js/html2canvas.min.js"></script>
    <script src="Frameworks/Flipbook/js/three.min.js"></script>
    <script src="Frameworks/Flipbook/js/pdf.min.js"></script>

    <script src="Frameworks/Flipbook/js/3dflipbook.min.js"></script>
    
</body>
</html>
