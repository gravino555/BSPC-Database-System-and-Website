<?php
require('db.php');
include("auth.php");

$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];

if($usertype != "receptionist"){
	echo "Only for receptionists";
	die();
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Query</title>
	<link rel="stylesheet" href="css/style1.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</head>

<body>
<div id="header">Bahamas Sports Physio Center</div>
<p class = "logout"> <?=$username?> (<?=$usertype?>)  <a href="logout.php">Logout</a></p>

<h2> All information available for physio patients who have been at the center</h2> <br/>


<h5><a href="receptionist.php">Back to Control Panel</a></h5>

<?php

$query = "SELECT patient.first_name,patient.last_name, patient.age,patient.pid AS patient_ID, note,diagnosis,payid,amount,type,date_treat FROM patient LEFT JOIN prescription ON patient.pid=prescription.pid LEFT JOIN payment ON patient.pid= payment.pid LEFT JOIN time_appointment ON patient.pid= time_appointment.pid";
//echo $query . "<br><br>";

$result = mysqli_query($con,$query);
$numUsers = mysqli_num_rows($result);
echo "Number of patients: ".$numUsers."<br>";

if (mysqli_num_rows($result) > 0) {
	
	$tableHtml = "<table class='results'><tr><th>first_name</th><th>last_name</th><th>age</th><th>patient_ID</th><th>note</th><th>diagnosis</th><th>payid</th><th>amount</th><th>type</th><th>date_treat</th></tr>";
	
    // append data of each row
    while($row = mysqli_fetch_assoc($result)) {
		$tableHtml = $tableHtml . "<tr><td>" . $row["first_name"] . "</td><td>" . $row["last_name"] . "</td><td>" . $row["age"] . "</td><td>" . $row["patient_ID"] . "</td><td>" . $row["note"] . "</td><td>" . $row["diagnosis"] . "</td><td>" . $row["payid"]  . "</td><td>" . $row["amount"]  . "</td><td>" . $row["type"] . "</td><td>" . $row["date_treat"] . "</td></tr>";
    }
	
	$tableHtml = $tableHtml . "</table>";
	echo $tableHtml;
	echo "<br>";
	
	
} else {
    echo "0 results";
}


?>




</body>
</html>