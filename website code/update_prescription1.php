<?php
require('db.php');
include("auth.php");

$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];

if($usertype != "nurse" && $usertype != "doctor"){
	echo "Only for nurses and doctors.";
	die();
}


if (isset($_REQUEST['pre_id'])){
	
	//FORM RECEIVED
	
	$pre_id = stripslashes($_REQUEST['pre_id']);
	if($pre_id==""){
		echo "Error. ID not provided";
		die();
	}
	
	$pre_id = mysqli_real_escape_string($con,$pre_id);
		
	
	$query = "SELECT * FROM prescription WHERE pre_id=" . $pre_id;
	   $result = mysqli_query($con,$query);
	   $numPrescriptions = mysqli_num_rows($result);
	   
	   if($numPrescriptions!=1){
		echo "<div class='fail'>No such ID. Please try again.</div>";
	   }else{
		   header("Location: update_prescription2.php?id=".$pre_id); // Redirect user to prepopulated form
	   }
	
	
   }
   
   
?>

<!DOCTYPE html>
<html>
<head>
	<title>Update Prescription Information</title>
	<link rel="stylesheet" href="css/style1.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</head>

<body>
<div id="header">Bahamas Sports Physio Center</div>
<p class = "logout"> <a href="logout.php">Logout</a></p>

<h2>Which Prescription To Update?</h2> <br/>


<h5><a href="<?=$usertype?>.php">Back to Control Panel</a></h5>


		<form action="update_prescription1.php" method="post">
			<input type="number" name="pre_id" placeholder="Enter Prescription ID" required />
			<input class="btn btn-primary" type="submit" name="submit" value="Continue" />
		</form>
		
<br/><a href='list_all_prescriptions.php'>See list of prescriptions</a>	


</body>
</html>