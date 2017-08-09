<?php
require('db.php');
include("auth.php");

$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];

if($usertype != "receptionist"){
	echo "Only for receptionists";
	die();
}

$date1 = $_GET["date1"];
$date2 = $_GET["date2"];

$date1_original = $date1;
$date2_original = $date2;

$date1 = $date1." 00:00:00";
$date2 = $date2." 23:59:59";

$query = "SELECT the_id AS therapist_ID, COUNT(pid) AS patientN FROM treat WHERE treat_day BETWEEN '" . $date1 . "' AND '" . $date2 . "' GROUP BY (the_id)";
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

<h2>How many patients has each physio therapist seen in a specified period of time?</h2> <br/>
<h3>From <?=$date1_original?> to <?=$date2_original?></h3>

<h5><a href="receptionist.php">Back to Control Panel</a></h5>

<?php


//echo $query . "<br><br>";

$result = mysqli_query($con,$query);
$numUsers = mysqli_num_rows($result);
echo "Number of therapists: ".$numUsers."<br>";

if (mysqli_num_rows($result) > 0) {
	
	$tableHtml = "<table class='results'><tr><th>Therapist ID</th><th>Number Of Patients</th></tr>";
	
    // append data of each row
    while($row = mysqli_fetch_assoc($result)) {
		$tableHtml = $tableHtml . "<tr><td>" . $row["therapist_ID"] . "</td><td>" . $row["patientN"] . "</td></tr>";
    }
	
	$tableHtml = $tableHtml . "</table>";
	echo $tableHtml;
	
	
	
} else {
    echo "0 results";
}


?>




</body>
</html>