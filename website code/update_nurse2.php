<?php
require('db.php');
include("auth.php");


$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];

if($usertype != "receptionist"){
	echo "Only for receptionists";
	die();
}


$fetch_first_name="";
$fetch_last_name="";


$formClass="";


if (isset($_REQUEST['first_name'])){
	
	//FORM RECEIVED
	
	$type = "nurse";
	
	$nurse_id = stripslashes($_REQUEST['nurse_id_to_update']);
	if($nurse_id==""){
		echo "Error. ID not provided";
		die();
	}
	
	$nurse_id = mysqli_real_escape_string($con,$nurse_id);
	
	$first_name = stripslashes($_REQUEST['first_name']);
	$first_name = mysqli_real_escape_string($con,$first_name);
	
	$last_name = stripslashes($_REQUEST['last_name']);
	$last_name = mysqli_real_escape_string($con,$last_name);
	
	
	$queryUpdate = "UPDATE nurse SET first_name = '" . $first_name . "', last_name = '" . $last_name . "' WHERE n_id = " . $nurse_id;

	
	mysqli_query($con, $queryUpdate);
	$numRowsAff = mysqli_affected_rows($con);
	if($numRowsAff==1){
		echo "<div class='updateSuccess'><h3>Update Successful.</h3><br/></div>";
		$formClass = "hidden";
	}else{
		echo "<div class='warning'>No change was made.</div>";
		$formClass = "hidden";
	}
	
	
	
   }else{
	   
	   
	   $nurse_id = $_GET["id"];
	   	if($nurse_id==""){
			echo "Error. ID must be provided in the URL";
			die();
		}
	   
	   
	   $query = "SELECT * FROM nurse WHERE n_id=" . $nurse_id;
	   $result = mysqli_query($con,$query);
	   $numNurses = mysqli_num_rows($result);
	   
	   if($numNurses!=1){
		echo "<div class='fail'>No such ID. Please try again</div>";   
		die();
	   }else{
		   $row = mysqli_fetch_assoc($result);
		   $fetch_first_name=$row["first_name"];
		   $fetch_last_name=$row["last_name"];
	   }
	   
	   
	   
   }
   
   
?>

<!DOCTYPE html>
<html>
<head>
	<title>Update Nurse Information</title>
	<link rel="stylesheet" href="css/style1.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</head>

<body>
<div id="header">Bahamas Sports Physio Center</div>
<p class = "logout"> <a href="logout.php">Logout</a></p>

<h2>Update Nurse Information (id=<?=$nurse_id?>)</h2> <br/>


<h5><a href="receptionist.php">Back to Control Panel</a></h5>

<div class="<?=$formClass?>">
<form action="update_nurse2.php" method="post">
	<input type="hidden" name="nurse_id_to_update" value="<?=$nurse_id?>" />
	<input type="text" name="first_name" placeholder="Enter First Name" required value="<?=$fetch_first_name?>"/>
	<input type="text" name="last_name" placeholder="Enter Last Name" required value="<?=$fetch_last_name?>"/>
	<input class="btn btn-primary" type="submit" name="submit" value="Update" />	
</form>
</div>


</body>
</html>