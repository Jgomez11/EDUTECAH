<?php
#    Session
session_start();

#    Importar Clases
include("Clases/Conexion.php");

#    Crear conexion
$conexion = new Conexion();
$conexion->mysql_set_charset("utf8");
?>


<!DOCTYPE html>
<html>
<head>
  <title>Selecciona un plan</title>

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
  <style type="text/css">
    #divCard{
      -webkit-transform:scale(1,1);
      -webkit-transition-duration:100ms;
    }

    #divCard:hover{
      -webkit-transform:scale(1.12,1.12);
      -webkit-transition-duration:100ms;
    }
  </style>
</head>

<body style="background-color: #eafbf1">
  <div class="container mt-5">
    <div id="cargar"></div>
    <div class="row">
      <div class="col-md-12">
        <div class="text-center form-signin">
          <img src="Recursos/Imagenes/logoDark.png" alt="" width="200" >
          <h1 class="h3 font-weight-normal">Pase virtual: <?php echo $_SESSION['Pase']; ?></h1>
          <p>Por favor provea este pase virtual a los docentes que se registraran en el sistema. 
          Podra revisar su pase en la pagina de perfil</p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="text-center mb-4">
          <div class="form-signin">
            <h1 class="h3 font-weight-normal">Selecciona un plan</h1>
            <p>Por favor seleccione uno de los siguientes planes para utilizar la plataforma <br> <br></p>
          </div>  

          
          <div class="row">

            <?php
            $consulta="select tbltipoplan.IDTipoPlan, tbltipoplan.TipoPlan , tbltipoplan.Precio, tbltipoplan.Soporte, tbltipoplan.AulasDisponibles, tbltipoplan.Calificaciones, tbltipoplan.notificacionesEmail from tbltipoplan";

            $resultado=$conexion->ejecutarconsulta($consulta);

            while ($arreglo=$resultado->fetch_array()) {
              echo'


              <div class="col-md-3" id="divCard">
              
              <div class="card ui">
              
              <div class="ui center aligned header"> <br> '.$arreglo['TipoPlan'].'<br> $  '   .$arreglo['Precio']. ' </div>
              <div class="meta">
              <span class="category"> <br>  <hr>  Detalles del paquete <hr> <br> </span>
              </div>

              <div class="description">

              <div class="item"> <strong>Cantidad de Aulas: </strong> &emsp;&emsp;&emsp;&emsp; <em>'.$arreglo['AulasDisponibles'].'</em>  <br> <br></div>
              
              <div class="item"><strong> Soporte Guiado por Video: </strong> &nbsp; &nbsp; <em>  '.$arreglo['Soporte'].'</em>  <br><br></div>

              <div class="item"><strong> Calificaciones: </strong> &nbsp; &nbsp; &nbsp; &nbsp;  &emsp;  &emsp;  &emsp; &nbsp; <em>  '.$arreglo['Calificaciones'].'</em>  <br><br></div>

              <div class="item"><strong> Notificaciones via email: </strong> &nbsp; &nbsp; &nbsp; <em>  '.$arreglo['notificacionesEmail'].'</em>  <br><br></div>

              <div class="item"> <strong>Contenido Disponible 24/7: </strong> &nbsp;  <em>SI</em> <br> <br> </div>

              <div class="item"> <strong>Lector PDF Integrado:</strong> &emsp;&emsp;&emsp;  <em>SI</em> <br> <br> </div>

              <div class="item"> <strong> Gestion de Docentes:</strong>  &nbsp;&emsp;&emsp;&emsp;  <em>SI</em> <br> <br> </div>


              <br>
              <br>
              </div>
              
              
              <a class="ui basic green button"  href="Acciones/actualizarPlan.php?planID='.$arreglo['IDTipoPlan'].'&Aulas='.$arreglo['AulasDisponibles'].'">Seleccionar</a>

              </div>
              
              </div>
              ';     }  ?>  

            </div>
            <br>
            <a href="index.php" class="form-signin btn btn-block ui red button mt-5">Seleccionar mas tarde</a>
          </div>
        </div>
      </div>
      <p class="text-muted text-center mb-4">&copy; 2018-2019</p>   
    </div>
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