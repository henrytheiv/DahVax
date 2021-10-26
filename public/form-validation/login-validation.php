<?php

$username = $_POST['username'];
$password = $_POST['password'];

if (!$username) {
    $blankUsernameMsg = "Username cannot be blank";
}

if (!$password) {
    $blankPasswordMsg = "Password cannot be blank";
}

