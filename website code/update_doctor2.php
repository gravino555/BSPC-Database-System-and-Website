<?php
require('db.php');
include("auth.php");


$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];

if($usertype != "receptionist"){
	echo "Only for receptionists";
	die();
}

$fetch_first_name="";
$fetch_last_name="";
$fetch_status="";
$fetch_experience="";

$formClass="";


if (isset($_REQUEST['first_name'])){
	
	//FORM RECEIVED
	
	$type = "doctor";
	
	$doctor_id = stripslashes($_REQUEST['doctor_id_to_update']);
	if($doctor_id==""){
		echo "Error. ID not provided";
		die();
	}
	
	$doctor_id = mysqli_real_escape_string($con,$doctor_id);
	
	$first_name = stripslashes($_REQUEST['first_name']);
	$first_name = mysqli_real_escape_string($con,$first_name);
	
	$last_name = stripslashes($_REQUEST['last_name']);
	$last_name = mysqli_real_escape_string($con,$last_name);
	
	$status = stripslashes($_REQUEST['status']);
	$status = mysqli_real_escape_string($con,$status);
	
	$experience = stripslashes($_REQUEST['experience']);
	$experience = mysqli_real_escape_string($con,$experience);
	
	$queryUpdate = "UPDATE doctor SET first_name = '" . $first_name . "', last_name = '" . $last_name . "', status = " . $status . ", experience = " . $experience . " WHERE doc_id = " . $doctor_id;

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
	   
	   
	   $doctor_id = $_GET["id"];
	   	if($doctor_id==""){
			echo "Error. ID must be provided in the URL";
			die();
		}
	   
	   
	   $query = "SELECT * FROM doctor WHERE doc_id=" . $doctor_id;
	   $result = mysqli_query($con,$query);
	   $numDoctors = mysqli_num_rows($result);
	   
	   if($numDoctors!=1){
		echo "<div class='fail'>No such ID. Please try again</div>";   
		die();
	   }else{
		   $row = mysqli_fetch_assoc($result);
		   $fetch_first_name=$row["first_name"];
		   $fetch_last_name=$row["last_name"];
		   $fetch_status=$row["status"];
		   $fetch_experience=$row["experience"];
	   }
	   
	   
   }
   
   
?>

<!DOCTYPE html>
<html>
<head>
	<title>Update Doctor Information</title>
	<link rel="stylesheet" href="css/style1.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</head>

<body>
<div id="header">Bahamas Sports Physio Center</div>
<p class = "logout"> <a href="logout.php">Logout</a></p>

<h2>Update Doctor Information (id=<?=$doctor_id?>)</h2> <br/>


<h5><a href="receptionist.php">Back to Control Panel</a></h5>

<div class="<?=$formClass?>">
<form action="update_doctor2.php" method="post">
	<input type="hidden" name="doctor_id_to_update" value="<?=$doctor_id?>" />
	<input type="text" name="first_name" placeholder="Enter First Name" required value="<?=$fetch_first_name?>"/>
	<input type="text" name="last_name" placeholder="Enter Last Name" required value="<?=$fetch_last_name?>"/>
	<input type="number" name="status" min="0" max="1" placeholder="Enter 0 for unactive or 1 for active" required value="<?=$fetch_status?>">
	<input type="number" name="experience" placeholder="Experience" required value="<?=$fetch_experience?>"/>

	<input class="btn btn-primary" type="submit" name="submit" value="Update" />
	
</form>
</div>


</body>
</html>