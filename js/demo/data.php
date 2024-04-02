<?php
// Include the database connection file
header('Content-Type: application/json');
include 'C:\xampp\htdocs\hifi11\config.php';

// SQL query to fetch data from the users table
$sql = "SELECT * FROM demo";
$result = $con->query($sql);

// if ($result->num_rows > 0) {
    // Output data of each ro
$data = array();
foreach ($result as $row) {
    # code...
    $data[] = $row;
}
// $conn->close()
print json_encode($data);
?>
