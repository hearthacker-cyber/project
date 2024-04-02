<?php
// Include the database connection file
include 'config.php';

// Check if ID parameter exists in the POST data
if(isset($_POST['id'])) {
    $id = $_POST['id'];

    // Delete the record from the database based on the ID
    $delete_sql = "DELETE FROM flood_history WHERE id = $id";
    if ($con->query($delete_sql) === TRUE) {
        // If deletion successful, return JSON response
        echo json_encode(['success' => true, 'message' => 'Record deleted successfully']);
        exit();
    } else {
        // If deletion fails, return JSON response
        echo json_encode(['success' => false, 'message' => 'Error deleting record: ' . $con->error]);
        exit();
    }
} else {
    // If no ID parameter provided, return JSON response
    echo json_encode(['success' => false, 'message' => 'ID parameter missing']);
    exit();
}
?>
