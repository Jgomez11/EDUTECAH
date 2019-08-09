<?php  
	session_start();

	$_SESSION["IDAula"] = $_POST["ID"];

	echo $_SESSION["IDAula"];
 ?>