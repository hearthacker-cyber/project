<?php
include_once('templates/sidebar.php');
include_once('templates/topbar.php');

?>

  
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">FLood Details</h1>
                   

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"></h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                            <th>ID</th>
                                                <th>Location</th>
                                                <th>Severity</th>
                                                <th>Year</th>
                                                <th>Impact</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                                <!-- <th>Delete</th> -->
                                            
                                            </tr>
                                        </thead>
                                    <tfoot>
                                        <tr>
                                        <th>ID</th>
                                                <th>Location</th>
                                                <th>Severity</th>
                                                <th>Year</th>
                                                <th>Impact</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            <!-- <th>Delete</th> -->
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
// Include the database connection file
include 'config.php';

// SQL query to fetch data from the users table
$sql = "SELECT * FROM flood_history";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        // echo "ID: " . $row["id"]. " - Username: " . $row["username"]. " - Email: " . $row["email"]. "<br>";

?>

                                        <tr>
                                            <td><?php echo $row['id'];?></td>
                                            <td><?php echo $row['location'];?></td>
                                            <td><?php echo $row['severity'];?></td>
                                            <td><?php echo $row['year'];?></td>
                                            <td><?php echo $row['impact'];?></td>
                                            
                                            <td>
                                            <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
</td>


                    <td>
    <button class="btn btn-danger btn-sm delete-btn" data-id="<?php echo $row['id']; ?>">Delete</button>
</td>

                    <!-- <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a> -->
                
                                   
                                        </tr>
                                       <?php
    }
} else {
    echo "0 results";
}

                    
                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
                <script>
document.addEventListener("DOMContentLoaded", function() {
    const deleteButtons = document.querySelectorAll('.delete-btn');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            if (confirm('Are you sure you want to delete this record?')) {
                // Send AJAX request
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'delete.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (xhr.status == 200) {
                        // Check if deletion was successful
                        const response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            // Remove the row from the table
                            const row = button.closest('tr');
                            row.remove();
                            alert(response.message);
                        } else {
                            alert(response.message);
                        }
                    } else {
                        alert('Error: ' + xhr.statusText);
                    }
                };
                xhr.onerror = function() {
                    alert('Request failed');
                };
                xhr.send('id=' + id);
            }
        });
    });
});
</script>

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>