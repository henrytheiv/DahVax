<?php

require '../app/app.php';

if (is_post()) {


    $username = $_POST['username'];
    $batchNo = $_POST['batchNo'];
    $appointmentDate = $_POST['appointmentDate'];
    $status = "Pending";
    $remarks = "-";

    $sucess = '';

    $wrong_appointmentDate = '';

    if (empty($appointmentDate)) {
        $wrong_appointmentDate = 'blankAppointmentDate';
    } else {

        if ($appointmentDate < ('Y-m-d')) {
            $wrong_appointmentDate = 'invalidAppointmentDate';
        }
    }


    // if dh error in validate then move to here
    if ($wrong_appointmentDate == '') {

        $data = array(

            ':appointmentDate' => $appointmentDate,
            ':status' => $status,
            ':remarks' => $remarks,
            ':username' => $username,
            ':batchNo' => $batchNo

        );



        $requestSql = $pdo->prepare("INSERT INTO vaccinations (appointmentDate, status, remarks, username, batchNo) 
        VALUES (:appointmentDate, :status, :remarks, :username, :batchNo)");
        $requestSql->execute($data);



        $getBatchSql = $pdo->prepare("SELECT * FROM batches WHERE batchNo = :batchNo");
        $getBatchSql->bindValue(':batchNo', $batchNo);
        $getBatchSql->execute();
        $batch = $getBatchSql->fetch();

        $newQuantityPending = $batch['quantityPending'] + 1;
        $newQuantityAvailable = $batch['quantityAvailable'] - 1;

        $updateBatchSql = $pdo->prepare("UPDATE batches SET quantityPending = :quantityPending, 
                quantityAvailable = :quantityAvailable WHERE batchNo = :batchNo");
        $updateBatchSql->execute(array(
            ':quantityPending' => $newQuantityPending,
            ':quantityAvailable' => $newQuantityAvailable,
            ':batchNo' => $batchNo
        ));
    }

    $output = array(
        'success' => $success,
        'wrong_appointmentDate' => $wrong_appointmentDate,
    );

    echo json_encode($output);
}
