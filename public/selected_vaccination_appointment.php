<?php

require_once "../app/app.php";


if(is_post()){

    $output = "";

    $vaccinationID = $_POST['vaccinationID'];

    $statement = $pdo->prepare("SELECT * FROM vaccinations WHERE vaccinationID = :vaccinationID");
    $statement->bindValue(':vaccinationID', $vaccinationID);
    $statement->execute();
    $vaccination = $statement->fetch();

    $output = "<p><strong>Appointment Date: </strong>" . $vaccination['appointmentDate'] . "</p>
    <p><strong>Status: </strong>" . $vaccination['status'] . "</p>
    <p><strong>Remarks: </strong>" . $vaccination['remarks'] . "</p>";

    echo $output;

}