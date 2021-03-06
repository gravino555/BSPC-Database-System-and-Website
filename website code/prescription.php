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

<h2>Prescription</h2> <br/>
<h5><a href="manage_records.php">Back to Manage Records</a></h5>


<form action="prescription.php" method="post">

	<input type="text" name="diagnosis" placeholder="Diagnosis" required />
	<input type="text" name="note" placeholder="Note" required />
	<input type="number" name="p_id" placeholder="Patient ID" required />
	
	<input class="btn btn-primary" type="submit" name="submit" value="Enter Prescription" />
</form>
<?php

	$diagnosis = $_POST['diagnosis'];
	$note = $_POST['note'];
	$p_id = $_POST['p_id'];
	
	$query = "SELECT id FROM `users` WHERE username = '$username'";
	$result = mysqli_query($con,$query);
	
	while ($row = $result->fetch_assoc())
			$user_id = $row['id'];
	
	if (isset($_POST['submit'])) {
	
	$query = "INSERT into `prescription` (pid, doc_id, note, diagnosis) VALUES ('$p_id', '$user_id', '$note', '$diagnosis')";
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
	
	$query = "SELECT * FROM prescription WHERE doc_id = '$user_id'  ";

	$result = mysqli_query($con,$query);
	echo "Your Prescribed Patients: "."<br>";

	if (mysqli_num_rows($result) > 0) {
	
		$tableHtml = "<table class='results'><tr><th>Prescription ID</th><th>Patient ID</th><th>Doctor ID</th><th>Note</th><th>Diagnosis</th></tr>";
	
		// append data of each row
		while($row = mysqli_fetch_assoc($result)) {
			$tableHtml = $tableHtml . "<tr><td>" . $row["pre_id"] . "</td><td>" . $row["pid"] . "</td><td>" . $row["doc_id"] . "</td><td>" . $row["note"] . "</td><td>" . $row["diagnosis"] . "</td></tr>" ;
		}
	
		$tableHtml = $tableHtml . "</table>";
		echo $tableHtml;
		
	} 
?>

</body>
</html>