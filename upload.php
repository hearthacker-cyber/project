<?php
session_start();
if (!isset($_SESSION['login_user'])) {
    header("location: login.php");
    exit; // Add exit to prevent further execution
}

include_once('templates/sidebar.php');
include_once('templates/topbar.php');

include "config.php";

if(isset($_FILES["importfile"])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["importfile"]["name"]);

    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

    // Check if the file is a CSV file
    if($imageFileType != "csv") {
        echo "Only CSV files are allowed.";
    } else {
        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["importfile"]["tmp_name"], $target_file)) {
            $file = fopen($target_file, "r");
            $skip = true; // Skip the header row
            $successCount = 0;
            $errorCount = 0;

            // Start a transaction
            mysqli_begin_transaction($con);
            
            while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
                if ($skip) {
                    $skip = false;
                    continue;
                }

                $username = mysqli_real_escape_string($con, $data[0]);
                $fname = mysqli_real_escape_string($con, $data[1]);
                $lname = mysqli_real_escape_string($con, $data[2]);
                $email = mysqli_real_escape_string($con, $data[3]);

                $insert_query = "INSERT INTO user (logtitude, latitutde, year, level) VALUES ('$username', '$fname', '$lname', '$email')";

                if(mysqli_query($con, $insert_query)) {
                    $successCount++;
                } else {
                    $errorCount++;
                }
            }

            // Commit the transaction
            mysqli_commit($con);

            fclose($file);

            // Delete the uploaded CSV file
            unlink($target_file);

            // Prepare response
            $response = array(
                'success' => true,
                'message' => "Data uploaded successfully. $successCount records inserted, $errorCount records failed."
            );
            echo json_encode($response);
        } else {
            // Prepare error response
            $response = array(
                'success' => false,
                'message' => "Sorry, there was an error uploading your file."
            );
            echo json_encode($response);
        }
    }
} else {
    // Prepare error response
    $response = array(
        'success' => false,
        'message' => "File not found."
    );
    echo json_encode($response);
}
?>
