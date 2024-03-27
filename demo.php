<?php
$servername = "srv1124.hstgr.io";
$username = "u632480160_joinponguk";
$password = "@Babahelp13";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>