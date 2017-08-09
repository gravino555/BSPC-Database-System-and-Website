<?php
require('db.php');
include("auth.php");

$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];

if($usertype != "receptionist"){
	echo "Only for receptionists";
	die();
}

$pid = $_GET["pid"];

$query = "SELECT expert.first_name AS expert_first_name,expert.last_name AS expert_last_name, date_treat AS date, start AS time FROM patient JOIN time_appointment ON patient.pid=time_appointment.pid JOIN schedule ON (time_appointment.pid=schedule.pid AND time_appointment.ta_id=schedule.ta_id) JOIN (select doc_id as id, first_name ,last_name from doctor UNION select the_id AS id,first_name,last_name from therapist) expert ON schedule.emp_id=id WHERE patient.pid=" . $pid;
//echo $query;

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

<h2>Reservation details for a specific patient</h2> <br/>
<h3>Patient ID = <?=$pid?></h3>

<h5><a href="receptionist.php">Back to Control Panel</a></h5>

<?php


//echo $query . "<br><br>";

$result = mysqli_query($con,$query);
$numUsers = mysqli_num_rows($result);
echo "Number of reservations: ".$numUsers."<br>";

if (mysqli_num_rows($result) > 0) {
	
	$tableHtml = "<table class='results'><tr><th>expert_first_name</th><th>expert_last_name</th><th>date</th><th>time</th></tr>";
	
    // append data of each row
    while($row = mysqli_fetch_assoc($result)) {
		$tableHtml = $tableHtml . "<tr><td>" . $row["expert_first_name"] . "</td><td>" . $row["expert_last_name"] . "</td><td>" . $row["date"] . "</td><td>" . $row["time"] . "</td></tr>";
    }
	
	$tableHtml = $tableHtml . "</table>";
	echo $tableHtml;
	
	
	
} else {
    echo "0 results";
}


?>




</body>
</html>