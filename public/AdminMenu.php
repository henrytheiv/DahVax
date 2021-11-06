<?php

session_start();

require_once '../app/database.php';

$sql = $pdo->prepare("SELECT * FROM admins WHERE username = :username");
$sql->bindValue(':username', $_SESSION['user']);
$sql->execute();
$admin = $sql->fetch();

$_SESSION['centreName']=$admin['centreName'];


include_once '../views/partials/header.php';


?>
<nav class="navbar navbar-expand-lg custom-navbar" id="navbarNav">
  <span class="navbar-brand mb-0 h1">DahVax</span>

  <ul class="navbar-nav ms-auto">
    <li class="nav-item">
      <a class="nav-link" href="index.php">Log Out <i class="fas fa-sign-out-alt"></i></a>
    </li>
  </ul>
</nav>

<h2 class="page-title">Dashboard</h2>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-lg-4 text-center">
    <i class="fas fa-user fa-10x user-icon mb-2"></i>
      <h2><?php echo $admin['fullName']; ?></h2>
      <p><?php echo $admin['centreName']; ?></p>
    </div>
    <div class="col-lg-4">
      <div class="row">
        <a class="btn btn-primary btn-lg mb-3 function-button" href="RecordNewVaccineBatch.php" role="button">
          Record New Vaccine Batch
        </a>
      </div>
      <div class="row">
        <a class="btn btn-primary btn-lg mb-3 function-button" href="ViewVaccineBatchInfo.php" role="button">
          View Vaccine Batch Info
        </a>
      </div>
    </div>
  </div>
</div>

<?php

include_once '../views/partials/footer.php';

?>