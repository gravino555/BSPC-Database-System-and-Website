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
	<title>All Doctors</title>
	<link rel="stylesheet" href="css/style1.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</head>

<body>
<div id="header">Bahamas Sports Physio Center</div>
<p class = "logout"> <?=$username?> (<?=$usertype?>)  <a href="logout.php">Logout</a></p>

<h2>All Doctors</h2> <br/>


<h5><a href="receptionist.php">Back to Control Panel</a></h5>

<?php

$query = "SELECT * FROM doctor ORDER BY doc_id";

$result = mysqli_query($con,$query);
$numDoctors = mysqli_num_rows($result);
echo "Number of doctors: ".$numDoctors."<br>";

if (mysqli_num_rows($result) > 0) {
	
	$tableHtml = "<table class='results'><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Status</th><th>Experience (years)</th></tr>";
	
    // append data of each row
    while($row = mysqli_fetch_assoc($result)) {
		$status = "";
		if($row["status"]==1){$status = "Active";} else{$status = "inactive";}
		$tableHtml = $tableHtml . "<tr><td>" . $row["doc_id"] . "</td><td>" . $row["first_name"] . "</td><td>" . $row["last_name"] . "</td><td>" . $status . "</td><td>" . $row["experience"] . "</td></tr>" ;
    }
	
	$tableHtml = $tableHtml . "</table>";
	echo $tableHtml;
	
	
	
} else {
    echo "0 results";
}



?>

<br/><a href='update_doctor1.php'>Update Doctor Information</a><br/></br>


</body>
</html>