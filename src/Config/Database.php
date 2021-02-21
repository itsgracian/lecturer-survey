<?php
$con = mysqli_connect("localhost","root","gramdb@1","survey");

$role = ['student', 'admin'];

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

?>
