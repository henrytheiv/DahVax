<?php

require_once '../../app/app.php';


if (is_post()) {

    $vaccinationID = $_POST['vaccinationID'];
    $status = $_POST['status'];
    $batchNo = $_POST['batchNo'];

    if (empty(trim($_POST['remarks']))) {
        $remarks = "-";
    } else {
        $remarks = $_POST['remarks'];
    }

    $getBatchQuantitySql = $pdo->prepare("SELECT * FROM batches WHERE batchNo = :batchNo");
    $getBatchQuantitySql->bindValue(":batchNo", $batchNo);
    $getBatchQuantitySql->execute();
    $batch = $getBatchQuantitySql->fetch();

    $quantityPending = $batch['quantityPending'];
    $quantityAdministered = $batch['quantityAdministered'];




    $updateToAdministeredSql = $pdo->prepare("UPDATE vaccinations SET status='Administered', 
            remarks = :remarks WHERE vaccinationID = :vaccinationID");
    $updateToAdministeredSql->execute(array(
        ':remarks' => $remarks,
        ':vaccinationID' => $vaccinationID
    ));



    $updateQuantityAdministeredSql = $pdo->prepare("UPDATE batches SET quantityPending = :quantityPending, 
            quantityAdministered = :quantityAdministered WHERE batchNo = :batchNo");
    $updateQuantityAdministeredSql->execute(array(
        ':quantityPending' => $quantityPending - 1,
        ':quantityAdministered' => $quantityAdministered + 1,
        ':batchNo' => $batchNo
    ));
}
