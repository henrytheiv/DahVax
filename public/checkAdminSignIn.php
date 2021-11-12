<?php

if ($_SESSION['user'] == null) {

    redirect("index.php");
}else{

  $findAdminSql = $pdo->prepare("SELECT * FROM admins WHERE username = :username");
  $findAdminSql->bindValue(":username", $_SESSION['user']);
  $findAdminSql->execute();
  $result = $findAdminSql->rowCount();

  if (!$result > 0){

    redirect("PatientMenu.php");

  }
}