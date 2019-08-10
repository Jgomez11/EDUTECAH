<?php  
	session_start();

	$_SESSION["IDLibro"] = $_POST["ID"];

	echo $_SESSION["IDLibro"];
 ?>