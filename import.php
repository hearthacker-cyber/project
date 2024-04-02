<?php
session_start();
if (!isset($_SESSION['login_user'])) {
    header("location: login.php");
    exit; // Add exit to prevent further execution
}

include_once('templates/sidebar.php');
include_once('templates/topbar.php');

include "config.php";

if(isset($_POST['but_import'])){
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

                $year = mysqli_real_escape_string($con, $data[0]);
                $location = mysqli_real_escape_string($con, $data[1]);
                $severity = mysqli_real_escape_string($con, $data[2]);
                $impact = mysqli_real_escape_string($con, $data[3]);
                $latitude = mysqli_real_escape_string($con, $data[4]);
                $longtitude = mysqli_real_escape_string($con, $data[5]);
                $value = mysqli_real_escape_string($con, $data[6]);

                $insert_query = "INSERT INTO flood_history (year, location, severity, impact,latitude, longitude,value) VALUES ('$year', '$location', '$severity', '$impact','$latitude','$longtitude',$value)";

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

            // Display feedback to the user
            echo "Data uploaded successfully. $successCount records inserted, $errorCount records failed.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>


<div class="col-xl-6 col-md-6 mb-6">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Upload CSV File</h5>
        </div>
        <div class="card-body">
            <form method="post" action="" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="exampleFormControlFile1">Choose CSV File</label>
                    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="importfile">
                </div>
                <button type="submit" class="btn btn-primary"  name="but_import">Submit</button>
            </form>
        </div>
    </div>
</div>


<?php 
include_once('templates/footer.php');
?>
