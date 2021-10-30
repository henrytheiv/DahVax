<?php



if ($_SERVER['REQUEST_METHOD'] === 'POST') {


  require_once '../../app/database.php';

  

  $batchNo = $_POST['batchNo'];
  $expiryDate = $_POST['expiryDate'];
  $quantityAvailable = $_POST['quantityAvailable'];
  $quantityPending = 0;
  $quantityAdministered = 0;
  $vaccineID = 'V110';

  $success = '';

  $wrong_batchNo = '';
  $wrong_expiryDate = '';
  $wrong_quantity = '';

  $findExistingBatchNoSQL = $pdo->prepare("SELECT * FROM batches WHERE batchNo = :batchNo");
  $findExistingBatchNoSQL->bindValue(':batchNo', $batchNo);
  $findExistingBatchNoSQL->execute();
  $result = $findExistingBatchNoSQL->rowCount();



  if (empty($batchNo)) {

    $wrong_batchNo = 'blankBatchNo';

  }
  else{

    if( $result > 0){
      $wrong_batchNo = 'usedBatchNo';
    }
  }

  if (empty($expiryDate)) {

    $wrong_expiryDate = 'blankExpiryDate';
  } else {

    if ($expiryDate < date('Y-m-d')) {

      $wrong_expiryDate = 'invalidExpiryDate';
    }
  }

  if (empty($quantityAvailable)) {

    $wrong_quantity = 'blankQuantity';
  } else {

    if ($quantityAvailable < 10) {

      $wrong_quantity = 'invalidQuantity';
    }
  }

  if ($wrong_batchNo == '' && $wrong_expiryDate == '' && $wrong_quantity == '') {

    $data = array(

      ':batchNo' => $batchNo,
      ':expiryDate' => $expiryDate,
      ':quantityAvailable' => $quantityAvailable,
      ':quantityPending' => $quantityPending,
      ':quantityAdministered' => $quantityAdministered,
      ':vaccineID' => $vaccineID
    );

    $statement = $pdo->prepare("INSERT INTO batches (batchNo, expiryDate, quantityAvailable, quantityPending, quantityAdministered, vaccineID)
    VALUES (:batchNo, :expiryDate, :quantityAvailable, :quantityPending, :quantityAdministered, :vaccineID)");

    $statement->execute($data);

    $success = 'Yeah!';
  }

  $output = array(
    'success' => $success,
    'wrong_batchNo'  =>  $wrong_batchNo,
    'wrong_expiryDate'  =>  $wrong_expiryDate,
    'wrong_quantity'  =>  $wrong_quantity
  );

  echo json_encode($output);
}
