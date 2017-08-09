<?php
require('db.php');
include("auth.php");


$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];

if($usertype != "receptionist"){
	echo "Only for receptionists";
	die();
}


if (isset($_REQUEST['date1'])){
	
	//FORM RECEIVED
	
	$date1 = stripslashes($_REQUEST['date1']);
	$date2 = stripslashes($_REQUEST['date2']);
	$doc_id = stripslashes($_REQUEST['doc_id']);
	
	
		$query = "SELECT * FROM doctor WHERE doc_id=" . $doc_id;
	   $result = mysqli_query($con,$query);
	   $numDoctors = mysqli_num_rows($result);
	   
	   if($numDoctors!=1){
		echo "<div class='fail'>No such ID. Please try again.</div>";
	   }else{
		   header("Location: q7.php?doc_id=".$doc_id."&date1=".$date1."&date2=".$date2);
	   }
	
			
   }
   
?>

<!DOCTYPE html>
<html>
<head>
	<title>Q7</title>
	<link rel="stylesheet" href="css/style1.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</head>

<body>
<div id="header">Bahamas Sports Physio Center</div>
<p class = "logout"> <a href="logout.php">Logout</a></p>

<h2>Specify Doctor and Start & End Dates</h2> <br/>

<h5><a href="receptionist.php">Back to Control Panel</a></h5>


		<form action="q7_form.php" method="post">
			<input type="number" name="doc_id" placeholder="Enter Doctor ID" required />
			<input type="date" name="date1" placeholder="Enter Start Date" required />
			<input type="date" name="date2" placeholder="Enter End Date" required />
			<input class="btn btn-primary" type="submit" name="submit" value="Continue" />
		</form>

		<br/><a href='list_all_doctors.php'>See list of doctors</a>
		
</body>
</html>