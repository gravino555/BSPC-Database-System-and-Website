<?php
require('db.php');
include("auth.php");


$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];

if($usertype != "receptionist"){
	echo "Only for receptionists";
	die();
}

	//If form received
	if (isset($_REQUEST['username'])){
		
		$first_name = stripslashes($_REQUEST['first_name']);
		$first_name = mysqli_real_escape_string($con,$first_name);
		
		$last_name = stripslashes($_REQUEST['last_name']);
		$last_name = mysqli_real_escape_string($con,$last_name);
		
		$age = stripslashes($_REQUEST['age']);
		$age = mysqli_real_escape_string($con,$age);
		
		$pre_id = stripslashes($_REQUEST['pre_id']);
		$pre_id = mysqli_real_escape_string($con,$pre_id);
		
        $query = "SELECT pid 
			FROM `patient` 
			WHERE first_name = '$first_name' AND last_name = '$last_name' AND age = '$age' AND pre_id = '$pre_id'";
			
		
		
		$pid = mysqli_query($con,$query);
		
		if($age < 18)
			echo "Too Young!";
		
        else if(mysqli_num_rows($pid) == 0){
            
			$type = "patient";
		
			$username = stripslashes($_REQUEST['username']); // removes backslashes
			$username = mysqli_real_escape_string($con,$username); //escapes special characters in a string
					
			$password = stripslashes($_REQUEST['password']);
			$password = mysqli_real_escape_string($con,$password);
			
			$trn_date = date("Y-m-d H:i:s");
			
			$query = "INSERT into `users` (username, password, type) VALUES ('$username', '".md5($password)."', '$type')";
			$result = mysqli_query($con,$query);
			
			if($result){
				$query = "INSERT into `patient` (first_name, last_name, age, pre_id) VALUES ('$first_name', '$last_name', '$age', '$pre_id')";
				$result = mysqli_query($con,$query);
				echo "<div class='registrationSuccess'><h3>Registration successful.</h3></div>";	
			}
			
			else{
				echo "Username already taken. Try again.";
			}	
        }
		
		else{
			echo "ALready registered. ID is ";
			while ($row = $pid->fetch_assoc()) {  
				echo "<u>".$row['pid']."</u><b>";
			}
		}
		
		$query = "SELECT pid 
			FROM `patient` 
			WHERE first_name = '$first_name' AND last_name = '$last_name' AND age = '$age' AND pre_id = '$pre_id'";
		
		$pid = mysqli_query($con,$query);
		
		while ($row = $pid->fetch_assoc()) {
			$test = $row['pid'];
		}
		
		$query = "UPDATE `users` SET id = '$test' WHERE username = '$username'";
		$result = mysqli_query($con,$query);
		
    }

?>

<!DOCTYPE html>
<html>
<head>
	<title>Control Panel</title>
	<link rel="stylesheet" href="css/style1.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</head>

<body>
<div id="header">Bahamas Sports Physio Center</div>
<p class = "logout"> <a href="logout.php">Logout</a></p>

<h2>Patient Registration</h2> <br/>


<h5><a href="receptionist.php">Back to Control Panel</a></h5>

<form action="register_patient.php" method="post">
	
	<input type="text" name="username" placeholder="Username" required />
	<input type="password" name="password" placeholder="Password" required />
	<input type="text" name="first_name" placeholder="First Name" required />
	<input type="text" name="last_name" placeholder="Last Name" required />
	<input type="number" name="age" placeholder="Age" required />
	<input type="number" name="pre_id" placeholder="Prescription ID" required />
	
	<input class="btn btn-primary" type="submit" name="submit" value="Register" />
</form>


</body>
</html>