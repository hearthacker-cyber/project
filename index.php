
<?php

session_start();
if (!isset($_SESSION['login_user'])) {
    header("location: login.php");

}?>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Chart.js CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>

<?php

include_once('templates/sidebar.php');
include_once('templates/topbar.php');
include_once('content.php');   
include_once('templates/footer.php');


?>
        

               

 