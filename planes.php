<?php 
  session_start();
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
</head>

<body style="background-color: #eafbf1">
  <div class="container mt-5">
    <div id="cargar"></div>
    <div class="row">
      <div class="col-md-12">
        <div class="text-center form-signin">
          <img src="Recursos/Imagenes/logoDark.png" alt="" width="200">
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
            <p>Por favor seleccione uno de los siguientes planes para utilizar la plataforma</p>
          </div>  
            <div class="row">
            <div class="col-md-3">
              <a class="ui card">
                <div class="content">
                  <div class="ui center aligned header">Prueba (Defecto)</div>
                  <div class="meta">
                    <span class="category">Detalles del paquete</span>
                  </div>
                  <div class="description">
                    <p>
                      <div class="ui left aligned bulleted list">
                        <div class="item">30 dias de acceso</div>
                        <div class="item">10 aulas</div>
                        <br>
                        <br>
                      </div>
                    </p>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-md-3">
              <a class="ui card">
                <div class="content">
                  <div class="ui center aligned header">Basico ($5.00)</div>
                  <div class="meta">
                    <span class="category">Detalles del paquete</span>
                  </div>
                  <div class="description">
                    <p>
                      <div class="ui left aligned bulleted list">
                        <div class="item">Acceso ilimitado</div>
                        <div class="item">20 aulas</div>
                        <div class="item">Ediciones de wiki</div>
                        <br>
                      </div>
                    </p>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-md-3">
              <a class="ui card">
                <div class="content">
                  <div class="ui center aligned header">Estandar ($7.00)</div>
                  <div class="meta">
                    <span class="category">Detalles del paquete</span>
                  </div>
                  <div class="description">
                    <p>
                      <div class="ui left aligned bulleted list">
                        <div class="item">Acceso ilimitado</div>
                        <div class="item">40 aulas</div>
                        <div class="item">Ediciones de wiki</div>
                        <div class="item">Soporte personalizado</div>
                      </div>
                    </p>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-md-3">
              <a class="ui card">
                <div class="content">
                  <div class="ui center aligned header">Completo ($10.00)</div>
                  <div class="meta">
                    <span class="category">Detalles del paquete</span>
                  </div>
                  <div class="description">
                    <p>
                      <div class="ui left aligned bulleted list">
                        <div class="item">Acceso ilimitado</div>
                        <div class="item">100 aulas</div>
                        <div class="item">Ediciones de wiki</div>
                        <div class="item">Soporte personalizado</div>
                      </div>
                    </p>
                  </div>
                </div>
              </a>
            </div>
            </div>
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