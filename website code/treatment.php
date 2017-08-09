<?php
require('db.php');
include("auth.php");


$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];


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

<h2>Treatment</h2> <br/>


<h5><a href="therapist.php">Back to Control Panel</a></h5>

<form action="treatment.php" method="post">

	<input type="text" name="treatment_name" placeholder="Treatment Name" required />
	<input type="text" name="device_name" placeholder="Device" required />
	<input type="text" name="device_usetime" placeholder="Device Usage Time (minutes)" required />
	<input type="number" name="p_id" placeholder="Patient ID" required />
	
	<input class="btn btn-primary" type="submit" name="submit" value="Enter Treatment" />
</form>
<?php

	$treatment_name = $_POST['treatment_name'];
	$device_name = $_POST['device_name'];
	$device_usetime = $_POST['device_usetime'];
	$p_id = $_POST['p_id'];
	
	$query = "SELECT id FROM `users` WHERE username = '$username'";
	$result = mysqli_query($con,$query);
	
	while ($row = $result->fetch_assoc())
			$user_id = $row['id'];
	
	if (isset($_POST['submit'])) {
	
	$query = "INSERT into `treat` (pid, the_id, treat_name) VALUES ('$p_id', '$user_id', '$treatment_name')";
	$result = mysqli_query($con,$query);
	
	$query = "INSERT into `device` (treat_name, name, use_time, the_id) VALUES ('$treatment_name', '$device_name', '$device_usetime', '$user_id')";
	$result = mysqli_query($con,$query);
	}

	$query = "SELECT * FROM patient WHERE pre_id = '$user_id' ";

	$result = mysqli_query($con,$query);
	echo "Your Patients: "."<br>";

	if (mysqli_num_rows($result) > 0) {
	
		$tableHtml = "<table class='results'><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Age</th><th>Pre_id</th></tr>";
	
		// append data of each row
		while($row = mysqli_fetch_assoc($result)) {
			$tableHtml = $tableHtml . "<tr><td>" . $row["pid"] . "</td><td>" . $row["first_name"] . "</td><td>" . $row["last_name"] . "</td><td>" . $row["age"] . "</td><td>" . $row["pre_id"] . "</td></tr>" ;
		}
	
		$tableHtml = $tableHtml . "</table>";
		echo $tableHtml;
		
	} 
	
	$query = "SELECT * FROM treat WHERE the_id = '$user_id'  ";

	$result = mysqli_query($con,$query);
	echo "Your Treated Patients: "."<br>";

	if (mysqli_num_rows($result) > 0) {
	
		$tableHtml = "<table class='results'><tr><th>Patient ID</th><th>Therapist ID</th><th>Treatment Day</th><th>Treatment Name</th><th>";
	
		// append data of each row
		while($row = mysqli_fetch_assoc($result)) {
			$tableHtml = $tableHtml . "<tr><td>" . $row["pid"] . "</td><td>" . $row["the_id"] . "</td><td>" . $row["treat_day"] . "</td><td>" . $row["treat_name"] . "</td><td>";
		}
	
		$tableHtml = $tableHtml . "</table>";
		echo $tableHtml;
		
	} 
	
	$query = "SELECT * FROM device WHERE the_id = '$user_id'";

	$result = mysqli_query($con,$query);
	echo "Devices used by your patients: "."<br>";

	if (mysqli_num_rows($result) > 0) {
	
		$tableHtml = "<table class='results'><tr><th>Treatment Name</th><th>Device Name</th><th>Usage Time</th><th>Therapist ID</th><th>";
	
		// append data of each row
		while($row = mysqli_fetch_assoc($result)) {
			$tableHtml = $tableHtml . "<tr><td>" . $row["treat_name"] . "</td><td>" . $row["name"] . "</td><td>" . $row["use_time"] . "</td><td>" . $row["the_id"] . "</td><td>";
		}
	
		$tableHtml = $tableHtml . "</table>";
		echo $tableHtml;
		
	} 
?>



</body>
</html>