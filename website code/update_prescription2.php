<?php
require('db.php');
include("auth.php");

$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];

if($usertype != "nurse" && $usertype != "doctor"){
	echo "Only for nurses and doctors.";
	die();
}

$fetch_note="";
$fetch_diagnosis="";


$formClass="";


if (isset($_REQUEST['note'])){
	
	//FORM RECEIVED
	
	$pre_id = stripslashes($_REQUEST['prescription_id_to_update']);
	if($pre_id==""){
		echo "Error. ID not provided";
		die();
	}
	
	$pre_id = mysqli_real_escape_string($con,$pre_id);
	
	$note = stripslashes($_REQUEST['note']);
	$note = mysqli_real_escape_string($con,$note);
	
	$diagnosis = stripslashes($_REQUEST['diagnosis']);
	$diagnosis = mysqli_real_escape_string($con,$diagnosis);
	
	
	$queryUpdate = "UPDATE prescription SET note = '" . $note . "', diagnosis = '" . $diagnosis . "' WHERE pre_id = " . $pre_id;

	
	mysqli_query($con, $queryUpdate);
	$numRowsAff = mysqli_affected_rows($con);
	if($numRowsAff==1){
		echo "<div class='updateSuccess'><h3>Update Successful.</h3><br/></div>";
		$formClass = "hidden";
	}else{
		echo "<div class='warning'>No change was made.</div>";
		$formClass = "hidden";
	}
	
	
	
   }else{
	   
	   $pre_id = $_GET["id"];
	   	if($pre_id==""){
			echo "Error. ID must be provided in the URL";
			die();
		}
	   
	   
	   $query = "SELECT * FROM prescription WHERE pre_id=" . $pre_id;
	   $result = mysqli_query($con,$query);
	   $numNurses = mysqli_num_rows($result);
	   
	   if($numNurses!=1){
		echo "<div class='fail'>No such ID. Please try again</div>";   
		die();
	   }else{
		   $row = mysqli_fetch_assoc($result);
		   $fetch_note=$row["note"];
		   $fetch_diagnosis=$row["diagnosis"];
	   }
	   
	   
	   
   }
   
   
?>

<!DOCTYPE html>
<html>
<head>
	<title>Update Prescription</title>
	<link rel="stylesheet" href="css/style1.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</head>

<body>
<div id="header">Bahamas Sports Physio Center</div>
<p class = "logout"> <a href="logout.php">Logout</a></p>

<h2>Update Prescription (id=<?=$pre_id?>)</h2> <br/>


<h5><a href="<?=$usertype?>.php">Back to Control Panel</a></h5>

<div class="<?=$formClass?>">
<form action="update_prescription2.php" method="post">
	<input type="hidden" name="prescription_id_to_update" value="<?=$pre_id?>" />
	<input type="text" name="note" placeholder="Enter Note" required value="<?=$fetch_note?>"/>
	<input type="text" name="diagnosis" placeholder="Enter Diagnosis" required value="<?=$fetch_diagnosis?>"/>
	<input class="btn btn-primary" type="submit" name="submit" value="Update" />
</form>
</div>


</body>
</html>