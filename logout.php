<?php
if(!isset($_SESSION)){ 
	session_start();
}

session_unset(); // unset session variables
session_destroy(); // destroy the session
header("Location:index.php");
exit();
?>







