<?php
ob_start();
// Include necessary files
include_once('templates/sidebar.php');
include_once('templates/topbar.php');

// Include database connection
include 'config.php';

// Check if ID parameter exists in the URL
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the record from the database based on the ID
    $sql = "SELECT * FROM flood_history WHERE id = $id";
    $result = $con->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Store the fetched data into variables for convenience
        $longitude = $row['longitude'];
        $latitude = $row['latitude'];
        $location = $row['location'];
        $year = $row['year'];
        $severity = $row['severity'];
        $impact = $row['impact'];

    } else {
        // If no record found, display an error message
        echo "Record not found.";
        exit();
    }
} else {
    // If no ID parameter provided, display an error message
    echo "ID parameter missing.";
    exit();
}

// Check if form is submitted for updating the record
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $longitude = $_POST['longitude'];
    $latitude = $_POST['latitude'];
    $location = $_POST['location'];
    $year = $_POST['year'];
    $severity = $_POST['severity'];
    $impact = $_POST['impact'];

    // Update the record in the database
    $update_sql = "UPDATE `flood_history` SET `year` = '$year', `location` = '$location', `severity` = '$severity', `impact` = '$impact', `latitude` = '$latitude', `longitude` = '$longitude' WHERE `flood_history`.`id` = '$id';";

    // $update_sql = "UPDATE flood_history SET longitude = '$longitude', latitude = '$latitude', year = '$year', severity = '$severity', 'impact' = '$impact','location'='$location' WHERE id = $id";
    if ($con->query($update_sql) === TRUE) {
        // If update successful, redirect back to the page with a success message
        header("Location: tables.php?success=Record updated successfully");

        exit();
    } else {
        // If update fails, display an error message
        echo "Error updating record: " . $con->error;
        exit();
    }
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Edit Flood Details</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"></h6>
        </div>
        <div class="card-body">
            <form method="POST" action="edit.php?id=<?php echo $id?>">
                <div class="form-group">
                    <label for="longitude">Longitude:</label>
                    <input type="text" class="form-control" name="longitude" value="<?php echo $longitude; ?>">
                </div>
                <div class="form-group">
                    <label for="latitude">Latitude:</label>
                    <input type="text" class="form-control" name="latitude" value="<?php echo $latitude; ?>">
                </div>
                <div class="form-group">
                    <label for="year">Year:</label>
                    <input type="text" class="form-control" name="year" value="<?php echo $year; ?>">
                </div>
                <div class="form-group">
                    <label for="level">severity</label>
                    <input type="text" class="form-control" name="severity" value="<?php echo $severity; ?>">
                </div>
                <div class="form-group">
                    <label for="level">Flood Location</label>
                    <input type="text" class="form-control" name="location" value="<?php echo $location; ?>">
                </div>
                <div class="form-group">
                    <label for="level">impact</label>
                    <input type="text" class="form-control" name="impact" value="<?php echo $impact; ?>">
                </div>
                <button type="submit" class="btn btn-primary" name="update">Update</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php
// Include footer and necessary scripts
include_once('templates/footer.php');
?>
