<?php
session_start();
date_default_timezone_set('America/Tegucigalpa');
include("../Clases/Conexion.php");
$conexion = new Conexion();
$conexion->mysql_set_charset("utf8");
$allowed_ext = array('jpg','jpeg','png','gif');

if(array_key_exists('pic',$_FILES) && $_FILES['pic']['error'] == 0 ){
	
	$pic = $_FILES['pic'];
	$contenidoImagen = file_get_contents($pic['tmp_name']);
	
	if(!in_array(get_extension($pic['name']),$allowed_ext)){
		exit_status('Only '.implode(',',$allowed_ext).' files are allowed!');
	}	
	
	// Move the uploaded file from the temporary 
	// directory to the uploads folder:
	$sql = sprintf("UPDATE tbl_usuario SET Imagen ='%s' WHERE idusuario = '%s'",$conexion->antiInyeccion($contenidoImagen), $conexion->antiInyeccion($_SESSION['ID']));

	$conexion->ejecutarconsulta($sql);

	$_SESSION['Imagen'] = $contenidoImagen;
}

exit_status('Something went wrong with your upload!');

function exit_status($str){
	echo json_encode(array('status'=>$str));
	exit;
}

function get_extension($file_name){
	$ext = explode('.', $file_name);
	$ext = array_pop($ext);
	return strtolower($ext);
}
?>