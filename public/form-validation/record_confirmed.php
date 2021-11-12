<?php

$updateToConfirmedSql = $pdo->prepare("UPDATE vaccinations SET status='Confirmed', 
remarks = :remarks WHERE vaccinationID= :vaccinationID");
$updateToConfirmedSql->execute(array(
    ':remarks' => $remarks,
    ':vaccinationID' => $vaccinationID
));