
<?php

session_start();
if (!isset($_SESSION['login_user'])) {
    header("location: login.php");

}

include_once('templates/sidebar.php');
include_once('templates/topbar.php');
include_once('templates/content.php');   
include_once('templates/footer.php');


?>
        

               

 