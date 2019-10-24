<?php
session_start();
include("Clases/Conexion.php");
$conexion = new Conexion();
$conexion->mysql_set_charset("utf8");
?>
<!DOCTYPE html>

<html>
<head>
	<title>Soporte</title>
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
	<?php include("Contenido/modalVideos.php"); ?>
</head>

<body style="background-color: #eafbf1">
	<div class="ui container mt-12">


		<?php  
		if (!empty($_SESSION) && isset($_SESSION["ID"]) && $_SESSION["TipoUsuario"]=='3') {
    #Inicio de fila para Maestro

			ECHO' 
			<div class="container col-10">
			<div class="text-center mb-3"> <br>
			<hr> <h1 class="h3 mb-3 font-weight-normal">Hola. ¿En qué podemos ayudarte?</h1> <hr>
			</div>
			</div> <br>  <br>


			<div class="container">
			<center>
			<div class="row">


			<div class="col-md-3 mb-3">
			</div>

			<div class="col-md-3 mb-3" >
			<div class="ui link card">
			<div class="content">
			<div class="center aligned floated author">
			<img class="ui image" width="250px" src="recursos/imagenes/Portadas Tarjetas Videos/V_CrearAUL.jpg">
			</div>
			<div class="ui center aligned header">¿Como Crear Una Nueva Asignatura?</div>
			</div>
			<button class="ui basic green button" type="button"onclick="$(\'#modalComoCrearUnaNuevaAula\')

			.modal(
			{	

				onDeny: function () {
					$(\'video\').trigger(\'pause\'); 
				} 			
				})
				.modal(\'setting\', \'transition\', \'scale\')
				.modal(\'show\');"> 
				<i class="play icon"></i>Ver </button>

				</div>
				</div>

				<div class="col-md-3 mb-3">
				<div class="ui link card">
				<div class="content">
				<div class="center aligned floated author">
				<img class="ui image" width="250px" src="recursos/imagenes/Portadas Tarjetas Videos/V_SubirRECUR.jpg">
				</div>
				<div class="ui center aligned header">¿Como Subir Un Nuevo Recurso?</div> 
				</div>
				<button class="ui basic green button" type="button"onclick="$(\'#modalComoSubirUnNuevoRecurso\')

				.modal(
				{
					onDeny: function () {
						$(\'video\').trigger(\'pause\'); 
					}
					})
					.modal(\'setting\', \'transition\', \'scale\')
					.modal(\'show\');"> 
					<i class="play icon"></i>Ver </button>
					</div>
					</div>

					</div>
					</center>
					</div>

					<div>
					<br> <p class="mt-5 mb-3 text-muted text-center">&copy; 2018-2019</p>
 			</div>' #FIN DE FILA
 			;

 		}
 		elseif (!empty($_SESSION) && isset($_SESSION["ID"]) && $_SESSION["TipoUsuario"]=='2') {
      #Inicio de fila para Director-->
 			ECHO'
 			<div class="container col-10">
 			<div class="text-center mb-3"> <br>
 			<hr> <h1 class="h3 mb-3 font-weight-normal">Hola. ¿En qué podemos ayudarte?</h1> <hr>
 			</div>
 			</div> <br>  <br>


 			<div class="container">
 			<center>
 			<div class="row">


 			<div class="col-md-3 mb-3">
 			</div>

 			<div class="col-md-3 mb-3" >
 			<div class="ui link card">
 			<div class="content">
 			<div class="center aligned floated author">
 			<img class="ui image" width="250px" src="recursos/imagenes/Portadas Tarjetas Videos/V_CrearCUR.jpg">
 			</div>
 			<div class="ui center aligned header">¿Como Crear Un Nuevo Curso?</div>
 			</div>
 			<button class="ui basic green button" type="button"onclick="$(\'#modalComoCrearUnNuevoCurso\')

 			.modal(
 			{
 				onDeny: function () {
 					$(\'video\').trigger(\'pause\'); 
 				}
 				})
 				.modal(\'setting\', \'transition\', \'scale\')
 				.modal(\'show\');"> 
 				<i class="play icon"></i>Ver </button>

 				</div>
 				</div>

 				<div class="col-md-3 mb-3">
 				<div class="ui link card">
 				<div class="content">
 				<div class="center aligned floated author">
 				<img class="ui image" width="250px" src="recursos/imagenes/Portadas Tarjetas Videos/V_GestionarDOC.jpg">
 				</div>
 				<div class="ui center aligned header">¿Como Gestionar Docentes?</div> 
 				</div>
 				<button class="ui basic green button" type="button"onclick="$(\'#modalComoGestionarDocentes\')

 				.modal(
 				{
 					onDeny: function () {
 						$(\'video\').trigger(\'pause\'); 
 					}
 					})
 					.modal(\'setting\', \'transition\', \'scale\')
 					.modal(\'show\');"> 
 					<i class="play icon"></i>Ver </button>
 					</div>
 					</div>

 					</div>
 					</center>
 					</div>

 					<div>
 					<br> <p class="mt-5 mb-3 text-muted text-center">&copy; 2018-2019</p>
 			</div>'  #FIN DE FILA
 			;
 		} else{ 
        #Inicio de fila para Estudiantes-->

 			ECHO'
 			<div class="container col-11">
 			<div class="text-center mb-3">
 			<img  src="Recursos/Imagenes/logoDark.png" alt="" width="200"> 
 			<hr> <h1 class="h3 mb-3 font-weight-normal">Hola. ¿En qué podemos ayudarte?</h1> <hr>
 			</div>
 			</div> 
 			<br>

 			
 			<center>
 			<div class="container">
 			<div class="row align-items-start">

 			<div class="col" style="padding-bottom: 2em;"><div  class="col-md-10 mb-10">
 			<div class="ui link card">
 			<div class="content">
 			<div class="center aligned floated author">

 			<img class="ui image" width="250px" src="recursos/imagenes/Portadas Tarjetas Videos/V_RegistroUs.jpg">
 			</div>
 			<div class="ui center aligned header"> ¿Como Iniciar Sesión Como Estudiante? </div> 
 			</div>
 			<button class="ui basic green button" type="button"onclick="$(\'#modalComoIniciarSesionComoEstudiante\')

 			.modal(
 			{
 				onDeny: function () {
 					$(\'video\').trigger(\'pause\'); 
 				}		
 				})
 				.modal(\'setting\', \'transition\', \'scale\')
 				.modal(\'show\');"> 
 				<i class="play icon"></i>Ver </button>

 				</div>
 				</div> </div>


 				<div class="col" style="padding-bottom: 2em;"><div  class="col-md-10 mb-10">
 				<div class="ui link card">
 				<div class="content">
 				<div class="center aligned floated author">

 				<img class="ui image" width="250px" src="recursos/imagenes/Portadas Tarjetas Videos/V_RegistroDOC.jpg">
 				</div>
 				<div class="ui center aligned header"> ¿Como Registrarme Como Docente? </div> 
 				</div>
 				<button class="ui basic green button" type="button"onclick="$(\'#modalComoRegistrarmeComoDocente\')

 				.modal(
 				{

 					onDeny: function () {
 						$(\'video\').trigger(\'pause\'); 
 					} 			
 					})
 					.modal(\'setting\', \'transition\', \'scale\')
 					.modal(\'show\');"> 
 					<i class="play icon"></i>Ver </button>

 					</div>
 					</div> </div>
 					

 					<div class="col" style="padding-bottom: 2em;"><div  class="col-md-10 mb-10">
 					<div class="ui link card">
 					<div class="content">
 					<div class="center aligned floated author">

 					<img class="ui image" width="250px" src="recursos/imagenes/Portadas Tarjetas Videos/V_RegistroINS.jpg">
 					</div>
 					<div class="ui center aligned header">¿Como Registrarme Como Instituto?</div> 
 					</div>
 					<button class="ui basic green button" type="button"onclick="$(\'#modalComoRegistrarmeComoInstituto\')

 					.modal(
 					{
 						onDeny: function () {
 							$(\'video\').trigger(\'pause\'); 
 						} 			
 						})
 						.modal(\'setting\', \'transition\', \'scale\')
 						.modal(\'show\');"> 
 						<i class="play icon"></i>Ver </button>

 						</div>
 						</div> </div>

 						</div>

 						</div>
 						</center>

 						<p class="mt-5 mb-6 text-muted text-center"> <a href="index.php" class="btn ui red button" style="padding-left: 10em; padding-right: 10em;">Salir</a> </p>
 						<p class="mt-5 mb-3 text-muted text-center">&copy; 2018-2019</p>
    </div>' #FIN DE FILA-->
    ;

}


?>

</body>
</html>