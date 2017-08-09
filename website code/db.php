<?php

$server = "auc353_1.encs.concordia.ca";
$username = "auc353_1";
$password = "BrownCOW";
$database = "auc353_1";


$con = mysqli_connect($server,$username ,$password,$database);
if (mysqli_connect_errno()){
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

?>