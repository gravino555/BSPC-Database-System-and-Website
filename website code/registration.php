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
	require('db.php');
	
	$experience = stripslashes($_REQUEST['experience']);
	$experience = mysqli_real_escape_string($con,$experience);
    // If form submitted, insert values into the database.
    
	
	//RECEPTIONIST FORM RECEIVED
	if (isset($_REQUEST['username']) && $_REQUEST['formType'] == 1){
		$type = "receptionist";
		
		$username = stripslashes($_REQUEST['username']); // removes backslashes
		$username = mysqli_real_escape_string($con,$username); //escapes special characters in a string
				
		$password = stripslashes($_REQUEST['password']);
		$password = mysqli_real_escape_string($con,$password);
		
		//Checking if username exists
		$queryUsername = "SELECT username FROM users where username='" . $username . "'";
		$usernameExists=false;
		$resultUsername = mysqli_query($con,$queryUsername);
		if($resultUsername) {
			$numRows = mysqli_num_rows($resultUsername);
			if($numRows==1){$usernameExists=true;}
		}else{
			echo "Error: " . mysqli_error($conn);
		}
		/////////////////////////////
		
		if($usernameExists){
			echo "<div class=''>Username already taken. Please try again</div>";
		}else{
			$query = "INSERT into `users` (username, password, type) VALUES ('$username', '".md5($password)."', '$type')";
			$result = mysqli_query($con,$query);
			if($result){
				echo "<div class='registrationSuccess'><h3>You have registered successfully.</h3><br/>Click here to <a href='login.php'>Login</a></div>";
			}
		}
		   
    }
	
	
	//NURSE FORM RECEIVED
	if (isset($_REQUEST['username']) && $_REQUEST['formType'] == 2){
		$type = "nurse";
		
		$username = stripslashes($_REQUEST['username']); // removes backslashes
		$username = mysqli_real_escape_string($con,$username); //escapes special characters in a string
				
		$password = stripslashes($_REQUEST['password']);
		$password = mysqli_real_escape_string($con,$password);
		
		$first_name = stripslashes($_REQUEST['first_name']);
		$first_name = mysqli_real_escape_string($con,$first_name);
		
		$last_name = stripslashes($_REQUEST['last_name']);
		$last_name = mysqli_real_escape_string($con,$last_name);
		
		
		//Checking if username exists
		$queryUsername = "SELECT username FROM users where username='" . $username . "'";
		$usernameExists=false;
		$resultUsername = mysqli_query($con,$queryUsername);
		if($resultUsername) {
			$numRows = mysqli_num_rows($resultUsername);
			if($numRows==1){$usernameExists=true;}
		}else{
			echo "Error: " . mysqli_error($conn);
		}
		/////////////////////////////
		
		if($usernameExists){
			echo "<div class=''>Username already taken. Please try again</div>";
		}else{
			
			$query = "INSERT into `nurse` (first_name, last_name) VALUES ('$first_name', '$last_name')";
			if (mysqli_query($con, $query)) {
				$last_id = mysqli_insert_id($con);
				$query = "INSERT into `users` (username, password, type,id) VALUES ('$username', '".md5($password)."', '$type', '$last_id')";
				if (mysqli_query($con, $query)) {
					echo "<div class='registrationSuccess'><h3>You have registered successfully.</h3><br/>Click here to <a href='login.php'>Login</a></div>";
				}
			}
			
		}
		
    }
	
	
	//DOCTOR FORM RECEIVED
	if (isset($_REQUEST['username']) && $_REQUEST['formType'] == 3){
		
		if($experience >= 6){
			$type = "doctor";
		
			$username = stripslashes($_REQUEST['username']); // removes backslashes
			$username = mysqli_real_escape_string($con,$username); //escapes special characters in a string
				
			$password = stripslashes($_REQUEST['password']);
			$password = mysqli_real_escape_string($con,$password);
			
			$first_name = stripslashes($_REQUEST['first_name']);
			$first_name = mysqli_real_escape_string($con,$first_name);
			
			$last_name = stripslashes($_REQUEST['last_name']);
			$last_name = mysqli_real_escape_string($con,$last_name);
			
			
			//Checking if username exists
			$queryUsername = "SELECT username FROM users where username='" . $username . "'";
			$usernameExists=false;
			$resultUsername = mysqli_query($con,$queryUsername);
			if($resultUsername) {
				$numRows = mysqli_num_rows($resultUsername);
				if($numRows==1){$usernameExists=true;}
			}else{
				echo "Error: " . mysqli_error($conn);
			}
			/////////////////////////////
			
			if($usernameExists){
				echo "<div class=''>Username already taken. Please try again</div>";
			}else{
				
				$query = "INSERT into `doctor` (first_name, last_name, status, experience) VALUES ('$first_name', '$last_name', 1, '$experience')";
				if (mysqli_query($con, $query)) {
					$last_id = mysqli_insert_id($con);
					$query = "INSERT into `users` (username, password, type,id) VALUES ('$username', '".md5($password)."', '$type', '$last_id')";
					if (mysqli_query($con, $query)) {
						echo "<div class='registrationSuccess'><h3>You have registered successfully.</h3><br/>Click here to <a href='login.php'>Login</a></div>";
					}
				}
				
			}
			
		}
		else
			echo "Doctor must have at least 6 years of experience to work here!";
    }
	
		//THERAPIST FORM RECEIVED
	if (isset($_REQUEST['username']) && $_REQUEST['formType'] == 4){
		
		if($experience >= 2){
			$type = "therapist";
		
			$username = stripslashes($_REQUEST['username']); // removes backslashes
			$username = mysqli_real_escape_string($con,$username); //escapes special characters in a string
				
			$password = stripslashes($_REQUEST['password']);
			$password = mysqli_real_escape_string($con,$password);
			
			$first_name = stripslashes($_REQUEST['first_name']);
			$first_name = mysqli_real_escape_string($con,$first_name);
			
			$last_name = stripslashes($_REQUEST['last_name']);
			$last_name = mysqli_real_escape_string($con,$last_name);
					
			//Checking if username exists
			$queryUsername = "SELECT username FROM users where username='" . $username . "'";
			$usernameExists=false;
			$resultUsername = mysqli_query($con,$queryUsername);
			if($resultUsername) {
				$numRows = mysqli_num_rows($resultUsername);
				if($numRows==1){$usernameExists=true;}
			}else{
				echo "Error: " . mysqli_error($conn);
			}
			/////////////////////////////
			
			if($usernameExists){
				echo "<div class=''>Username already taken. Please try again</div>";
			}else{
				
				$query = "INSERT into `therapist` (first_name, last_name, status, experience) VALUES ('$first_name', '$last_name', 1, '$experience')";
				if (mysqli_query($con, $query)) {
					$last_id = mysqli_insert_id($con);
					$query = "INSERT into `users` (username, password, type,id) VALUES ('$username', '".md5($password)."', '$type', '$last_id')";
					if (mysqli_query($con, $query)) {
						echo "<div class='registrationSuccess'><h3>You have registered successfully.</h3><br/>Click here to <a href='login.php'>Login</a></div>";
					}
				}
				
			}
			
		}
		else
			echo "Therapist must have at least 2 years of experience to work here!";
    }
		
	
	
