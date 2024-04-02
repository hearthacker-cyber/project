<?php
// Include database connection file
include 'config.php';

// Fetch data from admin dashboard database
$sql = "SELECT * FROM user";
$result = $con->query($sql);

// File name for download
$filename = "flood_data.csv";

// Headers for CSV file
$header = array("ID", "Longitude", "Latitude", "Year", "Flood Level");

// Open file pointer
$fp = fopen('php://output', 'w');

// Write headers to CSV file
fputcsv($fp, $header);

// Populate CSV file with fetched data
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        fputcsv($fp, array($row['id'], $row['logtitude'], $row['latitude'], $row['year'], $row['level']));
    }
}

// Close file pointer
fclose($fp);

// Set headers to force download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . $filename . '"');

// Output CSV file contents
readfile("php://output");
?>
