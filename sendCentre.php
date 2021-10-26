<?php
    if (isset($_POST['centreName']) && isset($_POST['address'])){
        include 'db_conn.php';

        // data validation (got error)
        function validate($data){
            // $data = trim($data);
            // $data = stripslashes($data);
            // $data = htmspecialcahrs($data);
            return $data;
        }

        // pass in the user input 
        $centrename = validate($_POST['centreName']);
        $address = validate($_POST['address']);
    
        $sql = "INSERT INTO healthcareCentre (centreName, address) VALUES ('$centrename', '$address')";
        
        $res = mysqli_query($conn, $sql);

        // if i insert sucessfully then go back to log in page
        if ($res) {
            header("location:SignUp.html");
        } 
    }
?>