
<?php

session_start();
if (!isset($_SESSION['login_user'])) {
    header("location: login.php");

}

include_once('templates/sidebar.php');
include_once('templates/topbar.php');




?>
               <?php
        include "config.php";

        if(isset($_POST['but_import'])){
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["importfile"]["name"]);

            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

            $uploadOk = 1;
            if($imageFileType != "csv" ) {
                $uploadOk = 0;
            }

            if ($uploadOk != 0) {
                if (move_uploaded_file($_FILES["importfile"]["tmp_name"], $target_dir.'importfile.csv')) {

                    // Checking file exists or not
                    $target_file = $target_dir . 'importfile.csv';
                    $fileexists = 0;
                    if (file_exists($target_file)) {
                        $fileexists = 1;
                    }
                    if ($fileexists == 1 ) {

                        // Reading file
                        $file = fopen($target_file,"r");
                        $i = 0;

                        $importData_arr = array();
                       

                        while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
                            $num = count($data);

                            for ($c=0; $c < $num; $c++) {
                                $importData_arr[$i][] = mysqli_real_escape_string($con,$data[$c]);
                            }
                            $i++;
                        }
                        fclose($file);

                        $skip = 0;
                        // insert import data
                        foreach($importData_arr as $data){
                            if($skip != 0){
                                $username = $data[0];
                                $fname = $data[1];
                                $lname = $data[2];
                                $email = $data[3];

                                // Checking duplicate entry
                               

                                
                                    // Insert record
                                    $insert_query = "insert into user(logtitude,latitutde,year,level) values('".$username."','".$fname."','".$lname."','".$email."')";
                                    mysqli_query($con,$insert_query);
                                  
                                
                            }
                            $skip ++;
                        }
                        if($insert_query){
                            echo "uploaded successfull";
                        }
                        $newtargetfile = $target_file;
                        if (file_exists($newtargetfile)) {
                            unlink($newtargetfile);
                        }
                    }


                }
            }
        }
        ?>

               

        <div class="col-xl-12 col-md-12 mb-12">
        <form method="post" action="" enctype="multipart/form-data">
        
  <div class="form-group">
    <label for="exampleFormControlFile1">Example file input</label>
    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="importfile">
  </div>
  <button type="submit" class="btn btn-primary"  name="but_import">Submit</button>
  
<br>
 
</form>



    </div>




 <?php 
include_once('templates/footer.php');


 ?>