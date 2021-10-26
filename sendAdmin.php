<?php
    if (isset($_POST['adminUsername']) && isset($_POST['adminPassword']) && 
    isset($_POST['adminEmail']) && isset($_POST['adminFullname']) && 
    isset($_POST['staffid'])){
        include 'db_conn.php';

        // data validation (got error)
        function validate($data){
            // $data = trim($data);
            // $data = stripslashes($data);
            // $data = htmspecialcahrs($data);
            return $data;
        }

        // pass in the user input 
        $adminUsername = validate($_POST['adminUsername']);
        $adminPassword = validate($_POST['adminPassword']);
        $adminEmail = validate($_POST['adminEmail']);
        $adminFullname = validate($_POST['adminFullname']);
        $staffID = validate($_POST['staffid']);


        $sql = "INSERT INTO admin (adminUsername, adminPassword, adminEmail, adminFullname, staffID) VALUES ('$adminUsername', '$adminPassword ', '$adminEmail', '$adminFullname', '$staffID')";
        
        $res = mysqli_query($conn, $sql);

        // if i insert sucessfully then go back to log in page
        if ($res) {
            header("location:SignUp.html");
        } 
    }
?>