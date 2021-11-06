<?php

session_start();



if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $output = "";

    require_once "../app/database.php";

    $vaccineID = $_POST['vaccineID'];
    $_SESSION['vaccineID'] = $vaccineID;

    $statement = $pdo->prepare("SELECT * FROM vaccines WHERE vaccineID = :vaccineID");
    $statement->bindValue(':vaccineID', $vaccineID);
    $statement->execute();
    $vaccine = $statement->fetch();

    $output = "<p><strong>Vaccine Name: </strong>" . $vaccine['vaccineName'] . "</p>
    <p><strong>Manufacturer: </strong>" . $vaccine['manufacturer'] . "</p>";

    echo $output;
}
