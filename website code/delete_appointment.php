<?php
require('db.php');
include("auth.php");


$Pid = $_SESSION['Pid'];
$usertype = $_SESSION['usertype'];

if($usertype != "receptionist"){
	echo "Only for receptionists";
	die();
}

	//If form received
	if (isset($_REQUEST['pid'])){
		
		$pid = stripslashes($_REQUEST['pid']);
		$ta_id = stripslashes($_REQUEST['ta_id']);
		
		

				//Checking if pid, ta_id exist
		$queryApp = "SELECT pid, ta_id FROM time_appointment where pid=" . $pid . " AND ta_id=" . $ta_id;
		$AppExists=false;
		$resultPid = mysqli_query($con,$queryApp);
		if($resultPid) {
			$numRows = mysqli_num_rows($resultPid);
			if($numRows==1){$AppExists=true;}
		}else{
			echo "Error: " . mysqli_error($conn);
		}
		
		
				if($AppExists){
					
					//echo "Patient exists!"; 
					
					$query = "delete from time_appointment where pid=" . $pid . " AND ta_id=" .$ta_id;

					//echo $query;
					
					if (mysqli_query($con, $query)) {
						echo "<div class='registrationSuccess'><h3>Successfully Cancelled Appointment.</h3><br/></div>";
					}
			
			
				}else{
					
					echo "<div class='fail'>No appointment with that Patient ID and Appointment ID found. Please try again.</div>";
					
				}
		
		
		
		

		
    }

?>

<!DOCTYPE html>
<html>
<head>
	<title>Cancel Appointment</title>
	<link rel="stylesheet" href="css/style1.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</head>

<body>
<div id="header">Bahamas Sports Physio Center</div>
<p class = "logout"> <a href="logout.php">Logout</a></p>

<h2>Cancel Appointment</h2> <br/>


<h5><a href="receptionist.php">Back to Control Panel</a></h5>

<form action="delete_appointment.php" method="post">
	<input type="number" name="pid" placeholder="Enter Patient ID" required />
	<input type="number" name="ta_id" placeholder="Enter Appointment ID" required />
	<input class="btn btn-primary" type="submit" name="submit" value="Delete" />
</form>


</body>
</html>