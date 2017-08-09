<?php

include("auth.php");

$thisType = $_SESSION['usertype'];

if($thisType=="receptionist"){
	header("Location: receptionist.php"); // Redirect user
}else if($thisType=="patient"){
	header("Location: patient.php"); // Redirect user
}else if($thisType=="nurse"){
	header("Location: nurse.php"); // Redirect user
}else if($thisType=="doctor"){
	header("Location: doctor.php"); // Redirect user
}else{
	header("Location:login.php");
}

?>
