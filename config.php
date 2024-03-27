<?php
$servername = "srv1124.hstgr.io";
$username = "u632480160_52project";
$password = "@Babahelp13";
$db = "u632480160_52project";


// Create connectionfhhff
$con = new mysqli($servername, $username, $password,$db);

// Check connection
if ($con->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// echo "Connected successfully";
?>