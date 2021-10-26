<?php

$batchNo = '';
$expiryDate = '';
$quantityAvailable = '';


$batchNo = $_POST['batchNo'];
$expiryDate = $_POST['expiryDate'];
$quantityAvailable = $_POST['quantityAvailable'];
$vaccineID = 'V110';

$errors = [];


if ($expiryDate < date('Y-m-d')) {

    $errors[] = 1;
}

if ($quantityAvailable < 10) {

    $errors[] = 1;
}

if (!$batchNo) {
    $errors[] = 1;
    $blankBatchNoMsg = "Batch No cannot be blank";
}

if (!$expiryDate) {
    $errors[] = 1;
    $blankExpiryDateMsg = "Expiry Date cannot be blank";
}

if (!$quantityAvailable) {
    $errors[] = 1;
    $blankQuantityMsg = "Quantity available cannot be blank";
}

include_once 'RecordNewVaccineBatch.php';
