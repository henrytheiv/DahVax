<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    require_once "../app/database.php";

    $output = "";

    $vaccinationID = $_POST['vaccinationID'];

    $output = $vaccinationID;

    $findVaccinationSql = $pdo->prepare("SELECT * FROM vaccinations WHERE vaccinationID = :vaccinationID");
    $findVaccinationSql->bindValue(":vaccinationID", $vaccinationID);
    $findVaccinationSql->execute();
    $vaccination = $findVaccinationSql->fetch();

    $findPatientSql = $pdo->prepare("SELECT * FROM patients WHERE username = :username");
    $findPatientSql->bindValue(":username", $vaccination['username']);
    $findPatientSql->execute();
    $patient = $findPatientSql->fetch();

    $findBatchSql = $pdo->prepare("SELECT * FROM batches WHERE batchNo = :batchNo");
    $findBatchSql->bindValue(":batchNo", $vaccination['batchNo']);
    $findBatchSql->execute();
    $batch = $findBatchSql->fetch();

    $findVaccineSql = $pdo->prepare("SELECT * FROM vaccines WHERE vaccineID = :vaccineID");
    $findVaccineSql->bindValue(":vaccineID", $batch['vaccineID']);
    $findVaccineSql->execute();
    $vaccine = $findVaccineSql->fetch();

    $output = "
    <div class='row'>
    <div class='col'>
      <div class='information'>
        <h3 class='header'>Patient details:</h3>
        <p>Full Name.: " . $patient['fullName'] . "</p>
        <p>IC/ Passport: " . $patient['ICPassport'] . "</p>
      </div>
    </div>
    <div class='col'>
      <div class='information'>
        <h3 class='header'>Batch info:</h3>
        <p>Batch No.: " . $batch['batchNo'] . "</p>
        <p>Expiry date: " . $batch['expiryDate'] . "</p>
        <p>Vaccine name: " . $vaccine['vaccineName'] . "</p>
        <p>Manufacturer: " . $vaccine['manufacturer'] . "</p>
      </div>
    </div>
  </div>
  <div class='row'>
    <h3 class='header mt-0'>Status:</h3>

    <p>" . $vaccination['status'] . "
         <i class='fas fa-edit fa-lg'></i>
    </p>
    <span class='type'>
      <form id='form' action=''>
        <div class='form-control'>
          <label for='remark'>Remarks:</label>
          <input type='text' placeholder='Any remarks?' />
        </div>
      </form>
      <button type='submit'>Update</button>
    </span>
  </div>";

    echo $output;
}
