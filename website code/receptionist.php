<?php

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

<h2>Receptionist's Control Panel</h2> <br/>


<!-- https://v4-alpha.getbootstrap.com/components/collapse/ -->

<div class="container">
<div id="accordion" role="tablist" aria-multiselectable="true">
  <div class="card">
    <div class="card-header" role="tab" id="headingOne">
      <h5 class="mb-0">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Registration/Appointments/Payments
        </a>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
      <div class="card-block">
        
		<!-- Item 1 -->
		
		<h5><a href="register_patient.php">Register Patient</a></h5>
		<h5><a href="appoint_rec.php">Book an Appointment for a Patient</a></h5>
		<h5><a href="list_all_appointments.php">View All Appointments</a></h5>
		<h5><a href="delete_appointment.php">Cancel an Appointment</a></h5>
		<h5><a href="list_all_payments.php">View All Payments</a></h5>
		<h5><a href="make_payment1.php">Make Payment</a></h5>
		
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" role="tab" id="headingTwo">
      <h5 class="mb-0">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          View Records
        </a>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="card-block">
        
		<!-- Item 2 -->
		
		<h5><a href="list_all_users.php">List All Users</a></h5>
		<h5><a href="list_all_nurses.php">List All Nurses</a></h5>
		<h5><a href="list_all_doctors.php">List All Doctors</a></h5>
		<h5><a href="list_all_therapists.php">List All Therapists</a></h5>
		<h5><a href="list_all_patients.php">List All Patients</a></h5>
			
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" role="tab" id="headingThree">
      <h5 class="mb-0">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Update Staff Information
        </a>
      </h5>
    </div>
	
	
    <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="card-block">
        
		<!-- Item 3 -->
		
		<h5><a href="update_nurse1.php">Update Nurse Information</a></h5>
		<h5><a href="update_doctor1.php">Update Doctor Information</a></h5>
		<h5><a href="update_therapist1.php">Update Therapist Information</a></h5>
		
      </div>
    </div>
  </div>
  
    <div class="card">
    <div class="card-header" role="tab" id="headingFour">
      <h5 class="mb-0">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
          Other
        </a>
      </h5>
    </div>
	
	
    <div id="collapseFour" class="collapse" role="tabpanel" aria-labelledby="headingFour">
      <div class="card-block">
        
		<!-- Item 4 -->
		<! -- The 7 Queries -->
		
		<h5><a href="q1_form.php">1. Patients seen by each physio therapist in a specified period of time</a></h5>
		<h5><a href="q2.php">2 .Equipment that was never used</a></h5>
		<h5><a href="q3.php">3. All info on physio patients who have been at the center</a></h5>
		<h5><a href="q4.php">4. All info on therapists who have been at the center</a></h5>
		<h5><a href="q5.php">5. All info on therapists who work at the center</a></h5>
		<h5><a href="q6_form.php">6. Reservation details for a specific patient</a></h5>
		<h5><a href="q7_form.php">7. Availability of therapist/doctor during a specified period of time.</a></h5>
		
      </div>
    </div>
  </div>
  
  
</div>

</div>

</body>
</html>