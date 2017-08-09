<?php
require('db.php');
include("auth.php");


$Pid = $_SESSION['Pid'];
$usertype = $_SESSION['usertype'];

if($usertype != "receptionist"){
	echo "Only for receptionists";
	die();
}

	//If form received
	if (isset($_REQUEST['amount'])){
		
			$pid = stripslashes($_REQUEST['pid']);
		$amount = stripslashes($_REQUEST['amount']);
		$type = stripslashes($_REQUEST['type']);
		$card_id = stripslashes($_REQUEST['card_id']);
		$validNum = stripslashes($_REQUEST['validNum']);
		$holdername = stripslashes($_REQUEST['holdername']);
		$experi_date = stripslashes($_REQUEST['experi_date']);
		
		
		
				//Checking if pid exists
		$queryPid = "SELECT Pid FROM patient where pid='" . $pid . "'";
		$PidExists=false;
		$resultPid = mysqli_query($con,$queryPid);
		if($resultPid) {
			$numRows = mysqli_num_rows($resultPid);
			if($numRows==1){$PidExists=true;}
		}else{
			echo "Error: " . mysqli_error($conn);
		}
		
		
				if($PidExists){
					
					//echo "Patient exists!"; 
					
					$query = "INSERT INTO payment (pid,amount,type,status) VALUES (" . $pid . "," . $amount . ",'".$type . "',1)";
					
					//echo $query;
					
					
					
					
						if (mysqli_query($con, $query)) {
							
							
							if($type=="Cash"){
								echo "<div class='registrationSuccess'><h3>Successful Payment.</h3><br/></div>";
							}else{
							
							
							
							$last_id = mysqli_insert_id($con);
							
							
							
							$query = "INSERT INTO card (payid,card_id,validNum,holdername,experi_date) VALUES (" . $last_id . "," . $card_id . "," . $validNum . ",'" . $holdername . "','" . $experi_date . "')";
							
							//echo "query2 <br>";
							//echo $query;
							
							
							//echo "<br>";
							
							
							
							if (mysqli_query($con, $query)) {
								echo "<div class='registrationSuccess'><h3>Successful Payment.</h3><br/></div>";
							}
							
							}
						}
			
					
			
			
			
			
		}else{
			
			echo "<div class='fail'>No such Patient ID. Please try again.</div>";
			
		}
		
		
		
		

		
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
<p class = "logout"> <a href="logout.php">Logout</a></p>

<h2>Payment</h2> <br/>


<h5><a href="receptionist.php">Back to Control Panel</a></h5>

<form action="make_payment1.php" method="post">

<input type="number" name="pid" placeholder="Patient ID" required />
	
	<input type="number" name="amount" placeholder="Enter amount" required />
	
	
	
	<select id="type" name="type">                      

  <option value="Cash">Cash</option>
  <option value="Credit Card">Credit Card</option>
  <option value="Debit Card">Debit Card</option>
	</select>
	
	
	<input type="number" name="card_id" placeholder="Card ID" required />
	<input type="number" name="validNum" placeholder="validNum" required />
	<input type="text" name="holdername" placeholder="Holder Name" required />
	<input type="date" name="experi_date" placeholder="Exp date" required />
	
	<input class="btn btn-primary" type="submit" name="submit" value="Register" />
	
</form>


</body>
</html>