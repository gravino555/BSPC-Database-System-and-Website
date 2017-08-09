<?php
require('db.php');
include("auth.php");


$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];

if($usertype != "receptionist"){
	echo "Only for receptionists";
	die();
}


if (isset($_REQUEST['the_id'])){
	
	//FORM RECEIVED
	
	$type = "therapist";
	
	$the_id = stripslashes($_REQUEST['the_id']);
	if($the_id==""){
		echo "Error. ID not provided";
		die();
	}
	
	$the_id = mysqli_real_escape_string($con,$the_id);
		
	
	$query = "SELECT * FROM therapist WHERE the_id=" . $the_id;
	   $result = mysqli_query($con,$query);
	   $numTherapists = mysqli_num_rows($result);
	   
	   if($numTherapists!=1){
		echo "<div class='fail'>No such ID. Please try again.</div>";
	   }else{
		   header("Location: update_therapist2.php?id=".$the_id); // Redirect user to prepopulated form
	   }
	
	
   }
   
   
?>

<!DOCTYPE html>
<html>
<head>
	<title>Update Therapist Information: Select Therapist</title>
	<link rel="stylesheet" href="css/style1.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</head>

<body>
<div id="header">Bahamas Sports Physio Center</div>
<p class = "logout"> <a href="logout.php">Logout</a></p>

<h2>Which Therapist's Information To Update?</h2> <br/>


<h5><a href="receptionist.php">Back to Control Panel</a></h5>


		<form action="update_therapist1.php" method="post">
			<input type="number" name="the_id" placeholder="Enter Therapist ID" required />
			<input class="btn btn-primary" type="submit" name="submit" value="Continue" />
		</form>
		
<br/><a href='list_all_therapists.php'>See list of therapists</a>


</body>
</html>