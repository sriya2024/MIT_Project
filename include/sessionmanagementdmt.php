<?php
if(!isset($_SESSION)){ 
	session_start();
}

if($_SESSION['siddmt']=="" || $_SESSION['password']==""){
	$msg=("Please Login to the system.....");
	header("Location:../index.php?id=$msg");
	
}

?>