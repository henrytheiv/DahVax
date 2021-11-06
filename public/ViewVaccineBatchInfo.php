<?php

session_start();

require_once '../app/app.php';


if ($_SESSION['user'] == null) {

  redirect("index.php");
}

$getBatchesSql = $pdo->prepare("SELECT * FROM batches WHERE centreName = :centreName");
$getBatchesSql->bindValue(":centreName", $_SESSION['centreName']);
$getBatchesSql->execute();
$batches = $getBatchesSql->fetchAll(PDO::FETCH_ASSOC);



include_once '../views/partials/header.php';

?>
<nav class="navbar navbar-expand-lg custom-navbar" id="navbarNav">
  <span class="navbar-brand mb-0 h1">DahVax</span>
  <button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    <ul class="navbar-nav ms-auto">
      <li class="nav-item dropdown">
        <div id="my-custom-ddl">
          <a onclick="dropDownIconChange()" class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Menu
            <i class="fas fa-bars"></i>
          </a>
          <div class="dropdown-menu custom-nav-dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="AdminMenu.php">Dashboard <i class="fas fa-user"></i></a>
            <a class="dropdown-item" href="RecordNewVaccineBatch.php">Record New Vaccine Batch</a>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php">Log Out <i class="fas fa-sign-out-alt"></i></a>
      </li>
    </ul>
  </div>
</nav>

<!-- Batch table -->

<h2 class="page-title">View Vaccine Batch Info</h2>
<div class="container mt-3">
  <h3 class="instruction">Select a vaccine batch to view:</h3>

  <div class="scrollable">
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">Batch No.</th>
          <th scope="col">Vaccine Name</th>
          <th scope="col">No. of pending appointments</th>

          <th></th>
        </tr>
      </thead>
      <tbody>


        <?php foreach ($batches as $batch) :

          $findVaccineSQL = $pdo->prepare("SELECT * FROM vaccines WHERE vaccineID = :vaccineID");
          $findVaccineSQL->bindValue(':vaccineID', $batch['vaccineID']);
          $findVaccineSQL->execute();
          $vaccine = $findVaccineSQL->fetch();

        ?>
          <tr>
            <td><?php echo $batch['batchNo']; ?></td>
            <td><?php echo $vaccine['vaccineName']; ?></td>
            <td><?php echo $batch['quantityPending']; ?></td>
            <td>
              <i class="fas fa-eye fa-2x view_batch_data view_vaccinations" id="<?php echo $batch['batchNo']; ?>" data-toggle="modal" href="#myModal"></i>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>



</div>

<div class="modal fade" id="myModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="viewBatchTitle">Batch Info</h3>
        <i class="fas fa-window-close fa-2x close" data-dismiss="modal" aria-label="Close"></i>
      </div>
      <div class="modal-body">

        <div class="information" id="batch-detail">

        </div>

        <div id="all_vaccinations">

        </div>


      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="myModal2">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="manageVaccinationTitle">Vaccination Info</h3>
        <i class="fas fa-window-close fa-2x close" data-dismiss="modal" aria-label="Close"></i>
      </div>
      <div class="container"></div>
      <div class="modal-body">
        <div class="container text-center">

          <div id="vaccination-detail">

          </div>

        </div>
      </div>
    </div>
  </div>
</div>


<script>
  $(document).ready(function() {

    $('.view_batch_data').click(function() {

      var batchNo = $(this).attr("id");

      $.ajax({

        url: "selected_batch.php",
        method: "POST",
        data: {
          batchNo: batchNo
        },
        success: function(data) {

          $('#batch-detail').html(data);

        }
      });
    });

    $('.view_vaccinations').click(function() {

      var batchNo = $(this).attr("id");

      $.ajax({

        url: "vaccination_list.php",
        method: "POST",
        data: {
          batchNo: batchNo
        },
        success: function(data) {

          $('#all_vaccinations').html(data);

        }
      });


    });

    




  });


  function getVaccination() {
    var vaccinationID = $(".fa-edit").attr('id');

    $.ajax({
      url: "selected_vaccination.php",
      method: "POST",
      data: {
        vaccinationID: vaccinationID
      },
      success: function(data) {
        $("#vaccination-detail").html(data);
      }

    });



  }
</script>


<?php include_once '../views/partials/footer.php'; ?>