?>

<h2>Employee Account Creator</h2>

<!-- https://v4-alpha.getbootstrap.com/components/collapse/ -->

<div class="container">
<div id="accordion" role="tablist" aria-multiselectable="true">
  <div class="card">
    <div class="card-header" role="tab" id="headingOne">
      <h5 class="mb-0">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Receptionist
        </a>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
      <div class="card-block">
        
		<!-- FORM -->
		
		<form action="registration.php" method="post">
		
			<input type="hidden" name="formType" value="1" />
			
			<input type="text" name="username" placeholder="Username" required />
			<input type="password" name="password" placeholder="Password" required />
			<input class="btn btn-primary" type="submit" name="submit" value="Register" />
		</form>
		
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" role="tab" id="headingTwo">
      <h5 class="mb-0">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Nurse
        </a>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="card-block">
        
		<!-- FORM -->
		
		<form action="registration.php" method="post">
		
			<input type="hidden" name="formType" value="2" />
			
			<input type="text" name="username" placeholder="Username" required />
			<input type="password" name="password" placeholder="Password" required />
			<input type="text" name="first_name" placeholder="First Name" required />
			<input type="text" name="last_name" placeholder="Last Name" required />
			
			<input class="btn btn-primary" type="submit" name="submit" value="Register" />
		</form>
			
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" role="tab" id="headingThree">
      <h5 class="mb-0">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Doctor
        </a>
      </h5>
    </div>
	
	
    <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="card-block">
        
		<!-- FORM -->
		
		<form action="registration.php" method="post">
		
			<input type="hidden" name="formType" value="3" />
			
			<input type="text" name="username" placeholder="Username" required />
			<input type="password" name="password" placeholder="Password" required />
			<input type="text" name="first_name" placeholder="First Name" required />
			<input type="text" name="last_name" placeholder="Last Name" required />
			<input type="number" name="experience" placeholder="Experience" required />
			
			<input class="btn btn-primary" type="submit" name="submit" value="Register" />
		</form>
		
      </div>
    </div>
  </div>
  
  
    <div class="card">
    <div class="card-header" role="tab" id="headingFour">
      <h5 class="mb-0">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
          Therapist
        </a>
      </h5>
    </div>
	
	
    <div id="collapseFour" class="collapse" role="tabpanel" aria-labelledby="headingFour">
      <div class="card-block">
        
		<!-- FORM -->
		
		<form action="registration.php" method="post">
		
			<input type="hidden" name="formType" value="4" />
			
			<input type="text" name="username" placeholder="Username" required />
			<input type="password" name="password" placeholder="Password" required />
			<input type="text" name="first_name" placeholder="First Name" required />
			<input type="text" name="last_name" placeholder="Last Name" required />
			<input type="number" name="experience" placeholder="Experience" required />
			
			<input class="btn btn-primary" type="submit" name="submit" value="Register" />
		</form>
		
      </div>
    </div>
  </div>
  
  

</div>

</div>



<p>Already have an account? <a href='login.php'>Login Here</a></p>


</body>
</html>
