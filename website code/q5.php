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

<h2>All info on therapists who work at the center</h2> <br/>


<h5><a href="receptionist.php">Back to Control Panel</a></h5>

<?php

$query = "SELECT first_name,last_name,experience AS working_experience, date_treat AS appointment,treat.pid AS patient_ID_served,name,treat.treat_name,time_appointment.pid AS patient_ID_reserved FROM therapist left join schedule ON therapist.the_id= schedule.emp_id LEFT JOIN time_appointment ON (schedule.ta_id=time_appointment.ta_id AND schedule.pid=time_appointment.pid) left join treat ON therapist.the_id= treat.the_id LEFT join device ON treat.treat_name= device.treat_name WHERE therapist.status=1";
//echo $query . "<br><br>";

$result = mysqli_query($con,$query);
$numUsers = mysqli_num_rows($result);
echo "Number of results: ".$numUsers."<br>";

if (mysqli_num_rows($result) > 0) {
	
	$tableHtml = "<table class='results'><tr><th>first_name</th><th>last_name</th><th>working_experience</th><th>appointment</th><th>patient_ID_served</th><th>name</th><th>treat_name</th><th>patient_ID_reserved</th></tr>";
	
    // append data of each row
    while($row = mysqli_fetch_assoc($result)) {
		$tableHtml = $tableHtml . "<tr><td>" . $row["first_name"] . "</td><td>" . $row["last_name"] . "</td><td>" . $row["working_experience"] . "</td><td>" . $row["appointment"] . "</td><td>" . $row["patient_ID_served"] . "</td><td>" . $row["name"] . "</td><td>" . $row["treat_name"] . "</td><td>" . $row["patient_ID_reserved"] . "</td></tr>";
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