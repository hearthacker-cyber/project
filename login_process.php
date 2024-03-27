<?php
session_start();
include_once('config.php');
// Retrieve username and password from form
$username = $_POST['username'];
$password = $_POST['password'];

// SQL injection prevention
$username = stripslashes($username);
$password = stripslashes($password);
$username = mysqli_real_escape_string($con, $username);
$password = mysqli_real_escape_string($con, $password);

// Fetch user from database
$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);

if ($row) {
    // Successful login
    $_SESSION['login_user'] = $username;
    header("location: index.php");
} else {
    // Invalid login
    echo "Invalid username or password.";
}

$conn->close();
?>
