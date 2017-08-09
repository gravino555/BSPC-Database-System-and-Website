<?php
	require('db.php');
	session_start();
	
	$message='';
	
	// If form submitted, check user credentials
    if (isset($_POST['username'])){
		
		$username = stripslashes($_REQUEST['username']);
		$username = mysqli_real_escape_string($con,$username);
		$password = stripslashes($_REQUEST['password']);
		$password = mysqli_real_escape_string($con,$password);
		
		//Checking if user exists in database and verifying password
        $query = "SELECT * FROM users WHERE username='$username' and password='".md5($password)."'";
		$result = mysqli_query($con,$query) or die(mysql_error());
		$rows = mysqli_num_rows($result);
        
		if($rows==1){
			//User found
		
			//Getting user's type
			$queryUserType = "SELECT type FROM users WHERE username = '".$username."'";
			$resultUserType = mysqli_query($con,$queryUserType);
			$row = mysqli_fetch_assoc($resultUserType);
			$thisType = $row["type"];
		
			//Set session variables
			$_SESSION['username'] = $username;
			$_SESSION['usertype'] = $thisType;
			
			if($thisType=="receptionist"){
				header("Location: receptionist.php"); // Redirect user
			}else if($thisType=="patient"){
				header("Location: patient.php"); // Redirect user
			}else if($thisType=="nurse"){
				header("Location: nurse.php"); // Redirect user
			}else if($thisType=="doctor"){
				header("Location: doctor.php"); // Redirect user
			}else if($thisType=="therapist"){
				header("Location: therapist.php"); // Redirect user
			}else if($thisType=="patient"){
				header("Location: patient.php"); // Redirect user
			}
			
            }else{
				$message = "<div class='errorCredentials'><h3>Username/password is incorrect.</h3><br/></div>";
			}
    }
	
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>Log In</title>
	<link rel="stylesheet" href="css/style1.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</head>
<body>
<div id="header">Bahamas Sports Physio Center</div>

<?php
	if($message!=''){echo $message;}

?>

<div class="form">
<h1>Log In</h1>
<form action="login.php" method="post">
	<input type="text" name="username" placeholder="Enter username" required />
	<input type="password" name="password" placeholder="Enter password" required />
	<input class="btn btn-success" name="submit" type="submit" value="Login" />
</form>
<p>Are you an employee without an account? <a href='registration.php'>Register Here</a></p>


</body>
</html>
