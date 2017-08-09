<?php
require('db.php');
include("auth.php");

$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];

if($usertype != "patient"){
	echo "Only for patients";
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

<h2>Make an Appointment</h2> <br/>


<h5><a href="patient.php">Back to Control Panel</a></h5>

<head>
  <meta http-equiv="content-type" content="text/html;charset=utf-8">
  <title>Php Calendar</title>
  <link rel="stylesheet" type="text/css" media="screen" href="calendar.css">
</head>

<body>

<?php

$query = "SELECT id FROM `users` WHERE username = '$username'";
$result = mysqli_query($con,$query);

if (mysqli_num_rows($result) > 0) {
	
	while ($row = $result->fetch_assoc())
			$test = $row['id'];
		
	$query = "SELECT pre_id FROM `patient` WHERE pid = '$test'";
	$result = mysqli_query($con,$query);
	
	while ($row = $result->fetch_assoc()){
		$get_pre = $row['pre_id'];
	}
	
	if($get_pre[0] == 1){
		$query = "SELECT first_name, last_name, doc_id FROM `doctor` WHERE (SELECT pre_id FROM `patient` WHERE pid = '$test') = doc_id";  
		$result = mysqli_query($con,$query);
		
		while ($row = $result->fetch_assoc()){
			echo "Your referred doctor/therapist is: ";
			$test2 = $row['first_name'];
			$test3 = $row['last_name'];	
			echo "<u>"."$test2";
			echo " ";
			echo "<u>"."$test3" ."<br />";
			$test4 = $row['doc_id'];
		}
	}
	
	elseif($get_pre[0] == 2){
		$query = "SELECT first_name, last_name, the_id FROM `therapist` WHERE (SELECT pre_id FROM `patient` WHERE pid = '$test') = the_id";  
		$result = mysqli_query($con,$query);
		
		while ($row = $result->fetch_assoc()){
			echo "Your referred doctor/therapist is: ";
			$test2 = $row['first_name'];
			$test3 = $row['last_name'];	
			echo "<u>"."$test2";
			echo " ";
			echo "<u>"."$test3" ."<br />";
			$test4 = $row['the_id'];
		}
	}
	
} 

function draw_calendar($month,$year,$n_year=array(),$n_month=array(),$n_day=array(),$n_start=array(),$test2,$test3){
		
	/* draw table */
	$calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

	/* table headings */
	$headings = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
	$calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

	/* days and weeks vars now ... */
	$running_day = date('w',mktime(0,0,0,$month,1,$year));
	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
	$days_in_this_week = 1;
	$day_counter = 0;
	$dates_array = array();

	/* row for week one */
	$calendar.= '<tr class="calendar-row">';

	/* print "blank" days until the first of the current week */
	for($x = 0; $x < $running_day; $x++):
		$calendar.= '<td class="calendar-day-np">&nbsp;</td>';
		$days_in_this_week++;
	endfor;

	/* keep going with days.... */
	for($list_day = 1; $list_day <= $days_in_month; $list_day++):
		$calendar.= '<td class="calendar-day"><div style="position:relative;height:100px;">';
			/* add in the day number */
			$calendar.= '<div class="day-number">'.$list_day.'</div>';
			
			if(!empty($n_year))
			{
			foreach ($n_year as $index => $value)
			{
				//$events[index] = array($n_year[$index], $n_month[$index], $n_day[$index], $n_start[$index], $n_dur[$index]);
				if($day_counter == $n_day[$index]-1 && $month == $n_month[$index] && $year == $n_year[$index])
					$calendar.= '<div class="event">'."$n_start[$index]" ."<br />" ."1" 
				." Hour" ."<br />" ."$test2" ." " ."$test3" .'</div>';
			}
			}
		$calendar.= '</div></td>';
		if($running_day == 6):
			$calendar.= '</tr>';
			if(($day_counter+1) != $days_in_month):
				$calendar.= '<tr class="calendar-row">';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		endif;
		$days_in_this_week++; $running_day++; $day_counter++;
	endfor;

	/* finish the rest of the days in the week */
	if($days_in_this_week < 8):
		for($x = 1; $x <= (8 - $days_in_this_week); $x++):
			$calendar.= '<td class="calendar-day-np">&nbsp;</td>';
		endfor;
	endif;

	/* final row */
	$calendar.= '</tr>';
	

	/* end the table */
	$calendar.= '</table>';

	/** DEBUG **/
	$calendar = str_replace('</td>','</td>'."\n",$calendar);
	$calendar = str_replace('</tr>','</tr>'."\n",$calendar);
	
	/* all done, return result */
	return $calendar;
}

function random_number() {
	srand(time());
	return (rand() % 7);
}

/* date settings */
$month = (int) ($_GET['month'] ? $_GET['month'] : date('m'));
$year = (int)  ($_GET['year'] ? $_GET['year'] : date('Y'));

/* select month control */
$select_month_control = '<select name="month" id="month">';
for($x = 1; $x <= 12; $x++) {
	$select_month_control.= '<option value="'.$x.'"'.($x != $month ? '' : ' selected="selected"').'>'.date('F',mktime(0,0,0,$x,1,$year)).'</option>';
}
$select_month_control.= '</select>';

/* select year control */
$year_range = 7;
$select_year_control = '<select name="year" id="year">';
for($x = ($year-floor($year_range/2)); $x <= ($year+floor($year_range/2)); $x++) {
	$select_year_control.= '<option value="'.$x.'"'.($x != $year ? '' : ' selected="selected"').'>'.$x.'</option>';
}
$select_year_control.= '</select>';

/* "next month" control */
$next_month_link = '<a href="?month='.($month != 12 ? $month + 1 : 1).'&year='.($month != 12 ? $year : $year + 1).'" class="control">Next Month &gt;&gt;</a>';

/* "previous month" control */
$previous_month_link = '<a href="?month='.($month != 1 ? $month - 1 : 12).'&year='.($month != 1 ? $year : $year - 1).'" class="control">&lt;&lt; 	Previous Month</a>';


/* bringing the controls together */
$controls = '<form method="get">'.$select_month_control.$select_year_control.'&nbsp;<input type="submit" name="submit" value="Go" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$previous_month_link.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$next_month_link.' </form>';

/* get all events for the given month */

	$date_sql = $_POST['date_sql'];
	
	$time_sql = $_POST['time_sql'];
	
	//if (isset($_POST['submit'])) {
	
	$query = "SELECT ta_id, pid
				FROM `schedule`
				WHERE emp_id = '$test4' AND ta_id <> '0'";
		
	$result = mysqli_query($con,$query);
	
	$ctr =0;
	$duplicate_flag = 0;
	while ($row = $result->fetch_assoc()) {
		$get_docid[ctr] = $row['ta_id'];
		$get_patid[ctr] = $row['pid'];
		$query1 = "SELECT date_treat, start 
				FROM `time_appointment`
				WHERE ta_id = '$get_docid[ctr]' AND pid = '$get_patid[ctr]'";
		$result1 = mysqli_query($con,$query1);
		
		$ctr2 = 0;
		while ($row1 = $result1->fetch_assoc()) {
			$get_date[ctr2] = $row1['date_treat'];
			$get_time[ctr2] = $row1['start'];
			
			if($date_sql == $get_date[ctr2] && $time_sql == $get_time[ctr2]){
				$duplicate_flag = 1;;
			}
			$ctr2++;
		}
		$ctr++;
		
	}
	
	if($duplicate_flag != 1 && isset($_POST['submit'])){
		$query = "INSERT into `time_appointment` (pid, duration, date_treat, start) VALUES ('$test', '1', '$date_sql', '$time_sql')";
		$result = mysqli_query($con,$query);
	
		$appoint = mysqli_insert_id($con);
	
		$query = "INSERT into `schedule` (ta_id, emp_id, pid) VALUES ('$appoint', '$test4', '$test')";
		$result = mysqli_query($con,$query);
	}	
	
	elseif (isset($_POST['submit']))
		echo "<br />" ."Doctor is already treating someone at that time!!" ."<br />";
	
	$query = "SELECT * 
				FROM `time_appointment` 
				WHERE pid = '$test'";
				
	$result = mysqli_query($con,$query);

	$ctr =0;
	while ($row = $result->fetch_assoc()) {
			$ta1[$ctr] = $row['date_treat'];
			$seperate = explode("-", $ta1[$ctr]);
			$n_year[$ctr] = (int)$seperate[0];
			$n_month[$ctr] = (int)$seperate[1];
			$n_day[$ctr] = (int)$seperate[2];
			$n_start[$ctr] = $row['start'];
			$ctr++;
	}
	//}		
echo '<div style="float:left;">'.$controls.'</div>';
echo '<div style="clear:both;"></div>';
echo draw_calendar($month,$year,$n_year,$n_month,$n_day,$n_start,$test2,$test3);
echo '<br /><br />';

?>

<form action="appointment.php" method="post">
	
	<input type="text" name="date_sql" placeholder="Date (YYYY-MM-DD)" required />
	<input type="text" name="time_sql" placeholder="Time (HH:MM:SS)" required />

	<input type="submit" name="submit" value="Make Appointment" />
</form>

</body>
</html>