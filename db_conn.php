<?php

$name = "localhost";
$uname = "root";
$password = "";

$db_name = "dahvax";
// the name of my database call mhtest
$conn = mysqli_connect($name, $uname, $password, $db_name);

if (!$conn) {
    echo "connection failed!";
    exit();
}