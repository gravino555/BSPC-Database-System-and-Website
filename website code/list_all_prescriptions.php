<?php
require('db.php');
include("auth.php");

$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];

if($usertype != "nurse" && $usertype != "doctor"){
	echo "Only for nurses and doctors.";
	die();
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
<p class = "logout"> <?=$username?> (<?=$usertype?>)  <a href="logout.php">Logout</a></p>

<h2>All Prescriptions</h2> <br/>


<h5><a href="<?=$usertype?>.php">Back to Control Panel</a></h5>

<?php

$query = "SELECT * FROM prescription";

$result = mysqli_query($con,$query);
$numUsers = mysqli_num_rows($result);
echo "Number of prescription: ".$numUsers."<br>";

if (mysqli_num_rows($result) > 0) {
	
	$tableHtml = "<table class='results'><tr><th>Prescription ID</th><th>Patient ID</th><th>Doctor ID</th><th>Note</th><th>Diagnosis</th></tr>";
	
    // append data of each row
    while($row = mysqli_fetch_assoc($result)) {
		$tableHtml = $tableHtml . "<tr><td>" . $row["pre_id"] . "</td><td>" . $row["pid"] . "</td><td>" . $row["doc_id"] . "</td><td>" . $row["note"] . "</td><td>" . $row["diagnosis"] . "</td></tr>";
    }
	
	$tableHtml = $tableHtml . "</table>";
	echo $tableHtml;
	
	
	
} else {
    echo "0 results";
}




?>


<br/><a href='update_prescription1.php'>Update Prescription</a>

</body>
</html>