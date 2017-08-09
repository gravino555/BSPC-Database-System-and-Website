<?php
require('db.php');
include("auth.php");


$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];

if($usertype != "receptionist"){
	echo "Only for receptionists";
	die();
}


if (isset($_REQUEST['doc_id'])){
	
	//FORM RECEIVED
	
	$type = "doctor";
	
	$doc_id = stripslashes($_REQUEST['doc_id']);
	if($doc_id==""){
		echo "Error. ID not provided";
		die();
	}
	
	$doc_id = mysqli_real_escape_string($con,$doc_id);
		
	
	$query = "SELECT * FROM doctor WHERE doc_id=" . $doc_id;
	   $result = mysqli_query($con,$query);
	   $numDoctors = mysqli_num_rows($result);
	   
	   if($numDoctors!=1){
		echo "<div class='fail'>No such ID. Please try again.</div>";
	   }else{
		   header("Location: update_doctor2.php?id=".$doc_id); // Redirect user to prepopulated form
	   }
	
	
   }
   
   
?>

<!DOCTYPE html>
<html>
<head>
	<title>Update Doctor Information: Select Doctor</title>
	<link rel="stylesheet" href="css/style1.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</head>

<body>
<div id="header">Bahamas Sports Physio Center</div>
<p class = "logout"> <a href="logout.php">Logout</a></p>

<h2>Which Doctor's Information To Update?</h2> <br/>


<h5><a href="receptionist.php">Back to Control Panel</a></h5>


		<form action="update_doctor1.php" method="post">
			<input type="number" name="doc_id" placeholder="Enter Doctor ID" required />
			<input class="btn btn-primary" type="submit" name="submit" value="Continue" />
		</form>
		
<br/><a href='list_all_doctors.php'>See list of doctors</a>		


</body>
</html>