<?php
require('db.php');
include("auth.php");


$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];

if($usertype != "receptionist"){
	echo "Only for receptionists";
	die();
}


if (isset($_REQUEST['n_id'])){
	
	//FORM RECEIVED
	
	$type = "nurse";
	
	$n_id = stripslashes($_REQUEST['n_id']);
	if($n_id==""){
		echo "Error. ID not provided";
		die();
	}
	
	$n_id = mysqli_real_escape_string($con,$n_id);
		
	
	$query = "SELECT * FROM nurse WHERE n_id=" . $n_id;
	   $result = mysqli_query($con,$query);
	   $numNurses = mysqli_num_rows($result);
	   
	   if($numNurses!=1){
		echo "<div class='fail'>No such ID. Please try again.</div>";
	   }else{
		   header("Location: update_nurse2.php?id=".$n_id); // Redirect user to prepopulated form
	   }
	
	
	
	
	
   }
   
   
?>

<!DOCTYPE html>
<html>
<head>
	<title>Update Nurse Information: Select Nurse</title>
	<link rel="stylesheet" href="css/style1.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</head>

<body>
<div id="header">Bahamas Sports Physio Center</div>
<p class = "logout"> <a href="logout.php">Logout</a></p>

<h2>Which Nurse's Information To Update?</h2> <br/>


<h5><a href="receptionist.php">Back to Control Panel</a></h5>


		<form action="update_nurse1.php" method="post">
			<input type="number" name="n_id" placeholder="Enter Nurse ID" required />
			<input class="btn btn-primary" type="submit" name="submit" value="Continue" />
		</form>
		
<br/><a href='list_all_nurses.php'>See list of nurses</a>		


</body>
</html>