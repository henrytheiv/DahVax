<?php
    if (isset($_POST['username']) && isset($_POST['password']) && 
    isset($_POST['email']) && isset($_POST['fullname']) && 
    isset($_POST['icpassport'])){
        include 'db_conn.php';

        // data validation (got error)
        function validate($data){
            // $data = trim($data);
            // $data = stripslashes($data);
            // $data = htmspecialcahrs($data);
            return $data;
        }

        // pass in the user input 
        $name = validate($_POST['username']);
        $password = validate($_POST['password']);
        $email = validate($_POST['email']);
        $fullname = validate($_POST['fullname']);
        $icpassport = validate($_POST['icpassport']);


        // 
        $sql = "INSERT INTO patient (username, password, email, fullname, icpassport) VALUES ('$name', '$password ', '$email', '$fullname', '$icpassport')";
        
        $res = mysqli_query($conn, $sql);

        // if i insert sucessfully then go back to log in page
        if ($res) {
            header("location:SignUp.html");
        } 
    }
?>